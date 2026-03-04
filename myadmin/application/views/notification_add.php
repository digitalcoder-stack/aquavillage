<!-- =========================View==============Fix========== -->

<!-- ========================Header==============Fix========= --> 
<?php $this->view('header') ?>
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
                <h3>Send Nofification</h3>
             </div>
          </div>
       </div>
    </div>
  </div>
</div>
<!-- End Breadcromb Row -->
<!-- =====================/Page Title======================== -->

<!-- =====================Page Content======================= -->
<!-- Add Product Area Start -->
<div class="row">
  <div class="col-md-12">
    <div class="page-box">
      <div class="form-example">
        <div class="form-wrap top-label-exapmple form-layout-page">
<form method="post" action="#" id="frm-add-notification">
          <div class="row">
            <div class="col-md-4">

              <div class="form-group">
                <label>Notification Title</label>
  <input type="text" name="notification_text" id="notification_text" class="form-control" placeholder="Enter Notification Title" autofocus="true">
              </div>

            </div>
            <div class="col-md-4">

              <div class="form-group">
                <label>Select User</label>
                <select name="notification_userid" id="notification_userid" class="form-control" title="Select User">
                  <option value="0">All User</option>

                   <?php
                      if(!empty($user_list))
                      {
                        foreach($user_list as $ulist)
                        {

                            echo "<option value='$ulist->kh_user_id'>$ulist->kh_user_fname</option>";
                        }

                      }

                      ?>

                 
                </select>
              </div>

            </div>
            <div class="col-md-4">

              <div class="form-group">
                <label>Notification Image</label>
                <br><div class="product-upload btn btn-info btn-block" title="Not Selected">
                  <p> <i class="fa fa-camera "></i> Notification Image</p>
                  <input type="file" name="notification_banner" id="notification_banner" onchange="ImageAction(this);" accept="image/*">
                </div>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-12">

              <div class="form-group">
                <label>Notification Description</label>

                <textarea class="form-control" name="notification_desc"></textarea>
   
              </div>

            </div>
            
          </div>
          <div class="row">
            <div class="col-md-6">

              <div class="form-layout-submit">
  <button type="submit" id="btn-add-notification" class="btn btn-block btn-info">Submit</button>
              </div>

            </div>
            <div class="col-md-6">

              <div class="form-layout-submit">
                <a href="<?php echo site_url('Notification') ?>" class="btn btn-block btn-danger">Cancel</a>
              </div>

            </div>
          </div>
</form>
        </div>
      </div>
    </div>
  </div>
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
<!-- =======================/Footer================Fix======= -->

<!-- ========================Script========================== -->
<?php $this->view('js/notification_js') ?>
<!-- ========================Script========================== -->