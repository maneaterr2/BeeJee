<?php

namespace BeeJee\models;

use BeeJee\core\Model;

class Model_Main extends Model
{
    public function checkUser() {

        $login = $_POST['login'];
        
		$password = md5($_POST['password']);

		$sql = "SELECT * FROM users WHERE login = :login AND password = :password";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":login", $login, \PDO::PARAM_STR);
		$stmt->bindValue(":password", $password, \PDO::PARAM_STR);
		$stmt->execute();


		$res = $stmt->fetch(\PDO::FETCH_ASSOC);


		if(!empty($res)) {
            $_SESSION['auth'] = true;
            return true;
		} else {
			$_SESSION['auth'] = false;
			return false;
		}

	}
    public function get_list() {
		$current_skip = 1;
		$sort_field = "id";
		$sort_way = "ASC"; //DESC
		$limit = 3;
		if(!empty($_POST['current_skip'])){
			$current_skip = $_POST['current_skip'];
		}if(!empty($_POST['limit'])){
			$limit = $_POST['limit'];
		}
		if(!empty($_POST['sort_field'])){
			$sort_field = $_POST['sort_field'];
		}
		if(!empty($_POST['sort_way'])&&($_POST['sort_way']=='DESC')){
			$sort_way = 'DESC';
		}
        
        $current_skip = ($current_skip * 3) - 3;
		$sql = 'SELECT * FROM list ORDER BY '.$sort_field.' '.$sort_way.' LIMIT '.$limit.' OFFSET '.$current_skip.'';
        $count = $this->db->query('SELECT COUNT(*) as count FROM list')->fetchColumn();

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

        $res['count'] = $count;
        $res['skip'] = $current_skip;
		$res['data'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return json_encode($res, JSON_UNESCAPED_UNICODE);

	}
    public function add_list() {
        $name = $_POST['name'];
        $email = $_POST['email'];
		$text = $_POST['text'];
		$error = false;
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = 'Не корректный email';
		}
		$name = $this->test_input($name); 
		$text = $this->test_input($text); 
        $sql = 'INSERT INTO list (name,email,text) VALUES (:name,:email,:text);';
        
        $stmt = $this->db->prepare($sql);
		$stmt->bindValue(":name", $name, \PDO::PARAM_STR);
		$stmt->bindValue(":email", $email, \PDO::PARAM_STR);
		$stmt->bindValue(":text", $text, \PDO::PARAM_STR);
		if(!$error){
			$stmt->execute();
			echo '{"error":"false"}';
		}else{
			echo '{"error":"email"}';
		}
		
	}

    public function save_task() {
        $id = $_POST['id'];
        $status = $_POST['status'];
		$text = $_POST['text'];
		$text = $this->test_input($text); 

        $sql = 'UPDATE list SET status=:status WHERE id =:id';
		
		$sql_check ="SELECT text FROM list WHERE id=:id";
		$stmt_check = $this->db->prepare($sql_check);
		$stmt_check->bindValue(":id", $id, \PDO::PARAM_STR);
		$stmt_check->execute();
		
		$test_text = $stmt_check->fetch(\PDO::FETCH_ASSOC);
		if($text!=$test_text['text']){
			//изменить запрос, если задачи не совпадают
			$sql = 'UPDATE list SET status=:status,text=:text,modify="1" WHERE id =:id';
		}
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id, \PDO::PARAM_STR);
		$stmt->bindValue(":status", $status, \PDO::PARAM_STR);
		if($text!=$test_text['text']){
			//добавить бинд, если сообщение изменено
			$stmt->bindValue(":text", $text, \PDO::PARAM_STR);
		}
		$stmt->execute();
		echo '{"message":"ok"}';
		
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	  }

}
?>