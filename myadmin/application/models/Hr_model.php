<?php date_default_timezone_set('Asia/Kolkata');
class Hr_model extends CI_model
{


	//========================== dept  =============================//

	public function get_all_dept()
	{
		$this->db->select('*');
		$this->db->order_by('m_dept_name');
		$res = $this->db->get('master_department_tbl')->result();
		return $res;
	}
	public function get_edit_dept($edid)
	{
		$this->db->select('*');
		$this->db->where('m_dept_id', $edid);
		$res = $this->db->get('master_department_tbl')->row();
		return $res;
	}
	public function insert_dept()
	{

		$s_data = array(
			"m_dept_name" => $this->input->post('m_dept_name'),
			"m_dept_code" => $this->input->post('m_dept_code'),
			"m_dept_status" => $this->input->post('m_dept_status'),
			"m_dept_added_on" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_dept_id');
		if (!empty($id)) {
			$this->db->where('m_dept_id', $id)->update('master_department_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_department_tbl', $s_data);
			return 1;
		}
	}


	public function delete_dept()
	{
		$this->db->where('m_dept_id', $this->input->post('delete_id'));
		return $this->db->delete('master_department_tbl');
	}

	public function get_active_dept()
	{
		$this->db->select('dept.m_dept_name,dept.m_dept_id');
		$this->db->where('m_dept_status', '1');
		$this->db->order_by('m_dept_name');
		$res = $this->db->get('master_department_tbl dept')->result();
		return $res;
	}
	//=========================================== dept ===============================================//

	//========================== design  =============================//

	public function get_all_design()
	{
		$this->db->select('*');
		$this->db->order_by('m_design_name');
		$res = $this->db->get('master_designation_tbl')->result();
		return $res;
	}
	public function get_edit_design($edid)
	{
		$this->db->select('*');
		$this->db->where('m_design_id', $edid);
		$res = $this->db->get('master_designation_tbl')->row();
		return $res;
	}
	public function insert_design()
	{

		$s_data = array(
			"m_design_name" => $this->input->post('m_design_name'),
			"m_design_code" => $this->input->post('m_design_code'),
			"m_design_status" => $this->input->post('m_design_status'),
			"m_design_added_on" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_design_id');
		if (!empty($id)) {
			$this->db->where('m_design_id', $id)->update('master_designation_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_designation_tbl', $s_data);
			return 1;
		}
	}


	public function delete_design()
	{
		$this->db->where('m_design_id', $this->input->post('delete_id'));
		return $this->db->delete('master_designation_tbl');
	}

	public function get_active_design()
	{
		$this->db->select('design.m_design_name,design.m_design_id');
		$this->db->where('m_design_status', '1');
		$this->db->order_by('m_design_name');
		$res = $this->db->get('master_designation_tbl design')->result();
		return $res;
	}
	//=========================================== design ===============================================//


	//========================== hq  =============================//

	public function get_all_hq()
	{
		$this->db->select('*');
		$this->db->where('m_hq_type', 1);
		$this->db->order_by('m_hq_name');
		$res = $this->db->get('master_hq_tbl')->result();
		return $res;
	}

	public function get_hq_type($type)
	{
		$this->db->select('*');
		$this->db->where('m_hq_type', $type);
		$this->db->order_by('m_hq_name');
		$res = $this->db->get('master_hq_tbl')->result();
		return $res;
	}

	public function get_active_hq_type($type)
	{
		$this->db->select('*');
		$this->db->where('m_hq_type', $type);
		$this->db->where('m_hq_status', 1);
		$this->db->order_by('m_hq_name');
		$res = $this->db->get('master_hq_tbl')->result();
		return $res;
	}

	public function get_edit_hq($edid)
	{
		$this->db->select('*');
		$this->db->where('m_hq_id', $edid);
		$res = $this->db->get('master_hq_tbl')->row();
		return $res;
	}
	public function insert_hq()
	{

		if (!empty($this->input->post('m_hq_items'))) {
			$items = implode(',', $this->input->post('m_hq_items'));
		} else {
			$items = '';
		};

		$s_data = array(
			"m_hq_name" => $this->input->post('m_hq_name'),
			"m_hq_type" => $this->input->post('m_hq_type'),
			"m_hq_rate" => $this->input->post('m_hq_rate') ?: 0,
			"m_hq_items" => $items,
			"m_hq_remark" => $this->input->post('m_hq_remark'),
			"m_hq_status" => $this->input->post('m_hq_status'),
			"m_hq_added_on" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_hq_id');
		if (!empty($id)) {
			$this->db->where('m_hq_id', $id)->update('master_hq_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_hq_tbl', $s_data);
			return 1;
		}
	}


	public function delete_hq()
	{
		$this->db->where('m_hq_id', $this->input->post('delete_id'));
		return $this->db->delete('master_hq_tbl');
	}

	public function get_active_hq()
	{
		$this->db->select('hq.m_hq_name,hq.m_hq_id');
		$this->db->where('m_hq_status', '1');
		$this->db->where('m_hq_type', 1);
		$this->db->order_by('m_hq_name');
		$res = $this->db->get('master_hq_tbl hq')->result();
		return $res;
	}
	//=========================================== hq ===============================================//


	//========================== nh  =============================//

	public function get_all_nh()
	{
		$this->db->select('*');
		$res = $this->db->get('master_nh_tbl')->result();
		return $res;
	}
	public function get_edit_nh($edid)
	{
		$this->db->select('*');
		$this->db->where('m_nh_id', $edid);
		$res = $this->db->get('master_nh_tbl')->row();
		return $res;
	}
	public function insert_nh()
	{

		$s_data = array(
			"m_nh_name" => $this->input->post('m_nh_name'),
			"m_nh_dayid" => $this->input->post('m_nh_dayid'),
			"m_nh_monthid" => $this->input->post('m_nh_monthid'),
			"m_nh_yearid" => $this->input->post('m_nh_yearid'),
			"m_nh_status" => $this->input->post('m_nh_status'),
			"m_nh_added_on" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_nh_id');
		if (!empty($id)) {
			$this->db->where('m_nh_id', $id)->update('master_nh_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_nh_tbl', $s_data);
			return 1;
		}
	}


	public function delete_nh()
	{
		$this->db->where('m_nh_id', $this->input->post('delete_id'));
		return $this->db->delete('master_nh_tbl');
	}

	public function get_active_nh()
	{
		$this->db->select('nh.m_nh_name,nh.m_nh_id');
		$this->db->where('m_nh_status', '1');
		$res = $this->db->get('master_nh_tbl nh')->result();
		return $res;
	}
	//=========================================== nh ===============================================//


	//=======================================================employee=================================================//

	public function get_emp_list($from_date, $to_date, $status = 'o')
	{

		if (!empty($from_date)) {
			$this->db->where('DATE_FORMAT(emplist.m_emp_added_on,"%Y-%m-%d")>=', $from_date);
		}
		if (!empty($to_date)) {
			$this->db->where('DATE_FORMAT(emplist.m_emp_added_on,"%Y-%m-%d")<=', $to_date);
		}
		if ($status == 'o') {
			$this->db->where("emplist.is_out_of_job", 0);
		} else {
			$this->db->where("emplist.is_out_of_job", 1);
		}
		$this->db->select('emplist.*,m_dept_name,m_design_name,m_company_name,boss.m_emp_name as boss_name');
		$this->db->join('master_employee_tbl boss', 'boss.m_emp_id = emplist.m_emp_boss', 'left');
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = emplist.m_emp_dept', 'left');
		$this->db->join('master_designation_tbl', 'master_designation_tbl.m_design_id = emplist.m_emp_design', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = emplist.m_emp_company', 'left');
		$res = $this->db->get('master_employee_tbl emplist')->result();
		return $res;
	}

	public function get_Active_emp($dept = '', $leadact = '')
	{
		if (!empty($dept)) {
			$this->db->where('m_emp_dept', $dept);
		}
		if (!empty($leadact)) {
			$this->db->where('m_emp_leadact', 1);
		}
		$res = $this->db->select('m_emp_name,m_emp_mobile,m_emp_code,m_emp_id,m_emp_salary,m_emp_gross_salary,m_emp_design,m_emp_dept,m_dept_name,m_design_name')->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_employee_tbl.m_emp_dept', 'left')->join('master_designation_tbl', 'master_designation_tbl.m_design_id = master_employee_tbl.m_emp_design', 'left')->where('is_out_of_job', 0)->get('master_employee_tbl')->result();
		return $res;
	}

	public function get_emp_design_list($design)
	{
		$res = $this->db->select('m_emp_name,m_emp_mobile,m_emp_code,m_emp_id')->where_in('m_emp_design', $design)->where('is_out_of_job', 0)->get('master_employee_tbl')->result();
		return $res;
	}

	// public function get_credit_emp()
	// {
	// 	$res = $this->db->where('m_emp_status', 1)->where('m_emp_type', 1)->get('master_employee_tbl')->result();
	// 	return $res;
	// }

	public function get_emp_dtl($id)
	{
		$this->db->select('*');
		$this->db->where('m_emp_id', $id);
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_employee_tbl.m_emp_dept', 'left');
		$this->db->join('master_designation_tbl', 'master_designation_tbl.m_design_id = master_employee_tbl.m_emp_design', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_employee_tbl.m_emp_company', 'left');
		$res = $this->db->get('master_employee_tbl')->row();

		return $res;
	}

	public function insert_emp()
	{

		$emp_id = $this->input->post('m_emp_id');

		if ($this->input->post('is_esic_applicable')) {
			$is_esic_applicable = 1;
		} else {
			$is_esic_applicable = 0;
		}
		if ($this->input->post('is_tds_applicable')) {
			$is_tds_applicable = 1;
		} else {
			$is_tds_applicable = 0;
		}
		if ($this->input->post('is_out_of_job')) {
			$is_out_of_job = 1;
		} else {
			$is_out_of_job = 0;
		}

		if ($this->input->post('is_epf_applicable')) {
			$is_epf_applicable = 1;
		} else {
			$is_epf_applicable = 0;
		}
		if ($this->input->post('m_emp_leadact')) {
			$m_emp_leadact = 1;
		} else {
			$m_emp_leadact = 0;
		}


		$data = array(

			"m_emp_code" => 		$this->input->post('m_emp_code'),
			"m_emp_name" => 		$this->input->post('m_emp_name'),
			"m_emp_fhname" => 		$this->input->post('m_emp_fhname'),
			"m_emp_doj" => 			$this->input->post('m_emp_doj'),
			"m_emp_dob" => 			$this->input->post('m_emp_dob'),
			"m_emp_mobile" => 		$this->input->post('m_emp_mobile'),
			"m_emp_company" => 		$this->input->post('m_emp_company'),
			"m_emp_dept" => 		$this->input->post('m_emp_dept'),
			"m_emp_design" => 		$this->input->post('m_emp_design'),
			"m_emp_hq" => 			$this->input->post('m_emp_hq') ?: '',
			"m_emp_altmobile" =>	$this->input->post('m_emp_altmobile'),
			"m_emp_email" => 		$this->input->post('m_emp_email') ?: '',
			"m_emp_altemail" => 	$this->input->post('m_emp_altemail') ?: '',
			"m_emp_bg" => 			$this->input->post('m_emp_bg'),
			"m_emp_dshift" => 		$this->input->post('m_emp_dshift'),
			"m_emp_dtype" => 		$this->input->post('m_emp_dtype'),
			"m_emp_rest" => 		$this->input->post('m_emp_rest'),
			"m_emp_ottype" => 		$this->input->post('m_emp_ottype'),
			"m_emp_boss" => 		$this->input->post('m_emp_boss') ?: '',
			"m_emp_salary" => 		$this->input->post('m_emp_salary') ?: '',
			"m_emp_cca" => 			$this->input->post('m_emp_cca') ?: '',
			"m_emp_medic_allow" =>	$this->input->post('m_emp_medic_allow') ?: '',
			"m_emp_ta" => 			$this->input->post('m_emp_ta') ?: '',
			"m_emp_spl_allow" => 	$this->input->post('m_emp_spl_allow') ?: '',
			"m_emp_medicliam_ded" => $this->input->post('m_emp_medicliam_ded') ?: '',
			"m_emp_hra" => 			$this->input->post('m_emp_hra') ?: '',
			"m_emp_educ_allow" => 	$this->input->post('m_emp_educ_allow') ?: '',
			"m_emp_gross_salary" => $this->input->post('m_emp_gross_salary') ?: '',
			"m_emp_epfno" => 		$this->input->post('m_emp_epfno') ?: '',
			"m_emp_esicno" => 		$this->input->post('m_emp_esicno') ?: '',
			"m_emp_accno" => 		$this->input->post('m_emp_accno') ?: '',
			"m_emp_panno" => 		$this->input->post('m_emp_panno') ?: '',
			"m_emp_uanno" => 		$this->input->post('m_emp_uanno') ?: '',
			"m_emp_bankname" => 	$this->input->post('m_emp_bankname') ?: '',
			"m_emp_bankbranch" => 	$this->input->post('m_emp_bankbranch') ?: '',
			"m_emp_adharno" => 		$this->input->post('m_emp_adharno') ?: '',
			"m_emp_ifsc" => 		$this->input->post('m_emp_ifsc') ?: '',
			"m_emp_prev_empr" => 	$this->input->post('m_emp_prev_empr') ?: '',
			"m_emp_prev_dept" => 	$this->input->post('m_emp_prev_dept') ?: '',
			"m_emp_prev_design" => 	$this->input->post('m_emp_prev_design') ?: '',
			"m_emp_prev_duration" => $this->input->post('m_emp_prev_duration') ?: '',
			"m_emp_laddress" => 	$this->input->post('m_emp_laddress') ?: '',
			"m_emp_paddress" => 	$this->input->post('m_emp_paddress') ?: '',
			"m_emp_password" => 	$this->input->post('m_emp_password') ?: '',
			"m_emp_login_type" => 	$this->input->post('m_emp_login_type') ?: '',
			"m_emp_qualification" => $this->input->post('m_emp_qualification') ?: '',
			"m_emp_dol" => 			$this->input->post('m_emp_dol') ?: '',
			"m_emp_salmode" => 			$this->input->post('m_emp_salmode') ?: '',
			"m_emp_leadact" => 			$m_emp_leadact,
			"is_esic_applicable" => $is_esic_applicable,
			"is_tds_applicable" => 	$is_tds_applicable,
			"is_out_of_job" => 		$is_out_of_job,
			"is_epf_applicable" => 	$is_epf_applicable,

		);

		if (!empty($emp_id)) {
			// $emp_detail = $this->db->where('m_emp_id', $emp_id)->get('master_employee_tbl')->row();

			// $data["m_emp_salary"] = 		$this->input->post('m_emp_salary') ?: $emp_detail->m_emp_salary;
			// $data["m_emp_cca"] = 			$this->input->post('m_emp_cca') ?: $emp_detail->m_emp_cca;
			// $data["m_emp_medic_allow"] =	$this->input->post('m_emp_medic_allow') ?: $emp_detail->m_emp_medic_allow;
			// $data["m_emp_ta"] = 			$this->input->post('m_emp_ta') ?: $emp_detail->m_emp_ta;
			// $data["m_emp_spl_allow"] = 	$this->input->post('m_emp_spl_allow') ?: $emp_detail->m_emp_spl_allow;
			// $data["m_emp_medicliam_ded"] = $this->input->post('m_emp_medicliam_ded') ?: $emp_detail->m_emp_medicliam_ded;
			// $data["m_emp_hra"] = 			$this->input->post('m_emp_hra') ?: $emp_detail->m_emp_hra;
			// $data["m_emp_educ_allow"] = 	$this->input->post('m_emp_educ_allow') ?: $emp_detail->m_emp_educ_allow;
			// $data["m_emp_gross_salary"] = $this->input->post('m_emp_gross_salary') ?: $emp_detail->m_emp_gross_salary;
			// $data["m_emp_epfno"] = 		$this->input->post('m_emp_epfno') ?: $emp_detail->m_emp_epfno;
			// $data["m_emp_esicno"] = 		$this->input->post('m_emp_esicno') ?: $emp_detail->m_emp_esicno;
			// $data["m_emp_accno"] = 		$this->input->post('m_emp_accno') ?: $emp_detail->m_emp_accno;
			// $data["m_emp_panno"] = 		$this->input->post('m_emp_panno') ?: $emp_detail->m_emp_panno;
			// $data["m_emp_uanno"] = 		$this->input->post('m_emp_uanno') ?: $emp_detail->m_emp_uanno;
			// $data["m_emp_bankname"] = 	$this->input->post('m_emp_bankname') ?: $emp_detail->m_emp_bankname;
			// $data["m_emp_bankbranch"] = 	$this->input->post('m_emp_bankbranch') ?: $emp_detail->m_emp_bankbranch;
			// $data["m_emp_adharno"] = 		$this->input->post('m_emp_adharno') ?: $emp_detail->m_emp_adharno;
			// $data["m_emp_ifsc"] = 		$this->input->post('m_emp_ifsc') ?: $emp_detail->m_emp_ifsc;
			// $data["m_emp_prev_empr"] = 	$this->input->post('m_emp_prev_empr') ?: $emp_detail->m_emp_prev_empr;
			// $data["m_emp_prev_dept"] = 	$this->input->post('m_emp_prev_dept') ?: $emp_detail->m_emp_prev_dept;
			// $data["m_emp_prev_design"] = 	$this->input->post('m_emp_prev_design') ?: $emp_detail->m_emp_prev_design;
			// $data["m_emp_prev_duration"] = $this->input->post('m_emp_prev_duration') ?: $emp_detail->m_emp_prev_duration;
			// $data["m_emp_laddress"] = 	$this->input->post('m_emp_laddress') ?: $emp_detail->m_emp_laddress;
			// $data["m_emp_paddress"] = 	$this->input->post('m_emp_paddress') ?: $emp_detail->m_emp_paddress;
			// $data["m_emp_password"] = 	$this->input->post('m_emp_password') ?: $emp_detail->m_emp_password;
			// $data["m_emp_login_type"] = 	$this->input->post('m_emp_login_type') ?: $emp_detail->m_emp_login_type;
			// $data["m_emp_qualification"] = $this->input->post('m_emp_qualification') ?: $emp_detail->m_emp_qualification;
			// $data["m_emp_dol"] = 			$this->input->post('m_emp_dol') ?: $emp_detail->m_emp_dol;
			// $data["m_emp_salmode"] = 			$this->input->post('m_emp_salmode') ?: $emp_detail->m_emp_salmode;

			$this->db->where('m_emp_id', $emp_id)->update('master_employee_tbl', $data);
			return 2;
		} else {
			$data['m_emp_added_on'] = date('Y-m-d H:i:s');
			$this->db->insert('master_employee_tbl', $data);
			return 1;
		}
	}

	public function delete_emp()
	{
		$this->db->where('m_emp_id', $this->input->post('delete_id'));
		$this->db->delete('master_employee_tbl');
		return true;
	}
	//=======================================================employee=================================================//


	//========================== advance  =============================//

	public function get_all_advance($from_date, $to_date, $empsrch, $monthsrch)
	{

		if (!empty($from_date)) {
			$this->db->where('DATE_FORMAT(m_advance_date,"%Y-%m-%d")>=', $from_date);
		}
		if (!empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_advance_date,"%Y-%m-%d")<=', $to_date);
		}
		if (!empty($empsrch)) {
			$this->db->where('m_advance_empid', $empsrch);
		}
		if (!empty($monthsrch)) {
			$this->db->where('m_advance_month', $monthsrch);
		}

		$this->db->select('master_advance_tbl.*,m_emp_code,m_emp_name,m_emp_mobile,m_cashacc_name');
		$this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id= master_advance_tbl.m_advance_empid', 'left');
		$this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = master_advance_tbl.m_advance_acct', 'left');
		return $this->db->get('master_advance_tbl')->result();
	}
	public function get_edit_advance($edid)
	{
		$this->db->select('master_advance_tbl.*,m_emp_code,m_emp_name,m_emp_mobile,m_emp_company,m_company_name,m_design_name,m_dept_name,m_emp_hq,m_emp_doj,m_emp_gross_salary,m_cashacc_name');
		$this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id= master_advance_tbl.m_advance_empid', 'left');
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_employee_tbl.m_emp_dept', 'left');
		$this->db->join('master_designation_tbl', 'master_designation_tbl.m_design_id = master_employee_tbl.m_emp_design', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_employee_tbl.m_emp_company', 'left');
		$this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = master_advance_tbl.m_advance_acct', 'left');
		$this->db->where('m_advance_id', $edid);
		$res = $this->db->get('master_advance_tbl')->row();
		return $res;
	}
	public function insert_advance()
	{

		$s_data = array(
			// "m_advance_type" => $this->input->post('m_advance_type'),
			"m_advance_empid" => $this->input->post('m_advance_empid'),

			"m_advance_amt" => $this->input->post('m_advance_amt'),
			"m_advance_remarks" => $this->input->post('m_advance_remarks'),
			"m_advance_acct" => $this->input->post('m_advance_acct') ?: 2,

		);
		$id = $this->input->post('m_advance_id');
		if (!empty($id)) {
			$s_data['m_advance_month'] = $this->input->post('m_advance_month');
			$s_data['m_advance_date'] = $this->input->post('m_advance_date');
			$s_data['m_advance_updatedby'] = $this->session->userdata('user_id');
			$s_data['m_advance_updatedon'] = date('Y-m-d H:i');
			$this->db->where('m_advance_id', $id)->update('master_advance_tbl', $s_data);
			return 2;
		} else {
			$s_data['m_advance_month'] = date('Y-m');
			$s_data['m_advance_date'] = date('Y-m-d');
			$s_data['m_advance_status'] = 1;
			$s_data['m_advance_addedby'] = $this->session->userdata('user_id');
			$s_data['m_advance_addedon'] = date('Y-m-d H:i');
			$this->db->insert('master_advance_tbl', $s_data);
			return 1;
		}
	}


	public function delete_advance()
	{
		$this->db->where('m_advance_id', $this->input->post('delete_id'));
		return $this->db->delete('master_advance_tbl');
	}

	public function check_emp_history($emp_id)
	{

		$res = $this->db->where('m_advance_month', date('Y-m'))->where('m_advance_empid', $emp_id)->order_by('m_advance_id', 'desc')->get('master_advance_tbl')->result();
		return $res;
	}

	public function get_emp_advance($emp_id, $month)
	{
		$res = $this->db->where('m_advance_month', $month)->where('m_advance_empid', $emp_id)->order_by('m_advance_id', 'desc')->get('master_advance_tbl')->result();
		return $res;
	}

	//=========================================== advance ===============================================//
	//========================== salinst  =============================//

	public function get_finalsalary_sheet($month_from = '', $month_to = '', $dept = '', $seach_in = '')
	{

		$leadact = $this->db->select("m_emp_id,m_emp_name,m_emp_mobile,m_emp_accno")->where('m_emp_leadact', 1)->where('is_out_of_job', 0)->get('master_employee_tbl')->result();
		$result = array();

		if (!empty($leadact)) {
			foreach ($leadact as $key) {
				if (!empty($month_from)) {
					$this->db->where('m_sallary_month >=', $month_from);
				}
				if (!empty($month_to)) {
					$this->db->where('m_sallary_month <=', $month_to);
				}
				if (!empty($dept)) {
					$this->db->where('m_emp_dept', $dept);
				}
				if (!empty($seach_in)) {
					$wh = "(m_emp_name LIKE '%$seach_in%' OR m_emp_mobile LIKE '%$seach_in%' OR m_emp_code LIKE '%$seach_in%')";
					$this->db->where($wh);
				}

				$salamt = $this->db->select('sum(m_sallary_payamt) as finalamt')
					->join('master_employee_tbl', 'master_employee_tbl.m_emp_id= master_salaryinst_tbl.m_sallary_empid')
					->where('m_sallary_status', 0)
					->where("(m_emp_boss = $key->m_emp_id OR m_emp_id = $key->m_emp_id)")
					->get('master_salaryinst_tbl')->result();

				$res = (object) array(
					"m_emp_id" => $key->m_emp_id,
					"m_emp_name" => $key->m_emp_name,
					"m_emp_mobile" => $key->m_emp_mobile,
					"m_emp_accno" => $key->m_emp_accno,
					"finalamt" => $salamt[0]->finalamt,
				);
				$result[] = $res;
			}
		}

		return $result;
	}

	public function get_ledact_detail($ledact_id,$month_from = '', $month_to = '')
	{

		if (!empty($month_from)) {
			$this->db->where('m_sallary_month >=', $month_from);
		}
		if (!empty($month_to)) {
			$this->db->where('m_sallary_month <=', $month_to);
		}

		$salamt = $this->db->select('master_salaryinst_tbl.*,master_employee_tbl.m_emp_code,master_employee_tbl.m_emp_name,m_design_name,m_dept_name')
			->join('master_employee_tbl', 'master_employee_tbl.m_emp_id= master_salaryinst_tbl.m_sallary_empid', 'left')
			->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_employee_tbl.m_emp_dept', 'left')
			->join('master_designation_tbl', 'master_designation_tbl.m_design_id = master_employee_tbl.m_emp_design', 'left')
			->where('m_sallary_status', 0)
			->where("(m_emp_boss = $ledact_id OR m_emp_id = $ledact_id)")
			->get('master_salaryinst_tbl')->result();

		return $salamt;
	}

	public function get_salary_history($month_from = '', $month_to = '', $dept = '', $seach_in = '')
	{
		if (!empty($month_from)) {
			$this->db->where('m_sallary_month >=', $month_from);
		}
		if (!empty($month_to)) {
			$this->db->where('m_sallary_month <=', $month_to);
		}
		if (!empty($dept)) {
			$this->db->where('m_emp_dept', $dept);
		}

		if (!empty($seach_in)) {
			$wh = "(m_emp_name LIKE '%$seach_in%' OR m_emp_mobile LIKE '%$seach_in%' OR m_emp_code LIKE '%$seach_in%')";
			$this->db->where($wh);
		}

		$this->db->select('master_salaryinst_tbl.*,master_employee_tbl.m_emp_code,master_employee_tbl.m_emp_name,m_design_name,m_dept_name');
		$this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id= master_salaryinst_tbl.m_sallary_empid', 'left');
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_employee_tbl.m_emp_dept', 'left');
		$this->db->join('master_designation_tbl', 'master_designation_tbl.m_design_id = master_employee_tbl.m_emp_design', 'left');
		return $this->db->where('m_sallary_status', 0)->get('master_salaryinst_tbl')->result();
	}

	public function get_edit_salinst($edid)
	{
		$this->db->select('master_salaryinst_tbl.*,m_emp_code,m_emp_name,m_emp_company,m_company_name,m_design_name,m_dept_name,m_emp_hq,m_emp_doj,m_emp_gross_salary');
		$this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id= master_salaryinst_tbl.m_sallary_empid', 'left');
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_employee_tbl.m_emp_dept', 'left');
		$this->db->join('master_designation_tbl', 'master_designation_tbl.m_design_id = master_employee_tbl.m_emp_design', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_employee_tbl.m_emp_company', 'left');
		$this->db->where('m_sallary_id', $edid);
		$res = $this->db->get('master_salaryinst_tbl')->row();
		return $res;
	}
	public function insert_salinst()
	{

		$m_sallary_month = $this->input->post('m_sallary_month');
		$m_sallary_empid = $this->input->post('m_sallary_empid');
		$m_sallary_amt = $this->input->post('m_sallary_amt');
		$m_sallary_perday = $this->input->post('m_sallary_perday');
		$m_sallary_pstday = $this->input->post('m_sallary_pstday');
		$m_sallary_extday = $this->input->post('m_sallary_extday');
		$m_sallary_extamt = $this->input->post('m_sallary_extamt');
		$m_sallary_abstday = $this->input->post('m_sallary_abstday');
		$m_sallary_abstamt = $this->input->post('m_sallary_abstamt');
		$m_sallary_time = $this->input->post('m_sallary_time');
		$m_sallary_timeamt = $this->input->post('m_sallary_timeamt');
		$m_sallary_advance = $this->input->post('m_sallary_advance');
		$m_sallary_payamt = $this->input->post('m_sallary_payamt');
		$m_sallary_remarks = $this->input->post('m_sallary_remarks');
		$m_sallary_id = $this->input->post('m_sallary_id');

		foreach ($m_sallary_empid as $cou => $key) {

			$s_data = array(
				"m_sallary_month" => $m_sallary_month,
				"m_sallary_empid" => $key,
				"m_sallary_amt" => $m_sallary_amt[$cou],
				"m_sallary_perday" => $m_sallary_perday[$cou],
				"m_sallary_pstday" => $m_sallary_pstday[$cou],
				"m_sallary_extday" => $m_sallary_extday[$cou],
				"m_sallary_extamt" => $m_sallary_extamt[$cou],
				"m_sallary_abstday" => $m_sallary_abstday[$cou],
				"m_sallary_abstamt" => $m_sallary_abstamt[$cou],
				"m_sallary_time" => $m_sallary_time[$cou],
				"m_sallary_timeamt" => $m_sallary_timeamt[$cou],
				"m_sallary_advance" => $m_sallary_advance[$cou],
				"m_sallary_payamt" => $m_sallary_payamt[$cou],
				"m_sallary_remarks" => $m_sallary_remarks[$cou],
			);


			if (!empty($m_sallary_id[$cou])) {
				$s_data['m_sallary_updatedby'] = $this->session->userdata('user_id');
				$s_data['m_sallary_updatedon'] = date('Y-m-d H:i');
				$this->db->where('m_sallary_id', $m_sallary_id[$cou])->update('master_salaryinst_tbl', $s_data);
				$res = 2;
			} else {
				$check = $this->db->select('m_sallary_id')->where('m_sallary_month', $m_sallary_month)->where('m_sallary_empid', $key)->get('master_salaryinst_tbl')->row();
				if (!empty($check)) {
					$s_data['m_sallary_updatedby'] = $this->session->userdata('user_id');
					$s_data['m_sallary_updatedon'] = date('Y-m-d H:i');
					$this->db->where('m_sallary_id', $check->m_sallary_id)->update('master_salaryinst_tbl', $s_data);
					$res = 2;
				} else {
					$s_data['m_sallary_addedby'] = $this->session->userdata('user_id');
					$s_data['m_sallary_addedon'] = date('Y-m-d H:i');
					$this->db->insert('master_salaryinst_tbl', $s_data);
					$res = 1;
				}
			}
		}
		return $res;
	}


	public function delete_salinst()
	{
		$this->db->where('m_sallary_id', $this->input->post('delete_id'));
		return $this->db->delete('master_salaryinst_tbl');
	}


	//=========================================== salinst ===============================================//


	//========================== incrmt  =============================//

	public function get_all_incrmt()
	{
		$this->db->select('master_increaments_tbl.*,master_employee_tbl.m_emp_code,master_employee_tbl.m_emp_name');
		$this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id= master_increaments_tbl.m_incrmt_empid', 'left');
		$res = $this->db->get('master_increaments_tbl')->result();
		return $res;
	}
	public function get_edit_incrmt($edid)
	{
		$this->db->select('master_increaments_tbl.*,m_emp_code,m_emp_name,m_emp_company,m_company_name,m_design_name,m_dept_name,m_emp_hq,m_emp_doj,m_emp_salary,m_emp_ta,m_emp_hra,m_emp_cca,m_emp_design,m_emp_spl_allow,m_emp_educ_allow,m_emp_medic_allow,m_emp_gross_salary');
		$this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id= master_increaments_tbl.m_incrmt_empid', 'left');
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_employee_tbl.m_emp_dept', 'left');
		$this->db->join('master_designation_tbl', 'master_designation_tbl.m_design_id = master_employee_tbl.m_emp_design', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_employee_tbl.m_emp_company', 'left');
		$this->db->where('m_incrmt_id', $edid);
		$res = $this->db->get('master_increaments_tbl')->row();
		return $res;
	}
	public function insert_incrmt()
	{

		if (!empty($this->input->post('arias_from_month'))) {
			$arias_from_month = 1;
		} else {
			$arias_from_month = 2;
		}

		$s_data = array(
			"m_incrmt_vouno" => $this->input->post('m_incrmt_vouno'),
			"m_incrmt_voudate" => $this->input->post('m_incrmt_voudate'),
			"m_incrmt_empid" => $this->input->post('m_incrmt_empid'),
			"m_incrmt_strdate" => $this->input->post('m_incrmt_strdate'),
			"m_incrmt_amt" => $this->input->post('m_incrmt_amt'),
			"is_arias_from_month" => $arias_from_month,
			"m_incrmt_ariasdate" => $this->input->post('m_incrmt_ariasdate'),
			"m_incrmt_design" => $this->input->post('m_incrmt_design'),
			"m_old_designation" => $this->input->post('m_old_designation'),
			"m_old_gross" => $this->input->post('m_old_gross'),
			"m_new_gross" => $this->input->post('m_emp_gross_salary'),
			"m_incrmt_remarks" => $this->input->post('m_incrmt_remarks'),
			"m_incrmt_addedon" => date('Y-m-d H:i'),
		);


		$emp_data = array(
			"m_emp_salary" => $this->input->post('m_emp_salary'),
			"m_emp_ta" => $this->input->post('m_emp_ta'),
			"m_emp_hra" => $this->input->post('m_emp_hra'),
			"m_emp_cca" => $this->input->post('m_emp_cca'),
			"m_emp_spl_allow" => $this->input->post('m_emp_spl_allow'),
			"m_emp_educ_allow" => $this->input->post('m_emp_educ_allow'),
			"m_emp_medic_allow" => $this->input->post('m_emp_medic_allow'),
			"m_emp_gross_salary" => $this->input->post('m_emp_gross_salary'),
		);
		$this->db->where('m_emp_id', $this->input->post('m_incrmt_empid'))->update('master_employee_tbl', $emp_data);

		$id = $this->input->post('m_incrmt_id');
		if (!empty($id)) {
			$this->db->where('m_incrmt_id', $id)->update('master_increaments_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_increaments_tbl', $s_data);
			return 1;
		}
	}


	public function delete_incrmt()
	{
		$this->db->where('m_incrmt_id', $this->input->post('delete_id'));
		return $this->db->delete('master_increaments_tbl');
	}

	public function get_active_incrmt()
	{
		$this->db->where('m_incrmt_status', '1');
		$res = $this->db->get('master_increaments_tbl incrmt')->result();
		return $res;
	}
	//=========================================== incrmt ===============================================//



	//========================== leadst  =============================//

	public function get_all_leadsource()
	{
		$this->db->select('*');
		$res = $this->db->where('m_leadst_type', 1)->get('master_leadsource_tbl')->result();
		return $res;
	}

	public function get_all_leadtype()
	{
		$this->db->select('*');
		$res = $this->db->where('m_leadst_type', 2)->get('master_leadsource_tbl')->result();
		return $res;
	}

	public function get_all_leadstatus()
	{
		$this->db->select('*');
		$res = $this->db->where('m_leadst_type', 3)->get('master_leadsource_tbl')->result();
		return $res;
	}

	public function get_edit_leadst($edid)
	{
		$this->db->select('*');
		$this->db->where('m_leadst_id', $edid);
		$res = $this->db->get('master_leadsource_tbl')->row();
		return $res;
	}
	public function insert_leadst()
	{

		$s_data = array(
			"m_leadst_name" => $this->input->post('m_leadst_name'),
			"m_leadst_type" => $this->input->post('m_leadst_type'),
			"m_leadst_status" => $this->input->post('m_leadst_status'),
			"m_leadst_added_on" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_leadst_id');
		if (!empty($id)) {
			$this->db->where('m_leadst_id', $id)->update('master_leadsource_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_leadsource_tbl', $s_data);
			return 1;
		}
	}


	public function delete_leadst()
	{
		$this->db->where('m_leadst_id', $this->input->post('delete_id'));
		return $this->db->delete('master_leadsource_tbl');
	}


	//=========================================== leadst ===============================================//


	//======================================================= lclient =================================================//

	public function get_leadclient_list($from_date, $to_date)
	{
		$this->db->select('master_leadclient_tbl.*,master_city_tbl.m_city_name,source.m_leadst_name as m_leadsource_name,type.m_leadst_name as m_leadtype_name');
		$this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_leadclient_tbl.m_lclient_city', 'left');
		$this->db->join('master_leadsource_tbl source', 'source.m_leadst_id = master_leadclient_tbl.m_lclient_src', 'left');
		$this->db->join('master_leadsource_tbl type', 'type.m_leadst_id = master_leadclient_tbl.m_lclient_type', 'left');
		if (!empty($from_date) && !empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_lclient_added_on,"%Y-%m-%d")>=', $from_date);
			$this->db->where('DATE_FORMAT(m_lclient_added_on,"%Y-%m-%d")<=', $to_date);
		}
		$res = $this->db->order_by('m_lclient_id', 'desc')->get('master_leadclient_tbl')->result();
		return $res;
	}


	public function get_Active_lclient()
	{
		$res = $this->db->where('m_lclient_status', 1)->get('master_leadclient_tbl')->result();
		return $res;
	}


	public function get_leadclient_dtl($id)
	{
		$this->db->select('*');
		$this->db->where('m_lclient_id', $id);
		$this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_leadclient_tbl.m_lclient_city', 'left');
		$res = $this->db->get('master_leadclient_tbl')->row();

		return $res;
	}

	public function get_lclientperson_dtl($id)
	{
		$this->db->select('*');
		$this->db->where('lc_person_id', $id);
		return $this->db->get('client_persondtl_tbl')->row();
	}

	public function get_lclientperson_list($id)
	{
		$this->db->select('*');
		$this->db->where('lc_person_clientid', $id);
		return $this->db->get('client_persondtl_tbl')->result();
	}

	public function get_lclientmem_count($id)
	{
		$this->db->where('p_member_lclientid', $id);
		return $this->db->get('client_persondtl_tbl')->num_rows();
	}

	public function insert_leadclient()
	{

		$lclientid = $this->input->post('m_lclient_id');

		$data = array(

			"m_lclient_src" => $this->input->post('m_lclient_src'),
			"m_lclient_type" => $this->input->post('m_lclient_type'),
			"m_lclient_name" => $this->input->post('m_lclient_name'),
			"m_lclient_village" => $this->input->post('m_lclient_village'),
			"m_lclient_city" => $this->input->post('m_lclient_city'),
			"m_lclient_potential" => $this->input->post('m_lclient_potential'),
			"m_lclient_address" => $this->input->post('m_lclient_address'),
			"m_lclient_remark" => $this->input->post('m_lclient_remark'),
			"m_lclient_status" => 1,

		);

		if (!empty($lclientid)) {
			$this->db->where('m_lclient_id', $lclientid)->update('master_leadclient_tbl', $data);
			$lclient_id = $lclientid;
			// return 2;
		} else {
			$data['m_lclient_added_on'] = date('Y-m-d H:i:s');
			$this->db->insert('master_leadclient_tbl', $data);
			$lclient_id = $this->db->insert_id();

			// return 1;
		}

		$member_id = $this->input->post('lc_person_id');
		$person_name = $this->input->post('lc_person_name');
		$person_mobileno = $this->input->post('lc_person_mobileno');
		$person_email = $this->input->post('lc_person_email');
		$person_dept = $this->input->post('lc_person_dept');


		for ($i = 0; $i < count($person_name); $i++) {

			if ($person_name[$i] != '') {
				$memdata = array(
					"lc_person_clientid" => $lclient_id,
					"lc_person_name" => $person_name[$i],
					"lc_person_mobileno" => $person_mobileno[$i],
					"lc_person_email" => $person_email[$i],
					"lc_person_dept" => $person_dept[$i],
					"lc_person_status" => 1,

				);
				if ($member_id[$i] != '') {
					$this->db->where('lc_person_id', $member_id[$i])->update('client_persondtl_tbl', $memdata);
					$res = 2;
				} else {
					$data['lc_person_addedon'] = date('Y-m-d H:i');
					$this->db->insert('client_persondtl_tbl', $memdata);
					// $lclient_id = $this->db->insert_id();

					$res = 1;
				}
				// $this->db->insert('client_persondtl_tbl', $memdata);
			}
		}
		return $res;
	}

	public function delete_lclient()
	{

		$this->db->where('m_lclient_id', $this->input->post('delete_id'));
		$this->db->delete('master_leadclient_tbl');

		$this->db->where('p_member_lclientid', $this->input->post('delete_id'));
		$this->db->delete('client_persondtl_tbl');

		return true;
	}

	public function get_client_dtl($id)
	{
		$this->db->select('master_leadclient_tbl.*,master_city_tbl.m_city_name,source.m_leadst_name as m_leadsource_name,type.m_leadst_name as m_leadtype_name');
		$this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_leadclient_tbl.m_lclient_city', 'left');
		$this->db->join('master_leadsource_tbl source', 'source.m_leadst_id = master_leadclient_tbl.m_lclient_src', 'left');
		$this->db->join('master_leadsource_tbl type', 'type.m_leadst_id = master_leadclient_tbl.m_lclient_type', 'left');
		$res = $this->db->where('m_lclient_id', $id)->get('master_leadclient_tbl')->row();

		$data = array(
			"m_lclient_id" => $res->m_lclient_id,
			"m_lclient_src" => $res->m_leadsource_name,
			"m_lclient_type" => $res->m_leadtype_name,
			"m_lclient_name" => $res->m_lclient_name,
			"m_lclient_village" => $res->m_lclient_village,
			"m_lclient_city" => $res->m_city_name,
			"m_lclient_potential" => $res->m_lclient_potential,
			"m_lclient_address" => $res->m_lclient_address,
			"m_lclient_remark" => $res->m_lclient_remark,
			"m_lclient_added_on" => date('d-m-Y', strtotime($res->m_lclient_added_on)),
			"Contact_persons" => $this->get_lclientperson_list($res->m_lclient_id),
		);

		return $data;
	}

	//=======================================================lclient=================================================//



	//======================================================= lead =================================================//

	public function get_lead_group($from_date, $to_date, $clientsearch, $planserach, $statussearch)
	{

		$result = array();
		$this->db->select('max(m_lead_id) as m_lead_id');
		if (!empty($from_date)) {
			$this->db->where('DATE_FORMAT(m_lead_addedon,"%Y-%m-%d")>=', $from_date);
		}
		if (!empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_lead_addedon,"%Y-%m-%d")<=', $to_date);
		}
		if (!empty($clientsearch)) {
			$this->db->where('m_lead_clientid', $clientsearch);
		}
		if (!empty($planserach)) {
			$this->db->where('m_lead_plan', $planserach);
		}
		if (!empty($statussearch)) {
			$this->db->where('m_lead_status', $statussearch);
		}
		$res = $this->db->group_by('m_lead_uno')->order_by('m_lead_id', 'desc')->get('master_lead_tbl')->result();
		if (!empty($res)) {
			foreach ($res as $key) {
				$this->db->select('master_lead_tbl.*,m_lclient_name,m_lclient_city,m_emp_name,status.m_leadst_name as status_name,plan.m_hq_name as plan_name,package.m_hq_name as package_name,package.m_hq_items as package_item,meetwith.*');
				$this->db->join('master_leadclient_tbl', 'master_leadclient_tbl.m_lclient_id = master_lead_tbl.m_lead_clientid', 'left');
				$this->db->join('master_employee_tbl emp', 'emp.m_emp_id = master_lead_tbl.m_lead_pro', 'left');
				$this->db->join('master_leadsource_tbl status', 'status.m_leadst_id = master_lead_tbl.m_lead_status', 'left');
				$this->db->join('master_hq_tbl plan', 'plan.m_hq_id = master_lead_tbl.m_lead_plan', 'left');
				$this->db->join('client_persondtl_tbl meetwith', 'meetwith.lc_person_id = master_lead_tbl.m_lead_meetwith', 'left');
				$this->db->join('master_hq_tbl package', 'package.m_hq_id = master_lead_tbl.m_lead_package', 'left');
				$letest_d = $this->db->where('m_lead_id', $key->m_lead_id)->get('master_lead_tbl')->row();

				$result[] = $letest_d;
			}
		}

		return $result;
	}

	public function get_lead_list($from_date, $to_date, $clientsearch, $planserach, $statussearch)
	{
		$this->db->select('master_lead_tbl.*,m_lclient_name,m_lclient_city,m_emp_name,status.m_leadst_name as status_name,plan.m_hq_name as plan_name,package.m_hq_name as package_name,package.m_hq_items as package_item,meetwith.*');
		$this->db->join('master_leadclient_tbl', 'master_leadclient_tbl.m_lclient_id = master_lead_tbl.m_lead_clientid', 'left');
		$this->db->join('master_employee_tbl emp', 'emp.m_emp_id = master_lead_tbl.m_lead_pro', 'left');
		$this->db->join('master_leadsource_tbl status', 'status.m_leadst_id = master_lead_tbl.m_lead_status', 'left');
		$this->db->join('master_hq_tbl plan', 'plan.m_hq_id = master_lead_tbl.m_lead_plan', 'left');
		$this->db->join('client_persondtl_tbl meetwith', 'meetwith.lc_person_id = master_lead_tbl.m_lead_meetwith', 'left');
		$this->db->join('master_hq_tbl package', 'package.m_hq_id = master_lead_tbl.m_lead_package', 'left');
		if (!empty($from_date)) {
			$this->db->where('DATE_FORMAT(m_lead_addedon,"%Y-%m-%d")>=', $from_date);
		}
		if (!empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_lead_addedon,"%Y-%m-%d")<=', $to_date);
		}
		if (!empty($clientsearch)) {
			$this->db->where('m_lead_clientid', $clientsearch);
		}
		if (!empty($planserach)) {
			$this->db->where('m_lead_plan', $planserach);
		}
		if (!empty($statussearch)) {
			$this->db->where('m_lead_status', $statussearch);
		}
		$res = $this->db->order_by('m_lead_id', 'desc')->get('master_lead_tbl')->result();
		return $res;
	}


	public function get_lead_dtl($id)
	{
		$this->db->select('master_lead_tbl.*,master_leadclient_tbl.m_lclient_name,m_emp_name,status.m_leadst_name as status_name,plan.m_hq_name as plan_name,package.m_hq_name as package_name,package.m_hq_items as package_item');
		$this->db->join('master_leadclient_tbl', 'master_leadclient_tbl.m_lclient_id = master_lead_tbl.m_lead_clientid', 'left');
		$this->db->join('master_employee_tbl emp', 'emp.m_emp_id = master_lead_tbl.m_lead_pro', 'left');
		$this->db->join('master_leadsource_tbl status', 'status.m_leadst_id = master_lead_tbl.m_lead_status', 'left');
		$this->db->join('master_hq_tbl plan', 'plan.m_hq_id = master_lead_tbl.m_lead_plan', 'left');
		$this->db->join('master_hq_tbl package', 'package.m_hq_id = master_lead_tbl.m_lead_package', 'left');
		$this->db->where('m_lead_id', $id);
		$res = $this->db->get('master_lead_tbl')->row();

		return $res;
	}



	public function insert_lead()
	{

		$leadid = $this->input->post('m_lead_id');
		if (!empty($this->input->post('m_lead_uno'))) {
			$lead_uno = $this->input->post('m_lead_uno');
		} else {
			$lead_uno = 'AQV' . $this->input->post('m_lead_clientid') . $this->input->post('m_lead_pro') . date('dmy');
		}
		$data = array(

			"m_lead_uno" => $lead_uno,
			"m_lead_clientid" => $this->input->post('m_lead_clientid'),
			"m_lead_pro" => $this->input->post('m_lead_pro'),
			"m_lead_date" => $this->input->post('m_lead_date'),
			"m_lead_status" => $this->input->post('m_lead_status'),
			"m_lead_minvisits" => $this->input->post('m_lead_minvisits'),
			"m_lead_rateph" => $this->input->post('m_lead_rateph'),
			"m_lead_flocker" => $this->input->post('m_lead_flocker'),
			"m_lead_fcostume" => $this->input->post('m_lead_fcostume'),
			"m_lead_meetwith" => $this->input->post('m_lead_meetwith'),
			"m_lead_followup" => $this->input->post('m_lead_followup'),
			"m_lead_remark" => $this->input->post('m_lead_remark'),
			"m_lead_summery" => $this->input->post('m_lead_summery'),
			"m_lead_ratio" => $this->input->post('m_lead_ratio'),
			"m_lead_plan" => $this->input->post('m_lead_plan'),
			"m_lead_package" => $this->input->post('m_lead_package'),
			"m_lead_advanceto" => $this->input->post('m_lead_advanceto'),
			"m_lead_advance" => $this->input->post('m_lead_advance'),
			"m_lead_advance_date" => $this->input->post('m_lead_advance_date'),
			"m_lead_paymode" => $this->input->post('m_lead_paymode') ?: 0,
		);

		if (!empty($leadid)) {
			$this->db->where('m_lead_id', $leadid)->update('master_lead_tbl', $data);

			return 2;
		} else {
			$data['m_lead_addedon'] = date('Y-m-d H:i:s');
			$this->db->insert('master_lead_tbl', $data);

			return 1;
		}
	}

	public function delete_blead()
	{

		$this->db->where('m_lead_uno', $this->input->post('delete_id'));
		return $this->db->delete('master_lead_tbl');
	}
	public function delete_lead()
	{

		$this->db->where('m_lead_id', $this->input->post('delete_id'));
		return $this->db->delete('master_lead_tbl');
	}



	public function get_lead_history($lead_uno)
	{
		$this->db->select('master_lead_tbl.*,master_leadclient_tbl.m_lclient_name,m_emp_name,status.m_leadst_name as status_name,plan.m_hq_name as plan_name,package.m_hq_name as package_name,package.m_hq_items as package_item,meetwith.lc_person_name as meet_with');
		$this->db->join('master_leadclient_tbl', 'master_leadclient_tbl.m_lclient_id = master_lead_tbl.m_lead_clientid', 'left');
		$this->db->join('master_employee_tbl emp', 'emp.m_emp_id = master_lead_tbl.m_lead_pro', 'left');
		$this->db->join('master_leadsource_tbl status', 'status.m_leadst_id = master_lead_tbl.m_lead_status', 'left');
		$this->db->join('master_hq_tbl plan', 'plan.m_hq_id = master_lead_tbl.m_lead_plan', 'left');
		$this->db->join('master_hq_tbl package', 'package.m_hq_id = master_lead_tbl.m_lead_package', 'left');
		$this->db->join('client_persondtl_tbl meetwith', 'meetwith.lc_person_id = master_lead_tbl.m_lead_meetwith', 'left');
		$res = $this->db->where('m_lead_uno', $lead_uno)->get('master_lead_tbl')->result();
		return $res;
	}

	//=======================================================lead=================================================//



}
