<?php
namespace Model;

abstract class Base extends \Illuminate\Database\Eloquent\Model{
	public static $snakeAttributes = false;
	//use SoftDeletes;

	//use Illuminate\Database\Eloquent\SoftDeletes;

	/*$params = $this->app->request->params();
		$user = $this->app->user->fill($params);
		if(!$user->validate()) {
		   $this->app->flash('error', $user->errors())
		   $this->app->redirect($this->urlFor('UserEdit'));
		}
		$user->save();
		$this->app->redirect($this->app->urlFor('home'));*/


		// make a new validator object
		// $v = Validator::make($data, $this->rules);
		//$v = \Illuminate\Validation\Validator::make($data, $this->rules)

		/*

		private $rules = array(
		   'firstname'  => 'required',
		   'lastname'  => 'required',
		   'email'  => 'required',
		   'password'  => 'required',
		    'phone'  => 'required'
		);

		*/

	protected $rules = array();

	protected function validate($data){
		$v =  \Illuminate\Validation\Validator::make($data, $this->rules);
		return $v->passes();
	}


}

?>