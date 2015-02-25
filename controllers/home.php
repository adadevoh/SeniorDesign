<?php

namespace Controller;

class Home extends Base{

	public function login(){
		//sign a returning user in
		//authenticate post data against user model, if exists render user console
		//if not  flash "invlaid user"
		$email = $this->app->request->params('email');
		$pass = $this->app->request->params('password');

		
		$user = new \Model\User();
		if(!$user->Authenticate($email, $pass)){
			$this->app->flashNow("error", "invalid username/password");
			$this->app->render('login.html');
		}
		else{
			$this->app->render('user.html');
		}
	}
	public function loginForm(){
		//sign a returning user in
		//authenticate post data against user model, if exists render user console
		//if not  flash "invlaid user"
		$this->app->render('login.html');
	}
	public function signUp(){
		//echo"home-sign up() called";
		//starting point for creating new user
		//create new User model, and then use the post data to create and save a new user
		// then grab that user info and display it on the user console
		$msg = "Thank you for Signing Up.";

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,100);

		// send email
		$Email = "tsc.joshua@gmail.com";
		//mail($Email,"TramSys",$msg);
		//echo "mail sent";
		$this->app->render('user.html', array("msg" => $msg));


	}

	public function display(){
		//render home/ landing page
		//if not session active, render login.html
		$this->app->render('Login.html');
		//else render user console.html
	}

	public function test(){
		echo"<br>called test function from home<br>";
	}
}


?>