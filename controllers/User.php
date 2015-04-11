<?php
namespace Controller;
class User extends Base{
	private $session_token;
	private $user;
	public function __construct(){
		parent::__construct();
		$this->user = $this->app->user;
	}
	
	public function edit(){
		$u = $this->app->user;
		$this->app->render('userEdit.html', array('isAuth' =>true, 'user' => $u));
	}
	public function locations(){
		$u = $this->app->user;
		$this->app->render('locations.html', array('isAuth' =>true,'user'=>$u));
	}

	public function saveLoc(){
		$locs = $this->app->request->params();
		print_r($this->app->request->params());
		$locations = new \Model\Locations();
		$locErr = "";
		foreach ($locs as $stop => $times) {
			if(!empty($stop)){
				for ($i=0; $i<count($times) ; $i++) {//add only if user + location does not exist
					$temp = \Model\Locations::whereRaw("user = ? and location = ? and time = ?", [$this->user->email, $stop, $times[$i]])->get();
					if ($temp->count() == 0) {
						$locations = \Model\Locations::create(["user"     => $this->user->email,
														       "location" => $stop,
														       "time"     => $times[$i]]);
					}
					else{
						$locErr .= $stop."-".$times[$i]."\n";
					}
				}
			}
		}
		if($locErr != "")
			$this->app->flash("error", "you have already signed up for the folowing times and locations: $locErr");
		$this->app->redirect($this->app->urlFor('home'));
	}

	public function deleteLocation(){
		echo $id = $this->app->request->params('locationID');
		$l = \Model\Locations::find($id);
		$l->delete();
		$this->app->redirect($this->app->urlFor('home'));
	}


	public function save(){
		$user = $this->app->user;
		if($this->app->request->params('email') != ''){
			$user->email = $this->app->request->params('email');
		}
		if($this->app->request->params('password') != ''){
			$user->password = $this->app->request->params('password');
		}
		if($this->app->request->params('firstname') != ''){
			$user->firstname = $this->app->request->params('firstname');
		}
		if($this->app->request->params('lastname') != ''){
			$user->lastname = $this->app->request->params('lastname');
		}
		if($this->app->request->params('phone') != ''){
			$user->phone = $this->app->request->params('phone');
		}

		$user->save();
		$this->app->redirect($this->app->urlFor('home'));
	}
}

?>