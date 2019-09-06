<?php
class Pesanan extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Penjualan"){
			redirect('Login');
		}
	}
	
	public function index(){
		if (isset($_POST['detail'])) {
			$data['detail'] = $this->m_pesanan->GetDataDetailPesanan();
			$sess["detail"] = "Detail";
			$this->session->set_userdata($sess);
		}
		$data['pesanan']     = $this->m_pesanan->Get();
		$this->template->load('template', 'pesanan/v_pesanan', $data);
	}

	public function Tambah(){
		$data['pk']          = $this->m_pesanan->GeneratePK();
		$data['pelanggan']   = $this->m_pelanggan->GetDataPelanggan();
		$data['produk']      = $this->m_produk->GetDataProduk5();
		$data['detail']    	 = $this->m_pesanan->GetDataDetail($data['pk']);
		$data['jmltgl'] 	 = $this->m_pesanan->CariTanggal()->num_rows();
		if($data['jmltgl'] == 0){
			$data['tglterakhir'] = date('Y-m-d');
		}else{
			$data['tglterakhir'] = $this->m_pesanan->CariTanggal()->row()->tanggal;
		}
		$this->template->load('template', 'pesanan/f_pesanan', $data);
	}

	public function TambahDetail(){
		$config = array(
			array(
				'field'  => 'kd_produk',
				'label'  => 'Produk',
				'rules'  => 'required',
				'errors' => array(
					'required' => '%s Harus diisi')
			),
			array(
				'field'  => 'jumlah',
				'label'  => 'Jumlah',
				'rules'  => 'required|is_natural_no_zero',
				'errors' => array(
					'required'           => '%s Tidak boleh Kosong',
					'is_natural_no_zero' => '%s hanya berisi angka dari 1 dan seterusnya')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>', '</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$alert["alert"] = "Gagal";
			$this->session->set_userdata($alert);
			$this->Tambah();
		}else{
			$alert["alert"] = "Sukses";
			$this->session->set_userdata($alert);
			$this->m_pesanan->SimpanDetail();
		redirect('pesanan/Tambah');
		}
	}

	public function Selesai(){
		$this->m_pesanan->Selesai();
		$sess["alert"] = "SuksesPesanan";
		$this->session->set_userdata($sess);
		redirect('Pesanan');
	}
}