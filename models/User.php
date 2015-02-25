<?php
namespace Model;

class User extends \Model\Base{
	private locations = array();

	public function isAuthenticated(){

		return (empty($_SESSION['user_id'])) ? false : true;
	}

}
?>