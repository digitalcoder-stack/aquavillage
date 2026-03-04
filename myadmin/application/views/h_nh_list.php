<!-- =========================View==============Fix========== -->
<!-- ========================Header==============Fix========= -->
<?php $this->view('top_header'); 
  $logged_user_id = $this->session->userdata('user_id') ; $logged_user_type = $this->session->userdata('user_type') ;
?>
<!-- =======================/Header==============Fix========= -->
<!-- =========================View===============Fix========= -->
<!-- Right Side Content Start -->
<div class="page-content p-0" style="overflow-x: hidden;">
<div class="container-fluid" >

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

            <div class="col-md-8">
                <div class="page-box">
                    <div class="advance-table">
                        <table id="nh_tbl" class="my_custom_datatable table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>DayID</th>
                                    <th>MonthID</th>
                                    <th>YearID</th>
                                    <th>NH Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($all_value)) {
                                    foreach ($all_value as $value) {
                                        $edit_link = site_url('HrDept/nh_list?id=') . $value->m_nh_id;
                                ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $value->m_nh_dayid; ?></td>
                                            <td><?php echo $value->m_nh_monthid; ?></td>
                                            <td><?php echo $value->m_nh_yearid; ?></td>
                                            <td><?php echo $value->m_nh_name; ?></td>
                                            <td>
                                                <?php
                                                if (!empty($value->m_nh_status == 1)) {
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
                                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Nh', 'Edit')) { ?>
                                                <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                <?php }if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Nh', 'Delete')) { ?>
                                                <button class="btn btn-danger btn-action delete-nh" data-value="<?php echo $value->m_nh_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                                <?php }?>
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
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Nh', 'Add')) { ?>
            <div class="col-md-4">
                <div class="page-box">
                    <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                            echo 'Edit Value';
                                                        } else {
                                                            echo 'Add New';
                                                        } ?></h3>
                    <div class="form-example">
                        <div class="form-wrap top-label-exapmple form-layout-page">
                            <form method="post" action="#" id="frm-add-nh">

                                <?php if (!empty($edit_value)) {
                                    $id = $edit_value->m_nh_id;
                                    $title = $edit_value->m_nh_name;
                                    $dayid = $edit_value->m_nh_dayid;
                                    $monthid = $edit_value->m_nh_monthid;
                                    $yearid = $edit_value->m_nh_yearid;
                                    $status = $edit_value->m_nh_status;
                                } else {
                                    $id = '';
                                    $title = '';
                                    $dayid = '';
                                    $monthid = '';
                                    $yearid = '';
                                    $status = 1;
                                } ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Day ID<span class="text-danger">*</span></label>
                                            <input type="number" max="31" name="m_nh_dayid" id="m_nh_dayid" class="form-control" placeholder="Enter dayid" required="" value="<?= $dayid ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Month ID<span class="text-danger">*</span></label>
                                            <input type="number" max="31" name="m_nh_monthid" id="m_nh_monthid" class="form-control" placeholder="Enter monthid" required="" value="<?= $monthid ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Year ID<span class="text-danger">*</span></label>
                                            <input type="number" max='2200' name="m_nh_yearid" id="m_nh_yearid" class="form-control" placeholder="Enter yearid" required="" value="<?= $yearid ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>NH Name<span class="text-danger">*</span></label>
                                            <input type="hidden" name="m_nh_id" id="m_nh_id" value="<?= $id ?>">
                                            <input type="text" name="m_nh_name" id="m_nh_name" class="form-control" placeholder="Enter Name" required="" value="<?= $title ?>">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="m_nh_status" id="m_nh_status" class="form-control" title="Select Status">
                                                <option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
                                                <option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-layout-submit">
                                            <button type="submit" id="btn-add-nh" class="btn btn-block btn-info">Submit</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-layout-submit">
                                            <a href="<?php echo site_url('HrDept/nh_list') ?>" class="btn btn-block btn-danger">Cancel </a>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
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