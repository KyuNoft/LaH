<?php 
class m_login extends CI_Model{	

	function cek(){
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		return $this->db->get('user');
	}
}