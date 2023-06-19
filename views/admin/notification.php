<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('seller/Dashboard');?>">Home</a></li>
			<li class="active">Notification</li>
            <li></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12" style="float: right">
                        <button class="btn-btn-danger" onclick="delteFunction();">Delete All</button>
                    </div>
                </div>
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Notification
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Customer Profile</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // print_r($tableData);
                                        $i = 1;
                                        if (!empty($tableData)) {
                                            # code...
                                        foreach ($tableData as $key) { 
                                            // print_r($key['about_us_id']);
                                            // echo $url = site_url('admin/about_us/edit_about_us/'.$key["about_us_id"]);
                                            ?>
                                            <tr class="gradeC">
                                                <!-- <td><?php echo $i; ?></td> -->
                                                <td><?php echo $key['notification_id']; ?></td>
                                                <?php 
                                                    if (!empty($key['customer_profile'])) { ?>
                                                        <td><img src="<?php echo $key['customer_profile']; ?>" height = '100px'  width = '100px'></td>
                                                    <?php }else{
                                                        echo "<td></td>";
                                                    }
                                                ?>
                                                <td><?php echo $key['customer_name']; ?></td>
                                                <td><?php echo $key['product_name']; ?></td>
                                                <td><?php echo $key['title']; ?></td>
                                                <td><?php echo $key['text_message']; ?></td>
                                            </tr>
                                        <?php $i++; } 
                                        } ?>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTables-example').dataTable({
           "order": [[ 0, 'desc' ]]
        });
    });
    function delteFunction(val){
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: '<?php echo site_url("seller/Dashboard/delete_notification"); ?>',
                type: "POST",
                // data: {
                //     "Notification_id" : val
                // },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Notification!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Notification!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>