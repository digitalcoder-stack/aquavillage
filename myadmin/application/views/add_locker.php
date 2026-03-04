<?php $this->view('top_header') ?>
<div class="page-content">
    <div class="container-fluid">
        <!-- Breadcromb Row Start -->
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 pull-right">
                    <div class="seipkon-breadcromb-right">
                        <a href="<?php echo site_url('Shop/locker_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All lockers </a>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
            .check {
                display: flex;
                justify-content: space-between;
            }

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

            div {
                background-position: center center !important;
                background-size: cover !important;
            }

            th,
            td {
                padding: 4px !important;
            }
        </style>
        <!-- View Counselor Area Start -->

        <?php


        if (!empty($edit_value)) {
            $id           = $edit_value->m_locker_id;
            $date         = $edit_value->m_locker_date;
            $cashaccount  = $edit_value->m_locker_counter;
            $cust_mobile  = $edit_value->m_cust_mobile;
            $cust_name    = $edit_value->m_cust_name;
            $Trent     = $edit_value->m_locker_Trent;
            $Tlocker       = $edit_value->m_locker_Tlocker;
            $payableAmt     = $edit_value->m_locker_payableAmt;
            $Tdeposit       = $edit_value->m_locker_Tdeposit;
            $paidAmt      = $edit_value->m_locker_paidAmt;
            $balAmt       = $edit_value->m_locker_balAmt;
            $remark       = $edit_value->m_locker_remark;
            $ticket_id       = $edit_value->m_locker_ticket_id;
            $customer_id       = $edit_value->m_locker_customer;
            $catBid       = explode(',', $edit_value->m_locker_B);
            $catLid       = explode(',', $edit_value->m_locker_L);
            $catGid       = explode(',', $edit_value->m_locker_G);
            $paidAmt2      = $edit_value->m_locker_paidAmt2;
            $paytype       = $edit_value->m_locker_paytype;
            $paytype2       = $edit_value->m_locker_paytype2;
            $ispartial       = $edit_value->m_locker_ispartial;
            $credit_allow       = $edit_value->m_locker_iscredit;
        } else {
            $id = '';
            $date = '';
            $cashaccount = '';
            $cust_mobile = $user_lst->m_cust_mobile;
            $cust_name = $user_lst->m_cust_name;
            $remark = '';
            $Trent = 0;
            $Tlocker   = 0;
            $payableAmt = 0;
            $Tdeposit   = 0;
            $paidAmt  = 0;
            $balAmt   = 0;
            $ticket_id   = $user_lst->m_ticket_id;
            $customer_id   = $user_lst->m_ticket_customer;
            $catBid   = array();
            $catLid   = array();
            $catGid   = array();
            $paytype   = 1;
            $paytype2   = '';
            $ispartial  = 0;
            $paidAmt2  = '';

            if ($user_lst->m_ticket_paymode == 'Credit') {
                $HiddenProducts = explode(',', $user_lst->m_ticket_credit_allow);
                if (in_array(1, $HiddenProducts)) {
                    $credit_allow = 1;
                } else {
                    $credit_allow = 0;
                }
            }else if($user_lst->m_ticket_cusType == 'Free'){
                $HiddenProducts = explode(',', $user_lst->m_ticket_credit_allow);
                if (in_array(1, $HiddenProducts)) {
                    $credit_allow = 2;
                } else {
                    $credit_allow = 0;
                }
            }
        }


        ?>


        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-locker-create" enctype="mutipart/form-data">
                        <div class="row">
                            <input type="hidden" name="is_credit_allow" id="is_credit_allow" class="form-control" value="<?= $credit_allow ?>">
                            <input type="hidden" name="m_locker_id" id="m_locker_id" class="form-control" value="<?= $id ?>">
                            <div class="col-md-3 col-sm-4" id="Amcounter_in">
                                <div class="form-group ">

                                    <label>Cash Account</label>
                                    <select name="m_locker_counter" id="m_locker_counter" class="form-control select2">
                                        <?php
                                        if (!empty($cashcot_dtl)) {
                                            foreach ($cashcot_dtl as $cckey) {
                                                if ($cashaccount == $cckey->m_cashacc_id) {
                                                    $op = 'selected';
                                                } else {
                                                    $op = '';
                                                }
                                        ?>
                                                <option value="<?php echo $cckey->m_cashacc_id; ?>" <?= $op ?>><?php echo $cckey->m_cashacc_name; ?>
                                                </option>
                                        <?php
                                            }
                                        }

                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="m_locker_date" id="m_locker_date" class="form-control" readonly value="<?php if ($date == '') {
                                                                                                                                        echo date('Y-m-d');
                                                                                                                                    } else {
                                                                                                                                        echo $date;
                                                                                                                                    } ?>">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="number" placeholder="Enter Here" class="form-control" id="m_cust_mobile" name="m_cust_mobile" value="<?= $cust_mobile ?>" readonly />

                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="m_cust_name" id="m_cust_name" class="form-control" placeholder="Enter Name" value="<?= $cust_name ?>" readonly>
                                    <input type="hidden" name="m_locker_ticket_id" id="m_locker_ticket_id" class="form-control" value="<?= $ticket_id ?>">
                                    <input type="hidden" name="m_locker_customer" id="m_locker_customer" class="form-control" value="<?= $customer_id ?>">
                                </div>
                            </div>
                            <!-- locker -->
                            <div class="col-lg-2 col-md-4">
                                <label>Lockers B</label>
                                <table class=" table table-striped table-bordered" style="display: block; height: 200px;overflow-y: scroll;">
                                    <thead>
                                        <th width="1%">Sn</th>
                                        <th>Locker Code</th>
                                        <th>Allot</th>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($catB_dtl)) {
                                            $i = 0;
                                            $j = 0;

                                            foreach ($catB_dtl as $catB) {
                                                $op = '';
                                                if (!empty($catBid)) {
                                                    if ($j < count($catBid)) {
                                                        if ($catBid[$j] == $catB->m_lockercode_id) {
                                                            $op = 'checked';
                                                            $j++;
                                                        } else {
                                                            $op = '';
                                                        }
                                                    }
                                                }

                                                $i++; ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $catB->m_lockercode_title ?></td>
                                                    <td><input type="checkbox" name="catB[]" <?= $op ?> class="catclick" value="<?= $catB->m_lockercode_id ?>"></td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <label>Lockers L</label>
                                <table class=" table table-striped table-bordered" style="display: block; height: 200px; overflow-y: scroll;">
                                    <thead>
                                        <th width="1%">Sn</th>
                                        <th>Locker Code</th>
                                        <th>Allot</th>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($catL_dtl)) {
                                            $i = 0;
                                            $j = 0;
                                            foreach ($catL_dtl as $catL) {
                                                $op = '';
                                                if (!empty($catLid)) {
                                                    if ($j < count($catLid)) {
                                                        if ($catLid[$j] == $catL->m_lockercode_id) {
                                                            $op = 'checked';
                                                            $j++;
                                                        } else {
                                                            $op = '';
                                                        }
                                                    }
                                                }
                                                $i++; ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $catL->m_lockercode_title ?></td>
                                                    <td><input type="checkbox" name="catL[]" <?= $op ?> class="catclick" value="<?= $catL->m_lockercode_id ?>"></td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <label>Lockers G</label>
                                <table class=" table table-striped table-bordered" style="display: block; height: 200px;overflow-y: scroll;">
                                    <thead>
                                        <th width="1%">Sn</th>
                                        <th>Locker Code</th>
                                        <th>Allot</th>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($catG_dtl)) {
                                            $i = 0;
                                            $j = 0;
                                            foreach ($catG_dtl as $catG) {
                                                $op = '';
                                                if (!empty($catGid)) {
                                                    if ($j < count($catGid)) {
                                                        if ($catGid[$j] == $catG->m_lockercode_id) {
                                                            $op = 'checked';
                                                            $j++;
                                                        } else {
                                                            $op = '';
                                                        }
                                                    }
                                                }
                                                $i++; ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $catG->m_lockercode_title ?></td>
                                                    <td><input type="checkbox" name="catG[]" <?= $op ?> class="catclick" value="<?= $catG->m_lockercode_id ?>"></td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Total Rent</label>
                                    <input type="number" name="m_locker_Trent" id="m_locker_Trent" class="form-control" readonly value="<?= $Trent ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Total Locker</label>
                                    <input type="number" name="m_locker_Tlocker" id="m_locker_Tlocker" class="form-control" readonly value="<?= $Tlocker ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Total Payable</label>
                                    <input type="number" name="m_locker_payableAmt" id="m_locker_payableAmt" class="form-control" readonly value="<?= $payableAmt ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Total Deposit</label>
                                    <input type="number" name="m_locker_Tdeposit" id="m_locker_Tdeposit" class="form-control" readonly value="<?= $Tdeposit ?>">
                                </div>
                            </div>
                            <div class="col-md-2 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?> margin-top:30px">
                                <div class="form-check">
                                    <input type="checkbox" <?php if ($ispartial == 1) {
                                                                echo 'checked';
                                                            } ?> class="form-check-input" id="m_locker_ispartial" name="m_locker_ispartial" value="1">
                                    <label class="form-check-label" for="m_locker_ispartial"> Partial Payment</label>
                                </div>
                            </div>


                            <div class="col-lg-2 col-md-3 col-sm-4 cashdiv" style="display: block;" id="Ampayty_in">
                                <div class="form-group">
                                    <label>Payment Mode</label>
                                    <select name="m_locker_paytype" id="m_locker_paytype" class="form-control select2">

                                        <option value="partial" id="partial_op">Partial Payment</option>
                                        <option value="1" <?php if ($paytype == 1) echo 'selected' ?>>Cash</option>
                                        <option value="2" <?php if ($paytype == 2) echo 'selected' ?>>Paytm</option>
                                        <option value="3" <?php if ($paytype == 3) echo 'selected' ?>>Phone Pay</option>
                                        <option value="4" <?php if ($paytype == 4) echo 'selected' ?>>Other</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Amount Paid</label>
                                    <input type="number" name="m_locker_paidAmt" id="m_locker_paidAmt" class="form-control" required value="<?= $paidAmt ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?>">
                                <div class="form-group">
                                    <label>Payment Mode2</label>
                                    <select name="m_locker_paytype2" id="m_locker_paytype2" class="form-control select2" style="width:100%">
                                        <option value="1" <?php if ($paytype2 == 1) echo 'selected' ?>>Cash</option>
                                        <option value="2" <?php if ($paytype2 == 2) echo 'selected' ?>>Paytm</option>
                                        <option value="3" <?php if ($paytype2 == 3) echo 'selected' ?>>Phone Pay</option>
                                        <option value="4" <?php if ($paytype2 == 4) echo 'selected' ?>>Other</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?>">
                                <div class="form-group">
                                    <label>Amount Paid2</label>
                                    <input type="number" name="m_locker_paidAmt2" id="m_locker_paidAmt2" class="form-control" value="<?= $paidAmt2 ?>">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Balance</label>
                                    <input type="number" name="m_locker_balAmt" id="m_locker_balAmt" class="form-control" readonly value="<?= $balAmt ?>">
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Remark</label>
                                    <input type="text" name="m_locker_remark" id="m_locker_remark" class="form-control" value="<?= $remark ?>">
                                </div>
                            </div>


                        </div>

                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-locker-create" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-layout-submit"><a href="<?php echo site_url('Shop'); ?>" class="btn btn-block btn-danger">Cancel</a>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========================/View=================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/locker_js');

if (empty($edit_value) && empty($user_lst)) {
    echo '<script type="text/javascript"> 
    swal("Cannot add locker of previous date ticket", {icon: "error", timer: 2000, });
    setTimeout(function(){ window.location = "' . site_url('Shop/locker_list') . '"; },2000);
    </script>';
}
?>