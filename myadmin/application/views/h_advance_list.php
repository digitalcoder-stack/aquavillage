<!-- =========================View==============Fix========== -->
<!-- ========================Header==============Fix========= -->
<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id') ; $logged_user_type = $this->session->userdata('user_type') ;
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
        <?php if ($pagetype == 2) { ?>
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-8  col-sm-8">
                        <div class="seipkon-breadcromb-left">
                            <h3><?php echo $pagename; ?></h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="seipkon-breadcromb-right">
                            <a href="<?= site_url('HrDept/advance_list/1') ?>" class="btn btn-info btn-vsm">Advance List </a>

                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>

            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="seipkon-breadcromb-left">
                            <h3><?php echo $pagename; ?></h3>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'ADV', 'Filter')) { ?>
                            <form method="post" action="<?php echo site_url('HrDept/advance_list/1') ?>">
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
                                        <label>Employee</label>
                                        <select name="empsrch" class="form-control select2">
                                            <option value="">All Employee</option>
                                            <?php
                                            if (!empty($emp_list)) {
                                                foreach ($emp_list as $emp) {
                                                    if ($empid == $emp->m_emp_id) {
                                                        $op = 'selected';
                                                    } else {
                                                        $op = '';
                                                    }

                                            ?>
                                                    <option value="<?php echo $emp->m_emp_id; ?>" <?= $op ?>><?php echo $emp->m_emp_name . '-' . $emp->m_emp_mobile; ?></option>
                                            <?php
                                                }
                                            }

                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Month</label>
                                        <input class="form-control" type="month" placeholder="Month" name="monthsrch" id="monthsrch" value="<?php echo $monthsrch; ?>">
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button class="btn btn-info btn-vsm" type="submit" title="Click To Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            <a href="<?php echo site_url('HrDept/advance_list/1') ?>"><button class="btn btn-primary btn-vsm" type="button" title="Click To Reset"><i class="fa fa-refresh" aria-hidden="true"></i></button></a>
                                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'ADV', 'Export')) { ?>
                                                <button class="btn btn-success btn-vsm" type="submit" name="Excel" value="2" title="Export Excel File"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
                                            <?php } ?>
                                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'ADV', 'Add')) { ?>
                                                <a href="<?= site_url('HrDept/advance_list/2') ?>" class="btn btn-info btn-vsm" style="margin-top: 5px;">Add Advance</a>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        <?php } ?>
                    </div>

                </div>
            </div>

        <?php } ?>

        <div class="row">

            <div class="col-md-12" id="listadvance" style="<?php if ($pagetype == 2) {
                                                                echo 'display:none;';
                                                            } else {
                                                                echo 'display:block;';
                                                            } ?>">
                <div class="page-box">
                    <div class="advance-table">
                        <table id="advance_tbl" class="my_custom_datatable table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">SN</th>
                                    <th>Date</th>
                                    <th>Emp Name</th>
                                    <th>Emp MObile</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $sum_amt = 0;
                                if (!empty($all_value)) {
                                    foreach ($all_value as $value) {
                                        $edit_link = base_url('HrDept/advance_list/2?id=') . $value->m_advance_id;
                                        $sum_amt += $value->m_advance_amt;
                                ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($value->m_advance_date)); ?></td>
                                            <td><?php echo $value->m_emp_name; ?></td>
                                            <td><?php echo $value->m_emp_mobile; ?></td>
                                            <td><?php echo date('F', strtotime($value->m_advance_month)); ?></td>
                                            <td><?php echo $value->m_advance_amt; ?></td>
                                            <td><?php echo $value->m_advance_remarks; ?></td>


                                            <td title="Action" style="white-space: nowrap;">
                                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'ADV', 'Edit')) { ?>
                                                    <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                <?php }
                                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'ADV', 'Delete')) { ?>
                                                    <button class="btn btn-danger btn-action delete-advance" data-value="<?php echo $value->m_advance_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <th colspan="5"> Total</th>
                                <th><?=  $sum_amt ?></th>
                                <th ></th>
                                <th ></th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12" id="addadvance" style=" <?php if ($pagetype == 2) {
                                                                echo 'display:block;';
                                                            } else {
                                                                echo 'display:none;';
                                                            } ?>">
                <div class="page-box">

                    <div class="form-example">
                        <div class="form-wrap top-label-exapmple form-layout-page">
                            <form method="post" action="#" id="frm-add-advance">

                                <?php if (!empty($edit_value)) {
                                    $id = $edit_value->m_advance_id;
                                    $accts = $edit_value->m_advance_acct;
                                    $empid = $edit_value->m_advance_empid;
                                    $month = $edit_value->m_advance_month;
                                    $year = $edit_value->m_advance_date;
                                    $amt = $edit_value->m_advance_amt;
                                    $remarks = $edit_value->m_advance_remarks;
                                } else {
                                    $id = '';
                                    $accts = 2;
                                    $empid = '';
                                    $month = date('Y-m');
                                    $year =  date('Y-m-d');;
                                    $amt = '';
                                    $remarks = '';
                                } ?>

                                <div class="row">

                                    <div class="col-md-12" id="empdetailblock">
                                        <?php if ($id) { ?>
                                            <h4>Employee Details</h4>
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    <th>EmployeeCode</th>
                                                    <td><?= $edit_value->m_emp_code ?></td>
                                                    <th>EmployeeName</th>
                                                    <td><?= $edit_value->m_emp_name ?></td>
                                                    <th>Mobile</th>
                                                    <td><?= $edit_value->m_emp_mobile ?></td>
                                                    <th>Alt Mobile</th>
                                                    <td><?= $edit_value->m_emp_altmobile ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Company</th>
                                                    <td><?= $edit_value->m_company_name ?></td>
                                                    <th>Designation</th>
                                                    <td><?= $edit_value->m_design_name ?></td>
                                                    <th>Department</th>
                                                    <td><?= $edit_value->m_dept_name ?></td>
                                                    <th>DateOfBirth</th>
                                                    <td><?= $edit_value->m_emp_dob ?></td>
                                                </tr>
                                                <tr>
                                                    <th>DateOfJoining</th>
                                                    <td><?= $edit_value->m_emp_doj ?></td>
                                                    <th>Salary Mode</th>
                                                    <td><?= $edit_value->m_emp_salmode == 1 ? 'Cash' : 'Bank Account' ?></td>
                                                    <th>Max Advance Amount</th>
                                                    <td id="maxadvamt"><?= ($edit_value->m_emp_gross_salary * 0.2) ?></td>
                                                </tr>
                                            </table>


                                        <?php } ?>
                                    </div>

                                    <div class="col-md-12" id="emphistoryblock">
                                        <?php if ($id) { ?>
                                            <h4>Advance History Of this month</h4>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <th>SNo</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Remark</th>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        <?php } ?>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Month<span class="text-danger">*</span></label>
                                                    <input type="month" name="m_advance_month" id="m_advance_month" class="form-control" value="<?= $month ?>" >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date <span class="text-danger">*</span></label>
                                                    <input type="date" name="m_advance_date" id="m_advance_date" class="form-control" value="<?= $year ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Account <span class="text-danger">*</span></label>
                                                    <select name="m_advance_acct" id="m_advance_acct" disabled class="form-control">
                                                        <?php if (!empty($account_list)) {
                                                            foreach ($account_list as $key => $value) {
                                                                if ($accts == $value->m_cashacc_id) {
                                                                    $op = 'selected';
                                                                } else {
                                                                    $op = '';
                                                                }
                                                                echo '<option value="' . $value->m_cashacc_id . '" ' . $op . '>' . $value->m_cashacc_name . '</option>';
                                                            }
                                                        } ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="hidden" name="m_advance_id" id="m_advance_id" value="<?= $id ?>">
                                                    <label>Employee Id<span class="text-danger">*</span></label>
                                                    <select name="m_advance_empid" id="m_advance_empid" class="form-control select2" title="Select Employee" style="width: 100%;">
                                                        <option value="">Choose Employee</option>
                                                        <?php
                                                        if (!empty($emp_list)) {
                                                            foreach ($emp_list as $emp) {
                                                                if ($empid == $emp->m_emp_id) {
                                                                    $op = 'selected';
                                                                } else {
                                                                    $op = '';
                                                                }

                                                        ?>
                                                                <option value="<?php echo $emp->m_emp_id; ?>" <?= $op ?>><?php echo $emp->m_emp_name . '-' . $emp->m_emp_mobile; ?></option>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Amount <span class="text-danger">*</span></label>
                                                    <input type="number" name="m_advance_amt" id="m_advance_amt" class="form-control" value="<?= $amt ?>">
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Remark <span class="text-danger">*</span></label>
                                            <textarea name="m_advance_remarks" id="m_advance_remarks" class="form-control"><?= $remarks ?></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-layout-submit">
                                <button type="submit" id="btn-add-advance" class="btn btn-block btn-info">Submit</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-layout-submit">
                                <a href="<?php echo site_url('HrDept/advance_list') ?>" class="btn btn-block btn-danger">Cancel </a>

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
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