<?php

namespace App\Http\Services\ESarpras;

use App\Models\Report;
use App\Models\ReportDescription;
use App\Models\ReportPicture;
use App\Models\Holiday;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ReportServices
{
    public function main()
    {
        return Report::with('ReportDescription', 'ReportPicture')->whereUserId(auth()->user()->id)->get();
    }

    public function findBy($field, $id)
    {
        return Report::with('ReportDescription', 'ReportPicture')->where($field, $id)->first();
    }

    public function deleteDescription($report)
    {
        return ReportDescription::where('report_id', $report->id)->delete();
    }

    public function deletePicture($report)
    {
        return ReportPicture::where('report_id', $report->id)->delete();
    }

    public function doStore($request) {

        $report = Report::create($request->all());

        return $report;
    }

    public function doUpdate($request, $report) {

        $report->update($request->all());

        return "success";
    }

    public function doStoreGenerate($request) {

        $YearMonth = explode("-", $request->month);
        $request['user_id']         = auth()->user()->id;
        $request['month']           = $YearMonth[1];
        $request['year']            = $YearMonth[0];
        $request['verification']    = 'open';
        //Store
        $report = Report::create($request->all());

        foreach(RenderParams('report') as $key => $value){
            if($value['role'] == auth()->user()->role->slug){
                $dataDescription = $value['data'];
            }
        }

        //Get 1 Month Date
        $dates = $this->getRangeWorkDays($YearMonth[1]);
        foreach ($dates as $date) {
            $request['report_id']       = $report->id;
            $request['date']            = $date;
            $request['descriptions']    = json_encode($dataDescription, true);
            
            ReportDescription::create($request->all());
            ReportPicture::create($request->all());
        }

        // dd("OKE");
        // dd([$YearMonth, $request->all(), $dates]);
        return response()->json([
            'success'   => true,
            'message'   => "Data Report Successfully Generated!"
        ]);
    }

    public function getRangeWorkDays($month){
        //Get holidays
        $holiday = Holiday::whereMonth('date', $month)->get()->pluck('date')->toArray();
        foreach ($holiday as $dateHoliday) {
            $holidays[] = date('Y-m-d',strtotime($dateHoliday));
        }

        //Get 1 Month Date
        $firstday = date('01-' . $month . '-Y');
        $lastday = date(date('t', strtotime($firstday)) .'-' . $month . '-Y');

        CarbonPeriod::macro('Weekdays', function () { return $this->filter('isWeekday'); });

        $period = CarbonPeriod::create($firstday, $lastday)->Weekdays();

        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        return array_diff($dates, $holidays);
    }

    public function paramsDescription(){
        foreach(RenderParams('report') as $key => $value){
            if($value['role'] == auth()->user()->role->slug){
                $dataDescription = $value['data'];
            }
        }

        return $dataDescription;
    }

    //Function Check RepoertDescription
    public function checkReportDescription($id, $request){
        return ReportDescription::where('date', $request->date)->whereReportId($id)->first();
    }

    public function doStoreDescription($id, $request) {
        $check = $this->checkReportDescription($id, $request);
        if(!empty($check)){
            return redirect()->back()->with('error', 'Data Report Description in '.$request->date.' Already Exist!');
        } else {
            $request['report_id']       = $id;
            $request['descriptions']    = json_encode($request->descriptions, true);
            ReportDescription::create($request->all());
            return redirect()->back()->with('success', 'Data Report Description successfully added!');
        }
    }

    //Function Check RepoertPicture
    public function checkRepoertPicture($id, $request){
        return ReportPicture::where('date', $request->date)->whereReportId($id)->first();
    }

    public function doStorePicture($id, $request) {
        $check = $this->checkRepoertPicture($id, $request);
        if(!empty($check)){
            \File::deleteDirectory(storage_path('tmp'));
            return redirect()->back()->with('error', 'Data Report Picture in '.$request->date.' Already Exist!');
        } else { 
            //File Upload
            foreach ($request->pictures as $file) {
                \File::move(storage_path('tmp/uploads/'.$file), storage_path('app/public/report/pictures/'.$file));
            }

            \File::deleteDirectory(storage_path('tmp'));
            

            //Insert Report
            $request['report_id']       = $id;
            $request['pictures']        = json_encode($request->pictures, true);
            ReportPicture::create($request->all());
            return redirect()->back()->with('success', 'Data Report Picture successfully added!');
        }
    }

    public function doUpdatePicture($report_picture, $request) {
        if(!empty($request->pictures)){
            foreach ($request->pictures as $file) {
                \File::move(storage_path('tmp/uploads/'.$file), storage_path('app/public/report/pictures/'.$file));
            }
    
            \File::deleteDirectory(storage_path('tmp'));
            
            //Merge
            // $oldPicture         = $request['old_pictures'];
            if(!empty($request['old_pictures'])){
                $pictureMerge       = array_merge($request['old_pictures'], $request->pictures);
            } else {
                $pictureMerge       = $request->pictures;
            }
            //Insert Report
            $request['pictures']        = json_encode($pictureMerge, true);
        }
        
        ReportPicture::find($report_picture)->update($request->all());

        return redirect()->back()->with('success', 'Data Report Picture successfully update!');
    }


    public function tmpFileUpload($request){
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . time() . '_' .$file->getClientOriginalName();
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function tmpFileRemove($request){
        $file_path = storage_path('tmp/uploads/').$request->filename;
        unlink($file_path);
        return response()->json([
            'success'       => true,
        ]);
    }

    public function PictureRemoves($report_picture){
        if($report_picture->pictures != null){
            foreach(json_decode($report_picture->pictures, true) as $key => $value){
                $file_path = storage_path('app/public/report/pictures/').$value;
                unlink($file_path);
            }
        }
    }

    public function removeByPicture($report_picture, $name){
        //Remove File
        $file_path = storage_path('app/public/report/pictures/').$name;
        unlink($file_path);

        //Remove in Array
        $pictures = json_decode($report_picture->pictures, true);
        foreach($pictures as $key => $value){
            if($value == $name){
                unset($pictures[$key]);
            }
        }

        //Update in ReportPicture
        $report_picture->pictures = json_encode($pictures, true);
        $report_picture->save();

        response()->json([
            'success'   =>  true,
            'message'   => 'Data Report Picture successfully removed!',
        ]);
        // return redirect()->back()->with('success', 'Data Report Picture successfully removed!');
        // if($report_picture->pictures != null){
        //     foreach(json_decode($report_picture->pictures, true) as $key => $value){
        //         $file_path = storage_path('app/public/report/pictures/').$value;
        //         unlink($file_path);
        //     }
        // }
    }

    
}
