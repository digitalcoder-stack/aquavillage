<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Vouchers extends CI_Controller
{


  /////////////////////////////////////////// expense category /////////////////////////////////////////////////
  public function expense_cat_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Expense Category List";
    $data['id'] = $this->input->get('id');
    $data['type'] = 2;
    $data['all_value'] = $this->Setup_model->get_all_prodcat($data['type']);
    $data['edit_value'] = $this->Setup_model->get_edit_prodcat($data['id']);

    $this->load->view('s_prodcategory_list', $data);
  }
  /////////////////////////////////////////// expense category /////////////////////////////////////////////////


  /////////////////////////////////////////// expense /////////////////////////////////////////////////

  public function expense_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Expense List";
    $data['from_date'] = $this->input->post('from_date') ? :date('Y-m-d',strtotime(date('Y-m-d').'- 7 days'));
    $data['to_date'] = $this->input->post('to_date') ? :date('Y-m-d');

    if (!empty($this->input->post('Excel'))) {
      $this->excelForexpense($data['from_date'], $data['to_date']);
    }
    $data['mode'] = 1;
    $data['expense_value'] = $this->Setup_model->get_expense_list($data['from_date'], $data['to_date']);
    $this->load->view('expense_list', $data);
  }

  public function journal_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Voucher List";

    $data['from_date'] = $this->input->post('from_date') ? :date('Y-m-d',strtotime(date('Y-m-d').'- 7 days'));
    $data['to_date'] = $this->input->post('to_date') ? :date('Y-m-d');

    if (!empty($this->input->post('Excel'))) {
      $this->excelForexpense($data['from_date'], $data['to_date']);
    }
    $data['mode'] = 2;
    $data['expense_value'] = $this->Setup_model->get_journal_list($data['from_date'], $data['to_date']);
    $this->load->view('expense_list', $data);
  }

  public function add_expense()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Expense Details";
    } else {
      $data['pagename'] = "Add New Expense";
    }
    $data['mode'] = 1;
    $data['company_list'] = $this->Setup_model->get_active_company();
    $data['expcat_list'] = $this->Setup_model->get_active_prodcat(2);
    $data['casact_list'] = $this->Master_model->get_active_cashacc();
    $data['dept_list'] = $this->Hr_model->get_active_dept();
    $data['emp_list'] = $this->Hr_model->get_Active_emp();
    $data['edit_value'] = $this->Setup_model->get_expense_dtl($data['id']);
    // $data['info_value'] = $this->Setup_model->get_expense_info_dtl($data['id']);
    $this->load->view('add_expense', $data);
  }

  public function add_journal()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Voucher Details";
    } else {
      $data['pagename'] = "Add New Voucher";
    }
    $data['mode'] = 2;
    $data['company_list'] = $this->Setup_model->get_active_company();
    $data['expcat_list'] = $this->Setup_model->get_active_prodcat(2);
    $data['casact_list'] = $this->Master_model->get_active_cashacc();
    $data['dept_list'] = $this->Hr_model->get_active_dept();
    $data['emp_list'] = $this->Hr_model->get_Active_emp();
    $data['edit_value'] = $this->Setup_model->get_expense_dtl($data['id']);
    // $data['info_value'] = $this->Setup_model->get_expense_info_dtl($data['id']);

    $this->load->view('add_expense', $data);
  }

  public function insert_expense()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_expense()) {

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



  public function delete_expense()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->delete_expense()) {

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

  public function excelForexpense($from_date, $to_date)
  {

    $allreportdata  = $this->Main_model->get_expense_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {

      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_expense_no;
      $subArray[] = $key->m_expense_name;
      $subArray[] = $key->m_city_name;
      $subArray[] = $key->m_expense_mobile;
      $subArray[] = $this->Main_model->get_expensemem_count($key->m_expense_id);
      $subArray[] = $key->reg_paper_rcvd == 1 ? 'Yes' : 'No ';;
      $subArray[] =  $key->is_adhar_rcvd == 1 ? 'Yes' : 'No ';
      $subArray[] =  $key->m_expense_aadhar_no;
      $subArray[] =  $key->m_expense_remark;

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'expense_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "SN",
      "expenseNo",
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

  /////////////////////////////////////////// expense /////////////////////////////////////////////////



  /////////////////////////////////////////// payment /////////////////////////////////////////////////

  public function payment_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Payment List";
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
      $this->excelForpayment($data['from_date'], $data['to_date']);
    }
    $data['mode'] = 1;
    $data['payment_value'] = $this->Setup_model->get_payment_list($data['from_date'], $data['to_date']);
    $this->load->view('payment_list', $data);
  }

  public function receipt_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Receipt List";
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
      $this->excelForpayment($data['from_date'], $data['to_date']);
    }
    $data['mode'] = 2;
    $data['payment_value'] = $this->Setup_model->get_receipt_list($data['from_date'], $data['to_date']);
    $this->load->view('payment_list', $data);
  }

  public function add_payment()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Payment Details";
    } else {
      $data['pagename'] = "Add New Payment";
    }
    $data['mode'] = 1;
    $data['company_list'] = $this->Setup_model->get_active_company();
    $data['plot_dtl'] = $this->Main_model->get_Active_plot();
    $data['edit_value'] = $this->Setup_model->get_payment_dtl($data['id']);
    $data['info_value'] = $this->Setup_model->get_payment_info_dtl($data['id']);
    $this->load->view('add_payment', $data);
  }

  public function add_receipt()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Receipt Details";
    } else {
      $data['pagename'] = "Add New Receipt";
    }
    $data['mode'] = 2;
    $data['company_list'] = $this->Setup_model->get_active_company();
    $data['plot_dtl'] = $this->Main_model->get_Active_plot();
    $data['edit_value'] = $this->Setup_model->get_payment_dtl($data['id']);
    $data['info_value'] = $this->Setup_model->get_payment_info_dtl($data['id']);

    $this->load->view('add_payment', $data);
  }

  public function insert_payment()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_payment()) {

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



  public function delete_payment()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->delete_payment()) {

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

  public function excelForpayment($from_date, $to_date)
  {

    $allreportdata  = $this->Main_model->get_payment_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {

      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_payment_no;
      $subArray[] = $key->m_payment_name;
      $subArray[] = $key->m_city_name;
      $subArray[] = $key->m_payment_mobile;
      $subArray[] = $this->Main_model->get_paymentmem_count($key->m_payment_id);
      $subArray[] = $key->reg_paper_rcvd == 1 ? 'Yes' : 'No ';;
      $subArray[] =  $key->is_adhar_rcvd == 1 ? 'Yes' : 'No ';
      $subArray[] =  $key->m_payment_aadhar_no;
      $subArray[] =  $key->m_payment_remark;

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'payment_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "SN",
      "paymentNo",
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

  /////////////////////////////////////////// payment /////////////////////////////////////////////////

  /////////////////////////////////////////// Discount /////////////////////////////////////////////////

    public function discount_list()
    {
        $data = $this->login_details();
        $data['pagename'] = "All Discount List";

        $data['discount_value'] = $this->Setup_model->get_discount_list();
        $this->load->view('discount_list', $data);
    }


    public function add_discount()
    {
        $data = $this->login_details();

        $data['id'] = $this->input->get('code');

        if (!empty($data['id'])) {
            $data['pagename'] = "Edit Discount";
        } else {
            $data['pagename'] = "Add New Discount";
        }

        $data['edit_value'] = $this->Setup_model->get_discount_dtl($data['id']);

        $this->load->view('add_discount', $data);
    }


    public function save_discount()
    {
        if ($this->ajax_login() === false) {
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if ($data = $this->Setup_model->insert_discount()) {

                if ($data == 1) {

                    $info = array(
                        'status' => 'success',
                        'message' => 'Discount added successfully!'
                    );

                } else if ($data == 2) {

                    $info = array(
                        'status' => 'success',
                        'message' => 'Discount updated successfully!'
                    );

                }

            } else {

                $info = array(
                    'status' => 'error',
                    'message' => 'Some problem occurred! Please try again'
                );

            }

            echo json_encode($info);
        }
    }



    public function delete_discount()
    {
        if ($this->ajax_login() === false) {
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if ($this->Setup_model->delete_discount()) {

                $info = array(
                    'status' => 'success',
                    'message' => 'Discount deleted successfully!'
                );

            } else {

                $info = array(
                    'status' => 'error',
                    'message' => 'Some problem occurred!'
                );

            }

            echo json_encode($info);
        }
    }


  /////////////////////////////////////////// Discount /////////////////////////////////////////////////









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
