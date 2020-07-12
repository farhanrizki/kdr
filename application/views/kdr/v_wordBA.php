<?php
	$PHPWord = $word;
    //$this->load->library('word'); 
    $section = $PHPWord->createSection(array('orientation' => 'landscape'));

    //Setting Header di Word
    $PHPWord->addFontStyle('Header1', array('bold'=>true, 'size'=>18, 'name'=>'Times New Roman'));
    $PHPWord->addFontStyle('Header2', array('size'=>11, 'name'=>'Univers'));
    $PHPWord->addFontStyle('Header3', array('size'=>8, 'name'=>'Arial'));
    //Setting Header Table Style
    $PHPWord->addFontStyle('HeaderF', array('bold'=>true, 'size'=>11, 'name'=>'Courier New'));
    $PHPWord->addParagraphStyle('HeaderP', array('align'=>'center','spaceAfter'=>0));
    //Setting Isi Table Style
    $PHPWord->addFontStyle('IsiF', array('size'=>11, 'name'=>'Courier New'));
    $PHPWord->addParagraphStyle('IsiP', array('align'=>'center','spaceAfter'=>0));


    //Isi
    $section->addTextBreak(1);
    $section->addText('BERITA ACARA PATCHING DATA', array('size'=>13, 'name'=>'Arial Narrow', 'bold'=>true, 'underline'=>'single'), array('align'=>'center','spaceAfter' => 0));
    $section->addText('No. B.         -OPT/KDR/02/2019', array('size'=>12, 'name'=>'Arial Narrow', 'bold'=>true), array('align'=>'center','spaceAfter' => 0));

    foreach($isiword as $row)
    {
        $tgl_patching[] = date("d F",strtotime($row['tgl_patching']));
        $tahun_patching = date("Y",strtotime($row['tgl_patching']));
    }
    //Get Min and Max Date from Array
    usort($tgl_patching, function($a, $b) {
        $dateTimestamp1 = strtotime($a);
        $dateTimestamp2 = strtotime($b);
        return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
    });
    $tgl_min = $tgl_patching[0];
    $tgl_max = $tgl_patching[count($tgl_patching) - 1];
    $section->addText('Pada tanggal '.$tgl_min.' sd '.$tgl_max.' '.$tahun_patching.' Bagian KDR (Assurance Kualitas Data & Risiko TI) Divisi OPT (Operasional Teknologi Informasi) BRI bertempat di IT Building lantai 6 telah melaksanakan patching data sesuai dengan permintaan pada Aplikasi Bristars Menu Lain-lain - E-Form Patching Bagian Helpdesk & Kualitas Data Nasabah '.$nama_divisi.' sbb :', array('size'=>12, 'name'=>'Arial Narrow'), array('align'=>'both','spaceAfter' => 0));
    

    //Table
    $section->addTextBreak(1);
	$styleCell = array('borderTopSize'=>1 ,'borderTopColor'=>'black','borderLeftSize'=>1,
				 'borderLeftColor'=>'black','borderRightSize'=>1,'borderRightColor'=>'black',
				 'borderBottomSize'=>1,'borderBottomColor'=>'black');
    $table     = $section->addTable('myOwnTableStyle',array('borderSize'=>1, 'borderColor'=>'999999'));
	$table->addRow(-0.8, array('exactHeight' => 1));
	$table->addCell(500,$styleCell)->addText('NO','HeaderF', 'HeaderP');
	$table->addCell(3000,$styleCell)->addText('NO. ID PATCHING','HeaderF', 'HeaderP');
	$table->addCell(5500,$styleCell)->addText('PERIHAL','HeaderF', 'HeaderP');
	$table->addCell(2500,$styleCell)->addText('TANGGAL PATCHING','HeaderF', 'HeaderP');
	$table->addCell(3500,$styleCell)->addText('PIC','HeaderF', 'HeaderP');
	$no=1;
	foreach($isiword as $row)
	{
        $tgl_patching = date("d F Y",strtotime($row['tgl_patching']));
		$table->addRow(-0.8, array('exactHeight' => 1));
		$table->addCell(500,$styleCell)->addText($no++,'IsiF', 'IsiP');
		$table->addCell(3000,$styleCell)->addText('ID PATCHING '.$row['id_patching2'],'IsiF', 'IsiP');
		$table->addCell(5500,$styleCell)->addText(strtoupper($row['judul_patching']),'IsiF', 'IsiP');
		$table->addCell(2500,$styleCell)->addText($tgl_patching,'IsiF', 'IsiP');
		$table->addCell(3500,$styleCell)->addText($row['maker'],'IsiF', 'IsiP');
	}


    $section->addTextBreak(2);
    $section->addText('Hasil patching data untuk masing-masing ID Patching dapat dilihat pada Aplikasi Bristars Menu Lain-lain - Eform Patching.', array('size'=>12, 'name'=>'Arial Narrow'), array('align'=>'left','spaceAfter' => 0));
    $section->addText('Demikian berita acara ini dibuat sesuai permintaan yang dikerjakan pada E-Form Patching dan disampaikan kepada : ', array('size'=>12, 'name'=>'Arial Narrow'), array('align'=>'left','spaceAfter' => 0));
    $section->addText('1. '.$nama_divisi, array('size'=>12, 'name'=>'Arial Narrow'), array('spaceAfter' => 0));
    $section->addText('2. Arsip (dokumen asli)', array('size'=>12, 'name'=>'Arial Narrow'), array('spaceAfter' => 0));

    $section->addTextBreak(0.5);
    $month = date('F Y');
    $section->addText('Jakarta,         '.$month, array('size'=>12, 'name'=>'Arial Narrow'), array('align'=>'right'));


    //Tabel 2
    $table   = $section->addTable('myOwnTableStyle',array('borderSize'=>1, 'borderColor'=>'999999'));
    $table->addRow(900, array("exactHeight" => true));
    $cell    = $table->addCell(1000,$styleCell);
    $textrun = $cell->createTextRun();
    $textrun->addText(' ');

    $judul1 = array('bold'=>true,'size'=>10.5,'name'=>'Arial Narrow');
    $judul2 = array('size'=>10.5,'name'=>'Arial Narrow');

    $cell    = $table->addCell(2000,$styleCell);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('Pemohon :', $judul1);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('( Kabag )', $judul2);    
    $cell    = $table->addCell(5000,$styleCell);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('Dilaksanakan oleh :', $judul1);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('( Programmer / SAD /  KDR )', $judul2);
    $cell    = $table->addCell(2000,$styleCell);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('Diverifikasi oleh :', $judul1);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('( Kabag KDR )', $judul2);
    $cell    = $table->addCell(4000,$styleCell);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('Disetujui oleh :', $judul1);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('( Kadiv/Wakadiv )', $judul2);

    $table->addRow(1700, array("exactHeight" => true));
    $cell = $table->addCell(1000,$styleCell);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('Signature',$judul1);
    $cell = $table->addCell(2000,$styleCell);
    $cell = $table->addCell(5000,$styleCell);
    $cell = $table->addCell(2000,$styleCell);
    $cell = $table->addCell(4000,$styleCell);

    $table->addRow(300, array("exactHeight" => true));
    $cell = $table->addCell(1000,$styleCell);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('Name',$judul1);
    $cell = $table->addCell(2000,$styleCell);
    $cell = $table->addCell(5000,$styleCell);
    $cell = $table->addCell(2000,$styleCell);
    $cell = $table->addCell(4000,$styleCell);

    $table->addRow(300, array("exactHeight" => true));
    $cell = $table->addCell(1000,$styleCell);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('Title',$judul1);
    $cell = $table->addCell(2000,$styleCell);
    $cell = $table->addCell(5000,$styleCell);
    $cell = $table->addCell(2000,$styleCell);
    $cell = $table->addCell(4000,$styleCell);

    $table->addRow(300, array("exactHeight" => true));
    $cell = $table->addCell(1000,$styleCell);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('Date',$judul1);
    $cell = $table->addCell(2000,$styleCell);
    $cell = $table->addCell(5000,$styleCell);
    $cell = $table->addCell(2000,$styleCell);
    $cell = $table->addCell(4000,$styleCell);


    //Header
    $header  = $section->createHeader(PHPWord_Section_Header::FIRST);
    $header->addText('Model 54',array('size'=>8, 'name'=>'Times New Roman'),array('align'=>'right','spaceAfter' => 0));
    $table   = $header->addTable();
    $table->addRow();
    $table->addCell(2500)->addImage('./assets/images/logo-bri.png');
    $cell    = $table->addCell(8500);
    $textrun = $cell->createTextRun(array('align'=>'center'));
    $textrun->addText('         PT. BANK RAKYAT INDONESIA (PERSERO)  ','Header1');
    $textrun->addText('KANTOR PUSAT','Header2');
    $textrun = $cell->createTextRun(array('align'=>'center','spaceAfter' => 0));
    $textrun->addText('Jalan Jenderal Sudirman No. 44-46 Tromol Pos 1094 / 1000 Jakarta 10210','Header3');
    $textrun = $cell->createTextRun(array('align'=>'center','spaceAfter' => 0));
    $textrun->addText('JTelepon : 5751502, 5751504, 5751506, 5751507,  5751508, 5751510','Header3');
    $textrun = $cell->createTextRun(array('align'=>'center','spaceAfter' => 0));
    $textrun->addText('Facsimile : 2500126,  Kawat : KANPUSBRI','Header3');
    $textrun = $cell->createTextRun(array('align'=>'center','spaceAfter' => 0));
    $textrun->addText('Telex : 65293, 65301, 65456, 65461','Header3');
    $textrun = $cell->createTextRun(array('align'=>'center','spaceAfter' => 0));
    $textrun->addText('Website : www.bri.co.id','Header3');
    
    $footer  = $section->createFooter();
    $footer->addText('Integrity, Professionalism, Trust, Innovation, Customer Centric',array('size'=>11, 'name'=>'Times New Roman','italic'=>true),array('align'=>'center','spaceAfter' => 0));

    /*$section->getSettings()->setEvenAndOddHeaders(true);
    $a = $section->getSettings();
    $a->setEvenAndOddHeaders(true);

    $header = $section->createHeader();
    $header->firstPage();
    $header->addText('A');
    
    $headerEven = $section->createHeader();
    $headerEven->addText('B');*/
    
  
    /* cara 1
    $filename='BA.doc';
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0'); //no cache
    $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
    $objWriter->save('php://output'); */

    //Cara 2 
    $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
    $filename = 'MyFile.docx';
    $objWriter->save($filename);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$filename);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    flush();
    readfile($filename);
    unlink($filename); // deletes the temporary file
    exit;

    /* Cara 3 
    $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
    $filePath = 'BA.docx';
    $objWriter->save($filePath);
    header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document;');
    header("Content-Disposition: attachment; filename=".$filePath);
    readfile($filePath);
    unlink($filePath);*/

?>