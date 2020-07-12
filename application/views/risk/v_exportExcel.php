<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon glyphicon glyphicon-user "></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li class="active">Export Excel</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
			<div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                    		<div class="container">
								<div class="row" style=" margin-top:20px;">
									<div class="col-md-6 col-md-offset-3">
										<div class="well well-sm">
											<form class="form-horizontal" action="<?php echo base_url().'risk/eksport_excel'?>" method="post">
												<fieldset>
													<legend class="text-center">Form Export Excel</legend>
													<div class="form-group">
														<label class="col-md-3 control-label" for="tanggal_awal">Tanggal Awal
														</label>
														<div class="col-md-9">
															<input id="tanggal_awal" name="tanggal_awal" type="text" placeholder="Tanggal Awal" class="form-control" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="tanggal_akhir">Tanggal Akhir
														</label>
														<div class="col-md-9">
															<input id="tanggal_akhir" name="tanggal_akhir" type="text" placeholder="Tanggal Akhir" class="form-control" required>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-md-12 text-right">
															<button type="submit" name="exportexcel" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i>&nbsp; Export Excel</button>
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

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css" />
<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>

<!-- DATEPICKER -->
<script>
	$(document).ready(function () {
		$('#tanggal_awal').datepicker({
			uiLibrary: 'bootstrap',
			format: 'dd-mm-yyyy',
			autoclose: true
	    });

	    $('#tanggal_akhir').datepicker({
			uiLibrary: 'bootstrap',
			format: 'dd-mm-yyyy',
			autoclose: true
	    });
	});
</script>