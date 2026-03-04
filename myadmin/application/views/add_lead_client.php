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
                        <a href="<?php echo site_url('Marketing/leadclient_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All Clients List</a>
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

            $id         = $edit_value->m_lclient_id;
            $leadsrc    = $edit_value->m_lclient_src;
            $leadtype     = $edit_value->m_lclient_type;
            $name  = $edit_value->m_lclient_name;
            $village       = $edit_value->m_lclient_village;
            $cities    = $edit_value->m_lclient_city;
            $potential   = $edit_value->m_lclient_potential;
            $address     = $edit_value->m_lclient_address;
            $remark     = $edit_value->m_lclient_remark;
        } else {
            $id         = '';
            $name  = '';
            $leadsrc    = '';
            $village       = '';
            $cities    = '';
            $potential   = '';
            $remark     = '';
            $address     = '';
            $leadtype     = '';
        } ?>

        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-add-lclient" enctype="mutipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Lead Source</label>
                                            <input type="hidden" name="m_lclient_id" id="m_lclient_id" value="<?= $id; ?>">
                                            <select name="m_lclient_src" id="m_lclient_src" class="form-control select2">
                                                <option value="">Select Source</option>
                                                <?php
                                                foreach ($leadsource_dtl as $value) {

                                                    if ($leadsrc == $value->m_leadst_id) {
                                                        $option1 = "selected";
                                                    } else {
                                                        $option1 = "";
                                                    }

                                                ?>
                                                    <option value="<?php echo $value->m_leadst_id; ?>" <?= $option1 ?>><?php echo $value->m_leadst_name ?></option>
                                                <?php
                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Lead Client Type</label>
                                            <select name="m_lclient_type" id="leadtype" class="form-control select2">
                                                <option value="">Select type</option>
                                                <?php
                                                foreach ($leadtype_dtl as $value) {

                                                    if ($leadtype == $value->m_leadst_id) {
                                                        $option1 = "selected";
                                                    } else {
                                                        $option1 = "";
                                                    }

                                                ?>
                                                    <option value="<?php echo $value->m_leadst_id; ?>" <?= $option1 ?>><?php echo $value->m_leadst_name ?></option>
                                                <?php
                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label id="name_label">Client Name</label>
                                            <input type="text" name="m_lclient_name" id="m_lclient_name" class="form-control" required="" value="<?= $name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Village</label>
                                            <input type="text" name="m_lclient_village" id="m_lclient_village" class="form-control" required="" value="<?= $village; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="input-group">
                                            <label>City Name <span class="text-danger">*</span></label>
                                            <select name="m_lclient_city" id="stc_add_city" class="form-control select2" required>
                                                <option value="">Select City</option>
                                                <?php
                                                foreach ($city_dtl as $city) {
                                                    if ($cities == $city->m_city_id) {
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

                                        <!-- <div class="form-group">
                                            <label>City</label>
                                            <select name="m_lclient_city" id="m_lclient_city" class="form-control select2">
                                                <option value="">Select City</option>
                                                <?php
                                                // foreach ($city_dtl as $city) {
                                                //     if ($cities == $city->m_city_id) {
                                                //         $op = 'selected';
                                                //     } else {
                                                //         $op = '';
                                                //     }

                                                ?>
                                                    <option value="<?php echo $city->m_city_id; ?>" <?= $op ?>><?php echo $city->m_city_name . ' | ' . $city->m_state_name; ?> | india
                                                    </option>
                                                <?php
                                                // }

                                                ?>

                                            </select>
                                        </div> -->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Potential Capacity</label>
                                            <input type="text" name="m_lclient_potential" id="m_lclient_potential" class="form-control" required="" value="<?= $potential; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="m_lclient_address" id="m_lclient_address" class="form-control" value="<?= $address; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Remark</label>
                                            <input type="text" name="m_lclient_remark" id="m_lclient_remark" class="form-control" value="<?= $remark; ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6" style="padding:0px; ">
                                <div class="row">
                                    <div class="col-md-12" style="width:100% ;height:250px; ">
                                        <label>Contact Person and Details</label>
                                        <button type="button" class="btn btn-vsm btn-primary pull-right" onclick="addrow()">Add row</button>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" style="width:100%;">
                                                <thead>
                                                    <th width="1%">Sn</th>
                                                    <th>Contact Person</th>
                                                    <th>Mobile No </th>
                                                    <th>Email </th>
                                                    <th>Designation </th>
                                                    <th></th>

                                                </thead>
                                                <tbody id="tableblock">

                                                    <?php if (!empty($id)) {
                                                        $con = 0;
                                                        foreach ($edit_mem as $key) {
                                                            ++$con ?>
                                                            <tr>
                                                                <td id="rowcount<?= $con ?>"><?= $con ?></td>
                                                                <td><input type="text" name="lc_person_name[]" required value="<?= $key->lc_person_name ?>"> <input type="hidden" name="lc_person_id[]" value="<?= $key->lc_person_id ?>"></td>
                                                                <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10" minlength="10" name="lc_person_mobileno[]" required value="<?= $key->lc_person_mobileno ?>"></td>
                                                                <td><input type="email" id="lc_person_email<?= $con ?>" name="lc_person_email[]" class="mailinput" data-count="<?= $con ?>" value="<?= $key->lc_person_email ?>"></td>
                                                                <td>
                                                                    <select name="lc_person_dept[]" id="lc_person_dept<?= $con ?>" class=" deptinput" data-count="<?= $con ?>">
                                                                        <?php
                                                                        foreach ($design_value as $dekey) {
                                                                            if ($key->lc_person_dept == $dekey->m_design_id) {
                                                                                $op = "selected";
                                                                            } else {
                                                                                $op = "";
                                                                            }
                                                                        ?>
                                                                            <option value="<?php echo $dekey->m_design_id; ?>" <?= $op ?>><?php echo $dekey->m_design_name; ?>
                                                                            </option>
                                                                        <?php
                                                                        }

                                                                        ?>

                                                                    </select>
                                                                </td>
                                                                <td><button class="btn btn-danger btn-action delete-person" data-value="<?php echo $key->lc_person_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button></td>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr id="trrowcount1">
                                                            <td id="rowcount1">1</td>
                                                            <td><input type="text" name="lc_person_name[]" required> <input type="hidden" name="lc_person_id[]"></td>
                                                            <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10" minlength="10" name="lc_person_mobileno[]" required></td>
                                                            <td><input type="email" id="lc_person_email1" name="lc_person_email[]" class="mailinput" data-count="1"></td>
                                                            <td> <select name="lc_person_dept[]" id="lc_person_dept1" class="deptinput" data-count="1">
                                                                    <?php
                                                                    foreach ($design_value as $dekey) {

                                                                    ?>
                                                                        <option value="<?php echo $dekey->m_design_id; ?>"><?php echo $dekey->m_design_name; ?>
                                                                        </option>
                                                                    <?php
                                                                    }

                                                                    ?>

                                                                </select></td>
                                                                <td><button class="btn btn-danger btn-action " onclick="remove_row(1)" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>



                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-lclient" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php if (!empty($id)) { ?>
                                    <div class="form-layout-submit"><a href="<?php echo site_url('Marketing/leadclient_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                    <?php } else { ?>
                                        <div class="form-layout-submit"><a href="<?php echo site_url('Marketing/add_leadclient'); ?>" class="btn btn-block btn-danger">Reset</a>
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
<?php $this->view('top_footer');
$this->view('js/sales_js');
$this->view('js/common_js'); ?>


<script>
    $("#leadtype").on('change', function() {
        var name = $(this).find(':selected').text();
        // alert(name);
        $('#name_label').html(name + ' Name');
    });

    let x = 1;

    function addrow() {
        x++;
        $('#tableblock').append(`<tr id="trrowcount` + x + `">
                                                    <td id="rowcount` + x + `" >` + x + `</td>
                                                    <td><input type="text" name="lc_person_name[]" required> <input type="hidden" name="lc_person_id[]"></td>
                                                    <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10" minlength="10" name="lc_person_mobileno[]" required></td>
                                                    <td><input type="email" id="lc_person_email` + x + `" name="lc_person_email[]" class="mailinput" data-count="` + x + `" ></td>
                                                    <td> 
                                                    <select name="lc_person_dept[]" id="lc_person_dept` + x + `" class=" deptinput" data-count="` + x + `">
                                                        <?php
                                                        foreach ($design_value as $dekey) {

                                                        ?>
                                                            <option value="<?php echo $dekey->m_design_id; ?>"><?php echo $dekey->m_design_name; ?>
                                                            </option>
                                                        <?php
                                                        }

                                                        ?>

                                                    </select></td>
                                                    <td><button class="btn btn-danger btn-action" onclick="remove_row(` + x + `)" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button></td>
                                                </tr>`);

    }

    function remove_row(count){
        $('#trrowcount'+ count).remove();
    }
</script>