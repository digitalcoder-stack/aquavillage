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
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS', 'Filter')) { ?>
                        <form method="post" action="<?php echo site_url('Shop/costume_list/' . $type) ?>">
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
                                        <a href="<?php echo site_url('Shop/costume_list/' . $type) ?>"><button class="btn btn-primary" type="button">Refresh</button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS', 'Export')) { ?>
                                            <button class="btn btn-success" type="submit" name="Excel" value="2">Export</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>

            </div>
        </div>

        <div class="page-box">
            <div class="advance-table tabel-overflow">
                <?php if ($type == 1) { ?>
                    <table id="costume_tbl" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>Dated</th>
                                <th>Mode</th>
                                <th>Mobile No</th>
                                <th>Family</th>
                                <th>Stag</th>
                                <th>CustomerName</th>
                                <th>Created on</th>
                                <th>Refund</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ii = 0;
                            if (!empty($ticket_value)) {
                                foreach ($ticket_value as $value) {

                                    $costume_val = $this->db->select('m_costume_ticket_id,group_concat(m_costume_id) as m_costume_id,m_costume_counter,group_concat(m_costume_Tdeposit) as m_costume_Tdeposit,sum(m_costume_Tdeposit) as total_Tdeposit,sum(m_costume_refund) as total_Treturn,group_concat(m_costume_cosid) as m_costume_cosid,group_concat(m_costume_Tqty) as m_costume_Tqty,m_costume_status')->where('DATE_FORMAT(m_costume_added_on,"%Y-%m-%d")', date('Y-m-d'))->where('m_costume_ticket_id', $value->m_ticket_id)->group_by('m_costume_ticket_id')->get('costume_wp_tbl')->result();
                                    // echo '<pre>';
                                    // print_r($costume_val);
                                    $ii++;
                            ?>
                                    <tr>
                                        <td><?php echo $ii; ?></td>
                                        <td><?php echo $value->m_ticket_date; ?></td>
                                        <td><?php echo "Cash" ?></td>
                                        <td><?php echo $value->m_cust_mobile; ?></td>
                                        <td><?php echo $value->m_ticket_adult; ?></td>
                                        <td><?php echo $value->m_ticket_child; ?></td>
                                        <td><?php echo $value->m_cust_name; ?></td>
                                        <td><?php echo date('d-m-Y h:i', strtotime($value->m_ticket_added_on)); ?></td>
                                        <td><?php if (!empty($costume_val)) { echo $costume_val[0]->total_Treturn; }?></td>
                                       

                                        <td class="wd-30">
                                            <?php if (!empty($costume_val)) { ?>
                                                <button type="button" class="btn btn-vsm" style="background-color: #34bc72;" data-toggle="modal" data-target="#myrefundModal<?= $costume_val[0]->m_costume_ticket_id ?>"><i class="fa fa-reply-all"></i></button>
                                                <!---import model-->

                                                <div id="myrefundModal<?= $costume_val[0]->m_costume_ticket_id ?>" class="modal fade myrefundModal" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Refund Modal</h4>
                                                            </div>
                                                            <form method="POST" id="frm-costumerefund" enctype="multipart/form-data">
                                                                <div class="modal-body">

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-md-6 col-sm-6 col-form-label">Dr Account</label>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <select name="m_costume_counter" id="m_costume_counter" class="form-control select2">
                                                                                <?php
                                                                                foreach ($cashcot_dtl as $cckey) {
                                                                                    if ($costume_val[0]->m_costume_counter == $cckey->m_cashacc_id) {
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
                                                                                    <input type="hidden" class="form-control" id="m_costume_id" name="m_costume_id" value="<?= $costume_val[0]->m_costume_id ?>" />
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
                                                                                    <input type="number" class="form-control" id="m_costume_Tdeposit" name="m_costume_Tdeposit" value="<?= $costume_val[0]->total_Tdeposit ?>" readonly />
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row" style="margin-top: 10px;">
                                                                                <label for="staticEmail" class="col-sm-5 col-form-label">Return Amt</label>
                                                                                <div class="col-sm-7">
                                                                                    <input type="hidden"  name="m_costume_refund" value="<?= $costume_val[0]->m_costume_Tdeposit ?>" />
                                                                                    <input type="number" class="form-control" id="m_costume_refund" value="<?= $costume_val[0]->total_Tdeposit ?>" readonly />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <label for="staticEmail" class="col-sm-12 col-form-label">Alloted costume list</label>
                                                                                <div class="col-sm-12">
                                                                                    <table class=" table table-striped table-bordered" style="display: block; height: 200px;overflow-y: scroll;">
                                                                                        <thead>
                                                                                            <th width="1%">Sn</th>
                                                                                            <th>Title </th>
                                                                                            <th>Qty </th>

                                                                                            <th>ReturnQty</th>
                                                                                        </thead>
                                                                                        <tbody>

                                                                                            <?php
                                                                                            $cci = 0;
                                                                                            $cosid = explode(',', $costume_val[0]->m_costume_cosid);
                                                                                            $qty = explode(',', $costume_val[0]->m_costume_Tqty);
                                                                                            foreach ($cosid as $ciu => $catB) {
                                                                                                if (!empty($catB)) {
                                                                                                    $cci ++;
                                                                                                    $cosCode = $this->db->where('m_product_id', $catB)->get('master_product_tbl')->row();
                                                                                            ?>
                                                                                                    <tr>
                                                                                                        <td><?= ($cci) ?></td>
                                                                                                        <td><?= $cosCode->m_product_name ?></td>
                                                                                                        <td class="recoredqty<?= $cosCode->m_product_id ?>"><?= $qty[$ciu] ?></td>
                                                                                                        <td><input type="number" style="width: 50px;" name="m_costume_Tqty2[]" class="returnqty" data-recoredqty="<?= $qty[$ciu] ?>" required>
                                                                                                    </tr>
                                                                                            <?php }
                                                                                            }
                                                                                            ?>
                                                                                        </tbody>
                                                                                    </table>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <?php if ($costume_val[0]->m_costume_status == 2) {
                                                                        echo '<span > Already refunded</span>';
                                                                    } ?>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success" id="btn-costumerefund" <?php if ($costume_val[0]->m_costume_status == 2) {
                                                                                                                                                echo 'disabled';
                                                                                                                                            } ?>>Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!---import model end above-->
                                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS', 'Edit')) { ?>

                                                    <!-- <a href="<?php echo base_url('Shop/add_costume?id=') . $costume_val[0]->m_costume_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a> -->
                                                <?php }
                                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS', 'Delete')) { ?>
                                                    <!-- <button class="btn btn-danger btn-action delete-costume" data-value="<?php echo $costume_val[0]->m_costume_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button> -->
                                                <?php }
                                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS', 'Add')) { ?>
                                                    <a href="<?php echo site_url('Shop/add_costume?ticketid=') . $value->m_ticket_id ?>" class="btn btn-info btn-vsm" title="Add new"><i class="fa fa-plus-circle"></i></a>
                                                <?php   }
                                            } else {
                                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS', 'Add')) { ?>
                                                    <a href="<?php echo site_url('Shop/add_costume?ticketid=') . $value->m_ticket_id ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i>Add Costume </a>
                                            <?php   }
                                            } ?>
                                        </td>
                                    </tr>
                            <?php

                                }
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <table id="costume_tbl" class="mylong_datatable table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>Dated</th>
                                <th>CustomerName</th>
                                <th>Mobile No</th>

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
                            if (!empty($costume_value)) {
                                foreach ($costume_value as $value) {
                                    $ii++;

                            ?>
                                    <tr>
                                        <td><?php echo $ii; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($value->m_costume_date)); ?></td>
                                        <td><?php echo $value->m_cust_name; ?></td>
                                        <td><?php echo $value->m_cust_mobile; ?></td>

                                        <td><?php echo array_sum(explode(',', $value->m_costume_Tqty))  ?></td>
                                        <td><?php echo $value->m_costume_Trent; ?></td>
                                        <td><?php echo $value->m_costume_Tdeposit; ?></td>
                                        <td><?php echo $value->m_costume_payableAmt; ?></td>
                                        <td><?php echo $value->m_costume_paidAmt; ?></td>
                                        <td><?php echo $value->m_costume_refund; ?></td>
                                        <td><?php echo $value->m_costume_refund_on == '0000-00-00 00:00:00' ? '--' : date('d-m-Y h:i', strtotime($value->m_costume_refund_on)); ?></td>
                                        <td><?php echo $value->m_costume_remark; ?></td>

                                        <td class="wd-30">


                                            <button type="button" class="btn btn-vsm" style="background-color: #34bc72;" data-toggle="modal" data-target="#myrefundModal<?= $value->m_costume_id ?>"><i class="fa fa-reply-all"></i></button>
                                            <!---import model-->

                                            <div id="myrefundModal<?= $value->m_costume_id ?>" class="modal fade myrefundModal" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Refund Modal</h4>
                                                        </div>
                                                        <form method="POST" id="frm-costumerefund" enctype="multipart/form-data">
                                                            <div class="modal-body">

                                                                <div class="form-group row">
                                                                    <label for="staticEmail" class="col-md-6 col-sm-6 col-form-label">Dr Account</label>
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <select name="m_costume_counter" id="m_costume_counter" class="form-control select2">
                                                                            <?php
                                                                            foreach ($cashcot_dtl as $cckey) {
                                                                                if ($value->m_costume_counter == $cckey->m_cashacc_id) {
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
                                                                                <input type="hidden" class="form-control" id="m_costume_id" name="m_costume_id" value="<?= $value->m_costume_id ?>" />
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
                                                                                <input type="number" class="form-control" id="m_costume_Tdeposit" name="m_costume_Tdeposit" value="<?= $value->m_costume_Tdeposit ?>" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row" style="margin-top: 10px;">
                                                                            <label for="staticEmail" class="col-sm-5 col-form-label">Return Amt</label>
                                                                            <div class="col-sm-7">
                                                                                <input type="number" class="form-control" id="m_costume_refund" name="m_costume_refund" value="<?= $value->m_costume_Tdeposit ?>" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="staticEmail" class="col-sm-12 col-form-label">Alloted costume list</label>
                                                                            <div class="col-sm-12">
                                                                                <table class=" table table-striped table-bordered" style="display: block; height: 200px;overflow-y: scroll;">
                                                                                    <thead>
                                                                                        <th width="1%">Sn</th>
                                                                                        <th>Title </th>
                                                                                        <th>Qty </th>

                                                                                        <th>ReturnQty</th>
                                                                                    </thead>
                                                                                    <tbody>

                                                                                        <?php
                                                                                        $cosCode = $this->db->where_in('m_product_id', explode(',', $value->m_costume_cosid))->get('master_product_tbl')->result();
                                                                                        $i = 0;
                                                                                        $qty = explode(',', $value->m_costume_Tqty);
                                                                                        foreach ($cosCode as $catB) {
                                                                                            $i++; ?>
                                                                                            <tr>
                                                                                                <td><?= $i ?></td>
                                                                                                <td><?= $catB->m_product_name ?></td>
                                                                                                <td class="recoredqty<?= $catB->m_product_id ?>"><?= $qty[$i - 1] ?></td>
                                                                                                <td><input type="number" style="width: 50px;" name="m_costume_Tqty2[]" class="returnqty" data-recoredqty="<?= $qty[$i - 1] ?>" required>
                                                                                            </tr>
                                                                                        <?php }
                                                                                        ?>
                                                                                    </tbody>
                                                                                </table>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <?php if ($value->m_costume_status == 2) {
                                                                    echo '<span > Already refunded</span>';
                                                                } ?>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-success" id="btn-costumerefund" <?php if ($value->m_costume_status == 2) {
                                                                                                                                            echo 'disabled';
                                                                                                                                        } ?>>Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!---import model end above-->

                                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS', 'Edit')) { ?>
                                                <!-- <a href="<?php echo base_url('Shop/view_shop_dtl?id=') . $value->m_costume_id; ?>" class="btn btn-info btn-action" title="View" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                                <a href="<?php echo base_url('Shop/add_costume?id=') . $value->m_costume_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <?php }
                                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS', 'Delete')) { ?>
                                                <button class="btn btn-danger btn-action delete-costume" data-value="<?php echo $value->m_costume_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
$this->view('js/costume_js');
$this->view('js/custom_js'); ?>
<!-- =======================/Footer================Fix======= -->