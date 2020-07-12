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
				<li class="active">Patching Divisi</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
			<div class="row">
				<div class="space-6"></div>
				<form method="post" action="<?php echo site_url('kdr/patching_divisi/filter_divisi'); ?>">
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
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_divisi/download_divisi/'.$tanggal_start.'/'.$tanggal_end);?>">Download</a></div>
						</div>
					</div>
				</form>
			</div>
			
			<div class="row" style="margin: 0 auto;">
				<div class="space-6"></div>
				<div class="space-6"></div>
				<div class="space-6"></div>
				<div class="col-sm-8 infobox-container" style="width: 100%;">
					<div id="container"></div>
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

<!-- Highcharts -->
<script>
	Highcharts.chart('container', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Total Patching Per Divisi <?php if (!empty($tanggal_divisi)) {echo "Tanggal ".$tanggal_divisi;}else{ echo "Tahun ".date("Y");}?>'
	    },
	    xAxis: {
	        type: 'category',
	        labels: {
		        formatter: function () {
					var nama = this.value;
					return '<a href="<?php echo base_url('kdr/patching_divisi/detail_divisi/'.$tanggal_start.'/'.$tanggal_end.'/')?>'+ nama +'<?php ; ?>">' + this.value + '</a>'


					/*BENAR return '<a href="<?php echo base_url('kdr/patching_divisi/detail_divisi/')?>'+ nama +'<?php ; ?>">' + this.value + '</a>'*/
		        	/*return '<a href="http://www.google.com?q=' + this.value + '">' +
                        this.value + '</a>';*/
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
	            "name": "Patching Divisi",
	            "colorByPoint": true,
	            "data": [
					<?php 
						foreach($divisi as $row)
						{
							echo '{"name": "'.$row['divisi'].'","y": '.$row['hitung_divisi'].'},';
						}
					?>
	            ]
	        }
	    ]
	});
</script>