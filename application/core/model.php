<?php

namespace BeeJee\core;


use BeeJee\config\DB_Connect as DB;
class Model
{
    protected $db = null;

	public function __construct() {
		$this->db = DB::connToDB();
    }
    
	public function get_data()
	{
	}
}
?>