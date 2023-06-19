
<div id="page-wrapper">
    <div class="header">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
            <li><a href="<?php echo site_url('admin/User/seller');?>">Seller</a></li>
            <!-- <li><a href="#">Profile</a></li> -->
            <li class="active">Seller Product</li>
            <li></li>
        </ol>           
    </div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="container">
                            <div class="row">
                                <?php
                                    if (count($images)>0) {
                                        foreach ($images as $key) { ?>
                                            <div class="col-md-4 col-xs-6">
                                                <img src="<?php echo base_url().'product/'.$key['image']; ?>" class="img-responsive img-thumbnail">
                                            </div>
                                        <?php }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>
</div>