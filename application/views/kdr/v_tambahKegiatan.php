<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li>
					<a href="<?php echo base_url('kdr/kegiatan'); ?>">Kegiatan</a>
				</li>
				<li class="active">Tambah Kegiatan</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                    		<div class="container">
								<div class="row">
									<div class="col-md-6 col-md-offset-3">
										<div class="well well-sm">
											<form class="form-horizontal" action="<?php echo base_url().'kdr/kegiatan/simpan_kegiatan'?>" method="post">
												<fieldset>
													<legend class="text-center">Form Tambah Kegiatan</legend>
													<div class="form-group">
														<label class="col-md-3 control-label" for="no_surat">Nomor Surat</label>
														<div class="col-md-9">
															<input placeholder="Nomor Surat" type="text" class="form-control" name="no_surat" id="no_surat" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="agenda">Agenda</label>
														<div class="col-md-9">
															<input placeholder="Agenda" type="text" class="form-control" name="agenda" id="agenda" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="tempat">Tempat</label>
														<div class="col-md-9">
															<input placeholder="Agenda" type="text" class="form-control" name="tempat" id="tempat" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="pic">Nama PIC</label>
														<div class="col-md-9">
															<input placeholder="Nama PIC" type="text" class="form-control" name="pic" id="pic" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="kategori">Kategori</label>
														<div class="col-md-9">
														 	<select class="form-control" name="kategori" required>
														 		<option value="">-- Pilih Kategori --</option>
																<option value="audit">Audit</option>
																<option value="compliance">Compliance</option>
																<option value="meeting">Meeting</option>
																<option value="mr">Mr</option>
																<option value="patching">Patching</option>
																<option value="training">Training</option>
																<option value="other">Other</option>
															</select> 
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="subkategori">Sub Kategori</label>
														<div class="col-md-9">
														 	<select class="form-control" name="subkategori" required>
														 		<option value="">-- Pilih Sub Kategori --</option>
																<option value="compliance">Compliance</option>
																<option value="entrance">Entrance</option>
																<option value="exit">Exit</option>
																<option value="iso">Iso</option>
																<option value="patching">Patching</option>
																<option value="pendidikan">Pendidikan</option>
																<option value="project">Project</option>
																<option value="risk">Risk</option>
																<option value="data audit">Data Audit</option>
																<option value="audit eksternal">Audit Eksternal</option>
																<option value="tl audit">TL Audit</option>
																<option value="other">Other</option>
															</select> 
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="tgl_pelaksanaan">Tgl Pelaksanaan</label>
														<div class="col-md-9">
															<input placeholder="Tgl Pelaksanaan" type="text" class="form-control" name="tgl_pelaksanaan" id="tgl_pelaksanaan" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="tgl_berakhir">Tgl Berakhir</label>
														<div class="col-md-9">
															<input placeholder="Tgl Berakhir" type="text" class="form-control" name="tgl_berakhir" id="tgl_berakhir" required>
														</div>
													</div>

													<!--<div class="form-group">
                                                        <label class="col-md-3 control-label">Warna</label>
                                                        <div class="col-md-9">
                                                            <select name="color" class="form-control" required>
                                                                <option value="">-- Pilih Warna --</option>
                                                                <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                                                <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                                                <option style="color:#008000;" value="#008000">&#9724; Green</option>                       
                                                                <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                                                <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                                                <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                                                <option style="color:#000;" value="#000">&#9724; Black</option>
                                                            </select>
                                                        </div>
                                                    </div>-->

													<div class="form-group">
														<div class="col-md-12 text-right">
															<button type="submit" class="btn btn-primary"><i class="ace-icon fa fa-plus"></i></i>&nbsp; Tambah Kegiatan</button>
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
<link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/jquery.tagit.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>assets/js/tag-it.js" type="text/javascript" charset="utf-8"></script>

<!-- Datepicker -->
<script>
	$('#tgl_pelaksanaan').datepicker({
	    format: 'dd-mm-yyyy',
	    autoclose: true
	});

	$('#tgl_berakhir').datepicker({
	    format: 'dd-mm-yyyy',
	    autoclose: true
	});
</script>

<!-- Tagging -->
<script>
    $(function(){
	    var myTags = $('#pic');
	    myTags.tagit({
	        allowSpaces: true,
	        removeConfirmation: true,
	        autocomplete: {
	            source: "<?php echo base_url('kdr/kegiatan/data_username/'); ?>"
	        }
	    });
	});
</script>