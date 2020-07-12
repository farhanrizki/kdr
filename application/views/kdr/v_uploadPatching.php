<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li class="active">Upload Patching</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
			<?php if(isset($berhasil_upload)) { echo $berhasil_upload; } if(isset($gagal_upload)) { echo $gagal_upload; } ?>
			<?php if(isset($tidak_valid)) { echo $tidak_valid; } ?>

			<style>
				#fader {
					opacity: 0.3;
					background: black;
					position: fixed;
					top: 0;
					right: 0;
					bottom: 0;
					left: 0;
					display: none;
				}
			</style>

			<div id="fader"></div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                    		<div class="container">
								<div class="row" style=" margin-top:20px;">
									<div class="col-md-6 col-md-offset-3">
										<div class="well well-sm">
											<form class="form-horizontal" action="<?php echo base_url().'kdr/upload_patching'?>" method="post" enctype="multipart/form-data">
												<fieldset>
													<legend class="text-center">Upload Patching</legend>
													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">File Upload</label>
														<div class="col-md-9" style="margin-top:5px;">
															<input type="file" name="csv" required>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-md-11 text-right">
															<button type="submit" name="upload" id="upload" class="btn btn-primary"><i class="ace-icon fa fa-upload bigger-110"></i></i>&nbsp; Upload</button>

															<button type="button" class="btn btn-primary" 
															onclick="window.location='<?php echo base_url("kdr/patching_resume");?>'">
															<i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Kembali 
											    			</button>
														</div>
													</div>
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

<script>
	$('#upload').click(function() {
		$('#fader').css('display', 'block');
	});
</script>