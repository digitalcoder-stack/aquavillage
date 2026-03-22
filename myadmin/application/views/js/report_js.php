<script type="text/javascript">
$(document).ready(function () {

    /* ============================================================
       State & guards
    ============================================================ */
    var activeFilters  = {};   // current filter params
    var ajaxInProgress = false; // duplicate-call guard

    /* ============================================================
       Core fetch function
       page    – 1-based page number
       filters – object with {from_date, to_date, fun, type, filed, fval}
    ============================================================ */
    function fetchTickets(page, filters) {

        if (ajaxInProgress) return;
        ajaxInProgress = true;

        // Show loader, hide both table wrappers and pagination
        $('#ticket_loader').show();
        $('#ticket_table_wrapper').hide();
        $('#ticket_pagination').hide();

        var params = {
            from_date : filters.from_date || '',
            to_date   : filters.to_date   || '',
            fun       : filters.fun       || 1,
            type      : filters.type      || 2,
            filed     : filters.filed     || '',
            fval      : filters.fval      || '',
            page      : page              || 1
        };

        $.ajax({
            url     : TICKET_AJAX_URL,
            method  : 'POST',
            data    : params,
            dataType: 'json',
            success : function (res) {
                if (res.status !== 'ok') {
                    showTableError('An error occurred. Please try again.');
                    return;
                }

                /* ---- Update page heading ---- */
                if (res.heading_data) {
                    var hd = res.heading_data;
                    var headingText = hd.mainhead;
                    if (hd.subhead) headingText += ' - ' + hd.subhead;
                    $('#ticket_report_heading').text(headingText);
                }

                /* ---- Show the correct table, hide the other ---- */
                if (res.type == 1) {
                    $('#ticket_summary_wrap').show();
                    $('#ticket_detail_wrap').hide();
                    // Inject into summary table
                    $('#ticket_summary_tbody').html(res.html);
                    $('#ticket_summary_tfoot').html(res.footer_html);
                } else {
                    $('#ticket_detail_wrap').show();
                    $('#ticket_summary_wrap').hide();
                    // Inject into detail table
                    $('#ticket_detail_tbody').html(res.html);
                    $('#ticket_detail_tfoot').html(res.footer_html);
                }

                /* ---- Build pagination ---- */
                buildPagination(res.total, res.per_page, res.page, filters);
            },
            error: function (xhr, status, err) {
                showTableError('Request failed. Please refresh and try again.');
                console.error('fetchTickets error:', status, err);
            },
            complete: function () {
                ajaxInProgress = false;
                $('#ticket_loader').hide();
                $('#ticket_table_wrapper').show();
                $('#ticket_pagination').show();
            }
        });
    }

    /* Show an error message in a visible table */
    function showTableError(msg) {
        var errRow = '<tr><td colspan="13" class="text-center text-danger">' + msg + '</td></tr>';
        $('#ticket_summary_wrap').show();
        $('#ticket_detail_wrap').hide();
        $('#ticket_summary_tbody').html(errRow);
        $('#ticket_summary_tfoot').html('');
    }

    /* ============================================================
       Pagination builder
    ============================================================ */
    function buildPagination(total, perPage, currentPage, filters) {
        var totalPages = Math.ceil(total / perPage);
        var $pg = $('#ticket_pagination').empty();

        if (totalPages <= 1) return;

        var html = '';

        // Previous button
        if (currentPage > 1) {
            html += '<button class="btn btn-sm btn-secondary ticket-page-btn" data-page="' + (currentPage - 1) + '">&laquo; Prev</button>';
        }

        // Windowed page number buttons (±3 around current)
        var startPage = Math.max(1, currentPage - 3);
        var endPage   = Math.min(totalPages, currentPage + 3);

        if (startPage > 1) {
            html += '<button class="btn btn-sm btn-outline-secondary ticket-page-btn" data-page="1">1</button>';
            if (startPage > 2) html += '<span class="btn btn-sm disabled">…</span>';
        }
        for (var p = startPage; p <= endPage; p++) {
            var cls = (p === currentPage) ? 'btn-primary' : 'btn-outline-primary';
            html += '<button class="btn btn-sm ' + cls + ' ticket-page-btn" data-page="' + p + '">' + p + '</button>';
        }
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) html += '<span class="btn btn-sm disabled">…</span>';
            html += '<button class="btn btn-sm btn-outline-secondary ticket-page-btn" data-page="' + totalPages + '">' + totalPages + '</button>';
        }

        // Next button
        if (currentPage < totalPages) {
            html += '<button class="btn btn-sm btn-secondary ticket-page-btn" data-page="' + (currentPage + 1) + '">Next &raquo;</button>';
        }

        html += '<small class="text-muted" style="display:block;margin-top:4px;">Page ' + currentPage + ' of ' + totalPages + ' &nbsp;|&nbsp; ' + total + ' total records</small>';

        $pg.html(html);

        // Delegated click — buttons are freshly injected each time
        $pg.off('click', '.ticket-page-btn').on('click', '.ticket-page-btn', function () {
            fetchTickets(parseInt($(this).data('page'), 10), activeFilters);
        });
    }

    /* ============================================================
       Parse filter button data-value string into an object
       Format: "&fun=1&type=2&filed=m_ticket_city&fval=Cash"
    ============================================================ */
    function parseDataValue(dataValue) {
        var result = {};
        (dataValue || '').replace(/^&/, '').split('&').forEach(function (pair) {
            var kv = pair.split('=');
            if (kv.length === 2) result[kv[0]] = decodeURIComponent(kv[1]);
        });
        return result;
    }

    /* ============================================================
       Update the active (green) filter button
    ============================================================ */
    function setActiveFilterBtn(fun) {
        $('#filterbtns .filterbtn').removeClass('btn-success').addClass('btn-primary');
        $('#filterbtns .filterbtn').each(function () {
            var parsed = parseDataValue($(this).data('value'));
            if (parseInt(parsed.fun, 10) === parseInt(fun, 10)) {
                $(this).removeClass('btn-primary').addClass('btn-success');
            }
        });
    }

    /* ============================================================
       Filter button — click
    ============================================================ */
    $(document).on('click', '.filterbtn', function () {
        var parsed = parseDataValue($(this).data('value'));
        activeFilters = {
            from_date : $('#from_date').val(),
            to_date   : $('#to_date').val(),
            fun       : parsed.fun   || 1,
            type      : parsed.type  || 2,
            filed     : parsed.filed || '',
            fval      : parsed.fval  || ''
        };
        setActiveFilterBtn(activeFilters.fun);
        fetchTickets(1, activeFilters);
    });

    /* ============================================================
       Date inputs — change event (fires once when user commits a date)
    ============================================================ */
    // $(document).on('change', '.dateinf', function () {
    //     activeFilters.from_date = $('#from_date').val();
    //     activeFilters.to_date   = $('#to_date').val();
    //     fetchTickets(1, activeFilters);
    // });

    /* ============================================================
       Initial load — use TICKET_INIT seeded by PHP
    ============================================================ */
    if (typeof TICKET_INIT !== 'undefined') {
        activeFilters = {
            from_date : TICKET_INIT.from_date,
            to_date   : TICKET_INIT.to_date,
            fun       : TICKET_INIT.fun,
            type      : TICKET_INIT.type,
            filed     : TICKET_INIT.filed,
            fval      : TICKET_INIT.fval
        };

        fetchTickets(1, activeFilters);
    }

});
</script>