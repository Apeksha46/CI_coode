<div id="page-wrapper">
    <div class="header">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/Dashboard');?>">Home</a></li>/
            <li><a href="<?php echo site_url('admin/Booking');?>">Booking</a></li>/
            <li><a href="#">Booking Allot</a></li>
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
                            <div class="title">Booking Allot</div>
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
                        <form class="form-horizontal" action="<?php echo site_url('admin/Booking/insert_driver_booking');?>" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Driver</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="booking_id" value="<?php echo $this->uri->segment(4); ?>" >
                                    <select class="form-control" name="delivery_man_id">
                                        <?php
                                            foreach ($driver as $key) { ?>
                                                <option value="<?php echo $key['delivery_man_id']; ?>" ><?php echo $key['delivery_man_first_name'].' '.$key['delivery_man_last_name'].' ('.$key['driver_identification_id'].' )' ; ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Pick-Up Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="pickup_location" class=" mapControls  form-control" value = "<?php if(!empty( $data->pickup_location)){ echo $data->pickup_location; }else{ echo""; } ?>" id="searchMapInput" placeholder="Pick up Address">

                                    
                                    <input type="hidden" value = "<?php if(!empty( $data->pickup_latitude)){ echo $data->pickup_latitude; }else{ echo""; } ?>" name="pickup_latitude" id="lat-span">
                                    <input type="hidden" value = "<?php if(!empty( $data->pickup_longitude)){ echo $data->pickup_longitude; }else{ echo""; } ?>" name="pickup_longitude" id="lon-span">
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="add_Product" class="btn btn-primary">Allot Driver</button>
                                </div>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfBnNOV6-8Uddif7X67gMS6I77jdXXgo&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript">
	function initMap() {
        var input = document.getElementById('searchMapInput');
    
        var autocomplete = new google.maps.places.Autocomplete(input);
     
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            // document.getElementById('location-snap').value = place.formatted_address;
            document.getElementById('lat-span').value = place.geometry.location.lat();
            document.getElementById('lon-span').value = place.geometry.location.lng();
        });
    }
</script>