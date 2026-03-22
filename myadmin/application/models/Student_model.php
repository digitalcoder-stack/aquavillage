<?php

use LDAP\Result;

date_default_timezone_set('Asia/Kolkata');
class Student_model extends CI_model
{
  //============================User============================//


  //////=============================== reports=========================================////////

  public function day_report_all($to_date, $from_date)
  {
    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $ticket = $this->db->select('sum(m_ticket_paidAmt) as total_rent,m_ticket_added_on as dated,m_cashacc_name')
      ->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = tickets_wp_tbl.m_ticket_counter', 'left')
      ->group_by('m_ticket_counter,DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")')
      ->order_by('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")')
      ->get('tickets_wp_tbl')->result();

    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $locker = $this->db->select('sum(m_locker_Trent) as total_rent,sum(m_locker_Tdeposit) as total_deposit,m_locker_added_on as dated,m_cashacc_name')
      ->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = locker_wp_tbl.m_locker_counter', 'left')
      ->group_by('m_locker_counter,DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")')
      ->order_by('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")')
      ->get('locker_wp_tbl')->result();

    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $costume = $this->db->select('sum(m_costume_Trent) as total_rent,sum(m_costume_Tdeposit) as total_deposit,m_costume_added_on as dated,m_cashacc_name')
      ->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = costume_wp_tbl.m_costume_counter', 'left')
      ->group_by('m_costume_counter,DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")')
      ->order_by('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")')
      ->get('costume_wp_tbl')->result();

    return  array_merge($ticket, $locker, $costume);
  }

  public function day_report_detail($to_date, $from_date)
  {
    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $ticket = $this->db->select('sum(m_ticket_paidAmt) as total_rent,m_ticket_added_on as dated,m_cashacc_name,sum(m_ticket_child+m_ticket_adult) as total_person')
      ->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = tickets_wp_tbl.m_ticket_counter', 'left')
      ->group_by('m_ticket_added_on')
      ->order_by('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")')
      ->get('tickets_wp_tbl')->result();

    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $locker = $this->db->select('sum(m_locker_Trent) as total_rent,sum(m_locker_Tdeposit) as total_deposit,m_locker_added_on as dated,m_cashacc_name,m_locker_Tlocker')
      ->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = locker_wp_tbl.m_locker_counter', 'left')
      ->group_by('m_locker_added_on')
      ->order_by('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")')
      ->get('locker_wp_tbl')->result();

    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")<=', $to_date);
    }

    $lockerRefund = $this->db->select('sum(m_locker_refund) as refund,m_locker_refund_on as dated,m_cashacc_name,m_locker_Tlocker')
      ->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = locker_wp_tbl.m_locker_counter', 'left')
      ->where('m_locker_status', 2)
      ->group_by('m_locker_added_on')
      ->order_by('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")')
      ->get('locker_wp_tbl')->result();

    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")<=', $to_date);
    }

    $costume = $this->db->select('sum(m_costume_Trent) as total_rent,sum(m_costume_Tdeposit) as total_deposit,m_costume_added_on as dated,m_cashacc_name,count(m_costume_Tqty) as m_costume_Tqty')
      ->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = costume_wp_tbl.m_costume_counter', 'left')
      ->group_by('m_costume_added_on')
      ->order_by('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")')
      ->get('costume_wp_tbl')->result();

    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")<=', $to_date);
    }

    $costumeRefund = $this->db->select('sum(m_costume_refund) as refund,m_costume_refund_on as dated,m_cashacc_name,count(m_costume_Tqty) as m_costume_Tqty')
      ->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = costume_wp_tbl.m_costume_counter', 'left')
      ->group_by('m_costume_added_on')
      ->where('m_costume_status', 2)
      ->order_by('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")')
      ->get('costume_wp_tbl')->result();

    return  array_merge($ticket, $locker, $costume, $costumeRefund, $lockerRefund);
  }

  public function day_report_ticket($to_date)
  {
    return $this->db->select('sum(m_ticket_paidAmt) as total_amount,m_cashacc_name')->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = tickets_wp_tbl.m_ticket_counter', 'left')->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")', $to_date)->group_by('m_ticket_counter')->get('tickets_wp_tbl')->result();
  }

  public function day_report_locker($to_date)
  {
    return $this->db->select('sum(m_locker_Trent) as total_rent,sum(m_locker_Tdeposit) as total_deposit,m_cashacc_name')->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = locker_wp_tbl.m_locker_counter', 'left')->where('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")', $to_date)->group_by('m_locker_counter')->get('locker_wp_tbl')->result();
  }

  public function day_report_costume($to_date)
  {
    return $this->db->select('sum(m_costume_Trent) as total_rent,sum(m_costume_Tdeposit) as total_deposit,m_cashacc_name')->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = costume_wp_tbl.m_costume_counter', 'left')->where('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")', $to_date)->group_by('m_costume_counter')->get('costume_wp_tbl')->result();
  }

  public function Costume_details_report($to_date, $from_date)
  {

    $voucher_list = $this->db->select('sum(m_expense_amt) as expense_amt,m_expense_paymode')->where('DATE_FORMAT(m_expense_date,"%Y-%m-%d")>=', $from_date)->where('DATE_FORMAT(m_expense_date,"%Y-%m-%d")<=', $to_date)->where('m_expense_dept', 2)->where('m_expense_mode', 2)->where('m_expense_status', 1)->group_by('m_expense_paymode')->get('master_expense_tbl')->result();
    $expense_list = $this->db->select('sum(m_expense_amt) as expense_amt')->where('DATE_FORMAT(m_expense_date,"%Y-%m-%d")>=', $from_date)->where('DATE_FORMAT(m_expense_date,"%Y-%m-%d")<=', $to_date)->where('m_expense_dept', 2)->where('m_expense_mode', 1)->where('m_expense_status', 1)->get('master_expense_tbl')->result();

    $missing_sql = $this->db->select('group_concat(m_product_name,"(",(case when ivt_stkout_prodsize != "" then prosize.m_prodgroup_name else "" end),")-",ivt_stkout_prodqty) as items')->join('master_product_tbl', 'master_product_tbl.m_product_id = insckot.ivt_stkout_product', 'left')->join('master_prodgroup_tbl prosize', 'prosize.m_prodgroup_id = insckot.ivt_stkout_prodsize', 'left')->where('ivt_stkout_date >=', $from_date)->where('ivt_stkout_date <=', $to_date)->where("ivt_stkout_dept", 2)->where("ivt_stkout_type", 1)->get('inventory_storeout_tbl insckot')->result();
    $damage_sql = $this->db->select('group_concat(m_product_name,"(",(case when ivt_stkout_prodsize != "" then prosize.m_prodgroup_name else "" end),")-",ivt_stkout_prodqty) as items')->join('master_product_tbl', 'master_product_tbl.m_product_id = insckot.ivt_stkout_product', 'left')->join('master_prodgroup_tbl prosize', 'prosize.m_prodgroup_id = insckot.ivt_stkout_prodsize', 'left')->where('ivt_stkout_date >=', $from_date)->where('ivt_stkout_date <=', $to_date)->where("ivt_stkout_dept", 2)->where("ivt_stkout_type", 2)->get('inventory_storeout_tbl insckot')->result();

    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $locker = $this->db->where('m_locker_iscredit !=', 2)->get('locker_wp_tbl')->result();

    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $costume = $this->db->where('m_costume_iscredit !=', 2)->get('costume_wp_tbl')->result();

    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_sales_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_sales_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $sales = $this->db->get('sales_wp_tbl')->result();


    $Costume_balance = 0;
    $Costume_discount = 0;
    $Costume_Upi = 0;
    $Costume_total = 0;
    $Locker_rent = 0;
    $Costume_rent = 0;

    if (!empty($voucher_list)) {
      foreach ($voucher_list as $vouch) {
        $cosfund[] =  $this->get_paymode_fun($vouch->m_expense_paymode, $vouch->expense_amt);

        if ($vouch->m_expense_paymode != 1 && $vouch->m_expense_paymode != 0) {
          $Costume_Upi += $vouch->expense_amt;
        }

      }
    }

    // if (!empty($expense_list)) {
    //   foreach ($expense_list as $expen) {
    //     $cosfund[] =  $this->get_paymode_fun($expen->m_expense_paymode, $expen->expense_amt);
    //     if ($vouch->m_expense_paymode != 1 && $vouch->m_expense_paymode != 0) {
    //       $Costume_Upi -= $vouch->expense_amt;
    //     }
    //   }
    // }

    if (!empty($costume)) {
      foreach ($costume as $ckey) {

        $cosfund[] =  $this->get_paymode_fun($ckey->m_costume_paytype, $ckey->m_costume_paidAmt, $ckey->m_costume_iscredit, $ckey->m_costume_refund);

        if ($ckey->m_costume_paytype != 1 && $ckey->m_costume_paytype != 0) {
          $Costume_Upi += $ckey->m_costume_paidAmt;
        }
        if ($ckey->m_costume_ispartial == 1) {

          $cosfund[] =  $this->get_paymode_fun($ckey->m_costume_paytype2, $ckey->m_costume_paidAmt2, $ckey->m_costume_iscredit, $ckey->m_costume_refund);

          if ($ckey->m_costume_paytype2 != 1 && $ckey->m_costume_paytype2 != 0) {
            $Costume_Upi += $ckey->m_costume_paidAmt2;
          }
        }

        $Costume_balance += $ckey->m_costume_balAmt;
        $Costume_discount += $ckey->m_costume_discount;
        $Costume_total += $ckey->m_costume_Trent;
        $Costume_rent += ($ckey->m_costume_Trent);
      }
    }

    if (!empty($locker)) {
      foreach ($locker as $lkey) {

        $cosfund[] =  $this->get_paymode_fun($lkey->m_locker_paytype, $lkey->m_locker_paidAmt, $lkey->m_locker_iscredit, $lkey->m_locker_refund);

        if ($lkey->m_locker_paytype != 1 && $lkey->m_locker_paytype != 0) {
          $Costume_Upi += $lkey->m_locker_paidAmt;
        }
        if ($lkey->m_locker_ispartial == 1) {

          $cosfund[] =  $this->get_paymode_fun($lkey->m_locker_paytype2, $lkey->m_locker_paidAmt2, $lkey->m_locker_iscredit, $lkey->m_locker_refund);

          if ($lkey->m_locker_paytype2 != 1 && $lkey->m_locker_paytype2 != 0) {
            $Costume_Upi += $lkey->m_locker_paidAmt2;
          }
        }

        $Costume_balance += $lkey->m_locker_balAmt;
        $Costume_discount += $lkey->m_locker_discount;
        $Costume_total += $lkey->m_locker_Trent;
        $Locker_rent += ($lkey->m_locker_Trent);
      }
    }

    if (!empty($sales)) {
      foreach ($sales as $skey) {

        $cosfund[] =  $this->get_paymode_fun($skey->m_sales_paytype, $skey->m_sales_paidAmt);

        if ($skey->m_sales_paytype != 1 && $skey->m_sales_paytype != 0) {
          $Costume_Upi += $skey->m_sales_paidAmt;
        }
        if ($skey->m_sales_ispartial == 1) {

          $cosfund[] =  $this->get_paymode_fun($skey->m_sales_paytype2, $skey->m_sales_paidAmt2);

          if ($skey->m_sales_paytype2 != 1 && $skey->m_sales_paytype2 != 0) {
            $Costume_Upi += $skey->m_sales_paidAmt2;
          }
        }

        $Costume_balance += $skey->m_sales_balAmt;
        $Costume_discount += $skey->m_sales_discount;
        $Costume_total += $skey->m_sales_netAmt;
      }
    }

    $cash = !empty($cosfund) ? array_sum(array_column($cosfund, 'cash')) : 0;
    $paytm = !empty($cosfund) ? array_sum(array_column($cosfund, 'paytm')) : 0;
    $phonepay = !empty($cosfund) ? array_sum(array_column($cosfund, 'phonepay')) : 0;
    $other = !empty($cosfund) ? array_sum(array_column($cosfund, 'other')) : 0;


    $res['Costume_balance'] = $Costume_balance;
    $res['Costume_discount'] = $Costume_discount + $expense_list[0]->expense_amt ? : 0;
    $res['Costume_voucher'] = !empty($voucher_list) ? array_sum(array_column($voucher_list, 'expense_amt')):0;
    $res['Costume_Cash'] = ($Costume_total - $Costume_Upi - $Costume_balance - $Costume_discount);
    $res['ma_cash'] = $cash;
    $res['Costume_Paytm'] = $paytm;
    $res['Costume_PhoneP'] = $phonepay;
    $res['Costume_other'] = $other;
    $res['Costume_Upi'] = $Costume_Upi;
    $res['Costume_total'] = $Costume_total;
    $res['Locker_rent'] = $Locker_rent;
    $res['Costume_rent'] = $Costume_rent;
    $res['product_list'] = $this->get_product_sale($from_date, $to_date);
    $res['missing_items'] = $missing_sql[0]->items;
    $res['damage_item'] = $damage_sql[0]->items;

    // echo '<pre>'; print_r($res); die ;
    return $res;
  }


  public function get_lead_tickets($to_date, $from_date)
  {
    $result = array();
    if (!empty($from_date) && !empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")>=', $from_date);
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $tick_sql = $this->db->select('m_ticket_id,m_ticket_band,m_ticket_adult,m_ticket_netAmt,m_ticket_paidAmt,m_ticket_paidAmt2,m_ticket_free,m_lead_plan,m_lead_id,m_lead_uno,m_lead_rateph,m_lead_advance,m_lead_advance_date,m_lead_paymode,m_lclient_name')->join('master_lead_tbl', 'master_lead_tbl.m_lead_id = tickets_wp_tbl.m_ticket_lead_id')->join('master_leadclient_tbl', 'master_leadclient_tbl.m_lclient_id = master_lead_tbl.m_lead_clientid')->where('m_ticket_head', 10)->where('m_ticket_status', 1)->get('tickets_wp_tbl')->result();

    if (!empty($tick_sql)) {
      foreach ($tick_sql as $krry) {
        $bandids = explode(',', $krry->m_ticket_band);

        $Radult_band = $this->get_bands($bandids[0], null, $to_date);
        $Rfree_band = $this->get_bands($bandids[2], null, $to_date);

        // $adult_op_bal = $this->get_band_balance($bandids[0], null, date('Y-m-d', strtotime($to_date . '-1 day')));
        // $free_op_bal = $this->get_band_balance($bandids[2], null, date('Y-m-d', strtotime($to_date . '-1 day')));

        $adult_bal = $this->get_band_balance($bandids[0], $from_date, $to_date);
        $free_bal = $this->get_band_balance($bandids[2], $from_date, $to_date);

        $adult_op_bal = ($Radult_band->m_band_total - $Radult_band->m_band_instock - $adult_bal);
        $free_op_bal = ($Rfree_band->m_band_total - $Rfree_band->m_band_instock - $free_bal);


        $resadult = (object) array(
          'id' => $krry->m_lead_id,
          'Name' => 'Family (' . $krry->m_lead_rateph . ')',
          'count' => $krry->m_ticket_adult,
          'netto_amt' => ($krry->m_ticket_netAmt),
          'paid_amt' => ($krry->m_ticket_paidAmt + $krry->m_ticket_paidAmt2),
          'band_colorid' => $bandids[0],
          'band_color' => $Radult_band->m_hq_name,
          'startno' => ($Radult_band->m_band_nostart + $adult_op_bal),
          'endno' => '-',
          'finalno' => ($Radult_band->m_band_nostart + $adult_op_bal + $adult_bal),
        );
        $resfree = (object) array(
          'id' => $krry->m_lead_id,
          'Name' => 'Free',
          'count' => $krry->m_ticket_free,
          'netto_amt' => 0,
          'paid_amt' => 0,
          'band_colorid' => $bandids[2],
          'band_color' => $Rfree_band->m_hq_name,
          'startno' => ($Rfree_band->m_band_nostart + $free_op_bal),
          'endno' => '-',
          'finalno' => ($Rfree_band->m_band_nostart + $free_op_bal + $free_bal),
        );

        switch ($krry->m_lead_paymode) {
          case 1:
            $modenm = "CASH";
            break;
          case 2:
            $modenm = "PayTM";
            break;
          case 3:
            $modenm = "PhonePay";
            break;
          case 4:
            $modenm = "Other";
            break;
        }
        $advance_detail = (object) array(
          'Name' => $krry->m_lclient_name,
          'leadno' => $krry->m_lead_uno,
          'adv_amount' => $krry->m_lead_advance,
          'adv_date' => $krry->m_lead_advance_date,
          'adv_mode' => $modenm,

        );

        $result[] = $resadult;
        $result[] = $resfree;
        $result2[] = $advance_detail;
      }
    }

    $resd = (object) array(
      'list' => $result,
      'detail' => $result2,
    );

    return $resd;
  }

  public function ticketing_detail_report($to_date, $from_date)
  {

    $expense_list = $this->db->select('sum(m_expense_amt) expense_amt')->where('DATE_FORMAT(m_expense_date,"%Y-%m-%d")>=', $from_date)->where('DATE_FORMAT(m_expense_date,"%Y-%m-%d")<=', $to_date)->where('m_expense_dept', 3)->where('m_expense_mode', 1)->where('m_expense_status', 1)->get('master_expense_tbl')->result();
    $voucher_list = $this->db->select('sum(m_expense_amt) voucher_amt,m_expense_paymode')->where('DATE_FORMAT(m_expense_date,"%Y-%m-%d")>=', $from_date)->where('DATE_FORMAT(m_expense_date,"%Y-%m-%d")<=', $to_date)->where('m_expense_dept', 3)->where('m_expense_mode', 2)->where('m_expense_status', 1)->group_by('m_expense_paymode')->get('master_expense_tbl')->result();

  
    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $tick_refund = $this->db->select('tickets_wp_tbl.*,m_admin_name,m_city_name,m_cust_name,m_cust_mobile')
      ->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = tickets_wp_tbl.m_ticket_customer', 'left')
      ->join('master_city_tbl', 'master_city_tbl.m_city_id = tickets_wp_tbl.m_ticket_city', 'left')
      ->join('master_admin_tbl', 'master_admin_tbl.m_admin_id = tickets_wp_tbl.m_ticket_added_by', 'left')
      ->where('m_ticket_refund', 1)->get('tickets_wp_tbl')->result();

    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(m_ticket_added_on,"%Y-%m-%d")<=', $to_date);
    }
    $ticket = $this->db->select('m_ticket_id,m_ticket_paytype,m_ticket_paidAmt,m_ticket_paymode,m_ticket_gstAmt,m_ticket_ispartial,m_ticket_paytype2,m_ticket_paidAmt2,m_ticket_head,m_ticket_adult,m_ticket_child,m_ticket_free,m_ticket_balAmt,m_ticket_discount,m_ticket_refund,m_ticket_netAmt,m_lead_advance,m_lead_paymode,is_discount_applied')->join('master_lead_tbl', 'master_lead_tbl.m_lead_id = tickets_wp_tbl.m_ticket_lead_id', 'left')->where('m_ticket_status', 1)->get('tickets_wp_tbl')->result();

    $Ticket_balance = 0;
    $Ticket_discount = 0;

    $Ticket_Upi = 0;
    $Ticket_total = 0;
    $Total_buissness = 0;
    $Total_refund = 0;
    $meb_count = 0;
    $total_free = 0;

    $wp_adult = 0;
    $wp_child = 0;
    $wp_free = 0;

    $ap_adult = 0;
    $ap_child = 0;
    $ap_free = 0;

    $cp_adult = 0;
    $cp_child = 0;
    $cp_free = 0;

    if (!empty($voucher_list)) {
      foreach ($voucher_list as $vouch) {
        $fund[] =  $this->get_paymode_fun($vouch->m_expense_paymode, $vouch->voucher_amt);

        if ($vouch->m_expense_paymode != 1 && $vouch->m_expense_paymode != 0) {
          $Ticket_Upi += $vouch->voucher_amt;
        }

      }
    }

    if (!empty($ticket)) {
      foreach ($ticket as $key) {

        if ($key->m_ticket_refund == 1) {
          $Total_refund += $key->m_ticket_netAmt;
        }

        $fund[] =  $this->get_paymode_fun($key->m_lead_paymode, $key->m_lead_advance);

        $Ticket_Upi += $key->m_lead_advance;

        $fund[] =  $this->get_paymode_fun($key->m_ticket_paytype, $key->m_ticket_paidAmt);

        if ($key->m_ticket_paytype != 1) {
          $Ticket_Upi += $key->m_ticket_paidAmt;
        }
        if ($key->m_ticket_ispartial == 1) {
          $fund[] =  $this->get_paymode_fun($key->m_ticket_paytype2, $key->m_ticket_paidAmt2);

          if ($key->m_ticket_paytype2 != 1) {
            $Ticket_Upi += $key->m_ticket_paidAmt2;
          }
        }

        switch ($key->m_ticket_head) {
          case 1: {
              $wp_adult += $key->m_ticket_adult;
              $wp_child += $key->m_ticket_child;
              $wp_free += $key->m_ticket_free;
              $total_free += $key->m_ticket_free;
            }
            break;
          case 2: {
              $meb_count += $key->m_ticket_adult;
            }
            break;
          case 4: {
              $ap_adult += $key->m_ticket_adult;
              $ap_child += $key->m_ticket_child;
              $ap_free += $key->m_ticket_free;
              $total_free += $key->m_ticket_free;
            }
            break;
          case 9: {
              $cp_adult += $key->m_ticket_adult;
              $cp_child += $key->m_ticket_child;
              $cp_free += $key->m_ticket_free;
              $total_free += $key->m_ticket_free;
            }
            break;
        }

        $Ticket_balance += $key->m_ticket_balAmt;
        $Ticket_total += ($key->m_ticket_paidAmt2 + $key->m_ticket_paidAmt);

        if (strtoupper($key->m_ticket_paymode) == 'MEMBERS') {
          $Ticket_discount += 0;
          $Total_buissness += ($key->m_ticket_gstAmt);
        } else if($key->is_discount_applied == 1){ 
          $Ticket_discount += $key->m_ticket_discount;
          $Total_buissness += ($key->m_ticket_netAmt + $key->m_ticket_discount);
        } else {
          $Ticket_discount += $key->m_ticket_discount;
          $Total_buissness += ($key->m_ticket_netAmt);
        }
      }
    }

    $resort_bandcolor = get_rate_band('WDRB', 3);
    $camp_bandcolor = get_rate_band('WDCB', 3);

    // echo $resort_bandcolor ; die ;

    $res['Ticket_Cash'] = !empty($fund) ? array_sum(array_column($fund, 'cash')) : 0;
    $res['Ticket_Paytm'] = !empty($fund) ? array_sum(array_column($fund, 'paytm')) : 0;
    $res['Ticket_PhoneP'] = !empty($fund) ? array_sum(array_column($fund, 'phonepay')) : 0;
    $res['Ticket_other'] = !empty($fund) ? array_sum(array_column($fund, 'other')) : 0;
    $res['Ticket_Upi'] = $Ticket_Upi;
    $res['Ticket_total'] = $Ticket_total;
    $res['Total_buissness'] = ($Total_buissness);
    $res['total_voucher'] = !empty($voucher_list) ? array_sum(array_column($voucher_list, 'voucher_amt')) : 0;
    $res['Ticket_discount'] = ($Ticket_discount + $Total_refund + $expense_list[0]->expense_amt ?: 0);
    $res['Ticket_balance'] = $Ticket_balance;
    $res['Total_refund'] = $Total_refund;

    // $res['oth_adult'] = $oth_adult;
    // $res['oth_child'] = $oth_child;
    // $res['oth_free'] = $oth_free;
    $res['meb_count'] = $meb_count;
    $res['wp_adult'] = $wp_adult;
    $res['wp_child'] = $wp_child;
    $res['wp_free'] = $wp_free;
    $res['cp_adult'] = $cp_adult;
    $res['cp_child'] = $cp_child;
    $res['ap_adult'] = $ap_adult;
    $res['ap_child'] = $ap_child;
    $res['ap_free'] = $ap_free;
    $res['cp_free'] = $cp_free;
    $res['total_free'] = $total_free;
    $res['wp_bands'] = $this->band_used_fun(1, $to_date);
    $res['c_bands'] = $this->band_used_fun(9, $to_date);
    $res['ap_bands'] = $this->band_used_fun(4, $to_date);
    $res['mem_bands'] = $this->band_used_fun(2, $to_date);
    $res['resort_bands'] = $this->get_bands_stock_detail($resort_bandcolor, $to_date, $to_date);
    $res['camp_bands'] = $this->get_bands_stock_detail($camp_bandcolor, $to_date, $to_date);
    $res['tick_refund_list'] = $tick_refund;


    return $res;
  }

  public function get_paymode_fun($paymode, $paidamt, $iscredit = '', $refund = '')
  {

    if (!empty($iscredit) && !empty($refund)) {

      if ($iscredit == 1) {
        $cash = $paidamt;
      } else if ($paymode == 1 && $iscredit == 0) {
        $cash = ($paidamt - $refund);
      } else if ($paymode == 2) {
        $paytm = $paidamt;
      } else if ($paymode == 3) {
        $phonepay = $paidamt;
      } else if ($paymode == 4) {
        $other = $paidamt;
      }
    } else {
      switch ($paymode) {
        case 1: {
            $cash = $paidamt;
          }
          break;
        case 2: {
            $paytm = $paidamt;
          }
          break;
        case 3: {
            $phonepay = $paidamt;
          }
          break;
        case 4: {
            $other = $paidamt;
          }
          break;
      }
    }

    $payac = (object) array(
      'cash' => $cash,
      'paytm' => $paytm,
      'phonepay' => $phonepay,
      'other' => $other,
    );
    return $payac;
  }

  public function report_listing_data($date, $dept = '')
  {
    $tick_bal = $this->db->select('m_ticket_id,m_ticket_balAmt,m_emp_name,m_city_name,m_cust_name,m_cust_mobile,(Select sum(m_locker_balAmt) as locker_balamt from locker_wp_tbl where m_locker_ticket_id = m_ticket_id and m_locker_iscredit = 1) as locker_balamt,(Select sum(m_locker_Tlocker) as free_locker from locker_wp_tbl where m_locker_ticket_id = m_ticket_id and m_locker_iscredit = 2) as free_locker,(Select sum(m_costume_balAmt) as costume_balamt from costume_wp_tbl where m_costume_ticket_id = m_ticket_id and m_costume_iscredit = 1) as costume_balamt,(Select sum(m_costume_Tqty) as free_costume from costume_wp_tbl where m_costume_ticket_id = m_ticket_id and m_costume_iscredit = 2) as free_costume')
      ->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = tickets_wp_tbl.m_ticket_customer', 'left')
      ->join('master_employee_tbl', 'master_employee_tbl.m_emp_id = tickets_wp_tbl.m_ticket_resp_id', 'left')
      ->join('master_city_tbl', 'master_city_tbl.m_city_id = tickets_wp_tbl.m_ticket_city', 'left')
      ->where('m_ticket_date', $date)->where('(m_ticket_paymode = "Credit" OR m_ticket_cusType = "Free")')->get('tickets_wp_tbl')->result();


    if (!empty($dept)) {
      $this->db->where('m_expense_dept', $dept);
    }
    $expense_list = $this->db->select('m_expense_id,m_expense_amt,m_expense_remark,m_expense_mode,m_cashacc_name,m_dept_name,m_prodcat_name,m_admin_name')
      ->join('master_prodcategory_tbl', 'master_prodcategory_tbl.m_prodcat_id = master_expense_tbl.m_expense_cat', 'left')
      ->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = master_expense_tbl.m_expense_act', 'left')
      ->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_expense_tbl.m_expense_dept', 'left')
      ->join('master_admin_tbl', 'master_admin_tbl.m_admin_id = master_expense_tbl.m_expense_addedby', 'left')
      ->where('m_expense_date', $date)->where('m_expense_mode', 1)->where('m_expense_status', 1)->get('master_expense_tbl')->result();

    if (!empty($dept)) {
      $this->db->where('m_expense_dept', $dept);
    }
    $voucher_list = $this->db->select('m_expense_id,m_expense_amt,m_expense_remark,m_expense_mode,m_cashacc_name,m_dept_name,m_prodcat_name,m_admin_name')
      ->join('master_prodcategory_tbl', 'master_prodcategory_tbl.m_prodcat_id = master_expense_tbl.m_expense_cat', 'left')
      ->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = master_expense_tbl.m_expense_act', 'left')
      ->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_expense_tbl.m_expense_dept', 'left')
      ->join('master_admin_tbl', 'master_admin_tbl.m_admin_id = master_expense_tbl.m_expense_addedby', 'left')
      ->where('m_expense_date', $date)->where('m_expense_mode', 2)->where('m_expense_status', 1)->get('master_expense_tbl')->result();


    $advance_list = $this->db->select('master_advance_tbl.*,m_emp_code,m_emp_name,m_emp_mobile,m_dept_name,m_emp_hq,m_emp_doj,m_emp_gross_salary,m_cashacc_name,m_admin_name')->join('master_employee_tbl', 'master_employee_tbl.m_emp_id= master_advance_tbl.m_advance_empid', 'left')->join('master_department_tbl', 'master_department_tbl.m_dept_id = master_employee_tbl.m_emp_dept', 'left')->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = master_advance_tbl.m_advance_acct', 'left')->join('master_admin_tbl', 'master_admin_tbl.m_admin_id = master_advance_tbl.m_advance_addedby', 'left')->where('m_advance_date', $date)->get('master_advance_tbl')->result();


    $res = array(
      'tick_balnce' => $tick_bal,
      'expense_list' => $expense_list,
      'voucher_list' => $voucher_list,
      'advance_list' => $advance_list,
    );

    return $res;
  }

  public function get_foodcourt_data($from_date, $to_date, $baln = '')
  {

    $rtc_total = 0;
    $rtc_discount = 0;
    $rtc_balance = 0;
    $rtc_upi = 0;

    $this->db->select('foodcourt_data_tbl.*,(r_fcdata_amt + r_fcdata_amt2 + r_fcdata_extra) as total_amount,m_cashacc_name,m_emp_name');

    $this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id = foodcourt_data_tbl.r_fcdata_respon', 'left');
    $this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = foodcourt_data_tbl.r_fcdata_acc', 'left');

    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(r_fcdata_date,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(r_fcdata_date,"%Y-%m-%d")<=', $to_date);
    }

    $resort_sql = $this->db->group_by('r_fcdata_uno')->get('foodcourt_data_tbl')->result();
    if (!empty($resort_sql)) {
      if ($baln == 1) {

        foreach ($resort_sql as $key => $value) {
          $rtc_total += ($value->total_amount + $value->r_fcdata_balamt);
          $rtc_balance += ($value->r_fcdata_balamt);
          $rtc_discount += ($value->r_fcdata_disc);

          $foodcoufund[] =  $this->get_paymode_fun($value->r_fcdata_paytype, $value->r_fcdata_amt);

          if ($value->r_fcdata_paytype != 1) {
            $rtc_upi += $value->r_fcdata_amt;
          }

          if ($value->r_fcdata_ispartial == 1) {

            $foodcoufund[] =  $this->get_paymode_fun($value->r_fcdata_paytype2, $value->r_fcdata_amt2);

            if ($value->r_fcdata_paytype2 != 1) {
              $rtc_upi += $value->r_fcdata_amt2;
            }
          }
        }
        $res = (object) array(
          "rtc_total" => $rtc_total,
          "rtc_cash" => !empty($foodcoufund) ? array_sum(array_column($foodcoufund, 'cash')) : 0,
          "rtc_paytm" => !empty($foodcoufund) ? array_sum(array_column($foodcoufund, 'paytm')) : 0,
          "rtc_phonepay" => !empty($foodcoufund) ? array_sum(array_column($foodcoufund, 'phonepay')) : 0,
          "rtc_other" => !empty($foodcoufund) ? array_sum(array_column($foodcoufund, 'other')) : 0,
          "rtc_discount" => $rtc_discount,
          "rtc_balance" => $rtc_balance,
          "rtc_upi" => $rtc_upi
        );
        return $res;
      } else {
        return $resort_sql;
      }
    }
  }

  public function get_resort_data_list($type, $from_date, $to_date, $status = '', $baln = '')
  {

    $rtc_total = 0;
    $rtc_discount = 0;
    $rtc_balance = 0;
    $rtc_upi = 0;

    $this->db->select('resort_data_tbl.*,(r_resdata_amount + r_resdata_amt2 + r_resdata_fpamt1 + r_resdata_fpamt2) as total_amount,(r_resdata_child + r_resdata_adult) as total_person,m_city_name,m_cashacc_name,m_emp_name');

    $this->db->join('master_employee_tbl', 'master_employee_tbl.m_emp_id = resort_data_tbl.r_resdata_respon', 'left');
    $this->db->join('master_city_tbl', 'master_city_tbl.m_city_id = resort_data_tbl.r_resdata_city', 'left');
    $this->db->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = resort_data_tbl.r_resdata_act', 'left');

    $this->db->where('r_resdata_type', $type);
    if (!empty($from_date)) {
      $this->db->where('DATE_FORMAT(r_resdata_updatedon,"%Y-%m-%d")>=', $from_date);
    }
    if (!empty($to_date)) {
      $this->db->where('DATE_FORMAT(r_resdata_updatedon,"%Y-%m-%d")<=', $to_date);
    }
    if (!empty($status)) {
      $this->db->where('r_resdata_status', $status);
    }
    $resort_sql = $this->db->get('resort_data_tbl')->result();
    if (!empty($resort_sql)) {
      if ($baln == 1) {

        foreach ($resort_sql as $key => $value) {
          $rtc_total += ($value->total_amount + $value->r_resdata_balamt);
          $rtc_balance += ($value->r_resdata_balamt);

          $restfund[] =  $this->get_paymode_fun($value->r_resdata_paytype, $value->r_resdata_amount);

          if ($value->r_resdata_paytype != 1) {
            $rtc_upi += $value->r_resdata_amount;
          }

          if ($value->r_resdata_ispartial == 1) {

            $restfund[] =  $this->get_paymode_fun($value->r_resdata_paytype2, $value->r_resdata_amt2);

            if ($value->r_resdata_paytype2 != 1) {
              $rtc_upi += $value->r_resdata_amt2;
            }
          }

          $restfund[] =  $this->get_paymode_fun($value->r_resdata_fpmode1, $value->r_resdata_fpamt1);

          if ($value->r_resdata_fpmode1 != 1) {
            $rtc_upi += $value->r_resdata_fpamt1;
          }

          if ($value->r_resdata_fispartial == 1) {

            $restfund[] =  $this->get_paymode_fun($value->r_resdata_fpmode2, $value->r_resdata_fpamt2);

            if ($value->r_resdata_fpmode2 != 1) {
              $rtc_upi += $value->r_resdata_fpamt2;
            }
          }
        }
        $res = (object) array(
          "rtc_total" => $rtc_total,
          "rtc_cash" => !empty($restfund) ? array_sum(array_column($restfund, 'cash')) : 0,
          "rtc_paytm" => !empty($restfund) ? array_sum(array_column($restfund, 'paytm')) : 0,
          "rtc_phonepay" => !empty($restfund) ? array_sum(array_column($restfund, 'phonepay')) : 0,
          "rtc_other" => !empty($restfund) ? array_sum(array_column($restfund, 'other')) : 0,
          "rtc_discount" => $rtc_discount,
          "rtc_balance" => $rtc_balance,
          "rtc_upi" => $rtc_upi
        );
        return $res;
      } else {
        return $resort_sql;
      }
    }
  }


  public function dash_report_data($date)
  {
    $bal_list = array();
    $daydata_sql = $this->db->where('d_data_date', $date)->get('dayreport_data_tbl')->row();
    $food_sql = $this->get_foodcourt_data($date, $date, 1);
    $camp_sql = $this->get_resort_data_list(2, $date, $date, null, 1);
    $resort_sql = $this->get_resort_data_list(1, $date, $date, null, 1);

    $food_bal = $this->db->select('r_fcdata_uno,r_fcdata_balamt,m_emp_name,r_fcdata_name,r_fcdata_mobile,r_fcdata_cust,sum(r_fcdata_qty) as total_qty,r_fcdata_nettotal')->join('master_employee_tbl', 'master_employee_tbl.m_emp_id =  foodcourt_data_tbl.r_fcdata_respon', 'left')->where('r_fcdata_date', $date)->where('(r_fcdata_iscredit = 1 OR r_fcdata_iscredit = 2)')->group_by('r_fcdata_uno')->get('foodcourt_data_tbl')->result();

    $resort_bal = $this->db->select('r_resdata_id,r_resdata_balamt,m_emp_name,r_resdata_name,r_resdata_mobile,r_resdata_cust')->join('master_employee_tbl', 'master_employee_tbl.m_emp_id =  resort_data_tbl.r_resdata_respon', 'left')->where('DATE_FORMAT(r_resdata_updatedon,"%Y-%m-%d")', $date)->where('(r_resdata_iscredit = 1 OR r_resdata_iscredit = 2)')->get('resort_data_tbl')->result();

    if (!empty($food_bal)) {
      foreach ($food_bal as $fodbl) {
        $rres = (object) array(
          'id' => $fodbl->r_fcdata_uno,
          'bl_amount' => $fodbl->r_fcdata_balamt,
          'emp_name' => $fodbl->m_emp_name,
          'cust_name' => $fodbl->r_fcdata_name,
          'cust_mobile' => $fodbl->r_fcdata_mobile,
          'cust_id' => $fodbl->r_fcdata_cust,
        );
        $bal_list[] = $rres;
      }
    }

    if (!empty($resort_bal)) {
      foreach ($resort_bal as $resbl) {
        $rtes = (object) array(
          'id' => $resbl->r_resdata_id,
          'bl_amount' => $resbl->r_resdata_balamt,
          'emp_name' => $resbl->m_emp_name,
          'cust_name' => $resbl->r_resdata_name,
          'cust_mobile' => $resbl->r_resdata_mobile,
          'cust_id' => $resbl->r_resdata_cust,
        );
        $bal_list[] = $rtes;
      }
    }
    // echo '<pre>'; print_r($resort_sql); die ;

    $res = array(
      "d_rtc_total" => $resort_sql->rtc_total,
      "d_rtc_cash" => $resort_sql->rtc_cash,
      "d_rtc_paytm" => $resort_sql->rtc_paytm,
      "d_rtc_phonepay" => $resort_sql->rtc_phonepay,
      "d_rtc_other" => $resort_sql->rtc_other,
      "d_rtc_discount" => $resort_sql->rtc_discount,
      "d_rtc_balance" => $resort_sql->rtc_balance,
      "d_rtc_upi" => $resort_sql->rtc_upi,

      "d_camp_total" => $camp_sql->rtc_total,
      "d_camp_cash" => $camp_sql->rtc_cash,
      "d_camp_paytm" => $camp_sql->rtc_paytm,
      "d_camp_phonepay" => $camp_sql->rtc_phonepay,
      "d_camp_other" => $camp_sql->rtc_other,
      "d_camp_discount" => $camp_sql->rtc_discount,
      "d_camp_balance" => $camp_sql->rtc_balance,
      "d_camp_upi" => $camp_sql->rtc_upi,

      "d_fc_total" => $food_sql->rtc_total,
      "d_fc_cash" => $food_sql->rtc_cash,
      "d_fc_paytm" => $food_sql->rtc_paytm,
      "d_fc_phonepay" => $food_sql->rtc_phonepay,
      "d_fc_other" =>  $food_sql->rtc_other,
      "d_fc_discount" => $food_sql->rtc_discount,
      "d_fc_balance" => $food_sql->rtc_balance,
      "d_fc_totupi" =>  $food_sql->rtc_upi,

      "d_data_updatedon" => $daydata_sql->d_data_updatedon,
      "d_data_updatedby" => $daydata_sql->d_data_updatedby,
      // "d_fc_phonepay" => $daydata_sql->d_fc_phonepay,
      "d_data_date" => $daydata_sql->d_data_date,
      // "d_fc_discount" => $daydata_sql->d_fc_discount,
      // "d_fc_balance" => $daydata_sql->d_fc_balance,
      "d_data_upiremark" => $daydata_sql->d_data_upiremark,
      "d_data_remark" => $daydata_sql->d_data_remark,
      "d_data_rrbaln" => $daydata_sql->d_data_rrbaln,
      "balance_list" => $bal_list,
    );

    return $res;
  }

  public function get_dayreport_data($date)
  {
    return $this->db->where('d_data_date', $date)->get('dayreport_data_tbl')->row();
  }

  public function insert_dayreport_data()
  {
    $check = $this->get_dayreport_data($this->input->post('d_data_date'));

    if (!empty($check)) {
      $data_id = $check->d_data_id;
    } else {
      $data_id = $this->input->post('d_data_id');
    }

    $data = array(
      "d_fc_cash" => $this->input->post('d_fc_cash'),
      "d_fc_paytm" => $this->input->post('d_fc_paytm'),
      "d_fc_phonepay" => $this->input->post('d_fc_phonepay'),
      "d_data_date" => $this->input->post('d_data_date'),
      "d_fc_discount" => $this->input->post('d_fc_discount'),
      "d_fc_balance" => $this->input->post('d_fc_balance'),
      // "d_rtc_cash" => $this->input->post('d_rtc_cash'),
      // "d_rtc_paytm" => $this->input->post('d_rtc_paytm'),
      // "d_rtc_phonepay" => $this->input->post('d_rtc_phonepay'),
      // "d_rtc_discount" => $this->input->post('d_rtc_discount'),
      // "d_rtc_balance" => $this->input->post('d_rtc_balance'),
      "d_data_upiremark" => $this->input->post('d_data_upiremark'),
      "d_data_remark" => $this->input->post('d_data_remark'),
      "d_data_rrbaln" => $this->input->post('d_data_rrbaln'),
      'd_data_updatedon' => date('Y-m-d H:i'),
      'd_data_updatedby' => $this->session->userdata('user_id'),
    );

    // print_r($data); die;

    if (!empty($data_id)) {

      $this->db->where('d_data_id', $data_id)->update('dayreport_data_tbl', $data);
      $retrun_val = 2;
    } else {
      $data['d_data_addedon'] = date('Y-m-d H:i');
      $data['d_data_addedby'] = $this->session->userdata('user_id');
      $rd = $this->db->insert('dayreport_data_tbl', $data);

      $retrun_val = 1;
    }

    return $retrun_val;
  }


  public function city_wise_ticket_report($from, $to_date, $head)
  {
    if (!empty($head)) {
      $this->db->where('m_ticket_head', $head);
    }
    return $this->db->select('sum(m_ticket_adult) as total_adult,sum(m_ticket_child) as total_child,m_city_name')->join('master_city_tbl', 'master_city_tbl.m_city_id = tickets_wp_tbl.m_ticket_city', 'left')
      ->where('DATE_FORMAT(m_ticket_date,"%Y-%m-%d") >=', $from)->where('DATE_FORMAT(m_ticket_date,"%Y-%m-%d") <=', $to_date)->where('m_ticket_status', 1)->group_by('m_ticket_city')->order_by('m_city_name')->get('tickets_wp_tbl')->result();

    // print_r($this->db->last_query()); die ;
  }


  public function locker_available()
  {
    $lockerid = $this->db->select('m_locker_B,m_locker_L,m_locker_G')->where('m_locker_status', 1)->get('locker_wp_tbl')->result();
    if (!empty($lockerid)) {
      foreach ($lockerid as $key) {
        $catAll[] = $key->m_locker_B . ',' . $key->m_locker_G . ',' . $key->m_locker_L . ',';
      }
      $allID = implode(',', $catAll);
      return $this->db->where_not_in('m_lockercode_id', explode(',', $allID))->get('master_lockercode_tbl')->num_rows();
      // return explode(',',$allID) ; 
    } else {
      return $this->db->get('master_lockercode_tbl')->num_rows();
    }
  }

  function band_used_fun($salehead, $date)
  {
    if ($this->isweekend($date) == 2) {
      if ($salehead == 9) {
        $adult_rate = get_rate_band('WDACR', 1);
        $child_rate = get_rate_band('WDCCR', 1);
        $adult_bandcolour = get_rate_band('WDCAB', 3);
        $child_bandcolour = get_rate_band('WDCCB', 3);
      } else if ($salehead == 2) {
        $adult_rate = 40;
        $child_rate = 40;
        $adult_bandcolour = get_rate_band('WDMB', 3);
        $child_bandcolour = get_rate_band('WDMB', 3);
      } else if ($salehead == 4) {
        $adult_rate = get_rate_band('WDAR', 1);
        $child_rate = get_rate_band('WDCR', 1);
        $adult_bandcolour = get_rate_band('WDAAB', 3);
        $child_bandcolour = get_rate_band('WDACB', 3);
      } else {
        $adult_rate = get_rate_band('WDAR', 1);
        $child_rate = get_rate_band('WDCR', 1);
        $adult_bandcolour = get_rate_band('WDWPAB', 3);
        $child_bandcolour = get_rate_band('WDWPCB', 3);
      }
      $free_bandcolour = get_rate_band('WDFB', 3);
    } else {
      if ($salehead == 9) {
        $adult_rate = get_rate_band('WEACR', 2);
        $child_rate = get_rate_band('WECCR', 2);
        $adult_bandcolour = get_rate_band('WECAB', 4);
        $child_bandcolour = get_rate_band('WECCB', 4);
      } else if ($salehead == 2) {
        $adult_bandcolour = get_rate_band('WEMB', 4);
        $child_bandcolour = get_rate_band('WEMB', 4);
        $adult_rate = 40;
        $child_rate = 40;
      } else if ($salehead == 4) {
        $adult_bandcolour = get_rate_band('WEAAB', 4);
        $child_bandcolour = get_rate_band('WEACB', 4);
        $adult_rate = get_rate_band('WEAR', 2);
        $child_rate = get_rate_band('WECR', 2);
      } else {
        $adult_bandcolour = get_rate_band('WEWPAB', 4);
        $child_bandcolour = get_rate_band('WEWPCB', 4);
        $adult_rate = get_rate_band('WEAR', 2);
        $child_rate = get_rate_band('WECR', 2);
      }
      $free_bandcolour = get_rate_band('WEFB', 4);
    }

    $Radult_band = $this->get_bands($adult_bandcolour, null, $date);
    $Rchild_band = $this->get_bands($child_bandcolour, null, $date);
    $Rfree_band = $this->get_bands($free_bandcolour, null, $date);

    // print_r($Radult_band) ; die ;

    // $adult_op_bal = $this->get_band_balance($adult_bandcolour, null, date('Y-m-d', strtotime($date . '-1 day')));
    // $child_op_bal = $this->get_band_balance($child_bandcolour, null, date('Y-m-d', strtotime($date . '-1 day')));
    // $free_op_bal = $this->get_band_balance($free_bandcolour, null, date('Y-m-d', strtotime($date . '-1 day')));

    $adult_bal = $this->get_band_balance($adult_bandcolour, $date, $date);
    $child_bal = $this->get_band_balance($child_bandcolour, $date, $date);
    $free_bal = $this->get_band_balance($free_bandcolour, $date, $date);

    $adult_op_bal = ($Radult_band->m_band_total - $Radult_band->m_band_instock - $adult_bal);
    $child_op_bal = ($Rchild_band->m_band_total - $Rchild_band->m_band_instock - $child_bal);
    $free_op_bal = ($Rfree_band->m_band_total - $Rfree_band->m_band_instock - $free_bal);


    $res = array(
      'adult_rate' => round($adult_rate + ($adult_rate * 0.18)),
      'child_rate' => round($child_rate + ($child_rate * 0.18)),

      'adult_bandid' => $adult_bandcolour,
      'adult_band' => $Radult_band->m_hq_name,
      'child_bandid' => $child_bandcolour,
      'child_band' => $Rchild_band->m_hq_name,
      'adult_start' => ($Radult_band->m_band_nostart + $adult_op_bal),
      'adult_end' => ($Radult_band->m_band_nostart + $adult_op_bal + $adult_bal),
      'child_start' => ($Rchild_band->m_band_nostart + $child_op_bal),
      'child_end' => ($Rchild_band->m_band_nostart + $child_op_bal + $child_bal),
      'free_bandid' => $free_bandcolour,
      'free_band' => $Rfree_band->m_hq_name,
      'free_start' => ($Rfree_band->m_band_nostart + $free_op_bal),
      'free_end' => ($Rfree_band->m_band_nostart + $free_op_bal + $free_bal),
    );
    return $res;
  }

  function today_band_stck_fun()
  {
    $date = date('Y-m-d');
    if ($this->isweekend($date) == 2) {

      $coat_bndclr = get_rate_band('WDCAB', 3);
      $cocld_bndclr = get_rate_band('WDCCB', 3);
      $mem_bndclr = get_rate_band('WDMB', 3);
      $adat_bndclr = get_rate_band('WDAAB', 3);
      $adcld_bndclr = get_rate_band('WDACB', 3);
      $wpat_bndclr = get_rate_band('WDWPAB', 3);
      $wpcd_bndclr = get_rate_band('WDWPCB', 3);
      $free_bndclr = get_rate_band('WDFB', 3);
    } else {

      $coat_bndclr = get_rate_band('WECAB', 4);
      $cocld_bndclr = get_rate_band('WECCB', 4);
      $mem_bndclr = get_rate_band('WEMB', 4);
      $adat_bndclr = get_rate_band('WEAAB', 4);
      $adcld_bndclr = get_rate_band('WEACB', 4);
      $wpat_bndclr = get_rate_band('WEWPAB', 4);
      $wpcd_bndclr = get_rate_band('WEWPCB', 4);
      $free_bndclr = get_rate_band('WEFB', 4);
    }

    // $coat_stk = $this->get_bands_stock_detail($coat_bndclr, $date, $date);
    // $cocld_stk = $this->get_bands_stock_detail($cocld_bndclr, $date, $date);
    // $mem_stk = $this->get_bands_stock_detail($mem_bndclr, $date, $date);
    // $adat_stk = $this->get_bands_stock_detail($adat_bndclr, $date, $date);
    // $adcld_stk = $this->get_bands_stock_detail($adcld_bndclr, $date, $date);
    // $wpat_stk = $this->get_bands_stock_detail($wpat_bndclr, $date, $date);
    // $wpcd_stk = $this->get_bands_stock_detail($wpcd_bndclr, $date, $date);
    // $free_stk = $this->get_bands_stock_detail($free_bndclr, $date, $date);
    $coat_stk = $this->get_bands($coat_bndclr, 1);
    $cocld_stk = $this->get_bands($cocld_bndclr, 1);
    $mem_stk = $this->get_bands($mem_bndclr, 1);
    $adat_stk = $this->get_bands($adat_bndclr, 1);
    $adcld_stk = $this->get_bands($adcld_bndclr, 1);
    $wpat_stk = $this->get_bands($wpat_bndclr, 1);
    $wpcd_stk = $this->get_bands($wpcd_bndclr, 1);
    $free_stk = $this->get_bands($free_bndclr, 1);

    $res = (object)array(
      // "wpat_stock" => $wpat_stk->bal_stock,
      // "wpat_bndclr" => $wpat_stk->band_color,
      // "wpcd_stock" => $wpcd_stk->bal_stock,
      // "wpcd_bndclr" => $wpcd_stk->band_color,
      // "adat_stock" => $adat_stk->bal_stock,
      // "adat_bndclr" => $adat_stk->band_color,
      // "adcld_stock" => $adcld_stk->bal_stock,
      // "adcld_bndclr" => $adcld_stk->band_color,
      // "coat_stock" => $coat_stk->bal_stock,
      // "coat_bndclr" => $coat_stk->band_color,
      // "cocld_stock" => $cocld_stk->bal_stock,
      // "cocld_bndclr" => $cocld_stk->band_color,
      // "mem_stock" => $mem_stk->bal_stock,
      // "mem_bndclr" => $mem_stk->band_color,
      // "free_stock" => $free_stk->bal_stock,
      // "free_bndclr" => $free_stk->band_color,

      "wpat_stock" => $wpat_stk->m_band_instock,
      "wpat_bndclr" => $wpat_stk->m_hq_name,
      "wpcd_stock" => $wpcd_stk->m_band_instock,
      "wpcd_bndclr" => $wpcd_stk->m_hq_name,
      "adat_stock" => $adat_stk->m_band_instock,
      "adat_bndclr" => $adat_stk->m_hq_name,
      "adcld_stock" => $adcld_stk->m_band_instock,
      "adcld_bndclr" => $adcld_stk->m_hq_name,
      "coat_stock" => $coat_stk->m_band_instock,
      "coat_bndclr" => $coat_stk->m_hq_name,
      "cocld_stock" => $cocld_stk->m_band_instock,
      "cocld_bndclr" => $cocld_stk->m_hq_name,
      "mem_stock" => $mem_stk->m_band_instock,
      "mem_bndclr" => $mem_stk->m_hq_name,
      "free_stock" => $free_stk->m_band_instock,
      "free_bndclr" => $free_stk->m_hq_name,

    );

    return $res;
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

  public function get_bands_stock_detail($color, $fdate, $tdate)
  {
    $banddetail = $this->get_bands($color, null, $tdate);
    // $old_used = $this->get_band_balance($color, null, date('Y-m-d', strtotime($fdate . '-1 day')));
    $band_used = $this->get_band_balance($color, $fdate, $tdate);
    $old_used = ($banddetail->m_band_total - $banddetail->m_band_instock - $band_used);

    $res = (object)array(

      'color_id' => $color,
      'band_color' => $banddetail->m_hq_name,
      'total_band' => $banddetail->m_band_total,
      'opening_stk' => $old_used,
      'total_used' =>  $band_used,
      'bal_stock' => $banddetail->m_band_instock,
      'start_no' => ($banddetail->m_band_nostart + $old_used),
      'end_no' => ($banddetail->m_band_nostart + $old_used + $band_used),

    );
    return $res;
  }

  function get_bands($color, $status = '', $date = '')
  {
    if (!empty($status)) {
      $this->db->where('m_band_status', $status);
    }
    if (!empty($date)) {
      $this->db->where('DATE_FORMAT(m_band_starton,"%Y-%m-%d")<=', $date);
      $this->db->where('m_band_status !=', 3);
      $this->db->order_by('m_band_starton', 'desc');
    }
    return $this->db->select('m_band_id,m_band_total,m_band_instock,m_band_nostart,m_band_noend,m_hq_name,m_band_starton')
      ->join('master_hq_tbl', 'master_hq_tbl.m_hq_id = master_bands_tbl.m_band_color', 'left')
      ->where('m_band_color', $color)
      ->get('master_bands_tbl')->row();
  }

  function get_band_balance($bandcolor, $fdate = '', $tdate = '')
  {
    $count = 0;
    if (!empty($tdate)) {
      $this->db->where('m_ticket_date <=', $tdate);
    }
    if (!empty($fdate)) {
      $this->db->where('m_ticket_date >=', $fdate);
    }
    $ticket_sql = $this->db->select('m_ticket_adult,m_ticket_child,m_ticket_free,m_ticket_band,m_ticket_id')->where("FIND_IN_SET('$bandcolor', m_ticket_band)")->where('m_ticket_status', 1)->get('tickets_wp_tbl')->result();
    if (!empty($ticket_sql)) {
      foreach ($ticket_sql as $key => $value) {
        $bandti = explode(',', $value->m_ticket_band);
        if ($bandti[0] == $bandcolor) {
          $count += $value->m_ticket_adult;
        } else if ($bandti[1] == $bandcolor) {
          $count += $value->m_ticket_child;
        } else if ($bandti[2] == $bandcolor) {
          $count += $value->m_ticket_free;
        }
      }
    }

    if (!empty($tdate)) {
      $this->db->where('DATE_FORMAT(r_resdata_addedon,"%Y-%m-%d") <=', $tdate);
    }
    if (!empty($fdate)) {
      $this->db->where('DATE_FORMAT(r_resdata_addedon,"%Y-%m-%d") >=', $fdate);
    }
    $resort_sql = $this->db->select('sum(r_resdata_child + r_resdata_adult) as total_person')->where('r_resdata_band', $bandcolor)->get('resort_data_tbl')->result();
    if (!empty($resort_sql)) {
      $count += $resort_sql[0]->total_person;
    }

    return $count;
  }

  function get_product_sale($from_date = '', $to_date = '')
  {
    $result = array();

    $product_list = $this->Setup_model->get_Active_product(null, 2, 1);
    if (!empty($product_list)) {
      foreach ($product_list as $pvape) {

        $prototal_qty = 0;
        if (!empty($from_date)) {
          $this->db->where('DATE_FORMAT(m_sales_date,"%Y-%m-%d")>=', $from_date);
        }
        if (!empty($to_date)) {
          $this->db->where('DATE_FORMAT(m_sales_date,"%Y-%m-%d")<=', $to_date);
        }
        $sales_sql = $this->db->select('m_sales_id,m_sales_prodid,m_sales_Tqty,m_sales_date')->where("FIND_IN_SET('$pvape->m_product_id', m_sales_prodid)")->get('sales_wp_tbl')->result();
        // print_r($sales_sql); die;
        if (!empty($sales_sql)) {
          foreach ($sales_sql as $vale) {

            $prod_id = explode(',', $vale->m_sales_prodid);
            $prod_qty = explode(',', $vale->m_sales_Tqty);
            foreach ($prod_id as $key => $va) {
              if ($prod_id[$key] == $pvape->m_product_id) {
                $prototal_qty += $prod_qty[$key] ?: 0;
              }
            }
          }
        }

        $old_stock = $this->get_prod_storebal(date('Y-m-d', strtotime($to_date . ' -1 day')), $pvape->m_product_id, null, 2, 1);
        // echo '<pre>'; print_r($old_stock); 
        $res = array(
          'product_id' => $pvape->m_product_id,
          'product_name' => $pvape->m_product_name,
          'product_rate' => $pvape->m_product_sale_rate,
          'product_qty_sale' => $prototal_qty,
          'product_sale_amt' => ($pvape->m_product_sale_rate * $prototal_qty),
          'product_old_stock' => $old_stock[0]->product_bal_qty,
          'product_final_stock' => ($old_stock[0]->product_bal_qty - $prototal_qty),
        );
        $result[] = $res;
      }
      // echo '<pre>'; print_r($result); 
    }
    // die;
    return $result;
  }

  function get_product_mainbal($date, $product, $prodsize = '')
  {
    $result = array();

    if (!empty($prodsize)) {
      $this->db->where('ivt_stkjn_prodsize', $prodsize);
    }

    $this->db->where('DATE_FORMAT(ivt_stkjn_date,"%Y-%m-%d")<=', $date);
    $main_sql = $this->db->select('sum(ivt_stkjn_prodqty) as Tqty,ivt_stkjn_product,ivt_stkjn_prodsize,prodsize.m_prodgroup_name as product_size')->join('master_prodgroup_tbl prodsize', 'prodsize.m_prodgroup_id = inventory_stockjournal_tbl.ivt_stkjn_prodsize', 'left')->where("ivt_stkjn_product", $product)->group_by('ivt_stkjn_product')->group_by('ivt_stkjn_prodsize')->get('inventory_stockjournal_tbl')->result();
    if (!empty($main_sql)) {
      foreach ($main_sql as $mansql) {

        $prototal_qty = $mansql->Tqty;
        $probal_qty = $mansql->Tqty;

        $this->db->where('DATE_FORMAT(ivt_stkisus_date,"%Y-%m-%d")<=', $date);
        $store_sql = $this->db->select('sum(ivt_stkisus_prodqty) as Tqty,ivt_stkisus_product')->where("ivt_stkisus_product", $product)->where("ivt_stkisus_prodsize", $mansql->ivt_stkjn_prodsize)->group_by('ivt_stkisus_product')->group_by('ivt_stkisus_prodsize')->get('inventory_storeissue_tbl')->result();

        if (isset($store_sql[0]->Tqty)) {
          $proissue_qty = $store_sql[0]->Tqty;
          $probal_qty -= $store_sql[0]->Tqty;
        }

        $res = (object) array(
          'prodsize_id' => $mansql->ivt_stkjn_prodsize,
          'product_size' => $mansql->product_size,
          'product_total_qty' => $prototal_qty ?: 0,
          'product_issue_qty' => $proissue_qty ?: 0,
          'product_bal_qty' => $probal_qty ?: 0,

        );

        $result[] = $res;
      }
    }
    return $result;
  }

  function get_prod_storebal($date, $product, $prodsize = '', $dept = '', $type = '')
  {
    $result = array();
    // type mean 1= is_job_work_product , 2= is_raw_material , 3= is_asset


    if (!empty($prodsize)) {
      $this->db->where('ivt_stkisus_prodsize', $prodsize);
    }
    $this->db->where('DATE_FORMAT(ivt_stkisus_date,"%Y-%m-%d")<=', $date);
    $store_sql = $this->db->select('sum(ivt_stkisus_prodqty) as Tqty,ivt_stkisus_product,ivt_stkisus_prodsize,prodsize.m_prodgroup_name as product_size')->join('master_prodgroup_tbl prodsize', 'prodsize.m_prodgroup_id = inventory_storeissue_tbl.ivt_stkisus_prodsize', 'left')->where("ivt_stkisus_product", $product)->group_by('ivt_stkisus_product')->group_by('ivt_stkisus_prodsize')->get('inventory_storeissue_tbl')->result();

    if (!empty($store_sql)) {
      foreach ($store_sql as $strsql) {

        $proissue_qty = (int)$strsql->Tqty;
        $probal_qty = (int)$strsql->Tqty;

        if ($dept == 2 && $type == 1) {

          if (!empty($date)) {
            $this->db->where('DATE_FORMAT(m_sales_date,"%Y-%m-%d")<=', $date);
          }
          $sales_sql = $this->db->select('m_sales_id,m_sales_prodid,m_sales_Tqty,m_sales_date')->where("FIND_IN_SET('$product', m_sales_prodid)")->get('sales_wp_tbl')->result();
          if (!empty($sales_sql)) {
            foreach ($sales_sql as $vale) {

              $prod_id = explode(',', $vale->m_sales_prodid);
              $prod_qty = explode(',', $vale->m_sales_Tqty);
              foreach ($prod_id as $key => $va) {
                if ($prod_id[$key] == $product) {
                  $prosale_qty = (int)$prod_qty[$key];
                  $probal_qty -= (int)$prod_qty[$key];
                }
              }
            }
          }
        } else {
          $this->db->where('DATE_FORMAT(ivt_stkout_date,"%Y-%m-%d")<=', $date);
          $strot_sql = $this->db->select('sum(ivt_stkout_prodqty) as Tqty,ivt_stkout_product')->where("ivt_stkout_product", $product)->where("ivt_stkout_prodsize", $strsql->ivt_stkisus_prodsize)->where("ivt_stkout_type", 1)->group_by('ivt_stkout_product')->group_by('ivt_stkout_prodsize')->get('inventory_storeout_tbl')->result();

          $this->db->where('DATE_FORMAT(ivt_stkout_date,"%Y-%m-%d")<=', $date);
          $damage_sql = $this->db->select('sum(ivt_stkout_prodqty) as Tqty,ivt_stkout_product')->where("ivt_stkout_product", $product)->where("ivt_stkout_prodsize", $strsql->ivt_stkisus_prodsize)->where("ivt_stkout_type", 2)->group_by('ivt_stkout_product')->group_by('ivt_stkout_prodsize')->get('inventory_storeout_tbl')->result();

          if (isset($store_sql[0]->Tqty)) {
            $prostrot_qty = $strot_sql[0]->Tqty;
            $probal_qty -= $strot_sql[0]->Tqty;
          }
          if (isset($damage_sql[0]->Tqty)) {
            $prodmg_qty = $damage_sql[0]->Tqty;
            $probal_qty -= $damage_sql[0]->Tqty;
          }
        }

        $res = (object)array(
          'prodsize_id' => $strsql->ivt_stkisus_prodsize,
          'product_size' => $strsql->product_size,
          'product_saleqty' => $prosale_qty ?: 0,
          'product_usedqty' => $prostrot_qty ?: 0,
          'product_dmgqty' => $prodmg_qty ?: 0,
          'product_totalqty' => $proissue_qty ?: 0,
          'product_bal_qty' => $probal_qty ?: 0,

        );

        $result[] = $res;
      }
    }
    return $result;
  }

  function get_stock_report($from_date, $to_date, $dept, $prod, $type)
  {
    $result = array();

    $product_list = $this->Setup_model->get_Active_product($prod, $dept, $type);
    if (!empty($product_list)) {
      foreach ($product_list as $value) {

        $op_mainsk = $this->get_product_mainbal(date('Y-m-d', strtotime($from_date . ' -1 day')), $value->m_product_id);
        if (!empty($op_mainsk)) {
          foreach ($op_mainsk as $opmnstk) {
            $cl_mainsk = $this->get_product_mainbal($to_date, $value->m_product_id, $opmnstk->prodsize_id);
            $op_storesk = $this->get_prod_storebal(date('Y-m-d', strtotime($from_date . ' -1 day')), $value->m_product_id, $opmnstk->prodsize_id, $dept, $type);
            $cl_storesk = $this->get_prod_storebal($to_date, $value->m_product_id, $opmnstk->prodsize_id, $dept, $type);
            // echo '<pre> product_issue_qty'; print_r($opmnstk->product_issue_qty);
            $res = (object)array(
              'product_id' => $value->m_product_id,
              'product_name' => $value->m_product_name,
              'product_unit' => $value->m_prodgroup_name,
              'product_size' => $opmnstk->product_size,
              'main_opening' =>  $opmnstk->product_bal_qty ?: 0,
              'total_issue' => abs($opmnstk->product_issue_qty - $cl_mainsk[0]->product_issue_qty) ?: 0,
              'main_closing' => $cl_mainsk[0]->product_bal_qty ?: 0,
              'store_opening' => $op_storesk[0]->product_bal_qty ?: 0,
              'total_sale' => abs($op_storesk[0]->product_saleqty - $cl_storesk[0]->product_saleqty) ?: 0,
              'total_used' => abs($op_storesk[0]->product_usedqty - $cl_storesk[0]->product_usedqty) ?: 0,
              'total_damage' => abs($op_storesk[0]->product_dmgqty - $cl_storesk[0]->product_dmgqty) ?: 0,
              'store_closing' => $cl_storesk[0]->product_bal_qty ?: 0,

            );

            $result[] = $res;
          }
        } else {
          $cl_mainsk = $this->get_product_mainbal($to_date, $value->m_product_id);
          $op_storesk = $this->get_prod_storebal(date('Y-m-d', strtotime($from_date . ' -1 day')), $value->m_product_id, null, $dept, $type);
          $cl_storesk = $this->get_prod_storebal($to_date, $value->m_product_id, null, $dept, $type);
          // echo '<pre> product_issue_qty'; print_r($cl_mainsk[0]->product_issue_qty);
          $res = (object)array(
            'product_id' => $value->m_product_id,
            'product_name' => $value->m_product_name,
            'product_unit' => $value->m_prodgroup_name,
            'product_size' => $cl_mainsk[0]->product_size,
            'main_opening' => 0,
            'total_issue' => abs($cl_mainsk[0]->product_issue_qty) ?: 0,
            'main_closing' => $cl_mainsk[0]->product_bal_qty ?: 0,
            'store_opening' => $op_storesk[0]->product_bal_qty ?: 0,
            'total_sale' => abs($op_storesk[0]->product_saleqty - $cl_storesk[0]->product_saleqty) ?: 0,
            'total_used' => abs($op_storesk[0]->product_usedqty - $cl_storesk[0]->product_usedqty) ?: 0,
            'total_damage' => abs($op_storesk[0]->product_dmgqty - $cl_storesk[0]->product_dmgqty) ?: 0,
            'store_closing' => $cl_storesk[0]->product_bal_qty ?: 0,

          );

          $result[] = $res;
        }
      }
      // die ;
    }
    return $result;
  }

  public function get_instk_prod($dept, $gtype)
  {
    $result = array();
    $to_date = date('Y-m-d');
    $product_list = $this->Setup_model->get_Active_product(null, $dept);
    if (!empty($product_list)) {
      foreach ($product_list as $value) {
        if ($gtype == 1) {
          $cl_sk = $this->get_product_mainbal($to_date, $value->m_product_id);
        } else if ($gtype == 2) {
          $cl_sk = $this->get_prod_storebal($to_date, $value->m_product_id, null, $dept, null);
        }


        if (!empty($cl_sk)) {
          foreach ($cl_sk as $opmnstk) {

            // echo '<pre> product_issue_qty'; print_r($opmnstk->product_issue_qty);
            $res = (object)array(

              'm_product_id' => $value->m_product_id,
              'm_product_name' => $value->m_product_name,
              'm_produnit_name' => $value->m_prodgroup_name,
              'm_product_sale_rate' => $value->m_product_sale_rate,
              'm_product_code' => $value->m_product_code,
              'm_prodsize_name' => $opmnstk->product_size,
              'm_prodsize_id' => $opmnstk->prodsize_id,
              'm_prodbal_qty' =>  $opmnstk->product_bal_qty ?: 0,

            );
            if ($opmnstk->product_bal_qty > 0) {
              $result[] = $res;
            }
          }
        }
      }
      // die ;
    }
    return $result;
  }
  //////=============================== reports=========================================////////

  //////=============================== reports=========================================////////

  public function get_ticket_report($from_date, $to_date, $type = '', $filed = '', $fval = '', $limit = 0, $offset = 0)
  {
    $this->db->select('tickets_wp_tbl.*,m_emp_code,m_emp_name,m_saleshead_title,m_city_name,m_cashacc_name,m_cust_name,m_cust_mobile,m_plot_name,m_plot_type,(CASE WHEN m_ticket_paytype = 1 THEN "Cash" WHEN m_ticket_paytype = 2 THEN "Paytm" WHEN m_ticket_paytype = 3 THEN "Phone Pe" WHEN m_ticket_paytype = 4 THEN "other" ELSE "INVAILD" END) AS paytype');
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
    if (!empty($type) && $type == 1 && !empty($filed)) {
      $this->db->select('sum(m_ticket_adult) as total_adult,sum(m_ticket_child) as total_child,(sum(m_ticket_adult) + sum(m_ticket_child) + sum(m_ticket_free)) as total_person,sum(m_ticket_free) as total_free,sum(m_ticket_netAmt) as total_netamt');
      $this->db->group_by($filed);
    } else  if (!empty($type) && $type == 2 && !empty($filed) && !empty($fval)) {
      $this->db->where($filed, $fval);
    }
    $this->db->where('m_ticket_status', 1);
    if ($limit > 0) {
      $this->db->limit($limit, $offset);
    }
    $res = $this->db->get('tickets_wp_tbl')->result_array();

    // echo $this->db->last_query(); die ;
    return $res;
  }

  public function get_ticket_report_count($from_date, $to_date, $type = '', $filed = '', $fval = '')
  {
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
    if (!empty($type) && $type == 2 && !empty($filed) && !empty($fval)) {
      $this->db->where($filed, $fval);
    }
    $this->db->where('m_ticket_status', 1);
    if (!empty($type) && $type == 1 && !empty($filed)) {
      // grouped summary: count distinct groups
      $this->db->select('COUNT(DISTINCT ' . $this->db->protect_identifiers($filed) . ') as cnt');
      $row = $this->db->get('tickets_wp_tbl')->row_array();
      return isset($row['cnt']) ? (int)$row['cnt'] : 0;
    }
    return $this->db->count_all_results('tickets_wp_tbl');
  }

  public function get_bandwise_ticket_count($from_date, $to_date, $bacolour = '')
  {
    if (!empty($bacolour)) {
      $this->db->where('m_hq_id', $bacolour);
    }
    return $this->db->where('m_hq_type', 4)->where('m_hq_status', 1)->count_all_results('master_hq_tbl');
  }

  public function get_bandwise_ticket($from_date, $to_date, $type, $bacolour = '', $limit = 0, $offset = 0)
  {
    if (!empty($bacolour)) {
      $this->db->where('m_hq_id', $bacolour);
    }
    $band_colours = $this->db->where('m_hq_type', 4)->where('m_hq_status', 1)->get('master_hq_tbl')->result();

    if (!empty($band_colours)) {
      foreach ($band_colours as $colval) {
        $adult_count = 0;
        $child_count = 0;
        $free_count = 0;
        if (!empty($to_date)) {
          $this->db->where('m_ticket_date <=', $to_date);
        }
        if (!empty($from_date)) {
          $this->db->where('m_ticket_date >=', $from_date);
        }
        $ticket_sql = $this->db->select('m_ticket_adult,m_ticket_child,m_ticket_added_on,m_ticket_free,m_ticket_band,m_ticket_id,m_ticket_paymode,m_ticket_netAmt,m_ticket_date,m_ticket_no,m_emp_code,m_emp_name,m_saleshead_title,m_city_name,m_cashacc_name,m_cust_name,m_cust_mobile,m_plot_name,m_plot_type,(CASE WHEN m_ticket_paytype = 1 THEN "Cash" WHEN m_ticket_paytype = 2 THEN "Paytm" WHEN m_ticket_paytype = 3 THEN "Phone Pe" WHEN m_ticket_paytype = 4 THEN "other" ELSE "INVAILD" END) AS paytype')
          ->join('master_customer_tbl', 'master_customer_tbl.m_cust_id = tickets_wp_tbl.m_ticket_customer', 'left')
          ->join('master_employee_tbl', 'master_employee_tbl.m_emp_id = tickets_wp_tbl.m_ticket_resp_id', 'left')
          ->join('master_saleshead_tbl', 'master_saleshead_tbl.m_saleshead_id = tickets_wp_tbl.m_ticket_head', 'left')
          ->join('master_city_tbl', 'master_city_tbl.m_city_id = tickets_wp_tbl.m_ticket_city', 'left')
          ->join('master_cashacc_tbl', 'master_cashacc_tbl.m_cashacc_id = tickets_wp_tbl.m_ticket_counter', 'left')
          ->join('master_plots_tbl', 'master_plots_tbl.m_plot_no = tickets_wp_tbl.m_ticket_plot_no', 'left')
          ->where("FIND_IN_SET('$colval->m_hq_id', m_ticket_band)")->where('m_ticket_status', 1)->get('tickets_wp_tbl')->result();
        if (!empty($ticket_sql)) {
          foreach ($ticket_sql as $key => $value) {
            $ac = 0;
            $cc = 0;
            $fc = 0;
            $bandti = explode(',', $value->m_ticket_band);
            if ($bandti[0] == $colval->m_hq_id) {
              $adult_count += $value->m_ticket_adult;
              $ac += $value->m_ticket_adult;
            } else if ($bandti[1] == $colval->m_hq_id) {
              $child_count += $value->m_ticket_child;
              $cc += $value->m_ticket_child;
            } else if ($bandti[2] == $colval->m_hq_id) {
              $free_count += $value->m_ticket_free;
              $fc += $value->m_ticket_free;
            }

            if ($type == 2) {
              $res = array(
                'm_colour_id' => $colval->m_hq_id,
                'm_band_colour' => $colval->m_hq_name,
                'm_ticket_id' => $value->m_ticket_id,
                'm_ticket_paymode' => $value->m_ticket_paymode,
                'm_ticket_netAmt' => $value->m_ticket_netAmt,
                'm_ticket_added_on' => $value->m_ticket_added_on,
                'm_ticket_no' => $value->m_ticket_no,
                'm_emp_code' => $value->m_emp_code,
                'm_emp_name' => $value->m_emp_name,
                'm_saleshead_title' => $value->m_saleshead_title,
                'm_city_name' => $value->m_city_name,
                'm_cashacc_name' => $value->m_cashacc_name,
                'm_cust_name' => $value->m_cust_name,
                'm_cust_mobile' => $value->m_cust_mobile,
                'm_plot_name' => $value->m_plot_name,
                'm_plot_type' => $value->m_plot_type,
                'paytype' => $value->paytype,
                'm_ticket_adult' => $ac,
                'm_ticket_child' => $cc,
                'm_ticket_fc' => $fc,
              );

              $result[] = $res;
            }
          }
        }
        if ($type == 1) {
          $res = array(
            'm_colour_id' => $colval->m_hq_id,
            'm_band_colour' => $colval->m_hq_name,
            'total_netamt' => 0,
            'total_adult' => $adult_count,
            'total_child' => $child_count,
            'total_free' => $free_count,
            'total_person' => $free_count + $adult_count + $child_count,

          );

          $result[] = $res;
        }
      }
    }
    if (empty($result)) {
      return [];
    }
    // Apply PHP-side slice for pagination (band aggregation happens in PHP loop above)
    if ($limit > 0) {
      return array_slice($result, $offset, $limit);
    }
    return $result;
  }

  public function get_monthly_report($month_in)
  {
    if (!empty($month_in)) {
      $last_day = date('t', strtotime($month_in));

      for ($day = 1; $day <= $last_day; $day++) {
        $date = date('Y-m-d', strtotime($month_in . '-' . $day));
        $tik_data = $this->ticketing_detail_report($date, $date);
        $cos_data = $this->Costume_details_report($date, $date);
        $repot_data = $this->dash_report_data($date);

        $expense_amt = $this->db->select('sum(m_expense_amt) as total_expense')
          ->where('m_expense_date', $date)->where_not_in('m_expense_dept', array(2, 3))->where('m_expense_mode', 1)->where('m_expense_status', 1)->get('master_expense_tbl')->result();
        $voucher_amt = $this->db->select('sum(m_expense_amt) as total_voucher')
          ->where('m_expense_date', $date)->where_not_in('m_expense_dept', array(2, 3))->where('m_expense_mode', 2)->where('m_expense_status', 1)->get('master_expense_tbl')->result();

        $advance_amt = $this->db->select('sum(m_advance_amt) as total_advance')->where('m_advance_date', $date)->get('master_advance_tbl')->result();


        $res = (object) array(
          'date' => $date,
          'reception' => $tik_data['Total_buissness'] + $tik_data['total_voucher']?: 0,
          'costume' => ($cos_data['Costume_total'] + $cos_data['Costume_voucher']) ?: 0,
          'resort' => $repot_data['d_rtc_total'] ?: 0,
          'camp' => $repot_data['d_camp_total'] ?: 0,
          'foodcourt' => $repot_data['d_fc_total'] ?: 0,
          'total_expense' => ($expense_amt[0]->total_expense + $advance_amt[0]->total_advance) ?: 0,
          'total_voucher' => $voucher_amt[0]->total_voucher ?: 0,
          'total_upi' => ($tik_data['Ticket_Upi'] + $cos_data['Costume_Upi'] + $repot_data['d_rtc_upi'] + $repot_data['d_camp_upi'] + $repot_data['d_fc_totupi']) ?: 0,
          'total_discount' => ($tik_data['Ticket_discount'] + $cos_data['Costume_discount'] + $repot_data['d_rtc_discount'] + $repot_data['d_camp_discount'] + $repot_data['d_fc_discount']) ?: 0,
          'total_balance' => ($tik_data['Ticket_balance'] + $cos_data['Costume_balance'] + $repot_data['d_rtc_balance'] + $repot_data['d_camp_balance'] + $repot_data['d_fc_balance']) ?: 0,
        );

        $result[] = $res;
      }
      return  $result;
    }
  }

public function get_month_ticket_data($start,$end)
{
    $this->db->select("
        DATE(m_ticket_date) as date,
        SUM(m_ticket_adult) as adult,
        SUM(m_ticket_child) as child,
        SUM(m_ticket_free) as free,
        (SUM(m_ticket_adult)+SUM(m_ticket_child)+SUM(m_ticket_free)) as person,
        SUM(m_ticket_netAmt) as revenue
    ");

    $this->db->from('tickets_wp_tbl');

    $this->db->where('DATE(m_ticket_date) >=',$start);
    $this->db->where('DATE(m_ticket_date) <=',$end);
    $this->db->where('m_ticket_status',1);

    $this->db->group_by('DATE(m_ticket_date)');

    return $this->db->get()->result_array();
}

  //////=============================== reports=========================================////////




  //===========================Profile==========================//

  public function get_application_settings()
  {
    $res = $this->db->get('application_settings')->result();
    return $res;
  }
  public function update_settings()
  {
    if (!empty($_FILES['m_app_logo']['name'])) {
      $config['file_name'] = $_FILES['m_app_logo']['name'];
      $config['upload_path'] = 'uploads';
      $config['allowed_types'] = 'jpg|jpeg|png|pdf';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_app_logo']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_app_logo')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_app_logo'])) {
          if (file_exists($config['m_app_logo'] . $update_data['m_app_logo'])) {
            unlink($config['upload_path'] . $update_data['m_app_logo']); /* deleting Image */
          }
        }
        $m_app_logo = $uploadData['file_name'];
      }
    } else {
      $m_app_logo = $this->input->post('applogo');
    }
    if (!empty($_FILES['m_app_icon']['name'])) {
      $config['file_name'] = $_FILES['m_app_icon']['name'];
      $config['upload_path'] = 'uploads';
      $config['allowed_types'] = 'jpg|jpeg|png|pdf';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_app_icon']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_app_icon')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_app_icon'])) {
          if (file_exists($config['m_app_icon'] . $update_data['m_app_icon'])) {
            unlink($config['upload_path'] . $update_data['m_app_icon']); /* deleting Image */
          }
        }
        $m_app_icon = $uploadData['file_name'];
      }
    } else {
      $m_app_icon = $this->input->post('appfavicon');
    }
    if (!empty($_FILES['m_app_banner']['name'])) {
      $config['file_name'] = $_FILES['m_app_banner']['name'];
      $config['upload_path'] = 'uploads';
      $config['allowed_types'] = 'jpg|jpeg|png|pdf';
      $config['remove_spaces'] = TRUE;
      $config['file_name'] = $_FILES['m_app_banner']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('m_app_banner')) {
        $uploadData = $this->upload->data();
        if (!empty($update_data['m_app_banner'])) {
          if (file_exists($config['m_app_banner'] . $update_data['m_app_banner'])) {
            unlink($config['upload_path'] . $update_data['m_app_banner']); /* deleting Image */
          }
        }
        $m_app_banner = $uploadData['file_name'];
      }
    } else {
      $m_app_banner = $this->input->post('appbanner');
    }
    $data = array(
      "m_app_name" => $this->input->post('m_app_name'),
      "m_app_title" => $this->input->post('m_app_title'),
      "m_app_email" => $this->input->post('m_app_mail'),
      "m_app_mobile" => $this->input->post('m_app_contact'),
      "m_app_address" => $this->input->post('m_app_address'),
      "is_today_holiday" => $this->input->post('is_today_holiday'),
      "m_app_logo" => "$m_app_logo",
      "m_app_icon" => "$m_app_icon",
      "m_app_banner" => "$m_app_banner",
    );
    $this->db->where('m_app_id', 1);
    $this->db->update('application_settings', $data);
    return true;
  }
  public function update_app()
  {
    if (!empty($_FILES)) {
      $config['upload_path'] = '../uploads/';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['remove_spaces'] = TRUE;
    }
    if (!empty($_FILES['app_favicon']['name'])) {
      $_POST['app_favicon'] = $_POST['app_pfavicon'];
      unset($_POST['app_pfavicon']);

      $config['file_name'] = $_FILES['app_favicon']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if ($this->upload->do_upload('app_favicon')) {
        $uploadData = $this->upload->data();

        if (!empty($_POST['app_favicon'])) {
          if (file_exists($config['upload_path'] . $_POST['app_favicon'])) {
            unlink($config['upload_path'] . $_POST['app_favicon']); /* Deleting Image */
          }
        }

        $_POST['app_favicon'] = $uploadData['file_name'];
      }
    }

    if (!empty($_FILES['app_logo']['name'])) {
      $_POST['app_logo'] = $_POST['app_plogo'];
      unset($_POST['app_plogo']);

      $config['file_name'] = $_FILES['app_logo']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if ($this->upload->do_upload('app_logo')) {
        $uploadData = $this->upload->data();

        if (!empty($_POST['app_logo'])) {
          if (file_exists($config['upload_path'] . $_POST['app_logo'])) {
            unlink($config['upload_path'] . $_POST['app_logo']); /* Deleting Image */
          }
        }

        $_POST['app_logo'] = $uploadData['file_name'];
      }
    }

    if (!empty($_FILES['app_footer_logo']['name'])) {
      $_POST['app_footer_logo'] = $_POST['app_footer_plogo'];
      unset($_POST['app_footer_plogo']);

      $config['file_name'] = $_FILES['app_footer_logo']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if ($this->upload->do_upload('app_footer_logo')) {
        $uploadData = $this->upload->data();

        if (!empty($_POST['app_footer_logo'])) {
          if (file_exists($config['upload_path'] . $_POST['app_footer_logo'])) {
            unlink($config['upload_path'] . $_POST['app_footer_logo']); /* Deleting Image */
          }
        }

        $_POST['app_footer_logo'] = $uploadData['file_name'];
      }
    }

    if (!empty($_FILES['app_mobile_logo']['name'])) {
      $_POST['app_mobile_logo'] = $_POST['app_mobile_plogo'];
      unset($_POST['app_mobile_plogo']);

      $config['file_name'] = $_FILES['app_mobile_logo']['name'];
      //Load upload library and initialize configuration
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if ($this->upload->do_upload('app_mobile_logo')) {
        $uploadData = $this->upload->data();

        if (!empty($_POST['app_mobile_logo'])) {
          if (file_exists($config['upload_path'] . $_POST['app_mobile_logo'])) {
            unlink($config['upload_path'] . $_POST['app_mobile_logo']); /* Deleting Image */
          }
        }

        $_POST['app_mobile_logo'] = $uploadData['file_name'];
      }
    }

    foreach ($_POST as $key => $value) {
      $this->db->set('m_app_value', $value);
      $this->db->where('m_app_key', $key);;
      $this->db->update('master_app_settings');
    }
    return true;
  }

  public function get_rate_band_list($type)
  {
    $res = $this->db->where('tbs_type', $type)->get('ticket_band_setting')->result();
    return $res;
  }

  public function update_rate_band_settings()
  {

    $tbs_value = $this->input->post('tbs_value');
    $tbs_id = $this->input->post('tbs_id');

    if (!empty($tbs_id)) {
      foreach ($tbs_id as $cau => $key) {
        $this->db->set('tbs_value', $tbs_value[$cau])->where('tbs_id', $key)->update('ticket_band_setting');
      }
      return true;
    } else {
      return false;
    }
  }

  //==========================/Profile==========================//


}
