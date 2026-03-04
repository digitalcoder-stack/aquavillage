<style type="text/css">
  .sidebar-profile {

    width: 95%;

  }

  .sidebar-navs {

    border-top: 1px solid lightgrey;

    padding: 0px 0px 0px 0px;

    border-bottom: 1px solid lightgrey;

    margin-top: 10px;

  }

  .nav-pills-circle {

    position: relative;

    margin: 0 auto;

    text-align: center;

    justify-content: center;

  }

  .sidebar-navs .nav-pills-circle .nav-link {

    display: block;

    padding: 5px;

    font-size: 14px;

    border: 1px solid #e3e7ed;

    border-radius: 50%;

    line-height: 1.6;

    height: 34px;

    width: 34px;

  }

  .nav {

    display: flex;

    flex-wrap: wrap;

    padding-left: 0;

    margin-bottom: 0;

    list-style: none;

  }


  .nav>li {

    margin: 3px 6px;

  }

  .icon-size {
    height: 24px !important;
    width: 24px !important;
  }
</style>

<!-- Sidebar Start -->

<aside class="seipkon-main-sidebar ver-nav">

  <nav id="sidebar">

    <!-- Sidebar Profile Start -->

    <div class="sidebar-profile clearfix">

      <div class="profile-avatar" style="border: 1px solid #0000000a; border-radius: 50%;">

        <?php

        $user_img = base_url('assets/img/default-user0.png');

        if (!empty($log_user_dtl[0]->m_admin_img)) {

          if (file_exists('uploads/' . $log_user_dtl[0]->m_admin_img)) {

            $user_img = base_url('uploads/') . $log_user_dtl[0]->m_admin_img;
          }
        }

        ?> <img src="<?php echo $user_img; ?>" class="img-responsive" alt="profile" style="width: 100%; height: 100%;" /> </div>

      <div class="profile-info">

        <p>Welcome !</p>

        <h4> <?php echo $log_user_dtl[0]->m_admin_name; ?></h4>
      </div>

      <div class="clearfix"></div>

      <div class="sidebar-navs">

        <ul class="nav  nav-pills-circle">



          <li class="nav-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Users List">

            <a style="background: deepskyblue; color: white;" class="nav-link text-center m-2" href="<?php echo site_url('Students/student_list'); ?>"> <i class="fa fa-user"></i> </a>

          </li>


          <li class="nav-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Logout">

            <a style="background: red; color: white;" class="nav-link text-center m-2" href="<?php echo Site_url('Logout') ?>"> <i class="fa fa-power-off"></i> </a>

          </li>

        </ul>

      </div>

    </div>

    <!-- Sidebar Profile End -->

    <!-- Menu Section Start -->

    <div class="menu-section">

      <h3>General</h3>

      <ul class="list-unstyled components mynev-menus activation">

        <li class="">

          <a href="<?php echo site_url('Welcome') ?>" class="mynev-links"><img class="icon-size" src="<?php echo base_url('uploads/icon/house.png'); ?>"> Dashboard </a>

        </li>
        <li>
          <a href="#waterpark" data-toggle="collapse" aria-expanded="false"> <img class="icon-size" src="<?php echo base_url('uploads/icon/booking.png'); ?>"> Water Park</a>
          <ul class="collapse list-unstyled mynev-submenus" id="waterpark">
            <li><a href="<?php echo site_url('Shop') ?>" class="mynev-links">Tickets List</a></li>
            <li><a href="<?php echo site_url('Shop/locker_list') ?>" class="mynev-links">Locker List</a></li>
            <li><a href="<?php echo site_url('Shop/costume_list') ?>" class="mynev-links">Costume List</a></li>


          </ul>
        </li>

        <li class="">

          <a href="<?php echo site_url('Setup/customer_list') ?>" class="mynev-links"> <img class="icon-size" src="<?php echo base_url('uploads/icon/student.png'); ?>"> Customer List </a>

        </li>

        <li>
          <a href="#Listings1" data-toggle="collapse" aria-expanded="false"> <img class="icon-size" src="<?php echo base_url('uploads/icon/database.png'); ?>"> Masters</a>
          <ul class="collapse list-unstyled mynev-submenus" id="Listings1">
            <li><a href="<?php echo site_url('Master/state_list') ?>" class="mynev-links">State</a></li>
            <li><a href="<?php echo site_url('Master/city_list') ?>" class="mynev-links">City</a></li>
            <li><a href="<?php echo site_url('Master/saleshead_list') ?>" class="mynev-links">Sale Head</a></li>
            <li><a href="<?php echo site_url('Master/cashAcc_list') ?>" class="mynev-links">Cash Account</a></li>
            <li><a href="<?php echo site_url('Master/lockercode_list') ?>" class="mynev-links">Locker Code</a></li>
            <li><a href="<?php echo site_url('Master/costumecode_list') ?>" class="mynev-links">Costume Code</a></li>

          </ul>
        </li>

        <li>
          <a href="#setup" data-toggle="collapse" aria-expanded="false"> <img class="icon-size" src="<?php echo base_url('uploads/icon/database.png');?>"> Setup</a>
          <ul class="collapse list-unstyled mynev-submenus" id="setup">
            <li><a href="<?php echo site_url('Setup/accparent_list') ?>" class="mynev-links">AccParent</a></li>
            <li><a href="<?php echo site_url('Setup/accgroup_list') ?>" class="mynev-links">AccGroup</a></li>
            <li><a href="<?php echo site_url('Setup/account_list') ?>" class="mynev-links">Accounts</a></li>
            <li><a href="<?php echo site_url('Setup/supplier_list') ?>" class="mynev-links">Supplier</a></li>
            <li><a href="<?php echo site_url('Setup/contractor_list') ?>" class="mynev-links">Contractor</a></li>
            <li><a href="<?php echo site_url('Setup/users_list') ?>" class="mynev-links">Users</a></li>
            <li><a href="<?php echo site_url('Setup/godown_list') ?>" class="mynev-links">Godowns</a></li>
            <li><a href="<?php echo site_url('Setup/asset_list') ?>" class="mynev-links">Asset</a></li>
           
           
          </ul>
        </li>

      </ul>
    </div>

    <!-- Menu Section End -->

    <!-- Menu Section Start -->

    <div class="menu-section">

      <h3>Extra Settings</h3>

      <ul class="list-unstyled components mynev-menus">

        <li>

          <a href="#ex_components" data-toggle="collapse" aria-expanded="false"> <i class="fa fa-cog"></i> General Setting </a>

          <ul class="collapse list-unstyled mynev-submenus" id="ex_components">

            <li><a href="<?php echo site_url('Profile') ?>" class="mynev-links">Your Profile </a></li>

            <li><a href="<?php echo site_url('Profile/application_settings') ?>" class="mynev-links">App Setting </a></li>

          </ul>

        </li>

        <li>

          <a href="<?php echo site_url('Logout') ?>" class="mynev-links"> <i class="fa fa-power-off"></i> Logout </a>

        </li>

      </ul>

    </div>

    <!-- Menu Section End -->

  </nav>

</aside>

<!-- End Sidebar -->
