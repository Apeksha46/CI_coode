<div id="page-wrapper">
	<div class="header"> 
        <h1 class="page-header">
            User<small>Small Bazar</small>
        </h1>
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
			<li class="active">User</li>
		</ol> 			
	</div>

    <!-- /. PAGE INNER  -->
    <div id="page-inner" class="scrollbar  download-earning-box panel">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        User Refer List
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <ul class="list-group alt">
                            <!-- Level 1 -->
                            <div class="col-lg-3 col-sm-12 col-md-3 col-sm-12 col-md-3">
                                <section class="panel panel-default">
                                    <div class="panel-body">
                                        <h4>Level 1</h4>
                                        <ul class="list-group-category">
                                            <?php
                                                
                                                $levelOne = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $tableData->referal_code),'user');
                                                // print_r($levelOne);die;
                                                  $i = 1;  
                                                foreach ($levelOne as $key => $value) {
                                            ?>

                                                <li class="list-group-item">
                                                    <div class="media">
                                                        <div class="pull-right text-$status m-t-sm">
                                                            <i class='fa fa-circle'></i>
                                                        </div> 
                                                        <div class="media-body">
                                                            <div>
                                                                <?php echo $i; ?>
                                                                <a target="_blank" href='<?php echo base_url()."admin/User/refer_list/".$value['user_id'] ; ?>'><?php echo $value["first_name"]?> <?php echo $value["last_name"]?></a>
                                                            </div>
                                                            <small class="text-muted">
                                                                 Unique Id  : <?php echo $value["unique_package_id"]?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php }?>
                                        </ul>
                                  
                                    </div>
                                </section>
                            </div>
                            

                            <!-- Level 2 -->
                            <div class="col-lg-3 col-sm-12 col-md-3 col-sm-12 col-md-3">
                                <section class="panel panel-default">
                                    <div class="panel-body">
                                        <h4>Level 2</h4>
                                        <ul class="list-group-category">
                                            <?php
                                                $levelOne = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $tableData->referal_code),'user');

                                                foreach ($levelOne as $key => $value) 
                                                {
                                                    $levelTwo = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');
                                                    foreach ($levelTwo as $key => $value) {
                                                    $i = 1;  
                                            ?>

                                                <li class="list-group-item">
                                                    <div class="media">
                                                        <div class="pull-right text-$status m-t-sm">
                                                            <i class='fa fa-circle'></i>
                                                        </div> 
                                                        <div class="media-body">
                                                            <div>
                                                                <?php echo $i; ?>
                                                                <a target="_blank" href='<?php echo base_url()."admin/User/refer_list/".$value['user_id'] ; ?>'><?php echo $value["first_name"]?> <?php echo $value["last_name"]?></a>
                                                            </div>
                                                            <small class="text-muted">
                                                                 Unique Id  : <?php echo $value["unique_package_id"]?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </li>

                                            <?php $i++; } }?>
                                        </ul>
                                  
                                    </div>
                                </section>
                            </div>

                            <!-- Level 3 -->
                            <div class="col-lg-3 col-sm-12 col-md-3 col-sm-12 col-md-3">
                                <section class="panel panel-default">
                                    <div class="panel-body">
                                        <h4>Level 3</h4>
                                        <ul class="list-group-category">
                                            <?php
                                                $levelOne = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $tableData->referal_code),'user');

                                                foreach ($levelOne as $key => $value) 
                                                {
                                                    $levelTwo = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');
                                                    foreach ($levelTwo as $key => $value) 
                                                    {
                                                        $levelThree = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');

                                                        foreach ($levelThree  as $key => $vTh) {
                                                            $i = 1;  
                                            ?>

                                                            <li class="list-group-item">
                                                                <div class="media">
                                                                    <div class="pull-right text-$status m-t-sm">
                                                                        <i class='fa fa-circle'></i>
                                                                    </div> 
                                                                    <div class="media-body">
                                                                        <div>
                                                                            <?php echo $i; ?>
                                                                            <a target="_blank" href='<?php echo base_url()."admin/User/refer_list/".$vTh['user_id'] ; ?>'><?php echo $vTh["first_name"]?> <?php echo $vTh["last_name"]?></a>
                                                                        </div>
                                                                        <small class="text-muted">
                                                                             Unique Id  : <?php echo $vTh["unique_package_id"]?>
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </li>

                                            <?php $i++; } } } ?>
                                        </ul>
                                    </div>
                                </section>
                            </div>

                            <!-- Level 4 -->
                            <div class="col-lg-3 col-sm-12 col-md-3 col-sm-12 col-md-3">
                                <section class="panel panel-default">
                                    <div class="panel-body">
                                        <h4>Level 4</h4>
                                        <ul class="list-group-category">
                                            <?php
                                                $levelOne = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $tableData->referal_code),'user');

                                                foreach ($levelOne as $key => $value) 
                                                {
                                                    $levelTwo = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');
                                                    foreach ($levelTwo as $key => $value) 
                                                    {
                                                        $levelThree = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');

                                                        foreach ($levelThree  as $key => $vTh) {

                                                            $levelFour = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $vTh['referal_code']),'user');

                                                            foreach ($levelFour as $key => $vFo) {
                                                            $i = 1;  
                                            ?>

                                                            <li class="list-group-item">
                                                                <div class="media">
                                                                    <div class="pull-right text-$status m-t-sm">
                                                                        <i class='fa fa-circle'></i>
                                                                    </div> 
                                                                    <div class="media-body">
                                                                        <div>
                                                                            <?php echo $i; ?>
                                                                            <a target="_blank" href='<?php echo base_url()."admin/User/refer_list/".$vFo['user_id'] ; ?>'><?php echo $vFo["first_name"]?> <?php echo $vFo["last_name"]?></a>
                                                                        </div>
                                                                        <small class="text-muted">
                                                                             Unique Id  : <?php echo $vFo["unique_package_id"]?>
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </li>

                                            <?php $i++; } } } }?>
                                        </ul>
                                    </div>
                                </section>
                            </div>

                            <!-- Level 5 -->
                            <div class="col-lg-3 col-sm-12 col-md-3 col-sm-12 col-md-3">
                                <section class="panel panel-default">
                                    <div class="panel-body">
                                        <h4>Level 5</h4>
                                        <ul class="list-group-category">
                                            <?php
                                                $levelOne = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $tableData->referal_code),'user');

                                                foreach ($levelOne as $key => $value) 
                                                {
                                                    $levelTwo = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');
                                                    foreach ($levelTwo as $key => $value) 
                                                    {
                                                        $levelThree = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $value['referal_code']),'user');

                                                        foreach ($levelThree  as $key => $vTh) {

                                                            $levelFour = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $vTh['referal_code']),'user');

                                                            foreach ($levelFour as $key => $vFo) {

                                                                 $levelFive = $this->CommonModel->selectResultDataByCondition(array('used_referal' => $vFo['referal_code']),'user');

                                                                 foreach ($levelFive as $key => $vFi) {

                                                            $i = 1;  
                                            ?>

                                                            <li class="list-group-item">
                                                                <div class="media">
                                                                    <div class="pull-right text-$status m-t-sm">
                                                                        <i class='fa fa-circle'></i>
                                                                    </div> 
                                                                    <div class="media-body">
                                                                        <div>
                                                                            <?php echo $i; ?>
                                                                            <a target="_blank" href='<?php echo base_url()."admin/User/refer_list/".$vFi['user_id'] ; ?>'><?php echo $vFi["first_name"]?> <?php echo $vFi["last_name"]?></a>
                                                                        </div>
                                                                        <small class="text-muted">
                                                                             Unique Id  : <?php echo $vFi["unique_package_id"]?>
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </li>

                                            <?php $i++; } } } } } ?>
                                        </ul>
                                    </div>
                                </section>
                            </div>
                            
                            <!-- End Fetching Downline Of User-->
                        </ul>
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>
</div>