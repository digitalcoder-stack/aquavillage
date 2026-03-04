<?php $this->view('top_header') ?>
<div class="page-content">
    <div class="container-fluid">
        <div class="breadcromb-area">
            <?php
            switch ($pagemode) {
                case 1: {
                        $pagelink = "Inventory/purchase_order";
                        $addlink = "Inventory/add_purchase_order";
                        $submod = "PORD";
                    }
                    break;
                case 2: {
                        $pagelink = "Inventory/purchase_invoice";
                        $addlink = "Inventory/add_purchase_invoice";
                        $submod = "PINV";
                    }
                    break;
                case 3: {
                        $pagelink = "Inventory/purchase_return";
                        $addlink = "Inventory/add_purchase_return";
                        $submod = "PRNT";
                    }
                    break;
            } ?>

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 pull-right">
                    <div class="seipkon-breadcromb-right">

                        <a href="<?= site_url($pagelink); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> View List</a>
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

            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>

        <?php if (!empty($edit_value)) {
            if ($pagemode == 3 && !empty($eid)) {
                $id = '';
                $purchase_no  = $rpurchase_no;
                $puridretn  = $eid;
                $date  = date('Y-m-d');
            } else {
                $id = $edit_value->ivt_purchase_id;
                $purchase_no  = $edit_value->ivt_purchase_no;
                $puridretn  = $edit_value->ivt_purchase_purid;
                $date  = $edit_value->ivt_purchase_date;
            }

            $mode         = $edit_value->ivt_purchase_mode;
            $itype    = $edit_value->ivt_purchase_type;
            $company       = $edit_value->ivt_purchase_company;
            $account     = $edit_value->ivt_purchase_account;
            $godown   = $edit_value->ivt_purchase_godown;
            $paymode  = $edit_value->ivt_purchase_paymode;
            $invno  = $edit_value->ivt_purchase_invno;
            $invdate  = $edit_value->ivt_purchase_invdate == '0000-00-00' ? date('Y-m-d') : $edit_value->ivt_purchase_invdate;


            $cashacc  = $edit_value->ivt_purchase_cashacc;
            $partyid  = $edit_value->ivt_purchase_partyid;

            $puradvn  = $edit_value->ivt_purchase_advance;
            $purbal  = $edit_value->ivt_purchase_balance;
            $remark = $edit_value->ivt_purchase_remark;
            $nopkgs = $edit_value->ivt_purchase_nopkgs;
            $vehical = $edit_value->ivt_purchase_vehical;
            $billtyno = $edit_value->ivt_purchase_billtyno;
            $billtydate = $edit_value->ivt_purchase_billtydate;
            $waybill = $edit_value->ivt_purchase_waybill;
            $waydate = $edit_value->ivt_purchase_waydate;
            $nbremark = $edit_value->ivt_purchase_nbremark;
            $creditdays = $edit_value->ivt_purchase_creditdays;
            $Tamount = $edit_value->ivt_purchase_Tamount;
            $disc = $edit_value->ivt_purchase_disc;
            $freight = $edit_value->ivt_purchase_freight;
            $pking = $edit_value->ivt_purchase_pking;
            $netamount = $edit_value->ivt_purchase_netamount;
            $Tqty = $edit_value->ivt_purchase_Tqty;
            $Tdisc = $edit_value->ivt_purchase_Tdisc;
            $taxable = $edit_value->ivt_purchase_taxable;
            $cgst = $edit_value->ivt_purchase_cgst;
            $sgst = $edit_value->ivt_purchase_sgst;
            $cess = $edit_value->ivt_purchase_cess;
        } else {
            $id         = '';
            $mode         = '';
            $itype         = '';
            $company         = '';
            $account         = '';
            $godown         = '';
            $paymode         = '';
            $invno         = '';
            $invdate         = date('Y-m-d');
            $date       = date('Y-m-d');
            $cashacc  = '';
            $partyid  = '';
            $puridretn  = '';
            $puradvn  = '';
            $purbal  = '';
            $remark  = '';
            $nopkgs  = '';
            $vehical  = '';
            $billtyno  = '';
            $billtydate  = '';
            $waybill  = '';
            $waydate  = '';
            $nbremark  = '';
            $creditdays  = '';
            $Tamount  = 0;
            $disc  = 0;
            $freight  = 0;
            $pking  = 0;
            $netamount  = 0;
            $Tqty = '';
            $Tdisc = '';
            $taxable = '';
            $cgst = '';
            $sgst = '';
            $cess = '';
        } ?>

        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-add-purchase" enctype="mutipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="hidden" name="ivt_purchase_id" id="ivt_purchase_id" value="<?= $id; ?>">
                                            <input type="hidden" name="ivt_purchase_mode" id="ivt_purchase_mode" value="<?= $mode == $pagemode ? $mode : $pagemode; ?>">
                                            <select name="ivt_purchase_company" id="ivt_purchase_company" class="form-control select2">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Voucher No</label>
                                            <input type="text" name="ivt_purchase_no" id="ivt_purchase_no" class="form-control" required="" value="<?= $purchase_no; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" name="ivt_purchase_date" id="ivt_purchase_date" class="form-control" required="" value="<?= $date; ?>" readonly>

                                        </div>
                                    </div>
                                    <?php if ($pagemode == 2 || $pagemode == 3) { ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>INV Type</label>
                                                <input type="hidden" name="ivt_purchase_purid" id="ivt_purchase_purid" value="<?= $puridretn ?>">
                                                <select name="ivt_purchase_type" id="ivt_purchase_type" class="form-control select2">
                                                    <option value="WithIn State" <?php if ($itype == "WithIn State") {
                                                                                        echo 'selected';
                                                                                    } ?>>WithIn State</option>
                                                    <option value="Out of State" <?php if ($itype == "Out of State") {
                                                                                        echo 'selected';
                                                                                    } ?>>Out of State</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Godown</label>
                                                <select name="ivt_purchase_godown" id="ivt_purchase_godown" class="form-control select2">
                                                    <option value="">Select Godown</option>
                                                    <?php
                                                    if (!empty($godown_dtl)) {
                                                        foreach ($godown_dtl as $value) {
                                                            if ($godown == $value->m_godown_id) {
                                                                $option1 = "selected";
                                                            } else {
                                                                $option1 = "";
                                                            }
                                                    ?>
                                                        <option value="<?php echo $value->m_godown_id; ?>" <?= $option1 ?>><?php echo $value->m_godown_name ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pur Inv No</label>
                                                <input type="text" name="ivt_purchase_invno" id="ivt_purchase_invno" class="form-control" required="" value="<?= $invno; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pur Inv Date</label>
                                                <input type="date" name="ivt_purchase_invdate" id="ivt_purchase_invdate" class="form-control" required="" value="<?= $invdate; ?>">

                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <?php if ($pagemode == 2 || $pagemode == 3) { ?>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Supplier (Party)</label>
                                        <select name="ivt_purchase_partyid" id="ivt_purchase_partyid" class="form-control select2" required>
                                            <option value="">--select supplier--</option>
                                            <?php
                                            if (!empty($supplier_dl)) {
                                                foreach ($supplier_dl as $sskey) {
                                                    if ($partyid == $sskey->m_supplier_id) {
                                                        $op = 'selected';
                                                    } else {
                                                        $op = '';
                                                    }
                                            ?>
                                                    <option value="<?php echo $sskey->m_supplier_id; ?>" <?= $op ?>><?php echo $sskey->m_supplier_name . '-' . $sskey->m_supplier_mobile; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>


                            <?php } ?>

                            <div class="col-md-4" id="supppdetailblock">

                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-vsm btn-primary pull-right" onclick="addrow()">Add Row</button>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th width="1%">Sn</th>
                                        <th>Product name/code</th>
                                        <th>Size </th>
                                        <th>HSNCode</th>
                                        <th>Qty </th>
                                        <th>Unit </th>
                                        <?php if ($pagemode == 2 || $pagemode == 3) { ?>
                                            <th width="8%">PRate</th>
                                            <th width="6%">Dis%</th>
                                            <th width="8%">Taxable</th>
                                            <th>SGST</th>
                                            <th>CGST</th>
                                            <th>Cess</th>
                                            <th>NetAmt</th>
                                            <th>Amount</th>
                                        <?php } ?>
                                    </thead>
                                    <tbody id="tableblock">
                                        <?php if (!empty($edit_value)) {
                                            $coun = 0;
                                            foreach ($info_value as $key) {
                                                $coun++; ?>
                                                <tr>
                                                    <td id="rowcount<?= $coun ?>">
                                                        <?php if ($pagemode == 3 && !empty($eid)) {
                                                            echo '<input type="hidden" name="ivt_product_id[]" id="ivt_product_id'. $coun .'" value="">';
                                                        } else {
                                                            echo '<input type="hidden" name="ivt_product_id[]" id="ivt_product_id'. $coun .'" value="'. $key->ivt_product_id .'">';
                                                        } ?>
                                                        <?= $coun ?></td>

                                                    <td><input type="text" list="usersdtl<?= $coun ?>" placeholder="Enter Product Name" class="form-control purchase_product" data-count="<?= $coun ?>" value="<?= $key->m_product_name ?>" />
                                                        <input type="hidden" id="ivt_product_name<?= $coun ?>" name="ivt_product_name[]" value="<?= $key->ivt_product_name ?>">
                                                        <datalist id="usersdtl<?= $coun ?>">
                                                            <?php
                                                            if (!empty($products)) {
                                                                foreach ($products as $ukey) {
                                                            ?>
                                                                    <option value="<?php echo $ukey->m_product_name; ?>" data-unit="<?= $ukey->m_prodgroup_name ?>" data-hsncode="<?= $ukey->m_product_HSNcode ?>" data-rate="<?= $ukey->m_product_sale_rate ?>" data-prodid="<?= $ukey->m_product_id ?>"><?php echo $ukey->m_product_id . ' | ' . $ukey->m_product_code; ?>
                                                                    </option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </datalist>
                                                    </td>
                                                    <td><select id="ivt_product_size<?= $coun ?>" name="ivt_product_size[]" class="form-control">
                                                            <option value="">Select Size</option>
                                                            <?php
                                                            if (!empty($prodsize_dl)) {
                                                                foreach ($prodsize_dl as $val) {

                                                                    if ($key->ivt_product_size == $val->m_prodgroup_id) {
                                                                        $option1 = "selected";
                                                                    } else {
                                                                        $option1 = "";
                                                                    }

                                                            ?>
                                                                    <option value="<?php echo $val->m_prodgroup_id; ?>" <?= $option1 ?>><?php echo $val->m_prodgroup_name ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                        </select></td>
                                                    <td id="ivt_purchase_HSNcode<?= $coun ?>"></td>
                                                    <td><input type="number" id="ivt_product_qty<?= $coun ?>" name="ivt_product_qty[]" class="prodqty form-control" data-count="<?= $coun ?>" value="<?= $key->ivt_product_qty ?>"></td>
                                                    <td id="ivt_purchase_unit<?= $coun ?>"></td>
                                                    <?php if ($pagemode == 2 || $pagemode == 3) { ?>
                                                        <td><input type="number" id="ivt_product_rate<?= $coun ?>" name="ivt_product_rate[]" class="form-control prodrate" data-count="<?= $coun ?>" value="<?= $key->ivt_product_rate ?>"></td>
                                                        <td><input type="number" id="ivt_product_disc<?= $coun ?>" name="ivt_product_disc[]" class="form-control proddisc" data-count="<?= $coun ?>" value="<?= $key->ivt_product_disc ?>"></td>
                                                        <td><input type="number" id="ivt_product_taxable<?= $coun ?>" name="ivt_product_taxable[]" class="form-control protaxable" data-count="<?= $coun ?>" value="<?= $key->ivt_product_taxable ?>"></td>
                                                        <td id="ivt_purchase_sgst<?= $coun ?>"></td>
                                                        <td id="ivt_purchase_cgst<?= $coun ?>"></td>
                                                        <td id="ivt_purchase_cess<?= $coun ?>"></td>
                                                        <td><input type="number" id="ivt_product_netrate<?= $coun ?>" name="ivt_product_netrate[]" class="form-control" value="<?= $key->ivt_product_netrate ?>"></td>
                                                        <td><input type="number" id="ivt_product_amount<?= $coun ?>" name="ivt_product_amount[]" class="form-control totalt" readonly value="<?= $key->ivt_product_amount ?>"></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php }
                                        } else if (!empty($reques_items)) {
                                            foreach ($reques_items as $cau => $key) { ?>
                                                <tr>
                                                    <td id="rowcount<?= $cau ?>"><input type="hidden" name="ivt_product_id[]" id="ivt_product_id<?= $cau ?>"> <?= ($cau + 1) ?></td>

                                                    <td><input type="text" list="usersdtl<?= $cau ?>" placeholder="Enter Product Name" class="form-control purchase_product" data-count="<?= $cau ?>" value="<?= $key->m_product_name ?>" />
                                                        <input type="hidden" id="ivt_product_name<?= $cau ?>" name="ivt_product_name[]" value="<?= $key->m_reqmt_item ?>">
                                                        <input type="hidden" id="request_id<?= $cau ?>" name="request_id[]" value="<?= $key->m_reqmt_id ?>">
                                                        <datalist id="usersdtl<?= $cau ?>">
                                                            <?php
                                                            if (!empty($products)) {
                                                                foreach ($products as $ukey) {
                                                            ?>
                                                                    <option value="<?php echo $ukey->m_product_name; ?>" data-unit="<?= $ukey->m_prodgroup_name ?>" data-hsncode="<?= $ukey->m_product_HSNcode ?>" data-rate="<?= $ukey->m_product_sale_rate ?>" data-prodid="<?= $ukey->m_product_id ?>"><?php echo $ukey->m_product_id . ' | ' . $ukey->m_product_code; ?>
                                                                    </option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </datalist>
                                                    </td>
                                                    <td><select id="ivt_product_size<?= $cau ?>" name="ivt_product_size[]" class="form-control">
                                                            <option value="">Select Size</option>
                                                            <?php
                                                            if (!empty($prodsize_dl)) {
                                                                foreach ($prodsize_dl as $val) {

                                                                    if ($key->m_reqmt_size == $val->m_prodgroup_id) {
                                                                        $option = "selected";
                                                                    } else {
                                                                        $option = "";
                                                                    }

                                                            ?>
                                                                    <option value="<?php echo $val->m_prodgroup_id; ?>" <?= $option ?>><?php echo $val->m_prodgroup_name ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                        </select></td>
                                                    <td id="ivt_purchase_HSNcode<?= $cau ?>"></td>
                                                    <td><input type="number" id="ivt_product_qty<?= $cau ?>" name="ivt_product_qty[]" class="prodqty form-control" data-count="<?= $cau ?>" value="<?= $key->tqty ?>"></td>
                                                    <td id="ivt_purchase_unit<?= $cau ?>"><?= $key->product_unit ?></td>
                                                    <?php if ($pagemode == 2 || $pagemode == 3) { ?>
                                                        <td><input type="number" id="ivt_product_rate<?= $cau ?>" name="ivt_product_rate[]" class="form-control prodrate" data-count="<?= $cau ?>"></td>
                                                        <td><input type="number" id="ivt_product_disc<?= $cau ?>" name="ivt_product_disc[]" class="form-control proddisc" data-count="<?= $cau ?>" value="0"></td>
                                                        <td><input type="number" id="ivt_product_taxable<?= $cau ?>" name="ivt_product_taxable[]" class="form-control protaxable" data-count="<?= $cau ?>" value="0"></td>
                                                        <td id="ivt_purchase_sgst<?= $cau ?>"></td>
                                                        <td id="ivt_purchase_cgst<?= $cau ?>"></td>
                                                        <td id="ivt_purchase_cess<?= $cau ?>"></td>
                                                        <td id="ivt_product_netrate<?= $cau ?>"><input type="hidden" name="ivt_product_netrate[]" class="form-control"></td>
                                                        <td><input type="number" id="ivt_product_amount<?= $cau ?>" name="ivt_product_amount[]" class="form-control totalt" readonly></td>
                                                    <?php } ?>
                                                </tr>

                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td id="rowcount1"><input type="hidden" name="ivt_product_id[]" id="ivt_product_id1"> 1</td>

                                                <td><input type="text" list="usersdtl1" placeholder="Enter Product Name" class="form-control purchase_product" data-count="1" value="" />
                                                    <input type="hidden" id="ivt_product_name1" name="ivt_product_name[]">
                                                    <datalist id="usersdtl1">
                                                        <?php
                                                        foreach ($products as $ukey) {
                                                        ?>
                                                            <option value="<?php echo $ukey->m_product_name; ?>" data-unit="<?= $ukey->m_prodgroup_name ?>" data-hsncode="<?= $ukey->m_product_HSNcode ?>" data-rate="<?= $ukey->m_product_sale_rate ?>" data-prodid="<?= $ukey->m_product_id ?>"><?php echo $ukey->m_product_id . ' | ' . $ukey->m_product_code; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </datalist>
                                                </td>
                                                <td><select id="ivt_product_size1" name="ivt_product_size[]" class="form-control">
                                                        <option value="">Select Size</option>
                                                        <?php
                                                        foreach ($prodsize_dl as $val) {

                                                            // if ($godown == $value->m_prodgroup_id) {
                                                            //     $option1 = "selected";
                                                            // } else {
                                                            //     $option1 = "";
                                                            // }

                                                        ?>
                                                            <option value="<?php echo $val->m_prodgroup_id; ?>"><?php echo $val->m_prodgroup_name ?></option>
                                                        <?php
                                                        }

                                                        ?>

                                                    </select></td>
                                                <td id="ivt_purchase_HSNcode1"></td>
                                                <td><input type="number" id="ivt_product_qty1" name="ivt_product_qty[]" class="prodqty form-control" data-count="1"></td>
                                                <td id="ivt_purchase_unit1"></td>
                                                <?php if ($pagemode == 2 || $pagemode == 3) { ?>
                                                    <td><input type="number" id="ivt_product_rate1" name="ivt_product_rate[]" class="form-control prodrate" data-count="1"></td>
                                                    <td><input type="number" id="ivt_product_disc1" name="ivt_product_disc[]" class="form-control proddisc" data-count="1" value="0"></td>
                                                    <td><input type="number" id="ivt_product_taxable1" name="ivt_product_taxable[]" class="form-control protaxable" data-count="1" value="0"></td>
                                                    <td id="ivt_purchase_sgst1"></td>
                                                    <td id="ivt_purchase_cgst1"></td>
                                                    <td id="ivt_purchase_cess1"></td>
                                                    <td id="ivt_product_netrate1"><input type="hidden" name="ivt_product_netrate[]" class="form-control"></td>
                                                    <td><input type="number" id="ivt_product_amount1" name="ivt_product_amount[]" class="form-control totalt" readonly></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <?php if ($pagemode == 2 || $pagemode == 3) { ?>
                            <div class="row">

                                <div class="col-md-3">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th>Description</th>
                                            <th>Value</th>
                                        </tr>
                                        <tr>
                                            <th>Total Qty</th>
                                            <td><input type="text" name="ivt_purchase_Tqty" id="ivt_purchase_Tqty" readonly value="<?= $Tqty ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>Total Disc</th>
                                            <td><input type="text" name="ivt_purchase_Tdisc" id="ivt_purchase_Tdisc" readonly value="<?= $Tdisc ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>Taxable Value</th>
                                            <td><input type="text" name="ivt_purchase_taxable" id="ivt_purchase_taxable" readonly value="<?= $taxable ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>CGST</th>
                                            <td><input type="text" name="ivt_purchase_cgst" id="ivt_purchase_cgst" readonly value="<?= $cgst ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>SGST</th>
                                            <td><input type="text" name="ivt_purchase_sgst" id="ivt_purchase_sgst" readonly value="<?= $sgst ?>"></td>
                                        </tr>

                                        <tr>
                                            <th>Cess</th>
                                            <td><input type="text" name="ivt_purchase_cess" id="ivt_purchase_cess" readonly value="<?= $cess ?>"></td>
                                        </tr>
                                    </table>

                                </div>

                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Remark</label>
                                                <input type="text" name="ivt_purchase_remark" id="ivt_purchase_remark" class="form-control" value="<?= $remark; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No. of Pkgs</label>
                                                <input type="number" name="ivt_purchase_nopkgs" id="ivt_purchase_nopkgs" class="form-control" value="<?= $nopkgs; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Vehical No.</label>
                                                <input type="text" name="ivt_purchase_vehical" id="ivt_purchase_vehical" class="form-control" value="<?= $vehical; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bilty No.</label>
                                                <input type="text" name="ivt_purchase_billtyno" id="ivt_purchase_billtyno" class="form-control" value="<?= $billtyno; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bilty Date</label>
                                                <input type="date" name="ivt_purchase_billtydate" id="ivt_purchase_billtydate" class="form-control" value="<?= $billtydate; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Way Bil No.</label>
                                                <input type="text" name="ivt_purchase_waybill" id="ivt_purchase_waybill" class="form-control" value="<?= $waybill; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Way Bil Date</label>
                                                <input type="date" name="ivt_purchase_waydate" id="ivt_purchase_waydate" class="form-control" value="<?= $waydate; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>NP Remark</label>
                                                <input type="text" name="ivt_purchase_nbremark" id="ivt_purchase_nbremark" class="form-control" value="<?= $nbremark; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Credit Day</label>
                                                <input type="number" name="ivt_purchase_creditdays" id="ivt_purchase_creditdays" class="form-control" value="<?= $creditdays; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Cash Lgr</label>
                                                <select name="ivt_purchase_cashacc" id="ivt_purchase_cashacc" class="form-control select2">
                                                    <?php
                                                    if (!empty($cashcot_dtl)) {
                                                        foreach ($cashcot_dtl as $cckey) {
                                                            if ($cashacc == $cckey->m_cashacc_id) {
                                                                $op = 'selected';
                                                            } else {
                                                                $op = '';
                                                            }
                                                    ?>
                                                            <option value="<?php echo $cckey->m_cashacc_id; ?>" <?= $op ?>><?php echo $cckey->m_cashacc_name; ?>
                                                            </option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pay Mode</label>
                                                <select name="ivt_purchase_paymode" id="ivt_purchase_paymode" class="form-control select2">
                                                    <option value="Cash" <?php if ($paymode == "Cash") {
                                                                                echo 'selected';
                                                                            } ?>>Cash</option>
                                                    <option value="Credit" <?php if ($paymode == "Credit") {
                                                                                echo 'selected';
                                                                            } ?>>Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total Amount</label>
                                                <input type="number" name="ivt_purchase_Tamount" id="ivt_purchase_Tamount" class="form-control caltotal" readonly value="<?= $Tamount; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <input type="number" name="ivt_purchase_disc" id="ivt_purchase_disc" class="form-control caltotal" readonly value="<?= $disc; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Freight</label>
                                                <input type="number" name="ivt_purchase_freight" id="ivt_purchase_freight" class="form-control caltotal" value="<?= $freight; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pking</label>
                                                <input type="number" name="ivt_purchase_pking" id="ivt_purchase_pking" class="form-control caltotal" value="<?= $pking; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Roundup</label>
                                                <input type="number" name="ivt_purchase_roundoff" id="ivt_purchase_roundoff" class="form-control" readonly value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>NetAmount</label>
                                                <input type="number" name="ivt_purchase_netamount" id="ivt_purchase_netamount" class="form-control" readonly value="<?= $netamount; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Advance Paid</label>
                                                <input type="text" name="ivt_purchase_advance" id="ivt_purchase_advance" class="form-control" placeholder="Enter Advance" value="<?= $puradvn ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Balance Amount</label>
                                                <input type="text" name="ivt_purchase_balance" id="ivt_purchase_balance" class="form-control" value="<?= $purbal ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-purchase" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <a href="<?php echo site_url($pagelink); ?>" class="btn btn-block btn-danger">Cancel</a>
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

    function addrow() {
        x++;
        $('#tableblock').append(` <tr>
                                                <td id="rowcount` + x + `"><input type="hidden" name="ivt_product_id[]" id="ivt_product_id` + x + `"> ` + x + `</td>

                                                <td><input type="text" list="usersdtl` + x + `" placeholder="Enter Product Name" class="form-control purchase_product" data-count="` + x + `" value="" />
                                                    <input type="hidden" id="ivt_product_name` + x + `" name="ivt_product_name[]">
                                                    <datalist id="usersdtl` + x + `">
                                                        <?php
                                                        if (!empty($products)) {
                                                            foreach ($products as $ukey) {
                                                        ?>
                                                            <option value="<?php echo $ukey->m_product_name; ?>" data-unit="<?= $ukey->m_prodgroup_name ?>" data-hsncode="<?= $ukey->m_product_HSNcode ?>" data-rate="<?= $ukey->m_product_sale_rate ?>" data-prodid="<?= $ukey->m_product_id ?>"><?php echo $ukey->m_product_id . ' | ' . $ukey->m_product_code; ?>
                                                            </option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </datalist>
                                                </td>
                                                <td><select id="ivt_product_size` + x + `" name="ivt_product_size[]" class="form-control">
                                                        <option value="">Select Size</option>
                                                        <?php
                                                        if (!empty($prodsize_dl)) {
                                                            foreach ($prodsize_dl as $val) {

                                                        ?>
                                                            <option value="<?php echo $val->m_prodgroup_id; ?>"><?php echo $val->m_prodgroup_name ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    </select></td>
                                                <td id="ivt_purchase_HSNcode` + x + `"></td>
                                                <td><input type="number" id="ivt_product_qty` + x + `" name="ivt_product_qty[]" class="prodqty form-control" data-count="` + x + `"></td>
                                                <td id="ivt_purchase_unit` + x + `"></td>
                                                <?php if ($pagemode == 2 || $pagemode == 3) { ?>
                                                <td><input type="number" id="ivt_product_rate` + x + `" name="ivt_product_rate[]" class="form-control prodrate" data-count="` + x + `"></td>
                                                <td><input type="number" id="ivt_product_disc` + x + `" name="ivt_product_disc[]" class="form-control proddisc" data-count="` + x + `" value="0"></td>
                                                <td><input type="number" id="ivt_product_taxable` + x + `" name="ivt_product_taxable[]" class="form-control protaxable" data-count="` + x + `" value="0"></td>
                                                <td id="ivt_purchase_sgst` + x + `"></td>
                                                <td id="ivt_purchase_cgst` + x + `"></td>
                                                <td id="ivt_purchase_cess` + x + `"></td>
                                                <td><input type="number" id="ivt_product_netrate` + x + `" name="ivt_product_netrate[]" class="form-control" readonly></td>
                                                <td><input type="number" id="ivt_product_amount` + x + `" name="ivt_product_amount[]" class="form-control totalt" readonly></td>
                                                <?php } ?>

                                            </tr>`);
    }
    $(document).ready(function(e) {
        calculate_totals();
        $(document).on("change", '.purchase_product', function() {
            // alert('working');
            var count = $(this).data('count');
            var unit = $("#usersdtl" + count + " option[value='" + $(this).val() + "']").attr('data-unit')
            var hsncode = $("#usersdtl" + count + " option[value='" + $(this).val() + "']").attr('data-hsncode')
            var rate = $("#usersdtl" + count + " option[value='" + $(this).val() + "']").attr('data-rate')
            var prodid = $("#usersdtl" + count + " option[value='" + $(this).val() + "']").attr('data-prodid')
            //   alert(count+'-'+unit);
            $('#ivt_purchase_unit' + count).text(unit);
            $('#ivt_product_rate' + count).val(rate);
            $('#ivt_product_name' + count).val(prodid);
            $('#ivt_purchase_HSNcode' + count).html(hsncode);
            //   $('#purchase_prodrate'+count).text(rate);
            //   $('#purchase_unit'+count).text(unit);
            //   $('#prodqty').val(custID);
        });

        $(document).on("keyup", '.prodqty', function() {
            var count = $(this).data('count');
            var qty = $(this).val();
            var rate = $('#ivt_product_rate' + count).val();

            var amount = (qty * rate);

            $('#ivt_product_netrate' + count).val(amount);
            $('#ivt_product_amount' + count).val(amount);
            calculate_totals();

        });

        $(document).on("keyup", '.proddisc', function() {
            var count = $(this).data('count');
            var disc = $(this).val();
            var qty = $('#ivt_product_qty' + count).val();
            var rate = $('#ivt_product_rate' + count).val();

            var amount = (qty * rate) - disc;

            $('#ivt_product_netrate' + count).val(amount);
            $('#ivt_product_amount' + count).val(amount);
            calculate_totals()

        });

        $(document).on("keyup", '.protaxable', function() {
            var count = $(this).data('count');
            var taxable = $(this).val();
            var disc = $('#ivt_product_disc' + count).val();
            var qty = $('#ivt_product_qty' + count).val();
            var rate = $('#ivt_product_rate' + count).val();

            var amount = ((qty * rate) - disc) + parseFloat(taxable);

            $('#ivt_product_netrate' + count).val(amount);
            $('#ivt_product_amount' + count).val(amount);
            calculate_totals();

        });

        $(document).on("change", '.prodrate', function() {
            var count = $(this).data('count');
            qty = $('#ivt_product_qty' + count).val();
            rate = $(this).val();

            var amount = (qty * rate);
            $('#ivt_product_netrate' + count).val(amount);
            $('#ivt_product_amount' + count).val(amount);
            calculate_totals();


        });

        $(document).on("change", '.caltotal', function() {

            calculate_totals();
        });

    });

    function calculate_totals() {
        var Ttaxable = 0;
        var Tdisc = 0;
        var Tamount = 0;
        var Tqty = 0;
        $('.prodqty').each(function(index) {
            Tqty += parseInt($(this).val());

        });

        $('.totalt').each(function(index) {
            Tamount += parseFloat($(this).val());
        });
        $('.proddisc').each(function(index) {
            Tdisc += parseFloat($(this).val());

        });

        $('.protaxable').each(function(index) {
            Ttaxable += parseFloat($(this).val());

        });

        $('#ivt_purchase_taxable').val(Ttaxable);
        $('#ivt_purchase_Tdisc').val(Tdisc);
        $('#ivt_purchase_disc').val(Tdisc);
        $('#ivt_purchase_Tamount').val(Tamount);
        $('#ivt_purchase_Tqty').val(Tqty);

        var Tamount = $('#ivt_purchase_Tamount').val();
        var disc = $('#ivt_purchase_disc').val();
        var freight = $('#ivt_purchase_freight').val();
        var pking = $('#ivt_purchase_pking').val();

        var nettotal = (parseFloat(Tamount) + parseFloat(freight) + parseFloat(pking) - parseFloat(disc));
        // alert(nettotal)
        $('#ivt_purchase_roundoff').val(Math.round(nettotal));
        $('#ivt_purchase_netamount').val(nettotal);

    }
</script>