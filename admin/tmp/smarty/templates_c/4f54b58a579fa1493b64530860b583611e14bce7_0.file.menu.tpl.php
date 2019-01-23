<?php
/* Smarty version 3.1.30, created on 2019-01-23 15:04:36
  from "/Users/zhangxiong/work/www/my/elf/elf/app/view/layouts/menu.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5c481204b000d9_92938088',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f54b58a579fa1493b64530860b583611e14bce7' => 
    array (
      0 => '/Users/zhangxiong/work/www/my/elf/elf/app/view/layouts/menu.tpl',
      1 => 1502446682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layouts/main.tpl' => 1,
  ),
),false)) {
function content_5c481204b000d9_92938088 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7402580565c481204afe650_03380305', 'menu');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layouts/main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'menu'} */
class Block_7402580565c481204afe650_03380305 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu1" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
	<li class="heading">
		<h3>GENERAL</h3>
	</li>
	<li class="active">
		<a href="index.html">
		<i class="icon-home"></i>
		<span class="title">Dashboard</span>
		</a>
	</li>
	<!-- BEGIN ANGULARJS LINK -->
	<li class="tooltips" data-container="body" data-placement="right" data-html="true">
		<a href="/lottery/recommend.html">
		<i class="icon-paper-plane"></i>
		<span class="title">
		推荐 </span>
		</a>
	</li>
	<li class="tooltips" data-container="body" data-placement="right" data-html="true">
		<a href="./file_upload.html">
		<i class="icon-paper-plane"></i>
		<span class="title">
		图片上传 </span>
		</a>
	</li>
	<li class="tooltips" data-container="body" data-placement="right" data-html="true">
		<a href="./table_list.html">
		<i class="icon-paper-plane"></i>
		<span class="title">
		数据列表 </span>
		</a>
	</li>
	<!-- END ANGULARJS LINK -->
	<li>
		<a href="javascript:;">
		<i class="icon-basket"></i>
		<span class="title">eCommerce</span>
		<span class="arrow "></span>
		</a>
		<ul class="sub-menu">
			<li>
				<a href="index_extended.html">
				<i class="icon-home"></i>
				Dashboard</a>
			</li>
		</ul>
	</li>
</ul>
<?php
}
}
/* {/block 'menu'} */
}
