<?php
/* Smarty version 3.1.29, created on 2022-09-13 17:21:27
  from "C:\Apache24\htdocs_bizum\templates\getup\goodtimes\index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_632059a73e37b3_92146692',
  'file_dependency' => 
  array (
    '346887524b76f2cd445d16c92961cc2ab128f198' => 
    array (
      0 => 'C:\\Apache24\\htdocs_bizum\\templates\\getup\\goodtimes\\index.html',
      1 => 1663064484,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/static/mainhead.html' => 1,
    'file:templates/getup/goodtimes/head.html' => 1,
  ),
),false)) {
function content_632059a73e37b3_92146692 ($_smarty_tpl) {
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:templates/static/mainhead.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:templates/getup/goodtimes/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</head>

<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-viola">
    <div class="container" style="max-width: 100%">
        <a href="#" class="navbar-brand"> uncleTales.ru </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2">
                <li class="nav-item mt-1">
                <?php if ($_smarty_tpl->tpl_vars['menu']->value) {?>
                    <?php
$_from = $_smarty_tpl->tpl_vars['menu']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo'] : false;
$__foreach_foo_0_saved_item = isset($_smarty_tpl->tpl_vars['v']) ? $_smarty_tpl->tpl_vars['v'] : false;
$__foreach_foo_0_saved_key = isset($_smarty_tpl->tpl_vars['k']) ? $_smarty_tpl->tpl_vars['k'] : false;
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_foo'] = new Smarty_Variable(array());
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable();
$__foreach_foo_0_first = true;
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['first'] = $__foreach_foo_0_first;
$__foreach_foo_0_first = false;
$__foreach_foo_0_saved_local_item = $_smarty_tpl->tpl_vars['v'];
?>
                        <li class="nav-item mt-1">
                            <a class="nav-link <?php if (isset($_smarty_tpl->tpl_vars['v']->value['childs'])) {?>dropdown-toggle<?php }?>" href="<?php if (isset($_smarty_tpl->tpl_vars['v']->value['childs'])) {?>#<?php } else { ?>/category/?c=<?php echo $_smarty_tpl->tpl_vars['v']->value['url'];
}?>" role="button" id="dropdownMenuLink" <?php if (isset($_smarty_tpl->tpl_vars['v']->value['childs'])) {?>data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"<?php }?>>
                                <?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>

                            </a>
                            <?php if (isset($_smarty_tpl->tpl_vars['v']->value['childs'])) {?>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <?php
$_from = $_smarty_tpl->tpl_vars['v']->value['childs'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo'] : false;
$__foreach_foo_1_saved_item = isset($_smarty_tpl->tpl_vars['sub']) ? $_smarty_tpl->tpl_vars['sub'] : false;
$__foreach_foo_1_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['sub'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_foo'] = new Smarty_Variable(array());
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$__foreach_foo_1_first = true;
$_smarty_tpl->tpl_vars['sub']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['sub']->value) {
$_smarty_tpl->tpl_vars['sub']->_loop = true;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['first'] = $__foreach_foo_1_first;
$__foreach_foo_1_first = false;
$__foreach_foo_1_saved_local_item = $_smarty_tpl->tpl_vars['sub'];
?>
                                        <a class="dropdown-item" href="/category/?c=<?php echo $_smarty_tpl->tpl_vars['sub']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['sub']->value['name'];?>
</a>
                                    <?php
$_smarty_tpl->tpl_vars['sub'] = $__foreach_foo_1_saved_local_item;
}
if ($__foreach_foo_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_foo'] = $__foreach_foo_1_saved;
}
if ($__foreach_foo_1_saved_item) {
$_smarty_tpl->tpl_vars['sub'] = $__foreach_foo_1_saved_item;
}
if ($__foreach_foo_1_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_foo_1_saved_key;
}
?>
                                </div>
                            <?php } else { ?>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="/category/?c=<?php echo $_smarty_tpl->tpl_vars['v']->value['url'];?>
">Перейти</a>
                                </div>
                            <?php }?>
                        </li>
                    <?php
$_smarty_tpl->tpl_vars['v'] = $__foreach_foo_0_saved_local_item;
}
if ($__foreach_foo_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_foo'] = $__foreach_foo_0_saved;
}
if ($__foreach_foo_0_saved_item) {
$_smarty_tpl->tpl_vars['v'] = $__foreach_foo_0_saved_item;
}
if ($__foreach_foo_0_saved_key) {
$_smarty_tpl->tpl_vars['k'] = $__foreach_foo_0_saved_key;
}
?>
                <?php }?>
            </ul>
            <form action="/category/find/" class="d-flex " method="post">
                <input type="text" id="find" name="find" placeholder="Поиск" class="form-control me-2">
                <button type="submit" class="btn btn-outline-white">Поиск</button>
            </form>
        </div>

    </div>

</nav>
<div class="row">
    <div class="col-12">
        <div class="navigation">
            <?php if (!empty($_smarty_tpl->tpl_vars['htpath']->value)) {?>
                <?php
$_from = $_smarty_tpl->tpl_vars['htpath']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_2_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo'] : false;
$__foreach_foo_2_saved_item = isset($_smarty_tpl->tpl_vars['v']) ? $_smarty_tpl->tpl_vars['v'] : false;
$__foreach_foo_2_saved_key = isset($_smarty_tpl->tpl_vars['k']) ? $_smarty_tpl->tpl_vars['k'] : false;
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_foo'] = new Smarty_Variable(array());
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable();
$__foreach_foo_2_first = true;
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['first'] = $__foreach_foo_2_first;
$__foreach_foo_2_first = false;
$__foreach_foo_2_saved_local_item = $_smarty_tpl->tpl_vars['v'];
?>
                    <?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['first'] : null)) {?>><?php }?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['v']->value['url'];?>
" class="header_text clean_link"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</a>
                <?php
$_smarty_tpl->tpl_vars['v'] = $__foreach_foo_2_saved_local_item;
}
if ($__foreach_foo_2_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_foo'] = $__foreach_foo_2_saved;
}
if ($__foreach_foo_2_saved_item) {
$_smarty_tpl->tpl_vars['v'] = $__foreach_foo_2_saved_item;
}
if ($__foreach_foo_2_saved_key) {
$_smarty_tpl->tpl_vars['k'] = $__foreach_foo_2_saved_key;
}
?>
            <?php }?>
        </div>
    </div>
</div>
<?php if (isset($_smarty_tpl->tpl_vars['main_content_template']->value)) {?>
    <div class="container page">

        <div class="row mt-1 pb-4">
            <div class="col-12">
                <div class="container">
                    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, $_smarty_tpl->tpl_vars['main_content_template']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

                </div>
            </div>
        </div>
    </div>

<?php }?>
<div class="footer bg-viola bg-viola_text">Мы подбираем для вас и ваших деток материалы с 2013 года</div>

<?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
