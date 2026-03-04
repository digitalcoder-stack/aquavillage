<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Profile extends CI_Controller {
//=========================Profile============================//

//=========================Profile==================admin=====//
public function index(){ $data = $this->login_details();

  $data['id'] = $this->input->get('id');
  if (!empty($data['id'])) {
    $data['pagename'] = "Edit User Details";
  } else {
    $data['pagename'] = "Add New User";
  }

  $data['dept_value'] = $this->Hr_model->get_active_dept();
  $data['user_dtl'] = $this->Setup_model->get_user_details($data['id']);

  $this->load->view('profile_admin', $data);
}

public function update_profile()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->update_profile()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'User has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'User data Updated Successfully'
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

public function delete_users()
	{

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if ($data = $this->Setup_model->delete_users()) {
				$info = array(
					'status' => 'success',
					'message' => 'User has been Deleted successfully!'
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

public function insert_userperm($userid)
  {
    $this->db->where('m_userperm_userId',$userid)->delete('master_user_permission_tbl');

    $all_valur =$this->Master_model->all_perm();

    if(!empty($all_valur)){
      foreach ($all_valur as $key ) {
        $insert_data = array(
          "m_userperm_userId"    => $userid,
          "m_userperm_module"    => $key->m_perm_module_slug,
          "m_userperm_submodule"    => $key->m_perm_submodule_slug,
          "m_userperm_permId"    => $key->m_perm_id ,
          "m_userperm_list"    => 1,
          "m_userperm_add"    => 1,
          "m_userperm_edit"    => 1,
          "m_userperm_delete"    => 1,
          "m_userperm_export"    => 1,
          "m_userperm_filter"    => 1,
        
        );
    
          $insert_data["m_userperm_added_on"] = date('Y-m-d H:i:s');
          $this->db->insert('master_user_permission_tbl', $insert_data);
      }
    }
   
     return true;
  }


//========================/Profile==================admin=====//


//=========================Profile==================app=======//
public function app(){ $data = $this->login_details();
  $data['pagename'] = "Profile Application";
  $this->load->view('profile_application', $data);
} 

public function update_app(){ if ($this->ajax_login() === false) { return; }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($data = $this->Student_model->update_app()){
      $info = array( 'status'=>'success',
        'message'=>'Application Details has been Updated successfully!'
      );
    }else{ $info = array( 'status'=>'fail',
        'message'=>'Some problem Occurred!! please try again'
      );
    } echo json_encode($info);
  }
}

public function application_settings(){ $data = $this->login_details();
  $data['pagename'] = "Application Setting";
  $data['pagetype'] = 1;
  $data['app_details'] = $this->Student_model->get_application_settings();
  $data['bandcolour'] = $this->Hr_model->get_active_hq_type(4);
  $this->load->view('application_settings',$data);
} 

public function weekday_settings(){ $data = $this->login_details();
  $data['pagename'] = "WeekDay Setting";
  $data['pagetype'] = 2;
  $data['wde_rate'] = $this->Student_model->get_rate_band_list(1);
  $data['wde_band'] = $this->Student_model->get_rate_band_list(3);
  $data['bandcolour'] = $this->Hr_model->get_active_hq_type(4);
  $this->load->view('application_settings',$data);
} 

public function weekend_settings(){ $data = $this->login_details();
  $data['pagename'] = "WeekEnd Setting";
  $data['pagetype'] = 3;
  $data['wde_rate'] = $this->Student_model->get_rate_band_list(2);
  $data['wde_band'] = $this->Student_model->get_rate_band_list(4);
  $data['bandcolour'] = $this->Hr_model->get_active_hq_type(4);
  $this->load->view('application_settings',$data);
} 

public function update_settings(){
 if ($this->ajax_login() === false) { return; }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($data = $this->Student_model->update_settings()){
      $info = array( 'status'=>'success',
        'message'=>'Application Settings has been update successfully!'
      );
    }else{ $info = array( 'status'=>'error',
        'message'=>'Some problem Occurred!! please try again'
      );
    } echo json_encode($info);
  }
}

public function update_rate_band_settings(){
 if ($this->ajax_login() === false) { return; }
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($data = $this->Student_model->update_rate_band_settings()){
      $info = array( 'status'=>'success',
        'message'=>'Settings has been updated successfully!'
      );
    }else{ $info = array( 'status'=>'error',
        'message'=>'Some problem Occurred!! please try again'
      );
    } echo json_encode($info);
  }
}
//========================/Profile==================app=======//

//==========================Details===========================//
protected function login_details(){ $this->require_login();
  $data['log_user_dtl'] = $this->Login_model->user_details();
  return $data;
}
//=========================/Details===========================//
  
//======================Login Validation======================//
protected function require_login(){
  $is_user_in = $this->session->userdata('is_user_in');
  if(isset($is_user_in) || $is_user_in == true){ return;
  } else { redirect('Login'); }
}

protected function ajax_login($nav_id=''){
  $is_user_in = $this->session->userdata('is_user_in');
  if(isset($is_user_in) || $is_user_in == true){ return true;
  } else { echo json_encode(array( 'status'=>'error', 'message'=>'You are not Logged in Now!! Please login again.')); return false; 
  }
}
//=====================/Login Validation======================//

//========================/Profile============================//
} ?>