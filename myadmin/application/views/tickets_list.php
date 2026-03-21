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
        <!-- Breadcromb Row Start -->
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Filter')) { ?>
                        <form method="post" action="<?php echo site_url('Shop') ?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-check-label">From Date</label>
                                    <input class="form-check-input date_form " type="date" placeholder="From Date" name="from_date" id="from_date" value="<?php echo $from_date; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-check-label">To Date</label>
                                    <input class="form-check-input date_form " type="date" placeholder="To Date" name="to_date" id="to_date" value="<?php echo $to_date; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-check-label">Sales Head</label>
                                    <select name="m_ticket_head" id="m_ticket_head" class="form-check-input" style="padding: 5px;">
                                        <option value="">--All Head--</option>
                                        <?php
                                        foreach ($head_dtl as $hkey) {
                                            if ($head == $hkey->m_saleshead_id) {
                                                $op = 'selected';
                                            } else {
                                                $op = '';
                                            }
                                        ?>
                                            <option value="<?php echo $hkey->m_saleshead_id; ?>" <?= $op ?>><?php echo $hkey->m_saleshead_title; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">Search</button>
                                        <a href="<?php echo site_url('Shop') ?>"><button class="btn btn-primary" type="button">Refresh</button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Export')) { ?>
                                            <button class="btn btn-success" type="submit" name="Excel" value="2">Export</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-right">
                        <button type="button" class="btn btn-primary btn-vsm" data-toggle="modal" data-target="#reportModal" title="View">Report</button>
                        <button type="button" class="btn btn-warning btn-vsm" data-toggle="modal" data-target="#pending_tickets" title="View">Pending <span><?= count($pending_tickets) ?></span></button>
                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Add')) { ?>
                            <a href="<?php echo site_url('Shop/add_ticket') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i>Ticket</a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="page-box">
            <div class="advance-table table-overflow">
                <table id="ticket_tbl" class="mylong_datatable table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Dated</th>
                            <th>Ticket No</th>
                            <th>Mode</th>
                            <th>Mobile No</th>
                            <th>Family</th>
                            <th>Stag</th>
                            <th>Total</th>
                            <th>CustomerName</th>
                            <th>CustomerType</th>
                            <th>City</th>
                            <th>PlotNo</th>
                            <th>PlotType</th>
                            <th>PlotOwner</th>
                            <th>NetAmount</th>
                            <th>Created on</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $wp_t_child = 0;
                        $wp_t_adult = 0;
                        $ap_t_child = 0;
                        $ap_t_adult = 0;
                        $cb_t_child = 0;
                        $cb_t_adult = 0;
                        $mb_t_child = 0;
                        $mb_t_adult = 0;
                        $total_child = 0;
                        $total_adult = 0;
                        $total_amount = 0;
                        if (!empty($ticket_value)) {

                            foreach ($ticket_value as $value) {

                                if ($value->m_ticket_head == 1) {
                                    $wp_t_adult += $value->m_ticket_adult;
                                    $wp_t_child += $value->m_ticket_child;
                                } else if ($value->m_ticket_head == 2) {
                                    $mb_t_child += $value->m_ticket_child;
                                    $mb_t_adult += $value->m_ticket_adult;
                                } else if ($value->m_ticket_head == 4) {
                                    $ap_t_adult += $value->m_ticket_adult;
                                    $ap_t_child += $value->m_ticket_child;
                                } else if ($value->m_ticket_head == 9) {
                                    $cb_t_adult += $value->m_ticket_adult;
                                    $cb_t_child += $value->m_ticket_child;
                                }

                                $total_adult += $value->m_ticket_adult;
                                $total_child += $value->m_ticket_child;
                                $total_amount += $value->m_ticket_netAmt;
                        ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= date('d-m-Y', strtotime($value->m_ticket_date)); ?></td>
                                    <td><?= $value->m_ticket_no; ?></td>
                                    <td><?= $value->m_ticket_paymode; ?></td>
                                    <td><?= $value->m_cust_mobile; ?></td>
                                    <td><?= $value->m_ticket_adult; ?></td>
                                    <td><?= $value->m_ticket_child; ?></td>
                                    <td><?= ($value->m_ticket_child + $value->m_ticket_adult); ?></td>
                                    <td><?= $value->m_cust_name; ?></td>
                                    <td><?= $value->m_ticket_cusType; ?></td>
                                    <td><?= $value->m_city_name; ?></td>
                                    <td><?= $value->m_ticket_plot_no; ?></td>
                                    <td><?= $value->m_plot_type ?></td>
                                    <td><?= $value->m_plot_name ?></td>
                                    <td><?= $value->m_ticket_netAmt; ?></td>
                                    <td><?= date('d-m-Y h:i', strtotime($value->m_ticket_added_on)); ?></td>

                                    <!-- <td><?php if ($value->m_shop_status == 1) echo "Active";
                                                else {
                                                    echo "In-Active";
                                                } ?></td>  -->

                                    <td class="wd-30">
                                        <?php if ($value->m_ticket_refund == 1) {
                                            echo '<span class="badge btn-danger">Refunded</span>';
                                        } else {
                                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Edit')) { ?>

                                                <a href="<?php echo base_url('Shop/add_ticket?id=') . $value->m_ticket_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <?php }
                                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Delete')) { ?>
                                                <button class="btn btn-danger btn-action delete-ticket" data-value="<?php echo $value->m_ticket_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                                <button class="btn btn-warning btn-action refund-ticket" data-value="<?php echo $value->m_ticket_id; ?>" title="Refund" data-toggle="tooltip"><i class="fa fa-reply" aria-hidden="true"></i></button>
                                        <?php }
                                        } ?>
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
                        <th colspan="9"></th>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- view Modal start -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="modal-title">Reports</h4>
                    </div>
                    <div class="col-md-2" style="text-align: end;">
                        <button type="button" class="btn-close btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="word-break: break-all;text-align: center;">
                <h4>From- (<?= date('d M Y', strtotime($from_date)) ?>) To- (<?= date('d M Y', strtotime($to_date)) ?>)</h4>

                <div class="row" style="margin-top: 10px;">
                    <h5 class="modal-title">Ticket Type Reports</h5>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Sn</th>
                                    <th>Type </th>
                                    <th>Family </th>
                                    <th>Stag </th>
                                    <th>Total </th>
                                </thead>
                                <tbody id="modal_body_contant">

                                    <tr>
                                        <td>1</td>
                                        <td>Water Park</td>
                                        <td><?= $wp_t_adult ?></td>
                                        <td><?= $wp_t_child ?></td>
                                        <td><?= ($wp_t_child + $wp_t_adult) ?></td>

                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Advanture Park</td>
                                        <td><?= $ap_t_adult ?></td>
                                        <td><?= $ap_t_child ?></td>
                                        <td><?= ($ap_t_child + $ap_t_adult) ?></td>

                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Combo</td>
                                        <td><?= $cb_t_adult ?></td>
                                        <td><?= $cb_t_child ?></td>
                                        <td><?= ($cb_t_child + $cb_t_adult) ?></td>

                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Member</td>
                                        <td><?= $mb_t_adult ?></td>
                                        <td><?= $mb_t_child ?></td>
                                        <td><?= ($mb_t_child + $mb_t_adult) ?></td>

                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Total</td>
                                        <td><?= $total_adult ?></td>
                                        <td><?= $total_child ?></td>
                                        <td><?= ($total_adult + $total_child) ?></td>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 10px;">
                    <h5 class="modal-title">City Wise Reports</h5>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Sn</th>
                                    <th>City Name </th>
                                    <th>Family </th>
                                    <th>Stag </th>
                                    <th>Total </th>

                                </thead>
                                <tbody id="modal_body_contant">

                                    <?php
                                    $sum_adult = 0;
                                    $sum_child = 0;
                                    if (!empty($city_report)) {
                                        foreach ($city_report as $cua => $key) {
                                            $sum_adult += $key->total_adult;
                                            $sum_child += $key->total_child;
                                            echo '<tr>
                                                                                    <td>' . ($cua + 1) . '</td>
                                                                                    <td>' . $key->m_city_name . ' </td>
                                                                                    <td>' . $key->total_adult . '</td>
                                                                                    <td>' . $key->total_child . '</td>
                                                                                    <td>' . ($key->total_adult + $key->total_child) . '</td>
                                                                                   
                                                                                </tr>';
                                        }
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Total</td>
                                        <td><?= $sum_adult ?></td>
                                        <td><?= $sum_child ?></td>
                                        <td><?= ($sum_adult + $sum_child) ?></td>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- view modal end -->

<!-- view Modal start -->
<div class="modal fade" id="pending_tickets" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="modal-title">Panding Ticket List from Appliction</h4>
                    </div>
                    <div class="col-md-2" style="text-align: end;">
                        <button type="button" class="btn-close btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="word-break: break-all">

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Sn</th>
                                    <th>Date </th>
                                    <th>Ticket No </th>
                                    <th>Customer Name </th>
                                    <th>Customer Mobile </th>
                                    <th>Family </th>
                                    <th>Stag </th>
                                    <th>Total </th>
                                    <th>Net Amount </th>
                                    <th>Remark </th>
                                    <th>Action </th>

                                </thead>
                                <tbody id="modal_body_contant">

                                    <?php

                                    if (!empty($pending_tickets)) {
                                        foreach ($pending_tickets as $cua => $key) { ?>

                                            <tr>
                                                <td><?= ($cua + 1) ?></td>
                                                <td><?= date('d-m-Y', strtotime($key->m_ticket_date)) ?> </td>
                                                <td><?= $key->m_ticket_no ?> </td>
                                                <td><?= $key->m_cust_name ?> </td>
                                                <td><?= $key->m_cust_mobile ?> </td>
                                                <td><?= $key->m_ticket_adult ?></td>
                                                <td><?= $key->m_ticket_child ?></td>
                                                <td><?= ($key->m_ticket_adult + $key->m_ticket_child) ?></td>
                                                <td><?= $key->m_ticket_netAmt ?></td>
                                                <td><?= $key->m_ticket_remark ?></td>
                                                <td><a href="<?= base_url('Shop/add_ticket?id=') . $key->m_ticket_id ?>" class="btn btn-success btn-vsm" title="Click to Confirm" data-toggle="tooltip">Confirm</a>
                                                    <?php
                                                    // if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Delete')) { 
                                                    ?>
                                                    <button class="btn btn-danger btn-action delete-ticket" data-value="<?php echo $key->m_ticket_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                                    <?php // } 
                                                    ?>
                                                </td>

                                            </tr>
                                    <?php   }
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- view modal end -->

<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/ticket_js');
$this->view('js/custom_js'); ?>
<!-- =======================/Footer================Fix=======