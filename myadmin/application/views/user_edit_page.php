<!-- =========================View==============Fix========== -->

<!-- ========================Header==============Fix========= --> 
<?php $this->view('top_header') ?>
<!-- =======================/Header==============Fix========= -->

<!-- =========================View===============Fix========= -->
  <div class="page-content"> <div class="container-fluid">
<!-- ========================/View===============Fix========= -->

<!-- ======================Page Title======================== -->
<!-- Breadcromb Row Start -->
<div class="row">
   <div class="col-md-12">
      <div class="breadcromb-area">
         <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="seipkon-breadcromb-left">
                <h3>Edit User</h3>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 pull-right">
              <div class="seipkon-breadcromb-right">
                <a href="<?php echo site_url('User'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> List </a>
                <a href="<?php echo site_url('User/details?id=').$a_value[0]->m_user_id; ?>" class="btn btn-success btn-vsm"><i class="fa fa-eye"></i> Details </a>
              </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Breadcromb Row -->
<!-- =====================/Page Title======================== -->

<!-- =====================Page Content======================= -->
<!-- View Counselor Area Start -->
<div class="row">
  <div class="col-md-12">
    <div class="page-box">

      <div class="form-example">
        <div class="form-wrap top-label-exapmple form-layout-page">
<form method="post" action="#" id="frm-update-user">
  <input type="hidden" name="m_user_id" id="m_user_id" value="<?php echo $a_value[0]->m_user_id; ?>">
          <div class="row">
            <div class="col-md-4">

              <div class="form-group">
                <label>Full Name</label>
  <input type="text" name="m_user_name" id="m_user_name" class="form-control" placeholder="Enter Full Name" autofocus="true" value="<?php echo $a_value[0]->m_user_name; ?>">
              </div>

            </div>
            <div class="col-md-4">

              <div class="form-group">
                <label>First Name</label>
  <input type="text" name="m_user_fname" id="m_user_fname" class="form-control" placeholder="Enter First Name" value="<?php echo $a_value[0]->m_user_fname; ?>">
              </div>

            </div>
            <div class="col-md-4">

              <div class="form-group">
                <label>Last Name</label>
  <input type="text" name="m_user_lname" id="m_user_lname" class="form-control" placeholder="Enter Last Name" value="<?php echo $a_value[0]->m_user_lname; ?>">
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-4">

              <div class="form-group">
                <label>User Email</label>
  <input type="email" name="m_user_email" id="m_user_email" class="form-control" placeholder="Enter User Email" value="<?php echo $a_value[0]->m_user_email; ?>">
              </div>

            </div>
            <div class="col-md-4">

              <div class="form-group">
                <label>User Mobile</label>
  <input name="m_user_mobile" id="m_user_mobile" class="form-control" placeholder="Enter User Mobile" value="<?php echo $a_value[0]->m_user_mobile; ?>" maxlength = "10" 
    type="text" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
              </div>

            </div>
            <div class="col-md-4">

                <label>Picture</label>
  <input type="hidden" name="m_user_ppic" value="<?php echo $a_value[0]->m_user_pic; ?>">
  <br><div class="product-upload btn btn-info btn-block" title="Select File">
    <p style="padding-top: 3px; padding-bottom: 3px;">
      <i class="fas fa-file-upload"></i>
      Select File
    </p>
    <input type="file" accept="image/*" name="m_user_pic" id="m_user_pic" onchange="ImageAction(this);">
  </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-4">

              <div class="form-group">
                <label>User About</label>
  <textarea class="form-control" name="m_user_about" id="m_user_about" placeholder="Enter User Address"><?php echo $a_value[0]->m_user_about; ?></textarea>
              </div>

            </div>
            <div class="col-md-8">

              <div class="form-group">
                <label>User Address</label>
  <textarea class="form-control" name="m_user_address" id="m_user_address" placeholder="Enter User Address"><?php echo $a_value[0]->m_user_address; ?></textarea>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-4">

              <div class="form-group">
                <label>Date Of Birth</label>

  <input name="m_user_dob" id="m_user_dob" class="form-control" title="Enter User Date Of Birth" value="<?php echo $a_value[0]->m_user_dob; ?>"    type="date"  onkeypress="return false">
              </div>

              <div class="form-group">
                <label>Gender</label>
  <select name="m_user_gender" id="m_user_gender" class="form-control" title="Select Gender">
    <option value="Male" <?php if($a_value[0]->m_user_gender == "Male") echo "selected"; ?>>Male</option>
    <option value="Female" <?php if($a_value[0]->m_user_gender == "Female") echo "selected"; ?>>Female</option>
    <option value="Other" <?php if($a_value[0]->m_user_gender == "Other") echo "selected"; ?>>Other</option>
  </select>
              </div>

              <div class="form-group">
                <label>Select City</label>
  <select class="form-control select2" name="m_user_city" id="m_user_city" title="Select City">
    <?php echo '<option value="">- - Select - -</option>';
    if (!empty($city_list)) { foreach ($city_list as $r) {
      echo '<option value="'.$r->m_city_id.'"'; 
      if($a_value[0]->m_user_city == $r->m_city_id) echo " selected";
      echo '>'.$r->mcity_name.'</option>';
    }} ?>
  </select>
              </div>

              <div class="form-group">
                <label>Status</label>
  <select name="m_user_status" id="m_user_status" class="form-control" title="Select Status">
    <option value="2" <?php if($a_value[0]->m_user_status != 1) echo "selected"; ?>>Blocked</option>
    <option value="1" <?php if($a_value[0]->m_user_status == 1) echo "selected"; ?>>Active</option>
  </select>
              </div>

            </div>
            <div class="col-md-8">
                              <h4 class="heading">Social Details</h4>
              <div class="form-wrap input-form-mask">

                <div class="form-group">
                   <div class="row">
                      <div class="col-md-2 col-sm-2 text-left">
                         <label class="control-label" for="dateMask">FaceBook : </label>
                      </div>
                      <div class="col-md-8 col-sm-8">
                         <div class="input-group">
                            <div class="input-group-addon">
                               <i class="fa fa-facebook-square"></i>
                            </div>
<input type="text" name="m_user_fb" id="m_user_fb" class="form-control" value="<?php echo $a_value[0]->m_user_fb; ?>">
                         </div>
                      </div>
                   </div>
                </div>

                <div class="form-group">
                   <div class="row">
                      <div class="col-md-2 col-sm-2 text-left">
                         <label class="control-label" for="dateMask">Twitter : </label>
                      </div>
                      <div class="col-md-8 col-sm-8">
                         <div class="input-group">
                            <div class="input-group-addon">
                               <i class="fa fa-twitter-square"></i>
                            </div>
<input type="text" name="m_user_twitter" id="m_user_twitter" class="form-control" value="<?php echo $a_value[0]->m_user_twitter; ?>">
                         </div>
                      </div>
                   </div>
                </div>

                <div class="form-group">
                   <div class="row">
                      <div class="col-md-2 col-sm-2 text-left">
                         <label class="control-label" for="dateMask">Instagram : </label>
                      </div>
                      <div class="col-md-8 col-sm-8">
                         <div class="input-group">
                            <div class="input-group-addon">
                               <i class="fa fa-instagram"></i>
                            </div>
<input type="text" name="m_user_insta" id="m_user_insta" class="form-control" value="<?php echo $a_value[0]->m_user_insta; ?>">
                         </div>
                      </div>
                   </div>
                </div>

                <div class="form-group">
                   <div class="row">
                      <div class="col-md-2 col-sm-2 text-left">
                         <label class="control-label" for="dateMask">YouTube : </label>
                      </div>
                      <div class="col-md-8 col-sm-8">
                         <div class="input-group">
                            <div class="input-group-addon">
                               <i class="fa fa-youtube"></i>
                            </div>
<input type="text" name="m_user_youtube" id="m_user_youtube" class="form-control" value="<?php echo $a_value[0]->m_user_youtube; ?>">
                         </div>
                      </div>
                   </div>
                </div>

                <div class="form-group">
                   <div class="row">
                      <div class="col-md-2 col-sm-2 text-left">
                         <label class="control-label" for="dateMask">Linkedin : </label>
                      </div>
                      <div class="col-md-8 col-sm-8">
                         <div class="input-group">
                            <div class="input-group-addon">
                               <i class="fa fa-linkedin"></i>
                            </div>
<input type="text" name="m_user_linkedin" id="m_user_linkedin" class="form-control" value="<?php echo $a_value[0]->m_user_linkedin; ?>">
                         </div>
                      </div>
                   </div>
                </div>

                <div class="form-group">
                   <div class="row">
                      <div class="col-md-2 col-sm-2 text-left">
                         <label class="control-label" for="dateMask">Telegram : </label>
                      </div>
                      <div class="col-md-8 col-sm-8">
                         <div class="input-group">
                            <div class="input-group-addon">
                               <i class="fa fa-telegram"></i>
                            </div>
<input type="text" name="m_user_telegram" id="m_user_telegram" class="form-control" value="<?php echo $a_value[0]->m_user_telegram; ?>">
                         </div>
                      </div>
                   </div>
                </div>

                <div class="form-group">
                   <div class="row">
                      <div class="col-md-2 col-sm-2 text-left">
                         <label class="control-label" for="dateMask">WhatsApp : </label>
                      </div>
                      <div class="col-md-8 col-sm-8">
                         <div class="input-group">
                            <div class="input-group-addon">
                               <i class="fa fa-whatsapp"></i>
                            </div>
<input type="text" name="m_user_whatsapp" id="m_user_whatsapp" class="form-control" value="<?php echo $a_value[0]->m_user_whatsapp; ?>">
                         </div>
                      </div>
                   </div>
                </div>

              </div>
            </div>
          </div>




          <div class="row">
            <div class="col-md-6">

              <div class="form-layout-submit">
 <button type="submit" id="btn-update-user" class="btn btn-block btn-info">Update</button>
              </div>

            </div>
            <div class="col-md-6">

              <div class="form-layout-submit">
                <a href="<?php echo site_url('User'); ?>" class="btn btn-block btn-danger">Cancel</a>
              </div>

            </div>
          </div>
</form>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- View Counselor Area End -->
<!-- ====================/Page Content======================= -->

<!-- =========================View=================Fix======= -->
  </div></div>
<!-- ========================/View=================Fix======= -->

<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer'); $this->view('js/user_js'); ?>
<!-- =======================/Footer================Fix======= -->