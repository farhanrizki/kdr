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
				<li class="active">Edit Kegiatan</li>
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
											<form class="form-horizontal" action="<?php echo base_url().'kdr/kegiatan/update_kegiatan'?>" method="post">
												<fieldset>
												<?php foreach($lihat_kegiatan as $row) 
													{ 
														$date1           = $row['tgl_pelaksanaan'];
														$tgl_pelaksanaan = date('d-m-Y', strtotime($date1));
														$date2           = $row['end'];
														$tgl_berakhir    = date('d-m-Y', strtotime($date2));
												?>
													<legend class="text-center">Form Edit Kegiatan</legend>
													<div class="form-group">
														<label class="col-md-3 control-label">Nomor Surat</label>
														<div class="col-md-9">
															<input placeholder="Nomor Surat" type="text" class="form-control" name="no_surat" id="no_surat" 
															value="<?php echo $row['no_surat']; ?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label">Agenda</label>
														<div class="col-md-9">
															<input placeholder="Agenda" type="text" class="form-control" name="agenda" id="agenda" value="<?php echo $row['agenda']; ?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label">Tempat</label>
														<div class="col-md-9">
															<input placeholder="Agenda" type="text" class="form-control" name="tempat" id="tempat" value="<?php echo $row['tempat']; ?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="pic">Nama PIC</label>
														<div class="col-md-9">
															<input placeholder="Nama PIC" type="text" class="form-control" name="pic" id="pic" value="<?php echo $row['pic']; ?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label">Kategori</label>
														<div class="col-md-9">
														 	<select class="form-control" name="kategori" required>
														 		<option value="">-- Pilih Kategori --</option>
																<option value="audit" <?php if($row['kategori']=="audit") echo 'selected="selected"'; ?>>Audit</option>
																<option value="compliance" <?php if($row['kategori']=="compliance") echo 'selected="selected"'; ?>>Compliance</option>
																<option value="meeting" <?php if($row['kategori']=="meeting") echo 'selected="selected"'; ?>>Meeting</option>
																<option value="mr" <?php if($row['kategori']=="mr") echo 'selected="selected"'; ?>>Mr</option>
																<option value="patching" <?php if($row['kategori']=="patching") echo 'selected="selected"'; ?>>Patching</option>
																<option value="training" <?php if($row['kategori']=="training") echo 'selected="selected"'; ?>>Training</option>
																<option value="other" <?php if($row['kategori']=="other") echo 'selected="selected"'; ?>>Other</option>
															</select> 
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label">Sub Kategori</label>
														<div class="col-md-9">
														 	<select class="form-control" name="subkategori" required>
														 		<option value="">-- Pilih Sub Kategori --</option>
																<option value="compliance" <?php if($row['sub_kategori']=="compliance") echo 'selected="selected"'; ?>>Compliance</option>
																<option value="entrance" <?php if($row['sub_kategori']=="entrance") echo 'selected="selected"'; ?>>Entrance</option>
																<option value="exit" <?php if($row['sub_kategori']=="exit") echo 'selected="selected"'; ?>>Exit</option>
																<option value="iso" <?php if($row['sub_kategori']=="iso") echo 'selected="selected"'; ?>>Iso</option>
																<option value="patching" <?php if($row['sub_kategori']=="patching") echo 'selected="selected"'; ?>>Patching</option>
																<option value="pendidikan" <?php if($row['sub_kategori']=="pendidikan") echo 'selected="selected"'; ?>>Pendidikan</option>
																<option value="project" <?php if($row['sub_kategori']=="project") echo 'selected="selected"'; ?>>Project</option>
																<option value="risk" <?php if($row['sub_kategori']=="risk") echo 'selected="selected"'; ?>>Risk</option>
																<option value="data audit" <?php if($row['sub_kategori']=="data audit") echo 'selected="selected"'; ?>>Data Audit</option>
																<option value="audit eksternal" <?php if($row['sub_kategori']=="audit eksternal") echo 'selected="selected"'; ?>>Audit Eksternal</option>
																<option value="tl audit" <?php if($row['sub_kategori']=="tl audit") echo 'selected="selected"'; ?>>TL Audit</option>
																<option value="other" <?php if($row['sub_kategori']=="other") echo 'selected="selected"'; ?>>Other</option>
															</select> 
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label">Tgl Pelaksanaan</label>
														<div class="col-md-9">
															<input placeholder="Tgl Pelaksanaan" type="text" class="form-control" name="tgl_pelaksanaan" id="tgl_pelaksanaan" value="<?php echo $tgl_pelaksanaan; ?>" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label">Tgl Berakhir</label>
														<div class="col-md-9">
															<input placeholder="Tgl Berakhir" type="text" class="form-control" name="tgl_berakhir" id="tgl_berakhir" value="<?php echo $tgl_berakhir; ?>" required>
														</div>
													</div>

													<!--<div class="form-group">
                                                        <label class="col-md-3 control-label">Warna</label>
                                                        <div class="col-md-9">
                                                            <select name="color" class="form-control" required>
                                                                <option value="">-- Pilih Warna --</option>
                                                                <option style="color:#0071c5;" value="#0071c5" <?php if($row['color']=="#0071c5") echo 'selected="selected"'; ?>>&#9724; Dark blue</option>
                                                                <option style="color:#40E0D0;" value="#40E0D0" <?php if($row['color']=="#40E0D0") echo 'selected="selected"'; ?>>&#9724; Turquoise</option>
                                                                <option style="color:#008000;" value="#008000" <?php if($row['color']=="#008000") echo 'selected="selected"'; ?>>&#9724; Green</option>                       
                                                                <option style="color:#FFD700;" value="#FFD700" <?php if($row['color']=="#FFD700") echo 'selected="selected"'; ?>>&#9724; Yellow</option>
                                                                <option style="color:#FF8C00;" value="#FF8C00" <?php if($row['color']=="#FF8C00") echo 'selected="selected"'; ?>>&#9724; Orange</option>
                                                                <option style="color:#FF0000;" value="#FF0000" <?php if($row['color']=="#FF0000") echo 'selected="selected"'; ?>>&#9724; Red</option>
                                                                <option style="color:#000;" value="#000" <?php if($row['color']=="#000") echo 'selected="selected"'; ?>>&#9724; Black</option>
                                                            </select>
                                                        </div>
                                                    </div>-->

													<input type="hidden" name="id_kegiatan" value="<?php echo $row['id_kegiatan']; ?>">

													<div class="form-group">
														<div class="col-md-12 text-right">
															<button type="submit" class="btn btn-primary"><i class="ace-icon fa fa-edit"></i>&nbsp; Edit Kegiatan</button>
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