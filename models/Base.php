<?php

namespace Model
class Base{
	public function __construct(){
		//initialize class
	}
}

//your child class class should look like this
/*
class child_Class extendss \Model\Base{
	//private data_member

	public function __construct(){
		parent::__construct();//calls parent contructor
	}

	public function your_function(){
		
	}
}
*/



?>