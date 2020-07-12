<?php
	header("Content-Type: application/force-download");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 2010 05:00:00 GMT"); 
	header("content-disposition: attachment;filename=detail_patching_personal_".date('d-m-Y').".xls");
 
	echo 
	" 
		<table>
			<tr>
				<td>&nbsp;</td>
				<td style='border-style:none;font-weight: bold;'>Detail Patching Personal ". $nama_personal ." ". $tanggal ."</td>
			</tr>
		</table>
		<table align='center' border='1'>
			<tr>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>No.</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Tanggal Permohonan</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Tanggal Patching</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Patching</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Kategori</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Nomor Tiket</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>ID Patching</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Divisi</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Status</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Uker</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Maker</td>
			</tr>
		</table> 
	";

	$no = 1;
	foreach ($isiexcel as $row) 
	{	
		$tgl_permohonan = date('d M Y', strtotime($row['tgl_permohonan']));
		$tgl_patching   = date('d M Y', strtotime($row['tgl_patching']));
		echo 
		"		
			<table align='center' border='1'>
				<tbody>
					<tr>
						<td>" . $no++ . "</td>
						<td>" . $tgl_permohonan . "</td>
						<td>" . $tgl_patching . "</td>
						<td>" . $row['nama'] . "</td>
						<td>" . $row['jenis'] . "</td>
						<td>" . $row['no_tiket'] . "</td>
						<td>" . $row['id_patching2'] . "</td>
						<td>" . $row['divisi'] . "</td>
						<td>" . $row['status'] . "</td>
						<td>" . $row['uker'] . "</td>
						<td>" . $row['maker'] . "</td>
					</tr>
				</tbody>
			</table>
		";
	}
?>