<?php
	//fungsi untuk Generate Jurnal
	function jurnal($no_akun, $tanggal, $posisi, $nominal){
		$ci =& get_instance(); // Untuk memanggil akses CI seperti $this di contoller
		$jurnal = array(
			'no_akun' => $no_akun,
			'tanggal' => $tanggal,
			'posisi'  => $posisi,
			'nominal' => $nominal
		);
		$ci->db->insert('jurnal', $jurnal);
	}
?>