<?php
namespace Model;

class User extends \Model\Base{
	protected $dates = ['deleted_at'];


	protected $fillable=['FirstName', 'LastName', 'phone', 'email', 'password'];

	private $locations = array();
	
	protected $table = "users";

	protected $primaryKey = "Email";

	/*public function __construct(){
		//parent::__construct();		
	}*/

	public function Authenticate($email, $pass){
		$user = $this->whereRaw("email = ? and password = ?", [$email, $pass])->get();
		if($user->count() == 1){
			if($user[0]['Email'] == $email){
				return ($user[0]['Password'] == $pass) ? true : false ;
			}
		}
		
		return false;
	}

	/*public function find(){
		return $this->whereRaw('email = ? and password = ?');
	}*/

	public function isAuthenticated(){

		return (empty($_SESSION['user_id'])) ? false : true;
	}

}
?>