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
                        <a href="<?php echo site_url('Inventory/requirement_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All Requirements</a>
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

            $dept    = $edit_value[0]->m_reqmt_dept;
            $date       = $edit_value[0]->m_reqmt_date;
        } else {

            $dept    = '';
            $date       = date('Y-m-d');
        } ?>

        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-add-reqmt" enctype="mutipart/form-data">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Department Name</label>
                                    <select name="m_reqmt_dept" id="m_reqmt_dept" class="form-control select2">
                                        <?php if (!empty($dept_list)) {
                                            foreach ($dept_list as $key) {
                                                if ($dept == $key->m_dept_id) {
                                                    $op = 'selected';
                                                } else {
                                                    $op = '';
                                                }
                                                echo '<option value="' . $key->m_dept_id . '" ' . $op . '>' . $key->m_dept_name . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            
                           
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="m_reqmt_date" id="m_reqmt_date" class="form-control" readonly value="<?= $date; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                             
                                <button type="button" class="btn btn-vsm btn-primary pull-right" onclick="addrowout()">Add row</button>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th width="1%">Sn</th>
                                        <th>Product name/code</th>
                                        <th>Size </th>
                                        <th>Qty </th>
                                        <th>Unit </th>
                                        <th>Remark</th>
                                       
                                    </thead>
                                    <tbody id="tableblockout">
                                        <?php if (!empty($id)) {
                                            $coun = 0;
                                            foreach ($edit_value as $key) {
                                                $coun++;
                                        ?>

                                                <tr>
                                                    <td id="rowcount<?= $coun ?>"><input type="hidden" name="m_reqmt_id[]" value="<?= $key->m_reqmt_id ?>" /><?= $coun ?></td>
                                                    <td><input type="text" list="usersdtl<?= $coun ?>" placeholder="Enter Product Name" class="form-control reqmt_productout" data-count="<?= $coun ?>" value="<?= $key->m_product_name ?>" />

                                                        <input type="hidden" id="m_reqmt_item<?= $coun ?>" name="m_reqmt_item[]" value="<?= $key->m_reqmt_item ?>">
                                                        <datalist id="usersdtl<?= $coun ?>">
                                                            <?php
                                                            foreach ($products as $ukey) {
                                                            ?>
                                                                <option value="<?php echo $ukey->m_product_name; ?>" data-unitname="<?= $ukey->m_prodgroup_name ?>" data-rate="<?= $ukey->m_product_sale_rate ?>" data-prodid="<?= $ukey->m_product_id ?>"><?php echo $ukey->m_product_id . ' | ' . $ukey->m_product_code; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </datalist>
                                                    </td>
                                                    <td><select id="m_reqmt_size<?= $coun ?>" name="m_reqmt_size[]" class="form-control">
                                                            <option value="">Select Size</option>
                                                            <?php
                                                            foreach ($prodsize_dl as $val) {

                                                                if ($key->m_reqmt_size == $val->m_prodgroup_id) {
                                                                    $op = "selected";
                                                                } else {
                                                                    $op = "";
                                                                }

                                                            ?>
                                                                <option value="<?php echo $val->m_prodgroup_id; ?>" <?= $op ?>><?php echo $val->m_prodgroup_name ?></option>
                                                            <?php
                                                            }

                                                            ?>

                                                        </select></td>
                                                    <td><input type="number" id="m_reqmt_qty<?= $coun ?>" name="m_reqmt_qty[]" class="prodqty" data-count="<?= $coun ?>" value="<?= $key->m_reqmt_qty ?>"></td>
                                                    <td><input type="text" id="m_reqmt_unit<?= $coun ?>" readonly value="<?= $key->product_unit ?>"></td>
                                                    <td><input type="text" id="m_reqmt_remark<?= $coun ?>" name="m_reqmt_remark[]" value="<?= $key->m_reqmt_remark ?>"></td>
                                                    
                                                </tr>

                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td id="rowcount1"><input type="hidden" name="m_reqmt_id[]" />1</td>
                                                <td><input type="text" list="usersdtl1" placeholder="Enter Product Name" class="form-control reqmt_productout" data-count="1" />

                                                    <input type="hidden" id="m_reqmt_item1" name="m_reqmt_item[]">
                                                    <datalist id="usersdtl1">
                                                        <?php
                                                        foreach ($products as $ukey) {
                                                        ?>
                                                            <option value="<?php echo $ukey->m_product_name; ?>" data-unitname="<?= $ukey->m_prodgroup_name ?>" data-rate="<?= $ukey->m_product_sale_rate ?>" data-prodid="<?= $ukey->m_product_id ?>"><?php echo $ukey->m_product_id . ' | ' . $ukey->m_product_code; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </datalist>
                                                </td>
                                                <td><select id="m_reqmt_size1" name="m_reqmt_size[]" class="form-control">
                                                        <option value="">Select Size</option>
                                                        <?php
                                                        foreach ($prodsize_dl as $val) {
                                                        ?>
                                                            <option value="<?php echo $val->m_prodgroup_id; ?>"><?php echo $val->m_prodgroup_name ?></option>
                                                        <?php
                                                        }

                                                        ?>

                                                    </select></td>
                                                <td><input type="number" id="m_reqmt_qty1" name="m_reqmt_qty[]" class="prodqty" data-count="1"></td>
                                                <td><input type="text" id="m_reqmt_unit1"  readonly></td>
                                                <td><input type="text" id="m_reqmt_remark1" name="m_reqmt_remark[]"></td>
                                         
                                            </tr>
                                        <?php  } ?>

                                        <?php // }
                                        // } 
                                        ?>

                                    </tbody>
                                </table>

                            </div>

                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remark</label>
                                    <input type="text" name="m_reqmt_remark" id="m_reqmt_remark" class="form-control" value="<?= $remark; ?>">
                                </div>
                            </div> -->
                        </div>

                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-reqmt" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php if (!empty($id)) { ?>
                                    <div class="form-layout-submit"><a href="<?php echo site_url('Inventory/requirement_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                    <?php } else { ?>
                                        <div class="form-layout-submit"><a href="<?php echo site_url('Inventory/add_requirement'); ?>" class="btn btn-block btn-danger">Reset</a>
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
$this->view('js/restuarent_js'); ?>


<script>
    let x = 1;
    let xin = 1;

    function addrowout() {
        x++;
        $('#tableblockout').append(`<tr>
                                                    <td id="rowcount` + x + `"><input type="hidden" name="m_reqmt_id[]" />` + x + `</td>
                                                    <td><input type="text" list="usersdtl` + x + `" placeholder="Enter Product Name" class="form-control reqmt_productout" data-count="` + x + `" />
                                                    <input type="hidden" id="m_reqmt_item` + x + `" name="m_reqmt_item[]" >    
                                    <datalist id="usersdtl` + x + `">
                                        <?php
                                        foreach ($products as $ukey) {
                                        ?>
                                            <option value="<?php echo $ukey->m_product_name; ?>"  data-unitname="<?= $ukey->m_prodgroup_name ?>" data-rate="<?= $ukey->m_product_sale_rate ?>"  data-prodid="<?= $ukey->m_product_id ?>"><?php echo $ukey->m_product_id . ' | ' . $ukey->m_product_code; ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </datalist></td>
                                                    <td><select id="m_reqmt_size` + x + `" name="m_reqmt_size[]" class="form-control">
                                        <option value="">Select Size</option>
                                        <?php
                                        foreach ($prodsize_dl as $val) {

                                            // if ($godown == $value->m_prodgroup_id) {
                                            //     $option1 = "selected";
                                            // } else {
                                            //     $option1 = "";
                                            // }

                                            // 
                                        ?>
                                            <option value="<?php echo $val->m_prodgroup_id; ?>"><?php echo $val->m_prodgroup_name ?></option>
                                        <?php
                                        }

                                        ?>

                                    </select></td>
                                                    <td><input type="number" id="m_reqmt_qty` + x + `" class="prodqty" data-count="` + x + `" name="m_reqmt_qty[]"></td>
                                                    <td><input type="text" id="m_reqmt_unit` + x + `" readonly></td>
                                                    <td><input type="text" id="m_reqmt_remark` + x + `" name="m_reqmt_remark[]" ></td>
                                                 
                                                </tr>`);
    }

   

    $(document).ready(function(e) {

        $(document).on("change", '.reqmt_productout', function() {
     
            var count = $(this).data('count');
            var unit = $("#usersdtl" + count + " option[value='" + $(this).val() + "']").attr('data-unitname')
            // var rate = $("#usersdtl" + count + " option[value='" + $(this).val() + "']").attr('data-rate')
            var prodid = $("#usersdtl" + count + " option[value='" + $(this).val() + "']").attr('data-prodid')
        
            $('#m_reqmt_unit' + count).val(unit);
            // $('#m_reqmt_remark' + count).val(rate);
            $('#m_reqmt_item' + count).val(prodid);
          
        });

    });
</script>