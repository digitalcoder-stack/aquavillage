<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aqua Village</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <style>
    :root {
      --font-color: black;
      --highlight-color: #00a5ce;
      --secondary-color: #868f95;
      --header-bg-color: #B8E6F1;
      --footer-bg-color: #BFC0C3;
      --table-img-bg-color: #BFC0C3;
      --gap-size: 15px;
    }
  </style>

</head>

<body onload="window.print();">
  <section class="main-section p-4">
    <!-- header -->
    <header class="p-2 bg-light">
      <div class="row align-items-center justify-content-between g-2">
        <div class="col-3">
          <img src="<?= base_url('uploads/') . get_settings('m_app_icon') ?>" alt="" class="w-100">
        </div>
        <div class="col-8 text-end">
          <h3 class="fw-bold m-0">
            <?= get_settings('m_app_title') ?>
          </h3>
          <h6 class="m-0 mt-1 fw-semibold">Call: +91- <?= get_settings('m_app_mobile') ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Email :
            <?= get_settings('m_app_email') ?></h6>
          <p class="m-0 small ps-5">
            <small class="d-block ps-5">
              <?= get_settings('m_app_address') ?>
              <br>Rajnandgaon, India, Chhattisgarh
            </small>
          </p>
        </div>
      </div>
    </header>
    <!-- lead details -->
    <section class="py-3">
      <div class="row align-items-end">
        <div class="col-7">
          <h5 class="m-0 mb-1 fw-semibold text-secondary">Customer Details</h2>
            <h4 class="m-0 text-capitalize fw-bold">
              <?= $leadclient_dtl->m_lclient_name ?>
              <!-- <small class="badge text-bg-primary small fw-normal small ms-1">Just Reached</small> -->
            </h4>
            <h6 class="m-0 mt-1 fw-semibold text-dark">
              City : <?= $leadclient_dtl->m_city_name ?>
            </h6>
        </div>
        <div class="col-5 text-end">
          <h4 class="m-0 text-capitalize fw-semibold">
            <span class="badge text-bg-warning ms-1"><?= $lead_dtl->plan_name ?></sma>
          </h4>
          <h6 class="text-secondary fw-semibold m-0 mt-1">
            Date : <?= date('d-m-Y', strtotime($lead_dtl->m_lead_date)); ?>
            <br>Meeting With : <?= $meetwith_dtl->lc_person_name ?>
            <br>+91-<?= $meetwith_dtl->lc_person_mobileno ?>
          </h6>
        </div>
      </div>
    </section>
    <section class="py-3">
      <div class="row row-cols-5 g-2">
        <div class="col">
          <div class="card bg-light p-3 text-center rounded-4 border-1">
            <h4 class="fw-bold text-dark"><?= $lead_dtl->m_lead_ratio ?></h4>
            <h6 class="small">Ratio</h6>
          </div>
        </div>
        <div class="col">
          <div class="card bg-light p-3 text-center rounded-4 border-1">
            <h4 class="fw-bold text-dark"><?= $lead_dtl->m_lead_minvisits ?></h4>
            <h6 class="small">Min Visitors</h6>
          </div>
        </div>
        <div class="col">
          <div class="card bg-light p-3 text-center rounded-4 border-1">
            <h4 class="fw-bold text-dark"><?= $lead_dtl->m_lead_rateph ?></h4>
            <h6 class="small">Rate / Head</h6>
          </div>
        </div>
        <div class="col">
          <div class="card bg-light p-3 text-center rounded-4 border-1">
            <h4 class="fw-bold text-dark"><?= $lead_dtl->m_lead_flocker ?></h4>
            <h6 class="small">Free Locker</h6>
          </div>
        </div>
        <div class="col">
          <div class="card bg-light p-3 text-center rounded-4 border-1">
            <h4 class="fw-bold text-dark"><?= $lead_dtl->m_lead_fcostume ?></h4>
            <h6 class="small">Free Costume</h6>
          </div>
        </div>

      </div>
    </section>
    <section class="py-3 bg-light">
      <h5 class="m-0 mb-1 fw-semibold text-secondary">Food Offer:</h5>
      <h6><?= $lead_dtl->package_name ?></h6>
      <p class="m-0 text-dark fw-normal">
        <?php $items_name = $this->db->select('GROUP_CONCAT(m_menu_name) as names')->where_in('m_menu_id', explode(',', $lead_dtl->package_item))->get('master_menu_tbl')->result(); ?>
        <?= $items_name[0]->names ?>
      </p>
    </section>
    <section class="py-3 bg-light">
      <h5 class="m-0 mb-1 fw-semibold text-secondary">Remarks:</h5>
      <p class="m-0 text-dark fw-normal">
        <?= $lead_dtl->m_lead_remark ?>
      </p>
    </section>
    <section class="py-3 bg-light">
      <h5 class="m-0 mb-1 fw-semibold text-secondary">Discussion Summary:</h5>
      <p class="m-0 text-dark fw-normal">
        <?= $lead_dtl->m_lead_summery ?>
      </p>
    </section>
    <section class="py-3 bg-light">
      <h5 class="m-0 mb-1 fw-semibold text-secondary">Instractions :</h5>
      <ul>
        <?php if (!empty($instructions_list)) {
          foreach ($instructions_list as $key) {
            echo '<li>' . $key->m_saleshead_title . '</li>';
          }
        } ?>


      </ul>
    </section>
</body>

</html>