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
                        <a href="<?php echo site_url('Shop/sales_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All sales </a>
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
            $id           = $edit_value->m_sales_id;
            $date         = $edit_value->m_sales_date;
            $cashaccount  = $edit_value->m_sales_counter;
            $cust_mobile  = $edit_value->m_cust_mobile;
            $cust_name    = $edit_value->m_cust_name;
            $Ttextable     = $edit_value->m_sales_Ttextable;
            $Tqty       = $edit_value->m_sales_Tqty;
            $netAmt     = $edit_value->m_sales_netAmt;
            $gst       = $edit_value->m_sales_gst;
            $remark       = $edit_value->m_sales_remark;
            $ticket_id       = $edit_value->m_sales_ticket_id;
            $customer_id       = $edit_value->m_sales_customer;
            $m_sales_prodid       = $edit_value->m_sales_prodid;
            $paymode       = $edit_value->m_sales_paymode;
            $sales_no       = $edit_value->m_sales_no;
            $editqty = explode(',', $edit_value->m_sales_Tqty);
            $editcosid = explode(',', $edit_value->m_sales_prodid);
            $counterid       = count($editcosid);
            $paidAmt      = $edit_value->m_sales_paidAmt;
            $paidAmt2      = $edit_value->m_sales_paidAmt2;
            $paytype       = $edit_value->m_sales_paytype;
            $paytype2       = $edit_value->m_sales_paytype2;
            $ispartial       = $edit_value->m_sales_ispartial;
            // $catGid       = $edit_value->m_sales_G;
        } else {

            $id = '';
            $date = '';
            $cashaccount = '';
            $cust_mobile = '';
            $cust_name = '';
            $remark = '';
            $Ttextable = 0;
            $Tqty   = 0;
            $netAmt = 0;
            $gst   = 0;

            $ticket_id   = '';
            $customer_id   = '';
            $m_sales_prodid   = '';
            $sales_no   = 'SL/' . (rand(10, 10000));
            $editqty   = '';
            $editcosid   = '';
            $editqtyyy   = '';
            $paymode   = 1;
            $counterid   = 0;
            $paidAmt   = '';
            $paidAmt2      = "";
            $paytype       = 1;
            $paytype2       = "";
            $ispartial       = 0;
        }
        ?>

        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-sales-create" enctype="mutipart/form-data">
                        <div class="row">
                            <input type="hidden" name="m_sales_id" id="m_sales_id" class="form-control" value="<?= $id ?>">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Pay Mode</label>
                                    <select name="m_sales_paymode" id="m_sales_paymode" class="form-control">
                                        <option value="1" <?php if ($paymode == 1) echo 'selected' ?>>Cash</option>
                                        <option value="2" <?php if ($paymode == 2) echo 'selected' ?>>Credit</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2" id="Amcounter_in">
                                <div class="form-group ">
                                    <label>Cash Account</label>
                                    <select name="m_sales_counter" id="m_sales_counter" class="form-control select2">
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

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="text" list="usersdtl" placeholder="Enter Here" class="form-control" id="m_cust_mobile" name="m_cust_mobile" value="<?= $cust_mobile ?>" required />
                                    <datalist id="usersdtl">
                                        <?php
                                        foreach ($user_lst as $ukey) {
                                        ?>
                                            <option value="<?php echo $ukey->m_cust_mobile; ?>" <?= $op ?> data-tickId="<?= $ukey->m_ticket_id ?>" data-custId="<?= $ukey->m_ticket_customer ?>" data-custname="<?= $ukey->m_cust_name ?>"><?php echo $ukey->m_cust_mobile . ' | ' . $ukey->m_cust_name; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="m_cust_name" id="m_cust_name" class="form-control" placeholder="Enter Name" value="<?= $cust_name ?>">
                                    <input type="hidden" name="m_sales_ticket_id" id="m_sales_ticket_id" class="form-control" value="<?= $ticket_id ?>">
                                    <input type="hidden" name="m_sales_customer" id="m_sales_customer" class="form-control" value="<?= $customer_id ?>">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Sale No</label>
                                    <input type="text" name="m_sales_no" id="m_sales_no" class="form-control" value="<?= $sales_no ?>">

                                </div>
                            </div>
                            <div class="col-md-2" style="float: right;">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="m_sales_date" id="m_sales_date" class="form-control" required="" value="<?php if ($date == '') {
                                                                                                                                            echo date('Y-m-d');
                                                                                                                                        } else {
                                                                                                                                            echo $date;
                                                                                                                                        } ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>List of saless Rent out</label>
                                        <table class=" table table-striped table-bordered" style="display: block; height: auto;overflow-y: visible;">
                                            <thead>
                                                <th width="1%">Sn</th>
                                                <th>Product Name </th>
                                                <th>Unit </th>
                                                <th>Rate </th>
                                                <th>GST% </th>
                                                <th>Taxable </th>
                                                <th>NetRate </th>
                                                <th>Qty</th>
                                                <th>Amount</th>
                                            </thead>
                                            <tbody>

                                                <?php if (!empty($products)) {
                                                    $i = 0;
                                                    $j = 0;
                                                    foreach ($products as $catB) {
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
                                                            <td><?= $catB->m_produnit_name ?></td>
                                                            <td><?= $catB->m_product_sale_rate ?></td>
                                                            <td><?= $catB->is_gst_notapplicable == 1 ? 0 : $catB->m_product_GSTgroup ?></td>
                                                            <td><?= $catB->m_product_sale_rate ?></td>
                                                            <td><?= $catB->m_product_sale_rate ?></td>
                                                            <td><input type="number" name="m_sales_Tqty[]" class="catclick" data-rate="<?= $catB->m_product_sale_rate ?>" data-product_id="<?= $catB->m_product_id ?>" value="<?= $editqtyyy ?>"></td>
                                                            <td id="tamt<?= $catB->m_product_id ?>" data-id="<?= $catB->m_product_id ?>" class="ratesum"></td>
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
                                                    <label>Total Textable</label>
                                                    <input type="hidden" name="m_sales_prodid" id="m_sales_prodid" class="form-control" value="<?= $m_sales_prodid ?>">
                                                    <input type="number" name="m_sales_Ttextable" id="m_sales_Ttextable" class="form-control" readonly value="<?= $Ttextable ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label>GST</label>
                                                    <input type="number" name="m_sales_gst" id="m_sales_gst" class="form-control" readonly value="<?= $gst ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?> margin-top:30px">
                                                <div class="form-check">
                                                    <input type="checkbox" <?php if ($ispartial == 1) {
                                                                                echo 'checked';
                                                                            } ?> class="form-check-input" id="m_sales_ispartial" name="m_sales_ispartial" value="1">
                                                    <label class="form-check-label" for="m_sales_ispartial"> Partial Payment</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6 col-md-6 col-sm-6 cashdiv" style="display: block;" id="Ampayty_in">
                                                <div class="form-group">
                                                    <label>Payment Mode</label>
                                                    <select name="m_sales_paytype" id="m_sales_paytype" class="form-control select2">

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
                                                    <input type="number" name="m_sales_paidAmt" id="m_sales_paidAmt" class="form-control" required value="<?= $paidAmt ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 cashdiv paypartial" style="<?php if ($ispartial != 1) echo 'display: none;' ?>">
                                                <div class="form-group">
                                                    <label>Payment Mode2</label>
                                                    <select name="m_sales_paytype2" id="m_sales_paytype2" class="form-control select2" style="width:100%">
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
                                                    <input type="number" name="m_sales_paidAmt2" id="m_sales_paidAmt2" class="form-control" value="<?= $paidAmt2 ?>">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Net Amount</label>
                                                    <input type="number" name="m_sales_netAmt" id="m_sales_netAmt" class="form-control" readonly value="<?= $netAmt ?>">
                                                </div>
                                            </div>


                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Remark</label>
                                                    <input type="text" name="m_sales_remark" id="m_sales_remark" class="form-control" value="<?= $remark ?>">
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
                                    <button type="submit" id="btn-sales-create" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php if (!empty($id)) { ?>
                                    <div class="form-layout-submit"><a href="<?php echo site_url('Shop/sales_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                    <?php } else { ?>
                                        <div class="form-layout-submit"><a href="<?php echo site_url('Shop/add_sales'); ?>" class="btn btn-block btn-danger">Reset</a>
                                        <?php } ?>
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
$this->view('js/sales_js');
?>