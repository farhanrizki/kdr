<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li class="active">Persetujuan</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Data Persetujuan

					<?php 
						echo strtoupper($nama_bagian_risk);						
					?>
				</h1>
			</div>

			<?php if(isset($berhasil_tambah)) { echo $berhasil_tambah; } if(isset($gagal_tambah)) { echo $gagal_tambah; } ?>
			<?php if(isset($berhasil_update)) { echo $berhasil_update; } if(isset($gagal_update)) { echo $gagal_update; } ?>
			<?php if(isset($berhasil_hapus)) { echo $berhasil_hapus; } if(isset($gagal_hapus)) { echo $gagal_hapus; } ?>
			<?php if(isset($batal_tambah)) { echo $batal_tambah; } if(isset($gagal_batal_tambah)) { echo $gagal_batal_tambah; } ?>
			<?php if(isset($batal_edit)) { echo $batal_edit; } if(isset($gagal_batal_edit)) { echo $gagal_batal_edit; } ?>
			<?php if(isset($batal_hapus)) { echo $batal_hapus; } if(isset($gagal_batal_hapus)) { echo $gagal_batal_hapus; } ?>

			<div class="row">
				<div class="col-xs-12">
					<form action="" id="myForm">
						<div class="form-group">
							<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th rowspan="2">No. </th>
										<th rowspan="2">Nama Bagian</th>
										<th rowspan="2">Risk Issue Yang Akan Ditambah</th>
										<th rowspan="2">Risk Issue Sebelum Edit</th>
										<th rowspan="2">Risk Issue Sesudah Edit</th>
										<th colspan="3" style="text-align: center;">Persetujuan</th>
									</tr>
									<tr>
										<th>Tambah</th>
										<th>Edit</th>
										<th>Hapus</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$no = 1;
									foreach($data_persetujuan as $row)
									{
								?>
										<tr>
											<td><?=$no++?>.</td>
											<td><?=$row['nama_bagian']?></td>
											<td>
												<?php 
													if ($row['risk_issue_tambah'] != null ) {
														echo $row['risk_issue_tambah'];
													} else {
														echo "-";
													} 
												?>
											</td>
											<td>
												<?php 
													if ($row['risk_issue'] != null ) {
														echo $row['risk_issue'];
													} else {
														echo "-";
													} 
												?>
											</td>
											<td>
												<?php 
													if ($row['risk_issue_edit'] != null ) {
														echo $row['risk_issue_edit'];
													} else {
														echo "-";
													} 
												?>
											</td>
											<td>
												<?php if ($row['risk_issue_tambah'] != null ) { ?>
													<a class="green" href="" data-toggle="modal" data-target="#tambah_modal<?php echo $row['id_risk'];?>"> 
														<i class="ace-icon fa fa-plus bigger-130"></i>
														Yes
													</a>
													&nbsp;
													<a class="red" href="" data-toggle="modal" data-target="#batal_tambah<?php echo $row['id_risk'];?>"> 
														<i class="ace-icon fa fa-times bigger-130"></i>
														No
													</a>
													<?php } else {
														echo "-";
													} 
												?>
											</td>
											<td>
												<?php if ($row['edit_user'] == 1 ) { ?>
													<a class="green" href="" data-toggle="modal" data-target="#edit_modal<?php echo $row['id_risk'];?>"> 
														<i class="ace-icon fa fa-pencil bigger-130"></i>
														Yes
													</a>
													&nbsp;
													<a class="red" href="" data-toggle="modal" data-target="#batal_edit<?php echo $row['id_risk'];?>"> 
														<i class="ace-icon fa fa-times bigger-130"></i>
														No
													</a>
												<?php } else {
													echo "-";
												} ?>
											</td>
											<td>
												<?php if ($row['hapus_user'] == 1 ) { ?>
													<a class="green" href="" data-toggle="modal" data-target="#hapus_modal<?php echo $row['id_risk'];?>"> 
														<i class="ace-icon fa fa-trash bigger-130"></i>
														Yes
													</a>
													&nbsp;
													<a class="red" href="" data-toggle="modal" data-target="#batal_hapus<?php echo $row['id_risk'];?>"> 
														<i class="ace-icon fa fa-times bigger-130"></i>
														No
													</a>
												<?php } else {
													echo "-";
												} ?>
											</td>
										</tr>
								<?php 
									} 
		                        ?>
								</tbody>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ============ MODAL TAMBAH, EDIT DAN HAPUS =============== -->
<?php 
    foreach($data_persetujuan as $row):
	$id_risk           = $row['id_risk'];
	$risk_issue        = $row['risk_issue'];
	$risk_issue_tambah = $row['risk_issue_tambah'];
	$risk_issue_edit   = $row['risk_issue_edit'];
?>
<div class="modal fade" id="tambah_modal<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="tambah_modal" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Tambah Data</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'risk/persetujuan'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Menambah "<?php echo $risk_issue_tambah ?>" Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_risk" value="<?php echo $id_risk;?>">
	                    <input type="hidden" name="risk_issue_tambah" value="<?php echo $risk_issue_tambah;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="persetujuantambah" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tutup</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>

<div class="modal fade" id="batal_tambah<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="batal_tambah" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Batal Tambah Data</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'risk/persetujuan'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Membatalkan Tambah Data "<?php echo $risk_issue_tambah ?>" Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_risk" value="<?php echo $id_risk;?>">
	                    <input type="hidden" name="risk_issue_tambah" value="<?php echo $risk_issue_tambah;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="bataltambah" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tutup</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>

<div class="modal fade" id="edit_modal<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Edit Data</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'risk/persetujuan'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Mengedit "<?php echo $risk_issue ?>" Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_risk" value="<?php echo $id_risk;?>">
	                    <input type="hidden" name="risk_issue_edit" value="<?php echo $risk_issue_edit;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="persetujuanedit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tutup</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>

<div class="modal fade" id="batal_edit<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="batal_edit" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Batal Edit Data</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'risk/persetujuan'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Membatalkan Edit Data "<?php echo $risk_issue ?>" Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_risk" value="<?php echo $id_risk;?>">
	                    <input type="hidden" name="risk_issue_edit" value="<?php echo $risk_issue_edit;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="bataledit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tutup</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>

<div class="modal fade" id="hapus_modal<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'risk/persetujuan'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Menghapus "<?php echo $risk_issue ?>" Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_risk" value="<?php echo $id_risk;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="persetujuanhapus" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tutup</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>

<div class="modal fade" id="batal_hapus<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="batal_hapus" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Batal Hapus Data</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'risk/persetujuan'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Membatalkan Hapus Data "<?php echo $risk_issue ?>" Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_risk" value="<?php echo $id_risk;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="batalhapus" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tutup</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>
<?php endforeach;?>
<!-- AKHIR MODAL TAMBAH, EDIT DAN HAPUS -->

<script type="text/javascript">
	jQuery(function($) {
		var myTable = $('#simple-table').DataTable({
				bAutoWidth: true,
				aoColumns: 
				[
					null,null, null, null, null, null, null,
					{ bSortable: false }
				],
				aaSorting: []
		    });
	})
</script>