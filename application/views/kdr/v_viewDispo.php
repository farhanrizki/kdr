<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li>
					<a href="<?php echo base_url('kdr/dispo_dio'); ?>">Dispo Dio</a>
				</li>
				<li class="active">View Data Dispo</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Data Dispo Dio
				</h1>
			</div>

			<style>
				.judul { font-size: 18px; }
				.isi { font-size: 15px; }
				.row { margin-left:10px; }
			</style>

			<dl class="row">
				<form method="post" action="<?php echo base_url(); ?>kdr/dispo_dio/update_keterangan">
				<?php foreach($lihat_dispo as $row) { ?>
					<dt class="col-sm-3 judul">Nomor Surat</dt>
					<dd class="col-sm-9 isi"><?php echo $row['no_surat']; ?></dd><br><br>

					<dt class="col-sm-3 judul">Agenda</dt>
					<dd class="col-sm-9 isi"><?php echo $row['agenda']; ?></dd><br><br>

					<dt class="col-sm-3 judul">Keterangan</dt>
					<dd class="col-sm-9 isi"><?php echo $row['keterangan']; ?></dd><br><br>

					<dt class="col-sm-3 judul">PIC</dt>
					<dd class="col-sm-9 isi"><?php echo $row['pic']; ?></dd><br><br>

					<dt class="col-sm-3 judul">Kategori</dt>
					<dd class="col-sm-9 isi"><?php echo $row['kategori']; ?></dd><br><br>

					<dt class="col-sm-3 judul">Sub Kategori</dt>
					<dd class="col-sm-9 isi"><?php echo $row['sub_kategori']; ?></dd><br><br>

					<dt class="col-sm-3 judul">Tanggal TL</dt>
					<dd class="col-sm-9 isi">
						<?php 
			        		if($row['tgl_tl'] == "") 
			        		{ 
			        			echo "-";
			        		}
			        		else
			        		{
			        			$time   = strtotime($row['tgl_tl']);
								$tgl_tl = date('d-m-Y',$time);
								echo $tgl_tl;
			        		}
			        	?>	
					</dd><br><br>

					<dt class="col-sm-3 judul">Keterangan TL</dt>
					<dd class="col-sm-9 isi">
						<?php 
			        		if($row['keterangan_tl'] == "") { ?> 
	        					<input type="text" class="col-sm-6" id="keterangan_tl" name="keterangan_tl" value="-" disabled>
                            		
			        		<?php } else { ?>
	        					<input type="text" class="col-sm-6" id="keterangan_tl" name="keterangan_tl" 
	        					value="<?php echo $row['keterangan_tl']; ?>">
			        		<?php }
			        	?>	
					</dd><br><br>

					<dt class="col-sm-3 judul">Tanggal Done</dt>
					<dd class="col-sm-9 isi">
						<?php 
			        		if($row['tgl_done'] == "") 
			        		{ 
			        			echo "-";
			        		}
			        		else
			        		{
			        			$time   = strtotime($row['tgl_done']);
								$tgl_done = date('d-m-Y',$time);
								echo $tgl_done;
			        		}
			        	?>			
					</dd><br><br>

					<dt class="col-sm-3 judul">Keterangan Done</dt>
					<dd class="col-sm-9 isi">
						<?php 
			        		if($row['keterangan_done'] == "") { ?> 
	        					<input type="text" class="col-sm-6" id="keterangan_done" name="keterangan_done" value="-" disabled>
                            		
			        		<?php } else { ?>
	        					<input type="text" class="col-sm-6" id="keterangan_done" name="keterangan_done" 
	        					value="<?php echo $row['keterangan_done']; ?>">
			        		<?php }
			        	?>
					</dd><br><br>

					<dt class="col-sm-3 judul">Tanggal Deadline</dt>
					<dd class="col-sm-9 isi">
						<?php 
							$time     = strtotime($row['due_date']);
							$due_date = date('d-m-Y',$time);
							echo $due_date;
						?>
					</dd><br><br>

					<dt class="col-sm-3 judul">Tanggal Dispo</dt>
					<dd class="col-sm-9 isi">
						<?php 
							$time      = strtotime($row['tgl_dispo']);
							$tgl_dispo = date('d-m-Y',$time);
							echo $tgl_dispo;
						?>	
					</dd>

					<input type="hidden" name="id_dispodio" value="<?php echo $row['id_dispodio'];?>">

					<dd class="col-sm-7 text-right">
						<?php 
			        		if($row['keterangan_tl'] != "" || $row['keterangan_done'] != "") { ?>
			        			<button type="submit" name="update" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Update Keterangan</button>
			        		<?php } else { }
			        	?>		
						
						<button type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url("kdr/dispo_dio");?>'">
		    				<i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Kembali 
		    			</button>
					</dd>
				<?php } ?>
				</form>
			</dl>
    	</div>
    </div>
</div>