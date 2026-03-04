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

            #printhead {
                display: none;
            }

            @media print {
                #printhead {
                    display: block;
                    margin: 0 !important;
                    margin-bottom: 10px !important;
                    margin-top: -130px !important;
                }

                .printDiv {
                    margin: 0 !important;
                    padding: 10px !important;
                }

                /* .page-box {
                    margin: 0px !important;
                    padding: 0px 10px !important;
                } */

            }
        </style>

        <div class="row">

            <div class="col-md-12">
                <div class="page-box">

                    <div class="seipkon-breadcromb-left">
                        <form action="<?= base_url('Reports/monthly_report') ?>" method="get">
                            <div class="row" style="display: flex; justify-content:space-between">
                                <div class="col-md-2">
                                    <h3>Monthly Report</h3>
                                </div>

                                <div class="col-md-10">
                                    <div class="row" style="display: flex;justify-content: end;">
                                        <div class="col-md-2">
                                            <input class="form-control stkinpfilt" onchange="this.form.submit();" style="width: 100%;" type="month" min="<?= date('2023-12') ?>" max="<?= date('Y-m') ?>" name="month_in" id="month_in" value="<?php echo $month_in; ?>">
                                        </div>
                                        <div class="col-md-1">
                                            <a onclick="printcustomdiv()" class="btn btn-success btn-sm">
                                                <i class="fa fa-printer me-2"></i>Print
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </form>

                        <hr style="margin-top: 0px; border-top: 2px solid #dee2e6;">
                    </div>
                    <div class="printDiv">
                        <div class="row" id="printhead">
                            <div class="col-md-6 col-xs-6">
                                <h3> Monthly Report</h3>
                            </div>
                            <div class="col-md-6 col-xs-6" style="text-align: right;">
                                <h5>Date: <?= date('d-m-Y') ?></h5>
                            </div>
                        </div>
                        <table id="monthly_tbl" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Reception</th>
                                    <th>Costume</th>
                                    <th>FoodCourt</th>
                                    <th>Resort</th>
                                    <th>Camps</th>
                                    <th>Vouchers</th>
                                    <th>Expense</th>
                                    <th>Balance</th>
                                    <th>Total</th>
                                    <th>Total Upi</th>
                                    <th>Hand Cash</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sum_reception = 0;
                                $sum_costume = 0;
                                $sum_foodCourt = 0;
                                $sum_resort = 0;
                                $sum_camps = 0;
                                $sum_voucher = 0;
                                $sum_expense = 0;
                                $sum_balance = 0;
                                $sum_total = 0;
                                $sum_upi = 0;
                                $sum_handcash = 0;
                                if (!empty($all_data)) {
                                    foreach ($all_data as $key => $value) {
                                        $total_col = ($value->reception + $value->costume + $value->foodcourt + $value->total_voucher + $value->resort + $value->camp - $value->total_discount  - $value->total_expense - $value->total_balance);
                                        $hand_cash = ($total_col - $value->total_upi);

                                        $sum_reception += $value->reception;
                                        $sum_costume += $value->costume;
                                        $sum_foodCourt += $value->foodcourt;
                                        $sum_resort += $value->resort;
                                        $sum_camps += $value->camp;
                                        $sum_voucher += $value->total_voucher;
                                        $sum_expense += ($value->total_discount  + $value->total_expense);
                                        $sum_balance += $value->total_balance;
                                        $sum_total += $total_col;
                                        $sum_upi += $value->total_upi;
                                        $sum_handcash += $hand_cash;
                                ?><tr>
                                            <td><?= date('d-m-Y', strtotime($value->date)) ?></td>
                                            <td><?= $value->reception ?></td>
                                            <td><?= $value->costume ?></td>
                                            <td><?= $value->foodcourt ?></td>
                                            <td><?= $value->resort ?></td>
                                            <td><?= $value->camp ?></td>
                                            <td><?= $value->total_voucher ?></td>
                                            <td><?= ($value->total_discount  + $value->total_expense) ?></td>
                                            <td><?= $value->total_balance ?></td>
                                            <td><?= $total_col ?></td>
                                            <td><?= $value->total_upi ?></td>
                                            <td><?= $hand_cash ?></td>
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <th>Total</th>
                                <th><?= $sum_reception ?></th>
                                <th><?= $sum_costume ?></th>
                                <th><?= $sum_foodCourt ?></th>
                                <th><?= $sum_resort ?></th>
                                <th><?= $sum_camps ?></th>
                                <th><?= $sum_voucher ?></th>
                                <th><?= $sum_expense ?></th>
                                <th><?= $sum_balance ?></th>
                                <th><?= $sum_total ?></th>
                                <th><?= $sum_upi ?></th>
                                <th><?= $sum_handcash ?></th>
                            </tfoot>

                        </table>
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