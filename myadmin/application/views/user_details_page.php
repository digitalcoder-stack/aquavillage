<!-- =========================View==============Fix========== -->

<!-- ========================Header==============Fix========= --> 
<?php $this->view('top_header') ?>
<!-- =======================/Header==============Fix========= -->

<style type="text/css">
  .widget_card_page img {
    border-radius: 100px;
  }

  .widget_card_page {
    box-shadow: 0px 10px 10px 20px rgba(176, 184, 214, 0.09), 10px 10px 15px -5px #b0b8d6;
    background-clip: border-box;
    border-radius: 8px;
  }

  .profile-left {
    box-shadow: 0px 10px 10px 20px rgba(176, 184, 214, 0.09), 10px 10px 15px -5px #b0b8d6;
    background-clip: border-box;
    border-radius: 8px;
  }

  .table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}

.table>tbody>tr>td {
  border: none;
}

.table tr {
  box-shadow: 0px 0px;
}

.table tr:hover {
  box-shadow: 0px 0px;
}

.font-weight-semibold {
    font-weight: 600 !important;
    color: #424e79;
}

.p-0 {
  padding-top: 0px!important;
  padding-bottom: 0px!important;
}

.user-btn {
  color: blue;
  font-size: 21px;
}

</style>

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
            <div class="col-md-6 col-sm-6">
              <div class="seipkon-breadcromb-left">
                <h3>User Details</h3>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 pull-right">
              <div class="seipkon-breadcromb-right">
                <a href="<?php echo site_url('User'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> List </a>
                <a href="<?php echo site_url('User/edit?id=').$a_value[0]->m_user_id; ?>" class="btn btn-success btn-vsm"><i class="fa fa-pencil"></i> Edit </a>
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
  <div class="col-xl-4 col-lg-4 col-md-12 mt-30">
  <div class="card box-widget widget-user">
    <div class="widget-user-image mx-auto mt-5 text-center">
      <img alt="User Avatar" class="rounded-circle" src="https://spruko.com/demo/dashtic/DASHTIC/assets/images/users/16.jpg">
    </div>
    <div class="card-body text-center">
      <div class="pro-user">
        <h4 class="pro-user-username text-dark mb-1 font-weight-bold"><?php echo $a_value[0]->m_user_name; ?></h4> 
       <!--  <h6 class="pro-user-desc text-muted">Web Designer</h6>  -->
       <a href="#" class="btn btn-success btn-sm mt-3">Lock</a>  <a href="#" class="btn btn-info btn-sm mt-3">Edit Profile</a> 
         <a href="#" class="btn btn-danger btn-sm mt-3">Blocked</a> 
      </div>
    </div>
    <div class="card-footer p-0">
      <div class="row">
        <div class="col-sm-12 border-right text-center">
          <div class="description-block p-4">
            <div class="table-responsive"> 
                  <table class="table mb-0"> 
                  <tbody style="display: flex; font-size: 25px; justify-content: space-between;">
      <tr>
      <td class="p-0"><a href="<?php echo $a_value[0]->m_user_fb; ?>" target="_blank"><span class="font-weight-semibold w-50"><i class="fa fa-facebook-square"></i> </span></a> </td>
      <td class="p-0"></td></tr>
      <tr>
      <td class="p-0"><a href="<?php echo $a_value[0]->m_user_twitter; ?>" target="_blank"><span class="font-weight-semibold w-50"><i class="fa fa-twitter-square"></i> </span></a> </td>
      <td class="p-0"></td></tr>
      <tr>
      <td class="p-0"><a href="<?php echo $a_value[0]->m_user_insta; ?>" target="_blank"> <span class="font-weight-semibold w-50"><i class="fa fa-instagram"></i> </span></a> </td>
      <td class="p-0"></td></tr>
      <tr>
      <td class="p-0"><a href="<?php echo $a_value[0]->m_user_youtube; ?>" target="_blank" > <span class="font-weight-semibold w-50"><i class="fa fa-youtube"></i> </span> </a></td>
      <td class="p-0"></td></tr>
      <tr>
      <td class="p-0"><a href="<?php echo $a_value[0]->m_user_linkedin; ?>" target="_blank" ><span class="font-weight-semibold w-50"><i class="fa fa-linkedin"></i> </span></a> </td>
      <td class="p-0"></td></tr>
      <tr>
      <td class="p-0"><a href="<?php echo $a_value[0]->m_user_telegram; ?>"> <span class="font-weight-semibold w-50"><i class="fa fa-telegram"></i> </span></a> </td>
      <td class="p-0"></td></tr>
      <tr>
      <td class="p-0"><a href="https://wa.me/<?php echo $a_value[0]->m_user_whatsapp; ?>" target="_blank" > <span class="font-weight-semibold w-50"><i class="fa fa-whatsapp"></i> </span> </a></td>
      <td class="p-0"></td></tr>



       </tbody>
       </table>
        </div>
          </div>
        </div>
       
      </div>
    </div>
  </div>
</div>

<div class="col-xl-4 col-lg-4 col-md-12 mt-30">
  <div class="card">
  <div class="card-body">
    <h4 class="card-title">Personal Details</h4> 
    <div class="table-responsive">
      <table class="table mb-0">
        <tbody>
          <tr>
            <td class="py-2 px-0"> <span class="font-weight-semibold w-50">Full Name   </span> 
            </td>
            <td class="py-2 px-0"><?php echo $a_value[0]->m_user_name; ?></td>
          </tr>
          <tr>
            <td class="py-2 px-0"> <span class="font-weight-semibold w-50">Gender </span> 
            </td>
            <td class="py-2 px-0"><?php echo $a_value[0]->m_user_gender; ?></td>
          </tr>
          <tr>
            <td class="py-2 px-0"> <span class="font-weight-semibold w-50">Birth Date  </span> 
            </td>
            <td class="py-2 px-0"><?php echo $a_value[0]->user_dob; ?></td>
          </tr>
          <tr>
            <td class="py-2 px-0"> <span class="font-weight-semibold w-50">Login Type  </span> 
            </td>
            <td class="py-2 px-0"><?php echo $a_value[0]->login_type; ?></td>
          </tr>
          <tr>
            <td class="py-2 px-0"> <span class="font-weight-semibold w-50">About   </span> 
            </td>
            <td class="py-2 px-0"><?php echo $a_value[0]->m_user_about; ?></td>
          </tr>
          <tr>
            <td class="py-2 px-0"> <span class="font-weight-semibold w-50">Referred By   </span> 
            </td>
            <td class="py-2 px-0"><?php echo $a_value[0]->referred_by; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<div class="col-xl-4 col-lg-4 col-md-12 mt-30">
  <div class="card">
  <div class="card-body">
    <h4 class="card-title">Contact Details</h4> 
    <div class="table-responsive">
      <table class="table mb-0">
        <tbody>
          <tr>
            <td class="py-2 px-0"> <span class="font-weight-semibold w-50">Contact Num. </span> 
            </td>
            <td class="py-2 px-0"><span data-toggle="modal" data-target="#myModal" style="cursor: pointer;" title="Send SMS"><?php echo $a_value[0]->m_user_mobile; ?></span> </td>
          </tr>
          <tr>
            <td class="py-2 px-0"> <span class="font-weight-semibold w-50">Alt.Num   </span> 
            </td>
            <td class="py-2 px-0"><?php echo $a_value[0]->m_user_alt_mobile; ?></td>
          </tr>
          <tr>
            <td class="py-2 px-0"> <span class="font-weight-semibold w-50">Email   </span> 
            </td>
            <td class="py-2 px-0"><span data-toggle="modal" data-target="#mailModal" style="cursor: pointer;" title="Send Mail"> <?php echo $a_value[0]->m_user_email; ?></span></td>
          </tr>
          <tr>
            <td class="py-2 px-0"> <span class="font-weight-semibold w-50">City  </span> 
            </td>
            <td class="py-2 px-0"><?php echo $a_value[0]->mcity_name; ?></td>
          </tr>
          <tr>
            <td class="py-2 px-0"> <span class="font-weight-semibold w-50">Address   </span> 
            </td>
            <td class="py-2 px-0"><?php echo $a_value[0]->m_user_address; ?></td>
          </tr>
         
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

</div>



<!-- <div class="row">
  <div class="col-md-12">

    <div class="profile-left">
      <div class="widget_card_page">

  <div class="row">
    <div class="col-md-4">
      <?php  $user_img = base_url('assets/img/default-user0.png');
      if (!empty($a_value[0]->m_user_pic)) {$img_title = $a_value[0]->m_user_pic;
        if (file_exists('../uploads/users/'.$img_title)){
          $user_img = base_url('../uploads/users/').$img_title;
        }
      }
      $btn_status = ($a_value[0]->m_user_status == 1) ? '<button type="button" class="btn btn-info btn-block btn-vsm" data-status="2" title="Click here to Change Status">Active</button>' : '<button type="button" class="btn btn-danger btn-block btn-vsm" data-status="1" title="Click here to Change Status">Blocked</button>';

      ?>
           <div class="profile-widget-img">
              <img src="<?php echo $user_img; ?>" alt="profile" style="width: 100px; height: 100px;" />
           </div>
           <div class="profile-widget-info">
              <h3><?php echo $a_value[0]->m_user_name; ?></h3>
              <p>User Name</p>
           </div>
           <div class="text-center profile-widget-social" id="user_tbl"><span class="change-status" data-cgid="<?php echo $a_value[0]->m_user_id; ?>"><?php echo $btn_status; ?></span></div>
           <div class="text-center profile-widget-social">
              <a class="btn-block" href="<?php echo site_url('User/edit?id=').$a_value[0]->m_user_id; ?>">Edit User <i class="fa fa-pencil"></i></a>
           </div>
           <div class="text-center profile-widget-social">
              <a class="btn-block" href="#"><?php echo $a_value[0]->login_type; ?> <i class="fa fa-lock"></i></a>
           </div>


    </div>
    <div class="col-md-4">

<div class="single-profile-bio">


            <h3 style="margin-top: 10px; float: left;">Profile Details</h3>

<div class="table-responsive"> <table class="table mb-0"> <tbody><tr>
<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Full Name </span> </td>
<td class="py-2 px-0"><?php echo $a_value[0]->m_user_name; ?></td></tr>
<tr>
<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Gender </span> </td>
<td class="py-2 px-0"><?php echo $a_value[0]->m_user_gender; ?></td></tr>
<tr>
<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Birth Date </span> </td>
<td class="py-2 px-0"><?php echo $a_value[0]->user_dob; ?></td></tr>
<tr>
<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Login Type </span> </td>
<td class="py-2 px-0"> <?php echo $a_value[0]->login_type; ?></td></tr>
<tr>
<td class="py-2 px-0"> <span class="font-weight-semibold w-50">About </span> </td>
<td class="py-2 px-0"><?php echo $a_value[0]->m_user_about; ?></td></tr>
<tr>
<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Referred By </span> </td>
<td class="py-2 px-0"><?php echo $a_value[0]->referred_by; ?></td></tr>
 </tbody>
 </table>
  </div>

</div>  
      
    </div>
    <div class="col-md-4">
      



        <div class="profile-bio">
          <div class="single-profile-bio">
            <h3 style="margin-top: 10px; float: left;">Contact Details</h3>
            <div class="table-responsive"> 
            <table class="table mb-0"> 
            <tbody>
<tr>
<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Contact Num.</span> </td>
<td class="py-2 px-0"><span data-toggle="modal" data-target="#myModal" style="cursor: pointer;" title="Send SMS"> <span class="user-btn"><i class="fa fa-commenting-o" aria-hidden="true"></i></span> <?php echo $a_value[0]->m_user_mobile; ?></span> </td></tr>
<tr>
<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Alt.Num</span> </td>
<td class="py-2 px-0"><?php echo $a_value[0]->m_user_alt_mobile; ?></td></tr>
<tr>
<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Email</span> </td>
<td class="py-2 px-0"><span data-toggle="modal" data-target="#mailModal" style="cursor: pointer;" title="Send Mail"> <span class="user-btn"><i class="fa fa-envelope-o" aria-hidden="true"></i></span> <?php echo $a_value[0]->m_user_email; ?></span></td></tr>
<tr>
<td class="py-2 px-0"> <span class="font-weight-semibold w-50">City</span> </td>
<td class="py-2 px-0"><?php echo $a_value[0]->mcity_name; ?></td></tr>
<tr>
<td class="py-2 px-0"> <span class="font-weight-semibold w-50">Address</span> </td>
<td class="py-2 px-0"><?php echo $a_value[0]->m_user_address; ?></td></tr>


 </tbody>
 </table>
  </div>
           
          </div>
        </div>




    </div>
    <div class="col-md-8">





              <div class="profile-bio">
                <div class="single-profile-bio">
                  <h3 style="margin-top: 10px; float: left;">Social Details</h3>
                  

             
                </div>
              </div>




    </div>
  </div>
      </div>
    </div>

  </div>
</div> --><!-- div row close -->
<!-- View Counselor Area End -->
<!-- ====================/Page Content======================= -->

<!-- =====================Page Content======================= -->
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Message</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Message</label>
  <textarea class="form-control" name="" id="" placeholder="Enter Message"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="" class="btn btn-info" data-dismiss="modal">Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Modal -->
  <div class="modal fade" id="mailModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Mail</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Message</label>
  <textarea class="form-control" name="" id="" placeholder="Enter Message"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="" class="btn btn-info" data-dismiss="modal">Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
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
<?php $this->view('js/user_js'); $this->view('js/custom_js'); ?>
<!-- ========================Script========================== -->