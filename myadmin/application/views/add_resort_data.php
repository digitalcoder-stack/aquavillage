<?php $this->view('top_header') ?>
<div class="page-content">
    <div class="container-fluid">
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <?php

                switch ($pagtype) {
                    case 1: {
                            $pagelink = "Restuarent/resort_data_list";
                            $tdtname = "Room";
                        }
                        break;
                    case 2: {
                            $pagelink = "Restuarent/camps_data_list";
                            $tdtname = "Camp";
                        }
                        break;
                }

                ?>
                <div class="col-md-3 col-sm-3 pull-right">
                    <div class="seipkon-breadcromb-right">
                        <a href="<?php echo site_url($pagelink); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All Entries </a>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
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
            $id           = $edit_value->r_resdata_id;
            $pagtype     = $edit_value->r_resdata_type;
            $date         = $edit_value->r_resdata_date;
            $cust_mobile  = $edit_value->r_resdata_mobile;
            $adult        = $edit_value->r_resdata_adult;
            $cust_name    = $edit_value->r_resdata_name;
            $child        = $edit_value->r_resdata_child;
            $custcity     = $edit_value->r_resdata_city;
            $cust_adrs       = $edit_value->r_resdata_address;
            $remark       = $edit_value->r_resdata_remark;
            $roomno         = $edit_value->r_resdata_roomno;
            $cashaccount  = $edit_value->r_resdata_act;
            $paidAmt       = $edit_value->r_resdata_amount;
            $paidAmt2      = $edit_value->r_resdata_amt2;
            $paytype       = $edit_value->r_resdata_paytype;
            $paytype2       = $edit_value->r_resdata_paytype2;
            $ispartial       = $edit_value->r_resdata_ispartial;
            $iscredit       = $edit_value->r_resdata_iscredit;
            $balamt       = $edit_value->r_resdata_balamt;
            $respon       = $edit_value->r_resdata_respon;
            $food_amt     = $edit_value->r_resdata_fpamt1;
            $rmqty        = $edit_value->r_resdata_rmqty;
        } else {
            $id = '';
            $date = date('Y-m-d');
            $cust_mobile = '';
            $adult = '';
            $cust_name = '';
            $child = '';
            $custcity = '';
            $cust_adrs = '';
            $remark = '';
            $roomno = '';
            $cashaccount = '';
            $paidAmt = '';
            $paidAmt2 = '';
            $paytype = 1;
            $paytype2 = 1;
            $ispartial = 0;
            $food_amt = '';
            $rmqty = '';
            $iscredit = 0;
            $balamt = '';
            $respon = '';
        }
        ?>
        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-resort-create" enctype="mutipart/form-data">
                        <div class="row">
                            <div class="col-md-2 ">
                                <div class="form-check">
                                    <input type="checkbox" <?php if ($iscredit == 1) {
                                                                echo 'checked';
                                                            } ?> class="form-check-input" id="r_resdata_iscredit" name="r_resdata_iscredit" value="1">
                                    <label class="form-check-label" for="r_resdata_iscredit"> Is Credit</label>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="hidden" name="r_resdata_type" id="r_resdata_type" class="form-control" value="<?= $pagtype ?>">
                                    <input type="hidden" name="r_resdata_id" id="r_resdata_id" class="form-control" value="<?= $id ?>">
                                    <input type="date" name="r_resdata_date" id="r_resdata_date" class="form-control" value="<?php if ($date == '') {
                                                                                                                                            echo date('Y-m-d');
                                                                                                                                        } else {
                                                                                                                                            echo $date;
                                                                                                                                        } ?>">
                                </div>
                            </div>


                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Mobile No.<span class="text-danger">*</span></label>
                                    <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="r_resdata_mobile" id="r_resdata_mobile" class="form-control" placeholder="Enter Mobile Number" required="" autofocus value="<?= $cust_mobile ?>">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Customer Name <span class="text-danger">*</span></label>
                                    <input type="text" name="r_resdata_name" id="r_resdata_name" class="form-control" placeholder="Enter Name" value="<?= $cust_name ?>" required>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4">

                                <div class="input-group">
                                    <label>City Name <span class="text-danger">*</span></label>
                                    <select name="r_resdata_city" id="stc_add_city" class="form-control select2" required>
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

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="r_resdata_address" id="r_resdata_address" class="form-control" value="<?= $cust_adrs ?>">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Adult <span class="text-danger">*</span></label>
                                    <input type="number" name="r_resdata_adult" id="r_resdata_adult" class="form-control amountcalculate" placeholder="Adult" required="" value="<?= $adult ?>">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Children <span class="text-danger">*</span></label>
                                    <input type="number" name="r_resdata_child" id="r_resdata_child" class="form-control amountcalculate" placeholder="Child" required="" value="<?= $child ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>No of <?= $tdtname ?>s <span class="text-danger">*</span></label>
                                    <select name="r_resdata_rmqty" id="r_resdata_rmqty" class="form-control select2">

                                        <?php
                                        $rccun = $pagtype == 1 ? 8 : 20;
                                        for ($i = 1; $i <= $rccun; $i++) {
                                            if ($rmqty == $i) {
                                                $op = 'selected';
                                            } else {
                                                $op = '';
                                            }
                                            echo ' <option value="' . $i . '" ' . $op . '>' . $i . '</option>';
                                        } ?>

                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label><?= $tdtname ?> No <span class="text-danger">*</span></label>
                                    <input type="text" name="r_resdata_roomno" id="r_resdata_roomno" class="form-control" placeholder="<?= $tdtname ?> No" value="<?= $roomno ?>">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4 creditdiv" <?php if ($iscredit != 1) {
                                                                                    echo 'style="display: none;"';
                                                                                } ?>>
                                <div class="form-group">
                                    <label>Balance Amount <span class="text-danger">*</span></label>
                                    <input type="number" name="r_resdata_balamt" id="r_resdata_balamt" class="form-control" value="<?= $balamt ?>">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4 creditdiv" <?php if ($iscredit != 1) {
                                                                                    echo 'style="display: none;"';
                                                                                } ?> id="respo_in">
                                <div class="form-group">
                                    <label>Credit Responsible</label>
                                    <select name="r_resdata_respon" id="r_resdata_respon" class="form-control select2" style="width: 100%;">
                                        <option value=""> -- select employee--</option>
                                        <?php
                                        foreach ($emp_list as $emp) {
                                            if ($respon == $emp->m_emp_id) {
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

                            <div class="col-lg-2 col-md-3 col-sm-4 cashdiv" <?php if ($iscredit == 1) {
                                                                                echo 'style="display: none;"';
                                                                            } ?> id="Amcounter_in">
                                <div class="form-group">
                                    <label>Cash Counter</label>
                                    <select name="r_resdata_act" id="r_resdata_act" class="form-control select2">
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

                            <div class="col-md-2 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?> height:65px; padding-top:30px">
                                <div class="form-check">
                                    <input type="checkbox" <?php if ($ispartial == 1) {
                                                                echo 'checked';
                                                            } ?> class="form-check-input" id="r_resdata_ispartial" name="r_resdata_ispartial" value="1">
                                    <label class="form-check-label" for="r_resdata_ispartial"> Partial Payment</label>
                                </div>
                            </div>


                            <div class="col-lg-2 col-md-3 col-sm-4 cashdiv" <?php if ($iscredit == 1) {
                                                                                echo 'style="display: none;"';
                                                                            } ?> id="Ampayty_in">
                                <div class="form-group">
                                    <label>Payment Mode</label>
                                    <select name="r_resdata_paytype" id="r_resdata_paytype" class="form-control select2">

                                        <option value="partial" id="partial_op">Partial Payment</option>
                                        <option value="1" <?php if ($paytype == 1) echo 'selected' ?>>Cash</option>
                                        <option value="2" <?php if ($paytype == 2) echo 'selected' ?>>Paytm</option>
                                        <option value="3" <?php if ($paytype == 3) echo 'selected' ?>>Phone Pay</option>
                                        <option value="4" <?php if ($paytype == 4) echo 'selected' ?>>Other</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4 cashdiv" <?php if ($iscredit == 1) {
                                                                                echo 'style="display: none;"';
                                                                            } ?>>
                                <div class="form-group">
                                    <label>Amount Paid <span class="text-danger">*</span></label>
                                    <input type="number" name="r_resdata_amount" id="r_resdata_amount" class="form-control" required value="<?= $paidAmt ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?>">
                                <div class="form-group">
                                    <label>Payment Mode2</label>
                                    <select name="r_resdata_paytype2" id="r_resdata_paytype2" class="form-control select2" style="width:100%">
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
                                    <input type="number" name="r_resdata_amt2" id="r_resdata_amt2" class="form-control" value="<?= $paidAmt2 ?>">
                                </div>
                            </div>

                            <?php if (!empty($edit_value)) { ?>
                                <div class="col-lg-2 col-md-3 col-sm-4 fcashdiv fpaypartial" style="<?php if ($edit_value->r_resdata_fispartial != 1) echo 'display: none;' ?> height:65px; padding-top:30px">
                                    <div class="form-check">
                                        <input type="checkbox" <?php if ($edit_value->r_resdata_fispartial == 1) {
                                                                    echo 'checked';
                                                                } ?> class="form-check-input r_resdata_fispartial" id="r_resdata_fispartial<?= $edit_value->r_resdata_id ?>" data-resdit="<?= $edit_value->r_resdata_id ?>" name="r_resdata_fispartial" value="1">
                                        <label class="form-check-label" for="r_resdata_fispartial"> Partial Payment</label>
                                    </div>
                                </div>


                                <div class="col-lg-2 col-md-3 col-sm-4 fcashdiv" <?php if ($edit_value->r_resdata_iscredit == 1) {
                                                                                        echo 'style="display: none;"';
                                                                                    } ?> id="Ampayty_in">
                                    <div class="form-group">
                                        <label>Payment Mode</label>
                                        <select name="r_resdata_fpmode1" id="r_resdata_fpmode1<?= $edit_value->r_resdata_id ?>" data-resdit="<?= $edit_value->r_resdata_id ?>" class="form-control select2 r_resdata_fpmode1" style="width: 100%;">

                                            <option value="1" <?php if ($edit_value->r_resdata_fpmode1 == 1) echo 'selected' ?>>Cash</option>
                                            <option value="2" <?php if ($edit_value->r_resdata_fpmode1 == 2) echo 'selected' ?>>Paytm</option>
                                            <option value="3" <?php if ($edit_value->r_resdata_fpmode1 == 3) echo 'selected' ?>>Phone Pay</option>
                                            <option value="4" <?php if ($edit_value->r_resdata_fpmode1 == 4) echo 'selected' ?>>Other</option>
                                            <option value="partial" id="partial_op<?= $edit_value->r_resdata_id ?>">Partial Payment</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-3 col-sm-4 fcashdiv" <?php if ($edit_value->r_resdata_iscredit == 1) {
                                                                                        echo 'style="display: none;"';
                                                                                    } ?>>
                                    <div class="form-group">
                                        <label>Food Amount <span class="text-danger">*</span></label>
                                        <input type="number" name="r_resdata_fpamt1" id="r_resdata_fpamt1<?= $edit_value->r_resdata_id ?>" class="form-control" required value="<?= $edit_value->r_resdata_fpamt1 ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-4 fcashdiv fpaypartial" style="<?php if ($edit_value->r_resdata_fispartial != 1) echo 'display: none;' ?>">
                                    <div class="form-group">
                                        <label>Payment Mode2</label>
                                        <select name="r_resdata_fpmode2" id="r_resdata_fpmode2<?= $edit_value->r_resdata_id ?>" class="form-control select2" style="width:100%">
                                            <option value="1" <?php if ($edit_value->r_resdata_fpmode2 == 1) echo 'selected' ?>>Cash</option>
                                            <option value="2" <?php if ($edit_value->r_resdata_fpmode2 == 2) echo 'selected' ?>>Paytm</option>
                                            <option value="3" <?php if ($edit_value->r_resdata_fpmode2 == 3) echo 'selected' ?>>Phone Pay</option>
                                            <option value="4" <?php if ($edit_value->r_resdata_fpmode2 == 4) echo 'selected' ?>>Other</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-3 col-sm-4 fcashdiv fpaypartial" style="<?php if ($edit_value->r_resdata_fispartial != 1) echo 'display: none;' ?>">
                                    <div class="form-group">
                                        <label>Food Amount2 </label>
                                        <input type="number" name="r_resdata_fpamt2" id="r_resdata_fpamt2<?= $edit_value->r_resdata_id ?>" class="form-control" value="<?= $edit_value->r_resdata_fpamt2 ?>">
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Remark</label>
                                    <input type="text" name="r_resdata_remark" id="r_resdata_remark" class="form-control" value="<?= $remark ?>">
                                </div>
                            </div>


                        </div>
                </div>

            </div>



            <!---------------5th row completed--------------->

            <div class="row">
                <div class="col-md-3">
                    <div class="form-layout-submit">
                        <a href="<?php echo site_url($pagelink); ?>" class="btn btn-block btn-danger">Cancel</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-layout-submit">
                        <button type="submit" id="btn-resort-create" class="btn btn-block btn-info"> Submit</button>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>

<!-- ========================/View=================Fix======= -->

<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/restuarent_js');
$this->view('js/common_js');
?>
<!-- =======================/Footer================Fix=======