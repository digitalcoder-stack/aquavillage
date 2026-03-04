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
        <!-- Breadcromb Row Start -->
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT', 'Filter')) { ?>
                        <form method="post" action="<?php echo base_url('HrDept/salary_history/' . $pagetype) ?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-check-label">From</label>
                                    <input class="form-check-input" type="month" placeholder="From Month" name="month_from" id="month_from" value="<?php echo $month_from; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-check-label">To</label>
                                    <input class="form-check-input" type="month" placeholder="To Month" name="month_to" id="month_to" value="<?php echo $month_to; ?>">
                                </div>

                                <div class="col-md-3">
                                    <input class="form-control" type="text" placeholder="Search name ,mobile , code..." name="seach_in" id="seach_in" value="<?php echo $seach_in; ?>">
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">Search</button>
                                        <a href="<?php echo base_url('HrDept/salary_history/' . $pagetype) ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT', 'Export')) { ?>
                                            <button class="btn btn-success" type="submit" name="Excel" value="2">Excel Export</button>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </form>
                    <?php } ?>
                </div>
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-right">
                        <?php if ($pagetype == 2) {
                            echo ' <a href="' . base_url('HrDept/salary_history/1') . '" class="btn btn-primary btn-vsm">Salary history</a>';
                        } else {
                            echo ' <a href="' . base_url('HrDept/salary_history/2') . '" class="btn btn-primary btn-vsm">Final sheet</a>';
                        } ?>

                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT', 'Add')) { ?>
                            <a href="<?php echo base_url('HrDept/add_monthly_salary') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add Salary</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-box">
            <div class="advance-table table-overflow">
                <?php if ($pagetype == 1) { ?>
                    <table id="salhstry_tbl" class="dash_datatable table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="2%">SN</th>
                                <th>Emp Name</th>
                                <th>Design Name</th>
                                <th>Month</th>
                                <th>Salary</th>
                                <th>Per Day</th>
                                <th>Present Days</th>
                                <th>Extra days</th>
                                <th>Extra Amt</th>
                                <th>Absent days</th>
                                <th>Absent Amt</th>
                                <th>Time</th>
                                <th>Time Amt</th>
                                <th>Advance</th>
                                <th>Final Amt</th>
                                <th>Remarks</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $sum_amt = 0;
                            $sum_extamt = 0;
                            $sum_abstamt = 0;
                            $sum_timeamt = 0;
                            $sum_advance = 0;
                            $sum_payamt = 0;
                            $sum_perday = 0;
                            $sum_pstday = 0;
                            $sum_extday = 0;
                            $sum_abstday = 0;
                            $sum_time = 0;
                            if (!empty($all_value)) {
                                foreach ($all_value as $value) {
                                    $sum_amt += $value->m_sallary_amt;
                                    $sum_extamt += $value->m_sallary_extamt;
                                    $sum_abstamt += $value->m_sallary_abstamt;
                                    $sum_timeamt += $value->m_sallary_timeamt;
                                    $sum_advance += $value->m_sallary_advance;
                                    $sum_payamt += $value->m_sallary_payamt;
                                    $sum_perday += $value->m_sallary_perday;
                                    $sum_pstday += $value->m_sallary_pstday;
                                    $sum_extday += $value->m_sallary_extday;
                                    $sum_abstday += $value->m_sallary_abstday;
                                    $sum_time += $value->m_sallary_time;
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?= $value->m_emp_name ?></td>
                                        <td><?= $value->m_design_name ?></td>
                                        <td><?= date('M-y', strtotime($value->m_sallary_month)) ?></td>
                                        <td><?= $value->m_sallary_amt ?></td>
                                        <td><?= $value->m_sallary_perday ?></td>
                                        <td><?= $value->m_sallary_pstday ?></td>
                                        <td><?= $value->m_sallary_extday ?></td>
                                        <td><?= $value->m_sallary_extamt ?></td>
                                        <td><?= $value->m_sallary_abstday ?></td>
                                        <td><?= $value->m_sallary_abstamt ?></td>
                                        <td><?= $value->m_sallary_time ?></td>
                                        <td><?= $value->m_sallary_timeamt ?></td>
                                        <td><?= $value->m_sallary_advance ?></td>
                                        <td><?= $value->m_sallary_payamt ?></td>
                                        <td><?= $value->m_sallary_remarks ?></td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <th colspan="4"> Total </th>
                            <th><?= $sum_amt ?></th>
                            <th><?= $sum_perday ?></th>
                            <th><?= $sum_pstday ?></th>
                            <th><?= $sum_extday ?></th>
                            <th><?= $sum_extamt ?></th>
                            <th><?= $sum_abstday ?></th>
                            <th><?= $sum_abstamt ?></th>
                            <th><?= $sum_time ?></th>
                            <th><?= $sum_timeamt ?></th>
                            <th><?= $sum_advance ?></th>
                            <th><?= $sum_payamt ?></th>
                            <th></th>
                        </tfoot>
                    </table>
                <?php } else if ($pagetype == 2) { ?>
                    <table id="salhstry_tbl2" class="dash_datatable table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="2%">SN</th>
                                <th>Emp Name</th>
                                <th>Account No</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $sum_finalamt = 0;

                            if (!empty($all_value)) {
                                foreach ($all_value as $value) {
                                    $sum_finalamt += $value->finalamt;

                            ?>
                                    <tr onclick="viewsalarysheetmodal(`<?= $value->m_emp_id ?>`)">
                                        <td><?php echo $i; ?></td>
                                        <td><?= $value->m_emp_name ?></td>
                                        <td><?= $value->m_emp_accno ?></td>
                                        <td><?= $value->finalamt ?></td>

                                    </tr>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <th colspan="3"> Total </th>
                            <th><?= $sum_finalamt ?></th>

                        </tfoot>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
<!-- ========================/View=================Fix======= -->

<!-- view Modal start -->
<div class="modal fade  modal-xl" id="modalsheetdetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 95%;">
        <div class="modal-content">

            <div class="modal-header">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="modal-title">Salary Sheet Detail</h4>
                    </div>
                    <div class="col-md-2" style="text-align: end;">
                        <button type="button" class="btn-close btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="word-break: break-all">

                <table id="salhstry_tbl" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="2%">SN</th>
                            <th>Emp Name</th>
                            <th>Design Name</th>
                            <th>Month</th>
                            <th>Salary</th>
                            <th>Per Day</th>
                            <th>Present Days</th>
                            <th>Extra days</th>
                            <th>Extra Amt</th>
                            <th>Absent days</th>
                            <th>Absent Amt</th>
                            <th>Time</th>
                            <th>Time Amt</th>
                            <th>Advance</th>
                            <th>Final Amt</th>
                            <th>Remarks</th>

                        </tr>
                    </thead>
                    <tbody id="modaltablebody">

                    </tbody>
                    <tfoot id="modaltablefoot">

                    </tfoot>
                </table>

            </div>

        </div>
    </div>
</div>
<!-- view modal end -->


<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/js_hr');
$this->view('js/custom_js'); ?>


<script>
    function viewsalarysheetmodal(leadactId) {

        let month_from = $('#month_from').val();
        let month_to = $('#month_to').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('HrDept/get_ledact_detail'); ?>",
            data: {
                leadactId,
                month_from,
                month_to
            },
            dataType: "JSON",
            success: function(data) {
                if (data != '') {

                    let tabbody = '';
                    let = sum_amt = 0;
                    let = sum_extamt = 0;
                    let = sum_abstamt = 0;
                    let = sum_timeamt = 0;
                    let = sum_advance = 0;
                    let = sum_payamt = 0;
                    let = sum_perday = 0;
                    let = sum_pstday = 0;
                    let = sum_extday = 0;
                    let = sum_abstday = 0;
                    let = sum_time = 0;
                    $.each(data, function(i, item) {

                        sum_amt += parseFloat(item.m_sallary_amt);
                        sum_extamt += parseFloat(item.m_sallary_extamt);
                        sum_abstamt += parseFloat(item.m_sallary_abstamt);
                        sum_timeamt += parseFloat(item.m_sallary_timeamt);
                        sum_advance += parseFloat(item.m_sallary_advance);
                        sum_payamt += parseFloat(item.m_sallary_payamt);
                        sum_perday += parseFloat(item.m_sallary_perday);
                        sum_pstday += parseFloat(item.m_sallary_pstday);
                        sum_extday += parseFloat(item.m_sallary_extday);
                        sum_abstday += parseFloat(item.m_sallary_abstday);
                        sum_time += parseFloat(item.m_sallary_time);

                        tabbody += `<tr>
                                    <td> ${(i+1)}</td> 
                                    <td> ${item.m_emp_name}</td> 
                                    <td> ${item.m_design_name}</td> 
                                    <td> ${item.m_sallary_month}</td> 
                                    <td> ${item.m_sallary_amt}</td> 
                                    <td> ${item.m_sallary_perday}</td> 
                                    <td> ${item.m_sallary_pstday}</td> 
                                    <td> ${item.m_sallary_extday}</td> 
                                    <td> ${item.m_sallary_extamt}</td> 
                                    <td> ${item.m_sallary_abstday}</td> 
                                    <td> ${item.m_sallary_abstamt}</td> 
                                    <td> ${item.m_sallary_time}</td> 
                                    <td> ${item.m_sallary_timeamt}</td> 
                                    <td> ${item.m_sallary_advance}</td> 
                                    <td> ${item.m_sallary_payamt}</td> 
                                    <td> ${item.m_sallary_remarks}</td> 
                                    </tr>`

                    });

                    $('#modaltablebody').html(tabbody);
                    $('#modaltablefoot').html(`
                    <th colspan = "4" > Total </th> 
                        <th> ${sum_amt}</th> 
                        <th> ${sum_perday}</th> 
                        <th> ${sum_pstday}</th> 
                        <th> ${sum_extday}</th> 
                        <th> ${sum_extamt}</th> 
                        <th> ${sum_abstday}</th> 
                        <th> ${sum_abstamt}</th> 
                        <th> ${sum_time}</th> 
                        <th> ${sum_timeamt}</th> 
                        <th> ${sum_advance}</th> 
                        <th> ${sum_payamt}</th> 
                        <th> </th>
                    `);
                    $('#modalsheetdetail').modal('show');
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
<!-- =======================/Footer================Fix=======