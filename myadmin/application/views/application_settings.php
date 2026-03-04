<?php $this->view('top_header') ?>
<div class="page-content">
  <div class="container-fluid">
    <style type="text/css">
      .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 18px;
      }

      .select2-container--default .select2-selection--single .select2-selection__arrow b {
        top: 30%;
      }

      .select2-selection.select2-selection--single {
        height: auto;
      }
    </style>

    <!-- Breadcromb Row Start -->
    <div class="breadcromb-area">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="seipkon-breadcromb-left">
            <h3><?php echo $pagename ?></h3>
          </div>
        </div>
      </div>
    </div>

    <?php if ($pagetype == 1) { ?>


      <div class="page-box">
        <form method="POST" action="#" id="frm-update">
          <div class="row">
            <input type="hidden" name="appid" value="<?php echo $app_details[0]->m_app_id ?>">
            <div class="col-md-12">
              <div class="row">


                <div class="col-md-2">
                  <div class="form-group">
                    <label class="control-label">Application Name <span class="text-danger">*</span></label>
                    <input value="<?php echo $app_details[0]->m_app_name ?>" type="text" required placeholder="App Name" class="form-control" name="m_app_name">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label class="control-label">Application Title</label>
                    <input value="<?php echo $app_details[0]->m_app_title ?>" type="text" name="m_app_title" placeholder="App Title" class="form-control">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label class="control-label">Application Mail</label>
                    <input value="<?php echo $app_details[0]->m_app_email  ?>" type="text" name="m_app_mail" placeholder="App Mail" class="form-control">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label class="control-label">Application Contact</label>
                    <input value="<?php echo $app_details[0]->m_app_mobile  ?>" type="text" name="m_app_contact" placeholder="App Contact" class="form-control">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Application Address</label>
                    <textarea name="m_app_address" class="form-control"><?php echo $app_details[0]->m_app_address ?></textarea>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" data-toggle="toggle" <?= $app_details[0]->is_today_holiday == 1 ? 'checked':'' ?> value="1" name="is_today_holiday">
                      Treat Today as Weekend
                    </label>
                  </div>
                 
                </div>

              </div>
            </div>

            <div class="col-md-12" style="padding-top: 15px;">
              <div class="row">
                <div class="col-md-4" style="border: 2px solid #f1f2f4;height: 200px;">
                  <div class="form-group">
                    <?php
                    if (!empty($app_details[0]->m_app_logo) && file_exists('uploads/' . $app_details[0]->m_app_logo)) {
                      $applogo = base_url('uploads/' . $app_details[0]->m_app_logo);
                    } else {
                      $applogo = base_url('uploads/blank.jpg');
                    }
                    ?>
                    <img style="max-height:120px" src="<?php echo $applogo ?>" class="img-responsive img-thumbnail" />
                    <br>
                    <label class="control-label">Application Logo</label>
                    <input type="hidden" name="applogo" value="<?php echo $app_details[0]->m_app_logo ?>">
                    <input type="file" name="m_app_logo" class="form-control">
                  </div>
                </div>
                <div class="col-md-4" style="border: 2px solid #f1f2f4;height: 200px;">
                  <div class="form-group">
                    <?php
                    if (!empty($app_details[0]->m_app_icon) && file_exists('uploads/' . $app_details[0]->m_app_icon)) {
                      $appfavi = base_url('uploads/' . $app_details[0]->m_app_icon);
                    } else {
                      $appfavi = base_url('uploads/blank.jpg');
                    }
                    ?>
                    <img style="max-height:50px" src="<?php echo $appfavi ?>" class="img-responsive img-thumbnail" />
                    <br>
                    <label class="control-label">Application Favicon</label>
                    <input type="hidden" name="appfavicon" value="<?php echo $app_details[0]->m_app_icon ?>">
                    <input type="file" name="m_app_icon" class="form-control">
                  </div>
                </div>
                <div class="col-md-4" style="border: 2px solid #f1f2f4;height: 200px;">
                  <div class="form-group">
                    <?php
                    if (!empty($app_details[0]->m_app_banner) && file_exists('uploads/' . $app_details[0]->m_app_banner)) {
                      $appBanner = base_url('uploads/' . $app_details[0]->m_app_banner);
                    } else {
                      $appBanner = base_url('uploads/blank.jpg');
                    }
                    ?>
                    <img style="max-height:120px;width: 100%;" src="<?php echo $appBanner ?>" class="img-responsive img-thumbnail" />
                    <br>
                    <label class="control-label">Application Banner</label>
                    <input type="hidden" name="appbanner" value="<?php echo $app_details[0]->m_app_banner ?>">
                    <input type="file" name="m_app_banner" class="form-control">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- cta -->
          <div class="row" style="padding-top: 20px;">
            <div class="col-md-3 pull-right">
              <div class="form-layout-submit">
                <button type="submit" id="btn-update" class="btn btn-block btn-info">Update Settings</button>
              </div>
            </div>
            <div class="col-md-3 pull-right">
              <div class="form-layout-submit"> <a href="<?php echo site_url('Welcome'); ?>" class="btn btn-block btn-danger">Cancel</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    <?php } else { ?>
      <div class="page-box">
        <form method="POST" action="#" id="frm-rate-band-update">
          <div class="row">
            <div class="col-md-12">
              <h4>Ticket Rates</h4>
              <div class="row">
                <?php if (!empty($wde_rate)) {
                  foreach ($wde_rate as $wder) {
                    echo '<div class="col-md-3">
    <div class="form-group">
      <label class="control-label">' . $wder->tbs_name . '</label>
      <input value="' . $wder->tbs_value . '" type="text" onkeypress="return (event.charCode >= 46 && event.charCode <= 57)" name="tbs_value[]" class="form-control">
      <input value="' . $wder->tbs_id . '" type="hidden" name="tbs_id[]">
    </div>
  </div>';
                  }
                } ?>

              </div>
            </div>


            <div class="col-md-12" style="margin-top: 20px;">
              <h4>Band Colour</h4>
              <div class="row">

                <?php if (!empty($wde_band)) {
                  foreach ($wde_band as $wdeb) { ?>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="control-label"><?= $wdeb->tbs_name ?></label>
                        <input value="<?= $wdeb->tbs_id ?>" type="hidden" name="tbs_id[]">
                        <select name="tbs_value[]" class="form-control select2">
                          <option value="">Select Band</option>
                          <?php
                          foreach ($bandcolour as $value) {
                            if ($wdeb->tbs_value == $value->m_hq_id) {
                              $option1 = "selected";
                            } else {
                              $option1 = "";
                            }
                          ?>
                            <option value="<?php echo $value->m_hq_id; ?>" <?= $option1 ?>><?php echo $value->m_hq_name ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                <?php  }
                } ?>


              </div>
            </div>

          </div>

          <!-- cta -->
          <div class="row" style="padding-top: 20px;">
            <div class="col-md-3 pull-right">
              <div class="form-layout-submit">
                <input value="<?= $pagetype ?>" type="hidden" id="pagetype">
                <button type="submit" id="btn-rate-band-update" class="btn btn-block btn-info">Update Settings</button>
              </div>
            </div>
            <div class="col-md-3 pull-right">
              <div class="form-layout-submit"> <a href="<?php echo site_url('Welcome'); ?>" class="btn btn-block btn-danger">Cancel</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    <?php } ?>

  </div>
</div>
<?php $this->view('top_footer'); ?>
<?php $this->view('js/app_settings_js'); ?>