<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li class="active">Contact</li>
            <li></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Contact
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Query</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // print_r($tableData);
                                        $i = 1;
                                        foreach ($tableData as $key) { 
                                            // print_r($key['about_us_id']);
                                            // echo $url = site_url('admin/about_us/edit_about_us/'.$key["about_us_id"]);
                                            ?>
                                            <tr class="gradeC">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $key['name']; ?></td>
                                                <td><?php echo $key['mobile']; ?></td>
                                                <td><?php echo $key['email']; ?></td>
                                                <td><?php echo $key['query']; ?></td>
                                                <td><?php echo $key['created_at']; ?></td>
                                            </tr>
                                       <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>