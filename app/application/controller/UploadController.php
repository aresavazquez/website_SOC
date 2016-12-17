<?php

class UploadController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function upload(){
        if($_FILES['file']['error']) $this->View->renderJSON($this->error_code($_FILES['file']['error'], null));
    	
    	$file = $_FILES['file']['tmp_name'];
    	$new_file_name = uniqid() . '_' . strtolower($_FILES['file']['name']);
        $new_file_name = $this->sluggify($new_file_name);
    	$is_valid = null;
    	$result_array = getimagesize($file); 

		if ($result_array !== false) { 
    		$mime_type = $result_array['mime']; 
    		switch($mime_type) { 
        		case "image/jpeg": 
            	case "image/gif":
            	case "image/png": 
            		$is_valid = true;
            		break; 
        		default: 
            		$is_valid = false;
    		} 
		} else { 
    		$is_valid = false;
		}
		if(!$is_valid) $this->View->renderJSON($this->error_code('El archivo que has subido no es válido', null));
		if( move_uploaded_file($_FILES['file']['tmp_name'], './img/uploads/'.$new_file_name) ){
			$path = Config::get('URL') . 'img/uploads/' . $new_file_name;
			$this->View->renderJSON($this->success_code($path));
		}
    }

    public function upload_profile_image(){
        if($_FILES['file']['error']) $this->View->renderJSON($this->error_code($_FILES['file']['error'], null));
        
        $file = $_FILES['file']['tmp_name'];
        $userID = $_POST['user_id'];
        $new_file_name = 'profile/' . $userID . '_' . strtolower($_FILES['file']['name']);
        $new_file_name = $this->sluggify($new_file_name);
        $is_valid = null;
        $result_array = getimagesize($file); 

        if ($result_array !== false) { 
            $mime_type = $result_array['mime']; 
            switch($mime_type) { 
                case "image/jpeg": 
                case "image/gif":
                case "image/png": 
                    $is_valid = true;
                    break; 
                default: 
                    $is_valid = false;
            } 
        } else { 
            $is_valid = false;
        }
        if(!$is_valid) $this->View->renderJSON($this->error_code('El archivo que has subido no es válido', null));
        if( move_uploaded_file($_FILES['file']['tmp_name'], './img/uploads/'.$new_file_name) ){
            $path = Config::get('URL') . 'img/uploads/' . $new_file_name;
            User::getInstance()->setData($userID, array('profile_image'=>$path));
            $this->View->renderJSON($this->success_code($path));
        }    
    }

    public function upload_new_profile_image(){
        if($_FILES['file']['error']) $this->View->renderJSON($this->error_code($_FILES['file']['error'], null));
        
        $file = $_FILES['file']['tmp_name'];
        $new_file_name = 'profile/' . strtolower($_FILES['file']['name']);
        $new_file_name = $this->sluggify($new_file_name);
        $is_valid = null;
        $result_array = getimagesize($file); 

        if ($result_array !== false) { 
            $mime_type = $result_array['mime']; 
            switch($mime_type) { 
                case "image/jpeg": 
                case "image/gif":
                case "image/png": 
                    $is_valid = true;
                    break; 
                default: 
                    $is_valid = false;
            } 
        } else { 
            $is_valid = false;
        }
        if(!$is_valid) $this->View->renderJSON($this->error_code('El archivo que has subido no es válido', null));
        if( move_uploaded_file($_FILES['file']['tmp_name'], './img/uploads/'.$new_file_name) ){
            $path = Config::get('URL') . 'img/uploads/' . $new_file_name;
            $this->View->renderJSON($this->success_code($path));
        }
    }

    private function sluggify($url){
        # Prep string with some basic normalization
        $url = strtolower($url);
        $url = strip_tags($url);
        $url = stripslashes($url);
        $url = html_entity_decode($url);

        # Remove quotes (can't, etc.)
        $url = str_replace('\'', '', $url);

        # Replace non-alpha numeric with hyphens
        $match = '/[^a-z0-9]+/';
        $replace = '-';
        $url = preg_replace($match, $replace, $url);

        $url = trim($url, '-');

        return $url;
    }

    private function success_code($data){
        return array('status'=>200, 'data'=>$data);
    }

    private function error_code($errors, $data){
        return array('status'=>500, 'errors'=>$errors, 'data'=>$data);
    }
}
