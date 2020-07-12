<?php
	header("Content-Type: application/force-download");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 2010 05:00:00 GMT"); 
	header("content-disposition: attachment;filename=patching_personal_".date('d-m-Y').".xls");
 
	echo 
	" 
		<table>
			<tr>
				<td>&nbsp;</td>
				<td style='border-style:none;font-weight: bold;'>Patching Personal ". $tanggal ."</td>
			</tr>
		</table>
		<table align='center' border='1'>
			<tr>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>No.</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Maker</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Jumlah Maker</td>
			</tr>
		</table> 
	";

	$no    = 1;
	$total = 0;
	foreach ($isiexcel as $row) 
	{	
		$total += $row['hitung_maker'];
		echo 
		"		
			<table align='center' border='1'>
				<tbody>
					<tr>
						<td>" . $no++ . "</td>
						<td>" . $row['maker'] . "</td>
						<td>" . $row['hitung_maker'] . "</td>
					</tr>
				</tbody>
			</table>
		";
	}

	echo 
	"
		<table align='center' border='1'>
			<tbody>
				<tr>
					<td style='background-color:#ffffff;border-style:none;'>&nbsp;</td>
					<td style='text-align:center;background-color:#C0C0C0;font-weight: bold;'>Total Maker</td>
					<td style='text-align:right;background-color:#C0C0C0;font-weight: bold;'>".$total."</td>
				</tr>
			</tbody>
		</table>
	";
?>