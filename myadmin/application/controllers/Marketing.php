<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Marketing extends CI_Controller
{

  //-------------------------- leadtype ------------------------//
  public function leadtype_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Lead Client Type List";
    $data['id'] = $this->input->get('id');
    $data['type'] = 2;
    $data['all_value'] = $this->Hr_model->get_all_leadtype();
    $data['edit_value'] = $this->Hr_model->get_edit_leadst($data['id']);

    $this->load->view('lead_source_type_list', $data);
  }
  public function leadstatus_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Lead Status List";
    $data['id'] = $this->input->get('id');
    $data['type'] = 3;
    $data['all_value'] = $this->Hr_model->get_all_leadstatus();
    $data['edit_value'] = $this->Hr_model->get_edit_leadst($data['id']);

    $this->load->view('lead_source_type_list', $data);
  }

  //-------------------------- leadtype ------------------------//


  //-------------------------- leadsource ------------------------//
  public function leadsource_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Lead Source List";
    $data['id'] = $this->input->get('id');
    $data['type'] = 1;
    $data['all_value'] = $this->Hr_model->get_all_leadsource();
    $data['edit_value'] = $this->Hr_model->get_edit_leadst($data['id']);

    $this->load->view('lead_source_type_list', $data);
  }

  public function insert_leadst()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Hr_model->insert_leadst()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Data has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Data Updated Successfully'
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

  public function delete_leadst()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Hr_model->delete_leadst()) {
        $info = array(
          'status' => 'success',
          'message' => 'Data has been Deleted successfully!'
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
  //-------------------------- leadsource ------------------------//


  /////////////////////////////////////////// leadclient /////////////////////////////////////////////////

  public function leadclient_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All leadclient List";
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
    $data['leadclient_value'] = $this->Hr_model->get_leadclient_list($data['from_date'], $data['to_date']);

    if (!empty($this->input->post('Excel'))) {
      $this->excelForleadclient($data['leadclient_value']);
    }
    $this->load->view('lead_client_list', $data);
  }

  public function add_leadclient()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');

    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Client Details";
    } else {
      $data['pagename'] = "Add New Client";
    }
    $data['leadsource_dtl'] = $this->Hr_model->get_all_leadsource();
    $data['leadtype_dtl'] = $this->Hr_model->get_all_leadtype();
    $data['get_active_state'] = $this->Master_model->get_active_state();
    $data['city_dtl'] = $this->Master_model->get_active_city();
    $data['edit_value'] = $this->Hr_model->get_leadclient_dtl($data['id']);
    $data['edit_mem'] = $this->Hr_model->get_lclientperson_list($data['id']);
    $data['design_value'] = $this->Hr_model->get_active_design();
    // print_r($data['prodsize']); die ;
    $this->load->view('add_lead_client', $data);
  }

  public function insert_leadclient()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Hr_model->insert_leadclient()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'leadclient has been booked successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'leadclient data Updated Successfully'
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



  public function delete_leadclient()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->delete_leadclient()) {

        $info = array(
          'status' => 'success',
          'message' => 'leadclient Has been Deleted successfully!'
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

  public function excelForleadclient($allreportdata)
  {

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {

      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_leadsource_name;
      $subArray[] = $key->m_leadtype_name;
      $subArray[] = $key->m_lclient_name;
      $subArray[] = $key->m_city_name;
      $subArray[] = $key->m_lclient_potential;
      $subArray[] =  $key->m_lclient_remark;
      $subArray[] =  date('d-m-Y', strtotime($key->m_lclient_added_on));
      $subArray[] =  '';

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'leadclient_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "SN",
      "LeadSrc",
      "LeadClientType",
      "ClientName",
      "City",
      "Potential",
      "Remarks",
      "Created On",
      "Created By"

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


  /////////////////////////////////////////// leadclient /////////////////////////////////////////////////




  /////////////////////////////////////////// lead /////////////////////////////////////////////////

  public function lead_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Lead List";
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
    $data['clientsearch'] = $this->input->post('clientsearch');
    $data['planserach'] = $this->input->post('planserach');
    $data['statussearch'] = $this->input->post('statussearch');
    $data['bandcolour'] = $this->Hr_model->get_active_hq_type(4);
    $data['leadclient_dtl'] = $this->Hr_model->get_Active_lclient();
    $data['planlist'] = $this->Hr_model->get_active_hq_type(2);
    $data['leadstatus'] = $this->Hr_model->get_all_leadstatus();

    $data['lead_value'] = $this->Hr_model->get_lead_group($data['from_date'], $data['to_date'],$data['clientsearch'],$data['planserach'],$data['statussearch']);

    // echo '<pre>'; print_r($data['lead_value']); die ;
    if (!empty($this->input->post('Excel'))) {
      $this->excelForlead($data['lead_value']);
    }
    $this->load->view('lead_list', $data);
  }

  public function lead_client_print($lead_id)
  {
    $data = $this->login_details();
    $data['pagename'] = "All Lead List";

    $data['lead_dtl'] = $this->Hr_model->get_lead_dtl($lead_id);
    $data['leadclient_dtl'] = $this->Hr_model->get_leadclient_dtl($data['lead_dtl']->m_lead_clientid);
    $data['meetwith_dtl'] = $this->Hr_model->get_lclientperson_dtl($data['lead_dtl']->m_lead_meetwith);
    $data['instructions_list'] = $this->Master_model->all_instraction_list();
    $this->load->view('lead_client_print', $data);
  }

  public function add_lead($type='',$id='')
  {
    $data = $this->login_details();
    $data['id'] = $id;
    $data['type'] = $type;
    $data['client_id'] = $this->input->get('client_id');

    $data['leadclient_dtl'] = $this->Hr_model->get_Active_lclient();
    $data['menulist'] = $this->Main_model->get_active_menu();
    $data['prolist'] = $this->Hr_model->get_emp_design_list(array(3,4));
    $data['planlist'] = $this->Hr_model->get_active_hq_type(2);
    $data['packagelist'] = $this->Hr_model->get_active_hq_type(3);
    $data['bandcolour'] = $this->Hr_model->get_active_hq_type(4);
    $data['leadstatus'] = $this->Hr_model->get_all_leadstatus();

    $data['edit_value'] = $this->Hr_model->get_lead_dtl($data['id']);

    // echo '<pre>'; print_r($data['edit_value']); die ;
    if (!empty($data['id'])) {
      if($type == 1){
        $data['pagename'] = "Add Followup";
      }else {
        $data['pagename'] = "Edit Lead Details";
      }
     
      $data['client_dtl'] = $this->Hr_model->get_client_dtl($data['edit_value']->m_lead_clientid);
      $data['history'] = $this->Hr_model->get_lead_history($data['edit_value']->m_lead_uno);
    } else {
      if (!empty($data['client_id'])) {
        $data['client_dtl'] = $this->Hr_model->get_client_dtl($data['client_id']);
        // $data['history'] = $this->Hr_model->get_lead_history($data['client_id']);
      }
      $data['pagename'] = "Add New Lead";
     
    }

    $this->load->view('add_lead', $data);
  }

  public function insert_lead()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Hr_model->insert_lead()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Lead has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Lead data Updated Successfully'
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



  public function delete_lead()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Hr_model->delete_lead()) {

        $info = array(
          'status' => 'success',
          'message' => 'Lead Has been Deleted successfully!'
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

  public function delete_blead()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Hr_model->delete_blead()) {

        $info = array(
          'status' => 'success',
          'message' => 'Lead Has been Deleted successfully!'
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

  public function excelForlead($allreportdata)
  {

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {

      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_lclient_name;
      $subArray[] = $key->m_lead_pro;
      $subArray[] = date('d-m-Y', strtotime($key->m_lead_date));
      $subArray[] = date('d-m-Y', strtotime($key->m_lead_followup));
      $subArray[] = $key->m_lead_remark;
      $subArray[] = $key->m_lead_status;


      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'lead_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "SN",
      "Client Name",
      "PRO",
      "Lead Date",
      "Followup Date.",
      "Remarks",
      "Status",

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


  public function get_client_dtl()
  {

    $id = $this->input->post('clientid');
    $data = $this->Hr_model->get_client_dtl($id);
    // echo '<pre>';
    // print_r($data); die;
    echo json_encode($data);
  }

  public function get_lead_history()
  {

    $id = $this->input->post('clientid');
    $data = $this->Hr_model->get_lead_history($id);
    echo json_encode($data);
  }

  // public function get_emp_dtl()
  // {

  //   $id = $this->input->post('empid');
  //   $data= $this->Hr_model->get_emp_dtl($id);
  // 	echo json_encode($data);
  // }

  /////////////////////////////////////////// lead /////////////////////////////////////////////////









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
