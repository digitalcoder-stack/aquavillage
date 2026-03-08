<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id');
$logged_user_type = $this->session->userdata('user_type');
?>

<div class="page-content">
    <div class="container-fluid">

        <div class="breadcromb-area">
            <div class="row">

                <div class="col-lg-6">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>

                <div class="col-lg-6 pull-right">
                    <div class="seipkon-breadcromb-right">

                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'DCNT', 'Add')) { ?>
                            <a href="<?php echo site_url('Vouchers/add_discount') ?>" class="btn btn-info btn-vsm">
                                <i class="fa fa-plus-circle"></i> Add Discount
                            </a>
                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>


        <div class="page-box">
            <div class="advance-table table-overflow">

                <table id="discount_tbl" class="my_custom_datatable table table-striped table-bordered">

                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Discount Code</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Ranges</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $i = 1;

                        if (!empty($discount_value)) {
                            foreach ($discount_value as $value) {
                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->discount_code; ?></td>
                                    <td><?php echo $value->discount_name; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($value->start_date)); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($value->end_date)); ?></td>
                                    <td>
                                        <?php
                                        if (!empty($value->discount_ranges)) {
                                            foreach ($value->discount_ranges as $range) {
                                                echo
                                                '<div style="margin-bottom:4px;">
                                                <b>' . $range['min_pack'] . '</b>
                                                -
                                                <b>' . $range['max_pack'] . '</b>
                                                Pack :
                                                <span class="label label-info">' . $range['discount_percent'] . '% </span>
                                                </div> <br>';
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($value->discount_status == 1) { ?>
                                            <span class="label label-success">Active</span>
                                        <?php } else { ?>
                                            <span class="label label-danger">Inactive</span>
                                        <?php } ?>
                                    </td>
                                    <td class="wd-30">
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'DCNT', 'Edit')) { ?>
                                            <a href="<?php echo base_url('Vouchers/add_discount?code=') . $value->discount_code; ?>" class="btn btn-info btn-action" title="Edit"> <i class="fa fa-edit"></i> </a>
                                        <?php } ?>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'DCNT', 'Delete')) { ?>
                                            <button class="btn btn-danger btn-action delete-discount" data-code="<?php echo $value->discount_code; ?>" title="Delete"> <i class="fa fa-trash"></i> </button>
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

            </div>
        </div>

    </div>
</div>


<?php
$this->view('top_footer');
$this->view('js/js_setup');
$this->view('js/custom_js');
?>