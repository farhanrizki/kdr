<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li>
					<a href="<?php echo base_url('risk/monitoring'); ?>">Monitoring Risk By Apps</a>
				</li>
				<li class="active">List Score</li>
			</ul>
		</div>

		<div class="page-content">
			<style>
			    .baris { height: auto; }

				table.dataTable td {
  					word-break: break-word;
  					overflow: hidden;
				}
			</style>

			<!-- Table yang sudah fix -->
			<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                    <div class="box-body">
	                        <table id="tabel-fix" class="table table-bordered table-striped">
	                            <thead>
	                                <tr class="baris">
	                                	<th>No.</th>
	                                	<th>Nama Aplikasi</th>
	                                	<th>IP Server</th> 
										<th>Jenis Server</th>
										<th>Score</th>
	                                	<th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
		                        <?php $no = 1; foreach($data_app_server as $row) { ?>
									<tr class="baris">
										<td><?=$no++?>.</td>
										<td><?=$row['nama_app']?></td>
										<td><?=$row['ip_server']?></td>
										<td><?=$row['jenis_server']?></td>
										<td align="center">
											<button type="button" class="view_data btn btn-primary btn-xs"
											onclick='return ScoreServer(<?php echo $row['id_app_server'];?>,
											"<?php echo $row['nama_app']; ?>","<?php echo $row['ip_server']; ?>")'>SERVER</button>

											<button type="button" class="view_data btn btn-primary btn-xs"
											onclick='return ScoreAplikasi(<?php echo $row['id_app_server'];?>,
											<?php echo $row['id_app'];?>,"<?php echo $row['nama_app']; ?>","<?php echo $row['ip_server']; ?>")'>APLIKASI</button>
										</td>
										<td align="center">
											<button type="button" class="view_data btn btn-primary btn-xs" 
											onclick="window.location='<?php echo base_url("risk/monitoring/update_score/".$row['id_app_server'].'/'.$row['id_app'].'/'.$row['id_server']);?>'">UPDATE SCORE</button>
										</td>
									</tr>
								<?php } ?>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
        	</div>
    	</div>
	</div>
</div>

<div class="modal fade" id="modal_server" tabindex="-1" role="dialog" aria-labelledby="modal_server" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:700px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div id="judul_server"></div>
				<div class="modal-body">
		        	<table class="table table-bordered table-hover responsive">
						<thead>
							<tr>
								<th>Nama Risk</th>
								<th>Score Risk</th>
							</tr>
						</thead>
						<tbody id="tampil_server"></tbody>
					</table>
	            </div>
	            <div class="modal-footer">
		            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Tutup</button>
		        </div>
		    </div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_aplikasi" tabindex="-1" role="dialog" aria-labelledby="modal_aplikasi" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:700px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div id="judul_aplikasi"></div>
				<div class="modal-body">
		        	<table class="table table-bordered table-hover responsive">
						<thead>
							<tr>
								<th>Nama Risk</th>
								<th>Score Risk</th>
							</tr>
						</thead>
						<tbody id="tampil_aplikasi"></tbody>
					</table>
	            </div>
	            <div class="modal-footer">
		            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Tutup</button>
		        </div>
		    </div>
		</div>
	</div>
</div>

<!-- Datatable Fix -->
<script>
	// Init DataTable
	var table = $('#tabel-fix').DataTable({
		"sScrollX": true,
		"scrollY":  "475px",
		"searching": true,
		"autoWidth": false
	});

	// Filter event handler
	$( table.table().container() ).on( 'keyup', 'thead input', function () {
		table
			.column( $(this).data('index') )
			.search( this.value )
			.draw();
	});
</script>

<!-- Score Server -->
<script>
	function ScoreServer(id_app_server,nama_app,ip_server) 
	{
		var id_app_server = JSON.stringify(id_app_server);
		var nama          = nama_app.replace(/\"/g, "");
		var ip            = ip_server.replace(/\"/g, "");

		$.ajax({
			method: 'POST',
			url: "<?php echo base_url('risk/monitoring/score_server/'); ?>",
			data: {id_app_server: id_app_server},
			dataType: 'JSON',
			success: function(data){
                $("#modal_server").modal('show');
                $('#tampil_server').html(data);
                document.getElementById('judul_server').innerHTML = '<h4>Score Server '+nama+' dengan IP Server '+ip+'</h4>';
            },
            error : function(data) {
           		alert("Tidak ada skor server untuk data ini");
        	}
        });
	 	event.preventDefault();
	}
</script>

<!-- Score Aplikasi -->
<script>
	function ScoreAplikasi(id_app_server,id_app,nama_app,ip_server) 
	{
		var id_app_server = JSON.stringify(id_app_server);
		var id_app        = JSON.stringify(id_app);
		var nama          = nama_app.replace(/\"/g, "");
		var ip            = ip_server.replace(/\"/g, "");

		$.ajax({
			method: 'POST',
			url: "<?php echo base_url('risk/monitoring/score_aplikasi/'); ?>",
			data: {id_app: id_app},
			dataType: 'JSON',
			success: function(data){
                $("#modal_aplikasi").modal('show');
                $('#tampil_aplikasi').html(data);
                document.getElementById('judul_aplikasi').innerHTML = '<h4>Score Aplikasi '+nama+ ' dengan IP Server '+ip+'</h4>';
            },
            error : function(data) {
           		alert("Tidak ada skor aplikasi untuk data ini");
        	}
        });
	 	event.preventDefault();
	}
</script>