<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('dashboard_kdr'); ?>">Home</a>
				</li>
				<li class="active">Report KDR</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
			<div class="page-header">
				<h1>
					Report KDR
				</h1>
			</div>

			<div class="row">
				<div class="space-6"></div>
				<div class="col-xs-12">
					<table id="datatable" class="table table-bordered table-hover" style="font-size: 12;">	
						<thead>
							<tr>
								<th>Judul</th>
								<th>
									<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
									Update
								</th>   					
							</tr>
						</thead>

						<tbody>
						<?php 
							foreach($report_kdr as $data)
							{
								echo '
								<tr>
			                    <td>
									<a href="'.base_url('file/reportkdr/'.$data['nama_file']).'.pdf" target="blank">'.$data['judul'].'</a>
								</td>
								<td>'.$data["date_modified"].'</td>
			                    </tr>';
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>					

<script>
	$('#datatable').dataTable({
		"bProcessing": true,
		"sServerMethod": "POST",
		"iDisplayLength": 10,
		"sPaginationType": "full_numbers",
		"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
		"aaSorting": [[0, 'desc']],
		"aoColumnDefs": [{ "bSortable": false, "aTargets": [ ] }, 
            { "bSearchable": false, "aTargets": [] }],
		"fnDrawCallback": function() {
			$('.btn-delete').click(function(e) {
				e.preventDefault();
				var c = alertify.confirm('Anda akan menghapus data ini, Lanjutkan?').set('onok', function(){ window.location.href = $(e.delegateTarget).attr('href');} );
			});

		    $('#shift').change(function(){
				var a = $(this).val();
				var table = $('#example').DataTable();
		        table.draw();
			});
			
			$('[data-toggle="tooltip"]').tooltip();
		}
	});
</script>