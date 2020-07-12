<?php
class Notifaudit {

	function updateNotif(){
		$CI =& get_instance();
    	$CI->load->model('monica/m_audit_report');
        $untuk_notif            = $CI->m_audit_report->untuk_notif();
        $pemantauan_internal    = 0;
        $tidak_memadai_internal = 0;
        $id_tidakmemadai        = array();
        $id_dalampemantauan     = array();
        foreach ($untuk_notif as $row){
            $pemantauan_internal    += $row['total_pemantauan_1'];
            $pemantauan_internal    += $row['total_pemantauan_2'];
            $tidak_memadai_internal += $row['total_tidak_memadai_1'];
            $tidak_memadai_internal += $row['total_tidak_memadai_2'];
            $tidak_memadai_internal += $row['total_tidak_memadai_3'];

            if($row['total_tidak_memadai_1'] == '1' || $row['total_tidak_memadai_2'] == '1' || $row['total_tidak_memadai_3'] == '1'){
                $id_tidakmemadai[] = $row['id_audit'];
            } 

            if($row['total_pemantauan_1'] == '1' || $row['total_pemantauan_2'] == '1'){
                $id_dalampemantauan[] = $row['id_audit'];
            } 
        }
        $dalampemantauan = $pemantauan_internal;
        $tidakmemadai    = $tidak_memadai_internal;
        $CI->m_audit_report->notiftidakmemadai($tidakmemadai);
        $CI->m_audit_report->notifdalampemantauan($dalampemantauan);
        return array(
			'id_tidakmemadai'    => $id_tidakmemadai,
			'id_dalampemantauan' => $id_dalampemantauan
		);
    }

    function getNotif(){
    	$CI =& get_instance();
    	$CI->load->model('monica/m_audit_report');
        $get_notif = $CI->m_audit_report->get_notif();
        return $get_notif;
    }
}
