<?php
/* Smarty version 3.1.29, created on 2022-09-13 17:42:46
  from "C:\Apache24\htdocs_bizum\templates\static\mainhead.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_63205ea631fc13_60315335',
  'file_dependency' => 
  array (
    '5470a951d0690155a987a32ad50f689c7f0a6223' => 
    array (
      0 => 'C:\\Apache24\\htdocs_bizum\\templates\\static\\mainhead.html',
      1 => 1663065764,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63205ea631fc13_60315335 ($_smarty_tpl) {
?>
<!-- Bootstrap core CSS -->
<link href="/templates/static/plugins/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="/templates/static/styles/main.css" rel="stylesheet">
<link href="/templates/static/plugins/fontawesome-free-5.14.0-web/css/all.css" rel="stylesheet"> <!--load all styles -->
<link href="/templates/static/styles/jquery.fancybox.css" rel="stylesheet"> <!--load all styles -->
<!-- Bootstrap core JavaScript
   ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php echo '<script'; ?>
 src="/templates/static/plugins/jquery-3.5.1.min.js" crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/templates/static/plugins/popper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/templates/static/plugins/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/templates/static/plugins/loadingoverlay.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/templates/static/plugins/jquery.fancybox.js"><?php echo '</script'; ?>
>


<?php echo '<script'; ?>
>
    $(document).ready(function() {
        $(".img").fancybox();

        $('.spoilerbody').hide();
        $('.hide').click(function(){
            $(this).toggleClass("folded").toggleClass("unfolded").next().slideToggle()
        })
    });
<?php echo '</script'; ?>
>


<?php }
}
