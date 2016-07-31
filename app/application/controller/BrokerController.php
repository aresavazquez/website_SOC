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
        $this->View->render('broker/show.html');
    }

    public function edit(){
        if(!Session::userIsLoggedIn()) Redirect::to('admin');
        $uid = Session::get('user_id');
        $user = User::getInstance()->byId($uid);
        $site = Site::getInstance()->byUser($uid);
        $states = State::getInstance()->all();
        foreach ($states as $key => $state) {
            $state->name = utf8_encode($state->name);
        }
        $site->title = utf8_encode($site->title);
        $site->address = utf8_encode($site->address);
        $site->content = ltrim(utf8_encode($site->content));
        $this->View->render('broker/edit.html', array('user' => $user, 'site' => $site, 'states' => $states, 'is_admin' => false));
    }
}
