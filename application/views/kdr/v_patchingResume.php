<?php 
	//untuk hapus dokumen expired
	header("Cache-Control: max-age=300, must-revalidate"); 

	if (!empty($tanggal)) 
	{
		$tanggal2      = explode(' / ',$tanggal);
		$tanggal_start = $tanggal2[0];
		$tanggal_end   = $tanggal2[1];
	}
	else
	{
		$tanggal_start = 0;
		$tanggal_end   = 0;
	}
?>

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li class="active">Patching Resume</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
			<div class="row">
				<div class="space-6"></div>
				<form method="post" action="<?php echo base_url('kdr/patching_resume/filter_resume'); ?>">
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>

							<input class="form-control" type="text" name="tanggal" id="id-date-range-picker-1" value="<?php if (!empty($tanggal)) { echo $tanggal; } ?>"/>
							<span class="input-group-btn">
								<button type="submit" class="btn btn-sm btn-success">
								Filter
								</button>
							</span>
						</div>
					</div>
					<?php if (strtolower($level_kdr) == "adminkdr") { ?>
					&nbsp;&nbsp;&nbsp;
					<div class="infobox infobox-black">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-upload"></i>
						</div>
						<div class="infobox-data">
							<div class="infobox-content">Upload Excel</div>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/upload_patching');?>">Upload</a></div>
						</div>
					</div>

					<div class="infobox infobox-black">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-plus"></i>
						</div>
						<div class="infobox-data">
							<div class="infobox-content">Hari Libur</div>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/hari_libur');?>">Tambah</a></div>
						</div>
					</div>
					<?php } else { } ?> 
					&nbsp;&nbsp;&nbsp;
					<div class="infobox infobox-black">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-download"></i>
						</div>
						<div class="infobox-data">
							<div class="infobox-content">Download Excel</div>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/download_resume/'.$tanggal_start.'/'.$tanggal_end);?>">Download</a></div>
						</div>
					</div>
				</form>
			</div>

			<div class="row">
				<div class="space-6"></div>
				<div class="space-6"></div>
				<div class="space-6"></div>

				<div class="col-sm-12 infobox-container">
					<div class="infobox infobox-green">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $rekap_brinets['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/BRINETS');?>">BRINETS</a></div>
						</div>
					</div>

					<div class="infobox infobox-blue">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $rekap_tab['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/Tabungan');?>">Tabungan</a></div>
						</div>
					</div>
					
					<div class="infobox infobox-red">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $rekap_loan['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/Pinjaman');?>">Pinjaman</a></div>
						</div>
					</div>
					
					<div class="infobox infobox-orange">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $rekap_giro['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/Giro');?>">Giro</a></div>
						</div>
					</div>
					
					<div class="infobox infobox-grey">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $rekap_gl['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/GL');?>">General Ledger</a></div>
						</div>
					</div>
					
					<div class="infobox infobox-purple">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $rekap_ia['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/IA');?>">Internal Account</a></div>
						</div>
					</div>
					
					<div class="infobox infobox-orange2">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $rekap_pen['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/BRIPENS');?>">BRIPENS</a></div>
						</div>
					</div>
					
					<div class="infobox infobox-brown">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $rekap_cif['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/CIF');?>">CIF</a></div>
						</div>
					</div>
					
					<div class="infobox infobox-black">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $rekap_inventory['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/Inventory');?>">Inventory</a></div>
						</div>
					</div>
					
					<div class="infobox infobox-blue2">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $tf['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/TF');?>">Trade Finance</a></div>
						</div>
					</div>
					
					<div class="infobox infobox-red">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $remmitance['hitung'];; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/Remmitance');?>">Remmitance</a></div>
						</div>
					</div>
					
					<div class="infobox infobox-orange">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $deposito['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/Deposito');?>">Deposito</a></div>
						</div>
					</div>
					
					<div class="infobox infobox-grey">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $las['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/LAS');?>">LAS</a></div>
						</div>
					</div>

					<div class="infobox infobox-purple">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number"><?php echo $cams['hitung']; ?></span>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_resume/detail_resume/'.$tanggal_start.'/'.$tanggal_end.'/CAMS');?>">CAMS</a></div>
						</div>
					</div>

					<div class="space-6"></div>
					<div class="space-6"></div>

					<div class="infobox infobox-black infobox-big infobox-dark">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<div class="infobox-content">Total Patching</div>
							<div class="infobox-content"><?php echo $total_patching['hitung_patching'];?></div>
						</div>
					</div>

					<div class="infobox infobox-orange infobox-big infobox-dark">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<div class="infobox-content">Total Realisasi</div>
							<div class="infobox-content"><?php echo $totalrealisasi.' %';?></div>
						</div>
					</div>

					<div class="infobox infobox-brown infobox-big infobox-dark">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-certificate"></i>
						</div>
						<div class="infobox-data">
							<div class="infobox-content">Total Pencapaian</div>
							<div class="infobox-content"><?php echo $totalpencapaian.' %';?></div>
						</div>
					</div>
				</div>
			</div>
			<br><br><br>

			<!--<div class="row" style="margin: 0 auto;">
				<div class="col-sm-6 infobox-container" style="width: 100%;">
					<div id="grafik-tahun-ini"></div>
				</div>
			</div>
			<br><br><br>

			<div class="row" style="margin: 0 auto;">
				<div class="col-sm-6 infobox-container" style="width: 100%;">
					<div id="grafik-tahun-sebelum"></div>
				</div>
			</div>-->

			<div class="row" style="margin: 0 auto;">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                    <div class="box-body">
	                    	<div class="col-xs-6">
	                    		<div id="grafik-tahun-sebelum"></div>
							</div>

							<div class="col-xs-6">
								<div id="grafik-tahun-ini"></div>
							</div>
	                    </div>
	                </div>
	            </div>
        	</div>
		</div>
	</div>
</div>

<!-- Filter -->
<script type="text/javascript">
	$('.input-daterange').datepicker({autoclose:true});
	$('input[name=tanggal]').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-default',
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
			format: 'YYYY-MM-DD',
			separator: ' / ',
		}
	})
	.prev().on(ace.click_event, function(){
		$(this).next().focus();
	});
	$('.easy-pie-chart.percentage').each(function(){
		var $box = $(this).closest('.infobox');
		var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
		var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
		var size = parseInt($(this).data('size')) || 50;
		$(this).easyPieChart({
			barColor: barColor,
			trackColor: trackColor,
			scaleColor: false,
			lineCap: 'butt',
			lineWidth: parseInt(size/10),
			animate: ace.vars['old_ie'] ? false : 1000,
			size: size
		});
	})
</script>

<!-- Grafik SLA dan Non SLA Per Bulan di Tahun Ini -->
<script>
	Highcharts.chart('grafik-tahun-ini', {
	    chart: {
	        zoomType: 'xy'
	    },
	    title: {
	        text: 'Grafik SLA dan Non SLA Tahun <?php if (!empty($tahun_filter)) { echo $tahun_filter; } else { echo date("Y"); } ?>'
	    },
	    xAxis: {
	        categories: <?php echo $nama_bulan; ?>,
	        labels: {
		        formatter: function () {
		        	<?php 
		        		if($tahun_filter == 0)
		        	 	{
		        	 		$tahun = date("Y");
		        	 	}
		        	 	else
		        	 	{
		        	 		$tahun = $tahun_filter;
		        	 	}
		        	?>
					var tahun      = <?php echo $tahun; ?>;
					var nama_bulan = this.value;
					return '<a href="<?php echo base_url('kdr/patching_resume/detail_resume_bulan/')?>'+ tahun + '/' + nama_bulan + '<?php ; ?>">' + this.value + '</a>'
		        },
		        style: {
                    fontSize:'18px'
                },
		        useHTML: true
		    },
	        crosshair: true
	    },
	    yAxis: 
	    [{ 
	        labels: {
	            format: '{value}',
	            style: {
	                color: Highcharts.getOptions().colors[1]
	            }
	        },
	        title: {
	            text: 'Jumlah Patching',
	            style: {
	                color: Highcharts.getOptions().colors[1]
	            }
	        }
	    }],
	    tooltip: {
	        shared: true
	    },
	    credits: {
			enabled: false
		},
		series: [
	        {
	            name: 'Bar SLA',
		        type: 'column',
	            data: <?php echo $tampil_sla; ?>
	        },
	        {
	            name: 'Line SLA',
		        type: 'spline',
	            data: <?php echo $tampil_sla; ?>
	        },
	        {
	            name: 'Bar Non SLA',
		        type: 'column',
	            data: <?php echo $tampil_not_sla; ?>
	        },
	        {
	            name: 'Line Non SLA',
		        type: 'spline',
	            data: <?php echo $tampil_not_sla; ?>
	        }
	    ]
	});
</script>

<!-- Grafik SLA dan Non SLA Per Bulan di Tahun Ini -1 -->
<script>
	Highcharts.chart('grafik-tahun-sebelum', {
	    chart: {
	        zoomType: 'xy'
	    },
	    title: {
	        text: 'Grafik SLA dan Non SLA Tahun <?php if (!empty($tahun_sebelum)) { echo $tahun_sebelum; } else { echo date("Y")-1; } ?>'
	    },
	    xAxis: {
	        categories: <?php echo $nama_bulan; ?>,
	        labels: {
		        formatter: function () {
		        	<?php 
		        		if($tahun_sebelum == 0)
		        	 	{
		        	 		$tahun = date("Y")-1;
		        	 	}
		        	 	else
		        	 	{
		        	 		$tahun = $tahun_sebelum;
		        	 	}
		        	?>
					var tahun      = <?php echo $tahun; ?>;
					var nama_bulan = this.value;
					return '<a href="<?php echo base_url('kdr/patching_resume/detail_resume_bulan/')?>'+ tahun + '/' + nama_bulan + '<?php ; ?>">' + this.value + '</a>'
		        },
		        style: {
                    fontSize:'18px'
                },
		        useHTML: true
		    },
	        crosshair: true
	    },
	    yAxis: 
	    [{ 
	        labels: {
	            format: '{value}',
	            style: {
	                color: Highcharts.getOptions().colors[1]
	            }
	        },
	        title: {
	            text: 'Jumlah Patching',
	            style: {
	                color: Highcharts.getOptions().colors[1]
	            }
	        }
	    }],
	    tooltip: {
	        shared: true
	    },
	    credits: {
			enabled: false
		},
		series: [
	        {
	            name: 'Bar SLA',
		        type: 'column',
	            data: <?php echo $sla_sebelum; ?>
	        },
	        {
	            name: 'Line SLA',
		        type: 'spline',
	            data: <?php echo $sla_sebelum; ?>
	        },
	        {
	            name: 'Bar SLA',
		        type: 'column',
	            data: <?php echo $not_sla_sebelum; ?>
	        },
	        {
	            name: 'Line SLA',
		        type: 'spline',
	            data: <?php echo $not_sla_sebelum; ?>
	        }
	    ]
	});
</script>