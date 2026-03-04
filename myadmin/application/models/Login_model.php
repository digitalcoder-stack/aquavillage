<?php date_default_timezone_set('Asia/Kolkata');

class Login_model extends CI_model{

//============================Login===========================//



//============================Login===========================//

public function validate_user(){

	$pass = $this->input->post('login_pass');

	

	$this->db->select('m_admin_id,m_admin_type,m_admin_branch');

	$this->db->where('m_admin_login_id',$this->input->post('login_id'));

	$this->db->where('m_admin_pass',$pass);
	$this->db->where('m_admin_login_allowed',1);

	$sql=$this->db->get('master_admin_tbl');

	

	if($sql->num_rows() == 1){ return $sql->result(); }else{ return false; }

}

		

public function user_details(){

	// $this->db->select('m_admin_id, m_admin_name, m_admin_img');

	$this->db->where('m_admin_id',$this->session->userdata('user_id'));

	return $this->db->get('master_admin_tbl')->result();

}

		

public function get_user_profile_details(){

	// $this->db->select('m_admin_id, m_admin_name, m_admin_login_id, m_admin_email, m_admin_pass, m_admin_contact, m_admin_img');

	$this->db->where('m_admin_id',$this->session->userdata('user_id'));

	return $this->db->get('master_admin_tbl')->result();

}

//===========================/Login===========================//



//===========================/Login===========================//

} ?>