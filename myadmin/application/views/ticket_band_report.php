<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pagename ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

    th {
        font-size: 14px;
    }

    td {
        font-size: 13px;
    }

    @media print {
        .no-print {
            display: none !important;
        }

    }
</style>


<body class="p-2">

    <!-- Breadcromb Row Start -->
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
                <th class="color" colspan="12">reception</th>
            </tr>
            <tr>
                <td colspan="2" style="width: 20%;">authorised</td>
                <td colspan="2"></td>
                <td colspan="2">date</td>
                <td colspan="2"><?= date('d-m-Y', strtotime($date)) ?></td>
                <td colspan="2">sign</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <th class="color" colspan="12">report</th>
            </tr>
            <tr>
                <td colspan="2" style="width: 20%;">water park</td>
                <td colspan="2">count</td>
                <td colspan="2">totalling</td>
                <td>band</td>
                <td>start</td>
                <td>end</td>
                <td>final</td>
                <td colspan="2">sign</td>
            </tr>
            <tr>
                <td colspan="2" style="width: 20%;">Family (<?= $tik_data['wp_bands']['adult_rate'] ?>)</td>
                <td colspan="2"><?= $tik_data['wp_adult'] ?></td>
                <td colspan="2"><?= ($tik_data['wp_bands']['adult_rate'] * $tik_data['wp_adult']) ?></td>
                <td onclick="viewbanddetail(`<?= $tik_data['wp_bands']['adult_bandid'] ?>`,`<?= $date ?>`)"><?= $tik_data['wp_bands']['adult_band'] ?></td>
                <td><?= $tik_data['wp_bands']['adult_start'] ?></td>
                <td>-</td>
                <td><?= $tik_data['wp_bands']['adult_end'] ?></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 20%;">Stag (<?= $tik_data['wp_bands']['child_rate'] ?>)</td>
                <td colspan="2"><?= $tik_data['wp_child'] ?></td>
                <td colspan="2"><?= ($tik_data['wp_bands']['child_rate'] * $tik_data['wp_child']) ?></td>
                <td onclick="viewbanddetail(`<?= $tik_data['wp_bands']['child_bandid'] ?>`,`<?= $date ?>`)"><?= $tik_data['wp_bands']['child_band'] ?></td>
                <td><?= $tik_data['wp_bands']['child_start'] ?></td>
                <td>-</td>
                <td><?= $tik_data['wp_bands']['child_end'] ?></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 20%;">combo a (<?= $tik_data['c_bands']['adult_rate'] ?>)</td>
                <td colspan="2"><?= $tik_data['cp_adult'] ?></td>
                <td colspan="2"><?= ($tik_data['c_bands']['adult_rate'] * $tik_data['cp_adult']) ?></td>
                <td onclick="viewbanddetail(`<?= $tik_data['c_bands']['adult_bandid'] ?>`,`<?= $date ?>`)"><?= $tik_data['c_bands']['adult_band'] ?></td>
                <td><?= $tik_data['c_bands']['adult_start'] ?></td>
                <td>-</td>
                <td><?= $tik_data['c_bands']['adult_end'] ?></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 20%;">combo c (<?= $tik_data['c_bands']['child_rate'] ?>)</td>
                <td colspan="2"><?= $tik_data['cp_child'] ?></td>
                <td colspan="2"><?= ($tik_data['c_bands']['child_rate'] * $tik_data['cp_child']) ?></td>
                <td onclick="viewbanddetail(`<?= $tik_data['c_bands']['child_bandid'] ?>`,`<?= $date ?>`)"><?= $tik_data['c_bands']['child_band'] ?></td>
                <td><?= $tik_data['c_bands']['child_start'] ?></td>
                <td>-</td>
                <td><?= $tik_data['c_bands']['child_end'] ?></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <th class="color text-start" colspan="12">adventure park</th>
            </tr>
            <tr>
                <td colspan="2" style="width: 20%;">Family (<?= $tik_data['ap_bands']['adult_rate'] ?>)</td>
                <td colspan="2"><?= $tik_data['ap_adult'] ?></td>
                <td colspan="2"><?= ($tik_data['ap_bands']['adult_rate'] * $tik_data['ap_adult']) ?></td>
                <td onclick="viewbanddetail(`<?= $tik_data['ap_bands']['adult_bandid'] ?>`,`<?= $date ?>`)"><?= $tik_data['ap_bands']['adult_band'] ?></td>
                <td><?= $tik_data['ap_bands']['adult_start'] ?></td>
                <td>-</td>
                <td><?= $tik_data['ap_bands']['adult_end'] ?></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 20%;">Stag (<?= $tik_data['ap_bands']['child_rate'] ?>)</td>
                <td colspan="2"><?= $tik_data['ap_child'] ?></td>
                <td colspan="2"><?= ($tik_data['ap_bands']['child_rate'] * $tik_data['ap_child']) ?></td>
                <td onclick="viewbanddetail(`<?= $tik_data['ap_bands']['child_bandid'] ?>`,`<?= $date ?>`)"><?= $tik_data['ap_bands']['child_band'] ?></td>
                <td><?= $tik_data['ap_bands']['child_start'] ?></td>
                <td>-</td>
                <td><?= $tik_data['ap_bands']['child_end'] ?></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 20%;">member (40)</td>
                <td colspan="2"><?= $tik_data['meb_count'] ?></td>
                <td colspan="2"><?= ($tik_data['meb_count'] * 40) ?></td>
                <td onclick="viewbanddetail(`<?= $tik_data['mem_bands']['adult_bandid'] ?>`,`<?= $date ?>`)"><?= $tik_data['mem_bands']['adult_band'] ?></td>
                <td><?= $tik_data['mem_bands']['adult_start'] ?></td>
                <td>-</td>
                <td><?= $tik_data['mem_bands']['adult_end'] ?></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 20%;">Free </td>
                <td colspan="2"><?= $tik_data['total_free'] ?></td>
                <td colspan="2"></td>
                <td onclick="viewbanddetail(`<?= $tik_data['wp_bands']['free_bandid'] ?>`,`<?= $date ?>`)"><?= $tik_data['wp_bands']['free_band'] ?></td>
                <td><?= $tik_data['wp_bands']['free_start'] ?></td>
                <td>-</td>
                <td><?= $tik_data['wp_bands']['free_end'] ?></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 20%;">Resort </td>
                <td colspan="2"><?= $tik_data['resort_bands']->total_used ?></td>
                <td colspan="2"></td>
                <td onclick="viewbanddetail(`<?= $tik_data['resort_bands']->color_id ?>`,`<?= $date ?>`)"><?= $tik_data['resort_bands']->band_color ?></td>
                <td><?= $tik_data['resort_bands']->start_no ?></td>
                <td>-</td>
                <td><?= $tik_data['resort_bands']->end_no ?></td>
                <td colspan="2"></td>
            </tr>
            <!-- <tr>
                <td colspan="2" style="width: 20%;">Camp </td>
                <td colspan="2"><?= $tik_data['camp_bands']->total_used ?></td>
                <td colspan="2"></td>
                <td onclick="viewbanddetail(`<?= $tik_data['camp_bands']->color_id ?>`,`<?= $date ?>`)"><?= $tik_data['camp_bands']->band_color ?></td>
                <td><?= $tik_data['camp_bands']->start_no ?></td>
                <td>-</td>
                <td><?= $tik_data['camp_bands']->end_no ?></td>
                <td colspan="2"></td>
            </tr> -->
            <tr>
                <th class="color text-start" colspan="12">package tickets</th>
            </tr>
            <?php if (!empty($lead_tickets->list)) {
                foreach ($lead_tickets->list as $ptll) { ?>
                    <tr onclick="window.open('<?= base_url('Marketing/lead_client_print/') . $ptll->id ?>','_blank');">
                        <td colspan="2" style="width: 20%;"><?= $ptll->Name ?></td>
                        <td colspan="2"><?= $ptll->count ?></td>
                        <td colspan="2"><?= $ptll->netto_amt ?></td>
                        <td onclick="viewbanddetail(`<?= $ptll->band_colorid ?>`,`<?= $date ?>`)"><?= $ptll->band_color ?></td>
                        <td><?= $ptll->startno ?></td>
                        <td><?= $ptll->endno ?></td>
                        <td><?= $ptll->finalno ?></td>
                        <td colspan="2"></td>
                    </tr>
            <?php }
            } ?>

            <tr>
                <th class="fs-4 color" colspan="4" rowspan="3">total</th>
                <th colspan="2" rowspan="3">₹<?= ($tik_data['Total_buissness']) ?></th>
                <th>
                    a). Paytm
                </th>
                <th colspan="2">₹<?= $tik_data['Ticket_Paytm'] ?></th>
                <th rowspan="3">Total UPI</th>
                <th colspan="2" rowspan="3">₹ <?= ($tik_data['Ticket_Upi']) ?></th>
            </tr>
            <tr>
                <th>
                    b). Phonepay
                </th>
                <th colspan="2">₹ <?= $tik_data['Ticket_PhoneP'] ?></th>

            </tr>
            <tr>
                <th>
                    c). Other
                </th>
                <th colspan="2">₹ <?= $tik_data['Ticket_other'] ?></th>

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
        <tr>
            <th class="color" colspan="12">Free / Balance Entry details</th>
        </tr>
        <tr>
            <td>S.no</td>
            <td colspan="3">Name</td>
            <td colspan="2">Mobile number</td>
            <td colspan="2">City</td>
            <td colspan="2">Amount</td>
            <td colspan="3">approval</td>
        </tr>
        <?php if (!empty($report_list_data['tick_balnce'])) {
            foreach ($report_list_data['tick_balnce'] as $key => $value) {
                echo '<tr>
                                <td>' . ($key + 1) . '</td>
                                <td colspan="3">' . $value->m_cust_name . '</td>
                                <td colspan="2">' . $value->m_cust_mobile . '</td>
                                <td colspan="2">' . $value->m_city_name . '</td>
                                <td colspan="2">' . $value->m_ticket_balAmt . '</td>
                                <td colspan="3">' . $value->m_emp_name . '</td>
                            </tr>';
            }
        } else {
            echo '<tr>
                <td colspan="6">N/A</td>
              
            </tr>';
        } ?>


        <tr>
            <td colspan="12" class="text-start" style="height: 100px;">
                <h6>remark :-</h6>
                <ol>
                    <!-- advance loop start -->
                    <?php
                    $toadvan = 0;
                    if (!empty($lead_tickets->detail)) {
                        foreach ($lead_tickets->detail as $key => $value) {
                            if ($value->adv_amount != 0) {
                                $toadvan += $value->adv_amount;
                                echo '<li> ₹' . ($value->adv_amount) . ' - ' . $value->Name .  ' Advance recieved on : ' . date('d-m-Y', strtotime($value->adv_date)) . ' in ' . $value->adv_mode . '
                         </li>';
                            }
                        }
                    }  ?>

                    <!-- advance loop end -->
                    <!-- refund loop start -->
                    <?php

                    if (!empty($tik_data['tick_refund_list'])) {
                        foreach ($tik_data['tick_refund_list'] as $key => $value) {

                            echo '<li>Ticket Refund of ₹' . ($value->m_ticket_netAmt) . ' - Total Person -' . ($value->m_ticket_adult + $value->m_ticket_child) . ', Customer -' . $value->m_cust_name .  ' (' . $value->m_cust_mobile . ')
                            </li>';
                        }
                    }  ?>

                    <!-- refund loop end -->
                    <!-- advance loop start -->
                    <?php
                  
                    if (!empty($resort_data)) {
                        foreach ($resort_data as $key => $value) {
                            if ($value->r_resdata_type == 1) {
                                echo '<li onclick="viewbanddetail(`'.$value->r_resdata_band.'`, `'.$date.'`)" >' . ($value->r_resdata_adult + $value->r_resdata_child) . ' ' . $value->m_hq_name .  ' Band Used for Resort Entry : ' . $value->r_resdata_name .' </li>';
                            }else {
                                echo '<li onclick="viewbanddetail(`'.$value->r_resdata_band.'`, `'.$date.'`)">' . ($value->r_resdata_adult + $value->r_resdata_child) . ' ' . $value->m_hq_name .  ' Band Used for Camp Entry : ' . $value->r_resdata_name .' </li>';
                            }
                        }
                    }  ?>

                    <!-- advance loop end -->


                </ol>


            </td>
        </tr>
        <tr>
            <th class="color" colspan="12">for office use only</th>
        </tr>
        </table>
        <table class="table table-bordered text-center mb-0">
            <tr>
                <td rowspan="2">department</td>
                <td colspan="2">amounty</td>
                <td rowspan="2">total expenses /balance/discount </td>
                <td rowspan="2">total cash</td>
                <td rowspan="2">handover details</td>
            </tr>
            <tr>
                <td>total</td>
                <td>phonepe/ paytm</td>
            </tr>
            <tr>
                <td>reception</td>
                <td>business</td>
                <td></td>
                <td></td>
                <td></td>
                <td>sign :-</td>
            </tr>
            <tr>
                <td rowspan="4" colspan="2">₹<?= ($tik_data['Total_buissness'] + $tik_data['total_voucher']) ?></td>

                <td>paytm : ₹<?= $tik_data['Ticket_Paytm'] ?></td>
                <td rowspan="4"><?= $tik_data['Ticket_balance'] . ' + ' . $tik_data['Ticket_discount'] . ' = ' ?> ₹<?= ($tik_data['Ticket_balance'] + $tik_data['Ticket_discount']) ?></td>
                <td rowspan="4">₹<?= (($tik_data['Total_buissness'] + $tik_data['total_voucher']) - ($tik_data['Ticket_Upi']) - ($tik_data['Ticket_balance'] + $tik_data['Ticket_discount'])) ?></td>
                <td rowspan="4"></td>
            </tr>
            <tr>
                <td>phonepe : ₹ <?= $tik_data['Ticket_PhoneP'] ?></td>
            </tr>
            <tr>
                <td>Other : ₹ <?= $tik_data['Ticket_other'] ?></td>
            </tr>
            <tr>
                <td>total upi : ₹<?= ($tik_data['Ticket_Upi']) ?></td>
            </tr>

        </table>
    </div>

    <div class="modal fade" id="bandstockdetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"> Band Stock Detail</h4>

                </div>
                <div class="modal-body" style="word-break: break-all" id="modalbody">

                </div>

            </div>
        </div>
    </div>



</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function viewbanddetail(bandcolor, date) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Reports/get_bands_stock_detail'); ?>",
            data: {
                color: bandcolor,
                from: date,
                to: date
            },
            dataType: "JSON",
            success: function(data) {
                if (data != '') {
                    // console.log(data);
                    $('#modalbody').empty();

                    $('#modalbody').html(`<div class="row">
                        <div class="col-md-6">
                            <span><b>Band Color</b>: ` + data.band_color + `</span>
                        </div>
                        <div class="col-md-6">
                            <span><b>Date</b>: ` + date + `</span>
                        </div>
                        <div class="col-md-6">
                            <span><b>Total Stock</b>: ` + data.total_band + ` </span>
                        </div>
                        <div class="col-md-6">
                            <span><b>Opening Stock</b>: ` + data.opening_stk + ` </span>
                        </div>
                        <div class="col-md-6">
                            <span><b>Total Used</b>: ` + data.total_used + ` </span>
                        </div>
                        <div class="col-md-6">
                            <span><b>Balance Stock</b>: ` + data.bal_stock + ` </span>
                        </div>
                        <div class="col-md-6">
                            <span><b>Start No</b>: ` + data.start_no + `</span>
                        </div>
                        <div class="col-md-6">
                            <span><b>End No</b>: ` + data.end_no + `</span>
                        </div>

                    </div>`);
                    $('#bandstockdetail').modal('show');
                }
            },
            error: function(jqXHR, status, err) {

                swal("Some Problem Occurred!! please try again", {
                    icon: "error",
                    timer: 2000,
                });
            }
        });


    }

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