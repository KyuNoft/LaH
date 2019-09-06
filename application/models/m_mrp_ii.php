<?php
class m_mrp_ii extends ci_model{

	public function GetTanggal(){
		if(isset($_POST['bulan'], $_POST['tahun'])){
			$b = $_POST['bulan'];
			$t = $_POST['tahun'];
			$sql = "SELECT tanggal
				FROM mps
				WHERE tanggal LIKE '$t-$b-__'
				GROUP BY tanggal";
			return $this->db->query($sql);
		}else{
			$sql = "SELECT tanggal
				FROM mps
				GROUP BY tanggal";
			return $this->db->query($sql);
		}
	}

	public function GetJumlah(){
		if(isset($_POST['bulan'], $_POST['tahun'])){
			$b = $_POST['bulan'];
			$t = $_POST['tahun'];
			$sql = "SELECT SUM(jumlah) jumlah
				FROM mps
				WHERE tanggal LIKE '$t-$b-__'
				GROUP BY tanggal";
			return $this->db->query($sql)->result_array();
		}else{
			$sql = "SELECT SUM(jumlah) jumlah
					FROM mps
					GROUP BY tanggal";
			return $this->db->query($sql)->result_array();
		}
	}

	public function GetTotalBiaya(){
		if(isset($_POST['bulan'], $_POST['tahun'])){
			$b = $_POST['bulan'];
			$t = $_POST['tahun'];
			$sql = "SELECT bbb.tanggal, (biaya_bb+biaya_akt+biaya_op) total
					FROM (SELECT tanggal, SUM(biaya) as biaya_bb
					FROM (SELECT a.tanggal, ((a.jumlah*b.kuantitas)*c.harga) as biaya
					FROM mps a JOIN bom b
					ON a.kd_produk = b.kd_produk
					JOIN kebutuhan_bb c
					ON b.kd_bahan_baku = c.kd_bahan_baku
					GROUP BY a.tanggal, a.kd_pesanan, a.kd_produk, b.kd_bahan_baku) bb
					GROUP BY tanggal) bbb
					JOIN (
					SELECT tanggal, SUM(biaya) biaya_akt
					FROM(SELECT a.tanggal, ((a.jumlah*b.waktu)*c.tarif) as biaya
					FROM mps a JOIN routing b
					ON a.kd_produk = b.kd_produk
					JOIN kebutuhan_akt c
					ON b.kd_aktivitas = c.kd_aktivitas
					GROUP BY a.tanggal, a.kd_pesanan, a.kd_produk, b.kd_aktivitas) b
					GROUP BY tanggal) btk
					ON bbb.tanggal = btk.tanggal
					JOIN (SELECT tanggal, SUM(biaya) biaya_op
					FROM(SELECT a.tanggal, ((a.jumlah*b.waktu)*c.tarif) as biaya
					FROM mps a JOIN jam_mesin b
					ON a.kd_produk = b.kd_produk
					JOIN kebutuhan_m c
					ON b.kd_mesin = c.kd_mesin
					GROUP BY a.tanggal, a.kd_pesanan, a.kd_produk, b.kd_mesin) c
					GROUP BY tanggal) bop
					ON bbb.tanggal = bop.tanggal
					WHERE bbb.tanggal LIKE '$t-$b-__'";
			return $this->db->query($sql)->result_array();
		}else{
			$sql = "SELECT bbb.tanggal, (biaya_bb+biaya_akt+biaya_op) total
					FROM (SELECT tanggal, SUM(biaya) as biaya_bb
					FROM (SELECT a.tanggal, ((a.jumlah*b.kuantitas)*c.harga) as biaya
					FROM mps a JOIN bom b
					ON a.kd_produk = b.kd_produk
					JOIN kebutuhan_bb c
					ON b.kd_bahan_baku = c.kd_bahan_baku
					GROUP BY a.tanggal, a.kd_produk, b.kd_bahan_baku) bb
					GROUP BY tanggal) bbb
					JOIN (
					SELECT tanggal, SUM(biaya) biaya_akt
					FROM(SELECT a.tanggal, ((a.jumlah*b.waktu)*c.tarif) as biaya
					FROM mps a JOIN routing b
					ON a.kd_produk = b.kd_produk
					JOIN kebutuhan_akt c
					ON b.kd_aktivitas = c.kd_aktivitas
					GROUP BY a.tanggal, a.kd_produk, b.kd_aktivitas) b
					GROUP BY tanggal) btk
					ON bbb.tanggal = btk.tanggal
					JOIN (SELECT tanggal, SUM(biaya) biaya_op
					FROM(SELECT a.tanggal, ((a.jumlah*b.waktu)*c.tarif) as biaya
					FROM mps a JOIN jam_mesin b
					ON a.kd_produk = b.kd_produk
					JOIN kebutuhan_m c
					ON b.kd_mesin = c.kd_mesin
					GROUP BY a.tanggal, a.kd_produk, b.kd_mesin) c
					GROUP BY tanggal) bop
					ON bbb.tanggal = bop.tanggal";
			return $this->db->query($sql)->result_array();
		}
	}

	public function Get(){
		$query = $this->db->order_by('kd_mrp_ii', 'ASC')->get('mrp_ii');
		return $query->result_array();
	}

	public function GetBBB($tanggal){
		$this->db->select('a.tanggal, a.jumlah, b.nama_produk, c.kuantitas, d.nama_bahan_baku, d.satuan, e.harga, (a.jumlah*c.kuantitas) as jumlah_terpakai, ((a.jumlah*c.kuantitas)*e.harga) as biaya');
		$this->db->from('mps a');
		$this->db->join('produk b', 'a.kd_produk = b.kd_produk');
		$this->db->join('bom c', 'b.kd_produk = c.kd_produk');
		$this->db->join('bahan_baku d', 'c.kd_bahan_baku = d.kd_bahan_baku');
		$this->db->join('kebutuhan_bb as e', 'd.kd_bahan_baku = e.kd_bahan_baku');
		$this->db->where('a.tanggal', $tanggal);
		$this->db->where('d.jenis_bahan_baku', 'Utama');
		$this->db->group_by('a.kd_pesanan, b.nama_produk, d.nama_bahan_baku');
		return $this->db->get()->result_array();
	}

	public function GetBTKL($tanggal){
		$this->db->select('a.tanggal, a.jumlah, b.nama_produk, c.waktu, d.nama_aktivitas, d.satuan, e.tarif, (a.jumlah*c.waktu) as waktu_terpakai, ((a.jumlah*c.waktu)*e.tarif) as biaya');
		$this->db->from('mps a');
		$this->db->join('produk b', 'a.kd_produk = b.kd_produk');
		$this->db->join('routing c', 'b.kd_produk = c.kd_produk');
		$this->db->join('aktivitas d', 'c.kd_aktivitas = d.kd_aktivitas');
		$this->db->join('kebutuhan_akt as e', 'd.kd_aktivitas = e.kd_aktivitas');
		$this->db->where('a.tanggal', $tanggal);
		$this->db->group_by('a.kd_pesanan, b.nama_produk, d.nama_aktivitas');
		return $this->db->get()->result_array();
	}

	public function GetBOPMesin($tanggal){
		$this->db->select('a.tanggal, a.jumlah, b.nama_produk, c.waktu, d.nama_mesin, d.satuan, e.tarif, (a.jumlah*c.waktu) as waktu_terpakai, ((a.jumlah*c.waktu)*e.tarif) as biaya');
		$this->db->from('mps a');
		$this->db->join('produk b', 'a.kd_produk = b.kd_produk');
		$this->db->join('jam_mesin c', 'b.kd_produk = c.kd_produk');
		$this->db->join('mesin d', 'c.kd_mesin = d.kd_mesin');
		$this->db->join('kebutuhan_m as e', 'd.kd_mesin = e.kd_mesin');
		$this->db->where('a.tanggal', $tanggal);
		$this->db->group_by('a.kd_pesanan, b.nama_produk, d.nama_mesin');
		return $this->db->get()->result_array();
	}

	public function GetBOPBahanPenolong($tanggal){
		$this->db->select('a.tanggal, a.jumlah, b.nama_produk, c.kuantitas, d.nama_bahan_baku, d.satuan, e.harga, (a.jumlah*c.kuantitas) as jumlah_terpakai, ((a.jumlah*c.kuantitas)*e.harga) as biaya');
		$this->db->from('mps a');
		$this->db->join('produk b', 'a.kd_produk = b.kd_produk');
		$this->db->join('bom c', 'b.kd_produk = c.kd_produk');
		$this->db->join('bahan_baku d', 'c.kd_bahan_baku = d.kd_bahan_baku');
		$this->db->join('kebutuhan_bb as e', 'd.kd_bahan_baku = e.kd_bahan_baku');
		$this->db->where('a.tanggal', $tanggal);
		$this->db->where('d.jenis_bahan_baku', 'Penolong');
		$this->db->group_by('a.kd_pesanan, b.nama_produk, d.nama_bahan_baku');
		return $this->db->get()->result_array();
	}


	public function CekTanggal($tanggal){
		$this->db->select('tanggal');
		$this->db->from('mrp_ii');
		$this->db->where('tanggal', $tanggal);
		return $this->db->get()->num_rows();
	}

	public function GeneratePK(){
	    //Kode pesanan otomatis
		$this->db->select('RIGHT(kd_mrp_ii,4) as pk', FALSE);
		$this->db->order_by('kd_mrp_ii','DESC');    
		$this->db->limit(1);
		$query = $this->db->get('mrp_ii');
		//Cek pk sudah ada atau belum
		if($query->num_rows() != 0){
		    //jika pk ternyata sudah ada
		    $data = $query->row();
		    $pk   = intval($data->pk) + 1;
		}else{       
		    //jika pk belum ada
		    $pk = 1;
		}
		$pkmax = str_pad($pk, 4, "0", STR_PAD_LEFT);
		$pkjadi = "MRPII-".$pkmax;
		return $pkjadi;
    }

	public function Simpan(){
		$kd     = $this->m_mrp_ii->GeneratePK();
		$insert = array(
			'kd_mrp_ii'  => $kd,
			'tanggal'    => $this->input->post('tanggal'),
			'total_bbb'  => $this->input->post('bbb'),
			'total_btkl' => $this->input->post('btkl'),
			'total_bop'  => $this->input->post('bop'),
			'total'      => $this->input->post('total')
		);
		$this->db->insert('mrp_ii', $insert);

		//Generate Jurnal Bahan Baku(BBB)//
		jurnal('123', $this->input->post('tanggal'), 'debit', $this->input->post('bbb'));
		jurnal('121', $this->input->post('tanggal'), 'kredit', $this->input->post('bbb'));

		//Generate Jurnal Aktivitas(BTKL)//
		jurnal('124', $this->input->post('tanggal'), 'debit', $this->input->post('btkl'));
		jurnal('512', $this->input->post('tanggal'), 'kredit', $this->input->post('btkl'));

		//Generate Jurnal BOP//
		jurnal('125', $this->input->post('tanggal'), 'debit', $this->input->post('bop'));
		jurnal('513', $this->input->post('tanggal'), 'kredit', $this->input->post('bop'));

		//Generate Jurnal Persediaan Barang Dalam Proses//
		jurnal('122', $this->input->post('tanggal'), 'debit', $this->input->post('total'));
		jurnal('123', $this->input->post('tanggal'), 'kredit', $this->input->post('bbb'));
		jurnal('124', $this->input->post('tanggal'), 'kredit', $this->input->post('btkl'));
		jurnal('125', $this->input->post('tanggal'), 'kredit', $this->input->post('bop'));

	}
}