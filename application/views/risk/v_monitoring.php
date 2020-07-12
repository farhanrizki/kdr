<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li class="active">Monitoring Risk By Apps</li>
			</ul>
		</div>

		<div class="page-content">

			<!-- Button Input Score Risk -->
			<div class="row">
				<div class="col-xs-12">	
					<button type="button" class="btn btn-sm btn-primary" 
						onclick="window.location='<?php echo base_url("risk/monitoring/list_score/");?>'">
						<i class="glyphicon glyphicon-plus"></i>&nbsp; Input Score Risk
					</button>
				</div>	
			</div>

			<div class="row">
				<div class="col-xs-12">
					<!-- Risk By Apps -->
					<div class="row">
						<div class="space-6"></div>
						<div class="vspace-12-sm"></div>
						<div class="col-lg-12">
							<div class="widget-box">
								<div class="widget-header">
									<h5 class="widget-title">
										<i class="ace-icon fa fa-signal"></i>
										Risk By Apps
									</h5>
								</div>
								<div class="widget-body">
									<div class="widget-main">
										<div class="col-lg-12">
											<div style="width: 900px; height: 380px; margin: 0 auto"> 
												<div id="all-monitoring" style="width: 900px; height: 380px; 
												float: left; margin-top:-10px"></div>
											</div> 
											<div style="justify-content: center; display: flex; margin-top:-10px">
												<img src="<?php echo base_url(); ?>assets/images/risk.png" style="height:70px;">
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
						<button class="btn btn-danger pull-left" id="very-critical"
						onclick="return TampilData(this.id);">Very Critical</button>
						<button class="btn btn-danger" id="critical" onclick="return TampilData(this.id);"
						style="margin-left: 150px; width: 100px;">Critical</button>
						<button class="btn btn-danger" id="high" onclick="return TampilData(this.id);"
						style="margin-left: 150px; width: 100px;">High</button>
						<button class="btn btn-danger" id="medium" onclick="return TampilData(this.id);"
						style="margin-left: 170px; width: 100px;">Medium</button>
						<button class="btn btn-danger pull-right" id="low" onclick="return TampilData(this.id);"
						style="width: 100px;">Low</button>

						<!-- Risk by Apps Very Critical -->
						<div class="row collapse" id="tampil-very-critical">
							<div class="space-6"></div>
							<div class="vspace-12-sm"></div>
							<div class="col-lg-12">
								<div class="widget-box">
									<div class="widget-header">
										<h5 class="widget-title">
											<i class="ace-icon fa fa-rss"></i>
											Very Critical
										</h5>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<div class="col-lg-12">
												<div class="tampil-vc" style="width: 900px; height: auto; margin: 0 auto">
												</div> 
											</div>													
											<div class="clearfix">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Risk by Apps Critical -->
						<div class="row collapse" id="tampil-critical">
							<div class="space-6"></div>
							<div class="vspace-12-sm"></div>
							<div class="col-lg-12">
								<div class="widget-box">
									<div class="widget-header">
										<h5 class="widget-title">
											<i class="ace-icon fa fa-wifi"></i>
											Critical
										</h5>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<div class="col-lg-12">
												<div class="tampil-c" style="width: 900px; height: auto; margin: 0 auto">
												</div> 
											</div>													
											<div class="clearfix">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Risk by Apps High -->
						<div class="row collapse" id="tampil-high">
							<div class="space-6"></div>
							<div class="vspace-12-sm"></div>
							<div class="col-lg-12">
								<div class="widget-box">
									<div class="widget-header">
										<h5 class="widget-title">
											<i class="ace-icon fa fa-wifi"></i>
											High
										</h5>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<div class="col-lg-12">
												<div class="tampil-h" style="width: 900px; height: auto; margin: 0 auto">
												</div> 
											</div>													
											<div class="clearfix">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Risk by Apps Medium -->
						<div class="row collapse" id="tampil-medium">
							<div class="space-6"></div>
							<div class="vspace-12-sm"></div>
							<div class="col-lg-12">
								<div class="widget-box">
									<div class="widget-header">
										<h5 class="widget-title">
											<i class="ace-icon fa fa-wifi"></i>
											Medium
										</h5>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<div class="col-lg-12">
												<div class="tampil-m" style="width: 900px; height: auto; margin: 0 auto">
												</div> 
											</div>													
											<div class="clearfix">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Risk by Apps Low -->
						<div class="row collapse" id="tampil-low">
							<div class="space-6"></div>
							<div class="vspace-12-sm"></div>
							<div class="col-lg-12">
								<div class="widget-box">
									<div class="widget-header">
										<h5 class="widget-title">
											<i class="ace-icon fa fa-wifi"></i>
											Low
										</h5>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<div class="col-lg-12">
												<div class="tampil-l" style="width: 900px; height: auto; margin: 0 auto">
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
</div>

<!-- Perhitungan All Risk -->
<script type="text/javascript">
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
				[0.5, '#DDDF0D'], // yellow
				[0.8, '#DF5353'] // red
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

	// The RPM gauge All Risk
	var chartAllRisk= Highcharts.chart('all-monitoring', Highcharts.merge(gaugeOptions, {
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
					((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.2f}</span><br/>' +
					   '<span style="font-size:25px;color:green">Risk By Apps</span></div>'
			},
			tooltip: {
				valueSuffix: ' revolutions/min'
			}
		}]
	}));

	// Hasilnya
	setInterval(function () {
	    var point;
	    if (chartAllRisk) {
			point  = chartAllRisk.series[0].points[0];
	        point.update(<?= ($all_monitoring) ?>);
	    }
	}, 2000);
</script>

<!-- Perhitungan Risk by Bia App -->
<script>
	function TampilData(id){
		var id_button = id;
		if(id_button == "very-critical"){
			var bia_app = 5;
		}else if(id_button == "critical"){
			var bia_app = 4;
		}else if(id_button == "high"){
			var bia_app = 3;
		}else if(id_button == "medium"){
			var bia_app = 2;
		}else{
			var bia_app = 1;
		}

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
					[0.5, '#DDDF0D'], // yellow
					[0.8, '#DF5353'] // red
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

		$.ajax({
			method: 'POST',
			url: "<?php echo base_url('risk/monitoring/per_bia_app/'); ?>",
			data: {bia_app: bia_app},
			dataType: 'JSON',
			success: function(data){
				if(id_button == "very-critical"){
					$("#tampil-very-critical").toggle();
					$("#tampil-critical").hide();
					$("#tampil-high").hide();
					$("#tampil-medium").hide();
					$("#tampil-low").hide();
					for(var i = 0; i < data.jumlah_aplikasi; i++){
						let nama_aplikasi  = data.nama_aplikasi[i];
						let hasil_aplikasi = data.hasil_aplikasi[i];
						$(".tampil-vc").append("<div style='width: 300px; height: 200px; float: left;' id='"+nama_aplikasi+"'></div>");
						var hasil = Highcharts.chart(nama_aplikasi, Highcharts.merge(gaugeOptions, {
						    yAxis: {
						        min: 0,
						        max: 5
						    },
						    credits: {
						        enabled: false
						    },
						    series: [{
						        name: 'Speed',
						        data: [1],
						        dataLabels: {
									format: '<div style="text-align:center"><span style="font-size:25px;color:' +
										((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.2f}</span><br/>' +
										   '<span style="font-size:13px;color:blue">*'+nama_aplikasi+'*</span></div>'
								},
						        tooltip: {
						            valueSuffix: ' km/h'
						        }
						    }]
						}));
						// Hasilnya
					    var point;
						point = hasil.series[0].points[0];
				        point.update(hasil_aplikasi);
					}
				}else if(id_button == "critical"){
					$("#tampil-very-critical").hide();
					$("#tampil-critical").toggle();
					$("#tampil-high").hide();
					$("#tampil-medium").hide();
					$("#tampil-low").hide();
					for(var i = 0; i < data.jumlah_aplikasi; i++){
						let nama_aplikasi  = data.nama_aplikasi[i];
						let hasil_aplikasi = data.hasil_aplikasi[i];
						$(".tampil-c").append("<div style='width: 300px; height: 200px; float: left;' id='"+nama_aplikasi+"'></div>");
						var hasil = Highcharts.chart(nama_aplikasi, Highcharts.merge(gaugeOptions, {
						    yAxis: {
						        min: 0,
						        max: 5
						    },
						    credits: {
						        enabled: false
						    },
						    series: [{
						        name: 'Speed',
						        data: [1],
						        dataLabels: {
									format: '<div style="text-align:center"><span style="font-size:25px;color:' +
										((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.2f}</span><br/>' +
										   '<span style="font-size:13px;color:blue">*'+nama_aplikasi+'*</span></div>'
								},
						        tooltip: {
						            valueSuffix: ' km/h'
						        }
						    }]
						}));
						// Hasilnya
					    var point;
						point = hasil.series[0].points[0];
				        point.update(hasil_aplikasi);
					}
				}else if(id_button == "high"){
					$("#tampil-very-critical").hide();
					$("#tampil-critical").hide();
					$("#tampil-high").toggle();
					$("#tampil-medium").hide();
					$("#tampil-low").hide();
					for(var i = 0; i < data.jumlah_aplikasi; i++){
						let nama_aplikasi  = data.nama_aplikasi[i];
						let hasil_aplikasi = data.hasil_aplikasi[i];
						$(".tampil-h").append("<div style='width: 300px; height: 200px; float: left;' id='"+nama_aplikasi+"'></div>");
						var hasil = Highcharts.chart(nama_aplikasi, Highcharts.merge(gaugeOptions, {
						    yAxis: {
						        min: 0,
						        max: 5
						    },
						    credits: {
						        enabled: false
						    },
						    series: [{
						        name: 'Speed',
						        data: [1],
						        dataLabels: {
									format: '<div style="text-align:center"><span style="font-size:25px;color:' +
										((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.2f}</span><br/>' +
										   '<span style="font-size:13px;color:blue">*'+nama_aplikasi+'*</span></div>'
								},
						        tooltip: {
						            valueSuffix: ' km/h'
						        }
						    }]
						}));
						// Hasilnya
					    var point;
						point = hasil.series[0].points[0];
				        point.update(hasil_aplikasi);
					}
				}else if(id_button == "medium"){
					$("#tampil-very-critical").hide();
					$("#tampil-critical").hide();
					$("#tampil-high").hide();
					$("#tampil-medium").toggle();
					$("#tampil-low").hide();
					for(var i = 0; i < data.jumlah_aplikasi; i++){
						let nama_aplikasi  = data.nama_aplikasi[i];
						let hasil_aplikasi = data.hasil_aplikasi[i];
						$(".tampil-m").append("<div style='width: 300px; height: 200px; float: left;' id='"+nama_aplikasi+"'></div>");
						var hasil = Highcharts.chart(nama_aplikasi, Highcharts.merge(gaugeOptions, {
						    yAxis: {
						        min: 0,
						        max: 5
						    },
						    credits: {
						        enabled: false
						    },
						    series: [{
						        name: 'Speed',
						        data: [1],
						        dataLabels: {
									format: '<div style="text-align:center"><span style="font-size:25px;color:' +
										((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.2f}</span><br/>' +
										   '<span style="font-size:13px;color:blue">*'+nama_aplikasi+'*</span></div>'
								},
						        tooltip: {
						            valueSuffix: ' km/h'
						        }
						    }]
						}));
						// Hasilnya
					    var point;
						point = hasil.series[0].points[0];
				        point.update(hasil_aplikasi);
					}
				}else{
					$("#tampil-very-critical").hide();
					$("#tampil-critical").hide();
					$("#tampil-high").hide();
					$("#tampil-medium").hide();
					$("#tampil-low").toggle();
					for(var i = 0; i < data.jumlah_aplikasi; i++){
						let nama_aplikasi  = data.nama_aplikasi[i];
						let hasil_aplikasi = data.hasil_aplikasi[i];
						$(".tampil-l").append("<div style='width: 300px; height: 200px; float: left;' id='"+nama_aplikasi+"'></div>");
						var hasil = Highcharts.chart(nama_aplikasi, Highcharts.merge(gaugeOptions, {
						    yAxis: {
						        min: 0,
						        max: 5
						    },
						    credits: {
						        enabled: false
						    },
						    series: [{
						        name: 'Speed',
						        data: [1],
						        dataLabels: {
									format: '<div style="text-align:center"><span style="font-size:25px;color:' +
										((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.2f}</span><br/>' +
										   '<span style="font-size:13px;color:blue">*'+nama_aplikasi+'*</span></div>'
								},
						        tooltip: {
						            valueSuffix: ' km/h'
						        }
						    }]
						}));
						// Hasilnya
					    var point;
						point = hasil.series[0].points[0];
				        point.update(hasil_aplikasi);
					}
				}
            },
            error : function(data) {
           		alert("Tidak ada data");
        	}
        });
	 	event.preventDefault();
	}
</script>