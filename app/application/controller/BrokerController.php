<?php

class BrokerController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function show($url){
        if(!Session::userIsLoggedIn()) Redirect::to('admin');
        $this->View->render('broker/show.html');
    }

    public function edit(){
        if(!Session::userIsLoggedIn()) Redirect::to('admin');
        $uid = Session::get('user_id');
        $user = User::getInstance()->byId($uid);
        $this->View->render('broker/edit.html', array('user'=>$user, 'is_admin' => false));
    }
}
