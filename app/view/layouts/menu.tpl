<{extends file='../layouts/main.tpl'}>
<{block name=menu}>
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
<{/block}>