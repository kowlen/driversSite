<?php

class Admin_Controller extends TinyMVC_Controller
{
    public $gate,$admin,$pages;

    function index(){
        $this->admin = new Admin_Model();
		$this->admin->get_access();
        header("Location: /admin/pages");
    }

    function auth(){
        //Авторизация в админке
        $this->admin = new Admin_Model();
        $this->func = new Func_Model();
        $this->func_valid = new Func_valid_Model();

        if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['pwd']) && !empty($_POST['pwd']) && $this->func_valid->valid_login($_POST['login']) == "1"){
            $data['login'] = $this->func->clean_var($_POST['login']);
            $data['pwd'] = substr(md5($_POST['pwd']."uncleMasterwasHeRe+secret_key_031016+vazazaza"), 0, 50);
            $data['key'] = substr(md5($_POST['login']."secret_key_0979265+blahblahblah"), 0,10);
            $login =  $this->admin->get_login($data);
            if ($login && !$login['ban']) {
                $_SESSION['admin'] = $data['login'];
                $_SESSION['key'] = $data['key'];
                header("Location: /admin/");
            }else{
                if (isset($data['login']) && !empty($data['login'])) {
                    $this->smarty->assign('lastLogin', $data['login']);
                }
                $this->smarty->assign("title", "Авторизация");
                if(!$login) $this->smarty->assign("badLogin", true);
                if($login && $login['ban']) $this->smarty->assign("isBanned", true);
                if (isset($_POST['login']) && !empty($_POST['login'])) $this->smarty->assign('lastlogin', $_POST['login']);
                $this->smarty->display('/admin/auth.admin.html');
            }
        }else{
            if (isset($_POST['submit']) && !empty($_POST['submit'])){
                $fail_login = (isset($_POST['login']) && !empty($_POST['login'])) ? (($this->func_valid->valid_login($_POST['login']) == "1") ? "" : admin_auth_mess_login_bad) : admin_auth_mess_login_empty;
                $this->smarty->assign('fail_login', $fail_login);
                if (isset($_POST['login']) && !empty($_POST['login'])) $this->smarty->assign('last_login', $_POST['login']);

                $fail_pwd = (isset($_POST['pwd']) && !empty($_POST['pwd'])) ? "" : admin_auth_mess_pass_empty;
                $this->smarty->assign('fail_pwd', $fail_pwd);
            }else{
                $this->admin->logout();
            }

            $this->smarty->assign("title", "Авторизация");
            $this->smarty->display('/templates/admin/auth.admin.html');
        }
    }

    function pages(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();
        $title = 'Страницы';

        $pages = $this->gate->getPages(true);

        //vars path to files
        $form_path = "getup/getup/admin/forms/page.form.html";
        $content_path = "getup/getup/admin/pages/pages.admin.html";
        $template_path = "getup/getup/admin/template.admin.html";

        //assigns vars to template
        $this->smarty->assign("title", $title);
        $this->smarty->assign("pages", $pages);
        $this->smarty->assign("form", $form_path);
        $this->smarty->assign("content", $content_path);
        $this->smarty->display($template_path);
    }

    function brands(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();
        $title = 'Брэнды';

        $brands = $this->gate->getBrands(true);
        $categories = $this->gate->getCategories(false);

        //vars path to files
        $form_path = "getup/getup/admin/forms/brands.form.html";
        $content_path = "getup/getup/admin/pages/brands.admin.html";
        $template_path = "getup/getup/admin/template.admin.html";

        //assigns vars to template
        $this->smarty->assign("brands", $brands);
        $this->smarty->assign("categories", $categories);

        $this->smarty->assign("title", $title);
        $this->smarty->assign("form", $form_path);
        $this->smarty->assign("content", $content_path);
        $this->smarty->display($template_path);
    }

    function categories(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();
        $title = 'Категории';

        $categories = $this->gate->getCategories(true);

        //vars path to files
        $form_path = "getup/getup/admin/forms/categories.form.html";
        $content_path = "getup/getup/admin/pages/categories.admin.html";
        $template_path = "getup/getup/admin/template.admin.html";

        //assigns vars to template
        $this->smarty->assign("title", $title);
        $this->smarty->assign("categories", $categories);
        $this->smarty->assign("form", $form_path);
        $this->smarty->assign("content", $content_path);
        $this->smarty->display($template_path);
    }

    function tastys(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();
        $title = 'Вкусы';

        $tastys = $this->gate->getTastys();

        //vars path to files
        $form_path = "getup/getup/admin/forms/tastys.form.html";
        $content_path = "getup/getup/admin/pages/tastys.admin.html";
        $template_path = "getup/getup/admin/template.admin.html";

        //assigns vars to template
        $this->smarty->assign("title", $title);
        $this->smarty->assign("tastys", $tastys);
        $this->smarty->assign("form", $form_path);
        $this->smarty->assign("content", $content_path);
        $this->smarty->display($template_path);
    }

    function weights(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();
        $title = 'Тяжесть';

        $weights = $this->gate->getWeights();

        //vars path to files
        $form_path = "getup/getup/admin/forms/weights.form.html";
        $content_path = "getup/getup/admin/pages/weights.admin.html";
        $template_path = "getup/getup/admin/template.admin.html";

        //assigns vars to template
        $this->smarty->assign("title", $title);
        $this->smarty->assign("weights", $weights);
        $this->smarty->assign("form", $form_path);
        $this->smarty->assign("content", $content_path);
        $this->smarty->display($template_path);
    }

    function products(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();
        $title = 'Товары';

        $filter_category = (isset($_GET['filter_category']) && !empty($_GET['filter_category'])) ? (string)$_GET['filter_category'] : null;
        $filter_brand = (isset($_GET['filter_brand']) && !empty($_GET['filter_brand'])) ? (string)$_GET['filter_brand'] : null;

        $filters = [
            'filter_category' => $filter_category,
            'filter_brand' => $filter_brand
        ];

        $products = $this->gate->getProducts(true, $filters);
        $categories = $this->gate->getCategories(false);
        $brands = $this->gate->getBrands(false);
        $tastys = $this->gate->getTastys();
        $weights = $this->gate->getWeights();

        //vars path to files
        $form_path = "getup/getup/admin/forms/products.form.html";
        $content_path = "getup/getup/admin/pages/products.admin.html";
        $template_path = "getup/getup/admin/template.admin.html";

        //assigns vars to template
        $this->smarty->assign("products", $products);
        $this->smarty->assign("categories", $categories);
        $this->smarty->assign("brands", $brands);
        $this->smarty->assign("tastys", $tastys);
        $this->smarty->assign("weights", $weights);

        $this->smarty->assign("title", $title);
        $this->smarty->assign("form", $form_path);
        $this->smarty->assign("content", $content_path);
        $this->smarty->display($template_path);
    }

    function registry(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();
        $title = 'Учет товаров';
        $mode = (isset($_GET['mode']) && !empty($_GET['mode'])) ? $_GET['mode'] : null;

        if($mode == 'find'){
            $barcode = (isset($_POST['barcode']) && !empty($_POST['barcode'])) ? $_POST['barcode'] : user_error('"barcode" paramenter is required.');
            $product = $this->gate->findProduct($barcode);
            print_r(json_encode($product, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }elseif($mode == 'buy'){
            $id = (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : user_error('"id" paramenter is required.');
            $price = (isset($_POST['price']) && !empty($_POST['price'])) ? $_POST['price'] : user_error('"price" paramenter is required.');
            $priceRetail = (isset($_POST['price_retail']) && !empty($_POST['price_retail'])) ? $_POST['price_retail'] : user_error('"price_retail" paramenter is required.');
            $coming = (isset($_POST['coming']) && !empty($_POST['coming'])) ? $_POST['coming'] : user_error('"coming" paramenter is required.');

            $form = [
                'id' => $id,
                'price' => $price,
                'price_retail' => $priceRetail,
                'coming' => $coming
            ];

            $this->gate->buyProduct($form);
        }else{
            $products = $this->gate->getProducts(false,true);

            //vars path to files
            $form_path = "getup/getup/admin/forms/registry.form.html";
            $content_path = "getup/getup/admin/pages/registry.admin.html";
            $template_path = "getup/getup/admin/template.admin.html";

            //assigns vars to template
            $this->smarty->assign("title", $title);
            $this->smarty->assign("products", $products);
            $this->smarty->assign("form", $form_path);
            $this->smarty->assign("content", $content_path);
            $this->smarty->display($template_path);
        }
    }

    function orders(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();
        $title = 'Заказы';

        $orders = $this->gate->getProducts(false,true);

        //vars path to files
        $form_path = "getup/getup/admin/forms/registry.form.html";
        $content_path = "getup/getup/admin/pages/registry.admin.html";
        $template_path = "getup/getup/admin/template.admin.html";

        //assigns vars to template
        $this->smarty->assign("title", $title);
        $this->smarty->assign("products", $products);
        $this->smarty->assign("form", $form_path);
        $this->smarty->assign("content", $content_path);
        $this->smarty->display($template_path);
    }

    function formPage(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();

        $formMode = (isset($_GET['mode']) && !empty($_GET['mode'])) ? $_GET['mode'] : user_error('"mode" paramenter is required.');
        $id = $formMode == 'edit' || $formMode == 'remove' ? (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : user_error('"id" paramenter is required.') : null;

        if($formMode == 'edit' || $formMode == 'create') {
            $name = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : user_error('"name" paramenter is required.');
            $title = (isset($_POST['title']) && !empty($_POST['title'])) ? $_POST['title'] : user_error('"title" paramenter is required.');
            $content = (isset($_POST['content']) && !empty($_POST['content'])) ? $_POST['content'] : user_error('"content" paramenter is required.');
            $description = (isset($_POST['description']) && !empty($_POST['description'])) ? $_POST['description'] : user_error('"description" paramenter is required.');
            $keywords = (isset($_POST['keywords']) && !empty($_POST['keywords'])) ? $_POST['keywords'] : user_error('"keywords" paramenter is required.');
            $is_visible = (isset($_POST['is_visible']) && !empty($_POST['is_visible'])) ? (int)$_POST['is_visible'] : 0;

            $form = [
                'id' => $id,
                'name' => $name,
                'title' => $title,
                'content' => $content,
                'description' => $description,
                'keywords' => $keywords,
                'is_visible' => $is_visible,
            ];
            if ($formMode == 'create') {
                $this->gate->createPage($form);
            } elseif ($formMode == 'edit') {
                $this->gate->editPage($form);
            }
        }elseif ($formMode == 'remove') {
            $this->gate->removePage($id);
        }
    }

    function formCategory(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();

        $formMode = (isset($_GET['mode']) && !empty($_GET['mode'])) ? $_GET['mode'] : user_error('"mode" paramenter is required.');
        $id = $formMode == 'edit' || $formMode == 'remove' ? (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : user_error('"id" paramenter is required.') : null;

        if($formMode == 'edit' || $formMode == 'create') {
            $pid = (isset($_POST['pid']) && !empty($_POST['pid'])) ? $_POST['pid'] : 0;
            $name = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : user_error('"name" paramenter is required.');
            $description = (isset($_POST['description']) && !empty($_POST['description'])) ? $_POST['description'] : null;
            $logo = (isset($_POST['logo']) && !empty($_POST['logo'])) ? $_POST['logo'] : null;
            $url = (isset($_POST['url']) && !empty($_POST['url'])) ? $_POST['url'] : null;
            $is_visible = (isset($_POST['is_visible']) && !empty($_POST['is_visible'])) ? (int)$_POST['is_visible'] : 0;

            $form = [
                'id' => $id,
                'pid' => $pid,
                'name' => $name,
                'description' => $description,
                'logo' => $logo,
                'url' => $url,
                'vis' => $is_visible,
            ];
            if ($formMode == 'create') {
                $this->gate->createCategory($form);
            } elseif ($formMode == 'edit') {
                $this->gate->editCategory($form);
            }
        }elseif ($formMode == 'remove') {
            $this->gate->removeCategory($id);
        }
    }

    function formBrand(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();

        $formMode = (isset($_GET['mode']) && !empty($_GET['mode'])) ? $_GET['mode'] : user_error('"mode" paramenter is required.');
        $id = $formMode == 'edit' || $formMode == 'remove' ? (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : user_error('"id" paramenter is required.') : null;

        if($formMode == 'edit' || $formMode == 'create') {
            $name = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : user_error('"name" paramenter is required.');
            $category = (isset($_POST['category']) && !empty($_POST['category'])) ? $_POST['category'] : null;
            $is_visible = (isset($_POST['is_visible']) && !empty($_POST['is_visible'])) ? (int)$_POST['is_visible'] : 0;

            $form = [
                'id' => $id,
                'name' => $name,
                'cat_id' => $category,
                'vis' => $is_visible,
            ];

            if ($formMode == 'create') {
                $this->gate->createBrand($form);
            } elseif ($formMode == 'edit') {
                $this->gate->editBrand($form);
            }
        }elseif ($formMode == 'remove') {
            $this->gate->removeBrand($id);
        }
    }

    function formTasty(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();

        $formMode = (isset($_GET['mode']) && !empty($_GET['mode'])) ? $_GET['mode'] : user_error('"mode" paramenter is required.');
        $id = $formMode == 'edit' || $formMode == 'remove' ? (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : user_error('"id" paramenter is required.') : null;

        if($formMode == 'edit' || $formMode == 'create') {
            $name = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : user_error('"name" paramenter is required.');

            $form = [
                'id' => $id,
                'name' => $name,
            ];

            if ($formMode == 'create') {
                $this->gate->createTasty($form);
            } elseif ($formMode == 'edit') {
                $this->gate->editTasty($form);
            }
        }elseif ($formMode == 'remove') {
            $this->gate->removeTasty($id);
        }
    }

    function formWeight(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();

        $formMode = (isset($_GET['mode']) && !empty($_GET['mode'])) ? $_GET['mode'] : user_error('"mode" paramenter is required.');
        $id = $formMode == 'edit' || $formMode == 'remove' ? (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : user_error('"id" paramenter is required.') : null;

        if($formMode == 'edit' || $formMode == 'create') {
            $name = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : user_error('"name" paramenter is required.');

            $form = [
                'id' => $id,
                'name' => $name,
            ];

            if ($formMode == 'create') {
                $this->gate->createWeight($form);
            } elseif ($formMode == 'edit') {
                $this->gate->editWeight($form);
            }
        }elseif ($formMode == 'remove') {
            $this->gate->removeWeight($id);
        }
    }

    function formProduct(){
        $this->admin = new Admin_Model();
        $this->gate = new Gate_Model();
        $this->admin->get_access();

        $formMode = (isset($_GET['mode']) && !empty($_GET['mode'])) ? $_GET['mode'] : user_error('"mode" paramenter is required.');
        $id = $formMode == 'edit' || $formMode == 'remove' ? (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : user_error('"id" paramenter is required.') : null;

        if($formMode == 'edit' || $formMode == 'create') {
            $name = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : user_error('"name" paramenter is required.');
            $category = (isset($_POST['category']) && !empty($_POST['category'])) ? $_POST['category'] : user_error('"category" paramenter is required.');
            $runame = (isset($_POST['runame']) && !empty($_POST['runame'])) ? $_POST['runame'] : '';
            $barcode = (isset($_POST['barcode']) && !empty($_POST['barcode'])) ? $_POST['barcode'] : user_error('"barcode" paramenter is required.');
            $brand = (isset($_POST['brand']) && !empty($_POST['brand'])) ? $_POST['brand'] : user_error('"brand" paramenter is required.');
            $price = (isset($_POST['price'])) ? (int)$_POST['price'] : user_error('"price" paramenter is required.');
            $price_retail = (isset($_POST['price_retail'])) ? (int)$_POST['price_retail'] : user_error('"price_retail" paramenter is required.');
            $count = (isset($_POST['count'])) ? (int)$_POST['count'] : user_error('"count" paramenter is required.');
            $sort = (isset($_POST['sort']) && !empty($_POST['sort'])) ? $_POST['sort'] : user_error('"sort" paramenter is required.');
            $taste_id = (isset($_POST['taste_id']) && !empty($_POST['taste_id'])) ? $_POST['taste_id'] : 'NULL';
            $weight_id = (isset($_POST['weight_id']) && !empty($_POST['weight_id'])) ? $_POST['weight_id'] : 'NULL';
            $is_tabacco = (isset($_POST['is_tabacco']) && !empty($_POST['is_tabacco'])) ? (int)1 : 0;
            $is_visible = (isset($_POST['is_visible']) && !empty($_POST['is_visible'])) ? (int)1 : 0;

            $form = [
                'id' => $id,
                'name' => $name,
                'category' => $category,
                'runame' => $runame,
                'barcode' => $barcode,
                'brand' => $brand,
                'price' => $price,
                'price_retail' => $price_retail,
                'count' => $count,
                'sort' => $sort,
                'taste_id' => $taste_id,
                'weight_id' => $weight_id,
                'is_tabacco' => $is_tabacco,
                'is_visible' => $is_visible,
            ];

            if ($formMode == 'create') {
                $this->gate->createProduct($form);
            } elseif ($formMode == 'edit') {
                $this->gate->editProduct($form);
            }
        }elseif ($formMode == 'remove') {
            $this->gate->removeProduct($id);
        }
    }
}

?>