<div id="page-wrapper">
    <div class="header">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
            <li><a href="<?php echo site_url('admin/Package');?>">Package</a></li>
            <li class="active">Add Package</li>
            <li></li>
        </ol>           
    </div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner"> 
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="card-title">
                            <div class="title">Add Package</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-info alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
                            </div>
                        <?php } if($this->session->flashdata('error')){  ?>
                             <div class="alert alert-danger alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              <strong>Error!</strong> <?php echo $this->session->flashdata('error');?>
                            </div>
                        <?php } ?>
                        <div id="msg"></div>
                        <form class="" action="<?php echo site_url('admin/Package/insert_package');?>" enctype="multipart/form-data" method="post">

                            <div class="row">
                                <div class="col-sm-12">
                                     <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Package Name</label><span style="color: red">*</span>
                                        <input type="text" name="package_name" class="form-control" id="inputEmail3" placeholder="Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Price</label><span style="color: red">*</span>
                                        <input type="text" onkeypress="return isNumberKey(event)" name="price" class="form-control" id="inputEmail3" placeholder="Price">
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Product Description</label><span style="color: red">*</span>
                                            <textarea class="form-control" rows="3" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Product Images</label><span style="color: red">*</span>
                                        <div class="input_image_fields_wrap ">
                                            <div class="p-rel input-div">
                                                <input type="file" class="form-control" id="upload_file" name="image"  placeholder="Package Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <button type="submit" name="add_package" class="btn btn-primary">Add Package</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
