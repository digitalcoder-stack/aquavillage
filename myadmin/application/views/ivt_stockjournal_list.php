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
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKJN', 'Filter')) { ?>
                        <form method="post" action="<?php echo site_url('Inventory/stockjournal_list') ?>">
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
                                        <a href="<?php echo site_url('Inventory/stockjournal_list') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKJN', 'Export')) { ?>
                                            <!-- <button class="btn btn-success" type="submit" name="Excel" value="2">Excel Export</button> -->
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </form>
                    <?php } ?>
                </div>
                <div class="col-lg-2 pull-right">
                    <div class="seipkon-breadcromb-right">
                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKJN', 'Add')) { ?>
                            <a href="<?php echo site_url('Inventory/add_stockjournal') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-box">
            <div class="advance-table table-overflow">
                <table id="stkjn_tbl" class="my_custom_datatable table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>No</th>
                            <th>Dated</th>
                            <th>CompanyName</th>
                            <th>Godown</th>
                            <th>Total Qty</th>
                            <th>Remarks</th>
                            <th>Addedby</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php
                        $i = 1;
                        if (!empty($stkjn_value)) {
                            foreach ($stkjn_value as $value) {

                        ?>
                                <tr class="">
                                    <td><?= $i; ?></td>
                                    <td><?= $value->ivt_stkjn_no; ?></td>
                                    <td><?= date('d-m-Y', strtotime($value->ivt_stkjn_date)); ?></td>
                                    <td><?= $value->m_company_name; ?></td>
                                    <td><?= $value->m_godown_name; ?></td>
                                    <td><?= $value->totqty; ?></td>
                                    <td><?= $value->ivt_stkjn_remark; ?></td>
                                    <td><?= $value->m_admin_name; ?></td>

                                    <td class="wd-30">

                                        <button type="button" class="btn btn-primary btn-action" onclick="viewmodalfun(<?php echo $value->ivt_stkjn_no; ?>);" title="View"><i class="fa fa-eye"></i></button>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKJN', 'Edit')) { ?>
                                            <a href="<?php echo base_url('Inventory/add_stockjournal?editid=') . $value->ivt_stkjn_no; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                        <?php }
                                        if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKJN', 'Delete')) { ?>
                                            <button class="btn btn-danger btn-action delete-stkjn" data-dtype="1" data-value="<?php echo $value->ivt_stkjn_no; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
$this->view('js/restuarent_js');
$this->view('js/custom_js'); ?>
<script>
    function viewmodalfun(stkno) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('Inventory/get_stkjn_dtl'); ?>",
            data: {
                stkno
            },
            dataType: "JSON",
            success: function(data) {
                if (data != '') {

                    tabbody = '';

                    $.each(data.ivt_stkjn_items, function(i, item) {
                        tabbody += ` <tr>
                                                <td>` + (i + 1) + `</td>
                                                <td>` + item.m_product_name + `</td>
                                                <td>` + item.productsize + `</td>
                                                <td>` + item.productunit + `</td>
                                                <td>` + item.ivt_stkjn_prodqty + `</td>
                                                <td>` + item.ivt_stkjn_prodrate + `</td>
                                                <td>` + item.ivt_stkjn_tamt + `</td>
                                            </tr>`;
                    });


                    $('#modaltitle').text('Stock No (' + stkno + ')');
                    $('#modalcontent').html(`<div class="row">
                            <div class="col-md-6 col-xs-3">
                                <b>Date :</b> ` + data.ivt_stkjn_date + `
                            </div>

                            <div class="col-md-6 col-xs-3">
                                <b>Company :</b>` + data.m_company_name + `
                            </div>
                            <div class="col-md-6 col-xs-5">
                                <b>Godown :</b> ` + data.m_godown_name + `
                            </div>
                            <div class="col-md-6 col-xs-4">
                                <b>Added By :</b> ` + data.m_admin_name + `
                            </div>

                            <div class="col-md-12 col-xs-8">
                                <b>Remark :</b> ` + data.ivt_stkjn_remark + `
                            </div>

                        </div>`);
                    $('#modaltables').html(`<h5>Stock Items</h5>
                        
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Product</th>
                                        <th>Size</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="modaltablebody">
                                    ` + tabbody + `
                                </tbody>
                            </table>`);
                    $('#viewModal').modal('show');
                }
            },
            error: function(jqXHR, status, err) {
                swal("Some Problem Occurred!! please try again", {
                    icon: "error",
                    timer: 2000,
                });
            }
        });
    }
</script>
