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

	if(!empty($sla_personal) ) {
		foreach($sla_personal as $data)
		{
			$patching    = array();
			$get_sla     = 0;
			$justifikasi = "";
			foreach($data as $key)
			{
				$tgl_permohonan = $key["tgl_permohonan"];
				$tgl_patching   = $key["tgl_patching"];
				$maker          = $key["maker"];
				$justifikasi[]  = $key["justifikasi"];
				$patching[]     = $working->getWorkingDays($tgl_permohonan,$tgl_patching,$holidays);

				//Get sla yang tidak lebih dari 5 hari
				$min_sla = 0;
				$max_sla = 5;
				$get_sla = array_filter(
				    $patching,
				    function ($value_sla) use($min_sla,$max_sla) {
				        return ($value_sla >= $min_sla && $value_sla <= $max_sla);
				    }
				);

				//Get non sla yang lebih dari 5 hari
				$max_not_sla = 5;
				$not_sla     = array_filter(
				    $patching,
				    function ($value_not_sla) use($max_not_sla) {
				        return ($value_not_sla > $max_not_sla);
				    }
				);	
				
				$count_sla     = count($get_sla);
				$count_not_sla = count($not_sla);
			}

			$count_justif = count(array_keys($justifikasi, "1"));
			$isi_sla[]    = array("nama" => $maker, 'sla' => $count_sla+$count_justif, 'not_sla' => $count_not_sla-$count_justif);
		}
	}
	else
	{
		$maker         = "";
		$count_sla     = 0;
		$count_not_sla = 0;
		$isi_sla[]     = array("nama" => $maker, 'sla' => $count_sla, 'not_sla' => $count_not_sla);
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
				<li class="active">Patching Personal</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
			<div class="row">
				<div class="space-6"></div>
				<form method="post" action="<?php echo site_url('kdr/patching_personal/filter_personal'); ?>">
					<div class="col-xs-4">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>

							<input class="form-control" type="text" name="tanggal" id="id-date-range-picker-1" value="<?php if (!empty($tanggal)) {echo $tanggal;}?>"/>
							<span class="input-group-btn">
								<button type="submit" class="btn btn-sm btn-success">
								Filter
								</button>
							</span>
						</div>
					</div>
					&nbsp;&nbsp;&nbsp;
					<div class="infobox infobox-black">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-download"></i>
						</div>
						<div class="infobox-data">
							<div class="infobox-content">Download Excel</div>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_personal/download_personal/'.$tanggal_start.'/'.$tanggal_end);?>">Download</a></div>
						</div>
					</div>
				</form>
			</div>

			<div class="row" style="margin: 0 auto;">
				<div class="space-6"></div>
				<div class="space-6"></div>
				<div class="space-6"></div>
				<div class="col-sm-8 infobox-container" style="width: 100%;">
					<div id="container-utama"></div>
				</div>
			</div>
			<br><br><br>
			<div class="row" style="margin: 0 auto;">
				<div class="space-6"></div>
				<div class="space-6"></div>
				<div class="space-6"></div>
				<div class="col-sm-8 infobox-container" style="width: 100%;">
					<div id="container-sla"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Tanggal -->
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
</script>

<!-- Highcharts Utama -->
<script>
	Highcharts.chart('container-utama', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Total Patching Personal Tahun <?php if (!empty($tanggal_personal)) {echo $tanggal_personal;} else { echo date("Y"); } ?>'
	    },
	    xAxis: {
	        type: 'category',
	        labels: {
		        formatter: function () {
					var personal = this.value;
					return '<a href="<?php echo base_url('kdr/patching_personal/detail_personal/'.$tanggal_start.'/'.$tanggal_end.'/')?>'+ personal +'<?php ; ?>">' + this.value + '</a>'
		        },
		        style: {
                    fontSize:'18px'
                },
		        useHTML: true
		    },
	        crosshair: true
	    },
	    yAxis: {
	        title: {
	            text: 'Jumlah Patching'
	        }
	    },
	    legend: {
	        enabled: false
	    },
	    credits: {
			enabled: false
		},
	    plotOptions: {
	        series: {
	            borderWidth: 0,
	            dataLabels: {
	                enabled: true,
	                format: '{point.y:1f}'
	            }
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:2f}</b> of total<br/>'
	    },
	    "series": [
	        {
	            "name": "Patching Personal",
	            "colorByPoint": true,
	            "data": [
					<?php 
						foreach($personal as $row)
						{
							echo '{"name": "'.$row['maker'].'","y": '.$row['hitung_maker'].'},';
						}
					?>
	            ]
	        }
	    ]
	});
</script>

<!-- Highcharts SLA -->
<script>
	Highcharts.chart('container-sla', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Total SLA dan Non SLA Patching Personal Tahun <?php if (!empty($tanggal_personal)) {echo $tanggal_personal; } else { echo date("Y"); } ?>'
	    },
	    xAxis: {
	        type: 'category',
	        labels: {
		        formatter: function () {
					var personal = this.value;
					return '<a href="<?php echo base_url('kdr/patching_personal/detail_personal/'.$tanggal_start.'/'.$tanggal_end.'/')?>'+ personal +'<?php ; ?>">' + this.value + '</a>'
		        },
		        style: {
                    fontSize:'18px'
                },
		        useHTML: true
		    },
	        crosshair: true
	    },
	    yAxis: {
	        title: {
	            text: 'Jumlah Patching'
	        }
	    },
	    legend: {
	        enabled: false
	    },
	    credits: {
			enabled: false
		},
	    plotOptions: {
	        series: {
	            borderWidth: 0,
	            dataLabels: {
	                enabled: true,
	                format: '{point.y:1f}'
	            }
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:2f}</b> of total<br/>'
	    },
	    "series": [
	        {
	            "name": "Patching SLA Personal",
	            "colorByPoint": true,
	            "data": [
					<?php 
						foreach($isi_sla as $data => $value)
						{
							echo '{"name": "'.$value['nama'].'","y": '.$value['sla'].'},';
						}
					?>
	            ]
	        },
	        {
	            "name": "Patching Non SLA Personal",
	            "colorByPoint": true,
	            "data": [
					<?php 
						foreach($isi_sla as $data => $value)
						{
							echo '{"name": "'.$value['nama'].'","y": '.$value['not_sla'].'},';
						}
					?>
	            ]
	        }
	    ]
	});
</script>