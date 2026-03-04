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
         <div class="col-md-8" style="padding-right: 0;">
            <div class="page-box">
               <div class="advance-table">
                  <table id="account_tbl" class="my_custom_datatable table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th width="5%">#</th>
                           <th>Account Name</th>
                           <th>Mobile</th>
                           <th>Bank Name</th>
                           <th>Account Number</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i = 1;
                        if (!empty($all_value)) {
                           foreach ($all_value as $value) {
                              $edit_link = site_url('Setup/account_list?id=') . $value->m_account_id;
                        ?>
                              <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $value->m_account_name; ?></td>
                                 <td><?php echo $value->m_account_mobile; ?></td>
                                 <td><?php echo $value->m_account_bank. '('.$value->m_account_ifsc.')'; ?></td>
                                 <td><?php echo $value->m_account_number; ?></td>
                                 <td>
                                    <?php
                                    if (!empty($value->m_account_status == 1)) {
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
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Acc', 'Edit')) { ?>
                                       <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                    <?php }
                                    if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Acc', 'Delete')) { ?>

                                    <?php } ?> <button class="btn btn-danger btn-action delete-account" data-value="<?php echo $value->m_account_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
         <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Acc', 'Add')) { ?>
            <div class="col-md-4">
               <div class="page-box">
                  <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                      echo 'Edit Value';
                                                   } else {
                                                      echo 'Add New';
                                                   } ?></h3>
                  <div class="form-example">
                     <div class="form-wrap top-label-exapmple form-layout-page">
                        <form method="post" action="#" id="frm-add-account">

                           <?php if (!empty($edit_value)) {
                              $id = $edit_value->m_account_id;
                              $act_mobile = $edit_value->m_account_mobile;
                              $act_bank = $edit_value->m_account_bank;
                              $act_number = $edit_value->m_account_number;
                              $act_ifsc = $edit_value->m_account_ifsc;
                              $group = $edit_value->m_account_group;
                              $title = $edit_value->m_account_name;
                              $status = $edit_value->m_account_status;
                           } else {
                              $id = '';
                              $act_bank = '';
                              $act_number = '';
                              $act_mobile = '';
                              $act_ifsc = '';
                              $group = '';
                              $title = '';
                              $status = 1;
                           } ?>

                           <!-- <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>AccGroup<span class="text-danger">*</span></label>
                                    <select name="m_account_group" id="m_account_group" class="form-control select2" title="Select Status" required>
                                       <option value="">Select group</option>
                                       <?php
                                       // if (!empty($accgroup)) {
                                       //    foreach ($accgroup as $pkey) {
                                       ?>
                                             <option value="<?php //echo $pkey->m_accgroup_id; 
                                                            ?>" <?php //if ($group == $pkey->m_accgroup_id) echo 'selected'; 
                                                                  ?>><?php // echo $pkey->m_accgroup_name; 
                                                                                                      ?></option>
                                       <?php
                                       //    }
                                       // }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                           </div> -->

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Account Holder Name <span class="text-danger">*</span></label>
                                    <input type="hidden" name="m_account_id" id="m_account_id" value="<?= $id ?>">
                                    <input type="text" name="m_account_name" id="m_account_name" class="form-control" placeholder="Enter account name" required="" value="<?= $title ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Mobile Number <span class="text-danger">*</span></label>
                                    <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_account_mobile" id="m_account_mobile" class="form-control" placeholder="Enter Mobile" required="" value="<?= $act_mobile ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Bank Name <span class="text-danger">*</span></label>
                                    <input type="text" name="m_account_bank" id="m_account_bank" class="form-control" placeholder="Enter bank name" required="" value="<?= $act_bank ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Account Number <span class="text-danger">*</span></label>
                                    <input type="text" name="m_account_number" id="m_account_number" class="form-control" placeholder="Enter account number" required="" value="<?= $act_number ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Bank IFSC</label>
                                    <input type="text" name="m_account_ifsc" id="m_account_ifsc" class="form-control" placeholder="Enter ifsc code" value="<?= $act_ifsc ?>">
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Status</label>
                                    <select name="m_account_status" id="m_account_status" class="form-control" title="Select Status">
                                       <option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
                                       <option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-account" class="btn btn-block btn-info">Submit</button>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-layout-submit">
                                    <a href="<?php echo site_url('Setup/account_list') ?>" class="btn btn-block btn-danger">Cancel </a>

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
<?php $this->view('js/js_setup') ?>
<?php $this->view('js/custom_js'); ?>

