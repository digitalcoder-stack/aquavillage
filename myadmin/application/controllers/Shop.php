<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Shop extends CI_Controller
{

  /////////////////////////////////////////// Ticket /////////////////////////////////////////////////

  public function index()
  {
    $data = $this->login_details();
    $data = $this->login_details();
    $data['pagename'] = "All Ticket List";
    if (!empty($this->input->post('from_date'))) {
      $data['from_date'] = $this->input->post('from_date');
    } else {
      $data['from_date'] = date('Y-m-d');
    }
    if (!empty($this->input->post('to_date'))) {
      $data['to_date'] = $this->input->post('to_date');
    } else {
      $data['to_date'] = date('Y-m-d');
    }

    $data['head'] = $this->input->post('m_ticket_head');
    if (!empty($this->input->post('Excel'))) {
      $this->excelForticket($data['from_date'], $data['to_date'], $data['head']);
    }

    $data['pending_tickets'] = $this->Main_model->get_pending_ticket();
    $data['head_dtl'] = $this->Master_model->all_active_saleshead();
    $data['ticket_value'] = $this->Main_model->get_ticket_list($data['from_date'], $data['to_date'], $data['head']);
    $data['city_report'] = $this->Student_model->city_wise_ticket_report($data['from_date'], $data['to_date'], $data['head']);
    // echo'<pre>';print_r($data['city_report']); die;
    $this->load->view('tickets_list', $data);
  }



  public function add_ticket()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Ticket Details";
    } else {
      $data['pagename'] = "Add New Ticket";
    }
    $data['dept'] = 3;
    $data['pending_tickets'] = $this->Main_model->get_pending_ticket();
    $data['head_dtl'] = $this->Master_model->all_active_saleshead();
    $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc($data['dept']);
    $data['user_dtl'] = $this->Main_model->get_credit_customer();
    $data['city_dtl'] = $this->Master_model->get_active_city();
    $data['get_active_state'] = $this->Master_model->get_active_state();
    $data['emp_list'] = $this->Hr_model->get_Active_emp();
    $data['edit_value'] = $this->Main_model->get_ticket_dtl($data['id']);
    $data['band_stk'] = $this->Student_model->today_band_stck_fun();

    $this->load->view('add_ticket', $data);
  }


  public function get_plotmem_list()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $plotno = $this->input->post('plotno');
      if ($data = $this->Main_model->get_plotmem_list($plotno)) {

        $info = array(
          'status' => 'success',
          'message' => 'fatched successfully!',
          'data' => $data,
        );
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'No data Found Related to this number',
          'data' => array(),
        );
      }

      echo json_encode($info);
    }
  }

  public function get_plotmem_details()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $memid = $this->input->post('memid');
      if ($data = $this->Main_model->get_plotmem_details($memid)) {

        $info = array(
          'status' => 'success',
          'data' => $data,
        );
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'No data Found Related to this number',

        );
      }

      echo json_encode($info);
    }
  }

  public function convert_lead_ticket()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->convert_lead_ticket()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Ticket has been booked successfully!'
          );
        } else if ($data == 3) {
          $info = array(
            'status' => 'error',
            'message' => 'Duplicate Entry ! This number is Already Used Today',
          );
        }
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'Some problem Occurred!! please try again'
        );
      }

      redirect($_SERVER['HTTP_REFERER']);
    }
  }
  public function insert_ticket()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_ticket()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Ticket has been booked successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Ticket data Updated Successfully'
          );
        } else if ($data == 3) {
          $info = array(
            'status' => 'error',
            'message' => 'Duplicate Entry ! This number is Already Used Today',
          );
        } else if ($data == 4) {
          $info = array(
            'status' => 'error',
            'message' => 'Net Amount And Paid Amount Should be Equal!',
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

  public function delete_ticket()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_ticket()) {

        $info = array(
          'status' => 'success',
          'message' => 'Ticket Has been Deleted successfully!'
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

  public function refund_ticket()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->refund_ticket()) {

        $info = array(
          'status' => 'success',
          'message' => 'Ticket Has been Refund successfully!'
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

  public function get_applicable_discount()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    $data = $this->Setup_model->get_applicable_discount();
    if ($data) {
      echo json_encode(['status' => 'success', 'discount' => $data]);
    } else {
      echo json_encode(['status' => 'error', 'discount' => '']);
    }
  }

  public function excelForticket($from_date, $to_date, $head)
  {

    $allreportdata  = $this->Main_model->get_ticket_list($from_date, $to_date, $head);
    // echo '<pre>' ;print_r($allreportdata); die ;
    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {
      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_ticket_date;
      $subArray[] = $key->m_ticket_paymode;
      $subArray[] = $key->m_cust_mobile;
      $subArray[] = $key->m_ticket_adult;
      $subArray[] = $key->m_ticket_child;
      $subArray[] = $key->m_cust_name;
      $subArray[] = $key->m_ticket_cusType;
      $subArray[] = $key->m_ticket_city;
      $subArray[] = $key->m_ticket_plot_no;
      $subArray[] = '';
      $subArray[] = '';
      $subArray[] =  $key->m_ticket_netAmt;
      $subArray[] = date('d-m-Y h:i', strtotime($key->m_ticket_added_on));

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'ticket_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "Sno.",
      "Dated",
      "Mode",
      "Mobile No.",
      "Family",
      "Stag",
      "CustomerName",
      "CustomerType",
      "City",
      "PlotNo",
      "PlotType",
      "PlotOwner",
      "NetAmount",
      "Created on",

    );
    fputcsv($file, $header);
    foreach ($report as $line) {
      fputcsv($file, $line);
    }
    fclose($file);

    exit;
  }


  /////////////////////////////////////////// Ticket /////////////////////////////////////////////////

  /////////////////////////////////////////// Locker /////////////////////////////////////////////////

  public function locker_list($type = 1)
  {
    $data = $this->login_details();

    if (!empty($this->input->post('from_date'))) {
      $data['from_date'] = $this->input->post('from_date');
    } else {
      $data['from_date'] = date('Y-m-d');
    }
    if (!empty($this->input->post('to_date'))) {
      $data['to_date'] = $this->input->post('to_date');
    } else {
      $data['to_date'] = date('Y-m-d');
    }
    $data['type'] = $type;
    if (!empty($this->input->post('Excel'))) {
      $this->excelForlocker($data['from_date'], $data['to_date']);
    }

    $data['dept'] = 2;

    $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc($data['dept']);
    $data['ticket_value'] = $this->Main_model->get_ticket_list($data['from_date'], $data['to_date']);

    if ($type == 1) {
      $data['pagename'] = "Create Locker List";
      $data['ticket_value'] = $this->Main_model->get_ticket_list($data['from_date'], $data['to_date']);
    } else {
      $data['pagename'] = "All Locker List";
      $data['locker_value'] = $this->Main_model->get_locker_list($data['from_date'], $data['to_date']);
      //  echo '<pre>'; print_r($data['locker_value']); die ;
    }

    $this->load->view('lockers_list', $data);
  }

  public function add_locker()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    $data['ticketid'] = $this->input->get('ticketid');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Locker Details";
    } else {
      $data['pagename'] = "Add New Locker";
    }
    $data['dept'] = 2;
    $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc($data['dept']);
    $data['catB_dtl'] = $this->Master_model->get_catB_lockercode();
    $data['catL_dtl'] = $this->Master_model->get_catL_lockercode();
    $data['catG_dtl'] = $this->Master_model->get_catG_lockercode();
    $data['user_lst'] = $this->Main_model->get_ticket_customer($data['ticketid']);
    $data['edit_value'] = $this->Main_model->get_locker_dtl($data['id']);


    $this->load->view('add_locker', $data);
  }

  public function insert_locker()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_locker()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Locker has been booked successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Locker data Updated Successfully'
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

  public function update_lockerrefund()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_lockerrefund()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Refund has been successfully!'
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


  public function delete_locker()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_locker()) {

        $info = array(
          'status' => 'success',
          'message' => 'Locker Has been Deleted successfully!'
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

  public function excelForlocker($from_date, $to_date)
  {

    $allreportdata  = $this->Main_model->get_locker_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {
      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_locker_date;
      $subArray[] = $key->m_locker_counter;
      $subArray[] = $key->m_cust_mobile;
      $subArray[] = $key->m_ticket_adult;
      $subArray[] = $key->m_ticket_child;
      $subArray[] = $key->m_cust_name;
      $subArray[] =  $key->m_locker_Tlocker;
      $subArray[] =  $key->m_locker_Trent;
      $subArray[] =  $key->m_locker_Tdeposit;
      $subArray[] =  $key->m_locker_refund;
      $subArray[] = date('d-m-Y h:i', strtotime($key->m_locker_added_on));

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'locker_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "Sno.",
      "Dated",
      "Counter",
      "Mobile No.",
      "Family",
      "Stag",
      "CustomerName",
      "Total Locker",
      "Total Rent",
      "Total Deposit",
      "Refund Amount",
      "Created on",

    );
    fputcsv($file, $header);
    foreach ($report as $line) {
      fputcsv($file, $line);
    }
    fclose($file);

    exit;
  }


  /////////////////////////////////////////// Locker /////////////////////////////////////////////////

  /////////////////////////////////////////// Costume /////////////////////////////////////////////////
  public function costume_list($type = 1)
  {
    $data = $this->login_details();


    if (!empty($this->input->post('from_date'))) {
      $data['from_date'] = $this->input->post('from_date');
    } else {
      $data['from_date'] = date('Y-m-d');
    }
    if (!empty($this->input->post('to_date'))) {
      $data['to_date'] = $this->input->post('to_date');
    } else {
      $data['to_date'] = date('Y-m-d');
    }
    $data['type'] = $type;
    if (!empty($this->input->post('Excel'))) {
      $this->excelForcostume($data['from_date'], $data['to_date']);
    }
    if ($type == 1) {
      $data['pagename'] = "Create costume List";
      $data['ticket_value'] = $this->Main_model->get_ticket_list($data['from_date'], $data['to_date']);
    } else {
      $data['pagename'] = "All costume List";
      $data['costume_value'] = $this->Main_model->get_costume_list($data['from_date'], $data['to_date']);
      //  echo '<pre>'; print_r($data['costume_value']); die ;
    }
    $data['dept'] = 2;
    $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc($data['dept']);


    $this->load->view('costume_list', $data);
  }

  public function add_costume()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    $data['ticketid'] = $this->input->get('ticketid');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Costume Details";
    } else {
      $data['pagename'] = "Add New Costume";
    }
    $data['dept'] = 2;
    $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc($data['dept']);

    $data['cosCode'] = $this->Setup_model->get_Active_product(null, 2, 2);

    $data['user_lst'] = $this->Main_model->get_ticket_customer($data['ticketid']);
    $data['edit_value'] = $this->Main_model->get_costume_dtl($data['id']);

    $this->load->view('add_costume', $data);
  }

  public function insert_costume()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_costume()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Costume has been booked successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Costume data Updated Successfully'
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

  public function update_costumerefund()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_costumerefund()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Refund has been successfully!'
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

  public function delete_costume()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_costume()) {

        $info = array(
          'status' => 'success',
          'message' => 'Costume Has been Deleted successfully!'
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

  public function excelForcostume($from_date, $to_date)
  {

    $allreportdata  = $this->Main_model->get_costume_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {
      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_costume_date;
      $subArray[] = $key->m_costume_counter;
      $subArray[] = $key->m_cust_mobile;
      $subArray[] = $key->m_ticket_adult;
      $subArray[] = $key->m_ticket_child;
      $subArray[] = $key->m_cust_name;
      $subArray[] =  $key->m_costume_Trent;
      $subArray[] =  $key->m_costume_Tdeposit;
      $subArray[] =  $key->m_costume_refund;
      $subArray[] = date('d-m-Y h:i', strtotime($key->m_costume_added_on));

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'costume_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "Sno.",
      "Dated",
      "Counter",
      "Mobile No.",
      "Family",
      "Stag",
      "CustomerName",
      "Total Rent",
      "Total Deposit",
      "Refund Amount",
      "Created on",

    );
    fputcsv($file, $header);
    foreach ($report as $line) {
      fputcsv($file, $line);
    }
    fclose($file);

    exit;
  }

  /////////////////////////////////////////// Costume /////////////////////////////////////////////////


  /////////////////////////////////////////// sales /////////////////////////////////////////////////
  public function sales_list()
  {

    $data = $this->login_details();
    $data['pagename'] = "All Sales List";
    if (!empty($this->input->post('from_date'))) {
      $data['from_date'] = $this->input->post('from_date');
    } else {
      $data['from_date'] = date('Y-m-d');
    }
    if (!empty($this->input->post('to_date'))) {
      $data['to_date'] = $this->input->post('to_date');
    } else {
      $data['to_date'] = date('Y-m-d');
    }
    if (!empty($this->input->post('Excel'))) {
      $this->excelForsales($data['from_date'], $data['to_date']);
    }
    $data['dept'] = 2;
    $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc($data['dept']);
    $data['sales_value'] = $this->Main_model->get_sales_list($data['from_date'], $data['to_date']);
    $this->load->view('sales_list', $data);
  }

  public function add_sales()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Sales Details";
    } else {
      $data['pagename'] = "Add New Sales";
    }
    $data['dept'] = 2;
    $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc($data['dept']);
    $data['products'] = $this->Setup_model->get_Active_product(null, 2, 1);
    $data['user_lst'] = $this->Main_model->get_ticket_selectedList();
    $data['edit_value'] = $this->Main_model->get_sales_dtl($data['id']);

    $this->load->view('add_sales', $data);
  }

  public function insert_sales()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_sales()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Sale has been added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Sale data Updated Successfully'
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

  public function update_salesrefund()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_salesrefund()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Refund has been successfully!'
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

  public function delete_sales()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_sales()) {

        $info = array(
          'status' => 'success',
          'message' => 'Sales Has been Deleted successfully!'
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

  public function excelForsales($from_date, $to_date)
  {

    $allreportdata  = $this->Main_model->get_sales_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {
      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_sales_no;
      $subArray[] = date('d-m-Y', strtotime($key->m_sales_date));
      $subArray[] = $key->m_cust_name;
      $subArray[] = $key->m_sales_Ttextable;
      $subArray[] = $key->m_sales_prodid;
      $subArray[] = $key->m_sales_Tqty;
      $subArray[] = 0;
      $subArray[] = 0;
      $subArray[] = 0;
      $subArray[] = 0;
      $subArray[] = 0;
      $subArray[] = $key->m_sales_netAmt;
      $subArray[] = $key->m_sales_netAmt;
      $subArray[] = $key->m_sales_remark;

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'sales_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "Sno",
      "Vno",
      "Dated",
      "Party",
      "Products",
      "Quantity",
      "Total_Taxable",
      "Total_SGST",
      "Total_CGST",
      "Total_IGST",
      "Total_Cess",
      "Total_Tax",
      "RoundUp",
      "NetAmount",
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

  /////////////////////////////////////////// sales /////////////////////////////////////////////////




  /////////////////////////////////////////// plot /////////////////////////////////////////////////

  public function plot_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Plot List";
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
      $this->excelForplot($data['from_date'], $data['to_date']);
    }

    $data['plot_value'] = $this->Main_model->get_plot_list($data['from_date'], $data['to_date']);
    $this->load->view('plots_list', $data);
  }

  public function add_plot()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Plot Details";
    } else {
      $data['pagename'] = "Add New Plot";
    }

    $data['city_dtl'] = $this->Master_model->get_active_city();
    $data['get_active_state'] = $this->Master_model->get_active_state();
    $data['edit_value'] = $this->Main_model->get_plot_dtl($data['id']);
    $data['edit_mem'] = $this->Main_model->get_plotmem_dtl($data['id']);

    $this->load->view('add_plots', $data);
  }

  public function insert_plot()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_plot()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Plot has been booked successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Plot data Updated Successfully'
          );
        } else if ($data == 3) {
          $info = array(
            'status' => 'error',
            'message' => 'Plot No and Plot Type already Registered ! Please check again!'
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



  public function delete_plot()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_plot()) {

        $info = array(
          'status' => 'success',
          'message' => 'Plot Has been Deleted successfully!'
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

  public function plot_membership_cancel()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->plot_membership_cancel()) {

        $info = array(
          'status' => 'success',
          'message' => 'Plot Member Has been Canceled successfully!'
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

  public function reactive_plot()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->reactive_plot()) {

        $info = array(
          'status' => 'success',
          'message' => 'Plot Member Has been Active successfully!'
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

  public function excelForplot($from_date, $to_date)
  {

    $allreportdata  = $this->Main_model->get_plot_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {

      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_plot_no;
      $subArray[] = $key->m_plot_name;
      $subArray[] = $key->m_city_name;
      $subArray[] = $key->m_plot_mobile;
      $subArray[] = $this->Main_model->get_plotmem_count($key->m_plot_id);
      $subArray[] = $key->reg_paper_rcvd == 1 ? 'Yes' : 'No ';;
      $subArray[] =  $key->is_adhar_rcvd == 1 ? 'Yes' : 'No ';
      $subArray[] =  $key->m_plot_aadhar_no;
      $subArray[] =  $key->m_plot_remark;

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'plot_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "SN",
      "PlotNo",
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


  /////////////////////////////////////////// plot /////////////////////////////////////////////////


  public function view_shop_dtl()
  {
    $data = $this->login_details();
    $data['pagename'] = "Prospect Details";
    $data['id'] = $this->input->get('id');
    $data['edit_value'] = $this->Main_model->get_ticket_dtl($data['id']);

    $data['frontFacing'] = $this->Main_model->get_frontFacing_img($data['id']);
    $data['billingConter'] = $this->Main_model->get_billingConter_img($data['id']);
    $data['instore'] = $this->Main_model->get_instore_img($data['id']);
    $data['proposedLocation'] = $this->Main_model->get_proposedLocation_img($data['id']);

    $this->load->view('view_shop_details', $data);
  }

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
