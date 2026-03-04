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

               <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'BND', 'Filter')) { ?>

                  <form method="get" action="<?= site_url('Setup/band_list') ?>">
                     <div class="row">
                        <div class="col-md-3">
                           <label class="form-check-label">Status</label>
                           <select name="bnd_status" id="bnd_status" class="form-check-input" style="padding: 5px;" onchange="this.form.submit();">
                              <option value="">--All--</option>
                              <option value="1" <?php if ($bnd_status == 1) echo 'selected' ?>>Running</option>
                              <option value="2" <?php if ($bnd_status == 2) echo 'selected' ?>>Expired</option>
                              <option value="3" <?php if ($bnd_status == 3) echo 'selected' ?>>Up Coming</option>

                           </select>

                        </div>
                        <div class="col-md-3">
                           <label class="form-check-label">Colour</label>
                           <select name="bnd_colour" id="bnd_colour" class="form-check-input" style="padding: 5px;" onchange="this.form.submit();">
                              <option value="">--All Colour--</option>
                              <?php
                              foreach ($bandcolour as $value) {
                                 if ($bnd_colour == $value->m_hq_id) {
                                    $option1 = "selected";
                                 } else {
                                    $option1 = "";
                                 }

                              ?>
                                 <option value="<?php echo $value->m_hq_id; ?>" <?= $option1 ?>><?php echo $value->m_hq_name ?></option>
                              <?php
                              }
                              ?>
                           </select>

                        </div>

                        <!-- 
                        <div class="col-md-3">
                           <div class="form-group">
                              <button class="btn btn-info" type="submit">Search</button>
                              <a href="<?php echo site_url('Setup/band_list') ?>" class="btn btn-primary">Refresh</a>

                           </div>
                        </div> -->
                     </div>
                  </form>
               <?php } ?>

               <div class="advance-table">
                  <div class="table-responsive">
                     <table id="band_tbl" class="my_master_datatable table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th width="5%">#</th>
                              <th>Color</th>
                              <th>Total Piece</th>
                              <th>Start No</th>
                              <th>End No</th>
                              <th>IN Stock</th>
                              <th>Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $i = 1;
                           if (!empty($all_value)) {
                              foreach ($all_value as $value) {
                                 $edit_link = site_url('Setup/band_list?id=') . $value->m_band_id;

                                 $bnd_main = $this->Setup_model->get_lastband_maintaince($value->m_band_id);
                                 // echo '<pre>';
                                 // print_r($bnd_main->days);
                           ?>
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->m_hq_name; ?></td>
                                    <td><?php echo $value->m_band_total; ?></td>
                                    <td><?php echo $value->m_band_nostart; ?></td>
                                    <td><?php echo $value->m_band_noend; ?></td>
                                    <td><?php echo $value->m_band_instock; ?></td>
                                    <td>
                                       <?php
                                       if ($value->m_band_status == 1) {
                                          echo '<a class="btn btn-success btn-action" title="Active" >Running</a>';
                                       } else if ($value->m_band_status == 2) {

                                          echo ' <a class="btn btn-danger btn-action" title="Expired" >Expired</a>';
                                       } else {

                                          echo ' <a class="btn btn-warning btn-action" title="Up Coming" >Up Coming</a>';
                                       }
                                       ?>
                                    </td>

                                    <td title="Action" style="white-space: nowrap;">
                                       <?php if ($bnd_main->days == '' || $bnd_main->days >= 15) {
                                          echo '<button class="btn btn-warning btn-action" type="button" onclick="addbandmaintance(`' . $value->m_band_id . '`,`' . $value->m_hq_name . '`)" title="Add Maintainance"><i class="fa fa-wrench" aria-hidden="true"></i></button>';
                                       } ?>
                                       <button class="btn btn-info btn-action" type="button" onclick="viewbandmaintance(`<?= $value->m_band_id ?>`,`<?= $value->m_hq_name ?>`)" title="View Maintainance History"><i class="fa fa-tags" aria-hidden="true"></i></button>
                                       <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'BND', 'Edit')) { ?>
                                          <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                       <?php }
                                       if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'BND', 'Delete')) { ?>
                                          <button class="btn btn-danger btn-action delete-band" data-value="<?php echo $value->m_band_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
         <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'BND', 'Add')) { ?>
            <div class="col-md-4">
               <div class="page-box">
                  <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                      echo 'Edit Value';
                                                   } else {
                                                      echo 'Add New';
                                                   } ?></h3>
                  <div class="form-example">
                     <div class="form-wrap top-label-exapmple form-layout-page">
                        <form method="post" action="#" id="frm-add-band">

                           <?php if (!empty($edit_value)) {
                              $id = $edit_value->m_band_id;
                              $color = $edit_value->m_band_color;

                              $nostart = $edit_value->m_band_nostart;
                              $noend = $edit_value->m_band_noend;
                              $instock = $edit_value->m_band_instock;
                              $status = $edit_value->m_band_status;
                           } else {
                              $id = '';
                              $color = '';

                              $nostart = '';
                              $noend = '';
                              $instock = '';
                              $status = 3;
                           } ?>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Band Color<span class="text-danger">*</span></label>
                                    <input type="hidden" name="m_band_id" id="m_band_id" value="<?= $id ?>">
                                    <select name="m_band_color" id="m_band_color" class="form-control select2" required>
                                       <option value="">Select Band</option>
                                       <?php
                                       foreach ($bandcolour as $value) {
                                          if ($color == $value->m_hq_id) {
                                             $option1 = "selected";
                                          } else {
                                             $option1 = "";
                                          }

                                       ?>
                                          <option value="<?php echo $value->m_hq_id; ?>" <?= $option1 ?>><?php echo $value->m_hq_name ?></option>
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
                                    <label>Start No<span class="text-danger">*</span></label>
                                    <input type="number" name="m_band_nostart" id="m_band_nostart" class="form-control" placeholder="Enter start no" required="" value="<?= $nostart ?>">
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>End No<span class="text-danger">*</span></label>
                                    <input type="number" name="m_band_noend" id="m_band_noend" class="form-control" placeholder="Enter end no" required value="<?= $noend ?>">
                                 </div>
                              </div>
                           </div>

                           <?php if (!empty($id)) { ?>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Bands In Stock</label>
                                       <input type="number" name="m_band_instock" id="m_band_instock" class="form-control" placeholder="Enter bands In Stock" value="<?= $instock ?>">
                                    </div>
                                 </div>
                              </div>
                           <?php } ?>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Status</label>
                                    <select name="m_band_status" id="m_band_status" class="form-control" title="Select Status">
                                       <option value="1" <?php if ($status == 1) echo 'selected' ?>>Running</option>
                                       <option value="2" <?php if ($status == 2) echo 'selected' ?>>Expired</option>
                                       <option value="3" <?php if ($status == 3) echo 'selected' ?>>Up Coming</option>
                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-band" class="btn btn-block btn-info">Submit</button>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-layout-submit">
                                    <a href="<?php echo site_url('Setup/band_list') ?>" class="btn btn-block btn-danger">Cancel </a>

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


<div class="modal fade" id="band_maintainance_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <div class="row">
               <div class="col-md-10">
                  <h4 class="modal-title" id="modaltitle">Band Maintanance History</h4>
               </div>
               <div class="col-md-2" style="text-align: end;">
                  <button type="button" class="btn-close btn-danger" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
               </div>
            </div>

         </div>
         <div class="modal-body" style="word-break: break-all" id="modalbody">
            <!-- <form id="frm-bndmaintanance" method="post">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Band In Stock </label>
                        <input type="hidden" name="bm_bandno" id="bm_bandno">
                        <input type="hidden" name="bm_colour" id="bm_colour">
                        <input type="hidden" name="bm_used" id="bm_used">
                        <input type="hidden" name="bm_stock" id="bm_stock">
                        <input type="number" name="bm_chk_stk" id="bm_chk_stk" class="form-control" placeholder="Enter bands In Stock" value="">
                     </div>
                     <div class="form-group">
                        <label>Remark</label>
                        <textarea name="bm_remark" id="bm_remark" class="form-control" placeholder="Enter Remark"></textarea>
                     </div>
                     <div class="form-group">
                        <button class="btn btn-primary" type="submit" id="btn-bndmaintanance"> Submit</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal"> Cancel</button>
                     </div>
                  </div>
               </div>
            </form> -->
            <!-- <hr> -->
            <div class="row">
               <div class="col-md-12">
                  <div class="table-responsive">
                     <table class="table table-striped table-bordered">
                        <thead>
                           <th>Date</th>
                           <th>Colour </th>
                           <th>Series </th>
                           <th>Total </th>
                           <th>Total Used </th>
                           <th>In Stock </th>
                           <th>Re Enter Stock </th>
                           <th>Remark </th>
                        </thead>
                        <tbody id="modal_body_contant">

                        </tbody>

                     </table>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="band_maintainance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="modal_title">Band Maintanance</h4>
         </div>
         <div class="modal-body" style="word-break: break-all" id="modalbody">
            <div class="row">

               <div class="col-md-6" id="bnddtldiv">

               </div>
               <div class="col-md-6">
                  <form id="frm-bndmaintanance" method="post">
                     <div class="form-group">
                        <label>Band In Stock </label>
                        <input type="hidden" name="bm_bandno" id="bm_bandno">
                        <input type="hidden" name="bm_colour" id="bm_colour">
                        <input type="hidden" name="bm_used" id="bm_used">
                        <input type="hidden" name="bm_stock" id="bm_stock">
                        <input type="number" name="bm_chk_stk" id="bm_chk_stk" class="form-control" placeholder="Enter bands In Stock" value="">
                     </div>
                     <div class="form-group">
                        <label>Remark</label>
                        <textarea name="bm_remark" id="bm_remark" class="form-control" placeholder="Enter Remark"></textarea>
                     </div>
                     <div class="form-group">
                        <button class="btn btn-primary" type="submit" id="btn-bndmaintanance"> Submit</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal"> Cancel</button>
                     </div>

                  </form>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer') ?>
<?php $this->view('js/js_setup') ?>
<?php $this->view('js/custom_js'); ?>
<!-- ========================Script========================== -->
<script>
   $("form#frm-bndmaintanance").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-bndmaintanance");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
         type: "POST",
         url: "<?php echo site_url('Setup/add_band_maintainance'); ?>",
         data: formData,
         processData: false,
         contentType: false,
         dataType: "JSON",
         success: function(data) {
            if (data.status == 'success') {
               swal(data.message, {
                  icon: "success",
                  timer: 1000,
               });
               setTimeout(function() {
                  window.location.reload();
               }, 1000);
            } else {
               clkbtn.prop('disabled', false);
               swal(data.message, {
                  icon: "error",
                  timer: 5000,
               });
            }
         },
         error: function(jqXHR, status, err) {
            clkbtn.prop('disabled', false);
            swal("Some Problem Occurred!! please try again", {
               icon: "error",
               timer: 2000,
            });
         }
      });

   });

   function addbandmaintance(bnd_id, bnd_color) {
      $('#modal_title').html(bnd_color + ' Band Maintanance')
      $.ajax({
         type: "POST",
         url: "<?php echo site_url('Setup/get_bnd_dtl'); ?>",
         data: {
            bnd_id,
         },
         dataType: "JSON",
         success: function(data) {
            if (data != '') {
               $('#bnddtldiv').html(` 
               <div><b>Band Color</b>: ` + bnd_color + `</div>
               <div><b>Total Bands</b>: ` + data.m_band_total + `</div>
               <div><b>Band Start No</b>: ` + data.m_band_nostart + `</div>
               <div><b>Band End No</b>: ` + data.m_band_noend + `</div>
               <div><b>Band In Stock</b>: ` + data.m_band_instock + `</div>
               <div><b>Total Used</b>: ` + (data.m_band_total - data.m_band_instock) + `</div>
               `);

               $('#bm_bandno').val(bnd_id);
               $('#bm_colour').val(data.m_band_color);
               $('#bm_used').val((data.m_band_total - data.m_band_instock));
               $('#bm_stock').val(data.m_band_instock);
               $('#bm_chk_stk').val(data.m_band_instock);

               $('#band_maintainance').modal('show');
            }
         },
         error: function(jqXHR, status, err) {

            swal("Some Problem Occurred!! please try again", {
               icon: "error",
               timer: 2000,
            });
         }
      });

   }

   function viewbandmaintance(bnd_id, bnd_color) {
      var from_date = '';
      var to_date = '';
      var bnd_colour = '';
      var bnd_no = bnd_id;
      $('#modaltitle').html(bnd_color + ' Band Maintanance')
      $.ajax({
         type: "POST",
         url: "<?php echo site_url('Setup/bands_history'); ?>",
         data: {
            from_date,
            to_date,
            bnd_colour,
            bnd_no,
         },
         dataType: "JSON",
         success: function(data) {
            if (data != '') {

               $.each(data, function (i, item) {

                  $('#modal_body_contant').append(` 
              <tr>
              <td>`+ item.bm_addedon +`</td>
              <td>`+ item.m_hq_name +`</td>
              <td>`+ item.m_band_nostart +` - `+ item.m_band_noend+`</td>
              <td>`+ item.m_band_total +`</td>
              <td>`+ item.bm_used +`</td>
              <td>`+ item.bm_stock +`</td>
              <td>`+ item.bm_chk_stk +`</td>
              <td>`+ item.bm_remark +`</td>
              </tr>
               `);

                });

               $('#band_maintainance_list').modal('show');
            }else {
               swal("No data found! please try again", {
               icon: "error",
               timer: 2000,
            });
            }
         },
         error: function(jqXHR, status, err) {

            swal("Some Problem Occurred!! please try again", {
               icon: "error",
               timer: 2000,
            });
         }
      });

   }
</script>