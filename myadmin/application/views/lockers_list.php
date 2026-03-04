<!--=========================View==============Fix========== -->
<!-- ========================Header==============Fix========= -->
<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id') ; $logged_user_type = $this->session->userdata('user_type') ;
?>
<!-- =======================/Header==============Fix========= -->
<!-- =========================View===============Fix========= -->
<div class="page-content">
    <div class="container-fluid">
        <!-- ========================/View===============Fix========= -->
        <!-- ======================Page Title======================== -->

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

            .myrefundModal .form-control {
                width: 100% !important;
                padding: 8px;
                height: 30px;
            }

            .myrefundModal .modal-footer span {
                float: left;
                color: red;
                font-size: 18px;
                font-weight: bold;
            }

            .myrefundModal .modal-footer button {
                float: right;
                margin-right: 5px;

            }

            .myrefundModal .modal-footer {
                text-align: initial;
            }
        </style>
        <!-- Breadcromb Row Start -->
        <!----------------------------row start------------------------>

        <div class="breadcromb-area">
            <div class="row">
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'LC', 'Filter')) { ?>
                        <form method="post" action="<?php echo site_url('Shop/locker_list/').$type ?>">
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
                                        <a href="<?php echo site_url('Shop/locker_list/').$type ?>"><button class="btn btn-primary" type="button">Refresh</button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'LC', 'Export')) { ?>
                                            <button class="btn btn-success" type="submit" name="Excel" value="2">Export</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
                <!-- <div class="col-lg-2">
                    <div class="seipkon-breadcromb-right">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'LC', 'Add')) { ?>
                            <a href="<?php echo site_url('Shop/add_locker') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New locker</a>
                        <?php } ?>
                        
                    </div>
                </div> -->
            </div>
        </div>
        <div class="page-box">
            <div class="advance-table table-overflow">
                <?php if ($type == 1) { ?>
                    <table id="locker_tbl" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>Dated</th>
                                <th>Mode</th>
                                <th>Mobile No</th>
                                <th>Adult</th>
                                <th>Child</th>
                                <th>CustomerName</th>
                                <th>Created on</th>
                                <th>Refund</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($ticket_value)) {
                                foreach ($ticket_value as $value) {

                                    $locker_val = $this->db->select('group_concat(m_locker_id) as m_locker_id,m_locker_counter,sum(m_locker_refund) as m_locker_refund,group_concat(m_locker_Tdeposit) as m_locker_Tdeposit,sum(m_locker_Tdeposit) as total_Tdeposit,group_concat(m_locker_B) as m_locker_B,group_concat(m_locker_L) as m_locker_L,group_concat(m_locker_G) as m_locker_G,m_locker_status,m_locker_ticket_id')->where('DATE_FORMAT(m_locker_added_on,"%Y-%m-%d")', date('Y-m-d'))->where('m_locker_ticket_id', $value->m_ticket_id)->group_by('m_locker_ticket_id')->get('locker_wp_tbl')->result();

                                    // echo '<pre>'; print_r($locker_val);
                            ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= date('d-m-Y', strtotime($value->m_ticket_date)); ?></td>
                                        <td><?= "Cash" ?></td>
                                        <td><?= $value->m_cust_mobile; ?></td>
                                        <td><?= $value->m_ticket_adult; ?></td>
                                        <td><?= $value->m_ticket_child; ?></td>
                                        <td><?= $value->m_cust_name; ?></td>
                                        <td><?= date('d-m-Y h:i', strtotime($value->m_ticket_added_on)); ?></td>
                                       <td><?php if (!empty($locker_val)) { echo $locker_val[0]->m_locker_refund; }?></td>
                                        <td class="wd-30">
                                            <?php if (!empty($locker_val)) { ?>
                                                <button type="button" class="btn btn-vsm" style="background-color: #34bc72;" data-toggle="modal" data-target="#myrefundModal<?= $locker_val[0]->m_locker_ticket_id ?>"><i class="fa fa-reply-all"></i></button>
                                                <!---import model-->

                                                <div id="myrefundModal<?= $locker_val[0]->m_locker_ticket_id ?>" class="modal fade myrefundModal" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Refund Modal</h4>
                                                            </div>
                                                            <form method="POST" id="frm-lockerrefund" enctype="multipart/form-data">
                                                                <div class="modal-body">

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-md-6 col-sm-6 col-form-label">Dr Account</label>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <select name="m_locker_counter" id="m_locker_counter" class="form-control select2">
                                                                                <?php
                                                                                foreach ($cashcot_dtl as $cckey) {
                                                                                    if ($locker_val[0]->m_locker_counter == $cckey->m_cashacc_id) {
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

                                                                    <div class="row" style="margin-top: 10px;">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <label for="staticEmail" class="col-sm-2 col-form-label">Mobile</label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="hidden" class="form-control" id="m_locker_id" name="m_locker_id" value="<?= $locker_val[0]->m_locker_id ?>" />
                                                                                    <input type="number" class="form-control" id="m_cust_mobile" name="m_cust_mobile" value="<?= $value->m_cust_mobile ?>" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="text" name="m_cust_name" id="m_cust_name" class="form-control" value="<?= $value->m_cust_name ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row" style="margin-top: 10px;">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <label for="staticEmail" class="col-sm-5 col-form-label">Deposit Amt</label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="number" class="form-control" id="m_locker_Tdeposit" name="m_locker_Tdeposit" value="<?= $locker_val[0]->total_Tdeposit ?>" readonly/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row" style="margin-top: 10px;">
                                                                                <label for="staticEmail" class="col-sm-5 col-form-label">Return Amt</label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="hidden" name="m_locker_Treturn" value="<?= $locker_val[0]->m_locker_Tdeposit ?>" />
                                                                                    <input type="number" class="form-control" id="m_locker_Treturn" value="<?= $locker_val[0]->total_Tdeposit ?>" readonly />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <label for="staticEmail" class="col-sm-12 col-form-label">Alloted Locker list</label>
                                                                                <div class="col-sm-12">
                                                                                    <p> Cat B-
                                                                                        <?php $lockername = $this->db->select('m_lockercode_title')->where_in('m_lockercode_id', explode(',', $locker_val[0]->m_locker_B))->get('master_lockercode_tbl')->result();
                                                                                        foreach ($lockername as $rkey) {
                                                                                            echo '<span class="btn btn-sm btn-primary" title="" style="margin-left: 5px;">' . $rkey->m_lockercode_title . '</span>';
                                                                                        }
                                                                                        ?>
                                                                                    </p>
                                                                                    <br>
                                                                                    <p> Cat L-
                                                                                        <?php $lockername = $this->db->select('m_lockercode_title')->where_in('m_lockercode_id', explode(',', $locker_val[0]->m_locker_L))->get('master_lockercode_tbl')->result();
                                                                                        foreach ($lockername as $rkey) {
                                                                                            echo '<span class="btn btn-sm btn-primary" title="" style="margin-left: 5px;">' . $rkey->m_lockercode_title . '</span>';
                                                                                        }
                                                                                        ?>
                                                                                    </p>
                                                                                    <br>
                                                                                    <p> Cat G-
                                                                                        <?php $lockername = $this->db->select('m_lockercode_title')->where_in('m_lockercode_id', explode(',', $locker_val[0]->m_locker_G))->get('master_lockercode_tbl')->result();
                                                                                        foreach ($lockername as $rkey) {
                                                                                            echo '<span class="btn btn-sm btn-primary" title="" style="margin-left: 5px;">' . $rkey->m_lockercode_title . '</span>';
                                                                                        }
                                                                                        ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <?php if ($locker_val[0]->m_locker_status == 2) {
                                                                        echo '<span > Already refunded</span>';
                                                                    } ?>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success" id="btn-lockerrefund" <?php if ($locker_val[0]->m_locker_status == 2) {
                                                                                                                                            echo 'disabled';
                                                                                                                                        } ?>>Save</button>


                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!---import model end above-->
                                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'LC', 'Edit')) { ?>
                                                    <!-- <a href="<?php echo base_url('Shop/add_locker?id=') . $locker_val[0]->m_locker_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a> -->
                                                <?php }
                                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'LC', 'Delete')) { ?>
                                                    <!-- <button class="btn btn-danger btn-action delete-locker" data-value="<?php echo $locker_val[0]->m_locker_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button> -->
                                                <?php }  if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'LC', 'Add')) { ?>
                                                    <a href="<?php echo site_url('Shop/add_locker?ticketid=') . $value->m_ticket_id ?>" class="btn btn-info btn-vsm" title="Add new"><i class="fa fa-plus-circle"></i></a>
                                            <?php   }
                                            } else {
                                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'LC', 'Add')) { ?>
                                                    <a href="<?php echo site_url('Shop/add_locker?ticketid=') . $value->m_ticket_id ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i>Add Locker </a>
                                            <?php   }
                                            } ?>
                                        </td>

                                    </tr>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <table id="locker_tbl" class="mylong_datatable table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>Dated</th>
                                <th>CustomerName</th>
                                <th>Mobile No</th>
                                <th>Active Lockers</th>
                                <th>Total Quantity</th>
                                <th>Total Rent</th>
                                <th>Total Deposit</th>
                                <th>Total Payable</th>
                                <th>Total Paid</th>
                                <th>Total Refund</th>
                                <th>Refund on</th>
                                <th>Remark</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ii = 0;
                            if (!empty($locker_value)) {
                                foreach ($locker_value as $value) {
                                    $locker_id ='';
                                    if (!empty($value->m_locker_B)) {
                                        $locker_id .=  $value->m_locker_B;
                                    }
                                    if (!empty($value->m_locker_L)) {
                                        $locker_id .= ',';
                                        $locker_id .=  $value->m_locker_L;
                                    }
                                    if (!empty($value->m_locker_G)) {
                                        $locker_id .= ',';
                                        $locker_id .=  $value->m_locker_G;
                                    }

// echo'<pre>';print_r($locker_id);
                                    $lockername = $this->db->select('Group_concat(m_lockercode_title) as locker_name')->where_in('m_lockercode_id', explode(',',$locker_id))->get('master_lockercode_tbl')->result();
                                    $ii++;

                            ?>
                                    <tr>
                                        <td><?php echo $ii; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($value->m_locker_date)); ?></td>
                                        <td><?php echo $value->m_cust_name; ?></td>
                                        <td><?php echo $value->m_cust_mobile; ?></td>

                                        <td><?php echo $lockername[0]->locker_name;  ?></td>
                                        <td><?php echo $value->m_locker_Tlocker;  ?></td>
                                        <td><?php echo $value->m_locker_Trent;  ?></td>
                                        <td><?php echo $value->m_locker_Tdeposit;  ?></td>
                                        <td><?php echo $value->m_locker_payableAmt; ?></td>
                                        <td><?php echo $value->m_locker_paidAmt; ?></td>
                                        <td><?php echo $value->m_locker_refund; ?></td>
                                        <td><?php echo $value->m_locker_refund_on == '0000-00-00 00:00:00' ? '--' : date('d-m-Y h:i', strtotime($value->m_locker_refund_on)); ?></td>
                                        <td><?php echo $value->m_locker_remark; ?></td>

                                        <td class="wd-30">

                                        <button type="button" class="btn btn-vsm" style="background-color: #34bc72;" data-toggle="modal" data-target="#myrefundModal<?= $value->m_locker_id ?>"><i class="fa fa-reply-all"></i></button>
                                                <!---import model-->

                                                <div id="myrefundModal<?= $value->m_locker_id ?>" class="modal fade myrefundModal" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Refund Modal</h4>
                                                            </div>
                                                            <form method="POST" id="frm-lockerrefund" enctype="multipart/form-data">
                                                                <div class="modal-body">

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-md-6 col-sm-6 col-form-label">Dr Account</label>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <select name="m_locker_counter" id="m_locker_counter" class="form-control select2">
                                                                                <?php
                                                                                foreach ($cashcot_dtl as $cckey) {
                                                                                    if ($value->m_locker_counter == $cckey->m_cashacc_id) {
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

                                                                    <div class="row" style="margin-top: 10px;">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <label for="staticEmail" class="col-sm-2 col-form-label">Mobile</label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="hidden" class="form-control" id="m_locker_id" name="m_locker_id" value="<?= $value->m_locker_id ?>" />
                                                                                    <input type="number" class="form-control" id="m_cust_mobile" name="m_cust_mobile" value="<?= $value->m_cust_mobile ?>" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="text" name="m_cust_name" id="m_cust_name" class="form-control" value="<?= $value->m_cust_name ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row" style="margin-top: 10px;">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <label for="staticEmail" class="col-sm-5 col-form-label">Deposit Amt</label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="number" class="form-control" id="m_locker_Tdeposit" name="m_locker_Tdeposit" value="<?= $value->m_locker_Tdeposit ?>" />
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row" style="margin-top: 10px;">
                                                                                <label for="staticEmail" class="col-sm-5 col-form-label">Return Amt</label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="number" class="form-control" id="m_locker_Treturn" name="m_locker_Treturn" value="<?= $value->m_locker_Tdeposit ?>" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <label for="staticEmail" class="col-sm-12 col-form-label">Alloted Locker list</label>
                                                                                <div class="col-sm-12">
                                                                                    <p> Cat B-
                                                                                        <?php $lockername = $this->db->select('m_lockercode_title')->where_in('m_lockercode_id', explode(',', $value->m_locker_B))->get('master_lockercode_tbl')->result();
                                                                                        foreach ($lockername as $rkey) {
                                                                                            echo '<span class="btn btn-sm btn-primary" title="" style="margin-left: 5px;">' . $rkey->m_lockercode_title . '</span>';
                                                                                        }
                                                                                        ?>
                                                                                    </p>
                                                                                    <br>
                                                                                    <p> Cat L-
                                                                                        <?php $lockername = $this->db->select('m_lockercode_title')->where_in('m_lockercode_id', explode(',', $value->m_locker_L))->get('master_lockercode_tbl')->result();
                                                                                        foreach ($lockername as $rkey) {
                                                                                            echo '<span class="btn btn-sm btn-primary" title="" style="margin-left: 5px;">' . $rkey->m_lockercode_title . '</span>';
                                                                                        }
                                                                                        ?>
                                                                                    </p>
                                                                                    <br>
                                                                                    <p> Cat G-
                                                                                        <?php $lockername = $this->db->select('m_lockercode_title')->where_in('m_lockercode_id', explode(',', $value->m_locker_G))->get('master_lockercode_tbl')->result();
                                                                                        foreach ($lockername as $rkey) {
                                                                                            echo '<span class="btn btn-sm btn-primary" title="" style="margin-left: 5px;">' . $rkey->m_lockercode_title . '</span>';
                                                                                        }
                                                                                        ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <?php if ($value->m_locker_status == 2) {
                                                                        echo '<span > Already refunded</span>';
                                                                    } ?>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success" id="btn-lockerrefund" <?php if ($value->m_locker_status == 2) {
                                                                                                                                            echo 'disabled';
                                                                                                                                        } ?>>Save</button>


                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!---import model end above-->

                                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS', 'Edit')) { ?>
                                              
                                                <a href="<?php echo base_url('Shop/add_locker?id=') . $value->m_locker_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <?php }
                                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS', 'Delete')) { ?>
                                                <button class="btn btn-danger btn-action delete-locker" data-value="<?php echo $value->m_locker_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                            <?php }

                                            ?>
                                        </td>
                                    </tr>
                            <?php

                                }
                            }
                            ?>
                        </tbody>
                    </table>
                <?php  } ?>
            </div>
        </div>
    </div>
</div>
<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/locker_js');
$this->view('js/custom_js'); ?>
<!-- =======================/Footer================Fix======= -->