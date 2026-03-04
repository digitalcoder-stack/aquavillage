<?php
date_default_timezone_set('Asia/Kolkata');
class API_model extends CI_model
{


  public function check_mobile($mobile)
  {
    $this->db->select('m_emp_id');
    $this->db->where("m_emp_mobile", $mobile);
    $sql = $this->db->get("master_employee_tbl");
    return $sql->result();
  }


  public function user_details($user_id)
  {
    $this->db->select('m_emp_id,m_emp_name,m_emp_code,m_emp_mobile,m_emp_email,m_emp_dob,m_emp_laddress,m_emp_login_type');
    // $this->db->join('master_designation_tbl', 'master_designation_tbl.m_desig_id = master_employee_tbl.m_emp_design', 'left');
    $this->db->where("m_emp_id", $user_id);
    $sql = $this->db->get("master_employee_tbl");
    return $sql->result();
  }


  public function user_login($mobile, $password, $type)
  {
    if($mobile == 7587422222){
      $this->db->select('m_emp_id,m_emp_mobile');
      $this->db->where('m_emp_mobile', $mobile);
      $this->db->where('m_emp_password', $password);
      $this->db->where('is_out_of_job', 0);
      $res = $this->db->get('master_employee_tbl')->result();
      return $res;
    }else {
      $this->db->select('m_emp_id,m_emp_mobile');
      $this->db->where('m_emp_mobile', $mobile);
      $this->db->where('m_emp_password', $password);
      $this->db->where('is_out_of_job', 0);
      $this->db->where('m_emp_login_type', $type);
      $res = $this->db->get('master_employee_tbl')->result();
      return $res;
    }
  
  }

  public function get_member_entered_count()
  {
    return $this->db->select('sum(m_ticket_adult+m_ticket_child) as memberEntered')->where('m_entry_status', 1)->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")', date('Y-m-d'))->get('tickets_wp_tbl')->result();
  }

  public function get_ticket_details()
  {
    $ticketno = $this->input->post('ticket_no');
    $res = $this->db->select('m_ticket_id,m_ticket_no,m_ticket_paymode,m_entry_status,m_cust_name,m_ticket_adult,m_ticket_child,m_city_name,sum(m_ticket_adult+m_ticket_child) as totalperson,m_ticket_date,m_ticket_remark')
      //  $res = $this->db->select('*')
      ->where('m_ticket_no', $ticketno)
      ->join('master_city_tbl', 'master_city_tbl.m_city_id = tickets_wp_tbl.m_ticket_city', 'left')
      ->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = tickets_wp_tbl.m_ticket_customer', 'left')
      ->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")', date('Y-m-d'))
      ->get('tickets_wp_tbl')->row();
    if ($res->m_ticket_id != null) {
      return $res;
    }
  }



  public function update_entry_status()
  {
    $ticket_id = $this->input->post('ticket_id');
    if ($this->input->post('status') == 1) {
      $data = array(
        'm_entry_status' =>  $this->input->post('status'),
        'm_entry_time' => date('H:i:s'),
      );
    } else if ($this->input->post('status') == 2) {
      $data = array(
        'm_entry_status' =>  $this->input->post('status'),
        'm_exit_time' => date('H:i:s'),
      );
    }

    return $this->db->where('m_ticket_id', $ticket_id)->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")', date('Y-m-d'))->update('tickets_wp_tbl', $data);
  }

  public function update_remark()
  {
    $ticket_id = $this->input->post('ticket_id');

    $data = array(
      'm_ticket_remark' =>  $this->input->post('remark'),
    );

    return $this->db->where('m_ticket_id', $ticket_id)->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")', date('Y-m-d'))->update('tickets_wp_tbl', $data);
  }

  public function booking_ticket()
  {
    // $ticketid = $this->input->post('m_ticket_id');
    $customer_mobile = $this->input->post('m_cust_mobile');

    $userCheck = $this->db->select('m_cust_id')->where('m_cust_mobile', $customer_mobile)->get('master_customer_tbl')->row();
    if (!empty($userCheck)) {
      $m_ticket_customer = $userCheck->m_cust_id;
      $this->db->set('m_cust_name',$this->input->post('m_cust_name'))->set('m_cust_city',$this->input->post('m_ticket_city'))->where('m_cust_id',$m_ticket_customer)->update('master_customer_tbl');
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

    $total_adult = $this->input->post('m_ticket_adult');
    $data = array(
      "m_ticket_head" => $this->input->post('m_ticket_head'),
      "m_ticket_date" => date('Y-m-d'),
      "m_ticket_paymode" => 'Cash',
      "m_ticket_paytype" => $this->input->post('m_ticket_paytype'),
      "m_ticket_customer" => $m_ticket_customer,
      "m_ticket_adult" => $this->input->post('m_ticket_adult'),
      "m_ticket_child" => $this->input->post('m_ticket_child'),
      "m_ticket_free" => $this->input->post('m_ticket_free'),
      "m_ticket_totalAmt" => $this->input->post('m_ticket_totalAmt'),
      "m_ticket_gstAmt" => $this->input->post('m_ticket_gstAmt'),

      "m_ticket_netAmt" => $this->input->post('m_ticket_netAmt'),
      "m_ticket_paidAmt" => 0,
      "m_ticket_balAmt" =>  $this->input->post('m_ticket_netAmt'),
      "m_ticket_city" => $this->input->post('m_ticket_city'),
      "m_ticket_remark" => $this->input->post('m_ticket_remark'),
      "m_ticket_no" => $this->RandomString(8),
      "m_ticket_status" => 0,
      "m_ticket_added_on" => date('Y-m-d H:i:s'),
      "m_ticket_added_by" =>  $this->input->post('user_id'),
    );

    $this->db->insert('tickets_wp_tbl', $data);

    return true;
  }

  public function update_ticket_detail()
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

    $total_adult = $this->input->post('m_ticket_adult');
    $data = array(
      "m_ticket_head" => $this->input->post('m_ticket_head'),
      "m_ticket_date" => date('Y-m-d'),
      "m_ticket_paymode" => 'Cash',
      "m_ticket_paytype" => $this->input->post('m_ticket_paytype'),
      "m_ticket_customer" => $m_ticket_customer,
      "m_ticket_adult" => $this->input->post('m_ticket_adult'),
      "m_ticket_child" => $this->input->post('m_ticket_child'),
      "m_ticket_free" => $this->input->post('m_ticket_free'),
      "m_ticket_totalAmt" => $this->input->post('m_ticket_totalAmt'),
      "m_ticket_gstAmt" => $this->input->post('m_ticket_gstAmt'),

      "m_ticket_netAmt" => $this->input->post('m_ticket_netAmt'),
      "m_ticket_paidAmt" => 0,
      "m_ticket_balAmt" =>  $this->input->post('m_ticket_netAmt'),
      "m_ticket_city" => $this->input->post('m_ticket_city'),
      "m_ticket_remark" => $this->input->post('m_ticket_remark'),
      "m_ticket_status" => 0,
      "m_ticket_added_by" =>  $this->input->post('user_id'),
    );

    $this->db->where('m_ticket_id', $this->input->post('m_ticket_id'))->update('tickets_wp_tbl', $data);

    return true;
  }

  public function get_Active_emp()
  {
    $res = $this->db->select('m_emp_name,m_emp_id')->where('is_out_of_job', 0)->get('master_employee_tbl')->result();
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

  public function insert_city()
  {
    $check = $this->db->where('m_city_name', $this->input->post('m_city_name'))->get('master_city_tbl city')->result();

    if (empty($check)) {
      $s_data = array(
        "m_city_name" => $this->input->post('m_city_name'),
        // "m_city_state" => $this->input->post('m_city_state'),
        "m_city_country" => 1,
        "m_city_status" => 1,
        "m_city_added_on" => date('Y-m-d H:i'),
      );

      return $this->db->insert('master_city_tbl', $s_data);
    } else {
      return 'Entered City Already Exist';
    }
  }

  public function get_credit_customer()
  {

    $res = $this->db->where('m_cust_status', 1)->where('m_cust_type', 1)->get('master_customer_tbl')->result();
    return $res;
  }

  public function get_active_cashacc()
  {
    $res = $this->db->where('m_cashacc_status', 1)->get('master_cashacc_tbl')->result();
    return $res;
  }

  public function all_active_saleshead()
  {
    $res = $this->db->select('*')->where_in('m_saleshead_id', array(1, 4, 9))->where('m_saleshead_status', 1)->where('m_saleshead_type', 1)->get('master_saleshead_tbl')->result();
    return $res;
  }

  public function get_ticket_rates()
  {

    $weekDay = date('w', strtotime(date('Y-m-d')));
    if ($weekDay == 0 || $weekDay == 6 || get_settings('is_today_holiday') == 1) {

      $adult_rate = get_rate_band('WEAR', 2);
      $adultnet = round(($adult_rate * 0.18) + $adult_rate);
      $child_rate = get_rate_band('WECR', 2);
      $childnet = round(($child_rate * 0.18) + $child_rate);
      $adult_combo_rate = get_rate_band('WEACR', 2);
      $adult_combonet = round(($adult_combo_rate * 0.18) + $adult_combo_rate);
      $child_combo_rate = get_rate_band('WECCR', 2);
      $child_combonet = round(($child_combo_rate * 0.18) + $child_combo_rate);
    } else {
      $adult_rate = get_rate_band('WDAR', 1);
      $adultnet = round(($adult_rate * 0.18) + $adult_rate);
      $child_rate = get_rate_band('WDCR', 1);
      $childnet = round(($child_rate * 0.18) + $child_rate);
      $adult_combo_rate = get_rate_band('WDACR', 1);
      $adult_combonet = round(($adult_combo_rate * 0.18) + $adult_combo_rate);
      $child_combo_rate = get_rate_band('WDCCR', 1);
      $child_combonet = round(($child_combo_rate * 0.18) + $child_combo_rate);
    }


    $res = array(

      "adult_rate" => $adult_rate,
      "adultnet" => (string)$adultnet,
      "child_rate" => $child_rate,
      "childnet" => (string)$childnet,
      "adult_combo_rate" => $adult_combo_rate,
      "adult_combonet" => (string)$adult_combonet,
      "child_combo_rate" => $child_combo_rate,
      "child_combonet" => (string)$child_combonet,

    );
    return $res;
  }

  public function get_ticket_list($fromdate, $todate)
  {
    $this->db->where('m_ticket_date >=', $fromdate);
    $this->db->where('m_ticket_date <=', $todate);
    $res = $this->db->select('m_ticket_id,m_ticket_no,m_ticket_adult,m_ticket_child,m_ticket_free,m_ticket_netAmt,m_ticket_date,m_cust_mobile,m_cust_name,m_city_name,m_ticket_status,m_ticket_remark,m_ticket_free,m_saleshead_title')
      ->join('master_saleshead_tbl', 'master_saleshead_tbl.m_saleshead_id = tickets_wp_tbl.m_ticket_head', 'left')
      ->join('master_city_tbl', 'master_city_tbl.m_city_id = tickets_wp_tbl.m_ticket_city', 'left')
      ->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = tickets_wp_tbl.m_ticket_customer', 'left')
      ->where('m_ticket_added_by', $this->input->post('user_id'))->get('tickets_wp_tbl')->result();
    return $res;
  }

  public function get_ticket_details_for_counter()
  {
    $ticketid = $this->input->post('ticket_id');
    $res = $this->db->select('tickets_wp_tbl.*,m_cust_name,m_cust_mobile,m_city_name,sum(m_ticket_adult+m_ticket_child) as totalperson')
      //  $res = $this->db->select('*')
      ->where('m_ticket_id', $ticketid)
      ->join('master_city_tbl', 'master_city_tbl.m_city_id = tickets_wp_tbl.m_ticket_city', 'left')
      ->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = tickets_wp_tbl.m_ticket_customer', 'left')
      // ->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")', date('Y-m-d'))
      ->get('tickets_wp_tbl')->row();
    if ($res->m_ticket_id != null) {
      return $res;
    }
  }


  function isweekend($date)
  {
    $date = strtotime($date);
    $date = date("l", $date);
    $date = strtolower($date);
    // echo $date;
    if ($date == "saturday" || $date == "sunday") {
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

  public function get_source_list()
  {
    $this->db->select('*');
    $res = $this->db->where('m_leadst_type', 1)->where('m_leadst_status', 1)->get('master_leadsource_tbl')->result();
    return $res;
  }

  public function get_lead_type()
  {
    $this->db->select('*');
    $res = $this->db->where('m_leadst_type', 2)->where('m_leadst_status', 1)->get('master_leadsource_tbl')->result();
    return $res;
  }

  public function get_design_list()
  {
    $this->db->select('*');
    $res = $this->db->where('m_desig_status', 1)->get('master_designation_tbl')->result();
    return $res;
  }

  public function get_leadclient_list()
  {
    $this->db->select('m_lclient_id,m_lclient_name,m_lclient_village,m_lclient_potential,m_lclient_address,m_lclient_remark,m_lclient_lat,m_lclient_long,m_lclient_added_on,master_city_tbl.m_city_name as m_lclient_city,source.m_leadst_name as m_lclient_src,type.m_leadst_name as m_lclient_type');
    $this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = master_leadclient_tbl.m_lclient_city', 'left');
    $this->db->join('master_leadsource_tbl source', 'source.m_leadst_id = master_leadclient_tbl.m_lclient_src', 'left');
    $this->db->join('master_leadsource_tbl type', 'type.m_leadst_id = master_leadclient_tbl.m_lclient_type', 'left');
    $res = $this->db->get('master_leadclient_tbl')->result();
    return $res;
  }

  public function insert_leadclient()
  {
    // $lclientid = $this->input->post('m_lclient_id');
    $data = array(

      "m_lclient_src" => $this->input->post('m_lclient_src'),
      "m_lclient_type" => $this->input->post('m_lclient_type'),
      "m_lclient_name" => $this->input->post('m_lclient_name'),
      "m_lclient_village" => $this->input->post('m_lclient_village')?:'',
      "m_lclient_city" => $this->input->post('m_lclient_city'),
      "m_lclient_potential" => $this->input->post('m_lclient_potential'),
      "m_lclient_address" => $this->input->post('m_lclient_address'),
      "m_lclient_remark" => $this->input->post('m_lclient_remark'),
      "m_lclient_lat" => $this->input->post('m_lclient_lat'),
      "m_lclient_long" => $this->input->post('m_lclient_long'),
      "m_lclient_status" => 1,
      "m_lclient_added_on" => date('Y-m-d H:i:s'),

    );

    return $this->db->insert('master_leadclient_tbl', $data);
  }

  public function insert_client_persons()
  {

    // $member_id = $this->input->post('lc_person_id');
    $person_name = $this->input->post('lc_person_name');
    $person_mobileno = $this->input->post('lc_person_mobileno');
    $person_email = $this->input->post('lc_person_email');
    $person_dept = $this->input->post('lc_person_dept');
    $lclient_id = $this->input->post('lc_person_clientid');


    for ($i = 0; $i < count($person_name); $i++) {

      if ($person_name[$i] != '') {
        $memdata = array(
          "lc_person_clientid" => $lclient_id,
          "lc_person_name" => $person_name[$i],
          "lc_person_mobileno" => $person_mobileno[$i],
          "lc_person_email" => $person_email[$i],
          "lc_person_dept" => $person_dept[$i],
          "lc_person_status" => 1,
          "lc_person_addedon" => date('Y-m-d H:i:s'),

        );

        $res =   $this->db->insert('client_persondtl_tbl', $memdata);
      }
    }
    return $res;
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
      "m_lclient_lat" => $res->m_lclient_lat,
      "m_lclient_long" => $res->m_lclient_long,
      "m_lclient_added_on" => date('d-m-Y', strtotime($res->m_lclient_added_on)),
      "Contact_persons" => $this->get_lclientperson_list($res->m_lclient_id),
    );

    return $data;
  }

  public function get_lclientperson_list($id)
  {
    $this->db->select('*');
        $this->db->join('master_designation_tbl', 'master_designation_tbl.m_desig_id = client_persondtl_tbl.lc_person_dept', 'left');
    $this->db->where('lc_person_clientid', $id);
    return $this->db->get('client_persondtl_tbl')->result();
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
