<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>
			<li><a href="<?php echo site_url('admin/Sale');?>">Sale</a></li>
			<li class="active">Add Sale</li>
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
                            <div class="title">Add Sale</div>
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
                        <form class="" action="<?php echo site_url('admin/Sale/insert_sale');?>" enctype="multipart/form-data" method="post">


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Sale Title</label>
                                    <input type="text" name="sale_title" class="form-control" required="" id="inputEmail3" placeholder="Sale Title">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Sale Description</label>
                                    <textarea name="sale_desc" class="form-control" required="" id="inputEmail3" placeholder="Sale Description"> </textarea>
                            </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">Start Date</label>
                                    <input type="date" onchange="fromDate(this.value);" id="from_date" name="start_date" class="form-control" required="" placeholder="Sale Start">
                            </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                <label for="inputEmail3" class="control-label">End Date</label>
                                    <input type="date" name="end_date" class="form-control" required="" id="to_date" placeholder="End Date" >
                            </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    
                            <div class="form-group">
                                <label for="inputPassword3" class="control-label">Sale Banner</label>
                                    <input type="file" class="form-control mb15" id="image" name="image" placeholder="file">
                                    <img id="preview" src="http://placehold.it/100x100" alt="your image" width="150px" height="120px" />
                            </div>
                                </div>
                            </div>

                            <button type="submit" name="add_Sale" class="btn btn-primary">Add Sale</button>



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