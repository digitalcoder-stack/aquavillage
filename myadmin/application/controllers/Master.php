<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Master extends CI_Controller
{

	//=========================/cashacc===========================//
	public function cashAcc_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Cash Counter List";
		$data['id'] = $this->input->get('id');
		$data['dept_list'] = $this->Hr_model->get_active_dept();
		$data['account_list'] = $this->Setup_model->get_active_account();
		$data['all_value'] = $this->Master_model->get_all_cashacc();
		$data['edit_value'] = $this->Master_model->get_edit_cashacc($data['id']);
		$this->load->view('cash_account_list', $data);
	}

	public function get_dept_counter()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$dept_id = $this->input->post('dept_id');
			$data = $this->Master_model->get_active_cashacc($dept_id);
			echo json_encode($data);
		}
	}

	public function insert_cashacc()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_cashacc()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Data has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Data Updated Successfully'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_cashacc()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->delete_cashacc()) {

				$info = array(
					'status' => 'success',
					'message' => 'data has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}
	//=========================/cashacc===========================//

	//=========================/state===========================//
	public function state_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "State List";
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Master_model->get_all_state();
		$data['edit_value'] = $this->Master_model->get_edit_state($data['id']);
		$this->load->view('state_list', $data);
	}

	public function insert_state()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_state()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'State has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'State Updated Successfully'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_state()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->delete_state()) {

				$info = array(
					'status' => 'success',
					'message' => 'State has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}
	//=========================/state===========================//

	//-------------------------- city ------------------------//
	public function city_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "City List";
		$data['id'] = $this->input->get('id');
		$data['get_active_state'] = $this->Master_model->get_active_state();
		$data['all_value'] = $this->Master_model->get_all_city();
		$data['edit_value'] = $this->Master_model->get_edit_city($data['id']);

		$this->load->view('city_list', $data);
	}

	public function insert_city()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_city()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'City has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'City Updated Successfully'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function insert_shortcut_city()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_shortcut_city()) {

				$info = array(
					'status' => 'success',
					'message' => 'City has been Added successfully!',
					'data' => $this->Master_model->get_edit_city($data),
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_city()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->delete_city()) {
				$info = array(
					'status' => 'success',
					'message' => 'City has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}
	//-------------------------- city ------------------------//


	//========================= lockercode ===========================//

	public function lockercode_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "All Lockercode list";
		$data['id'] = $this->input->get('id');
		$data['edit_value'] = $this->Master_model->get_edit_lockercode($data['id']);
		$data['all_value'] = $this->Master_model->all_lockercode();
		$this->load->view('m_lockercode_list', $data);
	}

	public function insert_lockercode()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_lockercode()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Data has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Data Updated Successfully'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_lockercode()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->delete_lockercode()) {
				$info = array(
					'status' => 'success',
					'message' => 'Data has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}
	//========================= lockercode ===========================//

	//========================= saleshead ===========================//

	public function saleshead_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "All Sales Head";
		$data['type'] = 1;
		$data['id'] = $this->input->get('id');
		$data['edit_value'] = $this->Master_model->get_edit_saleshead($data['id']);
		$data['all_value'] = $this->Master_model->all_saleshead();
		$this->load->view('saleshead_list', $data);
	}
	public function instraction_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "All Rules And Instraction";
		$data['type'] = 2;
		$data['id'] = $this->input->get('id');
		$data['dept_value'] = $this->Hr_model->get_active_dept();
		$data['edit_value'] = $this->Master_model->get_edit_saleshead($data['id']);
		$data['all_value'] = $this->Master_model->all_instraction_list();
		$this->load->view('saleshead_list', $data);
	}

	public function insert_saleshead()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_saleshead()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Data has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Data Updated Successfully'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_saleshead()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->delete_saleshead()) {
				$info = array(
					'status' => 'success',
					'message' => 'Data has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}
	//========================= saleshead ===========================//



	//========================= perm ===========================//

	public function perm_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "All Permission list";
		$data['id'] = $this->input->get('id');
		$data['edit_value'] = $this->Master_model->get_edit_perm($data['id']);
		$data['all_value'] = $this->Master_model->all_perm();
		$this->load->view('m_perm_list', $data);
	}

	public function insert_perm()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_perm()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Data has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Data Updated Successfully'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	public function delete_perm()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->delete_perm()) {
				$info = array(
					'status' => 'success',
					'message' => 'Data has been Deleted successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}
	//========================= perm ===========================//


	//========================= userperm ===========================//

	public function userperm_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "All Permission";
		$data['userid'] = $this->input->get('id');
		$data['user_dtl'] = $this->Setup_model->get_user_details($data['userid']);
		$data['edit_value'] = $this->Master_model->get_userperm_userId($data['userid']);
		$data['all_value'] = $this->Master_model->all_perm();
		$this->load->view('user_permission_list', $data);
	}

	public function insert_userperm()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Master_model->insert_userperm()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Data has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Data Updated Successfully'
					);
				}
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some problem Occurred!! please try again'
				);
			}
			echo json_encode($info);
		}
	}

	//   public function delete_userperm(){

	// 	if($_SERVER["REQUEST_METHOD"] == "POST"){
	// 	  if($data = $this->Master_model->delete_userperm()){
	// 	  $info = array( 'status'=>'success',
	// 	  'message'=>'Data has been Deleted successfully!'
	// 	  );
	// 	  }else{ 
	// 		$info = array( 'status'=>'error',
	// 		  'message'=>'Some problem Occurred!! please try again'
	// 		);
	// 	  } 
	// 	  echo json_encode($info);
	// 	}
	//   }
	//========================= userperm ===========================//


	//==========================Details===========================//
	protected function login_details()
	{
		$this->require_login();
		$data['log_user_dtl'] = $this->Login_model->user_details();
		return $data;
	}
	//=========================/Details===========================//

	//======================Login Validation======================//
	protected function require_login()
	{
		$is_user_in = $this->session->userdata('is_user_in');
		if (isset($is_user_in) || $is_user_in == true) {
			return;
		} else {
			redirect('Login');
		}
	}

	protected function ajax_login()
	{
		$is_user_in = $this->session->userdata('is_user_in');
		if (isset($is_user_in) || $is_user_in == true) {
			return true;
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'You are not Logged in Now!! Please login again.'));
			return false;
		}
	}
}
