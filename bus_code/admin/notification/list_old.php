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
                  <ul class="nav row">
                    <?php
                    if($record_num=='notification' ){
                        $notification = 'nav-link active';
                    }else{
                        $notification = 'nav-link ';
                    }

                    if($record_num=='notification_new' ){
                        $notification_new = 'nav-link';
                    }else{
                        $notification_new = 'nav-link';
                    }
                ?>

                  <li class="nav-item">
                      <a class="<?= $notification_new; ?> " href="<?php echo site_url('admin/notification_new');?>"><?php echo $this->lang->line('new_notification'); ?></a>
                  </li>  
                  <li class="nav-item">
                      <a class="<?= $notification; ?>" href="<?php echo site_url('admin/notification');?>"><?php echo $this->lang->line('notification_log'); ?></a>
                  </li>   
                      

                 </ul>
               </div>
               
                    <div class="d-flex w-100">
                        <div class="mt-4 mb-3">
                            <h5><?=$title; ?> (<?= $notification_count->total;?>)</h5>
                         </div>
                         
                    </div>

                    <div class="d-flex mb-3">
                        <!-- <a class="text-warning mr-3" href="">Delete</a>
                        <a class="text-warning mr-3" href="">Edit</a>
                        <a class="text-warning mr-3" href="">Export</a> -->
                         <button class="btn-sm btn-warning mr-3 bg-transparent border-0" id="btnDelete" onclick="checkValue()">
                               <?php echo $this->lang->line('delete'); ?>
                        </button> 

                        <form action="<?php echo site_url()?>admin/NotificationController/excelNotificaitonList" method="POST">
                          <input type="hidden" name="notificationId" class="textIddss" value="">
                           <input type="submit" name="pdf" class="btn-sm btn-warning mr-3 bg-transparent border-0" value="<?php echo $this->lang->line('excel'); ?>" />  
                        </form>

                        <form action="<?php echo site_url()?>admin/NotificationController/pdfNotificaitonList" method="POST">
                           <input type="hidden" name="notificationId" class="textIddss" value="">
                           <input type="submit" name="pdf" class="btn-sm btn-warning mr-3 bg-transparent border-0" value="<?php echo $this->lang->line('pdf'); ?>" />  
                        </form>
                    </div>      

                    <div class="">
                        
                            <table class="table table-borderless border-top border-bottom" id="example">
                                <thead>
                                  <tr>
                                    <th scope="col"><?php echo $this->lang->line('s_no'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('date_time'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('clients'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('user'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('based_on_app_version'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('all_app_version'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('platform'); ?></th>
                                    <th scope="col"><?php echo $this->lang->line('msg'); ?></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $i = 1;
                                    if(!empty($getAllNotification)){
                                        foreach ($getAllNotification as $key => $value) { 
                                  ?>
                                  <tr>
                                    <th scope="row">
                                         <input id="<?=$value['id']?>" type="checkbox" value="<?=$value['id']?>" name="notification_id[]" class="form-control-custom"  data-id ="<?=$value['id']?>" data-parsley-required="true" data-parsley-trigger="click" onclick="checkBox();">
                                          <label for="<?=$value['id']?>"></label><br>
                                          <span id="errmsg" style="color: red;"></span>
                                    </th>
                                    
                                     <td><?=  date("d/m/Y h:s A", strtotime($value['updated_at']));?></td>
                                     <td><?=$value['client']?></td>
                                     <td><?=$value['app_user']?></td>
                                     <td><?=$value['based_app']?></td>
                                     <td><?=$value['version']?></td>
                                     <td><?=$value['platform']?></td>
                                     <td><?=$value['msg']?></td>
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
            <form method="post" action="<?php echo site_url('admin/notification/delete');?>" enctype="multipart/form-data" data-parsley-validate>
                <input type="hidden" name="notificationId" id="txtDelete" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title"> 
                                <?php echo $this->lang->line('delete'); ?> <?php echo $this->lang->line('notification'); ?> </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                         <!-- <div class="form-group"> -->
                            <p><?php echo $this->lang->line('are_you_sure_want_delete_notification'); ?> </p>
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

<script type="text/javascript">
  $(document).ready(function() {
    //   var table = $('#example').DataTable( {
    //         // scrollY:        "300px",
    //         // scrollX:        true,
    //         scrollCollapse: true,
    //         paging:         false,
    //         fixedColumns:   true
    //     } );
        $('#example').DataTable( {
            // dom: 'Bfrtip',
            // buttons: [
            //         {
            //             extend: 'pdfHtml5',
            //             title: 'Bus List',
            //             orientation: 'landscape',
            //             pageSize: 'LEGAL',
            //             columns: ':visible',
            //             exportOptions: {                    
            //                 columns: [1,2,3,4,5]                
            //             },
     
            //         },
            //         {
            //             extend: 'excel',
            //             title: 'Bus List',
            //             orientation: 'landscape',
            //             pageSize: 'LEGAL',
            //             columns: ':visible',
            //              exportOptions: {                    
            //                  columns: [1,2,3,4,5]                
            //             },
            //          },
            //         {
            //             extend: 'print',
            //             title: 'Bus List',
            //             orientation: 'landscape',
            //             pageSize: 'LEGAL',
            //             columns: ':visible',
            //              exportOptions: {                    
            //                  columns: [1,2,3,4,5]                
            //             },
            //          },

            //     ],
        });
    });

//------------------Export PDF and Excel-------------------
    function checkBox()
    {
        // alert('hi');
        var selected_id = new Array();
        $('input[name="notification_id[]"]:checked').each(function() {

           selected_id.push(this.value);

        });
        // alert(selected_id);
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
//------------------Delete-------------------
     $("#btnDelete").click(function(){
      var selected_id = new Array();
      $('input[name="notification_id[]"]:checked').each(function() {

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
        $.each($("input[name='notification_id[]']:checked"), function(){            
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
</script>