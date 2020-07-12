<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li class="active">Hari Libur</li>
			</ul>
		</div>

		<!-- Form tambah libur -->
		<div class="page-content" style="overflow-x: hidden;">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                    		<div class="container">
								<div class="row" style=" margin-top:20px;">
									<div class="col-md-6 col-md-offset-3">
										<div class="well well-sm">
											<form class="form-horizontal" action="<?php echo base_url().'kdr/hari_libur/tambah'?>" method="post">
												<fieldset>
													<legend class="text-center">Tambah Hari Libur</legend>
													<div class="form-group">
														<label class="col-md-3 control-label" for="pqa">Tanggal</label>
														<div class="col-md-9" style="margin-top:5px;">
															<input type="text" id="holidays" name="holidays" class="form-control input-sm" data-role="tagsinput"  required>
														</div>
													</div>
													
													<div class="form-group">
														<div class="col-md-11 text-right">
															<button type="submit" name="upload" id="upload" class="btn btn-primary"><i class="ace-icon fa fa-plus bigger-110"></i></i>&nbsp; Tambah Hari Libur</button>

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

        <!-- Table edit libur -->
        <div class="page-content" style="overflow-x: hidden;">
			<style>
				.baris { height: auto; }
				table.dataTable td {
  					word-break: break-word;
  					overflow: hidden;
				}
			</style>
			<div class="row">
	            <div class="col-xs-6">
	                <div class="box box-primary">
	                    <div class="box-body">
	                    	<div class="container">
								<div class="row">
									<div class="col-md-6 col-md-offset-3">
										<h4 align="center">Edit Hari Libur</h4>
				                        <table id="tanggal-libur" class="table table-bordered table-hover">
											<thead>
												<tr>
													<th>No.</th>
													<th>Tanggal Libur</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
						
											</tbody>
										</table>
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

<!-- Edit Modal  -->
<div class="modal fade" id="modal_libur" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_libur" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Tgl Libur</label>
                            <div class="col-md-9">
                                <input name="tgl_libur" id="tgl_libur" placeholder="Tgl Libur" class="form-control" type="date">
                            </div>
                        </div>
                        <input name="id_tgl_libur" id="id_tgl_libur" type="hidden">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" id="btnSave" onclick="update_libur()" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Update Libur</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Input Tgl -->
<script>
	$(document).ready(function(){
		$('#holidays').tagsinput({
		    typeaheadjs: {
		        minViewMode: 2,
		        format: 'yyyy',
		        multidate: true,
		        endDate: '+0y',
		        startDate: '2016'
		    }
		});
		$('#holidays').on('beforeItemRemove', function(event) {
			console.log("Deleting");
		});
		$('.bootstrap-tagsinput input[type="text"]').datepicker({
		    changeMonth: true,
		    changeYear: true,
		    showButtonPanel: true,
		    format: 'yyyy',
		    multidate: true,
		    endDate: '+0y',
		    startDate: '2016',
		    onSelect: function(dateText) {
		       $('#holidays').tagsinput('add', dateText);
		       $('.bootstrap-tagsinput input[type="text"]').datepicker('setDate', null);
		  	}
		});
	});
</script>

<!-- Tabel Hari Libur -->
<script type="text/javascript">
    var save_method;
    var hari_libur;
    $(document).ready(function() {
        hari_libur = $('#tanggal-libur').DataTable({ 
            "processing": true, 
            "serverSide": true, 
            "sScrollX": true,
            "scrollY":  "255px",
            "searching": true,
            "autoWidth": false,
            "ajax": {
                "url": "<?php echo base_url('kdr/hari_libur/data_hari_libur')?>",
                "type": "POST"
            },
            "columnDefs": [
                { 
                    "targets": [ -1 ],
                    "orderable": false,
                },
            ],
        });
    });

    function edit_libur(id_tgl_libur)
    {
        save_method = 'update';
        $('#form_libur')[0].reset(); 

        $.ajax({
            url : "<?php echo base_url('kdr/hari_libur/edit_hari_libur/')?>/" + id_tgl_libur,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
            	$('[name="id_tgl_libur"]').val(data.id_tgl_libur);
				$('[name="tgl_libur"]').val(data.tgl_libur);  
                $('#modal_libur').modal('show');
                $('.modal-title').text('Edit Libur');

                //Change format date from database
                /*var d = new Date(data.tgl_libur); 
				var tgl_libur =
				    ("0" + d.getDate()).slice(-2) + "-" +
				    ("0" + (d.getMonth() + 1)).slice(-2) + "-" + 
				    d.getFullYear();*/
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal load data');
            }
        });
    }

    function reload_table()
    {
        hari_libur.ajax.reload(null,false); 
    }

    function update_libur()
    {
        var url;
        url = "<?php echo base_url('kdr/hari_libur/update_hari_libur')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_libur').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_libur').modal('hide');
                reload_table();
                alert('Update libur berhasil');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal update libur');
            }
        });
    }
</script>