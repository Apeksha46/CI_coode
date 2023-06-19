<style type="text/css">
    #ex4 .p1[data-count]:after{
        position:absolute;
        right:10%;
        top:8%;
        content: attr(data-count);
        font-size:44%;
        padding:.2em;
        border-radius:50%;
        line-height:1em;
        color: white;
        background:rgba(255,0,0,.85);
        text-align:center;
        min-width: 1.5em;
        /*font-weight:bold;*/
    }
</style>
<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('seller/Dashboard');?>">Home</a></li>
			<li class="active">Chat</li>
			<li></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Chat
                    </div>
                    <div id="msg"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Product Name</th>
                                        <th>Customer Name</th>
                                        <th>Customer Profile</th>
                                        <th>Last Message</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // print_r($chat);
                                        $i = 1;
                                        foreach ($chat as $key) { 
                                    ?>
                                    <tr class="gradeC">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $key['product_name']; ?></td>
                                        <td><?php echo $key['customer_name']; ?></td>
                                        <?php
                                            if (!empty($key['customer_profile'])) { ?>
                                                <td><img src="<?php echo $key['customer_profile']; ?>" height="30px" width="30px"></td>
                                            <?php }else{
                                                echo "<td></td>";
                                            }
                                        ?>
                                        <td><?php echo $key['last_msg']; ?></td>
                                        <td><?php echo $key['last_msg_time']; ?></td>
                                        <td class="center">
                                            <div id="ex4">
                                                <a href="<?php echo site_url('seller/Chat/chatting/'.$key["chat_id"].'/'.$key["customer_id"].'/'.$key["product_id"]);?>">
                                                    <span class="p1 fa-stack fa-2x has-badge" data-count="<?php echo $key['count']; ?>">
                                                        <i class="p3 fa fa-comments-o fa-stack-1x xfa-inverse" data-count="<?php echo $key['count']; ?>b"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                               <?php $i++; } ?>
                                </tbody>
                            </table>
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
    function delteFunction(val){
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: '<?php echo site_url("seller/Category/delete_category"); ?>',
                type: "POST",
                data: {
                    "category_id" : val
                },
                success: function (response) {
                    if (response == '1') {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-success"><strong>Category!</strong> delete successful.</div>');
                        }, 3000);
                    } else {
                        setTimeout(function(){ 
                            $('#msg').html('<div class="alert alert-danger"><strong>Category!</strong> Not delete.</div>'); 
                        }, 3000);   
                    }
                    location.reload();
                }
            });
        }
    }
</script>