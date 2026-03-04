<?php $this->view('top_header'); 
  $logged_user_id = $this->session->userdata('user_id') ; $logged_user_type = $this->session->userdata('user_type') ;
?>
<style>
    .row{
        margin-top: 5px;

    }
</style>
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
         <div class="col-md-9" style="padding-right: 0;">
            <div class="page-box">
               <div class="advance-table">
                  <table id="asset_tbl" class="my_custom_datatable table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th width="5%">#</th>
                           <th>Name</th>
                           <th>Owner</th>
                           <th>Godown id</th>
                           <th>Remark</th>
                           <th>Ownership</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i = 1;
                        if (!empty($all_value)) {
                           foreach ($all_value as $value) {
                              $edit_link = site_url('Setup/asset_list?id=') . $value->m_asset_id;
                        ?>
                              <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $value->m_asset_name; ?></td>
                                 <td><?php echo $value->m_asset_owner; ?></td>
                                 <td><?php echo $value->m_godown_name; ?></td>
                                 <td><?php echo $value->m_asset_remark; ?></td>
                                 <td><?php echo $value->m_asset_ownership; ?></td>
                                 <td><?php echo $value->m_asset_ishired; ?></td>
                                 <!-- <td>
                                    <?php
                                    if (!empty($value->m_asset_status == 1)) {
                                    ?>
                                       <a class="btn btn-success btn-action" title="Active" data-toggle="Active">Active</a>
                                    <?php
                                    } else {
                                    ?>
                                       <a class="btn btn-danger btn-action" title="In-Active" data-toggle="In-Active">In-Active</a>
                                    <?php
                                    }
                                    ?>
                                 </td> -->
                                 <td title="Action" style="white-space: nowrap;">
                                 <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Ats', 'Edit')) { ?>
                                    <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                    <?php }if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Ats', 'Delete')) { ?>
                                    <button class="btn btn-danger btn-action delete-asset" data-value="<?php echo $value->m_asset_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
         <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Ats', 'Add')) { ?>
         <div class="col-md-3">
            <div class="page-box">
               <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                   echo 'Edit Value';
                                                } else {
                                                   echo 'Add New';
                                                } ?></h3>
               <div class="form-example">
                  <div class="form-wrap top-label-exapmple form-layout-page">
                     <form method="post" action="#" id="frm-add-asset">

                        <?php if (!empty($edit_value)) {
                           $id = $edit_value->m_asset_id;
                           $owner = $edit_value->m_asset_owner;
                           $ownership = $edit_value->m_asset_ownership;
                           $remark = $edit_value->m_asset_remark;
                           $ishired = $edit_value->m_asset_ishired;
                           $title = $edit_value->m_asset_name;
                           $status = $edit_value->m_asset_status;
                           $godown = $edit_value->m_asset_godown;
                        } else {
                           $id = '';
                           $owner = '';
                           $ownership = '';
                           $remark = '';
                           $ishired = '';
                           $title = '';
                           $godown = '';
                           $status = 1;
                        } ?>


                        <div class="row">
                           <div class="form-group">
                           <div class="col-md-5">
                                 <label>Asset Name<span class="text-danger">*</span></label>
                                 </div><div class="col-md-7">
                                 <input type="hidden" name="m_asset_id" id="m_asset_id" value="<?= $id ?>">
                                 <input type="text" name="m_asset_name" id="m_asset_name" class="form-control" placeholder="Enter asset name" required="" value="<?= $title ?>">
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="form-group">
                           <div class="col-md-5">
                                 <label>Owner </label>
                                 </div><div class="col-md-7">
                                 <input type="text" name="m_asset_owner" id="m_asset_owner" class="form-control" placeholder="Enter asset owner" value="<?= $owner ?>">
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="form-group">
                           <div class="col-md-5">
                                 <label>Godown ID<span class="text-danger">*</span></label>
                                 </div><div class="col-md-7">
                                 <select name="m_asset_godown" id="m_asset_godown" class="form-control select2" required>
                                    <option value="">Select Godownid</option>
                                    <?php
                                    if (!empty($godown_list)) {
                                       foreach ($godown_list as $pkey) {
                                    ?>
                                          <option value="<?php echo $pkey->m_godown_id; ?>" <?php if ($godown == $pkey->m_godown_id) echo 'selected'; ?>><?php echo $pkey->m_godown_name; ?></option>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="form-group">
                           <div class="col-md-5">
                                 <label>Ownership </label>
                                 </div><div class="col-md-7">
                                 <input type="text" name="m_asset_ownership" id="m_asset_ownership" class="form-control" placeholder="Enter ownership " value="<?= $ownership ?>">
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="form-group">
                           <div class="col-md-5">
                                 <label>Remark </label>
                                 </div><div class="col-md-7">
                                 <input type="text" name="m_asset_remark" id="m_asset_remark" class="form-control" placeholder="Enter remark " value="<?= $remark ?>">
                              </div>
                           </div>
                        </div>


                        <div class="row">
                           <div class="form-group">
                           <div class="col-md-5">
                                 <label>Is Hired</label>
                                 </div><div class="col-md-7">
                                 <select name="m_asset_ishired" id="m_asset_ishired" class="form-control">
                                    <option value="1" <?php if ($ishired == 1) echo 'selected' ?>>Yes</option>
                                    <option value="2" <?php if ($ishired == 2) echo 'selected' ?>>No</option>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="form-group">
                           <div class="col-md-5">
                                 <label>Status</label>
                           </div><div class="col-md-7">
                                 <select name="m_asset_status" id="m_asset_status" class="form-control" title="Select Status">
                                    <option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
                                    <option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-layout-submit">
                                 <button type="submit" id="btn-add-asset" class="btn btn-block btn-info">Submit</button>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-layout-submit">
                                 <a href="<?php echo site_url('Setup/asset_list') ?>" class="btn btn-block btn-danger">Cancel </a>

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
