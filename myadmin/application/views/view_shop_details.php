<!-- ========================Header==============Fix========= -->
<?php $this->view('top_header') ?>
<!-- =======================/Header==============Fix========= -->

<!-- Right Side Content Start -->
<style>
    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .txt_left {
        float: left;
    }

    .txt-right {
        float: right;
    }

    .txt-word {
        word-break: break-word;
    }

    .font-15 {
        font-size: 15px !important;
        padding: 10px;
    }

    .wt-42 {
        width: 42%;
    }

    .badge {
        background-color: #2d1b4f !important;
        cursor: pointer;
    }

    .modal-content {
        text-align: left !important;
    }

    .p-0 {
        padding: 12px !important;
    }

    .img-set {
        width: 100%;
        height: 200px;
        border: 1px solid black;
        border-radius: 2%;
    }

    div {
        background-position: center center !important;
        background-size: cover !important;
    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <!-- ========================/View===============Fix========= -->
        <!-- ======================Page Title======================== -->
        <!-- Breadcromb Row Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-area">
                    <div class="row">
                        <div class="col-md-4  col-sm-4">
                            <div class="seipkon-breadcromb-left">
                                <h3><?php echo $pagename; ?></h3>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-8 pull-right">
                            <div class="seipkon-breadcromb-right">

                                <a href="<?php echo base_url('Shop/add_ticket?id=') . $edit_value->m_shop_id; ?>" class="btn btn-info btn-vsm" title="Edit"><i class="fa fa-edit"></i> Edit</a>

                                <a style="margin-right: 5px;" href="<?php echo site_url('Shop') ?>" class="btn btn-info btn-vsm"><i class="fa fa-long-arrow-left"></i> Back</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <br>
        <!------------------for img---------------------------->
        <?php

        if (!empty($frontFacing[0]->s_frontimg_image)) {
            $shop_img = base_url('uploads/shop/') . $frontFacing[0]->s_frontimg_image;
        } else {
            $shop_img = base_url('uploads/default_shop.png');
        }

        ?>
        <!------------------for img End Above------------------>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?php echo $shop_img; ?>" alt="Profile Photo" style="width:160px; margin-bottom:20px;">
                            <h4 style="font-size: 25px;"><?php echo  $edit_value->m_shop_name; ?></h4>
                            <!-------------------------------------------------------->

                        </div>
                    </div>
                </div>
                <div class="card font-15">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="wt-42"><i class="fa fa-user"></i> Category</td>
                                    <td><b><?php echo $edit_value->m_category_title; ?></b></td>
                                </tr>
                                <tr>
                                    <td class="wt-42"><i class="fa fa-user"></i> Proprietor Name</td>
                                    <td><b><?php echo $edit_value->m_shop_proprietor_name; ?></b></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-phone-square"></i> Contact No.</td>
                                    <td><b><?php echo $edit_value->m_shop_contact; ?></b></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-phone-square"></i>Alt. Contact No.</td>
                                    <td><b><?php echo $edit_value->m_shop_alt_contact; ?></b></td>
                                </tr>

                                <tr>
                                    <td><i class="fa fa-calendar-o"></i> Registered ON</td>
                                    <td><b class="txt-word"><?php if ($edit_value->m_shop_added_on != '0000-00-00') echo date('d-m-Y', strtotime($edit_value->m_shop_added_on));
                                                            else echo ''; ?></b></td>
                                </tr>

                                <tr>
                                    <td class="wt-42"><i class="fa fa-clock-o"></i> Status </td>
                                    <td><b><?php if ($edit_value->m_shop_status == 1) echo "Active";
                                            else {
                                                echo "InActive";
                                            } ?></b></td>
                                </tr>


                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="page-box">
                        <h4>Prospect Gallery</h4>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <label>Front Facing</label>
                                <hr>
                                <div class="row">

                                    <?php

                                    for ($i = 0; $i < 3; $i++) {
                                        if (!empty($frontFacing[$i]->s_frontimg_image)) {
                                            $fimg_link = base_url('uploads/shop/') . $frontFacing[$i]->s_frontimg_image;
                                            $fimg_id = $frontFacing[$i]->s_frontimg_id;
                                        } else {
                                            $fimg_link = base_url('uploads/default.jpg');
                                            $fimg_id = '';
                                        }

                                    ?>

                                        <div class="col-md-4">

                                            <a href="<?= $fimg_link ?>" target="_blank">
                                                <div style="aspect-ratio: 4/3; background:url('<?= $fimg_link ?>');">
                                                </div>
                                            </a>

                                        </div>
                                    <?php } ?>

                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <label>Billing Counter</label>
                                <hr>
                                <div class="row">

                                    <?php

                                    for ($i = 0; $i < 3; $i++) {
                                        if (!empty($billingConter[$i]->s_billcount_image)) {
                                            $fimg_link = base_url('uploads/shop/') . $billingConter[$i]->s_billcount_image;
                                            $fimg_id = $billingConter[$i]->s_billcount_id;
                                        } else {
                                            $fimg_link = base_url('uploads/default.jpg');
                                            $fimg_id = '';
                                        }

                                    ?>

                                        <div class="col-md-4">

                                            <a href="<?= $fimg_link ?>" target="_blank">
                                                <div style="aspect-ratio: 4/3; background:url('<?= $fimg_link ?>');">
                                                </div>
                                            </a>

                                        </div>
                                    <?php } ?>

                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <label>Instore Images</label>
                                <hr>
                                <div class="row">

                                    <?php

                                    for ($i = 0; $i < 3; $i++) {
                                        if (!empty($instore[$i]->s_instoreimg_image)) {
                                            $fimg_link = base_url('uploads/shop/') . $instore[$i]->s_instoreimg_image;
                                            $fimg_id = $instore[$i]->s_instoreimg_id;
                                        } else {
                                            $fimg_link = base_url('uploads/default.jpg');
                                            $fimg_id = '';
                                        }

                                    ?>

                                        <div class="col-md-4">

                                            <a href="<?= $fimg_link ?>" target="_blank">
                                                <div style="aspect-ratio: 4/3; background:url('<?= $fimg_link ?>');">
                                                </div>
                                            </a>

                                        </div>
                                    <?php } ?>

                                </div>
                            </div>

                        </div>
                        <br>

                        <div class="row">
                            <div class="col-xs-12">
                                <label>Proposed Location</label>
                                <hr>
                                <div class="row">

                                    <?php

                                    for ($i = 0; $i < 3; $i++) {
                                        if (!empty($proposedLocation[$i]->s_proloc_image)) {
                                            $fimg_link = base_url('uploads/shop/') . $proposedLocation[$i]->s_proloc_image;
                                            $fimg_id = $proposedLocation[$i]->s_proloc_id;
                                        } else {
                                            $fimg_link = base_url('uploads/default.jpg');
                                            $fimg_id = '';
                                        }

                                    ?>

                                        <div class="col-md-4">
                                            <a href="<?= $fimg_link ?>" target="_blank">
                                                <div style="aspect-ratio: 4/3; background:url('<?= $fimg_link ?>');">
                                                </div>
                                            </a>

                                        </div>
                                    <?php } ?>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-6 col-sm-6">
                <div class="card font-15">
                    <div class="card-body">
                        <h4>Genral Details</h4>
                        <br>
                        <table class="table table-bordered">

                            <tr>
                                <td>State:</td>
                                <td><b><?php echo $edit_value->m_shop_state; ?></b></td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td><b><?php echo $edit_value->m_shop_city; ?></b></td>
                            </tr>
                            <tr>
                                <td>Pincode:</td>
                                <td><b><?php echo $edit_value->m_shop_pincode; ?></b></td>
                            </tr>

                            <tr>
                                <td>Address:</td>
                                <td><b><?php echo $edit_value->m_shop_address; ?></b></td>
                            </tr>
                            <tr>
                                <td>Work Days:</td>
                                <td><b><?php if ($workingday->s_workday_mon == 1) {
                                            echo 'MON ';
                                        }
                                        if ($workingday->s_workday_tue == 1) {
                                            echo 'TUE ';
                                        }
                                        if ($workingday->s_workday_wed == 1) {
                                            echo 'WED ';
                                        }
                                        if ($workingday->s_workday_thu == 1) {
                                            echo 'THU ';
                                        }
                                        if ($workingday->s_workday_fri == 1) {
                                            echo 'FRI ';
                                        }
                                        if ($workingday->s_workday_sat == 1) {
                                            echo 'SAT ';
                                        }
                                        if ($workingday->s_workday_sun == 1) {
                                            echo 'SUN ';
                                        } ?></b></td>
                            </tr>
                            <tr>
                                <td>Opening Time:</td>
                                <td><b><?php echo date('h:i A', strtotime($edit_value->m_shop_opening_time)); ?></b></td>
                            </tr>
                            <tr>
                                <td>Closing Time:</td>
                                <td><b><?php echo date('h:i A', strtotime($edit_value->m_shop_closing_time)); ?></b></td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="card font-15">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>KYC Verification</h4>
                            </div>

                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>Aadhaar Front</label>
                                <hr>
                                <?php
                                if (!empty($edit_value->m_shop_adhar_front)) {
                                ?>
                                    <a href="<?php echo base_url('uploads/shop/') . $edit_value->m_shop_adhar_front; ?>" target="_blank"><img class="img-set" src="<?php echo base_url('uploads/shop/') . $edit_value->m_shop_adhar_front; ?>" alt="Aadhaar Front"></a>
                                <?php
                                } else {
                                ?>
                                    <img class="img-set" src="<?php echo base_url('uploads/default.jpg'); ?>" alt="Aadhaar Front">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>Aadhaar Back</label>
                                <hr>
                                <?php
                                if (!empty($edit_value->m_shop_adhar_back)) {
                                ?>
                                    <a href="<?php echo base_url('uploads/shop/') . $edit_value->m_shop_adhar_back; ?>"><img class="img-set" src="<?php echo base_url('uploads/shop/') . $edit_value->m_shop_adhar_back; ?>" alt="Aadhaar Back"></a>
                                <?php
                                } else {
                                ?>
                                    <img class="img-set" src="<?php echo base_url('uploads/default.jpg'); ?>" alt="Aadhaar Back">
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered">
                            <tr>
                                <td>Aadhaar Card No:</td>
                                <td><b><?php echo $edit_value->m_shop_adhar_no; ?></b></td>
                            </tr>
                        </table>
                        <br>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>Pan Image</label>
                                <hr>
                                <?php
                                if (!empty($edit_value->m_shop_pan_image)) {
                                ?>
                                    <a href="<?php echo base_url('uploads/shop/') . $edit_value->m_shop_pan_image; ?>" target="_blank"><img class="img-set" src="<?php echo base_url('uploads/shop/') . $edit_value->m_shop_pan_image; ?>" alt="Pan Image"></a>
                                <?php
                                } else {
                                ?>
                                    <img class="img-set" src="<?php echo base_url('uploads/default.jpg'); ?>" alt="Pan Image">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>Cancel Cheque</label>
                                <hr>
                                <?php
                                if (!empty($edit_value->m_shop_cancel_cheque)) {
                                ?>
                                    <a href="<?php echo base_url('uploads/shop/') . $edit_value->m_shop_cancel_cheque; ?>"><img class="img-set" src="<?php echo base_url('uploads/shop/') . $edit_value->m_shop_cancel_cheque; ?>" alt="Cancel Cheque"></a>
                                <?php
                                } else {
                                ?>
                                    <img class="img-set" src="<?php echo base_url('uploads/default.jpg'); ?>" alt="Cancel Cheque">
                                <?php
                                }
                                ?>
                            </div>
                          
                           
                            <div class="col-md-6 col-sm-6">
                                <br>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Pan Card No:</td>
                                        <td><b><?php echo $edit_value->m_shop_pan_no; ?></b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer'); ?>
<!-- =======================/Footer================Fix======= -->

<script>
    $(document).ready(function(e) {

        $("form#frm-updateplan").submit(function(e) {
            e.preventDefault();
            var clkbtn = $("#btn-updateplan");
            clkbtn.prop('disabled', true);
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Booking/update_membershipplan'); ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        swal(data.message, {
                            icon: "success",
                            timer: 1000,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        clkbtn.prop('disabled', false);
                        swal(data.message, {
                            icon: "error",
                            timer: 5000,
                        });
                    }
                },
                error: function(jqXHR, status, err) {
                    clkbtn.prop('disabled', false);
                    swal("Some Problem Occurred!! please try again", {
                        icon: "error",
                        timer: 2000,
                    });
                }
            });

        });


        $("#btn-aadharverify").on("click", function() {
            var shop_id = $(this).data('id');
            var value = $(this).data('value');

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Shop/update_verification'); ?>",
                data: {
                    shop_id: shop_id,
                    value: value
                },

                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        swal(data.message, {
                            icon: "success",
                            timer: 1000,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                }
            });

        });

    });
</script>