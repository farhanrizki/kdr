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
					<a href="<?php echo base_url('dashboard_kdr') ?>">Home</a>
				</li>
				<li class="active">Dashboard</li>
			</ul>
		</div>

		<!-- WEB RISK -->
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
					<!-- Data Notif Insiden -->
					<?php if($notifInsiden) { ?>
						<div class="alert alert-block alert-danger">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>		
								<i class="berkedip ace-icon fa fa-info-circle"></i>	
								Telah Terjadi <?php echo $notifInsiden; ?> Insiden pada Divisi OPT		
						</div>
					<?php } else { ?>
						<div class="alert alert-block alert-success">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>		
								Tidak Terdapat Insiden pada Divisi OPT	
						</div>
					<?php } ?>

					<!-- Profile Risiko OPT -->
					<div class="row">
						<div class="space-6"></div>
						<div class="vspace-12-sm"></div>
						<div class="col-lg-12">
							<div class="widget-box">
								<div class="widget-header">
									<h5 class="widget-title">
										<i class="ace-icon fa fa-signal"></i>
										Profile Risiko OPT
									</h5>
								</div>

								<div class="widget-body">
									<div class="widget-main">
										<div class="col-lg-12">
											<div style="width: 900px; height: 400px; margin: 0 auto">
												<div id="container-opt" style="width: 900px; height: 400px; 
												float: left"></div> 
											</div> 
										</div>													
										<div class="clearfix">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div>
						<button class="btn btn-danger" data-toggle="collapse" data-target="#bidang">Profile Risk Bidang</button>
						<button class="btn btn-danger pull-right" data-toggle="collapse" data-target="#bagian">Profile Risk Bagian</button>

						<!-- Profile Risiko Setiap Bidang -->
						<div class="row collapse" id="bidang">
							<div class="space-6"></div>
							<div class="vspace-12-sm"></div>
							<div class="col-lg-12">
								<div class="widget-box">
									<div class="widget-header">
										<h5 class="widget-title">
											<i class="ace-icon fa fa-rss"></i>
											Profile Risiko Setiap Bidang
										</h5>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div class="col-lg-12">
												<div style="width: 900px; height: 350px; margin: 0 auto">
													<div id="container-qa" style="width: 400px; height: 300px; float: left;"></div>
													<div id="container-ops" style="width: 400px; height: 300px; float: right;"></div>
												</div> 
											</div>													
											<div class="clearfix">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Profile Risiko Setiap Bagian -->
						<div class="row collapse" id="bagian">
							<div class="space-6"></div>
							<div class="vspace-12-sm"></div>
							<div class="col-lg-12">
								<div class="widget-box">
									<div class="widget-header">
										<h5 class="widget-title">
											<i class="ace-icon fa fa-wifi"></i>
											Profile Risiko Setiap Bagian
										</h5>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div class="col-lg-12">
												<div style="width: 900px; height: 900px; margin: 0 auto">
													<div id="container-opl" style="width: 300px; height: 200px; float: left;"></div>
													<div id="container-osd" style="width: 300px; height: 200px; float: left;"></div>
													<div id="container-ost" style="width: 300px; height: 200px; float: left;"></div>
													<div id="container-shd" style="width: 300px; height: 200px; float: left;"></div>
													<div id="container-isd" style="width: 300px; height: 200px; float: left;"></div>
													<div id="container-pen" style="width: 300px; height: 200px; float: left;"></div>
													<div id="container-inf" style="width: 300px; height: 200px; float: left;"></div>
													<div id="container-pqa" style="width: 300px; height: 200px; float: left;"></div>
													<div id="container-kdr" style="width: 300px; height: 200px; float: left;"></div>
													<div id="container-tik" style="width: 300px; height: 200px; float: inherit ;"></div>
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
				</div>
			</div>
		</div>

		<!-- WEB MONICA -->
		<div class="page-content">
			<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
			<div class="row">
				<div class="col-xs-12">

					<!-- Level Maturity Audit OPT -->
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
												<div id="audit-app" style="height:400px;margin:0 auto"></div>
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
			</div>
		</div>
	</div>
</div>

<?php 
	$b = 0;
	foreach($bagian as $bagian1){
?>
	<div id="modal-<?php echo $bagian1;?>" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Nama Insiden
					</div>
				</div>

				<div class="modal-body">
					<table class="table table-striped table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>No.</th>
								<th>Bagian</th>
								<th>Insiden</th>
								<th>Impact</th>
								<th>insiden cause</th>
							</tr>
						</thead>
						<tbody align="center">
				<?php 
					$no = 1; 
					foreach($detil_insiden[$b] as $detil)
					{
					//var_dump($detil);
						if(count($detil) != 0)
						{
					?>
						<tr>
							<td><?=$no++?>.</td>
							<td><?=$detil['engineer']?></td>
							<td><?=$detil['nama_insiden']?></td>
							<td><?=$detil['lingkup_impact']?></td>
							<td><?=$detil['insiden_cause']?></td>
						</tr>
					<?php
						}else 
							{
							?>
							<tr><td colspan=\"4\" align=\"center\">Data Tidak Ditemukan</td></tr>
							<?php
							}
					}
                     ?>										
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
	$b++;
	}
?>

<script src="<?php echo base_url();?>assets/js/globalize.min.js"></script>
<script src="<?php echo base_url();?>assets/js/dx.chartjs.js"></script>

<!-- Menampilkan gauge RISK -->
<script type="text/javascript">
	// interval kedip
	setInterval(function(){
		$(".berkedip").toggle();
	},1000);	
	
	jQuery(function($) {
		//flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
		//but sometimes it brings up errors with normal resize event handlers
		$.resize.throttleWindow = false;
			
		////////////////////////////////////

		//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
		//so disable dragging when clicking on label
		var agent = navigator.userAgent.toLowerCase();
		if(ace.vars['touch'] && ace.vars['android']) {
			$('#tasks').on('touchstart', function(e){
				var li = $(e.target).closest('#tasks li');
				if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
				if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
			});
		}

		$('#tasks').sortable({
			opacity:0.8,
			revert:true,
			forceHelperSize:true,
			placeholder: 'draggable-placeholder',
			forcePlaceholderSize:true,
			tolerance:'pointer',
			stop: function( event, ui ) {
				//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
				$(ui.item).css('z-index', 'auto');
			}
			}
		);
		$('#tasks').disableSelection();
		$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
			if(this.checked) $(this).closest('li').addClass('selected');
			else $(this).closest('li').removeClass('selected');
		});

		//show the dropdowns on top or bottom depending on window height and menu position
		$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
			var offset = $(this).offset();

			var $w = $(window)
			if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
				$(this).addClass('dropup');
			else $(this).removeClass('dropup');
		});
	})

	// menampilkan gague
	var gaugeOptions = {
		chart: {
			type: 'solidgauge'
		},
		title: null,
		pane: {
			center: ['50%', '85%'],
			size: '140%',
			startAngle: -100,
			endAngle: 100,
			background: {
				backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
				innerRadius: '60%',
				outerRadius: '100%',
				shape: 'arc'
			}
		},
		tooltip: {
			enabled: false
		},
		// the value axis
		yAxis: {
			stops: [
				[0.1, '#55BF3B'], // green
				[0.8, '#DDDF0D'], // yellow
				[0.9, '#DF5353'] // red
			],
			lineWidth: 0,
			minorTickInterval: null,
			tickAmount: 6,
			title: {
				y: -120
			},
			labels: {
				y: 16
			}
		},
		plotOptions: {
			solidgauge: {
				dataLabels: {
					y: 5,
					borderWidth: 0,
					useHTML: true
				}
			}
		}
	};

	// The RPM gauge OPT
	var chartRpm0 = Highcharts.chart('container-opt', Highcharts.merge(gaugeOptions, {
		yAxis: {
			min: 0,
			max: 5,
			title: {
				text: ''
			}
		},
		credits: {
			enabled: false
		},			    
		series: [{
			name: 'RPM',
			data: [1],
			dataLabels: {
				format: '<div style="text-align:center"><span style="font-size:30px;color:' +
					((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f}</span><br/>' +
					   '<span style="font-size:25px;color:green">RISK OPT</span></div>'
			},
			tooltip: {
				valueSuffix: ' revolutions/min'
			}
		}]
	}));

	//rpm 2 tampilan QA
	var chartRpm1 = Highcharts.chart('container-qa', Highcharts.merge(gaugeOptions, {
		yAxis: {
			min: 0,
			max: 5,
			title: {
				text: 'Bidang Quality Assurance'
			}
		},
		credits: {
			enabled: false
		},			    
		series: [{
			name: 'RPM',
			data: [1],
			dataLabels: {
				format: '<div style="text-align:center"><span style="font-size:25px;color:' +
					((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f}</span><br/>' +
					   '<span style="font-size:12px;color:blue">*Risk QA*</span></div>'
			},
			tooltip: {
				valueSuffix: ' revolutions/min'
			}
		}]
	}));

	// The RPM2 gauge OPS
	var chartRpm2 = Highcharts.chart('container-ops', Highcharts.merge(gaugeOptions, {
		yAxis: {
			min: 0,
			max: 5,
			title: {
				text: 'Bidang Operasional'

			}
		},
		credits: {
			enabled: false
		},
		series: [{
			name: 'RPM',
			data: [1],
			dataLabels: {
				format: '<div style="text-align:center"><span style="font-size:25px;color:' +
					((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f}</span><br/>' +
					   '<span style="font-size:12px;color:green">*Risk Operasional*</span></div>'
			},
			tooltip: {
				valueSuffix: ' revolutions/min'
			}
		}]
	}));

	// membuat tampilan bagian
	<?php 
		$a = 0;
		foreach($bagian as $bagian){
	?>
	var chartRpm<?php echo $bagian; ?> = Highcharts.chart('container-<?php echo $bagian;?>', Highcharts.merge(gaugeOptions, {
	    yAxis: {
	        min: 0,
	        max: 5,
	        title: {
	            text: '<?php echo strtoupper($bagian)?>'
	        }
	    },
	    credits: {
	        enabled: false
	    },	    
	    series: [{
	        name: 'RPM',
	        data: [1],
	        dataLabels: {
	            format: '<?php  if(count($insiden[$a]) > 0){$color="red";$status="true";$blink="berkedip";}else{$color="black";$status="none";$blink="none";}; ?> <div style="text-align:center"><a href="#modal-<?php echo $bagian;?>" role="button" style="color:<?php echo $color;?>" data-toggle="modal"><span style="font-size:25px;color:' +
	                ((Highcharts.theme && Highcharts.theme.contrastTextColor) || '<?php echo $color;?>') + '">{y:.1f}</span><br/>' + 
	                   '<span class="<?php echo $blink; ?>" style="font-size:12px;color:<?php echo $color;?>"><i class="ace-icon fa fa-info-circle red" style="display:<?php echo $status;?>" ></i><?php echo strtoupper($bagian) ?></a></span></div> '
	        },
	        tooltip: {
	            valueSuffix: ''
	        }
	    }]
	}));
	<?php
	$a++;
	}
	?>
	
	setInterval(function () {
	    // Speed
	    var point,
	        newVal,
	        inc;

	    // OPT
	    if (chartRpm0) {
	        point = chartRpm0.series[0].points[0];
	        point.update(<?= ($risk_opt/10) ?>);
	    }

	    // QA
	    if (chartRpm1) {
	        point = chartRpm1.series[0].points[0];
	      	point.update(<?= ($risk_qa/4) ?>);
	    }

	    // OPS
	    if (chartRpm2) {
	        point = chartRpm2.series[0].points[0];
	        point.update(<?= ($risk_ops/6) ?>);
	    }

	    //OPL
		if (chartRpmopl) {
	        point = chartRpmopl.series[0].points[0];
	        point.update(<?= $risk_bagian[6] ?>);
	    }

	    //OSD
		if (chartRpmosd) {
	        point = chartRpmosd.series[0].points[0];
	        point.update(<?= $risk_bagian[7] ?>);
	    }

	    //OST
		if (chartRpmost) {
	        point = chartRpmost.series[0].points[0];
	        point.update(<?= $risk_bagian[8] ?>);
	    }

	    //shd
		if (chartRpmshd) {
	        point = chartRpmshd.series[0].points[0];
	        point.update(<?= $risk_bagian[11] ?>);
	    }

		//isd
		if (chartRpmisd) {
	        point = chartRpmisd.series[0].points[0];	
	        point.update(<?= $risk_bagian[2] ?>);
	    }

	    //pen
		if (chartRpmpen) {
	        point = chartRpmpen.series[0].points[0];
	        point.update(<?= $risk_bagian[9] ?>);
	    }

	    //inf
		if (chartRpminf) {
	        point = chartRpminf.series[0].points[0];
	       point.update(<?= $risk_bagian[1] ?>);
	    }

	    //pqa
		if (chartRpmpqa) {
	        point = chartRpmpqa.series[0].points[0];
	        point.update(<?= $risk_bagian[10] ?>);
	    }

	    //kdr
		if (chartRpmkdr) {
	        point = chartRpmkdr.series[0].points[0];
	        point.update(<?= $risk_bagian[4] ?>);
	    }

	   	//tik
		if (chartRpmtik) {
	        point = chartRpmtik.series[0].points[0];
		    point.update(<?= $risk_bagian[12] ?>);
	    }
	}, 2000);	
</script>

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

<!-- Menampilkan gauge MONICA -->
<script>
	$("#audit-app").dxCircularGauge({
		scale: {
			startValue: 0,  
			endValue: 100,
			majorTick: { tickInterval: 10 },
			label: {
                customizeText: function (arg) {
                    return arg.valueText + " %";
                }
            }
		},
		rangeContainer: { 
			ranges: [
                {startValue: 0, endValue: 20, color: "#FF0000"},
                {startValue: 20, endValue: 40, color: "#F38840"},
                {startValue: 40, endValue: 60, color: "#FFFF00"},
                {startValue: 60, endValue: 80, color: "#008000"},
                {startValue: 80, endValue: 100, color: "#0000FF"}
            ]
		},
		title: {
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
</script>