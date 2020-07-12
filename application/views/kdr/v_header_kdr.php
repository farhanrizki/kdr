<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Portal KDR</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- Ganti icon web -->
		<link rel="icon" href="<?php echo base_url();?>assets/images/logo-bri.png" type="image/ico">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.custom.min.css" />
		<?php if(isset($css_arr)): foreach($css_arr as $css): ?>
		     <link rel="stylesheet" href="<?php echo base_url('assets/css/'.$css); ?>" type="text/css" />
		<?php endforeach; endif; ?>
		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />

		<link href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>

		<!-- ckeditor -->
		<script src="<?php echo base_url();?>assets/libs/ckeditor/ckeditor/ckeditor.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<!--[if !IE]> -->
		<script src="<?php echo base_url();?>assets/js/jquery-2.2.4.min.js"></script>

		
		<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script src="assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.easypiechart.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.sparkline.index.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.pie.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.resize.min.js"></script>

		<!-- datatables	page specific plugin scripts -->
		<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/buttons.flash.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/buttons.print.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/buttons.colVis.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/dataTables.select.min.js"></script>

		<!-- plugin untuk export file di datatable -->
		<script src="<?php echo base_url();?>assets/js/pdfmake.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script>

		<?php	if(isset($js_arr)): foreach($js_arr as $js): ?>
			<script src="<?php echo base_url('assets/js/'.$js); ?>"></script>
		<?php endforeach; endif; ?>
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="<?php echo base_url('dashboard_kdr'); ?>" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							<span class="" id="id-text2">Portal KDR</span>
						</small>
					</a>
				</div><!-- /.navbar -->

				<div class="navbar-buttons navbar-header pull-right" role="navigation" >
					<ul class="nav ace-nav">
						<!-- ketika login -->
						<?php if (strtolower($level_kdr) == "superadmin"  
						|| strtolower($level_kdr) == "adminkdr" || strtolower($level_kdr) == "staffkdr" 
						|| strtolower($level_kdr) == "kabagkdr" 
						|| (strtolower($level_kdr) == "nonadmin" && strtolower($untuk_web_kdr) == "kdr")) { ?>
							<li class="light-blue dropdown-modal">
								<a data-toggle="dropdown" class="dropdown-toggle" style="cursor: pointer;">
									<img class="nav-user-photo" src="<?php echo base_url(); ?>assets/images/avatars/user.jpg" alt="Jason's Photo" />
									<span class="user-info">
										<small>Welcome,</small>
										<b>
											<?php 
												echo (ucfirst($nama_lengkap_kdr));						
											?>
										</b> 
									</span>
									<i class="ace-icon fa fa-caret-down"></i>
								</a>

								<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
									<li>
										<a href="<?php echo base_url('kdr/ubah_password'); ?>">
											<i class="fa fa-edit"></i>
											Ubah Password
										</a>
									</li>
									<li>
										<a href="<?php echo base_url('dashboard_kdr/logout'); ?>">
											<i class="ace-icon glyphicon glyphicon-off"></i>
											Logout
										</a>
									</li>
								</ul>
							</li>
						<!-- ketika tidak login -->
						<?php } else {  ?>
							<li class="light-blue dropdown-modal">
								<a data-toggle="dropdown" class="dropdown-toggle" style="cursor: pointer;">
									<img class="nav-user-photo" src="<?php echo base_url(); ?>assets/images/avatars/user.jpg" alt="Jason's Photo" />
									<span class="user-info">
										<small>Welcome,</small>
										<b> Guest</b> 
									</span>
									<i class="ace-icon fa fa-caret-down"></i>
								</a>

								<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
									<li>
										<a href="<?php echo base_url('kdr/login_kdr'); ?>">
											<i class="ace-icon glyphicon glyphicon-user"></i>
											Login
										</a>
									</li>
								</ul>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="main-container ace-save-state" id="main-container">	
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<ul class="nav nav-list">
					<?php if (strtolower($level_kdr) == "superadmin") { ?>
						<li class="">
							<a href="<?php echo base_url('dashboard_kdr'); ?>">
								<i class="menu-icon fa fa-tachometer"></i>
								<span class="menu-text"> Dashboard KDR</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/dashboard_risk'); ?>">
								<i class="menu-icon fa fa-bolt"></i>
								<span class="menu-text"> Dashboard Risk</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-hourglass-end"></i>
								<span class="menu-text"> Dashboard Monica</span>
							</a>
							<b class="arrow"></b>
						</li>
		            	<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-user-plus"></i>
								<span class="menu-text">Manajemen User</span>
								<b class="arrow fa fa-angle-down"></b>
							</a>

							<b class="arrow"></b>
							<ul class="submenu">
								<li class="">
									<a href="<?php echo site_url('kdr/manajemen_khusus')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Manajemen Khusus
									</a>
									<b class="arrow"></b>
								</li>
								<li class="">
									<a href="<?php echo site_url('kdr/manajemen_user_kdr')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Manajemen User Kdr
									</a>
									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="<?php echo site_url('kdr/manajemen_user_risk')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Manajemen User Risk
									</a>
									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="<?php echo site_url('kdr/manajemen_user_monica')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Manajemen User Monica
									</a>
									<b class="arrow"></b>
								</li>
							</ul>
						</li>

					<?php } else if (strtolower($level_kdr) == "adminkdr" || strtolower($level_kdr) == "staffkdr" || strtolower($level_kdr) == "kabagkdr") { ?>
						<li class="">
							<a href="<?php echo base_url('dashboard_kdr'); ?>">
								<i class="menu-icon fa fa-tachometer"></i>
								<span class="menu-text"> Dashboard KDR</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/dashboard_risk'); ?>">
								<i class="menu-icon fa fa-bolt"></i>
								<span class="menu-text"> Dashboard Risk</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-hourglass-end"></i>
								<span class="menu-text"> Dashboard Monica</span>
							</a>
							<b class="arrow"></b>
						</li>
		            	<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-cogs"></i>
								<span class="menu-text"> Patching </span>
								<b class="arrow fa fa-angle-down"></b>
							</a>

							<b class="arrow"></b>

							<ul class="submenu">
								<li class="">
									<a href="<?php echo base_url('kdr/patching_resume')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Resume
									</a>
									<b class="arrow"></b>
								</li>
								<li class="">
									<a href="<?php echo base_url('kdr/patching_divisi')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Divisi
									</a>
									<b class="arrow"></b>
								</li>
								<li class="">
									<a href="<?php echo base_url('kdr/patching_personal')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Personal
									</a>
									<b class="arrow"></b>
								</li>
								<li class="">
									<a href="<?php echo base_url('kdr/patching_uker')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Uker
									</a>
									<b class="arrow"></b>
								</li>
							</ul>
						</li>
						<!--<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-folder"></i>
								<span class="menu-text"> Report </span>

								<b class="arrow fa fa-angle-down"></b>
							</a>
							<b class="arrow"></b>

							<ul class="submenu">
								<li class="">
									<a href="<?php echo site_url('kdr/report_kdr')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										KDR
									</a>
									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="<?php echo site_url('kdr/report_opt')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										OPT
									</a>
									<b class="arrow"></b>
								</li>
							</ul>
						</li>-->
						<li class="">
							<a href="<?php echo base_url('kdr/dispo_dio'); ?>">
								<i class="menu-icon fa fa-codepen"></i>
								<span class="menu-text"> Dispo Dio </span>
								<span class="badge badge-primary"><?php echo $notif_dispo; ?></span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('kdr/kegiatan'); ?>">
								<i class="menu-icon fa fa-arrows-alt"></i>
								<span class="menu-text"> Kegiatan </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('kdr/surat_keluar'); ?>">
								<i class="menu-icon fa fa-paper-plane"></i>
								<span class="menu-text"> Surat Keluar </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('../../../kpiopt/'); ?>">
								<i class="menu-icon fa fa-television"></i>
								<span class="menu-text"> KPI OPT </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('../../../scriptpedia/'); ?>">
								<i class="menu-icon fa fa-pencil-square-o"></i>
								<span class="menu-text"> Scriptpedia </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('all_dashboard'); ?>" target="_blank">
								<i class="menu-icon fa fa-area-chart"></i>
								<span class="menu-text"> All Dashboard</span>
							</a>
							<b class="arrow"></b>
						</li>
					
					<?php } else if (strtolower($level_kdr) == "nonadmin" && strtolower($untuk_web_kdr) != "kdr") { ?>
						<li class="">
							<a href="<?php echo base_url('dashboard_kdr'); ?>">
								<i class="menu-icon fa fa-tachometer"></i>
								<span class="menu-text"> Dashboard KDR</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-hourglass-end"></i>
								<span class="menu-text"> Dashboard Monica</span>
							</a>
							<b class="arrow"></b>
						</li>

					<?php } else { ?>
						<li class="">
							<a href="<?php echo base_url('dashboard_kdr'); ?>">
								<i class="menu-icon fa fa-tachometer"></i>
								<span class="menu-text"> Dashboard KDR</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/dashboard_risk'); ?>">
								<i class="menu-icon fa fa-bolt"></i>
								<span class="menu-text"> Dashboard Risk</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-hourglass-end"></i>
								<span class="menu-text"> Dashboard Monica</span>
							</a>
							<b class="arrow"></b>
						</li>
		            	<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-cogs"></i>
								<span class="menu-text"> Patching </span>
								<b class="arrow fa fa-angle-down"></b>
							</a>

							<b class="arrow"></b>

							<ul class="submenu">
								<li class="">
									<a href="<?php echo base_url('kdr/patching_resume')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Resume
									</a>
									<b class="arrow"></b>
								</li>
								<li class="">
									<a href="<?php echo base_url('kdr/patching_divisi')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Divisi
									</a>
									<b class="arrow"></b>
								</li>
								<li class="">
									<a href="<?php echo base_url('kdr/patching_uker')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Uker
									</a>
									<b class="arrow"></b>
								</li>
							</ul>
						</li>
						<li class="">
							<a href="<?php echo base_url('../../../kpiopt/'); ?>">
								<i class="menu-icon fa fa-television"></i>
								<span class="menu-text"> KPI OPT </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('../../../scriptpedia/'); ?>">
								<i class="menu-icon fa fa-pencil-square-o"></i>
								<span class="menu-text"> Scriptpedia </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('all_dashboard'); ?>" target="_blank">
								<i class="menu-icon fa fa-area-chart"></i>
								<span class="menu-text"> All Dashboard</span>
							</a>
							<b class="arrow"></b>
						</li>
						<!--<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-folder"></i>
								<span class="menu-text"> Report </span>

								<b class="arrow fa fa-angle-down"></b>
							</a>
							<b class="arrow"></b>

							<ul class="submenu">
								<li class="">
									<a href="<?php echo site_url('kdr/report_kdr')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										KDR
									</a>
									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="<?php echo site_url('kdr/report_opt')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										OPT
									</a>
									<b class="arrow"></b>
								</li>
							</ul>
						</li>-->
					<?php } ?>
				</ul>

				<!--<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-right ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>-->
			</div>