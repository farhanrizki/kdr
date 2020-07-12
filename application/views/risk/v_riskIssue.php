<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li class="active">Risk Issue</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Risk Issue
				</h1>
			</div>

			<?php if(isset($berhasil_simpan)) { echo $berhasil_simpan; } if(isset($gagal_simpan)) { echo $gagal_simpan; } ?>
			<?php if(isset($berhasil_update)) { echo $berhasil_update; } if(isset($gagal_update)) { echo $gagal_update; } ?>
			<?php if(isset($berhasil_hapus)) { echo $berhasil_hapus; } if(isset($gagal_hapus)) { echo $gagal_hapus; } ?>
			<?php if(isset($berhasil_simpan_user)) { echo $berhasil_simpan_user; } ?>
			<?php if(isset($berhasil_update_user)) { echo $berhasil_update_user; } ?>
			<?php if(isset($berhasil_hapus_user)) { echo $berhasil_hapus_user; } ?>

			<div class="row">
				<div class="col-xs-12">	
					<?php if (strtolower($level_risk) == "staffkdr" || strtolower($level_risk) == "adminkdr") { ?>
						<button data-target="#tambah_modal" data-toggle="modal" class="btn btn-sm btn-primary">
							<i class="glyphicon glyphicon-plus"></i> Tambah Risk Issue
						</button>
					<?php } else { ?>
						<button data-target="#tambah_modal_user" data-toggle="modal" class="btn btn-sm btn-primary">
							<i class="glyphicon glyphicon-plus"></i> Tambah Risk Issue
						</button>
					<?php } ?> 
					
					<hr>
				</div>	

				<div class="col-xs-12">
					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
					</div>
					<div class="table-header">
						Tabel Data Risk Issue
					</div>

					<!-- div.table-responsive -->
					<div>
						<table id="mytable" class="table table-striped table-bordered table-hover">
							<thead>
								<tr class="primary">
									<th>No. </th>
									<th>Bagian</th>
									<th width="60%">Risk Issue</th>
									<th>Kontrol Mitigasi</th>
									<th>IRS</th>
									<th>NK</th>
									<th>Risk Gabungan</th>
									<th width="7%">
										<i class="ace-icon glyphicon glyphicon-cog hidden-480"></i>
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$no = 1;
									foreach($data_risk_issue as $row)
									{
								?>
										<tr>
											<td><?=$no++?>.</td>
											<td><?=$row['nama_bagian']?></td>
											<td><?=$row['risk_issue']?></td>
											<td>
												<button type="button" class="view_data btn btn-primary 
												btn btn-warning btn-xs" data-toggle="modal" 
												data-target="#lihat_modal<?php echo $row['id_risk'];?>" >Lihat Data</button>
											</td> 
											<td><?=$row['irs']?></td>
											<td><?=$row['nk']?></td>
											<td><?=$row['risk_gabungan']?></td>
											<td>
												<?php if (strtolower($level_risk) == "staffkdr" || strtolower($level_risk) == "adminkdr") { ?>
												<div class="hidden-sm hidden-xs action-buttons">							
													<a class="green" href="" data-toggle="modal" data-target="#edit_modal<?php echo $row['id_risk'];?>"> 
														<i class="ace-icon fa fa-pencil bigger-130"></i>
													</a>
													<a class="red" href="" data-toggle='modal' data-target="#hapus_modal<?php echo $row['id_risk'];?>"> 
														<i class="ace-icon fa fa-trash-o bigger-130"></i>
													</a>
												</div>
												<?php } else if ($nama_bagian_risk == $row['nama_bagian'] ) { ?>
												<div class="hidden-sm hidden-xs action-buttons">
													<a class="green" href="" data-toggle="modal" data-target="#edit_modal_user<?php echo $row['id_risk'];?>"> 
														<i class="ace-icon fa fa-pencil bigger-130"></i>
													</a>
													<a class="red" href="" data-toggle='modal' data-target="#hapus_modal_user<?php echo $row['id_risk'];?>"> 
														<i class="ace-icon fa fa-trash-o bigger-130"></i>
													</a>
												</div>
												<?php }else{} ?> 
											</td>
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

<?php echo $footer ?>

<!-- ============ MODAL LIHAT, EDIT DAN HAPUS =============== -->
<?php 
    foreach($data_risk_issue as $row):
	$id_risk          = $row['id_risk'];
	$nama_bagian_edit = $row['nama_bagian'];
	$risk_issue       = $row['risk_issue'];
	$kontrol_mitigasi = $row['kontrol_mitigasi'];
?>

<div class="modal fade" id="lihat_modal<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="lihat_modal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Kontrol Mitigasi</h4>
			<div class="modal-body">
	            <table id="simple-table" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="4%">Bagian</th>
							<th>Risk Issue</th>
							<th>Kontrol Mitigasi</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?=$nama_bagian_edit?></td>
							<td><?=$risk_issue?></td>
							<td><?=$kontrol_mitigasi?></td>
						</tr>
					</tbody>
				</table>
                </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tutup</button>
		        </div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="edit_modal<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Risk Issue</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'risk/risk_issue'?>" method="post">
		        <div class="modal-body">
		            <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Bagian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bagian" name="bagian" 
                            	value="<?php echo $nama_bagian_edit; ?>" disabled>
                        </div>
                    </div>
		            <div class="form-group">
                        <label class="col-sm-2 control-label">Risk Issue</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="risk_issue" required><?php echo $risk_issue;?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id_risk" value="<?php echo $id_risk;?>">
		        </div>
		        <div class="modal-footer">
		            <button type="submit" name="updaterisk" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>Update</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Batal</button>
		        </div>
	    	</form>
	    </div>
    </div>
</div>

<div class="modal fade" id="edit_modal_user<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="edit_modal_user" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Risk Issue</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'risk/risk_issue'?>" method="post">
		        <div class="modal-body">
		            <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Bagian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bagian" name="bagian" 
                            	value="<?php echo $nama_bagian_edit; ?>" disabled>
                        </div>
                    </div>
		            <div class="form-group">
                        <label class="col-sm-2 control-label">Risk Issue</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="risk_issue" required><?php echo $risk_issue;?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id_risk" value="<?php echo $id_risk;?>">
		        </div>
		        <div class="modal-footer">
		            <button type="submit" name="updateriskuser" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>Update</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Batal</button>
		        </div>
	    	</form>
	    </div>
    </div>
</div>

<div class="modal fade" id="hapus_modal<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="hapus_modal" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'risk/risk_issue'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Menghapus Risk Issue " <?php echo $risk_issue ?> " Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_risk" value="<?php echo $id_risk;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="hapusrisk" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tidak</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>

<div class="modal fade" id="hapus_modal_user<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="hapus_modal_user" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'risk/risk_issue'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Menghapus Risk Issue " <?php echo $risk_issue ?> " Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_risk" value="<?php echo $id_risk;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="hapusriskuser" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tidak</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>
<?php endforeach;?>
<!-- AKHIR MODAL LIHAT, EDIT DAN HAPUS -->

<div class="modal fade" id="tambah_modal_user" tabindex="-1" role="dialog" aria-labelledby="tambah_modal_user" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambahkan Risk Issue</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('risk/risk_issue'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Bagian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bagian" name="bagian" 
                            	value="<?php echo $nama_bagian_risk; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Risk Issue</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="risk_issue" required></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                </div>
                <div class="modal-footer">
                	<button type="submit" name="tambahriskuser" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
					Tambah</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
					Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah_modal" tabindex="-1" role="dialog" aria-labelledby="tambah_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambahkan Risk Issue</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('risk/risk_issue'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Bagian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bagian" name="bagian" 
                            	value="<?php echo $nama_bagian_risk; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Risk Issue</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="risk_issue" required></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                </div>
                <div class="modal-footer">
                	<button type="submit" name="tambahrisk" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
					Tambah</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
					Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	jQuery(function($) {
		var myTable = $('#mytable').DataTable({
				bAutoWidth: true,
				aoColumns: 
				[
					null,null, null, null, null, null, null,
					{ bSortable: false }
				],
				aaSorting: []
		    });
		
		$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
		
		new $.fn.dataTable.Buttons( myTable, {
			buttons: 
			[
				{
					"extend": "colvis",
					"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
					"className": "btn btn-white btn-primary btn-bold",
					// columns: ':not(:first):not(:last)'
					columns: ':not(:last)'
				},
				{
					"extend": "copy",
					"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
					"className": "btn btn-white btn-primary btn-bold"
				},
				{
					"extend": "csv",
					"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
					"className": "btn btn-white btn-primary btn-bold"
				},
				{
					"extend": "excel",
					"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
					"className": "btn btn-white btn-primary btn-bold"
				},
				{
					"extend": "pdf",
					"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
					"className": "btn btn-white btn-primary btn-bold"
				},
				{
					"extend": "print",
					"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
					"className": "btn btn-white btn-primary btn-bold",
					autoPrint: false,
				}		  
			]
		} );
		myTable.buttons().container().appendTo( $('.tableTools-container') );
		
		//style the message box
		var defaultCopyAction = myTable.button(1).action();
		myTable.button(1).action(function (e, dt, button, config) {
			defaultCopyAction(e, dt, button, config);
			$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
		});
		
		var defaultColvisAction = myTable.button(0).action();
		myTable.button(0).action(function (e, dt, button, config) {
			defaultColvisAction(e, dt, button, config);
			if($('.dt-button-collection > .dropdown-menu').length == 0) {
				$('.dt-button-collection')
				.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
				.find('a').attr('href', '#').wrap("<li />")
			}
			$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
		});
	})
</script>