<style type="text/css">
  .sidebar-profile {
    width: 95%;
  }

  .sidebar-navs {
    border-top: 1px solid lightgrey;
    padding: 0px;
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

  .nav > li {
    margin: 3px 6px;
  }

  .icon-size {
    height: 24px !important;
    width: 24px !important;
  }
</style>

<!-- Sidebar Start -->
<?php 
  $logged_user_id = $this->session->userdata('user_id');
  $logged_user_type = $this->session->userdata('user_type');
?>
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
        ?>
        <img src="<?php echo $user_img; ?>" class="img-responsive" alt="profile" style="width: 100%; height: 100%;" />
      </div>

      <div class="profile-info">
        <p>Welcome !</p>
        <h4><?php echo $log_user_dtl[0]->m_admin_name; ?></h4>
      </div>

      <div class="clearfix"></div>

      <div class="sidebar-navs">
        <ul class="nav nav-pills-circle">
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

        <!-- Dashboard -->
        <li>
          <a href="<?php echo site_url('Welcome') ?>" class="mynev-links">
            <img class="icon-size" src="<?php echo base_url('uploads/icon/house.png'); ?>"> Dashboard
          </a>
        </li>

        <!-- Water Park -->
        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP')) { ?>
        <li>
          <a href="#sidebar-waterpark" data-toggle="collapse" aria-expanded="false">
            <img class="icon-size" src="<?php echo base_url('uploads/icon/booking.png'); ?>"> Water Park
          </a>
          <ul class="collapse list-unstyled mynev-submenus" id="sidebar-waterpark">
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC')) { ?>
              <li><a href="<?php echo site_url('Shop') ?>" class="mynev-links">Tickets List</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Add')) { ?>
                <li><a href="<?php echo site_url('Shop/add_ticket') ?>" class="mynev-links">Add Ticket</a></li>
              <?php } ?>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'LC')) { ?>
              <li><a href="<?php echo site_url('Shop/locker_list') ?>" class="mynev-links">Add Locker</a></li>
              <li><a href="<?php echo site_url('Shop/locker_list/2') ?>" class="mynev-links">Locker List</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS')) { ?>
              <li><a href="<?php echo site_url('Shop/costume_list') ?>" class="mynev-links">Add Costume</a></li>
              <li><a href="<?php echo site_url('Shop/costume_list/2') ?>" class="mynev-links">Costume List</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'SL')) { ?>
              <li><a href="<?php echo site_url('Shop/sales_list') ?>" class="mynev-links">Sales List</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'SL', 'Add')) { ?>
                <li><a href="<?php echo site_url('Shop/add_sales') ?>" class="mynev-links">Add Sale</a></li>
              <?php } ?>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'PL')) { ?>
              <li><a href="<?php echo site_url('Shop/plot_list') ?>" class="mynev-links">Plot List</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'PL', 'Add')) { ?>
                <li><a href="<?php echo site_url('Shop/add_plot') ?>" class="mynev-links">Add Plot</a></li>
              <?php } ?>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <!-- Vouchers -->
        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH')) { ?>
        <li>
          <a href="#sidebar-vouchers" data-toggle="collapse" aria-expanded="false">
            <i class="fa fa-file-invoice"></i> Vouchers
          </a>
          <ul class="collapse list-unstyled mynev-submenus" id="sidebar-vouchers">
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'EXP')) { ?>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'Expcat')) { ?>
                <li><a href="<?php echo site_url('Vouchers/expense_cat_list') ?>" class="mynev-links">Expense Category</a></li>
              <?php } ?>
              <li><a href="<?php echo site_url('Vouchers/expense_list') ?>" class="mynev-links">Expense List</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'EXP', 'Add')) { ?>
                <li><a href="<?php echo site_url('Vouchers/add_expense') ?>" class="mynev-links">Add Expense</a></li>
              <?php } ?>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'JNL')) { ?>
              <li><a href="<?php echo site_url('Vouchers/journal_list') ?>" class="mynev-links">Voucher</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'JNL', 'Add')) { ?>
                <li><a href="<?php echo site_url('Vouchers/add_journal') ?>" class="mynev-links">Add Voucher</a></li>
              <?php } ?>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'PMT')) { ?>
              <li><a href="<?php echo site_url('Vouchers/payment_list') ?>" class="mynev-links">Payment List</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'PMT', 'Add')) { ?>
                <li><a href="<?php echo site_url('Vouchers/add_payment') ?>" class="mynev-links">Add Payment</a></li>
              <?php } ?>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'RPT')) { ?>
              <li><a href="<?php echo site_url('Vouchers/receipt_list') ?>" class="mynev-links">Receipt List</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'RPT', 'Add')) { ?>
                <li><a href="<?php echo site_url('Vouchers/add_receipt') ?>" class="mynev-links">Add Receipt</a></li>
              <?php } ?>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'DCNT')) { ?>
              <li><a href="<?php echo site_url('Vouchers/discount_list') ?>" class="mynev-links">Discount List</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'DCNT', 'Add')) { ?>
                <li><a href="<?php echo site_url('Vouchers/add_discount') ?>" class="mynev-links">Add Discount</a></li>
              <?php } ?>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <!-- Inventory -->
        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT')) { ?>
        <li>
          <a href="#sidebar-inventory" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-boxes"></i> Inventory
          </a>
          <ul class="collapse list-unstyled mynev-submenus" id="sidebar-inventory">
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'REQMT')) { ?>
              <li><a href="<?php echo site_url('Inventory/requirement_list') ?>" class="mynev-links">Requirements</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'REQMT', 'Add')) { ?>
                <li><a href="<?php echo site_url('Inventory/add_requirement') ?>" class="mynev-links">Add Requirement</a></li>
              <?php } ?>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'PORD')) { ?>
              <li><a href="<?php echo site_url('Inventory/purchase_order') ?>" class="mynev-links">Purchase Order</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'PORD', 'Add')) { ?>
                <li><a href="<?php echo site_url('Inventory/add_purchase_order') ?>" class="mynev-links">Add Order</a></li>
              <?php } ?>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'PINV')) { ?>
              <li><a href="<?php echo site_url('Inventory/purchase_invoice') ?>" class="mynev-links">Purchase Invoice</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'PRTN')) { ?>
              <li><a href="<?php echo site_url('Inventory/purchase_return') ?>" class="mynev-links">Purchase Return</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKJN')) { ?>
              <li><a href="<?php echo site_url('Inventory/stockjournal_list') ?>" class="mynev-links">Stock Journal</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKJN', 'Add')) { ?>
                <li><a href="<?php echo site_url('Inventory/add_stockjournal') ?>" class="mynev-links">Add Stock</a></li>
              <?php } ?>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKISS')) { ?>
              <li><a href="<?php echo site_url('Inventory/storeissue_list') ?>" class="mynev-links">Store Issue</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKISS', 'Add')) { ?>
                <li><a href="<?php echo site_url('Inventory/add_storeissue') ?>" class="mynev-links">Add Store Issue</a></li>
              <?php } ?>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKOT')) { ?>
              <li><a href="<?php echo site_url('Inventory/storeout_list') ?>" class="mynev-links">Store Out</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKOT', 'Add')) { ?>
                <li><a href="<?php echo site_url('Inventory/add_storeout/1') ?>" class="mynev-links">Add Store Out</a></li>
              <?php } ?>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'DV')) { ?>
              <li><a href="<?php echo site_url('Inventory/damage_list') ?>" class="mynev-links">Damage List</a></li>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'DV', 'Add')) { ?>
                <li><a href="<?php echo site_url('Inventory/add_storeout/2') ?>" class="mynev-links">Add Damage</a></li>
              <?php } ?>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <!-- Reports -->
        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RPT')) { ?>
        <li>
          <a href="#sidebar-reports" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-chart-bar"></i> Reports
          </a>
          <ul class="collapse list-unstyled mynev-submenus" id="sidebar-reports">
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RPT', 'TCK')) { ?>
              <li><a href="<?php echo site_url('Reports/ticket_report') ?>" class="mynev-links">Ticket Report</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RPT', 'CTP')) { ?>
              <li><a href="<?php echo base_url('Reports/ticket_comparison_report') ?>" class="mynev-links">Comparison Report</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RPT', 'STK')) { ?>
              <li><a href="<?php echo site_url('Reports/stock_report') ?>" class="mynev-links">Stock Report</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RPT', 'MNR')) { ?>
              <li><a href="<?php echo site_url('Reports/monthly_report') ?>" class="mynev-links">Monthly Report</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <!-- Restaurant -->
        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES')) { ?>
        <li>
          <a href="#sidebar-restaurant" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-utensils"></i> Restaurant
          </a>
          <ul class="collapse list-unstyled mynev-submenus" id="sidebar-restaurant">
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'MG')) { ?>
              <li><a href="<?php echo site_url('Restuarent/menugroup_list') ?>" class="mynev-links">Menu Group</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'ME')) { ?>
              <li><a href="<?php echo site_url('Restuarent/menu_list') ?>" class="mynev-links">Menu</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'FCDE', 'Add')) { ?>
              <li><a href="<?php echo site_url('Restuarent/add_foodcourt') ?>" class="mynev-links">Add Food Entry</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'FCDE')) { ?>
              <li><a href="<?php echo site_url('Restuarent/foodcourt_list') ?>" class="mynev-links">FoodCourt Entries</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'RSTR', 'Add')) { ?>
              <li><a href="<?php echo site_url('Restuarent/add_resort_data') ?>" class="mynev-links">Add Resort Entry</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'RSTR')) { ?>
              <li><a href="<?php echo site_url('Restuarent/resort_data_list/1') ?>" class="mynev-links">Resort Entries</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'CMPR', 'Add')) { ?>
              <li><a href="<?php echo site_url('Restuarent/add_resort_data/2') ?>" class="mynev-links">Add Camp Entry</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'CMPR')) { ?>
              <li><a href="<?php echo site_url('Restuarent/camps_data_list') ?>" class="mynev-links">Camp Entries</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <!-- HR -->
        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR')) { ?>
        <li>
          <a href="#sidebar-hr" data-toggle="collapse" aria-expanded="false">
            <i class="fa-solid fa-user"></i> HR
          </a>
          <ul class="collapse list-unstyled mynev-submenus" id="sidebar-hr">
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Dept')) { ?>
              <li><a href="<?php echo site_url('HrDept/department_list') ?>" class="mynev-links">Department</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Deg')) { ?>
              <li><a href="<?php echo site_url('HrDept/designation_list') ?>" class="mynev-links">Designation</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Hq')) { ?>
              <li><a href="<?php echo site_url('HrDept/hq_list') ?>" class="mynev-links">HQ</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'nh')) { ?>
              <li><a href="<?php echo site_url('HrDept/nh_list') ?>" class="mynev-links">NH</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Emp')) { ?>
              <li><a href="<?php echo site_url('HrDept/employe_list') ?>" class="mynev-links">Employees</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'ADV')) { ?>
              <li><a href="<?php echo site_url('HrDept/advance_list') ?>" class="mynev-links">Advance</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT', 'Add')) { ?>
              <li><a href="<?php echo site_url('HrDept/add_monthly_salary') ?>" class="mynev-links">Add Salary</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT')) { ?>
              <li><a href="<?php echo site_url('HrDept/salary_history') ?>" class="mynev-links">Salary List</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'INMT')) { ?>
              <li><a href="<?php echo site_url('HrDept/incrmt_list') ?>" class="mynev-links">Increments</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <!-- Marketing -->
        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT')) { ?>
        <li>
          <a href="#sidebar-marketing" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-mail-bulk"></i> Marketing
          </a>
          <ul class="collapse list-unstyled mynev-submenus" id="sidebar-marketing">
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'LSR')) { ?>
              <li><a href="<?php echo site_url('Marketing/leadsource_list') ?>" class="mynev-links">Lead Source</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'LTY')) { ?>
              <li><a href="<?php echo site_url('Marketing/leadtype_list') ?>" class="mynev-links">Lead Type</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'LST')) { ?>
              <li><a href="<?php echo site_url('Marketing/leadstatus_list') ?>" class="mynev-links">Lead Status</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'LCTL')) { ?>
              <li><a href="<?php echo site_url('Marketing/leadclient_list') ?>" class="mynev-links">Clients List</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'lead')) { ?>
              <li><a href="<?php echo site_url('Marketing/lead_list') ?>" class="mynev-links">Enquiries</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <!-- Customer List (standalone) -->
        <li>
          <a href="<?php echo site_url('Setup/customer_list') ?>" class="mynev-links">
            <img class="icon-size" src="<?php echo base_url('uploads/icon/student.png'); ?>"> Customer List
          </a>
        </li>

        <!-- Masters -->
        <li>
          <a href="#sidebar-masters" data-toggle="collapse" aria-expanded="false">
            <img class="icon-size" src="<?php echo base_url('uploads/icon/database.png'); ?>"> Masters
          </a>
          <ul class="collapse list-unstyled mynev-submenus" id="sidebar-masters">
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Ste')) { ?>
              <li><a href="<?php echo site_url('Master/state_list') ?>" class="mynev-links">State</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'City')) { ?>
              <li><a href="<?php echo site_url('Master/city_list') ?>" class="mynev-links">City</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Shd')) { ?>
              <li><a href="<?php echo site_url('Master/saleshead_list') ?>" class="mynev-links">Sale Head</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'CACT')) { ?>
              <li><a href="<?php echo site_url('Master/cashAcc_list') ?>" class="mynev-links">Cash Account</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Lkc')) { ?>
              <li><a href="<?php echo site_url('Master/lockercode_list') ?>" class="mynev-links">Locker Code</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'inst')) { ?>
              <li><a href="<?php echo site_url('Master/instraction_list') ?>" class="mynev-links">Instructions</a></li>
            <?php } ?>
            <?php if ($logged_user_id == 1) { ?>
              <li><a href="<?php echo site_url('Master/perm_list') ?>" class="mynev-links">Permission</a></li>
            <?php } ?>
          </ul>
        </li>

        <!-- Setup -->
        <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup')) { ?>
        <li>
          <a href="#sidebar-setup" data-toggle="collapse" aria-expanded="false">
            <img class="icon-size" src="<?php echo base_url('uploads/icon/database.png'); ?>"> Setup
          </a>
          <ul class="collapse list-unstyled mynev-submenus" id="sidebar-setup">
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Acp')) { ?>
              <li><a href="<?php echo site_url('Setup/accparent_list') ?>" class="mynev-links">AccParent</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Acg')) { ?>
              <li><a href="<?php echo site_url('Setup/accgroup_list') ?>" class="mynev-links">AccGroup</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Acc')) { ?>
              <li><a href="<?php echo site_url('Setup/account_list') ?>" class="mynev-links">Accounts</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'cmpy')) { ?>
              <li><a href="<?php echo site_url('Setup/company_list') ?>" class="mynev-links">Company</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Supp')) { ?>
              <li><a href="<?php echo site_url('Setup/supplier_list') ?>" class="mynev-links">Supplier</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Ctr')) { ?>
              <li><a href="<?php echo site_url('Setup/contractor_list') ?>" class="mynev-links">Contractor</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Users')) { ?>
              <li><a href="<?php echo site_url('Setup/users_list') ?>" class="mynev-links">Users</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Gdwn')) { ?>
              <li><a href="<?php echo site_url('Setup/godown_list') ?>" class="mynev-links">Godowns</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Ats')) { ?>
              <li><a href="<?php echo site_url('Setup/asset_list') ?>" class="mynev-links">Asset</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'BND')) { ?>
              <li><a href="<?php echo site_url('Setup/band_list') ?>" class="mynev-links">Bands</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'bdcr')) { ?>
              <li><a href="<?php echo site_url('Setup/band_colour_list') ?>" class="mynev-links">Band Colour</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Prod')) { ?>
              <li><a href="<?php echo site_url('Setup/product_list') ?>" class="mynev-links">Product</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Pgp')) { ?>
              <li><a href="<?php echo site_url('Setup/prodgroup_list') ?>" class="mynev-links">ProdGroup</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Pct')) { ?>
              <li><a href="<?php echo site_url('Setup/prodcat_list') ?>" class="mynev-links">ProdCategory</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'plan')) { ?>
              <li><a href="<?php echo site_url('Setup/plans_list') ?>" class="mynev-links">Plans</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'package')) { ?>
              <li><a href="<?php echo site_url('Setup/package_list') ?>" class="mynev-links">Food Package</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

      </ul>
    </div>
    <!-- Menu Section End -->

    <!-- Settings Section -->
    <div class="menu-section">

      <h3>Settings</h3>

      <ul class="list-unstyled components mynev-menus">

        <li>
          <a href="#sidebar-settings" data-toggle="collapse" aria-expanded="false">
            <i class="fa fa-cog"></i> General Setting
          </a>
          <ul class="collapse list-unstyled mynev-submenus" id="sidebar-settings">
            <li><a href="<?php echo site_url('Profile') ?>" class="mynev-links">Your Profile</a></li>
            <li><a href="<?php echo site_url('Profile/application_settings') ?>" class="mynev-links">App Setting</a></li>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Set', 'wdst')) { ?>
              <li><a href="<?php echo site_url('Profile/weekday_settings') ?>" class="mynev-links">WeekDay Setting</a></li>
            <?php } ?>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Set', 'west')) { ?>
              <li><a href="<?php echo site_url('Profile/weekend_settings') ?>" class="mynev-links">WeekEnd Setting</a></li>
            <?php } ?>
          </ul>
        </li>

        <li>
          <a href="<?php echo site_url('Logout') ?>" class="mynev-links">
            <i class="fa fa-power-off"></i> Logout
          </a>
        </li>

      </ul>

    </div>
    <!-- Settings Section End -->

  </nav>

</aside>

<!-- End Sidebar -->
