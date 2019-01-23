<?php
/* Smarty version 3.1.30, created on 2017-08-11 17:55:19
  from "/Users/zhangxiong/work/www/my/elf/elf/app/view/layouts/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_598d7f07096472_69759190',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0264c5eb5c7c49e1fd52af6ca9e5d3de49c48ef1' => 
    array (
      0 => '/Users/zhangxiong/work/www/my/elf/elf/app/view/layouts/header.tpl',
      1 => 1502445317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_598d7f07096472_69759190 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
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
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/global/fonts/Open_Sans_400_300_600_700_subset_all.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout4/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>

<!-- sf css begin -->
<link rel="stylesheet" type="text/css" href="<?php echo WEB_DOMAIN;?>
/css/file_upload.css">
<!-- sf css end -->

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo WEB_DOMAIN;?>
/../favicon.ico"/>
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
				<img src="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout4/img/logo-light.png" alt="logo" class="logo-default"/>
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
						<li class="separator hide"></li>
						<!-- BEGIN NOTIFICATION DROPDOWN -->
						<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
						<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-bell"></i>
							<span class="badge badge-success">
							7 </span>
							</a>
							<ul class="dropdown-menu">
								<li class="external">
									<h3><span class="bold">12 pending</span> notifications</h3>
									<a href="extra_profile.html">view all</a>
								</li>
								<li>
									<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
										<li>
											<a href="javascript:;">
											<span class="time">just now</span>
											<span class="details">
											<span class="label label-sm label-icon label-success">
											<i class="fa fa-plus"></i>
											</span>
											New user registered. </span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="time">3 mins</span>
											<span class="details">
											<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
											</span>
											Server #12 overloaded. </span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="time">10 mins</span>
											<span class="details">
											<span class="label label-sm label-icon label-warning">
											<i class="fa fa-bell-o"></i>
											</span>
											Server #2 not responding. </span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="time">14 hrs</span>
											<span class="details">
											<span class="label label-sm label-icon label-info">
											<i class="fa fa-bullhorn"></i>
											</span>
											Application error. </span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="time">2 days</span>
											<span class="details">
											<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
											</span>
											Database overloaded 68%. </span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="time">3 days</span>
											<span class="details">
											<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
											</span>
											A user IP blocked. </span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="time">4 days</span>
											<span class="details">
											<span class="label label-sm label-icon label-warning">
											<i class="fa fa-bell-o"></i>
											</span>
											Storage Server #4 not responding dfdfdfd. </span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="time">5 days</span>
											<span class="details">
											<span class="label label-sm label-icon label-info">
											<i class="fa fa-bullhorn"></i>
											</span>
											System Error. </span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="time">9 days</span>
											<span class="details">
											<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
											</span>
											Storage server failed. </span>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<!-- END NOTIFICATION DROPDOWN -->
						<li class="separator hide"></li>
						<!-- BEGIN INBOX DROPDOWN -->
						<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
						<li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-envelope-open"></i>
							<span class="badge badge-danger">
							4 </span>
							</a>
							<ul class="dropdown-menu">
								<li class="external">
									<h3>You have <span class="bold">7 New</span> Messages</h3>
									<a href="page_inbox.html">view all</a>
								</li>
								<li>
									<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
										<li>
											<a href="inbox.html?a=view">
											<span class="photo">
											<img src="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout3/img/avatar2.jpg" class="img-circle" alt="">
											</span>
											<span class="subject">
											<span class="from">
											Lisa Wong </span>
											<span class="time">Just Now </span>
											</span>
											<span class="message">
											Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
											</a>
										</li>
										<li>
											<a href="inbox.html?a=view">
											<span class="photo">
											<img src="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout3/img/avatar3.jpg" class="img-circle" alt="">
											</span>
											<span class="subject">
											<span class="from">
											Richard Doe </span>
											<span class="time">16 mins </span>
											</span>
											<span class="message">
											Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
											</a>
										</li>
										<li>
											<a href="inbox.html?a=view">
											<span class="photo">
											<img src="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout3/img/avatar1.jpg" class="img-circle" alt="">
											</span>
											<span class="subject">
											<span class="from">
											Bob Nilson </span>
											<span class="time">2 hrs </span>
											</span>
											<span class="message">
											Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
											</a>
										</li>
										<li>
											<a href="inbox.html?a=view">
											<span class="photo">
											<img src="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout3/img/avatar2.jpg" class="img-circle" alt="">
											</span>
											<span class="subject">
											<span class="from">
											Lisa Wong </span>
											<span class="time">40 mins </span>
											</span>
											<span class="message">
											Vivamus sed auctor 40% nibh congue nibh... </span>
											</a>
										</li>
										<li>
											<a href="inbox.html?a=view">
											<span class="photo">
											<img src="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout3/img/avatar3.jpg" class="img-circle" alt="">
											</span>
											<span class="subject">
											<span class="from">
											Richard Doe </span>
											<span class="time">46 mins </span>
											</span>
											<span class="message">
											Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<!-- END INBOX DROPDOWN -->
						<li class="separator hide"></li>
						<!-- BEGIN TODO DROPDOWN -->
						<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
						<li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-calendar"></i>
							<span class="badge badge-primary">
							3 </span>
							</a>
							<ul class="dropdown-menu extended tasks">
								<li class="external">
									<h3>You have <span class="bold">12 pending</span> tasks</h3>
									<a href="page_todo.html">view all</a>
								</li>
								<li>
									<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
										<li>
											<a href="javascript:;">
											<span class="task">
											<span class="desc">New release v1.2 </span>
											<span class="percent">30%</span>
											</span>
											<span class="progress">
											<span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">40% Complete</span></span>
											</span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="task">
											<span class="desc">Application deployment</span>
											<span class="percent">65%</span>
											</span>
											<span class="progress">
											<span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">65% Complete</span></span>
											</span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="task">
											<span class="desc">Mobile app release</span>
											<span class="percent">98%</span>
											</span>
											<span class="progress">
											<span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">98% Complete</span></span>
											</span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="task">
											<span class="desc">Database migration</span>
											<span class="percent">10%</span>
											</span>
											<span class="progress">
											<span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">10% Complete</span></span>
											</span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="task">
											<span class="desc">Web server upgrade</span>
											<span class="percent">58%</span>
											</span>
											<span class="progress">
											<span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">58% Complete</span></span>
											</span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="task">
											<span class="desc">Mobile development</span>
											<span class="percent">85%</span>
											</span>
											<span class="progress">
											<span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">85% Complete</span></span>
											</span>
											</a>
										</li>
										<li>
											<a href="javascript:;">
											<span class="task">
											<span class="desc">New UI release</span>
											<span class="percent">38%</span>
											</span>
											<span class="progress progress-striped">
											<span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">38% Complete</span></span>
											</span>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<!-- END TODO DROPDOWN -->
						<!-- BEGIN USER LOGIN DROPDOWN -->
						<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
						<li class="dropdown dropdown-user dropdown-dark">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								<span class="username username-hide-on-mobile">
								Nick 
								</span>
								<!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
								<img alt="" class="img-circle" src="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout4/img/avatar9.jpg"/>
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
		<a href="./base_form.html">
		<i class="icon-paper-plane"></i>
		<span class="title">
		基础表单 </span>
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
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->

		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_929252925598d7f070652f0_56463611', 'body');
?>





		
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
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/respond.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/excanvas.min.js"><?php echo '</script'; ?>
> 
	<![endif]-->
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jquery.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"><?php echo '</script'; ?>
>
	<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
	<!-- <?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/morris/morris.min.js" type="text/javascript"><?php echo '</script'; ?>
> -->
	<!-- <?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/morris/raphael-min.js" type="text/javascript"><?php echo '</script'; ?>
> -->
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/global/scripts/metronic.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout4/scripts/layout.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/layout4/scripts/demo.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/pages/scripts/index3.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/theme/assets/admin/pages/scripts/tasks.js" type="text/javascript"><?php echo '</script'; ?>
>
	<!-- END PAGE LEVEL SCRIPTS -->


	<!-- 文件上传插件begin -->

	<link rel="stylesheet" type="text/css" href="<?php echo WEB_DOMAIN;?>
/css/file_upload.css">
	<!-- 文件上传插件end -->
	<?php echo '<script'; ?>
 src="<?php echo WEB_DOMAIN;?>
/js/sf.js" type="text/javascript"><?php echo '</script'; ?>
>
	
	<!-- <?php echo '<script'; ?>
 src="<?php echo '<?php ';?>echo Yii::$app->homeUrl <?php echo '?>';?>js/My97DatePicker/WdatePicker.js" type="text/javascript"><?php echo '</script'; ?>
> -->
	<?php echo '<script'; ?>
>
		jQuery(document).ready(function() {    
		   	Metronic.init(); // init metronic core componets
		   	Layout.init(); // init layout
		   	Demo.init(); // init demo features 
		    Index.init(); // init index page
		 	Tasks.initDashboardWidget(); // init tash dashboard widget  
		});
	<?php echo '</script'; ?>
>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

<?php }
/* {block 'body'} */
class Block_929252925598d7f070652f0_56463611 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'body'} */
}
