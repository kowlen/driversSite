<?php
/* Smarty version 3.1.29, created on 2022-09-13 14:07:21
  from "C:\Apache24\htdocs_bizum\templates\getup\goodtimes\category\post.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_63202c29145839_89917757',
  'file_dependency' => 
  array (
    'a1c38c7c881643f111b9250df8fda22aff48ae94' => 
    array (
      0 => 'C:\\Apache24\\htdocs_bizum\\templates\\getup\\goodtimes\\category\\post.html',
      1 => 1663039826,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63202c29145839_89917757 ($_smarty_tpl) {
?>


        <div class="header_text">
            <?php echo $_smarty_tpl->tpl_vars['title']->value;?>

        </div>


        <div class="mt-5 mb-5"></div>

        <div class="row">
            <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
                    <div class="col-12 mb-5">
                        <div class="card" style="">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-6"><b>Автор:</b> <?php echo $_smarty_tpl->tpl_vars['data']->value['autor'];?>
</div>
                                    <div class="col-6 ta-right"><b>Дата:</b> <?php echo $_smarty_tpl->tpl_vars['data']->value['dat'];?>
</div>
                                </div>
                                <h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</h5>
                                <p class="card-text">
                                    <?php echo $_smarty_tpl->tpl_vars['data']->value['text'];?>

                                </p>
                                <div class="row">
                                    <div class="col-12"><b>Теги:</b>
                                        <a href="">Раз</a>,
                                        <a href="">Два</a>,
                                        <a href="">Три</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><b>Категория:</b> </div>
                                    <div class="col-6 ta-right"><b>Просмотры:</b> <?php echo $_smarty_tpl->tpl_vars['data']->value['views'];?>
</div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }?>
        </div>



<?php }
}
