<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Inventory extends CI_Controller
{


  /////////////////////////////////////////// purchase /////////////////////////////////////////////////

  public function purchase_order()
  {
    $data = $this->login_details();
    $data['pagename'] = "Purchase Order List";

    $data['from_date'] = $this->input->post('from_date') ?: '';
    $data['to_date'] = $this->input->post('to_date') ?: '';

    if (!empty($this->input->post('Excel'))) {
      $this->excelForpurchase($data['from_date'], $data['to_date']);
    }
    $data['mode'] = 1;
    $data['purchase_value'] = $this->Master_model->get_purchase_order_list($data['from_date'], $data['to_date']);
    $this->load->view('purchase_list', $data);
  }

  public function purchase_invoice()
  {
    $data = $this->login_details();
    $data['pagename'] = "Purchase Invoice List";

    $data['from_date'] = $this->input->post('from_date') ?: '';
    $data['to_date'] = $this->input->post('to_date') ?: '';

    if (!empty($this->input->post('Excel'))) {
      $this->excelForpurchase($data['from_date'], $data['to_date']);
    }
    $data['mode'] = 2;
    $data['purchase_value'] = $this->Master_model->get_purchase_invoice_list($data['from_date'], $data['to_date']);
    $this->load->view('purchase_list', $data);
  }

  public function purchase_return()
  {
    $data = $this->login_details();
    $data['pagename'] = "Purchase Return List";

    $data['from_date'] = $this->input->post('from_date') ?: '';
    $data['to_date'] = $this->input->post('to_date') ?: '';

    if (!empty($this->input->post('Excel'))) {
      $this->excelForpurchase($data['from_date'], $data['to_date']);
    }
    $data['mode'] = 3;
    $data['purchase_value'] = $this->Master_model->get_purchase_return_list($data['from_date'], $data['to_date']);
    $this->load->view('purchase_list', $data);
  }

  public function add_purchase_order()
  {
    $data = $this->login_details();
    $data['requ_id'] = $this->input->post('requ_id');
    if (!empty($data['requ_id'])) {
      $data['reques_items'] = $this->Master_model->get_requirement_list_by($data['requ_id']);
    }

    $data['eid'] = $this->input->get('id');
    $editid = $this->input->get('editid');
    if (!empty($editid)) {
      $data['pagename'] = "Edit Purchase Order Details";
    } else {
      $data['pagename'] = "Add New Purchase Order";
    }
    $data['id'] = $data['eid'] ?: $editid;
    $data['pagemode'] = 1;
    $data['purchase_no'] = 'ORD-' . $this->Master_model->get_last_purid(1);
    $data['company_list'] = $this->Setup_model->get_active_company();
    $data['products'] = $this->Setup_model->get_Active_product();
    $data['prodsize_dl'] = $this->Setup_model->get_active_prodgroup(3);

    // $data['godown_dtl'] = $this->Setup_model->get_active_godown();
    // $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc();
    $data['edit_value'] = $this->Master_model->get_purchase_dtl($data['id']);
    $data['info_value'] = $this->Master_model->get_purchase_info_dtl($data['id']);
    $this->load->view('add_purchase', $data);
  }

  public function add_purchase_invoice()
  {
    $data = $this->login_details();
    $data['eid'] = $this->input->get('id');
    $editid = $this->input->get('editid');
    if (!empty($editid)) {
      $data['pagename'] = "Edit Purchase Invoice Details";
    } else {
      $data['pagename'] = "Add New Purchase Invoice";
    }
    $data['id'] = $data['eid'] ?: $editid;
    $data['pagemode'] = 2;
    $data['purchase_no'] = 'ORD-' . $this->Master_model->get_last_purid(1);
    $data['company_list'] = $this->Setup_model->get_active_company();
    $data['products'] = $this->Setup_model->get_Active_product();
    $data['prodsize_dl'] = $this->Setup_model->get_active_prodgroup(3);
    $data['supplier_dl'] = $this->Setup_model->get_Active_supplier(1);
    $data['godown_dtl'] = $this->Setup_model->get_active_godown();
    $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc();
    $data['edit_value'] = $this->Master_model->get_purchase_dtl($data['id']);
    $data['info_value'] = $this->Master_model->get_purchase_info_dtl($data['id']);
    $this->load->view('add_purchase', $data);
  }

  public function add_purchase_return()
  {
    $data = $this->login_details();
    $data['eid'] = $eid = $this->input->get('id');
    $editid = $this->input->get('editid');
    $data['id'] = $eid ?: $editid;

    if (!empty($editid)) {
      $data['pagename'] = "Edit Purchase Return Details";
      $data['info_value'] = $this->Master_model->get_purchase_info_dtl($data['id']);
    } else {
      $data['pagename'] = "Add New Purchase Return";
      $data['info_value'] = $this->Master_model->get_blcnd_puritms($data['id']);
    }

    $data['pagemode'] = 3;
    $data['rpurchase_no'] = 'PRTN-' . $this->Master_model->get_last_purid(3);
    $data['company_list'] = $this->Setup_model->get_active_company();
    $data['products'] = $this->Setup_model->get_Active_product();
    $data['prodsize_dl'] = $this->Setup_model->get_active_prodgroup(3);
    $data['supplier_dl'] = $this->Setup_model->get_Active_supplier(1);
    $data['godown_dtl'] = $this->Setup_model->get_active_godown();
    $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc();
    $data['edit_value'] = $this->Master_model->get_purchase_dtl($data['id']);


    // echo '<pre>'; print_r($data['info_value']); die ;
    $this->load->view('add_purchase', $data);
  }

  public function insert_purchase()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Master_model->insert_purchase()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Data has been booked successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Data data Updated Successfully'
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



  public function delete_purchase()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Master_model->delete_purchase()) {

        $info = array(
          'status' => 'success',
          'message' => 'Data Has been Deleted successfully!'
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

  public function excelForpurchase($from_date, $to_date)
  {

    $allreportdata  = $this->Master_model->get_purchase_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {

      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_purchase_no;
      $subArray[] = $key->m_purchase_name;
      $subArray[] = $key->m_city_name;
      $subArray[] = $key->m_purchase_mobile;
      $subArray[] = $this->Master_model->get_purchasemem_count($key->m_purchase_id);
      $subArray[] = $key->reg_paper_rcvd == 1 ? 'Yes' : 'No ';;
      $subArray[] =  $key->is_adhar_rcvd == 1 ? 'Yes' : 'No ';
      $subArray[] =  $key->m_purchase_aadhar_no;
      $subArray[] =  $key->m_purchase_remark;

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'purchase_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "SN",
      "purchaseNo",
      "RegistryName",
      "City",
      "Mobile No.",
      "MemberCount",
      "Reg Paper Rcvd",
      "Aadhar Rcvd",
      "Aadhar No",
      "Remark",
    );
    fputcsv($file, $header);
    foreach ($report as $line) {
      fputcsv($file, $line);
    }
    fclose($file);

    exit;
  }

  public function get_supplier_dtl()
  {

    $id = $this->input->post('suppid');
    $data = $this->Setup_model->get_supplier_dtl($id);
    echo json_encode($data);
  }
  /////////////////////////////////////////// purchase /////////////////////////////////////////////////


  /////////////////////////////////////////// requirment table /////////////////////////////////////////////////

  public function requirement_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Requirements List";
    if (!empty($this->input->post('from_date'))) {
      $data['from_date'] = $this->input->post('from_date');
    } else {
      $data['from_date'] = '';
    }
    if (!empty($this->input->post('to_date'))) {
      $data['to_date'] = $this->input->post('to_date');
    } else {
      $data['to_date'] = '';
    }
    if (!empty($this->input->post('Excel'))) {
      $this->excelForreqmt($data['from_date'], $data['to_date']);
    }
    // $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc();
    $data['all_data'] = $this->Master_model->get_requirement_list($data['from_date'], $data['to_date']);
    $this->load->view('ivt_requirement_list', $data);
  }

  public function add_requirement()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Requirement Details";
    } else {
      $data['pagename'] = "Add New Requirement";
    }

    $data['dept_list'] = $this->Hr_model->get_active_dept();
    $data['products'] = $this->Setup_model->get_Active_product();
    $data['prodsize_dl'] = $this->Setup_model->get_active_prodgroup(3);
    $data['edit_value'] = $this->Master_model->get_requirement_dtl($data['id']);

    // print_r($data['products']); die ;
    $this->load->view('add_reqirements', $data);
  }

  public function insert_requirements()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Master_model->insert_requirements()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Data has been Added Successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'data Updated Successfully'
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



  public function delete_requirement()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Master_model->delete_requirement()) {

        $info = array(
          'status' => 'success',
          'message' => 'Data Has been Deleted successfully!'
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

  public function excelForreqmt($from_date, $to_date)
  {

    $allreportdata  = $this->Master_model->get_requirement_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {

      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_requirement_no;
      $subArray[] = $key->m_requirement_name;
      $subArray[] = $key->m_city_name;
      $subArray[] = $key->m_requirement_mobile;
      $subArray[] = $this->Master_model->get_requirementmem_count($key->m_requirement_id);
      $subArray[] = $key->reg_paper_rcvd == 1 ? 'Yes' : 'No ';;
      $subArray[] =  $key->is_adhar_rcvd == 1 ? 'Yes' : 'No ';
      $subArray[] =  $key->m_requirement_aadhar_no;
      $subArray[] =  $key->m_requirement_remark;

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'requirement_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "SN",
      "requirementNo",
      "RegistryName",
      "City",
      "Mobile No.",
      "MemberCount",
      "Reg Paper Rcvd",
      "Aadhar Rcvd",
      "Aadhar No",
      "Remark",
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


  /////////////////////////////////////////// requirement /////////////////////////////////////////////////


  /////////////////////////////////////////// stkjn /////////////////////////////////////////////////

  public function stockjournal_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Stock Journal List";

    $data['from_date'] = $this->input->post('from_date');
    $data['to_date'] = $this->input->post('to_date');

    if (!empty($this->input->post('Excel'))) {
      $this->excelForstkjn($data['from_date'], $data['to_date']);
    }
    // $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc();
    $data['stkjn_value'] = $this->Master_model->get_stkjn_list($data['from_date'], $data['to_date']);
    $this->load->view('ivt_stockjournal_list', $data);
  }

  public function add_stockjournal()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    $data['editid'] = $this->input->get('editid');
    if (!empty($data['editid'])) {
      $data['pagename'] = "Edit Main Stock Details";
    } else {
      $data['pagename'] = "Add Main Stock";
    }
    if (!empty($data['id'])) {
      $data['pur_value'] = $this->Master_model->get_blcnd_puritms($data['id']);
    }
    $data['company_list'] = $this->Setup_model->get_active_company();
    $data['products'] = $this->Setup_model->get_Active_product();
    $data['prodsize_dl'] = $this->Setup_model->get_active_prodgroup(3);
    $data['godown_dtl'] = $this->Setup_model->get_active_godown(1);

    $data['edit_value'] = $this->Master_model->get_stkjn_dtl($data['editid']);

    //  echo '<pre>'; print_r($data['pur_value']); die ;
    $this->load->view('add_stockjournal', $data);
  }

  public function insert_stkjn()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Master_model->insert_stkjn()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Stock has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Stock data Updated Successfully'
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



  public function delete_stkjn()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Master_model->delete_stkjn()) {

        $info = array(
          'status' => 'success',
          'message' => 'Main Stock Has been Deleted successfully!'
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

  public function excelForstkjn($from_date, $to_date)
  {

    $allreportdata  = $this->Master_model->get_stkjn_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {

      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_stkjn_no;
      $subArray[] = $key->m_stkjn_name;
      $subArray[] = $key->m_city_name;
      $subArray[] = $key->m_stkjn_mobile;
      $subArray[] = $this->Master_model->get_stkjnmem_count($key->m_stkjn_id);
      $subArray[] = $key->reg_paper_rcvd == 1 ? 'Yes' : 'No ';;
      $subArray[] =  $key->is_adhar_rcvd == 1 ? 'Yes' : 'No ';
      $subArray[] =  $key->m_stkjn_aadhar_no;
      $subArray[] =  $key->m_stkjn_remark;

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'stkjn_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "SN",
      "stkjnNo",
      "RegistryName",
      "City",
      "Mobile No.",
      "MemberCount",
      "Reg Paper Rcvd",
      "Aadhar Rcvd",
      "Aadhar No",
      "Remark",
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

  public function get_instk_prod()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $dept = $this->input->post('dept');
      $gtype = $this->input->post('gtype');
      $data = $this->Student_model->get_instk_prod($dept, $gtype);

      echo json_encode($data);
    }
  }

  public function get_stkjn_dtl()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $stkno = $this->input->post('stkno');
      $data = $this->Master_model->get_stkjn_dtl($stkno);

      echo json_encode($data);
    }
  }
  /////////////////////////////////////////// stkjn /////////////////////////////////////////////////

  /////////////////////////////////////////// storeissue /////////////////////////////////////////////////

  public function storeissue_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Store Issue List";

    $data['from_date'] = $this->input->post('from_date');
    $data['to_date'] = $this->input->post('to_date');

    // if (!empty($this->input->post('Excel'))) {
    //   $this->excelForstoreissue($data['from_date'], $data['to_date']);
    // }
    // $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc();
    $data['storeissue_value'] = $this->Master_model->get_storeissue_list($data['from_date'], $data['to_date']);
    $this->load->view('ivt_storeissue_list', $data);
  }

  public function add_storeissue()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    $data['editid'] = $this->input->get('editid');
    $data['dept'] = $this->input->get('dept');
    if (!empty($data['editid'])) {
      $data['pagename'] = "Edit Store Stock Details";
    } else {
      $data['pagename'] = "Add New store Stock";
    }
    if (!empty($data['id'])) {
      $data['pur_value'] = $this->Master_model->get_blcnd_puritms($data['id']);
    }
    $data['company_list'] = $this->Setup_model->get_active_company();
    // $data['products'] = $this->Setup_model->get_Active_product();
    $data['prodsize_dl'] = $this->Setup_model->get_active_prodgroup(3);
    $data['godown_dtl'] = $this->Setup_model->get_active_godown(2);
    $data['products'] = $this->Student_model->get_instk_prod($data['dept'], 1);
    $data['edit_value'] = $this->Master_model->get_storeissue_dtl($data['editid']);

    //  echo '<pre>'; print_r($data['products']); die ;
    $this->load->view('add_storeissue', $data);
  }

  public function insert_storeissue()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Master_model->insert_storeissue()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Stock has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Stock data Updated Successfully'
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




  public function delete_storeissue()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Master_model->delete_storeissue()) {

        $info = array(
          'status' => 'success',
          'message' => 'Stock Has been Deleted successfully!'
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

  public function get_storeissue_dtl()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $stkno = $this->input->post('stkno');
      $data = $this->Master_model->get_storeissue_dtl($stkno);

      echo json_encode($data);
    }
  }
  /////////////////////////////////////////// storeissue /////////////////////////////////////////////////
  /////////////////////////////////////////// storeout /////////////////////////////////////////////////

  public function storeout_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Store Out List";
    $data['pagetype'] = 1;
    $data['from_date'] = $this->input->post('from_date');
    $data['to_date'] = $this->input->post('to_date');

    if (!empty($this->input->post('Excel'))) {
      $this->excelForstoreout($data['from_date'], $data['to_date']);
    }
    // $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc();
    $data['storeout_value'] = $this->Master_model->get_storeout_list($data['pagetype'], $data['from_date'], $data['to_date']);
    $this->load->view('ivt_storeout_list', $data);
  }

  public function damage_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Damage List";
    $data['pagetype'] = 2;
    $data['from_date'] = $this->input->post('from_date');
    $data['to_date'] = $this->input->post('to_date');

    if (!empty($this->input->post('Excel'))) {
      $this->excelForstoreout($data['from_date'], $data['to_date']);
    }
    $data['storeout_value'] = $this->Master_model->get_storeout_list($data['pagetype'], $data['from_date'], $data['to_date']);
    $this->load->view('ivt_storeout_list', $data);
  }

  public function add_storeout($type = 1)
  {
    $data = $this->login_details();
    $data['pagetype'] = $type;
    $data['id'] = $this->input->get('id');
    $data['editid'] = $this->input->get('editid');
    $data['dept'] = $this->input->get('dept');

    if (!empty($data['editid'])) {
      $data['pagename'] =  $data['pagetype'] == 1 ? "Edit Store Out Details" : "Edit Damage Details";
    } else {
      $data['pagename'] = $data['pagetype'] == 1 ? "Add Store Out" : "Add New Damage";
    }

    if (!empty($data['id'])) {
      $data['pur_value'] = $this->Master_model->get_blcnd_puritms($data['id']);
    }

    $data['company_list'] = $this->Setup_model->get_active_company();
    $data['products'] = $this->Setup_model->get_Active_product();
    $data['prodsize_dl'] = $this->Setup_model->get_active_prodgroup(3);
    $data['godown_dtl'] = $this->Setup_model->get_active_godown(2);
    $data['products'] = $this->Student_model->get_instk_prod($data['dept'], 2);
    $data['edit_value'] = $this->Master_model->get_storeout_dtl($data['editid']);

    //  echo '<pre>'; print_r($data['pur_value']); die ;
    $this->load->view('add_storeout', $data);
  }

  public function insert_storeout()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Master_model->insert_storeout()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Stock has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Stock data Updated Successfully'
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



  public function delete_storeout()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Master_model->delete_storeout()) {

        $info = array(
          'status' => 'success',
          'message' => 'Stock Has been Deleted successfully!'
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

  public function get_storeout_dtl()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $stkno = $this->input->post('stkno');
      $data = $this->Master_model->get_storeout_dtl($stkno);

      echo json_encode($data);
    }
  }

  public function excelForstoreout($from_date, $to_date)
  {

    $allreportdata  = $this->Master_model->get_storeout_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {

      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->ivt_strissue_no;
      $subArray[] = $key->ivt_strissue_name;
      $subArray[] = $key->m_city_name;
      $subArray[] = $key->ivt_strissue_mobile;
      $subArray[] = $this->Master_model->get_storeoutmem_count($key->ivt_strissue_id);
      $subArray[] = $key->reg_paper_rcvd == 1 ? 'Yes' : 'No ';;
      $subArray[] =  $key->is_adhar_rcvd == 1 ? 'Yes' : 'No ';
      $subArray[] =  $key->ivt_strissue_aadhar_no;
      $subArray[] =  $key->ivt_strissue_remark;

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'storeout_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "SN",
      "storeoutNo",
      "RegistryName",
      "City",
      "Mobile No.",
      "MemberCount",
      "Reg Paper Rcvd",
      "Aadhar Rcvd",
      "Aadhar No",
      "Remark",
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


  /////////////////////////////////////////// storeout /////////////////////////////////////////////////

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

  protected function ajax_login($nav_id = '')
  {
    $is_user_in = $this->session->userdata('is_user_in');
    if (isset($is_user_in) || $is_user_in == true) {
      return true;
    } else {
      echo json_encode(array('status' => 'error', 'message' => 'You are not Logged in Now!! Please login again.'));
      return false;
    }
  }
  //=====================/Login Validation======================//

}
