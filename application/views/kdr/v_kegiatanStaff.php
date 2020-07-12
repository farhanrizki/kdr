<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li class="active">Kegiatan Staff</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="alert"></div>
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <div id='calendar'></div>
                </div>
            </div>

			<div class="modal fade">
	            <div class="modal-dialog">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	                        <h4 class="modal-title"></h4>
	                    </div>
	                    <div class="modal-body">
	                        <div class="error"></div>
	                        <form class="form-horizontal" id="crud-form">
	                         	<div class="form-group">
	                                <label class="col-md-3 control-label" for="no_surat">Nomor Surat</label>
	                                <div class="col-md-9">
	                                    <input placeholder="Nomor Surat" id="no_surat" name="no_surat" type="text" class="form-control">
	                                </div>
	                            </div> 

	                            <div class="form-group">
	                                <label class="col-md-3 control-label" for="agenda">Agenda</label>
	                                <div class="col-md-9">
	                                    <input placeholder="Agenda" id="agenda" name="agenda" type="text" class="form-control">
	                                </div>
	                            </div>  

	                            <div class="form-group">
	                                <label class="col-md-3 control-label" for="tempat">Tempat</label>
	                                <div class="col-md-9">
	                                    <input placeholder="Tempat" id="tempat" name="tempat" type="text" class="form-control">
	                                </div>
	                            </div>  

	                            <div class="form-group">
	                                <label class="col-md-3 control-label" for="kategori">Kategori</label>
	                                <div class="col-md-9">
	                                    <select id="kategori" name="kategori" class="form-control">
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
	                                    <select id="subkategori" name="subkategori" class="form-control">
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

	                            <!--<div class="form-group">
									<label class="col-md-3 control-label" for="tgl_pelaksanaan">Tgl Pelaksanaan</label>
									<div class="col-md-9">
										<input placeholder="Tgl Pelaksanaan" type="text" class="form-control" name="tgl_pelaksanaan" id="tgl_pelaksanaan">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="tgl_berakhir">Tgl Berakhir</label>
									<div class="col-md-9">
										<input placeholder="Tgl Berakhir" type="text" class="form-control" name="tgl_berakhir" id="tgl_berakhir">
									</div>
								</div>
	                           
	                            <div class="form-group">
	                                <label class="col-md-3 control-label" for="color">Color</label>
	                                <div class="col-md-9">
	                                    <select id="color" name="color" class="form-control">
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

	                            <input type="hidden" id="start">
		                        <input type="hidden" id="end">
		                        <input type="hidden" id="user_modified">
		                        <input type="hidden" id="id_pic" value="<?php echo $id_user; ?>">
		                        <input type="hidden" id="pic" value="<?php echo $username_kdr; ?>">
	                        </form>
	                    </div>
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	                    </div>
	                </div>
	            </div>
	        </div>
    	</div>
    </div>
</div>