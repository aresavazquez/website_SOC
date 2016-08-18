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

    private function success_code($data){
        return array('status'=>200, 'data'=>$data);
    }

    private function error_code($errors, $data){
        return array('status'=>500, 'errors'=>$errors, 'data'=>$data);
    }
}
