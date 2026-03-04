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

                        <a href="<?php echo $mode == 1 ? site_url('Vouchers/expense_list') : site_url('Vouchers/journal_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> <?= $mode == 1 ? 'All Expenses' : 'All Journal' ?></a>
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
            $company    = $edit_value[0]->m_expense_company;
            $date       = $edit_value[0]->m_expense_date;
            $expense_act   = $edit_value[0]->m_expense_act;
            $expense_dept  = $edit_value[0]->m_expense_dept;
            $expense_resp  = $edit_value[0]->m_expense_resp;
            $narration  = $edit_value[0]->m_expense_narration;
            $mode  = $edit_value[0]->m_expense_mode;
        } else {
            $company    = '';
            $date       = date('Y-m-d');
            $expense_act = '';
            $expense_dept = '';
            $expense_resp = '';
            $narration     = '';
        } ?>

        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-add-expense" enctype="mutipart/form-data">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="hidden" name="m_expense_mode" id="m_expense_mode" value="<?= $mode; ?>">
                                    <select name="m_expense_company" id="m_expense_company" class="form-control select2">
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
                                    <label>Department <span class="text-danger">*</span></label>
                                    <select name="m_expense_dept" id="m_seldept" class="form-control select2" required>
                                        <?php
                                        if (!empty($dept_list)) {

                                            foreach ($dept_list as $dkey) {
                                                if ($expense_dept == $dkey->m_dept_id) {
                                                    $op = 'selected';
                                                } else {
                                                    $op = '';
                                                }
                                        ?>
                                                <option value="<?php echo $dkey->m_dept_id; ?>" <?= $op ?>><?php echo $dkey->m_dept_name; ?>
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
                                    <label>Cash Account <span class="text-danger">*</span></label>
                                    <input type="hidden" id="m_cashcount_val" value="<?= $expense_act ?>">
                                    <select name="m_expense_act" id="m_cashcount" class="form-control select2" required>
                                        <?php
                                        if (!empty($casact_list)) {
                                            foreach ($casact_list as $dkey) {
                                                if ($expense_act == $dkey->m_cashacc_id) {
                                                    $op = 'selected';
                                                } else {
                                                    $op = '';
                                                }
                                        ?>
                                                <option value="<?php echo $dkey->m_cashacc_id; ?>" <?= $op ?>><?php echo $dkey->m_cashacc_name; ?>
                                                </option>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-2 pull-right">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="m_expense_date" id="m_expense_date" class="form-control" readonly value="<?= $date; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-vsm btn-primary pull-right" onclick="addrow()">Add Row</button>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th width="1%">Sn</th>
                                        <th>Account Name</th>
                                        <th width="12%">Amount</th>
                                        <th width="12%">Paymode</th>
                                        <th width="12%">File</th>
                                        <th>Remark</th>

                                    </thead>
                                    <tbody id="tableblock">
                                        <?php if (!empty($id)) {
                                            $coun = 0;
                                            foreach ($edit_value as $key) {
                                                $coun++; ?>
                                                <tr>
                                                    <td id="rowcount<?= $coun ?>"><input type="hidden" name="m_expense_id[]" id="m_expense_id" value="<?= $key->m_expense_id ?>"> <?= $coun ?></td>
                                                    <td><input type="text" list="usersdtl<?= $coun ?>" placeholder="Enter Account Name" class="form-control account_name" data-count="<?= $coun ?>" value="<?= $key->m_prodcat_name ?>" />
                                                        <input type="hidden" id="m_expense_cat<?= $coun ?>" name="m_expense_cat[]" value="<?= $key->m_expense_cat ?>">
                                                        <datalist id="usersdtl<?= $coun ?>">
                                                            <?php
                                                            if (!empty($expcat_list)) {
                                                                foreach ($expcat_list as $ukey) {
                                                            ?>
                                                                    <option value="<?php echo $ukey->m_prodcat_name; ?>" data-plotid="<?= $ukey->m_prodcat_id ?>" data-plotmax="<?= $ukey->m_prodcat_max ?>"><?php echo $ukey->m_prodcat_name ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </datalist>
                                                    </td>
                                                    <td><input type="number" id="m_expense_amt<?= $coun ?>" name="m_expense_amt[]" class="form-control" value="<?= $key->m_expense_amt ?>"></td>
                                                    <td> <select name="m_expense_paymode[]" id="m_expense_paymode<?= $coun ?>" class="form-control">
                                                        <option value="1" <?php if ($key->m_expense_paymode == 1) echo 'selected' ?>>Cash</option>
                                                        <option value="2" <?php if ($key->m_expense_paymode == 2) echo 'selected' ?>>Paytm</option>
                                                        <option value="3" <?php if ($key->m_expense_paymode == 3) echo 'selected' ?>>Phone Pay</option>
                                                        <option value="4" <?php if ($key->m_expense_paymode == 4) echo 'selected' ?>>Other</option>

                                                    </select></td>
                                                    <td><input type="file" id="m_expense_file<?= $coun ?>" name="m_expense_file[]" class="form-control">
                                                        <input type="hidden" id="m_expense_file1<?= $coun ?>" name="m_expense_file1[]" class="form-control" value="<?= $key->m_expense_file ?>">
                                                    </td>
                                                    <td><input type="text" id="m_expense_remark<?= $coun ?>" name="m_expense_remark[]" class="form-control" value="<?= $key->m_expense_remark ?>"></td>

                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td id="rowcount1"><input type="hidden" name="m_expense_id[]" id="m_expense_id"> 1</td>

                                                <td><input type="text" list="usersdtl1" placeholder="Enter Account Name" class="form-control account_name" data-count="1" />
                                                    <input type="hidden" id="m_expense_cat1" name="m_expense_cat[]">
                                                    <datalist id="usersdtl1">
                                                        <?php
                                                        if (!empty($expcat_list)) {
                                                            foreach ($expcat_list as $ukey) {
                                                        ?>
                                                                <option value="<?php echo $ukey->m_prodcat_name; ?>" data-plotid="<?= $ukey->m_prodcat_id ?>" data-plotmax="<?= $ukey->m_prodcat_max ?>"><?php echo $ukey->m_prodcat_name ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </datalist>
                                                </td>
                                                <td><input type="number" id="m_expense_amt1" name="m_expense_amt[]" class="form-control"></td>
                                                <td> <select name="m_expense_paymode[]" id="m_expense_paymode1" class="form-control">
                                                        <option value="1">Cash</option>
                                                        <option value="2">Paytm</option>
                                                        <option value="3">Phone Pay</option>
                                                        <option value="4">Other</option>

                                                    </select></td>
                                                <td><input type="file" id="m_expense_file1" name="m_expense_file[]" class="form-control">
                                                    <input type="hidden" id="m_expense_file11" name="m_expense_file1[]">
                                                </td>
                                                <td><input type="text" id="m_expense_remark1" name="m_expense_remark[]" class="form-control"></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Narration</label>
                                    <input type="text" name="m_expense_narration" id="m_expense_narration" class="form-control" value="<?= $narration; ?>">
                                </div>
                            </div>
                        </div>

                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-expense" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>

                            <?php if ($mode == 1) { ?>
                                <div class="col-md-6">
                                    <?php if (!empty($id)) { ?>
                                        <div class="form-layout-submit"><a href="<?php echo site_url('Vouchers/expense_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                        <?php } else { ?>
                                            <div class="form-layout-submit"><a href="<?php echo site_url('Vouchers/add_expense'); ?>" class="btn btn-block btn-danger">Reset</a>
                                            <?php } ?>
                                            </div>
                                        </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-6">
                                    <?php if (!empty($id)) { ?>
                                        <div class="form-layout-submit"><a href="<?php echo site_url('Vouchers/journal_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                        <?php } else { ?>
                                            <div class="form-layout-submit"><a href="<?php echo site_url('Vouchers/add_journal'); ?>" class="btn btn-block btn-danger">Reset</a>
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
                                            <input type="hidden" id="m_expense_cat` + x + `" name="m_expense_cat[]" >    
                                            <datalist id="usersdtl` + x + `">
                                            <?php
                                            if (!empty($expcat_list)) {
                                                foreach ($expcat_list as $ukey) {
                                            ?>
                                                                    <option value="<?php echo $ukey->m_prodcat_name; ?>" data-plotid="<?= $ukey->m_prodcat_id ?>" data-plotmax="<?= $ukey->m_prodcat_max ?>"><?php echo $ukey->m_prodcat_name ?></option>
                                                            <?php
                                                        }
                                                    }
                                                            ?>
                                                </datalist></td>
                                            <td><input type="number" id="m_expense_amt` + x + `" name="m_expense_amt[]" class="form-control"></td>
                                            <td> <select name="m_expense_paymode[]" id="m_expense_paymode` + x + `" class="form-control">
                                                        <option value="1">Cash</option>
                                                        <option value="2">Paytm</option>
                                                        <option value="3">Phone Pay</option>
                                                        <option value="4">Other</option>

                                                    </select></td>
                                            <td><input type="file" id="m_expense_file` + x + `" name="m_expense_file[]" class="form-control">
                                            <input type="hidden" id="m_expense_file1` + x + `" name="m_expense_file1[]" ></td>
                                            <td><input type="text" id="m_expense_remark` + x + `" name="m_expense_remark[]" class="form-control"></td>
                                        </tr>
                                       `);
    }

    $(document).on("change", '.account_name', function() {

        var count = $(this).data('count');

        var prodid = $("#usersdtl" + count + " option[value='" + $(this).val() + "']").attr('data-plotid')

        $('#m_expense_cat' + count).val(prodid);
        //   alert('working '+prodid);
    });
</script>