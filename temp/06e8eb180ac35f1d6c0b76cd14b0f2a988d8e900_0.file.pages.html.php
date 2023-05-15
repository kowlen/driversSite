<?php
/* Smarty version 3.1.29, created on 2022-10-30 16:21:14
  from "C:\Apache24\htdocs_bizum\templates\getup\goodtimes\pages\pages.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_635e420a2b8034_33697794',
  'file_dependency' => 
  array (
    '06e8eb180ac35f1d6c0b76cd14b0f2a988d8e900' => 
    array (
      0 => 'C:\\Apache24\\htdocs_bizum\\templates\\getup\\goodtimes\\pages\\pages.html',
      1 => 1667121672,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_635e420a2b8034_33697794 ($_smarty_tpl) {
?>


        <div class="header_text">
            <?php echo $_smarty_tpl->tpl_vars['title']->value;?>

        </div>

        <div class="row">
            <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
                    <div class="col-12 mb-5">
                        <div class="card" style="">
                            <div class="card-body">
                                <div class="row mb-2 d-none">
                                    <div class="col-6"><b>Автор:</b> </div>
                                    <div class="col-6 ta-right"><b>Дата:</b> <?php echo $_smarty_tpl->tpl_vars['data']->value['dat'];?>
</div>
                                </div>
                                <!--<h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</h5>-->
                                <p class="card-text" style="text-align: left;">
                                    <?php echo $_smarty_tpl->tpl_vars['data']->value['text'];?>

                                </p>
                                <div class="row">
                                    <!--<div class="col-12"><b>Теги:</b>
                                        <a href="">Раз</a>,
                                        <a href="">Два</a>,
                                        <a href="">Три</a>
                                    </div>-->
                                </div>
                                <div class="row d-none">
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
