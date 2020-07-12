<?php
	header("Content-Type: application/force-download");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 2010 05:00:00 GMT"); 
	header("content-disposition: attachment;filename=export_excel_".date('d-m-Y').".xls");
 
	echo 
	" 
		<table>
			<tr>
				<td>&nbsp;</td>
				<td style='border-style:none;font-weight: bold;'>Tanggal Awal</td>
				<td>" . $tgl_awal . "</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style='border-style:none;font-weight: bold;'>Tanggal Akhir</td>
				<td>" . $tgl_akhir . "</td>
			</tr>
		</table>
		<table align='center' border='1'>
			<tr>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>No</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Nama User</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Bagian</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Types</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Nama Insiden</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Aplikasi</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Server</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Serial Number</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Time Start</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Time End</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Intervals</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Log Start</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Log End</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Kategori</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Fact</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Impact</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Lingkup Impact</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Insiden Cause</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Jenis Problem</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Root Cause</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Action</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Last Status</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Engineer</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Prpb Manajemen</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Follow Up</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Status</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>IP</td>
			</tr>
		</table> 
	";

	$no = 1;
	foreach ($isiexcel as $row) 
	{
		$time_start = date('d M Y', strtotime($row['time_start']));
		$time_end   = date('d M Y', strtotime($row['time_end']));
		
		echo 
		"		
			<table align='center' border='1'>
				<tbody>
					<tr>
						<td>" . $no++ . "</td>
						<td>" . $row['nama_user'] . "</td>
						<td>" . $row['bagian'] . "</td>
						<td>" . $row['types'] . "</td>
						<td>" . $row['nama_insiden'] . "</td>
						<td>" . $row['aplikasi'] . "</td>
						<td>" . $row['server'] . "</td>
						<td>" . $row['SerialNumber'] . "</td>
						<td>" . $time_start . "</td>
						<td>" . $time_end . "</td>
						<td>" . $row['intervals'] . "</td>
						<td>" . $row['log_start'] . "</td>
						<td>" . $row['log_end'] . "</td>
						<td>" . $row['kategori'] . "</td>
						<td>" . $row['fact'] . "</td>
						<td>" . $row['impact'] . "</td>
						<td>" . $row['lingkup_impact'] . "</td>
						<td>" . $row['insiden_cause'] . "</td>
						<td>" . $row['jenis_problem'] . "</td>
						<td>" . $row['root_cause'] . "</td>
						<td>" . $row['action'] . "</td>
						<td>" . $row['last_status'] . "</td>
						<td>" . $row['engineer'] . "</td>
						<td>" . $row['prob_manajemen'] . "</td>
						<td>" . $row['follow_up'] . "</td>
						<td>" . $row['status'] . "</td>
						<td>" . $row['ip'] . "</td>
					</tr>
				</tbody>
			</table>
		";
	}
?>