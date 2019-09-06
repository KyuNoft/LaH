<?php

	//fungsi untuk format rupiah
	function format_rp($param){
		if(!is_numeric($param))return NULL;
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		$angka = "Rp. ". number_format($param, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan).",-";
		return $angka;
	}
	
?>