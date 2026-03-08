<?php date_default_timezone_set('Asia/Kolkata');
class Setup_model extends CI_model
{


	//========================== accparent  =============================//

	public function get_all_accparent()
	{
		$this->db->select('*');
		// $this->db->join('master_state_tbl', 'master_state_tbl.m_state_id = master_accparent_tbl.m_accparent_state','left');
		$this->db->order_by('m_accparent_name');
		$res = $this->db->get('master_accparent_tbl')->result();
		return $res;
	}
	public function get_edit_accparent($edid)
	{
		$this->db->select('*');
		$this->db->where('m_accparent_id', $edid);
		$res = $this->db->get('master_accparent_tbl')->row();
		return $res;
	}
	public function insert_accparent()
	{

		$s_data = array(
			"m_accparent_name" => $this->input->post('m_accparent_name'),
			// "m_accparent_state" => $this->input->post('m_accparent_state'),
			// "m_accparent_country" => 1,
			"m_accparent_status" => $this->input->post('m_accparent_status'),
			"m_accparent_added_on" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_accparent_id');
		if (!empty($id)) {
			$this->db->where('m_accparent_id', $id)->update('master_accparent_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_accparent_tbl', $s_data);
			return 1;
		}
	}


	public function delete_accparent()
	{
		$this->db->where('m_accparent_id', $this->input->post('delete_id'));
		return $this->db->delete('master_accparent_tbl');
	}

	public function get_active_accparent()
	{
		$this->db->select('accparent.m_accparent_name,accparent.m_accparent_id');
		$this->db->where('m_accparent_status', '1');
		$this->db->order_by('m_accparent_name');
		$res = $this->db->get('master_accparent_tbl accparent')->result();
		return $res;
	}
	//=========================================== accparent ===============================================//



	//========================== accgroup  =============================//

	public function get_all_accgroup()
	{
		$this->db->select('*');
		$this->db->join('master_accparent_tbl', 'master_accparent_tbl.m_accparent_id = master_accgroup_tbl.m_accgroup_parent', 'left');
		$this->db->order_by('m_accgroup_name');
		$res = $this->db->get('master_accgroup_tbl')->result();
		return $res;
	}
	public function get_edit_accgroup($edid)
	{
		$this->db->select('*');
		$this->db->where('m_accgroup_id', $edid);
		$res = $this->db->get('master_accgroup_tbl')->row();
		return $res;
	}
	public function insert_accgroup()
	{

		$s_data = array(
			"m_accgroup_name" => $this->input->post('m_accgroup_name'),
			"m_accgroup_parent" => $this->input->post('m_accgroup_parent'),
			"m_accgroup_status" => $this->input->post('m_accgroup_status'),
			"m_accgroup_added_on" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_accgroup_id');
		if (!empty($id)) {
			$this->db->where('m_accgroup_id', $id)->update('master_accgroup_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_accgroup_tbl', $s_data);
			return 1;
		}
	}


	public function delete_accgroup()
	{
		$this->db->where('m_accgroup_id', $this->input->post('delete_id'));
		return $this->db->delete('master_accgroup_tbl');
	}

	public function get_active_accgroup()
	{
		$this->db->select('accgroup.m_accgroup_name,accgroup.m_accgroup_id');
		$this->db->where('m_accgroup_status', '1');
		$this->db->order_by('m_accgroup_name');
		$res = $this->db->get('master_accgroup_tbl accgroup')->result();
		return $res;
	}
	//=========================================== accgroup ===============================================//


	//========================== account  =============================//

	public function get_all_account()
	{
		$this->db->select('*');
		$this->db->join('master_accgroup_tbl', 'master_accgroup_tbl.m_accgroup_id = master_accounts_tbl.m_account_group', 'left');
		$this->db->order_by('m_account_name');
		$res = $this->db->get('master_accounts_tbl')->result();
		return $res;
	}
	public function get_edit_account($edid)
	{
		$this->db->select('*');
		$this->db->where('m_account_id', $edid);
		$res = $this->db->get('master_accounts_tbl')->row();
		return $res;
	}
	public function insert_account()
	{

		$s_data = array(
			"m_account_name" => $this->input->post('m_account_name'),
			"m_account_bank" => $this->input->post('m_account_bank'),
			"m_account_number" => $this->input->post('m_account_number'),
			"m_account_mobile" => $this->input->post('m_account_mobile'),
			"m_account_ifsc" => $this->input->post('m_account_ifsc'),
			// "m_account_group" => $this->input->post('m_account_group'),
			"m_account_status" => $this->input->post('m_account_status'),
			// "m_account_added_on" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_account_id');
		if (!empty($id)) {
			$this->db->where('m_account_id', $id)->update('master_accounts_tbl', $s_data);
			return 2;
		} else {
			$s_data['m_account_added_on'] = date('Y-m-d H:i');
			$this->db->insert('master_accounts_tbl', $s_data);
			return 1;
		}
	}


	public function delete_account()
	{
		$this->db->where('m_account_id', $this->input->post('delete_id'));
		return $this->db->delete('master_accounts_tbl');
	}

	public function get_active_account()
	{
		$this->db->where('m_account_status', '1');
		$this->db->order_by('m_account_name');
		$res = $this->db->get('master_accounts_tbl account')->result();
		return $res;
	}
	//=========================================== account ===============================================//

	//========================== company  =============================//

	public function get_all_company()
	{
		$this->db->select('master_company_tbl.*,m_city_name,master_accounts_tbl.*');
		$this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_company_tbl.m_company_city', 'left');
		$this->db->join('master_accounts_tbl', 'master_accounts_tbl.m_account_id = master_company_tbl.m_company_account', 'left');
		$this->db->order_by('m_company_name');
		$res = $this->db->get('master_company_tbl')->result();
		return $res;
	}
	public function get_edit_company($edid)
	{
		$this->db->select('*');
		$this->db->where('m_company_id', $edid);
		$res = $this->db->get('master_company_tbl')->row();
		return $res;
	}
	public function insert_company()
	{

		$s_data = array(
			"m_company_name" => $this->input->post('m_company_name'),
			"m_company_code" => $this->input->post('m_company_code'),
			"m_company_mobile" => $this->input->post('m_company_mobile'),
			"m_company_email" => $this->input->post('m_company_email'),
			"m_company_website" => $this->input->post('m_company_website'),
			"m_company_city" => $this->input->post('m_company_city'),
			"m_company_address" => $this->input->post('m_company_address'),
			"m_company_account" => $this->input->post('m_company_account'),
			"m_company_status" => $this->input->post('m_company_status'),

		);
		$id = $this->input->post('m_company_id');
		if (!empty($id)) {
			$this->db->where('m_company_id', $id)->update('master_company_tbl', $s_data);
			return 2;
		} else {
			$s_data['m_company_addedon'] = date('Y-m-d H:i');
			$this->db->insert('master_company_tbl', $s_data);
			return 1;
		}
	}


	public function delete_company()
	{
		$this->db->where('m_company_id', $this->input->post('delete_id'));
		return $this->db->delete('master_company_tbl');
	}

	public function get_active_company()
	{
		$this->db->select('master_company_tbl.*,m_city_name,master_accounts_tbl.*');
		$this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_company_tbl.m_company_city', 'left');
		$this->db->join('master_accounts_tbl', 'master_accounts_tbl.m_account_id = master_company_tbl.m_company_account', 'left');
		$this->db->where('m_company_status', '1');
		$res = $this->db->get('master_company_tbl')->result();
		return $res;
	}
	//=========================================== company ===============================================//


	//========================== godown  =============================//

	public function get_all_godown()
	{
		$this->db->select('master_godown_tbl.*,m_dept_name,m_company_name');
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_godown_tbl.m_godown_dept', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_godown_tbl.m_godown_company', 'left');
		$this->db->order_by('m_godown_name');
		$res = $this->db->get('master_godown_tbl')->result();
		return $res;
	}
	public function get_edit_godown($edid)
	{
		$this->db->select('master_godown_tbl.*,m_dept_name,m_company_name');
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_godown_tbl.m_godown_dept', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_godown_tbl.m_godown_company', 'left');
		$this->db->where('m_godown_id', $edid);
		$res = $this->db->get('master_godown_tbl')->row();
		return $res;
	}
	public function insert_godown()
	{

		$s_data = array(
			"m_godown_name" => $this->input->post('m_godown_name'),
			"m_godown_code" => $this->input->post('m_godown_code'),
			"m_godown_dept" => $this->input->post('m_godown_dept'),
			"m_godown_company" => $this->input->post('m_godown_company'),
			"m_godown_type" => $this->input->post('m_godown_type') ?: 2,
			"use_as_dumping_point" => $this->input->post('use_as_dumping_point') ?: 0,
			"m_godown_status" => $this->input->post('m_godown_status') ?: 0,

		);
		$id = $this->input->post('m_godown_id');
		if (!empty($id)) {
			$this->db->where('m_godown_id', $id)->update('master_godown_tbl', $s_data);
			return 2;
		} else {
			$s_data['m_godown_added_on'] = date('Y-m-d H:i');
			$this->db->insert('master_godown_tbl', $s_data);
			return 1;
		}
	}


	public function delete_godown()
	{
		$this->db->where('m_godown_id', $this->input->post('delete_id'));
		return $this->db->delete('master_godown_tbl');
	}

	public function get_active_godown($type = '', $dept = '')
	{
		$this->db->select('m_godown_name,m_godown_id,m_godown_dept,m_godown_type');
		if (!empty($type)) {
			$this->db->where('m_godown_type', $type);
		}
		if (!empty($dept)) {
			$this->db->where('m_godown_dept', $dept);
		}
		$this->db->where('m_godown_status', '1');
		$res = $this->db->get('master_godown_tbl')->result();
		return $res;
	}
	//=========================================== godown ===============================================//

	//========================== asset  =============================//

	public function get_all_asset()
	{
		$this->db->select('*');
		$this->db->join('master_godown_tbl', 'master_godown_tbl.m_godown_id = master_assets_tbl.m_asset_godown', 'left');
		$this->db->order_by('m_asset_name');
		$res = $this->db->get('master_assets_tbl')->result();
		return $res;
	}
	public function get_edit_asset($edid)
	{
		$this->db->select('*');
		$this->db->where('m_asset_id', $edid);
		$res = $this->db->get('master_assets_tbl')->row();
		return $res;
	}
	public function insert_asset()
	{

		$s_data = array(
			"m_asset_name" => $this->input->post('m_asset_name'),
			"m_asset_owner" => $this->input->post('m_asset_owner'),
			"m_asset_godown" => $this->input->post('m_asset_godown'),
			"m_asset_remark" => $this->input->post('m_asset_remark'),
			"m_asset_ownership" => $this->input->post('m_asset_ownership'),
			"m_asset_ishired" => $this->input->post('m_asset_ishired'),
			"m_asset_status" => $this->input->post('m_asset_status'),

		);
		$id = $this->input->post('m_asset_id');
		if (!empty($id)) {
			$this->db->where('m_asset_id', $id)->update('master_assets_tbl', $s_data);
			return 2;
		} else {
			$s_data['m_asset_added_on'] = date('Y-m-d H:i');
			$this->db->insert('master_assets_tbl', $s_data);
			return 1;
		}
	}


	public function delete_asset()
	{
		$this->db->where('m_asset_id', $this->input->post('delete_id'));
		return $this->db->delete('master_assets_tbl');
	}

	// public function get_active_asset(){
	// 	$this->db->select('asset.m_asset_name,asset.m_asset_id,state.m_state_name');
	// 	$this->db->join('master_state_tbl state','state.m_state_id = asset.m_asset_state','left');
	// 	$this->db->where('m_asset_status','1');
	// 	$this->db->order_by('m_asset_name');
	// 	$res = $this->db->get('master_assets_tbl asset')->result();
	// 	return $res;
	// }
	//=========================================== asset ===============================================//


	//=======================================================Supplier=================================================//

	public function get_supplier_list($from_date, $to_date)
	{

		if (!empty($from_date) && !empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_supplier_added_on,"%Y-%m-%d")>=', $from_date);
			$this->db->where('DATE_FORMAT(m_supplier_added_on,"%Y-%m-%d")<=', $to_date);
		}
		$res = $this->db->where('m_supplier_type', 1)->get('master_supplier_tbl')->result();
		return $res;
	}

	public function get_contractor_list($from_date, $to_date)
	{

		if (!empty($from_date) && !empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_supplier_added_on,"%Y-%m-%d")>=', $from_date);
			$this->db->where('DATE_FORMAT(m_supplier_added_on,"%Y-%m-%d")<=', $to_date);
		}
		$res = $this->db->where('m_supplier_type', 2)->get('master_supplier_tbl')->result();
		return $res;
	}

	public function get_Active_supplier($type)
	{
		$res = $this->db->where('m_supplier_status', 1)->where('m_supplier_type', $type)->get('master_supplier_tbl')->result();
		return $res;
	}

	public function get_credit_supplier()
	{
		$res = $this->db->where('m_supplier_status', 1)->where('m_supplier_type', 1)->get('master_supplier_tbl')->result();
		return $res;
	}

	public function get_supplier_dtl($id)
	{
		$this->db->select('*');
		$this->db->where('m_supplier_id', $id);
		// $this->db->join('master_designation_tbl','master_designation_tbl.m_desig_id = master_supplier_tbl.m_supplier_desig','left');
		$this->db->join('master_state_tbl', 'master_state_tbl.m_state_id = master_supplier_tbl.m_supplier_state', 'left');
		$this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_supplier_tbl.m_supplier_city', 'left');
		$res = $this->db->get('master_supplier_tbl')->row();

		return $res;
	}

	public function insert_supplier()
	{

		$userid = $this->input->post('m_supplier_id');

		// for 1st image upload code.
		//   if(!empty($_FILES['m_supplier_image']['name'])){
		//   $config['file_name'] = $_FILES['m_supplier_image']['name'];
		//   $config['upload_path'] = 'uploads/users';
		//   $config['allowed_types'] = 'jpg|jpeg|png';
		//   $config['remove_spaces'] = TRUE;
		//   $config['file_name'] = $_FILES['m_supplier_image']['name'];
		//   //Load upload library and initialize configuration
		//   $this->load->library('upload',$config);
		//   $this->upload->initialize($config);
		//   if($this->upload->do_upload('m_supplier_image')){
		//     $uploadData = $this->upload->data();  
		//     if (!empty($update_data['m_supplier_image'])) { 
		//       if(file_exists($config['m_supplier_image'].$update_data['m_supplier_image'])){
		//       unlink($config['upload_path'].$update_data['m_supplier_image']); /* deleting Image */
		//       } 
		//     }
		//     $m_supplier_image = $uploadData['file_name'];
		//   }
		// }
		// else{
		//   $m_supplier_image = $this->input->post('m_supplier_image1');
		// }




		$data = array(

			"m_supplier_name" => $this->input->post('m_supplier_name'),
			"m_supplier_mobile" => $this->input->post('m_supplier_mobile'),
			"m_supplier_AccCode" => $this->input->post('m_supplier_AccCode'),
			"m_supplier_city" => $this->input->post('m_supplier_city'),
			"m_supplier_email" => $this->input->post('m_supplier_email'),
			"m_supplier_type" => $this->input->post('m_supplier_type'),
			"m_supplier_address" => $this->input->post('m_supplier_address'),
			"m_supplier_reqType" => $this->input->post('m_supplier_reqType'),
			"m_supplier_phoneNo" => $this->input->post('m_supplier_phoneNo'),
			// "m_supplier_state" => $this->input->post('m_supplier_state'),
			"m_supplier_pan_no" => $this->input->post('m_supplier_pan_no'),
			"m_supplier_status" => 1,

		);

		if (!empty($userid)) {
			$this->db->where('m_supplier_id', $userid)->update('master_supplier_tbl', $data);
			return 2;
		} else {
			$data['m_supplier_added_on'] = date('Y-m-d H:i:s');
			$this->db->insert('master_supplier_tbl', $data);
			return 1;
		}
	}

	public function delete_supplier()
	{
		$this->db->where('m_supplier_id', $this->input->post('delete_id'));
		$this->db->delete('master_supplier_tbl');
		return true;
	}
	//=======================================================Supplier=================================================//


	//========================== band  =============================//

	public function get_all_band($status = '', $colour = '')
	{

		if (!empty($status)) {
			$this->db->where('m_band_status', $status);
		}
		if (!empty($colour)) {
			$this->db->where('m_band_color', $colour);
		}

		$this->db->select('master_bands_tbl.*,m_hq_name');
		$this->db->join('master_hq_tbl', 'master_hq_tbl.m_hq_id = master_bands_tbl.m_band_color', 'left');
		$res = $this->db->order_by('m_band_id', 'desc')->get('master_bands_tbl')->result();
		// if (!empty($res)) {
		// 	foreach ($res as $key => $value) {
		// 		$stock_bal= $this->Student_model->get_bands_stock_detail($value->m_band_color, date('Y-m-d'), date('Y-m-d'));
		// 		$data = (object) array(
		// 			'm_band_id' => $value->m_band_id,
		// 			'm_band_color' => $value->m_band_color,
		// 			'm_band_total' => $value->m_band_total,
		// 			'm_band_nostart' => $value->m_band_nostart,
		// 			'm_band_noend' => $value->m_band_noend,
		// 			'm_band_instock' => $stock_bal->bal_stock,
		// 			'm_band_status' => $value->m_band_status,
		// 			'm_band_added_on' => $value->m_band_added_on,
		// 			'm_hq_name' => $value->m_hq_name,

		// 		);
		// 		$result[] = $data;
		// 	}
		// }
		// return $result;
		return $res;
	}

	public function get_edit_band($edid)
	{
		$this->db->select('*');
		$this->db->where('m_band_id', $edid);
		$res = $this->db->get('master_bands_tbl')->row();
		return $res;
	}
	public function insert_band()
	{
		$nostart = $this->input->post('m_band_nostart');
		$noend = $this->input->post('m_band_noend');
		$totalno = ($noend - $nostart) + 1;
		$s_data = array(
			"m_band_color" => $this->input->post('m_band_color'),
			"m_band_total" => $totalno,
			"m_band_nostart" => $this->input->post('m_band_nostart'),
			"m_band_noend" => $this->input->post('m_band_noend'),
			"m_band_status" => $this->input->post('m_band_status'),

		);
		$id = $this->input->post('m_band_id');
		if (!empty($id)) {
			$s_data['m_band_updateon'] = date('Y-m-d H:i');
			$s_data['m_band_updateby'] = $this->session->userdata('user_id');
			$s_data['m_band_instock'] = $this->input->post('m_band_instock');
			$this->db->where('m_band_id', $id)->update('master_bands_tbl', $s_data);
			return 2;
		} else {
			$s_data['m_band_starton'] = date('Y-m-d H:i');
			$s_data['m_band_added_on'] = date('Y-m-d H:i');
			$s_data['m_band_addedby'] = $this->session->userdata('user_id');
			$s_data['m_band_instock'] = $totalno;
			$this->db->insert('master_bands_tbl', $s_data);
			return 1;
		}
	}



	public function delete_band()
	{
		$this->db->where('m_band_id', $this->input->post('delete_id'));
		return $this->db->delete('master_bands_tbl');
	}



	//=========================================== band ===============================================//

	//=========================================== band Maintainance ===============================================//

	public function get_band_history($from_date = '', $to_date = '', $colour = '', $bnd_no = '')
	{

		if (!empty($from_date)) {
			$this->db->where('DATE_FORMAT(bm_addedon,"%Y-%m-%d")>=', $from_date);
		}
		if (!empty($to_date)) {
			$this->db->where('DATE_FORMAT(bm_addedon,"%Y-%m-%d")<=', $to_date);
		}

		if (!empty($colour)) {
			$this->db->where('bm_colour', $colour);
		}

		if (!empty($bnd_no)) {
			$this->db->where('bm_bandno', $bnd_no);
		}

		$this->db->select('band_management_tbl.*,master_bands_tbl.*,m_hq_name');
		$this->db->join('master_bands_tbl', 'master_bands_tbl.m_band_id = band_management_tbl.bm_bandno', 'left');
		$this->db->join('master_hq_tbl', 'master_hq_tbl.m_hq_id = band_management_tbl.bm_colour', 'left');
		$res = $this->db->get('band_management_tbl')->result();

		return $res;
	}

	public function get_lastband_maintaince($bnd_no = '')
	{
		if (!empty($bnd_no)) {
			$this->db->where('bm_bandno', $bnd_no);
		}

		$this->db->select('bm_addedon,DATEDIFF(current_date, bm_addedon) as days');
		$res = $this->db->order_by('bm_id', 'desc')->get('band_management_tbl')->row();

		return $res;
	}

	public function add_band_maintainance()
	{
		$s_data = array(
			"bm_colour" => $this->input->post('bm_colour'),
			"bm_stock" => $this->input->post('bm_stock'),
			"bm_chk_stk" => $this->input->post('bm_chk_stk'),
			"bm_remark" => $this->input->post('bm_remark'),
			"bm_bandno" => $this->input->post('bm_bandno'),
			"bm_used" => $this->input->post('bm_used'),
			"bm_addedon" => date('Y-m-d H:i'),
			"bm_addedby" => $this->session->userdata('user_id'),
		);

		return	$this->db->insert('band_management_tbl', $s_data);
	}
	//=========================================== band Maintainance ===============================================//



	//======================================================= Users=================================================//

	public function get_users_list($from_date, $to_date)
	{

		if (!empty($from_date) && !empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_admin_addedon,"%Y-%m-%d")>=', $from_date);
			$this->db->where('DATE_FORMAT(m_admin_addedon,"%Y-%m-%d")<=', $to_date);
		}
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_admin_tbl.m_admin_branch', 'left');
		$this->db->where('m_admin_type !=', 1);
		if ($this->session->userdata('user_type') != 1) {
			$this->db->where_not_in('m_admin_id', array(1, 2, 3));
		}
		$res = $this->db->get('master_admin_tbl')->result();
		return $res;
	}

	public function get_user_details($id)
	{
		return $this->db->where('m_admin_id', $id)->get('master_admin_tbl')->row();
	}

	public function update_profile()
	{
		$id = $this->input->post('m_admin_id');

		//for 1st image upload code.
		if (!empty($_FILES['m_admin_img']['name'])) {
			$config['file_name'] = $_FILES['m_admin_img']['name'];
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['remove_spaces'] = TRUE;
			$config['file_name'] = $_FILES['m_admin_img']['name'];
			//Load upload library and initialize configuration
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('m_admin_img')) {
				$uploadData = $this->upload->data();
				if (!empty($update_data['m_admin_img'])) {
					if (file_exists($config['m_admin_img'] . $update_data['m_admin_img'])) {
						unlink($config['upload_path'] . $update_data['m_admin_img']); /* deleting Image */
					}
				}
				$m_admin_img = $uploadData['file_name'];
			}
		} else {
			$m_admin_img = $this->input->post('pre_m_admin_img');
		}


		$update_data = array(
			"m_admin_name"    => $this->input->post('m_admin_name'),
			//   "m_admin_email"   => $this->input->post('m_admin_email'),
			"m_admin_login_id" => $this->input->post('m_admin_login_id'),

			//   "m_admin_contact" => $this->input->post('m_admin_contact'),
			"m_admin_type" => $this->input->post('m_admin_type') ?: 3,
			"m_admin_branch" => $this->input->post('m_admin_branch'),
			"m_admin_login_allowed" => $this->input->post('m_admin_login_allowed'),
			"m_admin_img" => $m_admin_img,
		);
		if (!empty($this->input->post('m_admin_pass'))) {
			$update_data['m_admin_pass'] = $this->input->post('m_admin_pass');
		}

		if (!empty($id)) {
			$this->db->where('m_admin_id', $id)->update('master_admin_tbl', $update_data);
			return 2;
		} else {

			$data['m_admin_addedon'] = date('Y-m-d H:i:s');
			$this->db->insert('master_admin_tbl', $update_data);
			return 1;
		}
	}

	public function delete_users()
	{
		$this->db->where('m_admin_id', $this->input->post('delete_id'));
		return $this->db->delete('master_admin_tbl');
	}

	//=======================================================/Users=================================================//

	//========================== prodgroup  =============================//

	public function get_all_prodgroup($type)
	{
		$this->db->select('*');
		$this->db->where('m_prodgroup_type', $type);
		$this->db->order_by('m_prodgroup_name');
		$res = $this->db->get('master_prodgroup_tbl')->result();
		return $res;
	}
	public function get_edit_prodgroup($edid)
	{
		$this->db->select('*');
		$this->db->where('m_prodgroup_id', $edid);
		$res = $this->db->get('master_prodgroup_tbl')->row();
		return $res;
	}
	public function insert_prodgroup()
	{

		$s_data = array(
			"m_prodgroup_name" => $this->input->post('m_prodgroup_name'),
			"m_prodgroup_type" => $this->input->post('m_prodgroup_type'),
			"m_prodgroup_uomid" => $this->input->post('m_prodgroup_uomid') ?: '',

			"m_prodgroup_status" => $this->input->post('m_prodgroup_status'),
			"m_prodgroup_added_on" => date('Y-m-d H:i'),
		);
		$id = $this->input->post('m_prodgroup_id');
		if (!empty($id)) {
			$this->db->where('m_prodgroup_id', $id)->update('master_prodgroup_tbl', $s_data);
			return 2;
		} else {
			$this->db->insert('master_prodgroup_tbl', $s_data);
			return 1;
		}
	}


	public function delete_prodgroup()
	{
		$this->db->where('m_prodgroup_id', $this->input->post('delete_id'));
		return $this->db->delete('master_prodgroup_tbl');
	}

	public function get_active_prodgroup($type)
	{
		$this->db->select('prodgroup.m_prodgroup_name,prodgroup.m_prodgroup_id');
		$this->db->where('m_prodgroup_type', $type);
		$this->db->where('m_prodgroup_status', '1');
		$this->db->order_by('m_prodgroup_name');
		$res = $this->db->get('master_prodgroup_tbl prodgroup')->result();
		return $res;
	}
	//=========================================== prodgroup ===============================================//

	//========================== prodcat  =============================//

	public function get_all_prodcat($type)
	{
		$this->db->select('*');
		$this->db->where('m_prodcat_type', $type)->order_by('m_prodcat_name');
		$res = $this->db->get('master_prodcategory_tbl')->result();
		return $res;
	}
	public function get_edit_prodcat($edid)
	{
		$this->db->select('*');
		$this->db->where('m_prodcat_id', $edid);
		$res = $this->db->get('master_prodcategory_tbl')->row();
		return $res;
	}
	public function insert_prodcat()
	{

		$s_data = array(
			"m_prodcat_name" => $this->input->post('m_prodcat_name'),
			"m_prodcat_type" => $this->input->post('m_prodcat_type'),
			"m_prodcat_max" => $this->input->post('m_prodcat_max') ?: '',

			"m_prodcat_status" => $this->input->post('m_prodcat_status'),

		);
		$id = $this->input->post('m_prodcat_id');
		if (!empty($id)) {
			$this->db->where('m_prodcat_id', $id)->update('master_prodcategory_tbl', $s_data);
			return 2;
		} else {
			$s_data['m_prodcat_added_on'] = date('Y-m-d H:i');
			$this->db->insert('master_prodcategory_tbl', $s_data);
			return 1;
		}
	}


	public function delete_prodcat()
	{
		$this->db->where('m_prodcat_id', $this->input->post('delete_id'));
		return $this->db->delete('master_prodcategory_tbl');
	}

	public function get_active_prodcat($type)
	{
		$this->db->select('m_prodcat_name,m_prodcat_id,m_prodcat_max');
		$this->db->where('m_prodcat_status', '1');
		$this->db->where('m_prodcat_type', $type)->order_by('m_prodcat_name');
		$res = $this->db->get('master_prodcategory_tbl')->result();
		return $res;
	}
	//=========================================== prodcat ===============================================//

	//=======================================================product=================================================//

	public function get_product_list($from_date, $to_date)
	{

		if (!empty($from_date) && !empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_product_added_on,"%Y-%m-%d")>=', $from_date);
			$this->db->where('DATE_FORMAT(m_product_added_on,"%Y-%m-%d")<=', $to_date);
		}
		$res = $this->db->get('master_product_tbl')->result();
		return $res;
	}

	public function get_Active_product($id = '', $dept = '', $type = '')
	{
		if (!empty($dept)) {
			$this->db->where('m_product_group', $dept);
		}
		if (!empty($id)) {
			$this->db->where('m_product_id', $id);
		}
		if ($type == 1) {
			$this->db->where('is_job_work_product', 1);
		} else if ($type == 2) {
			$this->db->where('is_raw_material', 1);
		} else if ($type == 3) {
			$this->db->where('is_asset', 1);
		}
		$res = $this->db->join('master_prodgroup_tbl', 'master_prodgroup_tbl.m_prodgroup_id = master_product_tbl.m_product_unit', 'left')
			->where('is_discontinued', 0)->get('master_product_tbl')->result();
		return $res;
	}

	public function get_credit_product()
	{
		$res = $this->db->where('is_discontinued', 0)->where('m_product_type', 1)->get('master_product_tbl')->result();
		return $res;
	}

	public function get_product_dtl($id)
	{
		$this->db->select('*');
		$this->db->where('m_product_id', $id);
		// $this->db->join('master_designation_tbl','master_designation_tbl.m_desig_id = master_product_tbl.m_product_desig','left');
		// $this->db->join('master_state_tbl','master_state_tbl.m_state_id = master_product_tbl.m_product_state','left');
		// $this->db->join('master_city_tbl','master_city_tbl.m_city_id = master_product_tbl.m_product_city','left');
		$res = $this->db->get('master_product_tbl')->row();

		return $res;
	}

	public function insert_product()
	{

		$product_id = $this->input->post('m_product_id');

		if ($this->input->post('is_gst_notapplicable')) {
			$is_gst_notapplicable = 1;
		} else {
			$is_gst_notapplicable = 0;
		}
		if ($this->input->post('is_job_work_product')) {
			$is_job_work_product = 1;
		} else {
			$is_job_work_product = 0;
		}
		if ($this->input->post('is_raw_material')) {
			$is_raw_material = 1;
		} else {
			$is_raw_material = 0;
		}
		if ($this->input->post('is_discontinued')) {
			$is_discontinued = 1;
		} else {
			$is_discontinued = 0;
		}
		if ($this->input->post('is_asset')) {
			$is_asset = 1;
		} else {
			$is_asset = 0;
		}

		$data = array(

			"m_product_code" => $this->input->post('m_product_code'),
			"m_product_name" => $this->input->post('m_product_name'),
			// "m_product_printname" => $this->input->post('m_product_printname'),
			"m_product_discription" => $this->input->post('m_product_discription'),
			"m_product_HSNcode" => $this->input->post('m_product_HSNcode'),
			"m_product_group" => $this->input->post('m_product_group'),
			"m_product_category" => $this->input->post('m_product_category'),
			"m_product_GSTgroup" => $this->input->post('m_product_GSTgroup'),
			"m_product_unit" => $this->input->post('m_product_unit'),
			"m_product_rent" => $this->input->post('m_product_rent'),
			"m_product_deposit" => $this->input->post('m_product_deposit'),
			"m_product_sale_rate" => $this->input->post('m_product_sale_rate'),
			"m_product_pur_rate" => $this->input->post('m_product_pur_rate'),
			"is_gst_notapplicable" => $is_gst_notapplicable,
			"is_job_work_product" => $is_job_work_product,
			"is_raw_material" => $is_raw_material,
			"is_discontinued" => $is_discontinued,
			"is_asset" => $is_asset,

		);

		if (!empty($product_id)) {
			$this->db->where('m_product_id', $product_id)->update('master_product_tbl', $data);
			return 2;
		} else {
			$data['m_product_added_on'] = date('Y-m-d H:i:s');
			$this->db->insert('master_product_tbl', $data);
			return 1;
		}
	}

	public function delete_product()
	{
		$this->db->where('m_product_id', $this->input->post('delete_id'));
		$this->db->delete('master_product_tbl');
		return true;
	}
	//=======================================================product=================================================//



	//======================================================= expense =================================================//

	public function get_expense_list($from_date, $to_date)
	{
		$this->db->select('master_expense_tbl.*,m_cashacc_name,m_dept_name,m_prodcat_name,m_prodcat_max,m_admin_name,m_company_name');
		$this->db->join('master_prodcategory_tbl', 'master_prodcategory_tbl.m_prodcat_id = master_expense_tbl.m_expense_cat', 'left');
		$this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = master_expense_tbl.m_expense_act', 'left');
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_expense_tbl.m_expense_dept', 'left');
		$this->db->join('master_admin_tbl', 'master_admin_tbl.m_admin_id = master_expense_tbl.m_expense_addedby', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_expense_tbl.m_expense_company', 'left');
		// $this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id = master_expense_tbl.m_expense_resp', 'left');
		if (!empty($from_date) && !empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_expense_added_on,"%Y-%m-%d")>=', $from_date);
			$this->db->where('DATE_FORMAT(m_expense_added_on,"%Y-%m-%d")<=', $to_date);
		}
		$res = $this->db->where('m_expense_mode', 1)->order_by('m_expense_id', 'desc')->get('master_expense_tbl')->result();
		return $res;
	}

	public function get_journal_list($from_date, $to_date)
	{
		$this->db->select('master_expense_tbl.*,m_cashacc_name,m_dept_name,m_prodcat_name,m_prodcat_max,m_admin_name,m_company_name');
		$this->db->join('master_prodcategory_tbl', 'master_prodcategory_tbl.m_prodcat_id = master_expense_tbl.m_expense_cat', 'left');
		$this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = master_expense_tbl.m_expense_act', 'left');
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_expense_tbl.m_expense_dept', 'left');
		$this->db->join('master_admin_tbl', 'master_admin_tbl.m_admin_id = master_expense_tbl.m_expense_addedby', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_expense_tbl.m_expense_company', 'left');
		if (!empty($from_date) && !empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_expense_added_on,"%Y-%m-%d")>=', $from_date);
			$this->db->where('DATE_FORMAT(m_expense_added_on,"%Y-%m-%d")<=', $to_date);
		}
		$res = $this->db->where('m_expense_mode', 2)->order_by('m_expense_id', 'desc')->get('master_expense_tbl')->result();
		return $res;
	}


	public function get_Active_expense()
	{
		$this->db->select('master_expense_tbl.*,m_cashacc_name,m_dept_name,m_prodcat_name,m_prodcat_max,m_admin_name,m_company_name');
		$this->db->join('master_prodcategory_tbl', 'master_prodcategory_tbl.m_prodcat_id = master_expense_tbl.m_expense_cat', 'left');
		$this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = master_expense_tbl.m_expense_act', 'left');
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_expense_tbl.m_expense_dept', 'left');
		$this->db->join('master_admin_tbl', 'master_admin_tbl.m_admin_id = master_expense_tbl.m_expense_addedby', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_expense_tbl.m_expense_company', 'left');
		$res = $this->db->where('m_expense_status', 1)->get('master_expense_tbl')->result();
		return $res;
	}


	public function get_expense_dtl($id)
	{
		$this->db->select('master_expense_tbl.*,m_cashacc_name,m_dept_name,m_prodcat_name,m_prodcat_max,m_admin_name,m_company_name');
		$this->db->join('master_prodcategory_tbl', 'master_prodcategory_tbl.m_prodcat_id = master_expense_tbl.m_expense_cat', 'left');
		$this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = master_expense_tbl.m_expense_act', 'left');
		$this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_expense_tbl.m_expense_dept', 'left');
		$this->db->join('master_admin_tbl', 'master_admin_tbl.m_admin_id = master_expense_tbl.m_expense_addedby', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_expense_tbl.m_expense_company', 'left');
		$this->db->where('m_expense_voucherno', $id);
		$res = $this->db->get('master_expense_tbl')->result();

		return $res;
	}


	public function insert_expense()
	{

		$last_id_insert = $this->db->select('m_expense_voucherno')->where('m_expense_mode', $this->input->post('m_expense_mode'))->order_by('m_expense_id', 'desc')->get('master_expense_tbl')->row();
		if (!empty($last_id_insert)) {
			$lasno = explode('/', $last_id_insert->m_expense_voucherno)[1];
			$expense_no = $this->input->post('m_expense_mode') == 1 ? 'EXP/' . ($lasno + 1) : 'JRN/' . ($lasno + 1);
		} else {
			$expense_no = $this->input->post('m_expense_mode') == 1 ? 'EXP/1' : 'JRN/1';
		}

		$expenseid = $this->input->post('m_expense_id');

		$expense_company = $this->input->post('m_expense_company');
		$expense_date = $this->input->post('m_expense_date');
		$expense_cat = $this->input->post('m_expense_cat');
		$expense_amt = $this->input->post('m_expense_amt');
		$m_expense_paymode = $this->input->post('m_expense_paymode');

		$expense_remark = $this->input->post('m_expense_remark');
		$expense_narration = $this->input->post('m_expense_narration');

		$m_expense_file1 = $this->input->post('m_expense_file1');


		for ($i = 0; $i < count($expense_cat); $i++) {

			if (!empty($expense_cat[$i]) && !empty($expense_amt[$i])) {

				if (!empty($_FILES['m_expense_file']['name'][$i])) {
					$_FILES['file']['name'] = $_FILES['m_expense_file']['name'][$i];
					$_FILES['file']['type'] = $_FILES['m_expense_file']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['m_expense_file']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['m_expense_file']['error'][$i];
					$_FILES['file']['size'] = $_FILES['m_expense_file']['size'][$i];

					$config['upload_path'] = 'uploads/expense';
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['max_size'] = '5000';
					$config['file_name'] = $_FILES['m_expense_file']['name'][$i];

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('file')) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						$m_expense_file = $filename;
					} else {
						$m_expense_file = $m_expense_file1[$i];
					}
				} else {
					$m_expense_file = $m_expense_file1[$i];
				}



				$data = array(

					"m_expense_company" => $expense_company,
					"m_expense_act" => $this->input->post('m_expense_act'),
					"m_expense_dept" => $this->input->post('m_expense_dept'),
					// "m_expense_resp" => $this->input->post('m_expense_resp'),
					"m_expense_date" => $expense_date,
					"m_expense_cat" => $expense_cat[$i],
					"m_expense_amt" => $expense_amt[$i],
					"m_expense_paymode" => $m_expense_paymode[$i],
					"m_expense_remark" => $expense_remark[$i],
					"m_expense_narration" => $expense_narration,
					"m_expense_mode" => $this->input->post('m_expense_mode'),
					"m_expense_file" => $m_expense_file,

				);
				if (!empty($expenseid[$i])) {
					$data['m_expense_updatedby'] = $this->session->userdata('user_id');
					$data['m_expense_updatedon'] = date('Y-m-d H:i:s');
					$this->db->where('m_expense_id', $expenseid[$i])->update('master_expense_tbl', $data);
					$res = 2;
				} else {
					$data['m_expense_voucherno'] = $expense_no;
					$data['m_expense_addedby'] = $this->session->userdata('user_id');
					$data['m_expense_added_on'] = date('Y-m-d H:i:s');
					$data['m_expense_status'] = 1;
					$this->db->insert('master_expense_tbl', $data);
					$res = 1;
				}
			}
		}

		return $res;
	}

	public function delete_expense()
	{

		$this->db->where('m_expense_id', $this->input->post('delete_id'));
		$this->db->delete('master_expense_tbl');

		return true;
	}
	//======================================================= expense =================================================//



	//======================================================= payment =================================================//

	public function get_payment_list($from_date, $to_date)
	{
		$this->db->select('master_payment_tbl.*,master_plots_tbl.m_plot_name,m_company_name');
		$this->db->join('master_plots_tbl', 'master_plots_tbl.m_plot_id = master_payment_tbl.m_payment_plotid', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_payment_tbl.m_payment_company', 'left');
		if (!empty($from_date) && !empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_payment_added_on,"%Y-%m-%d")>=', $from_date);
			$this->db->where('DATE_FORMAT(m_payment_added_on,"%Y-%m-%d")<=', $to_date);
		}
		$res = $this->db->where('m_payment_mode', 1)->get('master_payment_tbl')->result();
		return $res;
	}

	public function get_receipt_list($from_date, $to_date)
	{
		$this->db->select('master_payment_tbl.*,master_plots_tbl.m_plot_name,m_company_name');
		$this->db->join('master_plots_tbl', 'master_plots_tbl.m_plot_id = master_payment_tbl.m_payment_plotid', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_payment_tbl.m_payment_company', 'left');
		if (!empty($from_date) && !empty($to_date)) {
			$this->db->where('DATE_FORMAT(m_payment_added_on,"%Y-%m-%d")>=', $from_date);
			$this->db->where('DATE_FORMAT(m_payment_added_on,"%Y-%m-%d")<=', $to_date);
		}
		$res = $this->db->where('m_payment_mode', 2)->get('master_payment_tbl')->result();
		return $res;
	}


	public function get_Active_payment()
	{

		$res = $this->db->where('m_payment_status', 1)->get('master_payment_tbl')->result();
		return $res;
	}


	public function get_payment_dtl($id)
	{
		$this->db->select('master_payment_tbl.*,master_plots_tbl.m_plot_name,m_company_name');
		$this->db->join('master_plots_tbl', 'master_plots_tbl.m_plot_id = master_payment_tbl.m_payment_plotid', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_payment_tbl.m_payment_company', 'left');
		$this->db->where('m_payment_id', $id);
		$res = $this->db->get('master_payment_tbl')->row();

		return $res;
	}

	public function get_payment_info_dtl($id)
	{
		$this->db->select('payment_info_tbl.*,master_plots_tbl.m_plot_name,m_company_name');
		$this->db->join('master_plots_tbl', 'master_plots_tbl.m_plot_id = payment_info_tbl.pt_dtl_plotid', 'left');
		$this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = master_payment_tbl.m_payment_company', 'left');
		$this->db->where('pt_dtl_paymentid', $id);
		$res = $this->db->get('payment_info_tbl')->result();

		return $res;
	}


	public function insert_payment()
	{

		$paymentid = $this->input->post('m_payment_id');

		if (!empty($this->input->post('is_dollar'))) {
			$is_dollar = 1;
			$dollar_exchng_rt = $this->input->post('dollar_exchng_rt');
		} else {
			$is_dollar = 0;
			$dollar_exchng_rt = 0;
		}

		$data = array(
			"m_payment_voucherno" => $this->input->post('m_payment_no'),
			"m_payment_company" => $this->input->post('m_payment_company'),
			"m_payment_date" => $this->input->post('m_payment_date'),
			"m_payment_plotid" => $this->input->post('m_payment_plotid'),
			"m_payment_type" => $this->input->post('m_payment_type'),
			"m_payment_narration" => $this->input->post('m_payment_narration'),
			"m_payment_mode" => $this->input->post('m_payment_mode'),
			"m_payment_amount" => $this->input->post('m_payment_amount'),
			"is_dollar" => $is_dollar,
			"dollar_exchng_rt" => $dollar_exchng_rt,

		);
		if (!empty($paymentid)) {
			$this->db->where('m_payment_id', $paymentid)->update('master_payment_tbl', $data);
			$payment_id = $paymentid;
			$res = 2;
		} else {
			$data['m_payment_added_on'] = date('Y-m-d H:i:s');
			$data['m_payment_status'] = 1;
			$this->db->insert('master_payment_tbl', $data);
			$payment_id = $this->db->insert_id();
			$res = 1;
		}

		$pt_dtl_id = $this->input->post('pt_dtl_id');
		$pt_dtl_plotid = $this->input->post('pt_dtl_plotid');
		$pt_dtl_amount = $this->input->post('pt_dtl_amount');
		$pt_dtl_remark = $this->input->post('pt_dtl_remark');

		for ($i = 0; $i < count($pt_dtl_plotid); $i++) {


			$data = array(
				"pt_dtl_paymentid" => $payment_id,
				"pt_dtl_plotid" => $pt_dtl_plotid[$i],
				"pt_dtl_amount" => $pt_dtl_amount[$i],
				"pt_dtl_remark" => $pt_dtl_remark[$i],

			);
			if (!empty($pt_dtl_id[$i])) {
				$this->db->where('pt_dtl_id', $pt_dtl_id[$i])->update('payment_info_tbl', $data);
				$res = 2;
			} else {
				$data['pt_dtl_addedon'] = date('Y-m-d H:i:s');
				$data['pt_dtl_status'] = 1;
				$this->db->insert('payment_info_tbl', $data);
				$res = 1;
			}
		}

		return $res;
	}

	public function delete_payment()
	{

		$this->db->where('m_payment_id', $this->input->post('delete_id'));
		$this->db->delete('master_payment_tbl');

		$this->db->where('pt_dtl_paymentid', $this->input->post('delete_id'));
		$this->db->delete('payment_info_tbl');

		return true;
	}
	//======================================================= payment =================================================//

	//======================================================= discount =================================================//

	public function get_discount_list()
	{
		$result = [];

		$this->db->select('discount_code, discount_name, start_date, end_date, discount_status, created_at');
		$this->db->group_by('discount_code');
		$this->db->order_by('discount_id', 'DESC');

		$res = $this->db->get('ticket_discounts')->result();

		if (empty($res)) {
			return [];
		}

		/* get all ranges in one query */
		$codes = array_column($res, 'discount_code');

		$ranges = $this->db
			->select('discount_id, discount_code, min_pack, max_pack, discount_percent')
			->where_in('discount_code', $codes)
			->get('ticket_discounts')
			->result();

		$range_map = [];

		foreach ($ranges as $r) {
			$range_map[$r->discount_code][] = [
				"discount_id" => $r->discount_id,
				"min_pack" => $r->min_pack,
				"max_pack" => $r->max_pack,
				"discount_percent" => $r->discount_percent
			];
		}

		foreach ($res as $value) {
			$value->discount_ranges = $range_map[$value->discount_code] ?? [];
			$result[] = $value;
		}

		return $result;
	}

	public function get_discount_dtl($code)
	{
		$rows = $this->db
			->where('discount_code', $code)
			->order_by('min_pack', 'ASC')
			->get('ticket_discounts')
			->result();

		if (empty($rows)) {
			return [];
		}

		$response = [
			"discount_code" => $rows[0]->discount_code,
			"discount_name" => $rows[0]->discount_name,
			"start_date" => $rows[0]->start_date,
			"end_date" => $rows[0]->end_date,
			"discount_status" => $rows[0]->discount_status,
			"discount_ranges" => []
		];

		foreach ($rows as $r) {
			$response["discount_ranges"][] = [
				"discount_id" => $r->discount_id,
				"min_pack" => $r->min_pack,
				"max_pack" => $r->max_pack,
				"discount_percent" => $r->discount_percent
			];
		}

		return $response;
	}

	public function insert_discount()
	{
		$discount_code = $this->input->post('discount_code');

		if (empty($discount_code)) {

			$last = $this->db->select('discount_code')
				->order_by('discount_id', 'DESC')
				->limit(1)
				->get('ticket_discounts')
				->row();

			$num = 1;

			if ($last) {
				$num = (int) substr($last->discount_code, -3) + 1;
			}

			$discount_code = 'DISC' . str_pad($num, 3, '0', STR_PAD_LEFT);
		}

		$discount_id = $this->input->post('discount_id');
		$min_packs = $this->input->post('min_pack');
		$max_packs = $this->input->post('max_pack');
		$percents = $this->input->post('discount_percent');

		$data_common = [
			'discount_code' => $discount_code,
			'discount_name' => $this->input->post('discount_name'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
			'discount_status' => $this->input->post('discount_status'),
			'created_by' => $this->session->userdata('user_id'),
			'created_at' => date('Y-m-d H:i')
		];

		foreach ($min_packs as $key => $min) {

			$data = $data_common;

			$data['min_pack'] = $min;
			$data['max_pack'] = $max_packs[$key] ?? null;
			$data['discount_percent'] = $percents[$key];

			if (!empty($discount_id[$key])) {
				$res = $this->db->where('discount_id', $discount_id[$key])->update('ticket_discounts', $data);
				$res1 = 2;
			} else {
				$res = $this->db->insert('ticket_discounts', $data);
				$res1 = 1;
			}
		}
		return $res1;
	}

	public function delete_discount()
	{
		$code = $this->input->post('delete_id');

		$this->db->where('discount_code', $code);
		return $this->db->delete('ticket_discounts');
	}

	public function get_applicable_discount()
	{
		$pack_size = $this->input->post('pack_size');
		$current_date = date('Y-m-d');
		
		$this->db->select('discount_percent')
		->from('ticket_discounts')
		->where('discount_status', 1)
		->where('start_date <=', $current_date)
		->where('end_date >=', $current_date)
		->where('min_pack <=', $pack_size)
		->where('max_pack >=', $pack_size)
		->order_by('discount_percent', 'DESC')->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$discount = $query->row()->discount_percent;
		} else {
			$discount = 0;
		}
		return $discount;
	}

	//======================================================= discount =================================================//



}
