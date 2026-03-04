<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id') ; $logged_user_type = $this->session->userdata('user_type') ;
?>
<div class="page-content">
    <div class="container-fluid">
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-md-6  col-sm-6">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'cmpy', 'Add')) { ?>
                <div class="col-md-12" style="margin-bottom: 10px;">
                    <div class="page-box">
                        <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                                echo 'Edit Value';
                                                            } else {
                                                                echo 'Add New';
                                                            } ?></h3>
                        <div class="form-example">
                            <div class="form-wrap top-label-exapmple form-layout-page">
                                <form method="post" action="#" id="frm-add-company">

                                    <?php if (!empty($edit_value)) {
                                        $id = $edit_value->m_company_id;
                                        $company_name = $edit_value->m_company_name;
                                        $company_code = $edit_value->m_company_code;
                                        $company_mobile = $edit_value->m_company_mobile;
                                        $company_email = $edit_value->m_company_email;
                                        $company_website = $edit_value->m_company_website;
                                        $company_city = $edit_value->m_company_city;
                                        $company_address = $edit_value->m_company_address;
                                        $company_account = $edit_value->m_company_account;
                                        $company_status = $edit_value->m_company_status;
                                    } else {
                                        $id = '';
                                        $company_name = '';
                                        $company_code = '';
                                        $company_mobile = '';
                                        $company_email = '';
                                        $company_website = '';
                                        $company_city = '';
                                        $company_address = '';
                                        $company_account = '';
                                        $company_status = 1;
                                    } ?>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Company Name <span class="text-danger">*</span></label>
                                                <input type="hidden" name="m_company_id" id="m_company_id" value="<?= $id ?>">
                                                <input type="text" name="m_company_name" id="m_company_name" class="form-control" placeholder="Enter company name" required="" value="<?= $company_name ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Company Code <span class="text-danger">*</span></label>
                                                <input type="text" name="m_company_code" id="m_company_code" class="form-control" placeholder="Enter company code" required="" value="<?= $company_code ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Mobile Number </label>
                                                <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_company_mobile" id="m_company_mobile" class="form-control" placeholder="Enter Company mobile" value="<?= $company_mobile ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Email Address </label>
                                                <input type="text" name="m_company_email" id="m_company_email" class="form-control" placeholder="Enter Company email" value="<?= $company_email ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Website </label>
                                                <input type="text" name="m_company_website" id="m_company_website" class="form-control" placeholder="Enter Company website" value="<?= $company_website ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bank Account </label>
                                                <select name="m_company_account" id="m_company_account" class="form-control select2">
                                                    <?php
                                                    if (!empty($account_list)) {
                                                        foreach ($account_list as $dkey) {
                                                            if ($company_account == $dkey->m_account_id) {
                                                                $op = 'selected';
                                                            } else {
                                                                $op = '';
                                                            }
                                                        }
                                                    ?>
                                                        <option value="<?php echo $dkey->m_account_id; ?>" <?= $op ?>><?php echo $dkey->m_account_bank . ' ' . $dkey->m_account_number; ?></option>
                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <label>City Name <span class="text-danger">*</span></label>
                                                <select name="m_company_city" id="stc_add_city" class="form-control select2" required>
                                                    <option value="">Select City</option>
                                                    <?php
                                                    foreach ($city_dtl as $city) {
                                                        if ($company_city == $city->m_city_id) {
                                                            $op = 'selected';
                                                        } else {
                                                            $op = '';
                                                        }

                                                    ?>
                                                        <option value="<?php echo $city->m_city_id; ?>" <?= $op ?>><?php echo $city->m_city_name . ' | ' . $city->m_state_name; ?></option>
                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                                <div class="input-group-btn">
                                                    <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#addcityModal" type="button" style="margin-top: 25px;height: 40px;background: #8d8d8d;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="m_company_status" id="m_company_status" class="form-control" title="Select Status">
                                                    <option value="1" <?php if ($company_status == 1) echo 'selected' ?>>Active</option>
                                                    <option value="0" <?php if ($company_status == 0) echo 'selected' ?>>In-Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address <span class="text-danger">*</span></label>
                                                <textarea name="m_company_address" id="m_company_address" class="form-control" placeholder="Enter Company address" required><?= $company_address ?></textarea>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-layout-submit">
                                                <button type="submit" id="btn-add-company" class="btn btn-block btn-info">Submit</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-layout-submit">
                                                <a href="<?php echo site_url('Setup/company_list') ?>" class="btn btn-block btn-danger">Cancel </a>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="col-md-12" style="padding-right: 0;">
                <div class="page-box">
                    <div class="advance-table">
                        <table id="company_tbl" class="my_custom_datatable table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Account</th>
                                    <th>City</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($all_value)) {
                                    foreach ($all_value as $value) {
                                        $edit_link = site_url('Setup/company_list?id=') . $value->m_company_id;
                                ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                           
                                            <td><?php echo $value->m_company_name; ?></td>
                                            <td><?php echo $value->m_company_code; ?></td>
                                            <td><?php echo $value->m_company_mobile; ?></td>
                                            <td><?php echo $value->m_company_email; ?></td>
                                            <td><?php echo $value->m_company_website; ?></td>
                                            <td><?php echo $value->m_account_bank; ?></td>
                                            <td><?php echo $value->m_city_name; ?></td>
                                            <td><?php echo $value->m_company_address; ?></td>
                                         
                                            <td>
                                                <?php
                                                if (!empty($value->m_company_status == 1)) {
                                                ?>
                                                    <a class="btn btn-success btn-action" title="Active" data-toggle="Active">Active</a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a class="btn btn-danger btn-action" title="In-Active" data-toggle="In-Active">In-Active</a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td title="Action" style="white-space: nowrap;">
                                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'cmpy', 'Edit')) { ?>
                                                    <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                <?php }
                                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'cmpy', 'Delete')) { ?>
                                                    <button class="btn btn-danger btn-action delete-company" data-value="<?php echo $value->m_company_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
        <!-- End Advance Form Row -->
        <!-- ====================/Page Content======================= -->
        <!-- =========================View=================Fix======= -->
        <!-- End Widget Row -->
    </div>
</div>
<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer') ?>
<?php $this->view('js/js_setup') ?>
<?php $this->view('js/custom_js'); ?>
<!-- ========================Script========================== -->