<!--=========================View==============Fix========== -->
<!-- ========================nameer==============Fix========= -->
<?php $this->view('top_header') ?>
<!-- =======================/nameer==============Fix========= -->
<!-- =========================View===============Fix========= -->
<div class="page-content">
    <div class="container-fluid">
        <!-- ========================/View===============Fix========= -->
        <!-- ======================Page Title======================== -->
        <!-- Breadcromb Row Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-area">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="seipkon-breadcromb-left">
                                <h3><?php echo $pagename; ?></h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 pull-right">
                            <div class="seipkon-breadcromb-right">
                                <a href="<?php echo site_url('Setup/product_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All Products </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
            .check {
                display: flex;
                justify-content: space-between;
            }

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

            div {
                background-position: center center !important;
                background-size: cover !important;
            }
        </style>
        <!-- End Breadcromb Row -->
        <!-- =====================/Page Title======================== -->
        <!-- =====================Page Content======================= -->
        <!-- View Counselor Area Start -->

        <?php if (!empty($edit_value)) {
            $id                 = $edit_value->m_product_id;
            $code               = $edit_value->m_product_code;
            $name               = $edit_value->m_product_name;
            $printname          = $edit_value->m_product_printname;
            $discription        = $edit_value->m_product_discription;
            $HSNcode            = $edit_value->m_product_HSNcode;
            $prodgroup          = $edit_value->m_product_group;
            $prodcat            = $edit_value->m_product_category;
            $GSTgroup           = $edit_value->m_product_GSTgroup;
            $produnit           = $edit_value->m_product_unit;
            $product_rent              = $edit_value->m_product_rent;
            $product_deposit       = $edit_value->m_product_deposit;
            $sale_rate          = $edit_value->m_product_sale_rate;
            $pur_rate           = $edit_value->m_product_pur_rate;
            $notapplicable      = $edit_value->is_gst_notapplicable;
            $work_product       = $edit_value->is_job_work_product;
            $raw_material       = $edit_value->is_raw_material;
            $is_discontinued    = $edit_value->is_discontinued;
            $is_asset           = $edit_value->is_asset;
        } else {
            $id = '';
            $code = '';
            $name = '';
            $printname = '';
            $discription = '';
            $HSNcode = '';
            $prodgroup = '';
            $prodcat = '';
            $GSTgroup = '';
            $produnit = '';
            $product_rent = '';
            $product_deposit   = '';
            $sale_rate = 0;
            $pur_rate   = 0;
            $notapplicable   = '';
            $work_product   = '';
            $raw_material   = '';
            $is_discontinued   = '';
            $is_asset   = '';
        }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="page-box">
                    <div class="form-example">
                        <div class="form-wrap top-label-exapmple form-layout-page">
                            <form method="post" action="#" id="frm-product-create" enctype="mutipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="m_product_id" id="m_product_id" class="form-control" value="<?= $id ?>">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Product Code <span class="text-danger">*</span></label>
                                            <input type="text" name="m_product_code" id="m_product_code" class="form-control" required="" value="<?= $code; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="m_product_name" id="m_product_name" class="form-control" required="" value="<?= $name; ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Print Name</label>
                                            <input type="text" name="m_product_printname" id="m_product_printname" class="form-control" value="<?= $printname ?>">
                                        </div>
                                    </div> -->

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" name="m_product_discription" id="m_product_discription" class="form-control" value="<?= $discription ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>HSN/SAC Code</label>
                                            <input type="text" name="m_product_HSNcode" id="m_product_HSNcode" class="form-control" placeholder="Enter HSN code" value="<?= $HSNcode ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>GST Group</label>
                                            <select name="m_product_GSTgroup" id="m_product_GSTgroup" class="form-control select2">
                                                <option value="GST-0%" <?php if ($GSTgroup == "GST-0%") {
                                                                            echo 'selected';
                                                                        } ?>>GST-0%</option>
                                                <option value="GST-12%" <?php if ($GSTgroup == "GST-12%") {
                                                                            echo 'selected';
                                                                        } ?>>GST-12%</option>
                                                <option value="GST-18%" <?php if ($GSTgroup == "GST-18%") {
                                                                            echo 'selected';
                                                                        } ?>>GST-18%</option>
                                                <option value="GST-28%" <?php if ($GSTgroup == "GST-28%") {
                                                                            echo 'selected';
                                                                        } ?>>GST-28%</option>
                                                <option value="GST-5%" <?php if ($GSTgroup == "GST-5%") {
                                                                            echo 'selected';
                                                                        } ?>>GST-5%</option>
                                                <option value="GST-3%" <?php if ($GSTgroup == "GST-3%") {
                                                                            echo 'selected';
                                                                        } ?>>GST-3%</option>

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Product Group</label>
                                            <select name="m_product_group" id="m_product_group" class="form-control select2">
                                                <?php
                                                if (!empty($dept_list)) {
                                                    foreach ($dept_list as $cckey) {
                                                        if ($prodgroup == $cckey->m_dept_id) {
                                                            $op = 'selected';
                                                        } else {
                                                            $op = '';
                                                        }
                                                ?>
                                                        <option value="<?php echo $cckey->m_dept_id; ?>" <?= $op ?>><?php echo $cckey->m_dept_name; ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Product Category</label>
                                            <select name="m_product_category" id="m_product_category" class="form-control select2">
                                                <?php
                                                foreach ($prodcat_list as $pckey) {
                                                    if ($prodcat == $pckey->m_prodcat_id) {
                                                        $op = 'selected';
                                                    } else {
                                                        $op = '';
                                                    }
                                                ?>
                                                    <option value="<?php echo $pckey->m_prodcat_id; ?>" <?= $op ?>><?php echo $pckey->m_prodcat_name; ?>
                                                    </option>
                                                <?php
                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Master Unit</label>
                                            <select name="m_product_unit" id="m_product_unit" class="form-control select2">
                                                <?php
                                                foreach ($produnit_list as $pukey) {
                                                    if ($produnit == $pukey->m_prodgroup_id) {
                                                        $op = 'selected';
                                                    } else {
                                                        $op = '';
                                                    }
                                                ?>
                                                    <option value="<?php echo $pukey->m_prodgroup_id; ?>" <?= $op ?>><?php echo $pukey->m_prodgroup_name; ?>
                                                    </option>
                                                <?php
                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Product Rent Amount</label>
                                            <input type="text" name="m_product_rent" id="m_product_rent" class="form-control" value="<?= $product_rent ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Product Deposit Amount</label>
                                            <input type="text" name="m_product_deposit" id="m_product_deposit" class="form-control" value="<?= $product_deposit ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sales Rate</label>
                                            <input type="number" name="m_product_sale_rate" id="m_product_sale_rate" class="form-control" value="<?= $sale_rate ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Purcase rate</label>
                                            <input type="number" name="m_product_pur_rate" id="m_product_pur_rate" class="form-control" value="<?= $pur_rate ?>">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" <?php if (!empty($notapplicable)) {
                                                                        echo 'checked';
                                                                    } ?> class="form-check-input" id="is_gst_notapplicable" name="is_gst_notapplicable">
                                            <label class="form-check-label" for="is_gst_notapplicable"> GST Not Applicable</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" <?php if (!empty($work_product)) {
                                                                        echo 'checked';
                                                                    } ?> class="form-check-input" id="is_job_work_product" name="is_job_work_product">
                                            <label class="form-check-label" for="is_job_work_product"> is Job Work Product</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" <?php if (!empty($raw_material)) {
                                                                        echo 'checked';
                                                                    } ?> class="form-check-input" id="is_raw_material" name="is_raw_material">
                                            <label class="form-check-label" for="is_raw_material"> is Raw Material</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" <?php if (!empty($is_discontinued)) {
                                                                        echo 'checked';
                                                                    } ?> class="form-check-input" id="is_discontinued" name="is_discontinued">
                                            <label class="form-check-label" for="is_discontinued"> is Discontinued</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" <?php if (!empty($is_asset)) {
                                                                        echo 'checked';
                                                                    } ?> class="form-check-input" id="is_asset" name="is_asset">
                                            <label class="form-check-label" for="is_asset"> is Asset</label>
                                        </div>
                                    </div>




                                </div>

                                <!---------------5th row completed--------------->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-layout-submit">
                                            <button type="submit" id="btn-product-create" class="btn btn-block btn-info"> Submit</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if (!empty($id)) { ?>
                                            <div class="form-layout-submit"><a href="<?php echo site_url('Setup/product_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                            <?php } else { ?>
                                                <div class="form-layout-submit"><a href="<?php echo site_url('Setup/add_product'); ?>" class="btn btn-block btn-danger">Reset</a>
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


        <!-- View Counselor Area End -->
        <!-- ====================/Page Content======================= -->
        <!-- =========================View=================Fix======= -->
    </div>
</div>
<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/js_setup');
?>
<!-- =======================/Footer================Fix=======