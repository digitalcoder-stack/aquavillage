<?php $this->view('header') ?>
<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcromb-area">
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="seipkon-breadcromb-left">
                <h3>Notification List</h3>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 pull-right">
              <div class="seipkon-breadcromb-right">
                <a href="<?php  echo site_url('Notification/add_notification') ?>" class="btn btn-info"><i class="fa fa-plus"></i> Add New </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="page-box">
          <div class="advance-table">
            <table id="not_tbl" class="my_custom_datatable table display table-striped table-bordered">
              <thead>
                <th>S.No.</th>
                <th>Date</th>
                <th>User Name</th>
                <th>Notification Title</th>
                <th>Notification Message</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                if(!empty($all_values)){
                  foreach($all_values as $i => $vl){
                    echo"<tr>
                    <td title='S.No.'>".($i+1)."</td>
                    <td title='Date'>".date(DT_FRMT[get_settings('app_date_format')], strtotime($vl->nofification_date))."</td>
                    <td title='Student'>".$vl->kh_user_fname."</td>
                    <td title='Title'>".$vl->notification_text."</td>
                    <td title='Message'>".$vl->notification_desc."</td>
                    <td style='white-space: nowrap;'>
                    <button class='btn btn-danger btn-action delete-noti' data-value='".$vl->notification_id."' title='Delete' data-toggle='tooltip'><i class='fa fa-trash'></i></button>
                    </td>
                    </tr>";
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
  </div>
</div>
<?php $this->view('top_footer'); ?>
<?php $this->view('js/custom_js'); ?>
<?php $this->view('js/notification_js'); ?>