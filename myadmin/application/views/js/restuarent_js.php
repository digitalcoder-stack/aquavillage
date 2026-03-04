<script type="text/javascript">
  $(document).ready(function(e) {
    //============================Inventory============================//

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

    //============================ resort entries ============================//

    $('#r_resdata_iscredit').click(function() {
      if ($(this).prop('checked') == false) {
        $('.cashdiv').css('display', 'block');
        $('.creditdiv').css('display', 'none');
        $('.paypartial').css('display', 'none');
        $('#r_resdata_amount').prop('required', true);
        $('#r_resdata_balamt').prop('required', false);
        $('#r_resdata_respon').prop('required', false);
      } else {
        $('.cashdiv').css('display', 'none');
        $('.creditdiv').css('display', 'block');
        $('.paypartial').css('display', 'none');
        $('#r_resdata_amount').prop('required', false);
        $('#r_resdata_balamt').prop('required', true);
        $('#r_resdata_respon').prop('required', true);
      }
    });

    $('#r_resdata_ispartial').click(function() {
      if ($(this).prop('checked') == false) {
        $('.paypartial').css('display', 'none');
        $('#r_resdata_paytype').append(`<option value="partial" id="partial_op">Partial Payment</option>`);
        $('#r_resdata_ispartial').prop('checked', false);
        $('#r_resdata_paytype').val(1);
      }
    });

    $('#r_resdata_paytype').change(function() {

      if ($(this).val() == 'partial') {
        $('.paypartial').css('display', 'block');
        $('#partial_op').remove();
        $('#r_resdata_ispartial').prop('checked', true);
        $('#r_resdata_paytype').val(1);
      }

    });


    $("form#frm-salesrefund").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-salesrefund");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Inventory/update_salesrefund'); ?>",
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


    $("form#frm-resort-create").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-resort-create");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);
      var pagetype = $('#r_resdata_type').val();

      var pagelink = pagetype == 1 ? "<?php echo site_url('Restuarent/resort_data_list'); ?>" : "<?php echo site_url('Restuarent/camps_data_list'); ?>";


      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Restuarent/insert_resort_data'); ?>",
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
              window.location = pagelink;
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

    $(".delete-resort").on("click", function() {
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
            url: "<?php echo site_url('Restuarent/delete_resort_data'); ?>",
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

    $('.r_resdata_fispartial').click(function() {
      var resdit = $(this).data('resdit')
      if ($(this).prop('checked') == false) {
        $('.fpaypartial').css('display', 'none');
        $('#r_resdata_fpmode1' + resdit).append(`<option value="partial" id="partial_op` + resdit + `">Partial Payment</option>`);
        $('#r_resdata_fispartial' + resdit).prop('checked', false);
        $('#r_resdata_fpmode1' + resdit).val(1);
      }
    });

    $('.r_resdata_fpmode1').change(function() {
      var resdit = $(this).data('resdit')
      if ($(this).val() == 'partial') {
        $('.fpaypartial').css('display', 'block');
        $('#partial_op' + resdit).remove();
        $('#r_resdata_fispartial' + resdit).prop('checked', true);
        $('#r_resdata_fpmode1' + resdit).val(1);
      }

    });


    //============================ resort entries ============================//

    //============================ foodcourt entries ============================//



    $("form#frm-foodcourt").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-foodcourt");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Restuarent/insert_foodcourt'); ?>",
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
              window.location = "<?php echo site_url('Restuarent/foodcourt_list'); ?>";
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

    $(".delete-foodcourt").on("click", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');
      var dtype = $(this).data('type');

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
            url: "<?php echo site_url('Restuarent/delete_foodcourt'); ?>",
            data: {
              delete_id: dlt_id,
              dtype
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


    //============================ resort entries ============================//

    //============================Inventory============================//

    $("form#frm-salesrefund").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-salesrefund");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Inventory/update_salesrefund'); ?>",
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
        url: "<?php echo site_url('Inventory/insert_sales'); ?>",
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
              window.location = "<?php echo site_url('Inventory/add_sales'); ?>";
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
            url: "<?php echo site_url('Inventory/delete_sales'); ?>",
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

    //============================Inventory============================//

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

    });



    $("#m_cust_mobile").on("change", function() {
      var custname = $("#usersdtl option[value='" + $(this).val() + "']").attr('data-custname')
      var custID = $("#usersdtl option[value='" + $(this).val() + "']").attr('data-custId')
      var tickId = $("#usersdtl option[value='" + $(this).val() + "']").attr('data-tickId')

      $('#m_cust_name').val(custname);
      $('#m_sales_ticket_id').val(tickId);
      $('#m_sales_customer').val(custID);

    });



    //===========================menugroup ===========================//

    $("form#frm-add-menugroup").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-menugroup");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Restuarent/insert_menugroup'); ?>",
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
              window.location = "<?php echo site_url('Restuarent/menugroup_list'); ?>";
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


    $("#menugroup_tbl").on("click", ".delete-menugroup", function() {
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
            url: "<?php echo site_url('Restuarent/delete_menugroup'); ?>",
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

    //===========================menugroup===========================//



    //===========================menu ===========================//

    $("form#frm-add-menu").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-menu");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Restuarent/insert_menu'); ?>",
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
              window.location = "<?php echo site_url('Restuarent/menu_list'); ?>";
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


    $("#menu_tbl").on("click", ".delete-menu", function() {
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
            url: "<?php echo site_url('Restuarent/delete_menu'); ?>",
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

    //===========================menu===========================//



    //=========================== purchase ===========================//

    $("form#frm-add-purchase").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-purchase");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);
      var pmode = $('#ivt_purchase_mode').val();

      if (pmode == 1) {
        var pagelink = "<?php echo site_url('Inventory/purchase_order'); ?>";
      } else if (pmode == 2) {
        var pagelink = "<?php echo site_url('Inventory/purchase_invoice'); ?>";
      } else if (pmode == 3) {
        var pagelink = "<?php echo site_url('Inventory/purchase_return'); ?>";
      }


      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Inventory/insert_purchase'); ?>",
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
              window.location.href = pagelink;
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


    $("#purchase_tbl").on("click", ".delete-purchase", function() {
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
            url: "<?php echo site_url('Inventory/delete_purchase'); ?>",
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


    $("#ivt_purchase_partyid").on("change", function() {
      var suppid = $(this).val();
      //  alert(empid)

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Inventory/get_supplier_dtl'); ?>",
        data: {
          suppid
        },
        dataType: "JSON",
        success: function(data) {

          $('#supppdetailblock').html(`<h4>Supplier Details </h4>
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>` + data.m_supplier_name + `</td>
                                        <th>City</th>
                                        <td>` + data.m_city_name + `</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td>` + data.m_supplier_mobile + `</td>
                                        <th>Phone</th>
                                        <td>` + data.m_supplier_phoneNo + `</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>` + data.m_supplier_email + `</td>
                                        <th>Acc Code</th>
                                        <td>` + data.m_supplier_AccCode + `</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td colspan="3">` + data.m_supplier_address + `</td>

                                    </tr>
                                </table>`);


        },

      });



    });

    //=========================== purchase ===========================//


    //=========================== stkjn ===========================//
    $("form#frm-add-stkjn").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-stkjn");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Inventory/insert_stkjn'); ?>",
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
              window.location = "<?php echo site_url('Inventory/stockjournal_list'); ?>";
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


    $(document).on("click", ".delete-stkjn", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');
      var dtype = $(this).data('dtype');

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
            url: "<?php echo site_url('Inventory/delete_stkjn'); ?>",
            data: {
              delete_id: dlt_id,
              dtype
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

    //=========================== stkjn ===========================//
    //=========================== reqmt ===========================//
    $("form#frm-add-reqmt").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-reqmt");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Inventory/insert_requirements'); ?>",
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
              window.location = "<?php echo site_url('Inventory/requirement_list'); ?>";
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


    $("#REQMT_tbl").on("click", ".delete-REQMT", function() {
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
            url: "<?php echo site_url('Inventory/delete_requirement'); ?>",
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

    //=========================== reqmt ===========================//


    //=========================== storeissue ===========================//
    $("form#frm-add-storeissue").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-storeissue");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Inventory/insert_storeissue'); ?>",
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
              window.location = "<?php echo site_url('Inventory/storeissue_list'); ?>";
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


    $(document).on("click", ".delete-storeissue", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');
      var dtype = $(this).data('dtype');
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
            url: "<?php echo site_url('Inventory/delete_storeissue'); ?>",
            data: {
              delete_id: dlt_id,
              dtype
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

    //=========================== storeissue ===========================//
    //=========================== storeout ===========================//
    $("form#frm-add-storeout").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-storeout");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Inventory/insert_storeout'); ?>",
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
              window.location = "<?php echo site_url('Inventory/storeout_list'); ?>";
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


    $(document).on("click", ".delete-storeout", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');
      var dtype = $(this).data('dtype');
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
            url: "<?php echo site_url('Inventory/delete_storeout'); ?>",
            data: {
              delete_id: dlt_id,
              dtype
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

    //=========================== storeout ===========================//

  });
</script>