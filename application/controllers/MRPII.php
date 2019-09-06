<?php
class MRPII extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Produksi"){
			redirect('Login');
		}
	}

	public function index(){
		if(isset($_POST['pilih'])){
			$data['bulan'] = $_POST['bulan'];
		}
		$data['tanggal'] = $this->m_mrp_ii->GetTanggal()->result_array();
		$data['jmltgl']  = $this->m_mrp_ii->GetTanggal()->num_rows();
		$data['jumlah']  = $this->m_mrp_ii->GetJumlah();
		$data['totalb']  = $this->m_mrp_ii->GetTotalBiaya();
		$this->template->load('template', 'mrp_ii/v_mrp_ii', $data);
	}

	public function DaftarBiaya(){
		$data['mrp_ii'] = $this->m_mrp_ii->Get();
		$this->template->load('template', 'mrp_ii/v_mrp_ii_daftar_biaya', $data);
	}

	public function Hitung(){
		if(isset($_POST['tanggal'])){
			$tanggal 	  	  = $_POST['tanggal'];
			$data['bbb']  	  = $this->m_mrp_ii->GetBBB($tanggal);
			$data['btkl'] 	  = $this->m_mrp_ii->GetBTKL($tanggal);
			$data['bopm']  	  = $this->m_mrp_ii->GetBOPMesin($tanggal);
			$data['bopbp']    = $this->m_mrp_ii->GetBOPBahanPenolong($tanggal);
			$data['existtgl'] = $this->m_mrp_ii->CekTanggal($tanggal);
			$data['tanggal']  = $tanggal;
			$this->template->load('template', 'mrp_ii/f_mrp_ii_hitung', $data);
		}else{
			$this->template->load('template', 'mrp_ii/f_mrp_ii_hitung');
		}
	}

	public function Simpan(){
		$this->m_mrp_ii->Simpan();
		$sess["alert"] = "SuksesGenerate";
		$this->session->set_userdata($sess);
		redirect('MRPII/DaftarBiaya');
	}
}