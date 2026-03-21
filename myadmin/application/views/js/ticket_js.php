<script type="text/javascript">
  $(document).ready(function(e) {
    //============================shop============================//

    //============================shop============================//
    $("form#frm-ticket-create").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-ticket-create");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Shop/insert_ticket'); ?>",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function(data) {
          if (data.status == 'success') {
            swal(data.message, {
              icon: "success",
              timer: 1000,
            });
            setTimeout(function() {
              window.location = "<?php echo site_url('Shop/add_ticket'); ?>";
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

    });

    $(".delete-ticket").on("click", function() {
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
            url: "<?php echo site_url('Shop/delete_ticket'); ?>",
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

    $(".refund-ticket").on("click", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var tck_id = $(this).data('value');

      swal({
        title: "Are you sure?",
        text: "Once Refund, you will not be able to reverse this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {

          $.ajax({
            type: "POST",
            url: "<?php echo site_url('Shop/refund_ticket'); ?>",
            data: {
              tck_id
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

    $(".packqty").on("change", function() {
      if (this.id == 'm_ticket_adult') {
        $("#m_ticket_adult").prop('readonly', false);
        $("#m_ticket_child").val(0).prop('readonly', true);
      } else if (this.id == 'm_ticket_child') {
        $("#m_ticket_child").prop('readonly', false);
        $("#m_ticket_adult").val(0).prop('readonly', true);
      }
    });

    $(".amountcalculate").on("keyup", function() {

      let adultCount = $("#m_ticket_adult").val();
      let childCount = $("#m_ticket_child").val();
      let adultbase = parseFloat($("#adultbase").text());
      let childbase = parseFloat($("#childbase").text());
      let discount_amt = $("#m_ticket_discount").val() == 0 ? 0 : parseFloat($("#m_ticket_discount").val());
      let gst = parseInt($("#gst").text()) / 100;
      if (gst != 0.18) {
        gst = 0;
      }

      let adultTAmt = adultCount * adultbase;
      let childTAmt = childCount * childbase;
      let totalAmt = adultTAmt + childTAmt;
      $('.m_ticket_totalAmt').val(totalAmt.toFixed(2));

      let gstAmt = totalAmt * gst;
      let nextAmt = Math.round((gstAmt + totalAmt ) /10) * 10;
      $('.m_ticket_gstAmt').val(gstAmt.toFixed(2))
      $('.m_ticket_netAmt').val(nextAmt);

      let secDiscount_amt = 0;
      let discount_prt = 0;
      let pack20total = 0;

      if ($("#is_discount_applied").is(":checked")) {
        let pack_size = parseInt(adultCount) + parseInt(childCount);
        if (pack_size > 0) {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('Shop/get_applicable_discount'); ?>",
            data: {
              pack_size: pack_size
            },
            dataType: "JSON",
            async: false, // Make it synchronous to wait for response
            success: function(data) {
              if (data.status == 'success') {
                if (pack_size > 20) {
                  pack20total = (20 * nextAmt / pack_size);
                  secDiscount_amt = (pack20total * data.discount / 100);
                } else {
                  secDiscount_amt = (nextAmt * data.discount / 100);
                }
                discount_prt = data.discount;
                // console.log('Seasonal Discount Applied: ' + discount_amt.toFixed(2));
              }
            }
          });
        }
        nextAmt = Math.round((gstAmt + totalAmt - secDiscount_amt) /10) * 10;
        $('.m_ticket_netAmt').val(nextAmt);
        $('.m_ticket_discount').val(secDiscount_amt.toFixed(2));
        $('#m_ticket_disprt').val(discount_prt);
      }else {
        if($('#m_ticket_paymode').val() != 'Members'){
           $('.m_ticket_discount').val(secDiscount_amt.toFixed(2));
           $('#m_ticket_disprt').val(discount_prt);
        }else {
           nextAmt = Math.round((gstAmt + totalAmt - discount_amt) /10) * 10;
           $('.m_ticket_netAmt').val(nextAmt);
        }
      }

      // let paidamt = $("#m_ticket_paidAmt").val();
      // let balamt = Math.round(gstAmt + totalAmt) - paidamt;
      // $('.m_ticket_balAmt').val(balamt);
      // var net_payale = Math.round(gstAmt + totalAmt - discount_amt);

      if ($("#m_ticket_paymode").val() == 'Credit') {
        $('#m_ticket_paidAmt').val(0);
        $('.m_ticket_balAmt').val(nextAmt);
      } else {
        $('#m_ticket_paidAmt').val(nextAmt);
        $('.m_ticket_balAmt').val(0);
      }

    });


    $("#is_discount_applied").on("change", function() {
      $(".amountcalculate").trigger("keyup");
    });

    $("#m_ticket_paymode").on("change", function() {
      let mode = $(this).val();

      if (mode == 'Cash') {

        $('.cashdiv').css('display', 'block');
        $('.plotdiv').css('display', 'none');

        $('#creditCust_in').css('display', 'none');
        $('#allcreditdiv').css('display', 'none');
        $('#memberverdiv').addClass('d-none');
        $('#btn-ticket-create').prop('disabled', false);
      } else if (mode == 'Credit') {
        
        $('.cashdiv').css('display', 'none');
        $('.plotdiv').css('display', 'none');
        $('#creditCust_in').css('display', 'block');
        $('#allcreditdiv').css('display', 'block');
        $('#memberverdiv').addClass('d-none');
        $('#m_ticket_resp_id').attr('required', true);
        $('#btn-ticket-create').prop('disabled', false);
      } else {
        $('.cashdiv').css('display', 'block');
        $('.paypartial').css('display', 'none');
        $('.plotdiv').css('display', 'block');
        $('#creditCust_in').css('display', 'none');
        $('#allcreditdiv').css('display', 'none');
        $('#btn-ticket-create').prop('disabled', true);
      }

    });

    $("#m_ticket_cusType").on("change", function() {
      let cusType = $(this).val();

      if (cusType == 'General') {
        $('#allcreditdiv').css('display', 'none');
      } else if (cusType == 'Free') {
        $('#allcreditdiv').css('display', 'block');
      }

    });

    $("#m_ticket_head").on("change", function() {
      let id = $(this).val();
      let text = $(this).find(':selected').data('title');
      let dis = $(this).find(':selected').data('dis');
      let gst = $(this).find(':selected').data('gst');

      let weekday_adult_rate = parseFloat('<?= get_rate_band('WDAR', 1) ?>');
      let weekday_child_rate = parseFloat('<?= get_rate_band('WDCR', 1) ?>');
      let weekday_adult_combo_rate = parseFloat('<?= get_rate_band('WDACR', 1) ?>');
      let weekday_child_combo_rate = parseFloat('<?= get_rate_band('WDCCR', 1) ?>');
      let weekend_adult_rate = parseFloat('<?= get_rate_band('WEAR', 2) ?>');
      let weekend_child_rate = parseFloat('<?= get_rate_band('WECR', 2) ?>');
      let weekend_adult_combo_rate = parseFloat('<?= get_rate_band('WEACR', 2) ?>');
      let weekend_child_combo_rate = parseFloat('<?= get_rate_band('WECCR', 2) ?>');
      let is_today_holiday = parseInt('<?= get_settings('is_today_holiday') ?>');

      // alert(id +'-'+ dis +'-'+ gst + '-'+ (weekday_adult_rate + weekday_child_rate));
      var d = new Date();
      var n = d.getDay();
      if (id == 2) {
        $('#adultbase').text(222.20);
        $('#adultnet').text(Math.round((222.20 * 0.18) + 222.20));
        $('#childbase').text(222.20);
        $('#childnet').text(Math.round((222.20 * 0.18) + 222.20));
        $('#gst').text('18');
        $('#m_ticket_paymode').val('Members').trigger('change');
        $('#btn-ticket-create').prop('disabled', true);
      } else if (n == 6 || n == 0 || is_today_holiday == 1) {
        if (text == 'combo') {
          $('#adultbase').text(weekend_adult_combo_rate);
          $('#adultnet').text(Math.round((weekend_adult_combo_rate * 0.18) + weekend_adult_combo_rate));
          $('#childbase').text(weekend_child_combo_rate);
          $('#childnet').text(Math.round((weekend_child_combo_rate * 0.18) + weekend_child_combo_rate));
          $('#gst').text('18');
        } else if (dis != 0) {
          $('#adultbase').text(Math.ceil(weekend_adult_rate * (100 - dis) / 100));
          $('#adultnet').text(Math.ceil(weekend_adult_rate * (100 - dis) / 100));
          $('#childbase').text(Math.ceil(weekend_child_rate * (100 - dis) / 100));
          $('#childnet').text(Math.ceil(weekend_child_rate * (100 - dis) / 100));
          $('#gst').text(' ');

        } else {
          $('#adultbase').text(weekend_adult_rate);
          $('#adultnet').text(Math.round((weekend_adult_rate * 0.18) + weekend_adult_rate));
          $('#childbase').text(weekend_child_rate);
          $('#childnet').text(Math.round((weekend_child_rate * 0.18) + weekend_child_rate));
          $('#gst').text('18');
        }
        $('#memberverdiv').addClass('d-none');
        $('#m_ticket_paymode').val('Cash').trigger('change');
        $('#btn-ticket-create').prop('disabled', false);
      } else {
        if (text == 'combo') {
          $('#adultbase').text(weekday_adult_combo_rate);
          $('#adultnet').text(((weekday_adult_combo_rate * 0.18) + weekday_adult_combo_rate).toFixed(2));
          $('#childbase').text(weekday_child_combo_rate);
          $('#childnet').text(((weekday_child_combo_rate * 0.18) + weekday_child_combo_rate).toFixed(2));
          $('#gst').text('18');
        } else if (dis != 0) {
          $('#adultbase').text(Math.ceil(weekday_adult_rate * (100 - dis) / 100));
          $('#adultnet').text(Math.ceil(weekday_adult_rate * (100 - dis) / 100));
          $('#childbase').text(Math.ceil(weekday_child_rate * (100 - dis) / 100));
          $('#childnet').text(Math.ceil(weekday_child_rate * (100 - dis) / 100));
          $('#gst').text(' ');

        } else {
          $('#adultbase').text(weekday_adult_rate);
          $('#adultnet').text(((weekday_adult_rate * 0.18) + weekday_adult_rate).toFixed(2));
          $('#childbase').text(weekday_child_rate);
          $('#childnet').text(((weekday_child_rate * 0.18) + weekday_child_rate).toFixed(2));
          $('#gst').text('18');
        }
        $('#m_ticket_paymode').val('Cash').trigger('change');
        $('#memberverdiv').addClass('d-none');
        $('#btn-ticket-create').prop('disabled', false);
      }


    });

    $("#m_ticket_creditCust").on("change", function() {
      var custname = $(this).find(':selected').data('name');
      var custNO = $(this).find(':selected').data('num');
      var custcity = $(this).find(':selected').data('city');
      $('#m_cust_name').val(custname);
      $('#m_cust_mobile').val(custNO);
      $('#stc_add_city').val(custcity).trigger('change');
      //  alert(custname);
    });

    $("#m_ticket_plot_no").on("change", function() {
      var plotno = $(this).val();

      if (plotno != '' || plotno != null) {
        $.ajax({
          type: "POST",
          url: "<?php echo site_url('Shop/get_plotmem_list'); ?>",
          data: {
            plotno
          },
          dataType: "JSON",
          success: function(data) {
            if (data.status == 'success') {
              // console.log(data.data[0].p_member_adharno);
              $('#modal_body_contant').empty();
              $.each(data.data, function(i, item) {
                $('#modal_body_contant').append(`<tr class="tr_memclick" data-memid="` + item.p_member_id + `">
                                                <td>` + (i + 1) + `</td>
                                                <td>` + item.p_member_name + ` </td>
                                                <td>` + item.p_member_adharno + `</td>
                                                <td>` + item.p_member_mobileno + `</td>
                                             
                                            </tr>`);
              });
              $('#plotmemberModal').modal('show');

            } else {

              swal(data.message, {
                icon: "error",
                timer: 5000,
              });
            }
          },
          error: function(jqXHR, status, err) {

            swal("Some Problem Occurred!! please try again", {
              icon: "error",
              timer: 2000,
            });
          }
        });
      }

    });

    $(document).on("click", ".tr_memclick", function() {
      var memid = $(this).data('memid');

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Shop/get_plotmem_details'); ?>",
        data: {
          memid
        },
        dataType: "JSON",
        success: function(data) {
          if (data.status == 'success') {
            var member_docs = data.data.p_member_docs == '' ? '' : '<a href="<?= base_url('uploads/plots/') ?>' + data.data.p_member_docs + '" target="_blank" class="btn btn-info btn-action">View File</a>';
            var member_img = data.data.p_member_image == '' ? '<?= base_url('uploads/default_user.png') ?>' : '<?= base_url('uploads/capure_images/') ?>' + data.data.p_member_image;
            $('#memdetaildiv').html(`<div class="col-md-6 pd-5">
                            Plot No : <b>` + data.data.m_plot_no + `</b>
                        </div>
                        <div class="col-md-6 pd-5 text-end">
                            Plot Type : <b>` + data.data.m_plot_type + `</b>
                        </div>
                        <div class="col-md-6 pd-5 ">
                            Plot Name : <b>` + data.data.m_plot_name + `</b>
                        </div>

                        <div class="col-md-6 pd-5 text-end">
                            City : <b>` + data.data.m_city_name + `</b>
                        </div>
                        <div class="col-md-6 pd-5">
                            Member Name : <b>` + data.data.p_member_name + `</b>
                        </div>
                        <div class="col-md-6 pd-5 text-end">
                            Member Contact : <b>` + data.data.p_member_mobileno + `</b>
                        </div>
                        <div class="col-md-6 pd-5">
                            Member Aadhar no : <b>` + data.data.p_member_adharno + `</b>
                        </div>
                        <div class="col-md-6 pd-5 text-end">
                            Atteched docs : ` + member_docs + `
                        </div>`);

            $('#membimgdiv').html(`<a href="` + member_img + `" target="blank"><img src="` + member_img + `" alt=""></a>`);
            $('#vermodlbtndiv').append(`<button type="button" onclick="open_cancel_modal('` + data.data.p_member_id + `','` + data.data.m_plot_no + `','` + data.data.p_member_name + `','` + data.data.m_cancel_docs + `','` + data.data.m_cancel_reason + `','Shop/plot_membership_cancel')" style="margin-bottom: 5px;" class="btn btn-danger btn-sm" id="btn-notverify">Not Verified </button>`);
            $('#memberverdiv').removeClass('d-none');
            $('#m_cust_name').val(data.data.p_member_name);
            $('#m_ticket_scanCard').val(data.data.p_member_adharno);
            $('#m_cust_mobile').val(data.data.p_member_mobileno);
            $('#stc_add_city').val(data.data.m_plot_city).trigger('change');
          } else {
            swal(data.message, {
              icon: "error",
              timer: 5000,
            });
          }
        }
      });


      var discount = $('#adultbase').html();
      $('.m_ticket_discount').val(discount);
      $('#m_ticket_adult').val(1).trigger('keyup');

      $('#plotmemberModal').modal('hide');
    });

    $('#m_ticket_ispartial').click(function() {
      if ($(this).prop('checked') == false) {
        $('.paypartial').css('display', 'none');
        $('#m_ticket_paytype').append(`<option value="partial" id="partial_op">Partial Payment</option>`);
        $('#m_ticket_ispartial').prop('checked', false);
        $('#m_ticket_paytype').val(1);
      }
    });

    $('#m_ticket_paytype').change(function() {

      if ($(this).val() == 'partial') {
        $('.paypartial').css('display', 'block');
        $('#partial_op').remove();
        $('#m_ticket_ispartial').prop('checked', true);
        $('#m_ticket_paytype').val(1);
      }

    });

    $('#m_ticket_paidAmt').change(function() {
      if ($('#m_ticket_ispartial').prop('checked') == true) {
        var netamout = parseFloat($('#m_ticket_netAmt').val());
        var paidt1 = parseFloat($(this).val());
        var paidt2 = (netamout - paidt1);
        $('#m_ticket_paidAmt2').val(paidt2);
      }

    });

  });
</script>

<script>
  // $('.uploadImagebtn').click(function() {
  //     var coun = $(this).data('count');
  //       $("#uploadImage"+coun).trigger('click');
  //       return false;
  //    });

  function opencamera() {
    var name = $('#p_member_name').val();
    $('#camera_title').html(name);
    $('#preview_title').html('Preview - ' + name);
    $('#opencameraModal').modal('show');



    navigator.mediaDevices.getUserMedia({
        video: true
      })
      .then(stream => {
        const video = document.getElementById('video');
        video.srcObject = stream;

        const captureBtn = document.getElementById('captureBtn');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');

        captureBtn.addEventListener('click', () => {
          // Capture frame from the video stream
          context.drawImage(video, 0, 0, canvas.width, canvas.height);

          // Convert the canvas content to a data URL
          const dataURL = canvas.toDataURL('image/png');

          // Display the preview image
          $('#preview_image').prop('src', dataURL)
          $('#image_input').val(dataURL)
          $('#opencameraModal').modal('hide');
          $('#camera_btn').html('Change Image');
          // Send the captured image to the server

        });
      })
      .catch(error => {
        console.error('Error accessing webcam:', error);
      });
  }


  $('#btn_verify').click(function(e) {
    var dataURL = $('#image_input').val();
    fetch('<?= base_url('Welcome/upload_capture_image') ?>', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'image=' + encodeURIComponent(dataURL)
      })
      .then(response => response.json())
      .then(data => {
        if (data.status == 'success') {

          $('#m_ticket_plot_file').val(data.filename);
          $('#opencameraModal').modal('hide');
          $('#camera_btn').hide();
          $('#btn-ticket-create').prop('disabled', false);
          swal(data.message, {
            icon: "success",
            timer: 1000,
          });
          return true;
        } else {
          swal(data.message, {
            icon: "error",
            timer: 5000,
          });
        }
      })
      .catch(error => {
        console.error('Error sending image to server:', error);
      });
  });
</script>