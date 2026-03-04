<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Reports extends CI_Controller
{

    public function ticket_report()
    {
        $data = $this->login_details();
        $data['pagename'] = "Ticket Report";
        $data['from_date'] = $this->input->get('from_date') ?: date('Y-m-d');
        $data['to_date'] = $this->input->get('to_date') ?: date('Y-m-d');
        $data['type'] = $this->input->get('type') ?: 2;
        $data['filed'] = $this->input->get('filed');
        $data['fval'] = $this->input->get('fval');
        $data['fun'] = $this->input->get('fun') ?: 1;
        if ($data['fun'] == 9) {
            $data['ticket_value'] = $this->Student_model->get_bandwise_ticket($data['from_date'], $data['to_date'], $data['type'], $data['fval']);
        } else {
            $data['ticket_value'] = $this->Student_model->get_ticket_report($data['from_date'], $data['to_date'], $data['type'], $data['filed'], $data['fval']);
        }

        // echo'<pre>';print_r($data['ticket_value']); die;
        $this->load->view('ticket_reports', $data);
    }

    public function stock_report()
    {
        $data = $this->login_details();
        $data['pagename'] = "Stock Report";
        $data['from_date'] = $this->input->get('from_date') ?: date('Y-m-d');
        $data['to_date'] = $this->input->get('to_date') ?: date('Y-m-d');
        $data['godown'] = $this->input->get('godown') ?: "o";
        $data['prod'] = $this->input->get('prod') ?: "";
        $data['dept'] = $this->input->get('dept');

        $data['type'] = $this->input->get('type');


        $data['all_data'] = $this->Student_model->get_stock_report($data['from_date'], $data['to_date'], $data['dept'], $data['prod'], $data['type']);
        $data['dept_list'] = $this->Hr_model->get_active_dept();
        $data['godown_dtl'] = $this->Setup_model->get_active_godown(null, $data['dept']);
        $data['products'] = $this->Setup_model->get_Active_product(null, $data['dept'], $data['type']);

        // echo'<pre>';print_r($data['ticket_value']); die;
        $this->load->view('stock_report', $data);
    }

    public function monthly_report()
    {
        $data = $this->login_details();
        $data['pagename'] = "Monthly Report";
        $data['month_in'] = $this->input->get('month_in') ?: date('Y-m');
        $data['all_data'] = $this->Student_model->get_monthly_report($data['month_in']);

        // echo'<pre>';print_r($data['ticket_value']); die;
        $this->load->view('monthly_report', $data);
    }

    public function get_bands_stock_detail()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $from = $this->input->post('from') ?: date('Y-m-d');
            $to = $this->input->post('to') ?: date('Y-m-d');
            $color = $this->input->post('color');
            $data = $this->Student_model->get_bands_stock_detail($color, $from, $to);
            echo json_encode($data);
        }
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
