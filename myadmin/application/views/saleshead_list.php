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
                  <table id="custom_tbl" class="my_custom_datatable table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th>Sn.</th>
                           <th>Title</th>
                           <?php if ($type == 1) {
                              echo '<th>Discount</th>
                              <th>GST Added</th>';
                           } else if($type == 2){
                              echo '<th>Department</th>';
                           } ?>

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
                                 <td><?php echo $value->m_saleshead_title; ?></td>
                                 <?php if ($type == 1) {
                                    if ($value->m_saleshead_gst == 1) {
                                       $saleshead_gst = "Yes";
                                    } else {
                                       $saleshead_gst = "No";
                                    }
                                    echo '<td>' . $value->m_saleshead_discount . ' %</td>
                                 <td>' . $saleshead_gst . '</td>';
                                 } else if($type == 2){
                                    echo '<td>' . $value->m_dept_name . '</td>';
                                 } ?>
                                 <td><?php

                                       if ($value->m_saleshead_status == 1) {
                                          echo "Active";
                                       } else {
                                          echo "In-Active";
                                       }


                                       ?></td>


                                 <td title="Action" style="white-space: nowrap;">
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Shd', 'Edit')) { ?>
                                       <a href="<?php $type == 1 ? site_url('Master/saleshead_list?id=') . $value->m_saleshead_id  : site_url('Master/instraction_list?id=')  . $value->m_saleshead_id ?>" class="btn btn-success btn-action" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <?php }
                                    if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Shd', 'Delete')) { ?>
                                       <button class="btn btn-danger btn-action delete-saleshead" data-value="<?php echo $value->m_saleshead_id; ?>" title="Delete"><i class="fa fa-trash"></i></button>
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
         <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Shd', 'Add')) { ?>
            <div class="col-md-4">
               <div class="page-box">
                  <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                      echo 'Edit Value';
                                                   } else {
                                                      echo 'Add New';
                                                   } ?></h3>
                  <div class="form-example">
                     <div class="form-wrap top-label-exapmple form-layout-page">
                        <form method="post" action="#" id="frm-add-saleshead">

                           <?php if (!empty($edit_value)) {
                              $id = $edit_value->m_saleshead_id;

                              $title = $edit_value->m_saleshead_title;
                              $dis = $edit_value->m_saleshead_discount;
                              $status = $edit_value->m_saleshead_status;
                              $dept = $edit_value->m_saleshead_dept;
                              $gst = $edit_value->m_saleshead_gst;
                              $type = $edit_value->m_saleshead_type;
                           } else {
                              $id = '';

                              $title = '';
                              $dept = '';
                              $dis = 0;
                              $status = 1;
                              $gst = 1;
                           } ?>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Title<span class="text-danger">*</span></label>
                                    <input type="hidden" name="m_saleshead_id" id="m_saleshead_id" value="<?= $id ?>">
                                    <input type="hidden" name="m_saleshead_type" id="m_saleshead_type" value="<?= $type ?>">
                                    <?php if ($type == 1) { ?>
                                       <input type="text" name="m_saleshead_title" id="m_saleshead_title" class="form-control" placeholder=" Enter Title" required="" value="<?= $title ?>">
                                    <?php } else { ?>
                                       <textarea name="m_saleshead_title" id="m_saleshead_title" class="form-control" placeholder=" Enter Instraction" required=""> <?= $title ?></textarea>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                           <?php if ($type == 2) { ?>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Department</label>
                                       <select name="m_saleshead_dept" id="m_saleshead_dept" class="form-control select2">
                                          <?php
                                          foreach ($dept_value as $dkey) {
                                             if ($dept == $dkey->m_dept_id) {
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
                           <?php }
                           if ($type == 1) { ?>


                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Discount </label>
                                       <input type="number" max="100" name="m_saleshead_discount" id="m_saleshead_discount" class="form-control" placeholder=" Enter Discount" required="" value="<?= $dis ?>">
                                    </div>
                                 </div>
                              </div>


                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>GST Added</label>
                                       <select name="m_saleshead_gst" id="m_saleshead_gst" class="form-control" title="Select gst">
                                          <option value="1" <?php if ($gst == 1) echo 'selected' ?>>Yes</option>
                                          <option value="0" <?php if ($gst == 0) echo 'selected' ?>>No</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           <?php } ?>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Status</label>
                                    <select name="m_saleshead_status" id="m_saleshead_status" class="form-control" title="Select Status">
                                       <option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
                                       <option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-saleshead" class="btn btn-block btn-info">Submit</button>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-layout-submit">
                                    <a href="<?php $type == 1 ? site_url('Master/saleshead_list') : site_url('Master/instraction_list') ?>" class="btn btn-block btn-danger">Reset </a>

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