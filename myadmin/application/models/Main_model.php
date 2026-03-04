<?php date_default_timezone_set('Asia/Kolkata');

class Main_model extends CI_model
{

  public function get_customer_list($from_date, $to_date)
  {

    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_cust_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_cust_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $res = $this->db->get('master_customer_tbl')->result();
    return $res;
  }

  public function get_Active_customer()
  {
    $res = $this->db->where('m_cust_status', 1)->get('master_customer_tbl')->result();
    return $res;
  }

  public function get_credit_customer()
  {
    $res = $this->db->where('m_cust_status', 1)->where('m_cust_type', 1)->get('master_customer_tbl')->result();
    return $res;
  }

  public function get_user_dtl($id)
  {
    $this->db->select('*');
    $this->db->where('m_cust_id', $id);
    // $this->db->join('master_designation_tbl','master_designation_tbl.m_desig_id = master_customer_tbl.m_cust_desig','left');
    $this->db->join('master_state_tbl', 'master_state_tbl.m_state_id = master_customer_tbl.m_cust_state', 'left');
    $this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_customer_tbl.m_cust_city', 'left');
    $res = $this->db->get('master_customer_tbl')->row();

    return $res;
  }

  public function insert_customer()
  {

    $userid = $this->input->post('m_cust_id');

    // for 1st image upload code.
    //   if(!empty($_FILES['m_cust_image']['name'])){
    //   $config['file_name'] = $_FILES['m_cust_image']['name'];
    //   $config['upload_path'] = 'uploads/users';
    //   $config['allowed_types'] = 'jpg|jpeg|png';
    //   $config['remove_spaces'] = TRUE;
    //   $config['file_name'] = $_FILES['m_cust_image']['name'];
    //   //Load upload library and initialize configuration
    //   $this->load->library('upload',$config);
    //   $this->upload->initialize($config);
    //   if($this->upload->do_upload('m_cust_image')){
    //     $uploadData = $this->upload->data();  
    //     if (!empty($update_data['m_cust_image'])) { 
    //       if(file_exists($config['m_cust_image'].$update_data['m_cust_image'])){
    //       unlink($config['upload_path'].$update_data['m_cust_image']); /* deleting Image */
    //       } 
    //     }
    //     $m_cust_image = $uploadData['file_name'];
    //   }
    // }
    // else{
    //   $m_cust_image = $this->input->post('m_cust_image1');
    // }




    $data = array(

      "m_cust_name" => $this->input->post('m_cust_name'),
      "m_cust_mobile" => $this->input->post('m_cust_mobile'),
      "m_cust_AccCode" => $this->input->post('m_cust_AccCode'),
      "m_cust_city" => $this->input->post('m_cust_city'),
      "m_cust_email" => $this->input->post('m_cust_email'),
      "m_cust_type" => $this->input->post('m_cust_type'),
      "m_cust_address" => $this->input->post('m_cust_address'),
      "m_cust_reqType" => $this->input->post('m_cust_reqType'),
      "m_cust_phoneNo" => $this->input->post('m_cust_phoneNo'),
      // "m_cust_state" => $this->input->post('m_cust_state'),
      "m_cust_pan_no" => $this->input->post('m_cust_pan_no'),
      "m_cust_status" => 1,

    );

    if (!empty($userid)) {
      $this->db->where('m_cust_id', $userid)->update('master_customer_tbl', $data);
      return 2;
    } else {
      $data['m_cust_added_on'] = date('Y-m-d H:i:s');
      $this->db->insert('master_customer_tbl', $data);
      return 1;
    }
  }

  public function delete_customer()
  {
    $this->db->where('m_cust_id', $this->input->post('delete_id'));
    $this->db->delete('master_customer_tbl');
    return true;
  }

  public function get_costume_list($from_date, $to_date)
  {

    $this->db->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = costume_wp_tbl.m_costume_customer', 'left');
    $this->db->join('tickets_wp_tbl', 'tickets_wp_tbl.m_ticket_id = costume_wp_tbl.m_costume_ticket_id', 'left');
    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $res = $this->db->get('costume_wp_tbl')->result();
    return $res;
  }

  public function get_costume_dtl($id)
  {
    $this->db->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = costume_wp_tbl.m_costume_customer', 'left');
    $this->db->join('tickets_wp_tbl', 'tickets_wp_tbl.m_ticket_id = costume_wp_tbl.m_costume_ticket_id', 'left');
    $res = $this->db->where('m_costume_id', $id)->get('costume_wp_tbl')->row();
    return $res;
  }

  public function insert_costume()
  {

    $costume_id = $this->input->post('m_costume_id');
    $customer_mobile = $this->input->post('m_cust_mobile');
    $countTqty = $this->input->post('m_costume_Tqty');
    $countTqty2 = '';
    foreach ($countTqty as $keye) {
      if (!empty($keye) && $keye != 0) {
        $countTqty2 = $countTqty2 . $keye . ',';
      }
    }

    $data = array(
      "m_costume_counter" => $this->input->post('m_costume_counter'),
      "m_costume_date" => $this->input->post('m_costume_date'),
      "m_costume_ticket_id" => $this->input->post('m_costume_ticket_id'),
      "m_costume_customer" => $this->input->post('m_costume_customer'),
      "m_costume_cosid" => $this->input->post('m_costume_cosid'),
      "m_costume_Tqty" => $countTqty2,
      // "m_costume_G" => implode(",", $this->input->post('catG')),
      "m_costume_Trent" => $this->input->post('m_costume_Trent'),
      // "m_costume_Tcostume" => $this->input->post('m_costume_Tcostume'),
      "m_costume_payableAmt" => $this->input->post('m_costume_payableAmt'),
      "m_costume_Tdeposit" => $this->input->post('m_costume_Tdeposit'),
      "m_costume_paidAmt" => $this->input->post('m_costume_paidAmt'),
      "m_costume_balAmt" => $this->input->post('m_costume_balAmt'),
      "m_costume_remark" => $this->input->post('m_costume_remark'),
      "m_costume_iscredit" => $this->input->post('is_credit_allow') ?: 0,
      "m_costume_ispartial" => $this->input->post('m_costume_ispartial') ?: 0,
      "m_costume_paytype" => $this->input->post('m_costume_paytype'),
      "m_costume_paytype2" => $this->input->post('m_costume_paytype2') ?: 0,
      "m_costume_paidAmt2" => $this->input->post('m_costume_paidAmt2') ?: 0,

    );
    if (!empty($costume_id)) {
      $this->db->where('m_costume_id', $costume_id)->update('costume_wp_tbl', $data);
      $retrun_val = 2;
    } else {
      $data['m_costume_status'] = 1;
      $data['m_costume_added_on'] = date('Y-m-d H:i:s');
      $data['m_costume_addedby'] = $this->session->userdata('user_id');
      $this->db->insert('costume_wp_tbl', $data);
      // $shop_id = $this->db->insert_id();
      $retrun_val = 1;
    }

    return $retrun_val;
  }

  public function update_costumerefund()
  {

    $costume_id = explode(',', $this->input->post('m_costume_id'));
    $Treturn = explode(',', $this->input->post('m_costume_refund'));

    foreach ($costume_id as $key => $value) {
      $check_credit = $this->db->join('tickets_wp_tbl', 'tickets_wp_tbl.m_ticket_id = costume_wp_tbl.m_costume_ticket_id')->where('m_ticket_paymode', 'Credit')->where("FIND_IN_SET('2', m_ticket_credit_allow)")->where('m_costume_id', $value)->get('costume_wp_tbl')->row();


      $data = array(
        "m_costume_refund" => $Treturn[$key],
        "m_costume_status" => 2,
        "m_costume_refund_on" => date('Y-m-d H:i'),

      );

      if (!empty($check_credit)) {
        $data['m_costume_balAmt'] = ($check_credit->m_costume_balAmt - $Treturn[$key]);
      }


      $res = $this->db->where('m_costume_id', $value)->update('costume_wp_tbl', $data);
    }
    return $res;
  }

  public function delete_costume()
  {
    $this->db->where('m_costume_id', $this->input->post('delete_id'));
    $this->db->delete('costume_wp_tbl');
    return true;
  }



  public function get_locker_list($from_date, $to_date)
  {

    $this->db->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = locker_wp_tbl.m_locker_customer', 'left');
    $this->db->join('tickets_wp_tbl', 'tickets_wp_tbl.m_ticket_id = locker_wp_tbl.m_locker_ticket_id', 'left');
    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $res = $this->db->get('locker_wp_tbl')->result();
    return $res;
  }

  public function get_locker_dtl($id)
  {
    $this->db->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = locker_wp_tbl.m_locker_customer', 'left');
    $this->db->join('tickets_wp_tbl', 'tickets_wp_tbl.m_ticket_id = locker_wp_tbl.m_locker_ticket_id', 'left');
    $res = $this->db->where('m_locker_id', $id)->get('locker_wp_tbl')->row();
    return $res;
  }

  public function insert_locker()
  {

    $locker_id = $this->input->post('m_locker_id');
    $customer_mobile = $this->input->post('m_cust_mobile');

    if (!empty($this->input->post('catB'))) {
      $catB = implode(",", $this->input->post('catB'));
    } else {
      $catB = '';
    }
    if (!empty($this->input->post('catL'))) {
      $catL = implode(",", $this->input->post('catL'));
    } else {
      $catL = '';
    }
    if (!empty($this->input->post('catG'))) {
      $catG = implode(",", $this->input->post('catG'));
    } else {
      $catG = '';
    }

    $data = array(
      "m_locker_counter" => $this->input->post('m_locker_counter'),
      "m_locker_date" => $this->input->post('m_locker_date'),
      "m_locker_ticket_id" => $this->input->post('m_locker_ticket_id'),
      "m_locker_customer" => $this->input->post('m_locker_customer'),
      "m_locker_B" => $catB,
      "m_locker_L" => $catL,
      "m_locker_G" => $catG,
      "m_locker_Trent" => $this->input->post('m_locker_Trent'),
      "m_locker_Tlocker" => $this->input->post('m_locker_Tlocker'),
      "m_locker_payableAmt" => $this->input->post('m_locker_payableAmt'),
      "m_locker_Tdeposit" => $this->input->post('m_locker_Tdeposit'),
      "m_locker_paidAmt" => $this->input->post('m_locker_paidAmt'),
      "m_locker_balAmt" => $this->input->post('m_locker_balAmt'),
      "m_locker_remark" => $this->input->post('m_locker_remark'),
      "m_locker_iscredit" => $this->input->post('is_credit_allow') ?: 0,
      "m_locker_ispartial" => $this->input->post('m_locker_ispartial') ?: 0,
      "m_locker_paytype" => $this->input->post('m_locker_paytype'),
      "m_locker_paytype2" => $this->input->post('m_locker_paytype2') ?: 0,
      "m_locker_paidAmt2" => $this->input->post('m_locker_paidAmt2') ?: 0,

    );
    if (!empty($locker_id)) {
      $this->db->where('m_locker_id', $locker_id)->update('locker_wp_tbl', $data);
      $retrun_val = 2;
    } else {
      $data['m_locker_status'] = 1;
      $data['m_locker_added_on'] = date('Y-m-d H:i:s');
      $data['m_locker_addedby'] = $this->session->userdata('user_id');
      $this->db->insert('locker_wp_tbl', $data);
      // $shop_id = $this->db->insert_id();
      $retrun_val = 1;
    }

    return $retrun_val;
  }

  public function update_lockerrefund()
  {
    $locker_id = explode(',', $this->input->post('m_locker_id'));
    $Treturn = explode(',', $this->input->post('m_locker_Treturn'));

    foreach ($locker_id as $key => $value) {
      $check_credit = $this->db->join('tickets_wp_tbl', 'tickets_wp_tbl.m_ticket_id = locker_wp_tbl.m_locker_ticket_id')->where('m_ticket_paymode', 'Credit')->where("FIND_IN_SET('1', m_ticket_credit_allow)")->where('m_locker_id', $value)->get('locker_wp_tbl')->row();


      $data = array(
        "m_locker_refund" => $Treturn[$key],
        "m_locker_status" => 2,
        "m_locker_refund_on" => date('Y-m-d H:i'),

      );

      if (!empty($check_credit)) {
        $data['m_locker_balAmt'] = ($check_credit->m_locker_balAmt - $Treturn[$key]);
      }


      $res = $this->db->where('m_locker_id', $value)->update('locker_wp_tbl', $data);
    }
    return $res;
  }

  public function delete_locker()
  {
    $this->db->where('m_locker_id', $this->input->post('delete_id'));
    $this->db->delete('locker_wp_tbl');
    return true;
  }


  public function get_ticket_customer($id)
  {

    $this->db->select('m_ticket_id,m_cust_name,m_cust_mobile,m_ticket_customer,m_ticket_paymode,m_ticket_resp_id,m_ticket_credit_allow,m_ticket_cusType')
      ->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = tickets_wp_tbl.m_ticket_customer', 'left');
    $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")', date('Y-m-d'));
    $this->db->where('m_ticket_id', $id);
    $res = $this->db->get('tickets_wp_tbl')->row();
    return $res;
  }

  public function get_pending_ticket()
  {

    $this->db->select('tickets_wp_tbl.*,m_cust_name,m_cust_mobile,m_ticket_customer')
      ->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = tickets_wp_tbl.m_ticket_customer', 'left');
    $this->db->where('m_ticket_status', 0);
    $res = $this->db->get('tickets_wp_tbl')->result();
    return $res;
  }

  public function get_ticket_selectedList()
  {

    $this->db->select('m_ticket_id,m_cust_name,m_cust_mobile,m_ticket_customer')
      ->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = tickets_wp_tbl.m_ticket_customer', 'left');
    $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")', date('Y-m-d'));
    $this->db->where('m_ticket_status', 1);
    $res = $this->db->get('tickets_wp_tbl')->result();
    return $res;
  }

  public function get_ticket_list($from_date, $to_date, $head = '')
  {
    $this->db->select('tickets_wp_tbl.*,m_emp_code,m_emp_name,m_saleshead_title,m_city_name,m_cashacc_name,m_cust_name,m_cust_mobile,m_plot_name,m_plot_type');
    $this->db->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = tickets_wp_tbl.m_ticket_customer', 'left');
    $this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id = tickets_wp_tbl.m_ticket_resp_id', 'left');
    $this->db->join('master_saleshead_tbl', 'master_saleshead_tbl.m_saleshead_id = tickets_wp_tbl.m_ticket_head', 'left');
    $this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = tickets_wp_tbl.m_ticket_city', 'left');
    $this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = tickets_wp_tbl.m_ticket_counter', 'left');
    $this->db->join('master_plots_tbl', 'master_plots_tbl.m_plot_no = tickets_wp_tbl.m_ticket_plot_no', 'left');
    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")<=', $to_date);
    }
    if (!empty($head)) {
      $this->db->where('m_ticket_head', $head);
    }
    $this->db->where('m_ticket_status', 1);
    $res = $this->db->get('tickets_wp_tbl')->result();
    return $res;
  }

  public function get_ticket_dtl($id)
  {
    $this->db->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = tickets_wp_tbl.m_ticket_customer', 'left');
    $res = $this->db->where('m_ticket_id', $id)->get('tickets_wp_tbl')->row();
    return $res;
  }


  public function convert_lead_ticket()
  {

    $customer_mobile = $this->input->post('m_cust_mobile');
    $userCheck = $this->db->select('m_cust_id')->where('m_cust_mobile', $customer_mobile)->get('master_customer_tbl')->row();

    if (!empty($userCheck)) {
      $m_ticket_customer = $userCheck->m_cust_id;
      $this->db->set('m_cust_name', $this->input->post('m_cust_name'))->set('m_cust_city', $this->input->post('m_ticket_city'))->where('m_cust_id', $m_ticket_customer)->update('master_customer_tbl');
    } else {
      $userinsert = array(
        "m_cust_mobile" => $customer_mobile,
        "m_cust_name" => $this->input->post('m_cust_name'),
        "m_cust_city" => $this->input->post('m_ticket_city'),
        "m_cust_added_on" => date('Y-m-d H:i'),
        "m_cust_status" => 1,
      );
      $this->db->insert('master_customer_tbl', $userinsert);
      $m_ticket_customer = $this->db->insert_id();
    }


    $tickcheck = $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")', date('Y-m-d'))->where('m_ticket_customer', $m_ticket_customer)->get('tickets_wp_tbl')->row();
    if (!empty($tickcheck)) {
      return 3;
    }


    $data = array(
      "m_ticket_head" => $this->input->post('m_ticket_head'),
      "m_ticket_date" => $this->input->post('m_ticket_date'),
      "m_ticket_paymode" => 'Cash',
      "m_ticket_counter" => 2,

      "m_ticket_customer" => $m_ticket_customer,
      "m_ticket_adult" => $this->input->post('m_ticket_adult'),
      "m_ticket_free" => $this->input->post('m_ticket_free'),
      "m_ticket_totalAmt" => $this->input->post('m_ticket_totalAmt'),
      "m_ticket_gstAmt" => $this->input->post('m_ticket_gstAmt'),

      "m_ticket_lead_id" => $this->input->post('m_ticket_lead_id'),
      "m_ticket_netAmt" => $this->input->post('m_ticket_netAmt'),
      "m_ticket_paidAmt" => $this->input->post('m_ticket_paidAmt'),
      "m_ticket_balAmt" => $this->input->post('m_ticket_balAmt'),
      "m_ticket_city" => $this->input->post('m_ticket_city') ?: 0,
      "m_ticket_remark" => $this->input->post('m_ticket_remark') ?: '',
      "m_ticket_cusType" => $this->input->post('m_ticket_cusType'),
      "m_ticket_ispartial" => $this->input->post('m_ticket_ispartial') ?: 0,
      "m_ticket_paytype" => $this->input->post('m_ticket_paytype'),
      "m_ticket_paytype2" => $this->input->post('m_ticket_paytype2') ?: 0,
      "m_ticket_paidAmt2" => $this->input->post('m_ticket_paidAmt2') ?: 0,
      "m_ticket_band" => $this->input->post('m_lead_bandcolor') . ',0,' . $this->input->post('m_lead_freecolor'),
      "m_ticket_status" => 1,


    );

    $data['m_ticket_no'] =  $this->RandomString(8);
    $data['m_ticket_added_on'] = date('Y-m-d H:i');
    $rd = $this->db->insert('tickets_wp_tbl', $data);

    $this->db->set('m_lead_bandcolor', $this->input->post('m_lead_bandcolor'))->set('m_lead_freecolor', $this->input->post('m_lead_freecolor'))->where('m_lead_id', $this->input->post('m_ticket_lead_id'))->update('master_lead_tbl');

    $Rleadbands = $this->get_bands($this->input->post('m_lead_bandcolor'), 1);
    $Uleadbands = $this->get_bands($this->input->post('m_lead_bandcolor'), 3);

    $Rfree_band = $this->get_bands($this->input->post('m_lead_freecolor'), 1);
    $Ufree_band = $this->get_bands($this->input->post('m_lead_freecolor'), 3);

    if (!empty($Rleadbands)) {
      if ($Rleadbands->m_band_instock > 0) {
        if ($Rleadbands->m_band_instock >= (int)$this->input->post('m_ticket_adult')) {
          $this->db->set('m_band_instock', 'm_band_instock-' . (int)$this->input->post('m_ticket_adult'), false)->where('m_band_id', $Rleadbands->m_band_id)->update('master_bands_tbl');
        } else {
          if (!empty($Uleadbands)) {
            $this->db->set('m_band_instock', 'm_band_instock-' . ((int)$this->input->post('m_ticket_adult') - $Rleadbands->m_band_instock), false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Uleadbands->m_band_id)->update('master_bands_tbl');
            $this->db->set('m_band_instock', 0)->set('m_band_status', 2)->where('m_band_id', $Rleadbands->m_band_id)->update('master_bands_tbl');
          } else {
            return false;
          }
        }
      } else {
        if (!empty($Uleadbands)) {
          $this->db->set('m_band_instock', 'm_band_instock-' . (int)$this->input->post('m_ticket_adult'), false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Uleadbands->m_band_id)->update('master_bands_tbl');
          $this->db->set('m_band_status', 2)->where('m_band_id', $Rleadbands->m_band_id)->update('master_bands_tbl');
        } else {
          return false;
        }
      }
    }

    if (!empty($this->input->post('m_ticket_free')) && !empty($Rfree_band)) {
      if ($Rfree_band->m_band_instock > 0) {
        if ($Rfree_band->m_band_instock >= (int)$this->input->post('m_ticket_free')) {
          $this->db->set('m_band_instock', 'm_band_instock-' . (int)$this->input->post('m_ticket_free'), false)->where('m_band_id', $Rfree_band->m_band_id)->update('master_bands_tbl');
        } else {
          if (!empty($Ufree_band)) {
            $this->db->set('m_band_instock', 'm_band_instock-' . ((int)$this->input->post('m_ticket_free') - $Rfree_band->m_band_instock), false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Ufree_band->m_band_id)->update('master_bands_tbl');
            $this->db->set('m_band_instock', 0)->set('m_band_status', 2)->where('m_band_id', $Rfree_band->m_band_id)->update('master_bands_tbl');
          } else {
            return false;
          }
        }
      } else {
        if (!empty($Ufree_band)) {
          $this->db->set('m_band_instock', 'm_band_instock-' . (int)$this->input->post('m_ticket_free'), false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Ufree_band->m_band_id)->update('master_bands_tbl');
          $this->db->set('m_band_status', 2)->where('m_band_id', $Rfree_band->m_band_id)->update('master_bands_tbl');
        } else {
          return false;
        }
      }
    }

    return 1;
  }

  public function insert_ticket()
  {

    $ticketid = $this->input->post('m_ticket_id');
    $customer_mobile = $this->input->post('m_cust_mobile');


    $userCheck = $this->db->select('m_cust_id')->where('m_cust_mobile', $customer_mobile)->get('master_customer_tbl')->row();

    if (!empty($userCheck)) {
      $m_ticket_customer = $userCheck->m_cust_id;
      $this->db->set('m_cust_name', $this->input->post('m_cust_name'))->set('m_cust_city', $this->input->post('m_ticket_city'))->where('m_cust_id', $m_ticket_customer)->update('master_customer_tbl');
    } else {
      $userinsert = array(
        "m_cust_mobile" => $customer_mobile,
        "m_cust_name" => $this->input->post('m_cust_name'),
        "m_cust_city" => $this->input->post('m_ticket_city'),
        "m_cust_added_on" => date('Y-m-d H:i'),
        "m_cust_status" => 1,
      );
      $this->db->insert('master_customer_tbl', $userinsert);
      $m_ticket_customer = $this->db->insert_id();
    }
    if (!empty($this->input->post('m_ticket_credit_allow'))) {
      $m_ticket_credit_allow = implode(',', $this->input->post('m_ticket_credit_allow'));
    } else {
      $m_ticket_credit_allow = 0;
    }


    $m_ticket_paymode = $this->input->post('m_ticket_paymode');
    $m_ticket_netAmt = $this->input->post('m_ticket_netAmt');
    $m_ticket_paidAmt = $this->input->post('m_ticket_paidAmt');
    $m_ticket_paidAmt2 = $this->input->post('m_ticket_paidAmt2') ?: 0;
    $m_ticket_balAmt = $this->input->post('m_ticket_balAmt');

    if (strtoupper($m_ticket_paymode) == 'CASH') {
      if ($m_ticket_netAmt == ($m_ticket_paidAmt + $m_ticket_paidAmt2)) {
        $m_ticket_balAmt = 0;
      } else {
        return 4;
      }
    }

    $data = array(
      "m_ticket_head" => $this->input->post('m_ticket_head'),
      "m_ticket_date" => $this->input->post('m_ticket_date'),
      "m_ticket_paymode" => $m_ticket_paymode,
      "m_ticket_scanCard" => $this->input->post('m_ticket_scanCard') ?: 0,
      "m_ticket_plot_no" => $this->input->post('m_ticket_plot_no') ?: 0,
      "m_ticket_counter" => $this->input->post('m_ticket_counter'),
      "m_ticket_creditCust" => $this->input->post('m_ticket_creditCust'),
      "m_ticket_credit_allow" => $m_ticket_credit_allow,
      "m_ticket_resp_id" => $this->input->post('m_ticket_resp_id') ?: 0,
      "m_ticket_customer" => $m_ticket_customer,
      "m_ticket_adult" => $this->input->post('m_ticket_adult'),
      "m_ticket_child" => $this->input->post('m_ticket_child'),
      "m_ticket_free" => $this->input->post('m_ticket_free') ?: 0,
      "m_ticket_totalAmt" => $this->input->post('m_ticket_totalAmt'),
      "m_ticket_gstAmt" => $this->input->post('m_ticket_gstAmt'),
      "m_ticket_discount" => $this->input->post('m_ticket_discount') ?: 0,
      "m_ticket_netAmt" => $m_ticket_netAmt,
      "m_ticket_paidAmt" => $m_ticket_paidAmt,
      "m_ticket_balAmt" => $m_ticket_balAmt,
      "m_ticket_city" => $this->input->post('m_ticket_city') ?: 0,
      "m_ticket_remark" => $this->input->post('m_ticket_remark') ?: 0,
      "m_ticket_cusType" => $this->input->post('m_ticket_cusType'),
      "m_ticket_ispartial" => $this->input->post('m_ticket_ispartial') ?: 0,
      "m_ticket_paytype" => $this->input->post('m_ticket_paytype'),
      "m_ticket_paytype2" => $this->input->post('m_ticket_paytype2') ?: 0,
      "m_ticket_plot_file" => $this->input->post('m_ticket_plot_file') ?: 0,
      "m_ticket_paidAmt2" => $m_ticket_paidAmt2,
      "m_ticket_status" => 1,

    );

    // print_r($data); die;

    if (!empty($ticketid)) {

      $tickcheck_band = $this->db->where('m_ticket_id', $ticketid)->where('m_ticket_status', 0)->get('tickets_wp_tbl')->row();
      if (!empty($tickcheck_band)) {
        $this->band_used_fun($ticketid, $this->input->post('m_ticket_head'), $this->input->post('m_ticket_adult'), $this->input->post('m_ticket_child'), $this->input->post('m_ticket_free'));
      }

      $this->db->where('m_ticket_id', $ticketid)->update('tickets_wp_tbl', $data);
      // $shop_id = $ticketid;
      $retrun_val = 2;
    } else {

      $tickcheck = $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")', date('Y-m-d'))->where('m_ticket_customer', $m_ticket_customer)->get('tickets_wp_tbl')->row();
      if (!empty($tickcheck)) {
        return 3;
      }

      $data['m_ticket_no'] =  $this->RandomString(8);
      $data['m_ticket_added_on'] = date('Y-m-d H:i');
      $data['m_ticket_added_by'] = $this->session->userdata('user_id');
      $rd = $this->db->insert('tickets_wp_tbl', $data);
      $ticket_id = $this->db->insert_id();

      $this->band_used_fun($ticket_id, $this->input->post('m_ticket_head'), $this->input->post('m_ticket_adult'), $this->input->post('m_ticket_child'), $this->input->post('m_ticket_free'));

      $retrun_val = 1;
    }

    return $retrun_val;
  }

  public function delete_ticket()
  {
    $this->db->where('m_ticket_id', $this->input->post('delete_id'));
    $this->db->delete('tickets_wp_tbl');
    return true;
  }

  public function refund_ticket()
  {
    return $this->db->set('m_ticket_refund', 1)->where('m_ticket_id', $this->input->post('tck_id'))->update('tickets_wp_tbl');
  }


  public function get_sales_list($from_date, $to_date)
  {

    $this->db->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = sales_wp_tbl.m_sales_customer', 'left');
    $this->db->join('tickets_wp_tbl', 'tickets_wp_tbl.m_ticket_id = sales_wp_tbl.m_sales_ticket_id', 'left');
    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_sales_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_sales_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $res = $this->db->get('sales_wp_tbl')->result();
    return $res;
  }

  public function get_sales_dtl($id)
  {
    $this->db->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = sales_wp_tbl.m_sales_customer', 'left');
    $this->db->join('tickets_wp_tbl', 'tickets_wp_tbl.m_ticket_id = sales_wp_tbl.m_sales_ticket_id', 'left');
    $res = $this->db->where('m_sales_id', $id)->get('sales_wp_tbl')->row();
    return $res;
  }

  public function insert_sales()
  {

    $sales_id = $this->input->post('m_sales_id');
    $customer_mobile = $this->input->post('m_cust_mobile');
    $userCheck = $this->db->select('m_cust_id')->where('m_cust_mobile', $customer_mobile)->get('master_customer_tbl')->row();
    if (!empty($userCheck)) {
      $m_sales_customer = $userCheck->m_cust_id;
      $this->db->set('m_cust_name', $this->input->post('m_cust_name'))->where('m_cust_id', $m_sales_customer)->update('master_customer_tbl');
    } else {
      $userinsert = array(
        "m_cust_mobile" => $customer_mobile,
        "m_cust_name" => $this->input->post('m_cust_name'),
        // "m_cust_city" => $this->input->post('m_ticket_city'),
        "m_cust_added_on" => date('Y-m-d H:i'),
        "m_cust_status" => 1,
      );
      $this->db->insert('master_customer_tbl', $userinsert);
      $m_sales_customer = $this->db->insert_id();
    }

    $countTqty = $this->input->post('m_sales_Tqty');
    $countTqty2 = '';
    foreach ($countTqty as $keye) {
      if (!empty($keye)) {
        $countTqty2 = $countTqty2 . $keye . ',';
      }
    }


    $data = array(
      "m_sales_no" => $this->input->post('m_sales_no'),
      "m_sales_paymode" => $this->input->post('m_sales_paymode'),
      "m_sales_counter" => $this->input->post('m_sales_counter'),
      "m_sales_date" => $this->input->post('m_sales_date'),
      "m_sales_ticket_id" => $this->input->post('m_sales_ticket_id') ?: 0,
      "m_sales_customer" => $this->input->post('m_sales_customer') ?: $m_sales_customer,
      "m_sales_prodid" => $this->input->post('m_sales_prodid'),
      "m_sales_Tqty" => $countTqty2,
      "m_sales_Ttextable" => $this->input->post('m_sales_Ttextable'),
      "m_sales_gst" => $this->input->post('m_sales_gst'),
      "m_sales_netAmt" => $this->input->post('m_sales_netAmt'),
      "m_sales_remark" => $this->input->post('m_sales_remark'),
      "m_sales_paidAmt" => $this->input->post('m_sales_paidAmt'),
      "m_sales_ispartial" => $this->input->post('m_sales_ispartial') ?: 0,
      "m_sales_paytype" => $this->input->post('m_sales_paytype'),
      "m_sales_paytype2" => $this->input->post('m_sales_paytype2') ?: 0,
      "m_sales_paidAmt2" => $this->input->post('m_sales_paidAmt2') ?: 0,


    );
    if (!empty($sales_id)) {
      $this->db->where('m_sales_id', $sales_id)->update('sales_wp_tbl', $data);
      $retrun_val = 2;
    } else {
      $data['m_sales_status'] = 1;
      $data['m_sales_added_on'] = date('Y-m-d H:i:s');
      $data['m_sales_addedby'] = $this->session->userdata('user_id');
      $this->db->insert('sales_wp_tbl', $data);
      // $shop_id = $this->db->insert_id();
      $retrun_val = 1;
    }

    return $retrun_val;
  }

  // public function update_salesrefund()
  // {
  //   $sales_id = $this->input->post('m_sales_id');

  //   $data = array(
  //     "m_sales_refund" => $this->input->post('m_sales_Treturn'),
  //     "m_sales_status" => 2,
  //     "m_sales_refund_on" => date('Y-m-d H:i'),

  //   );

  //   return $this->db->where('m_sales_id',$sales_id)->update('sales_wp_tbl', $data);

  // }

  public function delete_sales()
  {
    $this->db->where('m_sales_id', $this->input->post('delete_id'));
    $this->db->delete('sales_wp_tbl');
    return true;
  }


  //=======================================================plot=================================================//

  public function get_plot_list($from_date, $to_date)
  {
    $this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_plots_tbl.m_plot_city', 'left');
    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_plot_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_plot_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $res = $this->db->get('master_plots_tbl')->result();
    return $res;
  }


  public function get_Active_plot()
  {
    $res = $this->db->where('m_plot_status', 1)->get('master_plots_tbl')->result();
    return $res;
  }

  public function get_credit_plot()
  {
    $res = $this->db->where('m_plot_status', 1)->where('m_plot_type', 1)->get('master_plots_tbl')->result();
    return $res;
  }

  public function get_plot_dtl($id)
  {
    $this->db->select('*');
    $this->db->where('m_plot_id', $id);
    $this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_plots_tbl.m_plot_city', 'left');
    $res = $this->db->get('master_plots_tbl')->row();

    return $res;
  }

  public function get_plotmem_dtl($id, $status = '')
  {
    $this->db->select('*');
    if (!empty($status)) {
      $this->db->where('p_member_status', $status);
    }
    $this->db->where('p_member_plotid', $id);
    return $this->db->get('plot_member_tbl')->result();
  }

  public function get_plotmem_details($memid)
  {
    $this->db->select('*');
    $this->db->join('master_plots_tbl', 'master_plots_tbl.m_plot_id = plot_member_tbl.p_member_plotid');
    $this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_plots_tbl.m_plot_city', 'left');
    $this->db->where('p_member_id', $memid);
    return $this->db->get('plot_member_tbl')->row();
  }

  public function get_plotmem_count($id)
  {
    $this->db->where('p_member_plotid', $id);
    return $this->db->get('plot_member_tbl')->num_rows();
  }

  public function get_plotmem_list($plotno)
  {
    $this->db->select('*');
    $this->db->where('m_plot_no', $plotno);
    $this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_plots_tbl.m_plot_city', 'left');
    $res = $this->db->get('master_plots_tbl')->row();

    if (!empty($res)) {
      $member_list = $this->get_plotmem_dtl($res->m_plot_id, 1);
      return $member_list;
    }
  }

  public function insert_plot()
  {

    $plotid = $this->input->post('m_plot_id');

    // for 1st image upload code.
    if (!empty($_FILES['m_plot_docs']['name'])) {
      $config['file_name'] = $_FILES['m_plot_docs']['name'];
      $config['upload_path'] = 'uploads/plots';
      $config['allowed_types'] = 'jpg|jpeg|png|pdf';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_plot_docs']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_plot_docs')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_plot_docs'])) {
          if (file_exists($config['m_plot_docs'] . $update_data['m_plot_docs'])) {
            unlink($config['upload_path'] . $update_data['m_plot_docs']); /* deleting Image */
          }
        }
        $m_plot_docs = $uploadData['file_name'];
      }
    } else {
      $m_plot_docs = $this->input->post('m_plot_docs1');
    }

    // for 1st image upload code.
    if (!empty($_FILES['m_plot_registry']['name'])) {
      $config['file_name'] = $_FILES['m_plot_registry']['name'];
      $config['upload_path'] = 'uploads/plots';
      $config['allowed_types'] = 'jpg|jpeg|png|pdf';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_plot_registry']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_plot_registry')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_plot_registry'])) {
          if (file_exists($config['m_plot_registry'] . $update_data['m_plot_registry'])) {
            unlink($config['upload_path'] . $update_data['m_plot_registry']); /* deleting Image */
          }
        }
        $m_plot_registry = $uploadData['file_name'];
      }
    } else {
      $m_plot_registry = $this->input->post('m_plot_registry1');
    }

    $data = array(
      "m_plot_name" => $this->input->post('m_plot_name'),
      "m_plot_fname" => $this->input->post('m_plot_fname'),
      "m_plot_no" => $this->input->post('m_plot_no'),
      "m_plot_type" => $this->input->post('m_plot_type'),
      "m_plot_mobile" => $this->input->post('m_plot_mobile'),
      "m_plot_whatsappNo" => $this->input->post('m_plot_whatsappNo'),
      "m_plot_email" => $this->input->post('m_plot_email'),
      "m_plot_city" => $this->input->post('m_plot_city'),
      "m_plot_pincode" => $this->input->post('m_plot_pincode'),
      "m_plot_address" => $this->input->post('m_plot_address'),
      "is_adhar_rcvd" => $this->input->post('is_adhar_rcvd') != '' ? 1 : 0,
      "m_plot_aadhar_no" => $this->input->post('m_plot_aadhar_no'),
      "reg_paper_rcvd" => $this->input->post('reg_paper_rcvd') != '' ? 1 : 0,
      "m_plot_registry" => $m_plot_registry,
      "m_plot_docs" => $m_plot_docs,
      "m_plot_remark" => $this->input->post('m_plot_remark'),
      "m_plot_emcontact_no" => $this->input->post('m_plot_emcontact_no'),
      "m_plot_emname" => $this->input->post('m_plot_emname'),
      "m_plot_emrelation" => $this->input->post('m_plot_emrelation'),
      "m_plot_status" => 1,

    );

    if (!empty($plotid)) {
      $this->db->where('m_plot_id', $plotid)->update('master_plots_tbl', $data);
      $plot_id = $plotid;
      $res = 2;
    } else {

      $check_plot = $this->db->where("m_plot_no", $this->input->post('m_plot_no'))->where("m_plot_type", $this->input->post('m_plot_type'))->get('master_plots_tbl')->row();
      if (!empty($check_plot)) {
        return 3;
      }

      $data['m_plot_added_on'] = date('Y-m-d H:i:s');
      $this->db->insert('master_plots_tbl', $data);
      $plot_id = $this->db->insert_id();

      $res = 1;
    }

    $member_id = $this->input->post('p_member_id');
    $member_name = $this->input->post('p_member_name');
    $member_adharno = $this->input->post('p_member_adharno');
    $member_mobileno = $this->input->post('p_member_mobileno');
    $member_whatapp = $this->input->post('p_member_whatapp');
    $member_docs = $this->input->post('p_member_docs1');
    $member_image = $this->input->post('p_member_image1');

    for ($i = 0; $i < count($member_name); $i++) {

      if (!empty($_FILES['p_member_imae']['name'][$i])) {
        $_FILES['file']['name'] = $_FILES['p_member_imae']['name'][$i];
        $_FILES['file']['type'] = $_FILES['p_member_imae']['type'][$i];
        $_FILES['file']['tmp_name'] = $_FILES['p_member_imae']['tmp_name'][$i];
        $_FILES['file']['error'] = $_FILES['p_member_imae']['error'][$i];
        $_FILES['file']['size'] = $_FILES['p_member_imae']['size'][$i];

        $config['upload_path'] = 'uploads/capure_images';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '5000';
        $config['file_name'] = $_FILES['p_member_imae']['name'][$i];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
          $uploadData = $this->upload->data();
          $filename = $uploadData['file_name'];
          $p_member_image = $filename;
        }
      } else {
        $p_member_image = $member_image[$i];
      }

      if (!empty($_FILES['p_member_docs']['name'][$i])) {
        $_FILES['file']['name'] = $_FILES['p_member_docs']['name'][$i];
        $_FILES['file']['type'] = $_FILES['p_member_docs']['type'][$i];
        $_FILES['file']['tmp_name'] = $_FILES['p_member_docs']['tmp_name'][$i];
        $_FILES['file']['error'] = $_FILES['p_member_docs']['error'][$i];
        $_FILES['file']['size'] = $_FILES['p_member_docs']['size'][$i];

        $config['upload_path'] = 'uploads/plots';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = '5000';
        $config['file_name'] = $_FILES['p_member_docs']['name'][$i];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
          $uploadData = $this->upload->data();
          $filname = $uploadData['file_name'];
          $p_member_docs = $filname;
        }
      } else {
        $p_member_docs = $member_docs[$i];
      }

      if ($member_name[$i] != '') {
        $memdata = array(
          "p_member_plotid" => $plot_id,
          "p_member_name" => $member_name[$i],
          "p_member_adharno" => $member_adharno[$i],
          "p_member_mobileno" => $member_mobileno[$i],
          "p_member_whatapp" => $member_whatapp[$i],
          "p_member_image" => $p_member_image,
          "p_member_docs" => $p_member_docs,

        );
        if ($member_id[$i] != '') {
          $this->db->where('p_member_id', $member_id[$i])->update('plot_member_tbl', $memdata);
          $res = 2;
        } else {
          $data['p_member_status'] = 1;
          $data['p_member_addedon'] = date('Y-m-d H:i');
          $this->db->insert('plot_member_tbl', $memdata);
          // $plot_id = $this->db->insert_id();

          $res = 1;
        }
        // $this->db->insert('plot_member_tbl', $memdata);
      }
    }
    return $res;
  }

  public function plot_membership_cancel()
  {

    if (!empty($_FILES['m_cancel_docs']['name'])) {
      $config['file_name'] = $_FILES['m_cancel_docs']['name'];
      $config['upload_path'] = 'uploads/plots';
      $config['allowed_types'] = 'jpg|jpeg|png|pdf';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_cancel_docs']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_cancel_docs')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_cancel_docs'])) {
          if (file_exists($config['m_cancel_docs'] . $update_data['m_cancel_docs'])) {
            unlink($config['upload_path'] . $update_data['m_cancel_docs']); /* deleting Image */
          }
        }
        $m_cancel_docs = $uploadData['file_name'];
      }
    } else {
      $m_cancel_docs = $this->input->post('m_cancel_docs1');
    }
    $memdata = array(

      "m_cancel_reason" => $this->input->post('m_cancel_reason'),
      "m_cancel_docs" => $m_cancel_docs,
      "p_member_status" => 0,
      "m_cancel_by" => $this->session->userdata('user_id'),
      "m_cancel_on" => date('Y-m-d H:i'),

    );

    return $this->db->where('p_member_id', $this->input->post('m_cancel_id'))->update('plot_member_tbl', $memdata);
  }
  public function reactive_plot()
  {

    return $this->db->set('p_member_status', 1)->where('p_member_id', $this->input->post('mem_id'))->update('plot_member_tbl');
  }

  public function delete_plot()
  {

    $this->db->where('m_plot_id', $this->input->post('delete_id'));
    $this->db->delete('master_plots_tbl');

    $this->db->where('p_member_plotid', $this->input->post('delete_id'));
    $this->db->delete('plot_member_tbl');

    return true;
  }
  //=======================================================plot=================================================//

  //========================== menugroup  =============================//

  public function get_all_menugroup()
  {
    $this->db->select('*');
    $this->db->order_by('m_menugroup_name');
    $res = $this->db->get('master_menugroup_tbl')->result();
    return $res;
  }
  public function get_edit_menugroup($edid)
  {
    $this->db->select('*');
    $this->db->where('m_menugroup_id', $edid);
    $res = $this->db->get('master_menugroup_tbl')->row();
    return $res;
  }
  public function insert_menugroup()
  {

    $s_data = array(
      "m_menugroup_name" => $this->input->post('m_menugroup_name'),
      "m_menugroup_status" => $this->input->post('m_menugroup_status'),
      "m_menugroup_added_on" => date('Y-m-d H:i'),
    );
    $id = $this->input->post('m_menugroup_id');
    if (!empty($id)) {
      $this->db->where('m_menugroup_id', $id)->update('master_menugroup_tbl', $s_data);
      return 2;
    } else {
      $this->db->insert('master_menugroup_tbl', $s_data);
      return 1;
    }
  }


  public function delete_menugroup()
  {
    $this->db->where('m_menugroup_id', $this->input->post('delete_id'));
    return $this->db->delete('master_menugroup_tbl');
  }

  public function get_active_menugroup()
  {
    $this->db->select('menugroup.m_menugroup_name,menugroup.m_menugroup_id');
    $this->db->where('m_menugroup_status', '1');
    $this->db->order_by('m_menugroup_name');
    $res = $this->db->get('master_menugroup_tbl menugroup')->result();
    return $res;
  }
  //=========================================== menugroup ===============================================//



  //========================== menu  =============================//

  public function get_all_menu()
  {
    $this->db->select('*');
    $this->db->join('master_menugroup_tbl', 'master_menugroup_tbl.m_menugroup_id = master_menu_tbl.m_menu_group', 'left');
    $this->db->join('master_prodgroup_tbl', 'master_prodgroup_tbl.m_prodgroup_id = master_menu_tbl.m_menu_produnit', 'left');
    $this->db->order_by('m_menu_name');
    $res = $this->db->get('master_menu_tbl')->result();
    return $res;
  }
  public function get_edit_menu($edid)
  {
    $this->db->select('*');
    $this->db->where('m_menu_id', $edid);
    $res = $this->db->get('master_menu_tbl')->row();
    return $res;
  }
  public function insert_menu()
  {

    $s_data = array(
      "m_menu_group" => $this->input->post('m_menu_group'),
      "m_menu_code" => $this->input->post('m_menu_code'),
      "m_menu_name" => $this->input->post('m_menu_name'),
      "m_menu_produnit" => $this->input->post('m_menu_produnit'),
      "m_menu_rate" => $this->input->post('m_menu_rate'),
      // "m_menu_stock" => $this->input->post('m_menu_stock'),
      // "m_menu_bomqty" => $this->input->post('m_menu_bomqty'),
      "m_menu_status" => $this->input->post('m_menu_status'),

    );
    $id = $this->input->post('m_menu_id');
    if (!empty($id)) {
      $this->db->where('m_menu_id', $id)->update('master_menu_tbl', $s_data);
      return 2;
    } else {
      $s_data['m_menu_added_on'] = date('Y-m-d H:i');
      $this->db->insert('master_menu_tbl', $s_data);
      return 1;
    }
  }


  public function delete_menu()
  {
    $this->db->where('m_menu_id', $this->input->post('delete_id'));
    return $this->db->delete('master_menu_tbl');
  }

  public function get_active_menu()
  {
    $this->db->select('menu.m_menu_name,menu.m_menu_code,menu.m_menu_id,m_menu_rate');
    $this->db->where('m_menu_status', '1');
    $res = $this->db->get('master_menu_tbl menu')->result();
    return $res;
  }
  //=========================================== menu ===============================================//


  //=========================================== resort entries ===============================================//

  public function get_resort_data_list($type, $from_date, $to_date, $status = '')
  {
    $this->db->select('resort_data_tbl.*,(r_resdata_amount + r_resdata_amt2 + r_resdata_fpamt1 + r_resdata_fpamt2) as total_amount,(r_resdata_child + r_resdata_adult) as total_person,m_city_name,m_cashacc_name,m_emp_name,m_hq_name');

    $this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id = resort_data_tbl.r_resdata_respon', 'left');
    $this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = resort_data_tbl.r_resdata_city', 'left');
    $this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = resort_data_tbl.r_resdata_act', 'left');
    $this->db->join('master_hq_tbl', 'master_hq_tbl.m_hq_id = resort_data_tbl.r_resdata_band', 'left');
    if (!empty($type)) {
      $this->db->where('r_resdata_type', $type);
    }
    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(r_resdata_addedon,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(r_resdata_addedon,"%Y-%m-%d")<=', $to_date);
    }
    if (!empty($status)) {
      $this->db->where('r_resdata_status', $status);
    }
    return $this->db->get('resort_data_tbl')->result();
  }

  public function get_resort_data_dtl($id)
  {
    $this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id = resort_data_tbl.r_resdata_respon', 'left');
    $this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = resort_data_tbl.r_resdata_city', 'left');
    $this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = resort_data_tbl.r_resdata_act', 'left');

    return $this->db->where('r_resdata_id', $id)->get('resort_data_tbl')->row();
  }

  public function insert_resort_data()
  {

    $resdataid = $this->input->post('r_resdata_id');
    $customer_mobile = $this->input->post('r_resdata_mobile');

    $userCheck = $this->db->select('m_cust_id')->where('m_cust_mobile', $customer_mobile)->get('master_customer_tbl')->row();

    if (!empty($userCheck)) {
      $r_resdata_cust = $userCheck->m_cust_id;
      $this->db->set('m_cust_name', $this->input->post('r_resdata_name'))->set('m_cust_city', $this->input->post('r_resdata_city'))->where('m_cust_id', $r_resdata_cust)->update('master_customer_tbl');
    } else {
      $userinsert = array(
        "m_cust_mobile" => $customer_mobile,
        "m_cust_name" => $this->input->post('r_resdata_name'),
        "m_cust_city" => $this->input->post('r_resdata_city'),
        "m_cust_address" => $this->input->post('r_resdata_address'),
        "m_cust_added_on" => date('Y-m-d H:i'),
        "m_cust_status" => 1,
      );
      $this->db->insert('master_customer_tbl', $userinsert);
      $r_resdata_cust = $this->db->insert_id();
    }

    $total_person = ($this->input->post('r_resdata_adult') + $this->input->post('r_resdata_child'));
    $data = array(
      "r_resdata_type" => $this->input->post('r_resdata_type'),
      "r_resdata_date" => $this->input->post('r_resdata_date'),
      "r_resdata_mobile" => $this->input->post('r_resdata_mobile'),
      "r_resdata_adult" => $this->input->post('r_resdata_adult'),
      "r_resdata_name" => $this->input->post('r_resdata_name'),
      "r_resdata_child" => $this->input->post('r_resdata_child'),
      "r_resdata_city" => $this->input->post('r_resdata_city'),
      "r_resdata_address" => $this->input->post('r_resdata_address'),
      "r_resdata_cust" => $r_resdata_cust,
      "r_resdata_remark" => $this->input->post('r_resdata_remark'),
      "r_resdata_roomno" => $this->input->post('r_resdata_roomno'),
      "r_resdata_act" => $this->input->post('r_resdata_act'),
      "r_resdata_amount" => $this->input->post('r_resdata_amount'),
      "r_resdata_amt2" => $this->input->post('r_resdata_amt2') ?: 0,
      "r_resdata_paytype" => $this->input->post('r_resdata_paytype'),
      "r_resdata_iscredit" => $this->input->post('r_resdata_iscredit') ?: 0,
      "r_resdata_balamt" => $this->input->post('r_resdata_balamt') ?: 0,
      "r_resdata_respon" => $this->input->post('r_resdata_respon') ?: 0,
      "r_resdata_paytype2" => $this->input->post('r_resdata_paytype2') ?: 0,
      "r_resdata_ispartial" => $this->input->post('r_resdata_ispartial') ?: 0,
      "r_resdata_fispartial" => $this->input->post('r_resdata_fispartial') ?: 0,
      "r_resdata_fpmode1" => $this->input->post('r_resdata_fpmode1') ?: 0,
      "r_resdata_fpamt1" => $this->input->post('r_resdata_fpamt1') ?: 0,
      "r_resdata_fpmode2" => $this->input->post('r_resdata_fpmode2') ?: 0,
      "r_resdata_fpamt2" => $this->input->post('r_resdata_fpamt2') ?: 0,
      "r_resdata_rmqty" => $this->input->post('r_resdata_rmqty'),

    );

    // print_r($data); die;

    if (!empty($resdataid)) {
      // $data['r_resdata_updatedon'] = date('Y-m-d H:i:s');
      // $data['r_resdata_updatedby'] = $this->session->userdata('user_id');
      $this->db->where('r_resdata_id', $resdataid)->update('resort_data_tbl', $data);
      // $shop_id = $ticketid;
      $retrun_val = 2;
    } else {

      if ($this->isweekend($this->input->post('r_resdata_date')) == 2) {
        if ($this->input->post('r_resdata_type') == 1) {
          $rbandcolour = get_rate_band('WDRB', 3);
        } else {
          $rbandcolour = get_rate_band('WDCB', 3);
        }
      } else {
        if ($this->input->post('r_resdata_type') == 1) {
          $rbandcolour = get_rate_band('WERB', 4);
        } else {
          $rbandcolour = get_rate_band('WECB', 4);
        }
      }



      $data['r_resdata_band'] = $rbandcolour;
      $data['r_resdata_addedon'] = date('Y-m-d H:i:s');
      $data['r_resdata_added_by'] = $this->session->userdata('user_id');
      $data['r_resdata_status'] = 1;
      $rd = $this->db->insert('resort_data_tbl', $data);


      $Rresortbands = $this->get_bands($rbandcolour, 1);
      $Uresortbands = $this->get_bands($rbandcolour, 3);

      if (!empty($Rresortbands)) {
        if ($Rresortbands->m_band_instock > 0) {
          if ($Rresortbands->m_band_instock >= (int)$total_person) {
            $this->db->set('m_band_instock', 'm_band_instock-' . (int)$total_person, false)->where('m_band_id', $Rresortbands->m_band_id)->update('master_bands_tbl');
          } else {
            if (!empty($Uresortbands)) {
              $this->db->set('m_band_instock', 'm_band_instock-' . ((int)$total_person - $Rresortbands->m_band_instock), false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Uresortbands->m_band_id)->update('master_bands_tbl');
              $this->db->set('m_band_instock', 0)->set('m_band_status', 2)->where('m_band_id', $Rresortbands->m_band_id)->update('master_bands_tbl');
            } else {
              return false;
            }
          }
        } else {
          if (!empty($Uresortbands)) {
            $this->db->set('m_band_instock', 'm_band_instock-' . (int)$total_person, false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Uresortbands->m_band_id)->update('master_bands_tbl');
            $this->db->set('m_band_status', 2)->where('m_band_id', $Rresortbands->m_band_id)->update('master_bands_tbl');
          } else {
            return false;
          }
        }
      }

      $retrun_val = 1;
    }

    return $retrun_val;
  }

  public function update_checkout_status()
  {
    $data = array(

      "r_resdata_fispartial" => $this->input->post('r_resdata_fispartial') ?: 0,
      "r_resdata_fpmode1" => $this->input->post('r_resdata_fpmode1') ?: 0,
      "r_resdata_fpamt1" => $this->input->post('r_resdata_fpamt1') ?: 0,
      "r_resdata_fpmode2" => $this->input->post('r_resdata_fpmode2') ?: 0,
      "r_resdata_fpamt2" => $this->input->post('r_resdata_fpamt2') ?: 0,
      "r_resdata_status" => 2,
      "r_resdata_updatedon" => date('Y-m-d H:i:s'),
      "r_resdata_updatedby" => $this->session->userdata('user_id'),

    );
    $this->db->where('r_resdata_id', $this->input->post('r_resdata_id'));
    return $this->db->update('resort_data_tbl', $data);
  }

  public function delete_resort_data()
  {
    $this->db->where('r_resdata_id', $this->input->post('delete_id'));
    $this->db->delete('resort_data_tbl');
    return true;
  }


  //=========================================== resort entries ===============================================//

  //=========================================== foodcourt entries ===============================================//


  public function get_foodcourt_list($from_date, $to_date, $itemid = '')
  {

    $this->db->select('r_fcdata_uno,r_fcdata_date,r_fcdata_cust,r_fcdata_name,r_fcdata_mobile,group_concat(r_fcdata_itemid) as itemid,group_concat(r_fcdata_qty) as itmqty,sum(r_fcdata_qty) as totqty,group_concat(r_fcdata_rate) as itrates,group_concat(r_fcdata_total) as ittot,r_fcdata_nettotal,r_fcdata_iscredit,r_fcdata_balamt,r_fcdata_respon,r_fcdata_ispartial,r_fcdata_acc,r_fcdata_amt,r_fcdata_amt2,r_fcdata_paytype,r_fcdata_paytype2,r_fcdata_remark,r_fcdata_status,respon.m_emp_name,respon.m_emp_mobile,addedby.m_admin_name,m_cashacc_name,r_fcdata_extra,r_fcdata_disc');
    $this->db->join('master_admin_tbl addedby', 'addedby.m_admin_id = foodcourt_data_tbl.r_fcdata_added_by', 'left');
    $this->db->join('master_employee_tbl respon', 'respon.m_emp_id = foodcourt_data_tbl.r_fcdata_respon', 'left');
    $this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = foodcourt_data_tbl.r_fcdata_acc', 'left');


    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(r_fcdata_date,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(r_fcdata_date,"%Y-%m-%d")<=', $to_date);
    }

    if (!empty($itemid)) {
      $this->db->where('r_fcdata_itemid', $itemid);
    }

    $this->db->group_by('r_fcdata_uno');
    $this->db->order_by('r_fcdata_uno', 'desc');
    return $this->db->get('foodcourt_data_tbl')->result();
  }


  public function get_foodcourt_dtl($food_uno)
  {

    $this->db->select('r_fcdata_uno,r_fcdata_date,r_fcdata_cust,r_fcdata_name,r_fcdata_mobile,r_fcdata_nettotal,r_fcdata_iscredit,r_fcdata_balamt,r_fcdata_respon,r_fcdata_ispartial,r_fcdata_acc,r_fcdata_amt,r_fcdata_amt2,r_fcdata_paytype,r_fcdata_paytype2,r_fcdata_remark,r_fcdata_status,respon.m_emp_name,respon.m_emp_mobile,addedby.m_admin_name,m_cashacc_name,r_fcdata_extra,r_fcdata_disc');
    $this->db->join('master_admin_tbl addedby', 'addedby.m_admin_id = foodcourt_data_tbl.r_fcdata_added_by', 'left');
    $this->db->join('master_employee_tbl respon', 'respon.m_emp_id = foodcourt_data_tbl.r_fcdata_respon', 'left');
    $this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = foodcourt_data_tbl.r_fcdata_acc', 'left');
    $this->db->where('r_fcdata_uno', $food_uno);
    $this->db->group_by('r_fcdata_uno');
    $sale_datil = $this->db->get('foodcourt_data_tbl')->result();

    $this->db->select('r_fcdata_id,r_fcdata_uno,r_fcdata_itemid,r_fcdata_qty,r_fcdata_rate,r_fcdata_total,m_menu_name');
    $this->db->join('master_menu_tbl mit', 'mit.m_menu_id = foodcourt_data_tbl.r_fcdata_itemid', 'left');
    $this->db->where('r_fcdata_uno', $food_uno);

    $sale_items =  $this->db->get('foodcourt_data_tbl')->result();

    if (!empty($sale_datil)) {
      $res = (object) array(

        'r_fcdata_uno' => $sale_datil[0]->r_fcdata_uno,
        'r_fcdata_date' => $sale_datil[0]->r_fcdata_date,
        'r_fcdata_cust' => $sale_datil[0]->r_fcdata_cust,
        'r_fcdata_name' => $sale_datil[0]->r_fcdata_name,
        'r_fcdata_mobile' => $sale_datil[0]->r_fcdata_mobile,
        'r_fcdata_nettotal' => $sale_datil[0]->r_fcdata_nettotal,
        'r_fcdata_iscredit' => $sale_datil[0]->r_fcdata_iscredit,
        'r_fcdata_balamt' => $sale_datil[0]->r_fcdata_balamt,
        'r_fcdata_respon' => $sale_datil[0]->r_fcdata_respon,
        'r_fcdata_ispartial' => $sale_datil[0]->r_fcdata_ispartial,
        'r_fcdata_acc' => $sale_datil[0]->r_fcdata_acc,
        'r_fcdata_amt' => $sale_datil[0]->r_fcdata_amt,
        'r_fcdata_amt2' => $sale_datil[0]->r_fcdata_amt2,
        'r_fcdata_paytype' => $sale_datil[0]->r_fcdata_paytype,
        'r_fcdata_paytype2' => $sale_datil[0]->r_fcdata_paytype2,
        'r_fcdata_remark' => $sale_datil[0]->r_fcdata_remark,
        'r_fcdata_status' => $sale_datil[0]->r_fcdata_status,
        'r_fcdata_extra' => $sale_datil[0]->r_fcdata_extra,
        'r_fcdata_disc' => $sale_datil[0]->r_fcdata_disc,
        'm_emp_name' => $sale_datil[0]->m_emp_name,
        'm_emp_mobile' => $sale_datil[0]->m_emp_mobile,
        'm_admin_name' => $sale_datil[0]->m_admin_name,
        'm_cashacc_name' => $sale_datil[0]->m_cashacc_name,
        "r_fcdata_items" => $sale_items,
      );
    }
    return $res;
  }

  public function insert_foodcourt()
  {

    $resdataid = $this->input->post('r_fcdata_id');
    $customer_mobile = $this->input->post('r_fcdata_mobile');

    if (!empty($customer_mobile)) {

      $userCheck = $this->db->select('m_cust_id')->where('m_cust_mobile', $customer_mobile)->get('master_customer_tbl')->row();

      if (!empty($userCheck)) {
        $r_fcdata_cust = $userCheck->m_cust_id;
        $this->db->set('m_cust_name', $this->input->post('r_fcdata_name'))->where('m_cust_id', $r_fcdata_cust)->update('master_customer_tbl');
      } else {
        $userinsert = array(
          "m_cust_mobile" => $customer_mobile,
          "m_cust_name" => $this->input->post('r_fcdata_name'),
          "m_cust_added_on" => date('Y-m-d H:i'),
          "m_cust_status" => 1,
        );
        $this->db->insert('master_customer_tbl', $userinsert);
        $r_fcdata_cust = $this->db->insert_id();
      }
    } else {
      $r_fcdata_cust = 0;
    }

    $checkuno = $this->db->select('r_fcdata_uno')->order_by('r_fcdata_uno', 'desc')->get('foodcourt_data_tbl')->row();
    if (!empty($checkuno)) {
      $fcdata_uno = ((int)$checkuno->r_fcdata_uno + 1);
    } else {
      $fcdata_uno = 1;
    }

    $r_fcdata_itemid = $this->input->post('r_fcdata_itemid');
    $r_fcdata_rate = $this->input->post('r_fcdata_rate');
    $r_fcdata_qty = $this->input->post('r_fcdata_qty');
    $r_fcdata_total = $this->input->post('r_fcdata_total');

    if ($this->input->post('r_fcdata_iscredit') == 1) {
      $iscredit = 1;
    } else if ($this->input->post('r_fcdata_iscredit2') == 2) {
      $iscredit = 2;
    } else if ($this->input->post('r_fcdata_iscredit3') == 3) {
      $iscredit = 3;
    } else {
      $iscredit = 0;
    }

    if ($iscredit == 1) {
      $balamt = $this->input->post('r_fcdata_nettotal');
      $amtpad = 0;
      $amtpad2 = 0;
    } else if ($iscredit == 2 || $iscredit == 3) {
      $balamt = 0;
      $amtpad = 0;
      $amtpad2 = 0;
    } else {
      $balamt = 0;
      $amtpad = $this->input->post('r_fcdata_amt');
      $amtpad2 = $this->input->post('r_fcdata_amt2');
    }

    if (!empty($r_fcdata_itemid)) {
      foreach ($r_fcdata_itemid as $cau => $key) {

        if ($r_fcdata_qty[$cau] != 0) {
          $data = array(
            "r_fcdata_date" => $this->input->post('r_fcdata_date'),
            "r_fcdata_cust" => $r_fcdata_cust,
            "r_fcdata_acc" => $this->input->post('r_fcdata_acc') ?: 0,
            "r_fcdata_mobile" => $this->input->post('r_fcdata_mobile') ?: '',
            "r_fcdata_name" => $this->input->post('r_fcdata_name') ?: '',
            "r_fcdata_balamt" => $balamt,
            "r_fcdata_nettotal" => $this->input->post('r_fcdata_nettotal'),
            "r_fcdata_remark" => $this->input->post('r_fcdata_remark'),
            "r_fcdata_respon" => $this->input->post('r_fcdata_respon') ?: 0,
            "r_fcdata_amt" => $amtpad,
            "r_fcdata_amt2" => $amtpad2,
            "r_fcdata_paytype" => $this->input->post('r_fcdata_paytype') ?: 0,
            "r_fcdata_paytype2" => $this->input->post('r_fcdata_paytype2') ?: 0,
            "r_fcdata_ispartial" => $this->input->post('r_fcdata_ispartial') ?: 0,
            "r_fcdata_iscredit" => $iscredit,
            "r_fcdata_extra" => $this->input->post('r_fcdata_extra') ?: 0,
            "r_fcdata_disc" => $this->input->post('r_fcdata_disc') ?: 0,
            "r_fcdata_itemid" => $key,
            "r_fcdata_rate" => $r_fcdata_rate[$cau],
            "r_fcdata_qty" => $r_fcdata_qty[$cau],
            "r_fcdata_total" => $r_fcdata_total[$cau],

          );

          // print_r($data); die;

          if (!empty($resdataid[$cau])) {
            $data['r_fcdata_updatedon'] = date('Y-m-d H:i:s');
            $data['r_fcdata_updatedby'] = $this->session->userdata('user_id');
            $this->db->where('r_fcdata_id', $resdataid[$cau])->update('foodcourt_data_tbl', $data);
            // $shop_id = $ticketid;
            $retrun_val = 2;
          } else {

            if (!empty($this->input->post('r_fcdata_uno'))) {
              $data['r_fcdata_uno'] = $this->input->post('r_fcdata_uno');
            } else {
              $data['r_fcdata_uno'] = $fcdata_uno;
            }

            $data['r_fcdata_addedon'] = date('Y-m-d H:i:s');
            $data['r_fcdata_added_by'] = $this->session->userdata('user_id');
            $data['r_fcdata_status'] = 1;
            $rd = $this->db->insert('foodcourt_data_tbl', $data);

            $retrun_val = 1;
          }
        }
      }
    }

    return $retrun_val;
  }

  public function delete_foodcourt()
  {
    if ($this->input->post('dtype') == 1) {
      $this->db->where('r_fcdata_uno', $this->input->post('delete_id'));
      return $this->db->delete('foodcourt_data_tbl');
    } else {
      $this->db->where('r_fcdata_id', $this->input->post('delete_id'));
      return $this->db->delete('foodcourt_data_tbl');
    }
  }


  //=========================================== foodcourt entries ===============================================//


  function band_used_fun($ticket_id, $salehead, $total_adult, $total_child, $total_free = '')
  {
    if ($this->isweekend($this->input->post('m_ticket_date')) == 2) {
      if ($salehead == 9) {
        $adult_bandcolour = get_rate_band('WDCAB', 3);
        $child_bandcolour = get_rate_band('WDCCB', 3);
      } else if ($salehead == 2) {
        $adult_bandcolour = get_rate_band('WDMB', 3);
        $child_bandcolour = get_rate_band('WDMB', 3);
      } else if ($salehead == 4) {
        $adult_bandcolour = get_rate_band('WDAAB', 3);
        $child_bandcolour = get_rate_band('WDACB', 3);
      } else {
        $adult_bandcolour = get_rate_band('WDWPAB', 3);
        $child_bandcolour = get_rate_band('WDWPCB', 3);
      }
      $free_bandcolour = get_rate_band('WDFB', 3);
    } else {
      if ($salehead == 9) {
        $adult_bandcolour = get_rate_band('WECAB', 4);
        $child_bandcolour = get_rate_band('WECCB', 4);
      } else if ($salehead == 2) {
        $adult_bandcolour = get_rate_band('WEMB', 4);
        $child_bandcolour = get_rate_band('WEMB', 4);
      } else if ($salehead == 4) {
        $adult_bandcolour = get_rate_band('WEAAB', 4);
        $child_bandcolour = get_rate_band('WEACB', 4);
      } else {
        $adult_bandcolour = get_rate_band('WEWPAB', 4);
        $child_bandcolour = get_rate_band('WEWPCB', 4);
      }
      $free_bandcolour = get_rate_band('WEFB', 3);
    }

    $this->db->set('m_ticket_band', $adult_bandcolour . ',' . $child_bandcolour . ',' . $free_bandcolour)->where('m_ticket_id', $ticket_id)->update('tickets_wp_tbl');

    $Radult_band = $this->get_bands($adult_bandcolour, 1);
    $Uadult_band = $this->get_bands($adult_bandcolour, 3);
    $Rchild_band = $this->get_bands($child_bandcolour, 1);
    $Uchild_band = $this->get_bands($child_bandcolour, 3);

    $Rfree_band = $this->get_bands($free_bandcolour, 1);
    $Ufree_band = $this->get_bands($free_bandcolour, 3);

    if (!empty($Radult_band)) {
      if ($Radult_band->m_band_instock > 0) {
        if ($Radult_band->m_band_instock >= (int)$total_adult) {
          $this->db->set('m_band_instock', 'm_band_instock-' . (int)$total_adult, false)->where('m_band_id', $Radult_band->m_band_id)->update('master_bands_tbl');
        } else {
          if (!empty($Uadult_band)) {
            $this->db->set('m_band_instock', 'm_band_instock-' . ((int)$total_adult - $Radult_band->m_band_instock), false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Uadult_band->m_band_id)->update('master_bands_tbl');
            $this->db->set('m_band_instock', 0)->set('m_band_status', 2)->where('m_band_id', $Radult_band->m_band_id)->update('master_bands_tbl');
          } else {
            return false;
          }
        }
      } else {
        if (!empty($Uadult_band)) {
          $this->db->set('m_band_instock', 'm_band_instock-' . (int)$total_adult, false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Uadult_band->m_band_id)->update('master_bands_tbl');
          $this->db->set('m_band_status', 2)->where('m_band_id', $Radult_band->m_band_id)->update('master_bands_tbl');
        } else {
          return false;
        }
      }
    }

    if (!empty($Rchild_band)) {
      if ($Rchild_band->m_band_instock > 0) {
        if ($Rchild_band->m_band_instock >= (int)$total_child) {
          $this->db->set('m_band_instock', 'm_band_instock-' . (int)$total_child, false)->where('m_band_id', $Rchild_band->m_band_id)->update('master_bands_tbl');
        } else {
          if (!empty($Uchild_band)) {
            $this->db->set('m_band_instock', 'm_band_instock-' . ((int)$total_child - $Rchild_band->m_band_instock), false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Uchild_band->m_band_id)->update('master_bands_tbl');
            $this->db->set('m_band_instock', 0)->set('m_band_status', 2)->where('m_band_id', $Rchild_band->m_band_id)->update('master_bands_tbl');
          } else {
            return false;
          }
        }
      } else {
        if (!empty($Uchild_band)) {
          $this->db->set('m_band_instock', 'm_band_instock-' . (int)$total_child, false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Uchild_band->m_band_id)->update('master_bands_tbl');
          $this->db->set('m_band_status', 2)->where('m_band_id', $Rchild_band->m_band_id)->update('master_bands_tbl');
        } else {
          return false;
        }
      }
    }

    if (!empty($total_free) && !empty($Rfree_band)) {
      if ($Rfree_band->m_band_instock > 0) {
        if ($Rfree_band->m_band_instock >= (int)$total_free) {
          $this->db->set('m_band_instock', 'm_band_instock-' . (int)$total_free, false)->where('m_band_id', $Rfree_band->m_band_id)->update('master_bands_tbl');
        } else {
          if (!empty($Ufree_band)) {
            $this->db->set('m_band_instock', 'm_band_instock-' . ((int)$total_free - $Rfree_band->m_band_instock), false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Ufree_band->m_band_id)->update('master_bands_tbl');
            $this->db->set('m_band_instock', 0)->set('m_band_status', 2)->where('m_band_id', $Rfree_band->m_band_id)->update('master_bands_tbl');
          } else {
            return false;
          }
        }
      } else {
        if (!empty($Ufree_band)) {
          $this->db->set('m_band_instock', 'm_band_instock-' . (int)$total_free, false)->set('m_band_status', 1)->set('m_band_starton', date('Y-m-d H:i'))->where('m_band_id', $Ufree_band->m_band_id)->update('master_bands_tbl');
          $this->db->set('m_band_status', 2)->where('m_band_id', $Rfree_band->m_band_id)->update('master_bands_tbl');
        } else {
          return false;
        }
      }
    }
  }


  function isweekend($date)
  {
    $date = strtotime($date);
    $date = date("l", $date);
    $date = strtolower($date);
    // echo $date;
    if ($date == "saturday" || $date == "sunday" || get_settings('is_today_holiday') == 1) {
      return 1;
    } else {
      return 2;
    }
  }

  function get_bands($color, $status)
  {
    return $this->db->select('m_band_id,m_band_instock')
      ->where('m_band_color', $color)
      ->where('m_band_status', $status)
      ->get('master_bands_tbl')->row();
  }

  public function RandomString($length)

  {

    $keys = array_merge(range(0, 9), range('0', '9'));

    $key = "";

    for ($i = 0; $i < $length; $i++) {

      $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
  }
}
