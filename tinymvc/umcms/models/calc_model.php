<?php

class Calc_Model extends TinyMVC_Model
{
    public $func, $db_mysql;
    public function __construct(){
        $this->db= new Db_mysql_Model();
    }

    function areaOfRectangle($xa, $xb){
        return $xa*$xb;
    }

}