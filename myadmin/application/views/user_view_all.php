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

  .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 12px; }
  .select2-container--default .select2-selection--single .select2-selection__arrow b { top: 30%; }
  .select2-selection.select2-selection--single{ height: auto; }
</style>
<!-- ======================Page Style======================== -->

<!-- ======================Page Title======================== -->
<!-- Breadcromb Row Start -->
<div class="row">
   <div class="col-md-12">
      <div class="breadcromb-area">
         <div class="row">
            <div class="col-md-2 col-sm-2">
              <div class="seipkon-breadcromb-left">
                <h3><?php echo $pagename ?></h3>
              </div>
            </div>
            <div class="col-md-10 col-sm-10">
        <form method="GET" action="<?php echo site_url('User'); ?>">
  <table style="width: 100%;">
    <tbody>
      <tr>
        <td></td>
        <td width="4%">City</td>
        <td width="20%">
          <input type="text" name="ct" value="<?php  echo $ct_id; ?>"  style="width: 100%;" placeholder="Enter . . .">
        </td>
        <td width="1%"></td>
        <td width="3%">
          <button type="submit" class="btn btn-block btn-info btn-vsm">Go</button>
        </td>
        <td width="2%"></td>
        <td width="5%">
          <a href="<?php echo site_url('User'); ?>"><button type="button" class="btn btn-block btn-success btn-vsm">Reset</button></a>
        </td>
        <td></td>
      </tr>
    </tbody>
  </table>
          </form>
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
                                            <div style="overflow-x: scroll;">
      <div class="advance-table">
        <table id="user_tbl" class="my_custom_datatable table table-striped table-bordered">
          <thead>
            <tr>
              <th width="5%" title="Serial Number">S.No.</th>
              <th title="Name">Name</th>
              <th title="Email">Email</th>
              <th title="Phone No.">Phone No.</th>
              <th title="City">City</th>
              <th title="Added On">Added On</th>
              <th title="Listings">Listings</th>
              <th width="8%" title="Action">Action</th>
            </tr>
          </thead>
          <tbody>
<?php if (!empty($all_value)) { 
  $edit_link= site_url('User/edit?id=');
  $dtl_link = site_url('User/details?id=');
  foreach ($all_value as $i => $vl) {
?>
<tr>
  <td title="Serial Number"><?php echo $i+1; ?></td>
  <td title="Name"><?php echo $vl->m_user_name; ?></td>
  <td title="Email" style="text-transform: none;"><?php echo $vl->m_user_email; ?></td>
  <td title="Phone No."><?php echo $vl->m_user_mobile; ?></td>
  <td title="City"><?php echo $vl->mcity_name; ?></td>
  <td title="Added On"><?php echo $vl->added_on; ?></td>
  <td title="Total Listings"><span class="btn btn-info" title="Total Listings"><?php echo $vl->m_user_listings_no; ?></span></td>
  <td title="Action" style="white-space: nowrap;">
    <a href="<?php echo $dtl_link.$vl->m_user_id; ?>" class="btn btn-info btn-action" title="View" data-toggle="tooltip"><i class="fa fa-eye"></i></a> <a href="<?php echo $edit_link.$vl->m_user_id; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a> <button class="btn btn-danger btn-action delete-user" data-value="<?php echo $vl->m_user_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
  </td>
</tr>
<?php } } ?>
          </tbody>
        </table>  
      </div>
                                            </div>  
    </div>
  </div>
</div>
<!-- View Counselor Area End -->
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
<!-- ========================Script==========================