<?php

namespace App\Http\Services\ESarpras;

use App\Models\Holiday;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Auth;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class HolidayServices
{
    public function main()
    {
        return Holiday::orderBy('date', "DESC")->get();
    }

    public function findBy($field, $id)
    {
        return Holiday::where($field, $id)->first();
    }

    public function doStore($request) {
        $request['source'] = Auth::user()->id;
        $role = Holiday::create($request->all());

        return $role;
    }

    public function doUpdate($request, $holiday) {
        $request['source'] = Auth::user()->id;
        $holiday->update($request->all());

        return "success";
    }

    public function sync(){
        try {
            $year = $year ?? Date('Y');

            $checkEvent = Holiday::whereYear('date', $year)->where('source', 'public_api')->get();

            $client = new \GuzzleHttp\Client;

            $apiRequest = $client->request('GET', "https://api-harilibur.vercel.app/api", [
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',                       //If needed to debug   
            ]);
            $content = json_decode($apiRequest->getBody()->getContents());
            
            if(count($checkEvent) > 0){
                Holiday::where('source', 'public_api')->delete();
                
                foreach ($content as $holiday) {
                    $dataHoliday = [
                        'source'        => 'public_api',
                        'date'          => $holiday->holiday_date,
                        'name'          => $holiday->holiday_name,
                        'is_holiday'    => $holiday->is_national_holiday,
                    ];
                    Holiday::create($dataHoliday);
                }

            } else {
                foreach ($content as $holiday) {
                    $dataHoliday = [
                        'source'        => 'public_api',
                        'date'          => $holiday->holiday_date,
                        'name'          => $holiday->holiday_name,
                        'is_holiday'    => $holiday->is_national_holiday,
                    ];
                    Holiday::create($dataHoliday);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Data Successfully Synced!'
            ]);

        } catch (RequestException $re) {
            
            return response()->json([
                'success' => true,
                'message' => $e->getMessage()
            ]);

        }

    }
}
