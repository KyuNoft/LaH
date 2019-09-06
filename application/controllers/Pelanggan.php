<?php
class Pelanggan extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Penjualan"){
			redirect('Login');
		}
	}

	public function index(){
		$data['pelanggan'] = $this->m_pelanggan->Get();
		$data['pk']     = $this->m_pelanggan->GeneratePK();
		$this->template->load('template', 'master_data/v_pelanggan', $data);
	}

	public function Tambah(){
		$config = array(
			array(
				'field'  => 'nama_pelanggan',
				'label'  => 'Nama Pelanggan',
				'rules'  => 'required|min_length[1]|max_length[30]|callback_AlphaSpace|callback_Blank',
				'errors' => array(
					'required'   => '%s Tidak boleh Kosong',
					'min_length' => '%s minimal berisi 1 karakter',
					'max_length' => '%s maksimal berisi 30 karakter',
					'AlphaSpace' => '%s hanya berisi huruf dan tidak boleh kosong',
					'Blank' 	 => '%s Tidak boleh kosong')
			),
			array(
				'field'  => 'no_telp',
				'label'  => 'No Telepon',
				'rules'  => 'required|numeric|min_length[11]|max_length[12]|is_natural_no_zero',
				'errors' => array(
					'required'           => '%s Tidak boleh Kosong',
					'numeric'            => '%s Hanya boleh berisi Angka 1-9',
					'min_length'         => '%s Minimal 11 digit',
					'max_length'         => '%s Maksimal 12 digit',
					'is_natural_no_zero' => '%s Tidak boleh Minus')
			),
			array(
				'field'  => 'email',
				'label'  => 'Email',
				'rules'  => 'required|valid_email',
				'errors' => array(
					'required' 	  => '%s Tidak boleh Kosong',
					'valid_email' => '%s harus sesuai ketentuan')
			),
			array(
				'field'  => 'alamat',
				'label'  => 'Alamat',
				'rules'  => 'required|min_length[10]|callback_Blank',
				'errors' => array(
					'required'   => '%s Tidak boleh Kosong',
					'min_length' => '%s minimal berisi 10 karakter',
					'Blank' 	 => '%s Tidak boleh Kosong')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$sess["alert"] = "Gagal";
			$this->session->set_userdata($sess);
			$this->index();
		}else{
			$this->m_pelanggan->Simpan();
			$sess["alert"] = "Sukses";
			$this->session->set_userdata($sess);
			redirect('Pelanggan');
		}
	}

	public function Ubah(){
		$config = array(
			array(
				'field'  => 'nama_pelanggan_u',
				'label'  => 'Nama Pelanggan',
				'rules'  => 'required|min_length[1]|max_length[30]|callback_AlphaSpace|callback_Blank|callback_Space_First',
				'errors' => array(
					'required'   => '%s Tidak boleh Kosong',
					'min_length' => '%s minimal berisi 1 karakter',
					'max_length' => '%s maksimal berisi 30 karakter',
					'AlphaSpace' => '%s hanya berisi huruf dan tidak boleh kosong',
					'Blank' 	 => '%s Tidak boleh kosong',
					'Space_First' => '%s tidak boleh diawali dengan spasi')
			),
			array(
				'field'  => 'no_telp_u',
				'label'  => 'No Telepon',
				'rules'  => 'required|numeric|min_length[11]|max_length[12]|is_natural_no_zero',
				'errors' => array(
					'required'           => '%s Tidak boleh Kosong',
					'numeric'            => '%s Hanya boleh berisi Angka 1-9',
					'min_length'         => '%s Minimal 11 digit',
					'max_length'         => '%s Maksimal 12 digit',
					'is_natural_no_zero' => '%s Tidak boleh Minus')
			),
			array(
				'field'  => 'email',
				'label'  => 'Email',
				'rules'  => 'required|valid_email',
				'errors' => array(
					'required' 	  => '%s Tidak boleh Kosong',
					'valid_email' => '%s harus sesuai ketentuan')
			),
			array(
				'field'  => 'alamat',
				'label'  => 'Alamat',
				'rules'  => 'required|min_length[10]|callback_Blank|callback_Space_First',
				'errors' => array(
					'required'   => '%s Tidak boleh Kosong',
					'min_length' => '%s minimal berisi 10 karakter',
					'Blank' 	 => '%s Tidak boleh Kosong',
					'Space_First' => '%s tidak boleh diawali dengan spasi')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$sess["alert"] = "GagalU";
			$sess["id"]    = $this->input->post('id_pelanggan_u');
			$this->session->set_userdata($sess);
			$this->index();
		}else{
			$this->m_pelanggan->Ubah();
			$sess["alert"] = "Sukses";
			$this->session->set_userdata($sess);
			redirect('Pelanggan');
		}
	}

	public function AlphaSpace($str){
		return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
	}

	public function Blank($str){
		if(trim($str) == ''){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function Space_First($str){
		return ( ! preg_match("/^(?! )/", $str)) ? FALSE : TRUE;
	}
}