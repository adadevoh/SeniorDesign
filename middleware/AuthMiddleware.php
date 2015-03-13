<?php

namespace Middleware;

class AuthMiddleware extends \Slim\Middleware {
	public function call() {
		$app = $this->app;
		$requireAuth = function() use($app) {
			// Get current route.
           	$route = $app->router->getCurrentRoute();
           	// Redirect to login screen.
           	if(!in_array($route->getName(), array('loginForm', 'UserLogin', 'UserSignUp') )) {//array of routes exempted
           		//userLogin and userSignUp
           		//echo $route->getName();die();
           		//echo"middle";
				if(empty($_SESSION['user_id'])) {
					$app->redirect($app->urlFor('loginForm'));
				}
				/*if($_SESSION['user_id']){
					$app->redirect($app->urlFor('home'));
				}*/
				$app->user = \Model\User::findOrNew($_SESSION['user_id']);// var_dump($app->user); die();
				//echo"firstname: ".$app->user->firstname;
           	}//$app->user = \Model\User::findOrNew($_SESSION['user_id']);// var_dump($app->user); die();
		};
        $app->hook('slim.before.dispatch', $requireAuth);
		$this->next->call();//echo "Middleware1"; die();
	}
}

?>

