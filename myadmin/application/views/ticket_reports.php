<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id');
$logged_user_type = $this->session->userdata('user_type');
?>
<div class="page-content">
    <div class="container-fluid">
        <style type="text/css">
            .d-flex {
                display: flex;
                align-items: center;
            }

            .jbfrm input[type=radio] {
                width: 27px;
                height: 17px;
                margin: 0px;
                background: none;
                box-shadow: none;
                transition: 0.5s;
            }

            .space-around {
                justify-content: space-around;
            }

            .space-around input[type=checkbox] {
                margin: 0px 0px 0px;
                transition: 0.5s;
                width: 20px;
                height: 18px;
            }

            .space-around input[type=checkbox]:focus {
                outline: none !important;
                transform: scale(1.2);
            }

            .jbfrm input[type=radio]:focus {
                outline: none !important;
                transform: scale(1.2);
            }

            .btn-vsm {
                position: relative;
            }

            .btn-vsm span {
                border-radius: 50%;
                background-color: red;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: -5px;
                right: -5px;
                line-height: 10px;
                font-size: 10px;
                width: 15px;
                height: 15px;
            }
        </style>

        <div class="row">

            <div class="col-md-10">
                <div class="page-box">
                    <?php switch ($fun) {
                        case 1: {
                                $mainhead = 'All Tickets';
                                $subhead = '';
                            }
                            break;
                        case 2: {
                                $mainhead = 'City Wise';
                                $subhead = $ticket_value[0]['m_city_name'];
                            }
                            break;
                        case 3: {
                                $mainhead = 'Ticket Type Wise';
                                $subhead = $ticket_value[0]['m_saleshead_title'];
                            }
                            break;
                        case 4: {
                                $mainhead = 'Cash Counter Wise';
                                $subhead = $ticket_value[0]['m_cashacc_name'];
                            }
                            break;
                        case 5: {
                                $mainhead = 'Cash Ticket List';
                                $subhead = '';
                            }
                            break;
                        case 6: {
                                $mainhead = 'Members Ticket List';
                                $subhead = '';
                            }
                            break;
                        case 7: {
                                $mainhead = 'Credit Ticket List';
                                $subhead = '';
                            }
                            break;
                        case 8: {
                                $mainhead = 'Payment Method Wise';
                                $subhead = $ticket_value[0]['paytype'];
                            }
                            break;
                        case 9: {
                                $mainhead = 'Band Wise';
                                $subhead = $ticket_value[0]['m_band_colour'];
                            }
                            break;
                    }  ?>
                    <div class="seipkon-breadcromb-left">
                        <h3><?= $type == 1 ? $mainhead : $mainhead . ' - ' . $subhead; ?></h3>
                        <hr style="margin-top: 0px; border-top: 2px solid #dee2e6;">
                    </div>

                    <div class="advance-table table-overflow">
                        <?php if ($type == 1) { ?>
                            <table id="ticket_tbl" class="my_custom_datatable table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sno.</th>
                                        <th>Mode</th>
                                        <th>Total Family</th>
                                        <th>Total Stag</th>
                                        <th>Total Free</th>
                                        <th>Total Person</th>
                                        <th>Total Amount</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;

                                    $total_free = 0;
                                    $total_person = 0;
                                    $total_child = 0;
                                    $total_adult = 0;
                                    $total_amount = 0;
                                    if (!empty($ticket_value)) {

                                        foreach ($ticket_value as $value) {

                                            $total_adult += $value['total_adult'];
                                            $total_child += $value['total_child'];
                                            $total_person += $value['total_person'];
                                            $total_free += $value['total_free'];
                                            $total_amount += $value['total_netamt'];

                                            switch ($fun) {
                                                case 2: {
                                                        $mode = $value['m_city_name'];
                                                        $mode_id = $value['m_ticket_city'];
                                                    }
                                                    break;
                                                case 3: {
                                                        $mode = $value['m_saleshead_title'];
                                                        $mode_id = $value['m_ticket_head'];
                                                    }
                                                    break;
                                                case 4: {
                                                        $mode = $value['m_cashacc_name'];
                                                        $mode_id = $value['m_ticket_counter'];
                                                    }
                                                    break;
                                                case 8: {
                                                        $mode = $value['paytype'];
                                                        $mode_id = $value['m_ticket_paytype'];
                                                    }
                                                    break;
                                                case 9: {
                                                        $mode = $value['m_band_colour'];
                                                        $mode_id = $value['m_colour_id'];
                                                    }
                                                    break;
                                            }

                                    ?>
                                            <tr onclick="window.location.href = '<?= base_url('Reports/ticket_report?from_date=') . $from_date . '&to_date=' . $to_date . '&fun=' . $fun . '&type=2&filed=' . $filed . '&fval=' . $mode_id ?>'">
                                                <td><?= $i; ?></td>
                                                <td><?= $mode; ?></td>
                                                <td><?= $value['total_adult']; ?></td>
                                                <td><?= $value['total_child']; ?></td>
                                                <td><?= $value['total_free']; ?></td>
                                                <td><?= $value['total_person']; ?></td>
                                                <td><?= $value['total_netamt']; ?></td>

                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th colspan="2"></th>
                                    <th><?= $total_adult ?></th>
                                    <th><?= $total_child ?></th>
                                    <th><?= $total_free ?></th>
                                    <th><?= $total_person ?></th>
                                    <th><?= $total_amount ?></th>

                                </tfoot>

                            </table>
                        <?php }
                        if ($type == 2) { ?>
                            <table id="ticket_detail_tbl" class="my_custom_datatable table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sno.</th>
                                        <th>Dated</th>
                                        <th>Ticket No</th>
                                        <th>Mode</th>
                                        <th>CustomerName</th>
                                        <th>Family</th>
                                        <th>Stag</th>
                                        <th>Total</th>
                                        <th>City</th>
                                        <th>PlotNo</th>
                                        <th>PlotOwner</th>
                                        <th>NetAmount</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;

                                    $total_child = 0;
                                    $total_adult = 0;
                                    $total_amount = 0;
                                    if (!empty($ticket_value)) {

                                        foreach ($ticket_value as $value) {

                                            $total_adult += $value['m_ticket_adult'];
                                            $total_child += $value['m_ticket_child'];
                                            $total_amount += $value['m_ticket_netAmt'];
                                    ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= date('d-m-Y h:i', strtotime($value['m_ticket_added_on'])); ?></td>

                                                <td><?= $value['m_ticket_no']; ?></td>
                                                <td><?= $value['m_ticket_paymode']; ?></td>
                                                <td><?= $value['m_cust_name'] . ' -' . $value['m_cust_mobile']; ?></td>
                                                <td><?= $value['m_ticket_adult']; ?></td>
                                                <td><?= $value['m_ticket_child']; ?></td>
                                                <td><?= ($value['m_ticket_child'] + $value['m_ticket_adult']); ?></td>

                                                <td><?= $value['m_city_name']; ?></td>
                                                <td><?= $value['m_ticket_plot_no']; ?></td>
                                                <td><?= $value['m_plot_name'] . '- ' . $value['m_plot_type'] ?></td>
                                                <td><?= $value['m_ticket_netAmt']; ?></td>

                                                <td class="wd-30">
                                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Edit')) { ?>
                                                        <!-- <a href="<?php echo base_url('Shop/view_shop_dtl?id=') . $value['m_costume_id']; ?>" class="btn btn-info btn-action" title="View" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                                        <a href="<?php echo base_url('Shop/add_ticket?id=') . $value['m_ticket_id']; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                                    <?php }
                                                    if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Delete')) { ?>
                                                        <button class="btn btn-danger btn-action delete-ticket" data-value="<?php echo $value['m_ticket_id']; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <th colspan="5"></th>
                                    <th><?= $total_adult ?></th>
                                    <th><?= $total_child ?></th>
                                    <th><?= ($total_adult + $total_child) ?></th>
                                    <th colspan="5"></th>
                                </tfoot>

                            </table>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="page-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="seipkon-breadcromb-left">
                                <h3><?php echo $pagename; ?></h3>
                                <hr style="margin-top: 0px; border-top: 2px solid #dee2e6;">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-check-label">From Date</label>
                            <input class="form-control dateinf" style="width: 100%;" type="date" placeholder="From Date" name="from_date" id="from_date" value="<?php echo $from_date; ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-check-label">To Date</label>
                            <input class="form-control dateinf" style="width: 100%;" type="date" placeholder="To Date" name="to_date" id="to_date" value="<?php echo $to_date; ?>">
                        </div>
                        <div class="col-md-12" style="margin-top:5px;" id="filterbtns">
                            <button type="button" class="btn <?php if ($fun == 1) {
                                                                    echo 'btn-success';
                                                                } else {
                                                                    echo 'btn-primary';
                                                                } ?> btn-block filterbtn" data-value="&fun=1&type=2">All Tickets</button>
                            <button type="button" class="btn <?php if ($fun == 2) {
                                                                    echo 'btn-success';
                                                                } else {
                                                                    echo 'btn-primary';
                                                                } ?> btn-block filterbtn" data-value="&fun=2&type=1&filed=m_ticket_city">City wise</button>
                            <button type="button" class="btn <?php if ($fun == 3) {
                                                                    echo 'btn-success';
                                                                } else {
                                                                    echo 'btn-primary';
                                                                } ?> btn-block filterbtn" data-value="&fun=3&type=1&filed=m_ticket_head">Ticket Type wise</button>
                            <button type="button" class="btn <?php if ($fun == 4) {
                                                                    echo 'btn-success';
                                                                } else {
                                                                    echo 'btn-primary';
                                                                } ?> btn-block filterbtn" data-value="&fun=4&type=1&filed=m_ticket_counter">Counter wise</button>
                            <button type="button" class="btn <?php if ($fun == 5) {
                                                                    echo 'btn-success';
                                                                } else {
                                                                    echo 'btn-primary';
                                                                } ?> btn-block filterbtn" data-value="&fun=5&type=2&filed=m_ticket_paymode&fval=Cash">Cash Tickets</button>
                            <button type="button" class="btn <?php if ($fun == 6) {
                                                                    echo 'btn-success';
                                                                } else {
                                                                    echo 'btn-primary';
                                                                } ?> btn-block filterbtn" data-value="&fun=6&type=2&filed=m_ticket_paymode&fval=Members">Members Tickets</button>
                            <button type="button" class="btn <?php if ($fun == 7) {
                                                                    echo 'btn-success';
                                                                } else {
                                                                    echo 'btn-primary';
                                                                } ?> btn-block filterbtn" data-value="&fun=7&type=2&filed=m_ticket_paymode&fval=Credit">Credit Tickets</button>
                            <button type="button" class="btn <?php if ($fun == 8) {
                                                                    echo 'btn-success';
                                                                } else {
                                                                    echo 'btn-primary';
                                                                } ?> btn-block filterbtn" data-value="&fun=8&type=1&filed=m_ticket_paytype">Paymode wise</button>

                            <button type="button" class="btn <?php if ($fun == 9) {
                                                                    echo 'btn-success';
                                                                } else {
                                                                    echo 'btn-primary';
                                                                } ?> btn-block filterbtn" data-value="&fun=9&type=1">Band wise</button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/report_js');
$this->view('js/custom_js'); ?>
<!-- =======================/Footer================Fix=======