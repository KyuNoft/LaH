<?php
class JamMesin extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Produksi"){
			redirect('Login');
		}
	}

	public function index(){
		unset($_SESSION['trigger']);
		if (isset($_POST['detail'])) {
			$data['jam_mesin'] = $this->m_jam_mesin->Get();
			$sess["detail"]	   = "Detail";
			$this->session->set_userdata($sess);
		}
		$data['nama'] = $this->m_jam_mesin->GetDataNamaProduk();
		$this->template->load('template', 'jam_mesin/v_jam_mesin', $data);
	}

	public function Tambah(){
		unset($_SESSION['trigger']);
		$data['produk4'] = $this->m_produk->GetDataProduk4();
		$data['mesin'] 	 = $this->m_mesin->GetDataMesin();
		$this->template->load('template', 'jam_mesin/f_jam_mesin', $data);
	}

	public function Simpan(){
		$config = array(
			array(
				'field'  => 'kd_produk',
				'label'  => 'Jam Mesin',
				'rules'  => 'callback_cek_jam_mesin',
				'errors' => array(
					'cek_jam_mesin' => '%s dengan Produk dan Mesin yang sama sudah ada')
			),
			array(
				'field'  => 'kd_mesin',
				'label'  => 'Mesin',
				'rules'  => 'required',
				'errors' => array(
					'required' => '%s Harus diisi')
			),
			array(
				'field'  => 'waktu',
				'label'  => 'Waktu',
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
				$data['djam_mesin'] = $this->m_jam_mesin->GetDetail($kd, $nama);
				$data['count']      = $this->m_jam_mesin->GetJumlah($kd, $nama);
				$data['produk2']  	= $this->m_produk->GetDataProduk2($kd);
				$data['mesin'] 	 	= $this->m_mesin->GetDataMesin();
				$sess["alert"]      = "Gagal";
				$sess["trigger"]    = "Tambah";
				$this->session->set_userdata($sess);
				$this->template->load('template', 'jam_mesin/f_jam_mesin', $data);
		}else{
			if (isset($_POST['trigger'])) {
				$this->m_jam_mesin->Simpan();
				$data['djam_mesin'] = $this->m_jam_mesin->GetDetail($kd, $nama);
				$data['count']      = $this->m_jam_mesin->GetJumlah($kd, $nama);
				$data['produk2']  	= $this->m_produk->GetDataProduk2($kd);
				$data['mesin']	    = $this->m_mesin->GetDataMesin();
				$sess["alert"]      = "Sukses";
				$sess["trigger"]    = "Tambah";
				$this->session->set_userdata($sess);
				$this->template->load('template', 'jam_mesin/f_jam_mesin', $data);
			}else{
				redirect('JamMesin');
			}
		}
	}

	public function Selesai($kd){
		$this->m_jam_mesin->Selesai($kd);
		unset($_SESSION['trigger']);
		redirect('JamMesin');
	}

	public function Hapus($produk, $mesin){
		$this->m_jam_mesin->Hapus($produk, $mesin);
		$nama_produk = "";
		$data['djam_mesin'] = $this->m_jam_mesin->GetDetail($produk, $nama_produk);
		$data['count']      = $this->m_jam_mesin->GetJumlah($produk, $nama_produk);
		$data['produk2']  	= $this->m_produk->GetDataProduk2($produk);
		$data['mesin'] 		= $this->m_mesin->GetDataMesin();
		$sess["trigger"]    = "Tambah";
		$this->session->set_userdata($sess);
		$this->template->load('template', 'jam_mesin/f_jam_mesin', $data);
	}

	public function cek_jam_mesin(){
		$this->db->where('kd_produk', $this->input->post('kd_produk'));
		$this->db->where('kd_mesin', $this->input->post('kd_mesin'));
		$num = $this->db->get('jam_mesin')->num_rows();
		if ($num > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}