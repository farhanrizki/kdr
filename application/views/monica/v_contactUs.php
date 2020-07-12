<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo base_url('monica/dashboard_monica'); ?>">Home</a>
                </li>
                <li class="active">Contact Us</li>
            </ul>
        </div>

        <!-- Login sebagai adminmonica atau superadmin -->
        <?php if($level_monica == 'adminkdr' || $level_monica == 'staffkdr' || $level_monica == 'kabagkdr') { ?>
	        <div class="page-content">
	            <div class="page-header">
					<h1>
						Data Contact Us
					</h1>
				</div>

        		<?php if(isset($berhasil_hapus)) { echo $berhasil_hapus; } if(isset($gagal_hapus)) { echo $gagal_hapus; } ?>

				<div class="row">
		            <div class="col-xs-12">
		                <div class="box box-primary">
		                    <div class="box-body">
		                        <table id="tabel" class="table table-bordered table-striped">
		                            <thead>
		                                <tr>
		                                	<th>Nomor</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Pesan</th>
											<th>Action</th>
		                                </tr>
		                            </thead>
		                            <tbody>
	                                <?php 
	                                	$no = 1;
										$today = date("Y-m-d");
										foreach($data_contact_us as $row)
										{ 	
									?>
										<tr>
											<td><?=$no++?></td>
											<td><?=$row['nama']?></td>
											<td><?=$row['email']?></td>
											<td><?=$row['pesan']?></td>
											<td align="center">
												<a class="red" href="" data-toggle='modal' data-target="#hapus_modal<?php echo $row['id_contact_us'];?>"> 
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
	        
	    <!-- Login sebagai user -->
    	<?php } else { ?>
	    	<div class="page-content" style="overflow-x: hidden;">
	    		<?php if(isset($berhasil_terkirim)) { echo $berhasil_terkirim; } if(isset($gagal_terkirim)) { echo $gagal_terkirim; } ?>
	            <div class="row">
	                <div class="col-xs-12">
	                    <div class="box box-primary">
	                        <div class="box-body">
	                    		<div class="container">
									<div class="row" style="margin-top:20px;">
										<div class="col-md-6 col-md-offset-3">
											<div class="well well-sm">
												<form class="form-horizontal" action="<?php echo base_url().'monica/contact_us'?>" method="post">
													<fieldset>
														<legend class="text-center">Contact Us</legend>
														<div class="form-group">
															<label class="col-md-3 control-label" for="nama">Nama</label>
															<div class="col-md-9">
																<input id="nama" name="nama" type="text" placeholder="Nama" class="form-control" required>
															</div>
														</div>
														<div class="form-group">
															<label class="col-md-3 control-label" for="email">Alamat Email</label>
															<div class="col-md-9">
																<input id="email" name="email" type="email" placeholder="Alamat Email" class="form-control" required>
															</div>
														</div>
														<div class="form-group">
															<label class="col-md-3 control-label" for="pesan">Pesan</label>
															<div class="col-md-9">
																<textarea class="form-control" id="pesan" name="pesan" 
																placeholder="Pesan" rows="5" required></textarea>
															</div>
														</div>
														<!-- Form actions -->
														<div class="form-group">
															<div class="col-md-12 text-right">
																<button type="submit" name="kirimpesan" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; Kirim Pesan</button>
															</div>
														</div>
													</fieldset>
												</form>
											</div>
										</div>
									</div>
									<div class="row" style=" margin-top:20px;">
										<div class="col-md-6 col-md-offset-3">
											<div class="well well-sm" style="text-align: center; font-weight: bold;">
												Hubungi Kami : 021 2323 2323
												<br>
												Email        : kdr@bri.com
											</div>
										</div>
									</div>
								</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
    	<?php } ?> 
    </div>
</div>

<!-- Modal Hapus Contact Us -->
<?php 
    foreach($data_contact_us as $row):
	$id_contact_us = $row['id_contact_us'];
?>

<div class="modal fade" id="hapus_modal<?php echo $id_contact_us;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data Audit Internal</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'monica/contact_us'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_contact_us" value="<?php echo $id_contact_us;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="hapuscontactus" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tidak</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>

<?php endforeach;?>

<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.min.js"></script>

<!-- Datatable -->
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