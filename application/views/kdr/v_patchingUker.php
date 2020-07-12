<?php 
	if (!empty($tanggal)) 
	{
		$tanggal2      = explode(' / ',$tanggal);
		$tanggal_start = $tanggal2[0];
		$tanggal_end   = $tanggal2[1];
	}
	else
	{
		$tanggal_start = 0;
		$tanggal_end   = 0;
	}

	if($filter_uker != "semua")
	{
		$uker_a = $filter_uker;
	}
	else
	{
		$uker_a = "semua";
	}


?>

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li class="active">Patching Uker</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
			<div class="page-header">
				<h1>
					Patching Uker <?php echo $tahun; ?>
				</h1>
			</div>

			<div class="row">
				<div class="space-6"></div>
				<form method="post" action="<?php echo base_url('kdr/patching_uker'); ?>">
					<div class="col-xs-3">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>

							<input class="form-control" type="text" name="tanggal" id="id-date-range-picker-1" value="<?php if (!empty($tanggal)) {echo $tanggal;}?>"/>
						</div>
					</div>

					<div class="col-xs-3">
						<div class="input-group">
							<select name="uker" id="uker" class="chosen-select form-control" id="form-field-select-3" required>
                            	<option class="option" value="">-- Pilih Uker --</option>
                            	<option class="option" value="semua" <?php echo set_select('uker', 'semua'); ?>>Semua</option>
                            	<?php foreach($uker as $row) { ?>
                            		<option value="<?php echo $row['uker']; ?>" <?php echo set_select('uker',  $row['uker']); ?>>
                            			<?php echo $row['uker']; ?>
                            		</option>
                            	<?php } ?>
                            </select>

	                		<span class="input-group-btn" style="padding-left: 20px;">
								<button type="submit" class="btn btn-sm btn-success">
								Filter
								</button>
							</span>
	                	</div>
                	</div>

					&nbsp;&nbsp;&nbsp;
					<div class="infobox infobox-black">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-download"></i>
						</div>
						<div class="infobox-data">
							<div class="infobox-content">Download Excel</div>
							<div class="infobox-content"><a href="<?php echo base_url('kdr/patching_uker/download_uker/'.$tanggal_start.'/'.$tanggal_end.'/'.$uker_a);?>">Download</a></div>
						</div>
					</div>
				</form>
			</div>

			<div class="row">
				<div class="space-6"></div>
				<div class="space-6"></div>
				<div class="space-6"></div>
				<div class="col-xs-12">
					<table id="datatable" class="table table-bordered table-hover" style="font-size: 12;">	
						<thead>
							<tr>
								<th>Uker</th>
								<th>Jumlah Pacthing</th>					
							</tr>
						</thead>
						<tbody>
						<?php foreach($patching_uker as $data){ ?>
							<tr>
								<td>
									<a href="javascript:void(0)" onClick = "lihatUker(this.innerHTML);"><?php echo $data['uker']; ?></a>
								</td>
								<td><?=$data['hitung_uker']?></td>

		                    </tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>					

<!-- Menampilkan detail uker -->
<div class="modal fade" id="lihat_uker" tabindex="-1" role="dialog" aria-labelledby="lihat_uker" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div id="judul_uker"></div>
				<div class="modal-body">
		        	<table id="table1" class="table table-bordered table-hover responsive">
						<thead>
							<tr>
								<th>Uker</th>
								<th>Jumlah Patching</th>
							</tr>
						</thead>
						<tbody id="tampil_uker"></tbody>
					</table>
	            </div>
	            <div class="modal-footer">
		            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Tutup</button>
		        </div>
		    </div>
		</div>
	</div>
</div>

<!-- Datepicker -->
<script type="text/javascript">
	$('.input-daterange').datepicker({autoclose:true});
	$('input[name=tanggal]').daterangepicker({
        'applyClass' : 'btn-sm btn-success',
        'cancelClass' : 'btn-sm btn-default',
        locale: {
            applyLabel: 'Apply',
            cancelLabel: 'Cancel',
            format: 'YYYY-MM-DD',
            separator: ' / ',
        }
	})
	.prev().on(ace.click_event, function(){
	        $(this).next().focus();
	});
</script>

<!-- Datatables -->
<script>
	$(function () {
	    $('#datatable').DataTable({
	        "paging": true,
	        "lengthChange": true,
	        "searching": true,
	        "ordering": true,
	        "info": true,
	        "autoWidth": true
	    });
	});
</script>

<!-- Detail Uker -->
<script>
	function lihatUker(uker)
	{
		var uker          = uker;
		var tanggal_start = "<?php echo $tanggal_start; ?>";
		var tanggal_end   = "<?php echo $tanggal_end; ?>";
		var tanggal_start = tanggal_start;
		var tanggal_end   = tanggal_end;

		$.ajax({
			method: 'POST',
			url: "<?php echo base_url('kdr/patching_uker/lihat_data_uker/'); ?>",
			data: {uker: uker, tanggal_start: tanggal_start, tanggal_end: tanggal_end},
			dataType: 'JSON',
			success: function(data){
                $("#lihat_uker").modal('show');
                $('#tampil_uker').html(data);

				var tgl_awal  = "<?php echo date("d-m-Y", strtotime($tanggal_start)); ?>";
				var tgl_akhir = "<?php echo date("d-m-Y", strtotime($tanggal_end)); ?>";

				if (tanggal_start == 0)
				{
					document.getElementById('judul_uker').innerHTML = '<h4>Patching uker '+uker+ ' all of time! </h4>';
				}
				else
				{
					document.getElementById('judul_uker').innerHTML = '<h4>Patching uker '+uker+ ' dari tanggal '+tgl_awal+ ' sampai '+tgl_akhir+ '</h4>';
				}

            },
            error : function(data) {
           		alert("Gagal Load Data");
        	}
        });
	}
</script>