<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon glyphicon glyphicon-user "></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li class="active">Ubah Password</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
			<?php if(isset($berhasil_update)) { echo $berhasil_update; } if(isset($gagal_update)) { echo $gagal_update; }
				  if(isset($beda_dengan_konfirmasi)) { echo $beda_dengan_konfirmasi; } 
				  if(isset($beda_dengan_database)) { echo $beda_dengan_database; } ?>
			<div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                    		<div class="container">
								<div class="row" style=" margin-top:20px;">
									<div class="col-md-6 col-md-offset-3">
										<div class="well well-sm">
											<form class="form-horizontal" action="<?php echo base_url().'kdr/ubah_password'?>" method="post">
												<fieldset>
													<legend class="text-center">Form Ubah Password</legend>
													<div class="form-group">
														<label class="col-md-3 control-label" for="password_lama">Password Lama
														</label>
														<div class="col-md-9">
															<input id="password_lama" name="password_lama" type="password" placeholder="Password Lama" class="form-control" minlength="6" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="password_baru">Password Baru
														</label>
														<div class="col-md-9">
															<input id="password_baru" name="password_baru" type="password" placeholder="Password Baru" class="form-control" minlength="6" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="konfirmasi_password">Konfirmasi Password
														</label>
														<div class="col-md-9">
															<input id="konfirmasi_password" name="konfirmasi_password" type="password" placeholder="Konfirmasi Password" class="form-control" minlength="6" required>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-md-12 text-right">
															<button type="submit" name="ubahpassword" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>Ubah Password</button>
															<button type="reset" class="btn btn-default " data-dismiss="modal">Reset</button>
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