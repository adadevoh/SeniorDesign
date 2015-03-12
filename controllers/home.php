<?php

namespace Controller;

class Home extends Base{

	//private $email = \Slim\Slim::getInstance()->request->params('email');
	private $email;

	public function __construct(){
		parent::__construct();
		$this->email = $this->app->request->params('email');
	}

	public function login(){
		
		$email = $this->app->request->params('email');
		$pass = $this->app->request->params('password');

		
		$user = new \Model\User();
		if(!$user->Authenticate($email, $pass)){
			echo"login";
			$this->app->flash('loginerr', "invalid username/password");
			$this->app->redirect($this->app->urlFor('UserLoginForm'));
		}
		else{
			$u = \Model\User::find($email);
			$this->app->render('user.html', array("isAuth" =>true, 'user' => $u));
		}
	}

	public function loginForm(){
		$this->app->render('login.html');
	}
	
	public function signUp(){
		$user = new \Model\User();
		

		$reDir = $this->validate();


		if($reDir['reDir']){
			$this->app->flash('signUpErr', sprintf($reDir['err']));
			$this->app->redirect($this->app->urlFor('UserLoginForm'));
		}
		

		$r = $user->where('email', '=', $this->app->request->params('email'));

		if($r->count() == 0){
			$u = \Model\User::create(["firstname" => $this->app->request->params('firstname'),
							    "lastname" => $this->app->request->params('lastname'),
							    "password" => $this->app->request->params('password'),
							    "email" => $this->app->request->params('email'),
							    "phone" => $this->app->request->params('phone')]);

			$this->app->render('user.html', array("user" =>$u));
			//$this->sendMail();
		}
		else{
			$this->app->flash('signUpErr', "sorry that user already exists, try a different email");
			$this->app->redirect($this->app->urlFor('UserLoginForm'));			
		}
	}

	public function display(){
		$isAuth = \Model\User::isAuthenticated();
		echo "email: " .$u = \Model\User::find($this->app->request->params('email'));
		if($isAuth){
			$this->app->render('user.html', array('isAuth' =>$isAuth, 'user' => $u));
		}
		else
			$this->app->redirect($this->app->urlFor('UserLoginForm'));
	}

	public function logout(){
		session_destroy();
		$this->app->redirect($this->app->urlFor('UserLoginForm'));
	}

	public function test(){
		echo"<br>called test function from home<br>";
	}

	/* ---------- utility functions ------------------ */

	private function sendMail(){
		//Send user confirmation email after account creation
		// use wordwrap() if lines are longer than 70 characters
		$msg = "Thank you for Signing Up.";
		$msg = wordwrap($msg,100);

		// send email
		$email = "tsc.joshua@gmail.com";
		mail($email,"TramSys",$msg);
	}


	//validate user input
	private function validate(){
		$err = "";
		$reDir = false;
		$res = array('err' => $err,
					 'reDir' => $reDir);
		if(empty($this->app->request->params('firstname'))){
			$err = $err. "\n Please enter a valid firstname";
			$reDir = true;
		}
		if(empty($this->app->request->params('lastname'))){
			$err .="\n Please enter a valid lastname";
			$reDir = true;				
		}
		if(empty($this->app->request->params('email'))){
			$err .="\n Please enter a valid email";
			$reDir = true;
		}
		if(empty($this->app->request->params('password'))){
			$err .="\n Please enter a valid password";
			$reDir = true;
		}
		if(empty($this->app->request->params('phone'))){
			$err .="\n\n Please enter a valid phone number";
			$reDir = true;
		}
		$res = array('err' => $err,
					 'reDir' => $reDir);
		return $res;

	}
}


?>