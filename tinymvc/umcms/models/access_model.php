<?php
class Access_Model extends TinyMVC_Model
{
    public function __construct()
    {
        $this->db = new Db_MySQL_Model();
    }
    function get_menu($user=1){
        $menu = $this->db->go_result('select * from category where enable = 1 and pid = 0 order by pos');
        $cats = $this->getTree($menu);

        return $cats;
    }

    function getTree($dataset) {
        $tree = array();
        foreach ($dataset as $id => &$node) {
            //Если нет вложений
            if (!$node['pid']){
                $tree[$node['id']] = &$node;
            }else{
                //Если есть потомки то перебераем массив
                $tree[$node['pid']]['childs'][$node['id']] = &$node;
            }
        }
        return $tree;
    }

}
?>