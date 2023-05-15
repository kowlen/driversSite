<?php
/* Smarty version 3.1.29, created on 2022-10-30 16:05:04
  from "C:\Apache24\htdocs_bizum\templates\admin\auth.admin.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_635e3e40094e96_87221759',
  'file_dependency' => 
  array (
    '76d17416e3adbcfd6acf7f54517eb4adb709a425' => 
    array (
      0 => 'C:\\Apache24\\htdocs_bizum\\templates\\admin\\auth.admin.html',
      1 => 1662976602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:/templates/admin/head.admin.html' => 1,
  ),
),false)) {
function content_635e3e40094e96_87221759 ($_smarty_tpl) {
?>
<!doctype html>
<html lang="en">

  <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:/templates/admin/head.admin.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


  <body class="text-center">

    <form class="form-signin" method="post">
      <?php if (isset($_smarty_tpl->tpl_vars['badLogin']->value) && $_smarty_tpl->tpl_vars['badLogin']->value) {?>
        <div class="alert alert-danger" role="alert">
          Неверный <strong>Логин</strong> или <strong>Пароль</strong>
        </div>
      <?php }?>
      <?php if (isset($_smarty_tpl->tpl_vars['isBanned']->value) && $_smarty_tpl->tpl_vars['isBanned']->value) {?>
        <div class="alert alert-warning" role="alert">
          Вы забанены
        </div>
      <?php }?>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="text" id="inputEmail" name="login" class="form-control" value="<?php if (isset($_smarty_tpl->tpl_vars['lastlogin']->value)) {
echo $_smarty_tpl->tpl_vars['lastlogin']->value;
}?>" placeholder="Login" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
  </body>
</html>
<?php }
}
