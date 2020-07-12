<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li>
					<a href="<?php echo base_url('risk/app_server'); ?>">App Server</a>
				</li>
				<li class="active">Tambah App Server</li>
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
											<form class="form-horizontal" action="<?php echo base_url().'risk/app_server/simpan_app'?>" method="post" name="myform">
												<fieldset>
													<legend class="text-center">Tambah App Server</legend>
													<div class="form-group">
														<label class="col-md-3 control-label">Nama Aplikasi</label>
														<div class="col-md-9">
															<select name="nama_app" style="width: 300px;" 
															class="nama_aplikasi" id="nama_aplikasi" required>
																<option value="">-- Pilih Nama Aplikasi --</option> 
																<?php foreach($get_nama_app as $row) { ?>
                                                                <option value="<?php echo $row['nama_app']; ?>">
                                                                    <?php echo $row['nama_app']; ?>
                                                                </option>
	                                                            <?php } ?>
                                                        	</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label">IP Server</label>
														<div class="col-md-9">
															<select name="ip_server" style="width: 300px;" class="ip_server" required>
																<option value="">-- Pilih IP Server --</option>
                                                        	</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label">IP DB</label>
														<div class="col-md-9">
															<select name="ip_db" style="width: 300px;" class="ip_db" required>
																<option value="">-- Pilih IP DB --</option>
                                                        	</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label">Bia App</label>
														<div class="col-md-9">
															<select name="bia_app" style="width: 300px;" class="bia_app" 
															required>
																<option value="">-- Pilih Bia App --</option> 
                                                        	</select>
														</div>
													</div>

													<!--<div class="form-group">
														<label class="col-md-3 control-label">IP Server</label>
														<div class="col-md-9">
															<select name="ip_server" style="width: 300px;" required>
																<option value="">-- Pilih IP Server --</option> 
																<?php foreach($get_ip_server as $row) { ?>
                                                                <option value="<?php echo $row['ip_server']; ?>">
                                                                    <?php echo $row['ip_server']; ?>
                                                                </option>
	                                                            <?php } ?>
                                                        	</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label">IP DB</label>
														<div class="col-md-9">
															<select name="db" style="width: 300px;" required>
																<option value="">-- Pilih IP DB --</option> 
																<?php foreach($get_ip_db as $row) { ?>
                                                                <option value="<?php echo $row['ip_server']; ?>">
                                                                    <?php echo $row['ip_server']; ?>
                                                                </option>
	                                                            <?php } ?>
                                                        	</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-3 control-label">Bia App</label>
														<div class="col-md-9">
															<select name="bia_app" style="width: 300px;" required>
																<option value="">-- Pilih Bia App --</option> 
																<option value="5">Very Critical</option>
																<option value="4">Critical</option>
																<option value="3">High</option>
																<option value="2">Medium</option>
                                                                <option value="1">Low</option>
                                                        	</select>
														</div>
													</div>-->
													
													<div class="form-group">
														<div class="col-md-12 text-right">
															<button type="submit" name="tambahapp" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i></i>&nbsp; Simpan App Server</button>
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

<script src="<?php echo base_url();?>assets/js/select2.min.js" type="text/javascript"></script>
<link href="<?php echo base_url();?>assets/css/select2.min.css" rel="stylesheet" type="text/css">

<!-- Tampil Combobox -->
<script>
	$("select").select2({
		tags: true,
		createTag: function (params) {
			return {
				id: params.term,
				text: params.term,
				newOption: true
			}
		},
		templateResult: function (data) {
			var $result = $("<span></span>");
			$result.text(data.text);
			if (data.newOption) {
				$result.append(" <em>(new)</em>");
			}
			return $result;
		}		 
	});

	//Dynamic data after pilih nama aplikasi
	$(function () {
		$(".nama_aplikasi").on('change', function (evt) {
			var nama_aplikasi = $(this).val();

			//Get Ip Server
			$.ajax({
                url : "<?php echo base_url();?>risk/app_server/get_ip_server",
                method : "POST",
                data : {nama_aplikasi: nama_aplikasi},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    html += '<option value="">-- Pilih IP Server --</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].ip_server+'">'+data[i].ip_server+'</option>';
                    }
                    $('.ip_server').html(html);
                }
            });

			//Get Ip DB
            $.ajax({
                url : "<?php echo base_url();?>risk/app_server/get_ip_db",
                method : "POST",
                data : {nama_aplikasi: nama_aplikasi},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    html += '<option value="">-- Pilih IP DB --</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+data[i].ip_server+'">'+data[i].ip_server+'</option>';
                    }
                    $('.ip_db').html(html);
                }
            });

            //Get Bia App
            $.ajax({
                url : "<?php echo base_url();?>risk/app_server/get_bia_app",
                method : "POST",
                data : {nama_aplikasi: nama_aplikasi},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;

                    for(i=0; i<data.length; i++){
                    	var nilai = data[i].bia_app;

                    	if(nilai == 5)
                    		{ ket_nilai = 'Very Critical'; }
	                    else if(nilai == 4)
	                    	{ ket_nilai = 'Critical'; }
	                    else if(nilai == 3)
	                    	{ ket_nilai = 'High'; }
	                    else if(nilai == 2)
	                    	{ ket_nilai = 'Medium'; }
	                    else 
	                    	{ ket_nilai = 'Low'; }

                    	if(typeof(nilai) != "undefined" && nilai != "0")
                    	{
                    		html += '<option value="'+data[i].bia_app+'">'+ket_nilai+'</option>';
                    	}
                    	else
                    	{
                    		html += '<option value="5">Very Critical</option>';
                    		html += '<option value="4">Critical</option>';
                    		html += '<option value="3">High</option>';
                    		html += '<option value="2">Medium</option>';
                    		html += '<option value="1">Low</option>';
                    	}
                    }
                    $('.bia_app').html(html);
                }
            });
		})
	})
</script>