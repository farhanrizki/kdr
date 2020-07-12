<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Risk Profile</title>

		<meta name="description" content="Risk Profile" />
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
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>" class="navbar-brand">
						<small>
							<i class="fa fa-cogs"></i>
							<span class="" id="id-text2">Risk Profile</span>
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<!-- ketika login -->
						<?php if (strtolower($level_risk) == "superadmin"  || strtolower($level_risk) == "adminkdr" 
						|| strtolower($level_risk) == "staffkdr" || strtolower($level_risk) == "kabagkdr"
						|| (strtolower($level_risk) == "nonadmin" && strtolower($untuk_web_risk) == "risk")) { ?>
							<li class="light-blue dropdown-modal">
								<a data-toggle="dropdown" class="dropdown-toggle" style="cursor: pointer;">
									<img class="nav-user-photo" src="<?php echo base_url(); ?>assets/images/avatars/guest.png" alt="Jason's Photo" />
									<span class="user-info">
										<small>Welcome,</small>
										<b>
											<?php 
												echo (ucfirst($nama_lengkap_risk));						
											?>
										</b> 
									</span>
									<i class="ace-icon fa fa-caret-down"></i>
								</a>

								<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
									<li>
										<a href="<?php echo base_url('risk/ubah_password'); ?>">
											<i class="fa fa-edit"></i>
											Ubah Password
										</a>
									</li>
									<li>
										<a href="<?php echo base_url('risk/dashboard_risk/logout'); ?>">
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
									<img class="nav-user-photo" src="<?php echo base_url(); ?>assets/images/avatars/guest.png" alt="Jason's Photo" />
									<span class="user-info">
										<small>Welcome,</small>
										<b> Guest</b> 
									</span>
									<i class="ace-icon fa fa-caret-down"></i>
								</a>

								<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
									<li>
										<a href="<?php echo base_url('risk/login_risk'); ?>">
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
					<?php if (strtolower($level_risk) == "adminkdr") { ?>
						<li class="">
							<a href="<?php echo base_url('risk/dashboard_risk'); ?>">
								<i class="menu-icon fa fa-bar-chart-o"></i>
								<span class="menu-text"> Dashboard Risk</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('dashboard_kdr'); ?>">
								<i class="menu-icon fa fa-tachometer"></i>
								<span class="menu-text"> Dashboard KDR </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-hourglass-end"></i>
								<span class="menu-text"> Dashboard Monica </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/risk_issue'); ?>">
								<i class="menu-icon fa fa-cloud"></i>
								<span class="menu-text">Risk Issue</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/risk_assessment'); ?>">
								<i class="menu-icon glyphicon glyphicon-check"></i>
								<span class="menu-text">Risk Assessment</span>
							</a>	
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/edit_bobot'); ?>">
								<i class="menu-icon fa fa-book"></i>
								<span class="menu-text">Edit Bobot</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/penilaian_kontrol'); ?>">
								<i class="menu-icon glyphicon glyphicon-time"></i>
								<span class="menu-text">Penilaian Kontrol</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/persetujuan'); ?>">
								<i class="menu-icon fa fa-bars"></i>
								<span class="menu-text">Persetujuan</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/eksport_excel'); ?>">
								<i class="menu-icon fa fa-download"></i>
								<span class="menu-text">Export Excel</span>
							</a>
						</li>

					<?php } else if (strtolower($level_risk) == "staffkdr" || strtolower($level_risk) == "kabagkdr") { ?>
						<li class="">
							<a href="<?php echo base_url('risk/dashboard_risk'); ?>">
								<i class="menu-icon fa fa-bar-chart-o"></i>
								<span class="menu-text"> Dashboard Risk</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('dashboard_kdr'); ?>">
								<i class="menu-icon fa fa-tachometer"></i>
								<span class="menu-text"> Dashboard KDR </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-hourglass-end"></i>
								<span class="menu-text"> Dashboard Monica </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/risk_issue'); ?>">
								<i class="menu-icon fa fa-cloud"></i>
								<span class="menu-text">Risk Issue</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/risk_assessment'); ?>">
								<i class="menu-icon glyphicon glyphicon-check"></i>
								<span class="menu-text">Risk Assessment</span>
							</a>	
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/edit_bobot'); ?>">
								<i class="menu-icon fa fa-book"></i>
								<span class="menu-text">Edit Bobot</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/penilaian_kontrol'); ?>">
								<i class="menu-icon glyphicon glyphicon-time"></i>
								<span class="menu-text">Penilaian Kontrol</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/persetujuan'); ?>">
								<i class="menu-icon fa fa-bars"></i>
								<span class="menu-text">Persetujuan</span>
							</a>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/eksport_excel'); ?>">
								<i class="menu-icon fa fa-download"></i>
								<span class="menu-text">Export Excel</span>
							</a>
						</li>

						<li class="">
		                    <a href="#" class="dropdown-toggle">
		                        <i class="menu-icon fa fa-dashcube"></i>
		                        <span class="menu-text"> Risk By Apps </span>
		                        <b class="arrow fa fa-angle-down"></b>
		                    </a>
		                    <b class="arrow"></b>

		                    <ul class="submenu">
		                    	<li class="">
		                            <a href="<?php echo base_url('risk/monitoring')?>">
	                                    <i class="menu-icon fa fa-caret-right"></i>
	                                    Monitoring
		                            </a>
		                            <b class="arrow"></b>
		                        </li>
		                        <li class="">
		                            <a href="<?php echo base_url('risk/list_risk')?>">
	                                    <i class="menu-icon fa fa-caret-right"></i>
	                                    List Risk
		                            </a>
		                            <b class="arrow"></b>
		                        </li>
		                        <li class="">
		                            <a href="<?php echo base_url('risk/kategori_risk')?>">
	                                    <i class="menu-icon fa fa-caret-right"></i>
	                                    Kategori Risk
		                            </a>
		                            <b class="arrow"></b>
		                        </li>
		                        <li class="">
		                            <a href="<?php echo base_url('risk/app_server')?>">
	                                    <i class="menu-icon fa fa-caret-right"></i>
	                                    Aplikasi dan Server
		                            </a>
		                            <b class="arrow"></b>
		                        </li>
		                    </ul>
		            	</li>

					<?php } else if (strtolower($level_risk) == "superadmin" ) { ?>
						<li class="">
							<a href="<?php echo base_url('risk/dashboard_risk'); ?>">
								<i class="menu-icon fa fa-bar-chart-o"></i>
								<span class="menu-text"> Dashboard Risk</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('dashboard_kdr'); ?>">
								<i class="menu-icon fa fa-tachometer"></i>
								<span class="menu-text"> Dashboard KDR </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-hourglass-end"></i>
								<span class="menu-text"> Dashboard Monica </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('risk/manajemen_user'); ?>">
								<i class="menu-icon fa fa-user-plus"></i>
								<span class="menu-text">Manajemen User</span>
							</a>
						</li>

					<?php } else if (strtolower($level_risk) == "nonadmin" && strtolower($untuk_web_risk) != "risk") { ?>
						<li class="">
							<a href="<?php echo base_url('risk/dashboard_risk'); ?>">
								<i class="menu-icon fa fa-bar-chart-o"></i>
								<span class="menu-text"> Dashboard Risk</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-hourglass-end"></i>
								<span class="menu-text"> Dashboard Monica </span>
							</a>
							<b class="arrow"></b>
						</li>

					<?php } else { ?>
						<li class="">
							<a href="<?php echo base_url('risk/dashboard_risk'); ?>">
								<i class="menu-icon fa fa-bar-chart-o"></i>
								<span class="menu-text"> Dashboard Risk</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('dashboard_kdr'); ?>">
								<i class="menu-icon fa fa-tachometer"></i>
								<span class="menu-text"> Dashboard KDR </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-hourglass-end"></i>
								<span class="menu-text"> Dashboard Monica </span>
							</a>
							<b class="arrow"></b>
						</li>
					<?php } ?>
				</ul>

				<!--<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>-->
			</div>