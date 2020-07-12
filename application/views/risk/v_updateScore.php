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
				<li>
					<a href="<?php echo base_url('risk/monitoring/list_score'); ?>">List Score</a>
				</li>
				<li class="active">Update Score</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">

                    	<!-- Untuk Kontrol Skor Server -->
                    	<div class="col-xs-6">
							<div class="well well-sm">
								<form class="form-horizontal" action="<?php echo base_url().'risk/monitoring/simpan_skor_server'?>" method="post">
									<fieldset>
										<legend class="text-center">Update Score Server</legend>
										<?php foreach($data_app_server as $row) { ?>
											<div class="form-group">
												<label class="col-md-3 control-label">IP Server</label>
												<div class="col-md-9">
													<input placeholder="Jumlah Agenda" type="text" class="form-control"name="ip_server" id="ip_server" 
													value="<?php echo $row['ip_server']; ?>" disabled>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Jenis Server</label>
												<div class="col-md-9">
													<input placeholder="Jumlah Agenda" type="text" class="form-control"name="jenis_server" id="jenis_server" 
													value="<?php echo $row['jenis_server']; ?>" disabled>
												</div>
											</div>
											<input type="hidden" name="id_app_server" id="id_app_server" 
											value="<?php echo $row['id_app_server']; ?>">
										<?php } ?>
										<?php foreach($list_risk_server as $data) { ?>
											<div class="form-group">
												<label class="col-md-3 control-label"><?php echo $data['nama_risk']; ?></label>
												
												<?php if($score_server_kosong == 0) { ?>
												<div class="col-md-9">
													<select class="form-control" name="score_risk[<?=$data['id_list_risk']?>]" 
													required>
												 		<option value=0 <?php echo 'selected'; ?>>0</option>
														<option value=1>1</option>
														<option value=2>2</option>
														<option value=3>3</option>
														<option value=4>4</option>
														<option value=5>5</option>
													</select> 
												</div>
												<?php } else {  ?>
												<div class="col-md-9">
													<select class="form-control" name="score_risk[<?=$data['id_list_risk']?>]" 
													required>
												 		<option value=0 <?php if($data['score_risk'] == 0){ echo 'selected';} ?>>0</option>
														<option value=1 <?php if($data['score_risk'] == 1){ echo 'selected';} ?>>1</option>
														<option value=2 <?php if($data['score_risk'] == 2){ echo 'selected';} ?>>2</option>
														<option value=3 <?php if($data['score_risk'] == 3){ echo 'selected';} ?>>3</option>
														<option value=4 <?php if($data['score_risk'] == 4){ echo 'selected';} ?>>4</option>
														<option value=5 <?php if($data['score_risk'] == 5){ echo 'selected';} ?>>5</option>
													</select> 
												</div>
												<?php } ?>
											</div>
											<input type="hidden" name="id_list_risk[]" value="<?php echo $data['id_list_risk']; ?>">
											<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
											<input type="hidden" name="app_server" value="<?php echo $penanda_app_server; ?>">
											<input type="hidden" name="id_app" value="<?php echo $penanda_id_app; ?>">
											<input type="hidden" name="id_server" value="<?php echo $penanda_id_server; ?>">
										<?php } ?>
										<div class="form-group">
											<div class="col-md-12 text-right">
												<button type="submit" class="btn btn-primary" name="btnserver" value="1"><i class="ace-icon fa fa-edit"></i>&nbsp; Update Score Server</button>
												<button type="button" class="btn btn-primary" 
												onclick="window.location='<?php echo base_url("risk/monitoring/list_score");?>'"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp; Kembali 
		    									</button>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div>

						<!-- Untuk Kontrol Skor Aplikasi -->
                    	<div class="col-xs-6">
							<div class="well well-sm">
								<form class="form-horizontal" action="<?php echo base_url().'risk/monitoring/simpan_skor_aplikasi'?>" method="post">
									<fieldset>
										<legend class="text-center">Update Score Aplikasi</legend>
										<?php foreach($data_app_server as $row) { ?>
											<div class="form-group">
												<label class="col-md-3 control-label">Nama Aplikasi</label>
												<div class="col-md-9">
													<input placeholder="Jumlah Agenda" type="text" class="form-control"name="jml_agenda" id="jml_agenda" 
													value="<?php echo $row['nama_app']; ?>" disabled>
												</div>
											</div>
											<input type="hidden" name="id_app_server" value="<?php echo $row['id_app_server']; ?>">
										<?php } ?>
										<?php foreach($list_risk_aplikasi as $data) { ?>
											<div class="form-group">
												<label class="col-md-3 control-label"><?php echo $data['nama_risk']; ?></label>
												
												<?php if($score_aplikasi_kosong == 0) { ?>
												<div class="col-md-9">
													<select class="form-control" name="score_risk[<?=$data['id_list_risk']?>]" required>
												 		<option value=0 <?php echo 'selected'; ?>>0</option>
														<option value=1>1</option>
														<option value=2>2</option>
														<option value=3>3</option>
														<option value=4>4</option>
														<option value=5>5</option>
													</select> 
												</div>
												<?php } else {  ?>
												<div class="col-md-9">
													<select class="form-control" name="score_risk[<?=$data['id_list_risk']?>]" required>
												 		<option value=0 <?php if($data['score_risk'] == 0){ echo 'selected';} ?>>0</option>
														<option value=1 <?php if($data['score_risk'] == 1){ echo 'selected';} ?>>1</option>
														<option value=2 <?php if($data['score_risk'] == 2){ echo 'selected';} ?>>2</option>
														<option value=3 <?php if($data['score_risk'] == 3){ echo 'selected';} ?>>3</option>
														<option value=4 <?php if($data['score_risk'] == 4){ echo 'selected';} ?>>4</option>
														<option value=5 <?php if($data['score_risk'] == 5){ echo 'selected';} ?>>5</option>
													</select> 
												</div>
												<?php } ?>
											</div>
											<input type="hidden" name="id_list_risk[]" value="<?php echo $data['id_list_risk']; ?>">
											<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
											<input type="hidden" name="app_server" value="<?php echo $penanda_app_server; ?>">
											<input type="hidden" name="id_app" value="<?php echo $penanda_id_app; ?>">
											<input type="hidden" name="id_server" value="<?php echo $penanda_id_server; ?>">
										<?php } ?>
										<div class="form-group">
											<div class="col-md-12 text-right">
												<button type="submit" class="btn btn-primary" name="btnapp" value="1"><i class="ace-icon fa fa-edit"></i>&nbsp; Update Score Aplikasi</button>
												<button type="button" class="btn btn-primary" 
												onclick="window.location='<?php echo base_url("risk/monitoring/list_score");?>'"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp; Kembali 
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