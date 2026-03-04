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

            .form-inline .form-control {
                display: block;
            }
        </style>
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-lg-10">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'Lead', 'Filter')) { ?>
                        <form method="post" action="<?php echo site_url('Marketing/lead_list') ?>">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>From Date</label>
                                    <input class="form-control date_form " type="date" placeholder="From Date" name="from_date" id="m_from_date" value="<?php echo $from_date; ?>">
                                </div>
                                <div class="col-md-2">
                                    <label>To Date</label>
                                    <input class="form-control date_form " type="date" placeholder="To Date" name="to_date" id="m_from_date" value="<?php echo $to_date; ?>">
                                </div>
                                <div class="col-md-2">
                                    <label>Client</label>
                                    <select name="clientsearch" class="form-control select2">
                                        <option value="">Select client</option>
                                        <?php
                                        foreach ($leadclient_dtl as $value) {

                                            if ($clientsearch == $value->m_lclient_id) {
                                                $option1 = "selected";
                                            } else {
                                                $option1 = "";
                                            }

                                        ?>
                                            <option value="<?php echo $value->m_lclient_id; ?>" <?= $option1 ?>><?php echo $value->m_lclient_name ?></option>
                                        <?php
                                        }

                                        ?>

                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Plan</label>
                                    <select name="planserach" class="form-control select2">
                                        <option value="">Select Plan</option>
                                        <?php
                                        foreach ($planlist as $value) {

                                            if ($planserach == $value->m_hq_id) {
                                                $option1 = "selected";
                                            } else {
                                                $option1 = "";
                                            }

                                        ?>
                                            <option value="<?php echo $value->m_hq_id; ?>" <?= $option1 ?>><?php echo $value->m_hq_name ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Status</label>
                                    <select name="statussearch" class="form-control select2">
                                        <option value="">Select Status</option>
                                        <?php
                                        foreach ($leadstatus as $value) {

                                            if ($statussearch == $value->m_leadst_id) {
                                                $option1 = "selected";
                                            } else {
                                                $option1 = "";
                                            }

                                        ?>
                                            <option value="<?php echo $value->m_leadst_id; ?>" <?= $option1 ?>><?php echo $value->m_leadst_name ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-info btn-vsm" type="submit" title="Click To Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        <a href="<?php echo site_url('Marketing/lead_list') ?>"><button class="btn btn-primary btn-vsm" type="button" title="Click To Reset"><i class="fa fa-refresh" aria-hidden="true"></i></button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'Lead', 'Export')) { ?>
                                            <button class="btn btn-success btn-vsm" type="submit" name="Excel" value="2" title="Export Excel File"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
                                        <?php } ?>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'Lead', 'Add')) { ?>
                                            <a href="<?php echo site_url('Marketing/add_lead') ?>" class="btn btn-info btn-vsm" style="margin-top: 5px;" title="Add New Lead"><i class="fa fa-plus-circle"></i> Add New Lead</a>
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
            <div class="advance-table table-overflow">
                <table id="lead_tbl" class="my_custom_datatable table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Client Name</th>
                            <th>PRO/Marketing </th>
                            <th>Plan</th>
                            <th>Lead Date</th>
                            <th>Followup Date</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($lead_value)) {
                            foreach ($lead_value as $value) {
                                $items_name = $this->db->select('GROUP_CONCAT(m_menu_name) as names')->where_in('m_menu_id', explode(',', $value->package_item))->get('master_menu_tbl')->result();

                                $check_enrolled = $this->db->select('m_ticket_id')->where('m_ticket_lead_id', $value->m_lead_id)->get('tickets_wp_tbl')->row(); ?>


                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->m_lclient_name; ?></td>
                                    <td><?php echo $value->m_emp_name; ?></td>
                                    <td><?php echo $value->plan_name; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($value->m_lead_date)); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($value->m_lead_followup)); ?></td>
                                    <td><?php echo $value->m_lead_remark; ?></td>
                                    <td><?php echo $value->status_name; ?></td>
                                    <td class="wd-30">
                                        <?php if ($value->m_lead_status == 12 && empty($check_enrolled)) {
                                            echo '<button type="button" class="btn btn-primary btn-action" data-toggle="modal" data-target="#convertmodal' . $value->m_lead_id . '" title="Convert to Ticket"><i class="fa fa-share" aria-hidden="true"></i></button>';
                                        } ?>

                                        <!-- view Modal start -->
                                        <div class="modal fade" id="convertmodal<?php echo $value->m_lead_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="width: 50%;">
                                                <div class="modal-content">
                                                    <form action="<?= base_url('Shop/convert_lead_ticket') ?>" method="post">
                                                        <div class="modal-header">
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <h4 class="modal-title">Convert To Ticket</h4>
                                                                </div>
                                                                <div class="col-md-2" style="text-align: end;">
                                                                    <button type="button" class="btn-close btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body" style="word-break: break-all">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card p-3">
                                                                        <div class="row " style="margin: 0px;">
                                                                            <div class="col-md-6 pd-5">
                                                                                Plan : <b><?= $value->plan_name; ?></b>
                                                                            </div>
                                                                            <div class="col-md-6 pd-5 text-end">
                                                                                Ratio : <b><?= $value->m_lead_ratio; ?></b>
                                                                            </div>
                                                                            <div class="col-md-6 pd-5 ">
                                                                                Free Locker : <b><?= $value->m_lead_flocker; ?></b>,Free Costume : <b><?= $value->m_lead_fcostume; ?></b>
                                                                            </div>

                                                                            <div class="col-md-6 pd-5 text-end">
                                                                                Advance Recieved : <b><?= $value->m_lead_advance; ?></b>
                                                                            </div>
                                                                            <div class="col-md-12 pd-5">
                                                                                Food Offer : <b><?= $value->package_name; ?></b> Items : <b><?= $items_name[0]->names ?></b>
                                                                            </div>
                                                                            <div class="col-md-6 pd-5">
                                                                                PRO Officer : <b><?= $value->m_emp_name; ?></b>
                                                                            </div>
                                                                            <div class="col-md-6 pd-5 text-end">
                                                                                Arrival Date : <b><?= date('d-m-Y', strtotime($value->m_lead_followup)); ?></b>
                                                                            </div>



                                                                            <div class="col-md-12 pd-5">
                                                                                Last Meet With : <b><?= $value->lc_person_name; ?></b>, Contact : <b><?= $value->lc_person_mobileno; ?></b>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row">

                                                                <input name="m_ticket_head" id="m_ticket_head<?= $value->m_lead_id ?>" type="hidden" value="10">
                                                                <input name="m_ticket_paymode" id="m_ticket_paymode<?= $value->m_lead_id ?>" value="Cash" type="hidden">
                                                                <input name="m_ticket_counter" id="m_ticket_counter<?= $value->m_lead_id ?>" value="0" type="hidden">
                                                                <input name="m_ticket_paytype" id="m_ticket_paytype<?= $value->m_lead_id ?>" value="1" type="hidden">

                                                                <input name="m_ticket_city" type="hidden" value="<?= $value->m_lclient_city; ?>">
                                                                <input name="m_ticket_remark" type="hidden" value="test">
                                                                <input name="m_ticket_cusType" type="hidden" value="General">

                                                                <input name="m_ticket_lead_id" type="hidden" value="<?= $value->m_lead_id ?>">


                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Date</label>
                                                                        <input type="date" name="m_ticket_date" id="m_ticket_date<?= $value->m_lead_id ?>" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                                                    </div>
                                                                </div>



                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Name <span class="text-danger">*</span></label>
                                                                        <input type="text" name="m_cust_name" id="m_cust_name<?= $value->m_lead_id ?>" class="form-control" placeholder="Enter Name" value="<?= $value->m_lclient_name; ?>" required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Mobile No.<span class="text-danger">*</span></label>
                                                                        <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_cust_mobile" id="m_cust_mobile<?= $value->m_lead_id ?>" class="form-control" placeholder="Enter Mobile Number" required="" autofocus value="<?= $value->lc_person_mobileno; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Adult <span class="text-danger">*</span></label>
                                                                        <input type="number" name="m_ticket_adult" id="m_ticket_adult<?= $value->m_lead_id ?>" class="form-control amountcalculate" data-count="<?= $value->m_lead_id ?>" placeholder="Adult" required="" value="<?= $value->m_lead_minvisits ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Free <span class="text-danger">*</span></label>
                                                                        <input type="number" name="m_ticket_free" id="m_ticket_free<?= $value->m_lead_id ?>" class="form-control amountcalculate" data-count="<?= $value->m_lead_id ?>" placeholder="Free" required="" value="0">
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Rate/Head</label>

                                                                        <input type="number" id="m_ticket_rate<?= $value->m_lead_id ?>" class="form-control amountcalculate" data-count="<?= $value->m_lead_id ?>" value="<?= $value->m_lead_rateph ?>">
                                                                        <input type="hidden" name="m_ticket_totalAmt" id="m_ticket_totalAmt<?= $value->m_lead_id ?>" class="form-control amountcalculate" data-count="<?= $value->m_lead_id ?>" value="<?= $value->m_lead_minvisits * $value->m_lead_rateph ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>GST</label>
                                                                        <input type="number" name="m_ticket_gstAmt" id="m_ticket_gstAmt<?= $value->m_lead_id ?>" class="form-control amountcalculate" data-count="<?= $value->m_lead_id ?>" value="0">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Net Amount</label>
                                                                        <input type="number" name="m_ticket_netAmt" id="m_ticket_netAmt<?= $value->m_lead_id ?>" class="form-control amountcalculate" data-count="<?= $value->m_lead_id ?>" value="<?= $value->m_lead_minvisits * $value->m_lead_rateph ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Advance Amount</label>
                                                                        <input type="number" name="m_ticket_advance" id="m_ticket_advance<?= $value->m_lead_id ?>" class="form-control amountcalculate" data-count="<?= $value->m_lead_id ?>" readonly value="<?= $value->m_lead_advance ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 cashdiv paypartial" style="display: none; margin-top:30px">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input m_ticket_ispartial" id="m_ticket_ispartial<?= $value->m_lead_id ?>" data-count="<?= $value->m_lead_id ?>" name="m_ticket_ispartial" value="1">
                                                                        <label class="form-check-label" for="m_ticket_ispartial"> Partial Payment</label>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-4 cashdiv" id="Ampayty_in<?= $value->m_lead_id ?>">
                                                                    <div class="form-group">
                                                                        <label>Payment Mode</label>
                                                                        <select name="m_ticket_paytype" id="m_ticket_paytype<?= $value->m_lead_id ?>" data-count="<?= $value->m_lead_id ?>" class="form-control select2 m_ticket_paytype" style="width: 100%;">

                                                                            <option value="partial" id="partial_op<?= $value->m_lead_id ?>">Partial Payment</option>
                                                                            <option value="1" selected>Cash</option>
                                                                            <option value="2">Paytm</option>
                                                                            <option value="3">Phone Pay</option>
                                                                            <option value="4">Other</option>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Amount Paid</label>
                                                                        <input type="number" name="m_ticket_paidAmt" id="m_ticket_paidAmt<?= $value->m_lead_id ?>" class="form-control m_ticket_paidAmt" data-count="<?= $value->m_lead_id ?>" required value="<?= (($value->m_lead_minvisits * $value->m_lead_rateph) - $value->m_lead_advance)  ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 cashdiv paypartial" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label>Payment Mode2</label>
                                                                        <select name="m_ticket_paytype2" id="m_ticket_paytype2<?= $value->m_lead_id ?>" data-count="<?= $value->m_lead_id ?>" class="form-control select2" style="width:100%">
                                                                            <option value="1">Cash</option>
                                                                            <option value="2">Paytm</option>
                                                                            <option value="3">Phone Pay</option>
                                                                            <option value="4">Other</option>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 cashdiv paypartial" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label>Amount Paid2</label>
                                                                        <input type="number" name="m_ticket_paidAmt2" id="m_ticket_paidAmt2<?= $value->m_lead_id ?>" data-count="<?= $value->m_lead_id ?>" class="form-control" value="">
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Balance</label>
                                                                        <input type="hidden" name="m_ticket_balAmt" class="form-control m_ticket_balAmt<?= $value->m_lead_id ?>" readonly value="0">
                                                                        <input type="number" class="form-control m_ticket_balAmt<?= $value->m_lead_id ?>" disabled value="0">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Band Color <span class="text-danger">*</span></label>
                                                                        <select name="m_lead_bandcolor" id="m_lead_bandcolor<?= $value->m_lead_id ?>" class="form-control select2" style="width: 100%;">
                                                                            <option value="">Select Band</option>
                                                                            <?php
                                                                            if (!empty($bandcolour)) {
                                                                                foreach ($bandcolour as $vall) {

                                                                                    if ($value->m_lead_bandcolor == $vall->m_hq_id) {
                                                                                        $option1 = "selected";
                                                                                    } else {
                                                                                        $option1 = "";
                                                                                    }

                                                                            ?>
                                                                                    <option value="<?php echo $vall->m_hq_id; ?>" <?= $option1 ?>><?php echo $vall->m_hq_name ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Free Band Color <span class="text-danger">*</span></label>
                                                                        <select name="m_lead_freecolor" id="m_lead_freecolor<?= $value->m_lead_id ?>" class="form-control select2" style="width: 100%;">
                                                                            <option value="">Select Band</option>
                                                                            <?php
                                                                            if (!empty($bandcolour)) {
                                                                                foreach ($bandcolour as $vall2) {

                                                                                    if ($value->m_lead_freecolor == $vall2->m_hq_id) {
                                                                                        $option1 = "selected";
                                                                                    } else {
                                                                                        $option1 = "";
                                                                                    }

                                                                            ?>
                                                                                    <option value="<?php echo $vall2->m_hq_id; ?>" <?= $option1 ?>><?php echo $vall2->m_hq_name ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success" id="btn-lockerrefund<?= $value->m_lead_id ?>">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- view modal end -->
                                        <a href="<?= base_url('Marketing/lead_client_print/') . $value->m_lead_id ?>" target="blank" class="btn btn-success btn-vsm"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                        <!-- <a href="<?php echo base_url('Marketing/view_user_dtl?id=') . $value->m_lead_id; ?>" class="btn btn-info btn-action" title="View" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                        <?php if (empty($check_enrolled)) {
                                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'Lead', 'Edit')) { ?>
                                                <a href="<?php echo base_url('Marketing/add_lead/1/') . $value->m_lead_id; ?>" class="btn btn-info btn-action" title="Add Followups" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <?php }
                                       
                                        if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'Lead', 'Delete')) { ?>
                                            <button class="btn btn-danger btn-action delete-blead" data-value="<?php echo $value->m_lead_uno; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                        <?php } }?>
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
$this->view('js/sales_js');
$this->view('js/custom_js'); ?>

<script>
    $(document).ready(function(e) {

        $(".amountcalculate").on("change", function() {
            var count = $(this).data('count');
            calculate_total(count)
        });

        $('.m_ticket_ispartial').click(function() {
            var count = $(this).data('count');
            if ($(this).prop('checked') == false) {
                $('.paypartial').css('display', 'none');
                $('#m_ticket_paytype' + count).append(`<option value="partial" id="partial_op">Partial Payment</option>`);
                $('#m_ticket_ispartial' + count).prop('checked', false);
                $('#m_ticket_paytype' + count).val(1);
            }
        });

        $('.m_ticket_paytype').change(function() {
            var count = $(this).data('count');
            if ($(this).val() == 'partial') {
                $('.paypartial').css('display', 'block');
                $('#partial_op' + count).remove();
                $('#m_ticket_ispartial' + count).prop('checked', true);
                $('#m_ticket_paytype' + count).val(1);
            }

        });

        $('.m_ticket_paidAmt').change(function() {
            var count = $(this).data('count');
            if ($('#m_ticket_ispartial' + count).prop('checked') == true) {
                var netamout = parseFloat($('#m_ticket_netAmt' + count).val());
                var tick_advance = parseInt($("#m_ticket_advance" + count).val());
                var paidt1 = parseFloat($(this).val());
                var paidt2 = (netamout - tick_advance - paidt1);
                $('#m_ticket_paidAmt2' + count).val(paidt2);
            }

        });

    });

    function calculate_total(count) {

        var tick_adult = parseInt($("#m_ticket_adult" + count).val());
        var tick_totalAmt = parseInt($("#m_ticket_rate" + count).val());
        var tick_advance = parseInt($("#m_ticket_advance" + count).val());
        var tick_gstAmt = parseInt($("#m_ticket_gstAmt" + count).val());

        var adultTAmt = tick_adult * tick_totalAmt
        $("#m_ticket_totalAmt" + count).val(adultTAmt)
        $('#m_ticket_netAmt' + count).val(Math.round(tick_gstAmt + adultTAmt))
        $('#m_ticket_paidAmt' + count).val(Math.round(tick_gstAmt + adultTAmt - tick_advance))


        var tick_paidAmt = parseInt($("#m_ticket_paidAmt" + count).val());
        $('.m_ticket_balAmt' + count).val(Math.round(tick_gstAmt + adultTAmt) - tick_paidAmt - tick_advance);
    }
</script>