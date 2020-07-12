<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li class="active">Surat Keluar</li>
			</ul>
		</div>

		<div class="page-content">
			<style>
				.baris { height: auto; }

				table.dataTable td {
  					word-break: break-word;
  					overflow: hidden;
				}
			</style>

			<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                	<?php if($level_kdr == 'adminkdr') { ?>
	                		<div class="col-md-2">
								<form method="post" action="<?php echo base_url(); ?>kdr/surat_keluar/tambah_surat">
									<input type="hidden" value="<?php echo $level_kdr;?>" name="level_kdr">
							    	<button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i>&nbsp; Tambah Surat</button>
								</form>
							</div>
							<div class="col-md-9">
								<button data-target="#filtersurat" data-toggle="modal" class="btn btn-primary"><i class="fa fa-filter"></i>&nbsp; Filter Surat </button>
							</div>
							<br><br><br>
	               		<?php } else { } ?>
	                    <div class="box-body">
	                        <table id="tabel-fix" class="table table-bordered table-striped">
	                            <thead>
	                                <tr class="baris">
	                                	<th>Nomor</th>
	                                	<th>Tanggal</th> 
										<th>No Surat</th>
										
										<th>Untuk Divisi</th>
										<th>Agenda</th>
										<th>PIC</th>
										<th>Kategori</th>
										<th>Sub Kategori</th>

										<th>Lihat Data</th>
										<?php if($level_kdr == 'adminkdr') { ?>
										<th>PIC</th>
										<?php } else { } ?>
										<?php if($level_kdr == 'adminkdr') { ?>
										<th>Action</th>
										<?php } else { } ?>
	                                </tr>
	                            </thead>
	                            <tbody>
                                <?php 
                                	$no = 1;
									foreach($surat as $data)
									{ 
								?>
									<tr class="baris">
										<input type="hidden" value="<?php echo $data['id_surat_keluar'];?>" name="id_surat_keluar">
										<td><?=$no++?></td>
										<td>
											<?php 
												$time    = strtotime($data['tanggal']);
												$tanggal = date('d-m-Y',$time);
												echo $tanggal;
											?>	
										</td>
										<td><?=$data['no_surat']?></td>

										<td><?=$data['ke_divisi']?></td>
										<td><?=$data['agenda']?></td>
										<td><?=$data['pic']?></td>
										<td><?=$data['kategori']?></td>
										<td><?=$data['sub_kategori']?></td>

										<td align="center">
											<button type="button" class="view_data btn btn-primary btn-xs" 
											onclick="window.location='<?php echo base_url("kdr/surat_keluar/view_surat/".$data['id_surat_keluar']);?>'">LIHAT DATA</button>
										</td>
										<?php if($level_kdr == 'adminkdr') { ?>
										<td><?=$data['pic']?></td>
										<?php } else { } ?>
										<?php if($level_kdr == 'adminkdr') { ?>
										<td align="center">
											<button type="button" class="view_data btn btn-primary btn-xs" 
											onclick="window.location='<?php echo base_url("kdr/surat_keluar/edit_surat/".$data['id_surat_keluar'].'/'.$level_kdr);?>'"><i class="ace-icon fa fa-edit"></i></button>
											&nbsp;
											<button type="button" class="view_data btn btn-primary btn-xs" 
											data-toggle='modal' data-target="#hapus_modal<?php echo $data['id_surat_keluar'];?>"><i class="ace-icon fa fa-trash-o bigger-130"></i></button>
										</td>
										<?php } else { } ?>
				                    </tr>
								<?php 
									} 
		                        ?>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
        	</div>
    	</div>
    </div>
</div>

<!-- Modal hapus -->
<?php 
    foreach($surat as $row):
	$id_surat_keluar = $row['id_surat_keluar'];
?>
<div class="modal fade" id="hapus_modal<?php echo $id_surat_keluar;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data Surat Keluar</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'kdr/surat_keluar/hapus_surat'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_surat_keluar" value="<?php echo $id_surat_keluar;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="hapus" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tidak</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>
<?php endforeach;?>

<div class="modal fade" id="filtersurat" tabindex="-1" role="dialog" aria-labelledby="filtersurat" aria-hidden="true">
    <div class="modal-dialog" style="width:500px;">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Filter by Tgl Surat</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'kdr/surat_keluar/filter_surat'?>" method="post" enctype="multipart/form-data">
		        <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tgl Awal</label>
                        <div class="col-sm-10">
                            <input placeholder="Tgl Awal" type="text" class="form-control" name="tgl_awal" id="tgl_awal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tgl Akhir</label>
                        <div class="col-sm-10">
                            <input placeholder="Tgl Akhir" type="text" class="form-control" name="tgl_akhir" id="tgl_akhir" required>
                        </div>
                    </div>
		        </div>
		        <div class="modal-footer">
		            <button type="submit" name="filter" class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp; Filter</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Batal</button>
		        </div>
	    	</form>
	    </div>
    </div>
</div>

<link href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js" type="text/javascript" charset="utf-8"></script>

<!-- Datepicker -->
<script>
	$('#tgl_awal').datepicker({
	    format: 'dd-mm-yyyy',
	    autoclose: true
	});
	$('#tgl_akhir').datepicker({
	    format: 'dd-mm-yyyy',
	    autoclose: true
	});
</script>

<!-- Datatable Fix -->
<script>
	// Create search header
	var new_row = $("<tr class='search-header'/>");
	$('#tabel-fix thead th').each(function(i) {
		var title = $(this).text();
		var new_th = $('<th style="' + $(this).attr('style') + '" />');
		$(new_th).append('<input type="text" placeholder="' + title + '" data-index="'+i+'"/>');
		$(new_row).append(new_th);
	});
	$('#tabel-fix thead').prepend(new_row);

	// Init DataTable
	var table = $('#tabel-fix').DataTable({
		"dom": "Bfrtip",
        "buttons": [
            //'pageLength','copy', 'csv', 'pdf', 'print'
            "pageLength",
			{
				extend: "csv",
				exportOptions: 
				{
					columns: [ 1,2,3,4,5,6,7 ]
				}
			}
        ],
        "pageLength" : 5,
    	"lengthMenu": [[5, 10, 25, 100], [5, 10, 25, 100]],
		"sScrollX": true,
		"scrollY":  "255px",
		"scrollCollapse": true,
		"searching": true,
		"autoWidth": false,
		"columnDefs": [
	        { "targets": [0], "visible": false, "searchable": false},
	        { "targets": [3,4,5,6,7], "visible": false, "searchable": true}
	    ]
	});

	// Filter event handler
	$( table.table().container() ).on( 'keyup', 'thead input', function () {
		table
			.column( $(this).data('index') )
			.search( this.value )
			.draw();
	});
</script>