<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li class="active">Kategori Risk</li>
			</ul>
		</div>

		<div class="page-content">
			<?php if(isset($berhasil_simpan)) { echo $berhasil_simpan; } if(isset($gagal_simpan)) { echo $gagal_simpan; } ?>
			<?php if(isset($berhasil_update)) { echo $berhasil_update; } if(isset($gagal_update)) { echo $gagal_update; } ?>
			<?php if(isset($berhasil_hapus)) { echo $berhasil_hapus; } if(isset($gagal_hapus)) { echo $gagal_hapus; } ?>

			<div class="row">
				<div class="col-xs-12">	
					<button data-target="#tambah_kategori" data-toggle="modal" class="btn btn-sm btn-primary">
						<i class="glyphicon glyphicon-plus"></i> Tambah Kategori Risk
					</button>
					<hr>
				</div>	

				<div class="col-xs-12">
					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
					</div>

					<div>
						<table id="mytable" class="table table-striped table-bordered table-hover">
							<thead>
								<tr class="primary">
									<th>No. </th>
									<th>Nama Kategori</th>
									<th>Bobot Kategori</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$no = 1;
									foreach($data_kategori as $row)
									{
								?>
										<tr>
											<td><?=$no++?>.</td>
											<td><?=$row['nama_kategori']?></td>
											<td><?=$row['bobot_kategori']?></td>
											<td align="center">
												<div class="hidden-sm hidden-xs action-buttons">							
													<a class="green" href="" data-toggle="modal" data-target="#edit_kategori<?php echo $row['id_kategori_risk'];?>"> 
														<i class="ace-icon fa fa-pencil bigger-130"></i>
													</a>
													<a class="red" href="" data-toggle='modal' data-target="#hapus_kategori<?php echo $row['id_kategori_risk'];?>"> 
														<i class="ace-icon fa fa-trash-o bigger-130"></i>
													</a>
												</div>
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

<?php
   foreach($data_kategori as $row):
	$id_kategori_risk = $row['id_kategori_risk'];
	$nama_kategori    = $row['nama_kategori'];
	$bobot_kategori   = $row['bobot_kategori'];
?>

<div class="modal fade" id="edit_kategori<?php echo $id_kategori_risk;?>" tabindex="-1" role="dialog" aria-labelledby="edit_kategori" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Kategori Risk</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'risk/kategori_risk'?>" method="post">
		        <div class="modal-body">
		            <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_kategori" 
                            	value="<?php echo $nama_kategori; ?>" required>
                        </div>
                    </div>
		            <div class="form-group">
                        <label class="col-sm-2 control-label">Bobot Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control edit" id="edit_bobot" name="bobot_kategori" 
                            value="<?php echo $bobot_kategori; ?>" required>
                        </div>
                    </div>
                    <input type="hidden" name="id_kategori_risk" value="<?php echo $id_kategori_risk;?>">
		        </div>
		        <div class="modal-footer">
		            <button type="submit" name="updatekategori" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Update</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Batal</button>
		        </div>
	    	</form>
	    </div>
    </div>
</div>

<div class="modal fade" id="hapus_kategori<?php echo $id_kategori_risk;?>" tabindex="-1" role="dialog" aria-labelledby="hapus_kategori" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'risk/kategori_risk'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <h4>Apakah anda yakin ingin menghapus data ini ?</h4>
	                    </div>
	                    <input type="hidden" name="id_kategori_risk" value="<?php echo $id_kategori_risk;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="hapuskategori" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Tidak</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>

<?php endforeach;?>

<div class="modal fade" id="tambah_kategori" tabindex="-1" role="dialog" aria-labelledby="tambah_kategori" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Kategori Risk</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('risk/kategori_risk'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Bobot Kategori</label>
                        <div class="col-sm-10">
							<input type="text" class="form-control tambah" id="tambah_bobot" name="bobot_kategori" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                	<button type="submit" name="tambahkategori" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
					Tambah</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
					Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- datatables	page specific plugin scripts -->
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.min.js"></script>

<script>
	$(function () {
	    $('#mytable').DataTable({
	        "paging": true,
	        "lengthChange": true,
	        "searching": true,
	        "ordering": true,
	        "info": true,
	        "autoWidth": true
	    });
	});
</script>

<!-- Otomatis input decimal 2 angka di belakang koma dan hanya angka -->
<script>
	//Decimal Number di edit
	$(document).on("input", ".edit", function (e) {
	    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
	});

	function formatNumber(e){
		var rex = /(^\d{2})|(\d{1,3})(?=\d{1,3}|$)/g,
		val = this.value.replace(/^0+|\.|,/g,""),
		res;
	      
		if (val.length) {
			res = Array.prototype.reduce.call(val, (p,c) => c + p)            // reverse the pure numbers string
			.match(rex)                                            // get groups in array
			.reduce((p,c,i) => i - 1 ? p + "," + c : p + "." + c); // insert (.) and (,) accordingly
			res += /\.|,/.test(res) ? "" : ".0";                              // test if res has (.) or (,) in it
			this.value = Array.prototype.reduce.call(res, (p,c) => c + p);    // reverse the string and display
		}
	}
	var ni = document.getElementById("edit_bobot");
	ni.addEventListener("keyup", formatNumber);
</script>

<script>
	//Decimal Number di edit
	$(document).on("input", ".tambah", function (e) {
	    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
	});

	function formatNumber(e){
		var rex = /(^\d{2})|(\d{1,3})(?=\d{1,3}|$)/g,
		val = this.value.replace(/^0+|\.|,/g,""),
		res;
	      
		if (val.length) {
			res = Array.prototype.reduce.call(val, (p,c) => c + p)            // reverse the pure numbers string
			.match(rex)                                            // get groups in array
			.reduce((p,c,i) => i - 1 ? p + "," + c : p + "." + c); // insert (.) and (,) accordingly
			res += /\.|,/.test(res) ? "" : ".0";                              // test if res has (.) or (,) in it
			this.value = Array.prototype.reduce.call(res, (p,c) => c + p);    // reverse the string and display
		}
	}
	var ni = document.getElementById("tambah_bobot");
	ni.addEventListener("keyup", formatNumber);
</script>