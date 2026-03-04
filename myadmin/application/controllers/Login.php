<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Login extends CI_Controller
{
  //============================Login===========================//

  //============================Login===========================//
  public function index()
  {
    $data['pagename'] = "Log-in";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $rules = array(
        array('field' => 'login_id',   'label' => 'Login Id',      'rules' => 'trim|required'),
        array('field' => 'login_pass', 'label' => 'Login Password', 'rules' => 'trim|required')
      );
      $this->form_validation->set_rules($rules); //pass the rules array here

      //by default initial load condition
      if ($this->form_validation->run() == FALSE) {
      } else {

        if ($data = $this->Login_model->validate_user()) {
          $usrdata = array(
            'is_user_in' => true,
            'user_id' => $data[0]->m_admin_id,
            'user_type' => $data[0]->m_admin_type,
            'user_dept' => $data[0]->m_admin_branch
          );
          $this->session->set_userdata($usrdata);
          /* $this->User_model->manage_daily_activiy(); */
          redirect('Welcome');
        } else {
          $this->session->set_flashdata('status', '<div class="alert alert-danger"> <strong><i class="fa fa-warning"></i> &nbsp; Some Problem Occurred !...</strong> Please Try Again. </div>');
        }
      }
    }

    $this->load->view('login_page', $data);
  }
  //===========================/Login===========================//

  //===========================/Login===========================//
}
