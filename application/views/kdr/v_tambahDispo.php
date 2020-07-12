<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li>
					<a href="<?php echo base_url('kdr/dispo_dio'); ?>">Dispo Dio</a>
				</li>
				<li class="active">Tambah Dispo Dio</li>
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
											<form class="form-horizontal" action="<?php echo base_url().'kdr/dispo_dio/simpan_dispo'?>" method="post">
												<fieldset>
													<legend class="text-center">Form Tambah Dispo Dio</legend>
													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">Nomor Surat</label>
														<div class="col-md-9">
															<input placeholder="Nomor Surat" type="text" class="form-control" name="no_surat" id="no_surat" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">Agenda</label>
														<div class="col-md-9">
															<input placeholder="Agenda" type="text" class="form-control" name="agenda" id="agenda" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">Nama PIC</label>
														<div class="col-md-9">
															<input placeholder="Nama PIC" type="text" class="form-control" name="pic" id="pic" required>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">Kategori</label>
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
														<label class="col-md-3 control-label" for="pqa">Sub Kategori</label>
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
														<label class="col-md-3 control-label" for="pqa">Tgl Deadline</label>
														<div class="col-md-9">
															<input placeholder="Tgl Deadline" type="text" class="form-control" name="due_date" id="due_date" required>
														</div>
													</div>

													<div class="form-group">
														<div class="col-md-12 text-right">
															<button type="submit" name="editbobot" class="btn btn-primary"><i class="ace-icon fa fa-plus"></i></i>&nbsp; Tambah Dispo</button>
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
	$('#due_date').datepicker({
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
	            source: "<?php echo base_url('kdr/dispo_dio/data_username/'); ?>"
	        }
	    });
	});
</script>

<!-- Mention Cara 1 jquery-mentiony-master
<textarea id="t1" name="mention1" class="mention1">Tambah PIC dengan ketik @</textarea>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.mentiony.css" />
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?lang=javascript&amp;skin=desert"></script>
<script src="<?php echo base_url();?>assets/js/jquery.mentiony.js"></script>
<script>
	$('textarea.mention1').mentiony({
	    onDataRequest: function (mode, keyword, onDataRequestCompleteCallback) {

	        var data = "<?php echo base_url('kdr/dispo_dio/json_search_country/'); ?>";

	        data = jQuery.grep(data, function( item ) {
	            return item.name.toLowerCase().indexOf(keyword.toLowerCase()) > -1;
	        });

	        // Call this to populate mention.
	        onDataRequestCompleteCallback.call(this, data);
	    },
	    timeOut: 0,
	    debug: 1,
	});
</script>
<script>
    $('textarea.mention1').mentiony({
        onDataRequest: function (mode, keyword, onDataRequestCompleteCallback) {

            var data = [
                { id:1, name:'Nguyen Luat', 'avatar':'https://goo.gl/WXAP1U', 'info':'Vietnam' , href: 'http://a.co/id'},
                { id:2, name:'Dinh Luat', 'avatar':'https://goo.gl/WXAP1U', 'info':'Vietnam' , href: 'http://a.co/id'},
                { id:3, name:'Max Luat', 'avatar':'https://goo.gl/WXAP1U', 'info':'Vietnam' , href: 'http://a.co/id'},
                { id:4, name:'John Neo', 'avatar':'https://goo.gl/WXAP1U', 'info':'Vietnam' , href: 'http://a.co/id'},
                { id:5, name:'John Dinh', 'avatar':'https://goo.gl/WXAP1U', 'info':'Vietnam' , href: 'http://a.co/id'},
                { id:6, name:'Test User', 'avatar':'https://goo.gl/WXAP1U', 'info':'Vietnam' , href: 'http://a.co/id'},
                { id:7, name:'Test User 2', 'avatar':'https://goo.gl/WXAP1U', 'info':'Vietnam' , href: 'http://a.co/id'},
                { id:8, name:'No Test', 'avatar':'https://goo.gl/WXAP1U', 'info':'Vietnam' , href: 'http://a.co/id'},
                { id:9, name:'The User Foo', 'avatar':'https://goo.gl/WXAP1U', 'info':'Vietnam' , href: 'http://a.co/id'},
                { id:10, name:'Foo Bar', 'avatar':'https://goo.gl/WXAP1U', 'info':'Vietnam' , href: 'http://a.co/id'},
            ];

            data = jQuery.grep(data, function( item ) {
                return item.name.toLowerCase().indexOf(keyword.toLowerCase()) > -1;
            });

            // Call this to populate mention.
            onDataRequestCompleteCallback.call(this, data);
        },
        timeOut: 0,
        debug: 1,
    });
</script>-->