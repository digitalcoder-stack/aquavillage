   <!-- Footer Area Start -->
   <footer class="seipkon-footer-area">
     <p>&copy;<?php echo date("Y");
              echo get_settings('m_app_name'); ?> | Design & Developed by <a href="https://DigitalShakha.com/">DigitalShakha</a></p>
   </footer>

   <!---cancel model-->

   <div id="cancelModal" class="modal fade cancelModal" role="dialog">
     <div class="modal-dialog">
       <!-- Modal content-->
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title" id="modaltitle">Cancel Modal </h4>
         </div>
         <form method="POST" id="frm-cancelmodel" enctype="multipart/form-data">
           <div class="modal-body">
             <div class="row">
               <div class="col-md-6" id="detaildiv">

               </div>
               <div class="col-md-3">
                 <div class="form-group">
                   <label>Reason File</label>

                   <input type="file" name="m_cancel_docs" id="m_cancel_docs">
                   <input type="hidden" name="m_cancel_id" id="m_cancel_id">
                   <input type="hidden" name="m_cancel_docs1" id="m_cancel_docs1">
                   <input type="hidden" name="m_url" id="m_url">

                 </div>

               </div>
               <div class="col-md-3" id="imgdiv">

               </div>
               <div class="col-md-12">
                 <div class="form-group">
                   <label>Cancel Reason</label>

                   <textarea rows="4" class="form-control" name="m_cancel_reason" id="m_cancel_reason"></textarea>

                 </div>
               </div>
             </div>

           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-success" id="btn-cancelmodel">submit</button>


           </div>
         </form>
       </div>
     </div>
   </div>

   <!---cancel model end above-->
   </section>
   </div>
   <!-- Bootstrap JS -->
   <script src="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/js/jquery.dataTables.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/js/dataTables.bootstrap.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/js/dataTables.buttons.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/js/buttons.bootstrap.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/js/buttons.flash.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/js/buttons.html5.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/js/buttons.print.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/js/dataTables.responsive.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/js/pdfmake.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/js/jszip.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/js/vfs_fonts.js') ?>"></script>
   <!-- Daterange JS -->
   <script src="<?php echo base_url('assets/plugins/daterangepicker/js/moment.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/daterangepicker/js/daterangepicker.js') ?>"></script>
   <!-- Perfect Scrollbar JS -->
   <script src="<?php echo base_url('assets/plugins/perfect-scrollbar/jquery-perfect-scrollbar.min.js') ?>"></script>
   <script src="" data-backup="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script src="<?php echo base_url('assets/plugins/sweet-alerts/js/sweetalert.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/sweet-alerts/js/custom-sweetalerts.js') ?>"></script>
   <!-- Masked Input JS -->
   <script src="<?php echo base_url('assets/plugins/masked-input/js/jquery.maskedinput.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/summernote/js/summernote.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/summernote/js/custom-summernote.js') ?>"></script>
   <!-- Select2 JS -->
   <script src="<?php echo base_url('assets/plugins/select2/js/select2.full.js') ?>"></script>
   <!-- Color Picker JS -->
   <script src="<?php echo base_url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ?>"></script>
   <!-- Jquery Knob JS -->
   <script src="<?php echo base_url('assets/plugins/jquery-knob/js/jquery.knob.min.js') ?>"></script>
   <!-- Advance Component Form JS For Only This Page -->
   <script src="<?php echo base_url('assets/js/advance_component_form.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/advance_table_custom.js') ?>"></script>
   <!-- Custom JS -->
   <script src="<?php echo base_url('assets/js/seipkon.js') ?>"></script>
   <!-- Table To Excel  07-03-2020 -->
   <script src="<?php echo base_url('assets/js/jquery.table2excel.js') ?>"></script>
   <!-- <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script> -->
   <script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>
   <!-- Main JS-->
   </body>

   </html>
   <?php $this->view('js/sidebar_js') ?>

   <script type="text/javascript">
     function open_cancel_modal(id, title, detail, docs, reason, url) {
       $('#modaltitle').text('Cancel Member (' + title + ')');
       $('#detaildiv').html('Member Name : <b>' + detail + '</b>');
       $('#m_cancel_id').val(id);
       $('#m_cancel_docs1').val(docs);
       if (docs != '') {
         $('#imgdiv').html(`
       <a href="<?= base_url('uploads/plots/') ?>` + docs + `" class="btn btn-info" target="_blank" rel="noopener noreferrer">View File</a>`);
       }else {
        $('#imgdiv').html(``);
       }

       $('#m_url').val(url);
       $('#m_cancel_reason').text(reason);
       $('#cancelModal').modal('show');
     }

     $("form#frm-cancelmodel").submit(function(e) {
       e.preventDefault();
       var clkbtn = $("#btn-cancelmodel");
       clkbtn.prop('disabled', true);

       var frm_url = $('#m_url').val();
       var formData = new FormData(this);

       $.ajax({
         type: "POST",
         url: "<?php echo site_url(); ?>" + frm_url,
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
               window.location.reload();
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

     $('.btn').filter(':not([title])').attr('title', 'Click Here');
     $('.mynev-links').filter(':not([title])').attr('title', 'Click Here');
     /* icon_input js Start :  use Eg  Hide-Show Password  */
     $(".icon_input").on('click', '.input-icon', function() {
       var icon = $(this),
         icon_input = icon.parent('.icon_input'),
         input = icon_input.children('.icon-input');
       var pre_intype = input.attr('type'),
         new_intype = input.data('change');
       var pre_incon = icon.data('change0'),
         new_incon = icon.data('change');
       input.attr('type', new_intype);
       input.data('change', pre_intype);
       icon.data('change0', new_incon);
       icon.data('change', pre_incon);
       icon.removeClass(pre_incon);
       icon.addClass(new_incon);
     });

     function ImageAction(img_input) {
       var myuploadimg = $(img_input).val();
       if (myuploadimg == '') {
         $(img_input).parent('div').removeClass('btn-success');
         $(img_input).parent('div').addClass('btn-info');
         $(img_input).parent('div').attr("title", "Select File");
       } else {
         $(img_input).parent('div').attr("title", "File Selected");
         $(img_input).parent('div').removeClass('btn-info');
         $(img_input).parent('div').addClass('btn-success');
       }
     };
     //header
     $(document).ready(function() {
       //for active class of top tabs
       var acdivid = "<?= $this->uri->segment(1) ?>";
       $('.subnavdiv').hide();
       $('#' + acdivid).show();
       $(".headnavbtn").click(function() {
         var divid = $(this).data('id');
         $('.headnavbtn').removeClass('active');
         $(this).addClass('active');
         $('.subnavdiv').hide();
         $('#' + divid).show();
         //  alert(divid);
       });


     });


     $(document).ready(function() {

       $('.select2').select2({
         // theme: "bootstrap-5",
         width: '100%',
         placeholder: $(this).data('placeholder'),
       });

     });


     function selectRefresh() {
       $('.select2').select2({
         // theme: "bootstrap-5",
         tags: true,
         placeholder: $(this).data('placeholder'),
         // allowClear: true,
         width: '100%',
       });
     }
   </script>