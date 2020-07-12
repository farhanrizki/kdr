<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('risk/dashboard_risk'); ?>">Home</a>
				</li>
				<li class="active">Risk Assessment</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Silahkan Isi Form Dibawah ini Sesuai Bagian Anda
				</h1>
			</div>

			<?php if(isset($berhasil_update)) { echo $berhasil_update; } if(isset($gagal_update)) { echo $gagal_update; } ?>

			<div class="row">
				<div class="col-xs-12">
					<form action="" id="myForm">
						<div class="form-group">
						<h4>
							Risk Assessment
							<?php 
								echo strtoupper($nama_bagian_risk);						
							?>
						</h4>
							<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th width="60px">No. </th>
										<th>Risk Issue</th>
										<th width="200px">Impact</th>
										<th width="200px">Likelihood</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$no = 1;
										foreach($isi_risk_assessment as $row){ ?>
										<tr>
											<td><?=$no++?>.</td>
											<td><?=$row['risk_issue']?></td>
											<input type="hidden" name="id_risk[]" value="<?=$row['id_risk']?>">
											<td class="text-center">
												<select name="impact[<?=$row['id_risk']?>]" id="impact" class="chosen-select form-control" id="form-field-select-3" required>
													<option value="">-- Choose Impact --</option>
													<option value="4" <?php if($row['impact'] == 4){ echo 'selected';} ?>>Sangat Ringan</option>
													<option value="3" <?php if($row['impact'] == 3){ echo 'selected';} ?>>Ringan</option>
													<option value="2" <?php if($row['impact'] == 2){ echo 'selected';} ?>>Sedang</option>
													<option value="1" <?php if($row['impact'] == 1){ echo 'selected';} ?>>Berat</option>
													<option value="0" <?php if(is_numeric($row['impact']) && $row['impact'] == 0){ echo 'selected';} ?>>Sangat Berat</option>
												</select>
											</td>
											<td>
												<select name="likelihood[<?=$row['id_risk']?>]" class="chosen-select form-control" id="form-field-select-3" required>
													<option value="">-- Choose Likelihood --</option>
													<option value="0" <?php if(is_numeric($row['likelihood']) && $row['likelihood'] == 0){ echo 'selected';} ?>>Sangat Jarang</option>
													<option value="1" <?php if($row['likelihood'] == 1){ echo 'selected';} ?>>Jarang</option>
													<option value="2" <?php if($row['likelihood'] == 2){ echo 'selected';} ?>>Sedang</option>
													<option value="3" <?php if($row['likelihood'] == 3){ echo 'selected';} ?>>Sering</option>
													<option value="4" <?php if($row['likelihood'] == 4){ echo 'selected';} ?>>Sangat Sering</option>
												</select>
											</td>
										</tr>
									<?php } ?>
			                        	<tr>
											<td align='center' colspan='4'>
												<button type="button" name="simpanrisk" id="simpanrisk" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Simpan Risk </button>
			                    			</td>
										</tr>
								</tbody>
							</table>
						</div>
					</form>
				</div>
			</div>

			<div id="control_modal" class="modal fade" tabindex="-1">
				<div class="modal-dialog modal-lg">
					<form action="<?php echo base_url().'risk/risk_assessment'?>" method="post">
						<div class="modal-content">
							<div class="modal-header no-padding">
								<div class="table-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<span class="white">&times;</span>
									</button>
									Kontrol Mitigasi
								</div>
							</div>
							<div class="modal-body">
								<table class="table table-striped table-bordered table-hover">
									<thead align="center">
										<tr>
											<th width="1%">No.</th>
											<th width="30%">Risk Issue</th>
											<th width="69%">Kontrol Mitigasi</th>
										</tr>
									</thead>
									<tbody align="center">
										<?php 
											$no = 1;
											foreach($isi_risk_assessment as $row){ ?>
											<tr>
												<td><?=$no?>.</td>
												<input type="hidden" name="id_risk[]" value="<?=$row['id_risk']?>">
												<td><?=$row['risk_issue']?></td>
												<td>
												<textarea id="<?= "editor".$no."" ?>" name="risk_issue[<?=$row['id_risk']?>]" id="editor<?=$no?>" class="form-control" rows="5"> <?=$row['kontrol_mitigasi']?> </textarea>
												<script>
									                CKEDITOR.replace( <?= "editor".$no++."" ?> );
									            </script>
											</tr>
										<?php } ?>
									</tbody>
				                </table>
							</div>
							<div class="modal-footer">
								<button type='submit' name='updatekontrol' class='btn btn-primary'><i class='fa fa-check-square-o' ></i> Update Kontrol</button>
								<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tutup</button>
							</div>
						</div><!-- /.modal-content -->
					</form>
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

		</div>
	</div>
</div>

<!-- Simpan risk -->
<script>
   $('#simpanrisk').click(function() {
        var myData = $("#myForm").serialize(); 
        $.ajax({
			method: 'POST',
			url: "<?php echo base_url('risk/risk_assessment/simpan_risk'); ?>",
			data: myData,
			dataType: 'html',
			success: function(data){
                $("#control_modal").modal('show');
            },
            error : function(data) {
           		alert("Gagal Menyimpan");
        	}
        });
	});
</script>