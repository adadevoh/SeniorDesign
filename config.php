<?php
//define app constants here
require('vendor/autoload.php');

define('DB_NAME', '');
define('DB_PASS', '');
define('DB_USER', '');
define('DB_HOST', '');
define('DSN', 'mysql:host ='.DB_HOST.';dbname='.DB_NAME);

define('APP_NAME', 'TestApp');
define('APP_LOCALE', 'en_US');


use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => DB_HOST,
    'database'  => DB_NAME,
    'username'  => DB_USER,
    'password'  => DB_PASS,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();


$view = new \Slim\Views\Twig();
$view->parserExtensions = array(new \Slim\Views\TwigExtension());

$app = new \Slim\Slim(array('mode' => 'development',
							'debug' => true,
							'view'=> $view,
							'templates.path'=> 'views'
							));
$app->add(new \Middleware\AuthMiddleware());


?>
