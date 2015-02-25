<?php
require 'vendor/autoload.php';
require 'config.php';
?>



<?php
// Set the view parser extensions.
$view = new \Slim\Views\Twig();
$view->parserExtensions = array(new \Slim\Views\TwigExtension());

$app = new \Slim\Slim(array('mode' => 'development',
							'debug' => true,
							'view'=> $view,
							'templates.path'=> 'views'
							));
//$app->add(new \Middleware\AuthMiddleware());

//dev branch test
$app->get('/', 'Controller\Home:display');
$app->post('/home','Controller\Home:login')->name('UserLogin');
//$app->get('/home',  'Controller\Home:loginForm')->name('UserLoginForm');
$app->post('/signup','Controller\Home:signUp')->name('UserSignup');
$app->get('/edit', 'Controller\User:edit')->name('editAccount');
//$app->post('/home', 'Controller\Home:test')->name('HomeTest');

$app->post('/',function(){
	$app = \Slim\Slim::getInstance();
	echo"called post from anonymous function<br>";
	echo $app->request->params('password');
});

function slimTest(){
	echo "<br><br><br>tets page. App initialized :)";
}
function postTest(){
	echo"called post<br>";
	echo $app->request->params('phone');
}
$app->run();
?>