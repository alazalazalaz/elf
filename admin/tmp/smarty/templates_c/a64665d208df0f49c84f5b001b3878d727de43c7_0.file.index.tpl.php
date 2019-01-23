<?php
/* Smarty version 3.1.30, created on 2019-01-23 15:04:29
  from "/Users/zhangxiong/work/www/my/elf/elf/app/view/lottery/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5c4811fd24bb88_20391459',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a64665d208df0f49c84f5b001b3878d727de43c7' => 
    array (
      0 => '/Users/zhangxiong/work/www/my/elf/elf/app/view/lottery/index.tpl',
      1 => 1502446716,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layouts/menu.tpl' => 1,
  ),
),false)) {
function content_5c4811fd24bb88_20391459 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15782953605c4811fd249413_81504777', 'body');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layouts/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_15782953605c4811fd249413_81504777 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue-hoki ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>首页
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                        </div>
                    </div>

                    <!-- 1，定义sf-controller[必须](名称可以任意填，一个controller表示一个作用域，一个页面可以有多个) -->
                    <div class="portlet-body" sf-controller="myNoteCtrl">
                        <!-- 2，定义sf-display[可选]作用：显示警告弹框 -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
}
/* {/block 'body'} */
}
