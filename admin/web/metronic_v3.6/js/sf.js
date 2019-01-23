$(document).ready(function(){
    var sf_app = new Object();

    sf_app = {
        "controller":[]
    };

    //初始化 begin
    modal_controller = modal_draw_confirm();
    init_param();
    init_bind_event();
    //初始化 end

    //全局变量 begin
    g_is_confirm = {
        _node:new Object()
    };
    //全局变量 end


    //初始化下拉框的值
    function sf_init_select_data(handler){
        var init_action = handler.attr('sf-get-data-action');
        if (typeof(init_action) == 'string') {
            $.ajax({
                url     : init_action,
                // data     : _param,
                type    : "get",
                dataType: "json",
                success : function(json){
                    if (json.status !== undefined) {
                        if (json.status == 200) {
                            for (var i=0; i < json.data.length; i++) {
                                handler.append("<option value='"+json.data[i].value+"'>"+json.data[i].text+"</option>")
                            }
                            sf_init_select(handler);
                        }else{

                        }
                    }else{
                        alert("json必须返回如下格式：{status:200, msg:xxx, data:...}");
                    }
                },
                error   : function(e){
                    
                }
            })
        }
    }

    //初始化下拉框默认选中的值，ajax获取下拉列表后记得调用一下
    function sf_init_select(handler){
        var init_value = handler.attr('sf-init');
        if (typeof(init_value) == 'string' && init_value!="") {
            handler.val(init_value);
        }
    }

    function sf_init_select_level(handlerArr){
        for(var i=0; i < handlerArr.length; i++){
            select_sf_model = handlerArr[i].attr('sf-model');
        }
    }

    //初始化变量
    function init_param(){
        $("*[sf-controller]").each(function(even){
            //初始化select
            $(this).find("select").each(function(){
                sf_init_select_data($(this));
                sf_init_select($(this));
            });
            //初始化input
            //初始化插件。。。@todo
        });
    }

    //初始化绑定事件
    function init_bind_event(init_all = true){
        $("*[sf-controller]").each(function(even){
            if (init_all == true) {
                //绑定其他插件
                $(this).find('new-list').each(function(){
                    //给new-list画表格头部信息
                    event_draw_newlist($(this));
                    //初始化表格
                    event_draw_newlist_init($(this));
                });
                $(this).find('table-list').each(function(){
                    
                    //table-list画表格头部信息
                    event_draw_tablelist($(this));

                    //初始化表格
                    event_draw_init($(this));
                    
                });
            }

            //绑定单击事件
            $(this).find("[sf-click]").each(function(){
                $(this).unbind("click");
                //@todo还可以监测其他事件，比如double click等
                var click_event = $(this).attr("sf-click").toLowerCase();

                if (click_event == "save()") {
                    $(this).bind("click", $(this), event_save);
                }else if(click_event == "clear()"){
                    $(this).bind("click", $(this), event_clear);
                }else if(click_event == "upload()"){
                    //给每一个upload增加一个隐藏域type=file
                    var hidden_obj = event_upload_init($(this));
                    hidden_obj.div = $(this);

                    hidden_obj.input.bind("change", hidden_obj, event_upload);
                }else if (click_event == 'file()') {
                    var upload_obj = event_file_init($(this));
                    upload_obj.node_input.bind("change", upload_obj, event_file);
                }else if(click_event == 'search()'){
                    $(this).bind("click", $(this), event_table_list);
                }else if(click_event == 'confirm()'){
                    $(this).bind('click', $(this), event_confirm);//点击删除、点击btn都有可能触发
                }else if(click_event == 'send_confirm()'){
                    $(this).bind('click', $(this), event_send_confirm);
                }else if(click_event == '_add_newlist()'){
                    //内置的点击事件，加个下划线在前面
                    $(this).bind('click', $(this), event_add_newlist);
                }
            });
            
        });
    }

    function event_add_newlist(handler, init_data = '', tag_name = 'a'){
        if (tag_name == 'a') {
            var new_list    = handler.data.parents('new-list');
            var base_table  = new_list.children('._sf_none').children('table');
        }else{
            var new_list    = handler;
            var base_table  = handler.children('._sf_none').children('table');
        }
        
        list_column = eval('(' + new_list.attr('list-column') + ')');
        //draw tr
        line = '<tr class="odd gradeX">';
        for(var key in list_column){
            //初始值
            var init_value = '';
            if (init_data[key]) {
                init_value = 'value="' + init_data[key] +'"';
            }
            //draw td
            line += '<td><input type="text" class="form-control" '+init_value+'></td>';
        }
        //draw 删除按钮
        if (typeof new_list.attr('sf-nobtn') != 'string') {
            line += '<td class="center"><a class="btn red addpic btn-sm">删除</a></td>';
        }
        line += '</tr>';

        base_table.children('tbody').append(line);

        if (typeof new_list.attr('sf-nobtn') != 'string') {
            //给删除按钮绑定删除事件
            base_table.children('tbody').children('tr:last-child').children('td:last-child').children('a').bind("click", function(){
                $(this).parents('td').parents('tr').remove();
            });
        }
    }


    /**
    *   初始化数据
    **/
    function event_draw_newlist_init(handler){
        var init_data = handler.attr('sf-init');
        if (init_data == '' || typeof(init_data) == 'undefined') {
            return ;
        }

        init_data = eval('(' + init_data + ')');
        if (typeof(init_data) != 'undefined' && init_data.length != 0) {
            for(var i=0; i<init_data.length; i++){
                event_add_newlist(handler, init_data[i], 'new-list');
            }
        }
    }

    /**
    *   画新增表格
    **/
    function event_draw_newlist(handler){
        var content = '<div class="table-scrollable _sf_none">\
                        <table class="table table-striped table-bordered table-hover">\
                            <thead>\
                            <tr>\
                            </tr>\
                            </thead>\
                            <tbody>\
                            </tbody>\
                        </table>\
                    </div>';
        handler.append(content);
        base_table_tr = handler.children('._sf_none').children('table').children('thead').children('tr');

        list_column = eval('(' + handler.attr('list-column') + ')');

        //draw th
        for(var key in list_column){
            //draw hh
            var th = "";
            th = '<th>'+list_column[key]+'</th>';
            base_table_tr.append(th);
        }

        if(typeof handler.attr('sf-nobtn')!='string'){
            var add_btn = '<th><a class="btn blue addpic btn-sm" sf-click="_add_newlist()">新增</a></th>';
            base_table_tr.append(add_btn);
        };
    }


    /**
    *   点击弹框
    **/
    function event_confirm(handler){
        var content = handler.data.attr('sf-confirm-content');
        var url = handler.data.attr('sf-confirm-action');
        var del = handler.data.attr('sf-confirm-need-del');

        modal_controller.find('p').html(content);
        modal_controller._sf_confirm_action = url;
        if (del == 'true') {
            modal_controller._sf_confirm_need_del = handler.data;
        }else{
            modal_controller._sf_confirm_need_del = '';
        }

        modal_controller.modal();
    }

    function event_send_confirm(handler){
        // handler.data.html("处理中。。。");
        // handler.data.attr('disabled', 'disabled');
        $.ajax({
            url     : modal_controller._sf_confirm_action,
            data    : {},
            type    : 'post',
            dataType: "json",
            success : function(json){
                if (json.status !== undefined) {
                    if (json.status == 200) {
                        $('#sf-modal').modal('hide');
                        //可以加一个成功的动画，比如modal弹框

                        if (modal_controller._sf_confirm_need_del != '') {
                            //点击删除后，删除tr行，
                            var del_line = modal_controller._sf_confirm_need_del.parents('tr');
                            // del_line.fadeOut(500);
                            //修改为点击删除后，刷新列表，类似重新点击search button
                            event_table_list(del_line);
                        }
                    }else{
                        alert('操作失败');
                    }
                }else{
                    alert("json必须返回如下格式：{status:200, msg:xxx, data:...}");
                }
            },
            error   : function(e){
                
            }
        });

    }


    /**
    * 初始化文件上传(新版本)
    **/
    function event_file_init(handler){

        var upload_obj = {
            node_img:"",
            node_icon:"",
            node_msg:"",
            node_a:"",
            node_input:"",
            node_a_del:""
        };
        var rand = Math.ceil(Math.random()*10000);
        var hidden_input = "hidden_file"+rand;
        var hidden_msg   = "hidden_msg"+rand;
        var parent = '<a href="" class="sf-file btn" >选择</a>';
        var preview_img_init_val = handler.attr('sf-init');
        handler.wrap(parent);
        label_a = handler.closest("a");//增加select btn
        label_a.before('<img src="" class="sf-file-img sf-file-img-width sf-file-img-height" style="display:none">');//增加一个img标签
        label_a.after('<a type="button" class="btn red" style="display:none">删除</a>');//增加del btn

        upload_obj.node_input = handler;
        upload_obj.node_a = label_a;
        upload_obj.node_img = label_a.prev();
        upload_obj.node_a_del = label_a.next();

        upload_obj.node_a.before('<div class="alert" style="display:none">\
                            <a class="close" data-dismiss="alert">&times;</a>\
                            <strong>default</strong>\
                            <a style="word-wrap:break-word" target="_blank"></a>\
                        </div>');//增加alert框
        upload_obj.node_msg = upload_obj.node_a.prev();
        upload_obj.node_msg.before('<i class=" alert fa fa-file-text-o fa-4x" style="padding-left:0px;display: none"></i>');
        upload_obj.node_icon = upload_obj.node_msg.prev();

        //初始化img大小
        var img_width = handler.attr('sf-width');
        if (typeof(img_width) != "undefined" && img_width != "") {
            upload_obj.node_img.removeClass('sf-file-img-width');
            upload_obj.node_img.css('width', img_width);
        }
        var img_height = handler.attr('sf-height');
        if (typeof(img_width) != "undefined" && img_width != "") {
            upload_obj.node_img.removeClass('sf-file-img-height');
            upload_obj.node_img.css('height', img_height);
        }
        //初始化预览图，如果是img则直接显示，否则显示系统Img
        if (preview_img_init_val != "") {
            if (is_img(preview_img_init_val) == false) {
                display_icon(upload_obj);
            }else{
                upload_obj.node_img.attr('src', preview_img_init_val);
                display_img(upload_obj);
            }
            upload_obj.node_a_del.css('display', 'inline-block');
            handler.attr('sf-value', preview_img_init_val);
        }

        //给删除按钮增加监听事件
        upload_obj.node_a_del.on('click', function(){
            //移除img,移除icon，移除alert,清空sf-value,移除自身按钮
            upload_obj.node_img.css('display', 'none');
            upload_obj.node_icon.css('display', 'none');
            upload_obj.node_msg.css('display', 'none');
            handler.attr('sf-value', '');
            upload_obj.node_a_del.css('display', 'none');
        })
        
        return upload_obj;
    }


    /**
    *初始化文件上传（老版本）
    **/
    function event_upload_init(handler){
        var rand = Math.ceil(Math.random()*10000);
        var hidden_input = "hidden_file"+rand;
        var hidden_msg   = "hidden_msg"+rand;
        handler.attr("hidden_input_id", hidden_input);
        handler.append("<input type='file' id='"+hidden_input+"'>");
        handler.append("<div id='"+hidden_msg+"'></div>");
        if (typeof(handler.attr("value")) == undefined) {
            handler.attr("value", "");
        };

        var hidden_obj = new Object();
        hidden_obj.input = $("#"+hidden_input);
        hidden_obj.msg = $("#"+hidden_msg);
        hidden_obj.input_name = hidden_input;
        hidden_obj.msg_name = hidden_msg;
        return hidden_obj;
    }

    function event_save(handler){
        //begin 改版为使用公共收集参数的方法
        var controller  = _event_get_controller(handler);
        var param       = _event_collect_param(controller);
        //end

        //清空错误信息
        if (typeof(param._errer_display) == 'object') {
            param._errer_display.html("");
        }
            
        if (param._submit_method == "ajax") {
            $.ajax({
                url     : param._url,
                data    : param._param,
                type    : param._method,
                dataType: "json",
                success : function(json){
                    if (json.status !== undefined) {
                        if (json.status == 200) {
                            if (typeof(param._errer_display) == 'object') {
                                draw_msg(param._errer_display, 'success', json.msg);
                            }

                            if (typeof(handler.data.attr("sf-jump-action")) == "string" && handler.data.attr("sf-jump-action")!="") {
                                window.location.href = handler.data.attr("sf-jump-action");
                            }
                        }else{
                            if (typeof(param._errer_display) == 'object') {
                                draw_msg(param._errer_display, 'danger', json.msg);
                            }
                            
                            $('html, body').animate({scrollTop:0}, 'slow');
                        }
                    }else{
                        alert("json必须返回如下格式：{status:200, msg:xxx, data:...}");
                    }
                },
                error   : function(e){
                    
                }
            })
        }else if (param._submit_method == "form") {
            param._form.submit();
        }else{
            alert('不存在的表单提交方式，详见sf-submit-method');
        }

        delete param;
        delete controller;
    }


    function event_clear(handler){
        //查找自己的controller

        handler.data.parents().each(function(){
            // var parent_type = typeof($(this).attr("sf-controller"));
            // var parent_controller = $(this).attr("sf-controller");

            // if (parent_type == "string") {
            //  //搜集参数
            //  $(this).find("[sf-model]").each(function(){
            //      var name = $(this).attr("sf-model");
            //      var type = $(this).attr("type").toLowerCase();
            //      var value= "";

            //      switch (type){
            //          case "text":
            //              $(this).val("");
            //              break;
            //      }

            //  });
            //  return false; //each中的break
            // }
        });
    }

    //@now
    function event_table_list(handler, forceReload = true){
        controller = _event_get_controller(handler);
        param = _event_collect_param(controller);
        table_list_node = controller.find('table-list');
        if (table_list_node.size() <= 0) {
            alert('sf-controller='+controller.attr('sf-controller')+'内未定义table-list插件');
        }
        //是否重新加载表格头部，比如点击search按钮就需要，其他占时不需要
        event_draw_tablelist(table_list_node, forceReload);
        //转菊花准备开始发送
        var send_status = table_list_sending(table_list_node);
        if (send_status == false) {return;}
        //采集页码放入参数中，可能是瀑布加载，可能是页码加载
        param._param = table_list_get_page(table_list_node, param._param);
        //收集参数，发送请求，处理请求，渲染表格
        $.ajax({
            url     : table_list_node.attr('action'),
            data    : param._param,
            type    : 'post',
            dataType: "json",
            success : function(json){
                if (json.status !== undefined) {
                    if (json.status == 200) {
                        //清空loading tr
                        table_list_cancel_loading(table_list_node);
                        //开始画表格body中的tr啦
                        draw_table_list(table_list_node, json.data);
                        //画完后重新初始化一下绑定事件，注意不要初始化变量，方式sf-init覆盖掉用户填写的值
                        init_bind_event(false);
                    }else{
                        if (typeof(param._errer_display) == 'object') {
                            draw_msg(param._errer_display, 'warning', json.msg);
                        }
                        
                        $('html, body').animate({scrollTop:0}, 'slow');
                    }
                }else{
                    alert("json必须返回如下格式：{status:200, msg:xxx, data:...},详见data/table-list-base.php文件");
                }
            },
            error   : function(e){
                
            }
        })
    }


    /**
    *   公用方法，根据任意节点，获取它的controller
    **/
    function _event_get_controller(handler){
        var controller = new Object();
        if (typeof(handler.parents) == 'function') {
            
        }else{
            handler = handler.data;
        }
        handler.parents().each(function(){
            var parent_type = typeof($(this).attr("sf-controller"));

            if (parent_type == "string") {
                controller = $(this);
                return false; //each中的break，找到最近的一个controller就退出
            }
        });

        return controller;
    }


    /**
    *   公用方法，搜集表单的参数以及sf-name参数
    **/
    function _event_collect_param(controller){
        //查找自己的controller
        var collect_data = {
            _param:new Object(),//表单和sf-name参数
            _url:"",
            _method:"",
            _submit_method:"",
            _errer_display:"",
            _form:controller.find("form")
        };
        var _form = new Object();

        //查找显示错误信息的元素
        controller.find("[sf-display]").each(function(){
            collect_data._errer_display = $(this);
            return false;//退出each
        });
        //初始化一些变量
        _form = controller.find("form");
        //搜集URL、提交方式、
        collect_data._url = _form.attr('action');
        collect_data._method = _form.attr('method');
        if (typeof(collect_data._method) != 'string') {collect_data._method = 'get';}
        collect_data._submit_method = _form.attr('sf-submit-method');
        if (typeof(collect_data._submit_method) != 'string') {collect_data._submit_method = 'ajax';}

        //搜集参数
        collect_data._param = _form.serializeArray();

        //搜集一些特殊的参数
        controller.find("[sf-name]").each(function(){
            var name = $(this).attr("sf-name");
            var value= "";
            var node_name = $(this).get(0).tagName.toLowerCase();

            if (node_name == 'new-list') {
                value = new_list_obj.collect_value($(this));
            }else{
                value = $(this).attr("sf-value");
            }
            
            if (typeof(value) == 'undefined' || value=="") {
                value = '';
            }
            var _param_tmp = new Object();
            _param_tmp.name= name;
            _param_tmp.value = value;

            collect_data._param.push(_param_tmp);

        });

        if (typeof(collect_data._errer_display) == 'object') {
            collect_data._errer_display.html("");
        }

        return collect_data;
    }


    function event_upload(handler){
        file.uploadFile(handler.data);
    }

    function event_file(handler){
        file_new.uploadFile(handler.data);
    }


    $('#sub').click(function(){
        var name = $('#name').val();
        var _url = $('#form').attr('action');

        $.ajax({
            url     : _url,
            data    : {data:name},
            type    : "get",
            dataType: "json",
            success : function(json){
                alert(json.data.username)
            },
            error   : function(e){
                alert(e);
            }
        })
    });


    //公共方法 public method begin
    function draw_msg(handle_div, status, msg){
        handle_div.html('<div class="alert alert-'+status+'">\
                            <a href="#" class="close" data-dismiss="alert">&times;</a>\
                            <strong>'+msg+'</strong>\
                        </div>');
    }

    function is_img(file_name){
        var re = new RegExp("^[\\s\\S]*(.png|.jpg|.jpeg|.bmp|.gif)$");
        return re.test(file_name) ? true : false;
    }

    function display_icon(handler){
        handler.node_img.css('display', 'none');
        handler.node_icon.css('display', 'block');
    }

    function display_img(handler){
        handler.node_img.css('display', 'block');
        handler.node_icon.css('display', 'none');
    }

    //公共方法 end


    // file upload begin 

    file = new Object();
    file.uploadFile = function(_handler){
        var fd = new FormData();

        fd.append("file", document.getElementById(""+_handler.input_name).files[0]);
        var xhr = new XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(e){file.uploadProgress(e, _handler);}, false);
        xhr.addEventListener("load", function(e){file.uploadComplete(e, _handler)}, false);
        xhr.addEventListener("error", this.uploadFailed, false);
        xhr.addEventListener("abort", this.uploadCanceled, false);
        xhr.open("POST", _handler.div.attr("sf-upload-action"));
        document.getElementById(""+_handler.msg_name).innerHTML = '正在上传。。。';
        xhr.send(fd);
    }

    file.uploadProgress = function(evt, handler){
        if (evt.lengthComputable) {
        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
            document.getElementById(""+handler.msg_name).innerHTML = percentComplete.toString() + '%';
        }else {
            document.getElementById(""+handler.msg_name).innerHTML = 'unable to compute';
        }
    }

    file.uploadComplete = function (evt, handler) {
        if (evt.target.status == 200) {
            jsonobj = eval('(' + evt.target.responseText + ')');
            if (jsonobj.success) {
                document.getElementById(""+handler.msg_name).innerHTML = '上传成功';
                //把data中的url写入到sf-model中
                handler.div.attr("sf-value", jsonobj.file_url);
            }else{
                document.getElementById(""+handler.msg_name).innerHTML = jsonobj.message;
            }
        }else{
            document.getElementById(""+handler.msg_name).innerHTML = '上传失败，http状态码非200';
        }
    }

    file.uploadFailed = function(evt) {
        alert("There was an error attempting to upload the file.");
    }

    file.uploadCanceled = function(evt) {
        alert("The upload has been canceled by the user or the browser dropped the connection.");
    }

    //file upload end


    //file upload new version begin at 17/6/3
    file_new = new Object();
    file_new.uploadFile = function(_handler){
        var upload_url = "";
        if (typeof(_handler.node_input.attr('sf-upload-action'))!="undefined") {
            upload_url = _handler.node_input.attr('sf-upload-action');
        }
        if (upload_url == '') {
            file_new.draw_failed_msg(_handler, '未填写上传地址，请在input标签新增sf-upload-action属性');
            return false;
        }

        var fd = new FormData();

        fd.append("file", _handler.node_input[0].files[0]);

        var xhr = new XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(e){file_new.uploadProgress(e, _handler);}, false);
        xhr.addEventListener("load", function(e){file_new.uploadComplete(e, _handler)}, false);
        xhr.addEventListener("error", this.uploadFailed, false);
        xhr.addEventListener("abort", this.uploadCanceled, false);
        xhr.open("POST", upload_url);
        file_new.draw_success_msg(_handler, '正在上传。。。');
        xhr.send(fd);
    }

    file_new.uploadProgress = function(evt, handler){
        handler.node_msg.css('display', 'block');

        if (evt.lengthComputable) {
        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
            file_new.draw_success_msg(handler, '正在上传。。。' + percentComplete.toString() + '%');
        }else {
            file_new.draw_warning_msg(handler, '正在上传。。。无法计算上传进度');
        }
    }

    file_new.uploadComplete = function (evt, handler) {
        handler.node_msg.css('display', 'block');

        if (evt.target.status == 200) {
            jsonobj = eval('(' + evt.target.responseText + ')');
            if (jsonobj.success) {
                file_new.draw_success_msg(handler, "上传成功", jsonobj.file_url);
                file_new.draw_img_or_icon(handler, jsonobj.file_url);
                file_new.draw_del_btn(handler);
                //把data中的url写入到sf-model中
                handler.node_input.attr("sf-value", jsonobj.file_url);
            }else{
                file_new.draw_failed_msg(handler, jsonobj.message);
            }
        }else{
            file_new.draw_failed_msg(handler, '上传失败，http状态码:'+evt.target.status);
        }
    }

    file_new.uploadFailed = function(evt) {
        alert("There was an error attempting to upload the file.");
    }

    file_new.uploadCanceled = function(evt) {
        alert("The upload has been canceled by the user or the browser dropped the connection.");
    }

    file_new.draw_success_msg = function(handler, msg, url=''){
        handler.node_msg.removeClass('alert-warning');
        handler.node_msg.removeClass('alert-danger');
        handler.node_msg.addClass('alert-success');
        handler.node_msg.css('display', 'block');
        handler.node_msg.children('strong').html(msg+'<br>' + file_new.draw_msg_file_info(handler));
        if (url != '') {
            handler.node_msg.children('strong').next().attr('href', url);
            handler.node_msg.children('strong').next().html(url);
        }
    }

    file_new.draw_failed_msg = function(handler, msg){
        handler.node_msg.removeClass('alert-warning');
        handler.node_msg.removeClass('alert-success');
        handler.node_msg.addClass('alert-danger');
        handler.node_msg.css('display', 'block');
        handler.node_msg.children('strong').html(msg+'<br>' + file_new.draw_msg_file_info(handler));
    }

    file_new.draw_warning_msg = function(handler, msg){
        handler.node_msg.removeClass('alert-danger');
        handler.node_msg.removeClass('alert-success');
        handler.node_msg.addClass('alert-warning');
        handler.node_msg.css('display', 'block');
        handler.node_msg.children('strong').html(msg+'<br>' + file_new.draw_msg_file_info(handler));
    }

    file_new.draw_msg_file_info= function(handler){
        var file = handler.node_input[0].files[0];
        var out = '0.00 B';
        i = Math.floor(Math.log(file.size) / Math.log(1024));
        sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        out = (file.size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + sizes[i];

        var msg = '大小:'+out+'<br>文件:'+file.name+'<br>';
        return msg;
    }

    file_new.draw_img_or_icon = function(handler, img_url){
        if (is_img(handler.node_input[0].files[0].name) == false) {
            display_icon(handler);
        }else{
            handler.node_img.attr('src', img_url);
            display_img(handler);
        }
    }

    file_new.cancel_img = function(handler){
        handler.node_img.css('display', 'none');
    }

    file_new.draw_del_btn = function(handler){
        handler.node_a_del.css('display', 'inline-block');
    }

    //file upload new version end


    //table list begin

    function table_list_get_page(handler, param){
        var page_type = handler.attr('sf-pageloading');
        var page = 1;
        if (typeof(page_type) == 'undefined') {
            page = handler.attr('_sf_page');
        }
        var p = new Object();
        p.name = "page";
        p.value = page;
        param.push(p);
        return param;
    }

    //计算page放入handler的_sf_page属性中，并且加载loading
    function table_list_sending(handler){
        var status = handler.attr('_sf_status');

        if (status == 'loading') {
            return false;
        }        

        if (status == 'none') {
            return false;
        }else{
            //记录瀑布流的页数
            var page = handler.attr('_sf_page');
            if (typeof(page) == 'undefined' || page == '') {
                page = 1;
            }else{
                page = parseInt(page) + 1;
            }
            handler.attr('_sf_page', page);

            handler.attr('_sf_status', 'loading');

            //修改状态
            table_list_change_status(handler, '加载中...');

            return true;
        }
    }

    function table_list_change_status(handler, content){
        var list_column = eval('(' + handler.attr('list-column') + ')');
        var keys = Object.keys(list_column);
        var sending = '<tr class="odd gradeX"><td class="center" style="text-align:center" colspan="'+keys.length+'"><span>'+content+'</span></td></tr>';
        handler.children('table').children('tbody').append(sending);
    }

    function table_list_cancel_loading(handler){
        handler.children('table').children('tbody').children('tr:last-child').remove();
        handler.attr('_sf_status', 'ready');
    }

    function event_draw_init(handler){
        var auto_loading = handler.attr('auto-loading');
        if (typeof auto_loading != 'undefined') {
            event_table_list(handler, false);
        }

        var no_scrolling = handler.attr('no-scrolling');
        if(typeof no_scrolling == 'undefined'){
            $(document).on("mousewheel DOMMouseScroll", function (e) {
                var delta = (e.originalEvent.wheelDelta && (e.originalEvent.wheelDelta > 0 ? 1 : -1)) ||  // chrome & ie
                        (e.originalEvent.detail && (e.originalEvent.detail > 0 ? -1 : 1));              // firefox
                if (delta > 0) {
                    // 向上滚
                } else if (delta < 0) {
                    // 向下滚
                    //判断浏览器是否有滚动条
                    if (document.documentElement.clientHeight < document.documentElement.offsetHeight-4){
                        // alert('yes');
                        if ($(document).scrollTop() + window.innerHeight == $(document).height()) {
                            // alert('end');
                            event_table_list(handler, false);
                        }
                    }else{
                        // alert('none');
                        event_table_list(handler, false);
                    }
                }
            });
        }
    }

    function event_draw_tablelist(handler, forceReload = true){
        if (forceReload == false) {
            return ;
        }
        //画表格头部和字段
        //清空一下表格
        handler.html('');
        handler.attr('_sf_status', 'on');
        handler.attr('_sf_page', '0');
        //开始画
        var base_table = '<table class="table table-striped table-bordered table-hover" >\
                                <thead>\
                                <tr>\
                                </tr>\
                                </thead>\
                                <tbody>\
                                </tbody>\
                            </table>';
        handler.append(base_table);
        base_table  = handler.children('table');
        base_table_body   = base_table.children('tbody');
        list_column = eval('(' + handler.attr('list-column') + ')');
        //draw th
        for(var key in list_column){
            //draw hh
            var th = "";
            th = '<th>'+list_column[key]+'</th>';
            base_table.children('thead').children('tr').append(th);
        }
    }

    function draw_table_list(handler, data){
        list_column = eval('(' + handler.attr('list-column') + ')');
        base_table  = handler.children('table');
        base_table_body   = base_table.children('tbody');

        if (data.list.length <= 0) {
            handler.attr('_sf_status', 'none');
            table_list_change_status(handler, '暂无数据');
        }

        for(var i=0 ; i < data.list.length ; i++){
            //draw tr
            var tr = '<tr class="odd gradeX"></tr>';
            base_table_body.append(tr);

            //draw td
            for(key in list_column){
                // if (typeof(data.list[i][key]) == 'undefined') {alert('返回值中不存在key='+key);return false;}
                var td = '<td class="center">\
                            '+column_type(data.list[i][key])+'\
                        </td>';
                base_table_body.children('tr:last-child').append(td);
            }
        }

        //把画好了的显示出来
        // base_table.fadeIn(500);
    }

    /**
    *   处理每一个column
    **/
    function column_type(object){
        if (typeof(object) == 'string' || typeof(object) == 'number' || object== null) {
            return object;
        }else if (typeof(object) == 'object') {
            if (Array.isArray(object)) {
                var string = '';
                for(var i=0; i < object.length; i++){
                    string += column_single_cell(object[i]);
                }
                return string;
            }else{
                return column_single_cell(object);
            }
            
        }else{
            alert('不存在的column类型');
        }
    }

    /**
    *   处理每一个列中的每个cell(也就是每个opt)
    **/
    function column_single_cell(object){
        if (object.type == 'img') {
            return column_type_img(object);
        }else if (object.type == 'btn' || object.type == 'edit' || object.type == 'del') {
            return column_type_btn(object);
        }else if (object.type == 'string'){
            return column_type_string(object);
        }else if (object.type == 'label'){
            return column_type_label(object);
        }
    }

    function column_type_btn(object){
        href = confirm = need_del = '';
        switch (object.submit){
            case "ajax":
                href = '';
                break;

            case "form":
                href = 'href='+object.url;
                break;
        }

        if (object.type == 'del') {need_del = 'true'}
        if (object.confirm != '' && typeof(object.confirm) != 'undefined') {
            confirm = 'sf-click="confirm()" sf-confirm-content="'+object.confirm+'" sf-confirm-action="'+object.url+'" sf-confirm-need-del="'+need_del+'"';
        }else{
            confirm = 'href="'+object.url+'" ';
        }
        var string = '<a '+href+' '+confirm+' class="btn default btn-xs blue '+object.class+'" target="'+object.target+'">\
                    <i class="fa '+object.icon+'"></i>'+object.value+'</a>';

        return string;
    }

    function column_type_img(object){
        return '<img src="'+object.url+'" width="'+object.width+'" height="'+object.height+'"/>';
    }

    function column_type_label(object){
        var string = '<span class="label '+object.class+'">'+object.value+'</span>';
        return string;
    }

    function column_type_string(object){
        var string = '<span class="'+object.class+'">'+object.value+'</span>';
        return string;
    }

    //table list end


    //bootstrap modal begin 

    /**
    *   确认框，点击确定，返回true
    *   @return boool
    **/
    function modal_draw_confirm(){
        var html = '<div class="modal" tabindex="-1" role="dialog" id="sf-modal" sf-controller="modal-app">\
                  <div class="modal-dialog modal-sm" role="document">\
                    <div class="modal-content">\
                      <div class="modal-header">\
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <h4 class="modal-title" id="testsss">提示</h4>\
                      </div>\
                      <div class="modal-body">\
                        <p></p>\
                      </div>\
                      <div class="modal-footer">\
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>\
                        <button type="button" class="btn btn-primary" sf-click="send_confirm()">确定</button>\
                      </div>\
                    </div>\
                  </div>\
                </div>';
        $('body').append(html);
        return $('#sf-modal');
    }


    //new list
    new_list_obj = new Object();
    //收集新增框的value
    new_list_obj.collect_value = function(handler){
        var list_column = eval('(' + handler.attr('list-column') + ')');
        var base_table  = handler.children('._sf_none').children('table').children('tbody');
        var tr_value = new Array();

        var list_column_key_arr = new Array();
        for(var key in list_column){
            list_column_key_arr.push(key);
        }

        base_table.children('tr').each(function(){
            var cell = new Object();
            $(this).children('td').each(function(i){
                
                cell_value = $(this).children('input').val();
                if (typeof(cell_value) != 'undefined') {
                    cell_key   = list_column_key_arr[i];
                    cell[cell_key] = cell_value;
                }
            })
            tr_value.push(cell);
        });

        return JSON.stringify(tr_value);
    } 

    $("#testsss").click(function(){
        alert(33);
    });
    //bootstrap modal end

    

})

