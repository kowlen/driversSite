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

    function get_menu_sub($catId){
        //die("select * from category where enable = 1 and pid in (select id from category where url = $catId) order by pos");
        $menu = $this->db->go_result("select * from category where enable = 1 and (pid in (select id from category where url = '$catId') or id in (select id from category where url = '$catId') or pid in (select pid from category where url = '$catId') or id in (select pid from category where url = '$catId'))  order by pos, pid");
        $cats = $this->getTree($menu);
        return $cats;
    }

    function getTree($dataset) {
        $tree = array();
        foreach ($dataset as $id => &$node) {
            //Если нет вложений
            $tree[$node['id']] = &$node;
            /*if (!$node['pid']){
                $tree[$node['id']] = &$node;
            }else{
                //Если есть потомки то перебираем массив
                $tree[$node['pid']]['childs'][$node['id']] = &$node;
            }*/
        }
        return $tree;
    }

}
?>