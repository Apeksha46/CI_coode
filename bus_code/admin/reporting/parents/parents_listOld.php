  <?php
         // $active = $this->uri->segment(3);
         $last = $this->uri->total_segments();
         $record_num = $this->uri->segment($last);
         $record_num1 = $this->uri->segment($last-1);
         $record_num2 = $this->uri->segment($last-2);
    ?>

 <div class="col-sm-12">
    <div class="border p-3 bg-white">
        <div class="">
            <div class="filter-menu mb-3">
                <ul class="nav">
                  <li class="nav-item">
                    <div class="row">
                         <label class="col-sm-4 pr-0 mb-0 align-items-center d-flex"><?php echo $this->lang->line('client_name'); ?></label>
                         <div class="col-sm-8">
                            <!-- <select class="form-control mb-0">
                                <option>The International School</option>
                                <option>The New School</option>
                            </select> -->
                            <select class="form-control mb-0" data-live-search="true" name="client_id" id="client_id" onchange="getClient(this.value);">
                                <option value=""><?php echo $this->lang->line('select_client'); ?></option>
                                <option data-tokens="0" value="0"><?php echo $this->lang->line('all_client'); ?> </option>
                                 <?php foreach ($getAllClient as $key) { ?>
                                    <option data-tokens="<?php echo $key['id']; ?>" value="<?php echo $key['id']; ?>"><?php echo $key['client_name']; ?></option>

                                 <?php } ?>
                            </select> 
                         </div>
                    </div>
                  </li> 
                  
                   <?php
                    if($record_num=='chaperone_list' ){
                        $reporting_chaperone = 'nav-link';
                    }else{
                        $reporting_chaperone = 'nav-link';
                    }

                     if($record_num=='parents_list' ){
                        $reporting_parents = 'nav-link active';
                    }else{
                        $reporting_parents = 'nav-link';
                    }

                    if($record_num=='bus_list' ){
                        $reporting_bus = 'nav-link ';
                    }else{
                        $reporting_bus = 'nav-link';
                    }

                    if($record_num=='driver_list' ){
                        $reporting_driver = 'nav-link ';
                    }else{
                        $reporting_driver = 'nav-link';
                    }
                    if($record_num=='status_list' ){
                        $reporting_status = 'nav-link';
                    }else{
                        $reporting_status = 'nav-link';
                    }
                    if($record_num=='trip_list' ){
                        $reporting_trip = 'nav-link ';
                    }else{
                        $reporting_trip = 'nav-link';
                    }
                    if($record_num=='map' ){
                        $reporting_map = 'nav-link active';
                    }else{
                        $reporting_map = 'nav-link';
                    }
                ?>

                  <li class="nav-item">
                      <a class="<?= $reporting_map;?>" href="<?php echo site_url('admin/reporting/map');?>"><?php echo $this->lang->line('map'); ?> </a>
                  </li>   
                  <li class="nav-item">
                      <a class="<?= $reporting_status;?>" href="<?php echo site_url('admin/reporting/status_list');?>"><?php echo $this->lang->line('status'); ?></a>
                  </li> 
                  <li class="nav-item">
                      <a class="<?= $reporting_trip;?>" href="<?php echo site_url('admin/reporting/trip_list');?>"><?php echo $this->lang->line('trip'); ?></a>
                  </li>   
                  <li class="nav-item">
                      <a class="<?= $reporting_bus;?>" href="<?php echo site_url('admin/reporting/bus_list');?>"><?php echo $this->lang->line('bus'); ?></a>
                  </li>  
                  <li class="nav-item">
                      <a class="<?= $reporting_driver;?>" href="<?php echo site_url('admin/reporting/driver_list');?>"><?php echo $this->lang->line('driver'); ?></a>
                  </li>  
                  <li class="nav-item">
                      <a class="<?= $reporting_chaperone;?>" href="<?php echo site_url('admin/reporting/chaperone_list');?>"><?php echo $this->lang->line('chaperone_users'); ?></a>
                  </li>  
                  <li class="nav-item">
                      <a class="<?= $reporting_parents;?>" href="<?php echo site_url('admin/reporting/parents_list');?>"><?php echo $this->lang->line('parent'); ?></a>
                      
                  </li>  
                  <li class="nav-item">
                      <a class="nav-link" href="">Analytics</a>
                  </li>  
                  <!-- <li class="nav-item">
                      <a class="nav-link" href=""></a>
                  </li>  
                  <li class="nav-item">
                      <a class="nav-link" href=""></a>
                  </li>  -->                     

             </ul>
           </div>
               
            <div class="d-flex w-100">
                <div class="mr-auto">
                    <h5><?= $title; ?> (<?= $parents_count->total; ?>)</h5>

                 </div>
                <div class="ml-auto">
                    <!-- <a class="btn-outline-warning btn btn-sm waves-effect waves-light" href="" data-toggle="modal" data-target="#importClientUser">
                        <?php echo $this->lang->line('import'); ?> 
                        <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                    </a> -->
                    <a class="btn-outline-warning btn btn-sm" href="<?php echo site_url('admin/reporting/parentsAdd');?>">
                        <?php echo $this->lang->line('add_new'); ?>
                        <i class="fa fa-plus ml-1" aria-hidden="true"></i>
                      </a>
                </div>
                 
            </div>

            <div class="d-flex mb-3">
                <!-- <a class="text-warning mr-3" href="">Delete</a>
                <a class="text-warning mr-3" href="">Export</a> -->
                <button class="btn-sm btn-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()">
                       <?php echo $this->lang->line('delete'); ?>
                </button> 
               
               
                <form action="<?php echo site_url()?>admin/reporting/ParentsController/excelParentsList" method="POST">
                  <input type="hidden" name="parentId" class="textIddss" value="">
                   <input type="submit" name="pdf" class="btn-sm btn-warning mr-3 bg-transparent border-0" value="<?php echo $this->lang->line('excel'); ?>" />  
                </form>

                <form action="<?php echo site_url()?>admin/reporting/ParentsController/pdfParentsList" method="POST">
                   <input type="hidden" name="parentId" class="textIddss" value="">
                   <input type="submit" name="pdf" class="btn-sm btn-warning mr-3 bg-transparent border-0" value="<?php echo $this->lang->line('pdf'); ?>" />  
                </form>
            </div>      


            <div class="">        
                <table class="table table-borderless border-top border-bottom" id="example">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"><?php echo $this->lang->line('client_name'); ?></th>
                            <th scope="col"><?php echo $this->lang->line('parents_name'); ?></th>
                            <th scope="col"><?php echo $this->lang->line('parent_number'); ?> </th>
                            <th scope="col"><?php echo $this->lang->line('assigned_bus'); ?> </th>
                            <th scope="col"><?php echo $this->lang->line('note'); ?></th>
                            <th scope="col"><?php echo $this->lang->line('secret_code'); ?></th>
                            <th scope="col"><?php echo $this->lang->line('modify'); ?> </th>
                            <!-- <th scope="col"><?php echo $this->lang->line('status'); ?> </th> -->
                            <th scope="col"><?php echo $this->lang->line('action'); ?> </th>
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
                             <td><?=$value['client_name']?></td>
                             <td><?=$value['parents_name']?></td>
                             <td><?=$value['parents_unique_id']?></td>
                             <td><?=$value['bus_unique_id']?></td>
                             <td><?=$value['note']?></td>
                             <td><?=$value['secret_code']?></td>
                             <td>
                                <?=  date("d/m/Y", strtotime($value['updated_at']));?>
                             </td>
                            <!-- <td>
                                <?php if($value['chaperone_status'] == 1) { ?>
                                    <button title="<?php echo $this->lang->line('change_staus')?> " class="btn-success  btn btn-sm" value="('<?=$value['chaperone_id']?>')" onclick="change_status('<?=$value['chaperone_id']?>','Deactive')">  <?php echo $this->lang->line('active')?>  </button>
                                <?php } else { ?>
                                   <button  title="<?php echo $this->lang->line('change_staus')?> " type="button" id="button" class="btn-info btn btn-sm " value="('<?=$value['chaperone_id']?>')" onclick="change_status('<?=$value['chaperone_id']?>','Active')"> <?php echo $this->lang->line('deactive')?>  </button>
                                <?php }  ?>
                            </td> -->
                            <td>
                               <a  title="<?php echo $this->lang->line('edit')?> " href="<?php echo base_url().'admin/reporting/parentsEdit/'.$value['parents_id'];?>" class="text-warning mr-3" ><?php echo $this->lang->line('edit')?></a>

                               <a  title="<?php echo $this->lang->line('delete'); ?>" class="text-warning mr-3" href="<?php echo base_url().'admin/reporting/ParentsController/delete/'.$value['parents_id'];?>" onclick="return deleteBus()" ><?php echo $this->lang->line('delete'); ?></a>
                            </td>
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
            <form method="post" action="<?php echo site_url('admin/reporting/delete_parents');?>" enctype="multipart/form-data" data-parsley-validate>
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
                            <button class="btn btn-primary" type="submit"><?php echo $this->lang->line('yes'); ?> </button>
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
                            <button class="btn btn-primary" type="submit"><?php echo $this->lang->line('upload'); ?> </button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript">
$( document ).ready(function() {
        $('#client_id').select2();

    });
   function deleteBus(){
        var result = confirm("<?= $this->lang->line('are_sure_delete');?> <?= $this->lang->line('this_parents');?>");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    }  

    function getClient(client_id)
    {
      // alert(client_id);die;

       var buildSearchData =     
        
        {            
              "client_id" : client_id,
        };

        table = $('#example').DataTable({ 
            "dom"           : 'Bfrtip',
            "buttons"       : [
                                {
                                    'extend': 'pdfHtml5',
                                    'orientation': 'landscape',
                                    'pageSize': 'LEGAL',
                                    'columns': ':visible',
                                    'exportOptions': {                    
                                        'columns':  [0,1,2,3,4,5,6,7,8]                        
                                    },
                 
                                },
                                // 'excel',
                                {
                                    'extend': 'excel',
                                    'orientation': 'landscape',
                                    'pageSize': 'LEGAL',
                                    'columns': ':visible',
                                     'exportOptions': {                    
                                        'columns': [0,1,2,3,4,5,6,7,8]               
                                    },
                                 },
                                 // 'print',
                                {
                                    'extend': 'print',
                                    'orientation': 'landscape',
                                    'pageSize': 'LEGAL',
                                    'columns': ':visible',
                                     'exportOptions': {                    
                                        'columns':[0,1,2,3,4,5,6,7,8]                
                                    },
                                 },
                            ],
            "ajax"          :  {
               "url"        : '<?php echo site_url("admin/reporting/ParentsController/getParentsReport"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        } );

    }

    $(document).ready(function() {
        // var table = $('#example').DataTable( {
        //     // scrollY:        "300px",
        //     // scrollX:        true,
        //     scrollCollapse: true,
        //     paging:         false,
        //     fixedColumns:   true
        // } );
        $('#example').DataTable( {
        //     dom: 'Bfrtip',
        //     buttons: [
        //             {
        //                 extend: 'pdfHtml5',
        //                 orientation: 'landscape',
        //                 pageSize: 'LEGAL',
        //                 columns: ':visible',
        //                 exportOptions: {                    
        //                     columns: [0,1,2,3,4,5,6,7,8]                
        //                 },
     
        //             },
        //             {
        //                 extend: 'excel',
        //                 orientation: 'landscape',
        //                 pageSize: 'LEGAL',
        //                 columns: ':visible',
        //                  exportOptions: {                    
        //                     columns: [0,1,2,3,4,5,6,7,8]                
        //                 },
        //              },
        //             {
        //                 extend: 'print',
        //                 orientation: 'landscape',
        //                 pageSize: 'LEGAL',
        //                 columns: ':visible',
        //                  exportOptions: {                    
        //                     columns: [0,1,2,3,4,5,6,7,8]                
        //                 },
        //              },

        //         ],
        });
    });


//------------------Delete-------------------
     $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="parents_id[]"]:checked').each(function() {

         selected_id.push(this.value);

      });
      // alert(selected_id);

      $('#txtDelete').val(selected_id);
    });
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
//------------------Export(PDF and Excel)-------------------

    $('form').submit(function () {
        var name = $('.textIddss').val();
        if (name === '') {
            $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            return false;
        }else{
           $('#errmsg').html('');
        }
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
          $('#errmsg').html('<?= $this->lang->line('select_one_checkbox'); ?>');
            // $("#errmsg").html("<?= $this->lang->line('select_one_checkbox'); ?>").show().fadeOut(5000);
            $('#deleteAllModal').modal('hide');

        }else
        {
          $('#errmsg').html('');
            $('#deleteAllModal').modal('show');
        }
    }

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
                if(data == 11){
                    toastr.success("<?= $this->lang->line('driver_add_successfully')?>");
                }else{

                    toastr.error("<?= $this->lang->line('driver_not_add_successfully')?>");
                }
                
                location.reload();
            }
        })
        e.preventDefault();
    });
 
});
</script>
