<?php $this->view('top_header') ?>
<div class="page-content">
    <div class="container-fluid">
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 pull-right">
                    <div class="seipkon-breadcromb-right">
                        <a href="<?php echo site_url('Shop/plot_list'); ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All plots</a>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
            .d-flex {
                display: flex;
                align-items: center;
            }

            .jbfrm input[type=radio] {
                width: 27px;
                height: 17px;
                margin: 0px;
                background: none;
                box-shadow: none;
                transition: 0.5s;
            }

            .space-around {
                justify-content: space-around;
            }

            .space-around input[type=checkbox] {
                margin: 0px 0px 0px;
                transition: 0.5s;
                width: 20px;
                height: 18px;
            }

            .space-around input[type=checkbox]:focus {
                outline: none !important;
                transform: scale(1.2);
            }

            .jbfrm input[type=radio]:focus {
                outline: none !important;
                transform: scale(1.2);
            }
        </style>

        <?php if (!empty($edit_value)) {

            $id             = $edit_value->m_plot_id;
            $name           = $edit_value->m_plot_name;
            $fname          = $edit_value->m_plot_fname;
            $plot_no        = $edit_value->m_plot_no;
            $type           = $edit_value->m_plot_type;
            $mobile         = $edit_value->m_plot_mobile;
            $whatsappNo     = $edit_value->m_plot_whatsappNo;
            $email          = $edit_value->m_plot_email;
            $custcity           = $edit_value->m_plot_city;
            $pincode        = $edit_value->m_plot_pincode;
            $address        = $edit_value->m_plot_address;
            $is_adhar_rcvd  = $edit_value->is_adhar_rcvd;
            $aadhar_no      = $edit_value->m_plot_aadhar_no;
            $reg_paper_rcvd = $edit_value->reg_paper_rcvd;
            $registry       = $edit_value->m_plot_registry;
            $docs           = $edit_value->m_plot_docs;
            $pan_no         = $edit_value->m_plot_remark;
            $emcontact_no   = $edit_value->m_plot_emcontact_no;
            $emname         = $edit_value->m_plot_emname;
            $emrelation     = $edit_value->m_plot_emrelation;
        } else {
            $id             = '';
            $name           = '';
            $fname          = '';
            $plot_no        = '';
            $type           = '';
            $mobile         = '';
            $whatsappNo     = '';
            $email          = '';
            $custcity           = '';
            $pincode        = '';
            $address        = '';
            $is_adhar_rcvd  = '';
            $aadhar_no      = '';
            $reg_paper_rcvd = '';
            $registry       = '';
            $docs           = '';
            $pan_no         = '';
            $emcontact_no   = '';
            $emname         = '';
            $emrelation     = '';
        } ?>

        <div class="page-box">
            <div class="form-example">
                <div class="form-wrap top-label-exapmple form-layout-page">
                    <form method="post" action="#" id="frm-add-plot" enctype="mutipart/form-data">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Registry Name</label>
                                    <input type="hidden" name="m_plot_id" id="m_plot_id" value="<?= $id; ?>">
                                    <input type="text" name="m_plot_name" id="m_plot_name" class="form-control" placeholder="Registry Name" required="" value="<?= $name; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Father Name</label>
                                    <input type="text" name="m_plot_fname" id="m_plot_fname" class="form-control" placeholder="Father Name" value="<?= $fname; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Plot No</label>
                                    <input type="text" name="m_plot_no" id="m_plot_no" class="form-control" placeholder="Enter PLot Number" required="" value="<?= $plot_no; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Plot Type</label>
                                    <input type="text" name="m_plot_type" id="m_plot_type" class="form-control" placeholder="Enter Plot Type" required="" value="<?= $type; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_plot_mobile" id="m_plot_mobile" class="form-control" placeholder="Enter Mobile Number" required="" value="<?= $mobile; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Whatsapp No.</label>
                                    <input type="tel" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_plot_whatsappNo" id="m_plot_whatsappNo" class="form-control" placeholder="Enter whatsapp No" value="<?= $whatsappNo; ?>">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Email id</label>
                                    <input type="email" name="m_plot_email" id="m_plot_email" class="form-control" placeholder="Enter Email id" value="<?= $email; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">

                                <div class="input-group">
                                    <label>City Name <span class="text-danger">*</span></label>
                                    <select name="m_plot_city" id="stc_add_city" class="form-control select2" required>
                                        <option value="">Select City</option>
                                        <?php
                                        foreach ($city_dtl as $city) {
                                            if ($custcity == $city->m_city_id) {
                                                $op = 'selected';
                                            } else {
                                                $op = '';
                                            }

                                        ?>
                                            <option value="<?php echo $city->m_city_id; ?>" <?= $op ?>><?php echo $city->m_city_name . ' | ' . $city->m_state_name; ?></option>
                                        <?php
                                        }

                                        ?>

                                    </select>
                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#addcityModal" type="button" style="margin-top: 25px;height: 40px;background: #8d8d8d;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Pin Code</label>
                                    <input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="m_plot_pincode" id="m_plot_pincode" class="form-control" placeholder="Enter Pincode" value="<?= $pincode; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="m_plot_address" id="m_plot_address" class="form-control" placeholder="Enter Address" value="<?= $address; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input type="checkbox" <?php if (!empty($is_adhar_rcvd)) {
                                                                echo 'checked';
                                                            } ?> class="form-check-input" id="is_adhar_rcvd" name="is_adhar_rcvd">
                                    <label class="form-check-label" for="is_adhar_rcvd">Is Aadhar Rcvd ?</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Aadhar Number</label>
                                    <input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="12" minlength="12" name="m_plot_aadhar_no" id="m_plot_aadhar_no" class="form-control" value="<?= $aadhar_no; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input type="checkbox" <?php if (!empty($reg_paper_rcvd)) {
                                                                echo 'checked';
                                                            } ?> class="form-check-input" id="reg_paper_rcvd" name="reg_paper_rcvd">
                                    <label class="form-check-label" for="reg_paper_rcvd"> Reg Paper Rcvd ?</label>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Attach Registry</label>
                                    <input type="file" name="m_plot_registry" id="m_plot_registry" class="form-control">
                                    <input type="hidden" name="m_plot_registry1" id="m_plot_registry1" class="form-control" value="<?= $registry; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Attach Docs</label>
                                    <input type="file" name="m_plot_docs" id="m_plot_docs" class="form-control">
                                    <input type="hidden" name="m_plot_docs1" id="m_plot_docs1" class="form-control" value="<?= $docs; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remark</label>
                                    <input type="text" name="m_plot_remark" id="m_plot_remark" class="form-control" value="<?= $pan_no; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Emergency Contact</label>
                                    <input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10" minlength="10" name="m_plot_emcontact_no" id="m_plot_emcontact_no" class="form-control" value="<?= $emcontact_no; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Emergency Name</label>
                                    <input type="text" name="m_plot_emname" id="m_plot_emname" class="form-control" value="<?= $emname; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Emergency Relation</label>
                                    <input type="text" name="m_plot_emrelation" id="m_plot_emrelation" class="form-control" value="<?= $emrelation; ?>">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>List of 4 Sponsered Members</label>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th width="1%">Sn</th>
                                        <th>Member Name </th>
                                        <th>Aadhar No </th>
                                        <th>Mobile </th>
                                        <th>Whatsapp </th>
                                        <th>Attach Photo</th>
                                        <th>Attach Docs</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <?php


                                        if (!empty($edit_mem)) {
                                            $j = 0;
                                            foreach ($edit_mem as $key) {
                                                if ($key->p_member_image != '' && $key->p_member_image != null) {
                                                    $btncls = 'btn-success';
                                                    $btntext = 'Change Image';
                                                } else {
                                                    $btncls = 'btn-primary';
                                                    $btntext = 'Open Camera';
                                                }

                                                if ($key->p_member_status == 0) {
                                                    $candiv = ' <td><button class="btn btn-info reactive-member" data-value="' . $key->p_member_id . '" title="Click to Re-Active" data-toggle="tooltip">Re-Active</button></td>';
                                                } else {
                                                    $candiv = '<td></td>';
                                                }

                                                echo ' <tr>
                                                <td>' . ($j + 1) . '</td>
                                                <td><input type="text" id="p_member_name' . $key->p_member_id . '" name="p_member_name[]" value="' . $key->p_member_name . '"> <input type="hidden" name="p_member_id[]" value="' . $key->p_member_id . '"></td>
                                                <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="12" minlength="12" name="p_member_adharno[]" value="' . $key->p_member_adharno . '" ></td>
                                                <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10" minlength="10" name="p_member_mobileno[]" value="' . $key->p_member_mobileno . '" ></td>
                                                <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10" minlength="10" name="p_member_whatapp[]" value="' . $key->p_member_whatapp . '" ></td>
                                                <td><button type="button" class="btn ' . $btncls . ' btn-sm" onclick="opencamera(' . $key->p_member_id . ')" id="camera_btn' . $key->p_member_id . '" >' . $btntext . '</button><input type="hidden" id="p_member_image' . $key->p_member_id . '" name="p_member_image1[]" value="' . $key->p_member_image . '"> <button type="button" class="btn btn-info uploadImagebtn" data-count="' . $key->p_member_id . '" >Upload from System</button>
                                                <input id="uploadImage' . $key->p_member_id . '" type="file" name="p_member_imae[]" style="display:none" ></td>
                                                <td><input type="file" name="p_member_docs[]"><input type="hidden" name="p_member_docs1[]" value="' . $key->p_member_docs . '"> </td>
                                               ' . $candiv . '
                                            </tr>';
                                                $j++;
                                            }
                                            if (count($edit_mem) < 4) {
                                                for ($r2 = 0; $r2 < (4 - count($edit_mem)); $r2++) {

                                                    echo '<tr>
                                            <td>' . ($j + $r2 + 1) . '</td>
                                            <td><input type="text" id="p_member_name' . ($j + $r2) . '" name="p_member_name[]"> <input type="hidden" name="p_member_id[]"></td>
                                            <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="12" minlength="12" name="p_member_adharno[]"></td>
                                            <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10" minlength="10" name="p_member_mobileno[]"></td>
                                            <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10" minlength="10" name="p_member_whatapp[]"></td>
                                            <td><button type="button" class="btn btn-primary btn-sm" onclick="opencamera(' . ($j + $r2) . ')" id="camera_btn' . ($j + $r2) . '" >Open Camera </button><input type="hidden" id="p_member_image' . ($j + $r2) . '" name="p_member_image1[]">                               <button type="button" class="btn btn-info uploadImagebtn" data-count="' . ($j + $r2) . '" >Upload from System</button>
                                            <input id="uploadImage' . ($j + $r2) . '" type="file" name="p_member_imae[]" style="display:none" ></td>
                                            <td><input type="file" name="p_member_docs[]"><input type="hidden" name="p_member_docs1[]"> </td>
                                            <td></td>
                                        </tr>';
                                                }
                                            }
                                        } else {



                                            $rows = 4;
                                            for ($i = 0; $i < $rows; $i++) { ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><input type="text" id="p_member_name<?= ($i) ?>" name="p_member_name[]"> <input type="hidden" name="p_member_id[]"></td>
                                                    <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="12" minlength="12" name="p_member_adharno[]"></td>
                                                    <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10" minlength="10" name="p_member_mobileno[]"></td>
                                                    <td><input type="tel" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" maxlength="10" minlength="10" name="p_member_whatapp[]"></td>
                                                    <td><button type="button" class="btn btn-primary btn-sm" onclick="opencamera('<?= $i ?>')" id="camera_btn<?= $i ?>">Open Camera </button> <input type="hidden" id="p_member_image<?= ($i) ?>" name="p_member_image1[]">
                                                        <button type="button" class="btn btn-info uploadImagebtn" data-count="<?= ($i) ?>">Upload from System</button>
                                                        <input id="uploadImage<?= ($i) ?>" type="file" name="p_member_imae[]" style="display:none">
                                                    </td>

                                                    <td><input type="file" name="p_member_docs[]"><input type="hidden" name="p_member_docs1[]"> </td>
                                                </tr>
                                        <?php }
                                        } ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <!---------------5th row completed--------------->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-layout-submit">
                                    <button type="submit" id="btn-add-plot" class="btn btn-block btn-info"> Submit</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php if (!empty($id)) { ?>
                                    <div class="form-layout-submit"><a href="<?php echo site_url('Shop/plot_list'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                    <?php } else { ?>
                                        <div class="form-layout-submit"><a href="<?php echo site_url('Shop/add_plot'); ?>" class="btn btn-block btn-danger">Reset</a>
                                        <?php } ?>
                                        </div>
                                    </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!--- opencamera model-->
<div id="opencameraModal" class="modal fade opencameraModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="camera_title"></h4>
            </div>
            <form method="POST" id="frm-lockerrefund" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            <video id="video" width="512px" height="512px" autoplay></video>
                            <canvas id="canvas" width="512px" height="512px" style="display:none;"></canvas>
                        </div>
                        <div class="col-md-12" style="text-align: center; margin-bottom:10px">
                            <input type="hidden" class="unique_perid">
                            <button class="btn btn-success" id="captureBtn" type="button" style="padding: 15px 20px; font-size: large;">Capture</button>
                        </div>

                    </div>

                </div>

            </form>
        </div>
    </div>
</div>
<!--- opencamera model-->

<!--- preview model-->
<div id="mypreviewModal" class="modal fade mypreviewModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="preview_title"></h4>
            </div>

            <div class="modal-body">
                <img src="" alt="" id="preview_image">
                <input type="hidden" id="image_input">
                <input type="hidden" class="unique_perid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnretake">Re Take</button>
                <button type="button" class="btn btn-success" id="btn-lockerrefund">Save</button>
            </div>

        </div>
    </div>
</div>
<!--- preview model-->

<!-- ========================/View=================Fix======= -->
<?php $this->view('top_footer');
$this->view('js/js_vendor');
$this->view('js/common_js');
?>

<script>
    $('.uploadImagebtn').click(function() {
        var coun = $(this).data('count');
        $("#uploadImage" + coun).trigger('click');
        return false;
    });

    function opencamera(id) {
        var name = $('#p_member_name' + id).val();
        $('#camera_title').html(name);
        $('#preview_title').html('Preview - ' + name);
        $('.unique_perid').val(id);
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
                    $('#mypreviewModal').modal('show');

                    // Send the captured image to the server

                });
            })
            .catch(error => {
                console.error('Error accessing webcam:', error);
            });

    }


    $('#btn-lockerrefund').click(function(e) {
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
                    var unid = $('.unique_perid').val();

                    $('#p_member_image' + unid).val(data.filename);
                    $('#opencameraModal').modal('hide');
                    $('#mypreviewModal').modal('hide');
                    $('#camera_btn' + unid).html('Change Image').removeClass('btn-primary').addClass('btn-success');
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

    $('#btnretake').click(function(e) {
        $('#opencameraModal').modal('show');
    });
</script>