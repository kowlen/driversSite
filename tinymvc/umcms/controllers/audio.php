<?php
require_once('/configs/conf.php');
require_once('/configs/autoload.php');
class Audio_Controller extends TinyMVC_Controller
{
    public $controller = 'audio';
    public $controllerName = 'Аудио';
    function index(){
        $this->load->model('Db_MySQL_Model','db');
        $this->load->model('Access_Model','access');
        $menu = $this->access->get_menu();

        $title = 'Главная';
        $htpath = array('Главная'=>'/', $this->controllerName=>'/'.$this->controller, $title=>'/'.$this->controller.'/'.__FUNCTION__);

        $this->smarty->assign("title", $title);
        $this->smarty->assign("htpath", $htpath);
        $this->smarty->assign("main_content_template", "templates/getup/".template.'/'.$this->controller."/main.html");
        $this->smarty->display('/templates/getup/'.template.'/index.html');
    }


    function audiotales(){
        $this->load->model('Db_MySQL_Model','db');
        $this->load->model('Access_Model','access');
        $menu = $this->access->get_menu();
        
        //print_r($menu);
        $title = 'Аудиосказки';
        $htpath = array('Главная'=>'/', $this->controllerName=>'/'.$this->controller, $title=>'/'.$this->controller.'/'.__FUNCTION__);
        $this->smarty->assign("title", $title);
        $this->smarty->assign("htpath", $htpath);
        $this->smarty->assign("menu", $menu);
        $this->smarty->assign("main_content_template", "templates/getup/".template.'/'.$this->controller."/audiotales.html");
        $this->smarty->display('/templates/getup/'.template.'/index.html');
    }

}
?>