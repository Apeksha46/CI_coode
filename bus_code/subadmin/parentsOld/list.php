 <div class="col-sm-12">
             <div class="border p-3 bg-white">
               <div class="">
                    <div class="d-flex">
                        <div class="mr-auto">
                            <h4><?= $title?> (<? if(empty($parents_count->parents_total)){ echo 0; }else{ echo $parents_count->parents_total;}?>)</h4>
                         </div>
                         <div class="ml-auto">
                              <a class="btn-outline-warning btn btn-sm" href=""  data-toggle="modal" data-target="#importParent">
                                <?php echo $this->lang->line('import'); ?> 
                                <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                              </a>
                              <a class="btn-outline-warning btn btn-sm" href="<?php echo site_url('subadmin/parents_add');?>"> 
                                <?php echo $this->lang->line('add_new'); ?>
                                <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                              </a>
                         </div> 
                    </div>

                    <div class="d-flex mb-3">
                         <button class="btn-sm btn-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()">
                               <?php echo $this->lang->line('delete'); ?>
                        </button> 

                        <button class="btn-sm btn-warning mr-3 bg-transparent border-0" id="btnEdit" onclick="checkEdit()" >
                               <?php echo $this->lang->line('edit'); ?>
                        </button>

                        <button class="btn-sm btn-warning mr-3 bg-transparent border-0" id="btnExport" onclick="checkExport()" >
                               <?php echo $this->lang->line('export'); ?>
                        </button> 
                    </div>      

                    <div class="">
                        
                            <table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col">
                                       <input id="checkbox1" type="checkbox" name="parent[]" class="form-control-custom" onchange="checkAllParents(this)">
                                    </th>
                                    <th scope="col"><?php echo $this->lang->line('parents_name'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('parent_number'); ?> </th>
                                    <th scope="col"><?php echo $this->lang->line('note'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('secret_code'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('modify'); ?> </th>
                                    <th scope="col"><?php echo $this->lang->line('status'); ?> </th>
                                    <!--<th scope="col"><?php echo $this->lang->line('action'); ?> </th>-->
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $i = 1;

                                    if(!empty($getAllParent)){
                                        foreach ($getAllParent as $key => $value) { 
                                ?>
                                  <tr>
                                    <th scope="row">
                                      <!-- <input type="checkbox" name=""> -->
                                      <input id="<?=$value['parents_id']?>" type="checkbox" value="<?=$value['parents_id']?>" name="parents_id[]" class="form-control-custom"  data-id ="<?=$value['parents_id']?>" data-parsley-required="true" data-parsley-trigger="click"  onclick="checkBox();">
                                      <label for="<?=$value['parents_id']?>"></label><br>
                                      <span id="errmsg" style="color: red;"></span>
                                    </th>
                                     <td><?=$value['parents_name']?></td>
                                     <td><?=$value['parents_unique_id']?></td>
                                     <td><?=$value['note']?></td>
                                     <td><?=$value['secret_code']?></td>
                                     <td>
                                        <?=  date("d/m/Y", strtotime($value['updated_at']));?>
                                     </td>
                                    <td>
                                        <?php if($value['parents_status'] == 1) { ?>
                                            <button title="<?php echo $this->lang->line('change_staus')?> " class="btn-success  btn btn-sm" value="('<?=$value['parents_id']?>')" onclick="change_status('<?=$value['parents_id']?>','Deactive')">  <?php echo $this->lang->line('active')?>  </button>
                                        <?php } else { ?>
                                           <button  title="<?php echo $this->lang->line('change_staus')?> " type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['parents_id']?>')" onclick="change_status('<?=$value['parents_id']?>','Active')"> <?php echo $this->lang->line('deactive')?>  </button>
                                        <?php }  ?>
                                    </td>
                                    <!--<td>-->
                                    <!--   <a  title="<?php echo $this->lang->line('edit')?> " href="<?php echo base_url().'subadmin/parents_edit/'.$value['parents_id'];?>" class="text-warning mr-3" ><?php echo $this->lang->line('edit')?></a>-->

                                    <!--   <a  title="<?php echo $this->lang->line('delete'); ?>" class="text-warning mr-3" href="<?php echo base_url().'subadmin/ParentsController/delete/'.$value['parents_id'];?>" onclick="return deleteBus()" ><?php echo $this->lang->line('delete'); ?></a>-->
                                    <!--</td>-->
                                  </tr>
                                 <?php $i++; } }?>
                                 <input type="hidden" id="counting" name="counting" value="{{$i-1}}">
                                </tbody>
                            </table>
                        
                    </div> 
               </div>
             </div> 
         </div>

         <div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?php echo site_url('subadmin/delete_parents');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="parentsId" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('bus'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?= $this->lang->line('are_sure_delete');?> <?= $this->lang->line('this_parents');?></p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" type="submit"><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

         <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>subadmin/ParentsController/editParents" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="parentsId" id="txtEdit" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('edit'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_edit_selected_driver'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" ><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="selectAtleastOneParnetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="busId" id="" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('sorry_you_select_atleast_parents'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="btn btn-primary" type="submit" id="modelAlteastBus"><?php echo $this->lang->line('yes'); ?> </button> -->
                            <a href="<?= base_url() ?>subadmin/parents" class="btn btn-primary"><?php echo $this->lang->line('ok'); ?></a>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>


 <div class="modal fade" id="selectOnlyOneParentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <!-- <form method="post" action="" data-parsley-validate> -->
                <input type="hidden" name="busId" id="" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('confirm_msg'); ?></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p><?php echo $this->lang->line('sorry_slect_only_one_parents'); ?> </p>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= base_url() ?>subadmin/parents" class="btn btn-primary"><?php echo $this->lang->line('ok'); ?></a>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>


  <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="<?= base_url() ?>subadmin/ParentsController/exportParentsCSV" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="parentsId" id="txtExport" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> <?php echo $this->lang->line('export'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_sure_export_selected_parents'); ?> </p>
                        <!-- </div> -->
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" id="submitExcel"><?php echo $this->lang->line('yes'); ?> </button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="importParent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="" enctype="multipart/form-data" data-parsley-validate  id="my-form">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('import'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <p><label><?php echo $this->lang->line('select_excel_file'); ?> </label>
                                <div id="file-wrap">
                                <p><?php echo $this->lang->line('drag_drop_file_here'); ?> </p>
                                   <input id="my-file" type="file" name="file" draggable="true" accept=".xls, .xlsx" required data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('choose_file'); ?>" >
                               </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" type="submit"><?php echo $this->lang->line('upload'); ?> </button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript">

  function deleteBus(){
        var result = confirm("<?= $this->lang->line('are_sure_delete');?> <?= $this->lang->line('this_parents');?>");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    }  

    function change_status(id,value)
    {
        var parents_id = id;
            // alert(user_id);
        if(confirm("<?= $this->lang->line('are_you_sure_want');?> "+value+" <?= $this->lang->line('this_parents');?>")){
            $.ajax({
                url: '<?php echo site_url("subadmin/parents/changeStatus"); ?>',
                type: "POST",
                data: {
                    "parents_id" : parents_id
                },
                success: function(response) { 
                    var data = response;
                    // console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.parents_id).removeClass("btn-info").addClass('btn-success').text('Active')
                    }
                    else 
                    {
                      $('#change_status_'+data.parents_id).removeClass("btn-success").addClass('btn-info').text('Deactive')
                    }
                    location.reload();
                }
            });
        }
    }

    // $("#btnDelete").click(function(){
    //   var selected_id = new Array();
    //   $('input[name="parents_id[]"]:checked').each(function() {

    //      selected_id.push(this.value);

    //   });
    //   // alert(selected_id);

    //   $('#txtDelete').val(selected_id);
    // });

    // $(document).ready(function() {
    //     $('#example').DataTable({
    //     });
    // });

    //  function checkValue()
    // {
    //     // alert('h');
    //     var selected_id = new Array();
    //     var counting = $('#counting').val();
    //     // for(var i=0 ; i<counting)
    //     $.each($("input[name='parents_id[]']:checked"), function(){            
    //         selected_id.push($(this).val());
    //     });
    //     if(selected_id.length == 0)
    //     {
    //       $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
    //         // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
    //         $('#deleteAllModal').modal('hide');

    //     }else
    //     {
    //       $('#errmsg').html('');
    //         $('#deleteAllModal').modal('show');
    //     }
    // }

//------------Export Pdf and Excel----------------------------
  function checkBox()
    {
        // alert('hi');
        var selected_id = new Array();
        $('input[name="parents_id[]"]:checked').each(function() {

           selected_id.push(this.value);

        });

            $('.textIddss').val(selected_id);
       
    }

    $('form').submit(function () {
        var name = $('.textIddss').val();
        if (name === '') {
            $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            return false;
        }else{
           $('#errmsg').html('');
        }
    });

//------------------Import (Choose and select)-------------------
  $( function() {
 
    $("#my-file").on('change', function (e) { // if file input value
        $("#file-wrap p").html('Now click on Upload button'); // change wrap message
    });
 
    $("#my-form").on('submit', function (e) { // if submit form
 
        var eventType = $(this).attr("method"); // get method type for #my-form
 
        var eventLink = $(this).attr("action"); // get action link for #my-form
        
        $.ajax({
             url:"<?php echo base_url(); ?>subadmin/import_parent",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,

            success:function(data)
            {
                $("#file-wrap p").html('Drag and drop file here'); // change wrap message
                if(data == 1){
                    toastr.success("<?= $this->lang->line('parent_add_successfully')?>");
                }else{

                    toastr.error("<?= $this->lang->line('parent_not_add_successfully')?>");
                }
                // 
                location.reload();
            }
        })
        e.preventDefault();
    });
 
});


//Delete Button Function
  function checkAllParents(ele) {
    $('input[name ="parents_id[]"]').each( function() {
        if (ele.checked) {
            $(this).prop('checked',true);
        } else {
            $(this).prop('checked',false);
        } 
    });
  }

  $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="parents_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtDelete').val(selected_id);
    });

     function checkValue()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='parents_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        if(selected_id.length == 0)
        {
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#deleteAllModal').modal('hide');
            $('#selectAtleastOneParnetModal').modal('show');

        }else
        {
          $('#errmsg').html('');
            $('#deleteAllModal').modal('show');
        }
    }

//Edit Button Funtion
     function checkEdit()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='parents_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
          // var result = confirm("<?= $this->lang->line('sorry_you_select_atleast_bu'); ?>");
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#editModal').modal('hide');
            $('#selectAtleastOneParnetModal').modal('show');

        }else if(selected_id.length == 1)
        {
           $('#errmsg').html('');
            $('#editModal').modal('show');
        }else
        {
          // var result = confirm("<?= $this->lang->line('sorry_slect_only_one_bus'); ?>");
          
           $('#editModal').modal('hide');
           $('#selectOnlyOneParentsModal').modal('show');
          // $('#errmsg').html('<?= $this->lang->line('sorry_slect_only_one_bus'); ?>'); 
        }
    }
  $("#btnEdit").click(function(){
      var selected_id = new Array();
      $('input[name="parents_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtEdit').val(selected_id);
    });
//Export Button Funtion
     function checkExport()
    {
        // alert('h');
        var selected_id = new Array();
        var counting = $('#counting').val();
        // for(var i=0 ; i<counting)
        $.each($("input[name='parents_id[]']:checked"), function(){            
            selected_id.push($(this).val());
        });
        // alert(selected_id.length);
        if(selected_id.length == 0)
        {
           // var result = confirm("<?= $this->lang->line('sorry_you_select_atleast_bu'); ?>");
          // $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#exportModal').modal('hide');
           $('#selectAtleastOneParnetModal').modal('show');

        }else
        {
          $('#errmsg').html('');
            $('#exportModal').modal('show');
        }
    }
  $(document).ready(function(){
      $("#submitExcel").click(function(){        
          // $("#excelForm").submit(); // Submit the form
          setTimeout(function() {
            window.location = "/bus_tracking/subadmin/parents";
          }, 1000);
      });

  });

  $("#btnExport").click(function(){
      var selected_id = new Array();
      $('input[name="parents_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtExport').val(selected_id);
    });
</script>