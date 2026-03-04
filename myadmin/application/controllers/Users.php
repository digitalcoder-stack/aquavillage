<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Users extends CI_Controller
{


  public function vendor_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Vendor Details";
    //echo "<pre>";print_r($data['all_value']);die();
    $data['mech_value'] = $this->Student_model->get_vendor_dtl_list();
    $this->load->view('vendor_dlt', $data);
  }
  public function add_vendor_dlt()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Vendor Details";
    } else {
      $data['pagename'] = "Add Vendor Details";
    }
    $data['get_active_state'] = $this->Master_model->get_active_state();
    $data['city_dtl'] = $this->Main_model->get_all_city_list();
    $data['edit_value'] = $this->Student_model->get_vendor_dtl($data['id']);

    //  print_r($data['edit_value']);die();
    $this->load->view('add_vendor', $data);
  }

  public function insert_vendors_dtl()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Student_model->insert_vendors_dtl()) {
        $info = array(
          'status' => 'success',
          'message' => 'Vendor  has been Added successfully!'
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

  public function view_vendor_dtl()
  {
    $data = $this->login_details();
    $data['pagename'] = "Vendor Details";
    $data['id'] = $this->input->get('id');
    $data['edit_value'] = $this->Student_model->get_vendor_dtl($data['id']);

    $this->load->view('view_vendor', $data);
  }

  public function delete_vendor_dtl()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($info = $this->Student_model->delete_vendor_dtl()) {
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'Some Problem Occured'
        );
      }
      echo json_encode($info);
    }
  }

////================================ Customer ===============================================////




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
