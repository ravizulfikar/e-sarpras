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

	if (!function_exists('UserName')) {
		function UserName($data){
			return \App\Models\User::whereId($data)->first()->name;
		}
	}

	if (!function_exists('ObjectToArray')) {
		function ObjectToArray($data) 
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
		}
	}

	if (!function_exists('JsonObjectToArray')) {
		function JsonObjectToArray($data){
			return ObjectToArray(json_decode($data));
		}
	}
?>