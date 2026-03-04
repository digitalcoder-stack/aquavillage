<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id');
$logged_user_type = $this->session->userdata('user_type');
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
         <div class="col-md-8" style="padding-right: 0;">
            <div class="page-box">
               <div class="advance-table">
                  <table id="godown_tbl" class="my_custom_datatable table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th width="5%">#</th>
                           <th>Name</th>
                           <th>Code</th>
                           <th>Type</th>
                           <th>Company</th>
                           <th>Department</th>
                           <th>Use As Dumping Point</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i = 1;
                        if (!empty($all_value)) {
                           foreach ($all_value as $value) {
                              $edit_link = site_url('Setup/godown_list?id=') . $value->m_godown_id;
                        ?>
                              <tr>
                                 <td><?= $i; ?></td>
                                 <td><?= $value->m_godown_name; ?></td>
                                 <td><?= $value->m_godown_code; ?></td>
                                 <td><?= $value->m_godown_type == 1 ? 'Main' : 'Departmental'; ?></td>
                                 <td><?= $value->m_company_name; ?></td>
                                 <td><?= $value->m_dept_name; ?></td>
                                 <td><?= $value->use_as_dumping_point == 1 ? 'YES' : 'NO'; ?></td>
                                 <td>
                                    <?php
                                    if (!empty($value->m_godown_status == 1)) {
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
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Gdwn', 'Edit')) { ?>
                                       <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                    <?php }
                                    if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Gdwn', 'Delete')) { ?>
                                       <button class="btn btn-danger btn-action delete-godown" data-value="<?php echo $value->m_godown_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
         <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Gdwn', 'Add')) { ?>
            <div class="col-md-4">
               <div class="page-box">
                  <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                      echo 'Edit Value';
                                                   } else {
                                                      echo 'Add New';
                                                   } ?></h3>
                  <div class="form-example">
                     <div class="form-wrap top-label-exapmple form-layout-page">
                        <form method="post" action="#" id="frm-add-godown">

                           <?php if (!empty($edit_value)) {
                              $id = $edit_value->m_godown_id;
                              $code = $edit_value->m_godown_code;
                              $company = $edit_value->m_godown_company;
                              $gdept = $edit_value->m_godown_dept;
                              $godown_type = $edit_value->m_godown_type;
                              $dumping_point = $edit_value->use_as_dumping_point;
                              $title = $edit_value->m_godown_name;
                              $status = $edit_value->m_godown_status;
                           } else {
                              $id = '';
                              $code = '';
                              $company = '';
                              $godown_type = '';
                              $dumping_point = '';
                              $title = '';
                              $status = 1;
                              $gdept = '';
                           } ?>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Company <span class="text-danger">*</span></label>
                                    <select name="m_godown_company" id="m_company" class="form-control select2" required>
                                       <?php if (!empty($company_list)) {
                                          foreach ($company_list as $key) {
                                             if ($company == $key->m_company_id) {
                                                $op = 'selected';
                                             } else {
                                                $op = '';
                                             }
                                             echo '<option value="' . $key->m_company_id . '" ' . $op . '>' . $key->m_company_name . '</option>';
                                          }
                                       } ?>

                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Department <span class="text-danger">*</span></label>
                                    <select name="m_godown_dept" id="m_seldept" class="form-control select2" required>
                                       <?php
                                       if (!empty($dept_list)) {

                                          foreach ($dept_list as $dkey) {
                                             if ($gdept == $dkey->m_dept_id) {
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
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Godown Name<span class="text-danger">*</span></label>
                                    <input type="hidden" name="m_godown_id" id="m_godown_id" value="<?= $id ?>">
                                    <input type="text" name="m_godown_name" id="m_godown_name" class="form-control" placeholder="Enter godown name" required="" value="<?= $title ?>">
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Godown Code</label>
                                    <input type="text" name="m_godown_code" id="m_godown_code" class="form-control" placeholder="Enter godown code" value="<?= $code ?>">
                                 </div>
                              </div>
                           </div>

                           <div class="row">

                              <div class="col-md-6">
                                 <div class="form-check">
                                    <input type="checkbox" <?php if (!empty($godown_type)) {
                                                               echo 'checked';
                                                            } ?> class="form-check-input" id="m_godown_type" name="m_godown_type" value="1">
                                    <label class="form-check-label" for="m_godown_type"> Is Main Godown</label>
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-check">
                                    <input type="checkbox" <?php if (!empty($dumping_point)) {
                                                               echo 'checked';
                                                            } ?> class="form-check-input" id="use_as_dumping_point" name="use_as_dumping_point" value="1">
                                    <label class="form-check-label" for="use_as_dumping_point"> Is Dumping Point</label>
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-check">
                                    <input type="checkbox" <?php if (!empty($status)) {
                                                               echo 'checked';
                                                            } ?> class="form-check-input" id="m_godown_status" name="m_godown_status" value="1">
                                    <label class="form-check-label" for="m_godown_status"> Is Active</label>
                                 </div>
                              </div>

                           </div>


                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-godown" class="btn btn-block btn-info">Submit</button>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-layout-submit">
                                    <a href="<?php echo site_url('Setup/godown_list') ?>" class="btn btn-block btn-danger">Cancel </a>

                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         <?php } ?>
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