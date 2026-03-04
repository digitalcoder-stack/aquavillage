<script type="text/javascript">
  $(document).ready(function(e) {
    //============================shop============================//

    $('.returnqty').on("change", function() {
      // alert()
      if ($(this).data('recoredqty') == $(this).val()) {
        $('#btn-costumerefund').prop('disabled', false)
      } else {
        // $('#btn-costumerefund').prop('disabled',true)
        swal("Costume is missing! please check again", {
          icon: "error",
          timer: 2000,
        });
        $(this).val('');
      }
    });


    // recoredqty

    //============================shop============================//

    $("form#frm-costumerefund").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-costumerefund");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Shop/update_costumerefund'); ?>",
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


    $("form#frm-costume-create").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-costume-create");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);
      var payamt = $('#m_costume_payableAmt').val();

      if (payamt == 0) {
        clkbtn.prop('disabled', false);
        swal("Amount Should not be 0", {
          icon: "error",
          timer: 2000,
        });
        return false;
      }
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Shop/insert_costume'); ?>",
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
              window.location = "<?php echo site_url('Shop/costume_list/1'); ?>";
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

    $(".delete-costume").on("click", function() {
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
            url: "<?php echo site_url('Shop/delete_costume'); ?>",
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
    $(".catclick").on("keyup", function() {
      let cosidcount = '';
      let Tdepositsum = 0;
      let Trentsum = 0;
      let rent = $(this).data('rent');
      let deposit = $(this).data('deposit');
      let costumecode_id = $(this).data('costumecode_id');
      let qty = $(this).val();
      //  qtycount += parseInt(qty);
      //  qtycount += qty +',';
      //  cosidcount += costumecode_id +',';
      let totalrent = rent * qty
      let totaldeposit = deposit * qty
      $('#rentsum' + costumecode_id).val(totalrent);
      $('#depositsum' + costumecode_id).val(totaldeposit);

      $('.rentsum').each(function(index) {
        if ($(this).val() != '' && $(this).val() != 0) {
          Trentsum += parseInt($(this).val());
          cosidcount += $(this).data('cosid') + ',';
        }
      });

      $('.depositsum').each(function(index) {
        if ($(this).val() != '') {
          Tdepositsum += parseInt($(this).val());

        }
      });

      $('#m_costume_cosid').val(cosidcount);
      $('#m_costume_Trent').val(Trentsum);
      $('#m_costume_Tdeposit').val(Tdepositsum);
      $('#m_costume_payableAmt').val(Trentsum + Tdepositsum)

      if ($('#is_credit_allow').val() == 1) {
        $('#m_costume_balAmt').val(Trentsum + Tdepositsum);
        $('#m_costume_paidAmt').val(0);
      } else if ($('#is_credit_allow').val() == 2) {
        $('#m_costume_balAmt').val(0);
        $('#m_costume_paidAmt').val(0);
      } else {
        $('#m_costume_paidAmt').val(Trentsum + Tdepositsum);
      }


      //   let paidamt = $("#m_costume_paidAmt").val(); 

      // $('#m_costume_balAmt').val((Trentsum + Tdepositsum)-paidamt);
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
      $('#m_costume_ticket_id').val(tickId);
      $('#m_costume_customer').val(custID);

    });

    $('#m_costume_ispartial').click(function() {
      if ($(this).prop('checked') == false) {
        $('.paypartial').css('display', 'none');
        $('#m_costume_paytype').append(`<option value="partial" id="partial_op">Partial Payment</option>`);
        $('#m_costume_ispartial').prop('checked', false);
        $('#m_costume_paytype').val(1);
      }
    });

    $('#m_costume_paytype').change(function() {

      if ($(this).val() == 'partial') {
        $('.paypartial').css('display', 'block');
        $('#partial_op').remove();
        $('#m_costume_ispartial').prop('checked', true);
        $('#m_costume_paytype').val(1);
      }

    });

    $('#m_costume_paidAmt').change(function() {
      if ($('#m_costume_ispartial').prop('checked') == true) {
        var netamout = parseFloat($('#m_costume_payableAmt').val());
        var paidt1 = parseFloat($(this).val());
        var paidt2 = (netamout - paidt1);
        $('#m_costume_paidAmt2').val(paidt2);
      }

    });


  });
</script>