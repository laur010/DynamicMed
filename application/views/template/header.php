<!doctype html>
<html class="no-js " lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
  <title>Dashboard</title>
  <link rel="icon" href="<?php echo base_url();?>theme/favicon.ico" type="image/x-icon"> <!-- Favicon-->

  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/morrisjs/morris.min.css" />
  <!-- Custom Css -->

  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/sweetalert/sweetalert.css"/>

  <!-- Colorpicker Css -->
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
  <!-- Multi Select Css -->
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/multi-select/css/multi-select.css">
  <!-- Bootstrap Spinner Css -->
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/jquery-spinner/css/bootstrap-spinner.css">
  <!-- Bootstrap Tagsinput Css -->
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
  <!-- Bootstrap Select Css -->
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/bootstrap-select/css/bootstrap-select.css" />

  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/css/timeline.css">
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/css/color_skins.css">

  <!-- Bootstrap Material Datetime Picker Css -->
  <link href="<?php echo base_url();?>theme/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

  <!-- Light Gallery Plugin Css -->
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/light-gallery/css/lightgallery.css">

  <!-- Dropzone Css -->
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/dropzone/dropzone.css">

  <link rel="stylesheet" href="<?php echo base_url();?>theme/inspina/js/jqgrid-5.1.0/css/ui.jqgrid.css" type="text/css" media="screen" title="default" />
  <link rel="stylesheet" href="<?php echo base_url();?>theme/inspina/js/jqgrid-5.1.0/css/ui.jqgrid-bootstrap-ui.css" type="text/css" media="screen" title="default" />
  <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>theme/custom_jq/jquery-ui.css' />

  <!-- Morris Css -->
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/plugins/morrisjs/morris.min.css" />

  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/css/main.css">
  <link rel="stylesheet" href="<?php echo base_url();?>theme/assets/css/color_skins.css">

</head>
<body class="theme-cyan">
<!-- Page Loader -->
<div class="page-loader-wrapper">
  <div class="loader">
    <div class="m-t-30"><img class="zmdi-hc-spin" src="<?php echo base_url();?>theme/assets/images/logo.svg" width="48" height="48" alt="Compass"></div>
    <p>Please wait...</p>
  </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>




<!-- Top Bar -->
<nav class="navbar">
  <div class="col-12">
    <div class="navbar-header">
      <a href="javascript:void(0);" class="bars"></a>
      <a class="navbar-brand" href="<?php echo base_url();?>dashboard"><img src="<?php echo base_url();?>theme/assets/images/logo.svg" width="30" alt="Compass"><span class="m-l-10">CTL</span></a>
    </div>
    <ul class="nav navbar-nav navbar-left">
      <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
      <li class="hidden-sm-down">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Cauta...">
          <span class="input-group-addon">
              <i class="zmdi zmdi-search"></i>
          </span>
        </div>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"> <a href="javascript:void(0);" id="notifications" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i>
          <div class="notify">
            <span id="span1" class="<?php if ($user_notifications['active']) echo "heartbit";?>" ></span>
            <span id="span2" class="<?php if ($user_notifications['active']) echo "point";?>"></span>
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-right slideDown">
          <li class="header">NOTIFICATIONS</li>
          <li class="body">
            <ul class="menu list-unstyled">
              <?php foreach ($user_notifications['rows'] as $notification):?>
              <li>
                <a href="javascript:void(0);">
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <div class="icon-circle <?php echo get_notification_type($notification['class_type'])['div_class'];?>">
                        <i class="<?php echo get_notification_type($notification['class_type'])['icon_class'];?>"></i>
                      </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="menu-info">
                        <h4><?php echo $notification['message'];?></h4>
                        <p><i class="zmdi zmdi-time"></i> <?php echo $notification['timestamp'];?></p>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
              <?php endforeach;?>
            </ul>
          </li>
          <li class="footer"> <a href="javascript:void(0);">View All Notifications</a> </li>
        </ul>
      </li>
      <li>
        <a href="javascript:void(0);" class="fullscreen hidden-sm-down" data-provide="fullscreen" data-close="true"><i class="zmdi zmdi-fullscreen"></i></a>
      </li>
      <li><a href="<?php echo base_url();?>account/logout" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a></li>
    </ul>
  </div>
</nav>

<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
  <div class="menu">
    <ul class="list">
      <li>
        <div class="user-info">
          <div class="image"><a href="<?php echo base_url();?>profile"><img src="<?php echo base_url();?>upload/profile_images/<?php echo $active_image['name'];?>" alt="User"></a></div>
          <div class="detail">
            <h4><?php echo $name?></h4>
            <small><?php echo $user_role;?></small>
          </div>
          <a href="#" title="Events"><i class="zmdi zmdi-calendar"></i></a>
          <a href="#" title="Inbox"><i class="zmdi zmdi-email"></i></a>
          <a href="#" title="Contact List"><i class="zmdi zmdi-account-box-phone"></i></a>
          <a href="#" title="Chat App"><i class="zmdi zmdi-comments"></i></a>
        </div>
      </li>
      <?php echo $menu;?>
    </ul>
  </div>
</aside>




<script async="" src="https://www.google-analytics.com/analytics.js"></script>
<script src="<?php echo base_url();?>theme/assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
<script src="<?php echo base_url();?>theme/assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="<?php echo base_url();?>theme/assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob Plugin Js -->

<script>

  jQuery(document).ready(function () {

    jQuery('#notifications').click( function(e) {
      e.preventDefault();
      document.getElementById('span1').className = '';
      document.getElementById('span2').className = '';

      jQuery.ajax({
        type: 'POST',
        data: {
          "operation": 'set_inactive'
        },
        url: '<?php echo base_url();?>notifications/process_request',
        dataType: 'json',
        success: function (data) {
          return data.code == 1;
        }
      });
    });
  });

</script>




<!--<script src="--><?php //echo base_url();?><!--theme/assets/js/Date.format.min.js"></script>-->
<!--<script src="--><?php //echo base_url();?><!--theme/assets/js/dateFormat.min.js"></script>-->


<script src="<?php echo base_url();?>theme/assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/dropzone/dropzone.js"></script> <!-- Dropzone Plugin Js -->

<script src="<?php echo base_url();?>theme/assets/plugins/light-gallery/js/lightgallery-all.min.js"></script> <!-- Light Gallery Plugin Js -->

<script src="<?php echo base_url();?>theme/assets/plugins/momentjs/moment.js"></script> <!-- Moment Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<script src="<?php echo base_url();?>theme/assets/bundles/morrisscripts.bundle.js"></script> <!-- Morris Plugin Js -->

<script src="<?php echo base_url();?>theme/assets/plugins/chartjs/Chart.bundle.js"></script> <!-- Chart Plugins Js -->

<script src="<?php echo base_url();?>theme/assets/bundles/mainscripts.bundle.js"></script>
<script src="<?php echo base_url();?>theme/assets/js/pages/forms/basic-form-elements.js"></script>
<script src="<?php echo base_url();?>theme/assets/js/pages/charts/jquery-knob.js"></script>

<script src="<?php echo base_url();?>theme/assets/js/pages/ui/dialogs.js"></script>

<!--  <script src="https://code.jquery.com/jquery.js"></script>-->
<!--  <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>-->
<!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
<!--<script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>-->
<!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>-->




<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/plugins/css-element-queries/ResizeSensor.js"></script>-->
<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/plugins/css-element-queries/ElementQueries.js"></script>-->
<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/jquery-ui/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>-->
<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/bootstrap.min.js"></script>-->
<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/plugins/metisMenu/jquery.metisMenu.js"></script>-->
<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>-->
<!---->
<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/plugins/jquery-ui/jquery-ui.min.js"></script>-->
<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/jquery-ui/jquery-ui.js" type="text/javascript"></script>-->
<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/jquery-ui/ui.helper.js" type="text/javascript" charset="utf-8"></script>-->
<!---->
<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/jqgrid-5.1.0/js/i18n/grid.locale-en.js" type="text/javascript" charset="utf-8"></script>-->
<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/jqgrid-5.1.0/js/jquery.jqGrid.min.js" type="text/javascript" charset="utf-8"></script>-->
<!--<script src="--><?php //echo base_url();?><!--theme/inspina/js/jqgrid-5.1.0/plugins/jquery.contextmenu.js" type="text/javascript" charset="utf-8"></script>-->




