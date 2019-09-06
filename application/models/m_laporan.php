<?php
class m_laporan extends ci_model{

	public function GetJurnal(){
		$this->db->select('a.no, b.no_akun, b.nama_akun, a.tanggal, a.posisi, a.nominal');
		$this->db->from('jurnal a');
		$this->db->join('akun b', 'a.no_akun = b.no_akun');
		$this->db->where('MONTH(a.tanggal)', $_POST['bulan']);
		$this->db->where('YEAR(a.tanggal)', $_POST['tahun']);
		$this->db->order_by('no, a.tanggal');
		return $this->db->get()->result_array();
	}

	public function GetJurnalTotalDebit(){
		$this->db->select('SUM(nominal) as total');
		$this->db->from('jurnal');
		$this->db->where('MONTH(tanggal)', $_POST['bulan']);
		$this->db->where('YEAR(tanggal)', $_POST['tahun']);
		$this->db->where('posisi', 'debit');
		return $this->db->get()->row()->total;
	}

	public function GetJurnalTotalKredit(){
		$this->db->select('SUM(nominal) as total');
		$this->db->from('jurnal');
		$this->db->where('MONTH(tanggal)', $_POST['bulan']);
		$this->db->where('YEAR(tanggal)', $_POST['tahun']);
		$this->db->where('posisi', 'kredit');
		return $this->db->get()->row()->total;
	}

	public function GetJurnalAll(){
		$this->db->select('a.no, b.no_akun, b.nama_akun, a.tanggal, a.posisi, a.nominal');
		$this->db->from('jurnal a');
		$this->db->join('akun b', 'a.no_akun = b.no_akun');
		$this->db->order_by('no');
		return $this->db->get()->result_array();
	}

	public function GetNamaAkun(){
		$this->db->where('no_akun', $_POST['no_akun']);
		return $this->db->get('akun')->row()->nama_akun;
	}

	public function GetSaldoAkun(){
		$tgl_dipilih = date("".$_POST['tahun']."-".$_POST['bulan']."-01");

		$this->db->select('saldo');
		$this->db->where('no_akun', $_POST['no_akun']);
		$saldo = $this->db->get('akun')->row()->saldo;

		$this->db->select('SUM(nominal) as total');
		$this->db->where('no_akun', $_POST['no_akun']);
		$this->db->where('posisi', 'debit');
		$this->db->where('tanggal <', $tgl_dipilih);
		$debit = $this->db->get('jurnal')->row()->total;

		$this->db->select('SUM(nominal) as total');
		$this->db->where('no_akun', $_POST['no_akun']);
		$this->db->where('posisi', 'kredit');
		$this->db->where('tanggal <', $tgl_dipilih);
		$kredit = $this->db->get('jurnal')->row()->total;

		return $saldo_awal = $saldo + ($debit - $kredit);
	}
	
	/*public function GetSaldoAkun(){
		$tgl_dipilih = date_create("".$_POST['tahun']."-".$_POST['bulan']."-01");

		$this->db->select('posisi, nominal');
		$this->db->from('jurnal');
		$this->db->where('no_akun', $_POST['no_akun']);
		$this->db->where('MONTH(tanggal)', $_POST['bulan']-1);
		$this->db->where('YEAR(tanggal)', $_POST['tahun']);
		$jurnal = $this->db->get()->result_array();

		$this->db->where('no_akun', $_POST['no_akun']);
		$saldo_akun = $this->db->get('akun')->row()->saldo;

		$saldo = $saldo_akun;
		foreach($jurnal as $data){
			if($data['posisi'] == 'debit'){
				$saldo = $saldo + $data['nominal'];
			}else{
				$saldo = $saldo - $data['nominal'];
			}
		}
		return $saldo;
	}*/
	
	public function GetDataJurnal(){
		$this->db->select('b.no_akun, a.tanggal, b.nama_akun, a.posisi, a.nominal');
		$this->db->from('jurnal a');
		$this->db->join('akun b', 'a.no_akun = b.no_akun');
		$this->db->where('b.no_akun', $_POST['no_akun']);
		$this->db->where('MONTH(a.tanggal)', $_POST['bulan']);
		$this->db->where('YEAR(a.tanggal)', $_POST['tahun']);
		$this->db->order_by('a.tanggal');
		return $this->db->get()->result_array();
	}
}