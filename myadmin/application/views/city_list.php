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
                  <table id="city_tbl" class="my_custom_datatable table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th width="5%">#</th>
                           <th>Name</th>
                           <th>State</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i = 1;
                        if (!empty($all_value)) {
                           foreach ($all_value as $value) {
                              $edit_link = site_url('Master/city_list?id=') . $value->m_city_id;
                        ?>
                              <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $value->m_city_name; ?></td>
                                 <td><?php echo $value->m_state_name; ?></td>
                                 <td>
                                    <?php
                                    if (!empty($value->m_city_status == 1)) {
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
                                 <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'City', 'Edit')) { ?>
                                    <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                    <?php }if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'City', 'Delete')) { ?>
                                    <button class="btn btn-danger btn-action delete-city" data-value="<?php echo $value->m_city_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
         <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'City', 'Add')) { ?>
         <div class="col-md-4">
            <div class="page-box">
               <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                   echo 'Edit Value';
                                                } else {
                                                   echo 'Add New';
                                                } ?></h3>
               <div class="form-example">
                  <div class="form-wrap top-label-exapmple form-layout-page">
                     <form method="post" action="#" id="frm-add-city">

                        <?php if (!empty($edit_value)) {
                           $id = $edit_value->m_city_id;
                           $State = $edit_value->m_city_state;
                           $title = $edit_value->m_city_name;
                           $status = $edit_value->m_city_status;
                        } else {
                           $id = '';
                           $State = '';
                           $title = '';
                           $status = '';
                        } ?>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>State<span class="text-danger">*</span></label>
                                 <select name="m_city_state" id="m_city_state" class="form-control select2" title="Select Status" required>
                                    <option value="1">Select State</option>
                                    <?php
                                    if (!empty($get_active_state)) {
                                       foreach ($get_active_state as $state) {
                                    ?>
                                          <option value="<?php echo $state->m_state_id; ?>" <?php if ($State == $state->m_state_id) echo 'selected'; ?>><?php echo $state->m_state_name; ?></option>
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
                                 <label>City Title<span class="text-danger">*</span></label>
                                 <input type="hidden" name="m_city_id" id="m_city_id" value="<?= $id ?>">
                                 <input type="text" name="m_city_name" id="m_city_name" class="form-control" placeholder="Enter City Title" required="" value="<?= $title ?>">
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>City Status</label>
                                 <select name="m_city_status" id="m_city_status" class="form-control" title="Select Status">
                                    <option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
                                    <option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-layout-submit">
                                 <button type="submit" id="btn-add-city" class="btn btn-block btn-info">Submit</button>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-layout-submit">
                                 <a href="<?php echo site_url('Master/city_list') ?>" class="btn btn-block btn-danger">Cancel </a>

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
   </div>
</div>
<!-- ========================/View=================Fix======= -->
<?php $this->view('top_footer') ?>
<?php $this->view('js/js_master') ?>
<?php $this->view('js/custom_js'); ?>
