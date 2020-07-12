<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li>
					<a href="<?php echo base_url('kdr/patching_personal'); ?>">Patching Personal</a>
				</li>
				<li class="active">Detail Patching Personal</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-3">
					<div class="infobox infobox-black">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-download"></i>
						</div>
						<div class="infobox-data">
							<div class="infobox-content">Download Excel</div>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_personal/download_detail_personal/'.$tanggal_start.'/'.$tanggal_end.'/'.$nama_personal);?>">Download</a></div>
						</div>
					</div>
				</div>

				<?php if($tanggal_start == 0){ } else { ?>
					<div style="float: right; margin-right: 12px; margin-top: 10px;">
						<form method="post" action="<?php echo base_url('kdr/patching_personal/filter_personal'); ?>">
							<input type="hidden" name="tanggal" 
							value="<?php echo $tanggal_start.' / '.$tanggal_end; ?>">
							<button type="submit" class="btn btn-primary">
			    				<i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Kembali 
			    			</button>
		    			</form>
					</div>
				<?php } ?>
			</div>

			<div class="space-6"></div>
			<div class="space-6"></div>

			<div class="row">
				<div class="col-xs-12">
					<div class="table-header">
						Patching Personal <?php echo $nama_personal;?> <?php echo $filter;?>
					</div>
					<table id="datatable" class="table table-bordered table-hover" style="font-size: 12;">	
						<thead>
							<tr>
								<th>Tgl Permohonan</th>
								<th>Tgl Patching</th>
								<th>Patching</th>
								<th>SLA</th>
								<th>Kategori</th>
								<th>No Tiket</th>
								<th>ID Patching</th>
								<th>Divisi</th>
								<th>Status</th>
								<th>Uker</th>
								<th>Maker</th>   
								<?php if($level_kdr == 'adminkdr') { ?>
								<th>Justify</th>  	
								<?php } else { } ?>				
							</tr>
						</thead>

						<tbody>
						<?php 
							foreach($detail_personal as $data)
							{
								$startDate   = $data["tgl_permohonan"];
								$endDate     = $data["tgl_patching"];
								
								//Get library from controller
								$workingDays = $working->getWorkingDays($startDate,$endDate,$holidays);
						?>
								<tr>
									<td><?=$data['tgl_permohonan']?></td>
									<td><?=$data['tgl_patching']?></td>
									<td><?=$data['nama']?></td>
									<td><?=$workingDays. ' hari'?></td>
									<td><?=$data['jenis']?></td>
									<td><?=$data['no_tiket']?></td>
									<td><?=$data['id_patching2']?></td>
									<td><?=$data['divisi']?></td>
									<td><?=$data['status']?></td>
									<td><?=$data['uker']?></td>
									<td><?=$data['maker']?></td>
									<?php if($level_kdr == 'adminkdr') { ?>
									<td align="center">
										<button type="button" class="view_data btn btn-primary btn-xs" 
										data-toggle='modal' data-target="#justify<?php echo $data['id_patching'];?>">
										<i class="ace-icon fa fa-edit bigger-130"></i></button>
									</td>
									<?php } else { } ?>
								</tr>
			            <?php
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>	
	</div>
</div>	

<!-- Modal Justifikasi -->
<?php 
    foreach($detail_personal as $row):
	$id_patching = $row['id_patching'];
	$keterangan  = $row['keterangan'];
	$justifikasi = $row['justifikasi'];
?>
<div class="modal fade" id="justify<?php echo $id_patching;?>" tabindex="-1" role="dialog" aria-labelledby="justify" aria-hidden="true">
    <div class="modal-dialog" style="width:700px;">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Justifikasi</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'kdr/patching_personal/update_justifikasi'?>" method="post">
		        <div class="modal-body">
		            <div class="form-group">
                        <label class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" 
                            value="<?php echo $keterangan;?>" required>
                        </div>
                    </div>
                    <input type="hidden" name="id_patching[]" value="<?php echo $id_patching;?>">
                    <input type="hidden" name="tanggal_start" value="<?php echo $tanggal_start;?>">
                    <input type="hidden" name="tanggal_end" value="<?php echo $tanggal_end;?>">
                    <input type="hidden" name="nama_personal" value="<?php echo $nama_personal;?>">
		        </div>
		        <div class="modal-footer">
		            <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Update Justifikasi</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Tutup</button>
		            <?php if($justifikasi == "1") { ?>
		            	<button type="button" onclick="window.location='<?php echo base_url("kdr/patching_personal/batal_justifikasi/".$id_patching.'/'.$tanggal_start.'/'.$tanggal_end.'/'.$nama_personal);?>'" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;&nbsp;Batalkan Justifikasi</button>
		            <?php } ?>
		        </div>
	    	</form>
	    </div>
    </div>
</div>
<?php endforeach;?>		

<!-- Datatable -->
<script>
	$('#datatable').dataTable({
		"bProcessing": true,
		"sServerMethod": "POST",
		"iDisplayLength": 10,
		"sPaginationType": "full_numbers",
		"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
		"aaSorting": [[0, 'desc']],
		"aoColumnDefs": [{ "bSortable": false, "aTargets": [ ] }, 
            { "bSearchable": false, "aTargets": [] }],
		"fnDrawCallback": function() {
			$('.btn-delete').click(function(e) {
				e.preventDefault();
				var c = alertify.confirm('Anda akan menghapus data ini, Lanjutkan?').set('onok', function(){ window.location.href = $(e.delegateTarget).attr('href');} );
			});

		    $('#shift').change(function(){
				var a = $(this).val();
				var table = $('#example').DataTable();
		        table.draw();
			});
			
			$('[data-toggle="tooltip"]').tooltip();
		}
	});
</script>

<!-- Go Back 
<script>
	function goBack() 
	{
		window.history.back();
	}
</script> -->