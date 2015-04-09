<?php
namespace Model;

class Locations extends \Model\Base{
	protected $dates = ['deleted_at'];


	protected $fillable=['user', 'location', 'time'];
	
	protected $table = "locations";

	protected $primaryKey = "id";

	/*public function __construct(){
		//parent::__construct();		
	}*/


}
?>