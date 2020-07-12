<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li class="active">Manajemen User MONICA</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Manajemen User MONICA
				</h1>
			</div>

			<?php if(isset($berhasil_simpan)) { echo $berhasil_simpan; } if(isset($gagal_simpan)) { echo $gagal_simpan; } ?>
			<?php if(isset($duplicate_user)) { echo $duplicate_user; } ?>
			<?php if(isset($berhasil_update)) { echo $berhasil_update; } if(isset($gagal_update)) { echo $gagal_update; } ?>
			<?php if(isset($berhasil_hapus)) { echo $berhasil_hapus; } if(isset($gagal_hapus)) { echo $gagal_hapus; } ?>

			<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                    <div class="col-xs-12">	
	                        <button data-target="#tambahuser" data-toggle="modal" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah User</button>
	                        <hr style="border: 1px solid #E2E2E2;">
	                    </div>

	                    <div class="box-header">
	                        <h4 class="box-title">Daftar User MONICA Aktif</h4>
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
									foreach($user_monica_aktif as $row)
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
												<a class="blue" href="" data-toggle="modal" data-target="#edituseraktif<?php echo $row['id_user'];?>"> 
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>
												&nbsp;&nbsp;
												<a class="red" href="" data-toggle='modal' data-target="#hapususeraktif<?php echo $row['id_user'];?>"> 
													<i class="ace-icon fa fa-trash-o bigger-130"></i>
												</a>
											</td>
										</tr>
								<?php 
									} 
		                        ?>
	                            </tbody>
	                        </table>
	                    </div>
	                    <br>
	                    <hr style="border: 1px solid #E2E2E2;">
	                    <br>


	                    <div class="box-header">
	                        <h4 class="box-title">Daftar User MONICA Non Aktif</h4>
	                    </div>

	                    <div class="box-body">
	                        <table id="tabel2" class="table table-bordered table-striped" style="font-size: 11pt">
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
									foreach($user_monica_nonaktif as $row)
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
												<a class="blue" href="" data-toggle="modal" data-target="#editusernonaktif<?php echo $row['id_user'];?>"> 
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>
												&nbsp;&nbsp;
												<a class="red" href="" data-toggle='modal' data-target="#hapususernonaktif<?php echo $row['id_user'];?>"> 
													<i class="ace-icon fa fa-trash-o bigger-130"></i>
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

<!-- Modal edit, hapus user aktif -->
<?php 
    foreach($user_monica_aktif as $row):
	$id_user      = $row['id_user'];
	$nama_lengkap = $row['nama_lengkap'];
	$username     = $row['username'];
	$level        = $row['level'];
	$status       = $row['status'];
	$nama_bagian  = $row['nama_bagian'];
	$untuk_web    = $row['untuk_web'];
?>

<div class="modal fade" id="edituseraktif<?php echo $id_user;?>" tabindex="-1" role="dialog" aria-labelledby="edituseraktif" aria-hidden="true">
    <div class="modal-dialog" style="width:750px;">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit User MONICA Aktif</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'kdr/manajemen_user_monica'?>" method="post">
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
                        <label class="col-sm-2 control-label">Level</label>
                        <div class="col-sm-10">
                            <select name="level[<?=$row['id_user']?>]" id="level" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option value="" <?php if($level == ''){ echo 'selected';} ?>>-- Pilih Level --</option>
                            	<option value="staffkdr" <?php if($level == 'staffkdr'){ echo 'selected';} ?>>Staff KDR</option>
                            	<option value="nonadmin" <?php if($level == 'nonadmin'){ echo 'selected';} ?>>Non Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status[<?=$row['id_user']?>]" id="status" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option value=1 <?php if($status == 1){ echo 'selected';} ?>>Aktif</option>
                            	<option value=0 <?php if($status == 0){ echo 'selected';} ?>>Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Bagian</label>
                        <div class="col-sm-10">
                            <select name="nama_bagian[<?=$row['id_user']?>]" id="nama_bagian" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option value="kdr" <?php if($nama_bagian == "kdr"){ echo 'selected';} ?>>KDR</option>
                            	<option value="pqa" <?php if($nama_bagian == "pqa"){ echo 'selected';} ?>>PQA</option>
                            	<option value="isd" <?php if($nama_bagian == "isd"){ echo 'selected';} ?>>ISD</option>
                            	<option value="osd" <?php if($nama_bagian == "osd"){ echo 'selected';} ?>>OSD</option>
                            	<option value="opl" <?php if($nama_bagian == "opl"){ echo 'selected';} ?>>OPL</option>
                            	<option value="ost" <?php if($nama_bagian == "ost"){ echo 'selected';} ?>>OST</option>
                            	<option value="shd" <?php if($nama_bagian == "shd"){ echo 'selected';} ?>>SHD</option>
                            	<option value="inf" <?php if($nama_bagian == "inf"){ echo 'selected';} ?>>INF</option>
                            	<option value="pen" <?php if($nama_bagian == "pen"){ echo 'selected';} ?>>PEN</option>
                            	<option value="tik" <?php if($nama_bagian == "tik"){ echo 'selected';} ?>>TIK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Untuk Web</label>
                        <div class="col-sm-10">
                            <select name="untuk_web[<?=$row['id_user']?>]" id="untuk_web" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option value="semua" <?php if($untuk_web == "semua"){ echo 'selected';} ?>>Semua Web</option>
                            	<option value="monica" <?php if($untuk_web == "monica"){ echo 'selected';} ?>>MONICA</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password Baru</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
								<input type="checkbox" class="passaktif">Ubah Password
							</label>
							<input type="password" class="form-control password_aktif" name="password_baru" minlength="6" placeholder="Password Baru" disabled="disabled">
                        </div>
                    </div>
                    <input type="hidden" name="id_user[]" value="<?php echo $id_user;?>">
		        </div>
		        <div class="modal-footer">
		            <button type="submit" name="updateuseraktif" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>Update</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Batal</button>
		        </div>
	    	</form>
	    </div>
    </div>
</div>

<div class="modal fade" id="hapususeraktif<?php echo $id_user;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data User MONICA Aktif</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'kdr/manajemen_user_monica'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Menghapus Username " <?php echo $username ?> " Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_user" value="<?php echo $id_user;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="hapususeraktif" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tidak</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>
<?php endforeach;?>

<!-- Modal edit, hapus user nonaktif -->
<?php 
    foreach($user_monica_nonaktif as $row):
	$id_user      = $row['id_user'];
	$nama_lengkap = $row['nama_lengkap'];
	$username     = $row['username'];
	$level        = $row['level'];
	$status       = $row['status'];
	$nama_bagian  = $row['nama_bagian'];
	$untuk_web    = $row['untuk_web'];
?>

<div class="modal fade" id="editusernonaktif<?php echo $id_user;?>" tabindex="-1" role="dialog" aria-labelledby="edituseraktif" aria-hidden="true">
    <div class="modal-dialog" style="width:750px;">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit User MONICA Non Aktif</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'kdr/manajemen_user_monica'?>" method="post">
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
                        <label class="col-sm-2 control-label">Level</label>
                        <div class="col-sm-10">
                            <select name="level[<?=$row['id_user']?>]" id="level" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option value="" <?php if($level == ''){ echo 'selected';} ?>>-- Pilih Level --</option>
                            	<option value="staffkdr" <?php if($level == 'staffkdr'){ echo 'selected';} ?>>Staff KDR</option>
                            	<option value="nonadmin" <?php if($level == 'nonadmin'){ echo 'selected';} ?>>Non Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status[<?=$row['id_user']?>]" id="status" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option value=1 <?php if($status == 1){ echo 'selected';} ?>>Aktif</option>
                            	<option value=0 <?php if($status == 0){ echo 'selected';} ?>>Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Bagian</label>
                        <div class="col-sm-10">
                            <select name="nama_bagian[<?=$row['id_user']?>]" id="nama_bagian" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option value="kdr" <?php if($nama_bagian == "kdr"){ echo 'selected';} ?>>KDR</option>
                            	<option value="pqa" <?php if($nama_bagian == "pqa"){ echo 'selected';} ?>>PQA</option>
                            	<option value="isd" <?php if($nama_bagian == "isd"){ echo 'selected';} ?>>ISD</option>
                            	<option value="osd" <?php if($nama_bagian == "osd"){ echo 'selected';} ?>>OSD</option>
                            	<option value="opl" <?php if($nama_bagian == "opl"){ echo 'selected';} ?>>OPL</option>
                            	<option value="ost" <?php if($nama_bagian == "ost"){ echo 'selected';} ?>>OST</option>
                            	<option value="shd" <?php if($nama_bagian == "shd"){ echo 'selected';} ?>>SHD</option>
                            	<option value="inf" <?php if($nama_bagian == "inf"){ echo 'selected';} ?>>INF</option>
                            	<option value="pen" <?php if($nama_bagian == "pen"){ echo 'selected';} ?>>PEN</option>
                            	<option value="tik" <?php if($nama_bagian == "tik"){ echo 'selected';} ?>>TIK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Untuk Web</label>
                        <div class="col-sm-10">
                            <select name="untuk_web[<?=$row['id_user']?>]" id="untuk_web" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option value="semua" <?php if($untuk_web == "semua"){ echo 'selected';} ?>>Semua Web</option>
                            	<option value="monica" <?php if($untuk_web == "monica"){ echo 'selected';} ?>>MONICA</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password Baru</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
								<input type="checkbox" class="passnon">Ubah Password
							</label>
							<input type="password" class="form-control password_non" name="password_baru" minlength="6" placeholder="Password Baru" disabled="disabled">
                        </div>
                    </div>
                    <input type="hidden" name="id_user[]" value="<?php echo $id_user;?>">
		        </div>
		        <div class="modal-footer">
		            <button type="submit" name="updateusernonaktif" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>Update</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Batal</button>
		        </div>
	    	</form>
	    </div>
    </div>
</div>

<div class="modal fade" id="hapususernonaktif<?php echo $id_user;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data User MONICA Non Aktif</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'kdr/manajemen_user_monica'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Menghapus Username " <?php echo $username ?> " Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_user" value="<?php echo $id_user;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="hapususernonaktif" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tidak</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>
<?php endforeach;?>

<!-- Modal tambah user -->
<div class="modal fade" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambahkan User MONICA Baru</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('kdr/manajemen_user_monica'); ?>" method="post">
                <div class="modal-body">
                	<div class="form-group">
                        <label class="col-sm-2 control-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" minlength="6" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Level</label>
                        <div class="col-sm-10">
                            <select class="dropdown" name="level" required style="width: 100%;">
                            	<option class="option" value="" selected>-- Pilih Level --</option>
                                <option class="option" value="staffkdr">Staff KDR</option>
                                <option class="option" value="nonadmin">Non Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Bagian</label>
                        <div class="col-sm-10">
                            <select class="dropdown" name="nama_bagian" required style="width: 100%;">
                            	<option class="option" value="" selected>-- Pilih Bagian --</option>
                                <option class="option" value="kdr">KDR</option>
                                <option class="option" value="pqa">PQA</option>
                                <option class="option" value="isd">ISD</option>
                                <option class="option" value="osd">OSD</option>
                                <option class="option" value="opl">OPL</option>
                                <option class="option" value="ost">OST</option>
                                <option class="option" value="shd">SHD</option>
                                <option class="option" value="inf">INF</option>
                                <option class="option" value="pen">PEN</option>
                                <option class="option" value="tik">TIK</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Untuk Web</label>
                        <div class="col-sm-10">
                            <select class="dropdown" name="untuk_web" required style="width: 100%;">
                            	<option class="option" value="" selected>-- Untuk Web --</option>
                                <option class="option" value="semua">Semua Web</option>
                                <option class="option" value="monica">MONICA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="tambahuser" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
					Tambah User</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
					Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

	$(function () {
	    $('#tabel2').DataTable({
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
	$('.passaktif').click(function() 
	{
	    $('.password_aktif').attr('disabled',! this.checked)
	});

	$('.passnon').click(function() 
	{
	    $('.password_non').attr('disabled',! this.checked)
	});
</script>