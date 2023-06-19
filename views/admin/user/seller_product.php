<div id="page-wrapper">
    <div class="header">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
            <li><a href="<?php echo site_url('admin/User/seller');?>">Seller</a></li>
            <!-- <li><a href="#">Profile</a></li> -->
            <li class="active">Seller Product</li>
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
                        Seller Product
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover tableExport">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Sub-Category</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Remain Quantity</th>
                                        <th>Used Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // print_r($tableData);
                                        $i = 1;
                                        foreach ($product as $key) { 
                                            // print_r($key['about_us_id']);
                                            // echo $url = site_url('admin/about_us/edit_about_us/'.$key["about_us_id"]);
                                            ?>
                                            <tr class="gradeC">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $key['product_name']; ?></td>
                                                <td><?php echo $key['category_name']; ?></td>
                                                <td><?php echo $key['sub_category_name']; ?></td>
                                                <td><?php echo $key['type']; ?></td>
                                                <td><?php echo $key['product_description']; ?></td>
                                                <td><?php echo $key['price']; ?></td>
                                                <td><?php echo $key['product_quantity']; ?></td>
                                                <td><?php echo $key['remaining_qty']; ?></td>
                                                <td><?php echo $key['used_qty']; ?></td>
                                                <td class="center">
                                                    <a class="btn btn-block btn-warning" href="<?php echo site_url('admin/User/color_size_product/'.$key["product_id"]);?>">View Color/Sizes</a>
                                                    <a class="btn btn-block btn-primary mb-2" href="<?php echo site_url('admin/User/product_image/'.$key["product_id"]);?>">View Product Images</a>
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
    
</script>