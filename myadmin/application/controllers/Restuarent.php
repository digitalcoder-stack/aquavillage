<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Restuarent extends CI_Controller
{





  //-------------------------- menugroup ------------------------//
  public function menugroup_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Group Menu List";
    $data['id'] = $this->input->get('id');
    $data['all_value'] = $this->Main_model->get_all_menugroup();
    $data['edit_value'] = $this->Main_model->get_edit_menugroup($data['id']);

    $this->load->view('r_menugroup_list', $data);
  }

  public function insert_menugroup()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_menugroup()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Group Menu has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Group Menu Updated Successfully'
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

  public function delete_menugroup()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_menugroup()) {
        $info = array(
          'status' => 'success',
          'message' => 'Group Menu has been Deleted successfully!'
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
  //-------------------------- menugroup ------------------------//

  //-------------------------- menu ------------------------//
  public function menu_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Menu List";
    $data['id'] = $this->input->get('id');
    $data['menugroup_dtl'] = $this->Main_model->get_active_menugroup();
    $data['produnit_dtl'] = $this->Setup_model->get_active_prodgroup(2);
    $data['all_value'] = $this->Main_model->get_all_menu();
    $data['edit_value'] = $this->Main_model->get_edit_menu($data['id']);

    $this->load->view('r_menu_list', $data);
  }

  public function insert_menu()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_menu()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Menu has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Menu Updated Successfully'
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

  public function delete_menu()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_menu()) {
        $info = array(
          'status' => 'success',
          'message' => 'Menu has been Deleted successfully!'
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
  //-------------------------- menu ------------------------//

  //////========================== Resort entries ==========================/////////

  public function resort_data_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Resort Entries";
    $data['pagtype'] = 1;
    $data['from_date'] = $this->input->post('from_date') ?: date('Y-m-d');
    $data['to_date'] = $this->input->post('to_date') ?: date('Y-m-d');
    if ($this->input->post('status') == 'o') {
      $data['status'] = '';
    } else {
      $data['status'] = $this->input->post('status') ?: 1;
    }

    // if (!empty($this->input->post('Excel'))) {
    //   $this->excelForresort($data['from_date'], $data['to_date'], $data['status']);
    // }

    $data['resort_value'] = $this->Main_model->get_resort_data_list($data['pagtype'], $data['from_date'], $data['to_date'], $data['status']);

    $this->load->view('resort_data_list', $data);
  }

  public function camps_data_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Camp Entries";

    $data['pagtype'] = 2;
    $data['from_date'] = $this->input->post('from_date') ?: date('Y-m-d');
    $data['to_date'] = $this->input->post('to_date') ?: date('Y-m-d');
    if ($this->input->post('status') == 'o') {
      $data['status'] = '';
    } else {
      $data['status'] = $this->input->post('status') ?: 1;
    }

    $data['resort_value'] = $this->Main_model->get_resort_data_list($data['pagtype'], $data['from_date'], $data['to_date'], $data['status']);

    $this->load->view('resort_data_list', $data);
  }



  public function add_resort_data($pagtype = 1)
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = $pagtype == 1 ? "Edit Resort Data" : "Edit Camp Data";
    } else {
      $data['pagename'] = $pagtype == 1 ? "Add Resort Entry" : "Add Camp Entry";
    }
    $data['dept'] = $pagtype == 1 ? 6 : 10;
    
    $data['pagtype'] = $pagtype;
    $data['emp_list'] = $this->Hr_model->get_Active_emp();
    $data['get_active_state'] = $this->Master_model->get_active_state();
    $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc($data['dept']);
    $data['city_dtl'] = $this->Master_model->get_active_city();
    $data['edit_value'] = $this->Main_model->get_resort_data_dtl($data['id']);
    $this->load->view('add_resort_data', $data);
  }

  public function insert_resort_data()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_resort_data()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Data has been added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Data Updated Successfully'
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

  public function delete_resort_data()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_resort_data()) {

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

  public function update_checkout_status()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->update_checkout_status()) {

        redirect($_SERVER['HTTP_REFERER']);
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'Some problem Occurred!! please try again'
        );
      }
    }
  }


  //////========================== Resort entries ==========================/////////
  //////========================== food court entries ==========================/////////

  public function foodcourt_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Food Court Entries";
    $data['from_date'] = $this->input->post('from_date') ?: date('Y-m-d');
    $data['to_date'] = $this->input->post('to_date') ?: date('Y-m-d');
    $data['itemid'] = $this->input->post('itemid');

    $data['all_data'] = $this->Main_model->get_foodcourt_list($data['from_date'], $data['to_date'], $data['itemid']);
// echo '<pre>' ; print_r( $data['all_data']); die ;
    $this->load->view('r_foodcourt_list', $data);
  }


  public function add_foodcourt()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Food Data";
    } else {
      $data['pagename'] = "Add Food Data";
    }
    $data['dept'] = 5;
    $data['emp_list'] = $this->Hr_model->get_Active_emp();
    $data['menulist'] = $this->Main_model->get_active_menu();
    $data['cashcot_dtl'] = $this->Master_model->get_active_cashacc($data['dept']);
    $data['edit_value'] = $this->Main_model->get_foodcourt_dtl($data['id']);
    // echo '<pre>' ; print_r($data['edit_value']); die ;
    $this->load->view('add_foodcourt', $data);
  }

  public function insert_foodcourt()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_foodcourt()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Data has been added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Data Updated Successfully'
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

  public function delete_foodcourt()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_foodcourt()) {

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


  //////========================== Food Court ==========================/////////



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
