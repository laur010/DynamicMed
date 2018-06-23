<!doctype html>
<html class="no-js " lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

  <title>Login</title>
  <!-- Favicon-->
  <link rel="icon" href="<?php echo base_url();?>theme/favicon.ico" type="image/x-icon">
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/css/main.css">
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/css/authentication.css">
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/css/color_skins.css">
</head>

<body class="theme-cyan authentication sidebar-collapse">
<div class="page-header">
  <div class="page-header-image" style="background-image:url(<?php echo base_url();?>theme/assets/images/login.jpg)"></div>
  <div class="container">
    <div class="col-md-12 content-center">
      <div class="card-plain">
        <?php echo form_open(base_url().'login/do_login');?>
          <div class="header">
            <div class="logo-container">
              <img src="<?php echo base_url();?>theme/assets/images/logo.svg" alt="">
            </div>
            <h5>Log in</h5>
          </div>
          <div class="content">
            <div class="input-group input-lg">
              <input type="text" class="form-control" name="username" placeholder="Enter User Name">
              <span class="input-group-addon">
                <i class="zmdi zmdi-account-circle"></i>
              </span>
            </div>
            <div class="input-group input-lg">
              <input type="password" placeholder="Password" name="password" class="form-control" />
              <span class="input-group-addon">
                <i class="zmdi zmdi-lock"></i>
              </span>
            </div>
          </div>
          <div class="footer text-center">
            <button class="btn l-cyan btn-round btn-lg btn-block waves-effect waves-light">SIGN IN</button>
            <h6 class="m-t-20"><a href="" class="link">Forgot Password?</a></h6>
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="container">
      <nav>
        <ul>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
      </nav>
      <div class="copyright">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>,
        <span>Designed by <a href="#" target="_blank">CTL Company</a></span>
      </div>
    </div>
  </footer>
</div>

<!-- Jquery Core Js -->
<script src="<?php echo base_url();?>theme/assets/bundles/libscripts.bundle.js"></script>
<script src="<?php echo base_url();?>theme/assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

<script>
  //=============================================================================
  $('.form-control').on("focus", function() {
    $(this).parent('.input-group').addClass("input-group-focus");
  }).on("blur", function() {
    $(this).parent(".input-group").removeClass("input-group-focus");
  });
</script>
</body>
</html>