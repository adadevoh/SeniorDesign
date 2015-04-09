<?php
namespace Model;

class User extends \Model\Base{
	protected $dates = ['deleted_at'];


	protected $fillable=['firstname', 'lastname', 'phone', 'email', 'password'];

	private $locations = array();
	
	protected $table = "users";

	protected $primaryKey = "email";

	/*public function __construct(){
		//parent::__construct();		
	}*/


	public function Authenticate($email, $pass){
		$user = $this->whereRaw("email = ? and password = ?", [$email, $pass])->get();//var_dump($user);
		
		if($user->count() == 1){
			if($user[0]['email'] == $email){//echo $user[0]['email']; die();
				if($user[0]['password'] == $pass){
					$_SESSION['user_id'] = $user[0]['email'];
					return true;
				}
				else
					return false;
			}
		}
		return false;
	}

	public static function isAuthenticated(){

		return (empty($_SESSION['user_id'])) ? false : true;
	}

}
?>