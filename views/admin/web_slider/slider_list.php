<div id="page-wrapper">
	<div class="header"> 
        <h1 class="page-header">
            Web Slider<small>Small Bazar</small>
        </h1>
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
            <li class="active">Web Slider</li>
            <li style="float: right"><a class="btn btn-primary" href="<?php echo site_url('admin/Web_Slider/add_slider');?>">Add Web Slider</a></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Web Slider
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Slider Name</th>
                                        <th>Slider Description</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // print_r($tableData);
                                        $i = 1;
                                        foreach ($tableData as $key) {  ?>
                                            <tr class="gradeC">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $key['slider_title']; ?></td>
                                                <td><?php echo $key['slider_desc']; ?></td>
                                                <?php
                                                    if (!empty($key['slider_img'])) { ?>
                                                        <td><img src="<?php echo base_url().'slider/'.$key['slider_img']; ?>" height="30px" width="30px"></td>
                                                    <?php }else{
                                                        echo "<td></td>";
                                                    }
                                                ?>
                                                <td class="center">
                                                    <a class="btn btn-primary" href="<?php echo site_url('admin/Web_Slider/edit_slider/'.$key["slider_id"]);?>">Edit</a>
                                                    <a class="btn btn-danger" onclick="delteFunction('<?php echo $key["slider_id"] ;?>')">Delete</a>

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
                url: '<?php echo site_url("admin/Web_Slider/delete_slider"); ?>',
                type: "POST",
                data: {
                    "slider_id" : val
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Web Slider!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Web Slider!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>