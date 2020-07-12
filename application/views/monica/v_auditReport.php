<?php
	$tahun = $tahun_input;
?>	

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('monica/dashboard_monica') ?>">Home</a>
				</li>
				<li>
					<a href="<?php echo base_url('monica/audit_report'); ?>">Tahun Audit Report</a>
				</li>
				<li class="active">Audit Report</li>
			</ul>
		</div>

		<style>
			.internal, .kategori, .eksternal  { width:100%;margin-top:20px; }
			.status-internal, .kategori-internal, .status-eksternal { width:33%;text-align:center;float:left; }
			.status-internal-satu, .status-eksternal-satu { background: #00B050;justify-content: center;
			align-items: center;border-radius: 100%;text-align: center;
			margin: 5px 40px;font-size: 80px;display: flex;height: 250px;color: #fff;
			text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; }
			.kategori-internal-satu { background: #FF0000;justify-content: center;
			align-items: center;text-align: center;margin: 5px 40px;font-size: 80px;
			display: flex;height: 250px;color: #fff;text-shadow: -1px -1px 0 #000, 
			1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; }
			.status-internal-dua, .status-eksternal-dua { font-size: 80px;background: #FFC000; }
			.status-internal-tiga, .status-eksternal-tiga { font-size: 80px;background: #FF0000; }
			.kategori-internal-dua { font-size: 80px;background: #0000FF; }
			.kategori-internal-tiga { font-size: 80px;background: #FFFF00; }
			.status-internal p, .kategori-internal p, .status-eksternal p { font-size:20px;color:#000; }
		</style>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Audit Report
					<?php 
						if ($tahun_input != 'semua')
						{
							echo 'Div. APP Tahun '.ucfirst($tahun_input); 
						}
						else
						{
							echo 'Div. APP'; 
						}
					?>
				</h1>
			</div>

			<!-- DIAGRAM CHART INTERNAL -->
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div id="diagram-chart-internal" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
					</div>
				</div>
			</div>

			<br>
			<br>

			<!-- JUMLAH STATUS MONITORING INTERNAL -->
			<div class="row">
				<div class="col-xs-12">
					<div class="row" style="width: 1000px; height: 400px; margin: 0 auto">
						<h3 style="text-align: center; font-family: arial;"> 
							Jumlah Status Monitoring 
							<?php 
								if ($tahun_input != 'semua')
								{
									echo 'Div. APP Tahun '.ucfirst($tahun_input); 
								}
								else
								{
									echo 'Div. APP'; 
								}
							?>
						</h3>
						<div class="internal">
						    <div class="status-internal">
						        <div class="status-internal-satu">
						        	<?php echo $total_memadai_internal; ?>
						        </div>
						        <p>Memadai</p>
						    </div>
						    <div class="status-internal">
						        <div class="status-internal-satu status-internal-dua">
						        	<?php echo $total_pemantauan_internal; ?>
						        </div>
						        <p>Dalam Pemantauan</p>
						    </div>
						    <div class="status-internal">
						    	<a onclick="return tidakMemadai();" style="cursor: pointer;">
							        <div class="status-internal-satu status-internal-tiga">
							        	<?php echo $total_tidak_memadai_internal; ?>
							        </div>
							    </a>
						        <p><a onclick="return tidakMemadai();" style="cursor: pointer;">Tidak Memadai</a></p>
						    </div>
						</div>
					</div>
				</div>
			</div>

			<br>
			<br>

			<!-- JUMLAH KATEGORI TEMUAN INTERNAL -->
			<div class="row">
				<div class="col-xs-12">
					<div class="row" style="width: 1000px; height: 400px; margin: 0 auto">
						<h3 style="text-align: center; font-family: arial;"> 
							Jumlah Kategori Temuan 
							<?php 
								if ($tahun_input != 'semua')
								{
									echo 'Div. APP Tahun '.ucfirst($tahun_input); 
								}
								else
								{
									echo 'Div. APP'; 
								}
							?>
						</h3>
						<div class="kategori">
						    <div class="kategori-internal">
						    	<a data-target="#major" data-toggle="modal" href="#major">
							        <div class="kategori-internal-satu">
							        	<?php echo $total_major; ?>
							        </div>
							    </a>
						        <p><a data-target="#major" data-toggle="modal" href="#major">Major</a></p>
						    </div>
						    <div class="kategori-internal">
						    	<a data-target="#minor" data-toggle="modal" href="#minor">
							        <div class="kategori-internal-satu kategori-internal-dua">
							        	<?php echo $total_minor; ?>
							        </div>
							    </a>
						        <p><a data-target="#minor" data-toggle="modal" href="#minor">Minor</a></p>
						    </div>
						    <div class="kategori-internal">
						    	<a data-target="#moderate" data-toggle="modal" href="#moderate">
							        <div class="kategori-internal-satu kategori-internal-tiga">
							        	<?php echo $total_moderate; ?>
							        </div>
							    </a>
						        <p><a data-target="#moderate" data-toggle="modal" href="#moderate">Moderate</a></p>
						    </div>
						</div>
					</div>
				</div>
			</div>

			<br>
			<br>

			<!-- JUMLAH STATUS MONITORING EKSTERNAL -->
			<div class="row">
				<div class="col-xs-12">
					<div class="row" style="width: 1000px; height: 400px; margin: 0 auto">
						<h3 style="text-align: center; font-family: arial;"> 
							Jumlah Status Monitoring 
							<?php 
								if ($tahun_input != 'semua')
								{
									echo 'Eksternal Tahun '.ucfirst($tahun_input); 
								}
								else
								{
									echo 'Eksternal'; 
								}
							?>
						</h3>
						<div class="eksternal">
						    <div class="status-eksternal">
						        <div class="status-eksternal-satu">
						        	<?php echo $total_memadai_eksternal; ?>
						        </div>
						        <p>Memadai</p>
						    </div>
						    <div class="status-eksternal">
						        <div class="status-eksternal-satu status-eksternal-dua">
						        	<?php echo $total_pemantauan_eksternal; ?>
						        </div>
						        <p>Dalam Pemantauan</p>
						    </div>
						    <div class="status-eksternal">
						        <div class="status-eksternal-satu status-eksternal-tiga">
						        	<?php echo $total_tidak_memadai_eksternal; ?>
						        </div>
						        <p>Tidak Memadai</p>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Menampilkan jumlah memadai, tidak memadai dan dalam pemantauan sesuai bagian internal/eksternal -->
<div class="modal fade" id="lihat_internal" tabindex="-1" role="dialog" aria-labelledby="lihat_internal" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:1000px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div id="judul_internal"></div>
				<div class="modal-body">
		        	<table id="table1" class="table table-bordered table-hover responsive">
						<thead>
							<tr>
								<th rowspan="2">Nama Bagian</th>
								<th colspan="3" style="text-align: center;">Major</th>
								<th colspan="3" style="text-align: center;">Minor</th>
								<th colspan="3" style="text-align: center;">Moderate</th>
							</tr>
							<tr>
								<th style="text-align: center;">Memadai</th>
								<th style="text-align: center;">Dalam Pemantauan</th>
								<th style="text-align: center;">Tidak Memadai</th>
								<th style="text-align: center;">Memadai</th>
								<th style="text-align: center;">Dalam Pemantauan</th>
								<th style="text-align: center;">Tidak Memadai</th>
								<th style="text-align: center;">Memadai</th>
								<th style="text-align: center;">Dalam Pemantauan</th>
								<th style="text-align: center;">Tidak Memadai</th>
							</tr>
						</thead>
						<tbody id="tampil_internal"></tbody>
					</table>
	            </div>
	            <div class="modal-footer">
		            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Tutup</button>
		        </div>
		    </div>
		</div>
	</div>
</div>

<!-- Jumlah Monitoring Internal Major -->
<div class="modal fade" id="major" tabindex="-1" role="dialog" aria-labelledby="major" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:550px;">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-body">
					<div id="major_monitoring"></div>
	            </div>
	            <div class="modal-footer">
		            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Tutup</button>
		        </div>
		    </div>
		</div>
	</div>
</div>

<!-- Jumlah Monitoring Internal Minor -->
<div class="modal fade" id="minor" tabindex="-1" role="dialog" aria-labelledby="minor" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:550px;">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-body">
					<div id="minor_monitoring"></div>
	            </div>
	            <div class="modal-footer">
		            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Tutup</button>
		        </div>
		    </div>
		</div>
	</div>
</div>

<!-- Jumlah Monitoring Internal Moderate -->
<div class="modal fade" id="moderate" tabindex="-1" role="dialog" aria-labelledby="moderate" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:550px;">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-body">
					<div id="moderate_monitoring"></div>
	            </div>
	            <div class="modal-footer">
		            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Tutup</button>
		        </div>
		    </div>
		</div>
	</div>
</div>

<!-- Menampilkan Jumlah Tidak Memadai yang Belum TL -->
<div class="modal tidak-memadai" id="tidak-memadai" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:800px;">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <div id="judul"></div>
		    </div>
	        <div class="modal-body">
	        	<!-- Jumlah Seluruh Bagian Tidak Memadai yang Belum TL -->
				<div class="row">
					<style>
						.tl, .divisi-baris-satu, .divisi-baris-dua, .divisi-baris-tiga, .divisi-baris-empat { width:100%;height:auto;margin:0 auto; }
						.status-tl { width:30%;text-align:center;margin:auto; }
						.divisi-satu, .divisi-dua, .divisi-tiga, .divisi-empat { width:20%;text-align:center;float:left; }

						.status-tl-satu { background: #FF0000;justify-content: center;align-items: center;
						border-radius: 100%;text-align: center;margin: 5px 40px;font-size: 80px;
						display: flex;height: 150px;color: #fff;
						text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; }
						.status-divisi-satu, .status-divisi-dua, .status-divisi-tiga, .status-divisi-empat { justify-content:center;
						align-items:center;border-radius:100%;text-align: center;margin: 0px 10px;
						font-size: 35px;display: flex;height: 120px;color: #fff;
						text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; }

						.status-tl p { font-size:18px;color:#000; }
						.divisi-satu p, .divisi-dua, .divisi-tiga, .divisi-empat p { font-size:15px;color:#000; }
					</style>
					<div class="tl">
					    <div class="status-tl">
					        <div class="status-tl-satu" id="status-tl-satu"></div>
					        <p>Jumlah Tidak Memadai</p>
					    </div>
					</div>
				</div>
				<br>

				<!-- Jumlah Per Bagian Tidak Memadai yang Belum TL Baris 1-->
				<div class="row">
					<div class="divisi-baris-satu">
					    <div class="divisi-satu">
					        <div class="status-divisi-satu" id="status-divisi-kmg"></div>
					        <p>KMG</p>
					    </div>
					    <div class="divisi-satu">
					        <div class="status-divisi-satu" id="status-divisi-pqa"></div>
					        <p>PQA</p>
					    </div>
					    <div class="divisi-satu">
					        <div class="status-divisi-satu" id="status-divisi-opl"></div>
					        <p>OPL</p>
					    </div>
					    <div class="divisi-satu">
					        <div class="status-divisi-satu" id="status-divisi-cbs"></div>
					        <p>CBS</p>
					    </div>
					    <div class="divisi-satu">
					        <div class="status-divisi-satu" id="status-divisi-sku"></div>
					        <p>SKU</p>
					    </div>
					</div>
				</div>

				<!-- Jumlah Per Bagian Tidak Memadai yang Belum TL Baris 2-->
				<div class="row">
					<div class="divisi-baris-dua">
					    <div class="divisi-dua">
					        <div class="status-divisi-dua" id="status-divisi-sld"></div>
					        <p>SLD</p>
					    </div>
					    <div class="divisi-dua">
					        <div class="status-divisi-dua" id="status-divisi-itp"></div>
					        <p>ITP</p>
					    </div>
					    <div class="divisi-dua">
					        <div class="status-divisi-dua" id="status-divisi-msa"></div>
					        <p>MSA</p>
					    </div>
					    <div class="divisi-dua">
					        <div class="status-divisi-dua" id="status-divisi-sbp"></div>
					        <p>SBP</p>
					    </div>
					    <div class="divisi-dua">
					        <div class="status-divisi-dua" id="status-divisi-kop"></div>
					        <p>KOP</p>
					    </div>
					</div>
				</div>

				<!-- Jumlah Per Bagian Tidak Memadai yang Belum TL Baris 3-->
				<div class="row">
					<div class="divisi-baris-tiga">
					    <div class="divisi-tiga">
					        <div class="status-divisi-tiga" id="status-divisi-ibr"></div>
					        <p>IBR</p>
					    </div>
					    <div class="divisi-tiga">
					        <div class="status-divisi-tiga" id="status-divisi-sdk"></div>
					        <p>SDK</p>
					    </div>
					    <div class="divisi-tiga">
					        <div class="status-divisi-tiga" id="status-divisi-aes"></div>
					        <p>AES</p>
					    </div>
					    <div class="divisi-tiga">
					        <div class="status-divisi-tiga" id="status-divisi-cao"></div>
					        <p>CAO</p>
					    </div>
					    <div class="divisi-tiga">
					        <div class="status-divisi-tiga" id="status-divisi-mao"></div>
					        <p>MAO</p>
					    </div>
					</div>
				</div>

				<!-- Jumlah Per Bagian Tidak Memadai yang Belum TL Baris 4-->
				<div class="row">
					<div class="divisi-baris-empat">
					    <div class="divisi-empat">
					        <div class="status-divisi-empat" id="status-divisi-dao"></div>
					        <p>DAO</p>
					    </div>
					    <div class="divisi-empat">
					        <div class="status-divisi-empat" id="status-divisi-itg"></div>
					        <p>ITG</p>
					    </div>
					</div>
				</div>
				<br>
				
	        	<table class="table table-striped table-hover responsive" id="table_tl">
					<thead>
						<tr>
							<th>Data Temuan</th>
							<th>Nama Bagian</th>
							<th>Deadline</th>
						</tr>
					</thead>
					<tbody id="isi_table"></tbody>
				</table>
	        </div>
	        <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Tutup</button>
	        </div>
	    </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/js/exporting.js"></script>
<script src="<?php echo base_url();?>assets/js/export-data.js"></script>
<link href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css" rel="stylesheet"/>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>

<!-- Menampilkan diagram chart internal -->
<script>
	Highcharts.chart('diagram-chart-internal', {
    	chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Audit Report Internal <?php 
						if ($tahun_input != 'semua'){
							echo 'Div. APP Tahun '.ucfirst($tahun_input); 
						}else{
							echo 'Div. APP'; 
						}
					?>' 
	    },
	    xAxis: {
	        categories: <?php echo $namainternal; ?>,
	        labels: {
		        formatter: function () {
		        	return '<a href="javascript:void(0)" onClick = "lihatInternal(this.innerHTML);">' + this.value + '</a>'
		        },
		        style: {
                    fontSize:'18px'
                },
		        useHTML: true
		    },
	        crosshair: true
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Total'
	        },
	        tickInterval: 10
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	            '<td style="padding:0"><b>{point.y}</b></td></tr>',
	        footerFormat: '</table>',
	        shared: true,
	        useHTML: true
	    },
	    plotOptions: {
	        column: {
	            pointPadding: 0.2,
	            borderWidth: 0,
	            dataLabels: {
			        enabled: true,
			        distance: -40,
			        color: "#000000",
			        formatter: function() 
			        {
						return this.y;
			        }
			    }
	        }
	    },
	    credits: {
			enabled: false
		},
	    series: [{
	        name: 'Major',
	        color: "#FF0000",
	        data: <?php echo $nilaimajorinternal; ?>

	    }, {
	        name: 'Minor',
	        color: "#0000FF",
	        data: <?php echo $nilaiminorinternal; ?>

	    }, {
	        name: 'Moderate',
	        color: "#FFFF00",
	        data: <?php echo $nilaimoderateinternal; ?>

	    }]
	});
</script>

<!-- Menampilkan jumlah memadai, tidak memadai dan dalam pemantauan sesuai bagian internal yang di klik -->
<script>
	function lihatInternal(nama){
		var nama  = nama;
		var tahun = "<?php echo $tahun; ?>";
		var tahun = tahun;
		$.ajax({
			method: 'POST',
			url: "<?php echo base_url('monica/audit_report/lihat_data_internal/'); ?>",
			data: {nama: nama, tahun: tahun},
			dataType: 'JSON',
			success: function(data){
                $("#lihat_internal").modal('show');
                $('#tampil_internal').html(data);
                 
				if (tahun != 'semua'){
					document.getElementById('judul_internal').innerHTML = '<h4>Jumlah Major, Minor, Moderate Bagian '+nama+ ' Tahun '+tahun+ '</h4>';
				}else{
					document.getElementById('judul_internal').innerHTML = '<h4>Jumlah Major, Minor, Moderate Bagian '+nama+ ' Div. APP</h4>';
				}
            },
            error : function(data) {
           		alert("Gagal Load Data");
        	}
        });
	}
</script>

<!-- Jumlah Monitoring Internal Major -->
<script type="text/javascript">
	Highcharts.chart('major_monitoring', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Jumlah Monitoring Internal Major <?php 
						if ($tahun_input != 'semua'){
							echo 'Div. APP Tahun '.ucfirst($tahun_input); 
						}else{
							echo 'Div. APP'; 
						}
					?>' 
        },
        plotOptions: {
    	    pie: {
    			dataLabels: {
    				enabled: true,
    				distance: -50,
    				formatter: function() {
    					return this.y;
    				},
                    style: { fontFamily: 'sans-serif', fontSize: '25px' }
    			},
    	  		showInLegend: true
    	    }
      	},
      	credits: {
			enabled: false
		},
        series: [{
            name: 'Major Internal',
            colorByPoint: true,
            data: [{
                name: 'Memadai',
                y: <?php echo $major_memadai_internal; ?>,
                color: '#00B050'
            }, {
                name: 'Dalam Pemantauan',
                y: <?php echo $major_pemantauan_internal; ?>,
                color: '#FFC000'
            }, {
                name: 'Tidak Memadai',
                y: <?php echo $major_tidak_memadai_internal; ?>,
                color: '#FF0000'
            }]
        }]
    });
</script>

<!-- Jumlah Monitoring Internal Minor -->
<script type="text/javascript">
	Highcharts.chart('minor_monitoring', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Jumlah Monitoring Internal Minor <?php 
						if ($tahun_input != 'semua'){
							echo 'Div. APP Tahun '.ucfirst($tahun_input); 
						}else{
							echo 'Div. APP'; 
						}
					?>' 
        },
        plotOptions: {
    	    pie: {
    			dataLabels: {
    				enabled: true,
    				distance: -50,
    				formatter: function() {
    					return this.y;
    				},
                    style: { fontFamily: 'sans-serif', fontSize: '25px' }
    			},
    	  		showInLegend: true
    	    }
      	},
      	credits: {
			enabled: false
		},
        series: [{
            name: 'Minor Internal',
            colorByPoint: true,
            data: [{
                name: 'Memadai',
                y: <?php echo $minor_memadai_internal; ?>,
                color: '#00B050'
            }, {
                name: 'Dalam Pemantauan',
                y: <?php echo $minor_pemantauan_internal; ?>,
                color: '#FFC000'
            }, {
                name: 'Tidak Memadai',
                y: <?php echo $minor_tidak_memadai_internal; ?>,
                color: '#FF0000'
            }]
        }]
    });
</script>

<!-- Jumlah Monitoring Internal Moderate -->
<script type="text/javascript">
	Highcharts.chart('moderate_monitoring', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Jumlah Monitoring Internal Moderate <?php 
						if ($tahun_input != 'semua'){
							echo 'Div. APP Tahun '.ucfirst($tahun_input); 
						}else{
							echo 'Div. APP'; 
						}
					?>' 
        },
        plotOptions: {
    	    pie: {
    			dataLabels: {
    				enabled: true,
    				distance: -50,
    				formatter: function() {
    					return this.y;
    				},
                    style: { fontFamily: 'sans-serif', fontSize: '25px' }
    			},
    	  		showInLegend: true
    	    }
      	},
      	credits: {
			enabled: false
		},
        series: [{
            name: 'Major Internal',
            colorByPoint: true,
            data: [{
                name: 'Memadai',
                y: <?php echo $moderate_memadai_internal; ?>,
                color: '#00B050'
            }, {
                name: 'Dalam Pemantauan',
                y: <?php echo $moderate_pemantauan_internal; ?>,
                color: '#FFC000'
            }, {
                name: 'Tidak Memadai',
                y: <?php echo $moderate_tidak_memadai_internal; ?>,
                color: '#FF0000'
            }]
        }]
    });
</script>

<!-- Menampilkan Jumlah Tidak Memadai yang Belum TL -->
<script>
	function tidakMemadai(){
		var tahun       = "<?php echo $tahun; ?>";
		var tahun       = tahun;
		var nama_bagian = "<?php echo $nama_bagian_monica; ?>";
		$.ajax({
			method: 'POST',
			url: "<?php echo base_url('monica/audit_report/detail_tidak_memadai/'); ?>",
			data: {tahun: tahun, nama_bagian: nama_bagian},
			dataType: 'JSON',
			success: function(data){
                $(".tidak-memadai").modal('show');
                if(tahun == 'semua'){
                	document.getElementById('judul').innerHTML = '<h4>Tidak Memadai Yang Belum TL Div. APP</h4>';
                }else{
                	document.getElementById('judul').innerHTML = '<h4>Tidak Memadai Yang Belum TL Div. APP Tahun '+tahun+ '</h4>';
                }

                //Kalo nilai per bagian 0 maka warnanya biru, selain itu merah
                if(data.jml_kmg == 0){ 
                	$('#status-divisi-kmg').css({'background':'#0000FF', 'fontSize':'35px'}); 
                } else { 
                	$('#status-divisi-kmg').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_pqa == 0){ 
                	$('#status-divisi-pqa').css({'background':'#0000FF', 'fontSize':'35px'}); 
                } else { 
                	$('#status-divisi-pqa').css({'background':'#FF0000','fontSize':'35px'});  
                }
                if(data.jml_opl == 0){ 
                	$('#status-divisi-opl').css({'background':'#0000FF', 'fontSize':'35px'}); 
                } else { 
                	$('#status-divisi-opl').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_cbs == 0){ 
                	$('#status-divisi-cbs').css({'background':'#0000FF', 'fontSize':'35px'}); 
                } else { 
                	$('#status-divisi-cbs').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_sku == 0){ 
                	$('#status-divisi-sku').css({'background':'#0000FF', 'fontSize':'35px'});  
                } else { 
                	$('#status-divisi-sku').css({'background':'#FF0000','fontSize':'35px'});  
                }
                if(data.jml_sld == 0){ 
                	$('#status-divisi-sld').css({'background':'#0000FF', 'fontSize':'35px'});  
                } else { 
                	$('#status-divisi-sld').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_itp == 0){ 
                	$('#status-divisi-itp').css({'background':'#0000FF', 'fontSize':'35px'}); 
                } else { 
                	$('#status-divisi-itp').css({'background':'#FF0000','fontSize':'35px'});  
                }
                if(data.jml_msa == 0){ 
                	$('#status-divisi-msa').css({'background':'#0000FF', 'fontSize':'35px'}); 
                } else { 
                	$('#status-divisi-msa').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_sbp == 0){ 
                	$('#status-divisi-sbp').css({'background':'#0000FF', 'fontSize':'35px'});  
                } else { 
                	$('#status-divisi-sbp').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_kop == 0){ 
                	$('#status-divisi-kop').css({'background':'#0000FF', 'fontSize':'35px'});  
                } else { 
                	$('#status-divisi-kop').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_ibr == 0){ 
                	$('#status-divisi-ibr').css({'background':'#0000FF', 'fontSize':'35px'});  
                } else { 
                	$('#status-divisi-ibr').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_sdk == 0){ 
                	$('#status-divisi-sdk').css({'background':'#0000FF', 'fontSize':'35px'});  
                } else { 
                	$('#status-divisi-sdk').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_aes == 0){ 
                	$('#status-divisi-aes').css({'background':'#0000FF', 'fontSize':'35px'});  
                } else { 
                	$('#status-divisi-aes').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_cao == 0){ 
                	$('#status-divisi-cao').css({'background':'#0000FF', 'fontSize':'35px'});  
                } else { 
                	$('#status-divisi-cao').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_mao == 0){ 
                	$('#status-divisi-mao').css({'background':'#0000FF', 'fontSize':'35px'});  
                } else { 
                	$('#status-divisi-mao').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_dao == 0){ 
                	$('#status-divisi-dao').css({'background':'#0000FF', 'fontSize':'35px'});  
                } else { 
                	$('#status-divisi-dao').css({'background':'#FF0000','fontSize':'35px'}); 
                }
                if(data.jml_itg == 0){ 
                	$('#status-divisi-itg').css({'background':'#0000FF', 'fontSize':'35px'});  
                } else { 
                	$('#status-divisi-itg').css({'background':'#FF0000','fontSize':'35px'}); 
                }

                document.getElementById('status-tl-satu').innerHTML = data.total_tidak_memadai;
                document.getElementById('status-divisi-kmg').innerHTML = data.jml_kmg;
                document.getElementById('status-divisi-pqa').innerHTML = data.jml_pqa;
                document.getElementById('status-divisi-opl').innerHTML = data.jml_opl;
                document.getElementById('status-divisi-cbs').innerHTML = data.jml_cbs;
                document.getElementById('status-divisi-sku').innerHTML = data.jml_sku;
                document.getElementById('status-divisi-sld').innerHTML = data.jml_sld;
                document.getElementById('status-divisi-itp').innerHTML = data.jml_itp;
                document.getElementById('status-divisi-msa').innerHTML = data.jml_msa;
                document.getElementById('status-divisi-sbp').innerHTML = data.jml_sbp;
                document.getElementById('status-divisi-kop').innerHTML = data.jml_kop;
                document.getElementById('status-divisi-ibr').innerHTML = data.jml_ibr;
                document.getElementById('status-divisi-sdk').innerHTML = data.jml_sdk;
                document.getElementById('status-divisi-aes').innerHTML = data.jml_aes;
                document.getElementById('status-divisi-cao').innerHTML = data.jml_cao;
                document.getElementById('status-divisi-mao').innerHTML = data.jml_mao;
                document.getElementById('status-divisi-dao').innerHTML = data.jml_dao;
                document.getElementById('status-divisi-itg').innerHTML = data.jml_itg;

                $('#isi_table').html(data.isi_table);

				var new_row = $("<tr class='search-header'/>");
				$('#table_tl thead th').each(function(i) {
					var title = $(this).text();
					var new_th = $('<th style="' + $(this).attr('style') + '" />');
					$(new_th).append('<input type="text" placeholder="' + title + '" data-index="'+i+'"/>');
					$(new_row).append(new_th);
				});
				$('#table_tl thead').prepend(new_row);
				var table = $('#table_tl').DataTable({
					"scrollX": true,
					"scrollY":  "250px",
					"searching": true,
					"retrieve": true,
				});
				$( table.table().container() ).on('keyup', 'thead input', function () {
					table
						.column( $(this).data('index') )
						.search( this.value )
						.draw();
				});
            },
            error : function(data) {
           		alert("Tidak ada data");
        	}
        });
	}
</script>