
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="" name="description" />
        <meta content="webthemez" name="author" />
        <!-- <link rel="shortcut icon" type="img/icon" href="<?php echo base_url(); ?>assets/img/"/> -->

        <title>Terms And Conditions | Small-Bazar</title>
        <!-- Bootstrap Styles-->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
         <!-- FontAwesome Styles-->
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
            <!-- Custom Styles-->
        <link href="<?php echo base_url(); ?>assets/css/custom-styles.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" />
         <!-- TABLE STYLES-->
         <!-- Google Fonts-->
       <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
      
    </head>
    <body style="background-color: white;">
        <div id="wrapper" class="termCondition" style="background-color: #f4f4f4">
            <!-- <nav class="navbar navbar-default top-navbar" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo site_url('Dashboard'); ?>" style=" margin-bottom: 7px;">
                        <img src="<?php echo base_url(); ?>assets/img/logo.png" class="img-responsive" >
                    </a>
                </div>
            </nav> -->
            <div class="blend-space">
                <div class="about_us">
                    <?php 
                    	// print_r($arr);exit;
                        if (!empty($arr['title'])) 
                        { 
                            echo '<h1>'.$arr['title'].'</h1>'; 
                        } 
                    ?>
                    <?php 
                        if (!empty($arr['content'])) 
                        { 
                            echo $arr['content']; 
                        } 
                    ?>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</html>