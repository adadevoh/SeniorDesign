<?php

namespace Middleware;

class AuthMiddleware extends \Slim\Middleware {
	public function call() {
		$app = $this->app;
		$requireAuth = function() use($app) {
			if(empty($_SESSION['user_id'])) {
				$app->redirect($app->urlFor('UserLoginForm'));
			}
		};
        $this->app->hook('slim.before.dispatch', $requireAuth);
		$this->next->call();
	}
}

?>