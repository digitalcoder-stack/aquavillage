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

    public function ticket_comparison_report()
    {
        $data = $this->login_details();
        $data['pagename'] = "Comparison Report";
       
        $first_period  = $this->input->post('first_period') ?? date('Y-m', strtotime('-1 year'));
        $second_period = $this->input->post('second_period') ?? date('Y-m');

        $start1 = $first_period . '-01';
        $end1   = date("Y-m-t", strtotime($start1));

        $start2 = $second_period . '-01';
        $end2   = date("Y-m-t", strtotime($start2));

        $data2025 = $this->Student_model->get_month_ticket_data($start1, $end1);
        $data2026 = $this->Student_model->get_month_ticket_data($start2, $end2);

        /* convert to date index */
        $map1 = [];
        foreach ($data2025 as $row) {
            $map1[$row['date']] = $row;
        }

        $map2 = [];
        foreach ($data2026 as $row) {
            $map2[$row['date']] = $row;
        }

        /* weekday alignment */
        $start1 = new DateTime($start1);
        $end1   = new DateTime($end1);

        $start2 = new DateTime($start2);
        $end2   = new DateTime($end2);

        /* find first matching weekday */
        while ($start1->format('N') != $start2->format('N')) {
            $start2->modify('+1 day');
        }

        $d1 = clone $start1;
        $d2 = clone $start2;

        $monthStart2 = new DateTime($second_period . '-01');

        $report = [];

        while ($d1 <= $end1) {

            $date1 = $d1->format('Y-m-d');
            $date2 = $d2->format('Y-m-d');

            /* wrap month if exceeded */
            if ($d2 > $end2) {
                $d2 = clone $monthStart2;
                $date2 = $d2->format('Y-m-d');
            }

            $r1 = $map1[$date1] ?? ['adult' => 0, 'child' => 0, 'free' => 0, 'person' => 0, 'revenue' => 0];
            $r2 = $map2[$date2] ?? ['adult' => 0, 'child' => 0, 'free' => 0, 'person' => 0, 'revenue' => 0];

            $report[] = [
                'day' => $d1->format('l'),

                'date1' => $date1,
                'adult1' => $r1['adult'],
                'child1' => $r1['child'],
                'free1' => $r1['free'],
                'person1' => $r1['person'],
                'revenue1' => $r1['revenue'],

                'date2' => $date2,
                'adult2' => $r2['adult'],
                'child2' => $r2['child'],
                'free2' => $r2['free'],
                'person2' => $r2['person'],
                'revenue2' => $r2['revenue']
            ];

            $d1->modify('+1 day');
            $d2->modify('+1 day');
        }

        $data['report'] = $report;
        $data['first_period'] = $first_period;
        $data['second_period'] = $second_period;

        $this->load->view('ticket_comparison_report', $data);
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
