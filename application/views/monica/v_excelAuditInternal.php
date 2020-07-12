<style>
	.judul{
		border-style:none;font-weight:bold;
	}
	.header-table{
		text-align:center;background:#C0C0C0;font-weight:bold;
	}
	.ket-status{
		text-align:center;font-weight:bold;background:aqua;
	}
	.note{
		text-align:center;font-weight:bold;background:green;
	}
	.isi-status{
		text-align:center;
	}
</style>

<?php
	header("Content-Type: application/force-download");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 2010 05:00:00 GMT"); 
	header("content-disposition: attachment;filename=Audit_Internal".".xls");
 
	echo 
	" 
		<table>
			<tr class='judul'>
				<td colspan='3'>".$judul."</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<br>
		<table align='center' border='1'>
			<tr class='header-table'>
				<td>No.</td>
				<td>Tahun</td>
				<td>SHA Code</td>
				<td>Tema Audit</td>
				<td>Nama Divisi</td>
				<td>Data Temuan</td>
				<td>Kategori Temuan</td>
				<td>Rekomendasi AIN</td>
				<td>Status Monitoring</td>
				<td>RPM OPT</td>
				<td>Tanggapan SKAI</td>
				<td>Deadline</td>
				<td>Risk Issue</td>
				<td>Tipe Temuan</td>
				<td>Proses Major</td>
				<td>Sub Proses Major</td>
			</tr>
		</table> 
	";

	$no = 1;
	foreach ($isiexcel as $row) 
	{	
		$tgl_deadline = date('d M Y', strtotime($row['deadline']));
		echo 
		"		
			<table align='center' border='1'>
				<tbody>
					<tr>
						<td>".$no++."</td>
						<td>".$row['tahun']."</td>
						<td>".$row['sha']."</td>
						<td>".$row['tema_audit']."</td>
						<td>".$row['nama_divisi']."</td>
						<td>".$row['data_temuan']."</td>
						<td>".$row['nama_kategori']."</td>
						<td>".$row['rekomendasi_1']." ".$row['rekomendasi_2']." ".$row['rekomendasi_3']." ".$row['rekomendasi_4']." ".$row['rekomendasi_5']." ".$row['rekomendasi_6']." ".$row['rekomendasi_7']." " .$row['rekomendasi_8']." ".$row['rekomendasi_9']." ".$row['rekomendasi_10']."</td>
						<td>".$row['status_monitoring_1']." ".$row['status_monitoring_2']." ".$row['status_monitoring_3']." ".$row['status_monitoring_4']." ".$row['status_monitoring_5']." ".$row['status_monitoring_6']." ".$row['status_monitoring_7']." ".$row['status_monitoring_8']." ".$row['status_monitoring_9']." ".$row['status_monitoring_10']."</td>
						<td>".$row['rpm_opt']."</td>
						<td>".$row['tanggapan_skai']."</td>
						<td>".$tgl_deadline."</td>
						<td>".$row['risk_issue']."</td>
						<td>".$row['tipe_temuan']."</td>
						<td>".$row['proses_major']."</td>
						<td>".$row['subproses_major']."</td>
					</tr>
				</tbody>
			</table>
		";
	}

	echo 
	"
		<br>
		<br>
		<table border='1'> 
			<tr class='note'>
				<td colspan='2'>NOTE</td>
			</tr>
			<tr class='ket-status'>
				<td>Status Monitoring</td>
				<td>Keterangan</td>
			</tr>
			<tr class='isi-status'>
				<td>M</td>
				<td>Memadai</td>
			</tr>
			<tr class='isi-status'>
				<td>P</td>
				<td>Dalam Pemantauan</td>
			</tr>
			<tr class='isi-status'>
				<td>T</td>
				<td>Tidak Memadai</td>
			</tr>
		</table>
	";
?>