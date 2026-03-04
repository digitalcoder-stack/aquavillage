<script type="text/javascript">
    $(document).ready(function(e) {
        $('.filterbtn').on('click', function(e) {
            var fdate = $('#from_date').val();
            var tdate = $('#to_date').val();
            var oval = $(this).data('value');
            // alert(oval);
            window.location.href = "<?= base_url('Reports/ticket_report?from_date=') ?>" + fdate + '&to_date=' + tdate + oval;

        })
        
        $('.dateinf').on('change', function(e) {
            var fdate = $('#from_date').val();
            var tdate = $('#to_date').val();
            var oval = $('#filterbtns').find(".btn-success").data('value');
            // alert(oval);
            window.location.href = "<?= base_url('Reports/ticket_report?from_date=') ?>" + fdate + '&to_date=' + tdate + oval;
            
        })

        // $('.stckfiltbtn').on('click', function(e) {
        //     var fdate = $('#from_date').val();
        //     var tdate = $('#to_date').val();
        //     var godown = $('#godown').val();
        //     var prod = $('#prod').val();
        //     var oval = $(this).data('value');
        //     // alert(oval);
        //     window.location.href = "<?= base_url('Reports/stock_report?from_date=') ?>" + fdate + '&to_date=' + tdate+ '&godown=' + godown+ '&prod=' + prod + oval;

        // })

        // $('.stkinpfilt').on('change', function(e) {
        //     var fdate = $('#from_date').val();
        //     var tdate = $('#to_date').val();
        //     var godown = $('#godown').val();
        //     var prod = $('#prod').val();
        //     var oval = $('#stckfiltbtns').find(".btn-success").data('value');
        //     // alert(oval);
        //     window.location.href = "<?= base_url('Reports/stock_report?from_date=') ?>" + fdate + '&to_date=' + tdate+ '&godown=' + godown+ '&prod=' + prod + oval;

        // })
    });
</script>