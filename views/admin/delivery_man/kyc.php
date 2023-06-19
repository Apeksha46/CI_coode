<div id="page-wrapper">
	<div class="header"> 
        <h1 class="page-header">
            Kyc<small>Xiri</small>
        </h1>
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
			<li class="active">Kyc</li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <?php
        // print_r($tableData);exit;
    ?>
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <?php
                    if (!empty($tableData)) { ?>
                        
                        <div class="col-md-6">
                                <button class="btn btn-primary" onclick="changeStatus('<?php echo $tableData[0]["driver_id"]; ?>','1')" type="button" value="Approved Kyc" name="approve">Approved Kyc</button>
                        </div>
                        <div class="col-md-6">
                            <button onclick="changeStatus('<?php echo $tableData[0]["driver_id"]; ?>','2')" class="btn btn-danger" type="button" value="Reject Kyc" name="reject">Reject Kyc</button>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Kyc
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Kyc Name</th>
                                        <th>Kyc document</th>
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
                                                <td><?php echo $key['other_kyc_name']; ?></td>
                                                <?php
                                                    if (!empty($key['other_kyc_document'])) { ?>
                                                        <td><img src="<?php echo base_url().'delivery_man/delivery_man_kyc/'.$key['other_kyc_document']; ?>" height="30px" width="30px"></td>
                                                    <?php }else{
                                                        echo "<td></td>";
                                                    }
                                                ?>
                                                
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
    function changeStatus(driver_ids,statuss){
        var driver_id = driver_ids;
        var status = statuss;
        $.ajax({
            url: '<?php echo site_url("admin/Delivery_man/changeStatus"); ?>',
            type: "POST",
            data: {
                "driver_id" : driver_id,
                "status"    : status
            },
            success: function (response) {
                // console.log(response)
                if (response == '1') {
                    window.location.href = '<?php echo site_url("admin/Delivery_man");?>';
                } else {
                    location.reload();   
                }
            }
        });
    }
</script>