<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id') ; $logged_user_type = $this->session->userdata('user_type') ;
?>
<!-- Right Side Content Start -->
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
                  <table id="cashacc_tbl" class="my_custom_datatable table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th width="5%">#</th>
                           <th>Name</th>
                           <th>Department</th>
                           <th>Upi Type</th>
                           <th>Bank Account</th>
                           <th>Mobile No</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i = 1;
                        if (!empty($all_value)) {
                           foreach ($all_value as $value) {
                              $edit_link = site_url('Master/cashAcc_list?id=') . $value->m_cashacc_id;

                              if ($value->m_cashacc_upiname == 2) {
                                 $upitype = 'Paytm';
                              } else if ($value->m_cashacc_upiname == 4) {
                                 $upitype = 'Other';
                              } else if ($value->m_cashacc_upiname == 3) {
                                 $upitype = 'Phone Pay';
                              } else {
                                 $upitype = '';
                              }

                        ?>
                              <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $value->m_cashacc_name; ?></td>
                                 <td><?php echo $value->m_dept_name; ?></td>
                                 <td><?php echo $upitype; ?></td>
                                 <td><?php echo $value->m_account_bank . ' ' . $value->m_account_number; ?></td>
                                 <td><?php echo $value->m_cashacc_mobileno; ?></td>
                                 <td>
                                    <?php
                                    if (!empty($value->m_cashacc_status == 1)) {
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
                                    <?php
                                    if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'CACT', 'Edit')) { ?>
                                       <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                    <?php }
                                    if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'CACT', 'Delete')) { ?>
                                       <button class="btn btn-danger btn-action delete-cashacc" data-value="<?php echo $value->m_cashacc_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
         <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'CACT', 'Add')) { ?>
            <div class="col-md-4">
               <div class="page-box">
                  <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                      echo 'Edit Value';
                                                   } else {
                                                      echo 'Add New';
                                                   } ?></h3>
                  <div class="form-example">
                     <div class="form-wrap top-label-exapmple form-layout-page">
                        <form method="post" action="#" id="frm-add-cashacc">

                           <?php if (!empty($edit_value)) {
                              $id = $edit_value->m_cashacc_id;
                              $upiname = $edit_value->m_cashacc_upiname;
                              $accname = $edit_value->m_cashacc_accname;
                              $mobileno = $edit_value->m_cashacc_mobileno;
                              $deptac = $edit_value->m_cashacc_dept;
                              $title = $edit_value->m_cashacc_name;
                              $status = $edit_value->m_cashacc_status;
                           } else {
                              $id = '';
                              $title = '';
                              $upiname = '';
                              $accname = '';
                              $mobileno = '';
                              $deptac = '';
                              $status = 1;
                           } ?>



                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="hidden" name="m_cashacc_id" id="m_cashacc_id" value="<?= $id ?>">
                                    <input type="text" name="m_cashacc_name" id="m_cashacc_name" class="form-control" placeholder="Enter Title" required="" value="<?= $title ?>">
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Department <span class="text-danger">*</span></label>
                                    <select name="m_cashacc_dept" id="m_cashacc_dept" class="form-control select2" required>
                                       <?php
                                       foreach ($dept_list as $dkey) {
                                          if ($deptac == $dkey->m_dept_id) {
                                             $op = 'selected';
                                          } else {
                                             $op = '';
                                          }
                                       ?>
                                          <option value="<?php echo $dkey->m_dept_id; ?>" <?= $op ?>><?php echo $dkey->m_dept_name; ?>
                                          </option>
                                       <?php
                                       }

                                       ?>

                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Bank Account <span class="text-danger">*</span></label>
                                    <select name="m_cashacc_accname" id="m_cashacc_accname" class="form-control select2" required>
                                       <?php
                                       if (!empty($account_list)) {
                                          foreach ($account_list as $dkey) {
                                             if ($accname == $dkey->m_account_id) {
                                                $op = 'selected';
                                             } else {
                                                $op = '';
                                             }
                                       ?>
                                             <option value="<?php echo $dkey->m_account_id; ?>" <?= $op ?>><?php echo $dkey->m_account_bank . ' ' . $dkey->m_account_number; ?></option>
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
                                    <label>UPI Type <span class="text-danger">*</span></label>
                                    <select name="m_cashacc_upiname" id="m_cashacc_upiname" class="form-control select2" required>
                                       <option value="2" <?php if ($upiname == 2) echo 'selected' ?>>Paytm</option>
                                       <option value="3" <?php if ($upiname == 3) echo 'selected' ?>>Phone Pay</option>
                                       <option value="4" <?php if ($upiname == 4) echo 'selected' ?>>Other</option>

                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Mobile Number </label>
                                    <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_cashacc_mobileno" id="m_cashacc_mobileno" class="form-control" placeholder="Enter Mobile" value="<?= $mobileno ?>">
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Status</label>
                                    <select name="m_cashacc_status" id="m_cashacc_status" class="form-control" title="Select Status">
                                       <option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
                                       <option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-cashacc" class="btn btn-block btn-info">Submit</button>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-layout-submit">
                                    <a href="<?php echo site_url('Master/cashAcc_list') ?>" class="btn btn-block btn-danger">Cancel </a>

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
   </div>
</div>
<!-- ========================/View=================Fix======= -->
<?php $this->view('top_footer') ?>
<?php $this->view('js/js_master') ?>
<?php $this->view('js/custom_js'); ?>