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
                <?php

                switch ($pagetype) {
                    case 1: {
                            $pagelink = 'Inventory/storeout_list';
                            $titl = "Store Out";
                        }
                        break;
                    case 2: {
                            $pagelink = 'Inventory/damage_list';
                            $titl = "Damage";
                        }
                        break;
                }

                ?>
                <div class="col-md-3 col-sm-3 pull-right">
                    <div class="seipkon-breadcromb-right">
                        <a href="<?php echo site_url($pagelink); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All <?= $titl ?></a>
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
            $company    = $edit_value->ivt_stkout_company;
            $storeout_no   = $edit_value->ivt_stkout_no;
            $pagetype   = $edit_value->ivt_stkout_type;
            $date       = $edit_value->ivt_stkout_date;
            $remark     = $edit_value->ivt_stkout_remark;
            $godown     = $edit_value->ivt_stkout_godown;
            $storeout_dept     = $edit_value->ivt_stkout_dept;
            $storeout_items     = $edit_value->ivt_stkout_items;
        } else {
            $storeout_no    = '';
            $company    = '';
            $date       = date('Y-m-d');
            $remark     = '';
            $godown     = '';
            $storeout_dept     = $dept;
            $storeout_items  = array();
        } ?>

        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-add-storeout" enctype="mutipart/form-data">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="hidden" name="ivt_stkout_type" id="ivt_stkout_type" value="<?= $pagetype; ?>">
                                    <input type="hidden" name="ivt_stkout_no" id="ivt_stkout_no" value="<?= $storeout_no; ?>">
                                    <select name="ivt_stkout_company" id="ivt_stkout_company" class="form-control select2">
                                        <?php if (!empty($company_list)) {
                                            foreach ($company_list as $key) {
                                                if ($company == $key->m_company_id) {
                                                    $op = 'selected';
                                                } else {
                                                    $op = '';
                                                }
                                                echo '<option value="' . $key->m_company_id . '" ' . $op . '>' . $key->m_company_name . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Godown <span class="text-danger">*</span></label>
                                    <input type="hidden" name="ivt_stkout_dept" id="ivt_stkout_dept" value="<?= $storeout_dept; ?>">
                                    <select name="ivt_stkout_godown" id="godown" class="form-control select2" required>
                                        <option value="">Select Godown</option>
                                        <?php
                                        foreach ($godown_dtl as $value) {

                                            if ($godown == $value->m_godown_id) {
                                                $opti = "selected";
                                            } else {
                                                $opti = "";
                                            }

                                        ?>
                                            <option value="<?php echo $value->m_godown_id; ?>" <?= $opti ?> data-dept="<?= $value->m_godown_dept; ?>"><?php echo $value->m_godown_name ?></option>
                                        <?php
                                        }

                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <input type="date" name="ivt_stkout_date" id="ivt_stkout_date" class="form-control" readonly value="<?= $date; ?>">
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
                                        <th>PRate</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="tableblockout">
                                        <?php if (!empty($storeout_items)) {
                                            $coun = 0;

                                            foreach ($storeout_items as $key) {
                                                $coun++;
                                        ?>

                                                <tr id="rowunt<?= $coun?>">
                                                    <td id="rowcount<?= $coun ?>"><input type="hidden" name="ivt_stkout_id[]" value="<?= $key->ivt_stkout_id ?>" /><input id="prodsize_id<?= $coun ?>" name="ivt_stkout_prodsize[]" type="hidden"  value="<?= $key->ivt_stkout_prodsize ?>"/><?= $coun ?></td>
                                                    <td>
                                                        <select name="ivt_stkout_product[]" id="ivt_stkout_product<?= $coun ?>" class="form-control select2 storeout_product" data-count="<?= $coun ?>" required>
                                                            <option value="">Select Product</option>
                                                            <?php
                                                            if (!empty($products)) {
                                                                foreach ($products as $ukey) {
                                                                    if ($ukey->m_product_id == $key->ivt_stkout_product) {
                                                                        $op = 'selected';
                                                                    } else {
                                                                        $op = '';
                                                                    }
                                                            ?>
                                                                    <option value="<?= $ukey->m_product_id ?>" <?= $op ?> data-unit="<?= $ukey->m_produnit_name ?>" data-rate="<?= $ukey->m_product_sale_rate ?>" data-sizeid="<?= $ukey->m_prodsize_id ?>" data-sizename="<?= $ukey->m_prodsize_name ?>" data-probalqty="<?= $ukey->m_prodbal_qty ?>"><?= $ukey->m_product_name . ' | ' . $ukey->m_prodsize_name ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                        </select>

                                                    </td>
                                                    <td id="prodsize_name<?= $coun ?>"><?= $key->productsize?></td>
                                                    <td><input type="number" id="ivt_stkout_prodqty<?= $coun ?>" name="ivt_stkout_prodqty[]" class="prodqty" data-count="<?= $coun ?>" value="<?= $key->ivt_stkout_prodqty ?>"></td>
                                                    <td><?= $key->productunit ?></td>
                                                    <td><input type="number" id="ivt_stkout_prodrate<?= $coun ?>" name="ivt_stkout_prodrate[]" readonly value="<?= $key->ivt_stkout_prodrate ?>"></td>
                                                    <td><input type="number" id="ivt_stkout_tamt<?= $coun ?>" name="ivt_stkout_tamt[]" readonly value="<?= $key->ivt_stkout_tamt ?>"></td>
                                                    <td><button class="btn btn-danger btn-action delete-storeout" data-dtype="2" data-value="<?php echo $key->ivt_stkout_id; ?>" title="Delete" type="button" data-toggle="tooltip"><i class="fa fa-trash"></i></button></td>
                                                </tr>

                                            <?php }
                                            echo '<input type="hidden" id="rowincout" value="' . $coun . '">';
                                        } else if (!empty($pur_value)) {
                                            foreach ($pur_value as $cau => $key) {
                                                $cau++; ?>
                                                <tr id="rowunt<?= $cau?>">
                                                    <td id="rowcount<?= $cau ?>"><input id="prodsize_id<?= $cau ?>" name="ivt_stkout_prodsize[]" type="hidden" /><?= $cau ?></td>
                                                    <td>
                                                        <select name="ivt_stkout_product[]" id="ivt_stkout_product<?= $cau ?>" class="form-control select2 storeout_product" data-count="<?= $coun ?>" required>
                                                            <option value="">Select Product</option>
                                                            <?php
                                                            if (!empty($products)) {
                                                                foreach ($products as $ukey) {
                                                                    if ($ukey->m_product_id == $key->ivt_product_name) {
                                                                        $op = 'selected';
                                                                    } else {
                                                                        $op = '';
                                                                    }
                                                            ?>
                                                                     <option value="<?= $ukey->m_product_id ?>" <?= $op ?> data-unit="<?= $ukey->m_produnit_name ?>" data-rate="<?= $ukey->m_product_sale_rate ?>" data-sizeid="<?= $ukey->m_prodsize_id ?>" data-sizename="<?= $ukey->m_prodsize_name ?>" data-probalqty="<?= $ukey->m_prodbal_qty ?>"><?= $ukey->m_product_name . ' | ' . $ukey->m_prodsize_name ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                        </select>

                                                    </td>
                                                    <td id="prodsize_name<?= $cau ?>"></td>
                                                    <td><input type="number" id="ivt_stkout_prodqty<?= $cau ?>" name="ivt_stkout_prodqty[]" class="prodqty" data-caut="<?= $cau ?>" value="<?= $key->ivt_product_qty ?>"></td>
                                                    <td><?= $key->m_unit_name ?></td>
                                                    <td><input type="number" id="ivt_stkout_prodrate<?= $cau ?>" name="ivt_stkout_prodrate[]" readonly value="<?= $key->ivt_product_rate ?>"></td>
                                                    <td><input type="number" id="ivt_stkout_tamt<?= $cau ?>" name="ivt_stkout_tamt[]" readonly value="<?= $key->ivt_product_amount ?>"></td>
                                                    
                                                    <td><button class="btn btn-danger btn-action" onclick="remove_row(<?= $cau ?>)" title="Delete" type="button" data-toggle="tooltip"><i class="fa fa-trash"></i></button></td>
                                                </tr>
                                            <?php }
                                            echo '<input type="hidden" id="rowincout" value="' . $cau . '">';
                                        } else { ?>
                                            <tr id="rowunt1">
                                                <td id="rowcount1"><input type="hidden" name="ivt_stkout_id[]" value="" /> <input id="prodsize_id1" name="ivt_stkout_prodsize[]" type="hidden" />1</td>
                                                <td>
                                                    <select name="ivt_stkout_product[]" id="ivt_stkout_product1" class="form-control select2 storeout_product" data-count="1" required>
                                                        <option value="">Select Product</option>
                                                        <?php
                                                        if (!empty($products)) {
                                                            foreach ($products as $ukey) {
                                                                if ($ukey->m_product_id == $key->ivt_stkout_product) {
                                                                    $op = 'selected';
                                                                } else {
                                                                    $op = '';
                                                                }
                                                        ?>
                                                               <option value="<?= $ukey->m_product_id ?>" <?= $op ?> data-unit="<?= $ukey->m_produnit_name ?>" data-rate="<?= $ukey->m_product_sale_rate ?>" data-sizeid="<?= $ukey->m_prodsize_id ?>" data-sizename="<?= $ukey->m_prodsize_name ?>" data-probalqty="<?= $ukey->m_prodbal_qty ?>"><?= $ukey->m_product_name . ' | ' . $ukey->m_prodsize_name ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    </select>

                                                </td>
                                                <td id="prodsize_name1"></td>
                                                <td><input type="number" id="ivt_stkout_prodqty1" name="ivt_stkout_prodqty[]" class="prodqty" data-count="1"></td>
                                                <td id="ivt_stkout_unit1"></td>
                                                <td><input type="number" id="ivt_stkout_prodrate1" name="ivt_stkout_prodrate[]" readonly></td>
                                                <td><input type="number" id="ivt_stkout_tamt1" name="ivt_stkout_tamt[]" readonly></td>
                                            </tr>
                                            <input type="hidden" id="rowincout" value="1">
                                        <?php  } ?>

                                        <?php // }
                                        // } 
                                        ?>

                                    </tbody>
                                </table>

                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remark</label>
                                    <input type="text" name="ivt_stkout_remark" id="ivt_stkout_remark" class="form-control" value="<?= $remark; ?>">
                                </div>
                            </div>
                        </div>

                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-storeout" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php if (!empty($id)) { ?>
                                    <div class="form-layout-submit"><a href="<?php echo site_url('Inventory/storeout_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                    <?php } else { ?>
                                        <div class="form-layout-submit"><a href="<?php echo site_url('Inventory/add_storeout'); ?>" class="btn btn-block btn-danger">Reset</a>
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
    var x = $('#rowincout').val();

    function addrowout() {
        x++;
        $('#tableblockout').append(`<tr id="rowunt` + x + `">
                                                    <td id="rowcount` + x + `"><input type="hidden" name="ivt_stkout_id[]" value="" /> <input id="prodsize_id`+x+`" name="ivt_stkout_prodsize[]" type="hidden" />` + x + `</td>
                                                    <td>
                                                    <select name="ivt_stkout_product[]" id="ivt_stkout_product` + x + `" class="form-control select2 storeout_product" data-count="` + x + `" required>
                                                        <option value="">Select Product</option>
                                                        <?php
                                                        if (!empty($products)) {
                                                            foreach ($products as $ukey) {
                                                                if ($ukey->m_product_id == $key->ivt_stkout_product) {
                                                                    $op = 'selected';
                                                                } else {
                                                                    $op = '';
                                                                }
                                                        ?>
                                                                    <option value="<?= $ukey->m_product_id ?>" <?= $op ?> data-unit="<?= $ukey->m_produnit_name ?>" data-rate="<?= $ukey->m_product_sale_rate ?>" data-sizeid="<?= $ukey->m_prodsize_id ?>" data-sizename="<?= $ukey->m_prodsize_name ?>" data-probalqty="<?= $ukey->m_prodbal_qty ?>"><?= $ukey->m_product_name . ' | ' . $ukey->m_prodsize_name ?></option>
                                                            <?php
                                                            }
                                                        }
                                                            ?>

                                                    </select></td>
                                                    <td id="prodsize_name`+x+`"></td>
                                                    <td><input type="number" id="ivt_stkout_prodqty` + x + `" class="prodqty" data-count="` + x + `" name="ivt_stkout_prodqty[]"></td>
                                                    <td id="ivt_stkout_unit` + x + `" ></td>
                                                    <td><input type="number" id="ivt_stkout_prodrate` + x + `" name="ivt_stkout_prodrate[]" readonly></td>
                                                    <td><input type="number" id="ivt_stkout_tamt` + x + `" name="ivt_stkout_tamt[]" readonly></td>
                                                    
                                                    <td><button class="btn btn-danger btn-action" onclick="remove_row(` + x + `)" title="Delete" type="button" data-toggle="tooltip"><i class="fa fa-trash"></i></button></td>
                                                </tr>`);
        selectRefresh();
    }



    $(document).ready(function(e) {

        $(document).on("change", '#godown', function() {

            var dept = $(this).find(':selected').data('dept')

            $('#ivt_stkout_dept').val(dept);

        });

        $(document).on("change", '.storeout_product', function() {
            // alert('working');
            var count = $(this).data('count');
            var unit = $(this).find(':selected').data('unit')
            var rate = $(this).find(':selected').data('rate')
            var probalqty = $(this).find(':selected').data('probalqty')
            var sizeid = $(this).find(':selected').data('sizeid')
            var sizename = $(this).find(':selected').data('sizename')
            //   alert(count+'-'+unit);
            $('#ivt_stkout_prodqty' + count).attr('max', probalqty);
            $('#ivt_stkout_unit' + count).text(unit);
            $('#ivt_stkout_prodrate' + count).val(rate);
            $('#prodsize_name' + count).text(sizename);
            $('#prodsize_id' + count).val(sizeid);
            //   $('#storeout_prodrate'+count).text(rate);
            //   $('#storeout_unit'+count).text(unit);
            //   $('#m_sales_customer').val(custID);
        });


        $(document).on("keyup", '.prodqty', function() {
            var count = $(this).data('count');
            var qty = $(this).val();
            var rate = $('#ivt_stkout_prodrate' + count).val();

            $('#ivt_stkout_tamt' + count).val(qty * rate);

        });



    });

    function remove_row(cout) {
        $('#rowunt' + cout).remove();
    }
</script>