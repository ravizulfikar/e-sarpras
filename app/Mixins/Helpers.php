<?php
	//Rendering Json
	if (!function_exists('RenderJson')) {
		function RenderJson($dataJson, $object, $value = null){
			if(!empty(json_decode($dataJson, true)[$object])){
				$class = json_decode($dataJson, true)[$object];
			} else {
				$class = $value;
			}
			return $class;
		}
	}

	if (!function_exists('UploadFile')) {
		function UploadFile($data, $path, $fileRemove = null, $id = null){
			if($fileRemove != null){
				if(file_exists($path.$fileRemove)){
					unlink($path.$fileRemove);
				}
			}

			if($id != null){
				$filename = $id.'_'.time().'.'.$data->extension();
			} else {
				$filename = time().'.'.$data->extension();
			}
        	$data->move(public_path($path), $filename);
			return $filename;
		}
	}

	if (!function_exists('LevelBadge')) {
		function LevelBadge($data){
			if($data == 'superadmin'){
				$class = '<span class="badge badge-primary">'.$data.'</span>';
			} else if($data == 'admin'){
				$class = '<span class="badge badge-success">'.$data.'</span>';
			} else if($data == 'user'){
				$class = '<span class="badge badge-warning">'.$data.'</span>';
			} else {
				$class = '<span class="badge badge-danger">ERROR</span>';
			}

			return $class;
		}
	}

	if (!function_exists('CityBadge')) {
		function CityBadge($data){
			if($data == 'Jakarta Pusat'){
				$class = '<span class="badge badge-primary">'.$data.'</span>';
			} else if($data == 'Jakarta Utara'){
				$class = '<span class="badge badge-success">'.$data.'</span>';
			} else if($data == 'Jakarta Selatan'){
				$class = '<span class="badge badge-warning">'.$data.'</span>';
			} else if($data == 'Jakarta Barat'){
				$class = '<span class="badge badge-info">'.$data.'</span>';
			} else if($data == 'Jakarta Timur'){
				$class = '<span class="badge badge-danger">'.$data.'</span>';
			} else if($data == 'Kepulauan Seribu'){
				$class = '<span class="badge badge-secondary">'.$data.'</span>';
			} else if($data == 'Dinas'){
				$class = '<span class="badge badge-warning">'.$data.'</span>';
			} else {
				$class = '<span class="badge badge-danger">ERROR</span>';
			}

			return $class;
		}
	}

	if (!function_exists('HolidayBadge')) {
		function HolidayBadge($data){
			if($data == true){
				$class = '<span class="badge badge-success"> true </span>';
			} else {
				$class = '<span class="badge badge-danger"> false </span>';
			}

			return $class;
		}
	}

	if (!function_exists('Badge')) {
		function Badge($params, $value){
			$params = json_decode($params, true);
			foreach ($params as $param) {
				if($param['id'] == $value){
					$class = '<span class="'.$param["class"].'">'.$value.'</span>';
				}
			}

			return '<span class="'.$class.'">'.$value.'</span>';
		}
	}

	if (!function_exists('ShowFile')) {
		function ShowFile($file, $path, $type, $value = null){
			if($type == 'image'){
				if(!empty($file)){
					$class = asset($path.$file);
				} else {
					$class = \Avatar::create($value)->toBase64();
				}
			}

			return $class;
		}
	}

	if (!function_exists('RenderParams')) {
		function RenderParams($slug){
			$params = \DB::table('params')->whereSlug($slug)->first();
			return json_decode($params->object, true);
		}
	}

	if (!function_exists('TokenCreate')) {
		function TokenCreate(){
			return strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8));
		}
	}

	if (!function_exists('ParamsCategory')) {
		function ParamsCategory(){
			return \DB::table('category')->get();
		}
	}

	// Ticket::whereStatus($status)->count();
	if (!function_exists('LocationTicket')) {
		function LocationTicket($data, $other = null){

			if($other = 'view'){
				$br = ' | ';
			} else {
				$br = '<br>';
			}

			if(!empty(json_decode($data, true))){
				$datajson = json_decode($data, true);
				if(isset($datajson['floor'])){
					$class = CityBadge($datajson['city']).$br.' Lantai : '.$datajson['floor'].' - '.$datajson['department'];
				} 
				
				if(isset($datajson['location'])){
					$class = $datajson['location'];
				}

				if(isset($datajson['unit'])){
					$class = CityBadge($datajson['city']).$br.$datajson['unit'];
				}
			} else {
				$class = null;
			}
			return $class;
		}
	}

	if (!function_exists('Location')) {
		function Location($data, $type){
			if(!empty(json_decode($data, true))){
				$datajson = json_decode($data, true);

				if($type == 'city'){
					if(isset($datajson['city'])){
						$class = CityBadge($datajson['city']);
					} else {
						$class = '-';
					}
				}

				if($type == 'unit'){
					if(isset($datajson['floor'])){
						$class = 'Lantai : '.$datajson['floor'].' - '.$datajson['department'];
					} 
					
					if(isset($datajson['location'])){
						$class = $datajson['location'];
					}
	
					if(isset($datajson['unit'])){
						$class = $datajson['unit'];
					}
				}
				
			} else {
				$class = '-';
			}
			return $class;
		}
	}

	if (!function_exists('TypeBadge')) {
		function TypeBadge($data){
			if($data == 'troubleshooting'){
				return '<span class="badge badge-primary">Troubleshooting</span>';
			} else if($data == 'server'){
				return '<span class="badge badge-success">Server</span>';
			} else if($data == 'monitoring'){
				return '<span class="badge badge-warning">Monitoring</span>';
			} else {
				return '<span class="badge badge-danger">ERROR</span>';
			}
		}
	}

	if (!function_exists('StatusBadge')) {
		function StatusBadge($data){
			if($data == 'entry'){
				return '<span class="badge badge-primary">Open</span>';
			} else if($data == 'finish'){
				return '<span class="badge badge-success">Finish</span>';
			} else if($data == 'process'){
				return '<span class="badge badge-warning">Process</span>';
			} else {
				return '<span class="badge badge-danger">ERROR</span>';
			}
		}
	}

	if (!function_exists('StatusHeader')) {
		function StatusHeader($data){
			if($data == 'entry'){
				return 'primary';
			} else if($data == 'finish'){
				return 'success';
			} else if($data == 'process'){
				return 'warning';
			} else {
				return 'danger';
			}
		}
	}

	if (!function_exists('UserName')) {
		function UserName($data){
			return \App\Models\User::whereId($data)->first()->name;
		}
	}

	if (!function_exists('getUserProcess')) {
		function getUserProcess($id)
		{
			return \App\Models\UserTicket::whereTicketId($id)->get();
		}
	}

	if (!function_exists('ObjectToArray')) {
		function ObjectToArray($data, $object = null) 
		{	
			if ((! is_array($data)) and (! is_object($data))) return 'xxx';
			$result = array();
			$data = (array) $data;
			foreach ($data as $key => $value) {
				if (is_object($value)) $value = (array) $value;
				if (is_array($value)) 
				$result[$key] = ObjectToArray($value);
				else
					$result[$key] = $value;
			}

			return $result;
			// dd($result['trouble']);
			// if($object != null){
			// 	if(!empty($result[$object])){
			// 		$class = $result;
			// 	} else {
			// 		$class = '-';
			// 	}
			// 	return $class;

			// } else {
			// 	return $result;
			// }

			// if(!empty(json_decode($dataJson, true)[$object])){
			// 	$class = json_decode($dataJson, true)[$object];
			// } else {
			// 	$class = $value;
			// }
			// return $class;
		}
	}

	if (!function_exists('JsonObjectToArray')) {
		function JsonObjectToArray($data){
			return ObjectToArray(json_decode($data));
		}
	}

	if (!function_exists('ReportVerify')) {
		function ReportVerify($data){
			if($data == 'kasatpel'){
				$class = '<span class="badge badge-primary">Verify by Kasatpel</span>';
			} else if($data == 'kasubbag'){
				$class = '<span class="badge badge-success">Verify by Kasubbag</span>';
			} else if($data == 'kabid'){
				$class = '<span class="badge badge-info">Verify by Kabid</span>';
			} else {
				$class = '<span class="badge badge-danger">Not Verify</span>';
			}

			return $class;
		}
	}

	if (!function_exists('MonthName')) {
		function MonthName($data){
			if($data == '01'){
				$class = 'Januari';
			} else if($data == '02'){
				$class = 'Februari';
			} else if($data == '03'){
				$class = 'Maret';
			} else if($data == '04'){
				$class = 'April';
			} else if($data == '05'){
				$class = 'Mei';
			} else if($data == '06'){
				$class = 'Juni';
			} else if($data == '07'){
				$class = 'Juli';
			} else if($data == '08'){
				$class = 'Agustus';
			} else if($data == '09'){
				$class = 'September';
			} else if($data == '10'){
				$class = 'Oktober';
			} else if($data == '11'){
				$class = 'November';
			} else if($data == '12'){
				$class = 'Desember';
			} else {
				$class = '-';
			}

			return $class;
		}
	}

	if (!function_exists('DateFormat')) {
		function DateFormat($tgl) {
			$dt = new  \Carbon\Carbon($tgl);
			setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US');
		
			return $dt->formatLocalized('%e %B %Y'); // Senin, 3 September 2018
		}
	}

	if (!function_exists('DayFormat')) {
		function DayFormat($tgl) {
			$dt = new  \Carbon\Carbon($tgl);
			setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US');

			return $dt->formatLocalized('%A'); // Senin, 3 September 2018
		}
	}

	
?>