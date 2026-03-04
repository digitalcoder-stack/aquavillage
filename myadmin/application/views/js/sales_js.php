<script type="text/javascript">
  $(document).ready(function(e) {
    //============================shop============================//

    // $('.returnqty').on("change",function(){  
    //   // alert()
    // if($(this).data('recoredqty') == $(this).val()){
    //   $('#btn-salesrefund').prop('disabled',false)
    // } else {
    //   // $('#btn-salesrefund').prop('disabled',true)
    //   swal("sales is missing! please check again", { icon: "error", timer: 2000, });
    //   $(this).val('');
    // }
    // });


    // recoredqty

    //============================shop============================//

    $("form#frm-salesrefund").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-salesrefund");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Shop/update_salesrefund'); ?>",
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


    $("form#frm-sales-create").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-sales-create");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Shop/insert_sales'); ?>",
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
              window.location = "<?php echo site_url('Shop/add_sales'); ?>";
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

    $(".delete-sales").on("click", function() {
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
            url: "<?php echo site_url('Shop/delete_sales'); ?>",
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

    $('#m_sales_ispartial').click(function() {
      if ($(this).prop('checked')==false) {
        $('.paypartial').css('display', 'none');
        $('#m_sales_paytype').append(`<option value="partial" id="partial_op">Partial Payment</option>`);
        $('#m_sales_ispartial').prop('checked', false);
        $('#m_sales_paytype').val(1);
      } 
    });

    $('#m_sales_paytype').change(function() {

      if ($(this).val() == 'partial') {
        $('.paypartial').css('display', 'block');
        $('#partial_op').remove();
        $('#m_sales_ispartial').prop('checked', true);
        $('#m_sales_paytype').val(1);
      } 

    });

    $('#m_sales_paidAmt').change(function() {
      if ($('#m_sales_ispartial').prop('checked') == true) {
        var netamout = parseFloat($('#m_sales_netAmt').val());
        var paidt1 = parseFloat($(this).val());
        var paidt2 = (netamout - paidt1);
        $('#m_sales_paidAmt2').val(paidt2);
      }

    });


    //============================shop============================//
    $(".catclick").on("keyup", function() {

      let prodid = '';
      //   let Tdepositsum = 0;
      let Tratesum = 0;
      let rate = $(this).data('rate');
      let product_id = $(this).data('product_id');
      let qty = $(this).val();

      let netAmt = rate * qty;

      $('#tamt' + product_id).text(netAmt);

      $('.ratesum').each(function(index) {
        if ($(this).text() != '') {
          Tratesum += parseInt($(this).text());
          prodid += $(this).data('id') + ',';

        }
      });

      //   $('.depositsum').each(function(index) {
      //     if($(this).val() != ''){
      //       Tdepositsum += parseInt($(this).val());

      //     }});

      $('#m_sales_prodid').val(prodid);
      $('#m_sales_Ttextable').val(Tratesum);
      $('#m_sales_netAmt').val(Tratesum);
      $('#m_sales_paidAmt').val(Tratesum);

    });



    $("#m_cust_mobile").on("change", function() {
      var custname = $("#usersdtl option[value='" + $(this).val() + "']").attr('data-custname')
      var custID = $("#usersdtl option[value='" + $(this).val() + "']").attr('data-custId')
      var tickId = $("#usersdtl option[value='" + $(this).val() + "']").attr('data-tickId')

      $('#m_cust_name').val(custname);
      $('#m_sales_ticket_id').val(tickId);
      $('#m_sales_customer').val(custID);

    });

    //===========================leadst ===========================//

    $("form#frm-add-leadst").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-leadst");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);
      var type1 = $('#m_leadst_type').val();

      if (type1 == 1) {
        var paglink = "<?= site_url('Marketing/leadsource_list'); ?>";
      } else if (type1 == 1) {
        var paglink = "<?= site_url('Marketing/leadtype_list'); ?>";
      } else {
        var paglink = "<?= site_url('Marketing/leadstatus_list'); ?>"
      }

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Marketing/insert_leadst'); ?>",
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
              window.location = paglink ;
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


    $("#leadst_tbl").on("click", ".delete-leadst", function() {
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
            url: "<?php echo site_url('Marketing/delete_leadst'); ?>",
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

    //===========================leadst===========================//


    //===========================lead===========================//
    $("form#frm-add-lead").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-lead");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Marketing/insert_lead'); ?>",
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
              window.location = "<?php echo site_url('Marketing/lead_list'); ?>";
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


    $("#leadhistory").on("click", ".delete-lead", function() {
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
            url: "<?php echo site_url('Marketing/delete_lead'); ?>",
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

    $("#lead_tbl").on("click", ".delete-blead", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');

      swal({
        title: "Are you sure?",
        text: "Once deleted, All the history is also deleted and you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {

          $.ajax({
            type: "POST",
            url: "<?php echo site_url('Marketing/delete_blead'); ?>",
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



    $("#m_lead_clientid").on("change", function() {
      var clientid = $(this).val();


      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Marketing/get_client_dtl'); ?>",
        data: {
          clientid
        },
        dataType: "JSON",
        success: function(data) {
          if (data) {
            let block = '';
            let result = '<option value="">Select Person</option>';
            $.each(data.Contact_persons, function(i, item) {
              block += `<tr><th>ContactID</th><td>` + item.lc_person_id + `</td></tr>
                                        <tr><th>Person Name</th><td>` + item.lc_person_name + `</td></tr>
                                        <tr><th>Mobile No</th><td>` + item.lc_person_mobileno + `</td></tr>
                                        <tr><th>Email</th><td>` + item.lc_person_email + `</td></tr>
                                        <tr><th>Department</th><td>` + item.lc_person_dept + `</td></tr>`;

              result += '<option value="' + item.lc_person_id + '" >' + item.lc_person_name + "</option>";
            });

            $('#m_lead_meetwith').html(result);

            $('#clientdtlblock').html(` <table class="table table-striped table-bordered">
                                    <thead>
                                        <th>Title</th>
                                        <th>Description</th>
                                    </thead>
                                    <tbody>
                                        <tr><th>LeadClientID</th><td>` + data.m_lclient_id + `</td></tr>
                                        <tr><th>LeadSrc</th><td>` + data.m_lclient_src + `</td></tr>
                                        <tr><th>LeadType</th><td>` + data.m_lclient_type + `</td></tr>
                                        <tr><th>LeadName</th><td>` + data.m_lclient_name + `</td></tr>
                                        <tr><th>Address</th><td>` + data.m_lclient_address + `</td></tr>
                                        <tr><th>Village</th><td>` + data.m_lclient_village + `</td></tr>
                                        <tr><th>City</th><td>` + data.m_lclient_city + `</td></tr>
                                        <tr><th>Potential</th><td>` + data.m_lclient_potential + `</td></tr>
                                        <tr><th>Remarks</th><td>` + data.m_lclient_remark + `</td></tr>
                                        <tr><th>Created On</th><td>` + data.m_lclient_added_on + `</td></tr>
                                        <tr><th></th><th></th></tr>
                                      ` + block + `
                                                                              
                                    </tbody>
                                </table>`);

          }
        },

      });

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Marketing/get_lead_history'); ?>",
        data: {
          clientid
        },
        dataType: "JSON",
        success: function(data) {
          if (data) {
            let rows = '';
            $.each(data, function(i1, item1) {

              rows += `<tr>
<td>` + (i1 + 1) + `</td>
<td>` + item1.meet_with + `</td>
<td>` + item1.m_lead_minvisits + `</td>
<td>` + item1.m_lead_rateph + `</td>
<td>` + item1.m_lead_flocker + `</td>
<td>` + item1.m_lead_fcostume + `</td>
<td>` + item1.m_lead_summery + `</td>
<td>` + item1.package_name + `</td>
<td>` + item1.m_lead_followup + `</td>
<td>` + item1.m_lead_date + `</td>
</tr>`;
            });
            // console.log(rows);
            $('#tableblock').empty().html(rows);

          }
        },

      });

    });



    //===========================lead===========================//
    //===========================lead client===========================//

    //===========================lead===========================//
    $("form#frm-add-lclient").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-lclient");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Marketing/insert_leadclient'); ?>",
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
              window.location = "<?php echo site_url('Marketing/leadclient_list'); ?>";
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


    $("#leadclient_tbl").on("click", ".delete-leadclient", function() {
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
            url: "<?php echo site_url('Marketing/delete_leadclient'); ?>",
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

    //===========================lead client===========================//

  });
</script>