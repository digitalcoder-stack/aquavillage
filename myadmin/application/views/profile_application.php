<!-- =========================View==============Fix========== -->

<!-- ========================Header==============Fix========= --> 
<?php $this->view('top_header') ?>
<!-- =======================/Header==============Fix========= -->

<!-- =========================View===============Fix========= -->
  <!-- Right Side Content Start -->
    <div class="page-content">
      <div class="container-fluid">
<!-- ========================/View===============Fix========= -->

<!-- ======================Page Style======================== -->
<style type="text/css">

.box {
    margin-top: 12px;
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}

.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;
}

.tabcontent {
    float: left;
    width: 73%;
    height: auto;
    border: 1px solid lightgrey;
    background-color: white;
}

.box.box-info {
    border-top-color: #00c0ef;
}

</style>
<style type="text/css">


  /* Style the tab */
.tab {
  float: left;
    border: 1px solid #ccc;
    width: 25%;
    margin: 0px 6px
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
    background-color: inherit;
    color: #464646;
    padding: 12px 15px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 14px;
    border-bottom: 1px solid #e0e0e0;
}


/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #1250b7;
  color: white;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #1250b7;
  color: white;
  border-bottom: 1px solid white;
}

/* Style the tab content */
.tabcontent {
  float: left;
  width: 73%;
  height: auto;
  border: 1px solid lightgrey;
 
}

.tab_title {
  border-bottom: 1px solid lightgrey;
    padding: 8px;
    margin: 0px;
}


.form-horizontal .control-label {
  text-align: left;
  padding-left: 3em;
}
button.update {
  border-radius: 100px;
    box-shadow: inset 1px -7px 21px 7px #2654d9;
    transition: 0.5s;
    background: #06356f;
}

.ico-upload > input {
 display: none;
}

.upload-icon  {
 color: #f1e5e6;
    background-color: #d3394c;
    width: auto;
    padding: 10px;
    cursor: pointer;
    width: 100%;
    text-align: center;
    margin-top: 1em;
}

.iconic {
  width: 100%;
    margin-right: auto;
    margin-left: auto;
    display: block;
    max-width: 70%;
}
.system_title {
  text-align: center;
}

small {
  font-size: 12px;
    margin-left: auto;
    margin-right: auto;
    display: block;
    margin-top: 2px;
    text-align: center;
}


</style>
  
<!-- =====================/Page Style======================== -->

<!-- ======================Page Title======================== -->
<!-- Breadcromb Row Start -->
<div class="row">
  <div class="col-md-12">
     <div class="breadcromb-area">
        <div class="row">
           <div class="col-md-6  col-sm-6">
              <div class="seipkon-breadcromb-left">
                 <h3>Application Setting</h3>
              </div>
           </div>
           <div class="col-md-3 col-sm-3 pull-right">
              <div class="seipkon-breadcromb-right">
                 <div class="seipkon-breadcromb-right">
                 </div>
              </div>
           </div>
        </div>
     </div>
  </div>
</div>
<!-- End Breadcromb Row -->
<!-- =====================/Page Title======================== -->

<!-- =====================Page Content======================= -->
<div class="row"><!-- Advance Form Row Start -->
  <div class="col-md-12">






               <div class="box" style="min-height: 500px;">

                 

                  <!-- /.box-header -->

                  <div class="box-body">


                  <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'General')" id="defaultOpen">General Settings</button>
        <button class="tablinks" onclick="openCity(event, 'Visual')"  >Visual Settings</button>
        <button class="tablinks" onclick="openCity(event, 'SocialMedia')">Social Media Settings</button>
        <button class="tablinks" onclick="openCity(event, 'SEO')">SEO Settings</button>
        <button class="tablinks" onclick="openCity(event, 'Email')">Email Settings</button>
        <button class="tablinks" onclick="openCity(event, 'SMS')">SMS Settings</button>
        <button class="tablinks" onclick="openCity(event, 'Notification')">Notification Settings</button>
        <button class="tablinks" onclick="openCity(event, 'Payment')">Payment Settings</button>

      </div>

      <div id="General" class="tabcontent">
         <div  class="box-header with-border">
                    <h3 class="box-title">General Settings</h3>
                  </div>
                <!-- Horizontal Form -->
                <div style="box-shadow:none;" class="box box-info">
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form method="post" class="form-horizontal frm-update-appdetails">
                    <div class="box-body">

                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Date Format</label>

                        <div class="col-sm-9">
      <?php
      $ary_vl = get_settings('app_date_format');
      $vl_ary = array(
        'DD/MM/YY' => "DD/MM/YY", 
        'DD-MM-YY' => "DD-MM-YY", 
        'MM/DD/YY' => "MM/DD/YY", 
        'MM-DD-YY' => "MM-DD-YY", 
      );
      ?>
      <select class="form-control" name="app_date_format">
        <option value="" style="display: none;"> - - - Select Format - - - </option>
        <?php if (!empty($vl_ary)) { foreach ($vl_ary as $i => $vl) {
          echo '<option value="'.$i.'"'; 
          if($ary_vl == $i) echo " selected";
          echo'>'.$vl.'</option>';
        }} ?>
      </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Time Format</label>

                        <div class="col-sm-9">
                            <select class="form-control" name="app_time_format">
                            <option value="" style="display: none;"> - - Select Format - - </option>
                            <option value="12 Hours" <?php echo get_settings('app_time_format') == '12 Hours'?'selected':'' ?>>12 Hours</option>
                            <option value="24 Hours" <?php echo get_settings('app_time_format') == '24 Hours'?'selected':'' ?>>24 Hours</option>

                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Time Zone</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Time Zone" name="app_time_zone" value="<?php echo get_settings('app_time_zone') ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Application Name</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="app_name" placeholder="Application Name" value="<?php echo get_settings('app_name') ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Address</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Address" name="app_address" value="<?php echo get_settings('app_address') ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Email</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_email" class="form-control" placeholder="Email" value="<?php echo get_settings('app_email') ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Mobile</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_phone" class="form-control" placeholder="Mobile" value="<?php echo get_settings('app_phone') ?>">
                        </div>
                      </div>


                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Alternate Mobile</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_alt_phone" class="form-control" placeholder="Alternate Mobile" value="<?php echo get_settings('app_alt_phone') ?>">
                        </div>
                      </div>

                      <div class="form-group">
                    <div class="col-sm-12">

                    <button type="submit" class="btn btn-info update pull-right btn-update-appdetails">Update Setting</button>
                    </div>
                      </div>
                                    
                    </div>

                    <!-- /.box-body -->
                   
                    
                    
                    <!-- /.box-footer -->
                  </form>
                </div>
                <!-- /.box -->
                
      </div>

      <div id="Visual" class="tabcontent">
          <div  class="box-header with-border">
                    <h3 class="box-title">Visual Settings</h3>
                  </div>
                <!-- Horizontal Form -->
                <div style="box-shadow:none;" class="box box-info">
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form class="frm-update-appdetails" method="post" action="#">
                    <div class="box-body">
                      <div class="form-group col-sm-3">
                        <label  class="col-sm-12 control-label system_title ">App Icon</label>
                        <?php 

      $img_link  = "https://upload.wikimedia.org/wikipedia/en/6/60/No_Picture.jpg";
      $img_title = get_settings('app_favicon');
      if (!empty($img_title)) { if(file_exists('../uploads/'.$img_title)){
        $img_link = base_url('../uploads/').$img_title;
      } }
      echo '<img class="iconic" src="'.$img_link.'" data-src="'.$img_link.'"  id="imgicon1">';

                        ?>
                          <small style="text-align: center;">Preferred Icon Size 32*32</small>

                      <div class="col-sm-12 ico-upload">
                        <label for="upload-icon" class="upload-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" fill="#fff" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                        <span>Change</span>
                        </label>
  <input type="file" id="upload-icon" onchange="PreviewImage(this.id)" class="form-control" placeholder="App Icon" name="app_favicon" data-id="imgicon1">
  <input type="hidden" name="app_pfavicon" value="<?php echo get_settings('app_favicon')  ?>">
                         
                         
                        </div>
                        
                      </div>


                      <div class="form-group col-sm-3">
                        <label  class="col-sm-12 control-label system_title">App Logo</label>
                         <?php 

      $img_link  = "https://upload.wikimedia.org/wikipedia/en/6/60/No_Picture.jpg";
      $img_title = get_settings('app_logo');
      if (!empty($img_title)) { if(file_exists('../uploads/'.$img_title)){
        $img_link = base_url('../uploads/').$img_title;
      } }
      echo '<img class="iconic" src="'.$img_link.'" data-src="'.$img_link.'"  id="imgicon2">';

                        ?>
                         <small>Preferred Icon Size 32*32</small>
                      <div class="col-sm-12 ico-upload">
                        <label for="upload-icon2" class="upload-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" fill="#fff" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                        <span>Change</span>
                        </label>
  <input type="file" id="upload-icon2" class="form-control" placeholder="App Icon" name="app_logo" onchange="PreviewImage(this.id)" data-id="imgicon2">
  <input type="hidden" name="app_plogo" value="<?php echo get_settings('app_logo')  ?>">
                         
                        </div>
                        
                      </div>


                       <div class="form-group col-sm-3">
                        <label  class="col-sm-12 control-label system_title">Footer Logo</label>

                        <?php 
      $img_link  = "https://upload.wikimedia.org/wikipedia/en/6/60/No_Picture.jpg";
      $img_title = get_settings('app_footer_logo');
      if (!empty($img_title)) { if(file_exists('../uploads/'.$img_title)){
        $img_link = base_url('../uploads/').$img_title;
      } }
      echo '<img class="iconic" src="'.$img_link.'" data-src="'.$img_link.'"  id="imgicon3">';
                        ?>
                       <small>Preferred Icon Size 32*32</small>

                      <div class="col-sm-12 ico-upload">
                        <label for="upload-icon3" class="upload-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" fill="#fff" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                        <span>Change</span>
                        </label>
  <input type="file" id="upload-icon3" class="form-control" placeholder="App Icon" name="app_footer_logo" onchange="PreviewImage(this.id)" data-id="imgicon3">
  <input type="hidden" name="app_footer_plogo" value="<?php echo get_settings('app_footer_logo')  ?>">
                         
                         
                           
                          
                        </div>
                        
                      </div>

                       <div class="form-group col-sm-3">
                        <label  class="col-sm-12 control-label system_title">Mobile Logo</label>

                      <?php 
      $img_link  = "https://upload.wikimedia.org/wikipedia/en/6/60/No_Picture.jpg";
      $img_title = get_settings('app_mobile_logo');
      if (!empty($img_title)) { if(file_exists('../uploads/'.$img_title)){
        $img_link = base_url('../uploads/').$img_title;
      } }
      echo '<img class="iconic" src="'.$img_link.'" data-src="'.$img_link.'"  id="imgicon4">';
                      ?>
                       <small>Preferred Icon Size 32*32</small>

                      <div class="col-sm-12 ico-upload">
                        <label for="upload-icon4" class="upload-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" fill="#fff" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                        <span>Change</span>
                        </label>
  <input type="file" id="upload-icon4" class="form-control" placeholder="App Icon" name="app_mobile_logo" onchange="PreviewImage(this.id)" data-id="imgicon4">
  <input type="hidden" name="app_mobile_plogo" value="<?php echo get_settings('app_mobile_logo')  ?>">
                         
                        
                        </div>
                        
                      </div>



                     
                      <div class="form-group">
                    <div class="col-sm-12">

                    <button type="submit" class="btn btn-info update pull-right btn-update-appdetails">Update Setting</button>
                    </div>
                      </div>
                                    
                    </div>

                    <!-- /.box-body -->
                   
                    
                    
                    <!-- /.box-footer -->
                  </form>
                </div>
                <!-- /.box -->
               
      </div>



      <div id="SocialMedia" class="tabcontent">
          <div  class="box-header with-border">
                    <h3 class="box-title">Social Media Settings</h3>
                  </div>
                <!-- Horizontal Form -->
                <div style="box-shadow:none;" class="box box-info">
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form action="#" class="form-horizontal frm-update-appdetails">
                    <div class="box-body">
                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Facebook Url</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="app_facebook_link" placeholder="Facebook Url" value="<?php echo get_settings('app_facebook_link') ?>">
                        </div>
                      </div>


                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Instagram Url</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="app_instagram_link" placeholder="Instagram Url" value="<?php echo get_settings('app_instagram_link') ?>">
                        </div>
                      </div>


                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Twitter Url</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_twitter_link" class="form-control" placeholder="Twitter Url" value="<?php echo get_settings('app_twitter_link') ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Youtube Url</label>

                        <div class="col-sm-9">
                          <input name="app_youtube_link" type="text" class="form-control" placeholder="Youtube Url" value="<?php echo get_settings('app_youtube_link') ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Website Url</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_website_url" class="form-control" placeholder="Website Url" value="<?php echo get_settings('app_website_url') ?>">
                        </div>
                      </div>


                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Playstore Url</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_download_android" class="form-control" placeholder="Playstore Url"  value="<?php echo get_settings('app_download_android') ?>">
                        </div>
                      </div>


                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Appstore Url</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_download_ios" class="form-control" placeholder="Appstore Url" value="<?php echo get_settings('app_download_ios') ?>">
                        </div>
                      </div>

                      



                      <div class="form-group">
                    <div class="col-sm-12">

                    <button type="submit" class="btn btn-info update pull-right btn-update-appdetails">Update Setting</button>
                    </div>
                      </div>
                                    
                    </div>

                    <!-- /.box-body -->
                   
                    
                    
                    <!-- /.box-footer -->
                  </form>
                </div>
                <!-- /.box -->
               
      </div>

      <div id="SEO" class="tabcontent">
         <div  class="box-header with-border">
                    <h3 class="box-title">SEO Settings</h3>
                  </div>
                <!-- Horizontal Form -->
                <div style="box-shadow:none;" class="box box-info">
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form class="form-horizontal frm-update-appdetails">
                    <div class="box-body">
                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Application Title</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_title" class="form-control" placeholder="Application Title" value="<?php echo get_settings('app_title') ?>">
                        </div>
                      </div>



                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Application Keywords</label>

                        <div class="col-sm-9">
                          <textarea type="text" name="app_keyword" class="form-control" placeholder="Application Keywords"><?php echo get_settings('app_keyword') ?></textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Description</label>

                        <div class="col-sm-9">
                           <textarea type="text" name="app_description" class="form-control" placeholder="Application Description"><?php echo get_settings('app_description') ?></textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Author</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_author" class="form-control" placeholder="Author" value="<?php echo get_settings('app_author') ?>">
                        </div>
                      </div>

                        <div class="form-group">
                        <label  class="col-sm-3 control-label">Google Recaptcha</label>

                        <div class="col-sm-9">
      <?php
      $ary_vl = get_settings('app_google_recaptcha');
      $vl_ary = array(
        'Enable' => "Enable", 
        'Disable' => "Disable"
      );
      ?>
      <select class="form-control" name="app_google_recaptcha">
        <option value="" style="display: none;"> - - - Select Format - - - </option>
        <?php if (!empty($vl_ary)) { foreach ($vl_ary as $i => $vl) {
          echo '<option value="'.$i.'"'; 
          if($ary_vl == $i) echo " selected";
          echo'>'.$vl.'</option>';
        }} ?>
      </select>
                        
                        </div>
                      </div>

                        <div class="form-group">
                        <label  class="col-sm-3 control-label">Recaptcha Key</label>

                        <div class="col-sm-9">
                           <input type="text" name="app_google_recaptcha_key" class="form-control" placeholder="Recaptcha Key" value="<?php echo get_settings('app_google_recaptcha_key') ?>">
                        </div>
                      </div>

                 
                        <div class="form-group">
                        <label  class="col-sm-3 control-label">Recaptcha Key Secret</label>

                        <div class="col-sm-9">
                           <input type="text" name="app_google_recaptcha_secret" class="form-control" placeholder="Recaptcha Key Secret" value="<?php echo get_settings('app_google_recaptcha_secret') ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Google Analytics Code</label>

                        <div class="col-sm-9">
                           <textarea type="text" name="app_google_analyticscode" class="form-control" placeholder="Google Analytics Code"></textarea>
                        </div>
                      </div>


                    
                      <div class="form-group">
                    <div class="col-sm-12">

                    <button type="submit" class="btn btn-info update pull-right btn-update-appdetails">Update Setting</button>
                    </div>
                      </div>
                                    
                    </div>

                    <!-- /.box-body -->
                   
                    
                    
                    <!-- /.box-footer -->
                  </form>
                </div>
                <!-- /.box -->
      </div>



      <div id="Email" class="tabcontent">
         <div  class="box-header with-border">
                    <h3 class="box-title">Email Settings</h3>
                  </div>
                <!-- Horizontal Form -->
                <div style="box-shadow:none;" class="box box-info">
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form class="form-horizontal frm-update-appdetails" method="post" action="#">
                    <div class="box-body">
                      <div class="form-group">
                        <label  class="col-sm-3 control-label">SMTP Host</label>

                        <div class="col-sm-9">
                          <input name="app_smtp_host" type="text" class="form-control" placeholder="SMTP Host" value="<?php echo get_settings('app_smtp_host') ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-3 control-label">SMTP Username</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_smtp_user" class="form-control" placeholder="SMTP Username" value="<?php echo get_settings('app_smtp_user') ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-3 control-label">SMTP Password</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="SMTP Password" name="app_smtp_password" value="<?php echo get_settings('app_smtp_password') ?>"> 
                        </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-3 control-label">SMTP Port</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_smtp_port" class="form-control" placeholder="SMTP Port" value="<?php echo get_settings('app_smtp_port') ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label  class="col-sm-3 control-label">Mail Encryption</label>

                        <div class="col-sm-9">
      <?php
      $ary_vl = get_settings('app_mail_encryption');
      $vl_ary = array(
        'TLS' => "TLS", 
        'SSL' => "SSL", 
        'None'=> "None"
      );
      ?>
      <select class="form-control" name="app_mail_encryption">
        <option value="" style="display: none;"> - - - Select Format - - - </option>
        <?php if (!empty($vl_ary)) { foreach ($vl_ary as $i => $vl) {
          echo '<option value="'.$i.'"'; 
          if($ary_vl == $i) echo " selected";
          echo'>'.$vl.'</option>';
        }} ?>
      </select>
                        </div>
                      </div>

                        <div class="form-group">
                        <label  class="col-sm-3 control-label">Mail From Name</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_mail_fromname" class="form-control" placeholder="Mail From Name" value="<?php echo get_settings('app_mail_fromname') ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Mail From Email</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_mail_fromemail" class="form-control" placeholder="Mail From Email" value="<?php echo get_settings('app_mail_fromemail') ?>">
                        </div>
                      </div>
                     

                      <div class="form-group">
                    <div class="col-sm-12">

                    <button type="submit" class="btn btn-info update pull-right btn-update-appdetails">Update Setting</button>
                    </div>
                      </div>
                                    
                    </div>

                    <!-- /.box-body -->
                   
                    
                    
                    <!-- /.box-footer -->
                  </form>
                </div>
                <!-- /.box -->
      </div>


      <div id="SMS" class="tabcontent">
         <div  class="box-header with-border">
                    <h3 class="box-title">SMS Settings</h3>
                  </div>
                <!-- Horizontal Form -->
                <div style="box-shadow:none;" class="box box-info">
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form action="#" class="form-horizontal frm-update-appdetails">
                    <div class="box-body">
                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Msg 91 API Url</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="API Url" name="app_sms_url" value="<?php echo get_settings('app_sms_url') ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Msg 91 API Key</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_sms_key" class="form-control" placeholder="API Key" value="<?php echo get_settings('app_sms_key') ?>">
                        </div>
                      </div>

                          <div class="form-group">
                        <label  class="col-sm-3 control-label">Msg 91 Sender ID</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_sms_sender" class="form-control" placeholder="Sender ID" value="<?php echo get_settings('app_sms_sender') ?>">
                        </div>
                      </div>


                      

                      <div class="form-group">
                    <div class="col-sm-12">

                    <button type="submit" class="btn btn-info update pull-right btn-update-appdetails">Update Setting</button>
                    </div>
                      </div>
                                    
                    </div>

                    <!-- /.box-body -->
                   
                    
                    
                    <!-- /.box-footer -->
                  </form>
                </div>
                <!-- /.box -->
      </div>


      <div id="Notification" class="tabcontent">
         <div  class="box-header with-border">
                    <h3 class="box-title">Notification Settings</h3>
                  </div>
                <!-- Horizontal Form -->
                <div style="box-shadow:none;" class="box box-info">
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form method="post" action="#" class="form-horizontal frm-update-appdetails">
                    <div class="box-body">
                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Sys Language</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_language" class="form-control" placeholder="Sys Language" value="<?php echo get_settings('app_language') ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Sys Name</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_name" class="form-control" placeholder="App Link Name" value="<?php echo get_settings('app_name') ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Sys Title</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_title" class="form-control" placeholder="Sys Title" value="<?php echo get_settings('app_title') ?>">
                        </div>
                      </div>

                      <div class="form-group">
                    <div class="col-sm-12">

                    <button type="submit" class="btn btn-info update pull-right btn-update-appdetails">Update Setting</button>
                    </div>
                      </div>
                                    
                    </div>

                    <!-- /.box-body -->
                   
                    
                    
                    <!-- /.box-footer -->
                  </form>
                </div>
                <!-- /.box -->
      </div>


      <div id="Payment" class="tabcontent">
         <div  class="box-header with-border">
                    <h3 class="box-title">Payment Settings</h3>
                  </div>
                <!-- Horizontal Form -->
                <div style="box-shadow:none;" class="box box-info">
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form class="form-horizontal frm-update-appdetails" action="#" method="post">
                    <div class="box-body">
                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Online Payment</label>

                        <div class="col-sm-9">
                         <select class="form-control" name="app_online_payment">
                          <option value="Active" <?php echo (get_settings('app_isonline') == 'Active'?'selected':'') ?>>Active</option>
                          <option value="Inactive" <?php echo (get_settings('app_isonline') == 'Inactive'?'selected':'') ?>>Inactive</option>
                        </select>
                         
                        </div>
                      </div>


                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Razorpay Key</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_rozarpay_key_id" class="form-control" placeholder="Razorpay Key" value="<?php echo get_settings('app_rozarpay_key_id') ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Razorpay Secret</label>

                        <div class="col-sm-9">
                          <input type="text" name="app_rozarpay_key_secret" class="form-control" placeholder="Razorpay Secret" value="<?php echo get_settings('app_rozarpay_key_secret') ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label  class="col-sm-3 control-label">Gateway Status</label>

                        <div class="col-sm-9">
                        <select class="form-control" name="app_gateway_status">
                          <option value="Test Mode" <?php echo (get_settings('app_gateway_status') == 'Test Mode'?'selected':'') ?>>Test Mode</option>
                          <option value="Live Mode" <?php echo (get_settings('app_gateway_status') == 'Live Mode'?'selected':'') ?>>Live Mode</option>
                        </select>
                      </div>
                      </div>

                      <div class="form-group">
                    <div class="col-sm-12">

                    <button type="submit" class="btn btn-info update pull-right btn-update-appdetails">Update Setting</button>
                    </div>
                      </div>
                                    
                    </div>

                    <!-- /.box-body -->
                    
                    <!-- /.box-footer -->
                  </form>
                </div>
                <!-- /.box -->
      </div>







          </div>

        </div>





    </div>
</div><!-- End Advance Form Row -->
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
<?php $this->view('js/profile_js'); ?>
<script type="text/javascript">

function PreviewImage(id){ var img_in = $('#'+id);

  if(img_in.val() ==''){ 
    document.getElementById(img_in.data('id')).src = $('#'+img_in.data('id')).data('src'); 
    return;
  }

  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById(id).files[0]);

  oFReader.onload = function (oFREvent) {
    document.getElementById(img_in.data('id')).src = oFREvent.target.result;
  };
}

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<!-- ========================Script========================== -->
   