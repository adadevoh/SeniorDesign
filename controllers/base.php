<?php
namespace Controller;
class Base{
	protected $app;
	public function __construct(){
		$this->app = \Slim\Slim::getInstance();
	}

}

?>