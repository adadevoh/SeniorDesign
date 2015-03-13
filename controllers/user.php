<?php
namespace Controller;
class User extends Base{
	private $session_token;
	public function __construct(){
		parent::__construct();
	}

	public function Home(){
		//render home view
	}
	
	protected function authenticate(){
		//authentiate user against user in db
	}
	public function edit(){
		echo"user edit called";
		$u = $this->app->user;
		$this->app->render('userEdit.html', array('isAuth' =>true, 'user' => $u));
	}
	public function save(){
		$user = $this->app->user;
		if($this->app->request->params('email') != ''){
			"email: ".$user->email = $this->app->request->params('email');
		}
		if($this->app->request->params('password') != ''){
			"password: ".$user->password = $this->app->request->params('password');
		}
		if($this->app->request->params('firstname') != ''){
			"firstname: ".$user->firstname = $this->app->request->params('firstname');
		}
		if($this->app->request->params('lastname') != ''){
			"lastname: ".$user->lastname = $this->app->request->params('lastname');
		}
		if($this->app->request->params('phone') != ''){
			"phone: ".$user->phone = $this->app->request->params('phone');
		}

		$user->save();
		$this->app->redirect($this->app->urlFor('home'));
	}
}

?>