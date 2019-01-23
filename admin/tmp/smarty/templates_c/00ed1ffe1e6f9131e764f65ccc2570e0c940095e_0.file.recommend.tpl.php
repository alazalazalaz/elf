<?php
/* Smarty version 3.1.30, created on 2019-01-23 15:04:36
  from "/Users/zhangxiong/work/www/my/elf/elf/app/view/lottery/recommend.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5c481204ad5c67_62402461',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '00ed1ffe1e6f9131e764f65ccc2570e0c940095e' => 
    array (
      0 => '/Users/zhangxiong/work/www/my/elf/elf/app/view/lottery/recommend.tpl',
      1 => 1502446723,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layouts/menu.tpl' => 1,
  ),
),false)) {
function content_5c481204ad5c67_62402461 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14323652135c481204acec85_87869763', 'body');
?>



<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layouts/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'} */
class Block_14323652135c481204acec85_87869763 extends Smarty_Internal_Block
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
                            <i class="fa fa-gift"></i>推荐
                        </div>
                        <div class="tools">
                            <a href="" class="collapse">
                            </a>
                        </div>
                    </div>

                    <!-- 1，定义sf-controller[必须](名称可以任意填，一个controller表示一个作用域，一个页面可以有多个) -->
                    <div class="portlet-body" sf-controller="myNoteCtrl">
                        <!-- 2，定义sf-display[可选]作用：显示警告弹框 -->
                        <div sf-display="error_msg"></div>
                            <!-- 3，定义form表单[必须]
                            参数：
                            action="xxx.php"    表示该表单提交的URL
                            sf-submit-method=ajax或者form，分别表示表单用ajax提交或者form方式提交 -->
                            <form class="form-horizontal" action="../../data/base_data.php" method="post" sf-submit-method="ajax">
                            
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">游戏名称:</label>
                                    <div class="col-md-5">
                                        <!-- 定义普通input框 -->
                                        <input type="text" name="win" value="init value" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">普通下拉框:</label>
                                    <div class="col-md-5">
                                        <!-- 定义select下拉框
                                        参数sf-init：表示初始化被选中的值 -->
                                        <select name="state" sf-init="1" class="form-control ">
                                            <option value="0">否</option>
                                            <option value="1">是</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">单选框:</label>
                                    <div class="col-md-5">
                                        <!-- 定义普通单选框 -->
                                        <label>
                                        <input type="radio" name="pay_me" value="zhifubao" checked="checked" />支付宝
                                        </label>
                                        <label>
                                        <input type="radio" name="pay_me" value="caifutong" />财富通
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">多选框:</label>
                                    <div class="col-md-5">
                                        <!-- 定义普通复选框 -->
                                        <input type="checkbox"  name="ck1" value="1" checked="checked" />Checkbox1
                                        <input type="checkbox"  name="ck2" value="2" />Checkbox2
                                        <input type="checkbox"  name="ck[]" value="3" />Checkbox2
                                        <input type="checkbox"  name="ck[]" value="4" />Checkbox2
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">textarea:</label>
                                    <div class="col-md-5">
                                        <!-- 定义普通文本域 -->
                                        <textarea rows="3" cols="20" name="desc">为了保证ajax操作成功请配置apache/nginx服务器</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">新增框:</label>
                                    <div class="col-md-5">
                                        <!-- 定义新增框 -->
                                        <new-list sf-name="sub_option" list-column='{"id":"ID", "name":"名字", "icon":"头像", "sex":"性别"}' sf-init='[{"id":1,"name":2,"icon":"iconddd","sex":"nan"},{"id":3,"name":"xx","icon":"666","sex":"444","qita":"fff"}]'></new-list>
                                    </div>
                                </div>

                                <div class="form-actions right1">
                                    <a type="button" href="index.html" class="btn red">取消</a>
                                    <!-- 定义保存按钮[必须]
                                    参数：
                                    sf-click="save()"   表示提交表单操作，
                                    sf-jump-action='xxx.html'   表示表单提交成功后跳转的url -->
                                    <a sf-click="save()" sf-jump-action="" class="btn green addpic">保存</a>
                                </div>
                            </div>
                        </form>
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
