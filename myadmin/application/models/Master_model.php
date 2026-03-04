<?php date_default_timezone_set('Asia/Kolkata');
class Master_model extends CI_model
{

  //========================== cashacc  =============================//
  public function get_all_cashacc()
  {
    $this->db->select('master_cashacc_tbl.*,master_accounts_tbl.*,m_dept_name')
      ->join('master_accounts_tbl', 'master_accounts_tbl.m_account_id = master_cashacc_tbl.m_cashacc_accname', 'left')
      ->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_cashacc_tbl.m_cashacc_dept', 'left');
    $this->db->order_by('m_cashacc_name');
    $res = $this->db->get('master_cashacc_tbl')->result();
    return $res;
  }

  public function get_active_cashacc($dept = '')
  {
    if (!empty($dept)) {
      $this->db->where('m_cashacc_dept', $dept);
    }
    $this->db->select('master_cashacc_tbl.*,master_accounts_tbl.*,m_dept_name')
      ->join('master_accounts_tbl', 'master_accounts_tbl.m_account_id = master_cashacc_tbl.m_cashacc_accname', 'left')
      ->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_cashacc_tbl.m_cashacc_dept', 'left');
    $res = $this->db->where('m_cashacc_status', 1)->get('master_cashacc_tbl')->result();
    return $res;
  }

  public function get_edit_cashacc($edid)
  {
    $this->db->select('master_cashacc_tbl.*,master_accounts_tbl.*,m_dept_name')
      ->join('master_accounts_tbl', 'master_accounts_tbl.m_account_id = master_cashacc_tbl.m_cashacc_accname', 'left')
      ->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_cashacc_tbl.m_cashacc_dept', 'left');
    $this->db->where('m_cashacc_id', $edid);
    $res = $this->db->get('master_cashacc_tbl')->row();
    return $res;
  }
  public function insert_cashacc()
  {

    $s_data = array(
      "m_cashacc_name" => $this->input->post('m_cashacc_name'),
      "m_cashacc_upiname" => $this->input->post('m_cashacc_upiname'),
      "m_cashacc_accname" => $this->input->post('m_cashacc_accname'),
      "m_cashacc_mobileno" => $this->input->post('m_cashacc_mobileno'),
      "m_cashacc_dept" => $this->input->post('m_cashacc_dept'),
      "m_cashacc_status" => $this->input->post('m_cashacc_status'),
      "m_cashacc_added_on" => date('Y-m-d H:i'),
    );
    $id = $this->input->post('m_cashacc_id');
    if (!empty($id)) {
      $this->db->where('m_cashacc_id', $id)->update('master_cashacc_tbl', $s_data);
      return 2;
    } else {
      $this->db->insert('master_cashacc_tbl', $s_data);
      return 1;
    }
  }

  public function delete_cashacc()
  {
    $this->db->where('m_cashacc_id', $this->input->post('delete_id'));
    return $this->db->delete('master_cashacc_tbl');
  }
  //========================== cashacc  =============================//

  //========================== State  =============================//
  public function get_all_state()
  {
    $this->db->select('*');
    $this->db->order_by('m_state_name');
    $res = $this->db->get('master_state_tbl')->result();
    return $res;
  }
  public function get_edit_state($edid)
  {
    $this->db->select('*');
    $this->db->where('m_state_id', $edid);
    $res = $this->db->get('master_state_tbl')->row();
    return $res;
  }
  public function insert_state()
  {

    $s_data = array(
      "m_state_name" => $this->input->post('m_state_name'),
      "m_state_country" => 1,
      "m_state_status" => $this->input->post('m_state_status'),
      "m_state_added_on" => date('Y-m-d H:i'),
    );
    $id = $this->input->post('m_state_id');
    if (!empty($id)) {
      $this->db->where('m_state_id', $id)->update('master_state_tbl', $s_data);
      return 2;
    } else {
      $this->db->insert('master_state_tbl', $s_data);
      return 1;
    }
  }

  public function delete_state()
  {
    $this->db->where('m_state_id', $this->input->post('delete_id'));
    return $this->db->delete('master_state_tbl');
  }
  //========================== State  =============================//


  //========================== City  =============================//

  public function get_all_city()
  {
    $this->db->select('*');
    $this->db->join('master_state_tbl', 'master_state_tbl.m_state_id = master_city_tbl.m_city_state', 'left');
    $this->db->order_by('m_city_name');
    $res = $this->db->get('master_city_tbl')->result();
    return $res;
  }
  public function get_edit_city($edid)
  {
    $this->db->select('*');
    $this->db->join('master_state_tbl', 'master_state_tbl.m_state_id = master_city_tbl.m_city_state', 'left');
    $this->db->where('m_city_id', $edid);
    $res = $this->db->get('master_city_tbl')->row();
    return $res;
  }

  public function insert_city()
  {

    $s_data = array(
      "m_city_name" => $this->input->post('m_city_name'),
      "m_city_state" => $this->input->post('m_city_state'),
      "m_city_country" => 1,
      "m_city_status" => $this->input->post('m_city_status'),
      "m_city_added_on" => date('Y-m-d H:i'),
    );
    $id = $this->input->post('m_city_id');
    if (!empty($id)) {
      $this->db->where('m_city_id', $id)->update('master_city_tbl', $s_data);
      return 2;
    } else {
      $this->db->insert('master_city_tbl', $s_data);
      return 1;
    }
  }

  public function insert_shortcut_city()
  {

    $check = $this->db->where("m_city_name", $this->input->post('m_city_name'))->where("m_city_state", $this->input->post('m_city_state'))->get('master_city_tbl')->row();

    if (empty($check)) {

      $s_data = array(
        "m_city_name" => $this->input->post('m_city_name'),
        "m_city_state" => $this->input->post('m_city_state'),
        "m_city_country" => 1,
        "m_city_status" => 1,
        "m_city_added_on" => date('Y-m-d H:i'),
      );

      $this->db->insert('master_city_tbl', $s_data);
      return $this->db->insert_id();
    } else {
      return $check->m_city_id;
    }
  }


  public function delete_city()
  {
    $this->db->where('m_city_id', $this->input->post('delete_id'));
    return $this->db->delete('master_city_tbl');
  }
  //Country State City
  public function get_active_country()
  {
    $this->db->select('*');
    $this->db->where('m_country_status', '1');
    $this->db->order_by('m_country_name');
    $res = $this->db->get('master_country_tbl')->result();
    return $res;
  }
  public function get_active_state()
  {
    $this->db->select('*');
    $this->db->where('m_state_status', '1');
    $this->db->where('m_state_country', '1');
    $this->db->order_by('m_state_name');
    $res = $this->db->get('master_state_tbl')->result();
    return $res;
  }
  public function get_active_city()
  {
    $this->db->select('city.m_city_name,city.m_city_id,state.m_state_name');
    $this->db->join('master_state_tbl state', 'state.m_state_id = city.m_city_state', 'left');
    $this->db->where('m_city_status', '1');
    $this->db->order_by('m_city_name');
    $res = $this->db->get('master_city_tbl city')->result();
    return $res;
  }
  //=========================================== city ===============================================//

  //===================== saleshead =======================//
  public function all_saleshead()
  {
    $res = $this->db->select('*')->where('m_saleshead_type', 1)->get('master_saleshead_tbl')->result();
    return $res;
  }

  public function all_instraction_list()
  {
    $res = $this->db->select('*')->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_saleshead_tbl.m_saleshead_dept', 'left')->where('m_saleshead_type', 2)->get('master_saleshead_tbl')->result();
    return $res;
  }

  public function all_active_saleshead()
  {
    $res = $this->db->select('*')->where('m_saleshead_status', 1)->where('m_saleshead_type', 1)->get('master_saleshead_tbl')->result();
    return $res;
  }

  public function insert_saleshead()
  {

    $salesheadid = $this->input->post('m_saleshead_id');
    $salesheadname = $this->input->post('m_saleshead_title');

    $check = $this->db->where('m_saleshead_title', $salesheadname)->get('master_saleshead_tbl')->result();

    if (!empty($check) && empty($salesheadid)) {

      return false;
    } else {

      $insert_data = array(
        "m_saleshead_title"    => $salesheadname,
        "m_saleshead_dept"    => $this->input->post('m_saleshead_dept') ?: '',
        "m_saleshead_status"    => $this->input->post('m_saleshead_status'),
        "m_saleshead_type"    => $this->input->post('m_saleshead_type'),
        "m_saleshead_discount"    => $this->input->post('m_saleshead_discount') ?: '',
        "m_saleshead_gst"    => $this->input->post('m_saleshead_gst') ?: '',
        "m_saleshead_added_on" => date('Y-m-d H:i:s'),

      );

      if (!empty($salesheadid)) {
        $this->db->where('m_saleshead_id', $salesheadid)->update('master_saleshead_tbl', $insert_data);
        return 2;
      } else {
        $this->db->insert('master_saleshead_tbl', $insert_data);
        return 1;
      }
    }
  }


  public function get_edit_saleshead($id)
  {
    $this->db->select('*');
    $this->db->where('m_saleshead_id', $id);
    $data = $this->db->get('master_saleshead_tbl');
    return $data->row();
  }

  public function delete_saleshead()
  {
    $this->db->where('m_saleshead_id', $this->input->post('delete_id'));
    $this->db->delete('master_saleshead_tbl');
    return true;
  }
  //===================== saleshead =======================//

  //===================== lockercode =======================//



  public function locker_booked_List()
  {

    if (!empty($this->input->get('id'))) {
      $this->db->where('m_locker_id !=', $this->input->get('id'));
    }

    $lockerid = $this->db->select('m_locker_B,m_locker_L,m_locker_G')->where('m_locker_status', 1)->get('locker_wp_tbl')->result();
    if (!empty($lockerid)) {
      foreach ($lockerid as $key) {
        $catAll[] = $key->m_locker_B . ',' . $key->m_locker_G . ',' . $key->m_locker_L . ',';
      }
      $allID = implode(',', $catAll);
      return  $allID;
    } else {
      return  '0';
    }
  }

  public function all_lockercode()
  {
    $res = $this->db->select('*')->get('master_lockercode_tbl')->result();
    return $res;
  }

  public function get_catB_lockercode()
  {
    $booked_id = explode(',', $this->locker_booked_List());
    $res = $this->db->select('m_lockercode_id,m_lockercode_title')->where_not_in('m_lockercode_id', $booked_id)->where('m_lockercode_category', 'Locker B')->where('m_lockercode_status', 1)->get('master_lockercode_tbl')->result();
    return $res;
  }

  public function get_catL_lockercode()
  {
    $booked_id = explode(',', $this->locker_booked_List());
    $res = $this->db->select('m_lockercode_id,m_lockercode_title')->where_not_in('m_lockercode_id', $booked_id)->where('m_lockercode_category', 'Locker L')->where('m_lockercode_status', 1)->get('master_lockercode_tbl')->result();
    return $res;
  }
  public function get_catG_lockercode()
  {
    $booked_id = explode(',', $this->locker_booked_List());
    $res = $this->db->select('m_lockercode_id,m_lockercode_title')->where_not_in('m_lockercode_id', $booked_id)->where('m_lockercode_category', 'Locker G')->where('m_lockercode_status', 1)->get('master_lockercode_tbl')->result();
    return $res;
  }

  public function insert_lockercode()
  {

    $lockercodeid = $this->input->post('m_lockercode_id');
    $lockercodename = $this->input->post('m_lockercode_title');

    $check = $this->db->where('m_lockercode_title', $lockercodename)->get('master_lockercode_tbl')->result();

    if (!empty($check) && empty($lockercodeid)) {

      return false;
    } else {
      $insert_data = array(
        "m_lockercode_title"    => $lockercodename,
        "m_lockercode_status"    => $this->input->post('m_lockercode_status'),
        "m_lockercode_category"    => $this->input->post('m_lockercode_category'),
        "m_lockercode_rent"    => $this->input->post('m_lockercode_rent'),
        "m_lockercode_added_on" => date('Y-m-d H:i:s'),

      );

      if (!empty($lockercodeid)) {
        $this->db->where('m_lockercode_id', $lockercodeid)->update('master_lockercode_tbl', $insert_data);
        return 2;
      } else {
        $this->db->insert('master_lockercode_tbl', $insert_data);
        return 1;
      }
    }
  }


  public function get_edit_lockercode($id)
  {
    $this->db->select('*');
    $this->db->where('m_lockercode_id', $id);
    $data = $this->db->get('master_lockercode_tbl');
    return $data->row();
  }

  public function delete_lockercode()
  {
    $this->db->where('m_lockercode_id', $this->input->post('delete_id'));
    $this->db->delete('master_lockercode_tbl');
    return true;
  }
  //===================== lockercode =======================//

  //===================== perm =======================//
  public function all_perm()
  {
    $res = $this->db->select('*')->order_by('m_perm_module_slug')->order_by('m_perm_id')->get('master_permission_tbl')->result();
    return $res;
  }

  public function insert_perm()
  {

    $permid = $this->input->post('m_perm_id');
    $permname = $this->input->post('m_perm_submodule_slug');

    $check = $this->db->where('m_perm_submodule_slug', $permname)->get('master_permission_tbl')->result();

    if (!empty($check) && empty($permid)) {

      return false;
    } else {
      $insert_data = array(
        "m_perm_name"    => $this->input->post('m_perm_name'),
        "m_perm_status"    => $this->input->post('m_perm_status'),
        "m_perm_module"    => $this->input->post('m_perm_module'),
        "m_perm_module_slug"    => $this->input->post('m_perm_module_slug'),
        "m_perm_submodule_slug"    => $permname,
        "m_perm_added_on" => date('Y-m-d H:i:s'),

      );

      if (!empty($permid)) {
        $this->db->where('m_perm_id', $permid)->update('master_permission_tbl', $insert_data);
        return 2;
      } else {
        $this->db->insert('master_permission_tbl', $insert_data);
        return 1;
      }
    }
  }


  public function get_edit_perm($id)
  {
    $this->db->select('*');
    $this->db->where('m_perm_id', $id);
    $data = $this->db->get('master_permission_tbl');
    return $data->row();
  }

  public function delete_perm()
  {
    $this->db->where('m_perm_id', $this->input->post('delete_id'));
    $this->db->delete('master_permission_tbl');
    return true;
  }
  //===================== perm =======================//


  //===================== userperm =======================//
  public function all_userperm_list()
  {
    $res = $this->db->select('*')->get('master_user_permission_tbl')->result();
    return $res;
  }

  public function insert_userperm()
  {

    
    $permid = $this->input->post('permid');
    $modulee = $this->input->post('modulee');
    $submodule = $this->input->post('submodule');
    $userpermid = $this->input->post('userpermid');
    $userid = $this->input->post('userid');
    $name = $this->input->post('name');
    $value = $this->input->post('value');
    
    
    $insert_data = array(
      "m_userperm_userId"    => $userid,
      "m_userperm_module"    => $modulee,
      "m_userperm_submodule"    => $submodule,
      "m_userperm_permId"    => $permid,
      $name    => $value,
      
    );
    
    if (!empty($userpermid)) {
      $this->db->where('m_userperm_id', $userpermid)->update('master_user_permission_tbl', $insert_data);
      return 2;
    } else {
      $check = $this->db->select()->where('m_userperm_userId',$userid)->where('m_userperm_permId',$permid)->get('master_user_permission_tbl')->row();
      if(!empty($check)){
        $this->db->where('m_userperm_id', $check->m_userperm_id)->update('master_user_permission_tbl', $insert_data);
        return 2;
      }else {
        $insert_data["m_userperm_added_on"] = date('Y-m-d H:i:s');
        $this->db->insert('master_user_permission_tbl', $insert_data);
        return 1;
      }
     
    }
  }

  // public function insertuserperm()
  // {

  //   $m_userperm_permId = $this->input->post('m_userperm_permId');
  //   $m_userperm_userId = $this->input->post('m_userperm_userId');
  //   $m_userperm_module = $this->input->post('m_userperm_module');
  //   $m_userperm_submodule = $this->input->post('m_userperm_submodule');
  //   $m_userperm_list = $this->input->post('m_userperm_list');
  //   $m_userperm_add = $this->input->post('m_userperm_add');
  //   $m_userperm_edit = $this->input->post('m_userperm_edit');
  //   $m_userperm_delete = $this->input->post('m_userperm_delete');
  //   $m_userperm_export = $this->input->post('m_userperm_export');
  //   $m_userperm_filter = $this->input->post('m_userperm_filter');

  //   for ($i = 0; $i < count($m_userperm_permId); $i++) {
  //     if (!empty($m_userperm_list[$i]) || !empty($m_userperm_add[$i]) || !empty($m_userperm_edit[$i]) || !empty($m_userperm_delete[$i]) || !empty($m_userperm_export[$i]) || !empty($m_userperm_filter[$i])) {

  //       if (!empty($m_userperm_list[$i])) {
  //         $userperm_list = 1;
  //       } else {
  //         $userperm_list = 0;
  //       }

  //       if (!empty($m_userperm_add[$i])) {
  //         $userperm_add = 1;
  //       } else {
  //         $userperm_add = 0;
  //       }

  //       if (!empty($m_userperm_edit[$i])) {
  //         $userperm_edit = 1;
  //       } else {
  //         $userperm_edit = 0;
  //       }

  //       if (!empty($m_userperm_delete[$i])) {
  //         $userperm_delete = 1;
  //       } else {
  //         $userperm_delete = 0;
  //       }

  //       if (!empty($m_userperm_export[$i])) {
  //         $userperm_export = 1;
  //       } else {
  //         $userperm_export = 0;
  //       }

  //       if (!empty($m_userperm_filter[$i])) {
  //         $userperm_filter = 1;
  //       } else {
  //         $userperm_filter = 0;
  //       }
  //       $insert_data = array(
  //         "m_userperm_userId"    => $m_userperm_userId,
  //         "m_userperm_module"    => $m_userperm_module[$i],
  //         "m_userperm_submodule"    => $m_userperm_submodule[$i],
  //         "m_userperm_permId"    => $m_userperm_permId[$i],
  //         "m_userperm_list"    => $userperm_list,
  //         "m_userperm_add"    => $userperm_add,
  //         "m_userperm_edit"    => $userperm_edit,
  //         "m_userperm_delete"    => $userperm_delete,
  //         "m_userperm_export"    => $userperm_export,
  //         "m_userperm_filter"    => $userperm_filter,
  //         "m_userperm_added_on" => date('Y-m-d H:i:s'),

  //       );
  //       $this->db->insert('master_user_permission_tbl', $insert_data);
  //     }
  //   }

  //   //  return $indata ;

  // }


  public function get_userperm_userId($id)
  {
    $this->db->select('*');
    $this->db->where('m_userperm_userId', $id);
    $this->db->order_by('m_userperm_module')->order_by('m_userperm_permId');
    $data = $this->db->get('master_user_permission_tbl');
    return $data->result();
  }

  // public function delete_userperm()
  // {
  //   $this->db->where('m_userperm_id', $this->input->post('delete_id'));
  //   $this->db->delete('master_user_permission_tbl');
  //   return true;
  // }
  //===================== userperm =======================//





  //======================================================= purchase =================================================//

  public function get_last_purid($type)
  {
    if ($type == 1) {
      $lastid = $this->db->select('ivt_purchase_no')->where('ivt_purchase_mode !=', 3)->order_by('ivt_purchase_id', 'desc')->get('inventory_purchase_tbl')->row();
    } else {
      $lastid =  $this->db->select('ivt_purchase_no')->where('ivt_purchase_mode', 3)->order_by('ivt_purchase_id', 'desc')->get('inventory_purchase_tbl')->row();
    }

    if (!empty($lastid)) {
      return (explode('-', $lastid->ivt_purchase_no)[1] + 1);
    } else {
      return 1;
    }
  }

  public function get_purchase_order_list($from_date, $to_date)
  {
    $this->db->select('ivt_purchase_id,ivt_purchase_mode,ivt_purchase_no,ivt_purchase_date,ivt_purchase_company,ivt_purchase_status,ivt_purchase_addedby,ivt_purchase_addedon,m_company_name,(Select sum(ivt_product_qty) as total_qty from inventory_product_tbl where ivt_product_purchaseid = ivt_purchase_id) as total_qty,(Select group_concat(m_product_name) as product_name from inventory_product_tbl LEFT JOIN master_product_tbl ON inventory_product_tbl.ivt_product_name = master_product_tbl.m_product_id where ivt_product_purchaseid = ivt_purchase_id) as product_name');
    $this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = inventory_purchase_tbl.ivt_purchase_company', 'left');
    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(ivt_purchase_addedon,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(ivt_purchase_addedon,"%Y-%m-%d")<=', $to_date);
    }
    $res = $this->db->where('ivt_purchase_mode', 1)->get('inventory_purchase_tbl')->result();
    return $res;
  }

  public function get_purchase_invoice_list($from_date, $to_date)
  {
    $this->db->select('inventory_purchase_tbl.*,m_company_name,m_supplier_name,m_supplier_mobile');
    $this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = inventory_purchase_tbl.ivt_purchase_company', 'left');
    $this->db->join('master_supplier_tbl', 'master_supplier_tbl.m_supplier_id = inventory_purchase_tbl.ivt_purchase_partyid', 'left');
    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(ivt_purchase_addedon,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(ivt_purchase_addedon,"%Y-%m-%d")<=', $to_date);
    }
    $res = $this->db->where('ivt_purchase_mode', 2)->get('inventory_purchase_tbl')->result();
    return $res;
  }

  public function get_purchase_return_list($from_date, $to_date)
  {
    $this->db->select('inventory_purchase_tbl.*,m_company_name,m_supplier_name,m_supplier_mobile');
    $this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = inventory_purchase_tbl.ivt_purchase_company', 'left');
    $this->db->join('master_supplier_tbl', 'master_supplier_tbl.m_supplier_id = inventory_purchase_tbl.ivt_purchase_partyid', 'left');
    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(ivt_purchase_addedon,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(ivt_purchase_addedon,"%Y-%m-%d")<=', $to_date);
    }
    $res = $this->db->where('ivt_purchase_mode', 3)->get('inventory_purchase_tbl')->result();
    return $res;
  }


  public function get_Active_purchase()
  {
    $res = $this->db->get('inventory_purchase_tbl')->result();
    return $res;
  }


  public function get_purchase_dtl($id)
  {
    $this->db->select('inventory_purchase_tbl.*,m_company_name,m_supplier_name,m_supplier_mobile');
    $this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = inventory_purchase_tbl.ivt_purchase_company', 'left');
    $this->db->join('master_supplier_tbl', 'master_supplier_tbl.m_supplier_id = inventory_purchase_tbl.ivt_purchase_partyid', 'left');
    $this->db->where('ivt_purchase_id', $id);
    $res = $this->db->get('inventory_purchase_tbl')->row();

    return $res;
  }

  public function get_purchase_info_dtl($id)
  {
    $this->db->select('inventory_product_tbl.*,master_product_tbl.m_product_name,prounit.m_prodgroup_name as unitname');
    $this->db->join('master_product_tbl', 'master_product_tbl.m_product_id = inventory_product_tbl.ivt_product_name', 'left');
    $this->db->join('master_prodgroup_tbl prounit', 'prounit.m_prodgroup_id = master_product_tbl.m_product_unit', 'left');
    $this->db->where('ivt_product_purchaseid', $id);
    $res = $this->db->order_by('m_product_id')->get('inventory_product_tbl')->result();

    return $res;
  }

  public function get_blcnd_puritms($id)
  {
    $result = array();
    $pur_itm_dtl = $this->get_purchase_info_dtl($id);

    $rtn_dtl = $this->db->select('Group_concat(ivt_purchase_id) as ivt_purchase_id,Group_concat(ivt_purchase_no) as ivt_purchase_no,Group_concat(ivt_purchase_date) as ivt_purchase_date')
      ->where('ivt_purchase_purid', $id)->where('ivt_purchase_mode', 3)->get('inventory_purchase_tbl')->row();
    // echo '<pre>'; print_r($rtn_dtl); die ;


    if (!empty($pur_itm_dtl)) {
      foreach ($pur_itm_dtl as $key) {

        $balance_qty = $key->ivt_product_qty;
        if (!empty($rtn_dtl)) {

          $rtn_itm_dtl = $this->db->select('sum(ivt_product_qty) as ivt_product_qty')->where_in('ivt_product_purchaseid', explode(',', $rtn_dtl->ivt_purchase_id))->where('ivt_product_name', $key->ivt_product_name)->where('ivt_product_size', $key->ivt_product_size)->group_by('ivt_product_name')->group_by('ivt_product_size')->get('inventory_product_tbl')->result();

          if (isset($rtn_itm_dtl[0]->ivt_product_qty)) {
            $balance_qty = $key->ivt_product_qty - $rtn_itm_dtl[0]->ivt_product_qty;
          }
        }

        $prod_amount = ($balance_qty * $key->ivt_product_rate);
        $res = (object) array(
          "ivt_product_purchaseid" => $key->ivt_product_purchaseid,
          "ivt_product_name" => $key->ivt_product_name,
          "m_product_name" => $key->m_product_name,
          "m_unit_name" => $key->unitname,
          "ivt_product_size" => $key->ivt_product_size,
          "ivt_product_qty" => $balance_qty,
          "ivt_product_rate" => $key->ivt_product_rate,
          "ivt_product_disc" => $key->ivt_product_disc,
          // "ivt_product_netrate" => $key->ivt_product_netrate,
          "ivt_product_taxable" => $key->ivt_product_taxable,
          "ivt_product_mode" => $key->ivt_product_mode,
          "ivt_product_amount" => $prod_amount,
          "ivt_product_added_on" => $key->ivt_product_added_on,
        );
        $result[] = $res;
      }
    }
    return $result;
  }

  public function insert_purchase()
  {

    $purchaseid = $this->input->post('ivt_purchase_id');
    $purcmode = $this->input->post('ivt_purchase_mode');
    if ($purcmode == 1) {
      $data = array(
        "ivt_purchase_mode" => $this->input->post('ivt_purchase_mode'),
        "ivt_purchase_company" => $this->input->post('ivt_purchase_company'),
        "ivt_purchase_no" => $this->input->post('ivt_purchase_no'),
        "ivt_purchase_date" => $this->input->post('ivt_purchase_date'),
      );
    } else {
      $data = array(
        "ivt_purchase_mode" => $this->input->post('ivt_purchase_mode'),
        "ivt_purchase_type" => $this->input->post('ivt_purchase_type'),
        "ivt_purchase_company" => $this->input->post('ivt_purchase_company'),
        // "ivt_purchase_account" => $this->input->post('ivt_purchase_account'),
        // "ivt_purchase_godown" => $this->input->post('ivt_purchase_godown'),
        "ivt_purchase_paymode" => $this->input->post('ivt_purchase_paymode'),
        "ivt_purchase_invno" => $this->input->post('ivt_purchase_invno'),
        "ivt_purchase_invdate" => $this->input->post('ivt_purchase_invdate'),
        "ivt_purchase_no" => $this->input->post('ivt_purchase_no'),
        "ivt_purchase_date" => $this->input->post('ivt_purchase_date'),
        "ivt_purchase_cashacc" => $this->input->post('ivt_purchase_cashacc'),
        "ivt_purchase_partyid" => $this->input->post('ivt_purchase_partyid'),
        "ivt_purchase_purid" => $this->input->post('ivt_purchase_purid') ?: '',
        "ivt_purchase_advance" => $this->input->post('ivt_purchase_advance'),
        "ivt_purchase_balance" => $this->input->post('ivt_purchase_balance'),
        "ivt_purchase_remark" => $this->input->post('ivt_purchase_remark'),
        "ivt_purchase_nopkgs" => $this->input->post('ivt_purchase_nopkgs'),
        "ivt_purchase_vehical" => $this->input->post('ivt_purchase_vehical'),
        "ivt_purchase_billtyno" => $this->input->post('ivt_purchase_billtyno'),
        "ivt_purchase_billtydate" => $this->input->post('ivt_purchase_billtydate'),
        "ivt_purchase_waybill" => $this->input->post('ivt_purchase_waybill'),
        "ivt_purchase_waydate" => $this->input->post('ivt_purchase_waydate'),
        "ivt_purchase_nbremark" => $this->input->post('ivt_purchase_nbremark'),
        "ivt_purchase_creditdays" => $this->input->post('ivt_purchase_creditdays'),
        "ivt_purchase_Tamount" => $this->input->post('ivt_purchase_Tamount'),
        "ivt_purchase_disc" => $this->input->post('ivt_purchase_disc'),
        "ivt_purchase_freight" => $this->input->post('ivt_purchase_freight'),
        "ivt_purchase_pking" => $this->input->post('ivt_purchase_pking'),
        "ivt_purchase_netamount" => $this->input->post('ivt_purchase_netamount'),
        "ivt_purchase_Tqty" => $this->input->post('ivt_purchase_Tqty'),
        "ivt_purchase_Tdisc" => $this->input->post('ivt_purchase_Tdisc'),
        "ivt_purchase_taxable" => $this->input->post('ivt_purchase_taxable'),
        "ivt_purchase_cgst" => $this->input->post('ivt_purchase_cgst'),
        "ivt_purchase_sgst" => $this->input->post('ivt_purchase_sgst'),
        "ivt_purchase_cess" => $this->input->post('ivt_purchase_cess'),

      );
    }

    if (!empty($purchaseid)) {
      $this->db->where('ivt_purchase_id', $purchaseid)->update('inventory_purchase_tbl', $data);
      $purchase_id = $purchaseid;
      $res = 2;
    } else {
      $data['ivt_purchase_addedby'] = $this->session->userdata('user_id');
      $data['ivt_purchase_addedon'] = date('Y-m-d H:i:s');

      $this->db->insert('inventory_purchase_tbl', $data);
      $purchase_id = $this->db->insert_id();
      $res = 1;
    }

    $ivt_product_id = $this->input->post('ivt_product_id');
    $ivt_product_name = $this->input->post('ivt_product_name');
    $ivt_product_size = $this->input->post('ivt_product_size');
    $ivt_product_qty = $this->input->post('ivt_product_qty');
    $ivt_product_rate = $this->input->post('ivt_product_rate');
    $ivt_product_disc = $this->input->post('ivt_product_disc');
    $ivt_product_taxable = $this->input->post('ivt_product_taxable');
    $ivt_product_netrate = $this->input->post('ivt_product_netrate');
    $ivt_product_amount = $this->input->post('ivt_product_amount');

    for ($i = 0; $i < count($ivt_product_qty); $i++) {

      $data = array(
        "ivt_product_purchaseid" => $purchase_id,
        "ivt_product_name" => $ivt_product_name[$i],
        "ivt_product_size" => $ivt_product_size[$i],
        "ivt_product_qty" => $ivt_product_qty[$i],
        "ivt_product_rate" => $ivt_product_rate[$i] ?: 0,
        "ivt_product_disc" => $ivt_product_disc[$i] ?: 0,
        "ivt_product_netrate" => $ivt_product_netrate[$i] ?: 0,
        "ivt_product_taxable" => $ivt_product_taxable[$i] ?: 0,
        "ivt_product_mode" => $this->input->post('ivt_purchase_mode'),
        "ivt_product_amount" => $ivt_product_amount[$i] ?: 0,

      );
      if (!empty($ivt_product_id[$i])) {
        $this->db->where('ivt_product_id', $ivt_product_id[$i])->update('inventory_product_tbl', $data);
        $res = 2;
      } else {
        $data['ivt_product_added_on'] = date('Y-m-d H:i:s');
        $data['ivt_product_status'] = 1;
        $this->db->insert('inventory_product_tbl', $data);
        $res = 1;
      }
    }

    if (!empty($this->input->post('request_id'))) {
      $req_ids = implode(',', $this->input->post('request_id'));
      $this->db->set('m_reqmt_status', 2)->where_in('m_reqmt_id', explode(',', $req_ids))->update('material_requirement_tbl');
    }

    return $res;
  }

  public function delete_purchase()
  {

    $this->db->where('ivt_purchase_id', $this->input->post('delete_id'));
    $this->db->delete('inventory_purchase_tbl');

    $this->db->where('ivt_product_purchaseid', $this->input->post('delete_id'));
    $this->db->delete('inventory_product_tbl');

    return true;
  }
  //======================================================= purchase =================================================//

  //======================================================= requirement =================================================//

  public function get_requirement_list_by($ids)
  {

    if (!empty($ids)) {
      $this->db->where_in('m_reqmt_id', $ids);
    }

    $this->db->select('group_concat(m_reqmt_id) as m_reqmt_id,m_reqmt_item,m_reqmt_size,sum(m_reqmt_qty) as tqty,m_product_name,prounit.m_prodgroup_name as product_unit,prosize.m_prodgroup_name as product_size');
    $this->db->join('master_product_tbl', 'master_product_tbl.m_product_id = material_requirement_tbl.m_reqmt_item', 'left');
    $this->db->join('master_prodgroup_tbl prounit', 'prounit.m_prodgroup_id = master_product_tbl.m_product_unit', 'left');
    $this->db->join('master_prodgroup_tbl prosize', 'prosize.m_prodgroup_id = material_requirement_tbl.m_reqmt_size', 'left');
    return $this->db->group_by('m_reqmt_item')->group_by('m_reqmt_size')->get('material_requirement_tbl')->result();
  }

  public function get_requirement_list($from_date, $to_date)
  {

    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(m_reqmt_date,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {

      $this->db->where('DATE_FORMAT(m_reqmt_date,"%Y-%m-%d")<=', $to_date);
    }
    $this->db->select('material_requirement_tbl.*,m_dept_name,m_product_name,prounit.m_prodgroup_name as product_unit,prosize.m_prodgroup_name as product_size,m_admin_name');
    $this->db->join('master_product_tbl', 'master_product_tbl.m_product_id = material_requirement_tbl.m_reqmt_item', 'left');
    $this->db->join('master_prodgroup_tbl prounit', 'prounit.m_prodgroup_id = master_product_tbl.m_product_unit', 'left');
    $this->db->join('master_prodgroup_tbl prosize', 'prosize.m_prodgroup_id = material_requirement_tbl.m_reqmt_size', 'left');
    $this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = material_requirement_tbl.m_reqmt_dept', 'left');
    $this->db->join('master_admin_tbl', 'master_admin_tbl.m_admin_id = material_requirement_tbl.m_reqmt_addedby', 'left');
    $res = $this->db->get('material_requirement_tbl')->result();
    return $res;
  }


  public function get_requirement_dtl($id)
  {
    $this->db->select('material_requirement_tbl.*,m_dept_name,m_product_name,prounit.m_prodgroup_name as product_unit,prosize.m_prodgroup_name as product_size,m_admin_name');
    $this->db->join('master_product_tbl', 'master_product_tbl.m_product_id = material_requirement_tbl.m_reqmt_item', 'left');
    $this->db->join('master_prodgroup_tbl prounit', 'prounit.m_prodgroup_id = master_product_tbl.m_product_unit', 'left');
    $this->db->join('master_prodgroup_tbl prosize', 'prosize.m_prodgroup_id = material_requirement_tbl.m_reqmt_size', 'left');
    $this->db->join('master_department_tbl', 'master_department_tbl.m_dept_id = material_requirement_tbl.m_reqmt_dept', 'left');
    $this->db->join('master_admin_tbl', 'master_admin_tbl.m_admin_id = material_requirement_tbl.m_reqmt_addedby', 'left');
    $this->db->where('m_reqmt_uno', $id);
    return $this->db->get('material_requirement_tbl')->result();
  }


  public function insert_requirements()
  {

    $requirementid = $this->input->post('m_reqmt_id');

    $reqmt_item = $this->input->post('m_reqmt_item');
    $reqmt_size = $this->input->post('m_reqmt_size');
    $reqmt_qty = $this->input->post('m_reqmt_qty');
    $reqmt_remark = $this->input->post('m_reqmt_remark');
    // $reqmt_remark2 = $this->input->post('m_reqmt_remark2');
    $reqmt_uno = date('ymdi') . $this->input->post('m_reqmt_dept') . $this->session->userdata('user_id');


    for ($i = 0; $i < count($reqmt_item); $i++) {

      $data = array(
        "m_reqmt_dept" => $this->input->post('m_reqmt_dept'),
        "m_reqmt_date" => $this->input->post('m_reqmt_date'),
        "m_reqmt_item" => $reqmt_item[$i],
        "m_reqmt_size" => $reqmt_size[$i],
        "m_reqmt_qty" => $reqmt_qty[$i],
        "m_reqmt_remark" => $reqmt_remark[$i],
        // "m_reqmt_remark2" => $reqmt_remark2[$i],

      );
      if (!empty($requirementid[$i])) {

        $data['m_reqmt_updatedon'] = date('Y-m-d H:i');
        $data['m_reqmt_updatedby'] = $this->session->userdata('user_id');
        $this->db->where('m_reqmt_id', $requirementid[$i])->update('material_requirement_tbl', $data);
        // $requirement_id = $requirementid;
        $res = 2;
      } else {
        $data['m_reqmt_uno'] = $reqmt_uno;
        $data['m_reqmt_addedon'] = date('Y-m-d H:i');
        $data['m_reqmt_addedby'] = $this->session->userdata('user_id');
        $data['m_reqmt_status'] = 1;
        $this->db->insert('material_requirement_tbl', $data);
        // $requirement_id = $this->db->insert_id();
        $res = 1;
      }
    }

    return $res;
  }

  public function delete_requirement()
  {

    $this->db->where('m_reqmt_id', $this->input->post('delete_id'));
    $this->db->delete('material_requirement_tbl');

    return true;
  }
  //=======================================================requirement=================================================//


  //=======================================================stkjn=================================================//


  public function get_stkjn_list($from_date, $to_date, $itemid = '', $godown = '')
  {

    $this->db->select('ivt_stkjn_no,ivt_stkjn_date,ivt_stkjn_company,ivt_stkjn_godown,ivt_stkjn_dept,group_concat(ivt_stkjn_product) as itemid,sum(ivt_stkjn_prodqty) as totqty,sum(ivt_stkjn_tamt) as total_amt,ivt_stkjn_remark,ivt_stkjn_status,addedby.m_admin_name,m_godown_name,m_company_name');
    $this->db->join('master_godown_tbl', 'master_godown_tbl.m_godown_id = insjt.ivt_stkjn_godown', 'left');
    $this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = insjt.ivt_stkjn_company', 'left');
    $this->db->join('master_admin_tbl addedby', 'addedby.m_admin_id = insjt.ivt_stkjn_addedby', 'left');
    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(ivt_stkjn_date,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(ivt_stkjn_date,"%Y-%m-%d")<=', $to_date);
    }

    if (!empty($itemid)) {
      $this->db->where('ivt_stkjn_product', $itemid);
    }
    if (!empty($godown)) {
      $this->db->where('ivt_stkjn_godown', $godown);
    }

    $this->db->group_by('ivt_stkjn_no');
    $this->db->order_by('ivt_stkjn_no', 'desc');
    return $this->db->get('inventory_stockjournal_tbl insjt')->result();
  }


  public function get_stkjn_dtl($stkjn_no)
  {

    $this->db->select('ivt_stkjn_no,ivt_stkjn_date,ivt_stkjn_company,ivt_stkjn_godown,ivt_stkjn_dept,group_concat(ivt_stkjn_product) as itemid,sum(ivt_stkjn_prodqty) as totqty,sum(ivt_stkjn_tamt) as total_amt,ivt_stkjn_remark,ivt_stkjn_status,addedby.m_admin_name,m_godown_name,m_company_name');
    $this->db->join('master_godown_tbl', 'master_godown_tbl.m_godown_id = insjt.ivt_stkjn_godown', 'left');
    $this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = insjt.ivt_stkjn_company', 'left');
    $this->db->join('master_admin_tbl addedby', 'addedby.m_admin_id = insjt.ivt_stkjn_addedby', 'left');
    $this->db->where('ivt_stkjn_no', $stkjn_no);
    $this->db->group_by('ivt_stkjn_no');
    $sale_datil = $this->db->get('inventory_stockjournal_tbl insjt')->result();

    $this->db->select('ivt_stkjn_id,ivt_stkjn_no,ivt_stkjn_prodsize,ivt_stkjn_product,ivt_stkjn_prodqty,ivt_stkjn_prodrate,ivt_stkjn_tamt,m_product_name,prosize.m_prodgroup_name as productsize,prounit.m_prodgroup_name as productunit');
    $this->db->join('master_product_tbl', 'master_product_tbl.m_product_id = insjt.ivt_stkjn_product', 'left');
    $this->db->join('master_prodgroup_tbl prounit', 'prounit.m_prodgroup_id = master_product_tbl.m_product_unit', 'left');
    $this->db->join('master_prodgroup_tbl prosize', 'prosize.m_prodgroup_id = insjt.ivt_stkjn_prodsize', 'left');
    $this->db->where('ivt_stkjn_no', $stkjn_no);

    $sale_items =  $this->db->get('inventory_stockjournal_tbl insjt')->result();

    if (!empty($sale_datil)) {
      $res = (object) array(
        'ivt_stkjn_no' => $sale_datil[0]->ivt_stkjn_no,
        'ivt_stkjn_date' => $sale_datil[0]->ivt_stkjn_date,
        'ivt_stkjn_company' => $sale_datil[0]->ivt_stkjn_company,
        'ivt_stkjn_godown' => $sale_datil[0]->ivt_stkjn_godown,
        'ivt_stkjn_dept' => $sale_datil[0]->ivt_stkjn_dept,
        'itemid' => $sale_datil[0]->itemid,
        'totqty' => $sale_datil[0]->totqty,
        'total_amt' => $sale_datil[0]->total_amt,
        'ivt_stkjn_remark' => $sale_datil[0]->ivt_stkjn_remark,
        'ivt_stkjn_status' => $sale_datil[0]->ivt_stkjn_status,
        'm_admin_name' => $sale_datil[0]->m_admin_name,
        'm_godown_name' => $sale_datil[0]->m_godown_name,
        'm_company_name' => $sale_datil[0]->m_company_name,
        "ivt_stkjn_items" => $sale_items,
      );
    }
    return $res;
  }


  public function insert_stkjn()
  {

    $stkjnid = $this->input->post('ivt_stkjn_id');

    $stkjn_company = $this->input->post('ivt_stkjn_company');
    $stkjn_godown = $this->input->post('ivt_stkjn_godown');
    $stkjn_dept = $this->input->post('ivt_stkjn_dept');
    $stkjn_date = $this->input->post('ivt_stkjn_date');
    $stkjn_product = $this->input->post('ivt_stkjn_product');
    $stkjn_prodsize = $this->input->post('ivt_stkjn_prodsize');
    $stkjn_prodqty = $this->input->post('ivt_stkjn_prodqty');

    $stkjn_prodrate = $this->input->post('ivt_stkjn_prodrate');
    $stkjn_tamt = $this->input->post('ivt_stkjn_tamt');
    $stkjn_remark = $this->input->post('ivt_stkjn_remark');

    $checkuno = $this->db->select('ivt_stkjn_no')->order_by('ivt_stkjn_no', 'desc')->get('inventory_stockjournal_tbl')->row();
    if (!empty($checkuno)) {
      $stkjn_no = ((int)$checkuno->ivt_stkjn_no + 1);
    } else {
      $stkjn_no = 1;
    }

    for ($i = 0; $i < count($stkjn_product); $i++) {
      $data = array(
        "ivt_stkjn_company" => $stkjn_company,
        "ivt_stkjn_godown" => $stkjn_godown,
        "ivt_stkjn_dept" => $stkjn_dept ?: 0,
        "ivt_stkjn_date" => $stkjn_date,
        "ivt_stkjn_product" => $stkjn_product[$i],
        "ivt_stkjn_prodsize" => $stkjn_prodsize[$i] ?: 0,
        "ivt_stkjn_prodqty" => $stkjn_prodqty[$i],
        "ivt_stkjn_prodrate" => $stkjn_prodrate[$i],
        "ivt_stkjn_tamt" => $stkjn_tamt[$i],
        "ivt_stkjn_remark" => $stkjn_remark,

      );
      if (!empty($stkjnid[$i])) {
        $data['ivt_stkjn_updatedon'] = date('Y-m-d H:i');
        $data['ivt_stkjn_updatedby'] = $this->session->userdata('user_id');
        $this->db->where('ivt_stkjn_id', $stkjnid[$i])->update('inventory_stockjournal_tbl', $data);
        // $stkjn_id = $stkjnid;
        $res = 2;
      } else {

        if (!empty($this->input->post('ivt_stkjn_no'))) {
          $data['ivt_stkjn_no'] = $this->input->post('ivt_stkjn_no');
        } else {
          $data['ivt_stkjn_no'] = $stkjn_no;
        }

        $data['ivt_stkjn_addedon'] = date('Y-m-d H:i');
        $data['ivt_stkjn_addedby'] = $this->session->userdata('user_id');
        $data['ivt_stkjn_status'] = 1;

        $this->db->insert('inventory_stockjournal_tbl', $data);
        // $stkjn_id = $this->db->insert_id();
        $res = 1;
      }
    }

    return $res;
  }

  public function delete_stkjn()
  {
    if ($this->input->post('dtype') == 1) {

      $this->db->where('ivt_stkjn_no', $this->input->post('delete_id'));
      $this->db->delete('inventory_stockjournal_tbl');
    } else if ($this->input->post('dtype') == 2) {
      $this->db->where('ivt_stkjn_id', $this->input->post('delete_id'));
      $this->db->delete('inventory_stockjournal_tbl');
    }
    return true;
  }
  //=======================================================stkjn=================================================//

  //======================================================= storeissue =================================================//


  public function get_storeissue_list($from_date, $to_date, $itemid = '', $godown = '')
  {

    $this->db->select('ivt_stkisus_no,ivt_stkisus_date,ivt_stkisus_company,ivt_stkisus_godown,ivt_stkisus_dept,group_concat(ivt_stkisus_product) as itemid,sum(ivt_stkisus_prodqty) as totqty,sum(ivt_stkisus_tamt) as total_amt,ivt_stkisus_remark,ivt_stkisus_status,addedby.m_admin_name,m_godown_name,m_company_name');
    $this->db->join('master_godown_tbl', 'master_godown_tbl.m_godown_id = insjt.ivt_stkisus_godown', 'left');
    $this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = insjt.ivt_stkisus_company', 'left');
    $this->db->join('master_admin_tbl addedby', 'addedby.m_admin_id = insjt.ivt_stkisus_addedby', 'left');
    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(ivt_stkisus_date,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(ivt_stkisus_date,"%Y-%m-%d")<=', $to_date);
    }

    if (!empty($itemid)) {
      $this->db->where('ivt_stkisus_product', $itemid);
    }
    if (!empty($godown)) {
      $this->db->where('ivt_stkisus_godown', $godown);
    }

    $this->db->group_by('ivt_stkisus_no');
    $this->db->order_by('ivt_stkisus_no', 'desc');
    return $this->db->get('inventory_storeissue_tbl insjt')->result();
  }


  public function get_storeissue_dtl($storeissue_no)
  {

    $this->db->select('ivt_stkisus_no,ivt_stkisus_date,ivt_stkisus_company,ivt_stkisus_godown,ivt_stkisus_dept,group_concat(ivt_stkisus_product) as itemid,sum(ivt_stkisus_prodqty) as totqty,sum(ivt_stkisus_tamt) as total_amt,ivt_stkisus_remark,ivt_stkisus_status,addedby.m_admin_name,m_godown_name,m_company_name');
    $this->db->join('master_godown_tbl', 'master_godown_tbl.m_godown_id = insjt.ivt_stkisus_godown', 'left');
    $this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = insjt.ivt_stkisus_company', 'left');
    $this->db->join('master_admin_tbl addedby', 'addedby.m_admin_id = insjt.ivt_stkisus_addedby', 'left');
    $this->db->where('ivt_stkisus_no', $storeissue_no);
    $this->db->group_by('ivt_stkisus_no');
    $sale_datil = $this->db->get('inventory_storeissue_tbl insjt')->result();

    $this->db->select('ivt_stkisus_id,ivt_stkisus_no,ivt_stkisus_prodsize,ivt_stkisus_product,ivt_stkisus_prodqty,ivt_stkisus_prodrate,ivt_stkisus_tamt,m_product_name,prosize.m_prodgroup_name as productsize,prounit.m_prodgroup_name as productunit');
    $this->db->join('master_product_tbl', 'master_product_tbl.m_product_id = insjt.ivt_stkisus_product', 'left');
    $this->db->join('master_prodgroup_tbl prounit', 'prounit.m_prodgroup_id = master_product_tbl.m_product_unit', 'left');
    $this->db->join('master_prodgroup_tbl prosize', 'prosize.m_prodgroup_id = insjt.ivt_stkisus_prodsize', 'left');
    $this->db->where('ivt_stkisus_no', $storeissue_no);

    $sale_items =  $this->db->get('inventory_storeissue_tbl insjt')->result();

    if (!empty($sale_datil)) {
      $res = (object) array(
        'ivt_stkisus_no' => $sale_datil[0]->ivt_stkisus_no,
        'ivt_stkisus_date' => $sale_datil[0]->ivt_stkisus_date,
        'ivt_stkisus_company' => $sale_datil[0]->ivt_stkisus_company,
        'ivt_stkisus_godown' => $sale_datil[0]->ivt_stkisus_godown,
        'ivt_stkisus_dept' => $sale_datil[0]->ivt_stkisus_dept,
        'itemid' => $sale_datil[0]->itemid,
        'totqty' => $sale_datil[0]->totqty,
        'total_amt' => $sale_datil[0]->total_amt,
        'ivt_stkisus_remark' => $sale_datil[0]->ivt_stkisus_remark,
        'ivt_stkisus_status' => $sale_datil[0]->ivt_stkisus_status,
        'm_admin_name' => $sale_datil[0]->m_admin_name,
        'm_godown_name' => $sale_datil[0]->m_godown_name,
        'm_company_name' => $sale_datil[0]->m_company_name,
        "ivt_stkisus_items" => $sale_items,
      );
    }
    return $res;
  }


  public function insert_storeissue()
  {

    $storeissueid = $this->input->post('ivt_stkisus_id');

    $storeissue_company = $this->input->post('ivt_stkisus_company');
    $storeissue_godown = $this->input->post('ivt_stkisus_godown');
    $storeissue_dept = $this->input->post('ivt_stkisus_dept');
    $storeissue_date = $this->input->post('ivt_stkisus_date');
    $storeissue_product = $this->input->post('ivt_stkisus_product');
    $storeissue_prodsize = $this->input->post('ivt_stkisus_prodsize');
    $storeissue_prodqty = $this->input->post('ivt_stkisus_prodqty');

    $storeissue_prodrate = $this->input->post('ivt_stkisus_prodrate');
    $storeissue_tamt = $this->input->post('ivt_stkisus_tamt');
    $storeissue_remark = $this->input->post('ivt_stkisus_remark');

    $checkuno = $this->db->select('ivt_stkisus_no')->order_by('ivt_stkisus_no', 'desc')->get('inventory_storeissue_tbl')->row();
    if (!empty($checkuno)) {
      $storeissue_no = ((int)$checkuno->ivt_stkisus_no + 1);
    } else {
      $storeissue_no = 1;
    }

    for ($i = 0; $i < count($storeissue_product); $i++) {
      $data = array(
        "ivt_stkisus_company" => $storeissue_company,
        "ivt_stkisus_godown" => $storeissue_godown,
        "ivt_stkisus_dept" => $storeissue_dept ?: 0,
        "ivt_stkisus_date" => $storeissue_date,
        "ivt_stkisus_product" => $storeissue_product[$i],
        "ivt_stkisus_prodsize" => $storeissue_prodsize[$i] ?: 0,
        "ivt_stkisus_prodqty" => $storeissue_prodqty[$i],
        "ivt_stkisus_prodrate" => $storeissue_prodrate[$i],
        "ivt_stkisus_tamt" => $storeissue_tamt[$i],
        "ivt_stkisus_remark" => $storeissue_remark,

      );
      if (!empty($storeissueid[$i])) {
        $data['ivt_stkisus_updatedon'] = date('Y-m-d H:i');
        $data['ivt_stkisus_updatedby'] = $this->session->userdata('user_id');
        $this->db->where('ivt_stkisus_id', $storeissueid[$i])->update('inventory_storeissue_tbl', $data);
        // $storeissue_id = $storeissueid;
        $res = 2;
      } else {

        if (!empty($this->input->post('ivt_stkisus_no'))) {
          $data['ivt_stkisus_no'] = $this->input->post('ivt_stkisus_no');
        } else {
          $data['ivt_stkisus_no'] = $storeissue_no;
        }

        $data['ivt_stkisus_addedon'] = date('Y-m-d H:i');
        $data['ivt_stkisus_addedby'] = $this->session->userdata('user_id');
        $data['ivt_stkisus_status'] = 1;

        $this->db->insert('inventory_storeissue_tbl', $data);
        // $storeissue_id = $this->db->insert_id();
        $res = 1;
      }
    }

    return $res;
  }

  public function delete_storeissue()
  {
    if ($this->input->post('dtype') == 1) {
      $this->db->where('ivt_stkisus_no', $this->input->post('delete_id'));
      $this->db->delete('inventory_storeissue_tbl');
    } else if ($this->input->post('dtype') == 2) {
      $this->db->where('ivt_stkisus_id', $this->input->post('delete_id'));
      $this->db->delete('inventory_storeissue_tbl');
    }
    return true;
  }
  //======================================================= storeissue =================================================//
  //======================================================= storeout =================================================//


  public function get_storeout_list($type, $from_date, $to_date, $itemid = '', $godown = '')
  {

    $this->db->select('ivt_stkout_no,ivt_stkout_date,ivt_stkout_company,ivt_stkout_godown,ivt_stkout_type,ivt_stkout_dept,group_concat(ivt_stkout_product) as itemid,sum(ivt_stkout_prodqty) as totqty,sum(ivt_stkout_tamt) as total_amt,ivt_stkout_remark,ivt_stkout_status,addedby.m_admin_name,m_godown_name,m_company_name');
    $this->db->join('master_godown_tbl', 'master_godown_tbl.m_godown_id = insjt.ivt_stkout_godown', 'left');
    $this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = insjt.ivt_stkout_company', 'left');
    $this->db->join('master_admin_tbl addedby', 'addedby.m_admin_id = insjt.ivt_stkout_addedby', 'left');
    if (!empty($type)) {
      $this->db->where('ivt_stkout_type', $type);
    }
    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(ivt_stkout_date,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(ivt_stkout_date,"%Y-%m-%d")<=', $to_date);
    }

    if (!empty($itemid)) {
      $this->db->where('ivt_stkout_product', $itemid);
    }
    if (!empty($godown)) {
      $this->db->where('ivt_stkout_godown', $godown);
    }

    $this->db->group_by('ivt_stkout_no');
    $this->db->order_by('ivt_stkout_no', 'desc');
    return $this->db->get('inventory_storeout_tbl insjt')->result();
  }


  public function get_storeout_dtl($storeout_no)
  {

    $this->db->select('ivt_stkout_no,ivt_stkout_type,ivt_stkout_date,ivt_stkout_company,ivt_stkout_godown,ivt_stkout_dept,group_concat(ivt_stkout_product) as itemid,sum(ivt_stkout_prodqty) as totqty,sum(ivt_stkout_tamt) as total_amt,ivt_stkout_remark,ivt_stkout_status,addedby.m_admin_name,m_godown_name,m_company_name');
    $this->db->join('master_godown_tbl', 'master_godown_tbl.m_godown_id = insjt.ivt_stkout_godown', 'left');
    $this->db->join('master_company_tbl', 'master_company_tbl.m_company_id = insjt.ivt_stkout_company', 'left');
    $this->db->join('master_admin_tbl addedby', 'addedby.m_admin_id = insjt.ivt_stkout_addedby', 'left');
    $this->db->where('ivt_stkout_no', $storeout_no);
    $this->db->group_by('ivt_stkout_no');
    $sale_datil = $this->db->get('inventory_storeout_tbl insjt')->result();

    $this->db->select('ivt_stkout_id,ivt_stkout_no,ivt_stkout_prodsize,ivt_stkout_product,ivt_stkout_prodqty,ivt_stkout_prodrate,ivt_stkout_tamt,m_product_name,prosize.m_prodgroup_name as productsize,prounit.m_prodgroup_name as productunit');
    $this->db->join('master_product_tbl', 'master_product_tbl.m_product_id = insjt.ivt_stkout_product', 'left');
    $this->db->join('master_prodgroup_tbl prounit', 'prounit.m_prodgroup_id = master_product_tbl.m_product_unit', 'left');
    $this->db->join('master_prodgroup_tbl prosize', 'prosize.m_prodgroup_id = insjt.ivt_stkout_prodsize', 'left');
    $this->db->where('ivt_stkout_no', $storeout_no);

    $sale_items =  $this->db->get('inventory_storeout_tbl insjt')->result();

    if (!empty($sale_datil)) {
      $res = (object) array(
        'ivt_stkout_no' => $sale_datil[0]->ivt_stkout_no,
        'ivt_stkout_type' => $sale_datil[0]->ivt_stkout_type,
        'ivt_stkout_date' => $sale_datil[0]->ivt_stkout_date,
        'ivt_stkout_company' => $sale_datil[0]->ivt_stkout_company,
        'ivt_stkout_godown' => $sale_datil[0]->ivt_stkout_godown,
        'ivt_stkout_dept' => $sale_datil[0]->ivt_stkout_dept,
        'itemid' => $sale_datil[0]->itemid,
        'totqty' => $sale_datil[0]->totqty,
        'total_amt' => $sale_datil[0]->total_amt,
        'ivt_stkout_remark' => $sale_datil[0]->ivt_stkout_remark,
        'ivt_stkout_status' => $sale_datil[0]->ivt_stkout_status,
        'm_admin_name' => $sale_datil[0]->m_admin_name,
        'm_godown_name' => $sale_datil[0]->m_godown_name,
        'm_company_name' => $sale_datil[0]->m_company_name,
        "ivt_stkout_items" => $sale_items,
      );
    }
    return $res;
  }


  public function insert_storeout()
  {

    $storeoutid = $this->input->post('ivt_stkout_id');

    $storeout_company = $this->input->post('ivt_stkout_company');
    $storeout_godown = $this->input->post('ivt_stkout_godown');
    $storeout_dept = $this->input->post('ivt_stkout_dept');
    $storeout_date = $this->input->post('ivt_stkout_date');
    $storeout_product = $this->input->post('ivt_stkout_product');
    $storeout_prodsize = $this->input->post('ivt_stkout_prodsize');
    $storeout_prodqty = $this->input->post('ivt_stkout_prodqty');

    $storeout_prodrate = $this->input->post('ivt_stkout_prodrate');
    $storeout_tamt = $this->input->post('ivt_stkout_tamt');
    $storeout_remark = $this->input->post('ivt_stkout_remark');
    $storeout_type = $this->input->post('ivt_stkout_type');

    $checkuno = $this->db->select('ivt_stkout_no')->order_by('ivt_stkout_no', 'desc')->get('inventory_storeout_tbl')->row();
    if (!empty($checkuno)) {
      $storeout_no = ((int)$checkuno->ivt_stkout_no + 1);
    } else {
      $storeout_no = 1;
    }

    for ($i = 0; $i < count($storeout_product); $i++) {
      $data = array(
        "ivt_stkout_type" => $storeout_type,
        "ivt_stkout_company" => $storeout_company,
        "ivt_stkout_godown" => $storeout_godown,
        "ivt_stkout_dept" => $storeout_dept ?: 0,
        "ivt_stkout_date" => $storeout_date,
        "ivt_stkout_product" => $storeout_product[$i],
        "ivt_stkout_prodsize" => $storeout_prodsize[$i] ?: 0,
        "ivt_stkout_prodqty" => $storeout_prodqty[$i],
        "ivt_stkout_prodrate" => $storeout_prodrate[$i],
        "ivt_stkout_tamt" => $storeout_tamt[$i],
        "ivt_stkout_remark" => $storeout_remark,

      );
      if (!empty($storeoutid[$i])) {
        $data['ivt_stkout_updatedon'] = date('Y-m-d H:i');
        $data['ivt_stkout_updatedby'] = $this->session->userdata('user_id');
        $this->db->where('ivt_stkout_id', $storeoutid[$i])->update('inventory_storeout_tbl', $data);
        // $storeout_id = $storeoutid;
        $res = 2;
      } else {

        if (!empty($this->input->post('ivt_stkout_no'))) {
          $data['ivt_stkout_no'] = $this->input->post('ivt_stkout_no');
        } else {
          $data['ivt_stkout_no'] = $storeout_no;
        }

        $data['ivt_stkout_addedon'] = date('Y-m-d H:i');
        $data['ivt_stkout_addedby'] = $this->session->userdata('user_id');
        $data['ivt_stkout_status'] = 1;

        $this->db->insert('inventory_storeout_tbl', $data);
        // $storeout_id = $this->db->insert_id();
        $res = 1;
      }
    }

    return $res;
  }

  public function delete_storeout()
  {
    if ($this->input->post('dtype') == 1) {
      $this->db->where('ivt_stkout_no', $this->input->post('delete_id'));
      $this->db->delete('inventory_storeout_tbl');
    } else if ($this->input->post('dtype') == 2) {
      $this->db->where('ivt_stkout_id', $this->input->post('delete_id'));
      $this->db->delete('inventory_storeout_tbl');
    }
    return true;
  }
  //======================================================= storeout =================================================//


}
