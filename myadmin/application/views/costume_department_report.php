<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pagename ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    .table>:not(caption)>*>* {
        padding: 0px !important;
    }

    .color {
        background-color: #aeaeae8a !important;
    }

    td,
    th {
        text-transform: uppercase;
        vertical-align: middle;
    }

    @media print {
        .no-print {
            display: none !important;
        }

    }
</style>

<body class="p-2">
    <!-- Start Breadcromb Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area" style="box-shadow: none;">
                <div class="row">
                    <div class="col-md-4  col-sm-4">
                        <div class="seipkon-breadcromb-left">
                            <h3><?= $pagename ?></h3>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="seipkon-breadcromb-right" style="text-align: end;">
                            <a onclick="printcustomdiv()" class="btn btn-success btn-sm">
                                <i class="fa fa-printer me-2"></i>Print
                            </a>
                            <a onclick="window.history.go(-1)" class="btn btn-danger btn-sm">
                                <i class="fa fa-box-arrow-left me-2"></i>Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcromb Row -->
    <div class="printDiv">
        <table class="table table-bordered text-center mb-0">
            <tr>
                <th colspan="7" class="color">COSTUME DEPARTMENT</th>
            </tr>
            <tr>
                <td>Authorised</td>
                <td colspan="2"></td>
                <td>date & sign</td>
                <td colspan="3" style="width: 40%;"><?= date('d-m-Y', strtotime($date)) ?></td>
            </tr>
            <tr>
                <th colspan="7" class="color">REPORT</th>
            </tr>
            <tr>
                <td>particulars</td>
                <td colspan="2">total rent</td>
                <td>totalling</td>
                <td rowspan="4" colspan="3">Rejected goods:-
                    <?= $cos_data['damage_item'] ?>
                </td>
            </tr>
            <tr>
                <td>costume</td>
                <td colspan="2"><?= $cos_data['Costume_rent'] ?></td>
                <td>₹<?= $cos_data['Costume_rent'] ?></td>
            </tr>
            <tr>
                <td>lockers</td>
                <td colspan="2"><?= $cos_data['Locker_rent'] ?></td>
                <td>₹<?= $cos_data['Locker_rent'] ?></td>
            </tr>
            <tr>
                <td colspan="3" style="width: 40%;">rent total</td>
                <td>₹<?= ($cos_data['Costume_rent'] + $cos_data['Locker_rent']) ?></td>
            </tr>
            <tr>
                <td class="text-start">selling products</td>
                <td style="width: 80px;">rate</td>
                <td style="width: 80px;">qty</td>
                <td>total</td>
                <td>sale today</td>
                <td>old stock</td>
                <td>final stock</td>
            </tr>
            <?php $sel_total = 0;
            if (!empty($cos_data['product_list'])) {
                foreach ($cos_data['product_list'] as $key => $value) {
                    $sel_total += $value['product_sale_amt'];
                    echo ' <tr>
              <td class="text-start">' . $value['product_name'] . '</td>
              <td>₹' . $value['product_rate'] . '</td>
              <td>' . $value['product_qty_sale'] . '</td>
              <td>₹' . $value['product_sale_amt'] . '</td>
              <td>' . $value['product_qty_sale'] . '</td>
              <td>' . $value['product_old_stock'] . '</td>
              <td>' . $value['product_final_stock'] . '</td>
          </tr>';
                }
            } ?>


            <tr>
                <td colspan="3">selling totalling</td>
                <td>₹<?= $sel_total ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="fw-bold">
                <td class="fs-5">EXTRA</td>
                <td colspan="2" class="color">₹<?= $cos_data['Costume_voucher'] ?></td>
                <td class="color p-0">
                    <div class="row align-items-stretch" style="height: 40px;">
                        <div class="col-6">
                            <div class="bg-white h-100 d-flex align-items-center justify-content-center fs-5">
                                LOSS
                            </div>
                        </div>
                    </div>
                </td>
                <td colspan="2" class="fs-5">FINAL TOTALLING</td>
                <td>₹<?= ($cos_data['Costume_total'] + $cos_data['Costume_voucher']) ?></td>
            </tr>
        </table>

        <table class="table table-bordered text-center mb-0">
            <!-- //////////////////////////////////// -->

            <tr>
                <th class="color" colspan="4">Paytm/PhonePe/Others</th>
                <th class="color" colspan="8">Free / Balance Entry details</th>
            </tr>
            <tr>
                <td colspan="4" style="vertical-align:top;">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <td>s.no</td>
                            <td>Name</td>
                            <td>amount</td>
                            <td>sign</td>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>Paytm</td>
                            <td><?= $cos_data['Costume_Paytm'] ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Phone Pay</td>
                            <td><?= $cos_data['Costume_PhoneP'] ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Other</td>
                            <td><?= $cos_data['Costume_other'] ?></td>
                            <td></td>
                        </tr>

                    </table>
                </td>
                <td colspan="8" style="vertical-align:top;">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <td>S.no</td>
                            <td colspan="2">Name</td>
                            <td>Locker</td>
                            <td>Costume</td>
                            <td>Total</td>
                            <td colspan="2">approval</td>
                            <td colspan="2">Sign</td>
                        </tr>

                        <!-- voucher loop start -->
                        <?php if (!empty($report_list_data['tick_balnce'])) {
                            foreach ($report_list_data['tick_balnce'] as $key => $value) {
                                if ($value->locker_balamt != 0 || $value->costume_balamt != 0) {
                                    echo ' <tr>
                                  <td>' . ($key + 1) . '</td>
                                  <td colspan="2">' . $value->m_cust_name . ' - ' . $value->m_cust_mobile . ' </td>
                                  <td >' . $value->locker_balamt . '</td>
                                  <td >' . $value->costume_balamt . '</td>
                                  <td >₹' . ($value->locker_balamt + $value->costume_balamt) . '</td>
                                  <td colspan="2">by ' . $value->m_emp_name . '</td>
                                  <td></td>
                             
                              </tr>';
                                } else if ($value->free_locker != 0 || $value->free_costume != 0) {
                                    echo ' <tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td colspan="2">' . $value->m_cust_name . ' - ' . $value->m_cust_mobile . ' </td>
                                    <td >' . $value->free_locker . '</td>
                                    <td >' . $value->free_costume . '</td>
                                    <td >₹' . ($value->locker_balamt + $value->costume_balamt) . '</td>
                                    <td colspan="2">by ' . $value->m_emp_name . '</td>
                                    <td></td>
                               
                                </tr>';
                                }
                            }
                        } else {
                            echo '<tr>
                        <td colspan="12"> N/A </td>
                         </tr>';
                        } ?>

                        <!-- voucher loop end -->
                    </table>
                </td>
            </tr>
            <tr>
                <th class="color text-start" colspan="2">Total UPI</th>

                <th colspan="2"> ₹<?= $cos_data['Costume_Upi'] ?></th>
                <th class="color text-start" colspan="5">Total Balance</th>

                <th colspan="3"> ₹<?= $cos_data['Costume_balance'] ?></th>


            </tr>
            <tr>
                <th class="color" colspan="6">Expenses / Discount</th>
                <th class="color" colspan="6">Vouchers / Package Advance</th>
            </tr>
            <tr>
                <td colspan="6" style="vertical-align:top;">
                    <table class="table table-bordered mb-0">
                        <tr>
                        <tr>
                            <td>S.no</td>
                            <td colspan="2">Name</td>
                            <td>Amount</td>
                            <td>Details</td>
                            <td>Sign</td>
                        </tr>
            </tr>
            <!-- loop start -->
            <?php $total_expense = 0;
            if (!empty($report_list_data['expense_list'])) {

                foreach ($report_list_data['expense_list'] as $key => $value) {
                    $total_expense += $value->m_expense_amt;
                    echo ' <tr>
                                <td>' . ($key + 1) . '</td>
                                <td colspan="2">' . $value->m_prodcat_name . ' (' . $value->m_dept_name . ')</td>
                                <td>₹' . ($value->m_expense_amt) . '</td>
                                <td>' . $value->m_cashacc_name . ' by ' . $value->m_admin_name . '</td>
                                <td></td>
                            </tr>';
                }
            } else {
                echo '<tr>
                    <td colspan="6">N/A</td>
                  
                </tr>';
            }  ?>


            <!-- loop end -->
        </table>
        </td>
        <td colspan="6" style="vertical-align:top;">
            <table class="table table-bordered mb-0">
                <tr>
                <tr>
                    <td>S.no</td>
                    <td colspan="2">Name</td>
                    <td>Amount</td>
                    <td>Details</td>
                    <td>Sign</td>
                </tr>
                </tr>

                <!-- voucher loop start -->
                <?php
                $Tovoucher = 0;
                if (!empty($report_list_data['voucher_list'])) {

                    foreach ($report_list_data['voucher_list'] as $key => $value) {
                        $Tovoucher +=  $value->m_expense_amt;
                        echo ' <tr>
                                <td>' . ($key + 1) . '</td>
                                <td colspan="2">' . $value->m_prodcat_name . ' (' . $value->m_dept_name . ')</td>
                                <td>₹' . ($value->m_expense_amt) . '</td>
                                <td>' . $value->m_cashacc_name . ' by ' . $value->m_admin_name . '</td>
                                <td></td>
                            </tr>';
                    }
                } else {
                    echo '<tr>
                    <td colspan="6">N/A</td>
                  
                </tr>';
                }  ?>

                <!-- voucher loop end -->
            </table>
        </td>
        </tr>
        <tr>
            <th class="color text-start" colspan="4">Total Expense</th>

            <th colspan="2"> ₹<?= $total_expense ?></th>
            <th class="color text-start" colspan="3">Total Voucher</th>

            <th colspan="2"> ₹<?= $Tovoucher ?></th>


        </tr>

        <!-- //////////////////////////////////// -->


        <tr>
            <td class="text-start" colspan="12" style="height: 80px;">remark (group if any,attach details)
          
            <p><?= '<b>Missing Items : </b>'. $cos_data['missing_items']?></p>
        </td>
        </tr>
        </table>

        <table class="table table-bordered text-center mb-0">
            <tr>
                <th colspan="7" class="color">for office use only</th>
            </tr>
            <tr>
                <td rowspan="2">sign</td>
                <td rowspan="2">department</td>
                <td colspan="2">amount</td>
                <td rowspan="2">expense/balance</td>
                <td rowspan="2">cash total</td>
                <td rowspan="2">handover detalis</td>
            </tr>
            <tr>
                <td>total</td>
                <td>PHONEPE/upi</td>
            </tr>
            <tr>
                <td rowspan="2"></td>
                <td rowspan="2">costume</td>
                <td rowspan="2"><?= ($cos_data['Costume_total'] + $cos_data['Costume_voucher']) ?></td>
                <td rowspan="2"><?= $cos_data['Costume_Upi'] ?></td>
                <td rowspan="2"><?= ($cos_data['Costume_balance'] + $cos_data['Costume_discount']) ?></td>
                <td rowspan="2"><?= ($cos_data['Costume_total'] + $cos_data['Costume_voucher'] - $cos_data['Costume_discount'] - $cos_data['Costume_balance'] - $cos_data['Costume_Upi']) ?></td>
                <td class="text-start">name :-</td>
            </tr>
            <tr>
                <td class="text-start">sign :-</td>
            </tr>
        </table>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };

    function printcustomdiv() {
        printDiv = ".printDiv"; // id of the div you want to print
        $("*").addClass("no-print");
        $(printDiv + " *").removeClass("no-print");
        $(printDiv).removeClass("no-print");

        parent = $(printDiv).parent();
        while ($(parent).length) {
            $(parent).removeClass("no-print");
            parent = $(parent).parent();
        }
        window.print();

    }
</script>

</html>