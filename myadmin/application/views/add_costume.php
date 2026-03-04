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
                <div class="col-md-3 col-sm-3 pull-right">
                    <div class="seipkon-breadcromb-right">
                        <a href="<?php echo site_url('Shop/costume_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All costumes </a>
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
                font-size: 15px !important;
                padding: 4px !important;
            }
        </style>

        <?php if (!empty($edit_value)) {
            $id           = $edit_value->m_costume_id;
            $date         = $edit_value->m_costume_date;
            $cashaccount  = $edit_value->m_costume_counter;
            $cust_mobile  = $edit_value->m_cust_mobile;
            $cust_name    = $edit_value->m_cust_name;
            $Trent     = $edit_value->m_costume_Trent;
            $Tqty       = $edit_value->m_costume_Tqty;
            $payableAmt     = $edit_value->m_costume_payableAmt;
            $Tdeposit       = $edit_value->m_costume_Tdeposit;
            $paidAmt      = $edit_value->m_costume_paidAmt;
            $balAmt       = $edit_value->m_costume_balAmt;
            $remark       = $edit_value->m_costume_remark;
            $ticket_id       = $edit_value->m_costume_ticket_id;
            $customer_id       = $edit_value->m_costume_customer;
            $m_costume_cosid       = $edit_value->m_costume_cosid;
            $editqty = explode(',', $edit_value->m_costume_Tqty);
            $editcosid = explode(',', $edit_value->m_costume_cosid);
            $counterid       = count($editcosid);
            $paidAmt2      = $edit_value->m_costume_paidAmt2;
            $paytype       = $edit_value->m_costume_paytype;
            $paytype2       = $edit_value->m_costume_paytype2;
            $ispartial       = $edit_value->m_costume_ispartial;
            $credit_allow       = $edit_value->m_costume_iscredit;
        } else {
            $id = '';
            $date = '';
            $cashaccount = '';
            $cust_mobile = $user_lst->m_cust_mobile;
            $cust_name = $user_lst->m_cust_name;
            $remark = '';
            $Trent = 0;
            $Tqty   = 0;
            $payableAmt = 0;
            $Tdeposit   = 0;
            $paidAmt  = '';
            $balAmt   = 0;
            $ticket_id   = $user_lst->m_ticket_id;
            $customer_id   = $user_lst->m_ticket_customer;
            $m_costume_cosid   = '';
            $editqty   = '';
            $editcosid   = '';
            $editqtyyy   = '';
            $counterid   = 0;
            $paidAmt2      = 0;
            $paytype       = 1;
            $paytype2       = '';
            $ispartial       = 0;

            if ($user_lst->m_ticket_paymode == 'Credit') {
                $HiddenProducts = explode(',', $user_lst->m_ticket_credit_allow);
                if (in_array(2, $HiddenProducts)) {
                    $credit_allow = 1;
                } else {
                    $credit_allow = 0;
                }
            }else if($user_lst->m_ticket_cusType == 'Free'){
                $HiddenProducts = explode(',', $user_lst->m_ticket_credit_allow);
                if (in_array(2, $HiddenProducts)) {
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
                    <form method="post" action="#" id="frm-costume-create" enctype="mutipart/form-data">
                        <div class="row">
                            <input type="hidden" name="is_credit_allow" id="is_credit_allow" class="form-control" value="<?= $credit_allow ?>">
                            <input type="hidden" name="m_costume_id" id="m_costume_id" class="form-control" value="<?= $id ?>">
                            <div class="col-md-3" id="Amcounter_in">
                                <div class="form-group ">
                                    <label>Cash Account</label>
                                    <select name="m_costume_counter" id="m_costume_counter" class="form-control select2">
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
                            <div class="col-md-3" style="float: right;">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="m_costume_date" id="m_costume_date" class="form-control" readonly value="<?php if ($date == '') {
                                                                                                                                            echo date('Y-m-d');
                                                                                                                                        } else {
                                                                                                                                            echo $date;
                                                                                                                                        } ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="number" class="form-control" id="m_cust_mobile" name="m_cust_mobile" value="<?= $cust_mobile ?>" readonly />

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="m_cust_name" id="m_cust_name" class="form-control" placeholder="Enter Name" value="<?= $cust_name ?>" readonly>
                                    <input type="hidden" name="m_costume_ticket_id" id="m_costume_ticket_id" class="form-control" value="<?= $ticket_id ?>">
                                    <input type="hidden" name="m_costume_customer" id="m_costume_customer" class="form-control" value="<?= $customer_id ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>List of Costumes Rent out</label>
                                        <table class=" table table-striped table-bordered" style="display: block; height: auto;overflow: visible;">
                                            <thead>
                                                <th width="1%">Sn</th>
                                                <th>Title </th>
                                                <th>Rent </th>
                                                <th>Deposit </th>
                                                <th>Total Chargeable </th>
                                                <th>Qty</th>
                                            </thead>
                                            <tbody>

                                                <?php if (!empty($cosCode)) {
                                                    $i = 0;
                                                    $j = 0;
                                                    foreach ($cosCode as $catB) {
                                                        if (!empty($editqty) && !empty($editcosid)) {
                                                            if ($j < $counterid) {
                                                                if ($editcosid[$j] == $catB->m_product_id) {
                                                                    $editqtyyy = $editqty[$j];
                                                                    $j++;
                                                                } else {
                                                                    $editqtyyy = '';
                                                                };
                                                            }
                                                        }

                                                        $i++; ?>
                                                        <tr>
                                                            <td><?= $i ?></td>
                                                            <td><?= $catB->m_product_name ?></td>
                                                            <td><?= $catB->m_product_rent ?></td>
                                                            <td><?= $catB->m_product_deposit ?></td>
                                                            <td><?= $catB->m_product_rent + $catB->m_product_deposit ?></td>
                                                            <td><input type="number" name="m_costume_Tqty[]" class="catclick" data-rent="<?= $catB->m_product_rent ?>" data-deposit="<?= $catB->m_product_deposit ?>" data-costumecode_id="<?= $catB->m_product_id ?>" value="<?= $editqtyyy ?>" autofocus>
                                                                <input type="hidden" name="rentsum[]" id="rentsum<?= $catB->m_product_id ?>" class="rentsum" data-cosid="<?= $catB->m_product_id ?>">
                                                                <input type="hidden" name="depositsum[]" id="depositsum<?= $catB->m_product_id ?>" class="depositsum">

                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Total Rent</label>
                                                    <input type="hidden" name="m_costume_cosid" id="m_costume_cosid" class="form-control" value="<?= $m_costume_cosid ?>">
                                                    <input type="number" name="m_costume_Trent" id="m_costume_Trent" class="form-control" readonly value="<?= $Trent ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Total Deposit</label>
                                                    <input type="number" name="m_costume_Tdeposit" id="m_costume_Tdeposit" class="form-control" readonly value="<?= $Tdeposit ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Total Payable</label>
                                                    <input type="number" name="m_costume_payableAmt" id="m_costume_payableAmt" class="form-control" readonly value="<?= $payableAmt ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?> padding-top:30px; height:65px;">
                                                <div class="form-check">
                                                    <input type="checkbox" <?php if ($ispartial == 1) {
                                                                                echo 'checked';
                                                                            } ?> class="form-check-input" id="m_costume_ispartial" name="m_costume_ispartial" value="1">
                                                    <label class="form-check-label" for="m_costume_ispartial"> Partial Payment</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6 col-md-6 col-sm-6 cashdiv" style="display: block;" id="Ampayty_in">
                                                <div class="form-group">
                                                    <label>Payment Mode</label>
                                                    <select name="m_costume_paytype" id="m_costume_paytype" class="form-control select2">

                                                        <option value="partial" id="partial_op">Partial Payment</option>
                                                        <option value="1" <?php if ($paytype == 1) echo 'selected' ?>>Cash</option>
                                                        <option value="2" <?php if ($paytype == 2) echo 'selected' ?>>Paytm</option>
                                                        <option value="3" <?php if ($paytype == 3) echo 'selected' ?>>Phone Pay</option>
                                                        <option value="4" <?php if ($paytype == 4) echo 'selected' ?>>Other</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label>Amount Paid</label>
                                                    <input type="number" name="m_costume_paidAmt" id="m_costume_paidAmt" class="form-control" required value="<?= $paidAmt ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?>">
                                                <div class="form-group">
                                                    <label>Payment Mode2</label>
                                                    <select name="m_costume_paytype2" id="m_costume_paytype2" class="form-control select2" style="width:100%">
                                                        <option value="1" <?php if ($paytype2 == 1) echo 'selected' ?>>Cash</option>
                                                        <option value="2" <?php if ($paytype2 == 2) echo 'selected' ?>>Paytm</option>
                                                        <option value="3" <?php if ($paytype2 == 3) echo 'selected' ?>>Phone Pay</option>
                                                        <option value="4" <?php if ($paytype2 == 4) echo 'selected' ?>>Other</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?>">
                                                <div class="form-group">
                                                    <label>Amount Paid2</label>
                                                    <input type="number" name="m_costume_paidAmt2" id="m_costume_paidAmt2" class="form-control" value="<?= $paidAmt2 ?>">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Balance</label>
                                                    <input type="number" name="m_costume_balAmt" id="m_costume_balAmt" class="form-control" readonly value="<?= $balAmt ?>">
                                                </div>
                                            </div>


                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Remark</label>
                                                    <input type="text" name="m_costume_remark" id="m_costume_remark" class="form-control" value="<?= $remark ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-costume-create" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-layout-submit"><a href="<?php echo site_url('Shop/costume_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
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
$this->view('js/costume_js');

if (empty($edit_value) && empty($user_lst)) {
    echo '<script type="text/javascript"> 
    swal("Cannot add Costume of previous date ticket", {icon: "error", timer: 2000, });
    setTimeout(function(){ window.location = "' . site_url('Shop/costume_list') . '"; },2000);
    </script>';
}

?>