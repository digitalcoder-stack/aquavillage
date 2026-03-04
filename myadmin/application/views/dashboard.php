<?php date_default_timezone_set('Asia/Kolkata'); ?>
<!-- =========================View==============Fix========== -->

<!-- ========================Header==============Fix========= -->
<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id');
$logged_user_type = $this->session->userdata('user_type');
?>
<!-- =======================/Header==============Fix========= -->

<!-- =========================View===============Fix========= -->
<!-- Right Side Content Start -->
<div class="page-content">
  <div class="container-fluid">
    <!-- ========================/View===============Fix========= -->

    <!-- ======================Page Style======================== -->
    <style type="text/css">
      .info-box {
        background: none;
        height: 129px;
        background-image: url(uploads/circle.svg);
        background-repeat: no-repeat;
        background-position: right;
        background-size: 100%;
      }

      .info-box-icon>img {
        max-width: 100%;
      }

      .info-box-icon {
        border-radius: 100px;
        width: 50px;
        height: 50px;
        background-color: #0e84ae;
        color: white;
        font-size: 19px;
        line-height: 50px;
        margin: 16px;
        display: block;
        float: left;
        text-align: center;
      }

      .info-box-text {
        text-transform: capitalize;
        font-size: 17px;
        overflow: visible;
        color: white;
        font-weight: 700;
      }

      .info-box-content {
        margin-left: 0px;
        margin-right: 11px;
      }

      .info-box-number {
        display: block;
        font-weight: 700;
        font-size: 30px;
        color: white;
        margin-top: 15px;
        float: right;
      }


      .box {
        position: relative;
        border-radius: 3px;
        background: #ffffff;
        border: none;
        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .12), 0 1px 5px 0 rgba(0, 0, 0, .2);
      }

      .crd {
        border-radius: 5px;
        margin-bottom: 10px;
      }

      .skin-blue .main-sidebar {
        position: sticky;
        top: 0;
        padding: 0px;
        float: left;
        box-shadow: 0px 8px 14.72px 1.28px rgba(159, 150, 226, 0.7);
        height: 800px;
      }


      .sidebar-menu>li {
        width: 95%;
      }

      .skin-blue .sidebar-menu>li>.treeview-menu {
        background: white;
      }

      .skin-blue .treeview-menu>li>a {
        color: #2d3144;
        margin-top: 1em;
        margin-bottom: 1em;
      }

      .skin-blue .treeview-menu>li>a:hover {
        color: #002cff;

      }

      .flexistart {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
      }

      .seacrh-box {
        width: 40%;
        display: inline-table;
        height: 25px;
      }

      .f-size {
        font-size: 12px !important;
      }

      .seats-row {
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        padding: 0 10px;
        justify-content: center;
      }

      .seats-row .seat-col {
        padding-right: 5px !important;
        padding-left: 0;
        min-height: 650px;
      }

      .seats-row .seat-col.sec-5 {
        min-height: 500px;
      }

      .seat {
        aspect-ratio: 1/1;
        color: white;
        font-size: 1.2rem;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 5px;
        border-radius: 5px;
      }

      .seat-avilable {
        background: #86B5CF;
      }

      .seat-booked {
        background-color: #E7AF2E;
      }

      .seat-maintance {
        background-color: #FF3131;
      }

      .seat-gap {
        background-color: #929292;
      }

      .seat-none {
        background-color: transparent;
      }

      .seat-card {
        padding: 10px;
        background-color: #e5e5e5;
        border-radius: 1rem;
        margin-bottom: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
      }

      .tdhead {
        color: red;
        font-weight: bold;
        font-size: 17px;
      }

      .trtotal {
        color: blue;

      }

      .d-none {
        display: none;
      }

      a.nabtn {
        line-height: 14px;
        display: inline-block;
        border-radius: 10px 10px 0 0;
        font-weight: 500;
        letter-spacing: 0.5px;
        font-size: 13px;
        margin: 0 1px;
        position: relative;
        top: 3px;
      }

      a.nabtn.active {
        background: #0d79ba;
        color: white;
      }

      a.nabtn:hover {
        color: black;
        background: #d1f0ff;
      }

      #print_head {
        display: none;
      }

      @media print {

        .no-print {
          display: none !important;
        }

        .page-box {
          margin-top: -14rem;
        }

        #print_head {
          display: flex;
          justify-content: space-between;
        }
      }
    </style>
    <!-- =====================/Page Style======================== -->

    <!-- ======================Page Title======================== -->
    <!-- Breadcromb Row Start -->
    <div class="row">
      <div class="col-md-12">
        <div class="breadcromb-area" style="box-shadow: none;">
          <div class="row">
            <div class="col-md-4  col-sm-4">
              <div class="seipkon-breadcromb-left">
                <h3>Dashboard</h3>
              </div>
            </div>
            <div class="col-md-8">
              <div class="col-sm-12 text-center">
                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'DSB', 'DYR')) { ?>
                  <a href="<?php echo site_url('Welcome?type=4') ?>" class="nav-top-btn nabtn <?php if ($type == 4) {
                                                                                                echo 'active';
                                                                                              } ?>" id="Dyrpt">Day Report</a>
                <?php }
                if ($logged_user_type == 1 || has_perm($logged_user_id, 'DSB', 'DSY')) { ?>
                  <a href="<?php echo site_url('Welcome?type=1') ?>" class="nav-top-btn nabtn <?php if ($type == 1) {
                                                                                                echo 'active';
                                                                                              } ?>" id="Dsum">Day Summary</a>
                <?php }
                if ($logged_user_type == 1 || has_perm($logged_user_id, 'DSB', 'BCS')) { ?>
                  <a href="<?php echo site_url('Welcome?type=2') ?>" class="nav-top-btn nabtn <?php if ($type == 2) {
                                                                                                echo 'active';
                                                                                              } ?>" id="Drsummery">Date Wise Cash Bank In Out - Summary</a>
                <?php }
                if ($logged_user_type == 1 || has_perm($logged_user_id, 'DSB', 'BCD')) { ?>
                  <a href="<?php echo site_url('Welcome?type=3') ?>" class="nav-top-btn nabtn <?php if ($type == 3) {
                                                                                                echo 'active';
                                                                                              } ?>" id="Drdetail">Date Wise Cash Bank In Out - Detail</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Breadcromb Row -->

    <!-- /Graph Section -->

    <?php $perm_add = 0;
    $perm_edit = 0;
    if ($logged_user_type == 1 || has_perm($logged_user_id, 'DSB', 'DYR', 'Add')) {
      isset($repot_data['d_data_date']) ? $perm_add = 0 : $perm_add = 1;
    }
    if ($logged_user_type == 1 || has_perm($logged_user_id, 'DSB', 'DYR', 'Edit')) {
      $perm_edit = 1;
    } ?>
    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'DSB')) { ?>

      <div class="row <?php if ($type != 4) {
                        echo 'd-none';
                      } ?>">
        <div class="col-md-12 col-xs-12">
          <div class="page-box">
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <h4>Day Report </h4>
              </div>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'DSB', 'DYR', 'Filter')) { ?>
                <div class="col-md-8 col-xs-8">
                  <form method="post" action="<?php echo site_url('Welcome?type=4') ?>">
                    <div class="row">

                      <div class="col-md-3 col-xs-4">
                        <label class="form-check-label">Date</label>
                        <input class="form-check-input" type="hidden" name="type" value="4">
                        <input class="form-check-input" type="date" name="to_date" value="<?php echo $to_date; ?>">
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <button class="btn btn-info" type="submit">Search</button>
                          <a href="<?php echo site_url('Welcome') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                          <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'DSB', 'DYR', 'Export')) { ?>
                            <button type="button" class="btn btn-success" onclick="printInvoice()">Print</button>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <h5>Last Updated : <?= isset($repot_data['d_data_updatedon']) ? date('d-m-Y h:i A', strtotime($repot_data['d_data_updatedon'])) : '--' ?></h5>
                      </div>
                    </div>
                  </form>
                </div>
              <?php } ?>
            </div>

            <div class="print" id="print_head">
              <h4>Day Report </h4>
              <h4>Date: <?= date('d-m-Y', strtotime($to_date)); ?> </h4>

            </div>

            <div class="advance-table print">
              <form action="<?= base_url('Welcome/insert_dayreport_data') ?>" method="post">
                <table id="my_tbl" class="table table-striped table-bordered">
                  <thead>
                    <tr>

                      <th>S.NO</th>
                      <th>Department</th>
                      <th>Total Business</th>
                      <th>Paytm/Phone Pay</th>
                      <th>Discount/dep Exp</th>
                      <th>Balance</th>
                      <th>Final Cash</th>
                      <th>Cash Handover</th>

                    </tr>
                  </thead>
                  <tbody>

                    <tr onclick="window.location.href='<?= base_url('Welcome/ticket_band_report/') . $to_date ?>'">

                      <td>1</td>
                      <td>WP RECEPTION/AD
                        <input type="hidden" id="ticket_paytm" value="<?= $tik_data['Ticket_Paytm'] ?>">
                        <input type="hidden" id="ticket_phonep" value="<?= $tik_data['Ticket_PhoneP'] ?>">
                        <input type="hidden" id="ticket_other" value="<?= $tik_data['Ticket_other'] ?>">
                        <input type="hidden" id="ticket_total" value="<?= $tik_data['Total_buissness'] ?>">
                        <input type="hidden" id="ticket_voucher" value="<?= $tik_data['total_voucher'] ?>">
                        <input type="hidden" id="ticket_upi" value="<?= $tik_data['Ticket_Upi'] ?>">
                        <input type="hidden" id="ticket_discount" value="<?= $tik_data['Ticket_discount'] ?>">
                        <input type="hidden" id="ticket_balance" value="<?= $tik_data['Ticket_balance'] ?>">
                        <input type="hidden" id="ticket_cash" value="<?= $tik_data['Ticket_Cash'] ?>">
                        <input type="hidden" id="ticket_refund" value="<?= $tik_data['Total_refund'] ?>">
                      </td>
                      <td><?= ($tik_data['Total_buissness'] + $tik_data['total_voucher']) ?: 'Nil' ?></td>
                      <td><?= $tik_data['Ticket_Upi'] ?: 'Nil' ?></td>
                      <td><?= $tik_data['Ticket_discount'] ?: 'Nil' ?></td>
                      <td><?= $tik_data['Ticket_balance'] ?: 'Nil' ?></td>
                      <td id="tick_finalcash"></td>
                      <td></td>

                    </tr>
                    <tr onclick="window.location.href='<?= base_url('Welcome/costume_department_report/') . $to_date ?>'">

                      <td>2</td>
                      <td>COSTUME
                        <input type="hidden" id="costume_paytm" value="<?= $cos_data['Costume_Paytm'] ?>">
                        <input type="hidden" id="costume_phonep" value="<?= $cos_data['Costume_PhoneP'] ?>">
                        <input type="hidden" id="costume_other" value="<?= $cos_data['Costume_other'] ?>">
                        <input type="hidden" id="costume_total" value="<?= $cos_data['Costume_total'] ?>">
                        <input type="hidden" id="costume_voucher" value="<?= $cos_data['Costume_voucher'] ?>">
                        <input type="hidden" id="costume_upi" value="<?= $cos_data['Costume_Upi'] ?>">
                        <input type="hidden" id="costume_discount" value="<?= $cos_data['Costume_discount'] ?>">
                        <input type="hidden" id="costume_balance" value="<?= $cos_data['Costume_balance'] ?>">
                        <input type="hidden" id="costume_cash" value="<?= $cos_data['Costume_Cash'] ?>">
                      </td>
                      <td><?= ($cos_data['Costume_total'] + $cos_data['Costume_voucher']) ?: 'Nil' ?></td>
                      <td><?= $cos_data['Costume_Upi'] ?: 'Nil' ?></td>
                      <td><?= $cos_data['Costume_discount'] ?: 'Nil' ?></td>
                      <td><?= $cos_data['Costume_balance'] ?: 'Nil' ?></td>
                      <td id="cos_finalcash"></td>
                      <td></td>

                    </tr>

                    <!-- <tr>

                      <td>3</td>
                      <td>WP FOOD COURT</td>
                      <td><input type="text" class="form-control" name="d_fc_cash" id="d_fc_cash" value="<?= isset($repot_data['d_fc_cash']) ? $repot_data['d_fc_cash'] : 0 ?>"></td>
                      <td>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="text" class="form-control calclas" name="d_fc_paytm" id="d_fc_paytm" value="<?= isset($repot_data['d_fc_paytm']) ? $repot_data['d_fc_paytm'] : 0 ?>">
                          </div>
                          <div class="col-md-6">
                            <input type="text" class="form-control calclas" name="d_fc_phonepay" id="d_fc_phonepay" value="<?= isset($repot_data['d_fc_phonepay']) ? $repot_data['d_fc_phonepay'] : 0 ?>">
                          </div>
                        </div>
                      </td>


                      <td><input type="hidden" class="form-control" name="d_data_id" id="d_data_id" value="<?= isset($repot_data['d_data_id']) ? $repot_data['d_data_id'] : '' ?>">
                        <input type="hidden" class="form-control" name="d_data_date" id="d_data_date" value="<?= isset($repot_data['d_data_date']) ? $repot_data['d_data_date'] : $to_date ?>">
                        <input type="text" class="form-control calclas" name="d_fc_discount" id="d_fc_discount" value="<?= isset($repot_data['d_fc_discount']) ? $repot_data['d_fc_discount'] : 0 ?>">
                      </td>
                      <td><input type="text" class="form-control calclas" name="d_fc_balance" id="d_fc_balance" value="<?= isset($repot_data['d_fc_balance']) ? $repot_data['d_fc_balance'] : 0 ?>"></td>
                      <td id="fc_fcash">0</td>
                      <td></td>

                    </tr> -->

                    <tr>

                      <td>3</td>
                      <td>WP FOOD COURT
                        <input type="hidden" class="form-control" name="d_data_id" id="d_data_id" value="<?= isset($repot_data['d_data_id']) ? $repot_data['d_data_id'] : '' ?>">
                        <input type="hidden" class="form-control" name="d_data_date" id="d_data_date" value="<?= isset($repot_data['d_data_date']) ? $repot_data['d_data_date'] : $to_date ?>">
                        <input type="hidden" name="d_fc_paytm" id="d_fc_paytm" value="<?= isset($repot_data['d_fc_paytm']) ? $repot_data['d_fc_paytm'] : 0 ?>">
                        <input type="hidden" name="d_fc_phonepay" id="d_fc_phonepay" value="<?= isset($repot_data['d_fc_phonepay']) ? $repot_data['d_fc_phonepay'] : 0 ?>">
                        <input type="hidden" name="d_fc_other" id="d_fc_other" value="<?= isset($repot_data['d_fc_other']) ? $repot_data['d_fc_other'] : 0 ?>">
                        <input type="hidden" name="d_fc_total" id="d_fc_total" value="<?= isset($repot_data['d_fc_total']) ? $repot_data['d_fc_total'] : 0 ?>">

                        <input type="hidden" name="d_fc_totupi" id="d_fc_totupi" value="<?= isset($repot_data['d_fc_totupi']) ? $repot_data['d_fc_totupi'] : 0 ?>">
                        <input type="hidden" name="d_fc_discount" id="d_fc_discount" value="<?= isset($repot_data['d_fc_discount']) ? $repot_data['d_fc_discount'] : 0 ?>">
                        <input type="hidden" name="d_fc_balance" id="d_fc_balance" value="<?= isset($repot_data['d_fc_balance']) ? $repot_data['d_fc_balance'] : 0 ?>">
                        <input type="hidden" name="d_fc_cash" id="d_fc_cash" value="<?= isset($repot_data['d_fc_cash']) ? $repot_data['d_fc_cash'] : 0 ?>">
                      </td>
                      <td><?= isset($repot_data['d_fc_total']) ? $repot_data['d_fc_total'] : 'nill' ?></td>
                      <td><?= isset($repot_data['d_fc_totupi']) ? $repot_data['d_fc_totupi'] : 0 ?></td>
                      <td> <?= isset($repot_data['d_fc_discount']) ? $repot_data['d_fc_discount'] : 'nill' ?> </td>
                      <td><?= isset($repot_data['d_fc_balance']) ? $repot_data['d_fc_balance'] : 'nill' ?></td>
                      <td id="fc_fcash">0</td>
                      <td></td>

                    </tr>

                    <tr>

                      <td>4</td>
                      <td>RESORT + FOOD</td>
                      <td><input type="hidden" class="form-control" id="d_rtc_cash" value="<?= isset($repot_data['d_rtc_total']) ? $repot_data['d_rtc_total'] : 0 ?>"><?= isset($repot_data['d_rtc_total']) ? $repot_data['d_rtc_total'] : 'Nill' ?></td>
                      <td>
                        <input type="hidden" class="form-control" id="d_rtc_paytm" value="<?= isset($repot_data['d_rtc_paytm']) ? $repot_data['d_rtc_paytm'] : 0 ?>">
                        <input type="hidden" class="form-control" id="d_rtc_phonepay" value="<?= isset($repot_data['d_rtc_phonepay']) ? $repot_data['d_rtc_phonepay'] : 0 ?>">
                        <?= isset($repot_data['d_rtc_upi']) ? $repot_data['d_rtc_upi'] : 'Nil' ?>
                      </td>

                      <td><input type="hidden" class="form-control" id="d_rtc_discount" value="<?= isset($repot_data['d_rtc_discount']) ? $repot_data['d_rtc_discount'] : 0 ?>"><?= isset($repot_data['d_rtc_discount']) ? $repot_data['d_rtc_discount'] : 'Nil' ?></td>
                      <td><input type="hidden" class="form-control" id="d_rtc_balance" value="<?= isset($repot_data['d_rtc_balance']) ? $repot_data['d_rtc_balance'] : 0 ?>"><?= isset($repot_data['d_rtc_balance']) ? $repot_data['d_rtc_balance'] : 'Nil' ?></td>
                      <td id="rtc_fcash">0</td>
                      <td></td>

                    </tr>
                    <tr>

                      <td>5</td>
                      <td>CAMP + FOOD</td>
                      <td><input type="hidden" class="form-control" id="d_camp_cash" value="<?= isset($repot_data['d_camp_total']) ? $repot_data['d_camp_total'] : 0 ?>"><?= isset($repot_data['d_camp_total']) ? $repot_data['d_camp_total'] : 'Nill' ?></td>
                      <td>
                        <input type="hidden" class="form-control" id="d_camp_paytm" value="<?= isset($repot_data['d_camp_paytm']) ? $repot_data['d_camp_paytm'] : 0 ?>">
                        <input type="hidden" class="form-control" id="d_camp_phonepay" value="<?= isset($repot_data['d_camp_phonepay']) ? $repot_data['d_camp_phonepay'] : 0 ?>">
                        <?= isset($repot_data['d_camp_upi']) ? $repot_data['d_camp_upi'] : 'Nil' ?>
                      </td>

                      <td><input type="hidden" class="form-control" id="d_camp_discount" value="<?= isset($repot_data['d_camp_discount']) ? $repot_data['d_camp_discount'] : 0 ?>"><?= isset($repot_data['d_camp_discount']) ? $repot_data['d_camp_discount'] : 'Nil' ?></td>
                      <td><input type="hidden" class="form-control" id="d_camp_balance" value="<?= isset($repot_data['d_camp_balance']) ? $repot_data['d_camp_balance'] : 0 ?>"><?= isset($repot_data['d_camp_balance']) ? $repot_data['d_camp_balance'] : 'Nil' ?></td>
                      <td id="camp_fcash">0</td>
                      <td></td>

                    </tr>
                    <tr>

                      <th colspan="2">TOTAL CALCULATION</th>
                      <th id="sum_bussi">0</th>
                      <th class="sum_total_upi">0</th>
                      <th id="sum_total_dis">0</th>
                      <th class="sum_total_blnc">0</th>
                      <th id="sum_total_cash">0</th>
                      <th></th>

                    </tr>
                    <tr>

                      <td colspan="3">Remark For UPI :- <input type="text" class="form-control" name="d_data_upiremark" id="d_data_upiremark" value="<?= isset($repot_data['d_data_upiremark']) ? $repot_data['d_data_upiremark'] : '' ?>"></td>

                      <td colspan="3" rowspan="4">
                        <div class="row">
                          <div class="col-md-6">
                            <h6 style="margin-bottom: 5px;">Expense</h6>
                            <ol>
                              <?php $total_expense = 0;
                              if (!empty($report_list_data['expense_list'])) {

                                foreach ($report_list_data['expense_list'] as $key => $value) {
                                  $total_expense += $value->m_expense_amt;
                                  echo '<li>' . ($key + 1) . ') ₹' . ($value->m_expense_amt) . ' - ' . $value->m_prodcat_name . ' (' . $value->m_dept_name . ') ' . $value->m_cashacc_name . ' by ' . $value->m_admin_name . '
                                  </li>';
                                }
                              } ?>

                            </ol>
                          </div>

                          <div class="col-md-6">
                            <h6 style="margin-bottom: 5px;">Advance</h6>
                            <ol>
                              <?php if (!empty($report_list_data['advance_list'])) {

                                foreach ($report_list_data['advance_list'] as $key => $value) {
                                  $total_expense += $value->m_advance_amt;
                                  echo '<li>' . ($key + 1) . ') ₹' . ($value->m_advance_amt) . ' - ' . $value->m_emp_name . '-' . $value->m_emp_mobile . ' ' . $value->m_cashacc_name . ' by ' . $value->m_admin_name . '
                                  </li>';
                                }
                              } ?>

                            </ol>
                          </div>
                        </div>

                      </td>
                      <td>Total</td>
                      <td>DATE:- <?= date('d-m-Y', strtotime($to_date)); ?></td>

                    </tr>
                    <tr>
                      <td>PHONE PAY</td>
                      <td colspan="2" id="sum_total_phonep"></td>
                      <td rowspan="3"><input type="hidden" class="form-control" id="total_expense" value="<?= $total_expense ?>">₹<?= $total_expense ?></td>
                      <td rowspan="4">Amount</td>
                    </tr>
                    <tr>
                      <td>Paytm</td>
                      <td colspan="2" id="sum_total_paytm"></td>
                    </tr>
                    <tr>

                      <td>Total UPI</td>
                      <td colspan="2" class="sum_total_upi"></td>
                    </tr>
                    <tr>
                      <td colspan="3" rowspan="4">
                        Remark

                        <ol>
                          <?php $total_voucher = 0;
                          if (!empty($report_list_data['voucher_list'])) {

                            foreach ($report_list_data['voucher_list'] as $key => $value) {
                              $total_voucher += $value->m_expense_amt;
                              echo '<li>' . ($key + 1) . ') ₹' . ($value->m_expense_amt) . ' - ' . $value->m_prodcat_name . ' (' . $value->m_dept_name . ') ' . $value->m_cashacc_name . ' by ' . $value->m_admin_name . '
                                  </li>';
                            }
                          } ?>

                        </ol>
                        <input type="hidden" class="form-control" id="total_voucher" value="<?= $total_voucher ?>">
                        <textarea type="text" rows="2" class="form-control" name="d_data_remark" id="d_data_remark"><?= isset($repot_data['d_data_remark']) ? $repot_data['d_data_remark'] : '' ?></textarea>
                      </td>
                      <td colspan="3" rowspan="4">
                        <div class="row">
                          <div class="col-md-6">
                            <h6 style="margin-bottom: 5px;">Reception Balance</h6>
                            <ol>
                              <?php if (!empty($report_list_data['tick_balnce'])) {
                                foreach ($report_list_data['tick_balnce'] as $key => $value) {
                                  echo '<li>' . ($key + 1) . ')₹ ' . ($value->m_ticket_balAmt + $value->locker_balamt + $value->costume_balamt) . ' (' . $value->m_cust_name . ' - ' . $value->m_cust_mobile . ' -' . $value->m_city_name . ') by ' . $value->m_emp_name . '
                                  </li>';
                                }
                              } ?>

                            </ol>
                          </div>

                          <div class="col-md-6">
                            <h6 style="margin-bottom: 5px;">Restuarent and Resort Balance</h6>
                            <ol>
                              <?php if (!empty($repot_data['balance_list'])) {
                                foreach ($repot_data['balance_list'] as  $rfble) {
                                  echo '<li> ₹ ' . $rfble->bl_amount  . ' (' . $rfble->cust_name . ' - ' . $rfble->cust_mobile  . ') by ' . $rfble->emp_name . '
                                  </li>';
                                }
                              } ?>
                            </ol>
                            <textarea type="text" class="form-control" name="d_data_rrbaln" id="d_data_rrbaln"><?= isset($repot_data['d_data_rrbaln']) ? $repot_data['d_data_rrbaln'] : '' ?></textarea>
                          </div>
                        </div>
                      </td>
                      <td>Total</td>

                    </tr>
                    <tr>

                      <td rowspan="3" class="sum_total_blnc"></td>
                      <td rowspan="3">Sign</td>
                    </tr>

                  </tbody>

                  <tr>
                    <th colspan="8" class="color">for office use only</th>
                  </tr>
                  <tr>
                    <td>S.no</td>
                    <td>Total Bussiness</td>
                    <td>Total UPI</td>
                    <td colspan="2">Total Expenses /Balance/Discount</td>
                    <td>cash total</td>
                    <td colspan="2">handover detalis</td>
                  </tr>

                  <tr>
                    <td rowspan="2">1</td>
                    <td rowspan="2" class="sum_total_bussi"></td>

                    <td rowspan="2" class="sum_total_upi"></td>
                    <td rowspan="2" colspan="2" id="sum_total_expense"></td>
                    <td rowspan="2" id="final_cash"></td>
                    <td class="text-start">name :-</td>
                  </tr>
                  <tr>
                    <td class="text-start">sign :-</td>
                  </tr>
                </table>
                <?php if ($perm_add == 1 || $perm_edit == 1) {
                  echo '<div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-sm btn-primary" type="submit">submit</button>

                  </div>
                </div>';
                } ?>

              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row <?php if ($type != 1) {
                        echo 'd-none';
                      } ?>">
        <div class="col-md-12">
          <div class="page-box">
            <div class="row">
              <div class="col-md-4 print">
                <h4>Day Summary </h4>
              </div>
              <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'DSB', 'DSY', 'Filter')) { ?>
                <div class="col-md-8">
                  <form method="post" action="<?php echo site_url('Welcome?type=1') ?>">
                    <div class="row">

                      <div class="col-md-3 print">
                        <label class="form-check-label">Date</label>
                        <input class="form-check-input" type="hidden" name="type" value="1">
                        <input class="form-check-input" type="date" name="to_date" value="<?php echo $to_date; ?>">
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <button class="btn btn-info" type="submit">Search</button>
                          <a href="<?php echo site_url('Welcome') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                          <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'DSB', 'DSY', 'Export')) { ?>
                            <button type="button" class="btn btn-success" onclick="printInvoice()">Print</button>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              <?php } ?>
            </div>
            <div class="advance-table print">
              <table id="my_tbl" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="5%"></th>
                    <th></th>
                    <th title="Contact">Rent</th>
                    <th title="Email">Deposit</th>
                    <th title="Subject">Refund</th>
                    <th title="Instersted">Balance</th>
                    <th title="Instersted">Final Cash</th>

                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="2" class="tdhead">Ticket Sales</td>

                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                  </tr>
                  <?php
                  $i = 1;
                  $grandtotalticket = 0;
                  if (!empty($all_ticket_count)) {
                    foreach ($all_ticket_count as $value) {
                      $grandtotalticket  += $value->total_amount;
                  ?>
                      <tr>
                        <td title="Serial Number"></td>
                        <td title="Title"><?php echo $value->m_cashacc_name; ?></td>
                        <td title="Title"><?php echo $value->total_amount; ?></td>
                        <td title="Title"></td>
                        <td title="Title"></td>
                        <td title="Title"></td>
                        <td title="Title"></td>

                      </tr>

                  <?php
                      $i++;
                    }
                  }
                  ?>
                  <tr class="trtotal">
                    <td title="Serial Number"></td>
                    <td title="Title">Total</td>
                    <td title="Title"><?php echo $grandtotalticket; ?></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"><?php echo $grandtotalticket; ?></td>

                  </tr>


                  <tr>
                    <td colspan="2" class="tdhead">Locker Sales</td>

                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>

                  </tr>
                  <?php

                  $grandtotallocker = 0;
                  if (!empty($all_locker_count)) {
                    foreach ($all_locker_count as $value) {
                      $grandtotallocker  += $value->total_rent;
                  ?>
                      <tr>
                        <td title="Serial Number"></td>
                        <td title="Title"><?php echo $value->m_cashacc_name; ?></td>
                        <td title="Title"><?php echo $value->total_rent; ?></td>
                        <td title="Title"><?php echo $value->total_deposit; ?></td>
                        <td title="Title"><?php echo $value->total_deposit; ?></td>
                        <td title="Title"></td>
                        <td title="Title"></td>

                      </tr>

                  <?php
                      $i++;
                    }
                  }
                  ?>
                  <tr class="trtotal">
                    <td title="Serial Number"></td>
                    <td title="Title">Total</td>
                    <td title="Title"><?php echo $grandtotallocker; ?></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"><?php echo $grandtotallocker; ?></td>

                  </tr>
                  <tr>
                    <td colspan="2" class="tdhead">Costume Sales</td>

                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>

                  </tr>
                  <?php
                  $i = 1;
                  $grandtotalcostume = 0;
                  if (!empty($all_costume_count)) {
                    foreach ($all_costume_count as $value) {
                      $grandtotalcostume  += $value->total_rent;
                  ?>
                      <tr>
                        <td title="Serial Number"></td>
                        <td title="Title"><?php echo $value->m_cashacc_name; ?></td>
                        <td title="Title"><?php echo $value->total_rent; ?></td>
                        <td title="Title"><?php echo $value->total_deposit; ?></td>
                        <td title="Title"><?php echo $value->total_deposit; ?></td>
                        <td title="Title"></td>
                        <td title="Title"></td>

                      </tr>

                  <?php
                      $i++;
                    }
                  }
                  ?>
                  <tr class="trtotal">
                    <td title="Serial Number"></td>
                    <td title="Title">Total</td>
                    <td title="Title"><?php echo $grandtotalcostume; ?></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"><?php echo $grandtotalcostume; ?></td>

                  </tr>
                  <tr>
                    <td title="Serial Number"></td>
                    <td title="Title" class="tdhead">Grand Total</td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title"></td>
                    <td title="Title" class="tdhead"><?php echo $grandtotalcostume + $grandtotalticket + $grandtotallocker; ?></td>

                  </tr>

                  <tr class="trtotal">
                    <td colspan="5"><strong>Lockers Available : <?php if (!empty($locker_available)) {
                                                                  echo $locker_available;
                                                                } ?> ,as on <?= date('d-m-Y h:i') ?></strong></td>
                    <td></td>
                    <td></td>

                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row <?php if ($type != 2) {
                        echo 'd-none';
                      } ?>">
        <div class="col-md-12">
          <div class="page-box ">
            <div class="row">
              <div class="col-md-4 print">
                <h4>Cash Bank Account Summary</h4>
              </div>

              <div class="col-md-8">
                <form method="post" action="<?php echo site_url('Welcome?type=2') ?>">
                  <div class="row">

                    <div class="col-md-3 print">
                      <label class="form-check-label">From Date</label>
                      <input class="form-check-input " type="date" name="from_date" value="<?php echo $from_date; ?>">
                      <input class="form-check-input " type="hidden" name="type" value="2">
                    </div>
                    <div class="col-md-3 print">
                      <label class="form-check-label">To Date</label>
                      <input class="form-check-input " type="date" name="to_date" value="<?php echo $to_date; ?>">
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <button class="btn btn-info" type="submit">Search</button>
                        <a href="<?php echo site_url('Welcome?type=2') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                        <button type="button" class="btn btn-success" onclick="printInvoice()">Print</button>
                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>
            <div class="advance-table print">
              <table id="my_tbl" class="my_custom_datatable table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Sn</th>
                    <th>Dated</th>
                    <th>Cash-Bank Account</th>
                    <th>Amt-In</th>
                    <th>Amt-Out</th>
                    <th>Balance</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  $grandtotalbalance = 0;
                  $grandtotalAmtOut = 0;
                  $grandtotalAmtIn = 0;
                  if (!empty($all_in_out)) {
                    foreach ($all_in_out as $value) {
                      if (!empty($value->total_deposit)) {
                        $AmtIn = $value->total_rent + $value->total_deposit;
                      } else {
                        $AmtIn = $value->total_rent;
                      }
                      if (!empty($value->total_deposit)) {
                        $Amtout = $value->total_deposit;
                      } else {
                        $Amtout = 0;
                      }
                      $grandtotalAmtIn  += $AmtIn;
                      $grandtotalAmtOut  += $Amtout;
                      $grandtotalbalance  += $value->total_rent;
                  ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= date('d-m-Y', strtotime($value->dated)); ?></td>
                        <td><?= $value->m_cashacc_name; ?></td>
                        <td><?php if (!empty($value->total_deposit)) {
                              echo $value->total_rent + $value->total_deposit;
                            } else {
                              echo $value->total_rent;
                            } ?></td>
                        <td><?php if (!empty($value->total_deposit)) {
                              echo $value->total_deposit;
                            } ?></td>
                        <td><?= $value->total_rent; ?></td>

                      </tr>

                  <?php
                      $i++;
                    }
                  }
                  ?>
                  <tr class="trtotal">
                    <td title="Serial Number"></td>
                    <td title="Title"></td>
                    <td title="Title">Total</td>
                    <td title="Title"><?php echo $grandtotalAmtIn; ?></td>
                    <td title="Title"><?php echo $grandtotalAmtOut; ?></td>
                    <td title="Title"><?php echo $grandtotalbalance; ?></td>

                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

      <div class="row <?php if ($type != 3) {
                        echo 'd-none';
                      } ?>">
        <div class="col-md-12">
          <div class="page-box">
            <div class="row">
              <div class="col-md-4 print">
                <h4>Cash Bank Account Detail</h4>
              </div>
              <div class="col-md-8">
                <form method="post" action="<?php echo site_url('Welcome?type=3') ?>">
                  <div class="row">

                    <div class="col-md-3 print">
                      <label class="form-check-label">From Date</label>
                      <input class="form-check-input " type="date" name="from_date" value="<?php echo $from_date; ?>">
                      <input class="form-check-input " type="hidden" name="type" value="2">
                    </div>
                    <div class="col-md-3 print">
                      <label class="form-check-label">To Date</label>
                      <input class="form-check-input " type="date" name="to_date" value="<?php echo $to_date; ?>">
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <button class="btn btn-info" type="submit">Search</button>
                        <a href="<?php echo site_url('Welcome?type=3') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                        <button type="button" class="btn btn-success" onclick="printInvoice()">Print</button>
                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>

            <div class="advance-table print">
              <table id="my_tbl" class="my_custom_datatable table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Sn</th>
                    <th>Dated</th>
                    <th>Cash-Bank Account</th>
                    <th>Amt-In</th>
                    <th>Amt-Out</th>
                    <th>Narration</th>
                    <th>Balance</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  $grandtotalbalance = 0;
                  $grandtotalAmtOut = 0;
                  $grandtotalAmtIn = 0;
                  if (!empty($in_out_detail)) {
                    foreach ($in_out_detail as $value) {
                      if (!empty($value->total_deposit)) {
                        $AmtIn = $value->total_rent + $value->total_deposit;
                      } else if (!empty($value->total_rent)) {
                        $AmtIn = $value->total_rent;
                      } else {
                        $AmtIn = 0;
                      }
                      if (!empty($value->total_deposit)) {
                        $Amtout = $value->total_deposit;
                      } else {
                        $Amtout = 0;
                      }
                      if (!empty($value->total_rent)) {
                        $Amtbal = $value->total_rent;
                      } else {
                        $Amtbal =  0;
                      }
                      $grandtotalAmtIn  += $AmtIn;
                      $grandtotalAmtOut  += $Amtout;
                      $grandtotalbalance  += $Amtbal;
                  ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= date('d-m-Y', strtotime($value->dated)); ?></td>
                        <td><?= $value->m_cashacc_name; ?></td>
                        <td><?php if (!empty($value->total_deposit)) {
                              echo $value->total_rent + $value->total_deposit;
                            } else if (!empty($value->total_rent)) {
                              echo $value->total_rent;
                            } ?></td>
                        <td><?php if (!empty($value->refund)) {
                              echo $value->refund;
                            } ?></td>
                        <td><?php if (!empty($value->total_person)) {
                              echo 'Sales of Ticket Against ' . $value->total_person . ' Guests';
                            } else if (!empty($value->m_locker_Tlocker)) {
                              if (!empty($value->refund)) {
                                echo 'Refund Locker Amt for items ' . $value->m_locker_Tlocker;
                              } else {
                                echo 'Locker on Rent : Total items ' . $value->m_locker_Tlocker;
                              }
                            } else {
                              if (!empty($value->refund)) {
                                echo 'Refund Costume Amt for items ' . $value->m_costume_Tqty;
                              } else {
                                echo 'Costume on Rent : Total items ' . $value->m_costume_Tqty;
                              }
                            } ?></td>
                        <td><?= $Amtbal; ?></td>

                      </tr>

                  <?php
                      $i++;
                    }
                  }
                  ?>
                  <tr class="trtotal">
                    <td title="Serial Number"></td>
                    <td title="Title"></td>
                    <td title="Title">Total</td>
                    <td title="Title"><?php echo $grandtotalAmtIn; ?></td>
                    <td title="Title"><?php echo $grandtotalAmtOut; ?></td>
                    <td title="Title"></td>
                    <td title="Title"><?php echo $grandtotalbalance; ?></td>

                  </tr>

                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer') ?>
<?php $this->view('js/dashboard_js'); ?>
<?php $this->view('js/custom_js'); ?>
<!-- =======================/Footer================Fix======= -->

<!-- =======================/Script========================== -->