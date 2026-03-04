<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id') ; $logged_user_type = $this->session->userdata('user_type') ;
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
        </style>
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'PMT', 'Filter')) { ?>
                        <form method="post" action="<?php echo $mode==1? site_url('Vouchers/payment_list') : site_url('Vouchers/receipt_list') ?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-check-label">From Date</label>
                                    <input class="form-check-input date_form " type="date" placeholder="From Date" name="from_date" id="m_from_date" value="<?php echo $from_date; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-check-label">To Date</label>
                                    <input class="form-check-input date_form " type="date" placeholder="To Date" name="to_date" id="m_from_date" value="<?php echo $to_date; ?>">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">Search</button>
                                        <a href="<?php echo $mode==1? site_url('Vouchers/payment_list') : site_url('Vouchers/receipt_list') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'PMT', 'Export')) { ?>
                                            <button class="btn btn-success" type="submit" name="Excel" value="2">Excel Export</button>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </form>
                    <?php } ?>
                </div>
                <div class="col-lg-2 pull-right">
                    <div class="seipkon-breadcromb-right">
                    <?php if ($mode == 1) {
                        if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'PMT', 'Add')) { ?>
                            <a href="<?php echo site_url('Vouchers/add_payment') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New payment</a>
                        <?php } } else{   if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'RPT', 'Add')) { ?>
                            <a href="<?php echo site_url('Vouchers/add_receipt') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New receipt</a>
                            <?php }} ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-box">
            <div class="advance-table table-overflow">
                <table id="payment_tbl" class="my_custom_datatable table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Voucher No</th>
                            <th>Dated</th>
                            <th>Account Name</th>
                            <th>Amount</th>
                            <?php if($mode == 1){ ?>
                            <th>ImpExp</th>
                            <th>Dollar</th>
                            <th>ExchRt</th>
                            <?php }?>
                            <th>Narration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($payment_value)) {
                            foreach ($payment_value as $value) {

                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->m_payment_voucherno; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($value->m_payment_date)); ?></td>
                                    <td><?php echo $value->m_plot_name; ?></td>
                                    <td><?php echo $value->m_payment_amount; ?></td>
                                    <?php if($mode == 1){ ?>
                                    <td><?php echo '' ?></td>
                                    <td><?php echo $value->is_dollar == 1?'Yes':'No'; ?></td>
                                    <td><?php echo $value->dollar_exchng_rt; ?></td>
                                    <?php }?>
                                    <td><?php echo $value->m_payment_narration; ?></td>
                                    <?php if ($mode == 1) { ?>
                                        <td class="wd-30">

                                            <!-- <a href="<?php echo base_url('Vouchers/view_user_dtl?id=') . $value->m_payment_id; ?>" class="btn btn-info btn-action" title="View" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'PMT', 'Edit')) { ?>
                                                <a href="<?php echo base_url('Vouchers/add_payment?id=') . $value->m_payment_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <?php }
                                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'PMT', 'Delete')) { ?>
                                                <button class="btn btn-danger btn-action delete-payment" data-value="<?php echo $value->m_payment_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                            <?php } ?>
                                        </td> <?php } else { ?>
                                        <td class="wd-30">

                                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'RPT', 'Edit')) { ?>
                                                <a href="<?php echo base_url('Vouchers/add_receipt?id=') . $value->m_payment_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <?php }
                                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'RPT', 'Delete')) { ?>
                                                <button class="btn btn-danger btn-action delete-payment" data-value="<?php echo $value->m_payment_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->view('top_footer');
$this->view('js/js_setup');
$this->view('js/custom_js'); ?>