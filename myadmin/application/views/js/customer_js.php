<script type="text/javascript"> $(document).ready(function(e) {

//============================ AJAX Pagination ============================//
var activeFilters  = (typeof CUSTOMER_INIT !== 'undefined') ? CUSTOMER_INIT : {};
var ajaxInProgress = false;

function fetchCustomers(page, filters) {
    if (ajaxInProgress) return;
    ajaxInProgress = true;

    $('#customer_loader').show();
    $('#customer_tbody').hide(); 
    $('#customer_pagination').hide();

    var params = {
        from_date : filters.from_date || '',
        to_date   : filters.to_date   || '',
        page      : page              || 1
    };

    $.ajax({
        url     : "<?php echo site_url('Setup/customer_list_ajax'); ?>",
        method  : 'POST',
        data    : params,
        dataType: 'json',
        success : function (res) {
            if (res.status !== 'ok') {
                $('#customer_tbody').html('<tr><td colspan="7" class="text-center text-danger">An error occurred.</td></tr>');
                return;
            }
            $('#customer_tbody').html(res.html);
            buildPagination(res.total, res.per_page, res.page, filters);
        },
        error: function (xhr, status, err) {
            $('#customer_tbody').html('<tr><td colspan="7" class="text-center text-danger">Request failed.</td></tr>');
        },
        complete: function () {
            ajaxInProgress = false;
            $('#customer_loader').hide();
            $('#customer_tbody').show();
            $('#customer_pagination').show();
        }
    });
}

function buildPagination(total, perPage, currentPage, filters) {
    var totalPages = Math.ceil(total / perPage);
    var $pg = $('#customer_pagination').empty();

    if (totalPages <= 1) return;

    var html = '';

    if (currentPage > 1) {
        html += '<button class="btn btn-sm btn-secondary cust-page-btn" data-page="' + (currentPage - 1) + '">&laquo; Prev</button>';
    }

    var startPage = Math.max(1, currentPage - 3);
    var endPage   = Math.min(totalPages, currentPage + 3);

    if (startPage > 1) {
        html += '<button type="button" class="btn btn-sm btn-outline-secondary cust-page-btn" data-page="1">1</button>';
        if (startPage > 2) html += '<span class="btn btn-sm disabled">…</span>';
    }
    for (var p = startPage; p <= endPage; p++) {
        var cls = (p === parseInt(currentPage)) ? 'btn-primary' : 'btn-outline-primary';
        html += '<button type="button" class="btn btn-sm ' + cls + ' cust-page-btn" data-page="' + p + '">' + p + '</button>';
    }
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) html += '<span class="btn btn-sm disabled">…</span>';
        html += '<button type="button" class="btn btn-sm btn-outline-secondary cust-page-btn" data-page="' + totalPages + '">' + totalPages + '</button>';
    }

    if (currentPage < totalPages) {
        html += '<button type="button" class="btn btn-sm btn-secondary cust-page-btn" data-page="' + (parseInt(currentPage) + 1) + '">Next &raquo;</button>';
    }

    html += '<small class="text-muted" style="display:block;width:100%;text-align:center;margin-top:4px;">Page ' + currentPage + ' of ' + totalPages + ' &nbsp;|&nbsp; ' + total + ' total records</small>';

    $pg.html(html);

    $pg.off('click', '.cust-page-btn').on('click', '.cust-page-btn', function (e) {
        e.preventDefault();
        fetchCustomers(parseInt($(this).data('page'), 10), activeFilters);
    });
}

// Initial Data Fetch
if ($('#customer_tbody').length > 0) {
    fetchCustomers(1, activeFilters);

    // Intercept Search Button (NOT Excel Button)
    $('form[action="<?php echo site_url('Setup/customer_list') ?>"] button[type="submit"]:not([name="Excel"])').on('click', function(e) {
        e.preventDefault();
        activeFilters.from_date = $('input[name="from_date"]').first().val();
        activeFilters.to_date = $('input[name="to_date"]').first().val();
        fetchCustomers(1, activeFilters);
    });

    // Date inputs exact sync
    $('input[name="from_date"], input[name="to_date"]').on('change', function() {
        activeFilters.from_date = $('input[name="from_date"]').first().val();
        activeFilters.to_date = $('input[name="to_date"]').first().val();
        fetchCustomers(1, activeFilters);
    });
}
//============================ /AJAX Pagination ============================//


//============================User============================//
$("form#frm-user-create").submit(function(e) { e.preventDefault();
  var clkbtn = $("#btn-user-create"); clkbtn.prop('disabled',true);
  var formData = new FormData(this); 
  
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('Setup/insert_customer'); ?>",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "JSON", 
    success: function(data) {
      if(data.status=='success'){
        swal(data.message, {icon: "success", timer: 1000, });
        setTimeout(function(){
          window.location = "<?php echo site_url('Setup/customer_list'); ?>"; 
        },1000);
      }else{ clkbtn.prop('disabled',false);
        swal(data.message, {icon: "error", timer: 5000, });
      }   
    }, error: function (jqXHR, status, err){ clkbtn.prop('disabled',false);
      swal("Some Problem Occurred!! please try again", { icon: "error", timer: 2000, });
    }
  });
  
});
//===========================/User============================//

//============================User============================//
$("#user_tbl").on("click",".delete-user",function(){ 
  var clkbtn = $(this); clkbtn.prop('disabled',true);
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
          url: "<?php echo site_url('Setup/delete_customer'); ?>",
          data: {delete_id:dlt_id},
          dataType: "JSON",
          success: function(data) { 
            if(data.status=='success'){
              swal(data.message, {icon: "success", timer: 1000, });
              setTimeout(function(){ location.reload(); },1000);
            }else{ clkbtn.prop('disabled',false);
              swal(data.message, {icon: "error", timer: 5000, });
            }  
          }, error: function (jqXHR, status, err) { clkbtn.prop('disabled',false);
            swal("Some Problem Occurred!! please try again", { icon: "error", timer: 2000, });
          }
        });
       
    } else { clkbtn.prop('disabled',false);
      swal("Your Data is safe!", { icon: "info", timer: 2000, });
    }
  });  
});
//===========================/User============================//

//============================User============================//
$("#user_tbl").on('click', '.change-status', function() {
  change_status($(this), "<?php echo site_url('User/change_user_status'); ?>");
});

function change_status(clkbtn, cngs_link){ clkbtn.prop('disabled',true);
  var cg_id=clkbtn.data('cgid'), cg_status=clkbtn.children('button').data('status');

  $.ajax({
    url : cngs_link,
    type: "POST",
    data: {cgstatus : cg_status, cgid:cg_id},
    dataType: "JSON",
    success: function(data){
      if(data.status=='success'){

        if (cg_status == 1) { clkbtn.html('<button type="button" class="btn btn-info btn-block btn-vsm" data-status="2" title="Click here to Change Status">Active</button>');
        }else{ clkbtn.html('<button type="button" class="btn btn-danger btn-block btn-vsm" data-status="1" title="Click here to Change Status">Blocked</button>');
        }
        clkbtn.prop('disabled',false);

      }else{ clkbtn.prop('disabled',false);
        swal(data.message, {icon: "error", timer: 2000, });
      }
    }, error: function (jqXHR, status, err){ clkbtn.prop('disabled',false);
      swal("Some Proble Occurred!! please try again", { icon: "error", timer: 2000, });
    }
  });

}


//===========================/User============================//

//=========================== Supplier============================//

$("form#frm-supplier-create").submit(function(e) { e.preventDefault();
  var clkbtn = $("#btn-supplier-create"); clkbtn.prop('disabled',true);
  var formData = new FormData(this); 
  
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('Setup/insert_supplier'); ?>",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "JSON", 
    success: function(data) {
      if(data.status=='success'){
        swal(data.message, {icon: "success", timer: 1000, });
        setTimeout(function(){
          window.location = "<?php echo site_url('Setup/supplier_list'); ?>"; 
        },1000);
      }else{ clkbtn.prop('disabled',false);
        swal(data.message, {icon: "error", timer: 5000, });
      }   
    }, error: function (jqXHR, status, err){ clkbtn.prop('disabled',false);
      swal("Some Problem Occurred!! please try again", { icon: "error", timer: 2000, });
    }
  });
  
});

$("#supplier_tbl").on("click",".delete-supplier",function(){ 
  var clkbtn = $(this); clkbtn.prop('disabled',true);
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
          url: "<?php echo site_url('Setup/delete_supplier'); ?>",
          data: {delete_id:dlt_id},
          dataType: "JSON",
          success: function(data) { 
            if(data.status=='success'){
              swal(data.message, {icon: "success", timer: 1000, });
              setTimeout(function(){ location.reload(); },1000);
            }else{ clkbtn.prop('disabled',false);
              swal(data.message, {icon: "error", timer: 5000, });
            }  
          }, error: function (jqXHR, status, err) { clkbtn.prop('disabled',false);
            swal("Some Problem Occurred!! please try again", { icon: "error", timer: 2000, });
          }
        });
       
    } else { clkbtn.prop('disabled',false);
      swal("Your Data is safe!", { icon: "info", timer: 2000, });
    }
  });  
});

// $("#supplier_tbl").on('click', '.change-status', function() {
//   change_status($(this), "<?php echo site_url('Setup/change_supplier_status'); ?>");
// });

// function change_status(clkbtn, cngs_link){ clkbtn.prop('disabled',true);
//   var cg_id=clkbtn.data('cgid'), cg_status=clkbtn.children('button').data('status');

//   $.ajax({
//     url : cngs_link,
//     type: "POST",
//     data: {cgstatus : cg_status, cgid:cg_id},
//     dataType: "JSON",
//     success: function(data){
//       if(data.status=='success'){

//         if (cg_status == 1) { clkbtn.html('<button type="button" class="btn btn-info btn-block btn-vsm" data-status="2" title="Click here to Change Status">Active</button>');
//         }else{ clkbtn.html('<button type="button" class="btn btn-danger btn-block btn-vsm" data-status="1" title="Click here to Change Status">Blocked</button>');
//         }
//         clkbtn.prop('disabled',false);

//       }else{ clkbtn.prop('disabled',false);
//         swal(data.message, {icon: "error", timer: 2000, });
//       }
//     }, error: function (jqXHR, status, err){ clkbtn.prop('disabled',false);
//       swal("Some Proble Occurred!! please try again", { icon: "error", timer: 2000, });
//     }
//   });

// }



//===========================/Supplier============================//
}); </script>