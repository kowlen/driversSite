<?php
require_once('/configs/conf.php');
require_once('/configs/autoload.php');
class Pages_Controller extends TinyMVC_Controller
{
    public $controller = 'pages';
    public $controllerName = 'Страницы';

    function index(){
        $this->load->model('Db_MySQL_Model','db');
        $this->load->model('Access_Model','access');
        $this->load->model('Data_Model','data');
        $menu = $this->access->get_menu();

        $id = (isset($_GET['p']) && !empty($_GET['p'])) ? $_GET['p'] : die('no data');
        $data = $this->data->get_page($id);
        //$data_desc = $this->data->get_categoryId_info($data['cat_id']);

        $title = $data['name'];

        $this->smarty->assign("title", $title);
        //$this->smarty->assign("data_desc", $data_desc);
        //$data_path = $this->data->get_menu_path($data_desc['id']);
        $data_path[] = array('name'=>$data['name'], 'url'=>'');
        $this->smarty->assign("htpath", $data_path);
        $this->smarty->assign("menu", $menu);
        $this->smarty->assign("data", $data);
        $this->smarty->assign("main_content_template", "templates/getup/".template.'/'.$this->controller."/pages.html");
        $this->smarty->display('/templates/getup/'.template.'/index.html');
    }
}
?>