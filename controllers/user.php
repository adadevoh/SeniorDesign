<?php
namespace Controller;
class User extends Base{
	private $session_token;
	public function __construct(){

	}

	public function Home(){
		//render home view
	}
	
	protected function authenticate(){
		//authentiate user against user in db
	}
	public function edit(){
		echo"user edit called";
	}
}

?>