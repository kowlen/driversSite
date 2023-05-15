<?php
class Admin_Model extends TinyMVC_Model
{
    public $func, $db_mysql;
    public function __construct()
    {
        $this->func= new Func_Model();
        $this->db_mysql= new db_mysql_Model();
    }

    function index($id, $date){
		return "U login as <b>".$_SESSION['admin']."</b>";
    }

    function get_access(){
        if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])){
            header("Location: /admin/auth/");
        }
    }

    function logout(){
        unset($_SESSION['admin']);
    }

    function get_login($data){
        $username = $data['login'];
        $pwd = $data['pwd'];
        $sql = "
		    select * from users where username = '$username' and pwd = '$pwd'
";
        if (!$ds = $this->db_mysql->go_result_once($sql)) {echo($this->db_mysql->error);}
        if ($ds){
            return $ds;
        }else{
            return false;
        }
    }

    function get_user_data($user, $do){
        $par = array("username"=>$user);
        $dodeny = array("USER_ID", "KEYHASH");
        if (in_array($do, $dodeny)) {
            $sql = <<<SQL
		    select $do from stat.WEB_API_USERS where username = :username
SQL;
            if ($ds = $this->db_mysql->go_result_once2($sql, $par)) {echo($this->db_mysql->error);}
            $this->db_mysql->CloseConnect();
            if ($ds[$do])
                return $ds[$do];
            else
                return "error";
        }else{
            return "deny";
        }
    }

    function get_api_logs($keyhash, $do){
        $par = array("keyhash"=>$keyhash, "do"=>$do);
        $sql = <<<SQL
		    select to_char(dat, 'DD.MM.YYYY MI:SS:HH') dat, url, ip from stat.WEB_API_LOGS where keyhash = :keyhash and par = :do
		    and rownum <= 50
		    order by dat desc
SQL;
        if ($ds = $this->db_mysql->go_result2($sql, $par)) {echo($this->db_mysql->error);}
        $this->db_mysql->CloseConnect();
        return $ds;
    }
}
?>