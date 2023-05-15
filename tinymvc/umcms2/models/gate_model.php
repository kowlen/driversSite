<?php

class Gate_Model extends TinyMVC_Model
{
    public $func, $db_mysql;
    public function __construct(){
        $this->func= new Func_Model();
        $this->db= new Db_mysql_Model();
    }

    function getPages($getDeleted = false){
        $condition = $getDeleted ? '' : 'AND is_visible is true';

        $sql = "
		    SELECT id, name, title, content, description, keywords, is_visible 
		    FROM pages
		    WHERE TRUE
		    $condition
            ORDER BY id DESC
";
        $result = $this->db->go_result($sql);
        return $result;
    }

    function getCategories($getDeleted = false){
        $condition = $getDeleted ? '' : 'AND vis is true';

        $sql = <<<SQL
		    SELECT id, pid, name, description, vis, logo, url
		    FROM categories
		    WHERE TRUE
		    $condition
SQL;
        $result = $this->db->go_result($sql);
        return $result;
    }

    function getBrands($getDeleted = false){
        $condition = $getDeleted ? '' : 'AND vis is true';

        $sql = <<<SQL
		    SELECT 
		        id, 
                name, 
                (SELECT name FROM categories WHERE id = cat_id) category_name, 
                cat_id, 
                vis
		    FROM brands
		    WHERE TRUE
		    $condition
SQL;
        $result = $this->db->go_result($sql);
        return $result;
    }

    function getProducts($getDeleted = false, $filters = false ,$getExist = false){
        $condition = $getDeleted ? ' ' : ' AND vis is true ';
        $condition .= $getExist ? ' AND count > 0 ' : ' ';
        $condition .= $filters['filter_category'] ? ' AND cat_id = '.(int)$filters['filter_category'] : ' ';
        $condition .= $filters['filter_brand'] ? ' AND brand_id = \''.(int)$filters['filter_brand'].'\'' : ' ';

        $sql = <<<SQL
		    SELECT 
               id, 
               (SELECT name FROM categories WHERE id = cat_id) category_name, 
               cat_id, 
               name, 
               runame, 
               barcode, 
               (SELECT name FROM brands WHERE id = brand_id) brand_name,
               brand_id, 
               price, 
               price_retail, 
               count, 
               sort, 
               vis, 
               (SELECT name FROM tastys WHERE id = taste_id) taste_name, 
               taste_id,
               (SELECT name FROM weight WHERE id = weight_id) weight_name, 
               weight_id, 
               is_tobacco
		    FROM products
		    WHERE TRUE
		    $condition
		    ORDER BY name, runame 
SQL;

        $result = $this->db->go_result($sql);
        return $result;
    }

    function getOrders(){
        $sql = <<<SQL
		    SELECT 
               id, 
               (SELECT name FROM categories WHERE id = cat_id) category_name, 
               cat_id, 
               name, 
               runame, 
               barcode, 
               (SELECT name FROM brands WHERE id = brand_id) brand_name,
               brand_id, 
               price, 
               price_retail, 
               count, 
               sort, 
               vis, 
               (SELECT name FROM tastys WHERE id = taste_id) taste_name, 
               taste_id,
               (SELECT name FROM weight WHERE id = weight_id) weight_name, 
               weight_id, 
               is_tobacco
		    FROM products
		    WHERE TRUE
SQL;

        $result = $this->db->go_result($sql);
        return $result;
    }

    function getTastys(){
        $sql = <<<SQL
		    SELECT  id, name
		    FROM tastys
SQL;
        $result = $this->db->go_result($sql);
        return $result;
    }

    function getWeights(){
        $sql = <<<SQL
		    SELECT  id, name
		    FROM weight
SQL;
        $result = $this->db->go_result($sql);
        return $result;
    }

    function createPage($form){
        $name = $form['name'];
        $title = $form['title'];
        $content = $form['content'];
        $description = $form['description'];
        $keywords = $form['keywords'];
        $is_visible = $form['is_visible'];

        $sql = <<<SQL
            INSERT INTO pages(name, title, content, description, keywords, is_visible)
            VALUES ('$name', '$title', '$content', '$description', '$keywords', '$is_visible') 
SQL;
        $this->db->go_query($sql);
    }

    function createCategory($form){
        $pid = $form['pid'];
        $name = $form['name'];
        $description = $form['description'];
        $vis = $form['vis'];
        $logo = $form['logo'];
        $url = $form['url'];

        $sql = <<<SQL
		    INSERT INTO categories (pid, name, description, vis, logo, url)
		    VALUES ('$pid','$name','$description','$vis','$logo','$url')
SQL;
        $this->db->go_query($sql);
    }

    function createBrand($form){
        $name = $form['name'];
        $cat_id = $form['cat_id'];
        $vis = $form['vis'];

        $sql = <<<SQL
            INSERT INTO brands(name, cat_id, vis)
            VALUES ('$name', $cat_id, '$vis') 
SQL;

        $this->db->go_query($sql);
    }

    function createProduct($form){
        $cat_id = $form['category'];
        $name = $form['name'];
        $runame = $form['runame'];
        $barcode = $form['barcode'];
        $brand_id = $form['brand'];
        $price = $form['price'];
        $price_retail = $form['price_retail'];
        $count = $form['count'];
        $sort = $form['sort'];
        $vis = $form['is_visible'];
        $taste_id = $form['taste_id'];
        $weight_id = $form['weight_id'];
        $is_tobacco = $form['is_tabacco'];

        $sql = <<<SQL
            INSERT INTO products (cat_id, name, runame, barcode, brand_id, price, price_retail, count, sort, vis, taste_id, weight_id, is_tobacco)
            VALUES ($cat_id, '$name', '$runame', $barcode, $brand_id, $price, '$price_retail', $count, '$sort', '$vis', $taste_id, $weight_id, '$is_tobacco') 
SQL;

        $this->db->go_query($sql);
    }

    function createTasty($form){
        $name = $form['name'];

        $sql = <<<SQL
            INSERT INTO tastys (name)
            VALUES ('$name') 
SQL;

        $this->db->go_query($sql);
    }

    function createWeight($form){
        $name = $form['name'];

        $sql = <<<SQL
            INSERT INTO weight (name)
            VALUES ('$name') 
SQL;

        $this->db->go_query($sql);
    }

    function editPage($form){
        $id = $form['id'];
        $name = $form['name'];
        $title = $form['title'];
        $content = $form['content'];
        $description = $form['description'];
        $keywords = $form['keywords'];
        $is_visible = $form['is_visible'];

        $sql = <<<SQL
            UPDATE pages SET
                name = '$name', 
                title = '$title', 
                content = '$content', 
                description = '$description', 
                keywords = '$keywords', 
                is_visible = '$is_visible'
            WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }

    function editCategory($form){
        $id = $form['id'];
        $pid = $form['pid'];
        $name = $form['name'];
        $description = $form['description'];
        $vis = $form['vis'];
        $logo = $form['logo'];
        $url = $form['url'];

        $sql = <<<SQL
            UPDATE categories SET
                pid = '$pid', 
                name = '$name', 
                description = '$description', 
                logo = '$logo', 
                url = '$url', 
                vis = '$vis'
            WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }

    function editBrand($form){
        $id = $form['id'];
        $name = $form['name'];
        $cat_id = $form['cat_id'];
        $vis = $form['vis'];

        $sql = <<<SQL
            UPDATE brands SET
                name = '$name', 
                cat_id = $cat_id, 
                vis = '$vis'
            WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }

    function editProduct($form){
        $id = $form['id'];
        $cat_id = $form['category'];
        $name = $form['name'];
        $runame = $form['runame'];
        $barcode = $form['barcode'];
        $brand_id = $form['brand'];
        $price = $form['price'];
        $price_retail = $form['price_retail'];
        $count = $form['count'];
        $sort = $form['sort'];
        $vis = $form['is_visible'];
        $taste_id = $form['taste_id'];
        $weight_id = $form['weight_id'];
        $is_tobacco = $form['is_tabacco'];

        $sql = <<<SQL
            UPDATE products SET
                cat_id = $cat_id, 
                name = '$name', 
                runame = '$runame', 
                barcode = $barcode, 
                brand_id = $brand_id, 
                price = $price, 
                price_retail = '$price_retail', 
                count = '$count', 
                sort = '$sort', 
                vis = '$vis', 
                taste_id = $taste_id, 
                weight_id = $weight_id, 
                is_tobacco = '$is_tobacco'
            WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }

    function editTasty($form){
        $id = $form['id'];
        $name = $form['name'];

        $sql = <<<SQL
            UPDATE tastys SET
                name = '$name'
            WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }

    function findProduct($barcode){
        $condition = 'AND barcode = '.$barcode;

        $sql = <<<SQL
		    SELECT 
               id, 
               (SELECT name FROM categories WHERE id = cat_id) category_name, 
               cat_id, 
               name, 
               runame, 
               barcode, 
               (SELECT name FROM brands WHERE id = brand_id) brand_name,
               brand_id, 
               price, 
               price_retail, 
               count, 
               sort, 
               vis, 
               (SELECT name FROM tastys WHERE id = taste_id) taste_name, 
               taste_id,
               (SELECT name FROM weight WHERE id = weight_id) weight_name, 
               weight_id, 
               is_tobacco
		    FROM products
		    WHERE TRUE
		    $condition
SQL;
        $result = $this->db->go_result_once($sql);
        return $result;
    }

    function buyProduct($form){
        $id = $form['id'];
        $price = $form['price'];
        $price_retail = $form['price_retail'];
        $coming = $form['coming'];

        $sql = <<<SQL
            UPDATE products t1
            JOIN products t2 ON t2.id = $id
            SET
                t1.price = $price, 
                t1.price_retail = $price_retail, 
                t1.count = t2.count + $coming 
            WHERE t1.id = $id
SQL;

        $this->db->go_query($sql);

        $sql = <<<SQL
            INSERT INTO logs_buys (id, id_prod, date, count, price, inner_id) 
            VALUES (NULL, $id, now(), $coming, $price, 1);
SQL;

        $this->db->go_query($sql);
    }

    function editWeight($form){
        $id = $form['id'];
        $name = $form['name'];

        $sql = <<<SQL
            UPDATE weight SET
                name = '$name' 
            WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }

    function removePage($id){
        $sql = <<<SQL
            DELETE from pages WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }

    function removeCategory($id){
        $sql = <<<SQL
            DELETE from categories WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }

    function removeBrand($id){
        $sql = <<<SQL
            DELETE from brands WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }

    function removeProduct($id){
        $sql = <<<SQL
            DELETE from products WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }

    function removeTasty($id){
        $sql = <<<SQL
            DELETE from tastys WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }

    function removeWeight($id){
        $sql = <<<SQL
            DELETE from weight WHERE id = $id
SQL;
        $this->db->go_query($sql);
    }


}