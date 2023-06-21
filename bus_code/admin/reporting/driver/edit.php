
         <div class="col-sm-7 m-auto">
             <div class="border p-3 bg-white">
               <div class="chaperone-add">
                    <div class="d-flex mb-3">
                        <div class="mr-auto">
                            <h4><?= $title;?></h4>
                         </div>
                         <div class="ml-auto">
                            <a class="text-dark" href="<?php echo site_url('admin/reporting/driver_list');?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                         </div> 
                    </div>
                <form action="<?php echo site_url('admin/reporting/driverUpdate');?>" enctype="multipart/form-data" method="post" data-parsley-validate="" name="myform">
                    <input type="hidden" name="driver_id" value="<?= $driverDetail->driver_id;?>">
                    <div class="row">
                         <div class="col-sm-12 ">
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <label class="col-sm-3">
                                        <?php echo $this->lang->line('clients'); ?>
                                    </label>
                                    <div class="col-sm-9">
                                         <select class="form-control" data-live-search="true" name="client_id" id="client_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_client'); ?>" onchange="getClientUser(this.value);">
                                            <option value="">Select Client</option>
                                             <?php foreach ($getAllClient as $key) { ?>
                                                <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>" <?php echo $key['id'] == $driverDetail->client_id ? 'selected' : '' ?>><?php echo $key['client_name']; ?></option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                </div>  
                            </div>

                            <div class="form-group">
                                <div class="row align-items-center">
                                    <label class="col-sm-3">
                                        <?php echo $this->lang->line('clients_portal_user'); ?>
                                    </label>
                                    <div class="col-sm-9">
                                         <select class="form-control" data-live-search="true" name="client_user_id" id="client_user_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_client'); ?>" onchange="getClientUserBus(this.value);">
                                             <!-- <option value="0">Select Client User</option> -->
                                             <?php foreach ($getAllClientUser as $key) { ?>
                                            <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>" <?php echo $key['id'] == $driverDetail->client_user_id ? 'selected' : '' ?>><?php echo $key['username']; ?></option>
                                         <?php } ?>
                                        </select>
                                    </div>
                                </div>  
                            </div>

                               <?php 
                                $names = explode(' ', $driverDetail->driver_name, 2);
                                $f_name = $names[0];
                                // $family_name = $names[1];
                                 if(!empty($names[1])){
                                     $family_name = $names[1];
                                }else{
                                     $family_name = "";
                                }
                             ?>
                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?= $this->lang->line('first_name'); ?> </label>
                                     <div class="col-sm-9">
                                         <input class="form-control" type="text" name="f_name" placeholder="<?= $this->lang->line('first_name'); ?> " required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_first_name'); ?>" value="<?= $f_name;?>">
                                     </div>
                                </div>  
                             </div>
                              <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?= $this->lang->line('family_name'); ?> </label>
                                     <div class="col-sm-9">
                                         <input class="form-control" type="text" name="family_name" placeholder="<?= $this->lang->line('family_name'); ?>" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_family_name'); ?>" value="<?= $family_name;?>">
                                     </div>
                                </div>  
                             </div>

                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3"><?= $this->lang->line('phone_number');?></label>
                                     <div class="col-sm-9">
                                        <!--<input class="form-control phoneno" type="text" name="drive_mobile_number" placeholder="<?= $this->lang->line('phone_number');?>" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_mobile_number'); ?>" data-parsley-type="number" data-parsley-required-message="<?php echo $this->lang->line('number_only'); ?> "  data-id="phone_number" data-parsley-minlength="10" data-parsley-maxlength="10"  data-parsley-maxlength-message=""data-parsley-minlength-message="" onblur="mustBeValidMobile(this,'errmsg_phoneno')" value="<?= $driverDetail->drive_mobile_number;?>">-->
                                        <!--<span id="errmsg_phoneno" style="color: red"></span>-->
                                        <input class="form-control" type="text" name="drive_mobile_number" placeholder="<?= $this->lang->line('phone_number');?>" id ="drive_mobile_number" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('enter_mobile_number'); ?>"  value="<?= $driverDetail->drive_mobile_number;?>" readonly>
                                        <span id="errmsg_drive_mobile_number" style="color: red"></span>
                                     </div>
                                </div>  
                             </div>
                             <!--<div class="form-group">-->
                             <!--   <div class="row align-items-center">-->
                             <!--        <label class="col-sm-3"><?php echo $this->lang->line('assigned_bus'); ?></label>-->
                             <!--        <div class="col-sm-5">-->
                             <!--            <select class="form-control" data-live-search="true" name="bus_id" id="bus_id" data-parsley-required="true" data-parsley-required-message="<?php echo $this->lang->line('select_bus'); ?>">-->
                             <!--           <option value=""><?php echo $this->lang->line('select_bus'); ?></option>-->
                             <!--            <?php foreach ($getAllBus as $key) { ?>-->
                             <!--               <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>" <?php echo $key['id'] == $driverDetail->bus_id ? 'selected' : '' ?>><?php echo $key['bus_number']; ?></option>-->
                             <!--            <?php } ?>-->
                             <!--       </select>-->
                             <!--        </div>-->
                             <!--   </div>  -->
                             <!--</div>-->
                            
                             <div class="form-group">
                                <div class="row align-items-center">
                                     <label class="col-sm-3">Note</label>
                                     <div class="col-sm-9">
                                         <!-- <input class="form-control" type="text" name="note"  placeholder="<?php echo $this->lang->line('note'); ?>" required data-parsley-required-message="<?php echo $this->lang->line('enter_note'); ?>" value="<?= $driverDetail->note;?>"> -->
                                         <input class="form-control" type="text" name="note"  placeholder="<?php echo $this->lang->line('note'); ?>" value="<?= $driverDetail->note;?>">
                                     </div>
                                </div>  
                             </div>
                         </div>
                    </div> 

                    <div class="col-sm-12">
                        <div class="row flex-row-reverse">
                             <!-- <a class="btn-outline-warning btn btn-sm">Save</a> -->
                              <button class="btn-outline-warning btn btn-sm" type="submit"><?php echo $this->lang->line('save'); ?></button>
                        </div>  
                    </div>  
                </form>    
               </div>
             </div> 
         </div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#client_id').select2();
        $('#client_user_id').select2();

    });

    function randomPassword(length) 
    {
      // alert(length);
         // chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
         // chars = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/" ;
        chars = '@&%ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';

        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }

        myform.secret_code.value = pass;
    }

    //check valid number   
    $('.phoneno').each(function(){
        $(this).mask('9999999999');
    });

    // ------check mobile number validation----
    function mustBeValidMobile(el, msgEl) {
        if( el.value === '' || el.value === null || el.value === undefined ) {
            return;
        }

        if((el.value).length < 10) {
            $(`#${msgEl}`).text('<?php echo $this->lang->line("enter_10_number")?>'); 
        } else {
            $(`#${msgEl}`).text(''); 
        }
    }

    function getClientUser(client_id){
        // alert(cat_id);
        $.ajax({
            url: '<?php echo site_url("admin/reporting/ChaperoneController/getClientUser"); ?>',
            type: "POST",
            data: {
                "client_id" : client_id
            },
            success: function (response) 
            {
                console.log(response);

                if (response == '0') {
                    $('#client_user_id').html('<option value="0">No Client User Found</option>');
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                    var html = '';
                    // html += '<option value="0">Other</option>'

                    for(var i=0; i<obj.length; i++){
                        // console.log(obj[i]['sub_category_id']);
                        // html += '<option value="'+obj[i]['sub_category_id']+'">'+obj[i]['sub_category_name']+'</option>'
                        html += '<option onchange="getClientUserBus(this.value);" data-tokens="'+obj[i]['id']+'" value="'+obj[i]['id']+'">'+obj[i]['username']+'</option>'
                    }

                    $('#client_user_id').html(html);
                }
            }
        });
    }

    function getClientUserBus(client_user_id)
    {
         $.ajax({
            url: '<?php echo site_url("admin/reporting/ChaperoneController/getClientUserBus"); ?>',
            type: "POST",
            data: {
                "client_user_id" : client_user_id
            },
            success: function (response) 
            {
                console.log(response);

                if (response == '0') {
                    $('#bus_id').html('<option value="0">Bus User Found</option>');
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                    var html = '';
                    // html += '<option value="0">Other</option>'

                    for(var i=0; i<obj.length; i++){
                        html += '<option data-tokens="'+obj[i]['id']+'" value="'+obj[i]['id']+'">'+obj[i]['bus_number']+'</option>'
                    }

                    $('#bus_id').html(html);
                }
            }
        });
    }
    function check_driverNumber(drive_mobile_number)
    {
      // alert('hi');
        // alert(bus_plate_number);
        var client_user_id = $('#client_user_id').val();
        // alert(client_user_id);
        
        if(drive_mobile_number != ''){

             $.ajax({
                url: '<?php echo site_url("admin/reporting/DriverController/check_driverNumber"); ?>',
                type: "POST",
                data: {
                    "drive_mobile_number" : drive_mobile_number,
                    "client_user_id" : client_user_id
                },
                success: function (response) 
                {
                    console.log(response);

                    if (response == '0') {
                        $('#errmsg_drive_mobile_number').html('');
                    } else {
                        
                        $('#errmsg_drive_mobile_number').html("Driver Mobile Number Already Exit");
                        $('#drive_mobile_number').val('');
                    }
                }
            });
        }
    }
</script>