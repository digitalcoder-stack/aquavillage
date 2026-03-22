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

            <div class="col-md-9 col-sm-12">
                <div class="page-box">
                    <?php switch ($godown) {
                        case 1: {
                                $mainhead = 'Main Stocks';
                                $subhead = '';
                            }
                            break;
                        case 2: {
                                $mainhead = 'Store Stocks';
                                $subhead = '';
                            }
                            break;
                        default: {
                                $mainhead = 'All Stocks';
                                $subhead = '';
                            }
                            break;
                    }  ?>
                    <div class="seipkon-breadcromb-left">
                        <div class="row">
                            <div class="col-md-6">
                                <h3><?= $mainhead ?></h3>
                            </div>
                            <div class="col-md-6 no-print" style="text-align: end;">
                                <a onclick="printcustomdiv()" class="btn btn-success btn-sm">
                                    <i class="fa fa-printer me-2"></i>Print
                                </a>
                            </div>
                        </div>

                        <hr style="margin-top: 0px; border-top: 2px solid #dee2e6;">
                    </div>
                    <div class="printDiv">
                        <div class="row" id="printhead">
                            <div class="col-md-6 col-xs-6">
                                <h3><?= $mainhead ?> Report</h3>
                            </div>
                            <div class="col-md-6 col-xs-6" style="text-align: right;">
                                <h5>Date: <?= date('d-m-Y') ?></h5>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table id="allStock_tbl" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Product</th>
                                    <th>Unit</th>
                                    <th>Size</th>
                                    <?php if ($godown != 2) {
                                        echo '<th>Main Opening</th>
                                        <th>Total Issue</th>
                                        <th>Main Closing</th>';
                                    }
                                    if ($godown != 1) {
                                        echo '<th>Store Opening</th>
                                        <th>Total Sale</th>
                                        <th>Total Used</th>
                                        <th>Total Damage</th>
                                        <th>Store Closing</th>';
                                    } ?>

                                    <!-- <th>Action</th> -->

                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($all_data)) {
                                    foreach ($all_data as $key => $value) { ?>
                                        <tr>
                                            <td><?= ($key + 1) ?></td>
                                            <td><?= $value->product_name ?></td>
                                            <td><?= $value->product_unit ?></td>
                                            <td><?= $value->product_size ?></td>

                                            <?php if ($godown != 2) {
                                                echo ' <td>' . $value->main_opening . '</td>
                                        <td>' . $value->total_issue . '</td>
                                        <td>' . $value->main_closing . '</td>';
                                            }
                                            if ($godown != 1) {
                                                echo '<td>' . $value->store_opening . '</td>
                                                <td>' . $value->total_sale . '</td>
                                                <td>' . $value->total_used . '</td>
                                                <td>' . $value->total_damage . '</td>
                                                <td>' . $value->store_closing . '</td>';
                                            } ?>
                                            <!-- <td></td> -->

                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                            <!-- <tfoot>
                                    <th colspan="5"></th>
                                    <th><? //$total_adult 
                                        ?></th>
                                    <th><? //$total_child 
                                        ?></th>
                                    <th><? //($total_adult + $total_child) 
                                        ?></th>
                                    <th colspan="5"></th>
                                </tfoot> -->

                        </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <div class="page-box">
                    <form action="<?= base_url('Reports/stock_report') ?>" method="get">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="seipkon-breadcromb-left">
                                    <h3><?php echo $pagename; ?></h3>
                                    <hr style="margin-top: 0px; border-top: 2px solid #dee2e6;">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-check-label">From Date</label>
                                <input type="hidden" name="type" value="<?= $type; ?>">
                                <input class="form-control stkinpfilt" onchange="this.form.submit();" style="width: 100%;" type="date" placeholder="From Date" name="from_date" id="from_date" value="<?php echo $from_date; ?>">
                            </div>
                            <div class="col-md-12 " style="margin-bottom: 5px;">
                                <label class="form-check-label">To Date</label>
                                <input class="form-control stkinpfilt" onchange="this.form.submit();" style="width: 100%;" type="date" placeholder="To Date" name="to_date" id="to_date" value="<?php echo $to_date; ?>">
                            </div>
                            <div class="col-md-12 " style="margin-bottom: 5px;">
                                <select name="dept" id="dept" class="form-control select2 stkinpfilt" onchange="this.form.submit();">
                                    <option value="">All Department</option>
                                    <?php
                                    foreach ($dept_list as $dtval) {

                                        if ($dept == $dtval->m_dept_id) {
                                            $opti = "selected";
                                        } else {
                                            $opti = "";
                                        }

                                    ?>
                                        <option value="<?php echo $dtval->m_dept_id; ?>" <?= $opti ?>><?php echo $dtval->m_dept_name ?></option>
                                    <?php
                                    }

                                    ?>

                                </select>
                            </div>
                            <div class="col-md-12 " style="margin-bottom: 5px;">
                                <select name="godown" id="godown" class="form-control select2 stkinpfilt" onchange="this.form.submit();">
                                    <option value="o" <?php if ($godown == 'o') echo 'selected' ?>>All Godown</option>
                                    <?php
                                    foreach ($godown_dtl as $gval) {

                                        if ($godown == $gval->m_godown_type) {
                                            $opti = "selected";
                                        } else {
                                            $opti = "";
                                        }

                                    ?>
                                        <option value="<?php echo $gval->m_godown_type; ?>" <?= $opti ?>><?php echo $gval->m_godown_name ?></option>
                                    <?php
                                    }

                                    ?>

                                </select>
                            </div>
                            <div class="col-md-12">
                                <select name="prod" id="prod" class="form-control select2 stkinpfilt" onchange="this.form.submit();">
                                    <option value="">All Product</option>
                                    <?php
                                    if (!empty($products)) {
                                        foreach ($products as $ukey) {
                                            if ($ukey->m_product_id == $prod) {
                                                $op = 'selected';
                                            } else {
                                                $op = '';
                                            }
                                    ?>
                                            <option value="<?php echo $ukey->m_product_id; ?>" <?= $op ?>><?= $ukey->m_product_name; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="col-md-12" style="margin-top:5px;" id="stckfiltbtns">
                                <button type="submit" class="btn <?php if ($type == '') {
                                                                        echo 'btn-success';
                                                                    } else {
                                                                        echo 'btn-primary';
                                                                    } ?> btn-block stckfiltbtn" name="type" value="">All Stock</button>
                                <button type="submit" class="btn <?php if ($type == 1) {
                                                                        echo 'btn-success';
                                                                    } else {
                                                                        echo 'btn-primary';
                                                                    } ?> btn-block stckfiltbtn" name="type" value="1">Sale Products</button>
                                <button type="submit" class="btn <?php if ($type == 2) {
                                                                        echo 'btn-success';
                                                                    } else {
                                                                        echo 'btn-primary';
                                                                    } ?> btn-block stckfiltbtn" name="type" value="2">Row Material</button>
                                <button type="submit" class="btn <?php if ($type == 3) {
                                                                        echo 'btn-success';
                                                                    } else {
                                                                        echo 'btn-primary';
                                                                    } ?> btn-block stckfiltbtn" name="type" value="3">Assets</button>

                            </div>
                        </div>
                    </form>
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
