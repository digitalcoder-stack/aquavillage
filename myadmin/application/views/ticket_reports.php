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

            /* ---- Loader ---- */
            #ticket_loader {
                display: none;
                text-align: center;
                padding: 30px 0;
            }
            #ticket_loader .spinner-border {
                width: 2.5rem;
                height: 2.5rem;
                border-width: 4px;
                color: #007bff;
            }
            /* ---- Pagination ---- */
            #ticket_pagination {
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
                justify-content: center;
                align-items: center;
            }
            #ticket_pagination .ticket-page-btn {
                margin: 2px;
            }
            /* ---- Filter buttons ---- */
            #filterbtns {
                display: flex;
                flex-direction: column;
                gap: 4px;
            }
            #filterbtns .filterbtn {
                width: 100%;
            }
        </style>

        <div class="row">

            <div class="col-md-9 col-sm-12">
                <div class="page-box">
                    <div class="seipkon-breadcromb-left">
                        <h3 id="ticket_report_heading">
                            <?php
                            switch ($fun) {
                                case 1: $mainhead = 'All Tickets';         $subhead = ''; break;
                                case 2: $mainhead = 'City Wise';           $subhead = ''; break;
                                case 3: $mainhead = 'Ticket Type Wise';    $subhead = ''; break;
                                case 4: $mainhead = 'Cash Counter Wise';   $subhead = ''; break;
                                case 5: $mainhead = 'Cash Ticket List';    $subhead = ''; break;
                                case 6: $mainhead = 'Members Ticket List'; $subhead = ''; break;
                                case 7: $mainhead = 'Credit Ticket List';  $subhead = ''; break;
                                case 8: $mainhead = 'Payment Method Wise'; $subhead = ''; break;
                                case 9: $mainhead = 'Band Wise';           $subhead = ''; break;
                                default: $mainhead = ''; $subhead = '';
                            }
                            echo $mainhead;
                            if (!empty($subhead)) echo ' - ' . $subhead;
                            ?>
                        </h3>
                        <hr style="margin-top: 0px; border-top: 2px solid #dee2e6;">
                    </div>

                    <!-- Loader -->
                    <div id="ticket_loader">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p style="margin-top:8px; color:#666;">Loading tickets…</p>
                    </div>

                    <div class="advance-table table-overflow" id="ticket_table_wrapper">

                        <!-- Summary table (type=1): City/Counter/Band/Paymode wise grouped view -->
                        <div id="ticket_summary_wrap" style="display:none;">
                            <table id="ticket_tbl" class="my_custom_datatable table table-striped table-bordered">
                                <thead id="ticket_summary_head">
                                    <tr>
                                        <th>Sno.</th>
                                        <th>Mode</th>
                                        <th>Total Family</th>
                                        <th>Total Stag</th>
                                        <th>Total Free</th>
                                        <th>Total Person</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="ticket_summary_tbody">
                                </tbody>
                                <tfoot id="ticket_summary_tfoot">
                                </tfoot>
                            </table>
                        </div>

                        <!-- Detail table (type=2): Per-ticket listing -->
                        <div id="ticket_detail_wrap" style="display:none;">
                            <table id="ticket_detail_tbl" class="my_custom_datatable table table-striped table-bordered">
                                <thead id="ticket_detail_head">
                                    <tr>
                                        <th>Sno.</th>
                                        <th>Dated</th>
                                        <th>Ticket No</th>
                                        <th>Mode</th>
                                        <th>CustomerName</th>
                                        <th>Family</th>
                                        <th>Stag</th>
                                        <th>Total</th>
                                        <th>City</th>
                                        <th>PlotNo</th>
                                        <th>PlotOwner</th>
                                        <th>NetAmount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="ticket_detail_tbody">
                                </tbody>
                                <tfoot id="ticket_detail_tfoot">
                                </tfoot>
                            </table>
                        </div>

                    </div>

                    <!-- Pagination -->
                    <div id="ticket_pagination" class="text-center" style="margin-top:10px;"></div>

                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <div class="page-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="seipkon-breadcromb-left">
                                <h3><?php echo $pagename; ?></h3>
                                <hr style="margin-top: 0px; border-top: 2px solid #dee2e6;">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-check-label">From Date</label>
                            <input class="form-control dateinf" style="width: 100%;" type="date" placeholder="From Date" name="from_date" id="from_date" value="<?php echo $from_date; ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-check-label">To Date</label>
                            <input class="form-control dateinf" style="width: 100%;" type="date" placeholder="To Date" name="to_date" id="to_date" value="<?php echo $to_date; ?>">
                        </div>
                        <div class="col-md-12" style="margin-top:5px;" id="filterbtns">
                            <button type="button" class="btn <?php echo ($fun == 1) ? 'btn-success' : 'btn-primary'; ?> btn-block filterbtn" data-value="&fun=1&type=2">All Tickets</button>
                            <button type="button" class="btn <?php echo ($fun == 2) ? 'btn-success' : 'btn-primary'; ?> btn-block filterbtn" data-value="&fun=2&type=1&filed=m_ticket_city">City wise</button>
                            <button type="button" class="btn <?php echo ($fun == 3) ? 'btn-success' : 'btn-primary'; ?> btn-block filterbtn" data-value="&fun=3&type=1&filed=m_ticket_head">Ticket Type wise</button>
                            <button type="button" class="btn <?php echo ($fun == 4) ? 'btn-success' : 'btn-primary'; ?> btn-block filterbtn" data-value="&fun=4&type=1&filed=m_ticket_counter">Counter wise</button>
                            <button type="button" class="btn <?php echo ($fun == 5) ? 'btn-success' : 'btn-primary'; ?> btn-block filterbtn" data-value="&fun=5&type=2&filed=m_ticket_paymode&fval=Cash">Cash Tickets</button>
                            <button type="button" class="btn <?php echo ($fun == 6) ? 'btn-success' : 'btn-primary'; ?> btn-block filterbtn" data-value="&fun=6&type=2&filed=m_ticket_paymode&fval=Members">Members Tickets</button>
                            <button type="button" class="btn <?php echo ($fun == 7) ? 'btn-success' : 'btn-primary'; ?> btn-block filterbtn" data-value="&fun=7&type=2&filed=m_ticket_paymode&fval=Credit">Credit Tickets</button>
                            <button type="button" class="btn <?php echo ($fun == 8) ? 'btn-success' : 'btn-primary'; ?> btn-block filterbtn" data-value="&fun=8&type=1&filed=m_ticket_paytype">Paymode wise</button>
                            <button type="button" class="btn <?php echo ($fun == 9) ? 'btn-success' : 'btn-primary'; ?> btn-block filterbtn" data-value="&fun=9&type=1">Band wise</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initial filter config (used by JS to fire the first fetch automatically) -->
<script>
var TICKET_INIT = {
    from_date : '<?= $from_date ?>',
    to_date   : '<?= $to_date ?>',
    fun       : <?= (int)$fun ?>,
    type      : <?= (int)$type ?>,
    filed     : '<?= addslashes($filed) ?>',
    fval      : '<?= addslashes($fval) ?>'
};
var TICKET_AJAX_URL = '<?= base_url("Reports/ticket_report_ajax") ?>';
</script>

<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/report_js');
$this->view('js/custom_js'); ?>
<!-- =======================/Footer================Fix=======