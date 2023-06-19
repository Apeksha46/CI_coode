<div id="page-wrapper">
    <div class="header"> 
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
            <li><a href="<?php echo site_url('admin/Advertisement');?>">Advertisement</a></li>
            <li class="active">Add Advertisement</li>
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
                            <div class="title">Add Advertisement</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-info alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="$('.alert').hide(); ">&times;</a>
                              <strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
                            </div>
                        <?php } if($this->session->flashdata('error')){  ?>
                             <div class="alert alert-danger alert-dismissible" id="hideDivId">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="$('.alert').hide(); ">&times;</a>
                              <strong>Error!</strong> <?php echo $this->session->flashdata('error');?>
                            </div>
                        <?php } ?>
                        <form class="" action="<?php echo site_url('admin/Advertisement/insert_advert');?>" enctype="multipart/form-data" method="post">


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Plan</label>
                                    <select class="form-control" name="plan_id">
                                        <?php
                                            foreach ($plan as $key) { ?>
                                                <option value="<?php echo $key['plan_id']; ?>" ><?php echo $key['plan_name']; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Seller</label>
                                    <select class="form-control" name="seller_id">
                                        <?php
                                            foreach ($seller as $key1) { ?>
                                                <option value="<?php echo $key1['seller_id']; ?>" ><?php echo $key1['seller_business_name'].'( '.$key1['seller_business_address'].' )'; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                            </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Advertisement Name</label>
                                    <input type="text" required="" name="advert_name" class="form-control" id="inputEmail3" placeholder="Advertisement">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputPassword3" class="control-label">Profile Image</label>
                                    <input type="file" class="form-control mb15" id="image" name="image" placeholder="file">
                                    <img id="preview" src="http://placehold.it/100x100" alt="your image" width="150px" height="120px" />
                            </div>
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label for="inputEmail3" class="control-label">Advertisement Description</label>
                                    <textarea name="advert_desc" required="" class="form-control" id="inputEmail3" rows="6" placeholder="Advertisement Description"></textarea>
                            </div>
                            
                            <div class="row">
                                
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputPassword3" class="control-label">From</label>
                                    <input type="date" onchange="fromDate(this.value);" class="form-control" id="from_date" name="from_date">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputPassword3" class="control-label">To</label>
                                    <input type="date" class="form-control" id="to_date" name="to_date">
                            </div>
                                </div>
                            </div>

                                   
                            
                            <button type="submit" name="add_Product" class="btn btn-primary">Add</button>

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
<script type="text/javascript">
    $( document ).ready(function() {

        ////////***START = Disable Past Date******//////
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var minDate= year + '-' + month + '-' + day;
        
        $('#from_date').attr('min', minDate);
        ////////***END = Disable Past Date******//////
        $('#image').change(function () {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                readURL(this);
            else
                alert("Please select image file (jpg, jpeg, png).")
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
            //$("#remove").val(0);
                };
            }
        }
        function removeImage() {
            $('#preview').attr('src', 'noimage.jpg');
            //$("#remove").val(1);
        }
    });
    function fromDate() {
        from_date = document.getElementById('from_date').value;

        var from = from_date.split("-")
        // console.log(from)
        // from[1]+'/'+from[2]+'/'+from[0]
        var f = from[0]+'-'+from[1]+'-'+from[2]
        // console.log(from[0]+'-'+from[1]+'-'+from[2])
        // alert(f)
        document.getElementById("to_date").setAttribute("min", f);

        // $( "#to_date" ).datepicker({ minDate: f});
    }
</script>