<?php

namespace BeeJee\controllers;

use BeeJee\core\Controller;
use BeeJee\models\Model_Cabinet;
use BeeJee\core\View;

class Controller_Cabinet extends Controller
{
    function __construct()
	{
		$this->model = new Model_Cabinet();
		$this->view = new View();
	}
	function action_index()
	{	
       if($_SESSION['auth']){
           $this->view->generate('cabinet_view.php', 'cabinet_view.php');
       }else{
        header("Location:/");
       }
		
    }
   
}
?>