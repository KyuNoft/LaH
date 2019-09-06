<?php
class BOM extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Produksi"){
			redirect('Login');
		}
	}

	public function index(){
		unset($_SESSION['trigger']);
		if (isset($_POST['detail'])) {
			$data['bom'] = $this->m_bom->Get();
			$sess["detail"] = "Detail";
			$this->session->set_userdata($sess);
		}
		$data['nama'] = $this->m_bom->GetDataNamaProduk();
		$this->template->load('template', 'bom/v_bom', $data);
	}

	public function Tambah(){
		unset($_SESSION['trigger']);
		$data['produk']     = $this->m_produk->GetDataProduk();
		$data['bahan_baku'] = $this->m_bahan_baku->GetDataBahanBaku();
		$this->template->load('template', 'bom/f_bom', $data);
	}

	public function Simpan(){
		$config = array(
			array(
				'field'  => 'kd_produk',
				'label'  => 'BOM',
				'rules'  => 'callback_cek_bom',
				'errors' => array(
					'cek_bom' => '%s dengan Produk dan Bahan yang sama sudah ada')
			),
			array(
				'field'  => 'kd_bahan_baku',
				'label'  => 'Bahan',
				'rules'  => 'required',
				'errors' => array(
					'required' => '%s Harus diisi')
			),
			array(
				'field'  => 'kuantitas',
				'label'  => 'Kuantitas',
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
				$data['dbom']       = $this->m_bom->GetDetail($kd, $nama);
				$data['count']      = $this->m_bom->GetJumlah($kd, $nama);
				$data['produk2']  	= $this->m_produk->GetDataProduk2($kd);
				$data['bahan_baku'] = $this->m_bahan_baku->GetDataBahanBaku();
				$sess["alert"]      = "Gagal";
				$sess["trigger"]    = "Tambah";
				$this->session->set_userdata($sess);
				$this->template->load('template', 'bom/f_bom', $data);
		}else{
			if (isset($_POST['trigger'])) {
				$this->m_bom->Simpan();
				$data['dbom']       = $this->m_bom->GetDetail($kd, $nama);
				$data['count']      = $this->m_bom->GetJumlah($kd, $nama);
				$data['produk2']  	= $this->m_produk->GetDataProduk2($kd);
				$data['bahan_baku'] = $this->m_bahan_baku->GetDataBahanBaku();
				$sess["alert"]      = "Sukses";
				$sess["trigger"]    = "Tambah";
				$this->session->set_userdata($sess);
				$this->template->load('template', 'bom/f_bom', $data);
			}else{
				redirect('BOM');
			}
		}
	}

	public function Selesai($kd){
		$this->m_bom->Selesai($kd);
		unset($_SESSION['trigger']);
		redirect('BOM');
	}

	public function Hapus($produk, $bahan_baku){
		$this->m_bom->Hapus($produk, $bahan_baku);
		$nama_produk = "";
		$data['dbom']       = $this->m_bom->GetDetail($produk, $nama_produk);
		$data['count']      = $this->m_bom->GetJumlah($produk, $nama_produk);
		$data['produk2']  	= $this->m_produk->GetDataProduk2($produk);
		$data['bahan_baku'] = $this->m_bahan_baku->GetDataBahanBaku();
		$sess["trigger"]    = "Tambah";
		$this->session->set_userdata($sess);
		$this->template->load('template', 'bom/f_bom', $data);
	}

	public function cek_bom(){
		$this->db->where('kd_produk', $this->input->post('kd_produk'));
		$this->db->where('kd_bahan_baku', $this->input->post('kd_bahan_baku'));
		$num = $this->db->get('bom')->num_rows();
		if ($num > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}