<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class HrDept extends CI_Controller
{

	//-------------------------- dept ------------------------//
	public function department_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Department List";
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_all_dept();
		$data['edit_value'] = $this->Hr_model->get_edit_dept($data['id']);

		$this->load->view('h_department_list', $data);
	}

	public function insert_dept()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->insert_dept()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Department has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Department Updated Successfully'
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

	public function delete_dept()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->delete_dept()) {
				$info = array(
					'status' => 'success',
					'message' => 'Department has been Deleted successfully!'
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
	//-------------------------- dept ------------------------//

	//-------------------------- design ------------------------//
	public function designation_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Designation List";
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_all_design();
		$data['edit_value'] = $this->Hr_model->get_edit_design($data['id']);

		$this->load->view('h_designation_list', $data);
	}

	public function insert_design()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->insert_design()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Designation has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Designation Updated Successfully'
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

	public function delete_design()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->delete_design()) {
				$info = array(
					'status' => 'success',
					'message' => 'Designation has been Deleted successfully!'
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
	//-------------------------- design ------------------------//


	//-------------------------- hq ------------------------//
	public function hq_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "HQ List";
		$data['id'] = $this->input->get('id');
		$data['type'] = 1;
		$data['all_value'] = $this->Hr_model->get_hq_type($data['type']);
		$data['edit_value'] = $this->Hr_model->get_edit_hq($data['id']);

		$this->load->view('h_hq_list', $data);
	}


	public function insert_hq()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->insert_hq()) {

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

	public function delete_hq()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->delete_hq()) {
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
	//-------------------------- hq ------------------------//

	//-------------------------- nh ------------------------//
	public function nh_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "NH List";
		$data['id'] = $this->input->get('id');
		$data['all_value'] = $this->Hr_model->get_all_nh();
		$data['edit_value'] = $this->Hr_model->get_edit_nh($data['id']);

		$this->load->view('h_nh_list', $data);
	}

	public function insert_nh()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->insert_nh()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'NH has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'NH Updated Successfully'
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

	public function delete_nh()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->delete_nh()) {
				$info = array(
					'status' => 'success',
					'message' => 'NH has been Deleted successfully!'
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
	//-------------------------- nh ------------------------//

	//======================================================= Employee=================================================//

	public function employe_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "All Employee List";
		$data['from_date'] = $this->input->post('from_date');
		$data['to_date'] = $this->input->post('to_date');
		$data['status'] = $this->input->post('status') ?: 'o';
		$data['emp_value'] = $this->Hr_model->get_emp_list($data['from_date'], $data['to_date'], $data['status']);

		if (!empty($this->input->post('Excel'))) {
			$this->excelForemp($data['emp_value']);
		}
		$this->load->view('h_employe_list', $data);
	}

	public function add_employe()
	{
		$data = $this->login_details();
		$data['id'] = $this->input->get('id');
		if (!empty($data['id'])) {
			$data['pagename'] = "Edit Employee Details";
		} else {
			$data['pagename'] = "Add New Employee";
		}
		$data['company_list'] = $this->Setup_model->get_active_company();
		$data['dept_value'] = $this->Hr_model->get_active_dept();
		$data['design_value'] = $this->Hr_model->get_active_design();
		$data['hq_value'] = $this->Hr_model->get_active_hq();
		$data['emp_list'] = $this->Hr_model->get_Active_emp(null, 1);
		$data['edit_value'] = $this->Hr_model->get_emp_dtl($data['id']);

		$this->load->view('add_employe', $data);
	}

	public function insert_emp()
	{
		if ($this->ajax_login() === false) {
			return;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->insert_emp()) {

				if ($data == 1) {
					$info = array(
						'status' => 'success',
						'message' => 'Employee has been Added successfully!'
					);
				} else if ($data == 2) {
					$info = array(
						'status' => 'success',
						'message' => 'Employee data Updated Successfully'
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

	public function check_emp_history()
	{

		$id = $this->input->post('empid');
		$res = $this->Hr_model->check_emp_history($id);
		if (!empty($res)) {
			$curdate = date('Y-m-d');
			$date1 = date_create($curdate);
			$date2 = date_create($res[0]->m_advance_date);
			$diff = date_diff($date1, $date2);

			$data['status'] = $diff->format("%a") >= 7 ? 'success' : 'error';
			$data['message'] = 'Advance Not Allowed ! There should 7 days difference';
		} else {
			$data['status'] = 'success';
			$data['message'] = 'Allowed';
		}
		$data['advc_his'] = $res;
		$data['emp_dtl'] = $this->Hr_model->get_emp_dtl($id);
		echo json_encode($data);
	}

	public function get_emp_dtl()
	{

		$id = $this->input->post('empid');
		$data = $this->Hr_model->get_emp_dtl($id);
		echo json_encode($data);
	}

	public function delete_emp()
	{
		if ($this->ajax_login() === false) {
			return;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($this->Hr_model->delete_emp()) {
				$info = array(
					'status' => 'success',
					'message' => 'Data has been Deleted Successfully!'
				);
			} else {
				$info = array(
					'status' => 'error',
					'message' => 'Some Problem Occured'
				);
			}
			echo json_encode($info);
		}
	}

	public function excelForemp($allreportdata)
	{

		$count = 0;
		$data = array();
		foreach ($allreportdata as $key) {
			$count++;
			$subArray = array();

			$subArray[] = $count;
			$subArray[] = $key->m_emp_code;
			$subArray[] = $key->m_emp_id;
			$subArray[] = $key->m_emp_name;
			$subArray[] = date('d-m-Y h:i', strtotime($key->m_emp_doj));
			$subArray[] = $key->m_emp_gross_salary;
			$subArray[] = $key->m_emp_epfno;
			$subArray[] = $key->m_emp_esicno;
			$subArray[] = $key->m_emp_panno;
			$subArray[] = $key->m_emp_mobile;
			$subArray[] = $key->m_emp_accno;
			$subArray[] = $key->m_emp_company;
			$subArray[] = $key->m_dept_name;
			$subArray[] = $key->m_design_name;

			$data[] = $subArray;
		}

		//  echo "<pre>" ;   print_r($data) ; die ;
		$fileName = 'emp_list' . date('Y_m_d_h_i_s') . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$fileName");
		header("Content-Type: application/csv; ");
		$report = $data;
		$file = fopen('php://output', 'w');

		$header = array(
			"Sno.",
			"EmpCode",
			"Login ID",
			"EmpName",
			"DOJ",
			"GSalary",
			"EPF No",
			"ESIC No",
			"Pan No",
			"Mobile No",
			"BankAccNo",
			"Company",
			"Dept",
			"Desig",


		);
		fputcsv($file, $header);
		foreach ($report as $line) {
			fputcsv($file, $line);
		}
		fclose($file);
		// echo json_encode(array(
		//   'status' => 'success',
		//   'message' => 'Data Export successfully!'
		// ));
		exit;
	}

	//=======================================================Employee=================================================//

	//-------------------------- advance ------------------------//
	public function advance_list($type = 1)
	{
		$data = $this->login_details();
		$data['pagetype'] = $type;
		$data['dept'] = 1;
		$data['id'] = $this->input->get('id');
		if ($type == 2) {
			$data['pagename'] = $data['id'] == '' ? "Add Advance" : "Edit Advance ";
		} else {
			$data['pagename'] = "Advance List";
		}

		$data['from_date'] = $this->input->post('from_date') ?: '';
		$data['to_date'] = $this->input->post('to_date') ?: '';
		$data['empsrch'] = $this->input->post('empsrch') ?: '';
		$data['monthsrch'] = $this->input->post('monthsrch') ?: date('Y-m');

		$data['emp_list'] = $this->Hr_model->get_Active_emp();
		$data['account_list'] = $this->Master_model->get_active_cashacc($data['dept']);
		$data['all_value'] = $this->Hr_model->get_all_advance($data['from_date'], $data['to_date'], $data['empsrch'], $data['monthsrch']);
		$data['edit_value'] = $this->Hr_model->get_edit_advance($data['id']);

		if (!empty($this->input->post('Excel'))) {
			$this->excelForadvance($data['all_value']);
		}

		$this->load->view('h_advance_list', $data);
	}

	public function insert_advance()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->insert_advance()) {

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

	public function delete_advance()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->delete_advance()) {
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

	public function excelForadvance($allreportdata)
	{

		$count = 0;
		$data = array();
		foreach ($allreportdata as $key) {
			$count++;
			$subArray = array();

			$subArray[] = $count;

			$subArray[] = date('d-m-Y', strtotime($key->m_advance_date));
			$subArray[] = $key->m_emp_name;
			$subArray[] = $key->m_emp_mobile;
			$subArray[] = date('F-Y', strtotime($key->m_advance_month));
			$subArray[] = $key->m_advance_amt;
			$subArray[] = $key->m_advance_remarks;

			$data[] = $subArray;
		}

		//  echo "<pre>" ;   print_r($data) ; die ;
		$fileName = 'Advance' . date('Ymdhis') . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$fileName");
		header("Content-Type: application/csv; ");
		$report = $data;
		$file = fopen('php://output', 'w');

		$header = array(
			"Sno.",
			"Date",
			"Emp Name",
			"Emp MObile",
			"Month",
			"Amount",
			"Remarks",


		);
		fputcsv($file, $header);
		foreach ($report as $line) {
			fputcsv($file, $line);
		}
		fclose($file);
		// echo json_encode(array(
		//   'status' => 'success',
		//   'message' => 'Data Export successfully!'
		// ));
		exit;
	}

	//-------------------------- advance ------------------------//

	//-------------------------- salinst ------------------------//
	public function salary_history($pagetype = 1)
	{
		$data = $this->login_details();
		$data['pagetype'] = $pagetype;

		

		$data['month_from'] = $this->input->post('month_from') ?: date('Y-m', strtotime(date('Y-m') . '- 1 month'));
		$data['month_to'] = $this->input->post('month_to') ?: date('Y-m', strtotime(date('Y-m') . '- 1 month'));
		$data['seach_in'] = $this->input->post('seach_in');

		if ($pagetype == 1) {
			$data['pagename'] = "View Salary History";
			$data['all_value'] = $this->Hr_model->get_salary_history($data['month_from'], $data['month_to'], $data['seach_in']);

			if (!empty($this->input->post('Excel'))) {
				$this->excelForsalary($data['all_value']);
			}
		} else if ($pagetype == 2) {
			$data['pagename'] = "Final Salary Sheet";
			$data['all_value'] = $this->Hr_model->get_finalsalary_sheet($data['month_from'], $data['month_to'], $data['seach_in']);

			if (!empty($this->input->post('Excel'))) {
				$this->excelForfinalsalary($data['all_value']);
			}
		}

		// echo "<pre>";	print_r($data['all_value']);
		// 	die;
		$this->load->view('h_salary_history', $data);
	}
	public function add_monthly_salary()
	{
		$data = $this->login_details();
		$data['pagename'] = "Add Monthly Salary";
		$data['m_dept'] = $this->input->post('m_dept');
		$data['emp_list'] = $this->Hr_model->get_Active_emp($data['m_dept']);
		$data['dept_value'] = $this->Hr_model->get_active_dept();
		// $data['all_value'] = $this->Hr_model->get_all_salinst();
		// $data['edit_value'] = $this->Hr_model->get_edit_salinst($data['id']);

		$this->load->view('add_monthly_salary', $data);
	}

	public function insert_salinst()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->insert_salinst()) {

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

	public function delete_salinst()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->delete_salinst()) {
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

	public function get_ledact_detail()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$ledactId = $this->input->post('leadactId');
			$month_from = $this->input->post('month_from');
			$month_to = $this->input->post('month_to');
			$data = $this->Hr_model->get_ledact_detail($ledactId,$month_from,$month_to);
			// print_r($data); die ;
			echo json_encode($data);
		}
	}

	public function excelForsalary($allreportdata)
	{

		$count = 0;
		$data = array();
		foreach ($allreportdata as $key) {
			$count++;
			$subArray = array();

			$subArray[] = $count;
			$subArray[] = $key->m_emp_name;
			$subArray[] = $key->m_dept_name;
			$subArray[] = $key->m_design_name;
			$subArray[] = date('F-Y', strtotime($key->m_sallary_month));
			$subArray[] = $key->m_sallary_amt;
			$subArray[] = $key->m_sallary_perday;
			$subArray[] = $key->m_sallary_pstday;
			$subArray[] = $key->m_sallary_extday;
			$subArray[] = $key->m_sallary_extamt;
			$subArray[] = $key->m_sallary_abstday;
			$subArray[] = $key->m_sallary_abstamt;
			$subArray[] = $key->m_sallary_time;
			$subArray[] = $key->m_sallary_timeamt;
			$subArray[] = $key->m_sallary_advance;
			$subArray[] = $key->m_sallary_payamt;
			$subArray[] = $key->m_sallary_remarks;
			$subArray[] = $key->m_sallary_addedon;

			$data[] = $subArray;
		}

		//  echo "<pre>" ;   print_r($data) ; die ;
		$fileName = 'salaries' . date('Ymdhis') . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$fileName");
		header("Content-Type: application/csv; ");
		$report = $data;
		$file = fopen('php://output', 'w');

		$header = array(
			"Sno.",
			"Emp Name",
			"Department Name",
			"Designation Name",
			"Month",
			"Salary Amount",
			"Per Day Salary",
			"Present Days",
			"Extra days",
			"Extra Amt",
			"Absent days",
			"Absent Amt",
			"Time",
			"Time Amt",
			"Advance",
			"Final Amount",
			"Remarks",
			"Created On",


		);
		fputcsv($file, $header);
		foreach ($report as $line) {
			fputcsv($file, $line);
		}
		fclose($file);
		// echo json_encode(array(
		//   'status' => 'success',
		//   'message' => 'Data Export successfully!'
		// ));
		exit;
	}

	public function excelForfinalsalary($allreportdata)
	{

		$count = 0;
		$data = array();
		foreach ($allreportdata as $key) {
			$count++;
			$subArray = array();

			$subArray[] = $count;
			$subArray[] = $key->m_emp_name;
			$subArray[] = $key->m_emp_accno;
			$subArray[] = $key->finalamt;

			$data[] = $subArray;
		}

		//  echo "<pre>" ;   print_r($data) ; die ;
		$fileName = 'final-salar-sheet' . date('Ymdhis') . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$fileName");
		header("Content-Type: application/csv; ");
		$report = $data;
		$file = fopen('php://output', 'w');

		$header = array(
			"Sno.",
			"Emp Name",
			"Account No",
			"Amount",


		);
		fputcsv($file, $header);
		foreach ($report as $line) {
			fputcsv($file, $line);
		}
		fclose($file);
		// echo json_encode(array(
		//   'status' => 'success',
		//   'message' => 'Data Export successfully!'
		// ));
		exit;
	}
	//-------------------------- salinst ------------------------//


	//-------------------------- incrmt ------------------------//
	public function incrmt_list()
	{
		$data = $this->login_details();
		$data['pagename'] = "Salary Increaments";
		$data['id'] = $this->input->get('id');
		$data['emp_list'] = $this->Hr_model->get_Active_emp();
		$data['design_value'] = $this->Hr_model->get_active_design();
		$data['all_value'] = $this->Hr_model->get_all_incrmt();
		$data['edit_value'] = $this->Hr_model->get_edit_incrmt($data['id']);

		$this->load->view('h_increament_list', $data);
	}

	public function insert_incrmt()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->insert_incrmt()) {

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

	public function delete_incrmt()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Hr_model->delete_incrmt()) {
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
	//-------------------------- incrmt ------------------------//


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
