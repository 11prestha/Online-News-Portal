<?php
	function debug($data, $is_exit = false){
		echo "<pre style='background: #FFFFFF;'>";
		print_r($data);
		echo "</pre>";
		if($is_exit){
			exit;
		}
	}

	function setSession($key, $value){
		if(!isset($_SESSION)){
			session_start();
		}
		$_SESSION[$key]= $value;
	}

	function flash(){
		if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
			echo "<p class='alert alert-danger'>".$_SESSION['error']."</p>";
			unset($_SESSION['error']);
		}

			if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
				echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
				unset($_SESSION['success']);
			}
	}

	function redirect($path, $session_key= null, $session_msg= null){
		if($session_key !== null){
			setSession($session_key, $session_msg);
		}
        header('location: '.$path);
        exit;
	}

	function randomString($length = 100){
		$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$len = strlen($chars);
		$random = "";
		for($i=0; $i<$length; $i++){
			$posn = rand(0, $len-1);
			$random .= $chars[$posn];
		}
		return $random;
	}

	function sanitize($str){
		$str = strip_tags($str);		//removes tags <p>,<script>
		$str = rtrim($str);				//removes multipl unnecessary spaces
		return $str;
	}

	function uploadSingleImage($file, $dir_name){
		if($file['error'] == 0){
			if($file['size'] <= 2048000){
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				
				if(in_array(strtolower($ext), ALLOWED_EXTS)){
					$upload_path = UPLOAD_DIR."/".$dir_name;
					if(!is_dir($upload_path)){
						mkdir($upload_path, 0777, true);
					}
					$file_name = ucfirst($dir_name)."-".date('Ymdhis').rand(0,999).".".$ext;
					
					$success = move_uploaded_file($file['tmp_name'], $upload_path."/".$file_name);
					//debug($success, true);
					if($success){
						return $file_name;
					}else{
						return false;
					}
				}else{
					return false; //echo "Extension does not match";
				}
			}else{
				return false; //echo "File Size exceeds the limit";
			}
		}else{
			return false;
		}
	}