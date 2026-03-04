<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Login" />
  <meta name="keywords" content="Login" />
  <meta name="author" content="Logixhunt">
  <!-- Title -->

  <title><?php echo (!empty($pagename)) ? $pagename : 'Login' ; ?></title>
  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="32x32" href="">
  <?php 
  echo  link_tag('assets/css/animate.min.css');
  echo  link_tag('assets/plugins/bootstrap/bootstrap.min.css');
  echo  link_tag('assets/plugins/font-awesome/font-awesome.min.css');
  echo  link_tag('assets/plugins/themify-icons/themify-icons.css');
  echo  link_tag('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css');
  echo  link_tag('assets/css/seipkon.css');
  echo  link_tag('assets/css/responsive.css');
  ?>
<style type="text/css">
.alert{ padding: 1px;margin-top: 15px;border: 2px solid;border-color: #fc0029; }
.alert i{ color: yellow;background: black;font-size: 18px;padding: 7px;border: 2px solid white; }

<?php if($this->session->flashdata('status') == "fail"){ ?>
   .icon_input .input-icon {    right: 14%; position: absolute; top: 55%; font-size: 14px; cursor: pointer; } <?php }else{ ?>
   .icon_input .input-icon {    right: 14%; position: absolute; top: 55%; font-size: 14px; cursor: pointer; } <?php } ?>
    
.icon_input .icon-input { padding-right: 10% !important; } 

.btn {
  border: 1px solid white;
  outline: 1px solid white;
  box-shadow: 0 0 5px 0px black;
  padding: 8px;
  line-height: 20px;
}

.login-form-box>h3 {
  color: white;
  border-bottom-style:double; 
}

.login-form-box {
  background: #00B4DB;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #0083B0, #00B4DB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}

label {
  color: white;
}



button.btn-action{ padding: 3px 0px 3px 5px; text-align: center; font-size: 20px; }

.login-form-box {
  border: 0px;
  box-shadow: 0 0 0px; 
}

.form-group .form-control {
  border-radius: 100px;
}

.btn {
   border: 0px;
   outline: 0px;
    padding: 8px;
    line-height: 20px;
    box-shadow: 0px 0px;
    border-radius: 100px;
    width: 50%;
    margin-left: auto;
    margin-right: auto;
    display: block;
    background: #2e3f6e;
}

.btn-success:hover, .btn-success:focus, .seipkon-btn-success:hover {
background: #2e3f6e;
}


</style>
        
</head>
<body style="background: url('<?php echo base_url('assets/img/admin_bg.svg') ?>') no-repeat; background-size: 100%;"> 
       
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- Login Page Header Area Start --
  <div class="seipkon-login-page-header-area">
    <div class="container-fluid"><div class="row"></div></div>
  </div>
  <!-- Login Page Header Area End -->

  <!-- Login Form Start -->
  <div style="padding-top: 200px;" class="seipkon-login-form-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="login-form-box">
            <h3> Login to the System</h3>
<form method="POST" action="<?php echo site_url('Login') ?>" id="frm-login">
              <div class="form-group">
                <label>Login ID</label>
    <input type="text" placeholder="Enter Login ID" class="form-control" required="true"
      name="login_id" value="<?php echo set_value('login_id'); ?>" id="login_id"
    >
    <span class="text-danger"><?php echo form_error('login_id'); ?> </span>
              </div>
              <div class="form-group">
                <label>Login Password</label>
    <span class="icon_input">   
      <input type="password" data-change="text" class="form-control icon-input" 
        required="true" placeholder="Enter Login Password"
        name="login_pass" id="login_pass" value="<?php echo set_value('login_pass'); ?>"> 
      <i 
        class='fa fa-eye fa-2x input-icon' 
        aria-hidden='true'
        data-change0='fa fa-eye' 
        data-change='fa fa-eye-slash'
        title="Click here" 
      ></i>
    </span> 
    <span class="text-danger"><?php echo form_error('login_pass'); ?> </span>
              </div>
              <div class="form-group form-checkbox">
                <input type="checkbox" id="chk_2">
    <!-- <label class="inline control-label" for="chk_2">Remember me</label> -->
    <!--<p class="lost-pass pull-right"> <a href="#">forget you password?</a> </p> -->
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <div>
    <button type="submit" id="btn-login" class="btn btn-success btn-block">Login</button>
                    </div>
                  </div>
                </div>
<?php if($this->session->flashdata('status')) echo $this->session->flashdata('status'); ?>
              </div>
</form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Form End -->
   
  <!-- jQuery -->
  <script src="<?php echo base_url('assets/js/jquery-3.1.0.min.js')?>"></script>
  <!-- Bootstrap JS -->
  <script src="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.js')?>"></script>
  <!-- Perfect Scrollbar JS -->
  <script src="<?php echo base_url('assets/plugins/perfect-scrollbar/jquery-perfect-scrollbar.min.js')?>"></script>
  <!-- Custom JS -->
  <script src="<?php echo base_url('assets/js/seipkon.js')?>"></script>
</body>
</html>

<script type="text/javascript">

$("#btn-login").on('click', function(){ var clk_btn = $(this);
  var fack_btn = '<button type="button" class="btn btn-success btn-block" disabled>Login</button>';
  clk_btn.hide(); clk_btn.before(fack_btn);
});
  
</script>
  <script>
    $(document).ready(function(){
      $(".icon_input").on('click','.input-icon', function(){
        var icon = $(this), icon_input = icon.parent('.icon_input'),
        input = icon_input.children('.icon-input');
        var pre_intype = input.attr('type'), new_intype = input.data('change');
        var pre_incon = icon.data('change0'), new_incon = icon.data('change');

        input.attr('type', new_intype);  input.data('change', pre_intype);
        icon.data('change0', new_incon); icon.data('change', pre_incon);
        icon.removeClass(pre_incon);  icon.addClass(new_incon); 

      });
    });
  
</script>