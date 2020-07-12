<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url('monica/dashboard_monica'); ?>">Home</a>
				</li>
				<li class="active">Tahun Audit Report</li>
			</ul>
		</div>

		<div class="page-content" style="overflow-x: hidden;">
			<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                    <div class="box-body">
	                       <div class="container">    
							    <div id="signupbox" style=" margin-top:20px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
							        <div class="panel panel-info">
							        	<div class="panel-heading">
							                <div class="panel-title">Masukan Tahun Audit Report</div>	
							            </div> 
							            <div class="panel-body">
							                <form method="post" action="<?php echo base_url().'monica/audit_report'?>">
							                    <div class="form-group">
							                        <label class="col-sm-2 control-label">Tahun</label>
							                        <div class="col-sm-10">
							                            <select name="tahun" id="tahun" class="chosen-select form-control" id="form-field-select-3" required>
							                            	<option class="option" value="">Pilih Tahun</option>
							                            	<option class="option" value="semua">Semua</option>
							                            	<?php foreach($tahun_audit_report as $row) { ?>
							                            		<option value="<?php echo $row['tahun']; ?>">
							                            			<?php echo $row['tahun']; ?>
							                            		</option>
							                            	<?php } ?>
							                            </select>
							                        </div>
							                    </div>
							                    <br>
							                    <br>	
							                    <br>
							                    <div class="form-group">
									            	<div class="col-md-12 text-center"> 
						                   	 			<button type="submit" name="lihatdata" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Lihat Data Audit Report </button>
						                   	 		</div>
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
    	</div>
    </div>
</div>