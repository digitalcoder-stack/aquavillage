<script type="text/javascript"> 
  $(document).ready(function(e) {

    $("#custom_tbl").on("click",".delete-student-data",function(){ 
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
            url: "<?php echo site_url('Students/delete_student_dtl'); ?>",
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


  $("form#frm-student-create").submit(function(e) { e.preventDefault();
      var clkbtn = $("#btn-student-create"); clkbtn.prop('disabled',true);
      var formData = new FormData(this); 
      
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Students/insert_student_dtl'); ?>",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON", 
        success: function(data) {
          if(data.status=='success'){
            swal(data.message, {icon: "success", timer: 1000, });
            setTimeout(function(){
              window.location = "<?php echo site_url('Students/student_list'); ?>"; 
            },1000);
          }else{ clkbtn.prop('disabled',false);
            swal(data.message, {icon: "error", timer: 5000, });
          }   
        }, error: function (jqXHR, status, err){ clkbtn.prop('disabled',false);
          swal("Some Problem Occurred!! please try again", { icon: "error", timer: 2000, });
        }
      });
    });

    $("#custom_tbl").on("click",".delete-vendor-data",function(){ 
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
            url: "<?php echo site_url('Students/delete_vendor_dtl'); ?>",
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


  $("form#frm-vendor-create").submit(function(e) { e.preventDefault();
      var clkbtn = $("#btn-vendor-create"); clkbtn.prop('disabled',true);
      var formData = new FormData(this); 
      
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Students/insert_vendors_dtl'); ?>",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON", 
        success: function(data) {
          if(data.status=='success'){
            swal(data.message, {icon: "success", timer: 1000, });
            setTimeout(function(){
              window.location = "<?php echo site_url('Students/vendor_list'); ?>"; 
            },1000);
          }else{ clkbtn.prop('disabled',false);
            swal(data.message, {icon: "error", timer: 5000, });
          }   
        }, error: function (jqXHR, status, err){ clkbtn.prop('disabled',false);
          swal("Some Problem Occurred!! please try again", { icon: "error", timer: 2000, });
        }
      });
    });



    //===========================plot===========================//
    $("form#frm-add-plot").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-plot");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Shop/insert_plot'); ?>",
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
              window.location = "<?php echo site_url('Shop/plot_list'); ?>";
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


    $("#plot_tbl").on("click", ".delete-plot", function() {
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
            url: "<?php echo site_url('Shop/delete_plot'); ?>",
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

    $(document).on("click", ".reactive-member", function() {
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var mem_id = $(this).data('value');

      swal({
        title: "Are you sure?",
        text: "You Want to Re Active Membership of this person!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {

          $.ajax({
            type: "POST",
            url: "<?php echo site_url('Shop/reactive_plot'); ?>",
            data: {
              mem_id
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

    //===========================plot===========================//

   





});
</script>