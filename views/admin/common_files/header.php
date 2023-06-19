<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="shortcut icon" type="img/icon" href="http://18.191.152.224/bright_future/assets/img/favicon.png"/> -->
	<meta content="" name="description" />
    <meta content="webthemez" name="author" />
    <title>Dashboard | Small Bazar</title>
	<!-- Bootstrap Styles-->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="<?php echo base_url(); ?>assets/css/custom-styles.css" rel="stylesheet" />
     <!-- TABLE STYLES-->
    <link href="<?php echo base_url(); ?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" >
    <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <style type="text/css">
       /* CSS used here will be applied after bootstrap.css */
        .badge-notify{
           background:red;
           position:relative;
           top: -13px;
           left: 28px;
        }
   </style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sidebar-collapse" aria-expanded="true"> 
                    <span class="sr-only">Toggle navigation</span> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span> 
                </button>

                <a class="navbar-brand" href="<?php echo site_url('admin/dashboard'); ?>">
                    <img src="<?php echo base_url(); ?>assets/img/white-logo.png" class="img-responsive"></a>
			<!-- 	<div id="sideNav" href="#">
		<i class="fa fa-bars icon"></i> 
		</div> -->
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <!-- <?php echo site_url('admin/Dashboard/notification')?> -->
                    <a class="dropdown-toggle" href="#" id="notify">
                        <!-- <span class="badge badge-notify">3</span>
                        <i class="fa fa-bell fa-fw"></i>  -->
                        <!-- <i class="fa fa-caret-down"></i> -->
                    </a>
                    <!-- <ul class="dropdown-menu dropdown-alerts">
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul> -->
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url('admin/Dashboard/show_profile');?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <!-- <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a> -->
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('admin/Dashboard/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // setInterval(function(){ notification(); }, 1000);
        // setTimeout(notification, 1000);
    });
    function notification() {
        // console.log('Hello');
        $.ajax({
            url: '<?php echo site_url("admin/Dashboard/count_notification"); ?>',
            type: "POST",
            // data: {
            //     "Notification_id" : val
            // },
            success: function (response) {
                // console.log(response);
                $('#notify').html('<span class="badge badge-notify">'+response+'</span><i class="fa fa-bell fa-fw"></i> ');
            }
        });
    }
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if ((charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>