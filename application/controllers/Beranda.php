<?php
class Beranda extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') == "Produksi" OR $this->session->userdata('akses') == "Penjualan"){
		}else{
			redirect('Login');
		}
	}

	public function index(){
		$this->template->load('template', 'beranda');
	}
}