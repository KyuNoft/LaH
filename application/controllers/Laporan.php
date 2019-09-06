<?php
class Laporan extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Penjualan"){
			redirect('Login');
		}
	}

	public function Jurnal(){
		if(isset($_POST['print'])) {
			$data['bulan']	   = $_POST['bulan'];
			$data['tahun']	   = $_POST['tahun'];
			$data['jurnal']    = $this->m_laporan->GetJurnal();
			$data['ttldebit']  = $this->m_laporan->GetJurnalTotalDebit();
			$data['ttlkredit'] = $this->m_laporan->GetJurnalTotalKredit();
			$this->template->load('template', 'jurnal/v_jurnal_pdf', $data);
		}elseif(isset($_POST['cari'])){
			$data['cari']      = $_POST['cari'];
			$data['bulan']	   = $_POST['bulan'];
			$data['tahun']	   = $_POST['tahun'];
			$data['jurnal']    = $this->m_laporan->GetJurnal();
			$data['ttldebit']  = $this->m_laporan->GetJurnalTotalDebit();
			$data['ttlkredit'] = $this->m_laporan->GetJurnalTotalKredit();
			$this->template->load('template', 'jurnal/v_jurnal', $data);
		}else{
			$this->template->load('template', 'jurnal/v_jurnal');
		}
	}
	
	public function BukuBesar(){
		if(isset($_POST['print'])) {
			$data['bulan']	  = $_POST['bulan'];
			$data['tahun']	  = $_POST['tahun'];
			$data['akun']     = $this->m_akun->GetDataAkun(); 
			$data['dataakun'] = $this->m_laporan->GetSaldoAkun();
			$data['jurnal']   = $this->m_laporan->GetDataJurnal(); 
			$this->template->load('template', 'buku_besar/v_buku_besar_pdf', $data);
		}elseif(isset($_POST['excel'])) {
			$data['bulan']	   = $_POST['bulan'];
			$data['tahun']	   = $_POST['tahun'];
			$data['akun']      = $this->m_akun->GetDataAkun();
			$data['nama_akun'] = $this->m_laporan->GetNamaAkun();
			$data['saldo']     = $this->m_laporan->GetSaldoAkun();
			$data['jurnal']    = $this->m_laporan->GetDataJurnal(); 
			$this->load->view('buku_besar/v_buku_besar_excel', $data);
		}elseif(isset($_POST['cari'])){
			$data['cari']      = $_POST['cari'];
			$data['bulan']	   = $_POST['bulan'];
			$data['tahun']	   = $_POST['tahun'];
			$data['akun']      = $this->m_akun->GetDataAkun();
			$data['nama_akun'] = $this->m_laporan->GetNamaAkun();
			$data['saldo']     = $this->m_laporan->GetSaldoAkun();
			$data['jurnal']    = $this->m_laporan->GetDataJurnal();
			$this->template->load('template', 'buku_besar/v_buku_besar', $data);
		}else{
			$data['akun']     = $this->m_akun->GetDataAkun(); 
			$this->template->load('template', 'buku_besar/v_buku_besar', $data);
		}
	}

	/*public function JurnalExcel(){
      	$data['jurnal'] = $this->m_laporan->GetJurnalAll();
      	$this->load->view('jurnal/v_jurnal_excel',$data);
    }*/
 }