<?php
	//Refresh page
	$page = $_SERVER['PHP_SELF'];
	$sec = "180";	
?>		
	<div class="main-content">
		<div class="main-content-inner">
			<div class="breadcrumbs ace-save-state" id="breadcrumbs">
				<ul class="breadcrumb">
					<li>
						<i class="ace-icon fa fa-home home-icon"></i>
						<a href="<?php echo base_url('monica/dashboard_monica') ?>">Home</a>
					</li>
					<li class="active">Dashboard</li>
				</ul>
			</div>

			<div class="page-content">
				<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
				<div class="page-header">
					<h1>
						Dashboard
						<small>
							<i class="ace-icon fa fa-angle-double-right"></i>
							overview &amp; stats
						</small>
					</h1>
				</div>

				<div class="row">
					<div class="col-xs-12">
						<div class="alert alert-block alert-success">
							<i class="ace-icon fa fa-check green"></i>
							Welcome to
							<strong class="green">
								Monica APP
								<small></small>
							</strong>,
							aplikasi ini digunakan untuk melakukan monitoring Audit Divisi APP
						</div>

						<!-- Level Maturity Audit APP -->
						<div class="row">
							<div class="space-6"></div>
							<div class="vspace-12-sm"></div>
							<div class="col-lg-12">
								<div class="widget-box">
									<div class="widget-header">
										<h5 class="widget-title">
											<i class="ace-icon fa fa-signal"></i>
											Level Maturity Audit APP
										</h5>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div class="col-lg-12">
												<div style="width: 900px; height: 400px; margin: 0 auto">
													<div id="audit-app" style="height:400px;"></div>
												</div> 
											</div>													
											<div class="clearfix">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php if (strtolower($level_monica) == "adminkdr" || strtolower($level_monica) == "staffkdr"  || strtolower($level_monica) == "nonadmin" ) { ?>
					    <div>
							<button class="btn btn-primary" type="button" id="clickbidang">Level Maturity Bidang</button>
							<button class="btn btn-primary pull-right" type="button" id="clickbagian">Level Maturity Bagian</button>

							<!-- Level Maturity Audit Setiap Bidang -->
							<div class="row" id="bidang">
								<div class="space-6"></div>
								<div class="vspace-12-sm"></div>
								<div class="col-lg-12">
									<div class="widget-box">
										<div class="widget-header">
											<h5 class="widget-title">
												<i class="ace-icon fa fa-rss"></i>
												Level Maturity Audit Setiap Bidang
											</h5>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												<div class="col-lg-12">
													<div style="width: 900px; height: 400px; margin: 0 auto">
														<div id="audit-qa" style="width: 400px; height: 400px; float: left;"></div>
														<div id="audit-ops" style="width: 400px; height: 400px; float: right;"></div>
													</div> 
												</div>													
												<div class="clearfix">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Level Maturity Audit Setiap Bagian -->
							<div class="row" id="bagian">
								<div class="space-6"></div>
								<div class="vspace-12-sm"></div>
								<div class="col-lg-12">
									<div class="widget-box">
										<div class="widget-header">
											<h5 class="widget-title">
												<i class="ace-icon fa fa-wifi"></i>
												Level Maturity Audit Setiap Bagian
											</h5>
										</div>
										<div class="widget-body">
											<div class="widget-main">
												<div class="col-lg-12">
													<div style="width: 900px; height: 400px; margin: 0 auto">
														<?php for($x=0; $x<=16; $x++){ $nama  = $bagian[$x]; ?>
															<div id="audit-<?php echo $nama; ?>" style="width: 300px; height: 300px; float: left;"></div>
														<?php } ?>
													</div> 
												</div>													
												<div class="clearfix">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	
						<?php } else {}  ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url();?>assets/js/globalize.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/dx.chartjs.js"></script>
	
	<script>
		$(document).ready(function() {
	        $('#clickbidang').on('click', function(event) {        
	            $('#bidang').toggle('show');
	        });
	        
	        $('#clickbagian').on('click', function(event) {        
	            $('#bagian').toggle('show');
	        });
	    });
	</script>

	<!-- Menampilkan gauge -->
	<script>
		$("#audit-app").dxCircularGauge({
			scale: 
			{
				startValue: 0,  
				endValue: 100,
				majorTick: { tickInterval: 10 },
				label: {
                    customizeText: function (arg) {
                        return arg.valueText + " %";
                    }
                }
			},
			rangeContainer: 
			{ 
				ranges: [
                    {startValue: 0, endValue: 20, color: "#FF0000"},
                    {startValue: 20, endValue: 40, color: "#F38840"},
                    {startValue: 40, endValue: 60, color: "#FFFF00"},
                    {startValue: 60, endValue: 80, color: "#008000"},
                    {startValue: 80, endValue: 100, color: "#0000FF"}
                ]
			},
			title: 
			{
				text: 'Level Maturity Audit APP',
				font: {size: 28},
				position: 'top-center'
			},
			subvalueIndicator: {
				type: 'textCloud',
				format: 'thousands',
				color: "#483D8B",
				text: {
					customizeText: function (arg) {
						return arg.valueText + " %";
					}
				}  
			},
			valueIndicator: {
				color: "#483D8B"
			},
			value: <?php echo $maturity_app ?>,
			subvalues: [<?php echo $maturity_app ?>]
		});

		$("#audit-qa").dxCircularGauge({
			scale: 
			{
				startValue: 0,  
				endValue: 100,
				majorTick: { tickInterval: 10 },
				label: {
                    customizeText: function (arg) {
                        return arg.valueText + " %";
                    }
                }
			},
			rangeContainer: 
			{ 
				ranges: [
                    {startValue: 0, endValue: 20, color: "#FF0000"},
                    {startValue: 20, endValue: 40, color: "#F38840"},
                    {startValue: 40, endValue: 60, color: "#FFFF00"},
                    {startValue: 60, endValue: 80, color: "#008000"},
                    {startValue: 80, endValue: 100, color: "#0000FF"}
                ]
			},
			title: 
			{
				text: 'Level Maturity Audit QA',
				font: {size: 28},
				position: 'top-center'
			},
			subvalueIndicator: {
				type: 'textCloud',
				format: 'thousands',
				color: "#483D8B",
				font: {size: 28},
				text: {
					customizeText: function (arg) {
						return arg.valueText + " %";
					}
				}  
			},
			valueIndicator: {
				color: "#483D8B"
			},
			value: <?php echo $maturity_qa ?>,
			subvalues: [<?php echo $maturity_qa ?>]
		});

		$("#audit-ops").dxCircularGauge({
			scale: 
			{
				startValue: 0,  
				endValue: 100,
				majorTick: { tickInterval: 10 },
				label: {
                    customizeText: function (arg) {
                        return arg.valueText + " %";
                    }
                }
			},
			rangeContainer: 
			{ 
				ranges: [
                    {startValue: 0, endValue: 20, color: "#FF0000"},
                    {startValue: 20, endValue: 40, color: "#F38840"},
                    {startValue: 40, endValue: 60, color: "#FFFF00"},
                    {startValue: 60, endValue: 80, color: "#008000"},
                    {startValue: 80, endValue: 100, color: "#0000FF"}
                ]
			},
			title: 
			{
				text: 'Level Maturity Audit OPS',
				font: {size: 28},
				position: 'top-center'
			},
			subvalueIndicator: {
				type: 'textCloud',
				format: 'thousands',
				color: "#483D8B",
				font: {size: 28},
				text: {
					customizeText: function (arg) {
						return arg.valueText + " %";
					}
				}  
			},
			valueIndicator: {
				color: "#483D8B"
			},
			value: <?php echo $maturity_ops ?>,
			subvalues: [<?php echo $maturity_ops ?>]
		});

		<?php for($x=0; $x<=$count; $x++){ $nama  = $bagian[$x]; $nilai = $urutan[$x]; ?>
		$("#audit-<?php echo $nama; ?>").dxCircularGauge({
			scale: 
			{
				startValue: 0,  
				endValue: 100,
				majorTick: { tickInterval: 10 },
				label: {
                    customizeText: function (arg) {
                        return arg.valueText + " %";
                    }
                }
			},
			rangeContainer: 
			{ 
				ranges: [
                    {startValue: 0, endValue: 20, color: "#FF0000"},
                    {startValue: 20, endValue: 40, color: "#F38840"},
                    {startValue: 40, endValue: 60, color: "#FFFF00"},
                    {startValue: 60, endValue: 80, color: "#008000"},
                    {startValue: 80, endValue: 100, color: "#0000FF"}
                ]
			},
			title: 
			{
				text: 'Maturity Audit <?php echo $nama; ?>',
				font: {size: 25},
				position: 'top-center'
			},
			subvalueIndicator: {
				type: 'textCloud',
				format: 'thousands',
				color: "#483D8B",
				font: {size: 25},
				text: {
					customizeText: function (arg) {
						return arg.valueText + " %";
					}
				}  
			},
			valueIndicator: {
				color: "#483D8B"
			},
			value: <?php echo $nilai; ?>,
			subvalues: <?php echo $nilai; ?>
		});
		<?php } ?>
	</script>