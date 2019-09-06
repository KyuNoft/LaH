<?php
class MPS extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Produksi"){
			redirect('Login');
		}
	}
	
	public function index(){
		$data['mps'] = $this->m_mps->Get();
		$this->template->load('template', 'mps/v_mps_pesanan', $data);
	}

	public function Jadwal(){
		if(isset($_POST['detail'])) {
			$data['detail'] = $this->m_mps->GetDetailJadwal();
			$sess['detail'] = "Detail";
			$this->session->set_userdata($sess);
			$data['cari']   = $_POST['cari'];
			$data['bulan']  = $_POST['bulan'];
			$data['tahun']  = $_POST['tahun'];
			$data['jadwal'] = $this->m_mps->GetJadwal();
			$this->template->load('template', 'mps/v_mps_jadwal', $data);
		}elseif(isset($_POST['cari'])){
			$data['cari']   = $_POST['cari'];
			$data['bulan']  = $_POST['bulan'];
			$data['tahun']  = $_POST['tahun'];
			$data['jadwal'] = $this->m_mps->GetJadwal();
			$this->template->load('template', 'mps/v_mps_jadwal', $data);
		}else{
			$this->template->load('template', 'mps/v_mps_jadwal');
		}
	}

	public function BuatJadwal($kd_pesanan){
		$this->m_mps->Buat($kd_pesanan);
		$this->m_mps->SimpanBB($kd_pesanan);
		$this->m_mps->SimpanAKT($kd_pesanan);
		$this->m_mps->SimpanM($kd_pesanan);
		$sess["alert"] = "SuksesJadwal";
		$this->session->set_userdata($sess);
		redirect('MPS/Jadwal');
	}
}