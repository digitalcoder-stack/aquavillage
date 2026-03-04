<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Setup extends CI_Controller
{


  //-------------------------- accparent ------------------------//
  public function accparent_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Acc Parent List";
    $data['id'] = $this->input->get('id');
    $data['all_value'] = $this->Setup_model->get_all_accparent();
    $data['edit_value'] = $this->Setup_model->get_edit_accparent($data['id']);

    $this->load->view('s_accparent_list', $data);
  }

  public function insert_accparent()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_accparent()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Parent has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Parent Updated Successfully'
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

  public function delete_accparent()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->delete_accparent()) {
        $info = array(
          'status' => 'success',
          'message' => 'Parent has been Deleted successfully!'
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
  //-------------------------- accparent ------------------------//

  //-------------------------- accgroup ------------------------//
  public function accgroup_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "AccGroup List";
    $data['id'] = $this->input->get('id');
    $data['accparent'] = $this->Setup_model->get_active_accparent();
    $data['all_value'] = $this->Setup_model->get_all_accgroup();
    $data['edit_value'] = $this->Setup_model->get_edit_accgroup($data['id']);

    $this->load->view('s_accgroup_list', $data);
  }

  public function insert_accgroup()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_accgroup()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'AccGroup has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'AccGroup Updated Successfully'
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

  public function delete_accgroup()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->delete_accgroup()) {
        $info = array(
          'status' => 'success',
          'message' => 'AccGroup has been Deleted successfully!'
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
  //-------------------------- accgroup ------------------------//

  //-------------------------- account ------------------------//
  public function account_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Accounts List";
    $data['id'] = $this->input->get('id');
    $data['accgroup'] = $this->Setup_model->get_active_accgroup();
    $data['all_value'] = $this->Setup_model->get_all_account();
    $data['edit_value'] = $this->Setup_model->get_edit_account($data['id']);

    $this->load->view('s_accounts_list', $data);
  }

  public function insert_account()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_account()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Account has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Account Updated Successfully'
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

  public function delete_account()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->delete_account()) {
        $info = array(
          'status' => 'success',
          'message' => 'Account has been Deleted successfully!'
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
  //-------------------------- account ------------------------//

  //-------------------------- Company ------------------------//
  public function company_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Company List";
    $data['id'] = $this->input->get('id');
    $data['account_list'] = $this->Setup_model->get_active_account();
    $data['city_dtl'] = $this->Master_model->get_active_city();
    $data['all_value'] = $this->Setup_model->get_all_company();
    $data['edit_value'] = $this->Setup_model->get_edit_company($data['id']);

    $this->load->view('s_company_list', $data);
  }

  public function insert_company()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_company()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Company has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Company Updated Successfully'
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

  public function delete_company()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->delete_company()) {
        $info = array(
          'status' => 'success',
          'message' => 'Company has been Deleted successfully!'
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
  //-------------------------- Company ------------------------//

  //-------------------------- godown ------------------------//
  public function godown_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Godowns List";
    $data['id'] = $this->input->get('id');
    $data['company_list'] = $this->Setup_model->get_active_company();
    $data['dept_list'] = $this->Hr_model->get_active_dept();
    $data['all_value'] = $this->Setup_model->get_all_godown();
    $data['edit_value'] = $this->Setup_model->get_edit_godown($data['id']);

    $this->load->view('s_godown_list', $data);
  }

  public function insert_godown()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_godown()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Godown has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Godown Updated Successfully'
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

  public function delete_godown()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->delete_godown()) {
        $info = array(
          'status' => 'success',
          'message' => 'Godown has been Deleted successfully!'
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
  //-------------------------- godown ------------------------//

  //-------------------------- asset ------------------------//
  public function asset_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Assets List";
    $data['id'] = $this->input->get('id');
    $data['godown_list'] = $this->Setup_model->get_active_godown();
    $data['all_value'] = $this->Setup_model->get_all_asset();
    $data['edit_value'] = $this->Setup_model->get_edit_asset($data['id']);

    $this->load->view('s_asset_list', $data);
  }

  public function insert_asset()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_asset()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Asset has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Asset Updated Successfully'
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

  public function delete_asset()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->delete_asset()) {
        $info = array(
          'status' => 'success',
          'message' => 'Asset has been Deleted successfully!'
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
  //-------------------------- asset ------------------------//



  //=======================================================Supplier=================================================//

  public function supplier_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Suppliers List";
    $data['from_date'] = '';
    $data['to_date'] = '';
    $data['from_date'] = $this->input->post('from_date');
    $data['to_date'] = $this->input->post('to_date');
    $data['mech_value'] = $this->Setup_model->get_supplier_list($data['from_date'], $data['to_date']);
    $this->load->view('supplier_list', $data);
  }
  public function contractor_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Contractor List";
    $data['from_date'] = '';
    $data['to_date'] = '';
    $data['from_date'] = $this->input->post('from_date');
    $data['to_date'] = $this->input->post('to_date');
    $data['mech_value'] = $this->Setup_model->get_contractor_list($data['from_date'], $data['to_date']);
    $this->load->view('contractor_list', $data);
  }
  public function add_supplier()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Suppliers Details";
    } else {
      $data['pagename'] = "Add New Suppliers";
    }
    $data['get_active_state'] = $this->Master_model->get_active_state();
    $data['city_dtl'] = $this->Master_model->get_active_city();
    $data['edit_value'] = $this->Setup_model->get_supplier_dtl($data['id']);

    $this->load->view('add_supplier', $data);
  }

  public function insert_supplier()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_supplier()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Supplier has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Supplier data Updated Successfully'
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

  //   public function view_user_dtl()
  //   {
  //     $data = $this->login_details();
  //     $data['pagename'] = "Supplier Details";
  //     $data['id'] = $this->input->get('id');
  //     $data['edit_value'] = $this->Setup_model->get_supplier_dtl($data['id']);

  //     $this->load->view('view_user_details', $data);
  //   }

  public function delete_supplier()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($this->Setup_model->delete_supplier()) {
        $info = array(
          'status' => 'success',
          'message' => 'Data has been Deleted Successfully!'
        );
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'Some Problem Occured'
        );
      }
      echo json_encode($info);
    }
  }

  //=======================================================Supplier=================================================//


  //-------------------------- prodgroup ------------------------//
  public function prodgroup_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Product Group";
    $data['id'] = $this->input->get('id');
    $data['type'] = 1;
    $data['all_value'] = $this->Setup_model->get_all_prodgroup($data['type']);
    $data['edit_value'] = $this->Setup_model->get_edit_prodgroup($data['id']);

    $this->load->view('s_prodgroup_list', $data);
  }

  public function produnit_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Product Unit List";
    $data['id'] = $this->input->get('id');
    $data['type'] = 2;
    $data['all_value'] = $this->Setup_model->get_all_prodgroup($data['type']);
    $data['edit_value'] = $this->Setup_model->get_edit_prodgroup($data['id']);

    $this->load->view('s_prodgroup_list', $data);
  }

  public function prodsize_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Product Size";
    $data['id'] = $this->input->get('id');
    $data['type'] = 3;
    $data['all_value'] = $this->Setup_model->get_all_prodgroup($data['type']);
    $data['edit_value'] = $this->Setup_model->get_edit_prodgroup($data['id']);

    $this->load->view('s_prodgroup_list', $data);
  }

  public function insert_prodgroup()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_prodgroup()) {

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

  public function delete_prodgroup()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->delete_prodgroup()) {
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
  //-------------------------- prodgroup ------------------------//

  //-------------------------- prodcat ------------------------//
  public function prodcat_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Product Category List";
    $data['id'] = $this->input->get('id');
    $data['type'] = 1;
    $data['all_value'] = $this->Setup_model->get_all_prodcat($data['type']);
    $data['edit_value'] = $this->Setup_model->get_edit_prodcat($data['id']);

    $this->load->view('s_prodcategory_list', $data);
  }

  public function insert_prodcat()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_prodcat()) {

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

  public function delete_prodcat()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->delete_prodcat()) {
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
  //-------------------------- prodcat ------------------------//




  //======================================================= product=================================================//

  public function product_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All products List";
    $data['from_date'] = '';
    $data['to_date'] = '';
    $data['from_date'] = $this->input->post('from_date');
    $data['to_date'] = $this->input->post('to_date');

    if (!empty($this->input->post('Excel'))) {
      $this->excelForproduct($data['from_date'], $data['to_date']);
    }

    $data['product_list'] = $this->Setup_model->get_product_list($data['from_date'], $data['to_date']);
    $this->load->view('s_product_list', $data);
  }

  public function add_product()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit products Details";
    } else {
      $data['pagename'] = "Add New products";
    }
    $data['dept_list'] = $this->Hr_model->get_active_dept();
    // $data['prodgroup_list'] = $this->Setup_model->get_active_prodgroup(1);
    $data['prodcat_list'] = $this->Setup_model->get_active_prodcat(1);
    $data['produnit_list'] = $this->Setup_model->get_active_prodgroup(2);
    $data['edit_value'] = $this->Setup_model->get_product_dtl($data['id']);

    $this->load->view('add_product', $data);
  }

  public function insert_product()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_product()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'product has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'product data Updated Successfully'
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


  public function delete_product()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($this->Setup_model->delete_product()) {
        $info = array(
          'status' => 'success',
          'message' => 'Data has been Deleted Successfully!'
        );
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'Some Problem Occured'
        );
      }
      echo json_encode($info);
    }
  }


  public function excelForproduct($from_date, $to_date)
  {

    $allreportdata  = $this->Setup_model->get_product_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {
      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_product_code;
      $subArray[] = $key->m_product_name;
      $subArray[] = $key->m_product_HSNcode;
      $subArray[] = $key->m_product_GSTgroup;
      $subArray[] = date('d-m-Y h:i', strtotime($key->m_product_added_on));

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'product_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "Sn.",
      "ProductCode",
      "ProductName",
      "HSNCode",
      "GSTGroup",
      "Created on",

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


  //=======================================================product=================================================//


  //-------------------------- band ------------------------//
  public function band_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Bands List";
    $data['id'] = $this->input->get('id');
    $data['bnd_status'] = $this->input->get('bnd_status');
    $data['bnd_colour'] = $this->input->get('bnd_colour');
    $data['bandcolour'] = $this->Hr_model->get_active_hq_type(4);
    $data['all_value'] = $this->Setup_model->get_all_band($data['bnd_status'], $data['bnd_colour']);
    $data['edit_value'] = $this->Setup_model->get_edit_band($data['id']);

    $this->load->view('s_bands_list', $data);
  }

  public function insert_band()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->insert_band()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'band has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'band Updated Successfully'
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

  public function delete_band()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->delete_band()) {
        $info = array(
          'status' => 'success',
          'message' => 'band has been Deleted successfully!'
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
  //-------------------------- band ------------------------//
  //-------------------------- band Maintainance------------------------//
  public function get_bnd_dtl()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $data = $this->Setup_model->get_edit_band($this->input->post('bnd_id'));
    }
    echo json_encode($data);
  }
  public function bands_history()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $from_date = $this->input->post('from_date');
      $to_date = $this->input->post('to_date');
      $bnd_colour = $this->input->post('bnd_colour');
      $bnd_no = $this->input->post('bnd_no');

      $data = $this->Setup_model->get_band_history($from_date, $to_date, $bnd_colour,$bnd_no);
    }
    echo json_encode($data);
  }

  public function add_band_maintainance()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Setup_model->add_band_maintainance()) {
        $info = array(
          'status' => 'success',
          'message' => 'Record has been Added successfully!'
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


  //-------------------------- band Maintainance------------------------//


  public function plans_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Plans List";
    $data['id'] = $this->input->get('id');
    $data['type'] = 2;
    $data['all_value'] = $this->Hr_model->get_hq_type($data['type']);
    $data['edit_value'] = $this->Hr_model->get_edit_hq($data['id']);

    $this->load->view('h_hq_list', $data);
  }

  public function package_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Package List";
    $data['id'] = $this->input->get('id');
    $data['type'] = 3;
    $data['menulist'] = $this->Main_model->get_active_menu();
    $data['all_value'] = $this->Hr_model->get_hq_type($data['type']);
    $data['edit_value'] = $this->Hr_model->get_edit_hq($data['id']);

    $this->load->view('h_hq_list', $data);
  }

  public function band_colour_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "Band Colour List";
    $data['id'] = $this->input->get('id');
    $data['type'] = 4;
    $data['all_value'] = $this->Hr_model->get_hq_type($data['type']);
    $data['edit_value'] = $this->Hr_model->get_edit_hq($data['id']);

    $this->load->view('h_hq_list', $data);
  }

  ////================================ Customer ===============================================////

  public function customer_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Customers List";
    $data['from_date'] = '';
    $data['to_date'] = '';
    $data['from_date'] = $this->input->post('from_date');
    $data['to_date'] = $this->input->post('to_date');

    if (!empty($this->input->post('Excel'))) {
      $this->excelForcustomer($data['from_date'], $data['to_date']);
    }
    $data['mech_value'] = $this->Main_model->get_customer_list($data['from_date'], $data['to_date']);
    $this->load->view('customer_list', $data);
  }

  public function add_customer()
  {
    $data = $this->login_details();
    $data['id'] = $this->input->get('id');
    if (!empty($data['id'])) {
      $data['pagename'] = "Edit Customer Details";
    } else {
      $data['pagename'] = "Add New Customer";
    }
    // $data['design_dtl'] = $this->Master_model->get_active_design();
    $data['get_active_state'] = $this->Master_model->get_active_state();
    $data['city_dtl'] = $this->Master_model->get_active_city();
    $data['edit_value'] = $this->Main_model->get_user_dtl($data['id']);

    $this->load->view('add_customer', $data);
  }

  public function insert_customer()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($data = $this->Main_model->insert_customer()) {

        if ($data == 1) {
          $info = array(
            'status' => 'success',
            'message' => 'Customer has been Added successfully!'
          );
        } else if ($data == 2) {
          $info = array(
            'status' => 'success',
            'message' => 'Customer data Updated Successfully'
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

  public function view_user_dtl()
  {
    $data = $this->login_details();
    $data['pagename'] = "User Details";
    $data['id'] = $this->input->get('id');
    $data['edit_value'] = $this->Main_model->get_user_dtl($data['id']);

    $this->load->view('view_user_details', $data);
  }

  public function delete_customer()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($this->Main_model->delete_customer()) {
        $info = array(
          'status' => 'success',
          'message' => 'Data has been Deleted Successfully!'
        );
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'Some Problem Occured'
        );
      }
      echo json_encode($info);
    }
  }

  public function update_verification()
  {
    if ($this->ajax_login() === false) {
      return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($info = $this->Main_model->update_verification()) {
        $info = array(
          'status' => 'success',
          'message' => 'User data Updated Successfuly'
        );
      } else {
        $info = array(
          'status' => 'error',
          'message' => 'Some Problem Occured'
        );
      }
      echo json_encode($info);
    }
  }

  public function excelForcustomer($from_date, $to_date)
  {

    $allreportdata  = $this->Main_model->get_customer_list($from_date, $to_date);

    $count = 0;
    $data = array();
    foreach ($allreportdata as $key) {
      $count++;
      $subArray = array();

      $subArray[] = $count;
      $subArray[] = $key->m_cust_name;
      $subArray[] = $key->m_cust_mobile;
      $subArray[] = $key->m_cust_email;
      if ($key->m_cust_status == 1) {
        $status = "Active";
      } else {
        $status = "In-Active";
      }
      $subArray[] = $status;
      $subArray[] = date('d-m-Y h:i', strtotime($key->m_cust_added_on));

      $data[] = $subArray;
    }

    //  echo "<pre>" ;   print_r($data) ; die ;
    $fileName = 'cust_list' . date('Y_m_d_h_i_s') . '.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/csv; ");
    $report = $data;
    $file = fopen('php://output', 'w');

    $header = array(
      "Sn.",
      "Name",
      "Mobile No.",
      "Email",
      "Status",
      "Registration Date",

    );
    fputcsv($file, $header);
    foreach ($report as $line) {
      fputcsv($file, $line);
    }
    fclose($file);

    exit;
  }

  ////================================ Customer ===============================================////

  ////================================ User ===============================================////

  //========================/Profile==================admin=====//

  public function users_list()
  {
    $data = $this->login_details();
    $data['pagename'] = "All Users List";
    $data['from_date'] = '';
    $data['to_date'] = '';
    $data['from_date'] = $this->input->post('from_date');
    $data['to_date'] = $this->input->post('to_date');
    $data['user_list'] = $this->Setup_model->get_users_list($data['from_date'], $data['to_date']);
    $this->load->view('users_list', $data);
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

  ////================================ User ===============================================////

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
}
