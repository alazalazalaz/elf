<{extends file='../layouts/menu.tpl'}>
<{block name=body}>


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
<{/block}>