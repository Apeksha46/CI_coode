<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('seller/Dashboard');?>">Home</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
			<li class="active">Color</li>
            <li style="float: right"><a class="btn btn-primary" href="<?php echo site_url('seller/Product/addColorSize');?>">Add Color</a></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Color
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover tableExport">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Product Name</th>
                                        <th>Color Name</th>
                                        <th>Quantity</th>
                                        <th>Remaining Quantity</th>
                                        <th>Used Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // print_r($colorData);
                                        $i = 1;
                                        foreach ($colorData as $key) { 
                                            // print_r($key['about_us_id']);
                                            // echo $url = site_url('seller/about_us/edit_about_us/'.$key["about_us_id"]);
                                            ?>
                                            <tr class="gradeC">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $key['product_name']; ?></td>
                                                <td><?php echo $key['color']; ?></td>
                                                <td><?php echo $key['total_qty']; ?></td>
                                                <td><?php echo $key['remaining_qty']; ?></td>
                                                <td><?php echo $key['used_qty']; ?></td>
                                                <td class="center">
                                                    <a class="btn btn-sm btn-primary mb-2" href="<?php echo site_url('seller/Product/editColorSize/'.$key["color_id"]);?>">Edit</a>
                                                    <a class="btn btn-sm btn-danger" onclick="deleteColor('<?php echo $key["color_id"] ;?>')">Delete</a>

                                                </td>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
    function deleteColor(color_id){
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: '<?php echo site_url("seller/Product/delete_color"); ?>',
                type: "POST",
                data: {
                    "color_id" : color_id
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Color!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Color!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>