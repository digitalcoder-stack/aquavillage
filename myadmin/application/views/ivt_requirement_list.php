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
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'REQMT', 'Filter')) { ?>
                        <form method="post" action="<?php echo site_url('Inventory/requirement_list') ?>">
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
                                        <a href="<?php echo site_url('Inventory/requirement_list') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'REQMT', 'Export')) { ?>
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
                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'REQMT', 'Add')) { ?>
                            <a href="<?php echo site_url('Inventory/add_requirement') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-box">
            <div class="advance-table table-overflow">
                <form action="<?= base_url('Inventory/add_purchase_order')?>" method="post">
                    <table id="REQMT_tbl" class="my_custom_datatable table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Request No</th>
                                <th>Date</th>
                                <th>Department</th>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Remark</th>
                                <th>Status</th>
                                <th>Added By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($all_data)) {
                                foreach ($all_data as $value) {
                                    switch ($value->m_reqmt_status) {
                                        case 1:
                                            $status = '<span class="btn btn-vsm btn-warning">Pending</span>';
                                            break;
                                        case 2:
                                            $status = '<span class="btn btn-vsm btn-info">Processing</span>';
                                            break;
                                        case 3:
                                            $status = '<span class="btn btn-vsm btn-danger">Rejected</span>';
                                            break;
                                        case 4:
                                            $status = '<span class="btn btn-vsm btn-success">Completed</span>';
                                            break;
                                    }
                            ?>
                                    <tr>
                                        <td><?php if ($value->m_reqmt_status == 1) {
                                                echo '<input type="checkbox" name="requ_id[]" class="form-select" value="' . $value->m_reqmt_id . '"/>';
                                            } ?></td>
                                        <td><?php echo  $value->m_reqmt_uno; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($value->m_reqmt_date)); ?></td>
                                        <td><?php echo $value->m_dept_name; ?></td>
                                        <td><?php echo $value->m_product_name; ?></td>
                                        <td><?php echo $value->product_size; ?></td>
                                        <td><?php echo $value->m_reqmt_qty; ?></td>
                                        <td><?php echo $value->product_unit; ?></td>
                                        <td><?php echo $value->m_reqmt_remark; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $value->m_admin_name; ?></td>

                                        <td class="wd-30">

                                            <!-- <a href="<?php echo base_url('Inventory/view_user_dtl?id=') . $value->m_reqmt_id; ?>" class="btn btn-info btn-action" title="View" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'REQMT', 'Edit')) { ?>
                                                <a href="<?php echo base_url('Inventory/add_requirement?id=') . $value->m_reqmt_uno; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <?php }
                                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'REQMT', 'Delete')) { ?>
                                                <button class="btn btn-danger btn-action delete-REQMT" data-value="<?php echo $value->m_reqmt_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Add Purchase Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->view('top_footer');
$this->view('js/restuarent_js');
$this->view('js/custom_js'); ?>