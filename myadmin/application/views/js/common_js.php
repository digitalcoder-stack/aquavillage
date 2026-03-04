<style>
    #frm_add_city .select2-container {
                width: 100% !important;
            }
</style>


<div id="addcityModal" class="modal fade " role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New City</h4>
      </div>

      <div class="modal-body">
        <form action="#" method="post" id="frm_add_city">
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label>State<span class="text-danger">*</span></label>
                <select name="m_city_state" id="m_city_state" class="form-control select2" title="Select State" required>
                  <option value="1">Select State</option>
                  <?php
                  if (!empty($get_active_state)) {
                    foreach ($get_active_state as $state) {
                  ?>
                      <option value="<?php echo $state->m_state_id; ?>"><?php echo $state->m_state_name; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>City Title<span class="text-danger">*</span></label>

                <input type="text" name="m_city_name" id="m_city_name" class="form-control" placeholder="Enter City Title" required="">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-layout-submit">
                <button type="button" data-dismiss="modal" class="btn btn-block btn-danger">Cancel</button>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-layout-submit">
                <button type="submit" id="btn_add_city" class="btn btn-block btn-info">Submit</button>
              </div>
            </div>

          </div>

        </form>


      </div>


    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(e) {

    $("form#frm_add_city").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn_add_city");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_shortcut_city'); ?>",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function(data) {
          if (data.status == 'success') {
            $('#stc_add_city').append(`<option value="` + data.data.m_city_id + `" selected>` + data.data.m_city_name + ` | ` + data.data.m_state_name + `</option>`);
            clkbtn.prop('disabled', false);
            $('#addcityModal').modal('hide');
            // console.log(data.data.m_city_name);
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

  });
</script>