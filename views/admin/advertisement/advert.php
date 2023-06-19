<div id="page-wrapper">
	<div class="header"> 
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
			<li class="active">Advertisement</li>
            <li style="float: right"><a class="btn btn-primary" href="<?php echo site_url('admin/Advertisement/add_advert');?>">Add Advertisement</a></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Advertisement
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover tableExport" >
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Plan</th>
                                        <th>Seller</th>
                                        <th>Advertisement</th>
                                        <th>Advertisement Description</th>
                                        <th>Advertisement Image</th>
                                        <th>Expiry Date</th>
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
                                                <td><?php echo $key['plan_name']; ?></td>
                                                <td><?php echo $key['seller_business_name'].'( '.$key['seller_business_address'].' )'; ?></td>
                                                <td><?php echo $key['advert_name']; ?></td>
                                                <td><?php echo $key['advert_desc']; ?></td>
                                                <?php
                                                    if(empty($key['advert_profile'])){ ?>
                                                        <td></td>
                                                    <?php }else{ ?>
                                                        <td><img src="<?php echo base_url().'advertisement/'.$key['advert_profile']; ?>" height="30px" width="30px"></td>
                                                    <?php } ?>
                                                
                                                <td><?php echo date('Y-m-d',strtotime($key['from_date'])).' - '.date('Y-m-d',strtotime($key['to_date'])); ?></td>
                                                <td class="center">
                                                    <a class="btn btn-sm btn-primary" href="<?php echo site_url('admin/Advertisement/edit_advert/'.$key["advert_id"]);?>">Edit</a>
                                                    <a class="btn btn-sm btn-danger" onclick="delteFunction('<?php echo $key["advert_id"] ;?>')">Delete</a>
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
                url: '<?php echo site_url("admin/Advertisement/delete_advert"); ?>',
                type: "POST",
                data: {
                    "advert_id" : val
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Advertisement!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Advertisement!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>