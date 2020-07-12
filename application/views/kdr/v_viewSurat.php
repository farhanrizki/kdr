<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li>
					<a href="<?php echo base_url('kdr/surat_keluar'); ?>">Surat Keluar</a>
				</li>
				<li class="active">View Data Surat Keluar</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Data Surat Keluar
				</h1>
			</div>

			<style>
				.judul { font-size: 18px; }
				.isi { font-size: 15px; }
				.row { margin-left:10px; }
			</style>

			<dl class="row">
				<?php foreach($lihat_surat as $row) { ?>
					<dt class="col-sm-3 judul">Nomor Surat</dt>
					<dd class="col-sm-9 isi"><?php echo $row['no_surat']; ?></dd><br><br>

					<dt class="col-sm-3 judul">Agenda</dt>
					<dd class="col-sm-9 isi"><?php echo $row['agenda']; ?></dd><br><br>

					<dt class="col-sm-3 judul">Dikirim ke Divisi</dt>
					<dd class="col-sm-9 isi"><?php echo $row['ke_divisi']; ?></dd><br><br>

					<dt class="col-sm-3 judul">PIC</dt>
					<dd class="col-sm-9 isi"><?php echo $row['pic']; ?></dd><br><br>

					<dt class="col-sm-3 judul">Kategori</dt>
					<dd class="col-sm-9 isi"><?php echo $row['kategori']; ?></dd><br><br>

					<dt class="col-sm-3 judul">Sub Kategori</dt>
					<dd class="col-sm-9 isi"><?php echo $row['sub_kategori']; ?></dd><br><br>

					<dt class="col-sm-3 judul">Tanggal</dt>
					<dd class="col-sm-9 isi">
						<?php 
							$time    = strtotime($row['tanggal']);
							$tanggal = date('d-m-Y',$time);
							echo $tanggal;
						?>	
					</dd>

					<dd class="col-sm-3 text-right">
						<button type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url("kdr/surat_keluar");?>'">
		    				<i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Kembali 
		    			</button>
					</dd>
				<?php } ?>
			</dl>
    	</div>
    </div>
</div>