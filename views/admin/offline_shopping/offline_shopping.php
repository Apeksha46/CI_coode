<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('seller/Dashboard');?>">Home</a></li>
			<li class="active">Offline Shopping</li>
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
                        Offline Shopping
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover tableExport">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Customer Name</th>
                                        <th>Price</th>
                                        <th>Point</th>
                                        <th>Status</th>
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
                                            // echo $url = site_url('seller/about_us/edit_about_us/'.$key["about_us_id"]);
                                            ?>
                                            <tr class="gradeC">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $key['customer_name']; ?></td>
                                                <td><?php echo $key['price']; ?></td>
                                                <td><?php echo $key['point']; ?></td>
                                                <td>
                                                    <?php
                                                        if ($key['approve_status'] == 0) {
                                                            echo"<span class = 'btn btn-warning' >Pending</span>";
                                                        }else{
                                                            echo"<span class = 'btn btn-primary' >Approved</span>";
                                                        } ?>
                                                </td>
                                                <?php
                                                    if (!empty($key['photo'])) { ?>
                                                        <td><img src="<?php echo base_url().'offline_pic/'.$key['photo']; ?>" height="100px" width="100px"></td>
                                                    <?php }else{
                                                        echo "<td></td>";
                                                    }
                                                ?>

                                                <td class="center">
                                                    <?php
                                                        if ($key['approve_status'] == 0) { ?>
                                                            <a class="btn btn-danger" onclick="changeStatus('<?php echo $key["offline_shopping_id"] ;?>')">Accept</a>
                                                        <?php }
                                                    ?>
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
    function changeStatus(val){
        if (confirm('Are you sure you want to approve this?')) {
            $.ajax({
                url: '<?php echo site_url("seller/Offline/changeStatus"); ?>',
                type: "GET",
                data: {
                    "offline_shopping_id" : val
                },
                success: function (response) {
                    console.log(response);
                    if (response == "1") {
                        location.reload();
                    } 
                }
            });
        }
    }
</script>