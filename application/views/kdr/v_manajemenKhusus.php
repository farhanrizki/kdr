<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li class="active">Manajemen Khusus</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Manajemen Khusus
				</h1>
			</div>

			<?php if(isset($berhasil_update)) { echo $berhasil_update; } if(isset($gagal_update)) { echo $gagal_update; } ?>
			<?php if(isset($duplicate_user)) { echo $duplicate_user; } ?>

			<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                    <div class="box-header">
	                        <h4 class="box-title">Daftar User Khusus</h4>
	                    </div>

	                    <div class="box-body">
	                        <table id="tabel" class="table table-bordered table-striped" style="font-size: 11pt">
	                            <thead>
	                                <tr>
	                                	<th>No.</th>
	                                	<th>Nama Lengkap</th>
	                                    <th>Username</th>
	                                    <th>Level</th>
	                                    <th>Status</th>
	                                    <th>Nama Bagian</th>
	                                    <th>Untuk Web</th>
	                                    <th>Aksi</th>
	                                </tr>
	                            </thead>
	                            <tbody>
                                <?php 
									$no = 1;
									foreach($manajemen_khusus as $row)
									{
								?>
										<tr>
											<td><?=$no++?>.</td>
											<td><?=$row['nama_lengkap']?></td>
											<td><?=$row['username']?></td>
											<td>
												<?php
													if($row['level'] != null)
													{
														echo $row['level'];
													}
													else
													{
														echo "-";
													}
												?>	
											</td>
											<td>
												<?php 
													if($row['status'] == 1)
													{
														echo "Aktif";
													}
													else
													{
														echo "Non Aktif";
													}
												?>	
											</td>
											<td><?=$row['nama_bagian']?></td>
											<td><?=$row['untuk_web']?></td>
											<td align="center">
												<a class="blue" href="" data-toggle="modal" data-target="#edituserkhusus<?php echo $row['id_user'];?>"> 
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>
											</td>
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
    </div>
</div>

<!-- Modal edit  -->
<?php 
    foreach($manajemen_khusus as $row):
	$id_user      = $row['id_user'];
	$nama_lengkap = $row['nama_lengkap'];
	$username     = $row['username'];
?>

<div class="modal fade" id="edituserkhusus<?php echo $id_user;?>" tabindex="-1" role="dialog" aria-labelledby="edituserkhusus" aria-hidden="true">
    <div class="modal-dialog" style="width:750px;">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit User Khusus</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'kdr/manajemen_khusus'?>" method="post">
		        <div class="modal-body">
		            <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                            	value="<?php echo $nama_lengkap; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" 
                            	value="<?php echo $username; ?>" disabled required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password Baru</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
								<input type="checkbox" class="ubahpass">Ubah Password
							</label>
							<input type="password" class="form-control password" name="password_baru" minlength="6" placeholder="Password Baru" disabled="disabled">
                        </div>
                    </div>
                    <input type="hidden" name="id_user[]" value="<?php echo $id_user;?>">
		        </div>
		        <div class="modal-footer">
		            <button type="submit" name="updateuserkhusus" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>Update</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Batal</button>
		        </div>
	    	</form>
	    </div>
    </div>
</div>
<?php endforeach;?>

<!-- datatables	page specific plugin scripts -->
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.min.js"></script>

<script>
	$(function () {
	    $('#tabel').DataTable({
	        "paging": true,
	        "lengthChange": true,
	        "searching": true,
	        "ordering": true,
	        "info": true,
	        "autoWidth": true
	    });
	});
</script>

<!-- Aktifin ubah password -->
<script>
	$('.ubahpass').click(function() 
	{
	    $('.password').attr('disabled',! this.checked)
	});
</script>