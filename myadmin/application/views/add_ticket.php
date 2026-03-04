<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id');
$logged_user_type = $this->session->userdata('user_type');
?>
<div class="page-content">
    <div class="container-fluid">
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 pull-right">
                    <div class="seipkon-breadcromb-right">
                        <button type="button" class="btn btn-warning btn-vsm" data-toggle="modal" data-target="#pending_tickets" title="View">
                            Pending
                            <span><?= count($pending_tickets) ?></span>
                        </button>
                        <a href="<?php echo site_url('Shop'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All Tickets </a>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
            .d-none {
                display: none !important;
            }

            .check {
                display: flex;
                justify-content: space-between;
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

            .sidediv {
                border: black;
                border-width: 1px;
                border-style: solid;
            }

            .itemdiv {
                justify-content: space-between;
                display: inline-flex;
            }

            .valuediv {
                background-color: lightgray;
                display: inline-block;
                width: 30%;
                margin-top: 2px;
                margin-bottom: 2px;
                border: black 1px solid;
            }
        </style>
        <?php if (!empty($edit_value)) {
            $id           = $edit_value->m_ticket_id;
            $date         = $edit_value->m_ticket_date;
            $head         = $edit_value->m_ticket_head;
            $cashaccount  = $edit_value->m_ticket_counter;
            $customer  = $edit_value->m_ticket_customer;
            $paymode      = $edit_value->m_ticket_paymode;
            $cust_mobile  = $edit_value->m_cust_mobile;
            $adult        = $edit_value->m_ticket_adult;
            $child        = $edit_value->m_ticket_child;
            $ticfree        = $edit_value->m_ticket_free;
            $cust_name    = $edit_value->m_cust_name;
            $cusType      = $edit_value->m_ticket_cusType;
            $custcity     = $edit_value->m_ticket_city;
            $plot_no      = $edit_value->m_ticket_plot_no;
            $scanCard      = $edit_value->m_ticket_scanCard;
            $totalAmt     = $edit_value->m_ticket_totalAmt;
            $gstAmt       = $edit_value->m_ticket_gstAmt;
            $discount     = $edit_value->m_ticket_discount;
            $netAmt       = $edit_value->m_ticket_netAmt;

            $paidAmt2      = $edit_value->m_ticket_paidAmt2;
            if ($edit_value->m_ticket_status == 0) {
                $paidAmt      = $edit_value->m_ticket_balAmt;
                $balAmt       = 0;
            } else {
                $paidAmt      = $edit_value->m_ticket_paidAmt;
                $balAmt       = $edit_value->m_ticket_balAmt;
            }

            $remark       = $edit_value->m_ticket_remark;
            $paytype       = $edit_value->m_ticket_paytype;
            $paytype2       = $edit_value->m_ticket_paytype2;
            $ispartial       = $edit_value->m_ticket_ispartial;
            $resp_id       = $edit_value->m_ticket_resp_id;
            $plot_file       = $edit_value->m_ticket_plot_file;
            $credit_allow       = explode(',', $edit_value->m_ticket_credit_allow);
        } else {
            $id = '';
            $date = '';
            $head = '';
            $cashaccount = '';
            $customer = '';
            $paymode = '';
            $cust_mobile = '';
            $adult = 0;
            $child = 0;
            $ticfree = 0;
            $cust_name = '';
            $cusType = '';
            $custcity = '';
            $plot_no = '';
            $scanCard  = '';
            $remark = '';
            $totalAmt = 0;
            $gstAmt   = 0;
            $discount = 0;
            $netAmt   = 0;
            $paidAmt  = '';
            $paidAmt2  = '';
            $balAmt   = 0;
            $paytype   = 1;
            $paytype2   = '';
            $ispartial  = 0;
            $resp_id  = '';
            $plot_file  = '';
            $credit_allow  = array();
        }
        ?>
        <div class="page-box d-none" id="memberverdiv">
            <h4>Plot Member detail</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="row" id="memdetaildiv">

                    </div>
                </div>
                <div class="col-md-2" id="membimgdiv">

                </div>
                <div class="col-md-2">
                    <img src="" alt="" id="preview_image">
                    <input type="hidden" id="image_input">
                   
                </div>
                <div class="col-md-2" style="display: flex;flex-direction: column;" id="vermodlbtndiv">
                    <button type="button" style="margin-bottom: 5px;" class="btn btn-primary btn-sm" onclick="opencamera()" id="camera_btn">Open Camera</button>
                    <button type="button" style="margin-bottom: 5px;" class="btn btn-success btn-sm" id="btn_verify">Verify</button>
                    
                </div>
            </div>

        </div>

        <div class="page-box">

            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <h5>Band Colours and Balance stock</h5>
                    <div class="row" style="border-bottom: solid 0.5px #b5b5b5;margin-bottom: 8px;">
                        <div class="col-md-3">
                            <div>Water Park Adult: <span class="badge" style="background-color: <?= $band_stk->wpat_bndclr ?>; <?php if ($band_stk->wpat_bndclr == 'White') echo 'color:black;' ?>"><?= $band_stk->wpat_bndclr ?> (<?= $band_stk->wpat_stock ?>) </span></div>
                        </div>
                        <div class="col-md-3">
                            <div>Water Park Child: <span class="badge" style="background-color: <?= $band_stk->wpcd_bndclr ?>; <?php if ($band_stk->wpcd_bndclr == 'White') echo 'color:black;' ?>"><?= $band_stk->wpcd_bndclr ?> (<?= $band_stk->wpcd_stock ?>) </span></div>
                        </div>
                        <div class="col-md-3">
                            <div>Advanture Park Adult: <span class="badge" style="background-color: <?= $band_stk->adat_bndclr ?>; <?php if ($band_stk->adat_bndclr == 'White') echo 'color:black;' ?>"><?= $band_stk->adat_bndclr ?> (<?= $band_stk->adat_stock ?>) </span></div>
                        </div>
                        <div class="col-md-3">
                            <div>Advanture Park Child: <span class="badge" style="background-color: <?= $band_stk->adcld_bndclr ?>; <?php if ($band_stk->adcld_bndclr == 'White') echo 'color:black;' ?>"><?= $band_stk->adcld_bndclr ?> (<?= $band_stk->adcld_stock ?>) </span></div>
                        </div>
                        <div class="col-md-3">
                            <div>Combo Adult: <span class="badge" style="background-color: <?= $band_stk->coat_bndclr ?>; <?php if ($band_stk->coat_bndclr == 'White') echo 'color:black;' ?>"><?= $band_stk->coat_bndclr ?> (<?= $band_stk->coat_stock ?>) </span></div>
                        </div>
                        <div class="col-md-3">
                            <div>Combo Child: <span class="badge" style="background-color: <?= $band_stk->cocld_bndclr ?>; <?php if ($band_stk->cocld_bndclr == 'White') echo 'color:black;' ?>"><?= $band_stk->cocld_bndclr ?> (<?= $band_stk->cocld_stock ?>) </span></div>
                        </div>
                        <div class="col-md-3">
                            <div>Member : <span class="badge" style="background-color: <?= $band_stk->mem_bndclr ?>; <?php if ($band_stk->mem_bndclr == 'White') echo 'color:black;' ?>"><?= $band_stk->mem_bndclr ?> (<?= $band_stk->mem_stock ?>) </span></div>
                        </div>
                        <div class="col-md-3">
                            <div>Free : <span class="badge" style="background-color: <?= $band_stk->free_bndclr ?>; <?php if ($band_stk->free_bndclr == 'White') echo 'color:black;' ?>"><?= $band_stk->free_bndclr ?> (<?= $band_stk->free_stock ?>) </span></div>
                        </div>

                    </div>

                    <form method="post" action="#" id="frm-ticket-create" enctype="mutipart/form-data">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <input type="hidden" name="m_ticket_id" id="m_ticket_id" class="form-control" value="<?= $id ?>">
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Sales Head</label>
                                            <select name="m_ticket_head" id="m_ticket_head" class="form-control select2">
                                                <?php
                                                foreach ($head_dtl as $hkey) {
                                                    if ($head == $hkey->m_saleshead_id) {
                                                        $op = 'selected';
                                                    } else {
                                                        $op = '';
                                                    }


                                                ?>
                                                    <option value="<?php echo $hkey->m_saleshead_id; ?>" <?= $op ?> data-dis="<?php echo $hkey->m_saleshead_discount; ?>" data-gst="<?php echo $hkey->m_saleshead_gst; ?>" data-title="<?php echo $hkey->m_saleshead_title; ?>"><?php echo $hkey->m_saleshead_title; ?></option>
                                                <?php
                                                }

                                                ?>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" name="m_ticket_date" id="m_ticket_date" class="form-control" readonly value="<?php if ($date == '') {
                                                                                                                                                echo date('Y-m-d');
                                                                                                                                            } else {
                                                                                                                                                echo $date;
                                                                                                                                            } ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Sales Mode</label>
                                            <select name="m_ticket_paymode" id="m_ticket_paymode" class="form-control select2">
                                                <option value="Cash" <?php if ($paymode == "Cash") {
                                                                            echo 'selected';
                                                                        } ?>>Cash</option>
                                                <option value="Credit" <?php if ($paymode == "Credit") {
                                                                            echo 'selected';
                                                                        } ?>>Credit</option>
                                                <option value="Members" <?php if ($paymode == "Members") {
                                                                            echo 'selected';
                                                                        } ?>>Members</option>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4 plotdiv" <?php if ($paymode != "Members") {
                                                                                        echo 'style="display: none;"';
                                                                                    } ?> id="scanCard_in">
                                        <div class="form-group">
                                            <label>Scan Card</label>
                                            <input type="text" name="m_ticket_scanCard" id="m_ticket_scanCard" class="form-control" readonly value="<?= $scanCard ?>">
                                            <input type="hidden" name="m_ticket_plot_file" id="m_ticket_plot_file" value="<?= $plot_file ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4 plotdiv" <?php if ($paymode != "Members") {
                                                                                        echo 'style="display: none;"';
                                                                                    } ?> id="plot_no_in">
                                        <div class="form-group">
                                            <label>Plot No</label>
                                            <input type="text" name="m_ticket_plot_no" id="m_ticket_plot_no" class="form-control" value="<?= $plot_no ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-3 col-sm-4" <?php if ($paymode != "Credit") {
                                                                                echo 'style="display: none;"';
                                                                            } ?> id="creditCust_in">
                                        <div class="form-group">
                                            <label>Credit Customer</label>
                                            <select name="m_ticket_creditCust" id="m_ticket_creditCust" class="form-control select2" style="width:100%;">
                                                <option value="">Select Customer</option>
                                                <?php
                                                foreach ($user_dtl as $ckey) {
                                                    if ($customer == $ckey->m_cust_id) {
                                                        $op = 'selected';
                                                    } else {
                                                        $op = '';
                                                    }
                                                ?>
                                                    <option value="<?php echo $ckey->m_cust_id; ?>" <?= $op ?> data-name="<?php echo $ckey->m_cust_name; ?>" data-num="<?php echo $ckey->m_cust_mobile; ?>" data-city="<?php echo $ckey->m_cust_city; ?>"><?php echo $ckey->m_cust_name; ?>
                                                    </option>
                                                <?php
                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Mobile No.<span class="text-danger">*</span></label>
                                            <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_cust_mobile" id="m_cust_mobile" class="form-control" placeholder="Enter Mobile Number" required="" autofocus value="<?= $cust_mobile ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" name="m_cust_name" id="m_cust_name" class="form-control" placeholder="Enter Name" value="<?= $cust_name ?>" autofocus required>
                                        </div>
                                    </div>


                                    <div class="col-lg-2 col-md-3 col-sm-4">

                                        <div class="input-group">
                                            <label>City Name <span class="text-danger">*</span></label>
                                            <select name="m_ticket_city" id="stc_add_city" class="form-control select2" required>
                                                <option value="">Select City</option>
                                                <?php
                                                foreach ($city_dtl as $city) {
                                                    if ($custcity == $city->m_city_id) {
                                                        $op = 'selected';
                                                    } else {
                                                        $op = '';
                                                    }

                                                ?>
                                                    <option value="<?php echo $city->m_city_id; ?>" <?= $op ?>><?php echo $city->m_city_name . ' | ' . $city->m_state_name; ?></option>
                                                <?php
                                                }

                                                ?>

                                            </select>
                                            <div class="input-group-btn">
                                                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#addcityModal" type="button" style="margin-top: 25px;height: 40px;background: #8d8d8d;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Adult <span class="text-danger">*</span></label>
                                            <input type="number" name="m_ticket_adult" id="m_ticket_adult" class="form-control amountcalculate" placeholder="Adult" required="" value="<?= $adult ?>" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Children <span class="text-danger">*</span></label>
                                            <input type="number" name="m_ticket_child" id="m_ticket_child" class="form-control amountcalculate" placeholder="Child" required="" value="<?= $child ?>" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Free </label>
                                            <input type="number" name="m_ticket_free" id="m_ticket_free" class="form-control" placeholder="Free" value="<?= $ticfree ?>" autofocus>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Total Amount</label>
                                            <input type="hidden" name="m_ticket_totalAmt" id="m_ticket_totalAmt" class="form-control m_ticket_totalAmt" readonly value="<?= $totalAmt ?>">
                                            <input type="number" class="form-control m_ticket_totalAmt" disabled value="<?= $totalAmt ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>GST</label>
                                            <input type="hidden" name="m_ticket_gstAmt" id="m_ticket_gstAmt" class="form-control m_ticket_gstAmt" readonly value="<?= $gstAmt ?>">
                                            <input type="number" class="form-control m_ticket_gstAmt" disabled value="<?= $gstAmt ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input type="hidden" name="m_ticket_discount" id="m_ticket_discount" class="form-control m_ticket_discount" readonly value="<?= $discount ?>">
                                            <input type="number" class="form-control m_ticket_discount" disabled value="<?= $discount ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Net Amount</label>
                                            <input type="hidden" name="m_ticket_netAmt" id="m_ticket_netAmt" class="form-control m_ticket_netAmt" readonly value="<?= $netAmt ?>">
                                            <input type="number" class="form-control m_ticket_netAmt" disabled value="<?= $netAmt ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-3 col-sm-4 cashdiv" <?php if ($paymode == "Credit") {
                                                                                        echo 'style="display: none;"';
                                                                                    } ?> id="Amcounter_in">
                                        <div class="form-group">
                                            <label>Cash Counter</label>
                                            <select name="m_ticket_counter" id="m_ticket_counter" class="form-control select2">
                                                <?php
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

                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?> margin-top:30px">
                                        <div class="form-check">
                                            <input type="checkbox" <?php if ($ispartial == 1) {
                                                                        echo 'checked';
                                                                    } ?> class="form-check-input" id="m_ticket_ispartial" name="m_ticket_ispartial" value="1">
                                            <label class="form-check-label" for="m_ticket_ispartial"> Partial Payment</label>
                                        </div>
                                    </div>


                                    <div class="col-lg-2 col-md-3 col-sm-4 cashdiv" <?php if ($paymode == "Credit") {
                                                                                        echo 'style="display: none;"';
                                                                                    } ?> id="Ampayty_in">
                                        <div class="form-group">
                                            <label>Payment Mode</label>
                                            <select name="m_ticket_paytype" id="m_ticket_paytype" class="form-control select2">

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
                                            <input type="number" name="m_ticket_paidAmt" id="m_ticket_paidAmt" class="form-control" required value="<?= $paidAmt ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?>">
                                        <div class="form-group">
                                            <label>Payment Mode2</label>
                                            <select name="m_ticket_paytype2" id="m_ticket_paytype2" class="form-control select2" style="width:100%">
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
                                            <input type="number" name="m_ticket_paidAmt2" id="m_ticket_paidAmt2" class="form-control" value="<?= $paidAmt2 ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Balance</label>
                                            <input type="hidden" name="m_ticket_balAmt" id="m_ticket_balAmt" class="form-control m_ticket_balAmt" readonly value="<?= $balAmt ?>">
                                            <input type="number" class="form-control m_ticket_balAmt" disabled value="<?= $balAmt ?>">
                                        </div>
                                    </div>


                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Remark</label>
                                            <input type="text" name="m_ticket_remark" id="m_ticket_remark" class="form-control" value="<?= $remark ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <div class="form-group">
                                            <label>Customer Type</label>
                                            <select name="m_ticket_cusType" id="m_ticket_cusType" class="form-control select2">
                                                <option value="General" <?php if ($cusType  == 'General') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>General</option>
                                                <option value="Free" <?php if ($cusType == 'Free') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>Free</option>

                                            </select>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2 sidediv">
                                <h5>Rate Sheet (per person)</h5>
                                <div class="row">
                                    <?php $weekDay = date('w', strtotime(date('Y-m-d')));
                                    if ($weekDay == 0 || $weekDay == 6 || get_settings('is_today_holiday') == 1) {
                                        // $adult_rate =  get_settings('weekend_adult_rate');
                                        $adult_rate = get_rate_band('WEAR', 2);
                                        $adultnet = round(($adult_rate * 0.18) + $adult_rate);
                                        // $child_rate = get_settings('weekend_child_rate');
                                        $child_rate = get_rate_band('WECR', 2);
                                        $childnet = round(($child_rate * 0.18) + $child_rate);
                                    } else {
                                        // $adult_rate = get_settings('weekday_adult_rate');
                                        $adult_rate = get_rate_band('WDAR', 1);
                                        $adultnet = round(($adult_rate * 0.18) + $adult_rate);
                                        // $child_rate = get_settings('weekday_child_rate');
                                        $child_rate = get_rate_band('WDCR', 1);
                                        $childnet = round(($child_rate * 0.18) + $child_rate);
                                    }
                                    ?>
                                    <div class="col-md-12 itemdiv">Adult Base <span class="valuediv" id="adultbase"><?= $adult_rate ?></span></div>
                                    <div class="col-md-12 itemdiv">Adult Net <span class="valuediv" id="adultnet"><?= $adultnet ?></span></div>
                                    <div class="col-md-12 itemdiv">Child Base <span class="valuediv" id="childbase"><?= $child_rate ?></span></div>
                                    <div class="col-md-12 itemdiv">Child Net <span class="valuediv" id="childnet"><?= $childnet ?></span></div>
                                    <div class="col-md-12 itemdiv">GST <span class="valuediv" id="gst">18</span></div>

                                </div>
                            </div>

                            <div class="col-md-2 sidediv" style="<?php if ($paymode != "Credit") {
                                                                        echo 'display: none;';
                                                                    } ?> margin-top:5px;" id="allcreditdiv">
                                <h5>Allow Credits</h5>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="m_ticket_credit_allow[]" <?php if (in_array(1, $credit_allow)) {
                                                                                                                                echo 'checked';
                                                                                                                            } ?> value="1">
                                            <label class="form-check-label" for="m_ticket_credit_allow"> Locker</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="m_ticket_credit_allow[]" <?php if (in_array(2, $credit_allow)) {
                                                                                                                                echo 'checked';
                                                                                                                            } ?> value="2">
                                            <label class="form-check-label" for="m_ticket_credit_allow"> Costume</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="m_ticket_credit_allow[]" <?php if (in_array(3, $credit_allow)) {
                                                                                                                                echo 'checked';
                                                                                                                            } ?> value="3">
                                            <label class="form-check-label" for="m_ticket_credit_allow"> Restaurent</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12" style="margin-bottom: 10px;">
                                        <div class="form-group">
                                            <label>Responsible</label>
                                            <select name="m_ticket_resp_id" id="m_ticket_resp_id" class="form-control select2" style="width: 100%;">
                                                <option value="">Choose</option>
                                                <?php
                                                foreach ($emp_list as $emp) {
                                                    if ($resp_id == $emp->m_emp_id) {
                                                        $op = 'selected';
                                                    } else {
                                                        $op = '';
                                                    }

                                                ?>
                                                    <option value="<?php echo $emp->m_emp_id; ?>" <?= $op ?>><?php echo $emp->m_emp_name; ?></option>
                                                <?php
                                                }

                                                ?>

                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-layout-submit">
                                    <a href="<?php echo site_url('Shop'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-ticket-create" class="btn btn-block btn-info"> Submit</button>
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

<div id="plotmemberModal" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Plot Member list</h4>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <label>List of Sponsered Members</label>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th width="1%">Sn</th>
                                    <th>Member Name </th>
                                    <th>Aadhar No </th>
                                    <th>Mobile </th>

                                </thead>
                                <tbody id="modal_body_contant">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>


        </div>
    </div>
</div>

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
                                    <th>Adult </th>
                                    <th>Child </th>
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


<!--- opencamera model-->
<div id="opencameraModal" class="modal fade opencameraModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="camera_title"></h4>
            </div>
            <form method="POST" id="frm-lockerrefund" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            <video id="video" width="512px" height="512px" autoplay></video>
                            <canvas id="canvas" width="512px" height="512px" style="display:none;"></canvas>
                        </div>
                        <div class="col-md-12" style="text-align: center; margin-bottom:10px">
                            <button class="btn btn-success" id="captureBtn" type="button" style="padding: 15px 20px; font-size: large;">Capture</button>
                        </div>

                    </div>

                </div>

            </form>
        </div>
    </div>
</div>
<!--- opencamera model-->


<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/ticket_js');
$this->view('js/common_js');
?>
<!-- =======================/Footer================Fix=======