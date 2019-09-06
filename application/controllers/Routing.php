<?php
class Routing extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Produksi"){
			redirect('Login');
		}
	}
	
	public function index(){
		unset($_SESSION['trigger']);
		if (isset($_POST['detail'])) {
			$data['routing'] = $this->m_routing->Get();
			$sess["detail"]  = "Detail";
			$this->session->set_userdata($sess);
		}
		$data['nama'] = $this->m_routing->GetDataNamaProduk();
		$this->template->load('template', 'routing/v_routing', $data);
	}

	public function Tambah(){
		unset($_SESSION['trigger']);
		$data['produk3']    = $this->m_produk->GetDataProduk3();
		$data['aktivitas']  = $this->m_aktivitas->GetDataAktivitas();
		$this->template->load('template', 'routing/f_routing', $data);
	}

	public function Simpan(){
		$config = array(
			array(
				'field'  => 'kd_produk',
				'label'  => 'Routing',
				'rules'  => 'callback_cek_routing',
				'errors' => array(
					'cek_routing' => '%s dengan Produk dan Aktivitas yang sama sudah ada')
			),
			array(
				'field'  => 'kd_aktivitas',
				'label'  => 'Aktivitas',
				'rules'  => 'required',
				'errors' => array(
					'required' => '%s Harus diisi')
			),
			array(
				'field'  => 'waktu',
				'label'  => 'waktu',
				'rules'  => 'required|is_natural_no_zero',
				'errors' => array(
					'required' => '%s Harus diisi',
					'is_natural_no_zero' => '%s hanya berisi angka dari 1 dan seterusnya')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		$kd   = $this->input->post('kd_produk');
		$nama = $this->input->post('nama_produk');
		if($this->form_validation->run() == FALSE){
				$data['drouting']   = $this->m_routing->GetDetail($kd, $nama);
				$data['count']      = $this->m_routing->GetJumlah($kd, $nama);
				$data['produk2']  	= $this->m_produk->GetDataProduk2($kd);
				$data['aktivitas']  = $this->m_aktivitas->GetDataAktivitas();
				$sess["alert"]      = "Gagal";
				$sess["trigger"]    = "Tambah";
				$this->session->set_userdata($sess);
				$this->template->load('template', 'routing/f_routing', $data);
		}else{
			if (isset($_POST['trigger'])) {
				$this->m_routing->Simpan();
				$data['drouting']   = $this->m_routing->GetDetail($kd, $nama);
				$data['count']      = $this->m_routing->GetJumlah($kd, $nama);
				$data['produk2']  	= $this->m_produk->GetDataProduk2($kd);
				$data['aktivitas']  = $this->m_aktivitas->GetDataAktivitas();
				$sess["alert"]      = "Sukses";
				$sess["trigger"]    = "Tambah";
				$this->session->set_userdata($sess);
				$this->template->load('template', 'routing/f_routing', $data);
			}else{
				redirect('Routing');
			}
		}
	}

	public function Selesai($kd){
		$this->m_routing->Selesai($kd);
		unset($_SESSION['trigger']);
		redirect('Routing');
	}

	public function Hapus($produk, $aktivitas){
		$this->m_routing->Hapus($produk, $aktivitas);
		$nama_produk = "";
		$data['drouting']   = $this->m_routing->GetDetail($produk, $nama_produk);
		$data['count']      = $this->m_routing->GetJumlah($produk, $nama_produk);
		$data['produk2']  	= $this->m_produk->GetDataProduk2($produk);
		$data['aktivitas']  = $this->m_aktivitas->GetDataAktivitas();
		$sess["trigger"]    = "Tambah";
		$this->session->set_userdata($sess);
		$this->template->load('template', 'routing/f_routing', $data);
	}

	public function cek_routing(){
		$this->db->where('kd_produk', $this->input->post('kd_produk'));
		$this->db->where('kd_aktivitas', $this->input->post('kd_aktivitas'));
		$num = $this->db->get('routing')->num_rows();
		if ($num > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}