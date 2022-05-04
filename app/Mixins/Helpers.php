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

	// // asset('assets/images/avatar/'.RenderJson(Auth::user()->profile, "photo", 'safari.png'))

	// if (!function_exists('ShowFile')) {
	// 	function ShowFile($data, $path){
			
	// 		$filename = time().'.'.$data->extension();

    //     	$data->move(public_path('uploads'), $image);

	// 		return $class;
	// 	}
	// }

?>