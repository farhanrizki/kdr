<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('monica/dashboard_monica'); ?>">Home</a>
				</li>
				<li class="active">Khasanah Eksternal</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Data Khasanah Eksternal
				</h1>
			</div>

			<?php if(isset($berhasil_simpan)) { echo $berhasil_simpan; } if(isset($gagal_simpan)) { echo $gagal_simpan; } ?>
            <?php if(isset($duplicate_doc)) { echo $duplicate_doc; } ?>
			<?php if(isset($berhasil_hapus)) { echo $berhasil_hapus; } if(isset($gagal_hapus)) { echo $gagal_hapus; } ?>

			<style>
				.baris {height:auto;}
				table.dataTable td {word-break:break-word;overflow:hidden;}
			</style>

			<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                    <div class="col-xs-12">	
	                        <button data-target="#tambahkhasanah" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Khasanah Eksternal </button>
	                        <hr>
	                    </div>
	                    <div class="box-body">
	                        <table id="tabel" class="table table-bordered table-striped">
	                            <thead>
	                                <tr class="baris">
	                                	<th>Nomor</th>
										<th>Lihat Data</th>
	                                	<th>Nomor Dokumen</th>
	                                	<th>Judul</th>
										<th>Diminta Oleh</th>
										<th>Catatan Khusus</th>
										<th>File</th>
										<th>Dibuat Oleh</th>
										<th>Dibuat Tanggal</th>
										<th>Diedit Oleh</th>
										<th>Diedit Tanggal</th>
										<th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
                                <?php 
                                	$no = 1;
									foreach($data_khasanah_eksternal as $row)
									{ 
										$dibuat_tanggal = date("d-m-Y", strtotime($row['dibuat_tanggal']));
										$diedit_tanggal = date("d-m-Y", strtotime($row['diedit_tanggal']));
								?>
									<tr class="baris">
										<td><?=$no++?></td>
										<td align="center">
											<button type="button" class="view_data btn btn-primary btn-xs" 
											onclick="return LihatData(<?php echo $row['id_compliance'];?>);">LIHAT DETAIL
											</button>
										</td>
										<td><?=$row['nomor_doc']?></td>
										<td><?=$row['judul']?></td>
										<td><?=$row['request_oleh']?></td>
										<td align="center">
											<?php 
												if($row['catatan_khusus'] != "")
												{
													echo $row['catatan_khusus'];
												}
												else
												{
													echo "-";
												}
											?>
										</td>
										<td align="center">
											<?php if ($row['file'] != '') { ?>
												<a href="<?php echo base_url().'upload/compliance/eksternal/'.$row['file']; ?>" class="dwn" target="_blank"><?php echo $row['file']; ?></a>
											<?php } else { 
												echo "-";
											} ?>
										</td>
										<td><?=$row['dibuat_oleh']?></td>
										<td><?=$dibuat_tanggal?></td>
										<td><?=$row['diedit_oleh']?></td>
										<td><?=$diedit_tanggal?></td>
										<td align="center">
											<button type="button" class="view_data btn btn-primary btn-xs" 
											onclick="window.location='<?php echo base_url("monica/khasanah_eksternal/edit_khasanah_eksternal/".$row['id_compliance']);?>'"><i class="ace-icon fa fa-edit"></i></button>
											&nbsp;
											<button type="button" class="view_data btn btn-primary btn-xs" 
											data-toggle='modal' data-target="#hapus_modal<?php echo $row['id_compliance'];?>"><i class="ace-icon fa fa-trash-o bigger-130"></i></button>
										</td>
									</tr>
								<?php } ?>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
        	</div>
    	</div>
    </div>
</div>

<!-- Modal Lihat, Edit, Hapus Audit Eksternal -->
<?php 
    foreach($data_khasanah_eksternal as $row):
	$id_compliance = $row['id_compliance'];
	$file          = $row['file'];
?>
<div class="modal fade" id="hapus_modal<?php echo $id_compliance;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data Khasanah Eksternal</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'monica/khasanah_eksternal'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_compliance" value="<?php echo $id_compliance;?>">
	                    <input type="hidden" name="file_sebelum" value="<?php echo $file;?>">
	                    <input type="hidden" name="username_monica" value="<?php echo $username_monica;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="hapuskhasanaheksternal" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tidak</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>
<?php endforeach;?>

<div class="modal fade" id="lihat_modal" tabindex="-1" role="dialog" aria-labelledby="lihat_modal" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:1000px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Data Khasanah Eksternal</h4>
				<div class="modal-body">
		        	<table id="table1" class="table table-bordered table-hover responsive">
						<thead>
							<tr>
								<th>Nomor Dokumen</th>
								<th>Judul</th>
								<th>Deskripsi</th>
								<th>Diminta Oleh</th>
								<th>Catatan Khusus</th>
								<th>Dibuat Oleh</th>
								<th>Dibuat Tanggal</th>
							</tr>
						</thead>
						<tbody id="tampil_data"></tbody>
					</table>
	            </div>
	            <div class="modal-footer">
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tutup</button>
		        </div>
		    </div>
		</div>
	</div>
</div>

<div class="modal fade" id="tambahkhasanah" tabindex="-1" role="dialog" aria-labelledby="tambahkhasanah" aria-hidden="true">
    <div class="modal-dialog" style="width:1000px;">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Data Khasanah Eksternal</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'monica/khasanah_eksternal'?>" method="post" enctype="multipart/form-data">
		        <div class="modal-body">
		            <div class="form-group">
                        <label class="col-sm-2 control-label">Nomor Dokumen</label>
                        <div class="form-group">
						    <div class="col-sm-2">
						    	<select id="no_doc" name="nomor_doc" class="form-control" required>
									<option value="" selected>Pilih Dokumen</option>
									<option value="CP-EXT">CP-EXT</option>
									<option value="BA-EXT">BA-EXT</option>
									<option value="PD-EXT">PD-EXT</option>
								</select>
						    </div>
						    <div class="col-sm-1">
						    	<input type="text" class="form-control" id="tahun" name="tahun" 
						    	value="<?php echo date("Y"); ?>" readonly>
						    </div>
						    <div class= "col-sm-1">
						    	<input type="text" class="form-control" id="angka" name="angka" readonly>
						    </div>
						</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Request Oleh</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="request_oleh" name="request_oleh" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Upload File</label>
                        <div class="col-sm-10">
                            <input type="file" name="file">
                        </div>
                    </div>
                    <input type="hidden" name="username_monica" value="<?php echo $username_monica;?>">
		        </div>
		        <div class="modal-footer">
		            <button type="submit" name="tambahkhasanaheksternal" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Tambah Khasanah</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Batal</button>
		        </div>
	    	</form>
	    </div>
    </div>
</div>

<link href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css" rel="stylesheet"/>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>

<!-- Datatable -->
<script>
	// Create search header
	var new_row = $("<tr class='search-header'/>");
	$('#tabel thead th').each(function(i) {
		var title = $(this).text();
		var new_th = $('<th style="' + $(this).attr('style') + '" />');
		$(new_th).append('<input type="text" placeholder="' + title + '" data-index="'+i+'"/>');
		$(new_row).append(new_th);
	});
	$('#tabel thead').prepend(new_row);

	// Init DataTable
	var table = $('#tabel').DataTable({
		"scrollX": true,
		"scrollY":  "270px",
		"scrollCollapse": true,
		"searching": true,
		"columnDefs": [
            { "targets": [ 0 ], "visible": false, "searchable": false }
        ]
	});

	// Filter event handler
	$(table.table().container()).on('keyup','thead input',function(){
		table.column($(this).data('index')).search(this.value).draw();
	});
</script>

<!-- Tampil detail khasanah eksternal -->
<script>
	function LihatData(id_compliance) 
	{
		var id_compliance = JSON.stringify(id_compliance);
		$.ajax({
			method: 'POST',
			url: "<?php echo base_url('monica/khasanah_eksternal/detail_khasanah_eksternal/'); ?>",
			data: {id_compliance: id_compliance},
			dataType: 'JSON',
			success: function(data){
                $("#lihat_modal").modal('show');
                $('#tampil_data').html(data);
            },
            error : function(data) {
           		alert("Gagal Load Data");
        	}
        });
	 	event.preventDefault();
	}
</script>

<!-- Get last no_doc ext --> 
<script>
	$('#no_doc').on('change', function() 
	{
		var no_doc = $('#no_doc').val();
		var tahun  = $('#tahun').val();
	    $.ajax({
	        type: "POST",
	        url: "<?php echo base_url('monica/khasanah_eksternal/doc_ext_input/'); ?>",
	        data: {no_doc: no_doc,tahun: tahun},
	        dataType: "JSON",
	        cache: false,
	        success:
	        function(data){
	        	$("#angka").val(data);
	        }
	    });
    });
</script>

<!-- Stop refresh -->
<script>
    if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href);
    }
</script>