<!-- =========================View==============Fix========== -->
<!-- ========================Header==============Fix========= -->
<?php $this->view('top_header'); 
  $logged_user_id = $this->session->userdata('user_id') ; $logged_user_type = $this->session->userdata('user_type') ;
?>
<!-- =======================/Header==============Fix========= -->
<!-- =========================View===============Fix========= -->
<!-- Right Side Content Start -->
<div class="page-content">
   <div class="container-fluid">
      <!-- ========================/View===============Fix========= -->
      <!-- ======================Page Title======================== -->
      <!-- Breadcromb Row Start -->
      <div class="row">
         <div class="col-md-12">
            <div class="breadcromb-area">
               <div class="row">
                  <div class="col-md-6  col-sm-6">
                     <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-8">
            <div class="page-box">
               <div class="advance-table">
                  <table id="custom_tbl" class="my_master_datatable table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>Sn.</th>
                           <th>Title</th>
                           <th>Category</th>
                           <th>Rent</th>
                           <th>Status</th>
                           <th>Action</th>

                        </tr>
                     </thead>
                     <tbody>

                        <?php
                        if (!empty($all_value)) {

                           foreach ($all_value as $i => $value) {


                        ?>

                              <tr>
                                 <td><?php echo $i + 1; ?></td>
                                 <td><?php echo $value->m_lockercode_title; ?></td>
                                 <td><?php echo $value->m_lockercode_category; ?></td>
                                 <td><?php echo $value->m_lockercode_rent;
                                       ?></td>
                                 <td><?php

                                       if ($value->m_lockercode_status == 1) {
                                          echo "Active";
                                       } else {
                                          echo "In-Active";
                                       }


                                       ?></td>


                                 <td title="Action" style="white-space: nowrap;">
                                 <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Lkc', 'Edit')) { ?>
                                    <a href="<?= site_url('Master/lockercode_list?id=') . $value->m_lockercode_id ?>" class="btn btn-success btn-action" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <?php } if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Lkc', 'Delete')) { ?>
                                    <button class="btn btn-danger btn-action delete-lockercode" data-value="<?php echo $value->m_lockercode_id; ?>" title="Delete"><i class="fa fa-trash"></i></button>
<?php } ?>
                                 </td>
                              </tr>
                        <?php }
                        } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Lkc', 'Add')) { ?>
         <div class="col-md-4">
            <div class="page-box">
               <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                   echo 'Edit Value';
                                                } else {
                                                   echo 'Add New';
                                                } ?></h3>
               <div class="form-example">
                  <div class="form-wrap top-label-exapmple form-layout-page">
                     <form method="post" action="#" id="frm-add-lockercode">

                        <?php if (!empty($edit_value)) {
                           $id = $edit_value->m_lockercode_id;

                           $title = $edit_value->m_lockercode_title;
                           $status = $edit_value->m_lockercode_status;
                           $category = $edit_value->m_lockercode_category;
                           $rent = $edit_value->m_lockercode_rent;
                        } else {
                           $id = '';

                           $title = '';
                           $status = 1;
                           $category = '';
                           $rent = '';
                        } ?>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Category</label>
                                 <select name="m_lockercode_category" id="m_lockercode_category" class="form-control" title="Select category" required>
                                    <option value="Locker B" <?php if ($category == "Locker B") echo 'selected' ?>>Locker B</option>
                                    <option value="Locker L" <?php if ($category == "Locker L") echo 'selected' ?>>Locker L</option>
                                    <option value="Locker G" <?php if ($category == "Locker G") echo 'selected' ?>>Locker G</option>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Title<span class="text-danger">*</span></label>
                                 <input type="hidden" name="m_lockercode_id" id="m_lockercode_id" value="<?= $id ?>">
                                 <input type="text" name="m_lockercode_title" id="m_lockercode_title" class="form-control" placeholder=" Enter Title" required="" value="<?= $title ?>">
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Rent </label>
                                 <input type="number" name="m_lockercode_rent" id="m_lockercode_rent" class="form-control" placeholder=" Enter Rent" value="<?= $rent ?>">
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Status</label>
                                 <select name="m_lockercode_status" id="m_lockercode_status" class="form-control" title="Select Status">
                                    <option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
                                    <option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-layout-submit">
                                 <button type="submit" id="btn-add-lockercode" class="btn btn-block btn-info">Submit</button>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-layout-submit">
                                 <a href="<?php echo site_url('Master/lockercode_list') ?>" class="btn btn-block btn-danger">Reset </a>

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
<?php $this->view('js/js_master') ?>
<?php $this->view('js/custom_js'); ?>
<!-- ========================Script========================== -->