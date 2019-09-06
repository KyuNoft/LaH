<?php
	//fungsi untuk Merubah Format Bulan
	function bulan($b){
		if(!is_numeric($b)) return NULL;
		if($b==1) $bulan = 'Januari';
		if($b==2) $bulan = 'Februari';
		if($b==3) $bulan = 'Maret';
		if($b==4) $bulan = 'April';
		if($b==5) $bulan = 'Mei';
		if($b==6) $bulan = 'Juni';
		if($b==7) $bulan = 'Juli';
		if($b==8) $bulan = 'Agustus';
		if($b==9) $bulan = 'September';
		if($b==10) $bulan = 'Oktober';
		if($b==11) $bulan = 'November';
		if($b==12) $bulan = 'Desember';
		return $bulan;
	}
	
?>