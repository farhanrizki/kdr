<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li class="active">Edit Bobot</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
			<div class="page-header">
				<h1>
					Edit Bobot
				</h1>
			</div>
			
			<?php if(isset($berhasil_update)) { echo $berhasil_update; } if(isset($gagal_update)) { echo $gagal_update; } ?>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                    		<div class="container">
								<div class="row" style=" margin-top:20px;">
									<div class="col-md-6 col-md-offset-3">
										<div class="well well-sm">
											<form class="form-horizontal" action="<?php echo base_url().'risk/edit_bobot'?>" method="post">
												<?php foreach($tampil_bobot as $row) { ?>
												<fieldset>
													<legend class="text-center">Atur Bobot</legend>
													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">PQA</label>
														<div class="col-md-9">
															<input id="pqa" name="pqa" type="text" placeholder="PQA" class="form-control" value="<?=$row['pqa']?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="inf">INF</label>
														<div class="col-md-9">
															<input id="inf" name="inf" type="text" placeholder="INF" class="form-control" value="<?=$row['inf']?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="shd">SHD</label>
														<div class="col-md-9">
															<input id="shd" name="shd" type="text" placeholder="SHD" class="form-control" value="<?=$row['shd']?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="ost">OST</label>
														<div class="col-md-9">
															<input id="ost" name="ost" type="text" placeholder="OST" class="form-control" value="<?=$row['ost']?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="osd">OSD</label>
														<div class="col-md-9">
															<input id="osd" name="osd" type="text" placeholder="OSD" class="form-control" value="<?=$row['osd']?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="osd">OPL</label>
														<div class="col-md-9">
															<input id="opl" name="opl" type="text" placeholder="OPL" class="form-control" value="<?=$row['opl']?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="isd">ISD</label>
														<div class="col-md-9">
															<input id="isd" name="isd" type="text" placeholder="ISD" class="form-control" value="<?=$row['isd']?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="pen">PEN</label>
														<div class="col-md-9">
															<input id="pen" name="pen" type="text" placeholder="PEN" class="form-control" value="<?=$row['pen']?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="tik">TIK</label>
														<div class="col-md-9">
															<input id="tik" name="tik" type="text" placeholder="TIK" class="form-control" value="<?=$row['tik']?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="tik">KDR</label>
														<div class="col-md-9">
															<input id="kdr" name="kdr" type="text" placeholder="KDR" class="form-control" value="<?=$row['kdr']?>" required>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-md-12 text-right">
															<button type="submit" name="editbobot" class="btn btn-primary"><i class="ace-icon fa fa-check bigger-110"></i></i>&nbsp; Edit Bobot</button>
														</div>
													</div>
												</fieldset>
												<?php } ?>
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