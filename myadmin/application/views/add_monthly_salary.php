<!-- =========================View==============Fix========== -->
<!-- ========================Header==============Fix========= -->
<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id');
$logged_user_type = $this->session->userdata('user_type');
?>

<style>
    #empdetailblock .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    #empdetailblock td,
    #empdetailblock th {
        padding: 2px !important;
    }
</style>
<!-- =======================/Header==============Fix========= -->
<!-- =========================View===============Fix========= -->
<!-- Right Side Content Start -->
<div class="page-content">
    <div class="container-fluid">
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-md-2">
                    <form action="<?= base_url('HrDept/add_monthly_salary') ?>" method="post">
                        <div class="form-group">
                            <select name="m_dept" id="m_seldept" class="form-control select2" onchange="this.form.submit();">
                                <option value="">All department</option>
                                <?php
                                if (!empty($dept_value)) {

                                    foreach ($dept_value as $dkey) {
                                        if ($m_dept == $dkey->m_dept_id) {
                                            $op = 'selected';
                                        } else {
                                            $op = '';
                                        }
                                ?>
                                        <option value="<?php echo $dkey->m_dept_id; ?>" <?= $op ?>><?php echo $dkey->m_dept_name; ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <div class="seipkon-breadcromb-right">
                        <a href="<?= base_url('HrDept/salary_history/2') ?>" class="btn btn-primary btn-vsm">View Final sheet</a>
                        <a href="<?= site_url('HrDept/salary_history/1') ?>" class="btn btn-info btn-vsm"> View Salary History </a>

                    </div>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-md-12" id="listSalInst">
                <div class="page-box">

                    <form action="" id="frm-add-salinst" method="post">

                        <div class="row">
                            <div class="col-md-3" style="margin-bottom: 10px;">
                                <div class="form-group">
                                    <label>Month</label>
                                    <?php $monthd = date('Y-m') . '- 1 month' ?>
                                    <input type="month" name="m_sallary_month" id="m_sallary_month" class="form-control" value="<?= date('Y-m', strtotime($monthd)) ?>" readonly>
                                    <input type="hidden" name="m_monthdays" id="m_monthdays" class="form-control"  value="<?= date('t', strtotime($monthd)) ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="salinst_tbl" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="2%">SN</th>
                                                <th>Emp Name</th>
                                                <th>Design</th>
                                                <th>Salary</th>
                                                <th>Per Day</th>
                                                <th width="5%">Present Days</th>
                                                <th width="5%">Extra days</th>
                                                <th width="6%">Extra Amt</th>
                                                <th width="5%">Absent days</th>
                                                <th width="6%">Absent Amt</th>
                                                <th width="5%">Time</th>
                                                <th width="6%">Time Amt</th>
                                                <th width="7%">Advance</th>
                                                <th width="7%">Final Amt</th>
                                                <!-- <th width="8%">Account</th> -->
                                                <th>Remarks</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            if (!empty($emp_list)) {
                                                foreach ($emp_list as $emps) {
                                                    $advance = $this->Hr_model->get_emp_advance($emps->m_emp_id, date('Y-m', strtotime($monthd)));

                                            ?>
                                                    <tr>
                                                        <td><?= $i; ?></td>
                                                        <td><?= $emps->m_emp_name; ?></td>
                                                        <td><?= $emps->m_design_name; ?></td>
                                                        <td>₹<?= $emps->m_emp_salary; ?>
                                                            <input type="hidden" name="m_emp_dept[]" id="m_emp_dept<?= $i ?>" data-count="<?= $i ?>" class="form-control m_emp_dept" value="<?= $emps->m_emp_dept; ?>">
                                                            <input type="hidden" name="m_sallary_empid[]" id="m_sallary_empid<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_empid" value="<?= $emps->m_emp_id; ?>">
                                                            <input type="hidden" name="m_sallary_amt[]" id="m_sallary_amt<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_amt" value="<?= $emps->m_emp_salary; ?>">
                                                            <input type="hidden" name="m_sallary_perday[]" id="m_sallary_perday<?= $i ?>" data-count="<?= $i ?>" class="form-control caldays m_sallary_perday">
                                                        </td>
                                                        <td id="m_perday<?= $i ?>"></td>
                                                        <td><input type="text" name="m_sallary_pstday[]" id="m_sallary_pstday<?= $i ?>" data-count="<?= $i ?>" class="form-control caldays m_sallary_pstday" required></td>
                                                        <td><input type="text" name="m_sallary_extday[]" id="m_sallary_extday<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_extday">
                                                            <input type="hidden" name="m_sallary_extamt[]" id="m_sallary_extamt<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_extamt">
                                                        </td>
                                                        <td id="m_extamt<?= $i ?>"></td>
                                                        <td><input type="text" name="m_sallary_abstday[]" id="m_sallary_abstday<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_abstday">
                                                            <input type="hidden" name="m_sallary_abstamt[]" id="m_sallary_abstamt<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_abstamt">
                                                        </td>
                                                        <td id="m_abstamt<?= $i ?>"></td>
                                                        <td><input type="text" name="m_sallary_time[]" id="m_sallary_time<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_time">
                                                            <input type="hidden" name="m_sallary_timeamt[]" id="m_sallary_timeamt<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_timeamt">
                                                            <input type="hidden" name="m_sallary_advance[]" id="m_sallary_advance<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_advance" value="<?= array_sum(array_column($advance, 'm_advance_amt')); ?>">
                                                            <input type="hidden" name="m_sallary_payamt[]" id="m_sallary_payamt<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_payamt">
                                                        </td>
                                                        <td id="m_timeamt<?= $i ?>"></td>
                                                        <td id="m_advance<?= $i ?>"> ₹<?= array_sum(array_column($advance, 'm_advance_amt')); ?></td>
                                                        <td id="m_payamt<?= $i ?>"></td>
                                                        <!-- <td><input type="text" name="m_sallary_account[]" id="m_sallary_account<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_account"></td> -->
                                                        <td><input type="text" name="m_sallary_remarks[]" id="m_sallary_remarks<?= $i ?>" data-count="<?= $i ?>" class="form-control m_sallary_remarks"></td>


                                                        <!-- <td title="Action" style="white-space: nowrap;">
                                                <?php // if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT', 'Edit')) { 
                                                ?>
                                                    <a href="<?php // echo $edit_link; 
                                                                ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                <?php //}
                                                    // if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT', 'Delete')) { 
                                                ?>
                                                    <button class="btn btn-danger btn-action delete-salinst" data-value="<?php // echo $value->m_salinst_id; 
                                                                                                                            ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                                <?php //} 
                                                ?>
                                            </td> -->
                                                    </tr>
                                            <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>

                                            <th colspan="3">Total</th>
                                            <th id="m_salamt"></th>
                                            <th id="m_salperday"></th>
                                            <th id="m_salpstday"></th>
                                            <th id="m_salextday"></th>
                                            <th id="m_salextamt"></th>
                                            <th id="m_salabstday"></th>
                                            <th id="m_salabstamt"></th>
                                            <th id="m_saltime"></th>
                                            <th id="m_saltimeamt"></th>
                                            <th id="m_saladvance"></th>
                                            <th id="m_salpayamt"></th>
                                            <th></th>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin-bottom: 10px; margin-top: 10px;">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-action btn-block" id="btn-add-salinst">Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
        <!-- End Advance Form Row -->
        <!-- ====================/Page Content======================= -->
        <!-- =========================View=================Fix======= -->
        <!-- End Widget Row -->
    </div>
</div>
<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer') ?>
<?php $this->view('js/js_hr') ?>
<?php $this->view('js/custom_js'); ?>
<!-- ========================Script========================== -->

<script>
    $(document).ready(function(e) {
        caltotals();
        perDayCalFun();

        $('.caldays').on('keyup', function() {
            let uid = $(this).data('count');

            if ($(this).val() < 0) {

                swal(`Invaild Number ! please Enter Vaild Days Count`, {
                    icon: "error",
                    timer: 2000,
                });
                $('#m_sallary_pstday' + uid).val(0).trigger('keyup');
                return false;

            }

            salCalFun(uid)
            caltotals()
        })

        $('.m_sallary_extday').on('keyup', function() {
            let uid = $(this).data('count');
            let exday = $(this).val();
            let monthdays = parseInt($('#m_monthdays').val());
            let salry_amt = parseFloat($('#m_sallary_amt' + uid).val());
            let advance_amt = parseFloat($('#m_sallary_advance' + uid).val());
            let salry_perday = parseFloat($('#m_sallary_perday' + uid).val());
            let m_emp_dept = parseFloat($('#m_emp_dept' + uid).val());
            let salry_abstday = parseFloat($('#m_sallary_abstday' + uid).val());
            let salry_time = parseFloat($('#m_sallary_time' + uid).val());
            let abstamt = parseFloat($('#m_sallary_abstamt' + uid).val());
            let timeamt = parseFloat($('#m_sallary_timeamt' + uid).val());

            if (m_emp_dept != 7) {
                if (exday > 3 || exday < 0) {
                    swal(`Extra Day Cannot be Greater then 3 and Less then 0`, {
                        icon: "error",
                        timer: 2000,
                    });
                    $('#m_sallary_extday' + uid).val(0).trigger('keyup');
                    return false;
                }
            }

            extamt = (salry_perday * exday);
            payamt = ((salry_amt - advance_amt - abstamt) + extamt);

            assignValueFun(uid, exday, salry_abstday, salry_time, extamt, abstamt, timeamt, payamt);

            caltotals()

        })

        $('.m_sallary_abstday').on('keyup', function() {
            let uid = $(this).data('count');
            let absday = $(this).val();
            let monthdays = parseInt($('#m_monthdays').val());
            let salry_amt = parseFloat($('#m_sallary_amt' + uid).val());
            let advance_amt = parseFloat($('#m_sallary_advance' + uid).val());
            let salry_perday = parseFloat($('#m_sallary_perday' + uid).val());
            let m_emp_dept = parseFloat($('#m_emp_dept' + uid).val());
            let salry_extday = parseFloat($('#m_sallary_extday' + uid).val());
            let salry_time = parseFloat($('#m_sallary_time' + uid).val());
            let extamt = parseFloat($('#m_sallary_extamt' + uid).val());
            let timeamt = parseFloat($('#m_sallary_timeamt' + uid).val());

                if (absday < 0 || absday > monthdays) {
                    swal(`Extra Day Cannot be Less then 0 and More then ${monthdays}`, {
                        icon: "error",
                        timer: 2000,
                    });
                    $('#m_sallary_abstday' + uid).val(0).trigger('keyup');
                    return false;
                }
         

            abstamt = (salry_perday * absday);
            payamt = ((salry_amt - advance_amt - abstamt) + extamt);

            assignValueFun(uid, salry_extday, absday, salry_time, extamt, abstamt, timeamt, payamt);

            caltotals()

        })


    });

    function salCalFun(uid) {
        let monthdays = parseInt($('#m_monthdays').val());
        let salry_amt = parseFloat($('#m_sallary_amt' + uid).val());
        let advance_amt = parseFloat($('#m_sallary_advance' + uid).val());
        let salry_perday = parseFloat($('#m_sallary_perday' + uid).val());
        let salry_pstday = parseFloat($('#m_sallary_pstday' + uid).val());


        // let salry_extday = parseFloat($('#m_sallary_extday' + uid).val());
        // let salry_abstday = parseFloat($('#m_sallary_abstday' + uid).val());
        // let salry_time = parseFloat($('#m_sallary_time' + uid).val());
        // alert(salry_extday)

        let extday = 0;
        let abstday = 0;
        let time = 0;
        let extamt = 0;
        let abstamt = 0;
        let timeamt = 0;
        let payamt = 0;


        if (salry_pstday > monthdays) {
            swal(`Present Days Should equal or Less Then ${monthdays}`, {
                icon: "error",
                timer: 2000,
            });
            $('#m_sallary_pstday' + uid).val(0).trigger('keyup');
            return false;
        }

        if (salry_pstday >= (monthdays - 3)) {

            extday = Math.abs((monthdays - 3) - salry_pstday);
            abstday = 0;
            time = 0;
            extamt = (salry_perday * extday);
            abstamt = 0;
            timeamt = 0;
            payamt = ((salry_amt - advance_amt) + extamt);

        } else if (salry_pstday >= (monthdays - 6)) {

            extday = 0;
            abstday = ((monthdays - 3) - salry_pstday);
            time = 0;
            extamt = 0;
            abstamt = (salry_perday * ((monthdays - 3) - salry_pstday));
            timeamt = 0;
            payamt = ((salry_amt - advance_amt) - abstamt);

        } else if (salry_pstday < (monthdays - 6)) {

            extday = 0;
            abstday = (monthdays - salry_pstday);
            time = 0;
            extamt = 0;
            abstamt = (salry_perday * (monthdays - salry_pstday));
            timeamt = 0;
            payamt = ((salry_pstday * salry_perday) - advance_amt);

        }


        assignValueFun(uid, extday, abstday, time, extamt, abstamt, timeamt, payamt);
    }


    function assignValueFun(uid, extday, abstday, time, extamt, abstamt, timeamt, payamt) {
        $('#m_sallary_extday' + uid).val(extday)
        $('#m_sallary_abstday' + uid).val(abstday)
        $('#m_sallary_time' + uid).val(time)
        $('#m_sallary_extamt' + uid).val(extamt.toFixed(2))
        $('#m_sallary_abstamt' + uid).val(abstamt.toFixed(2))
        $('#m_sallary_timeamt' + uid).val(timeamt.toFixed(2))
        $('#m_sallary_payamt' + uid).val((Math.round(payamt / 10) * 10))
        $('#m_extamt' + uid).text('₹' + extamt.toFixed(2))
        $('#m_abstamt' + uid).text('₹' + abstamt.toFixed(2))
        $('#m_timeamt' + uid).text('₹' + timeamt.toFixed(2))
        $('#m_payamt' + uid).text('₹' + (Math.round(payamt / 10) * 10))
    }

    function perDayCalFun() {
        let monthdays = parseInt($('#m_monthdays').val());
        let = sum_perday = 0;
        let = sum_amt = 0;
        $('.m_sallary_amt').each(function(index) {
            let uid = $(this).data('count');
            // alert(uid);
            let salamt = parseFloat($(this).val());
            let perDaySal = salamt / monthdays;
            sum_amt += parseFloat(salamt)
            sum_perday += parseFloat(perDaySal)

            $('#m_sallary_perday' + uid).val(perDaySal.toFixed(2));
            $('#m_perday' + uid).text('₹' + perDaySal.toFixed(2));
        });
        $('#m_salamt').text('₹' + sum_amt);
        $('#m_salperday').text('₹' + sum_perday.toFixed(2));

    }

    function caltotals() {



        let = sum_pstday = 0;
        let = sum_extday = 0;
        let = sum_extamt = 0;
        let = sum_abstday = 0;
        let = sum_abstamt = 0;
        let = sum_time = 0;
        let = sum_timeamt = 0;
        let = sum_advance = 0;
        let = sum_payamt = 0;


        $('.m_sallary_pstday').each(function() {
            sum_pstday += parseFloat($(this).val() || 0)
        });
        $('.m_sallary_extday').each(function() {
            sum_extday += parseFloat($(this).val() || 0)
        });
        $('.m_sallary_extamt').each(function() {
            sum_extamt += parseFloat($(this).val() || 0)
        });
        $('.m_sallary_abstday').each(function() {
            sum_abstday += parseFloat($(this).val() || 0)
        });
        $('.m_sallary_abstamt').each(function() {
            sum_abstamt += parseFloat($(this).val() || 0)
        });
        $('.m_sallary_time').each(function() {
            sum_time += parseFloat($(this).val() || 0)
        });
        $('.m_sallary_timeamt').each(function() {
            sum_timeamt += parseFloat($(this).val() || 0)
        });
        $('.m_sallary_advance').each(function() {
            sum_advance += parseFloat($(this).val() || 0)
        });
        $('.m_sallary_payamt').each(function() {
            sum_payamt += parseFloat($(this).val() || 0)
        });



        $('#m_salpstday').text(sum_pstday);
        $('#m_salextday').text(sum_extday);
        $('#m_salextamt').text('₹' + sum_extamt);
        $('#m_salabstday').text(sum_abstday);
        $('#m_salabstamt').text('₹' + sum_abstamt);
        $('#m_saltime').text(sum_time);
        $('#m_saltimeamt').text('₹' + sum_timeamt);
        $('#m_saladvance').text('₹' + sum_advance);
        $('#m_salpayamt').text('₹' + sum_payamt);


    }
</script>