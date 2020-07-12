<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('monica/dashboard_monica'); ?>">Home</a>
				</li>
				<li class="active">Data Audit Internal</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Audit Internal
					<?php 
						if($status == ""){
							$stat = "";
						}else{
							if($status == "memadai"){
								$stat = "Memadai";
							}else if($status == "tidakmemadai"){
								$stat = "Tidak Memadai";
							}else{
								$stat = "Dalam Pemantauan";
							}
						}

						if ($tahun != ""){
							if($stat == ""){
								echo 'Div. APP Tahun '.ucfirst($tahun);
							}else{
								echo 'Div. APP Tahun '.ucfirst($tahun).' dengan Status Monitoring '.$stat;
							}
						}else{
							if($stat == ""){
								echo 'Div. APP'; 
							}else{
								echo 'Div. APP dengan Status Monitoring '.$stat; 
							}
						}
					?>
				</h1>
			</div>
			<style>
				.baris {height:auto;}
				table.dataTable td {word-break:break-word;overflow:hidden;}
			</style>
			<!-- Filter -->
			<div class="row">
				<div class="col-xs-12">
					<?php if($level_monica != "nonadmin") { ?>
		            <div class="col-xs-3"> 
		                <button type="button" data-target="#tambahaudit" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Audit Internal </button>
		            </div>
		           	<?php } ?>
			
		            <div class="box box-primary">
		                <div class="box-body">
		                	<!-- Filter -->
			        		<div id="signupbox" class="mainbox col-md-4">
			                    <div class="panel panel-info">
			                        <div class="panel-body">
			                        	<form method="post" action="<?php echo base_url().'monica/data_audit_internal'?>">
			                                <div class="form-group">
			                                    <label class="col-sm-4 control-label">Tahun</label>
			                                    <div class="col-sm-8">
			                                        <select name="tahun" class="chosen-select form-control" id="form-field-select-3">
			                                            <option class="option" value="">Semua</option>
			                                            <?php foreach($tahun_audit_internal as $row) { ?>
			                                                <option value="<?php echo $row['tahun']; ?>">
			                                                    <?php echo $row['tahun']; ?>
			                                                </option>
			                                            <?php } ?>
			                                        </select>
			                                    </div>
			                                </div><br><br>
			                                <div class="form-group">
			                                    <label class="col-sm-4 control-label">Status Monitoring</label>
			                                    <div class="col-sm-8">
			                                        <select name="status" class="chosen-select form-control" id="form-field-select-3">
			                                            <option class="option" value="">Semua</option>
			                                            <option class="option" value="memadai">Memadai</option>
			                                            <option class="option" value="tidakmemadai">Tidak Memadai</option>
			                                            <option class="option" value="dalampemantauan">Dalam Pemantauan</option>
			                                        </select>
			                                    </div>
			                                </div><br><br>
			                                <div class="form-group">
			                                    <?php if($level_monica != "nonadmin") { ?>
			                                    <div class="col-md-12 text-center"> 
		                                       		<button type="submit" name="filter" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Filter </button>
			                                    </div>
			                                    <?php } else {} ?>
			                                </div>
			                            </form>
			                        </div>
			                    </div>
			                </div> 

			                <!-- Download -->
			                <div id="signupbox" class="mainbox col-md-3">
	                            <div class="infobox infobox-black">
									<div class="infobox-icon">
										<i class="ace-icon fa fa-download"></i>
									</div>
									<div class="infobox-data">
										<div class="infobox-content">Download Excel</div>
										<div class="infobox-content">
											<?php 
												if($tahun == ""){
													$tah = "semua";
												}else{
													$tah = $tahun;
												} 
												if($status == ""){
													$sta = "semua";
												}else{
													$sta = $status;
												} 
											?>
											<a href="<?php echo site_url('monica/data_audit_internal/download_audit_internal/'.$tah.'/'.$nama_bagian.'/'.$sta); ?>">Download</a>
										</div>
									</div>
								</div>
			                </div> 
				        </div>
				    </div>
				</div>
			</div>
		
			<!-- Table -->
			<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                    <div class="box-body">
	                        <table id="tabel" class="table table-bordered table-striped">
	                            <thead>
	                                <tr class="baris">
	                                	<th>Nomor</th>
	                                	<th>Tema Audit</th>
	                                	<th>Data Temuan</th>
										<th>Status Monitoring</th>
										<th>Status Deadline</th>
										<th>Deadline</th>
										<th>Bagian</th>
										<th>Kategori Temuan</th>
	                                	<th>Lihat Data</th>
										<?php if($level_monica != "nonadmin") { ?>
										<th>File Upload</th>
										<th>Action</th>
										<?php } else { } ?>
	                                </tr>
	                            </thead>
	                            <tbody>
                                <?php $no = 1; $today = date("Y-m-d"); foreach($data_audit_internal as $row){ ?>
									<tr class="baris">
										<td><?=$no++?></td>
										<td><?=$row['tema_audit']?></td>
										<td><?=$row['data_temuan']?></td>
										<td align="center" id="status">
											<?php 
												//SANGAT BENAR
												if(($row['status_monitoring_1'] == "M") 
													&& (($row['status_monitoring_2'] == "" 
														|| $row['status_monitoring_2'] == "M") 
													&& ($row['status_monitoring_3'] == ""
														|| $row['status_monitoring_3'] == "M")
													&& ($row['status_monitoring_4'] == ""
														|| $row['status_monitoring_4'] == "M")
													&& ($row['status_monitoring_5'] == ""
														|| $row['status_monitoring_5'] == "M")
													&& ($row['status_monitoring_6'] == ""
														|| $row['status_monitoring_6'] == "M")
													&& ($row['status_monitoring_7'] == ""
														|| $row['status_monitoring_7'] == "M")
													&& ($row['status_monitoring_8'] == ""
														|| $row['status_monitoring_8'] == "M")
													&& ($row['status_monitoring_9'] == ""
														|| $row['status_monitoring_9'] == "M")
													&& ($row['status_monitoring_10'] == ""
														|| $row['status_monitoring_10'] == "M")))
												{
													echo "<span class='label label-success' style='width:150px'>MEMADAI</span>";
												}
												//SANGAT BENAR
												else if(($row['status_monitoring_1'] == "P"
														|| $row['status_monitoring_1'] == "M") 
													&& (($row['status_monitoring_2'] == "" 
														|| $row['status_monitoring_2'] == "P"
														|| $row['status_monitoring_2'] == "M") 
													&& ($row['status_monitoring_3'] == ""
														|| $row['status_monitoring_3'] == "P"
														|| $row['status_monitoring_3'] == "M")
													&& ($row['status_monitoring_4'] == ""
														|| $row['status_monitoring_4'] == "P"
														|| $row['status_monitoring_4'] == "M")
													&& ($row['status_monitoring_5'] == ""
														|| $row['status_monitoring_5'] == "P"
														|| $row['status_monitoring_5'] == "M")
													&& ($row['status_monitoring_6'] == ""
														|| $row['status_monitoring_6'] == "P"
														|| $row['status_monitoring_6'] == "M")
													&& ($row['status_monitoring_7'] == ""
														|| $row['status_monitoring_7'] == "P"
														|| $row['status_monitoring_7'] == "M")
													&& ($row['status_monitoring_8'] == ""
														|| $row['status_monitoring_8'] == "P"
														|| $row['status_monitoring_8'] == "M")
													&& ($row['status_monitoring_9'] == ""
														|| $row['status_monitoring_9'] == "P"
														|| $row['status_monitoring_9'] == "M")
													&& ($row['status_monitoring_10'] == ""
														|| $row['status_monitoring_10'] == "P"
														|| $row['status_monitoring_10'] == "M")))
												{
													echo "<span class='label label-info' style='width:150px'>DALAM PEMANTAUAN</span>";
												}
												//SANGAT BENAR
												else if(($row['status_monitoring_1'] == "T"
														|| $row['status_monitoring_1'] == "M") 
													&& (($row['status_monitoring_2'] == "" 
														|| $row['status_monitoring_2'] == "T"
														|| $row['status_monitoring_2'] == "M") 
													&& ($row['status_monitoring_3'] == ""
														|| $row['status_monitoring_3'] == "T"
														|| $row['status_monitoring_3'] == "M")
													&& ($row['status_monitoring_4'] == ""
														|| $row['status_monitoring_4'] == "T"
														|| $row['status_monitoring_4'] == "M")
													&& ($row['status_monitoring_5'] == ""
														|| $row['status_monitoring_5'] == "T"
														|| $row['status_monitoring_5'] == "M")
													&& ($row['status_monitoring_6'] == ""
														|| $row['status_monitoring_6'] == "T"
														|| $row['status_monitoring_6'] == "M")
													&& ($row['status_monitoring_7'] == ""
														|| $row['status_monitoring_7'] == "T"
														|| $row['status_monitoring_7'] == "M")
													&& ($row['status_monitoring_8'] == ""
														|| $row['status_monitoring_8'] == "T"
														|| $row['status_monitoring_8'] == "M")
													&& ($row['status_monitoring_9'] == ""
														|| $row['status_monitoring_9'] == "T"
														|| $row['status_monitoring_9'] == "M")
													&& ($row['status_monitoring_10'] == ""
														|| $row['status_monitoring_10'] == "T"
														|| $row['status_monitoring_10'] == "M")))
												{
													echo "<span class='label label-danger' style='width:150px'>TIDAK MEMADAI</span>";
												}
												else 
												{ 
													echo "<span class='label label-danger' style='width:150px'>TIDAK MEMADAI</span>";
												}
											?>
										</td>
										<td align="center">
											<?php 
												//SANGAT BENAR
												if(($row['status_monitoring_1'] == "M") 
													&& (($row['status_monitoring_2'] == "" 
														|| $row['status_monitoring_2'] == "M") 
													&& ($row['status_monitoring_3'] == ""
														|| $row['status_monitoring_3'] == "M")
													&& ($row['status_monitoring_4'] == ""
														|| $row['status_monitoring_4'] == "M")
													&& ($row['status_monitoring_5'] == ""
														|| $row['status_monitoring_5'] == "M")
													&& ($row['status_monitoring_6'] == ""
														|| $row['status_monitoring_6'] == "M")
													&& ($row['status_monitoring_7'] == ""
														|| $row['status_monitoring_7'] == "M")
													&& ($row['status_monitoring_8'] == ""
														|| $row['status_monitoring_8'] == "M")
													&& ($row['status_monitoring_9'] == ""
														|| $row['status_monitoring_9'] == "M")
													&& ($row['status_monitoring_10'] == ""
														|| $row['status_monitoring_10'] == "M")))
												{
													echo "<span class='label label-default' style='width:150px'>DONE</span>";
												}
												//SANGAT BENAR
												else if(($row['status_monitoring_1'] == "P" 
														|| $row['status_monitoring_1'] == "T"
														|| $row['status_monitoring_1'] == "M") 
													&& (($row['status_monitoring_2'] == "" 
														|| $row['status_monitoring_2'] == "P"
														|| $row['status_monitoring_2'] == "T"
														|| $row['status_monitoring_2'] == "M") 
													&& ($row['status_monitoring_3'] == ""
														|| $row['status_monitoring_3'] == "P"
														|| $row['status_monitoring_3'] == "T"
														|| $row['status_monitoring_3'] == "M")
													&& ($row['status_monitoring_4'] == ""
														|| $row['status_monitoring_4'] == "P"
														|| $row['status_monitoring_4'] == "T"
														|| $row['status_monitoring_4'] == "M")
													&& ($row['status_monitoring_5'] == ""
														|| $row['status_monitoring_5'] == "P"
														|| $row['status_monitoring_5'] == "T"
														|| $row['status_monitoring_5'] == "M")
													&& ($row['status_monitoring_6'] == ""
														|| $row['status_monitoring_6'] == "P"
														|| $row['status_monitoring_6'] == "T"
														|| $row['status_monitoring_6'] == "M")
													&& ($row['status_monitoring_7'] == ""
														|| $row['status_monitoring_7'] == "P"
														|| $row['status_monitoring_7'] == "T"
														|| $row['status_monitoring_7'] == "M")
													&& ($row['status_monitoring_8'] == ""
														|| $row['status_monitoring_8'] == "P"
														|| $row['status_monitoring_8'] == "T"
														|| $row['status_monitoring_8'] == "M")
													&& ($row['status_monitoring_9'] == ""
														|| $row['status_monitoring_9'] == "P"
														|| $row['status_monitoring_9'] == "T"
														|| $row['status_monitoring_9'] == "M")
													&& ($row['status_monitoring_10'] == ""
														|| $row['status_monitoring_10'] == "P"
														|| $row['status_monitoring_10'] == "T"
														|| $row['status_monitoring_10'] == "M"))
													&& $row['deadline'] >= $today)
												{
													echo "<span class='label label-success' style='width:150px'>ON DEADLINE</span>";
												}
												//SANGAT BENAR
												else if(($row['status_monitoring_1'] == "P" 
														|| $row['status_monitoring_1'] == "T"
														|| $row['status_monitoring_1'] == "M") 
													&& (($row['status_monitoring_2'] == "" 
														|| $row['status_monitoring_2'] == "P"
														|| $row['status_monitoring_2'] == "T"
														|| $row['status_monitoring_2'] == "M") 
													&& ($row['status_monitoring_3'] == ""
														|| $row['status_monitoring_3'] == "P"
														|| $row['status_monitoring_3'] == "T"
														|| $row['status_monitoring_3'] == "M")
													&& ($row['status_monitoring_4'] == ""
														|| $row['status_monitoring_4'] == "P"
														|| $row['status_monitoring_4'] == "T"
														|| $row['status_monitoring_4'] == "M")
													&& ($row['status_monitoring_5'] == ""
														|| $row['status_monitoring_5'] == "P"
														|| $row['status_monitoring_5'] == "T"
														|| $row['status_monitoring_5'] == "M")
													&& ($row['status_monitoring_6'] == ""
														|| $row['status_monitoring_6'] == "P"
														|| $row['status_monitoring_6'] == "T"
														|| $row['status_monitoring_6'] == "M")
													&& ($row['status_monitoring_7'] == ""
														|| $row['status_monitoring_7'] == "P"
														|| $row['status_monitoring_7'] == "T"
														|| $row['status_monitoring_7'] == "M")
													&& ($row['status_monitoring_8'] == ""
														|| $row['status_monitoring_8'] == "P"
														|| $row['status_monitoring_8'] == "T"
														|| $row['status_monitoring_8'] == "M")
													&& ($row['status_monitoring_9'] == ""
														|| $row['status_monitoring_9'] == "P"
														|| $row['status_monitoring_9'] == "T"
														|| $row['status_monitoring_9'] == "M")
													&& ($row['status_monitoring_10'] == ""
														|| $row['status_monitoring_10'] == "P"
														|| $row['status_monitoring_10'] == "T"
														|| $row['status_monitoring_10'] == "M"))
													&& $row['deadline'] < $today)
												{
													echo "<span class='label label-danger' style='width:150px'>OUT DEADLINE</span>";
												}
												else { }
											?>
										</td>
										<td>
											<?php 
												$kurangduaminggu = date('Y-m-d', strtotime('-2 week'));
												$lebihduaminggu  = date('Y-m-d', strtotime('+2 week'));
												$tgl_deadline    = date('Y-m-d', strtotime($row['deadline']));
												$date1           = date_create($row['deadline']);
												$date2           = date_create($today);
												$diff            = date_diff($date2,$date1);

												//SANGAT BENAR
												if(($row['status_monitoring_1'] == "M") 
													&& (($row['status_monitoring_2'] == "" 
														|| $row['status_monitoring_2'] == "M") 
													&& ($row['status_monitoring_3'] == ""
														|| $row['status_monitoring_3'] == "M")
													&& ($row['status_monitoring_4'] == ""
														|| $row['status_monitoring_4'] == "M")
													&& ($row['status_monitoring_5'] == ""
														|| $row['status_monitoring_5'] == "M")
													&& ($row['status_monitoring_6'] == ""
														|| $row['status_monitoring_6'] == "M")
													&& ($row['status_monitoring_7'] == ""
														|| $row['status_monitoring_7'] == "M")
													&& ($row['status_monitoring_8'] == ""
														|| $row['status_monitoring_8'] == "M")
													&& ($row['status_monitoring_9'] == ""
														|| $row['status_monitoring_9'] == "M")
													&& ($row['status_monitoring_10'] == ""
														|| $row['status_monitoring_10'] == "M")))
												{
													echo "-";
												}
												else
												{
											   		echo $diff->format("%R%a hari");
												}
											?>
										</td>
										<td><?=$row['nama_divisi']?></td>
										<td><?=$row['nama_kategori']?></td>
										<td align="center">
											<button type="button" class="view_data btn btn-primary btn-xs" 
											onclick="return LihatData(<?php echo $row['id_audit'];?>);">LIHAT DETAIL</button>
										</td>
										<?php if($level_monica != "nonadmin") { ?>
										<td align="center">
											<?php if ($row['upload'] != '') { ?>
												<a href="<?php echo base_url().'upload/audit/internal/'.$row['upload']; ?>" class="dwn" target="_blank"><?php echo $row['upload']; ?></a>
											<?php } else { 
												echo "-";
											} ?>
										</td>
										<td align="center">
											<button type="button" class="view_data btn btn-primary btn-xs" 
											data-toggle='modal' data-target="#edit_modal<?php echo $row['id_audit'];?>"><i class="ace-icon fa fa-edit"></i></button>
											&nbsp;
											<button type="button" class="view_data btn btn-primary btn-xs" 
											data-toggle='modal' data-target="#hapus_modal<?php echo $row['id_audit'];?>"><i class="ace-icon fa fa-trash-o bigger-130"></i></button>
										</td>
										<?php } else { } ?>
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

<!-- Modal Lihat, Edit, Hapus Audit Internal -->
<?php 
    foreach($data_audit_internal as $row):
	$deadline = date("Y-m-d", strtotime($row['deadline']));
	$tgl_buat = date("d-m-Y", strtotime($row['dibuat_tanggal']));
?>
<div class="modal fade" id="edit_modal<?php echo $row['id_audit'];?>" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
    <div class="modal-dialog" style="width:1000px;">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Audit Internal</h4>
		    </div>
		    <form class="form-horizontal" action="<?php echo base_url().'monica/data_audit_internal'?>" method="post" enctype="multipart/form-data">
		        <div class="modal-body">
		            <div class="form-group">
                        <label class="col-sm-2 control-label">SHA Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sha" name="sha" 
                            	value="<?php echo $row['sha']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tema Audit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tema_audit" name="tema_audit" value="<?php echo $row['tema_audit']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Bagian Terkait</label>
                        <div class="col-sm-10">
                            <select name="bagian[<?=$row['id_audit']?>]" id="bagian" class="chosen-select form-control" id="form-field-select-3" required>
                            	<?php 
                            		foreach($nama_divisi as $data){ 
                            			$id_divisi = $data['id_divisi'];
                            			if($row['id_divisi'] == $id_divisi){
							                echo "<option selected ='selected' value=".$data['id_divisi'].">".$data['nama']."</option>";
							            }else{
							                echo "<option value=".$data['id_divisi'].">".$data['nama']."</option>";
							            }
							        }
                            	?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Data Temuan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="data_temuan" name="data_temuan" 
                            value="<?php echo $row['data_temuan']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kategori Temuan</label>
                        <div class="col-sm-10">
                            <select name="kategori[<?=$row['id_audit']?>]" id="kategori" class="chosen-select form-control" id="form-field-select-3" required>
                                <?php 
                            		foreach($nama_kategori as $data){ 
                            			$id_kategori = $data['id_kategori'];
                            			if($row['id_kategori'] == $id_kategori){
							                echo "<option selected ='selected' value=".$data['id_kategori'].">".$data['nama']."</option>";
							            }else{
							                echo "<option value=".$data['id_kategori'].">".$data['nama']."</option>";
							            }
							        }
                            	?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rekomendasi 1</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rekomendasi_1" name="rekomendasi_1" 
                            value="<?php echo $row['rekomendasi_1']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group textgroup">
                    	<label class="col-sm-2 control-label">Status Monitoring 1</label>
                        <div class="col-sm-10">
	                    	<select name="status_monitoring_1[<?=$row['id_audit']?>]" id="status_monitoring_1" class="chosen-select form-control" id="form-field-select-3" required>
	                    		<option class="option" value="">Pilih Status</option>
								<option value="M" <?php if($row['status_monitoring_1'] == 'M'){ echo 'selected';} ?>>Memadai</option>
								<option value="T" <?php if($row['status_monitoring_1'] == 'T'){ echo 'selected';} ?>>Tidak Memadai</option>
								<option value="P" <?php if($row['status_monitoring_1'] == 'P'){ echo 'selected';} ?>>Dalam Pemantauan</option>
							</select>
						</div>
                    </div>
                    <div class="form-group textgroup">
                        <label class="col-sm-2 control-label">Rekomendasi 2</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rekomendasi_2" name="rekomendasi_2" 
                            value="<?php echo $row['rekomendasi_2']; ?>">
                        </div>
                    </div>
                    <div class="form-group textgroup">
                    	<label class="col-sm-2 control-label">Status Monitoring 2</label>
                        <div class="col-sm-10">
	                    	<select name="status_monitoring_2[<?=$row['id_audit']?>]" id="status_monitoring_2" class="chosen-select form-control" id="form-field-select-3">
	                    		<option class="option" value="">Pilih Status</option>
								<option value="M" <?php if($row['status_monitoring_2'] == 'M'){ echo 'selected';} ?>>Memadai</option>
								<option value="T" <?php if($row['status_monitoring_2'] == 'T'){ echo 'selected';} ?>>Tidak Memadai</option>
								<option value="P" <?php if($row['status_monitoring_2'] == 'P'){ echo 'selected';} ?>>Dalam Pemantauan</option>
							</select>
						</div>
                    </div>
                    <div class="form-group textgroup">
                        <label class="col-sm-2 control-label">Rekomendasi 3</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rekomendasi_3" name="rekomendasi_3" 
                            value="<?php echo $row['rekomendasi_3']; ?>">
                        </div>
                    </div>
                    <div class="form-group textgroup">
                    	<label class="col-sm-2 control-label">Status Monitoring 3</label>
                        <div class="col-sm-10">
	                    	<select name="status_monitoring_3[<?=$row['id_audit']?>]" id="status_monitoring_3" class="chosen-select form-control" id="form-field-select-3">
	                    		<option class="option" value="">Pilih Status</option>
								<option value="M" <?php if($row['status_monitoring_3'] == 'M'){ echo 'selected';} ?>>Memadai</option>
								<option value="T" <?php if($row['status_monitoring_3'] == 'T'){ echo 'selected';} ?>>Tidak Memadai</option>
								<option value="P" <?php if($row['status_monitoring_3'] == 'P'){ echo 'selected';} ?>>Dalam Pemantauan</option>
							</select>
						</div>
                    </div>
                    <div class="form-group textgroup">
                        <label class="col-sm-2 control-label">Rekomendasi 4</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rekomendasi_4" name="rekomendasi_4" 
                            value="<?php echo $row['rekomendasi_4']; ?>">
                        </div>
                    </div>
                    <div class="form-group textgroup">
                    	<label class="col-sm-2 control-label">Status Monitoring 4</label>
                        <div class="col-sm-10">
	                    	<select name="status_monitoring_4[<?=$row['id_audit']?>]" id="status_monitoring_4" class="chosen-select form-control" id="form-field-select-3">
	                    		<option class="option" value="">Pilih Status</option>
								<option value="M" <?php if($row['status_monitoring_4'] == 'M'){ echo 'selected';} ?>>Memadai</option>
								<option value="T" <?php if($row['status_monitoring_4'] == 'T'){ echo 'selected';} ?>>Tidak Memadai</option>
								<option value="P" <?php if($row['status_monitoring_4'] == 'P'){ echo 'selected';} ?>>Dalam Pemantauan</option>
							</select>
						</div>
                    </div>
                    <div class="form-group textgroup">
                        <label class="col-sm-2 control-label">Rekomendasi 5</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rekomendasi_5" name="rekomendasi_5" 
                            value="<?php echo $row['rekomendasi_5']; ?>">
                        </div>
                    </div>
                    <div class="form-group textgroup">
                    	<label class="col-sm-2 control-label">Status Monitoring 5</label>
                        <div class="col-sm-10">
	                    	<select name="status_monitoring_5[<?=$row['id_audit']?>]" id="status_monitoring_5" class="chosen-select form-control" id="form-field-select-3">
	                    		<option class="option" value="">Pilih Status</option>
								<option value="M" <?php if($row['status_monitoring_5'] == 'M'){ echo 'selected';} ?>>Memadai</option>
								<option value="T" <?php if($row['status_monitoring_5'] == 'T'){ echo 'selected';} ?>>Tidak Memadai</option>
								<option value="P" <?php if($row['status_monitoring_5'] == 'P'){ echo 'selected';} ?>>Dalam Pemantauan</option>
							</select>
						</div>
                    </div>
                    <div class="form-group textgroup">
                        <label class="col-sm-2 control-label">Rekomendasi 6</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rekomendasi_6" name="rekomendasi_6" 
                            value="<?php echo $row['rekomendasi_6']; ?>">
                        </div>
                    </div>
                    <div class="form-group textgroup">
                    	<label class="col-sm-2 control-label">Status Monitoring 6</label>
                        <div class="col-sm-10">
	                    	<select name="status_monitoring_6[<?=$row['id_audit']?>]" id="status_monitoring_6" class="chosen-select form-control" id="form-field-select-3">
	                    		<option class="option" value="">Pilih Status</option>
								<option value="M" <?php if($row['status_monitoring_6'] == 'M'){ echo 'selected';} ?>>Memadai</option>
								<option value="T" <?php if($row['status_monitoring_6'] == 'T'){ echo 'selected';} ?>>Tidak Memadai</option>
								<option value="P" <?php if($row['status_monitoring_6'] == 'P'){ echo 'selected';} ?>>Dalam Pemantauan</option>
							</select>
						</div>
                    </div>
                    <div class="form-group textgroup">
                        <label class="col-sm-2 control-label">Rekomendasi 7</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rekomendasi_7" name="rekomendasi_7" 
                            value="<?php echo $row['rekomendasi_7']; ?>">
                        </div>
                    </div>
                    <div class="form-group textgroup">
                    	<label class="col-sm-2 control-label">Status Monitoring 7</label>
                        <div class="col-sm-10">
	                    	<select name="status_monitoring_7[<?=$row['id_audit']?>]" id="status_monitoring_7" class="chosen-select form-control" id="form-field-select-3">
	                    		<option class="option" value="">Pilih Status</option>
								<option value="M" <?php if($row['status_monitoring_7'] == 'M'){ echo 'selected';} ?>>Memadai</option>
								<option value="T" <?php if($row['status_monitoring_7'] == 'T'){ echo 'selected';} ?>>Tidak Memadai</option>
								<option value="P" <?php if($row['status_monitoring_7'] == 'P'){ echo 'selected';} ?>>Dalam Pemantauan</option>
							</select>
						</div>
                    </div>
                    <div class="form-group textgroup">
                        <label class="col-sm-2 control-label">Rekomendasi 8</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rekomendasi_8" name="rekomendasi_8" 
                            value="<?php echo $row['rekomendasi_8']; ?>">
                        </div>
                    </div>
                    <div class="form-group textgroup">
                    	<label class="col-sm-2 control-label">Status Monitoring 8</label>
                        <div class="col-sm-10">
	                    	<select name="status_monitoring_8[<?=$row['id_audit']?>]" id="status_monitoring_8" class="chosen-select form-control" id="form-field-select-3">
	                    		<option class="option" value="">Pilih Status</option>
								<option value="M" <?php if($row['status_monitoring_8'] == 'M'){ echo 'selected';} ?>>Memadai</option>
								<option value="T" <?php if($row['status_monitoring_8'] == 'T'){ echo 'selected';} ?>>Tidak Memadai</option>
								<option value="P" <?php if($row['status_monitoring_8'] == 'P'){ echo 'selected';} ?>>Dalam Pemantauan</option>
							</select>
						</div>
                    </div>
                    <div class="form-group textgroup">
                        <label class="col-sm-2 control-label">Rekomendasi 9</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rekomendasi_9" name="rekomendasi_9" 
                            value="<?php echo $row['rekomendasi_9']; ?>">
                        </div>
                    </div>
                    <div class="form-group textgroup">
                    	<label class="col-sm-2 control-label">Status Monitoring 9</label>
                        <div class="col-sm-10">
	                    	<select name="status_monitoring_9[<?=$row['id_audit']?>]" id="status_monitoring_9" class="chosen-select form-control" id="form-field-select-3">
	                    		<option class="option" value="">Pilih Status</option>
								<option value="M" <?php if($row['status_monitoring_9'] == 'M'){ echo 'selected';} ?>>Memadai</option>
								<option value="T" <?php if($row['status_monitoring_9'] == 'T'){ echo 'selected';} ?>>Tidak Memadai</option>
								<option value="P" <?php if($row['status_monitoring_9'] == 'P'){ echo 'selected';} ?>>Dalam Pemantauan</option>
							</select>
						</div>
                    </div>
                    <div class="form-group textgroup">
                        <label class="col-sm-2 control-label">Rekomendasi 10</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rekomendasi_10" name="rekomendasi_10" 
                            value="<?php echo $row['rekomendasi_10']; ?>">
                        </div>
                    </div>
                    <div class="form-group textgroup">
                    	<label class="col-sm-2 control-label">Status Monitoring 10</label>
                        <div class="col-sm-10">
	                    	<select name="status_monitoring_10[<?=$row['id_audit']?>]" id="status_monitoring_10" class="chosen-select form-control" id="form-field-select-3">
	                    		<option class="option" value="">Pilih Status</option>
								<option value="M" <?php if($row['status_monitoring_10'] == 'M'){ echo 'selected';} ?>>Memadai</option>
								<option value="T" <?php if($row['status_monitoring_10'] == 'T'){ echo 'selected';} ?>>Tidak Memadai</option>
								<option value="P" <?php if($row['status_monitoring_10'] == 'P'){ echo 'selected';} ?>>Dalam Pemantauan</option>
							</select>
						</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deadline</label>
                        <div class="col-sm-10">
                            <input type="date" name="deadline" max="3000-12-31" 
    						min="1000-01-01" class="form-control" value="<?php echo $deadline; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">RPM OPT</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rpm_opt" name="rpm_opt" value="<?php echo $row['rpm_opt']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggapan SKAI</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tanggapan_skai" name="tanggapan_skai" value="<?php echo $row['tanggapan_skai']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Risk Issue</label>
                        <div class="col-sm-10">
                            <select name="risk_issue[<?=$row['id_audit']?>]" id="risk_issue" class="chosen-select form-control" id="form-field-select-3" required>
                                <?php 
                                    foreach($risk_issue as $data){ 
                                        $id_risk = $data['id_riskissue'];
                                        if($row['risk_issue'] == $id_risk){
                                            echo "<option selected ='selected' value=".$data['id_riskissue'].">".$data['nama_risk']."</option>";
                                        }else{
                                            echo "<option value=".$data['id_riskissue'].">".$data['nama_risk']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tipe Temuan</label>
                        <div class="col-sm-10">
                            <select name="tipe_temuan[<?=$row['id_audit']?>]" id="tipe_temuan" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option value="Fraud" <?php if($row['tipe_temuan'] == 'Fraud'){ echo 'selected';} ?>>Fraud</option>
                            	<option value="Non Fraud" <?php if($row['tipe_temuan'] == 'Non Fraud'){ echo 'selected';} ?>>Non Fraud</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Proses Major</label>
                        <div class="col-sm-10">
                            <select name="proses_major[<?=$row['id_audit']?>]" id="proses_major" class="chosen-select form-control" id="form-field-select-3" required>
                                <?php 
                                    foreach($proses_major as $data){ 
                                        $id_major = $data['id_major'];
                                        if($row['proses_major'] == $id_major){
                                            echo "<option selected ='selected' value=".$data['id_major'].">".$data['proses_major']."</option>";
                                        }else{
                                            echo "<option value=".$data['id_major'].">".$data['proses_major']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sub Proses Major</label>
                        <div class="col-sm-10">
                            <select name="subproses_major[<?=$row['id_audit']?>]" id="subproses_major" class="chosen-select form-control" id="form-field-select-3" required>
                                <?php 
                                    foreach($sub_proses as $data){ 
                                        $id_subproses = $data['id_subproses'];
                                        if($row['subproses_major'] == $id_subproses){
                                            echo "<option selected ='selected' value=".$data['id_subproses'].">".$data['sub_proses']."</option>";
                                        }else{
                                            echo "<option value=".$data['id_subproses'].">".$data['sub_proses']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Upload File</label>
                        <div class="col-sm-10">
                            <input type="file" name="file">
                            <span>
                            	<a href="<?php echo base_url().'upload/audit/internal/'.$row['upload']; ?>" class="dwn" target="_blank">
                            		<?php echo $row['upload']; ?>
                            	</a>
                            </span>
                            <input type="hidden" name="upload_sebelum" value="<?php echo $row['upload'];?>">
                        </div>
                    </div>
                   	<input type="hidden" name="tahun_input" value="<?php echo $tahun;?>">
                    <input type="hidden" name="id_audit[]" value="<?php echo $row['id_audit'];?>">
                    <input type="hidden" name="username_monica" value="<?php echo $username_monica;?>">
		        </div>
		        <div class="modal-footer">
		            <button type="submit" name="updateauditinternal" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>Update</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Batal</button>
		        </div>
	    	</form>
	    </div>
    </div>
</div>
<div class="modal fade" id="hapus_modal<?php echo $row['id_audit'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi Hapus Data Audit Internal</h4>
		    </div>
		    <div class="modal-body">
		    	<form class="form-horizontal" action="<?php echo base_url().'monica/data_audit_internal'?>" method="post">
			        <div class="modal-body">
			            <div class="form-group">
	                        <p> Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
	                    </div>
	                    <input type="hidden" name="id_audit" value="<?php echo $row['id_audit'];?>">
	                    <input type="hidden" name="upload_sebelum" value="<?php echo $row['upload'];?>">
	                    <input type="hidden" name="tahun_input" value="<?php echo $tahun;?>">
	                    <input type="hidden" name="username_monica" value="<?php echo $username_monica;?>">
			        </div>
			        <div class="modal-footer">
			        	<button type="submit" name="hapusauditinternal" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>Ya</button>
        				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tidak</button>
			        </div>
		    	</form>
		    </div>
	    </div>
    </div>
</div>
<?php endforeach;?>

<div class="modal fade" id="lihat_modal" tabindex="-1" role="dialog" aria-labelledby="lihat_modal" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:1300px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Data Audit Internal</h4>
				<div class="modal-body">
		        	<table id="table1" class="table table-bordered table-hover responsive">
						<thead>
							<tr>
								<th>Tema Audit</th>
								<th>Data Temuan</th>
								<th>Status Monitoring</th>
								<th>Status Deadline</th>
								<th>Bagian</th>
								<th>Kategori Temuan</th>
								<th>Rekomendasi AIN</th>
								<th>RPM OPT</th>
								<th>Tanggapan SKAI</th>
								<th>Risk Issue</th>
								<th>Tipe Temuan</th>
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

<!-- Modal Tambah Audit Internal-->
<div id="tambahaudit" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambahkan Audit Internal Baru</h4>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('monica/data_audit_internal'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">SHA Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sha_code" name="sha_code" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tema Audit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tema_audit" name="tema_audit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Bagian Terkait</label>
                        <div class="col-sm-10">
                            <select name="bagian_terkait" class="chosen-select form-control" id="form-field-select-3" required>
                                <option class="option" value="">Pilih Bagian</option>
                                <?php foreach($nama_divisi as $row) { ?>
                                    <option value="<?php echo $row['id_divisi']; ?>">
                                        <?php echo $row['nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Data Temuan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="data_temuan" name="data_temuan" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kategori Temuan</label>
                        <div class="col-sm-10">
                            <select name="kategori_temuan" class="chosen-select form-control" id="form-field-select-3" required>
                                <option class="option" value="">Pilih Kategori</option>
                                <?php foreach($nama_kategori as $row) { ?>
                                    <option value="<?php echo $row['id_kategori']; ?>">
                                        <?php echo $row['nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rekomendasi 1</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rekomendasi_1" name="rekomendasi_1" required>
                        </div>
                    </div>
                    <div class="form-group" id="TextBoxesGroup">
                        <label class="col-sm-2 control-label">Status Monitoring 1</label>
                        <div class="col-sm-10">
                            <select name="status_monitoring_1" class="chosen-select form-control" id="form-field-select-3" required>
                                <option class="option" value="">Pilih Status</option>
                                <option class="option" value="M">Memadai</option>
                                <option class="option" value="T">Tidak Memadai</option>
                                <option class="option" value="P">Dalam Pemantauan</option>
                            </select>
                            <br>
                            <input type='button' value='Tambah Rekomendasi' id='addButton'>
                            <input type='button' value='Hapus Rekomendasi' id='removeButton'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deadline</label>
                        <div class="col-sm-10">
                            <input type="date" name="deadline" max="3000-12-31" 
                            min="1000-01-01" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">RPM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rpm_opt" name="rpm_opt" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggapan SKAI</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tanggapan_skai" name="tanggapan_skai" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Risk Issue</label>
                        <div class="col-sm-10">
                            <select name="risk_issue" class="chosen-select form-control" id="form-field-select-3" required>
                                <option class="option" value="">Pilih Risk Issue</option>
                                <?php foreach($risk_issue as $row) { ?>
                                    <option value="<?php echo $row['id_riskissue']; ?>">
                                        <?php echo $row['nama_risk']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tipe Temuan</label>
                        <div class="col-sm-10">
                            <select name="tipe_temuan" class="chosen-select form-control" id="form-field-select-3" required>
                                <option class="option" value="">Pilih Tipe Temuan</option>
                                <option class="option" value="Fraud">Fraud</option>
                                <option class="option" value="Non Fraud">Non Fraud</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Proses Major</label>
                        <div class="col-sm-10">
                            <select name="proses_major" class="chosen-select form-control" id="form-field-select-3" required>
                                <option class="option" value="">Pilih Proses Major</option>
                                <?php foreach($proses_major as $row) { ?>
                                    <option value="<?php echo $row['id_major']; ?>">
                                        <?php echo $row['proses_major']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sub Proses Major</label>
                        <div class="col-sm-10">
                            <select name="subproses_major" class="chosen-select form-control" id="form-field-select-3" required>
                                <option class="option" value="">Pilih Sub Proses Major</option>
                                <?php foreach($sub_proses as $row) { ?>
                                    <option value="<?php echo $row['id_subproses']; ?>">
                                        <?php echo $row['sub_proses']; ?>
                                    </option>
                                <?php } ?>
                            </select>
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
                    <button type="submit" name="tambahauditinternal" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
                    Tambah Audit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
                    Batal</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<!-- Warna row datatable -->
<style>
	.yellow {background-color: yellow !important;}
</style>

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
		"scrollY":  "520px",
		"scrollCollapse": true,
		"searching": true,
		"columnDefs": [{
            "targets": [ 0 ],
            "visible": false,
            "searchable": false
        }],
        "rowCallback": function( row, data, index ) {
        	var status_monitoring = $('#status span').text();
			var deadline = parseInt(data[5]);
			$node = this.api().row(row).nodes().to$();
			if(deadline <= -1 && status_monitoring != 'MEMADAI') { $node.addClass('yellow') }
			if(deadline >= 0 && deadline <= 14 && status_monitoring != 'MEMADAI') { $node.addClass('yellow') }
		}   
	});

	// Filter event handler
	$(table.table().container()).on('keyup','thead input',function(){
		table.column($(this).data('index')).search(this.value).draw();
	});
</script>

<!-- Tampil detail audit internal -->
<script>
	function LihatData(id_audit) 
	{
		var id_audit = JSON.stringify(id_audit);
		$.ajax({
			method: 'POST',
			url: "<?php echo base_url('monica/data_audit_internal/detail_audit_internal/'); ?>",
			data: {id_audit: id_audit},
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

<!-- Tambah text otomatis di tambah data -->
<script type="text/javascript">
    $(document).ready(function()
    {
        var counter = 2;        
        $("#addButton").click(function () 
        {
            if(counter>10)
            {
                alert("Hanya 10 Rekomendasi yang diizinkan");
                return false;
            }   
            var newTextBoxDiv = $(document.createElement('div'))
                 .attr("id", 'TextBoxDiv' + counter);
                        
            newTextBoxDiv.after().html('<label class="col-sm-2 control-label"><br>Rekomendasi '+ counter + '</label>' +
                  '<div class="col-sm-10"><br><input class="form-control" type="text" name="rekomendasi_tambahan[]' + counter + 
                  '" id="textbox' + counter + '" required></div>' + '<label class="col-sm-2 control-label"><br>Status Monitoring '+ counter + '</label>' +
                  '<div class="col-sm-10"><br><select name="status_monitoring_tambahan[]" class="chosen-select form-control" id="form-field-select-3" required><option class="option" value="">Pilih Status</option><option class="option" value="M">Memadai</option><option class="option" value="T">Tidak Memadai</option><option class="option" value="P">Dalam Pemantauan</option></select></div>');

            newTextBoxDiv.appendTo("#TextBoxesGroup");
            counter++;
        });

        $("#removeButton").click(function () {
            if(counter==2)
            {
                alert("Tidak ada rekomendasi yang dihapus");
                return false;
            }   
            counter--;  
            $("#TextBoxDiv" + counter).remove();
        });
    });
</script>

<!-- Stop refresh -->
<script>
    if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href);
    }
</script>