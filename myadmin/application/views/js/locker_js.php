<script type="text/javascript">
  $(document).ready(function(e) {
    //============================shop============================//

    //============================shop============================//
    $("form#frm-lockerrefund").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-lockerrefund");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Shop/update_lockerrefund'); ?>",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function(data) {
          if (data.status == 'success') {
            swal(data.message, {
              icon: "success",
              timer: 500,
            });
            setTimeout(function() {
              location.reload();
            }, 100);
          } else {
            clkbtn.prop('disabled', false);
            swal(data.message, {
              icon: "error",
              timer: 5000,
            });
          }
        },
        error: function(jqXHR, status, err) {
          clkbtn.prop('disabled', false);
          swal("Some Problem Occurred!! please try again", {
            icon: "error",
            timer: 2000,
          });
        }
      });

    });


    $("form#frm-locker-create").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-locker-create");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Shop/insert_locker'); ?>",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function(data) {
          if (data.status == 'success') {
            swal(data.message, {
              icon: "success",
              timer: 500,
            });
            setTimeout(function() {
              window.location = "<?php echo site_url('Shop/locker_list/1'); ?>";
            }, 100);
          } else {
            clkbtn.prop('disabled', false);
            swal(data.message, {
              icon: "error",
              timer: 5000,
            });
          }
        },
        error: function(jqXHR, status, err) {
          clkbtn.prop('disabled', false);
          swal("Some Problem Occurred!! please try again", {
            icon: "error",
            timer: 2000,
          });
        }
      });

    });

    $(".delete-locker").on("click", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');

      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {

          $.ajax({
            type: "POST",
            url: "<?php echo site_url('Shop/delete_locker'); ?>",
            data: {
              delete_id: dlt_id
            },
            dataType: "JSON",
            success: function(data) {
              if (data.status == 'success') {
                swal(data.message, {
                  icon: "success",
                  timer: 1000,
                });
                setTimeout(function() {
                  location.reload();
                }, 1000);
              } else {
                clkbtn.prop('disabled', false);
                swal(data.message, {
                  icon: "error",
                  timer: 5000,
                });
              }
            },
            error: function(jqXHR, status, err) {
              clkbtn.prop('disabled', false);
              swal("Some Problem Occurred!! please try again", {
                icon: "error",
                timer: 2000,
              });
            }
          });

        } else {
          clkbtn.prop('disabled', false);
          swal("Your Data is safe!", {
            icon: "info",
            timer: 2000,
          });
        }
      });
    });

    //============================shop============================//
    let checkedcount = parseInt($('#m_locker_Tlocker').val());
    $(".catclick").on("click", function() {
      let id = $(this).val();
      if ($(this).is(":checked")) {
        checkedcount = checkedcount + 1;
      } else {
        checkedcount = checkedcount - 1;
      }

      let totalAmt = checkedcount * 100
      let payableAmt = totalAmt * 2
      $('#m_locker_Trent').val(totalAmt);
      $('#m_locker_Tdeposit').val(totalAmt);
      $('#m_locker_payableAmt').val(payableAmt)
      $('#m_locker_Tlocker').val(checkedcount)

      if ($('#is_credit_allow').val() == 1) {
        $('#m_locker_balAmt').val(payableAmt);
        $('#m_locker_paidAmt').val(0);
      } else if ($('#is_credit_allow').val() == 2) {
        $('#m_locker_balAmt').val(0);
        $('#m_locker_paidAmt').val(0);
      } else {

        $('#m_locker_paidAmt').val(payableAmt);
      }

    });



    $("#m_ticket_paymode").on("change", function() {
      let mode = $(this).val();

      if (mode == 'Cash') {

        $('#Amcounter_in').css('display', 'block');
        $('#scanCard_in').css('display', 'none');
        $('#plot_no_in').css('display', 'none');
        $('#creditCust_in').css('display', 'none');
      } else if (mode == 'Credit') {

        $('#Amcounter_in').css('display', 'none');
        $('#scanCard_in').css('display', 'none');
        $('#plot_no_in').css('display', 'none');
        $('#creditCust_in').css('display', 'block');
      } else {

        $('#Amcounter_in').css('display', 'block');
        $('#scanCard_in').css('display', 'block');
        $('#plot_no_in').css('display', 'block');
        $('#creditCust_in').css('display', 'none');
      }

    });

    $("#m_cust_mobile").on("change", function() {
      var custname = $("#usersdtl option[value='" + $(this).val() + "']").attr('data-custname')
      var custID = $("#usersdtl option[value='" + $(this).val() + "']").attr('data-custId')
      var tickId = $("#usersdtl option[value='" + $(this).val() + "']").attr('data-tickId')

      $('#m_cust_name').val(custname);
      $('#m_locker_ticket_id').val(tickId);
      $('#m_locker_customer').val(custID);

    });

    $('#m_locker_ispartial').click(function() {
      if ($(this).prop('checked') == false) {
        $('.paypartial').css('display', 'none');
        $('#m_locker_paytype').append(`<option value="partial" id="partial_op">Partial Payment</option>`);
        $('#m_locker_ispartial').prop('checked', false);
        $('#m_locker_paytype').val(1);
      }
    });

    $('#m_locker_paytype').change(function() {

      if ($(this).val() == 'partial') {
        $('.paypartial').css('display', 'block');
        $('#partial_op').remove();
        $('#m_locker_ispartial').prop('checked', true);
        $('#m_locker_paytype').val(1);
      }

    });

    $('#m_locker_paidAmt').change(function() {
      if ($('#m_locker_ispartial').prop('checked') == true) {
        var netamout = parseFloat($('#m_locker_payableAmt').val());
        var paidt1 = parseFloat($(this).val());
        var paidt2 = (netamout - paidt1);
        $('#m_locker_paidAmt2').val(paidt2);
      }

    });



  });
</script>