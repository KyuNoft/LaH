<?php
class BahanBaku extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Produksi"){
			redirect('Login');
		}
	}
	
	public function index(){
		$data['bahan_baku'] = $this->m_bahan_baku->Get();
		$data['pk']         = $this->m_bahan_baku->GeneratePK();
		$this->template->load('template', 'master_data/v_bahan_baku', $data);
	}

	public function Tambah(){
		$config = array(
			array(
				'field'  => 'nama_bahan_baku',
				'label'  => 'Nama Bahan Baku',
				'rules'  => 'required|min_length[1]|max_length[20]|callback_AlphaSpace|callback_Blank',
				'errors' => array(
					'required'   => '%s Tidak boleh Kosong',
					'min_length' => '%s minimal berisi 1 karakter',
					'max_length' => '%s maksimal berisi 20 karakter',
					'AlphaSpace' => '%s hanya berisi huruf dan tidak boleh kosong',
					'Blank' 	 => '%s Tidak boleh kosong')
			),
			array(
				'field'  => 'satuan',
				'label'  => 'Satuan',
				'rules'  => 'required|min_length[1]|max_length[10]|callback_AlphaSpace|callback_Blank',
				'errors' => array(
					'required'   => '%s Tidak boleh Kosong',
					'min_length' => '%s minimal berisi 1 karakter',
					'max_length' => '%s maksimal berisi 10 karakter',
					'AlphaSpace' => '%s hanya berisi huruf dan tidak boleh kosong',
					'Blank' 	 => '%s Tidak boleh kosong')
			),
			array(
				'field'  => 'harga',
				'label'  => 'Harga',
				'rules'  => 'required|is_natural_no_zero',
				'errors' => array(
					'required' 			 => '%s tidak boleh kosong',
					'is_natural_no_zero' => '%s hanya bersisi angka dari 1 dan seterusnya')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$sess["alert"] = "Gagal";
			$this->session->set_userdata($sess);
			$this->index();
		}else{
			$this->m_bahan_baku->Simpan();
			$sess["alert"] = "Sukses";
			$this->session->set_userdata($sess);
			redirect('BahanBaku');
		}
	}

	public function Ubah(){
		$config = array(
			array(
				'field'  => 'nama_bahan_baku_u',
				'label'  => 'Nama Bahan Baku',
				'rules'  => 'required|min_length[1]|max_length[20]|callback_AlphaSpace|callback_Blank|callback_Space_First',
				'errors' => array(
					'required'   => '%s Tidak boleh Kosong',
					'min_length' => '%s minimal berisi 1 karakter',
					'max_length' => '%s maksimal berisi 20 karakter',
					'AlphaSpace' => '%s hanya berisi huruf dan tidak boleh kosong',
					'Blank' 	 => '%s Tidak boleh kosong',
					'Space_First' => '%s tidak boleh diawali dengan spasi')
			),
			array(
				'field'  => 'satuan_u',
				'label'  => 'Satuan',
				'rules'  => 'required|min_length[1]|max_length[10]|callback_AlphaSpace|callback_Blank|callback_Space_First',
				'errors' => array(
					'required'   => '%s Tidak boleh Kosong',
					'min_length' => '%s minimal berisi 1 karakter',
					'max_length' => '%s maksimal berisi 10 karakter',
					'AlphaSpace' => '%s hanya berisi huruf dan tidak boleh kosong',
					'Blank' 	 => '%s Tidak boleh kosong',
					'Space_First' => '%s tidak boleh diawali dengan spasi')
			),
			array(
				'field'  => 'harga_u',
				'label'  => 'Harga',
				'rules'  => 'required|is_natural_no_zero',
				'errors' => array(
					'required' 			 => '%s tidak boleh kosong',
					'is_natural_no_zero' => '%s hanya bersisi angka dari 1 dan seterusnya')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$sess["alert"] = "GagalU";
			$sess["id"]    = $this->input->post('kd_bahan_baku_u');
			$this->session->set_userdata($sess);
			$this->index();
		}else{
			$this->m_bahan_baku->Ubah();
			$sess["alert"] = "Sukses";
			$this->session->set_userdata($sess);
			redirect('BahanBaku');
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