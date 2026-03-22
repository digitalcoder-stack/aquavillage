<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id');
$logged_user_type = $this->session->userdata('user_type');
?>
<div class="page-content">
    <div class="container-fluid">
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

            .btn-vsm {
                position: relative;
            }

            .btn-vsm span {
                border-radius: 50%;
                background-color: red;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: -5px;
                right: -5px;
                line-height: 10px;
                font-size: 10px;
                width: 15px;
                height: 15px;
            }
            .total-row td {
                font-weight: bold;
            }
        </style>

        <div class="row">

            <div class="col-md-12">
                <div class="page-box">
                    <div class="seipkon-breadcromb-left">
                        <h3><?= $pagename; ?></h3>
                        <hr style="margin-top: 0px; border-top: 2px solid #dee2e6;">
                    </div>

                    <div class="advance-table table-overflow">

                        <form method="post" action="<?= base_url('Reports/ticket_comparison_report') ?>" class="mb-3">
                            <div class="row">
                                <div class="col-md-2 col-sm-6 col-xs-12">
                                    <label class="form-check-label">Period 1</label>
                                    <input class="form-control" style="width: 100%;" type="month" name="first_period" id="first_period" value="<?php echo $first_period; ?>">
                                </div>
                                <div class="col-md-2 col-sm-6 col-xs-12">
                                    <label class="form-check-label">Period 2</label>
                                    <input class="form-control" style="width: 100%;" type="month" name="second_period" id="second_period" value="<?php echo $second_period; ?>">
                                </div>
                                <div class="col-md-1 col-sm-4 col-xs-6" style="margin-top: 25px;">
                                    <button type="submit" class="btn btn-primary">Compare</button>
                                </div>
                                <div class="col-md-1 col-sm-4 col-xs-6" style="margin-top: 25px;">
                                    <input type="checkbox" name="show_detail" id="show_detail" value="1">
                                    <label for="show_detail">Show Detail</label>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label class="form-check-label">Search</label>
                                    <input type="text" id="search" class="form-control" placeholder="Search by date or day" style="width: 100%; max-width: 300px;">
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                        <table class="table table-bordered" id="report-table">

                            <thead>

                                <tr>
                                    <th rowspan="2">Sno</th>
                                    <th rowspan="2">Date</th>
                                    <th rowspan="2">Day</th>

                                    <th class="thperiod" colspan="1" style="text-align: center;">Period <?= date('Y F', strtotime($first_period)) ?></th>
                                    <th class="thperiod" colspan="1" style="text-align: center;">Period <?= date('Y F', strtotime($second_period)) ?></th>
                                    <th rowspan="2">Difference</th>


                                </tr>

                                <tr>
                                    <th class="detail-col">Family</th>
                                    <th class="detail-col">Stag</th>
                                    <th class="detail-col">Free</th>
                                    <th>Total Packs</th>
                                    <th class="detail-col">Revenue</th>
                                    <th class="detail-col">Family</th>
                                    <th class="detail-col">Stag</th>
                                    <th class="detail-col">Free</th>
                                    <th>Total Packs</th>
                                    <th class="detail-col">Revenue</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach ($report as $cr => $r) { ?>

                                    <tr>
                                        <td><?= ($cr + 1) ?></td>
                                        <td><?php echo date('d M Y', strtotime($r['date1'])); ?></td>
                                        <td><?php echo $r['day']; ?></td>

                                        <td class="detail-col"><?php echo $r['adult1']; ?></td>
                                        <td class="detail-col"><?php echo $r['child1']; ?></td>
                                        <td class="detail-col"><?php echo $r['free1']; ?></td>
                                        <td><?php echo $r['person1']; ?></td>
                                        <td class="detail-col">₹<?php echo number_format($r['revenue1']); ?></td>

                                        <td class="detail-col"><?php echo $r['adult2']; ?></td>
                                        <td class="detail-col"><?php echo $r['child2']; ?></td>
                                        <td class="detail-col"><?php echo $r['free2']; ?></td>
                                        <td><?php echo $r['person2']; ?></td>
                                        <td class="detail-col">₹<?php echo number_format($r['revenue2']); ?></td>
                                        <td><?php echo ($r['person1'] - $r['person2']); ?></td>

                                    </tr>

                                <?php } ?>

                            </tbody>

                            <tfoot>
                                <tr id="total-row">
                                    <td colspan="3"><b>Total</b></td>

                                    <td class="detail-col">0</td>
                                    <td class="detail-col">0</td>
                                    <td class="detail-col">0</td>
                                    <td>0</td>
                                    <td class="detail-col">₹0</td>

                                    <td class="detail-col">0</td>
                                    <td class="detail-col">0</td>
                                    <td class="detail-col">0</td>
                                    <td>0</td>
                                    <td class="detail-col">₹0</td>

                                    <td>0</td>

                                </tr>
                            </tfoot>

                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<script>
    $(document).ready(function() {
        // Toggle detail columns
        $('#show_detail').change(function() {
            if ($(this).is(':checked')) {
                $('.detail-col').show();
                $('.thperiod').attr('colspan', 5);
            } else {
                $('.thperiod').attr('colspan', 1);
                $('.detail-col').hide();
            }
        });
        // Initially hide if not checked
        if (!$('#show_detail').is(':checked')) {
            $('.detail-col').hide();
        }
        // Search functionality
        $('#search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#report-table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            calculateTotals();
        });
        // Function to calculate totals
        function calculateTotals() {

            var adult1 = 0,
                child1 = 0,
                free1 = 0,
                total1 = 0,
                rev1 = 0;
            var adult2 = 0,
                child2 = 0,
                free2 = 0,
                total2 = 0,
                rev2 = 0,
                diff = 0;

            $('#report-table tbody tr:visible').each(function() {

                adult1 += parseInt($(this).find('td').eq(3).text()) || 0;
                child1 += parseInt($(this).find('td').eq(4).text()) || 0;
                free1 += parseInt($(this).find('td').eq(5).text()) || 0;
                total1 += parseInt($(this).find('td').eq(6).text()) || 0;

                rev1 += parseFloat($(this).find('td').eq(7).text().replace('₹', '').replace(/,/g, '')) || 0;

                adult2 += parseInt($(this).find('td').eq(8).text()) || 0;
                child2 += parseInt($(this).find('td').eq(9).text()) || 0;
                free2 += parseInt($(this).find('td').eq(10).text()) || 0;
                total2 += parseInt($(this).find('td').eq(11).text()) || 0;

                rev2 += parseFloat($(this).find('td').eq(12).text().replace('₹', '').replace(/,/g, '')) || 0;

                diff += parseInt($(this).find('td').eq(13).text()) || 0;

            });

            var cells = $('#total-row td');

            cells.eq(1).text(adult1);
            cells.eq(2).text(child1);
            cells.eq(3).text(free1);
            cells.eq(4).text(total1);
            cells.eq(5).text('₹' + rev1.toLocaleString());

            cells.eq(6).text(adult2);
            cells.eq(7).text(child2);
            cells.eq(8).text(free2);
            cells.eq(9).text(total2);
            cells.eq(10).text('₹' + rev2.toLocaleString());

            cells.eq(11).text(diff);

        }
        // Initial calculation
        calculateTotals();
    });
</script>
<?php $this->view('top_footer');
$this->view('js/custom_js'); ?>
<!-- =======================/Footer================Fix=======