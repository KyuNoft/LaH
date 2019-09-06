<?php
class m_mps extends ci_model{

	public function Get(){
		$this->db->select('a.kd_pesanan, a.tanggal, a.total, a.status, b.nama_pelanggan, sum(c.jumlah) as jumlah');
		$this->db->from('pesanan a');
		$this->db->join('pelanggan b', 'a.id_pelanggan = b.id_pelanggan');
		$this->db->join('detail_pesanan c', 'a.kd_pesanan = c.kd_pesanan');
		$this->db->where('tanggal !=', '0000-00-00');
		$this->db->group_by('a.kd_pesanan');
		return $this->db->get()->result_array();
	}

	public function GetProduk($kd_pesanan){
		$this->db->select('kd_pesanan, kd_produk');
		$this->db->from('detail_pesanan');
		$this->db->where('kd_pesanan', $kd_pesanan);
		return $this->db->get();
	}

	public function Buat($kd_pesanan){
		$produk    = $this->m_mps->GetProduk($kd_pesanan);
		$jmlproduk = $produk->num_rows(); //Jumlah Jenis Produk yang akan di jadwalkan//
		for($i=0; $i < $jmlproduk; $i++){ //Berapa Jenis Produk yang akan di masukkan datanya//
			$kd_produk = $produk->row_array($i)['kd_produk']; // Kode Produk Dapat//
			$query = "SELECT a.jumlah, MAX(b.waktu) as waktumaks, a.jumlah*MAX(b.waktu) as kebutuhan
				  	  FROM detail_pesanan as a
				  	  JOIN jam_mesin as b
				  	  ON a.kd_produk 	= b.kd_produk
				  	  WHERE a.kd_produk = '$kd_produk'
				  	  AND a.kd_pesanan 	= '$kd_pesanan'";
		    $select    = $this->db->query($query)->row();
		    $jumlah    = $select->jumlah; // Jumlah di Detail Pesanan Dapat//
		    $waktumaks = $select->waktumaks; //Mesin dengan Waktu Terlama Dapat//
		    $kebutuhan = $select->kebutuhan; //Kebutuhan Waktu untuk Produk ini Dapat//

		    $this->db->order_by('kd_pesanan', 'DESC');
		    $this->db->limit(1);
		    $query2 = $this->db->get('mps');
		    if($query2->num_rows() == 0){
		    	$tglterakhir = date('Y-m-d'); //Jika Belum ada Tanggal di Tabel (Hanya di Awal saja)//
		    	$sisawaktu   = 0; //Jika Belum ada Sisawaktu di Tabel (Hanya di Awal saja)//
		    }else{
		    	$tglterakhir = $query2->row()->tanggal; //Tanggal Paling Bawah di Tabel//
		    	$sisawaktu   = $query2->row()->sisawaktu; //Sisawaktu Paling Bawah di Tabel//
		    }

		    $last  = new DateTime($tglterakhir); //Tanggal Produksi Terakhir//
            $new   = new DateTime(date('Y-m-d')); //Tanggal Hari ini//
            if($last <= $new){
            	$tglterakhir = date('Y-m-d'); //Jika Hari Terakhir Produksi Kurang dari Hari Ini//
		    	$sisawaktu   = 0;
            }else{
            	$tglterakhir = $tglterakhir; //Tanggal Paling Bawah di Tabel//
		    	$sisawaktu   = $sisawaktu; //Sisawaktu Paling Bawah di Tabel//
            }

		    //Memasukkan Data ke Tabel MPS//
		    $sisajumlah = $jumlah;
		    $hari       = 0;
		    if($sisawaktu < $waktumaks){
		    	$kapasitas = 480 / $waktumaks;// Kapasitas Jumlah Produk yang bisa di produksi perhari berdasarkan jenis produknya, 480 menit adalah jam kerja perhari//
		    	$hari      = 1;
		    	$sisawaktu = 480;
		    }else{
		    	$kapasitas = $sisawaktu / $waktumaks;// Kapasitas Jumlah Produk yang bisa di produksi perhari berdasarkan jenis produknya, $sisawaktu adalah waktu sisa yang tersedia di hari itu//
		    	$reset     = 0;
		    }
		    while(ceil($sisajumlah) != 0){
		    	if(ceil($sisajumlah) <= floor($kapasitas)){
		    		$tglmasuk = date('Y-m-d', strtotime($tglterakhir.' + '.$hari.'day'));
		    		if(date_format(date_create($tglmasuk), "D") == "Sun"){
		    			$hari 	  = $hari + 1;
		    			$tglmasuk = date('Y-m-d', strtotime($tglterakhir.' + '.$hari.'day'));
		    		}else{
		    			$tglmasuk = $tglmasuk;
		    		}
		    		$insert = array(
		    			'kd_pesanan' => $kd_pesanan,
		    			'kd_produk'  => $kd_produk,
		    			'tanggal'    => $tglmasuk,
		    			'jumlah'	 => ceil($sisajumlah),
		    			'sisawaktu'  => $sisawaktu - ceil($kebutuhan)
		    		);
		    		$this->db->insert('mps', $insert);
		    		$sisajumlah = $sisajumlah - $sisajumlah;
		    	}else{
		    		$tglmasuk = date('Y-m-d', strtotime($tglterakhir.' + '.$hari.'day'));
		    		if(date_format(date_create($tglmasuk), "D") == "Sun"){
		    			$hari 	  = $hari + 1;
		    			$tglmasuk = date('Y-m-d', strtotime($tglterakhir.' + '.$hari.'day'));
		    		}else{
		    			$tglmasuk = $tglmasuk;
		    		}
		    		$insert = array(
		    			'kd_pesanan' => $kd_pesanan,
		    			'kd_produk'  => $kd_produk,
		    			'tanggal'    => $tglmasuk,
		    			'jumlah'	 => floor($kapasitas),
		    			'sisawaktu'  => 0
		    		);
		    		$this->db->insert('mps', $insert);
		    		$sisajumlah = ceil($sisajumlah) - floor($kapasitas);
		    		$kebutuhan  = ceil($sisajumlah) * $waktumaks;
		    		if(isset($reset)){
		    			$kapasitas = 480 / $waktumaks; // Kapasitas di reset mengikuti kapasitas aslinya//
		    			$sisawaktu = 480; //Sisawaktu di reset ke jam kerja awal yang tersedia//
		    		}
		    		$hari++;
		    	}
		    }
		}
		$this->db->set('status', 'TJD');
		$this->db->where('kd_pesanan', $kd_pesanan);
		$this->db->update('pesanan');
	}

	public function SimpanBB($kd_pesanan){
		$produk     = $this->m_mps->GetProduk($kd_pesanan);
		$jmlproduk  = $produk->num_rows(); //Jumlah Jenis Produk yang akan di jadwalkan//
		for ($i=0; $i < $jmlproduk; $i++){ //Berapa Jenis Produk yang akan di masukkan datanya//
			$kd_produk = $produk->row_array($i)['kd_produk']; // Kode Produk Dapat//
			$query = "SELECT a.kd_bahan_baku, a.harga
					  FROM bahan_baku as a
					  JOIN bom as b
					  ON a.kd_bahan_baku = b.kd_bahan_baku
					  JOIN produk as c
					  ON b.kd_produk = c.kd_produk
					  WHERE c.kd_produk = '$kd_produk'";
		    $bahan = $this->db->query($query);
		    $jmlbahan = $bahan->num_rows();
		    for ($y=0; $y < $jmlbahan; $y++) {
		    	$kd_bahan_baku = $bahan->row_array($y)['kd_bahan_baku'];
		    	$harga 		   = $bahan->row_array($y)['harga'];
		    	$insert = array(
		    		'kd_pesanan' 	=> $kd_pesanan,
		    		'kd_produk'  	=> $kd_produk,
		    		'kd_bahan_baku' => $kd_bahan_baku,
		    		'harga'			=> $harga
		    	);
		    	$this->db->insert('kebutuhan_bb', $insert);
		    }
		}
	}

	public function SimpanAKT($kd_pesanan){
		$produk     = $this->m_mps->GetProduk($kd_pesanan);
		$jmlproduk  = $produk->num_rows(); //Jumlah Jenis Produk yang akan di jadwalkan//
		for ($i=0; $i < $jmlproduk; $i++){ //Berapa Jenis Produk yang akan di masukkan datanya//
			$kd_produk = $produk->row_array($i)['kd_produk']; // Kode Produk Dapat//
			$query = "SELECT a.kd_aktivitas, a.tarif
					  FROM aktivitas as a
					  JOIN routing as b
					  ON a.kd_aktivitas = b.kd_aktivitas
					  JOIN produk as c
					  ON b.kd_produk = c.kd_produk
					  WHERE c.kd_produk = '$kd_produk'";
		    $aktivitas 	  = $this->db->query($query);
		    $jmlaktivitas = $aktivitas->num_rows();
		    for ($y=0; $y < $jmlaktivitas; $y++) {
		    	$kd_aktivitas = $aktivitas->row_array($y)['kd_aktivitas'];
		    	$tarif 		  = $aktivitas->row_array($y)['tarif'];
		    	$insert = array(
		    		'kd_pesanan'   => $kd_pesanan,
		    		'kd_produk'    => $kd_produk,
		    		'kd_aktivitas' => $kd_aktivitas,
		    		'tarif'		   => $tarif
		    	);
		    	$this->db->insert('kebutuhan_akt', $insert);
		    }
		}
	}

	public function SimpanM($kd_pesanan){
		$produk     = $this->m_mps->GetProduk($kd_pesanan);
		$jmlproduk  = $produk->num_rows(); //Jumlah Jenis Produk yang akan di jadwalkan//
		for ($i=0; $i < $jmlproduk; $i++){ //Berapa Jenis Produk yang akan di masukkan datanya//
			$kd_produk = $produk->row_array($i)['kd_produk']; // Kode Produk Dapat//
			$query = "SELECT a.kd_mesin, a.tarif
					  FROM mesin as a
					  JOIN jam_mesin as b
					  ON a.kd_mesin = b.kd_mesin
					  JOIN produk as c
					  ON b.kd_produk = c.kd_produk
					  WHERE c.kd_produk = '$kd_produk'";
		    $mesin 	  = $this->db->query($query);
		    $jmlmesin = $mesin->num_rows();
		    for ($y=0; $y < $jmlmesin; $y++) {
		    	$kd_mesin = $mesin->row_array($y)['kd_mesin'];
		    	$tarif 	  = $mesin->row_array($y)['tarif'];
		    	$insert = array(
		    		'kd_pesanan' => $kd_pesanan,
		    		'kd_produk'  => $kd_produk,
		    		'kd_mesin'   => $kd_mesin,
		    		'tarif'		 => $tarif
		    	);
		    	$this->db->insert('kebutuhan_m', $insert);
		    }
		}
	}

	public function GetJadwal(){
		$this->db->select('tanggal, sum(jumlah) as jumlah');
		$this->db->from('mps');
		$this->db->where('MONTH(tanggal)', $_POST['bulan']);
		$this->db->where('YEAR(tanggal)', $_POST['tahun']);
		$this->db->group_by('tanggal');
		return $this->db->get()->result_array();
	}

	public function GetDetailJadwal(){
    	$this->db->select('a.tanggal, b.nama_produk, SUM(a.jumlah) as jumlah');
    	$this->db->from('mps a');
    	$this->db->join('produk b', 'a.kd_produk = b.kd_produk');
		$this->db->where('a.tanggal', $_POST['tanggal']);
		$this->db->group_by('a.tanggal, b.nama_produk');
		return $this->db->get()->result_array();
	}
}