<!-- =========================View==============Fix========== -->

<!-- ========================Header==============Fix========= -->
<?php $this->view('top_header') ?>
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
                        <h3><?= $pagename ?></h3>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 pull-right">
                     <div class="seipkon-breadcromb-right">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- End Breadcromb Row -->
      <!-- =====================/Page Title======================== -->

      <!-- =====================Page Content======================= -->

      <?php if (!empty($user_dtl)) {
         $id = $user_dtl->m_admin_id;
         $name = $user_dtl->m_admin_name;
         $email = $user_dtl->m_admin_email;
         $login_id = $user_dtl->m_admin_login_id;
         $pass = $user_dtl->m_admin_pass;
         $contact = $user_dtl->m_admin_contact;
         $img = $user_dtl->m_admin_img;
         $admin_type = $user_dtl->m_admin_type;
         $admin_role = $user_dtl->m_admin_branch;
         $login_allowed = $user_dtl->m_admin_login_allowed;
      } else {
         $id = '';
         $name = '';
         $email = '';
         $login_id = '';
         $pass = '';
         $contact = '';
         $img = '';
         $admin_type = '';
         $admin_role = '';
         $login_allowed = '';
      } ?>


      <!-- Advance Form Row Start -->
      <form method="post" action="#" id="frm-update-profile">
         <div class="row">
            <div class="col-md-6">
               <div class="page-box">
                  <div class="form-example">
                     <h3>Details</h3>
                     <div class="form-wrap input-form-mask">

                        <?php if ($this->session->userdata('user_type') == 1) { ?>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-4 col-sm-4 text-left">
                                    <label class="control-label" for="dateMask">User Type : </label>
                                 </div>
                                 <div class="col-md-8 col-sm-8">
                                    <div class="input-group">
                                       <div class="input-group-addon">
                                          <i class="fa fa-user"></i>
                                       </div>
                                       <select name="m_admin_type" id="m_admin_type" class="form-control select2" required>
                                          <option value="1" <?php if ($admin_type == 1) {
                                                               echo 'selected';
                                                            } ?>>Super Admin</option>
                                          <option value="2" <?php if ($admin_type == 2) {
                                                               echo 'selected';
                                                            } ?>>Admin</option>
                                          <option value="3" <?php if ($admin_type == 3) {
                                                               echo 'selected';
                                                            } ?>>Normal User</option>


                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        <?php } ?>

                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-4 col-sm-4 text-left">
                                 <label class="control-label" for="dateMask">User Department : </label>
                              </div>
                              <div class="col-md-8 col-sm-8">
                                 <div class="input-group">
                                    <div class="input-group-addon">
                                       <i class="fa fa-user"></i>
                                    </div>
                                    <select name="m_admin_branch" id="m_admin_branch" class="form-control select2" required>
                                       <?php
                                       foreach ($dept_value as $dkey) {
                                          if ($admin_role == $dkey->m_dept_id) {
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
                        </div>

                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-4 col-sm-4 text-left">
                                 <label class="control-label" for="dateMask">Name : </label>
                              </div>
                              <div class="col-md-8 col-sm-8">
                                 <div class="input-group">
                                    <div class="input-group-addon">
                                       <i class="fa fa-user"></i>
                                    </div>
                                    <input type="hidden" name="m_admin_id" id="m_admin_id" class="form-control" value="<?php echo $id; ?>">
                                    <input type="text" name="m_admin_name" id="m_admin_name" class="form-control" value="<?php echo $name; ?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- <div class="form-group">
                           <div class="row">
                              <div class="col-md-4 col-sm-4 text-left">
                                 <label class="control-label" for="aliasdateMask">Email : </label>
                              </div>
                              <div class="col-md-8 col-sm-8">
                                 <div class="input-group">
                                    <div class="input-group-addon">
                                       <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" name="m_admin_email" id="m_admin_email" class="form-control" value="<?php echo $email; ?>">
                                 </div>
                              </div>
                           </div>
                        </div> -->
                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-4 col-sm-4 text-left">
                                 <label class="control-label" for="aliasdateMask">Login Name: </label>
                              </div>
                              <div class="col-md-8 col-sm-8">
                                 <div class="input-group">
                                    <div class="input-group-addon">
                                       <i class="fa fa-lock"></i>
                                    </div>
                                    <input type="text" name="m_admin_login_id" id="m_admin_login_id" class="form-control" value="<?php echo $login_id; ?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php if (empty($id)) { ?>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-4 col-sm-4 text-left">
                                    <label class="control-label" for="phoneMask">Password : </label>
                                 </div>
                                 <div class="col-md-8 col-sm-8">
                                    <div class="input-group">
                                       <div class="input-group-addon">
                                          <i class="fa fa-lock"></i>
                                       </div>
                                       <input type="password" name="m_admin_pass" id="m_admin_pass" class="form-control" value="<?php echo $pass; ?>" required>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-4 col-sm-4 text-left">
                                    <label class="control-label" for="phoneMask">Re Password : </label>
                                 </div>
                                 <div class="col-md-8 col-sm-8">
                                    <div class="input-group">
                                       <div class="input-group-addon">
                                          <i class="fa fa-lock"></i>
                                       </div>
                                       <input type="password" id="m_admin_repass" class="form-control" value="<?php echo $pass; ?>">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        <?php } ?>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-4 col-sm-4 text-left">
                                 <label class="control-label" for="dateMask">Login Allowed : </label>
                              </div>
                              <div class="col-md-8 col-sm-8">
                                 <div class="input-group">
                                    <div class="input-group-addon">
                                       <i class="fa fa-user"></i>
                                    </div>
                                    <select name="m_admin_login_allowed" id="m_admin_login_allowed" class="form-control select2" required>
                                       <option value="1" <?php if ($login_allowed == 1) {
                                                            echo 'selected';
                                                         } ?>>Yes</option>
                                       <option value="2" <?php if ($login_allowed == 2) {
                                                            echo 'selected';
                                                         } ?>>No</option>


                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <!-- <div class="form-group">
                           <div class="row">
                              <div class="col-md-4 col-sm-4 text-left">
                                 <label class="control-label" for="serialMask">Contact Number : </label>
                              </div>
                              <div class="col-md-8 col-sm-8">
                                 <div class="input-group">
                                    <div class="input-group-addon">
                                       <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" name="m_admin_contact" id="m_admin_contact" class="form-control" value="<?php echo $contact; ?>">
                                 </div>
                              </div>
                           </div>
                        </div> -->

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <div class="form-layout-submit">
                                    <div class="row">
                                       <div class="col-md-2"></div>
                                       <div class="col-md-8">
                                          <button type="submit" class="btn btn-info btn-block" id="btn-update-profile"><?php if (!empty($id)) {
                                                                                                                           echo 'Update';
                                                                                                                        } else {
                                                                                                                           echo 'Submit';
                                                                                                                        } ?></button>
                                       </div>
                                       <div class="col-md-2"></div>

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>


                  </div>
               </div>
            </div>

            <div class="col-md-6">

               <?php
               $admin_img = base_url('assets/img/default-user0.png');
               if (!empty($img)) {
                  if (file_exists('uploads/' . $img)) {
                     $admin_img = base_url('uploads/') . $img;
                  }
               }
               ?>
               <div class="page-box">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-5 col-sm-5 text-right">
                           <img src="<?php echo $admin_img; ?>" class="img-circle" alt="Profile Picture" style="width: 95px; height: 95px;border: 1px solid #0000000a; border-radius: 50%;" id="myadminimg">
                        </div>
                        <div class="col-md-2 col-sm-2" style="text-align: center; padding-top: 8%;">
                           <span>
                              <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                           </span>
                        </div>
                        <div class="col-md-5 col-sm-5">
                           <img src="<?php echo $admin_img; ?>" class="img-circle" alt="Profile Picture" style="width: 95px; height: 95px;border: 1px solid #0000000a; border-radius: 50%;" id="uploadPreview">
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-4 col-sm-4 text-left">
                           <label class="control-label" for="serialMask"> </label>
                        </div>
                        <div class="col-md-8 col-sm-8">
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-image"></i>
                              </div>
                              <input type="hidden" name="pre_m_admin_img" value="<?php echo $img; ?>">
                              <button id="uploadImagebtn" class="btn btn-info" title="Only jpg,jpeg,png & gif files Allowed">Change Profile Picture (65 × 65)</button>
                              <input id="uploadImage" type="file" name="m_admin_img" onchange="PreviewImage();" style="display:none" accept="image/*">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </form>
      <!-- ====================/Page Content======================= -->

      <!-- =========================View=================Fix======= -->
      <!-- End Widget Row -->
   </div>
</div>
<!-- ========================/View=================Fix======= -->

<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer'); ?>
<!-- =======================/Footer================Fix======= -->

<!-- ========================Script========================== -->
<?php $this->view('js/profile_js') ?>
<script type="text/javascript">
   $("#uploadImagebtn").click(function() {
      $("#uploadImage").trigger('click');
      return false;
   });

   function PreviewImage() {
      var myadminimg = document.getElementById("myadminimg");
      var myuploadimg = $('#uploadImage').val();
      if (myuploadimg == '') {
         document.getElementById("uploadPreview").src = myadminimg.src;
      }

      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

      oFReader.onload = function(oFREvent) {
         document.getElementById("uploadPreview").src = oFREvent.target.result;
      };
   };
</script>
<!-- =======================/Script========================== -->