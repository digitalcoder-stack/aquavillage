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

            .badge {
                display: inline-block;
                min-width: 2px;
                padding: 1px 4px;
                font-size: 10px;
                font-weight: 700;
                line-height: 1;
                color: #fff;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                border-radius: 10px;
                position: relative;
                top: -8px;
                right: -8px;
                background-color: #cf2020;
            }
        </style>

<?php

        switch ($pagtype) {
            case 1: {
                    $pagelink = "Restuarent/resort_data_list";
                    $modu = "RES";
                    $submod = "RSTR";
                    $tdtname = "Room";
                }
                break;
            case 2: {
                    $pagelink = "Restuarent/camps_data_list";
                    $modu = "RES";
                    $submod = "CMPR";
                    $tdtname = "Camp";
                }
                break;
           
        }

        ?>

        <!-- Breadcromb Row Start -->
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, $modu, $submod, 'Filter')) { ?>
                        <form method="post" action="<?php echo site_url($pagelink) ?>">
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
                                    <label class="form-check-label">Entry Status</label>
                                    <select name="status" id="etr_status" class="form-check-input" style="padding: 5px;">
                                        <option value="o">-- Both --</option>
                                        <option value="1" <?php if ($status == 1) echo 'selected' ?>>Check In</option>
                                        <option value="2" <?php if ($status == 2) echo 'selected' ?>>Check Out</option>

                                    </select>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">Search</button>
                                        <a href="<?php echo site_url($pagelink) ?>"><button class="btn btn-primary" type="button">Refresh</button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, $modu, $submod, 'Export')) { ?>
                                            <!-- <button class="btn btn-success" type="submit" name="Excel" value="2">Export</button> -->
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-right">
                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, $modu, $submod, 'Add')) { ?>
                            <a href="<?php echo site_url('Restuarent/add_resort_data/').$pagtype ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add Entries</a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="page-box">
            <div class="advance-table table-overflow">
                <table id="resort_tbl" class="my_custom_datatable table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Dated</th>
                            <th>Customer Name</th>
                            <th>Mobile No</th>
                            <th>City</th>
                            <th>Adult</th>
                            <th>Child</th>
                            <th>Total</th>
                            <th><?= $tdtname ?> No</th>
                            <th>Amount</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;

                        $total_child = 0;
                        $total_adult = 0;

                        if (!empty($resort_value)) {

                            foreach ($resort_value as $value) {

                                $total_adult += $value->r_resdata_adult;
                                $total_child += $value->r_resdata_child;

                        ?>
                                <tr>
                                    <td><?= $i; ?><?php if ($value->r_resdata_iscredit == 1) {
                                                        echo '<span class="badge">credit</span>';
                                                    } ?></td>
                                    <td><?= date('d-m-Y', strtotime($value->r_resdata_date)); ?></td>

                                    <td><?= $value->r_resdata_mobile; ?></td>
                                    <td><?= $value->r_resdata_name; ?></td>
                                    <td><?= $value->m_city_name; ?></td>
                                    <td><?= $value->r_resdata_adult; ?></td>
                                    <td><?= $value->r_resdata_child; ?></td>
                                    <td><?= $value->total_person; ?></td>
                                    <td><?= $value->r_resdata_roomno; ?></td>
                                    <td><?= $value->r_resdata_iscredit == 1 ? $value->r_resdata_balamt : $value->total_amount; ?></td>

                                    <td><?= date('d-m-Y', strtotime($value->r_resdata_date)); ?></td>
                                    <td><?= $value->r_resdata_status == 1 || $value->r_resdata_updatedon == '0000-00-00 00:00:00' ? '-' : date('d-m-Y h:i', strtotime($value->r_resdata_updatedon)); ?></td>

                                    <td class="wd-30">
                                        <?php if ($value->r_resdata_status == 1) {
                                            echo ' <button class="btn btn-primary" data-target="#pending_tickets'. $value->r_resdata_id .'" data-toggle="modal" title="Click to Check Out">Mark Out</button>';
                                        } ?>

                                        <!-- view Modal start -->
                                        <div class="modal fade" id="pending_tickets<?= $value->r_resdata_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <h4 class="modal-title">Check Out- <?= $value->r_resdata_name; ?></h4>
                                                            </div>
                                                            <div class="col-md-2" style="text-align: end;">
                                                                <button type="button" class="btn-close btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="<?= base_url('Restuarent/update_checkout_status') ?>" method="post">
                                                        <div class="modal-body" style="word-break: break-all">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p>Customer Name :- <span style="font-weight: bold;"><?= $value->r_resdata_name; ?></span></p>
                                                                </div>
                                                                <div class="col-md-6" style="text-align: end;">
                                                                    <p>Mobile :- <span style="font-weight: bold;"><?= $value->r_resdata_mobile; ?></span></p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <p><?= $tdtname ?> NO :- <span style="font-weight: bold;"><?= $value->r_resdata_roomno; ?></span></p>
                                                                </div>
                                                                <div class="col-md-4" style="text-align: center;">
                                                                    <p>Total Guests :- <span style="font-weight: bold;"><?= $value->total_person; ?></span></p>
                                                                </div>
                                                                <div class="col-md-4" style="text-align: end;">
                                                                    <p>Total Amount :- <span style="font-weight: bold;">₹<?= $value->r_resdata_iscredit == 1 ? $value->r_resdata_balamt : $value->total_amount; ?></span></p>
                                                                </div>

                                                                <div class="col-md-12 fcashdiv fpaypartial" style="<?php if ($value->r_resdata_fispartial != 1) echo 'display: none;' ?> height:65px; padding-top:30px">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" <?php if ($value->r_resdata_fispartial == 1) {
                                                                                                    echo 'checked';
                                                                                                } ?> class="form-check-input r_resdata_fispartial" id="r_resdata_fispartial<?= $value->r_resdata_id ?>" data-resdit="<?= $value->r_resdata_id ?>" name="r_resdata_fispartial" value="1">
                                                                        <label class="form-check-label" for="r_resdata_fispartial"> Partial Payment</label>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-6 fcashdiv" <?php if ($value->r_resdata_iscredit == 1) {
                                                                                                    echo 'style="display: none;"';
                                                                                                } ?> id="Ampayty_in">
                                                                    <div class="form-group">
                                                                        <label>Payment Mode</label>
                                                                        <select name="r_resdata_fpmode1" id="r_resdata_fpmode1<?= $value->r_resdata_id ?>" data-resdit="<?= $value->r_resdata_id ?>" class="form-control select2 r_resdata_fpmode1" style="width: 100%;">

                                                                            <option value="1" <?php if ($value->r_resdata_fpmode1 == 1) echo 'selected' ?>>Cash</option>
                                                                            <option value="2" <?php if ($value->r_resdata_fpmode1 == 2) echo 'selected' ?>>Paytm</option>
                                                                            <option value="3" <?php if ($value->r_resdata_fpmode1 == 3) echo 'selected' ?>>Phone Pay</option>
                                                                            <option value="4" <?php if ($value->r_resdata_fpmode1 == 4) echo 'selected' ?>>Other</option>
                                                                            <option value="partial" id="partial_op<?= $value->r_resdata_id ?>">Partial Payment</option>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 fcashdiv" <?php if ($value->r_resdata_iscredit == 1) {
                                                                                                    echo 'style="display: none;"';
                                                                                                } ?>>
                                                                    <div class="form-group">
                                                                        <label>Food Amount <span class="text-danger">*</span></label>
                                                                        <input type="hidden" name="r_resdata_id" value="<?= $value->r_resdata_id ?>">
                                                                        <input type="number" name="r_resdata_fpamt1" id="r_resdata_fpamt1<?= $value->r_resdata_id ?>" class="form-control" required value="<?= $value->r_resdata_fpamt1 ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 fcashdiv fpaypartial" style="<?php if ($value->r_resdata_fispartial != 1) echo 'display: none;' ?>">
                                                                    <div class="form-group">
                                                                        <label>Payment Mode2</label>
                                                                        <select name="r_resdata_fpmode2" id="r_resdata_fpmode2<?= $value->r_resdata_id ?>" class="form-control select2" style="width:100%">
                                                                            <option value="1" <?php if ($value->r_resdata_fpmode2 == 1) echo 'selected' ?>>Cash</option>
                                                                            <option value="2" <?php if ($value->r_resdata_fpmode2 == 2) echo 'selected' ?>>Paytm</option>
                                                                            <option value="3" <?php if ($value->r_resdata_fpmode2 == 3) echo 'selected' ?>>Phone Pay</option>
                                                                            <option value="4" <?php if ($value->r_resdata_fpmode2 == 4) echo 'selected' ?>>Other</option>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 fcashdiv fpaypartial" style="<?php if ($value->r_resdata_fispartial != 1) echo 'display: none;' ?>">
                                                                    <div class="form-group">
                                                                        <label>Food Amount2 </label>
                                                                        <input type="number" name="r_resdata_fpamt2" id="r_resdata_fpamt2<?= $value->r_resdata_id ?>" class="form-control" value="<?= $value->r_resdata_fpamt2 ?>">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-success" type="submit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- view modal end -->
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, $modu, $submod, 'Edit')) { ?>

                                            <a href="<?php echo base_url('Restuarent/add_resort_data/'.$pagtype.'?id=') . $value->r_resdata_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                        <?php }
                                        if ($logged_user_type == 1 || has_perm($logged_user_id, $modu, $submod, 'Delete')) { ?>
                                            <button class="btn btn-danger btn-action delete-resort" data-value="<?php echo $value->r_resdata_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
            </div>
        </div>
    </div>
</div>




<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/restuarent_js');
$this->view('js/custom_js'); ?>
<!-- =======================/Footer================Fix=======