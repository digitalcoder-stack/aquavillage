<script type="text/javascript"> $(document).ready(function(e) {
//============================User============================//

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