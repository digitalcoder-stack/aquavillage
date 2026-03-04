<script type="text/javascript"> $(document).ready(function(e) {
//=========================Profile============================//

//=========================Profile==================admin=====//
$("form#frm-update-profile").submit(function(e) { e.preventDefault();
  var clkbtn = $("#btn-update-profile"); 
  clkbtn.prop('disabled',true);

  // var adminname = $("#aname").val();
  // if(adminname==""){ alert("Please Enter Admin Name");
  //   $("#aname").focus(); $("#aname").addClass('input-error');

  //   clkbtn.prop('disabled',false); return false;
  // }

  // var adminemail = $("#aemail").val();
  // if(adminemail==""){ alert("Please Entervalid Emailid");
  //   $("#aemail").focus(); $("#aemail").addClass('input-error');

  //   clkbtn.prop('disabled',false); return false;
  // }

  var adminpassword = $("#m_admin_pass").val();
  var repassword = $("#m_admin_repass").val();
  if(adminpassword != repassword){
    swal("Password Not Match! please try again",{ icon: "error", timer: 2000, });
    $("#m_admin_pass").val('');
$("#m_admin_repass").val('');
    clkbtn.prop('disabled',false); return false;
  }
  
  // if(adminpassword==""){ alert("Please Enter Password");
  //   $("#apass").focus(); $("#apass").addClass('input-error');

  //   clkbtn.prop('disabled',false); return false;
  // }

  var formData = new FormData(this);
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('Profile/update_profile'); ?>",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "JSON", 
    success: function(data) {
      if(data.status=='success'){
        swal(data.message, {icon: "success", timer: 1000, });
        setTimeout(function(){ window.location = "<?php echo site_url('Setup/users_list'); ?>"; },1000);
      }else{ clkbtn.prop('disabled',false);
        swal(data.message, {icon: "error", timer: 5000, });
      }  
    }, error: function (jqXHR, status, err) { clkbtn.prop('disabled',false);
      swal("Some Problem Occurred!! please try again",{ icon: "error", timer: 2000, });
    }
  });

});

$("form.frm-update-appdetails").submit(function(e) { e.preventDefault();
  var clkbtn = $(this).find("button.btn-update-appdetails"); clkbtn.prop('disabled',true);

  var formData = new FormData(this);
  $.ajax({
    type: "POST",
    url: "<?php echo site_url('Profile/update_app'); ?>",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "JSON", 
    success: function(data) {
      if(data.status=='success'){
        swal(data.message, {icon: "success", timer: 2000, });
        // setTimeout(function(){ 
        //  // window.location = "<?php //echo site_url('Profile/app'); ?>"; 
        // },3000);
      }else{ clkbtn.prop('disabled',false);
        swal(data.message, {icon: "error", timer: 5000, });
      }  
    }, error: function (jqXHR, status, err) { clkbtn.prop('disabled',false);
      swal("Some Problem Occurred!! please try again",{ icon: "error", timer: 2000, });
    }
  });

});
//========================/Profile==================admin=====//
$("#users_tbl").on("click",".delete-users",function(){ 
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
          url: "<?php echo site_url('Profile/delete_users'); ?>",
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
//========================/Profile============================//
}); </script>