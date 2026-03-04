<?php defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');

class Welcome extends CI_Controller
{

  //=========================Welcome============================//



  //=========================Welcome============================//

  public function index()
  {
    $data = $this->login_details();

    $data['pagename'] = "Dashboard";

    $data['from_date'] = $this->input->post('from_date') ?: date('Y-m-d');
    $data['to_date'] = $this->input->post('to_date') ?: date('Y-m-d');
    $data['type'] = $this->input->get('type') ?: 4;

    if ($data['type'] == 1) {
      $data['all_ticket_count'] = $this->Student_model->day_report_ticket($data['to_date']);
      $data['all_locker_count'] = $this->Student_model->day_report_locker($data['to_date']);
      $data['all_costume_count'] = $this->Student_model->day_report_costume($data['to_date']);
      $data['locker_available'] = $this->Student_model->locker_available();
    } else if ($data['type'] == 2) {

      $data['all_in_out'] = $this->Student_model->day_report_all($data['to_date'], $data['from_date']);
    } else if ($data['type'] == 3) {
      $data['in_out_detail'] = $this->Student_model->day_report_detail($data['to_date'], $data['from_date']);
    } else if ($data['type'] == 4) {
      $data['tik_data'] = $this->Student_model->ticketing_detail_report($data['to_date'], $data['to_date']);
      $data['cos_data'] = $this->Student_model->Costume_details_report($data['to_date'], $data['to_date']);
      $data['repot_data'] = $this->Student_model->dash_report_data($data['to_date']);
      $data['report_list_data'] = $this->Student_model->report_listing_data($data['to_date']);

      // echo "<pre>";
      // print_r($data['report_data']);
      // die;
    }


    $this->load->view('dashboard', $data);
  }

  public function ticket_band_report($date)
  {
    $data = $this->login_details();
    $data['date'] = $date;
    $data['pagename'] = "Ticket Detailed Report";
    $dept_id = 3;
    $data['resort_data'] = $this->Main_model->get_resort_data_list(null,$data['date'],$data['date']);
    $data['report_list_data'] = $this->Student_model->report_listing_data($data['date'],$dept_id);
    $data['tik_data'] = $this->Student_model->ticketing_detail_report($data['date'], $data['date']);
    $data['lead_tickets'] = $this->Student_model->get_lead_tickets($data['date'], $data['date']);

    //  echo "<pre>";
    //   print_r($data['resort_data']);
    //   die;

    $this->load->view('ticket_band_report', $data);
  }

  public function upload_capture_image()
  {

    if (isset($_POST['image'])) {
      // Get the data URL and decode it
      $data = $_POST['image'];
      $data = str_replace('data:image/png;base64,', '', $data);
      $data = str_replace(' ', '+', $data);
      $decodedData = base64_decode($data);

      // Generate a unique filename
      $filename = date('ymdhis') . '.png';
      $image_path = 'uploads/capure_images/' . $filename;
      // Save the decoded image data to the server
      file_put_contents($image_path, $decodedData);
      // Return a response to the client
      $response = ['status' => 'success', 'message' => 'Image uploaded successfully', 'filename' => $filename];
      echo json_encode($response);
    } else {
      // Return an error response if no image data is received
      $response = ['status' => 'error', 'message' => 'No image data received'];
      echo json_encode($response);
    }
  }

  public function costume_department_report($date)
  {
    $data = $this->login_details();
    $data['date'] = $date;
    $dept_id = 2;
    $data['pagename'] = "Costume Detailed Report";
    $data['cos_data'] = $this->Student_model->Costume_details_report($data['date'], $data['date']);
    $data['report_list_data'] = $this->Student_model->report_listing_data($data['date'],$dept_id);
    // echo "<pre>";
    //   print_r($data['cos_data']);
    //   die;
    $this->load->view('costume_department_report', $data);
  }

  function insert_dayreport_data()
  {
    if ($this->ajax_login() === false) {
      return;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Student_model->insert_dayreport_data()) {
        $info = array(
          'status' => 'success',
          'message' => 'Data Updated Successfully'
        );
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'Some problem Occurred!! please try again'
        );
      }

      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  //=========================/Welcome===========================//

  public function db_backup()
  {
    $this->load->helper('url');
    $this->load->helper('file');
    $this->load->helper('download');
    $this->load->library('zip');
    $this->load->dbutil();
    $db_format = array(
      'format' => 'zip',
      'filename' => 'sql_backup.sql'
    );
    $backup = &$this->dbutil->backup($db_format);
    $dbname = 'aquavilage_db_backup-' . date('YmdHi') . '.zip';
    $save = base_url('assets/database_backup/') . $dbname;
    write_file($save, $backup);
    force_download($dbname, $backup);
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



  protected function ajax_login()
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



  //=========================/Welcome===========================//

}
