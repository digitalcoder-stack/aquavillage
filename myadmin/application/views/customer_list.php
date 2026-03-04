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
                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Cust', 'Filter')) { ?>
                    <form method="post" action="<?php echo site_url('Setup/customer_list') ?>">
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
                                    <a href="<?php echo site_url('Setup/customer_list') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Cust', 'Export')) { ?>
                                    <button class="btn btn-success" type="submit" name="Excel" value="2">Excel Export</button>
                                    <?php }?>
                                </div>
                            </div>

                        </div>
                    </form>
                    <?php }?>
                </div>
                <div class="col-lg-2 pull-right">
                    <div class="seipkon-breadcromb-right">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Cust', 'Add')) { ?>
                        <a href="<?php echo site_url('Setup/add_customer') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New Customer</a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-box">
            <div class="advance-table table-overflow">
                <table id="user_tbl" class="my_custom_datatable table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile No.</th>
                            <th>Email</th>
                            <!-- <th>Gender</th> -->
                            <th>Registration Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($mech_value)) {
                            foreach ($mech_value as $value) {
                                $original_date = $value->m_cust_added_on;
                                $new_date = date("d-m-Y", strtotime($original_date));
                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->m_cust_name; ?></td>
                                    <td><?php echo $value->m_cust_mobile; ?></td>
                                    <td><?php echo $value->m_cust_email; ?></td>
                                    <!-- <td><?php echo $value->m_cust_gender; ?></td> -->
                                    <td><?php echo $new_date; ?></td>
                                    <td><?php if ($value->m_cust_status == 1) echo "Active";
                                        else {
                                            echo "In-Active";
                                        } ?></td>

                                    <td class="wd-30">

                                        <a href="<?php echo base_url('Setup/view_user_dtl?id=') . $value->m_cust_id; ?>" class="btn btn-info btn-action" title="View" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Cust', 'Edit')) { ?>
                                        <a href="<?php echo base_url('Setup/add_customer?id=') . $value->m_cust_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                        <?php }if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Cust', 'Delete')) { ?>
                                        <button class="btn btn-danger btn-action delete-user" data-value="<?php echo $value->m_cust_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
<?php $this->view('top_footer');
$this->view('js/customer_js');
$this->view('js/custom_js'); ?>