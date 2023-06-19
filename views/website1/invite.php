<style type="text/css">
  .aboutUs .about_us {    
    /* position: relative; */    
    top: 105px;    
    width: 80%;    
    margin: 0 auto;    
    background: #fff;    
    padding: 28px;    
    display: block;    
    /* float: left; */    
    height: 100%;    
    /*display: flex;*/
    overflow: hidden;
  }
  .aboutUs .about_us a.dropdown-item { float:right; color: green}
  .aboutUs .about_us a.dropdown-item i{ float:right;}

</style>
<body style="background-color: white;">
        <div id="wrapper" class="aboutUs" style="background-color: #f4f4f4">
            <!-- <nav class="navbar navbar-default top-navbar" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo site_url('Dashboard'); ?>" style=" margin-bottom: 7px;">
                        <img src="<?php echo base_url(); ?>assets/img/logo.png" class="img-responsive" >
                    </a>
                </div>
            </nav> -->
            <div class="blend-space">
              <div class="about_us">
                <h3><strong>Share & Invite</strong></h3>  <br/>
                <p>Earn guarantee  51 into your wallet</p>     
                <a href="#" class="dropdown-item" data-action="share/whatsapp/share" onclick="check()"><i class="fab fa-whatsapp fa-5x" aria-hidden="true"></i></a>       
              </div>
            </div>
        </div>
    </body>