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
        // Data is rendered via AJAX (ticket_report_ajax). No query needed on initial page load.
        $this->load->view('ticket_reports', $data);
    }

    // ===================== AJAX Endpoint ======================== //
    public function ticket_report_ajax()
    {
        if (!$this->ajax_login())
            return;

        $per_page = 500;
        $from_date = $this->input->post('from_date') ?: date('Y-m-d');
        $to_date = $this->input->post('to_date') ?: date('Y-m-d');
        $type = (int)($this->input->post('type') ?: 2);
        $filed = $this->input->post('filed');
        $fval = $this->input->post('fval');
        $fun = (int)($this->input->post('fun') ?: 1);
        $page = max(1, (int)($this->input->post('page') ?: 1));
        $offset = ($page - 1) * $per_page;

        $logged_user_id = $this->session->userdata('user_id');
        $logged_user_type = $this->session->userdata('user_type');

        if ($fun == 9) {
            $total = $this->Student_model->get_bandwise_ticket_count($from_date, $to_date, $fval);
            $ticket_value = $this->Student_model->get_bandwise_ticket($from_date, $to_date, $type, $fval, $per_page, $offset);
        }
        else {
            $total = $this->Student_model->get_ticket_report_count($from_date, $to_date, $type, $filed, $fval);
            $ticket_value = $this->Student_model->get_ticket_report($from_date, $to_date, $type, $filed, $fval, $per_page, $offset);
        }

        // Build heading meta for the JS to update the heading
        $heading_data = $this->_build_heading($fun, $ticket_value);

        // Pre-render HTML rows
        ob_start();
        if ($type == 1) {
            $this->_render_summary_rows($ticket_value, $fun, $from_date, $to_date, $filed);
        }
        else {
            $this->_render_detail_rows($ticket_value, $logged_user_id, $logged_user_type);
        }
        $html = ob_get_clean();

        // Pre-render footer
        ob_start();
        if ($type == 1) {
            $this->_render_summary_footer($ticket_value);
        }
        else {
            $this->_render_detail_footer($ticket_value);
        }
        $footer_html = ob_get_clean();

        $this->output->set_content_type('application/json');
        echo json_encode([
            'status' => 'ok',
            'html' => $html,
            'footer_html' => $footer_html,
            'total' => (int)$total,
            'page' => $page,
            'per_page' => $per_page,
            'type' => $type,
            'heading_data' => $heading_data,
        ]);
    }
    // ==================== /AJAX Endpoint ======================== //

    // -------------------- Row-render helpers --------------------- //
    private function _build_heading($fun, $ticket_value)
    {
        $heads = [
            1 => ['mainhead' => 'All Tickets', 'subhead' => ''],
            2 => ['mainhead' => 'City Wise', 'subhead' => isset($ticket_value[0]['m_city_name']) ? $ticket_value[0]['m_city_name'] : ''],
            3 => ['mainhead' => 'Ticket Type Wise', 'subhead' => isset($ticket_value[0]['m_saleshead_title']) ? $ticket_value[0]['m_saleshead_title'] : ''],
            4 => ['mainhead' => 'Cash Counter Wise', 'subhead' => isset($ticket_value[0]['m_cashacc_name']) ? $ticket_value[0]['m_cashacc_name'] : ''],
            5 => ['mainhead' => 'Cash Ticket List', 'subhead' => ''],
            6 => ['mainhead' => 'Members Ticket List', 'subhead' => ''],
            7 => ['mainhead' => 'Credit Ticket List', 'subhead' => ''],
            8 => ['mainhead' => 'Payment Method Wise', 'subhead' => isset($ticket_value[0]['paytype']) ? $ticket_value[0]['paytype'] : ''],
            9 => ['mainhead' => 'Band Wise', 'subhead' => isset($ticket_value[0]['m_band_colour']) ? $ticket_value[0]['m_band_colour'] : ''],
        ];
        return isset($heads[$fun]) ? $heads[$fun] : ['mainhead' => '', 'subhead' => ''];
    }

    private function _render_summary_rows($ticket_value, $fun, $from_date, $to_date, $filed)
    {
        if (empty($ticket_value)) {
            echo '<tr><td colspan="7" class="text-center">No records found</td></tr>';
            return;
        }
        $i = 1;
        foreach ($ticket_value as $value) {
            switch ($fun) {
                case 2:
                    $mode = $value['m_city_name'];
                    $mode_id = $value['m_ticket_city'];
                    break;
                case 3:
                    $mode = $value['m_saleshead_title'];
                    $mode_id = $value['m_ticket_head'];
                    break;
                case 4:
                    $mode = $value['m_cashacc_name'];
                    $mode_id = $value['m_ticket_counter'];
                    break;
                case 8:
                    $mode = $value['paytype'];
                    $mode_id = $value['m_ticket_paytype'];
                    break;
                case 9:
                    $mode = $value['m_band_colour'];
                    $mode_id = $value['m_colour_id'];
                    break;
                default:
                    $mode = '';
                    $mode_id = '';
            }
            $href = base_url('Reports/ticket_report?from_date=') . $from_date . '&to_date=' . $to_date . '&fun=' . $fun . '&type=2&filed=' . $filed . '&fval=' . $mode_id;
            echo '<tr onclick="window.location.href=\'' . $href . '\'">';
            echo '<td>' . $i . '</td>';
            echo '<td>' . htmlspecialchars($mode) . '</td>';
            echo '<td>' . $value['total_adult'] . '</td>';
            echo '<td>' . $value['total_child'] . '</td>';
            echo '<td>' . $value['total_free'] . '</td>';
            echo '<td>' . $value['total_person'] . '</td>';
            echo '<td>' . $value['total_netamt'] . '</td>';
            echo '</tr>';
            $i++;
        }
    }

    private function _render_summary_footer($ticket_value)
    {
        $total_adult = $total_child = $total_free = $total_person = $total_amount = 0;
        if (!empty($ticket_value)) {
            foreach ($ticket_value as $v) {
                $total_adult += $v['total_adult'];
                $total_child += $v['total_child'];
                $total_free += $v['total_free'];
                $total_person += $v['total_person'];
                $total_amount += $v['total_netamt'];
            }
        }
        echo '<th colspan="2"></th>';
        echo '<th>' . $total_adult . '</th>';
        echo '<th>' . $total_child . '</th>';
        echo '<th>' . $total_free . '</th>';
        echo '<th>' . $total_person . '</th>';
        echo '<th>' . $total_amount . '</th>';
    }

    private function _render_detail_rows($ticket_value, $logged_user_id, $logged_user_type)
    {
        if (empty($ticket_value)) {
            echo '<tr><td colspan="13" class="text-center">No records found</td></tr>';
            return;
        }
        $i = 1;
        foreach ($ticket_value as $value) {
            $can_edit = ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Edit'));
            $can_delete = ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Delete'));
            echo '<tr>';
            echo '<td>' . $i . '</td>';
            echo '<td>' . date('d-m-Y h:i', strtotime($value['m_ticket_added_on'])) . '</td>';
            echo '<td>' . htmlspecialchars($value['m_ticket_no']) . '</td>';
            echo '<td>' . htmlspecialchars($value['m_ticket_paymode']) . '</td>';
            echo '<td>' . htmlspecialchars($value['m_cust_name'] . ' -' . $value['m_cust_mobile']) . '</td>';
            echo '<td>' . $value['m_ticket_adult'] . '</td>';
            echo '<td>' . $value['m_ticket_child'] . '</td>';
            echo '<td>' . ($value['m_ticket_child'] + $value['m_ticket_adult']) . '</td>';
            echo '<td>' . htmlspecialchars($value['m_city_name']) . '</td>';
            echo '<td>' . htmlspecialchars($value['m_ticket_plot_no']) . '</td>';
            echo '<td>' . htmlspecialchars($value['m_plot_name'] . '- ' . $value['m_plot_type']) . '</td>';
            echo '<td>' . $value['m_ticket_netAmt'] . '</td>';
            echo '<td class="wd-30">';
            if ($can_edit) {
                echo '<a href="' . base_url('Shop/add_ticket?id=') . $value['m_ticket_id'] . '" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>';
            }
            if ($can_delete) {
                echo '<button class="btn btn-danger btn-action delete-ticket" data-value="' . $value['m_ticket_id'] . '" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>';
            }
            echo '</td>';
            echo '</tr>';
            $i++;
        }
    }

    private function _render_detail_footer($ticket_value)
    {
        $total_adult = $total_child = $total_amount = 0;
        if (!empty($ticket_value)) {
            foreach ($ticket_value as $v) {
                $total_adult += $v['m_ticket_adult'];
                $total_child += $v['m_ticket_child'];
                $total_amount += $v['m_ticket_netAmt'];
            }
        }
        echo '<th colspan="5"></th>';
        echo '<th>' . $total_adult . '</th>';
        echo '<th>' . $total_child . '</th>';
        echo '<th>' . ($total_adult + $total_child) . '</th>';
        echo '<th colspan="5"></th>';
    }
    // ------------------- /Row-render helpers --------------------- //

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

        $first_period = $this->input->post('first_period') ?? date('Y-m', strtotime('-1 year'));
        $second_period = $this->input->post('second_period') ?? date('Y-m');

        $start1 = $first_period . '-01';
        $end1 = date("Y-m-t", strtotime($start1));

        $start2 = $second_period . '-01';
        $end2 = date("Y-m-t", strtotime($start2));

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
        $end1 = new DateTime($end1);

        $start2 = new DateTime($start2);
        $end2 = new DateTime($end2);

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
                'day1' => $d1->format('l'),
                'day2' => $d2->format('l'),

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
        }
        else {
            redirect('Login');
        }
    }

    protected function ajax_login($nav_id = '')
    {
        $is_user_in = $this->session->userdata('is_user_in');
        if (isset($is_user_in) || $is_user_in == true) {
            return true;
        }
        else {
            echo json_encode(array('status' => 'error', 'message' => 'You are not Logged in Now!! Please login again.'));
            return false;
        }
    }
//=====================/Login Validation======================//

}
