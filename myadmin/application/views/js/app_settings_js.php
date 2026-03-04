<script type="text/javascript">
	$(document).ready(function(e) {
		$("form#frm-update").submit(function(e) {
			e.preventDefault();
			var clkbtn = $("#btn-update");
			clkbtn.prop('disabled', true);
			var formData = new FormData(this);

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Profile/update_settings'); ?>",
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
							window.location = "<?php echo site_url('Profile/application_settings'); ?>";
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


		$("form#frm-rate-band-update").submit(function(e) {
			e.preventDefault();
			var clkbtn = $("#btn-rate-band-update");
			clkbtn.prop('disabled', true);

			if ($('#pagetype').val() == 2) {
				var redlink = "<?php echo site_url('Profile/weekday_settings'); ?>";
			} else {
				var redlink = "<?php echo site_url('Profile/weekend_settings'); ?>"
			}
			var formData = new FormData(this);

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Profile/update_rate_band_settings'); ?>",
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
							window.location = redlink;
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
	});
</script>