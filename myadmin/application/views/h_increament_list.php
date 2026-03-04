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

    #salsrtblock td,
    #salsrtblock th {
        padding: 2px !important;
    }

   
    .salsrtblock {
           width: 100%;
    margin-right: 20px;
    height: 260px;
    max-width: 100%;
    background-color: lightgray;
    }
     #salsrtblock {
        width: 500px !important;
        height: 230px !important;
        background-color: white;
        
    }
    
</style>
<!-- =======================/Header==============Fix========= -->
<!-- =========================View===============Fix========= -->
<!-- Right Side Content Start -->
<div class="page-content p-0" style="overflow-x: hidden;">
    <div class="container-fluid">
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-md-8  col-sm-8">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="seipkon-breadcromb-right">
                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT', 'Add')) { ?>
                            <?php if ($id) {
                                echo '<a href="' . site_url('HrDept/incrmt_list') . '" class="btn btn-info btn-vsm">Increaments List </a>';
                            } else {
                                echo '<Button class="btn btn-info btn-vsm" id="navigbtn1" value="1">Add New</Button>';
                            } ?>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">

            <div class="col-md-12" id="listincrmt" style="<?php if ($id) {
                                                                echo 'display:none;';
                                                            } else {
                                                                echo 'display:block;';
                                                            } ?>">
                <div class="page-box">
                    <div class="advance-table">
                        <table id="incrmt_tbl" class="my_custom_datatable table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">SN</th>
                                    <th>Created On</th>
                                    <th>Emp Code</th>
                                    <th>Emp Name</th>
                                    <th>IsArias</th>
                                    <th>OldGross</th>
                                    <th>IncrAmt</th>
                                    <th>NewGross</th>
                                    <th>EffFrom</th>
                                    <th>TotalArias</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($all_value)) {
                                    foreach ($all_value as $value) {
                                        $edit_link = site_url('HrDept/incrmt_list?id=') . $value->m_incrmt_id;
                                ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= date('d-m-Y', strtotime($value->m_incrmt_addedon)); ?></td>
                                            <td><?= $value->m_emp_code; ?></td>
                                            <td><?= $value->m_emp_name; ?></td>
                                            <td><?php if ($value->is_arias_from_month == 1) {
                                                    echo 'Yes';
                                                } else {
                                                    echo 'No';
                                                } ?></td>
                                            <td><?= $value->m_old_gross; ?></td>
                                            <td><?= $value->m_incrmt_amt; ?></td>
                                            <td><?= $value->m_new_gross; ?></td>
                                            <td><?= date('d-m-Y', strtotime($value->m_incrmt_strdate)); ?></td>
                                            <td></td>


                                            <td title="Action" style="white-space: nowrap;">
                                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT', 'Edit')) { ?>
                                                    <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                <?php }
                                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT', 'Delete')) { ?>
                                                    <button class="btn btn-danger btn-action delete-incrmt" data-value="<?php echo $value->m_incrmt_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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

            <div class="col-md-12" id="addincrmt" style="<?php if ($id) {
                                                                echo 'display:block;';
                                                            } else {
                                                                echo 'display:none;';
                                                            } ?>">
                <div class="page-box">
                    <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                            echo 'Edit Value';
                                                        } else {
                                                            echo 'Add New';
                                                        } ?></h3>
                    <div class="form-example">
                        <div class="form-wrap top-label-exapmple form-layout-page">
                            <form method="post" action="#" id="frm-add-incrmt">

                                <?php if (!empty($edit_value)) {
                                    $id = $edit_value->m_incrmt_id;
                                    $vouno = $edit_value->m_incrmt_vouno;
                                    $voudate = $edit_value->m_incrmt_voudate;
                                    $empid = $edit_value->m_incrmt_empid;
                                    $strdate = $edit_value->m_incrmt_strdate;
                                    $ariasdate = $edit_value->m_incrmt_ariasdate;
                                    $design = $edit_value->m_incrmt_design;
                                    $new_gross = $edit_value->m_new_gross;
                                    $old_gross = $edit_value->m_old_gross;
                                    $amt = $edit_value->m_incrmt_amt;
                                    $remarks = $edit_value->m_incrmt_remarks;
                                    $arias_from_month = $edit_value->is_arias_from_month;
                                } else {
                                    $id = '';
                                    $vouno = '';
                                    $voudate = '';
                                    $empid = '';
                                    $strdate = '';
                                    $ariasdate = '';
                                    $design = '';
                                    $amt = '';
                                    $remarks = '';
                                    $arias_from_month = '';
                                } ?>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Voucher No<span class="text-danger">*</span></label>
                                                    <input type="number" name="m_incrmt_vouno" id="m_incrmt_vouno" class="form-control" value="<?= $vouno ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Voucher Date<span class="text-danger">*</span></label>
                                                    <input type="Date" name="m_incrmt_voudate" id="m_incrmt_voudate" class="form-control" value="<?= $voudate ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" name="m_incrmt_id" id="m_incrmt_id" value="<?= $id ?>">
                                                    <label>Employee Id<span class="text-danger">*</span></label>
                                                    <select name="m_incrmt_empid" id="m_incrmt_empid" class="form-control" title="Select Employee">
                                                        <option value="">Choose</option>
                                                        <?php
                                                        foreach ($emp_list as $emp) {
                                                            if ($empid == $emp->m_emp_id) {
                                                                $op = 'selected';
                                                            } else {
                                                                $op = '';
                                                            }

                                                        ?>
                                                            <option value="<?php echo $emp->m_emp_id; ?>" <?= $op ?>><?php echo $emp->m_emp_name; ?></option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12" id="empdetailblock">
                                                <?php if ($id) { ?>
                                                    <table class="table table-striped table-bordered">
                                                        <tr>
                                                            <th>EmployeeCode</th>
                                                            <td><?= $edit_value->m_emp_code ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>EmployeeName</th>
                                                            <td><?= $edit_value->m_emp_name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Company</th>
                                                            <td><?= $edit_value->m_company_name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Designation</th>
                                                            <td><input type="hidden" name="m_old_designation" value="<?= $edit_value->m_emp_design?>"><?= $edit_value->m_design_name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Department</th>
                                                            <td><?= $edit_value->m_dept_name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>HQ</th>
                                                            <td><?= $edit_value->m_emp_hq ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>DateOfJoining</th>
                                                            <td><?= $edit_value->m_emp_doj ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>GrossSalary</th>
                                                            <td><?= $edit_value->m_emp_gross_salary ?></td>
                                                        </tr>
                                                    </table>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>From the Month<span class="text-danger">*</span></label>
                                                    <input type="date" name="m_incrmt_strdate" id="m_incrmt_strdate" class="form-control" value="<?= $strdate ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Amount <span class="text-danger">*</span></label>
                                                    <input type="number" name="m_incrmt_amt" id="m_incrmt_amt" class="form-control" value="<?= $amt ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label style="display: inline-flex;"><input type="checkbox" name="arias_from_month" id="arias_from_month" class="form-control" <?php if ($arias_from_month == 1) echo 'checked' ?> value="1" style="height: 18px;display: inline;width: 20px;"> Is arias from month <span class="text-danger">*</span></label>
                                                    <input type="date" name="m_incrmt_ariasdate" id="m_incrmt_ariasdate" class="form-control" value="<?= $ariasdate ?>" <?php if ($arias_from_month != 1) echo 'readonly' ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                    <label>Designation</label>
                                                    <select name="m_incrmt_design" id="m_incrmt_design" class="form-control select2" style="width:100%">
                                                        <?php
                                                        foreach ($design_value as $dekey) {
                                                            if ($design == $dekey->m_design_id) {
                                                                $op = 'selected';
                                                            } else {
                                                                $op = '';
                                                            }
                                                        ?>
                                                            <option value="<?php echo $dekey->m_design_id; ?>" <?= $op ?>><?php echo $dekey->m_design_name; ?>
                                                            </option>
                                                        <?php
                                                        }

                                                        ?>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Remark </label>
                                                    <input name="m_incrmt_remarks" id="m_incrmt_remarks" class="form-control" value="<?= $remarks ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 ">
                                              
                                                <label>Update Salary Structure </label>
                                                <div class="salsrtblock">
                                                    <?php if ($id) { 
                                                        ?>
                                                        <table class="table table-bordered" id="salsrtblock">
                                                    <tbody >
                                                        <tr>
                                                            <th>Salary Head</th>
                                                            <th style="width:33%">Prev Salary</th>
                                                            <th style="width:32%">New Salary</th>

                                                        </tr>
                                                        <tr>
                                                            <th>Basic</th>
                                                            <td><?= $edit_value->m_emp_salary ?></td>
                                                            <td><input type="number" name="m_emp_salary" value="<?= $edit_value->m_emp_salary ?>"></td>
                                                         
                                                        </tr>
                                                        <tr>
                                                            <th>TA</th>
                                                            <td><?= $edit_value->m_emp_ta ?></td>
                                                            <td><input type="number" name="m_emp_ta" value="<?= $edit_value->m_emp_ta ?>"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>HRA</th>
                                                            <td><?= $edit_value->m_emp_hra ?></td>
                                                            <td><input type="number" name="m_emp_hra" value="<?= $edit_value->m_emp_hra ?>"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>CCA</th>
                                                            <td><?= $edit_value->m_emp_cca ?></td>
                                                            <td><input type="number" name="m_emp_cca" value="<?= $edit_value->m_emp_cca ?>"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>SplAllowance</th>
                                                            <td><?= $edit_value->m_emp_spl_allow ?></td>
                                                            <td><input type="number" name="m_emp_spl_allow" value="<?= $edit_value->m_emp_spl_allow ?>"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>EducationAllow</th>
                                                            <td><?= $edit_value->m_emp_educ_allow ?></td>
                                                            <td><input type="number" name="m_emp_educ_allow" value="<?= $edit_value->m_emp_educ_allow ?>"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>MedicalAllowance</th>
                                                            <td><?= $edit_value->m_emp_medic_allow ?></td>
                                                            <td><input type="number" name="m_emp_medic_allow" value="<?= $edit_value->m_emp_medic_allow ?>"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>GrossSalary</th>
                                                            <td><input type="hidden" name="m_old_gross" value="<?= $edit_value->m_emp_gross_salary ?>"><?= $edit_value->m_old_gross ?></td>
                                                            <td><input type="number" name="m_emp_gross_salary" value="<?= $edit_value->m_emp_gross_salary ?>"></td>
                                                            
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                    <?php  } 
                                                ?>
                                                </div>
                                               
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-layout-submit">
                                            <button type="submit" id="btn-add-incrmt" class="btn btn-block btn-info">Submit</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-layout-submit">
                                            <a href="<?php echo site_url('HrDept/incrmt_list') ?>" class="btn btn-block btn-danger">Cancel </a>

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