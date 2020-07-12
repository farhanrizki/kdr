<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login Page - Portal KDR</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />
	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-leaf green"></i>
									<span class="red" id="id-text2">OPT</span>
									<span class="black" id="id-text2">KDR</span>
								</h1>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Masukkan Data Anda
											</h4>

											<div class="space-6"></div>

											<form action="<?php echo base_url('kdr/login_kdr'); ?>" method="post" class="form-signin">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="username" class="form-control" placeholder="Username" required autofocus/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="password" id="password"
															class="form-control" placeholder="Password" required/>
															<i class="ace-icon fa fa-lock"></i><br>
															<input type="checkbox" onclick="showPassword()">&nbsp; Show Password 
														</span>
													</label>

													<div class="space"></div>
													<div class="space"></div>
													<div class="clearfix">
														<a href="<?php echo base_url('dashboard_kdr'); ?>">
															<i class="ace-icon fa fa-arrow-left"></i>
															Kembali ke Dashboard
														</a>

														<button type="submit" name="login" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<br>
														<!-- Kalo salah username atau password -->
														<?php if(isset($error)) { echo $error; }; ?>
													<div class="space-4"></div>
												</fieldset>
											</form>
										</div>	

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													Saya ingin daftar
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>		
									</div>
								</div>

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-user-plus green"></i>
												Pendaftaran User Baru
											</h4>

											<form action="<?php echo base_url('kdr/login_kdr/check'); ?>" method="POST" parsley-validate>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" parsley-required="true" required>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="username" placeholder="Username" parsley-required="true" required>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" minlength="6" placeholder="Password" parsley-required="true" parsley-minlength="6" required>
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<select name="nama_bagian" class="chosen-select form-control" id="form-field-select-3" required>
                                                                <option class="option" value="">Nama Bagian</option>
                                                                <option class="option" value="kdr">KDR</option>
                                                                <option class="option" value="pqa">PQA</option>
                                                                <option class="option" value="isd">ISD</option>
                                                                <option class="option" value="osd">OSD</option>
                                                                <option class="option" value="opl">OPL</option>
                                                                <option class="option" value="ost">OST</option>
                                                                <option class="option" value="shd">SHD</option>
                                                                <option class="option" value="inf">INF</option>
                                                                <option class="option" value="pen">PEN</option>
                                                                <option class="option" value="tik">TIK</option>
                                                            </select>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<select name="untuk_web" class="chosen-select form-control" id="form-field-select-3" required>
                                                                <option class="option" value="">Untuk Web</option>
                                                                <option class="option" value="semua">Semua Web</option>
                                                                <option class="option" value="kdr">KDR</option>
                                                                <option class="option" value="risk">RISK</option>
                                                                <option class="option" value="monica">MONICA</option>
                                                            </select>
														</span>
													</label>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">Hapus</span>
														</button>

														<button type="submit" class="width-65 pull-right btn btn-sm btn-primary">
															<span class="bigger-110">Daftar</span>
															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar clearfix">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Kembali ke login
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="<?php echo base_url();?>assets/js/parsley.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery-2.2.4.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets'); ?>/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
		</script>

		<script>
			function showPassword() {
				var x = document.getElementById("password");
				if (x.type === "password") {
					x.type = "text";
				} else {
					x.type = "password";
				}
			} 
		</script>
	</body>
</html>