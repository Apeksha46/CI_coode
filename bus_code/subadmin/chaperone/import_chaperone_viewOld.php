<?= $title;?>

<button class="btn-sm btn-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()" >
   <?php echo $this->lang->line('download'); ?>
</button> 



<form method="post" action="<?php echo site_url('subadmin/import_bus');?>" enctype="multipart/form-data" data-parsley-validate  id="my-form">
                
                                <div id="file-wrap">
                                <p><?php echo $this->lang->line('drag_drop_file_here'); ?> </p>
                                   <input id="my-file" type="file" name="file" draggable="true" accept=".xls, .xlsx" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('choose_file'); ?>" >
                               </div>

                            <button class="btn btn-warning" type="submit"><?php echo $this->lang->line('import'); ?> </button>
                          
            </form>

   <!-- <a href="<?=base_url ()?>subadmin/BusController/donwload_bus_import/bus.csv" class="btn btn-primary">Download imp.zip</a>
 -->

 <div class="modal fade" id="confirmationDownload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?=base_url ()?>subadmin/ChaperoneController/donwload_chaperone_import" data-parsley-validate>
                <input type="hidden" name="busId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirmation_download'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_want_confirm_download'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" id="submitDownload"><?php echo $this->lang->line('yes'); ?> </button>
                            <!-- <a href="<?=base_url ()?>subadmin/BusController/donwload_bus_import/bus.csv" class="btn btn-primary"><?php echo $this->lang->line('yes'); ?></a> -->
                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript">
	function checkValue()
    {
        
        // $('#errmsg').html('');
        $('#confirmationDownload').modal('show');
        
    }

     $(document).ready(function(){
      $("#submitDownload").click(function(){        
          // $("#excelForm").submit(); // Submit the form

          setTimeout(function() {
            window.location = "/bus_tracking/subadmin/bus";
          }, 1000);
      });
  });


     //------------------Import (Choose and select)-------------------
$( function() {
 
    $("#my-file").on('change', function (e) { // if file input value
        $("#file-wrap p").html('Now click on Upload button'); // change wrap message
    });
 
    $("#my-form").on('submit', function (e) { // if submit form
        // $("#result").html('<img src="http://qass.im/drag-and-drop-upload-on-submit/ajax-loader.GIF">'); // display image loader in #result element
 
        var eventType = $(this).attr("method"); // get method type for #my-form
 
        var eventLink = $(this).attr("action"); // get action link for #my-form
        
        $.ajax({
            url:"<?php echo base_url(); ?>subadmin/import_chaperone",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,

            success:function(data)
            {
                $("#file-wrap p").html('Drag and drop file here'); // change wrap message
                if(data == 1){
                    toastr.success("<?= $this->lang->line('chaperone_add_successfully')?>");
                }else{

                    toastr.error("<?= $this->lang->line('chaperone_not_add_successfully')?>");
                }
                
                location.reload();
            }
        })
        e.preventDefault();
 
    });
 
});

</script>