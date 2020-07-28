<?php

namespace BeeJee\controllers;
use BeeJee\core\Controller;
use BeeJee\models\Model_Main;
use BeeJee\core\View;

class Controller_Main extends Controller
{
    function __construct()
	{
		$this->model = new Model_Main();
		$this->view = new View();
	}
	function action_index()
	{	
        $data['data'] = $this->model->get_data();
		$this->view->generate('main_view.php', 'index_view.php', $data);
    }
    public function action_login() 
    {
		if(!$this->model->checkUser()) {
			echo "Неправильный логин или пароль";
        }else{
            echo "good";
        }
        
	}
    public function action_logout() 
    {
		$_SESSION['auth'] = false;
	}
    public function action_get_list() 
    {
        $data = $this->model->get_list();
        echo $data;
	}
    public function action_add_list() 
    {
        $data = $this->model->add_list();
        
	}
    public function action_save_task() 
    {
        if($_SESSION['auth']){
            $this->model->save_task();
        }else{
            echo '{"message":"main_page"}';
        }
        
        
	}
}
?>