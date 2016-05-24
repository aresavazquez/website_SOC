<?php
class User extends PDODB{
	private $by_page;
	public function __construct(){
		parent::__construct();
		$this->table = 'users';
	}
	/**
     * Login process (for DEFAULT user accounts).
     *
     * @param $user_name string The user's name
     * @param $user_password string The user's password
     * @param $set_remember_me_cookie mixed Marker for usage of remember-me cookie feature
     *
     * @return bool success state
     */
    public static function login($user_name, $user_password, $set_remember_me_cookie = null){
        // we do negative-first checks here, for simplicity empty username and empty password in one line
        if (empty($user_name) OR empty($user_password)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_OR_PASSWORD_FIELD_EMPTY'));
            return false;
        }

	    // checks if user exists, if login is not blocked (due to failed logins) and if password fits the hash
	    $result = self::validateAndGetUser($user_name, $user_password);

        // check if that user exists. We don't give back a cause in the feedback to avoid giving an attacker details.
        if (!$result) {
            //No Need to give feedback here since whole validateAndGetUser controls gives a feedback
            return false;
        }

        // stop the user's login if account has been soft deleted
        if ($result->user_deleted == 1) {
            Session::add('feedback_negative', Text::get('FEEDBACK_DELETED'));
            return false;
        }

        // stop the user from logging in if user has a suspension, display how long they have left in the feedback.
        if ($result->user_suspension_timestamp != null && $result->user_suspension_timestamp - time() > 0) {
            $suspensionTimer = Text::get('FEEDBACK_ACCOUNT_SUSPENDED') . round(abs($result->user_suspension_timestamp - time())/60/60, 2) . " hours left";
            Session::add('feedback_negative', $suspensionTimer);
            return false;
        }

        // reset the failed login counter for that user (if necessary)
        if ($result->user_last_failed_login > 0) {
            self::resetFailedLoginCounterOfUser($result->user_name);
        }

        // save timestamp of this login in the database line of that user
        self::saveTimestampOfLoginOfUser($result->user_name);

        // if user has checked the "remember me" checkbox, then write token into database and into cookie
        if ($set_remember_me_cookie) {
            self::setRememberMeInDatabaseAndCookie($result->user_id);
        }

        // successfully logged in, so we write all necessary data into the session and set "user_logged_in" to true
        self::setSuccessfulLoginIntoSession(
            $result->user_id, $result->user_name, $result->user_email, $result->user_account_type
        );

        // return true to make clear the login was successful
        // maybe do this in dependence of setSuccessfulLoginIntoSession ?
        return true;
    }
    /**
     * Log out process: delete cookie, delete session
     */
    public static function logout()
    {
        $user_id = Session::get('user_id');

        self::deleteCookie($user_id);

        Session::destroy();
        Session::updateSessionId($user_id);
    }
    /**
     * Deletes the cookie
     * It's necessary to split deleteCookie() and logout() as cookies are deleted without logging out too!
     * Sets the remember-me-cookie to ten years ago (3600sec * 24 hours * 365 days * 10).
     * that's obviously the best practice to kill a cookie @see http://stackoverflow.com/a/686166/1114320
     *
     * @param string $user_id
     */
    public static function deleteCookie($user_id = null){
        // is $user_id was set, then clear remember_me token in database
        if(isset($user_id)){
        	$data = array('user_remember_me_token' => NULL, 'user_id' => $user_id);
            self::_update($data, "user_id = $user_id LIMIT 1");
            //$database = DatabaseFactory::getFactory()->getConnection();

            //$sql = "UPDATE users SET user_remember_me_token = :user_remember_me_token WHERE user_id = :user_id LIMIT 1";
            //$sth = $database->prepare($sql);
            //$sth->execute(array(':user_remember_me_token' => NULL, ':user_id' => $user_id));
        }

        // delete remember_me cookie in browser
        setcookie('remember_me', false, time() - (3600 * 24 * 3650), Config::get('COOKIE_PATH'),
            Config::get('COOKIE_DOMAIN'), Config::get('COOKIE_SECURE'), Config::get('COOKIE_HTTP'));
    }
    public static function getSession($user_id = null){
        $result = self::_where("session_id", "user_id=$user_id");
        return $result;
    }
	public function create( $a, $b, $c, $d ){
		$data = array( "nombre" => $a, "apellido" => $b, "correo" => $c, "telefono" => $d );
		$result = $this->_insert( $data );
		return $result;
	}
	public function exist( $a ){
		$data = $this->_where("id", "correo='$a'")->get();
		if($data) $data = $data[0]->id;
		return $data;
	}
	public function get_name( $a ){
		$data = $this->_where("nombre, apellido", "id=$a")->get();
		return $data[0]->nombre . ' ' . $data[0]->apellido;
	}
}