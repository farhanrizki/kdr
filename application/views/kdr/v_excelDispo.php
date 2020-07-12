<?php
	header("Content-Type: application/force-download");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 2010 05:00:00 GMT"); 
	header("content-disposition: attachment;filename=excel_dispo_".date('d-m-Y').".xls");
 
	echo 
	" 
		<table>
			<tr>
				<td>&nbsp;</td>
				<td style='border-style:none;font-weight: bold;'>Dispo Dio</td>
			</tr>
			<tr>

			</tr>
		</table>
		<table align='center' border='1'>
			<tr>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>No.</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Tgl Dispo</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Nomor Surat</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Agenda</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Keterangan</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Keterangan TL</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Keterangan Done</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>PIC</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Kategori</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Sub Kategori</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Tgl TL</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Tgl Done</td>
				<td style='text-align:center;background:#C0C0C0;font-weight:bold;'>Tgl Deadline</td>
			</tr>
		</table> 
	";

	$no    = 1;
	foreach ($isiexcel as $row) 
	{	
		$tgl_dispo = date('d M Y', strtotime($row['tgl_dispo']));
		$tgl_tl    = date('d M Y', strtotime($row['tgl_tl']));
		$tgl_done  = date('d M Y', strtotime($row['tgl_done']));
		$due_date  = date('d M Y', strtotime($row['due_date']));
		echo 
		"		
			<table align='center' border='1'>
				<tbody>
					<tr>
						<td>" . $no++ . "</td>
						<td>" . $tgl_dispo . "</td>
						<td>" . $row['no_surat'] . "</td>
						<td>" . $row['agenda'] . "</td>
						<td>" . $row['keterangan'] . "</td>
						<td>" . $row['keterangan_tl'] . "</td>
						<td>" . $row['keterangan_done'] . "</td>
						<td>" . $row['pic'] . "</td>
						<td>" . $row['kategori'] . "</td>
						<td>" . $row['sub_kategori'] . "</td>
						<td>" . $tgl_tl . "</td>
						<td>" . $tgl_done . "</td>
						<td>" . $due_date . "</td>
					</tr>
				</tbody>
			</table>
		";
	}
?>