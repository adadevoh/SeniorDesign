<?php
namespace Model;

class User extends \Model\Base{
	private $locations = array();
	//private
	private $table = "users";

	public function __construct(){
		//parent::__construct();		
	}

	public function Authenticate($email, $pass){
		$data = array("Email", "Password");
		$clause = "where Email = $email and Password = $pass";
		//echo"authenticate called true";
		return true;

		/*$cred = $this->find($data, $clause);

		if($cred == false)
			return false;
		return $cred[0];*/
	}

	public function isAuthenticated(){

		return (empty($_SESSION['user_id'])) ? false : true;
	}

}
?>