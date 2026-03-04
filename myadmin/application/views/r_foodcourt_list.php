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
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'FCDE', 'Filter')) { ?>
                    <form method="post" action="<?php echo site_url('Restuarent/foodcourt_list') ?>">
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
                                    <a href="<?php echo site_url('Restuarent/foodcourt_list') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'FCDE', 'Export')) { ?>
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
                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'FCDE', 'Add')) { ?>
                            <a href="<?php echo site_url('Restuarent/add_foodcourt') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-box">
            <div class="advance-table tabel-overflow">
                <table id="sales_tbl" class="my_custom_datatable table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Uno.</th>
                            <th>Dated</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Remark</th>
                            <th>Added By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ii = 0;
                        if (!empty($all_data)) {
                            foreach ($all_data as $value) {
                                $product = $this->db->select('group_concat(m_menu_name) as items_name')->where_in('m_menu_id',explode(',',$value->itemid))->get('master_menu_tbl')->result();
                               $ii++;
                        ?>
                                <tr>
                                
                                    <td><?php echo $ii; ?></td>
                                    <td><?= $value->r_fcdata_uno; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($value->r_fcdata_date)); ?></td>
                                    <td><?= $product[0]->items_name ?></td>
                                    <td><?= $value->totqty ?></td>
                                    <td><?= $value->r_fcdata_nettotal; ?></td>
                                    <td><?php echo $value->r_fcdata_remark; ?></td>
                                    <td><?php echo $value->m_admin_name; ?></td>
                                   
                                    <td class="wd-30">
                                        
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'FCDE', 'Edit')) { ?>
                                            <a href="<?php echo base_url('Restuarent/add_foodcourt?id=') . $value->r_fcdata_uno; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                        <?php }
                                        if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'FCDE', 'Delete')) { ?>
                                            <button class="btn btn-danger btn-action delete-foodcourt" data-type="1" data-value="<?php echo $value->r_fcdata_uno; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                        <?php } ?>
                                    </td>
                                </tr>
                        <?php

                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/restuarent_js');
$this->view('js/custom_js'); ?>
<!-- =======================/Footer================Fix======= -->