<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
			<li class="active">Sale</li>
            <li style="float: right"><a class="btn btn-primary" href="<?php echo site_url('admin/Sale/add_sale');?>">Add Sale</a></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Sale
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Sale Title</th>
                                        <th>Sale</th>
                                        <th>Start Sale</th>
                                        <th>End Sale</th>
                                        <th>Banner</th>
                                        <th>Action</th>
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
                                                <td><?php echo $key['sale_title']; ?></td>
                                                <td><?php echo $key['sale_desc']; ?></td>
                                                <td><?php echo $key['start_date']; ?></td>
                                                <td><?php echo $key['end_date']; ?></td>
                                                <?php
                                                    if (!empty($key['sale_banner'])) { ?>
                                                        <td><img src="<?php echo $key['sale_banner']; ?>" height="30px" width="30px"></td>
                                                        
                                                    <?php }else{
                                                        echo "<td></td>";
                                                    }
                                                ?>
                                                <td class="center">
                                                    <a class="btn btn-primary" href="<?php echo site_url('admin/Sale/edit_sale/'.$key["sale_id"]);?>">Edit</a>
                                                    <a class="btn btn-danger" onclick="delteFunction('<?php echo $key["sale_id"] ;?>')">Delete</a>
                                                    <a class="btn btn-warning" href="<?php echo site_url('admin/Sale/participate_seller/'.$key["sale_id"]);?>">Participate Seller</a>

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
    function delteFunction(val){
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: '<?php echo site_url("admin/Sale/delete_sale"); ?>',
                type: "POST",
                data: {
                    "sale_id" : val
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Sale!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Sale!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>