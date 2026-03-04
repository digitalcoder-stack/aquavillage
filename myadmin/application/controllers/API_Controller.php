<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class API_Controller extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // Load model
    $this->load->model('API_model');
  }

  public function index()
  {
    echo "Not Found";
  }

  public function check_mobile()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $mobile   = $this->input->post('user_mobile');
      if ($user = $this->API_model->check_mobile($mobile)) {
        $info = array(
          'response' => 'success',
          'message' => 'User exist',
          'user' => $this->API_model->user_details($user[0]->m_emp_id),
        );
      } else {

        $info = array(
          'response' => 'error',
          'message' => 'Does not exists',
          'user' => array()
        );
      }
      echo json_encode($info);
    }
  }
  
  public function user_details()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $user_id = $this->input->post('user_id');
      if ($details = $this->API_model->user_details($user_id)) {
        $info = array(
          'response' => 'success',
          'message' => 'User Details',
          'details' => $details
        );
      } else {
        $info = array(
          'response' => 'error',
          'message' => 'No data found',
          'details' => array()
        );
      }
      echo json_encode($info);
    }
  }
 
  public function user_login()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $mobile   = $this->input->post('user_mobile');
      $password = $this->input->post('user_password');
      $type = $this->input->post('user_type');
      if ($user = $this->API_model->user_login($mobile, $password,$type)) {
        $info = array(
          'response' => 'success',
          'message' => 'Login successfully',
          'user' => $this->API_model->user_details($user[0]->m_emp_id),
        );
      } else {

        $info = array(
          'response' => 'error',
          'message' => 'Some Problem Occured',
          'user' => array()
        );
      }
      echo json_encode($info);
    }
  }

 
 public function get_member_entered_count()
 {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($details = $this->API_model->get_member_entered_count()) {
      $info = array(
        'response' => 'success',
        'count' => $details[0]->memberEntered == null ? 0 : $details[0]->memberEntered,
      );
    } else {
      $info = array(
        'response' => 'error',
        'count' => 0
      );
    }
    echo json_encode($info);
  }
 }

 public function get_ticket_details()
 {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($details = $this->API_model->get_ticket_details()) {
      $info = array(
        'response' => 'success',
        'details' => $details,
      );
    } else {
      $info = array(
        'response' => 'error',
        'details' => array(),
      );
    }
    echo json_encode($info);
  }
 }

 public function get_ticket_details_for_counter()
 {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($details = $this->API_model->get_ticket_details_for_counter()) {
      $info = array(
        'response' => 'success',
        'details' => $details,
      );
    } else {
      $info = array(
        'response' => 'error',
        'details' => array(),
      );
    }
    echo json_encode($info);
  }
 }


public function update_entry_status()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($prospect_id = $this->API_model->update_entry_status()) {
        $info = array(
          'response' => 'success',
          'message' => 'Status Updated successfully',
         
        );
      } else {
        $info = array(
          'response' => 'error',
          'message' => 'No data found',
         
        );
      }
      echo json_encode($info);
    }
}

public function update_remark()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($prospect_id = $this->API_model->update_remark()) {
        $info = array(
          'response' => 'success',
          'message' => 'Remark Updated successfully',
         
        );
      } else {
        $info = array(
          'response' => 'error',
          'message' => 'No data found',
         
        );
      }
      echo json_encode($info);
    }
}

public function booking_ticket()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($prospect_id = $this->API_model->booking_ticket()) {
        $info = array(
          'response' => 'success',
          'message' => 'Ticket Booked successfully',
          // 'prospect_id' => $prospect_id,
        );
      } else {
        $info = array(
          'response' => 'error',
          'message' => 'Something Went Wrong',
          // 'prospect_id' => '',
        );
      }
      echo json_encode($info);
    }
}

public function update_ticket_detail()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($prospect_id = $this->API_model->update_ticket_detail()) {
        $info = array(
          'response' => 'success',
          'message' => 'Ticket Updated successfully',
          // 'prospect_id' => $prospect_id,
        );
      } else {
        $info = array(
          'response' => 'error',
          'message' => 'Something Went Wrong',
          // 'prospect_id' => '',
        );
      }
      echo json_encode($info);
    }
}


public function get_employee_list()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($list = $this->API_model->get_Active_emp()) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}

public function get_ticket_list()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $fromdate = $this->input->post('fromdate')? : date('Y-m-d');
  $todate = $this->input->post('todate')? : date('Y-m-d');

   if ($list = $this->API_model->get_ticket_list($fromdate,$todate)) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}

public function get_saleshead()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($list = $this->API_model->all_active_saleshead()) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}
public function get_cash_accounts()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($list = $this->API_model->get_active_cashacc()) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}
public function get_credit_customer()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($list = $this->API_model->get_credit_customer()) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}

public function get_cities_list()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($list = $this->API_model->get_active_city()) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}

public function insert_city()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $list = $this->API_model->insert_city();
   if ($list == 1) {
     $info = array(
      'response' => 'success',
      'message' => 'City added successfully',
     );
   } else {
     $info = array(
      'response' => 'error',
      'message' => $list,
     );
   }
   echo json_encode($info);
 }
}

public function get_ticket_rates()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($list = $this->API_model->get_ticket_rates()) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}


public function get_source_list()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($list = $this->API_model->get_source_list()) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}

public function get_lead_type()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($list = $this->API_model->get_lead_type()) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}

public function get_design_list()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($list = $this->API_model->get_design_list()) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}

public function get_leadclient_list()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($list = $this->API_model->get_leadclient_list()) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}

public function get_client_dtl()
{
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $client_id   = $this->input->post('m_lclient_id');
   if ($list = $this->API_model->get_client_dtl($client_id)) {
     $info = array(
       'response' => 'success',
       'list' => $list,
     );
   } else {
     $info = array(
       'response' => 'error',
       'list' => array(),
     );
   }
   echo json_encode($info);
 }
}

public function insert_leadclient()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($prospect_id = $this->API_model->insert_leadclient()) {
        $info = array(
          'response' => 'success',
          'message' => 'New Client Added successfully',
          // 'prospect_id' => $prospect_id,
        );
      } else {
        $info = array(
          'response' => 'error',
          'message' => 'Something Went Wrong',
          // 'prospect_id' => '',
        );
      }
      echo json_encode($info);
    }
}

public function insert_client_persons()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($prospect_id = $this->API_model->insert_client_persons()) {
        $info = array(
          'response' => 'success',
          'message' => 'Client Contact Persons Added successfully',
          // 'prospect_id' => $prospect_id,
        );
      } else {
        $info = array(
          'response' => 'error',
          'message' => 'Something Went Wrong',
          // 'prospect_id' => '',
        );
      }
      echo json_encode($info);
    }
}



}
