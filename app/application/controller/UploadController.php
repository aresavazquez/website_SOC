<?php

class UploadController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function form(){
        $this->View->render('site/upload.html');
    }
}
