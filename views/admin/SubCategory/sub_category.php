<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<!-- <li><a href="#">Profile</a></li> -->
			<li class="active">Sub Category</li>
            <li style="float: right"><a class="btn btn-primary" href="<?php echo site_url('admin/SubCategory/add_sub_category');?>">Add Sub Category</a></li>
		</ol> 			
	</div>
    
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="form-group category-selector">
        <label for="inputEmail3" class="control-label">Category</label>
        <div class="">
            <select onchange="getSubCategory();" class="form-control" id="bjr" name="category_id">
                 <option  value="all" selected>All</option>
                <?php
                    foreach ($tableData as $key) { ?>
                        <option  value="<?php echo $key['category_id']; ?>" ><?php echo $key['category_name']; ?></option>
                    <?php }
                ?>
            </select>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Sub Category
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Sub-Category</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody  id="alldetails">
                                    <?php
                                        // print_r($tableData);
                                        $i = 1;
                                        foreach ($tableData1 as $key) { 
                                            // print_r($key['about_us_id']);
                                            // echo $url = site_url('admin/about_us/edit_about_us/'.$key["about_us_id"]);
                                            ?>
                                            <tr class="gradeC">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $key['sub_category_name']; ?></td>
                                                <?php
                                                    if (!empty($key['sub_category_image'])) { ?>
                                                        <td><img src="<?php echo base_url().'sub_category/'.$key['sub_category_image']; ?>" height="30px" width="30px"></td>
                                                    <?php }else{
                                                        echo "<td></td>";
                                                    }
                                                ?>
                                                <td class="center">
                                                    <a class="btn btn-primary" href="<?php echo site_url('admin/SubCategory/edit_sub_category/'.$key["sub_category_id"]);?>">Edit</a>
                                                    <a class="btn btn-danger" onclick="delteFunction('<?php echo $key["sub_category_id"] ;?>')">Delete</a>
                                                </td>
                                            </tr>
                                       <?php $i++; } ?>
                                </tbody>
                                <tbody id="klj">

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
    function getSubCategory(){
        var cat_id = $("#bjr").val();
        // alert(cat_id)
        if (cat_id =='all')
        {
            $("#alldetails").show();
        }
        else
        {
            $("#alldetails").hide();
        }
        $.ajax({
            url: '<?php echo site_url("admin/SubCategory/getSubCategory"); ?>',
            type: "POST",
            data: {
                "cat_id" : cat_id
            },
            success: function (response) {
                if (response == '0' && cat_id != 'all') {
                    $('#klj').html('<tr>No result</tr>');
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj);
                    console.log(obj.length);
                    var html = '';
                    var j = 0;
                    $('#klj').html("");
                    for(var i=0; i<obj.length; i++){
                        j++;
                        // console.log(obj[i]['sub_category_id']);
                        var img = '<?php echo base_url().'sub_category/' ?>';
                        var url = '<?php echo site_url().'/admin/SubCategory/edit_sub_category/' ?>';
                        if (obj[i]['sub_category_image'] != null) {
                            var val = '<img src ="'+img+obj[i]['sub_category_image']+'" width="50px" height="50px">';
                        }else{
                            var val = '';
                        }
                        html += '<tr class="gradeC"><td>'+j+'</td><td>'+obj[i]['sub_category_name']+'</td><td>'+val+'</td><td class="center"><a class="btn btn-primary" href="'+url+obj[i]['sub_category_id']+'">Edit</a><a class="btn btn-danger" onclick="delteFunction('+obj[i]['sub_category_id']+')">Delete</a></td></tr>';
                    }
                        // console.log(html)
                    $("#alldetails").val("");
                    $('#klj').html(html);
                }
            }
        });
    }
    function delteFunction(val){
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: '<?php echo site_url("admin/SubCategory/delete_sub_category"); ?>',
                type: "POST",
                data: {
                    "sub_category_id" : val
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Sub Category!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Sub Category!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>