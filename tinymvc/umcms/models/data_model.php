<?php
class Data_Model extends TinyMVC_Model
{
    public function __construct()
    {
        $this->db = new Db_MySQL_Model();
        $this->utl = new Utilites_Model();
    }

    function get_category_info($catId){
        return $this->db->go_result_once("select * from category where enable = 1 and url = '".$catId."'");
    }

    function get_categoryId_info($catId){
        return $this->db->go_result_once("select * from category where enable = 1 and id = '".$catId."'");
    }

    function get_category_posts($catId){
        $cats_id = $this->get_sub($catId);
        $data = $this->db->go_result("select 
        (select concat('<a href=','/category/?c=', url,'>', name, '</a>') from `category` where id = (select pid from `category` where id = t.cat_id)) as `pid_name`,
        (select concat('<a href=','/category/?c=', url,'>', name, '</a>') from `category` where id = t.cat_id) as `cat_name`,
        views, rate, id, haterate, dat, autor, CONCAT(LEFT(`text`, 100000), '...') text_short, CONCAT(LEFT(`text`, 15000), '...') text_short2, name from posts t where `show` = 1 and `del` = 0 and cat_id in (".$cats_id.")");

        foreach ($data as $key => $value) {
            $data[$key]['text_short'] = $this->utl->truncate($data[$key]['text_short'], 600);
            $data[$key]['text_short2'] = ($data[$key]['text_short2']);
        }

        return $data;
    }

    function get_post_find($find){
        $find = $find;
        return $this->db->go_result("select 
        (select concat('<a href=','/category/?c=', url,'>', name, '</a>') from `category` where id = (select pid from `category` where id = t.cat_id)) as `pid_name`,
        (select concat('<a href=','/category/?c=', url,'>', name, '</a>') from `category` where id = t.cat_id) as `cat_name`,
        views, rate, id, haterate, dat, autor, CONCAT(LEFT(`text`, 600), '...') text_short, CONCAT(LEFT(`text`, 150), '...') text_short2, name from posts t where `show` = 1 and `del` = 0 and 
        (lower(name) like lower('%".$find."%') or lower(text) like lower('%".$find."%')) ");
    }

    function get_menu_path($id=0){
        $menu_path = $this->db->go_result_once("select id, pid, name, url from category where enable = 1 and id = $id");
        if ($menu_path) {
            $menu_path_temp[] = array("name"=>$menu_path['name'], "url"=>'/category/?c='.$menu_path['url']);
        }
        if ($menu_path['pid'] != 0) {
            $pid = $menu_path['pid'];
            $menu_path = $this->db->go_result_once("select id, pid, name, url from category where enable = 1 and id = $pid");;
            $menu_path_temp[] = array("name"=>$menu_path['name'], "url"=>'/category/?c='.$menu_path['url']);
        }
        $menu_path_temp[] = array("name"=>"Главная", "url"=>"/");
        return array_reverse($menu_path_temp);
    }

    function get_post($postId){
        return $this->db->go_result_once("select * from posts where `show` = 1 and `del` = 0 and id = '".$postId."'");
    }

    function get_page($id){
        $id_pieces = explode('_', $id);
        $url = $id_pieces[0];
        $id = $id_pieces[1];
        return $this->db->go_result_once("select * from pages where `show` = 1 and `del` = 0 and id = '".$id."' and url = '".$url."'");
    }

    function get_sub($cid)
    {
        //get sub
        $sql = <<<SQL
            select
                `id`
            from `category`
            where enable = 1
            and  `pid` = $cid
SQL;
        $res = $this->db->go_result($sql);
        if ($res) {
            foreach ($res as $v) {
                $cid .= "," . $v['id'];
            }
        }
        return $cid;
    }


}
?>