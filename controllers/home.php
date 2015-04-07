<?php

namespace Controller;

class Home extends Base{
	private $email;

	public function __construct(){
		parent::__construct();
		$this->email = $this->app->request->params('email');
	}

	public function login(){
		
		$email = $this->app->request->params('email');
		$pass = $this->app->request->params('password');//die();

		
		$user = new \Model\User();
		if(!$user->Authenticate($email, $pass)){
			$this->app->flash('loginerr', "invalid username/password");
			$this->app->redirect($this->app->urlFor('loginForm'));
		}
		else{
			$u = \Model\User::find($email);
			$l = \Model\Locations::where('user', '=', $u->email)->get();
			$this->app->render('user.html', array("isAuth" =>true, 'user' => $u, 'locations' =>$l));
		}
	}

	public function loginForm(){
		if(isset($_SESSION['user_id'])){
			$this->app->redirect($this->app->urlFor('home'));
		}
		else
			$this->app->render('login.html');
	}
	
	public function signUp(){
		$user = new \Model\User();
		
		$reDir = $this->validate();


		if($reDir['reDir']){
			$this->app->flash('signUpErr', sprintf($reDir['err']));
			$this->app->redirect($this->app->urlFor('loginForm'));
		}
		

		$r = $user->where('email', '=', $this->app->request->params('email'));

		if($r->count() == 0){
			$u = \Model\User::create(["firstname" => $this->app->request->params('firstname'),
							    "lastname" => $this->app->request->params('lastname'),
							    "password" => $this->app->request->params('password'),
							    "email" => $this->app->request->params('email'),
							    "phone" => $this->app->request->params('phone')]);

			//
			$u = \Model\User::find($this->app->request->params('email'));
			echo"email: ". $u->email;//die();

			$_SESSION['user_id'] = $u->email;

			$this->app->render('user.html', array("user" =>$u));
			//$this->sendMail();
		}
		else{
			$this->app->flash('signUpErr', "sorry that user already exists, try a different email");
			$this->app->redirect($this->app->urlFor('loginForm'));			
		}
	}

	public function home(){
		if(isset($_SESSION['user_id'])){
			$u = $this->app->user;
			$l = \Model\Locations::where('user', '=', $u->email)->get();
			$this->app->render('user.html', array('isAuth' =>true, 'user' => $u, 'locations' =>$l));
		}
		else
			$this->app->redirect($this->app->urlFor('loginForm'));
	}

	public function logout(){
		session_destroy();
		$this->app->render('logout.html');
	}

	public function test(){
		echo"<br>called test function from home<br>";
	}

	/* ---------- utility functions ------------------ */

	private function sendMail(){
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