<?php
class User {
    private static $instance = false;
    private static $PDO;
	
    protected function __construct(){
        self::$PDO = new PDODB('users');
    }
    /**
    * Singleton pattern
    */
    public static function get_instance(){
        if( !self::$instance ) self::$instance = new self();
        return self::$instance;
    }

    public static function all(){
        $result = self::$PDO->_all('*');
        return $result->get();    
    }

	public static function getUserDataByEmail($user_email){
        $result = self::$PDO->_where("id, name, email, password, user_active, user_deleted, user_suspension_timestamp, user_last_failed_login, id_role", "email='$user_email'");
        return $result->first();
    }

    public static function incrementFails($user_name){
        $data = array('failed_logins', 'failed_logins+1');
        $result = self::$PDO->_update($data, "name= '$user_name'");
    }

    public static function login_timestamp($user_name){
        $data = array('updated_at'=>'NOW()');
        $result = self::$PDO->_update($data, "name = '$user_name'");
    }

    /**
     * Checks if a username is already taken
     *
     * @param $user_name string username
     *
     * @return bool
     */
    public static function doesUsernameAlreadyExist($user_name){
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT user_id FROM users WHERE user_name = :user_name LIMIT 1");
        $query->execute(array(':user_name' => $user_name));
        if ($query->rowCount() == 0) {
            return false;
        }
        return true;
    }

    /**
     * Checks if a email is already used
     *
     * @param $user_email string email
     *
     * @return bool
     */
    public static function doesEmailAlreadyExist($user_email){
        $result = self::$PDO->_where("id", "email='$user_email'");
        if($result->count() == 0){
            return false;
        }
        return true;
    }

    public static function getUserIdByUsername($user_name){
        return $result = self::$PDO->_where("id", "name='$user_name'")->first()->id;
    }

    public static function save($user_name, $user_password_hash, $user_email, $user_creation_timestamp, $user_activation_hash){
        $data = array('name'=>$user_name, 'email'=>$user_email, 'password'=>$user_password_hash, 'remember_token'=>$user_activation_hash);
        return $result = self::$PDO->_insert($data);
    }

    public static function getSession($user_id = null){
        $result = self::$PDO->_where("session_id", "id=$user_id");
        return $result->first();
    }

    public static function deleteCookie($user_id = null){
        $data = array('remember_token'=>null);
        return $result = self::$PDO->_update($data, "id='$user_id'");
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