<?php 
class Login extends CI_Controller{
 
	function index(){
		$this->load->view('login');
	}

	public function Cek(){
		$cek = $this->m_login->cek();
		if($cek->num_rows() > 0){
			foreach($cek->result_array() as $data){
				$sess_data['username']  = $data['username'];
				$sess_data['password']  = $data['password'];
				$sess_data['akses']     = $data['akses'];
				$this->session->set_userdata($sess_data);
			}
			$akses = $this->session->userdata('akses');
			if($akses == "Produksi"){
				redirect('Beranda');
			}elseif($akses == "Penjualan"){
				redirect('Beranda');
			}else{
				$data['gagal'] = '7';
				$this->load->view('login', $data);
			}
		}else{
			$data['gagal'] = '7';
			$this->load->view('login', $data);
		}
	}	

	public function Logout(){
		$this->session->sess_destroy();
		redirect('Login');
	}
}