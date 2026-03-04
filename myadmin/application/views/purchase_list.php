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
        </style>

        <?php
        switch ($mode) {
            case 1: {
                    $pagelink = "Inventory/purchase_order";
                    $addlink = "Inventory/add_purchase_order";
                    $submod = "PORD";
                }
                break;
            case 2: {
                    $pagelink = "Inventory/purchase_invoice";
                    $addlink = "Inventory/add_purchase_invoice";
                    $submod = "PINV";
                }
                break;
            case 3: {
                    $pagelink = "Inventory/purchase_return";
                    $addlink = "Inventory/add_purchase_return";
                    $submod = "PRNT";
                }
                break;
        }

        ?>

        <div class="breadcromb-area">
            <div class="row">
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>


                <div class="col-lg-8">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', $submod, 'Filter')) { ?>
                        <form method="post" action="<?= site_url($pagelink) ?>">
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
                                        <a href="<?= site_url($pagelink) ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', $submod, 'Export')) { ?>
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

                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', $submod, 'Add')) { ?>
                            <a href="<?php echo site_url($addlink) ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i>Add New</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-box">
            <div class="advance-table table-overflow">
                <table id="purchase_tbl" class="my_custom_datatable table table-striped table-bordered">
                    <thead>
                        <?php if ($mode == 1) {
                            echo '<tr>
                    <th>SN</th>
                    <th>Order Date</th>
                    <th>Order No</th>
                    <th>Total Quantity</th>
                    <th>Products</th>
                    <th colspan="2">Action</th>
                </tr>';
                        } else { ?>
                            <tr>
                                <th>SN</th>
                                <th>VNo</th>
                                <th>Order Date</th>
                                <th>Party</th>
                                <?php if ($mode == 2) { ?>
                                    <th>PurInv No</th>
                                    <th>PurInv Date</th>
                                    <th>Total Amount</th>
                                    <th>Total Tax</th>

                                <?php } ?>
                                <th>Net Amount</th>
                                <th>Remarks</th>
                                <th colspan="2">Action</th>
                            </tr>
                        <?php } ?>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($purchase_value)) {
                            foreach ($purchase_value as $value) {

                                if ($mode == 1) { ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= date('d-m-Y', strtotime($value->ivt_purchase_date)); ?></td>
                                        <td><?= $value->ivt_purchase_no; ?></td>
                                        <td><?= $value->total_qty ?></td>
                                        <td><?= $value->product_name ?></td>
                                        <td><a href="<?php echo base_url('Inventory/add_purchase_invoice?id=') . $value->ivt_purchase_id; ?>" class="btn btn-primary btn-action" title="Add Invoice" data-toggle="tooltip"><i class="fa fa-plus"></i> Add Invoice</a></td>
                                        <td class="wd-30">
                                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', $submod, 'Edit')) { ?>
                                                <a href="<?php echo base_url('Inventory/add_purchase_order?id=') . $value->ivt_purchase_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <?php }
                                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', $submod, 'Delete')) { ?>
                                                <button class="btn btn-danger btn-action delete-purchase" data-value="<?php echo $value->ivt_purchase_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php  } else { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>

                                        <td><?php echo $value->ivt_purchase_no; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($value->ivt_purchase_date)); ?></td>
                                        <td><?php echo $value->m_supplier_name; ?></td>
                                        <?php if ($mode == 2) { ?>
                                            <td><?php echo $value->ivt_purchase_invno; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($value->ivt_purchase_invdate)); ?></td>
                                            <td><?php echo $value->ivt_purchase_Tamount; ?></td>
                                            <td><?php echo $value->ivt_purchase_taxable; ?></td>
                                        <?php } ?>
                                        <td><?php echo $value->ivt_purchase_netamount; ?></td>
                                        <td><?php echo $value->ivt_purchase_remark; ?></td>
                                        <?php if ($mode == 2) { ?>
                                        <td><a href="<?php echo base_url('Inventory/add_stockjournal?id=') . $value->ivt_purchase_id; ?>" class="btn btn-success btn-vsm" title="Add To Stock" data-toggle="tooltip">Add To Stock</a>
                                        <a href="<?php echo base_url('Inventory/add_purchase_return?id=') . $value->ivt_purchase_id; ?>" class="btn btn-danger btn-vsm" title="Add To Return" data-toggle="tooltip"><i class="fa fa-plus"></i> Return</a></td>
                                        <?php } ?>
                                        <td class="wd-30">
                                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', $submod, 'Edit')) { ?>
                                                <a href="<?php echo base_url($addlink . '?editid=') . $value->ivt_purchase_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <?php }
                                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', $submod, 'Delete')) { ?>
                                                <button class="btn btn-danger btn-action delete-purchase" data-value="<?php echo $value->ivt_purchase_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                        <?php }
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
$this->view('js/restuarent_js');
$this->view('js/custom_js'); ?>