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

            .modal-dialog {
                width: 90% !important;
                margin: 30px auto;
            }

            .card {
                box-shadow: 1px 1px 10px -2px #b0b8d6 !important;
                padding: 10px;
            }

            .text-end {
                text-align: end;
            }

            .pd-5 {
                padding: 4px;
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
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'PL', 'Filter')) { ?>
                        <form method="post" action="<?php echo site_url('Shop/plot_list') ?>">
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
                                        <a href="<?php echo site_url('Shop/plot_list') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'PL', 'Export')) { ?>
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
                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'PL', 'Add')) { ?>
                            <a href="<?php echo site_url('Shop/add_plot') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New plot</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-box">
            <div class="advance-table table-overflow">
                <table id="plot_tbl" class="my_custom_datatable table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>PlotNo</th>
                            <th>RegistryName</th>
                            <th>City</th>
                            <th>Mobile No.</th>
                            <th>MemberCount</th>
                            <th>Reg Paper Rcvd</th>
                            <th>Aadhar Rcvd</th>
                            <th>Aadhar No</th>
                            <th>Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($plot_value)) {
                            foreach ($plot_value as $value) {
                                $memcount = $this->db->where('p_member_plotid', $value->m_plot_id)->get('plot_member_tbl')->num_rows();
                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->m_plot_no; ?></td>
                                    <td><?php echo $value->m_plot_name; ?></td>
                                    <td><?php echo $value->m_city_name; ?></td>
                                    <td><?php echo $value->m_plot_mobile; ?></td>
                                    <td><?= $memcount; ?></td>
                                    <td><?= $value->reg_paper_rcvd == 1 ? 'Yes' : 'No '; ?></td>
                                    <td><?= $value->is_adhar_rcvd == 1 ? 'Yes' : 'No '; ?></td>
                                    <td><?php echo $value->m_plot_aadhar_no; ?></td>
                                    <td><?php echo $value->m_plot_remark; ?></td>
                                    <td class="wd-30">

                                        <button type="button" class="btn btn-primary btn-action" data-toggle="modal" data-target="#viewModal<?php echo $value->m_plot_id; ?>" title="View"><i class="fa fa-eye"></i></button>
                                        <!-- view Modal start -->
                                        <div class="modal fade" id="viewModal<?php echo $value->m_plot_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <h4 class="modal-title"> Plot Details (<?php echo $value->m_plot_no; ?>)</h4>
                                                            </div>
                                                            <div class="col-md-2" style="text-align: end;">
                                                                <button type="button" class="btn-close btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body" style="word-break: break-all">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="card p-3">
                                                                    <div class="row " style="margin: 0px;">
                                                                        <div class="col-md-6 pd-5">
                                                                            Name : <b><?php echo $value->m_plot_name; ?></b>
                                                                        </div>
                                                                        <div class="col-md-6 pd-5 text-end">
                                                                            Father Name : <b><?php echo $value->m_plot_fname; ?></b>
                                                                        </div>
                                                                        <div class="col-md-6 pd-5 ">
                                                                            Contact No : <b><?php echo $value->m_plot_mobile; ?>,<?php echo $value->m_plot_whatsappNo; ?></b>
                                                                        </div>

                                                                        <div class="col-md-6 pd-5 text-end">
                                                                            Email : <b><?php echo $value->m_plot_email; ?></b>
                                                                        </div>
                                                                        <div class="col-md-6 pd-5">
                                                                            City : <b><?php echo $value->m_city_name ?></b> pin- <b><?= $value->m_plot_pincode ?></b>
                                                                        </div>
                                                                        <div class="col-md-6 pd-5 text-end">
                                                                            Aadhar No : <b><?php echo $value->m_plot_aadhar_no; ?></b>
                                                                        </div>

                                                                        <div class="col-md-12 pd-5">
                                                                            Address : <b><?php echo $value->m_plot_address; ?></b>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="card p-3">
                                                                    <div class="row " style="margin: 0px;">
                                                                        <div class="col-md-6 pd-5">
                                                                            Plot Type : <b><?php echo $value->m_plot_type; ?></b>
                                                                        </div>

                                                                        <div class="col-md-6 pd-5 text-end">
                                                                            Plot Number : <b><?php echo $value->m_plot_no; ?></b>
                                                                        </div>
                                                                        <!-- <div class="col-md-6 pd-5">
                                                                            Added on : <b><?php echo date('d-m-Y H:i', strtotime($value->m_plot_added_on)); ?></b>
                                                                        </div> -->
                                                                        <!-- <div class="col-md-6 pd-5 text-end">
                                                                            Added By: <b><?php if ($value->m_sale_added_by == 0) {
                                                                                                echo $value->m_plot_name;
                                                                                            } else {
                                                                                                echo $value->added_by;
                                                                                            }
                                                                                            ?></b>
                                                                        </div> -->
                                                                        <div class="col-md-6 pd-5 ">
                                                                            Emergency Name : <b><?php echo $value->m_plot_emname; ?></b>
                                                                        </div>
                                                                        <div class="col-md-6 pd-5 text-end">
                                                                            Emergency Contact : <b><?php echo $value->m_plot_emcontact_no; ?></b>
                                                                        </div>


                                                                        <div class="col-md-6 pd-5 ">
                                                                            Relation : <b><?php echo $value->m_plot_emrelation; ?></b>
                                                                        </div>
                                                                        <div class="col-md-6 pd-5 text-end">
                                                                            Registry Docs : <?php echo $value->m_plot_registry == '' ? 'NO' : ' <a href="' . base_url('uploads/plots/') . $value->m_plot_registry . '" target="_blank" class="btn btn-primary btn-action">View Registry</a>'; ?><?php echo $value->m_plot_docs == '' ? ',NO' : ' <a href="' . base_url('uploads/plots/') . $value->m_plot_docs . '" target="_blank" class="btn btn-info btn-action">View Docs</a>'; ?>
                                                                        </div>
                                                                        <div class="col-md-12 pd-5">
                                                                            Remark : <b><?php echo $value->m_plot_remark; ?></b>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                            <div class="col-md-12">
                                                                <label>List of Sponsered Members</label>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered">
                                                                        <thead>
                                                                            <th width="4%">Sn</th>
                                                                            <th>Member Name </th>
                                                                            <th>Aadhar No </th>
                                                                            <th>Mobile </th>
                                                                            <th>Whatsapp </th>
                                                                            <th>Attach Photo</th>
                                                                            <th>Attach Docs</th>
                                                                            <th>Action</th>
                                                                        </thead>
                                                                        <tbody id="modal_body_contant">

                                                                            <?php
                                                                            $member_list =  $this->db->select('*')->where('p_member_plotid', $value->m_plot_id)->get('plot_member_tbl')->result();
                                                                            if (!empty($member_list)) {
                                                                                foreach ($member_list as $cua => $key) {
                                                                                    $member_img = $key->p_member_image == '' ? '' : ' <a href="' . base_url('uploads/capure_images/') . $key->p_member_image . '" target="_blank" class="btn btn-info btn-action">View File</a>';
                                                                                    $member_docs = $key->p_member_docs == '' ? '' : ' <a href="' . base_url('uploads/plots/') . $key->p_member_docs . '" target="_blank" class="btn btn-info btn-action">View File</a>';
                                                                            ?><tr>
                                                                                        <td><?= ($cua + 1) ?></td>
                                                                                        <td><?= $key->p_member_name ?> </td>
                                                                                        <td><?= $key->p_member_adharno ?></td>
                                                                                        <td><?= $key->p_member_mobileno ?></td>
                                                                                        <td><?= $key->p_member_whatapp ?></td>
                                                                                        <td> <?= $member_img ?></td>
                                                                                        <td><?= $member_docs ?></td>
                                                                                        <td><button type="button" class="btn btn-danger" onclick="open_cancel_modal(`<?= $key->p_member_id ?>`,`<?php echo $value->m_plot_no; ?>`,`<?= $key->p_member_name ?>`,`<?= $key->m_cancel_docs ?>`,`<?= $key->m_cancel_reason ?>`,`Shop/plot_membership_cancel`)" title="Click to Cancel Membership"><?= $key->p_member_status == 1 ? 'Cancel':'Canceled' ?></button></td>
                                                                                       
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
                                            </div>
                                        </div>
                                        <!-- view modal end -->
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'PL', 'Edit')) { ?>
                                            <a href="<?php echo base_url('Shop/add_plot?id=') . $value->m_plot_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                        <?php }
                                        if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'PL', 'Delete')) { ?>
                                            <button class="btn btn-danger btn-action delete-plot" data-value="<?php echo $value->m_plot_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
$this->view('js/js_vendor');
$this->view('js/custom_js'); ?>