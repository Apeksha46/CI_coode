<div id="page-wrapper">
	<div class="header"> 
        <h1 class="page-header">
            Package<small>Small Bazar</small>
        </h1>
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
            <li class="active">Package</li>
            <li style="float: right"><a class="btn btn-primary" href="<?php echo site_url('admin/Package/add_package');?>">Add Package</a></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Package
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Image</th>
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
                                                <td><?php echo $key['package_name']; ?></td>
                                                <td><?php echo $key['description']; ?></td>
                                                <td><?php echo $key['price']; ?></td>
                                                <?php
                                                    if (!empty($key['image'])) { 
                                                        $url =  base_url().'package/'.$key['image'];
                                                ?>
                                                        
                                                        <td>
                                                            <img src="<?php echo $url; ?>" height=100, width= 100 >
                                                        </td>
                                                        
                                                    <?php }else{
                                                        echo "<td></td>";
                                                    }
                                                ?>
                                                <td class="center">
                                                    <a class="btn btn-primary" href="<?php echo site_url('admin/Package/edit_package/'.$key["package_id"]);?>">Edit</a>
                                                    <a class="btn btn-danger" onclick="delteFunction('<?php echo $key["package_id"] ;?>')">Delete</a>

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
                url: '<?php echo site_url("admin/Package/delete_package"); ?>',
                type: "POST",
                data: {
                    "package_id" : val
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Package!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Package!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>