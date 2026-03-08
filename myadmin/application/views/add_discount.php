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

                        <a href="<?php echo site_url('Vouchers/discount_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> <?= 'All discounts' ?></a>
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
            $code         = $edit_value['discount_code'];
            $discount_name    = $edit_value['discount_name'];
            $start_date       = $edit_value['start_date'];
            $end_date     = $edit_value['end_date'];
            $discount_status   = $edit_value['discount_status'];
            $discount_ranges   = $edit_value['discount_ranges'];
        } else {
            $code         = '';
            $discount_name    = '';
            $start_date       = '';
            $end_date     = '';
            $discount_status   = '';
            $discount_ranges   = [];
        } ?>


        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form id="frm-add-discount" method="post">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Discount Name</label>
                                    <input type="hidden" name="discount_code" class="form-control" value="<?php echo $code; ?>">
                                    <input type="text" name="discount_name" class="form-control" required placeholder="Enter discount name" value="<?php echo $discount_name; ?>">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date" class="form-control" value="<?php echo $start_date; ?>">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" name="end_date" class="form-control" value="<?php echo $end_date; ?>">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="discount_status" class="form-control">
                                        <option value="1" <?php echo $discount_status == 1 ? 'selected' : ''; ?>>Active</option>
                                        <option value="0" <?php echo $discount_status == 0 ? 'selected' : ''; ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12" style="margin-top: 8px;">
                                <h4>Discount Rules</h4>
                                <div id="rules">
                                    <?php if (!empty($discount_ranges)) {
                                        foreach ($discount_ranges as $range) { ?>
                                            <div class="row rule">
                                                <div class="col-lg-3">
                                                    <label>Min Pack</label>
                                                    <input type="hidden" name="discount_id[]" value="<?php echo $range['discount_id']; ?>">
                                                    <input type="number" name="min_pack[]" class="form-control" required value="<?php echo $range['min_pack']; ?>">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Max Pack</label>
                                                    <input type="number" name="max_pack[]" class="form-control" value="<?php echo $range['max_pack']; ?>">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Percent</label>
                                                    <input type="number" step="0.01" name="discount_percent[]" class="form-control" required value="<?php echo $range['discount_percent']; ?>">
                                                </div>
                                                <div class="col-lg-1">
                                                    <button type="button" class="btn btn-danger remove-rule" style="margin-top: 30px;">Remove</button>
                                                </div>
                                            </div>
                                        <?php }
                                    } else { ?>

                                        <div class="row rule">
                                            <div class="col-lg-3">
                                                <label>Min Pack</label>
                                                <input type="hidden" name="discount_id[]">
                                                <input type="number" name="min_pack[]" class="form-control" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Max Pack</label>
                                                <input type="number" name="max_pack[]" class="form-control">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Percent</label>
                                                <input type="number" step="0.01" name="discount_percent[]" class="form-control" required>
                                            </div>
                                            <div class="col-lg-1">
                                                <button type="button" class="btn btn-danger remove-rule" style="margin-top: 30px;">Remove</button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-12" style="margin-top: 16px;">
                                <button type="button" id="add-rule" class="btn btn-info">Add Rule</button>
                                <button type="submit" id="btn-add-discount" class="btn btn-primary">Save Discount</button>
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
$this->view('js/js_setup'); ?>

<script>
    $(document).ready(function() {
        $('#add-rule').click(function() {
            var rule = $('.rule').first().clone();
            rule.find('input').val('');
            $('#rules').append(rule);
        });
        $(document).on('click', '.remove-rule', function() {
            if ($('.rule').length > 1) {
                $(this).closest('.rule').remove();
            }
        });
    });
</script>