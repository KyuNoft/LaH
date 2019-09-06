<?php
class Akun extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Penjualan"){
			redirect('Login');
		}
	}
	
	public function index(){
		$data['akun'] = $this->m_akun->Get();
		$this->template->load('template', 'master_data/v_akun', $data);
	}

	public function Tambah(){
		$config = array(
			array(
				'field'  => 'no_akun',
				'label'  => 'No Akun',
				'rules'  => 'required|min_length[3]|max_length[3]|is_unique[akun.no_akun]is_natural_no_zero',
				'errors' => array(
					'required'  		 => '%s Tidak boleh Kosong',
					'min_length' 		 => '%s Hanya 3 angka',
					'max_length' 		 => '%s Hanya 3 angka',
					'is_unique'  		 => "".$_POST['no_akun']." sudah terdafar di database",
					'is_natural_no_zero' => '%s hanya bersisi 3 angka')
			),
			array(
				'field'  => 'nama_akun',
				'label'  => 'Nama Akun',
				'rules'  => 'min_length[1]|max_length[40]|callback_AlphaSpace|callback_Blank',
				'errors' => array(
					'min_length' => '%s minimal berisi 1 karakter',
					'max_length' => '%s maksimal berisi 40 karakter',
					'AlphaSpace' => '%s hanya berisi huruf dan tidak boleh kosong',
					'Blank' 	 => '%s tidak boleh mengandung angka dan tidak boleh kosong')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$sess["alert"] = "Gagal";
			$this->session->set_userdata($sess);
			$this->index();
		}else{
			$this->m_akun->Simpan();
			$sess["alert"] = "Sukses";
			$this->session->set_userdata($sess);
			redirect('Akun');
		}
	}

	public function Ubah(){
	$config = array(
			array(
				'field'  => 'nama_akun_u',
				'label'  => 'Nama Akun',
				'rules'  => 'min_length[1]|max_length[40]|callback_AlphaSpace|callback_Blank|callback_Space_First',
				'errors' => array(
					'min_length'  => '%s minimal berisi 1 karakter',
					'max_length'  => '%s maksimal berisi 40 karakter',
					'AlphaSpace'  => '%s hanya berisi huruf dan tidak boleh kosong',
					'Blank' 	  => '%s tidak boleh mengandung angka dan tidak boleh kosong',
					'Space_First' => '%s tidak boleh diawali dengan spasi')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$sess["alert"] = "GagalU";
			$sess["id"]    = $this->input->post('no_akun_u');
			$this->session->set_userdata($sess);
			$this->index();
		}else{
			$this->m_akun->Ubah();
			$sess["alert"] = "Sukses";
			$this->session->set_userdata($sess);
			redirect('Akun');
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