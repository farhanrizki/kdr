<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Monica</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- Ganti icon web -->
		<link rel="icon" href="<?php echo base_url();?>assets/images/logo-bri.png" type="image/ico">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.custom.min.css" />

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
					<a href="<?php echo base_url('monica/dashboard_monica'); ?>" class="navbar-brand">
						<small>
							<i class="fa fa-sort-amount-desc"></i>
							<span class="" id="id-text2">Monica APP</span>
						</small>
					</a>
				</div><!-- /.navbar -->

				<div class="navbar-buttons navbar-header pull-right" role="navigation" >
					<ul class="nav ace-nav">

						<!-- ketika login -->
						<?php if (strtolower($level_monica) == "adminkdr" || strtolower($level_monica) == "staffkdr" 
						|| strtolower($level_monica) == "kabagkdr") { ?>
							<li class="purple dropdown-modal">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<i class="ace-icon fa fa-bell icon-animated-bell"></i>
									<?php if($tidakmemadai != "0" && $dalampemantauan != "0"){ ?>
										<span class="badge badge-important">2</span>
									<?php }else if($tidakmemadai != "0" && $dalampemantauan == "0"){ ?>
										<span class="badge badge-important">1</span>
									<?php }else if($tidakmemadai == "0" && $dalampemantauan != "0"){ ?>
										<span class="badge badge-important">1</span>
									<?php }else{} ?>
								</a>

								<?php if($tidakmemadai != "0" || $dalampemantauan != "0") { ?>
								<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
									<li class="dropdown-content">
										<ul class="dropdown-menu dropdown-navbar navbar-pink">
											<?php if($tidakmemadai != "0") { ?>
											<li>
												<a href="<?php echo base_url('monica/data_audit_internal/lihat_data_langsung/'.$id_tidakmemadai); ?>">
													<div class="clearfix">
														<span class="pull-left">
															<i class="ace-icon fa fa-exclamation-triangle"></i>
															<?php echo $tidakmemadai; ?> Temuan Tidak Memadai
														</span>
													</div>
												</a>
											</li>
											<?php } else {} ?>

											<?php if($dalampemantauan != "0") { ?>
											<li>
												<a href="<?php echo base_url('monica/data_audit_internal/lihat_data_langsung/'.$id_dalampemantauan); ?>">
													<div class="clearfix">
														<span class="pull-left">
															<i class="ace-icon fa fa-exclamation-triangle"></i>
															<?php echo $dalampemantauan; ?> Temuan Dalam Pemantauan
														</span>
													</div>
												</a>
											</li>
											<?php } else {} ?>										
										</ul>
									</li>
								</ul>
								<?php }else{} ?>
							</li>
						<?php }else{} ?>

						<!-- ketika login -->
						<?php if (strtolower($level_monica) == "superadmin"  
						|| strtolower($level_monica) == "adminkdr" || strtolower($level_monica) == "staffkdr" 
						|| strtolower($level_monica) == "kabagkdr" 
						|| (strtolower($level_monica) == "nonadmin" && strtolower($untuk_web_monica) == "monica"))  { ?>
							<li class="light-blue dropdown-modal">
								<a data-toggle="dropdown" class="dropdown-toggle" style="cursor: pointer;">
									<img class="nav-user-photo" src="<?php echo base_url(); ?>assets/images/avatars/user.jpg" alt="Jason's Photo" />
									<span class="user-info">
										<small>Welcome,</small>
										<b>
											<?php 
												echo (ucfirst($nama_lengkap_monica));						
											?>
										</b> 
									</span>
									<i class="ace-icon fa fa-caret-down"></i>
								</a>

								<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
									<li>
										<a href="<?php echo base_url('monica/ubah_password'); ?>">
											<i class="fa fa-edit"></i>
											Ubah Password
										</a>
									</li>
									<li>
										<a href="<?php echo base_url('monica/dashboard_monica/logout'); ?>">
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
										<a href="<?php echo base_url('monica/login_monica'); ?>">
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
					<?php if (strtolower($level_monica) == "adminkdr" || strtolower($level_monica) == "staffkdr"
					|| strtolower($level_monica) == "kabagkdr") { ?>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-television"></i>
								<span class="menu-text">Dashboard Monica</span>
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
							<a href="<?php echo base_url('risk/dashboard_risk'); ?>">
								<i class="menu-icon fa fa-bolt"></i>
								<span class="menu-text"> Dashboard Risk </span>
							</a>
							<b class="arrow"></b>
						</li>

						<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-clone"></i>
								<span class="menu-text"> Audit </span>

								<b class="arrow fa fa-angle-down"></b>
							</a>
							<b class="arrow"></b>
							<ul class="submenu">
								<li class="">
									<a href="<?php echo site_url('monica/data_audit_internal')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Audit Internal
									</a>
									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="<?php echo site_url('monica/data_audit_eksternal')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Audit Eksternal
									</a>
									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="<?php echo site_url('monica/audit_report')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Audit Report
									</a>
									<b class="arrow"></b>
								</li>
							</ul>
						</li>

						<!--<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-clone"></i>
								<span class="menu-text"> Audit </span>
								<b class="arrow fa fa-angle-down"></b>
							</a>

							<b class="arrow"></b>

							<ul class="submenu">
								<li class="">
									<a href="#" class="dropdown-toggle">
										<i class="menu-icon fa fa-caret-right"></i>
										Audit Internal
										<b class="arrow fa fa-angle-down"></b>
									</a>

									<b class="arrow"></b>

									<ul class="submenu">
										<li class="">
											<a href="<?php echo site_url('monica/tl_internal')?>">
												<i class="menu-icon fa fa-caret-right"></i>
												Tindak Lanjut Audit Internal
											</a>
										</li>
										<li class="">
											<a href="<?php echo site_url('monica/data_audit_internal')?>">
												<i class="menu-icon fa fa-caret-right"></i>
												Data Audit Internal
											</a>
										</li>
									</ul>
								</li>

								<li class="">
									<a href="#" class="dropdown-toggle">
										<i class="menu-icon fa fa-caret-right"></i>
										Audit Eksternal
										<b class="arrow fa fa-angle-down"></b>
									</a>

									<b class="arrow"></b>

									<ul class="submenu">
										<li class="">
											<a href="<?php echo site_url('monica/tl_eksternal')?>">
												<i class="menu-icon fa fa-caret-right"></i>
												Tindak Lanjut Audit Eksternal
											</a>
										</li>
										<li class="">
											<a href="<?php echo site_url('monica/data_audit_eksternal')?>">
												<i class="menu-icon fa fa-caret-right"></i>
												Data Audit Eksternal
											</a>
										</li>
									</ul>
								</li>

								<li class="">
									<a href="<?php echo site_url('monica/audit_report')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Audit Report
									</a>
									<b class="arrow"></b>
								</li>
							</ul>
						</li>-->
						<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-hourglass-half"></i>
								<span class="menu-text">Compliance</span>
								<b class="arrow fa fa-angle-down"></b>
							</a>

							<b class="arrow"></b>
							<ul class="submenu">
								<li class="">
									<a href="<?php echo site_url('monica/khasanah_internal')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Khasanah Internal
									</a>
									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="<?php echo site_url('monica/khasanah_eksternal')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Khasanah Eksternal
									</a>
									<b class="arrow"></b>
								</li>
							</ul>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/contact_us'); ?>">
								<i class="menu-icon fa fa-bookmark-o"></i>
								<span class="menu-text">Contact Us</span>
							</a>
						</li>

					<?php } else if (strtolower($level_monica) == "superadmin" ) { ?>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-television"></i>
								<span class="menu-text">Dashboard Monica</span>
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
							<a href="<?php echo base_url('risk/dashboard_risk'); ?>">
								<i class="menu-icon fa fa-bolt"></i>
								<span class="menu-text"> Dashboard Risk </span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/manajemen_user'); ?>">
								<i class="menu-icon fa fa-user-plus"></i>
								<span class="menu-text">Manajemen User</span>
							</a>
						</li>

					<?php } else if (strtolower($level_monica) == "nonadmin" && $untuk_web_monica == "monica") { ?>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-television"></i>
								<span class="menu-text">Dashboard Monica</span>
							</a>
							<b class="arrow"></b>
						</li>
						<li class="">
							<a href="#" class="dropdown-toggle">
								<i class="menu-icon fa fa-clone"></i>
								<span class="menu-text"> Audit </span>

								<b class="arrow fa fa-angle-down"></b>
							</a>
							<b class="arrow"></b>
							<ul class="submenu">
								<li class="">
									<a href="<?php echo site_url('monica/data_audit_internal')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Audit Internal
									</a>
									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="<?php echo site_url('monica/data_audit_eksternal')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Audit Eksternal
									</a>
									<b class="arrow"></b>
								</li>

								<li class="">
									<a href="<?php echo site_url('monica/audit_report')?>">
										<i class="menu-icon fa fa-caret-right"></i>
										Audit Report
									</a>
									<b class="arrow"></b>
								</li>
							</ul>
						</li>
						<li class="">
							<a href="<?php echo base_url('monica/contact_us'); ?>">
								<i class="menu-icon fa fa-bookmark-o"></i>
								<span class="menu-text">Contact Us</span>
							</a>
						</li>

					<?php } else { ?>
						<li class="">
							<a href="<?php echo base_url('monica/dashboard_monica'); ?>">
								<i class="menu-icon fa fa-television"></i>
								<span class="menu-text">Dashboard Monica</span>
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
							<a href="<?php echo base_url('risk/dashboard_risk'); ?>">
								<i class="menu-icon fa fa-bolt"></i>
								<span class="menu-text"> Dashboard Risk </span>
							</a>
							<b class="arrow"></b>
						</li>
					<?php } ?>
				</ul>

				<!--<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>-->
			</div>