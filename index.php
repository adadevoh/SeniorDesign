<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
//require 'vendor/autoload.php';
require 'config_real.php';
session_start();

 


$app->get('/login',  'Controller\Home:loginForm')->name('loginForm');

$app->post('/home','Controller\Home:login')->name('UserLogin');
$app->post('/signup','Controller\Home:signUp')->name('UserSignup');

$app->get('/', 'Controller\Home:home')->name('home');
$app->get('/home','Controller\Home:home')/*->name('test')*/;
$app->get('/edit', 'Controller\User:edit')->name('editAccount');
$app->post('/save', 'Controller\User:save')->name('userSave');
$app->get('/logout', 'Controller\Home:logout')->name('logout');
$app->get('/locations', 'Controller\User:locations')->name('editLocations');
$app->post('/locations', 'Controller\User:saveLoc')->name('saveLocations');
$app->post('/deleteLocations', 'Controller\User:deleteLocation')->name('deleteLocation');



//$app->post('/home', 'Controller\Home:test')->name('HomeTest');
//$app->get('/home',  'Controller\Home:display')->name('home');
//$app->get('/logout', 'Controller\Home:')

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
