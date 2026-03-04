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
                        <a href="<?php echo site_url('Setup/customer_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All Customers</a>
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

        <?php if (!empty($edit_value)) {
            $id = $edit_value->m_cust_id;
            $name = $edit_value->m_cust_name;
            $mobile = $edit_value->m_cust_mobile;
            $AccCode = $edit_value->m_cust_AccCode;
            $email = $edit_value->m_cust_email;
            $status = $edit_value->m_cust_status;
            $city = $edit_value->m_cust_city;
            $phoneNo = $edit_value->m_cust_phoneNo;
            $state = $edit_value->m_cust_state;
            $address = $edit_value->m_cust_address;
            $pan_no = $edit_value->m_cust_pan_no;
            $reqType = $edit_value->m_cust_reqType;
            $custType = $edit_value->m_cust_type;
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
                    <form method="post" action="#" id="frm-user-create" enctype="mutipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="hidden" name="m_cust_id" id="m_cust_id" value="<?= $id; ?>">
                                    <input type="text" name="m_cust_name" id="m_cust_name" class="form-control" placeholder="Name" required="" value="<?= $name; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Acc Code</label>
                                    <input type="text" name="m_cust_AccCode" id="m_cust_AccCode" class="form-control" placeholder="Enter Acc Code" value="<?= $AccCode; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <label>City Name <span class="text-danger">*</span></label>
                                    <select name="m_cust_city" id="stc_add_city" class="form-control select2" required>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <input type="text" name="m_cust_address" id="m_cust_address" class="form-control" placeholder="Enter Your Permanent Address" required value="<?= $address; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile Number <span class="text-danger">*</span></label>
                                    <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_cust_mobile" id="m_cust_mobile" class="form-control" placeholder="Enter Mobile Number" required="" value="<?= $mobile; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone No.</label>
                                    <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_cust_phoneNo" id="m_cust_phoneNo" class="form-control" placeholder="Enter Phone Number" value="<?= $phoneNo; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email id</label>
                                    <input type="email" name="m_cust_email" id="m_cust_email" class="form-control" placeholder="Enter Your Email id" value="<?= $email; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pan Number</label>
                                    <input type="text" maxlength="10" name="m_cust_pan_no" id="m_cust_pan_no" class="form-control" value="<?= $pan_no; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Registration Type</label>
                                    <select name="m_cust_reqType" id="m_cust_reqType" class="form-control select2">
                                        <option value="1" <?php if ($reqType == 1) {
                                                                echo 'selected';
                                                            } ?>>Unregistered</option>
                                        <option value="2" <?php if ($reqType == 2) {
                                                                echo 'selected';
                                                            } ?>>Regular</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer Type <span class="text-danger">*</span></label>
                                    <select name="m_cust_type" id="m_cust_type" class="form-control select2" required>
                                        <option value="1" <?php if ($custType == 1) {
                                                                echo 'selected';
                                                            } ?>>Credit</option>
                                        <option value="2" <?php if ($custType == 2) {
                                                                echo 'selected';
                                                            } ?>>Vip</option>
                                        <option value="0" <?php if ($custType == 0) {
                                                                echo 'selected';
                                                            } ?>>Normal</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-user-create" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-layout-submit"><a href="<?php echo site_url('Setup/customer_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
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
<?php $this->view('top_footer');
$this->view('js/customer_js');
$this->view('js/common_js');
?>