<?php
require_once('/configs/conf.php');
require_once('/configs/autoload.php');
class Main_Controller extends TinyMVC_Controller
{
    public $controller = 'main';
    function index(){
        $this->load->model('Db_MySQL_Model','db');
        $this->load->model('Access_Model','access');
        $this->load->model('Data_Model','data');
        $menu = $this->access->get_menu();

        $title = 'Главная';

        $data_path = $this->data->get_menu_path();
        //print_r($data_path);die();
        $this->smarty->assign("htpath", $data_path);

        $this->smarty->assign("menu", $menu);
        $this->smarty->assign("title", $title);
        $this->smarty->assign("main_content_template", "templates/getup/".template."/main.html");
        $this->smarty->display('/templates/getup/'.template.'/index.html');
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


}
?>