<?php
require_once('/configs/conf.php');
require_once('/configs/autoload.php');
class Main_Controller extends TinyMVC_Controller
{
    public $controller = 'main';
    function index(){
        $this->smarty->display('/templates/main/index.main.html');
    }

    function dummy(){
        $this->load->model('Db_MySQL_Model','db');
        $this->load->model('Access_Model','access');
        $menu = $this->access->get_menu();

        $title = 'Главная';
        $htpath = array('Главная'=>'/',);

        $this->smarty->assign("title", $title);
        $this->smarty->assign("htpath", $htpath);
        $this->smarty->assign("main_content_template", "templates/getup/".template."/dummy.html");
        $this->smarty->display('/templates/getup/'.template.'/index.html');
    }

    function mainpage(){
        $this->smarty->display('/templates/mian/index.main.html');
    }


}
?>
