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
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Emp', 'Filter')) { ?>
                        <form method="post" action="<?php echo site_url('HrDept/employe_list') ?>">
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

                                    <select name="status" id="status" class="form-control">
                                        <option value="o" <?php if ($status == 'o') echo 'selected' ?>>Active</option>
                                        <option value="1" <?php if ($status == 1) echo 'selected' ?>>Out of Job</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">Search</button>
                                        <a href="<?php echo site_url('HrDept/employe_list') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Emp', 'Export')) { ?>
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
                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Emp', 'Add')) { ?>
                            <a href="<?php echo site_url('HrDept/add_employe') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New Employee</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-box">
            <div class="advance-table table-overflow">
                <table id="employe_tbl" class="my_custom_datatable table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>EmpCode</th>
                            <th>Login ID</th>
                            <th>EmpName</th>
                            <th>DOJ</th>
                            <?php if ($this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') != 3 && $this->session->userdata('user_dept') == 1) {
                                echo '<th>GSalary</th>
                            <th>EPF No</th>
                            <th>ESIC No</th>
                            <th>Leader Name</th>';
                            } ?>
                            <th>Pan No</th>
                            <th>Mobile No</th>
                            <th>BankAccNo</th>
                            <th>Company</th>
                            <th>Dept</th>
                            <th>Desig</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if (!empty($emp_value)) {
                            foreach ($emp_value as $value) {

                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->m_emp_code; ?></td>
                                    <td><?php echo $value->m_emp_id; ?></td>
                                    <td><?php echo $value->m_emp_name; ?></td>
                                    <td><?= date('d-m-Y h:i', strtotime($value->m_emp_doj)); ?></td>
                                    <?php if ($this->session->userdata('user_type') == 1 || $this->session->userdata('user_type') != 3 && $this->session->userdata('user_dept') == 1) {
                                        $bosname = $value->m_emp_leadact == 1? "Self" :$value->boss_name;
                                        echo ' <td>' . $value->m_emp_gross_salary . '</td>
                                                <td>' . $value->m_emp_epfno . '</td>
                                                <td>' . $value->m_emp_esicno . '</td>
                                                <td>' . $bosname . '</td>';
                                    } ?>
                                    <td><?php echo $value->m_emp_panno; ?></td>
                                    <td><?php echo $value->m_emp_mobile; ?></td>
                                    <td><?php echo $value->m_emp_accno; ?></td>
                                    <td><?php echo $value->m_company_name; ?></td>
                                    <td><?php echo $value->m_dept_name; ?></td>
                                    <td><?php echo $value->m_design_name; ?></td>

                                    <!-- <td><?php if ($value->m_HrDept_status == 1) echo "Active";
                                                else {
                                                    echo "In-Active";
                                                } ?></td>  -->

                                    <td class="wd-30">
                                        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Emp', 'Edit')) { ?>
                                            <!-- <a href="<?php echo base_url('HrDept/view_HrDept_dtl?id=') . $value->m_emp_id; ?>" class="btn btn-info btn-action" title="View" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                            <a href="<?php echo base_url('HrDept/add_employe?id=') . $value->m_emp_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                        <?php }
                                        if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Emp', 'Delete')) { ?>
                                            <button class="btn btn-danger btn-action delete-employe" data-value="<?php echo $value->m_emp_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
</div>
<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/js_hr');
$this->view('js/custom_js'); ?>
<!-- =======================/Footer================Fix=======