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

                        <a href="<?php echo $mode == 1 ? site_url('Vouchers/payment_list') : site_url('Vouchers/receipt_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> <?= $mode == 1 ? 'All payments' : 'All receipt' ?></a>
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

            $id         = $edit_value->m_payment_id;
            $payment_no = $edit_value->m_payment_voucherno;
            $company    = $edit_value->m_payment_company;
            $date       = $edit_value->m_payment_date;
            $typee     = $edit_value->m_payment_type;
            $plotid   = $edit_value->m_payment_plotid;
            $exchng_rt  = $edit_value->dollar_exchng_rt;
            $is_dollar     = $edit_value->is_dollar;
            $narration  = $edit_value->m_payment_narration;
            $mode  = $edit_value->m_payment_mode;
            $TAmount  = $edit_value->m_payment_amount;
        } else {
            $id         = '';
            $payment_no  = $mode == 1 ? 'PYMNT/' . (rand(10, 10000)) : 'RCPT/' . (rand(10, 10000));
            $company    = '';
            $date       = date('Y-m-d');
            // $product    = '';
            $plotid   = '';
            $typee    = $mode == 1 ? 1 : 2;
            $exchng_rt       = '';
            $is_dollar   = '';
            // $tamt       = '';
            $narration     = '';
            $TAmount     = '';
        } ?>

        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-add-payment" enctype="mutipart/form-data">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="hidden" name="m_payment_mode" id="m_payment_mode" value="<?= $mode; ?>">
                                    <input type="hidden" name="m_payment_id" id="m_payment_id" value="<?= $id; ?>">
                                    <select name="m_payment_company" id="m_payment_company" class="form-control select2">
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
                                    <label>Voucher No</label>
                                    <input type="text" name="m_payment_no" id="m_payment_no" class="form-control" required="" value="<?= $payment_no; ?>">
                                </div>
                            </div>
                            <div class="col-md-2 pull-right">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="m_payment_date" id="m_payment_date" class="form-control" required="" value="<?= $date; ?>">
                                    <input type="hidden" name="m_payment_amount" id="m_payment_amount" class="form-control" value="<?= $TAmount; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Pay To</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">

                                            <select id="m_payment_type" name="m_payment_type" class="form-control">
                                                <option value="1" <?= $typee == 1 ? 'selected' : '' ?>>DR</option>
                                                <option value="2" <?= $typee == 2 ? 'selected' : '' ?>>CR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">

                                            <select id="m_payment_plotid" name="m_payment_plotid" class="form-control select2">
                                                <option value=""> Select AccountName</option>
                                                <?php
                                                foreach ($plot_dtl as $ukey) {

                                                ?>
                                                    <option value="<?php echo $ukey->m_plot_id; ?>" <?= $plotid == $ukey->m_plot_id ? 'selected' : '' ?>><?php echo $ukey->m_plot_name ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($mode == 1) { ?>
                                <div class="col-md-6">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input type="checkbox" <?php if (!empty($is_dollar)) {
                                                                        echo 'checked';
                                                                    } ?> class="form-check-input" id="is_dollar" name="is_dollar">
                                            <label class="form-check-label" for="is_dollar"> Is Dollar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 " <?= $id ? '' : `style="display:none;"` ?> id="exchngfiled">
                                        <label class="form-check-label">Exchange Rate</label>
                                        <input type="number" name="dollar_exchng_rt" id="dollar_exchng_rt" class="form-check-input" value="<?= $exchng_rt; ?>">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-vsm btn-primary pull-right" onclick="addrow()">Add Row</button>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th width="1%">Sn</th>
                                        <th>Account Name</th>
                                        <th width="12%">Amount </th>
                                        <th>Remark</th>

                                    </thead>
                                    <tbody id="tableblock">
                                        <?php if (!empty($id)) {
                                            $coun = 0;
                                            foreach ($info_value as $key) {
                                                $coun++; ?>
                                                <tr>
                                                    <td id="rowcount<?= $coun ?>"><input type="hidden" name="pt_dtl_id[]" id="pt_dtl_id<?= $coun ?>" value="<?= $key->pt_dtl_id ?>"> <?= $coun ?></td>
                                                    <td><input type="text" list="usersdtl<?= $coun ?>" placeholder="Enter Account Name" class="form-control account_name" data-count="<?= $coun ?>" value="<?= $key->m_plot_name ?>" />
                                                        <input type="hidden" id="pt_dtl_plotid<?= $coun ?>" name="pt_dtl_plotid[]" value="<?= $key->pt_dtl_plotid ?>">
                                                        <datalist id="usersdtl<?= $coun ?>">
                                                            <?php
                                                            foreach ($plot_dtl as $ukey) {
                                                            ?>
                                                                <option value="<?php echo $ukey->m_plot_name; ?>" data-plotid="<?= $ukey->m_plot_id ?>"><?php echo $ukey->m_plot_mobile ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </datalist>
                                                    </td>
                                                    <td><input type="number" id="pt_dtl_amount<?= $coun ?>" name="pt_dtl_amount[]" class="form-control Totalamount" data-count="<?= $coun ?>" value="<?= $key->pt_dtl_amount ?>"></td>
                                                    <td><input type="text" id="pt_dtl_remark<?= $coun ?>" name="pt_dtl_remark[]" class="form-control" value="<?= $key->pt_dtl_remark ?>"></td>

                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td id="rowcount1"><input type="hidden" name="pt_dtl_id[]" id="pt_dtl_id1"> 1</td>

                                                <td><input type="text" list="usersdtl1" placeholder="Enter Account Name" class="form-control account_name" data-count="1" value="<?= $plotid ?>" />
                                                    <input type="hidden" id="pt_dtl_plotid1" name="pt_dtl_plotid[]">
                                                    <datalist id="usersdtl1">
                                                        <?php
                                                        foreach ($plot_dtl as $ukey) {
                                                        ?>
                                                            <option value="<?php echo $ukey->m_plot_name; ?>" data-plotid="<?= $ukey->m_plot_id ?>"><?php echo $ukey->m_plot_mobile ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </datalist>
                                                </td>
                                                <td><input type="number" id="pt_dtl_amount1" name="pt_dtl_amount[]" class="form-control Totalamount"></td>
                                                <td><input type="text" id="pt_dtl_remark1" name="pt_dtl_remark[]" class="form-control"></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Narration</label>
                                    <input type="text" name="m_payment_narration" id="m_payment_narration" class="form-control" value="<?= $narration; ?>">
                                </div>
                            </div>
                        </div>

                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-payment" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>

                            <?php if ($mode == 1) { ?>
                                <div class="col-md-6">
                                    <?php if (!empty($id)) { ?>
                                        <div class="form-layout-submit"><a href="<?php echo site_url('Vouchers/payment_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                        <?php } else { ?>
                                            <div class="form-layout-submit"><a href="<?php echo site_url('Vouchers/add_payment'); ?>" class="btn btn-block btn-danger">Reset</a>
                                            <?php } ?>
                                            </div>
                                        </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-6">
                                    <?php if (!empty($id)) { ?>
                                        <div class="form-layout-submit"><a href="<?php echo site_url('Vouchers/receipt_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                        <?php } else { ?>
                                            <div class="form-layout-submit"><a href="<?php echo site_url('Vouchers/add_receipt'); ?>" class="btn btn-block btn-danger">Reset</a>
                                            <?php } ?>
                                            </div>
                                        </div>
                                </div>
                            <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========================/View=================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/js_setup'); ?>


<script type="text/javascript">
    let x = 1;

    function addrow() {
        x++;
        $('#tableblock').append(`<tr>
                                            <td id="rowcount` + x + `">` + x + `</td>
                                            <td><input type="text" list="usersdtl` + x + `" placeholder="Enter Account Name" class="form-control account_name" data-count="` + x + `" />
                                            <input type="hidden" id="pt_dtl_plotid` + x + `" name="pt_dtl_plotid[]" >    
                                            <datalist id="usersdtl` + x + `">
                                                    <?php
                                                    foreach ($plot_dtl as $ukey) {
                                                    ?>
                                                        <option value="<?php echo $ukey->m_plot_name; ?>" data-plotid="<?= $ukey->m_plot_id ?>"><?php echo $ukey->m_plot_mobile ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </datalist></td>
                                            <td><input type="number" id="pt_dtl_amount` + x + `" name="pt_dtl_amount[]" class="form-control Totalamount"></td>
                                            <td><input type="text" id="pt_dtl_remark` + x + `" name="pt_dtl_remark[]" class="form-control"></td>
                                         
                                        </tr>
                                       `);
    }

    $(document).on("change", '.account_name', function() {

        var count = $(this).data('count');

        var prodid = $("#usersdtl" + count + " option[value='" + $(this).val() + "']").attr('data-plotid')

        $('#pt_dtl_plotid' + count).val(prodid);
        //   alert('working '+prodid);
    });

    checkbox_checked("#is_dollar", '#exchngfiled');

    $(document).on("click", '#is_dollar', function() {
        checkbox_checked(this, '#exchngfiled');
    });

    $(document).on("change", '.Totalamount', function() {
        let Tamount = 0;
        $(".Totalamount").each(function(index) {
            Tamount += parseFloat($(this).val());
            $('#m_payment_amount').val(Tamount);

        });
    });


    function checkbox_checked(checkboxId, inputId) {
        if ($(checkboxId).is(":checked")) {
            $(inputId).show();
        } else {
            $(inputId).hide();
        }
    }
</script>