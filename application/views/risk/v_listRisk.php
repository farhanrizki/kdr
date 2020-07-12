<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li class="active">List Risk</li>
			</ul>
		</div>

		<div class="page-content">
			<?php if(isset($berhasil_simpan)) { echo $berhasil_simpan; } if(isset($gagal_simpan)) { echo $gagal_simpan; } ?>
			<?php if(isset($berhasil_update)) { echo $berhasil_update; } if(isset($gagal_update)) { echo $gagal_update; } ?>
			<?php if(isset($berhasil_hapus)) { echo $berhasil_hapus; } if(isset($gagal_hapus)) { echo $gagal_hapus; } ?>
			<?php if(isset($duplicate_risk)) { echo $duplicate_risk; } ?>

			<div class="row">
				<div class="col-xs-12">	
					<button data-target="#tambah_risk" data-toggle="modal" class="btn btn-sm btn-primary">
						<i class="glyphicon glyphicon-plus"></i> Tambah List Risk
					</button>
				</div>	

				<div class="col-xs-12">
					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
					</div>

					<div>
						<table id="mytable" class="table table-striped table-bordered table-hover">
							<thead>
								<tr class="primary">
									<th>No. </th>
									<th>Nama Risk</th>
									<th>Kategori Risk</th>
									<th>Bobot Risk</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$no = 1;
									foreach($data_list_risk as $row)
									{
								?>
										<tr>
											<td><?=$no++?>.</td>
											<td><?=$row['nama_risk']?></td>
											<td><?=$row['nama_kategori']?></td>
											<td><?=$row['bobot_risk']?></td>
											<td align="center">
												<div class="hidden-sm hidden-xs action-buttons">							
													<a class="green" href="" data-toggle="modal" data-target="#edit_risk<?php echo $row['id_list_risk'];?>"> 
														<i class="ace-icon fa fa-pencil bigger-130"></i>
													</a>
													<a class="red" href="" data-toggle='modal' data-target="#hapus_risk<?php echo $row['id_list_risk'];?>"> 
														<i class="ace-icon fa fa-trash-o bigger-130"></i>
													</a>
												</div>
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

<?php
   foreach($data_list_risk as $row):
	$id_list_risk     = $row['id_list_risk'];
	$id_kategori_risk = $row['id_kategori_risk'];
	$nama_risk        = $row['nama_risk'];
	$bobot_risk       = $row['bobot_risk'];
	$kontrol_skor     = $row['kontrol_skor'];
?>

<div class="modal fade" id="edit_risk<?php echo $id_list_risk;?>" tabindex="-1" role="dialog" aria-labelledby="edit_risk" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit List Risk</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'risk/list_risk'?>" method="post">
		        <div class="modal-body">
		            <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Risk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_risk" 
                            	value="<?php echo $nama_risk; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kategori Risk</label>
                        <div class="col-sm-10">
                            <select name="id_kategori_risk[<?=$row['id_list_risk']?>]" id="id_kategori_risk" 
                            class="chosen-select form-control" id="form-field-select-3" required>
                            	<option class="option" value="">-- Pilih Kategori --</option>
                            	<?php 
                            		foreach($data_kategori as $data) 
                            		{ 
                            			$tabel_kategori = $data['id_kategori_risk'];
                            			if($id_kategori_risk == $tabel_kategori)
                        				{
							                echo "<option selected ='selected' value=".$data['id_kategori_risk'].">".$data['nama_kategori']."</option>";
							            }
							            else
							            {
							                echo "<option value=".$data['id_kategori_risk'].">".$data['nama_kategori']."</option>";
							            }
							        }
                            	?>
                            </select>
                        </div>
                    </div>

		            <div class="form-group">
                        <label class="col-sm-2 control-label">Bobot Risk</label>
                        <div class="col-sm-10">
                            <select name="bobot_risk[<?=$row['id_list_risk']?>]" id="bobot_risk" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option value=1 <?php if($bobot_risk == 1){ echo 'selected';} ?>>1</option>
                            	<option value=2 <?php if($bobot_risk == 2){ echo 'selected';} ?>>2</option>
                            	<option value=3 <?php if($bobot_risk == 3){ echo 'selected';} ?>>3</option>
                            	<option value=4 <?php if($bobot_risk == 4){ echo 'selected';} ?>>4</option>
                            	<option value=5 <?php if($bobot_risk == 5){ echo 'selected';} ?>>5</option>
                            	<option value=6 <?php if($bobot_risk == 6){ echo 'selected';} ?>>6</option>
                            	<option value=7 <?php if($bobot_risk == 7){ echo 'selected';} ?>>7</option>
                            	<option value=8 <?php if($bobot_risk == 8){ echo 'selected';} ?>>8</option>
                            	<option value=9 <?php if($bobot_risk == 9){ echo 'selected';} ?>>9</option>
                            	<option value=10 <?php if($bobot_risk == 10){ echo 'selected';} ?>>10</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id_list_risk" value="<?php echo $id_list_risk;?>">
                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
		        </div>
		        <div class="modal-footer">
		            <button type="submit" name="updatelistrisk" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Update</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Batal</button>
		        </div>
	    	</form>
	    </div>
    </div>
</div>

<div class="modal fade" id="hapus_risk<?php echo $id_list_risk;?>" tabindex="-1" role="dialog" aria-labelledby="hapus_risk" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'risk/list_risk'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <h4>Apakah anda yakin ingin menghapus data ini ?</h4>
	                    </div>
	                    <input type="hidden" name="id_list_risk" value="<?php echo $id_list_risk;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="hapuslistrisk" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Tidak</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>

<?php endforeach;?>

<div class="modal fade" id="tambah_risk" tabindex="-1" role="dialog" aria-labelledby="tambah_risk" aria-hidden="true">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah List Risk</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('risk/list_risk'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Risk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_risk" name="nama_risk" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kategori Risk</label>
                        <div class="col-sm-10">
                            <select name="id_kategori_risk" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option class="option" value="">-- Pilih Kategori --</option>
                            	<?php foreach($data_kategori as $row) { ?>
                            		<option value="<?php echo $row['id_kategori_risk']; ?>">
                            			<?php echo $row['nama_kategori']; ?>
                            		</option>
                            	<?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Bobot Risk</label>
                        <div class="col-sm-10">
                            <select class="dropdown" name="bobot_risk" required style="width: 100%;">
                            	<option class="option" value="" selected>-- Pilih Bobot --</option>
                                <option class="option" value=1>1</option>
                                <option class="option" value=2>2</option>
                                <option class="option" value=3>3</option>
                                <option class="option" value=4>4</option>
                                <option class="option" value=5>5</option>
                                <option class="option" value=6>6</option>
                                <option class="option" value=7>7</option>
                                <option class="option" value=8>8</option>
                                <option class="option" value=9>9</option>
                                <option class="option" value=10>10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kontrol Skor</label>
                        <div class="col-sm-10">
                            <select class="dropdown" name="kontrol_skor" required style="width: 100%;">
                            	<option class="option" value="" selected>-- Pilih Kontrol Skor --</option>
                                <option class="option" value="1">Server</option>
                                <option class="option" value="2">Aplikasi</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                </div>
                <div class="modal-footer">
                	<button type="submit" name="tambahlistrisk" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
					Tambah</button>
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
	    $('#mytable').DataTable({
	        "paging": true,
	        "lengthChange": true,
	        "searching": true,
	        "ordering": true,
	        "info": true,
	        "autoWidth": true
	    });
	});
</script>