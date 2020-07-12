<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_monica'); ?>">Home</a>
				</li>
				<li>
					<a href="<?php echo base_url('monica/khasanah_eksternal'); ?>">Khasanah Eksternal</a>
				</li>
				<li class="active">Edit Khasanah Eksternal</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
			<div class="page-header">
				<h1>
					Edit Khasanah Eksternal
				</h1>
			</div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                    		<div class="container">
								<div class="row">
									<div class="col-md-6 col-md-offset-3">
										<div class="well well-sm">
											<form class="form-horizontal" action="<?php echo base_url().'monica/khasanah_eksternal/update_khasanah_eksternal'?>" method="post" 
												enctype="multipart/form-data">
												<fieldset>
												<?php foreach($lihat_eksternal as $row) { 
													$nomor_doc      = $row['nomor_doc'];
													$judul          = $row['judul'];
													$deskripsi      = $row['deskripsi'];
													$request_oleh   = $row['request_oleh'];
													$catatan_khusus = $row['catatan_khusus'];
													$file           = $row['file'];
												?>
													<legend class="text-center">Form Edit Khasanah Eksternal</legend>
													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">Nomor Dokumen</label>
														<div class="col-md-4">
															<select class="form-control" id="no_doc" name="no_doc" required>
																<option value="">Pilih Dokumen</option>
																<option value="CP-EXT" <?php if(substr($nomor_doc,0,6)=="CP-EXT") echo 'selected="selected"'; ?>>CP-EXT</option>
																<option value="BA-EXT" <?php if(substr($nomor_doc,0,6)=="BA-EXT") echo 'selected="selected"'; ?>>BA-EXT</option>
																<option value="PD-EXT" <?php if(substr($nomor_doc,0,6)=="PD-EXT") echo 'selected="selected"'; ?>>PD-EXT</option>
															</select>
														</div>
														<div class="col-sm-2">
													    	<input type="text" class="form-control" id="tahun" name="tahun" 
													    	value="<?php echo date("Y"); ?>" readonly>
													    </div>
													    <div class= "col-sm-2">
													    	<input type="text" class="form-control" id="angka" name="angka" 
													    	value="<?php echo substr($nomor_doc,-4); ?>" readonly>

													    	<input type="hidden" id="nodoc_terakhir" name="nodoc_terakhir"
													    	value="<?php echo substr($nomor_doc,0,6); ?>">

													    	<input type="hidden" id="angka_terakhir" name="angka_terakhir"
													    	value="<?php echo substr($nomor_doc,-4); ?>">
													    </div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">Judul</label>
														<div class="col-md-9">
															<input type="text" class="form-control" id="judul" name="judul" 
                            								value="<?php echo $judul; ?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">Deskripsi</label>
														<div class="col-md-9">
															<input type="text" class="form-control" id="deskripsi" 
															name="deskripsi" value="<?php echo $deskripsi; ?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">Request Oleh</label>
														<div class="col-md-9">
															<input type="text" class="form-control" id="request_oleh" 
															name="request_oleh" value="<?php echo $request_oleh; ?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">Catatan Khusus</label>
														<div class="col-md-9">
															<input type="text" class="form-control" id="catatan_khusus" 
															name="catatan_khusus" value="<?php echo $catatan_khusus; ?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">Upload File</label>
														<div class="col-md-9">
															<input type="file" name="file">
								                            <span>
								                            	<a href="<?php echo base_url().'upload/compliance/eksternal/'.$file; ?>" class="dwn" target="_blank">
								                            		<?php echo $file; ?>
								                            	</a>
								                            </span>
								                            <input type="hidden" name="file_sebelum" value="<?php echo $file;?>">
														</div>
													</div>

													<input type="hidden" name="id_compliance" value="<?php echo $row['id_compliance']; ?>">
													<input type="hidden" name="username_monica" value="<?php echo $username_monica; ?>">

													<div class="form-group">
														<div class="col-md-12 text-right">
															<button type="submit" name="editbobot" class="btn btn-primary"><i class="ace-icon fa fa-edit"></i>&nbsp; Edit Compliance</button>
														</div>
													</div>
												<?php } ?>
												</fieldset>
											</form>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>			
	</div>
</div>

<!-- Get last no_doc int input --> 
<script>
	$('#no_doc').on('change', function() 
	{
		var no_doc         = $('#no_doc').val();
		var tahun          = $('#tahun').val();
		var nodoc_terakhir = $('#nodoc_terakhir').val();
		var angka_terakhir = $('#angka_terakhir').val();
	    $.ajax({
	        type: "POST",
	        url: "<?php echo base_url('monica/khasanah_eksternal/doc_ext_edit/'); ?>",
	        data: {no_doc: no_doc,tahun: tahun,nodoc_terakhir: nodoc_terakhir,angka_terakhir: angka_terakhir},
	        dataType: "JSON",
	        cache: false,
	        success:
	        function(data){
        		$("#angka").val(data);
	        }
	    });
    });
</script>