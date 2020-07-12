<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li class="active">Dispo Dio</li>
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

			<!-- Table yang sudah fix -->
			<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
                	<?php if($level_kdr == 'adminkdr') { ?>
						<div class="col-md-2">
							<form method="post" action="<?php echo base_url(); ?>kdr/dispo_dio/tambah_dispo">
								<input type="hidden" value="<?php echo $level_kdr;?>" name="level_kdr">
						    	<button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i>&nbsp; Tambah Dispo</button>&nbsp;&nbsp;&nbsp;&nbsp;
							</form>
						</div>
						<div class="col-md-9">
							<button data-target="#filterdispo" data-toggle="modal" class="btn btn-primary"><i class="fa fa-filter"></i>&nbsp; Filter Dispo </button>
						</div>
						<!--<div class="alert"></div>-->
               		<?php } else { ?>
               			<button data-target="#filterdispo" data-toggle="modal" class="btn btn-primary"><i class="fa fa-filter"></i>&nbsp; Filter Dispo </button>
               		<?php } ?>
	               		<div class="col-md-12 text-right">
							<label class="col-md-10 text-right">Filter By</label>
							<div class="col-md-1 text-right">
								<p id="FilterbyTglDispo"></p>
							</div>
							<div class="col-md-1 text-right">
								<p id="FilterbyTL"></p>
							</div>
						</div>

	                    <div class="box-body">
	                        <table id="tabel-fix" class="table table-bordered table-striped">
	                            <thead>
	                                <tr class="baris">
	                                	<th>Nomor</th>
	                                	<th>Status</th>
	                                	<th>Keterangan Dispo</th>
	                                	<th>Keterangan TL</th>
	                                	<th>Tgl Disposisi</th> 
										<th>No Surat</th>
										<th>Lihat Data</th>
										<th>Agenda</th>

										<!-- Yg ditampilin di excel tp di hide di view table -->
										<th>Keterangan</th>
										<th>Keterangan TL</th>
										<th>Keterangan Done</th>
										<th>PIC</th>
										<th>Kategori</th>
										<th>Sub Kategori</th>
										<th>Tgl TL</th>
										<th>Tgl Done</th>
										<th>Tgl Deadline</th>
										<!-- End -->

										<?php if($level_kdr == 'adminkdr') { ?>
										<th>PIC</th>
										<?php } else { } ?>
										<th>Tindak Lanjut</th>
										<th>Tgl Deadline</th>   
										<?php if($level_kdr == 'adminkdr') { ?>
										<th>Action</th>
										<?php } else { } ?>
	                                </tr>
	                            </thead>
	                            <tbody>
                                <?php 
                                	$no = 1;
									foreach($dispo as $data)
									{ 
								?>
									<tr class="baris">
										<input type="hidden" value="<?php echo $data['id_dispodio'];?>" name="id_dispodio">
										<td><?=$no++?></td>
										<td>
											<?php
												$user     = $data['user_id_notif'];
												$stat     = $data['status'];
												$cek_user = $id_user;
												$pos      = strpos($stat, $cek_user);
								                if($stat == "")
												{ echo "belum dibaca"; }	
												else if($stat != "" && $pos !== false)
												{ echo "sudah dibaca"; }
												else if($stat != "" && $pos !== true)
												{ echo "belum dibaca"; }
							                ?>
										</td>
										<td>
											<?php 
												$tanggal_dispo = strtotime($data['tgl_dispo']);
												$tgl_dispo     = date('d-m-Y',$tanggal_dispo);
												$due           = strtotime($data['due_date']);
												$due_date      = date('Y-m-d',$due);
												$now           = date('Y-m-d');
												$date          = $data['due_date'];
												$weeks         = -1;
												$a             = DateTime::createFromFormat('Y-m-d', $date);
												$a->add(DateInterval::createFromDateString($weeks . ' weeks'));
												$seminggu      = $a->format('Y-m-d');
												$days3         = -3;
												$days2         = -2;
												$days1         = -1;
												$b             = DateTime::createFromFormat('Y-m-d', $date);
												$b->add(DateInterval::createFromDateString($days3 . ' days3'));
												$c             = DateTime::createFromFormat('Y-m-d', $date);
												$c->add(DateInterval::createFromDateString($days2 . ' days2'));
												$d             = DateTime::createFromFormat('Y-m-d', $date);
												$d->add(DateInterval::createFromDateString($days1 . ' days1'));
												$tigahari      = $b->format('Y-m-d');
												$duahari       = $c->format('Y-m-d');
												$satuhari      = $d->format('Y-m-d');
												if($data['tgl_done'] != "") 
												{
													//echo "<span class='warna'>Hijau</span>";
													echo "Hijau";
												}
												else
												{
													if($now >= $due_date)
													{  
														//echo "<span class='warna'>Merah</span>";
														echo "Merah";
													}
													else if($now == $tigahari || $now == $duahari || $now == $satuhari)
													{
														//echo "<span class='warna'>Kuning</span>";
														echo "Kuning"; 
													}
													else
													{  
														//echo "<span class='warna'>Putih</span>";
														echo "Putih";
													}
												}
											?>	
										</td>
										<td>
											<?php 
												if($data['tgl_tl'] == "" && $data['tgl_done'] == "") 
												{ echo "Belum TL"; } 
												else if($data['tgl_tl'] != "" && $data['tgl_done'] == "") 
												{ echo "Sudah TL"; } 
												else if($data['tgl_tl'] != "" && $data['tgl_done'] != "") 
												{ echo "Done"; } 
												else 
												{ } 
											?>
										</td>
										<td align="center">
											<?php 
												$tanggal_dispo = strtotime($data['tgl_dispo']);
												$tgl_dispo     = date('d-m-Y',$tanggal_dispo);
												$due           = strtotime($data['due_date']);
												$due_date      = date('Y-m-d',$due);
												$now           = date('Y-m-d');
												
												$date  = $data['due_date'];
												$weeks = -1;
												$a = DateTime::createFromFormat('Y-m-d', $date);
												$a->add(DateInterval::createFromDateString($weeks . ' weeks'));
												$seminggu = $a->format('Y-m-d');

												$days3 = -3;
                                                $days2 = -2;
                                                $days1 = -1;
                                                $b = DateTime::createFromFormat('Y-m-d', $date);
                                                $b->add(DateInterval::createFromDateString($days3 . ' days3'));
                                                $c = DateTime::createFromFormat('Y-m-d', $date);
                                                $c->add(DateInterval::createFromDateString($days2 . ' days2'));
                                                $d = DateTime::createFromFormat('Y-m-d', $date);
                                                $d->add(DateInterval::createFromDateString($days1 . ' days1'));
												$tigahari = $b->format('Y-m-d');
												$duahari  = $c->format('Y-m-d');
												$satuhari = $d->format('Y-m-d');

												if($data['tgl_done'] != ""){ ?>
													<span class="label label-success" style="width:150px">
														<?php echo $tgl_dispo; ?>
													</span>
												<?php 
													} else {
													if($now >= $due_date) { ?>
														<div id="danger<?php echo $data['id_dispodio'];?>">
															<span class="label label-danger" style="width:150px">
																<?php echo $tgl_dispo; ?>
															</span>
														</div>

														<div id="success<?php echo $data['id_dispodio'];?>">

														</div>
												<?php 
													}
													else if($now == $tigahari || $now == $duahari || $now == $satuhari)
													{ ?>
														<div id="warning<?php echo $data['id_dispodio'];?>">
															<span class="label label-warning" style="width:150px">
																<?php echo $tgl_dispo; ?>
															</span>
														</div>
														<div id="success<?php echo $data['id_dispodio'];?>">

														</div>
												<?php
													}
													else
													{ ?>
														<div id="putih<?php echo $data['id_dispodio'];?>">
															<span style="width:150px;">
																<?php echo $tgl_dispo; ?>
															</span>
														</div>
														<div id="success<?php echo $data['id_dispodio'];?>">

														</div>
												<?php 
													}
												}
											?>	
										</td>
										<td><?=$data['no_surat']?></td>
										<td align="center">
											<button type="button" class="view_data btn btn-primary btn-xs" 
											onclick="window.location='<?php echo base_url("kdr/dispo_dio/view_dispo/".$data['id_dispodio'].'/'.$data['id_pic']);?>'">LIHAT DATA</button>
										</td>
										<td><?=$data['agenda']?></td>

										<!-- Yg ditampilin di excel tp di hide di view table -->
										<td>
											<?php
								                if($data['keterangan'] == "")
												{ echo "-"; }	
												else
												{ echo $data['keterangan']; }
							                ?>
										</td>
										<td>
											<?php
								                if($data['keterangan_tl'] == "")
												{ echo "-"; }	
												else
												{ echo $data['keterangan_tl']; }
							                ?>
										</td>
										<td>
											<?php
								                if($data['keterangan_done'] == "")
												{ echo "-"; }	
												else
												{ echo $data['keterangan_done']; }
							                ?>
										</td>
										<td><?=$data['pic']?></td>
										<td><?=$data['kategori']?></td>
										<td><?=$data['sub_kategori']?></td>
										<td>
											<?php
								                if($data['tgl_tl'] == "")
												{ echo "-"; }	
												else
												{ echo $data['tgl_tl']; }
							                ?>
										</td>
										<td>
											<?php
								                if($data['tgl_done'] == "")
												{ echo "-"; }	
												else
												{ echo $data['tgl_done']; }
							                ?>	
							            </td>
										<td>
											<?php
								                if($data['due_date'] == "")
												{ echo "-"; }	
												else
												{ echo $data['due_date']; }
							                ?>	
										</td>
										<!-- End -->

										<?php if($level_kdr == 'adminkdr') { ?>
										<td><?=$data['pic']?></td>
										<?php } else { } ?>
										<td align="center">
											<style>
												.disabled, .enabled {
													border: 1px solid #0066cc;
													background-color: #0099cc;
													color: #ffffff;
													/*padding: 5px 10px;*/
													width: 80%;
												}

												.enabled:hover {
													border: 1px solid #0099cc;
													background-color: #00aacc;
													color: #ffffff;
													/*padding: 5px 10px;*/
												}
												
												.disabled{
													border: 1px solid #999999;
													background-color: #cccccc;
													color: #666666;
													cursor:not-allowed;
													pointer-events:none;
												}
											</style>

											<?php if($data['tgl_tl'] == "" && $data['tgl_done'] == "") { ?>
												<button id="in-progress<?php echo $data['id_dispodio'];?>" class="enabled" data-toggle='modal' 
												data-target="#update_tl<?php echo $data['id_dispodio'];?>">IN PROGRESS</button>
												<br><br>
												<button id="done<?php echo $data['id_dispodio'];?>" class="disabled" data-toggle='modal' 
												data-target="#update_done<?php echo $data['id_dispodio'];?>">DONE</button>

											<?php } else if($data['tgl_tl'] != "" && $data['tgl_done'] == "") { ?>
												<button id="in-progress<?php echo $data['id_dispodio'];?>" class="disabled" data-toggle='modal' 
												data-target="#update_tl<?php echo $data['id_dispodio'];?>">IN PROGRESS</button>
												<br><br>
												<button id="done<?php echo $data['id_dispodio'];?>" class="enabled" data-toggle='modal' 
												data-target="#update_done<?php echo $data['id_dispodio'];?>">DONE</button>

											<?php } else if($data['tgl_tl'] != "" && $data['tgl_done'] != "") { ?>
												<button class="disabled"> IN PROGRESS </button>
												<br><br>
												<button class="disabled"> DONE </button>

											<?php } else { } ?>
										</td>
										<td>
											<?php 
												$time     = strtotime($data['due_date']);
												$due_date = date('d-m-Y',$time);
												echo $due_date;
											?>		
										</td>
										<?php if($level_kdr == 'adminkdr') { ?>
										<td align="center">
											<button type="button" class="view_data btn btn-primary btn-xs" 
											onclick="window.location='<?php echo base_url("kdr/dispo_dio/edit_dispo/".$data['id_dispodio'].'/'.$level_kdr);?>'"><i class="ace-icon fa fa-edit"></i></button>
											&nbsp;
											<button type="button" class="view_data btn btn-primary btn-xs" 
											data-toggle='modal' data-target="#hapus_modal<?php echo $data['id_dispodio'];?>">
											<i class="ace-icon fa fa-trash-o bigger-130"></i></button>
										</td>
										<?php } else { } ?>
				                    </tr>
								<?php 
									} 
		                        ?>
	                            </tbody>
	                        </table>
	                    </div>

	                    <div class="col-xs-12">
	                    	<p><b>Keterangan tanggal disposisi</b></p>
	               			<span class="label label-success" style="width:150px">DONE</span>&nbsp;&nbsp;&nbsp;
	               			<span class="label label-danger" style="width:150px">Lewat Tanggal Deadline</span>
	               			&nbsp;&nbsp;&nbsp;
							<span class="label label-warning" style="width:150px">Kurang dari 3 hari</span>
                    	</div>
	                </div>
	            </div>
        	</div>
    	</div>
    </div>
</div>

<!-- Modal hapus -->
<?php 
    foreach($dispo as $row):
	$id_dispodio   = $row['id_dispodio'];
	$tanggal_dispo = strtotime($row['tgl_dispo']);
	$tgl_dispo     = date('d-m-Y',$tanggal_dispo);
?>

<div class="modal fade" id="update_tl<?php echo $id_dispodio;?>" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 600px;">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Tindak Lanjut</h4>
		    </div>
		    <form class="form-horizontal">
		        <div class="modal-body">
		            <div class="form-group">
	                    <label class="col-sm-3 control-label">Keterangan TL</label>
	                    <div class="col-sm-9">
	                        <textarea class="form-control" id="keterangan_tl<?php echo $id_dispodio;?>" name="keterangan_tl">
	                        </textarea>
	                    </div>
	                </div>
	                <input type="hidden" name="id_dispodio" value="<?php echo $id_dispodio;?>">
		        </div>
		        <div class="modal-footer">
		        	<button type="button" class="btn btn-primary" onclick="return UpdateTL(<?php echo $id_dispodio;?>);">
		        	<i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Update TL</button>
		            
		            <!--<button type="submit" name="update" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Update TL</button>-->
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Batal</button>
		        </div>
		    </form>
	    </div>
    </div>
</div>

<div class="modal fade" id="update_done<?php echo $id_dispodio;?>" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 600px;">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Done</h4>
		    </div>
		    <form class="form-horizontal">
		        <div class="modal-body">
		            <div class="form-group">
                        <label class="col-sm-3 control-label">Keterangan Done</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="keterangan_done<?php echo $id_dispodio;?>" 
                            name="keterangan_done">
                            </textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id_dispodio" value="<?php echo $id_dispodio;?>">
                    <input type="hidden" id="tgl_dispo<?php echo $id_dispodio;?>" name="tgl_dispo" 
                    value="<?php echo $tgl_dispo;?>">
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-primary" onclick="return UpdateDone(<?php echo $id_dispodio;?>);">
		        	<i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Update Done</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Batal</button>
		        </div>
	    	</form>
	    </div>
    </div>
</div>

<div class="modal fade" id="hapus_modal<?php echo $id_dispodio;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data Dispodio</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'kdr/dispo_dio/hapus_dispo'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_dispodio" value="<?php echo $id_dispodio;?>">
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

<div class="modal fade" id="filterdispo" tabindex="-1" role="dialog" aria-labelledby="filterdispo" aria-hidden="true">
    <div class="modal-dialog" style="width:500px;">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Filter by Tgl Dispo</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'kdr/dispo_dio/filter_dispo'?>" method="post" enctype="multipart/form-data">
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

<!-- Warna row datatable -->
<style>
	.lightgray {
		background-color: lightgray !important;
	}
</style>

<!-- Datatable Fix -->
<script>
	// Create search header
	var new_row = $("<tr class='search-header'/>");
	$('#tabel-fix thead th').each(function(i) {
		var title = $(this).text();
		var new_th = $('<th style="' + $(this).attr('style') + '" />');
		$(new_th).append('<input type="text" style="width: 100px;" placeholder="' + title + '" data-index="'+i+'"/>');
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
					columns: [ 4,5,7,8,9,10,11,12,13,14,15,16 ]
				}
			}
        ],
        "pageLength" : 5,
    	"lengthMenu": [[5, 10, 25, 100], [5, 10, 25, 100]],
		"sScrollX": true,
		"scrollY":  "405px",
		"scrollCollapse": true,
		"searching": true,
		"autoWidth": false,
		/*"responsive": true,
	    "fixedHeader": true,
	    "fixedColumns": true,*/
        "columnDefs": [
	        { "targets": [0, 1, 8, 9, 10, 11, 12, 13, 14, 15, 16], "visible": false, "searchable": false},
	        { "targets": [2,3], "visible": false, "searchable": true}
	        /*{ "width": "170px", "targets": 18 }*/
	    ],
        "rowCallback": function( row, data, index ) {
			var status_notif = data[1];
			$node            = this.api().row(row).nodes().to$();
			if(status_notif != 'sudah dibaca') { $node.addClass('lightgray') }
		},
		"initComplete": function() {
			//Filter by Keterangan Tgl Dispo
			var column_tgl_dispo = this.api().column(2);
			var values_tgl_dispo = [];
			column_tgl_dispo.data().each(function(d, j) {
				d.split(",").forEach(function(data) {
					data = data.trim();

					//console.log(data);

					if (values_tgl_dispo.indexOf(data) === -1) {
						values_tgl_dispo.push(data);
					}
				});
			});

			$('<select class="filter-dispo" id="filter-dispo" style="width:83px;"><option value=""></option></select>')
				.append(values_tgl_dispo.sort().map(function(o) {
				
				if(o  == 'Hijau')
				{
					var c = "#82AF6F";
				}
				if(o  == 'Merah')
				{
					var c = "#D15B47";
				}
				if(o == 'Kuning')
				{
					var c = "#F89406";
				}
				if(o  == 'Putih')
				{
					var c = "";
				}
				return '<option value="' + o + '" style="background-color: '+c+';"></option>';
			}))
			.on('change', function() {
				column_tgl_dispo.search(this.value ? '\\b' + this.value + '\\b' : "", true, false).draw();
			})
			.appendTo('#FilterbyTglDispo');


			//Filter by Keterangan TL
			var column_tl = this.api().column(3);
			var values_tl = [];
			column_tl.data().each(function(d, j) {
				d.split(",").forEach(function(data) {
					data = data.trim();

					if (values_tl.indexOf(data) === -1) {
						values_tl.push(data);
					}
				});
			});

			$('<select class="filter"><option value=""></option></select>')
				.append(values_tl.sort().map(function(o) {
				return '<option value="' + o + '">' + o + '</option>';
			}))

			.on('change', function() {
				column_tl.search(this.value ? '\\b' + this.value + '\\b' : "", true, false).draw();
			})
			.appendTo('#FilterbyTL');
		}
	});

	// Filter event handler
	$( table.table().container() ).on( 'keyup', 'thead input', function () {
		table
			.column( $(this).data('index') )
			.search( this.value )
			.draw();
	});
</script>

<!-- Update TL -->
<script>
	function UpdateTL(id_dispodio) 
	{
		var id_dispodio   = JSON.stringify(id_dispodio);
		var keterangan_tl = $("textarea#keterangan_tl"+id_dispodio).val();
		$.ajax({
			method: 'POST',
			url: "<?php echo base_url('kdr/dispo_dio/update_tl/'); ?>",
			data: {id_dispodio: id_dispodio, keterangan_tl: keterangan_tl},
			dataType: 'JSON',
			success: function(data){
                $(".fade").modal('hide');
               	$("#in-progress"+id_dispodio).removeClass("enabled").addClass('disabled');
               	$("#done"+id_dispodio).removeClass("disabled").addClass('enabled');
               	alert("Update TL Berhasil");
               	//$('.alert').addClass('alert-success').text('Update TL Berhasil');
               	//hide_notify();
            },
            error : function(data) {
           		alert("Gagal update TL");
        	}
        });
	 	event.preventDefault();
	}

	/*function hide_notify()
    {
        setTimeout(function() {
            $('.alert').removeClass('alert-success').text('');
        }, 2000);
    }*/
</script>

<!-- Update Done -->
<script>
	function UpdateDone(id_dispodio) 
	{
		var id_dispodio     = JSON.stringify(id_dispodio);
		var keterangan_done = $("textarea#keterangan_done"+id_dispodio).val();
		var tgl_dispo 		= $("input#tgl_dispo"+id_dispodio).val();
		$.ajax({
			method: 'POST',
			url: "<?php echo base_url('kdr/dispo_dio/update_done/'); ?>",
			data: {id_dispodio: id_dispodio, keterangan_done: keterangan_done},
			dataType: 'JSON',
			success: function(data){
                $(".fade").modal('hide');
               	$("#done"+id_dispodio).removeClass("enabled").addClass('disabled');
               	$("#danger"+id_dispodio).remove();
               	$("#warning"+id_dispodio).remove();
               	$("#putih"+id_dispodio).remove();
               	$("#success"+id_dispodio).append("<span class='label label-success' style='width:150px'>"+tgl_dispo+'</span>');
              
               	//$(".filter-dispo").append("<option value='Hijau' style='background-color: #82AF6F;'></option>");
               	
               	alert("Update Done Berhasil");
            },
            error : function(data) {
           		alert("Gagal update done");
        	}
        });
	 	event.preventDefault();
	}
</script>

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