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
			} else {
				$class = '<span class="badge badge-danger">ERROR</span>';
			}

			return $class;
		}
	}

	// // asset('assets/images/avatar/'.RenderJson(Auth::user()->profile, "photo", 'safari.png'))

	// if (!function_exists('ShowFile')) {
	// 	function ShowFile($data, $path){
			
	// 		$filename = time().'.'.$data->extension();

    //     	$data->move(public_path('uploads'), $image);

	// 		return $class;
	// 	}
	// }

?>