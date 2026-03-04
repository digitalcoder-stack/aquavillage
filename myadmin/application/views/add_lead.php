<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id') ; $logged_user_type = $this->session->userdata('user_type') ; ?>

<style type="text/css">
    .d-none {
        display: none;

    }

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

    .form-group {
        margin-bottom: 2rem !important;
    }

    .select2-container {
        width: 100% !important;
    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 pull-right">
                    <div class="seipkon-breadcromb-right">
                        <a href="<?php echo site_url('Marketing/lead_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All Leads List</a>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($edit_value)) {
            if ($type == 1) {
                $id  = '';
            } else {
                $id  = $edit_value->m_lead_id;
            }

            $lead_uno  = $edit_value->m_lead_uno;
            $clientid    = $edit_value->m_lead_clientid;
            $date     = $edit_value->m_lead_date;
            $lead_pro  = $edit_value->m_lead_pro;
            $status       = $edit_value->m_lead_status;
            $minvisits = $edit_value->m_lead_minvisits;
            $lratio = $edit_value->m_lead_ratio;
            $rateph = $edit_value->m_lead_rateph;
            $flocker = $edit_value->m_lead_flocker;
            $fcostume = $edit_value->m_lead_fcostume;
            $restoff = $edit_value->m_lead_resoff;
            $meetwith = $edit_value->m_lead_meetwith;
            $followup = $edit_value->m_lead_followup;
            $remark = $edit_value->m_lead_remark;
            $summery = $edit_value->m_lead_summery;
            $lplan = $edit_value->m_lead_plan;
            $lpackage = $edit_value->m_lead_package;
            $advanceto = $edit_value->m_lead_advanceto;
            $advance = $edit_value->m_lead_advance;
            $advance_date = $edit_value->m_lead_advance_date;
            $paymode = $edit_value->m_lead_paymode;
        } else {
            $id         = '';
            $lead_uno    = '';
            $lead_pro  = '';
            $clientid    = $client_id ?: '';
            $date     = date('Y-m-d');
            $status       = '';
            $minvisits = '';
            $lratio = '';
            $rateph = '';
            $flocker = 0;
            $fcostume = 0;
            $restoff = '';
            $meetwith = '';
            $followup = date('Y-m-d', strtotime(date('Y-m-d') . '+7days'));
            $remark = '';
            $summery = '';
            $lplan = '';
            $lpackage = '';
            $advanceto = '';
            $advance = '';
            $advance_date = '';
            $paymode = '';
        } ?>

        <div class="page-box">
            <div class="row" style="display: flex;">
                <div class="col-md-9">
                    <form method="post" action="#" id="frm-add-lead" enctype="mutipart/form-data" style="max-width:100%">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Client Name</label>
                                    <input type="hidden" name="m_lead_uno" id="m_lead_uno" value="<?= $lead_uno; ?>">
                                    <input type="hidden" name="m_lead_id" id="m_lead_id" value="<?= $id; ?>">
                                    <select name="m_lead_clientid" id="m_lead_clientid" class="form-control select2">
                                        <option value="">Select client</option>
                                        <?php
                                        foreach ($leadclient_dtl as $value) {

                                            if ($clientid == $value->m_lclient_id) {
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
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pro/ Marketing Officer</label>
                                    <select name="m_lead_pro" id="m_lead_pro" class="form-control select2" required>
                                        <option value="">Select client</option>
                                        <?php
                                        foreach ($prolist as $value) {

                                            if ($lead_pro == $value->m_emp_id) {
                                                $option1 = "selected";
                                            } else {
                                                $option1 = "";
                                            }

                                        ?>
                                            <option value="<?php echo $value->m_emp_id; ?>" <?= $option1 ?>><?php echo $value->m_emp_name ?></option>
                                        <?php
                                        }

                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="m_lead_status" id="m_lead_status" class="form-control select2">
                                        <option value="">Select Status</option>
                                        <?php
                                        foreach ($leadstatus as $value) {

                                            if ($status == $value->m_leadst_id) {
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
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Dated</label>
                                    <input type="date" name="m_lead_date" id="m_lead_date" class="form-control" required="" value="<?= $date; ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Plan</label>
                                    <select name="m_lead_plan" id="m_lead_plan" required class="form-control select2">
                                        <option value="">Select Plan</option>
                                        <?php
                                        foreach ($planlist as $value) {

                                            if ($lplan == $value->m_hq_id) {
                                                $option1 = "selected";
                                            } else {
                                                $option1 = "";
                                            }

                                        ?>
                                            <option value="<?php echo $value->m_hq_id; ?>" data-rate="<?= $value->m_hq_rate ?>" <?= $option1 ?>><?php echo $value->m_hq_name ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Ratio</label>
                                    <input type="number" name="m_lead_ratio" id="m_lead_ratio" class="form-control" placeholder="18/1" value="<?= $lratio; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Min Visitors</label>
                                    <input type="number" name="m_lead_minvisits" id="m_lead_minvisits" class="form-control" required="" value="<?= $minvisits; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Rate Per Head</label>
                                    <input type="number" name="m_lead_rateph" id="m_lead_rateph" class="form-control" required="" value="<?= $rateph; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Free Locker</label>
                                    <input type="number" name="m_lead_flocker" id="m_lead_flocker" class="form-control" required="" value="<?= $flocker; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Free Costume</label>
                                    <input type="number" name="m_lead_fcostume" id="m_lead_fcostume" class="form-control" required="" value="<?= $fcostume; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Food Offer</label>
                                    <select name="m_lead_package" id="m_lead_package" class="form-control select2">
                                        <option value="">Select menu</option>
                                        <?php
                                        foreach ($packagelist as $value) {

                                            if ($lpackage == $value->m_hq_id) {
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
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Meeting With</label>
                                    <select name="m_lead_meetwith" id="m_lead_meetwith" class="form-control select2">
                                        <?php if (!empty($edit_value) || !empty($client_id)) {
                                            foreach ($client_dtl['Contact_persons'] as $key) {
                                                if ($key->lc_person_id == $meetwith) {
                                                    $op = 'selected';
                                                } else {
                                                    $op = '';
                                                }
                                                echo '<option value="' . $key->lc_person_id . '" ' . $op . ' >' . $key->lc_person_name . '</option>"';
                                            }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label id="followup_label">Next Followup Date</label>
                                    <input type="date" name="m_lead_followup" id="m_lead_followup" class="form-control" required="" value="<?= $followup; ?>">
                                </div>
                            </div>
                            <div class="col-md-3 <?php if ($status != 12) echo 'd-none'; ?> finalstaus">
                                <div class="form-group">
                                    <label>Advance Recieved By</label>
                                    <select name="m_lead_advanceto" id="m_lead_advanceto" class="form-control select2">
                                        <option value="">Select Employee</option>
                                        <?php
                                        if(!empty($prolist)){
                                        foreach ($prolist as $value) {

                                            if ($advanceto == $value->m_emp_id) {
                                                $option1 = "selected";
                                            } else {
                                                $option1 = "";
                                            }

                                        ?>
                                            <option value="<?php echo $value->m_emp_id; ?>" <?= $option1 ?>><?php echo $value->m_emp_name ?></option>
                                        <?php
                                        }
                                    }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 <?php if ($status != 12) echo 'd-none'; ?> finalstaus">
                                <div class="form-group">
                                    <label>Advance Amount</label>
                                    <input type="text" name="m_lead_advance" id="m_lead_advance" class="form-control" value="<?= $advance; ?>">
                                </div>
                            </div>
                            <div class="col-md-3 <?php if ($status != 12) echo 'd-none'; ?> finalstaus">
                                <div class="form-group">
                                    <label>Advance Recieved Date</label>
                                    <input type="date" name="m_lead_advance_date" id="m_lead_advance_date" class="form-control" value="<?= $advance_date; ?>">
                                </div>
                            </div>

                            <div class="col-md-3 <?php if ($status != 12) echo 'd-none'; ?> finalstaus">
                                <div class="form-group">
                                    <label>Advance Paymode</label>
                                    <select name="m_lead_paymode" id="m_lead_paymode" class="form-control">
                                        <option value="1" <?php if ($paymode == 1) echo 'selected' ?>>Cash</option>
                                        <option value="2" <?php if ($paymode == 2) echo 'selected' ?>>Paytm</option>
                                        <option value="3" <?php if ($paymode == 3) echo 'selected' ?>>Phone Pay</option>
                                        <option value="4" <?php if ($paymode == 4) echo 'selected' ?>>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remark</label>
                                    <textarea type="text" name="m_lead_remark" id="m_lead_remark" class="form-control" value="<?= $remark; ?>"><?= $remark; ?></textarea>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discussion Summary</label>
                                    <textarea type="text" name="m_lead_summery" id="m_lead_summery" class="form-control" value="<?= $summery; ?>"><?= $summery; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-lead" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-layout-submit"><a href="<?php echo site_url('Marketing/lead_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
                <div class="col-md-3">
                    <div style="height: 40rem;overflow-y:scroll" id="clientdtlblock">
                        <?php if (!empty($edit_value) || !empty($client_id)) { ?>
                            <table class="table table-striped table-bordered" style="width:100%;">
                                <thead>
                                    <th>Title</th>
                                    <th>Description</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>LeadClientID</th>
                                        <td><?= $client_dtl['m_lclient_id'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>LeadSrc</th>
                                        <td><?= $client_dtl['m_lclient_src'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>LeadType</th>
                                        <td><?= $client_dtl['m_lclient_type'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>LeadName</th>
                                        <td><?= $client_dtl['m_lclient_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><?= $client_dtl['m_lclient_address'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Village</th>
                                        <td><?= $client_dtl['m_lclient_village'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td><?= $client_dtl['m_lclient_city'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Potential</th>
                                        <td><?= $client_dtl['m_lclient_potential'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Remarks</th>
                                        <td><?= $client_dtl['m_lclient_remark'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Created On</th>
                                        <td><?= $client_dtl['m_lclient_added_on'] ?></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <?php foreach ($client_dtl['Contact_persons'] as $key) {
                                        echo '<tr><th>ContactID</th><td>' . $key->lc_person_id . '</td></tr>
                                                    <tr><th>Person Name</th><td>' . $key->lc_person_name . '</td></tr>
                                                    <tr><th>Mobile No</th><td>' . $key->lc_person_mobileno . '</td></tr>
                                                    <tr><th>Email</th><td>' . $key->lc_person_email . '</td></tr>
                                                    <tr><th>Department</th><td>' . $key->lc_person_dept . '</td></tr>';
                                    } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-box">
            <div class="row">
                <div class="col-md-12" style=" margin-top:10px;width:100% ;height:250px; ">
                    <label>History</label>
                    <table id="leadhistory" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <th width="1%">Sn</th>
                            <th>Contact Person</th>
                            <th>MinVisitors</th>
                            <th>RatePerHead</th>
                            <th>FreeLocker</th>
                            <th>FreeCostume</th>
                            <th>Discussion</th>
                            <th>RestOffer</th>
                            <th>Next Followup</th>
                            <th>Lead Date</th>


                        </thead>
                        <tbody id="tableblock">
                            <?php if (!empty($history)) {
                                $cou = 0;
                                foreach ($history as $his) { ?>
                                    <tr>
                                        <td><?= ++$cou ?></td>
                                        <td><?= $his->meet_with ?></td>
                                        <td><?= $his->m_lead_minvisits ?></td>
                                        <td><?= $his->m_lead_rateph ?></td>
                                        <td><?= $his->m_lead_flocker ?></td>
                                        <td><?= $his->m_lead_fcostume ?></td>
                                        <td><?= $his->m_lead_summery ?></td>
                                        <td><?= $his->package_name ?></td>
                                        <td><?= $his->m_lead_followup ?></td>
                                        <td><?= $his->m_lead_date ?></td>
                                        <td><a href="<?= base_url('Marketing/lead_client_print/') . $his->m_lead_id ?>" target="blank" class="btn btn-success btn-vsm"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'Lead', 'Edit')) { ?>
                                                <a href="<?php echo base_url('Marketing/add_lead/2/') . $his->m_lead_id; ?>" class="btn btn-info btn-action" title="Add Followups" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                            <?php }
                                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'Lead', 'Delete')) { ?>
                                                <button class="btn btn-danger btn-action delete-lead" data-value="<?php echo $his->m_lead_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                            <?php     }
                            } ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- ========================/View=================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/sales_js'); ?>

<script>
    $('#m_lead_status').change(function() {
        var statusval = $(this).val();
        if (statusval == 12) {
            $('.finalstaus').removeClass('d-none');
            $('#followup_label').html('Booking Date');
        } else {
            $('.finalstaus').addClass('d-none');
            $('#followup_label').html('Next Followup Date');
        }
    })

    $('#m_lead_plan').change(function() {
        var planrate = $(this).find(":selected").data('rate');
        $('#m_lead_rateph').val(planrate);

    })
</script>