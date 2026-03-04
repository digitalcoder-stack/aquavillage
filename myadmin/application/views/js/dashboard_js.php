<script>
  $(document).ready(function(e) {

    day_report_calculation()

    $('.calclas').on('keyup', function() {
      day_report_calculation();
    })

    $("#Dsum").click(function() {
      $('.nabtn').removeClass('active');
      $(this).addClass('active');
      $(".Dsum").css("display", "block");
      $(".Drsummery").css("display", "none");
      $(".Drdetail").css("display", "none");

    });
    $("#Drsummery").click(function() {
      $('.nabtn').removeClass('active');
      $(this).addClass('active');
      $(".Dsum").css("display", "none");
      $(".Drsummery").css("display", "block");
      $(".Drdetail").css("display", "none");

    });

    $("#Drdetail").click(function() {
      $('.nabtn').removeClass('active');
      $(this).addClass('active');
      $(".Dsum").css("display", "none");
      $(".Drsummery").css("display", "none");
      $(".Drdetail").css("display", "block");

    });

    $(document).on("keyup", '.calclas', function() {
            var sum = 0;
            $('.calclas').each(function() {
                var enter_amt = parseInt($(this).val());
                sum += enter_amt;
            });
            var total_buss = parseFloat($('#d_fc_cash').val());

            if (total_buss < sum) {
                swal('Amount should be equal or less then ' + total_buss, {
                    icon: "error",
                    timer: 5000,
                });
                $(this).val(0);
            }else {
                return true;
            }

        });


  });


  function printInvoice() {
    printDiv = ".print"; // id of the div you want to print
    $("*").addClass("no-print");
    $(printDiv + " *").removeClass("no-print");
    $(printDiv).removeClass("no-print");

    parent = $(printDiv).parent();
    while ($(parent).length) {
      $(parent).removeClass("no-print");
      parent = $(parent).parent();
    }
    window.print();

  }

  function day_report_calculation() {

    var ticket_paytm = parseFloat($('#ticket_paytm').val());
    var ticket_phonep = parseFloat($('#ticket_phonep').val());
    var ticket_other = parseFloat($('#ticket_other').val());
    var ticket_total = parseFloat($('#ticket_total').val());
    var ticket_voucher = parseFloat($('#ticket_voucher').val());
    var ticket_upi = parseFloat($('#ticket_upi').val());
    var ticket_discount = parseFloat($('#ticket_discount').val());
    var ticket_balance = parseFloat($('#ticket_balance').val());
    var ticket_cash = parseFloat($('#ticket_cash').val());
    var ticket_refund = parseFloat($('#ticket_refund').val());
    var costume_paytm = parseFloat($('#costume_paytm').val());
    var costume_phonep = parseFloat($('#costume_phonep').val());
    var costume_other = parseFloat($('#costume_other').val());
    var costume_voucher = parseFloat($('#costume_voucher').val());
    var costume_total = parseFloat($('#costume_total').val());
    var costume_upi = parseFloat($('#costume_upi').val());
    var costume_discount = parseFloat($('#costume_discount').val());
    var costume_balance = parseFloat($('#costume_balance').val());
    var costume_cash = parseFloat($('#costume_cash').val());
    var d_fc_total = parseFloat($('#d_fc_total').val());
    var d_fc_cash = parseFloat($('#d_fc_cash').val());
    var d_fc_paytm = parseFloat($('#d_fc_paytm').val());
    var d_fc_phonepay = parseFloat($('#d_fc_phonepay').val());
    var d_fc_discount = parseFloat($('#d_fc_discount').val());
    var d_fc_totupi = parseFloat($('#d_fc_totupi').val());
    var d_fc_balance = parseFloat($('#d_fc_balance').val());
    var d_rtc_cash = parseFloat($('#d_rtc_cash').val());
    var d_rtc_paytm = parseFloat($('#d_rtc_paytm').val());
    var d_rtc_phonepay = parseFloat($('#d_rtc_phonepay').val());
    var d_rtc_discount = parseFloat($('#d_rtc_discount').val());
    var d_rtc_balance = parseFloat($('#d_rtc_balance').val());

    var d_camp_cash = parseFloat($('#d_camp_cash').val());
    var d_camp_paytm = parseFloat($('#d_camp_paytm').val());
    var d_camp_phonepay = parseFloat($('#d_camp_phonepay').val());
    var d_camp_discount = parseFloat($('#d_camp_discount').val());
    var d_camp_balance = parseFloat($('#d_camp_balance').val());
    

    var tick_finalcash = ((ticket_total + ticket_voucher) - ticket_upi- ticket_discount - ticket_balance);
    var cos_finalcash = ((costume_total +costume_voucher) - costume_upi - costume_discount - costume_balance);
    var food_cash = (d_fc_total - d_fc_totupi- d_fc_discount - d_fc_balance);
    var report_cash = (d_rtc_cash - (d_rtc_paytm + d_rtc_phonepay) - d_rtc_balance);
    var camp_cash = (d_camp_cash - (d_camp_paytm + d_camp_phonepay) - d_camp_balance);
    var sum_upi = (ticket_upi + costume_upi + d_fc_paytm + d_fc_phonepay + d_camp_paytm + d_camp_phonepay + d_rtc_paytm + d_rtc_phonepay);
    var sum_discount = (ticket_discount + costume_discount + d_fc_discount + d_rtc_discount + d_camp_discount);
    var sum_dis = (d_fc_discount + d_rtc_discount + d_camp_discount);
    var sum_balance = (ticket_balance + costume_balance + d_fc_balance + d_rtc_balance + d_camp_balance);
    var sum_cash = (tick_finalcash + cos_finalcash + food_cash + report_cash + camp_cash);
    var sum_phonep = (ticket_phonep + costume_phonep + d_fc_phonepay + d_rtc_phonepay + d_camp_phonepay);
    var sum_paytm = (ticket_paytm + costume_paytm + d_fc_paytm + d_rtc_paytm + d_camp_paytm);
    var total_expense = sum_dis + sum_balance +ticket_refund + parseFloat($('#total_expense').val());
    var total_voucher = parseFloat($('#total_voucher').val());
    var sum_bussi_col = ((ticket_total + ticket_voucher) + costume_total + costume_voucher + d_fc_total + d_rtc_cash + d_camp_cash);
    var sum_bussi = (ticket_total + costume_total + d_fc_total + d_rtc_cash + d_camp_cash + total_voucher);
    var final_cash = (sum_bussi - sum_upi - total_expense);

    $('#sum_bussi').html('₹' + sum_bussi_col);
    $('.sum_total_bussi').html('₹' + sum_bussi);
    $('#sum_total_dis').html('₹' + sum_discount);
    $('.sum_total_blnc').html('₹' + sum_balance);
    $('#sum_total_cash').html('₹' + sum_cash);
    $('#sum_total_phonep').html('₹' + sum_phonep);
    $('#sum_total_paytm').html('₹' + sum_paytm);
    $('.sum_total_upi').html('₹' + sum_upi);
    $('#fc_fcash').html('₹' + food_cash);
    $('#tick_finalcash').html('₹' + tick_finalcash);
    $('#cos_finalcash').html('₹' + cos_finalcash);
    $('#rtc_fcash').html('₹' + report_cash);
    $('#camp_fcash').html('₹' + camp_cash);
    $('#sum_total_expense').html('₹' + total_expense);
    $('#final_cash').html('₹' + final_cash);

  }
</script>