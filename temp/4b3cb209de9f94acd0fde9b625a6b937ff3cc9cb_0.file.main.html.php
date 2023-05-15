<?php
/* Smarty version 3.1.29, created on 2022-09-13 17:18:09
  from "C:\Apache24\htdocs_bizum\templates\getup\goodtimes\category\main.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_632058e1ea55f9_14389765',
  'file_dependency' => 
  array (
    '4b3cb209de9f94acd0fde9b625a6b937ff3cc9cb' => 
    array (
      0 => 'C:\\Apache24\\htdocs_bizum\\templates\\getup\\goodtimes\\category\\main.html',
      1 => 1663064287,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632058e1ea55f9_14389765 ($_smarty_tpl) {
?>


        <div class="header_text">
            <?php echo $_smarty_tpl->tpl_vars['title']->value;?>

        </div>
        <?php echo $_smarty_tpl->tpl_vars['data_desc']->value['text'];?>


        <div class="mt-5 mb-5"></div>

        <div class="row">
            <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
                <?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_dal_0_saved_item = isset($_smarty_tpl->tpl_vars['dal']) ? $_smarty_tpl->tpl_vars['dal'] : false;
$_smarty_tpl->tpl_vars['dal'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['dal']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['dal']->value) {
$_smarty_tpl->tpl_vars['dal']->_loop = true;
$__foreach_dal_0_saved_local_item = $_smarty_tpl->tpl_vars['dal'];
?>
                    <div class="col-12 mb-5">
                        <div class="card" style="">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-6"><b>Автор:</b> <?php echo $_smarty_tpl->tpl_vars['dal']->value['autor'];?>
</div>
                                    <div class="col-6 ta-right"><b>Дата:</b> <?php echo $_smarty_tpl->tpl_vars['dal']->value['dat'];?>
</div>
                                </div>
                                <h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['dal']->value['name'];?>
</h5>
                                <p class="card-text">
                                    <?php echo $_smarty_tpl->tpl_vars['dal']->value['text_short'];?>

                                </p>
                                <div class="row">
                                    <div class="col-12"><b>Теги:</b>
                                        <a href="">Раз</a>,
                                        <a href="">Два</a>,
                                        <a href="">Три</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>Категория:</b> <?php echo $_smarty_tpl->tpl_vars['dal']->value['pid_name'];?>
 > <?php echo $_smarty_tpl->tpl_vars['dal']->value['cat_name'];?>
</div>
                                    <div class="col-6 ta-right"><b>Просмотры:</b> <?php echo $_smarty_tpl->tpl_vars['dal']->value['views'];?>
</div>
                                </div>
                                <div class="col text-center">
                                    <a href="/category/view_post/?p=<?php echo $_smarty_tpl->tpl_vars['dal']->value['id'];?>
/" class="btn btn-primary bg-viola bg-viola_text pull-right">Кнопка по центру</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
$_smarty_tpl->tpl_vars['dal'] = $__foreach_dal_0_saved_local_item;
}
if ($__foreach_dal_0_saved_item) {
$_smarty_tpl->tpl_vars['dal'] = $__foreach_dal_0_saved_item;
}
?>
            <?php }?>
        </div>

        <div class="row">
        <?php if ($_smarty_tpl->tpl_vars['data']->value && 1 == 2) {?>
            <?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_dal_1_saved_item = isset($_smarty_tpl->tpl_vars['dal']) ? $_smarty_tpl->tpl_vars['dal'] : false;
$_smarty_tpl->tpl_vars['dal'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['dal']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['dal']->value) {
$_smarty_tpl->tpl_vars['dal']->_loop = true;
$__foreach_dal_1_saved_local_item = $_smarty_tpl->tpl_vars['dal'];
?>
                <div class="col-md-4 mt-3 mb-3">
                    <div class="card" style="">
                        <img class="card-img-top" src="/templates/static/img/IMG_4188.JPG" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['dal']->value['name'];?>
</h5>
                            <p class="card-text"><?php echo $_smarty_tpl->tpl_vars['dal']->value['text_short2'];?>
</p>
                            <div class="col text-center">
                                <a href="#" class="btn btn-primary bg-viola bg-viola_text pull-right">Кнопка по центру</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
$_smarty_tpl->tpl_vars['dal'] = $__foreach_dal_1_saved_local_item;
}
if ($__foreach_dal_1_saved_item) {
$_smarty_tpl->tpl_vars['dal'] = $__foreach_dal_1_saved_item;
}
?>
        <?php }?>


        </div>

<?php }
}
