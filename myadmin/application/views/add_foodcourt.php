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
                        <a href="<?php echo site_url('Restuarent/foodcourt_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All sales </a>
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

            th,
            td {
                font-size: 15px !important;
                padding: 4px !important;
            }
        </style>

        <?php if (!empty($edit_value)) {
            $fcdata_date         = $edit_value->r_fcdata_date;
            $fcdata_uno         = $edit_value->r_fcdata_uno;
            $fcdata_acc  = $edit_value->r_fcdata_acc;
            $fcdata_mobile  = $edit_value->r_fcdata_mobile;
            $fcdata_name    = $edit_value->r_fcdata_name;
            $fcdata_balamt     = $edit_value->r_fcdata_balamt;
            $fcdata_nettotal     = $edit_value->r_fcdata_nettotal;
            $fcdata_remark       = $edit_value->r_fcdata_remark;
            $fcdata_respon       = $edit_value->r_fcdata_respon;
            $fcdata_amt      = $edit_value->r_fcdata_amt;
            $fcdata_amt2      = $edit_value->r_fcdata_amt2;
            $fcdata_paytype       = $edit_value->r_fcdata_paytype;
            $fcdata_paytype2       = $edit_value->r_fcdata_paytype2;
            $fcdata_ispartial       = $edit_value->r_fcdata_ispartial;
            $fcdata_iscredit       = $edit_value->r_fcdata_iscredit;
            $fcdata_items       = $edit_value->r_fcdata_items;
            $fcdata_extra       = $edit_value->r_fcdata_extra;
            $fcdata_disc       = $edit_value->r_fcdata_disc;
        } else {

            $fcdata_date         = '';
            $fcdata_uno         = '';
            $fcdata_acc  = '';
            $fcdata_mobile  = '';
            $fcdata_name    = '';
            $fcdata_balamt     = '';
            $fcdata_nettotal     = 0;
            $fcdata_remark       = '';
            $fcdata_respon       = '';
            $fcdata_amt      = '';
            $fcdata_amt2      = '';
            $fcdata_paytype       = '';
            $fcdata_paytype2       = '';
            $fcdata_ispartial       = '';
            $fcdata_extra       = '';
            $fcdata_disc       = 0;
            $fcdata_items       = array();
        }
        ?>

        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-foodcourt" enctype="mutipart/form-data">
                        <div class="row">

                            <div class="col-md-3 ">
                                <div class="form-check">
                                    <input type="checkbox" <?php if ($fcdata_iscredit == 1) {
                                                                echo 'checked';
                                                            } ?> class="form-check-input" id="r_fcdata_iscredit" name="r_fcdata_iscredit" value="1">
                                    <label class="form-check-label" for="r_fcdata_iscredit"> Is Credit</label>
                                    <input type="checkbox" <?php if ($fcdata_iscredit == 2) {
                                                                echo 'checked';
                                                            } ?> class="form-check-input" id="r_fcdata_iscredit2" name="r_fcdata_iscredit2" value="2" style="margin-left: 15px;">
                                    <label class="form-check-label" for="r_fcdata_iscredit2"> Is Free</label>
                                    <input type="checkbox" <?php if ($fcdata_iscredit == 3) {
                                                                echo 'checked';
                                                            } ?> class="form-check-input" id="r_fcdata_iscredit3" name="r_fcdata_iscredit3" value="3" style="margin-left: 15px;">
                                    <label class="form-check-label" for="r_fcdata_iscredit2"> Is Room</label>
                                </div>
                            </div>

                            <div class="col-md-2 cashdiv">
                                <div class="form-group ">
                                    <label>Cash Account</label>
                                    <select name="r_fcdata_acc" id="r_fcdata_acc" class="form-control select2">
                                        <?php
                                        foreach ($cashcot_dtl as $cckey) {
                                            if ($fcdata_acc == $cckey->m_cashacc_id) {
                                                $op = 'selected';
                                            } else {
                                                $op = '';
                                            }
                                        ?>
                                            <option value="<?php echo $cckey->m_cashacc_id; ?>" <?= $op ?>><?php echo $cckey->m_cashacc_name; ?>
                                            </option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 creditdiv" style="display: none;">
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" placeholder="Enter Mobile No." class="form-control" id="r_fcdata_mobile" name="r_fcdata_mobile" value="<?= $fcdata_mobile ?>" />

                                </div>
                            </div>
                            <div class="col-md-2 creditdiv" style="display: none;">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="r_fcdata_name" id="r_fcdata_name" class="form-control" placeholder="Enter Name" value="<?= $fcdata_name ?>">
                                </div>
                            </div>

                            <div class="col-md-2" style="float: right;">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="hidden" name="r_fcdata_uno" id="r_fcdata_uno" value="<?= $fcdata_uno ?>">
                                    <input type="date" name="r_fcdata_date" id="r_fcdata_date" class="form-control" readonly value="<?php if ($fcdata_date == '') {
                                                                                                                                        echo date('Y-m-d');
                                                                                                                                    } else {
                                                                                                                                        echo $fcdata_date;
                                                                                                                                    } ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-7" id="itemsdiv">
                                        <label>List of Items</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Items</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Rate</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Quantity</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Total</label>
                                            </div>

                                        </div>
                                        <?php $kry = 1;
                                        if (!empty($fcdata_items)) {
                                            foreach ($fcdata_items as $fval) { ?>
                                                <div class="row" style="margin-top: 5px;" id="rowid<?= $kry ?>">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <select name="r_fcdata_itemid[]" id="r_fcdata_itemid<?= $kry ?>" class="form-control select2 itemsel" data-count="<?= $kry ?>" required style="width: 100%;">
                                                                <option value="">Select items</option>
                                                                <?php
                                                                $j = 0;
                                                                foreach ($menulist as $men) {
                                                                    $option1 = "";

                                                                    if ($fval->r_fcdata_itemid == $men->m_menu_id) {
                                                                        $option1 = "selected";
                                                                        $j++;
                                                                    }

                                                                ?>
                                                                    <option value="<?php echo $men->m_menu_id; ?>" <?= $option1 ?> data-rate="<?php echo $men->m_menu_rate; ?>"><?php echo $men->m_menu_name ?></option>
                                                                <?php
                                                                }

                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="number" name="r_fcdata_rate[]" id="r_fcdata_rate<?= $kry ?>" class="form-control" data-count="<?= $kry ?>" readonly value="<?= $fval->r_fcdata_rate ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="hidden" name="r_fcdata_id[]" id="r_fcdata_id<?= $kry ?>" value="<?= $fval->r_fcdata_id ?>">
                                                            <input type="number" name="r_fcdata_qty[]" id="r_fcdata_qty<?= $kry ?>" class="form-control qtychg" data-count="<?= $kry ?>" required value="<?= $fval->r_fcdata_qty ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="number" name="r_fcdata_total[]" id="r_fcdata_total<?= $kry ?>" class="form-control subtol" data-count="<?= $kry ?>" readonly value="<?= $fval->r_fcdata_total ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" id="colbtnid<?= $kry ?>">
                                                        <button class="btn btn-danger delete-foodcourt" data-type="2" data-value="<?php echo $fval->r_fcdata_id; ?>" type="button">Remove</button>
                                                    </div>
                                                </div>
                                            <?php $kry++;
                                            }
                                            echo '<button class="btn btn-info" id="editaddbtn" type="button" onclick="addrow(' . $kry . ')">Add More</button>';
                                        } else { ?>
                                            <div class="row" style="margin-top: 5px;" id="rowid1">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <select name="r_fcdata_itemid[]" id="r_fcdata_itemid1" class="form-control select2 itemsel" data-count="1" required style="width: 100%;">
                                                            <option value="">Select items</option>
                                                            <?php
                                                            $j = 0;
                                                            foreach ($menulist as $value) {
                                                                $option1 = "";

                                                                if ($items[$j] == $value->m_menu_id) {
                                                                    $option1 = "selected";
                                                                    $j++;
                                                                }

                                                            ?>
                                                                <option value="<?php echo $value->m_menu_id; ?>" <?= $option1 ?> data-rate="<?php echo $value->m_menu_rate; ?>"><?php echo $value->m_menu_name ?></option>
                                                            <?php
                                                            }

                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="number" name="r_fcdata_rate[]" id="r_fcdata_rate1" class="form-control" data-count="1" readonly value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="number" name="r_fcdata_qty[]" id="r_fcdata_qty1" class="form-control qtychg" data-count="1" required value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="number" name="r_fcdata_total[]" id="r_fcdata_total1" class="form-control subtol" data-count="1" readonly value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-2" id="colbtnid1">
                                                    <button class="btn btn-info" type="button" onclick="addrow(1)">Add More</button>
                                                </div>
                                            </div>
                                        <?php } ?>


                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Net Amount</label>
                                                    <input type="number" name="r_fcdata_nettotal" id="r_fcdata_nettotal" class="form-control" readonly value="<?= $fcdata_nettotal ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 cashdiv">
                                                <div class="form-group">
                                                    <label>Discount Amount</label>
                                                    <input type="number" name="r_fcdata_disc" id="r_fcdata_disc" class="form-control" value="<?= $fcdata_disc ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 cashdiv paypartial" style="<?php if ($fcdata_ispartial != 1) echo 'display: none;' ?> margin-top:30px; height:65px">
                                                <div class="form-check">
                                                    <input type="checkbox" <?php if ($fcdata_ispartial == 1) {
                                                                                echo 'checked';
                                                                            } ?> class="form-check-input" id="r_fcdata_ispartial" name="r_fcdata_ispartial" value="1">
                                                    <label class="form-check-label" for="r_fcdata_ispartial"> Partial Payment</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6 col-md-6 col-sm-6 cashdiv" style="display: block;" id="Ampayty_in">
                                                <div class="form-group">
                                                    <label>Payment Mode</label>
                                                    <select name="r_fcdata_paytype" id="r_fcdata_paytype" class="form-control select2">
                                                        <option value="1" <?php if ($fcdata_paytype == 1) echo 'selected' ?>>Cash</option>
                                                        <option value="2" <?php if ($fcdata_paytype == 2) echo 'selected' ?>>Paytm</option>
                                                        <option value="3" <?php if ($fcdata_paytype == 3) echo 'selected' ?>>Phone Pay</option>
                                                        <option value="4" <?php if ($fcdata_paytype == 4) echo 'selected' ?>>Other</option>
                                                        <option value="partial" id="partial_op">Partial Payment</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 cashdiv">
                                                <div class="form-group">
                                                    <label>Amount Paid</label>
                                                    <input type="number" name="r_fcdata_amt" id="r_fcdata_amt" class="form-control" required value="<?= $fcdata_amt ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 cashdiv paypartial" style="<?php if ($fcdata_ispartial != 1) echo 'display: none;' ?>">
                                                <div class="form-group">
                                                    <label>Payment Mode2</label>
                                                    <select name="r_fcdata_paytype2" id="r_fcdata_paytype2" class="form-control select2">
                                                        <option value="1" <?php if ($fcdata_paytype2 == 1) echo 'selected' ?>>Cash</option>
                                                        <option value="2" <?php if ($fcdata_paytype2 == 2) echo 'selected' ?>>Paytm</option>
                                                        <option value="3" <?php if ($fcdata_paytype2 == 3) echo 'selected' ?>>Phone Pay</option>
                                                        <option value="4" <?php if ($fcdata_paytype2 == 4) echo 'selected' ?>>Other</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 cashdiv paypartial" style="<?php if ($fcdata_ispartial != 1) echo 'display: none;' ?>">
                                                <div class="form-group">
                                                    <label>Amount Paid2</label>
                                                    <input type="number" name="r_fcdata_amt2" id="r_fcdata_amt2" class="form-control" value="<?= $fcdata_amt2 ?>">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 creditdiv" <?php if ($fcdata_iscredit != 1) {
                                                                                                    echo 'style="display: none;"';
                                                                                                } ?> id="respo_in">
                                                <div class="form-group">
                                                    <label>Credit Responsible</label>
                                                    <select name="r_fcdata_respon" id="r_fcdata_respon" class="form-control select2">
                                                        <option value=""> -- select employee--</option>
                                                        <?php
                                                        foreach ($emp_list as $emp) {
                                                            if ($fcdata_respon == $emp->m_emp_id) {
                                                                $op = 'selected';
                                                            } else {
                                                                $op = '';
                                                            }

                                                        ?>
                                                            <option value="<?php echo $emp->m_emp_id; ?>" <?= $op ?>><?php echo $emp->m_emp_name; ?></option>
                                                        <?php
                                                        }

                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 cashdiv">
                                                <div class="form-group">
                                                    <label>Extra Amount</label>
                                                    <input type="number" name="r_fcdata_extra" id="r_fcdata_extra" class="form-control" value="<?= $fcdata_extra ?>">
                                                </div>
                                            </div>


                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Remark</label>
                                                    <input type="text" name="r_fcdata_remark" id="r_fcdata_remark" class="form-control" value="<?= $fcdata_remark ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-foodcourt" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <a href="<?php echo site_url('Restuarent/foodcourt_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- ========================/View=================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/restuarent_js');
?>

<script>
    $(document).ready(function(e) {
      
        $('#r_fcdata_iscredit,#r_fcdata_iscredit2,#r_fcdata_iscredit3').click(function() {
            if ($(this).prop('checked') == false) {
                $('.cashdiv').css('display', 'block');
                $('.creditdiv').css('display', 'none');
                $('.paypartial').css('display', 'none');
                $('#r_fcdata_amt').prop('required', true);
                $('#r_fcdata_respon').prop('required', false);
            } else {
                $('.cashdiv').css('display', 'none');
                $('.creditdiv').css('display', 'block');
                $('.paypartial').css('display', 'none');
                $('#r_fcdata_amt').prop('required', false);
                $('#r_fcdata_respon').prop('required', true);
            }
        });

        $('#r_fcdata_ispartial').click(function() {
            if ($(this).prop('checked') == false) {
                $('.paypartial').css('display', 'none');
                $('#r_fcdata_paytype').append(`<option value="partial" id="partial_op">Partial Payment</option>`);
                $('#r_fcdata_ispartial').prop('checked', false);
                $('#r_fcdata_paytype').val(1);
            }
        });

        $('#r_fcdata_paytype').change(function() {

            if ($(this).val() == 'partial') {
                $('.paypartial').css('display', 'block');
                $('#partial_op').remove();
                $('#r_fcdata_ispartial').prop('checked', true);
                $('#r_fcdata_paytype').val(1);
            }

        });

        $('#r_fcdata_amt').change(function() {
            if ($('#r_fcdata_ispartial').prop('checked') == true) {
                var disc = parseFloat($('#r_fcdata_disc').val());
                var netamout = parseFloat($('#r_fcdata_nettotal').val());
                var paidt1 = parseFloat($(this).val());
                var paidt2 = (netamout - paidt1 - disc);
                $('#r_fcdata_amt2').val(paidt2);
            }

        });

        $('#r_fcdata_disc').keyup(function() {
            calculate_function()
        });

        $(document).on('change', '.itemsel', function() {
            var count = $(this).data('count');
            var price = $(this).find(':selected').data('rate');
            $('#r_fcdata_rate' + count).val(price);
        });

        $(document).on("keyup", '.qtychg', function() {
            var count = $(this).data('count');
            var rate = parseFloat($('#r_fcdata_rate' + count).val());
            var qty = parseFloat($(this).val());

            var itemtotal = rate * qty;
            $('#r_fcdata_total' + count).val(itemtotal);
            calculate_function();
        });

        $(document).on("click", '.remoerow', function() {
            var count = $(this).data('count');
            $('#rowid' + count).remove();
            calculate_function();
        });

    });

    function calculate_function() {
        var disc = parseFloat($('#r_fcdata_disc').val());
        var nettotal = 0;
        $('.subtol').each(function(index) {
            nettotal += parseFloat($(this).val());
        });
        $('#r_fcdata_amt').val(nettotal - disc);
        $('#r_fcdata_nettotal').val(nettotal);
    }

    function addrow(x) {
        $('#editaddbtn').remove();
        $('#colbtnid' + x).html(`<button class="btn btn-danger remoerow" data-count="` + x + `" type="button" >Remove</button>`);
        x++;
        $('#itemsdiv').append(`<div class="row" style="margin-top: 5px;" id="rowid` + x + `">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select name="r_fcdata_itemid[]" id="r_fcdata_itemid` + x + `" class="form-control select2 itemsel" data-count="` + x + `" required>
                                                        <option value="">Select items</option>
                                                        <?php
                                                        $j = 0;
                                                        foreach ($menulist as $value) {
                                                            $option1 = "";

                                                            if ($items[$j] == $value->m_menu_id) {
                                                                $option1 = "selected";
                                                                $j++;
                                                            }

                                                        ?>
                                                            <option value="<?php echo $value->m_menu_id; ?>" <?= $option1 ?> data-rate="<?php echo $value->m_menu_rate; ?>"><?php echo $value->m_menu_name ?></option>
                                                        <?php
                                                        }

                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="number" name="r_fcdata_rate[]" id="r_fcdata_rate` + x + `" class="form-control" data-count="` + x + `" readonly value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="number" name="r_fcdata_qty[]" id="r_fcdata_qty` + x + `" class="form-control qtychg" data-count="` + x + `" required value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="number" name="r_fcdata_total[]" id="r_fcdata_total` + x + `" class="form-control subtol" data-count="` + x + `" readonly value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="colbtnid` + x + `">
                                                <button class="btn btn-info" type="button" onclick="addrow(` + x + `)">Add More</button>
                                            </div>
                                        </div>`);

        selectRefresh();
    }
</script>