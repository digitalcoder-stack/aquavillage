<?php $this->view('top_header') ?>
<div class="page-content">
    <div class="container-fluid">
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 pull-right">
                    <div class="seipkon-breadcromb-right">
                        <a href="<?php echo site_url('Setup/supplier_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All Suppliers</a>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
            .d-flex {
                display: flex;
                align-items: center;
            }

            .jbfrm input[type=radio] {
                width: 27px;
                height: 17px;
                margin: 0px;
                background: none;
                box-shadow: none;
                transition: 0.5s;
            }

            .space-around {
                justify-content: space-around;
            }

            .space-around input[type=checkbox] {
                margin: 0px 0px 0px;
                transition: 0.5s;
                width: 20px;
                height: 18px;
            }

            .space-around input[type=checkbox]:focus {
                outline: none !important;
                transform: scale(1.2);
            }

            .jbfrm input[type=radio]:focus {
                outline: none !important;
                transform: scale(1.2);
            }
        </style>
        <!-- End Breadcromb Row -->
        <!-- =====================/Page Title======================== -->
        <!-- =====================Page Content======================= -->
        <!-- View Counselor Area Start -->

        <?php if (!empty($edit_value)) {
            $id = $edit_value->m_supplier_id;
            $name = $edit_value->m_supplier_name;
            $mobile = $edit_value->m_supplier_mobile;
            $AccCode = $edit_value->m_supplier_AccCode;
            $email = $edit_value->m_supplier_email;
            $status = $edit_value->m_supplier_status;
            $city = $edit_value->m_supplier_city;
            $phoneNo = $edit_value->m_supplier_phoneNo;
            $state = $edit_value->m_supplier_state;
            $address = $edit_value->m_supplier_address;
            $pan_no = $edit_value->m_supplier_pan_no;
            $reqType = $edit_value->m_supplier_reqType;
            $custType = $edit_value->m_supplier_type;
        } else {
            $id = '';
            $name = '';
            $mobile = '';
            $AccCode = '';
            $email = '';
            $status = '';
            $city = '';
            $phoneNo = '';
            $state = '';
            $address = '';
            $pan_no = '';
            $reqType = '';
            $custType = 1;
        } ?>


        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-supplier-create" enctype="mutipart/form-data">
                        <div class="row">
                            <div class="col-lg-2 col-md-4">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="hidden" name="m_supplier_id" id="m_supplier_id" value="<?= $id; ?>">
                                    <input type="text" name="m_supplier_name" id="m_supplier_name" class="form-control" placeholder="Enter Name" required="" value="<?= $name; ?>">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4">
                                <div class="form-group">
                                    <label>Acc Code</label>
                                    <input type="text" name="m_supplier_AccCode" id="m_supplier_AccCode" class="form-control" placeholder="Enter Acc Code" value="<?= $AccCode; ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                            <div class="input-group">
                                    <label>City Name <span class="text-danger">*</span></label>
                                    <select name="m_supplier_city" id="stc_add_city" class="form-control select2" required>
                                        <option value="">Select City</option>
                                        <?php
                                        foreach ($city_dtl as $city) {
                                            if ($custcity == $city->m_city_id) {
                                                $op = 'selected';
                                            } else {
                                                $op = '';
                                            }

                                        ?>
                                            <option value="<?php echo $city->m_city_id; ?>" <?= $op ?>><?php echo $city->m_city_name . ' | ' . $city->m_state_name; ?></option>
                                        <?php
                                        }

                                        ?>

                                    </select>
                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#addcityModal" type="button" style="margin-top: 25px;height: 40px;background: #8d8d8d;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                    
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="m_supplier_address" id="m_supplier_address" class="form-control" placeholder="Enter Your Permanent Address" value="<?= $address; ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Mobile Number <span class="text-danger">*</span></label>
                                    <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_supplier_mobile" id="m_supplier_mobile" class="form-control" placeholder="Enter Mobile Number" required="" value="<?= $mobile; ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Phone No.</label>
                                    <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_supplier_phoneNo" id="m_supplier_phoneNo" class="form-control" placeholder="Enter Phone Number" value="<?= $phoneNo; ?>">
                                </div>
                            </div>


                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Email id</label>
                                    <input type="email" name="m_supplier_email" id="m_supplier_email" class="form-control" placeholder="Enter Your Email id" value="<?= $email; ?>">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Pan Number</label>
                                    <input type="text" maxlength="10" name="m_supplier_pan_no" id="m_supplier_pan_no" class="form-control" value="<?= $pan_no; ?>">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Registration Type</label>
                                    <select name="m_supplier_reqType" id="m_supplier_reqType" class="form-control select2">
                                        <option value="1" <?php if ($reqType == 1) {
                                                                echo 'selected';
                                                            } ?>>Unregistered</option>
                                        <option value="2" <?php if ($reqType == 2) {
                                                                echo 'selected';
                                                            } ?>>Regular</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label>Type <span class="text-danger">*</span></label>
                                    <select name="m_supplier_type" id="m_supplier_type" class="form-control select2" required>
                                        <option value="1" <?php if ($custType == 1) {
                                                                echo 'selected';
                                                            } ?>>Supplier</option>
                                        <option value="2" <?php if ($custType == 2) {
                                                                echo 'selected';
                                                            } ?>>Contractor</option>
                                        <!-- <option value="0" <?php if ($custType == 0) {
                                                                    echo 'selected';
                                                                } ?>>Normal</option> -->

                                    </select>
                                </div>
                            </div>




                        </div>

                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-supplier-create" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php if (!empty($id)) { ?>
                                    <div class="form-layout-submit"><a href="<?php echo site_url('Setup/supplier_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                    <?php } else { ?>
                                        <div class="form-layout-submit"><a href="<?php echo site_url('Setup/add_supplier'); ?>" class="btn btn-block btn-danger">Reset</a>
                                        <?php } ?>
                                        </div>
                                    </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/customer_js');
$this->view('js/common_js');
?>
<!-- =======================/Footer================Fix=======