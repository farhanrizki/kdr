<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li class="active">Penilaian Kontrol</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Silahkan Berikan Nilai Kontrol
				</h1>
			</div><!-- /.page-header -->

			<?php if(isset($berhasil_update)) { echo $berhasil_update; } if(isset($gagal_update)) { echo $gagal_update; } ?>

			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#nk_baru">
									<i class="green ace-icon fa fa-square-o bigger-120"></i>
									Nilai Kontrol Baru
								</a>
							</li>

							<li>
								<a data-toggle="tab" href="#nk_lama">
									<i class="green ace-icon fa fa-square-o bigger-120"></i>
									Nilai Kontrol Lama
								</a>
							</li>
						</ul>

						<div class="tab-content">
							<!-- Nilai Kontrol Baru -->
							<div id="nk_baru" class="tab-pane fade in active">
								<form action="<?php echo base_url('risk/penilaian_kontrol'); ?>" method="post">
									<div class="form-group">
										<h4>
											Profile Risk
										</h4>
										<table id="simple-table" class="table table-bordered table-hover">
											<thead>
												<tr>
													<th width="1%">No. </th>
													<th width="4%">Bagian</th>
													<th width="25%">Risk Issue</th>
													<th width="13%">Impact</th>
													<th width="13%">likelihood</th>
													<th width="5%">Kontrol Mitigasi</th>
													<th width="2%">IRS</th>
													<th width="10%"><a href="#modal-table" role="button" class="green" data-toggle="modal"><i class="ace-icon glyphicon glyphicon-search"></i> Nilai Kontrol </a></th>
												</tr>
											</thead>
											<tbody>
											<?php 
												$no = 1;
												foreach($kontrol_baru as $row) { 
											?>
												<tr>
													<td><?=$no++?>.</td>
													<td><?=$row['nama_bagian']?></td>
													<td><?=$row['risk_issue']?></td>
													<input type="hidden" name="id_risk[]" value="<?=$row['id_risk']?>">
													<td class="text-center">
														<select name="impact[<?=$row['id_risk']?>]" class="chosen-select form-control" id="form-field-select-3" disabled>
															<option value="">-- Choose Impact --</option>
															<option value="4" <?php if($row['impact'] == 4){ echo 'selected';} ?>>Sangat Ringan</option>
															<option value="3" <?php if($row['impact'] == 3){ echo 'selected';} ?>>Ringan</option>
															<option value="2" <?php if($row['impact'] == 2){ echo 'selected';} ?>>Sedang</option>
															<option value="1" <?php if($row['impact'] == 1){ echo 'selected';} ?>>Berat</option>
															<option value="0" <?php if(is_numeric($row['impact']) && $row['impact'] == 0){ echo 'selected';} ?>>Sangat Berat</option>
														</select>
													</td>
													<td>
														<select name="likelihood[<?=$row['id_risk']?>]" class="chosen-select form-control" id="form-field-select-3" disabled>
															<option value="">-- Choose Likelihood --</option>
															<option value="0" <?php if(is_numeric($row['likelihood']) && $row['likelihood'] == 0){ echo 'selected';} ?>>Sangat Jarang</option>
															<option value="1" <?php if($row['likelihood'] == 1){ echo 'selected';} ?>>Jarang</option>
															<option value="2" <?php if($row['likelihood'] == 2){ echo 'selected';} ?>>Sedang</option>
															<option value="3" <?php if($row['likelihood'] == 3){ echo 'selected';} ?>>Sering</option>
															<option value="4" <?php if($row['likelihood'] == 4){ echo 'selected';} ?>>Sangat Sering</option>
														</select>
													</td>
													<td>
														<button type="button" class="view_data btn btn-primary 
														btn btn-warning btn-xs" data-toggle="modal" 
														data-target="#lihat_baru<?php echo $row['id_risk'];?>" >Lihat Data</button>
													</td> 
													
													<td><?=$row['irs']?></td>
													<td class="text-center">
														<select name="nk[<?=$row['id_risk']?>]" class="chosen-select form-control" id="form-field-select-3">
															<option value="">- Pilih NK -</option>
															<option value="1" <?php if($row['nk'] == 1){ echo 'selected';} ?>>Sangat Efektif</option>
															<option value="2" <?php if($row['nk'] == 2){ echo 'selected';} ?>>Efektif</option>
															<option value="3" <?php if($row['nk'] == 3){ echo 'selected';} ?>>Cukup Efektif</option>
															<option value="4" <?php if($row['nk'] == 4){ echo 'selected';} ?>>Kurang Efektif</option>
															<option value="5" <?php if($row['nk'] == 5){ echo 'selected';} ?>>Tidak Efektif</option>
														</select>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
                        				<button type='submit' name='simpankontrol' class='btn btn-primary'><i class='fa fa-check-square-o'></i> Simpan Kontrol Baru </button>
									</div>
								</form>
							</div>

							<!-- Nilai Kontrol Lama -->
							<div id="nk_lama" class="tab-pane fade">
								<form action="<?php echo base_url('risk/penilaian_kontrol'); ?>" method="post">
									<div class="form-group">
										<h4>
											Profile Risk
										</h4>
										<table id="myTable" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th width="1%">No. </th>
													<th width="4%">Bagian</th>
													<th width="25%">Risk Issue</th>
													<th width="13%">Impact</th>
													<th width="13%">likelihood</th>
													<th width="5%">Kontrol Mitigasi</th>
													<th width="2%">IRS</th>
													<th width="10%"><a href="#modal-table" role="button" class="green" data-toggle="modal"><i class="ace-icon glyphicon glyphicon-search"></i> Nilai Kontrol </a></th>
												</tr>
											</thead>
											<tbody>
											<?php 
												$no = 1;
												foreach($kontrol_lama as $row) { 
											?>
												<tr>
													<td><?=$no++?>.</td>
													<td><?=$row['nama_bagian']?></td>
													<td><?=$row['risk_issue']?></td>
													<input type="hidden" name="id_risk[]" value="<?=$row['id_risk']?>">
													<input type="hidden" name="impact[<?=$row['id_risk']?>]" value="<?=$row['impact']?>">
													<input type="hidden" name="likelihood[<?=$row['id_risk']?>]" value="<?=$row['likelihood']?>">
													<td class="text-center">
														<select name="impact[<?=$row['id_risk']?>]" class="chosen-select form-control" id="form-field-select-3" disabled>
															<option value="">-- Choose Impact --</option>
															<option value="4" <?php if($row['impact'] == 4){ echo 'selected';} ?>>Sangat Ringan</option>
															<option value="3" <?php if($row['impact'] == 3){ echo 'selected';} ?>>Ringan</option>
															<option value="2" <?php if($row['impact'] == 2){ echo 'selected';} ?>>Sedang</option>
															<option value="1" <?php if($row['impact'] == 1){ echo 'selected';} ?>>Berat</option>
															<option value="0" <?php if(is_numeric($row['impact']) && $row['impact'] == 0){ echo 'selected';} ?>>Sangat Berat</option>
														</select>
													</td>
													<td>
														<select name="likelihood[<?=$row['id_risk']?>]" class="chosen-select form-control" id="form-field-select-3" disabled>
															<option value="">-- Choose Likelihood --</option>
															<option value="0" <?php if(is_numeric($row['likelihood']) && $row['likelihood'] == 0){ echo 'selected';} ?>>Sangat Jarang</option>
															<option value="1" <?php if($row['likelihood'] == 1){ echo 'selected';} ?>>Jarang</option>
															<option value="2" <?php if($row['likelihood'] == 2){ echo 'selected';} ?>>Sedang</option>
															<option value="3" <?php if($row['likelihood'] == 3){ echo 'selected';} ?>>Sering</option>
															<option value="4" <?php if($row['likelihood'] == 4){ echo 'selected';} ?>>Sangat Sering</option>
														</select>
													</td>
													<td>
														<button type="button" class="view_data btn btn-primary 
														btn btn-warning btn-xs" data-toggle="modal" 
														data-target="#lihat_lama<?php echo $row['id_risk'];?>" >Lihat Data</button>
													</td> 
													<td><?=$row['irs']?></td>
													<td class="text-center">
														<select name="nk[<?=$row['id_risk']?>]" class="chosen-select form-control" id="form-field-select-3">
															<option value="">- Pilih NK -</option>
															<option value="1" <?php if($row['nk'] == 1){ echo 'selected';} ?>>Sangat Efektif</option>
															<option value="2" <?php if($row['nk'] == 2){ echo 'selected';} ?>>Efektif</option>
															<option value="3" <?php if($row['nk'] == 3){ echo 'selected';} ?>>Cukup Efektif</option>
															<option value="4" <?php if($row['nk'] == 4){ echo 'selected';} ?>>Kurang Efektif</option>
															<option value="5" <?php if($row['nk'] == 5){ echo 'selected';} ?>>Tidak Efektif</option>
														</select>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
										<button type='submit' name='simpankontrol' class='btn btn-primary'><i class='fa fa-check-square-o'></i> Simpan Kontrol Lama </button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>



<!-- ======= MODAL KONTROL BARU ======= -->
<?php 
    foreach($kontrol_baru as $row):
	$id_risk          = $row['id_risk'];
	$nama_bagian_edit = $row['nama_bagian'];
	$risk_issue       = $row['risk_issue'];
	$kontrol_mitigasi = $row['kontrol_mitigasi'];
?>

<div class="modal fade" id="lihat_baru<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="lihat_baru" aria-hidden="true">
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

<?php endforeach;?>
<!-- AKHIR MODAL KONTROL BARU -->

<!-- ======= MODAL KONTROL LAMA ======= -->
<?php 
    foreach($kontrol_lama as $row):
	$id_risk          = $row['id_risk'];
	$nama_bagian_edit = $row['nama_bagian'];
	$risk_issue       = $row['risk_issue'];
	$kontrol_mitigasi = $row['kontrol_mitigasi'];
?>

<div class="modal fade" id="lihat_lama<?php echo $id_risk;?>" tabindex="-1" role="dialog" aria-labelledby="lihat_baru" aria-hidden="true">
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

<?php endforeach;?>
<!-- AKHIR MODAL KONTROL LAMA -->

<script type="text/javascript">
	jQuery(function($) {
		var myTable = $('#simple-table').DataTable({
				bAutoWidth: true,
				aoColumns: 
				[
					null,null, null, null, null, null, null,
					{ bSortable: false }
				],
				aaSorting: []
		    });
	})

	jQuery(function($) {
		var myTable = $('#myTable').DataTable({
				bAutoWidth: true,
				aoColumns: 
				[
					null,null, null, null, null, null, null,
					{ bSortable: false }
				],
				aaSorting: []
		    });
	})
</script>