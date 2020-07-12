<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content" style="overflow-x:hidden;">
			<!-- Level Maturity APP -->
			<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                    <div class="box-body">
						    <div id="audit-app" style="height:400px;"></div>
	                    </div>
	                </div>
	            </div>
        	</div><br>
        	<!-- Level Maturity Bagian -->
        	<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                    <div class="box-body">
	                    	<div class="row">
	                    		<?php for($x=0; $x<=$count; $x++){ $nama  = $bagian[$x]; ?>
	                    			<div id="audit-<?php echo $nama; ?>" style="width: 274px; float: left;"></div>
	                    		<?php } ?>
							</div>
	                    </div>
	                </div>
	            </div>
        	</div><br>

        	<!-- Risk By Apps -->
			<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                    <div class="box-body">
                    		<div id="riskByApps"></div>
	                    </div>
	                </div>
	            </div>
        	</div><br>

        	<style>
        		.judulAplikasi{ color: #FFFFFF; font-size:20px;}
        	</style>

        	<!-- Very Critical -->
        	<?php if($countVC != -1) { ?>
        	<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                	<p align="center" class="judulAplikasi">Aplikasi Very Critical</p>
	                    <div class="box-body">
	                    	<?php 
			        			array_walk($idVC, function(&$v){
								    $v = str_replace(' ', '', trim($v));
								});
			        			for($x=0; $x<=$countVC; $x++){ $id_VC = $idVC[$x]; ?>
			        			<div id="<?php echo $id_VC; ?>" style="float: left;"></div>
			        		<?php } ?>
	                    </div>
	                </div>
	            </div>
        	</div><br><br>
        	<?php } ?>

        	<!-- Critical -->
        	<?php if($countC != -1) { ?>
        	<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                	<p align="center" class="judulAplikasi">Aplikasi Critical</p>
	                    <div class="box-body">
	                    	<?php 
			        			array_walk($idC, function(&$v){
								    $v = str_replace(' ', '', trim($v));
								});
			        			for($x=0; $x<=$countC; $x++){ $id_C = $idC[$x]; ?>
			        			<div id="<?php echo $id_C; ?>" style="float: left;"></div>
			        		<?php } ?>
	                    </div>
	                </div>
	            </div>
        	</div><br><br>
        	<?php } ?>

        	<!-- High -->
        	<?php if($countH != -1) { ?>
        	<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                	<p align="center" class="judulAplikasi">Aplikasi High</p>
	                    <div class="box-body">
	                    	<?php 
			        			array_walk($idH, function(&$v){
								    $v = str_replace(' ', '', trim($v));
								});
			        			for($x=0; $x<=$countH; $x++){ $id_H = $idH[$x]; ?>
			        			<div id="<?php echo $id_H; ?>" style="float: left;"></div>
			        		<?php } ?>
	                    </div>
	                </div>
	            </div>
        	</div><br><br>
        	<?php } ?>

        	<!-- Medium -->
        	<?php if($countM != -1) { ?>
        	<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                	<p align="center" class="judulAplikasi">Aplikasi Medium</p>
	                    <div class="box-body">
	                    	<?php 
			        			array_walk($idM, function(&$v){
								    $v = str_replace(' ', '', trim($v));
								});
			        			for($x=0; $x<=$countM; $x++){ $id_M = $idM[$x]; ?>
			        			<div id="<?php echo $id_M; ?>" style="float: left;"></div>
			        		<?php } ?>
	                    </div>
	                </div>
	            </div>
        	</div><br><br>
        	<?php } ?>

        	<!-- Low -->
        	<?php if($countL != -1) { ?>
        	<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                	<p align="center" class="judulAplikasi">Aplikasi Medium</p>
	                    <div class="box-body">
	                    	<?php 
			        			array_walk($idL, function(&$v){
								    $v = str_replace(' ', '', trim($v));
								});
			        			for($x=0; $x<=$countL; $x++){ $id_L = $idL[$x]; ?>
			        			<div id="<?php echo $id_L; ?>" style="float: left;"></div>
			        		<?php } ?>
	                    </div>
	                </div>
	            </div>
        	</div><br><br>
        	<?php } ?>

        	<!--
        	<div class="row">
	            <div class="col-xs-12">
	                <div class="box box-primary">
	                    <div class="box-body">
                    		<div class="row">
						        <div class="col-lg-4">
						            <div id="test-circle2"></div>
						        </div>
						        <div class="col-lg-4">
						            <div id="test-circle3"></div>
						        </div>
						    </div>
	                    </div>
	                </div>
	            </div>
        	</div>
            -->
		</div>
	</div>
</div>


<!-- Level Maturity Audit -->
<script>
	$("#audit-app").dxCircularGauge({
		scale: {
			startValue: 0,  
			endValue: 100,
			majorTick: {tickInterval: 10},
			label: {
				font: {size: 15, color: "white"},
                customizeText: function (arg) {
                    return arg.valueText + " %";
                }
            }
		},
		rangeContainer: { 
			ranges: [
                {startValue: 0, endValue: 20, color: "#FF0000"},
                {startValue: 20, endValue: 40, color: "#F38840"},
                {startValue: 40, endValue: 60, color: "#FFFF00"},
                {startValue: 60, endValue: 80, color: "#008000"},
                {startValue: 80, endValue: 100, color: "#0000FF"}
            ]
		},
		title: {
			text: 'Maturity Audit APP',
			font: {size: 28, color: "white"},
			position: 'top-center'
		},
		subvalueIndicator: {
			type: 'textCloud',
			format: 'thousands',
			color: "black",
			text: {
				customizeText: function (arg) {
					return arg.valueText + " %";
				}
			}  
		},
		valueIndicator: {
			color: "white"
		},
		value: <?php echo $maturity_app ?>,
		subvalues: [<?php echo $maturity_app ?>]
	});

	<?php for($x=0; $x<=$count; $x++){ $nama  = $bagian[$x]; $nilai = $urutan[$x]; ?>
	$("#audit-<?php echo $nama; ?>").dxCircularGauge({
		scale: {
			startValue: 0,  
			endValue: 100,
			majorTick: { tickInterval: 10 },
			label: {
				font: {size: 13, color: "white"},
	            customizeText: function (arg) {
	                return arg.valueText + " %";
	            }
	        }
		},
		rangeContainer: { 
			ranges: [
	            {startValue: 0, endValue: 20, color: "#FF0000"},
	            {startValue: 20, endValue: 40, color: "#F38840"},
	            {startValue: 40, endValue: 60, color: "#FFFF00"},
	            {startValue: 60, endValue: 80, color: "#008000"},
	            {startValue: 80, endValue: 100, color: "#0000FF"}
	        ]
		},
		title: {
			text: 'Maturity Audit <?php echo $nama; ?>',
			font: {size: 15, color: "white"},
			position: 'top-center'
		},
		subvalueIndicator: {
			type: 'textCloud',
			format: 'thousands',
			color: "black",
			font: {size: 15},
			text: {
				customizeText: function (arg) {
					return arg.valueText + " %";
				}
			}  
		},
		valueIndicator: {
			color: "white"
		},
		value: <?php echo $nilai; ?>,
		subvalues: <?php echo $nilai; ?>
	});
	<?php } ?>
</script>

<!-- Risk By Apps -->
<script>
	//All Monitoring Risk By Apps
	FusionCharts.ready(function() {
		var myChart = new FusionCharts({
			type: "angulargauge",renderAt: "riskByApps",containerBackgroundOpacity: "0",width: "100%",
			height: "500",dataFormat: "json",dataSource
		}).render();
	});
	const dataSource = {
		chart: {
			caption: "Risk By Apps",captionFontColor: "#FFFFFF",captionFontSize: "25",captionFont: "Arial",
			subcaption: "<?php echo $all_monitoring; ?>",subcaptionFontSize: "18",	
			subcaptionFontColor: "#FFFFFF",chartBottomMargin: "80",lowerlimit: "0",
			upperlimit: "5",showvalue: "1",theme: "fusion",showtooltip: "0",bgAlpha: "0",majorTMNumber: "10",
      		minorTMNumber: "5",majorTMColor: "#333333",majorTMAlpha: "100",majorTMHeight: "15",
			majorTMThickness: "2",minorTMColor: "#666666",minorTMAlpha: "100",minorTMHeight: "12",
			minorTMThickness: "1",labelFontColor: "#FFFFFF",labelFontSize: "20"
		},
		colorrange: {
			color: [
				{minvalue: "0",maxvalue: "1",code: "#1dc080"},
				{minvalue: "1",maxvalue: "2",code: "#9AF233"},
				{minvalue: "2",maxvalue: "3",code: "#FFFF00"},
				{minvalue: "3",maxvalue: "4",code: "#FFA500"},
				{minvalue: "4",maxvalue: "5",code: "#FF0000"}
			]
		},
		dials: {
			dial: [
				{value: "<?php echo $all_monitoring; ?>",bgColor: "#FFFFFF",borderColor: "#FFFFFF",borderThickness: "5",
            	radius: "240",rearExtension: "7"}
			]
		}
	};

	//Very Critical
	<?php for($x=0; $x<=$countVC; $x++){ $id_VC = $idVC[$x]; $nilai_VC = $nilaiVC[$x]; $nama_VC = $namaVC[$x]; ?>
	FusionCharts.ready(function() {
		var cSatScoreChart = new FusionCharts({
			type: 'angulargauge',renderAt: '<?php echo $id_VC; ?>',containerBackgroundOpacity: "0",width: '269',
			height: '250',dataFormat: 'json',
			dataSource: {
				"chart": {"caption": "<?php echo $nama_VC; ?>","captionFontColor": "#FFFFFF","subcaption": "<?php echo $nilai_VC; ?>",
							"subcaptionFontColor": "#FFFFFF","lowerLimit": "0","upperLimit": "5","theme": "fusion","bgAlpha": "0",
							"chartBottomMargin": "40","labelFontColor": "#FFFFFF"
				},
				"colorRange": {"color": [{"minValue": "0","maxValue": "1","code": "#1dc080"},
										{"minValue": "1","maxValue": "2","code": "#9AF233"},
										{"minValue": "2","maxValue": "3","code": "#FFFF00"},
										{"minValue": "3","maxValue": "4","code": "#FFA500"},
										{"minValue": "4","maxValue": "5","code": "#FF0000"}
										]
				},
				"dials": {
					"dial": [{
						"value": "<?php echo $nilai_VC; ?>","bgColor": "#FFFFFF","borderColor": "#FFFFFF","borderThickness": "5",
        				"radius": "78","rearExtension": "7"
					}]
				}
			}
		}).render();
	});
	<?php } ?>

	//Critical
	<?php for($x=0; $x<=$countC; $x++){ $id_C = $idC[$x]; $nilai_C = $nilaiC[$x]; $nama_C = $namaC[$x]; ?>
	FusionCharts.ready(function() {
		var cSatScoreChart = new FusionCharts({
			type: 'angulargauge',renderAt: '<?php echo $id_C; ?>',containerBackgroundOpacity: "0",width: '269',
			height: '250',dataFormat: 'json',
			dataSource: {
				"chart": {"caption": "<?php echo $nama_C; ?>","captionFontColor": "#FFFFFF","subcaption": "<?php echo $nilai_C; ?>",
							"subcaptionFontColor": "#FFFFFF","lowerLimit": "0","upperLimit": "5","theme": "fusion","bgAlpha": "0",
							"chartBottomMargin": "40","labelFontColor": "#FFFFFF"
				},
				"colorRange": {"color": [{"minValue": "0","maxValue": "1","code": "#1dc080"},
										{"minValue": "1","maxValue": "2","code": "#9AF233"},
										{"minValue": "2","maxValue": "3","code": "#FFFF00"},
										{"minValue": "3","maxValue": "4","code": "#FFA500"},
										{"minValue": "4","maxValue": "5","code": "#FF0000"}
										]
				},
				"dials": {
					"dial": [{
						"value": "<?php echo $nilai_C; ?>","bgColor": "#FFFFFF","borderColor": "#FFFFFF","borderThickness": "5",
        				"radius": "78","rearExtension": "7"
					}]
				}
			}
		}).render();
	});
	<?php } ?>

	//High
	<?php for($x=0; $x<=$countH; $x++){ $id_H = $idH[$x]; $nilai_H = $nilaiH[$x]; $nama_H = $namaH[$x]; ?>
	FusionCharts.ready(function() {
		var cSatScoreChart = new FusionCharts({
			type: 'angulargauge',renderAt: '<?php echo $id_H; ?>',containerBackgroundOpacity: "0",width: '269',
			height: '250',dataFormat: 'json',
			dataSource: {
				"chart": {"caption": "<?php echo $nama_H; ?>","captionFontColor": "#FFFFFF","subcaption": "<?php echo $nilai_H; ?>",
							"subcaptionFontColor": "#FFFFFF","lowerLimit": "0","upperLimit": "5","theme": "fusion","bgAlpha": "0",
							"chartBottomMargin": "40","labelFontColor": "#FFFFFF"
				},
				"colorRange": {"color": [{"minValue": "0","maxValue": "1","code": "#1dc080"},
										{"minValue": "1","maxValue": "2","code": "#9AF233"},
										{"minValue": "2","maxValue": "3","code": "#FFFF00"},
										{"minValue": "3","maxValue": "4","code": "#FFA500"},
										{"minValue": "4","maxValue": "5","code": "#FF0000"}
										]
				},
				"dials": {
					"dial": [{
						"value": "<?php echo $nilai_H; ?>","bgColor": "#FFFFFF","borderColor": "#FFFFFF","borderThickness": "5",
        				"radius": "78","rearExtension": "7"
					}]
				}
			}
		}).render();
	});
	<?php } ?>

	//Medium
	<?php for($x=0; $x<=$countM; $x++){ $id_M = $idM[$x]; $nilai_M = $nilaiM[$x]; $nama_M = $namaM[$x]; ?>
	FusionCharts.ready(function() {
		var cSatScoreChart = new FusionCharts({
			type: 'angulargauge',renderAt: '<?php echo $id_M; ?>',containerBackgroundOpacity: "0",width: '269',
			height: '250',dataFormat: 'json',
			dataSource: {
				"chart": {"caption": "<?php echo $nama_M; ?>","captionFontColor": "#FFFFFF","subcaption": "<?php echo $nilai_M; ?>",
							"subcaptionFontColor": "#FFFFFF","lowerLimit": "0","upperLimit": "5","theme": "fusion","bgAlpha": "0",
							"chartBottomMargin": "40","labelFontColor": "#FFFFFF"
				},
				"colorRange": {"color": [{"minValue": "0","maxValue": "1","code": "#1dc080"},
										{"minValue": "1","maxValue": "2","code": "#9AF233"},
										{"minValue": "2","maxValue": "3","code": "#FFFF00"},
										{"minValue": "3","maxValue": "4","code": "#FFA500"},
										{"minValue": "4","maxValue": "5","code": "#FF0000"}
										]
				},
				"dials": {
					"dial": [{
						"value": "<?php echo $nilai_M; ?>","bgColor": "#FFFFFF","borderColor": "#FFFFFF","borderThickness": "5",
        				"radius": "78","rearExtension": "7"
					}]
				}
			}
		}).render();
	});
	<?php } ?>

	//Low
	<?php for($x=0; $x<=$countL; $x++){ $id_L = $idL[$x]; $nilai_L = $nilaiL[$x]; $nama_L = $namaL[$x]; ?>
	FusionCharts.ready(function() {
		var cSatScoreChart = new FusionCharts({
			type: 'angulargauge',renderAt: '<?php echo $id_L; ?>',containerBackgroundOpacity: "0",width: '269',
			height: '250',dataFormat: 'json',
			dataSource: {
				"chart": {"caption": "<?php echo $nama_L; ?>","captionFontColor": "#FFFFFF","subcaption": "<?php echo $nilai_L; ?>",
							"subcaptionFontColor": "#FFFFFF","lowerLimit": "0","upperLimit": "5","theme": "fusion","bgAlpha": "0",
							"chartBottomMargin": "40","labelFontColor": "#FFFFFF"
				},
				"colorRange": {"color": [{"minValue": "0","maxValue": "1","code": "#1dc080"},
										{"minValue": "1","maxValue": "2","code": "#9AF233"},
										{"minValue": "2","maxValue": "3","code": "#FFFF00"},
										{"minValue": "3","maxValue": "4","code": "#FFA500"},
										{"minValue": "4","maxValue": "5","code": "#FF0000"}
										]
				},
				"dials": {
					"dial": [{
						"value": "<?php echo $nilai_L; ?>","bgColor": "#FFFFFF","borderColor": "#FFFFFF","borderThickness": "5",
        				"radius": "78","rearExtension": "7"
					}]
				}
			}
		}).render();
	});
	<?php } ?>
</script>

<!-- Kanan 
<script>
    $( document ).ready(function() {
        $("#test-circle").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 15,
            backgroundBorderWidth: 15,
            percent: 90,
            textSize: 28,
            textStyle: 'font-size: 12px;',
            textColor: '#666',
            replacePercentageByText: '90',
            text: "INF",
            iconPosition: 'bottom',
            progressColor: {10: '#1dc080', 30: '#9AF233', 50: 'yellow', 70: 'orange', 90: 'red'}
        });
        $("#test-circle2").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 15,
            backgroundBorderWidth: 15,
            percent: 20,
            textSize: 28,
            textStyle: 'font-size: 12px;',
            textColor: '#666',
            replacePercentageByText: '20',
            text: "ISD",
            iconPosition: 'bottom',
            progressColor: {10: '#1dc080', 30: '#9AF233', 50: 'yellow', 70: 'orange', 90: 'red'}
        });
        $("#test-circle3").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 15,
            backgroundBorderWidth: 15,
            percent: 48,
            textSize: 28,
            textStyle: 'font-size: 12px;',
            textColor: '#666',
            replacePercentageByText: '48',
            text: "KDR",
            iconPosition: 'bottom',
            progressColor: {10: '#1dc080', 30: '#9AF233', 50: 'yellow', 70: 'orange', 90: 'red'}
        });
    });
</script> -->