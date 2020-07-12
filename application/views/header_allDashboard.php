<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>All Dashboard</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- Ganti icon web -->
		<link rel="icon" href="<?php echo base_url();?>assets/images/logo-bri.png" type="image/ico">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />
		<script src="<?php echo base_url();?>assets/js/jquery-2.2.4.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<link rel="stylesheet" href="<?php echo base_url();?>assets/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/jquery.circliful.css">
		<script src="<?php echo base_url();?>assets/jquery.circliful.js"></script>
		<script src="<?php echo base_url();?>assets/js/globalize.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/dx.chartjs.js"></script>
		<script src="<?php echo base_url();?>assets/js/fusionchart/fusioncharts.js"></script>
		<script src="<?php echo base_url();?>assets/js/fusionchart/themes/fusioncharts.theme.fusion.js"></script>
	</head>

	<body class="no-skin" style="background-color: #030303;">
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
				</div>
			</div>
		</div>

		<div class="main-container ace-save-state" id="main-container">	
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>