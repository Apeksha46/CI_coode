<div id="page-wrapper">
    <div class="header">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
            <li><a href="<?php echo site_url('admin/User/seller');?>">Seller</a></li>
            <li class="active">Color/Size</li>
            <li></li>
        </ol>           
    </div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <?php 
                                // print_r($color);
                                foreach ($color as $key) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key['color_id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                            <?php echo $key['color']; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse<?php echo $key['color_id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Size</th>
                                                        <th>Total Quantity</th>
                                                        <th>Remaining Quantity</th>
                                                        <th>Used Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $i = 1;
                                                        foreach ($key['size'] as $value) {
                                                            ?>
                                                            <tr class="gradeC">
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $value['size_name']; ?></td>
                                                                <td><?php echo $value['qty']; ?></td>
                                                                <td><?php echo $value['remaining_qty']; ?></td>
                                                                <td><?php echo $value['used_qty']; ?></td>
                                                                
                                                            </tr>
                                                       <?php $i++; } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
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