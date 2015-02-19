<?php
require 'vendor/autoload.php';
?>



<?php
$app = new \Slim\Slim(array('mode' => 'development',
							'debug' => true,
							'view'=> new \Slim\Views\Twig(),
							'templates.path'=> 'views'
							));

$app->get('/', 'Controller\Home:display');
$app->post('/home', 'Controller\Home:test')->name('mine');

$app->post('/',function(){
	$app = \Slim\Slim::getInstance();
	echo"called post<br>";
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