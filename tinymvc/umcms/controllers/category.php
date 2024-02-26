<?php
require_once('/configs/conf.php');
require_once('/configs/autoload.php');
class Category_Controller extends TinyMVC_Controller
{
    public $controller = 'category';
    public $controllerName = 'Раздел';

    function index(){
        $this->load->model('Db_MySQL_Model','db');
        $this->load->model('Access_Model','access');
        $this->load->model('Data_Model','data');
        $cat_id = (isset($_GET['c']) && !empty($_GET['c'])) ? $_GET['c'] : 'tales';
        $currentPage = (isset($_GET['page']) && !empty($_GET['page']))  ? (int)$_GET['page'] : 1;
        $menu = $this->access->get_menu();
        $menuSub = $this->access->get_menu_sub($cat_id);
        $data_desc = $this->data->get_category_info($cat_id);
        //pagination
        $total = $this->data->pagi_get_total_post($cat_id);
        $totalPages = ceil($total / postPerPage);
        $postTo = ($currentPage - 1) * postPerPage;
        //pagiVis
        $startPage = max(1, $currentPage - floor(maxVisPages / 2));
        $endPage = min($startPage + maxVisPages - 1, $totalPages);
        //$firstRecordIndex = ($currentPage - 1) * postPerPage;

        $data = $this->data->get_category_posts($data_desc['id'], $postTo);

        $title = $data_desc['name'];
        $this->smarty->assign("title", $title);
        $this->smarty->assign("data_desc", $data_desc);
        //$this->smarty->assign("htpath", $htpath);
        $data_path = $this->data->get_menu_path($data_desc['id']);
        $this->smarty->assign("htpath", $data_path);
        $this->smarty->assign("menu", $menu);
        $this->smarty->assign("menuSub", $menuSub);
        $this->smarty->assign("data", $data);
        $this->smarty->assign("totalPages", $totalPages);
        $this->smarty->assign("currentPage", $currentPage);
        $this->smarty->assign("startPage", $startPage);
        $this->smarty->assign("endPage", $endPage);
        $this->smarty->assign("main_content_template", "templates/getup/".template.'/'.$this->controller."/main.html");
        $this->smarty->display('/templates/getup/'.template.'/index.html');
    }

    function view_post(){
        $this->load->model('Db_MySQL_Model','db');
        $this->load->model('Access_Model','access');
        $this->load->model('Data_Model','data');
        $menu = $this->access->get_menu();
        $id = (isset($_GET['p']) && !empty($_GET['p'])) ? (int)$_GET['p'] : die('no data');

        $data = $this->data->get_post($id);
        $data_desc = $this->data->get_categoryId_info($data['cat_id']);

        $title = $data['name'];

        $this->smarty->assign("title", $title);
        $this->smarty->assign("data_desc", $data_desc);
        $data_path = $this->data->get_menu_path($data_desc['id']);
        $data_path[] = array('name'=>$data['name'], 'url'=>'');
        $this->smarty->assign("htpath", $data_path);
        $this->smarty->assign("menu", $menu);
        $this->smarty->assign("data", $data);
        $this->smarty->assign("main_content_template", "templates/getup/".template.'/'.$this->controller."/post.html");
        $this->smarty->display('/templates/getup/'.template.'/index.html');
    }

    function tag(){
        $this->load->model('Db_MySQL_Model','db');
        $this->load->model('Access_Model','access');
        $this->load->model('Data_Model','data');
        $tag = (isset($_GET['c']) && !empty($_GET['c'])) ? $_GET['c'] : '';
        $currentPage = (isset($_GET['page']) && !empty($_GET['page']))  ? (int)$_GET['page'] : 1;
        $menu = $this->access->get_menu();
        $menuSub = $this->access->get_menu_sub('main');
        $data_desc['name'] = 'Поиск по тегу <b>'.$tag.'</b>';
        $data_desc['text'] = 'Поиск по тегу <b>'.$tag.'</b>';
        //pagination
        $total = $this->data->pagi_get_total_tags($tag);
        $totalPages = ceil($total / postPerPage);
        $postTo = ($currentPage - 1) * postPerPage;
        //pagiVis
        $startPage = max(1, $currentPage - floor(maxVisPages / 2));
        $endPage = min($startPage + maxVisPages - 1, $totalPages);
        //$firstRecordIndex = ($currentPage - 1) * postPerPage;

        $data = $this->data->get_category_tags($tag, $postTo);

        $title = $data_desc['name'];
        $this->smarty->assign("title", $title);
        $this->smarty->assign("data_desc", $data_desc);
        //$this->smarty->assign("htpath", $htpath);
        $data_path = $this->data->get_menu_path();
        $this->smarty->assign("htpath", $data_path);
        $this->smarty->assign("menu", $menu);
        $this->smarty->assign("menuSub", $menuSub);
        $this->smarty->assign("data", $data);
        $this->smarty->assign("totalPages", $totalPages);
        $this->smarty->assign("currentPage", $currentPage);
        $this->smarty->assign("startPage", $startPage);
        $this->smarty->assign("endPage", $endPage);
        $this->smarty->assign("main_content_template", "templates/getup/".template.'/'.$this->controller."/main.html");
        $this->smarty->display('/templates/getup/'.template.'/index.html');
    }

    function find(){
        $this->load->model('Db_MySQL_Model','db');
        $this->load->model('Access_Model','access');
        $this->load->model('Data_Model','data');
        $menu = $this->access->get_menu();

        if (isset($_POST['find']) && !empty($_POST['find'])) {
            $find = $_POST['find'];
            $data = $this->data->get_post_find($find);
            $data_desc = array('text'=>'Результаты поиска по запросу: <h2>'.$find.'</h2>');//$this->data->get_categoryId_info($data['cat_id']);
        }else{
            $data = array();
            $data_desc = array('text'=>'Укажите фразу для поиска...');
        }

        $title = 'Поиск по сайту';

        $this->smarty->assign("title", $title);
        $this->smarty->assign("data_desc", $data_desc);
        $data_path = $this->data->get_menu_path();
        $data_path[] = array('name'=>$title, 'url'=>'');
        $this->smarty->assign("htpath", $data_path);
        $this->smarty->assign("menu", $menu);
        $this->smarty->assign("data", $data);
        $this->smarty->assign("main_content_template", "templates/getup/".template.'/'.$this->controller."/main.html");
        $this->smarty->display('/templates/getup/'.template.'/index.html');
    }

}
?>