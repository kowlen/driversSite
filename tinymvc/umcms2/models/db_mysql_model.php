<?php

require_once('/configs/conf.php');

class Db_mysql_Model extends TinyMVC_Model
{
   	var $user;
	var $pass;
	var $db;
	var $server;
	var $code = "";
	var $error = "";
	var $connect = false;

    function __construct(){
        $this->user = my_db_user;
        $this->pass = my_db_pass;
        $this->db = my_db_db;
        $this->server = my_db_serv;
    }

    function getConnect() {
        global $c;
        $this->code = '';
        $this->error = '';
        if (!$c = mysqli_connect($this->server, $this->user, $this->pass, $this->db)) {
            $this->connect = false;
            $this->error = "Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error();
        }else{
            $this->connect = true;
            mysqli_set_charset($c, "utf8");
        }
        return $this->connect;
    }

    function closeConnect() {
        global $c;
        mysqli_close($c);
        $this->connect = false;
    }

	function go_result($sql_in){
        global $c;
        $res = [];
        if (!$this->connect) $this->GetConnect();
        if(!$result = mysqli_query($c, $sql_in)) {
            $this->error = 'MySQL error ['.mysqli_error($c).']';
            $this->closeConnect();
            return false;
        }else{
            $res = [];
            while( $row = mysqli_fetch_assoc($result)){
                $res[] = ($row);
            }
            $this->closeConnect();
            return $res;
        }
	}

    function go_result_once($sql_in){
        global $c;
        if (!$this->connect) $this->GetConnect();
        if(!$result = mysqli_query($c, $sql_in)) {
            $this->error = 'MySQL error ['.mysqli_error($c).']';
            $this->closeConnect();
            return false;
        }else{
            $res = mysqli_fetch_assoc($result);
            $this->closeConnect();
            return $res;
        }
    }

    function go_query($sql_in){
        global $c;
        if (!$this->connect) $this->GetConnect();
        if(!$result = mysqli_query($c, $sql_in)) {
            $this->error = 'MySQL error ['.mysqli_error($c).']';
            $this->closeConnect();
            return false;
        }else{
            $this->closeConnect();
            return true;
        }
    }

}
?>