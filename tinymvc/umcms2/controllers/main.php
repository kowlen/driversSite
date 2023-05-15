<?php
require_once('/configs/conf.php');
class Main_Controller extends TinyMVC_Controller
{
    function index(){
        $this->load->model('Db_MySQL_Model','db');

        $title = 'umcms';

        $this->smarty->assign("title", $title);
        $this->smarty->assign("main_content_template", "getup/getup/default/main.html");
        $this->smarty->display('getup/getup/default/index.html');
    }

}
?>