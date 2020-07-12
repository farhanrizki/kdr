<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li class="active">App Server</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
						<form method="post" action="<?php echo base_url(); ?>risk/app_server/tambah_app">
							<input type="hidden" value="<?php echo $level_risk;?>" name="level_risk">
					    	<button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i>&nbsp; Tambah App Server </button>
						</form>
						<br>
	                    <div class="box-body">
	                    	<div class="col-xs-5">
	                    		<h4 align="center">Data List App</h4>
		                        <table id="list-app" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>Nama App</th>
											<th>Bia App</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
				
									</tbody>
								</table>
							</div>

							<div class="col-xs-7">
								<h4 align="center">Data List Server</h4>
		                        <table id="list-server" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>Ip Server</th>
											<th>Nama Server</th>
											<th>Jenis Server</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody id="show_list_server">
				
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

<!-- Detail List App -->
<div class="modal fade" id="modal_detail_app" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div id="judul-detail"></div>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="table_detail" width="570">
                    <thead>
                        <tr>
                            <th>Ip Server</th>
                            <th>Nama Server</th>
                            <th>Jenis Server</th>
                        </tr>
                    </thead>
                    <!--<tbody id="isi_table"></tbody>-->
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-check"></i>&nbsp; Ok</button>
            </div>
        </div>
    </div>
</div> 

<!-- Edit List App  -->
<div class="modal fade" id="modal_list_app" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_list_app" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama App</label>
                            <div class="col-md-9">
                                <input name="nama_app" placeholder="Nama App" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Bia App</label>
                            <div class="col-md-9">
                                <select name="bia_app" class="chosen-select form-control" id="bia_app" required>
                                    <option class="option" value="5">Very Critical</option>
                                    <option class="option" value="4">Critical</option>
                                    <option class="option" value="3">High</option>
                                    <option class="option" value="2">Medium</option>
                                    <option class="option" value="1">Low</option>
                                </select>
                            </div>
                        </div>
                        <input name="id_list_app" id="id_list_app" type="hidden">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="update_list_app()" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Update List App</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit List Server  -->
<div class="modal fade" id="modal_list_server" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_list_server" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Ip Server</label>
                            <div class="col-md-9">
                                <input name="ip_server" id="ip_server" class="form-control" type="text" placeholder="Ip Server"required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Server</label>
                            <div class="col-md-9">
                                <input name="nama_server" id="nama_server" class="form-control" type="text" placeholder="Nama Server" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenis Server</label>
                            <div class="col-md-9">
                                <input name="jenis_server" id="jenis_server" class="form-control" type="text" placeholder="Jenis Server" readonly>
                            </div>
                        </div>
                        <input name="id_list_server" id="id_list_server" type="hidden">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="update_list_server()" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Update List Server</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Hapus List Server  -->
<div class="modal fade" id="hapus_list_server" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Server ini dipakai untuk aplikasi berikut, pilih server di aplikasi mana yang akan dihapus?</h4>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_hapus_server" class="form-horizontal">
                    <div class="tampil-semua" style="font-size:20px;">
                        
                    </div>
                    <div class="tampil-nama-app" style="font-size:18px;">
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="hapus_list_server()" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Hapus Server</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- List App dan List Server -->
<script type="text/javascript">
    //List App
    var save_method;
    var table_list_app;
    $(document).ready(function() {
        table_list_app = $('#list-app').DataTable({ 
            "processing": true, 
            "serverSide": true, 
            "sScrollX": true,
            "scrollY":  "245px",
            "scrollCollapse": true,
            "searching": true,
            "autoWidth": false,
            "ajax": {
                "url": "<?php echo base_url('risk/app_server/data_list_app')?>",
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

    function tampil_app(id_list_app)
    {
        $.ajax({
            url : "<?php echo base_url('risk/app_server/detail_list_app/')?>/" + id_list_app,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_detail_app').modal('show');
                var dataTable = $("#table_detail").DataTable();
                dataTable.clear().draw();
                var nama_app = "";
                $.each(data, function(index, value) {
                    var row = dataTable.row.add([value.ip_server, value.nama_server, value.jenis_server]).draw().node();
                    
                    //Send value by cursor over
                    $('#table_detail').on('mouseover', 'tbody tr', function() {
                        var row2 = this._DT_RowIndex;
                        //console.log ('col #1 ', dataTable.cell( row, 0 ).data() );
                        var ip_server = dataTable.cell(row2,0).data();
                        $.ajax({
                            url : "<?php echo base_url('risk/app_server/detail_list_app2/')?>/" + ip_server,
                            type: "GET",
                            dataType: "JSON",
                            success: function(data)
                            {
                                $(row).attr({
                                   'data-toggle': 'tooltip',
                                   'data-placement': 'left',
                                   'title': 'Dipakai untuk aplikasi : ' + data
                                });
                                $('[data-toggle="tooltip"]', row).tooltip();
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Gagal');
                            }
                        });
                    });
                    nama_app = value.nama_app;
                });
                document.getElementById('judul-detail').innerHTML = '<h4>Detail List App '+nama_app+ '</h4>';
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal load data list app');
            }
        });
    }

    function edit_app(id_list_app)
    {
        save_method = 'update';
        $('#form_list_app')[0].reset(); // reset form on modals

        $.ajax({
            url : "<?php echo base_url('risk/app_server/edit_list_app/')?>/" + id_list_app,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_list_app"]').val(data.id_list_app);
                $('[name="nama_app"]').val(data.nama_app);
                $('[name="bia_app"]').val(data.bia_app);

                $('#modal_list_app').modal('show');
                $('.modal-title').text('Edit List App');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal load data list app');
            }
        });
    }

    function reload_table()
    {
        table_list_app.ajax.reload(null,false); 
    }

    function update_list_app()
    {
        var url;
        url = "<?php echo base_url('risk/app_server/update_list_app')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_list_app').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_list_app').modal('hide');
                reload_table();
                alert('Update list app berhasil');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal update list app');
            }
        });
    }

    function delete_app(id_list_app)
    {
        if(confirm('Yakin ingin hapus data?'))
        {
            //var marker;
            $.ajax({
                url : "<?php echo base_url('risk/app_server/hapus_list_app/')?>/" + id_list_app,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //alert(data);
                    alert("Data List App berhasil dihapus");
                    reload_table();
                    reload_table2();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Gagal Hapus List App');
                }
            });
        }
    }

    //List Server
    var save_method2;
    var table_list_server;
    $(document).ready(function() {
        table_list_server = $('#list-server').DataTable({ 
            "processing": true, 
            "serverSide": true, 
            "sScrollX": true,
            "scrollY":  "245px",
            "scrollCollapse": true,
            "searching": true,
            "autoWidth": false,
            "ajax": {
                "url": "<?php echo base_url('risk/app_server/data_list_server')?>",
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

    function edit_server(id_list_server)
    {
        save_method2 = 'update';
        $('#form_list_server')[0].reset(); 

        $.ajax({
            url : "<?php echo base_url('risk/app_server/edit_list_server/')?>/" + id_list_server,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_list_server"]').val(data.id_list_server);
                $('[name="ip_server"]').val(data.ip_server);
                $('[name="nama_server"]').val(data.nama_server);
                $('[name="jenis_server"]').val(data.jenis_server);

                $('#modal_list_server').modal('show');
                $('.modal-title').text('Edit List Server');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal load data list server');
            }
        });
    }

    function reload_table2()
    {
        table_list_server.ajax.reload(null,false); 
    }

    function update_list_server()
    {
        var url;
        url = "<?php echo base_url('risk/app_server/update_list_server')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_list_server').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_list_server').modal('hide');
                reload_table2();
                alert('Update list server berhasil');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal update list server');
            }
        });
    }

    function delete_server(id_list_server)
    {
        if(confirm('Yakin ingin hapus data?'))
        {
            $.ajax({
                url : "<?php echo base_url('risk/app_server/hapus_list_server/')?>/" + id_list_server,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //Jika jml server lebih dr 1
                    if(data.jml_server > 1)
                    {
                        $('#hapus_list_server').modal('show');
                        $('.tampil-nama-app').html('');
                        $('.tampil-semua').html('');
                        $.each(data.id_app_server,function(i,j){
                            $('.tampil-nama-app').append("<input type='checkbox' value='"+data.id_app_server[i]+"' name='id_app_server[]'> "+ data.nama_app[i] +"</br>");
                        });
                        $('.tampil-semua').append("<input type='checkbox' onclick='toggle(this);' name='pilih_semua'> Pilih Semua");
                    }
                    else
                    {
                        alert("Data List Server berhasil dihapus");
                        reload_table2();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Gagal Hapus List Server');
                }
            });
        }
    }

    function hapus_list_server()
    {
        var url;
        url = "<?php echo base_url('risk/app_server/hapus_list_server_double')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_hapus_server').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                alert('Data List Server berhasil dihapus');
                $('#hapus_list_server').modal('hide');
                reload_table2();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Gagal Hapus List Server');
            }
        });
    }
</script>

<!-- Check All -->
<script>
    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }
</script>