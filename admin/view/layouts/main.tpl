<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | Admin Dashboard Template</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<{WEB_DOMAIN}>/theme/assets/global/fonts/Open_Sans_400_300_600_700_subset_all.css" rel="stylesheet" type="text/css"/>
<link href="<{WEB_DOMAIN}>/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<{WEB_DOMAIN}>/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<{WEB_DOMAIN}>/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<{WEB_DOMAIN}>/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<{WEB_DOMAIN}>/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<{WEB_DOMAIN}>/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<{WEB_DOMAIN}>/theme/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="<{WEB_DOMAIN}>/theme/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="<{WEB_DOMAIN}>/theme/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="<{WEB_DOMAIN}>/theme/assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<{WEB_DOMAIN}>/theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<{WEB_DOMAIN}>/theme/assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<{WEB_DOMAIN}>/theme/assets/admin/layout4/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<{WEB_DOMAIN}>/theme/assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>

<!-- sf css begin -->
<link rel="stylesheet" type="text/css" href="<{WEB_DOMAIN}>/css/file_upload.css">
<!-- sf css end -->

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<{WEB_DOMAIN}>/../favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-sidebar-closed-hide-logo ppage-sidebar-closed-hide-logo">
	<!-- BEGIN HEADER -->
	<div class="page-header navbar navbar-fixed-top">
		<!-- BEGIN HEADER INNER -->
		<div class="page-header-inner">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="index.html">
				<img src="<{WEB_DOMAIN}>/theme/assets/admin/layout4/img/logo-light.png" alt="logo" class="logo-default"/>
				</a>
				<div class="menu-toggler sidebar-toggler">
					<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
				</div>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
			</a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN PAGE ACTIONS -->
			<!-- DOC: Remove "hide" class to enable the page header actions -->
			<div class="page-actions">
				<div class="btn-group">
					<button type="button" class="btn btn-transparent btn-default btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<span class="hidden-sm hidden-xs">Actions&nbsp;</span><i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="#">
							<i class="icon-docs"></i> New Post </a>
						</li>
						<li>
							<a href="#">
							<i class="icon-tag"></i> New Comment </a>
						</li>
						<li>
							<a href="#">
							<i class="icon-share"></i> Share </a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="#">
							<i class="icon-flag"></i> Comments <span class="badge badge-success">4</span>
							</a>
						</li>
						<li>
							<a href="#">
							<i class="icon-users"></i> Feedbacks <span class="badge badge-danger">2</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- END PAGE ACTIONS -->
			<!-- BEGIN PAGE TOP -->
			<div class="page-top">
				<!-- BEGIN HEADER SEARCH BOX -->
				<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
				<form class="search-form" action="extra_search.html" method="GET">
					<div class="input-group">
						<input type="text" class="form-control input-sm" placeholder="Search..." name="query">
						<span class="input-group-btn">
						<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
						</span>
					</div>
				</form>
				<!-- END HEADER SEARCH BOX -->
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
					
						<!-- END TODO DROPDOWN -->
						<!-- BEGIN USER LOGIN DROPDOWN -->
						<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
						<li class="dropdown dropdown-user dropdown-dark">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<span class="username username-hide-on-mobile">
								Nick 
								</span>
								<!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
								<img alt="" class="img-circle" src="<{WEB_DOMAIN}>/theme/assets/admin/layout4/img/avatar9.jpg"/>
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<a href="extra_profile.html">
									<i class="icon-user"></i> My Profile </a>
								</li>
								<li>
									<a href="page_calendar.html">
									<i class="icon-calendar"></i> My Calendar </a>
								</li>
								<li>
									<a href="inbox.html">
									<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
									3 </span>
									</a>
								</li>
								<li>
									<a href="page_todo.html">
									<i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
									7 </span>
									</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="extra_lock.html">
									<i class="icon-lock"></i> Lock Screen </a>
								</li>
								<li>
									<a href="login.html">
									<i class="icon-key"></i> Log Out </a>
								</li>
							</ul>
						</li>
						<!-- END USER LOGIN DROPDOWN -->
					</ul>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
			<!-- END PAGE TOP -->
		</div>
		<!-- END HEADER INNER -->
	</div>
	<!-- END HEADER -->
	<div class="clearfix"></div>
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
				<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
				<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
				<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
				<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
				<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
				<{block name=menu}><{/block}>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->

		<{block name=body}><{/block}>
	
		<!-- END CONTENT -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="page-footer">
		<div class="page-footer-inner">
			2017 &copy; simple frame by allen
		</div>
		<div class="scroll-to-top">
			<i class="icon-arrow-up"></i>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/respond.min.js"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
	<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
	<!-- <script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script> -->
	<!-- <script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script> -->
	<script src="<{WEB_DOMAIN}>/theme/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<{WEB_DOMAIN}>/theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/admin/pages/scripts/index3.js" type="text/javascript"></script>
	<script src="<{WEB_DOMAIN}>/theme/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->


	<!-- 文件上传插件begin -->

	<link rel="stylesheet" type="text/css" href="<{WEB_DOMAIN}>/css/file_upload.css">
	<!-- 文件上传插件end -->
	<script src="<{WEB_DOMAIN}>/js/sf.js" type="text/javascript"></script>
	
	<!-- <script src="<?php echo Yii::$app->homeUrl ?>js/My97DatePicker/WdatePicker.js" type="text/javascript"></script> -->
	<script>
		jQuery(document).ready(function() {    
		   	Metronic.init(); // init metronic core componets
		   	Layout.init(); // init layout
		   	Demo.init(); // init demo features 
		    Index.init(); // init index page
		 	Tasks.initDashboardWidget(); // init tash dashboard widget  
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

