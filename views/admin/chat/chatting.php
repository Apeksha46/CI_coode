<style type="text/css">
    textarea {
       resize: none;
    }
</style>
<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('seller/Dashboard');?>">Home</a></li>
            <li><a href="<?php echo site_url('seller/Chat');?>">Chat</a></li>
            <li class="active">Chatting</li>
            <li></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <?php
        // print_r($chat['customer_profile']);
    ?>
    <div id="page-inner"> 
        <div class="row">
            <div class="col-xs-12">
                <div class="chat-window">
                    <div id="frame">
                        <div class="content">
                            <div class="contact-profile">
                                <img src="<?php echo $chat['customer_profile']; ?>" alt="" />
                                <p><?php echo $chat['customer_name']; ?></p>
                            </div>
                            <div class="messages" >
                                <ul id="refreshDiv">
                                    <?php
                                        for ($i=0; $i < count($chat['chat']); $i++) { 
                                            if ($chat['chat'][$i]['send_to'] == 1) { ?>
                                                <li class="sent">
                                                    <p>
                                                        <span class="msg"><?php echo $chat['chat'][$i]['text_message'] ; ?></span>
                                                        <span class="date-time"><?php echo $chat['chat'][$i]['message_date'].' '.$chat['chat'][$i]['message_time'] ?></span>
                                                    </p>
                                                </li>
                                            <?php }else{ ?>
                                                <li class="replies">
                                                    <p>
                                                        <span class="msg"><?php echo $chat['chat'][$i]['text_message'] ; ?></span>
                                                        <span class="date-time"><?php echo $chat['chat'][$i]['message_date'].' '.$chat['chat'][$i]['message_time'] ?></span>
                                                </li>
                                                
                                            <?php }
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="message-input">
                                <div class="wrap">
                                    <input type="hidden" id="chat_id" value="<?php echo $this->uri->segment(4); ?>">
                                    <input type="hidden" id="customer_id" value="<?php echo $this->uri->segment(5); ?>">
                                    <input type="hidden" id="product_id" value="<?php echo $this->uri->segment(6); ?>">
                                    <textarea class="type-msg" id="text_message"  placeholder=""></textarea>
                                    <button onclick="send_message();" type="button" class="btn btn-default btn-sm" id="btnSubmit">
                                        <span class="glyphicon glyphicon-send"></span> 
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <style type="text/css">
                
                .nati-confirm {
                    width: 100%;
                    float: left;
                    margin-top: 19px;
                }

                .nati-confirm .panel.panel-default {
                    display: inline-block;
                    width: 100%;
                }
                .nati-confirm .form-group
                {
                    margin-bottom: 15px;
                }
            </style>
            <div class="col-xs-12 nati-confirm">

                <div class="alert alert-success" id="success-alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Success! </strong>
                Notification send successfully
            </div>
            <div class="alert alert-danger" id="danger-alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Danger! </strong>
                Data not inserted
            </div>
            <div class="alert alert-danger" id="danger-alert1" style="display: none;">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Danger! </strong>
                Please fill both the field value.
            </div>
            <div class="alert alert-danger" id="danger-alerts" style="display: none;">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Danger! </strong>
                Notification not send
            </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="card-title">
                            <div class="title">Send confirmation notification to customer</div>
                        </div>  
                    </div>
                    <div class="panel-body">
                        <div class="row">  
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" id = "bargain_amount" name = "bargain_amount" class="form-control" id="inputEmail3" placeholder="Enter Bargaining Amount" onkeypress="return isNumberKey(event)">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" id = "total_quantity" name = "total_quantity" class="form-control" id="inputEmail3" placeholder="Enter Total Quantity" onkeypress="return isNumberKey(event)">
                                </div>

                            </div>
                            
                        </div>

                        <button type="submit" onclick="return sendNotificationToCustomer();" name="add_Product" class="btn btn-primary">Send</button>
                    </div>       
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
    $(document).ready(function () {
        $('.messages').scrollTop($('.messages')[0].scrollHeight);
        setInterval(function(){ get_message(); }, 1000);

        // setTimeout(notification, 1000);
    });
    var wage = document.getElementById("text_message");
    wage.addEventListener("keydown", function (e) {
        if (e.keyCode === 13) {
            send_message(e);
            event.preventDefault();
        }
    });

    function get_message() {
        console.log('Hello');
        $.ajax({
            url: '<?php echo site_url("seller/Chat/get_message"); ?>',
            type: "POST",
            data: {
                "chat_id" : document.getElementById('chat_id').value
            },
            success: function (response) {
                // console.log(response);
                var html = '';
                var res = JSON.parse(response);
                // console.log(res);

                for(var i = 0; i < res.length ; i++){
                    if (res[i]['send_to'] == 1) {
                        html += '<li class="sent"><p><span class="msg">'+res[i]["text_message"]+'</span><span class="date-time">'+res[i]["message_date"]+' '+res[i]["message_time"]+'</span></p></li>';
                    }else{
                        html += '<li class="replies"><p><span class="msg">'+res[i]["text_message"]+'</span><span class="date-time">'+res[i]["message_date"]+' '+res[i]["message_time"]+'</span></p></li>';
                    }
                }
                $('#refreshDiv').html(html);
                // $('.messages').scrollTop($('.messages')[0].scrollHeight);
            }
        });
    }
    function send_message() {
        var product_id   = document.getElementById('product_id').value;
        var customer_id  = document.getElementById('customer_id').value;
        var text_message = document.getElementById('text_message').value;
        var chat_id      = document.getElementById('chat_id').value;
        $('#btnSubmit').attr("disabled", true);    
        if (text_message != '') {
            $.ajax({
                // url: '<?php echo site_url("seller/Chat/send_message"); ?>?product_id='+product_id+'&chat_id='+chat_id+'$text_message='+text_message+'&customer_id='+customer_id,
                url: '<?php echo site_url("seller/Chat/send_message"); ?>',
                type: "POST",
                data: {
                    "product_id"   : product_id,
                    "chat_id"      : chat_id,
                    "customer_id"  : customer_id,
                    "text_message" : text_message
                },
                success: function (response) {

                    $('#btnSubmit').removeAttr("disabled");
                    $('#text_message').val("");
                    console.log(response);
                    if (response == '1') {
                        fg();
                    } 
                }
            });
        }else{
            $('#btnSubmit').removeAttr("disabled");
        }
    }
    function sendNotificationToCustomer()
    {
        var product_id      = document.getElementById('product_id').value;
        var customer_id     = document.getElementById('customer_id').value;
        var bargain_amount  = document.getElementById('bargain_amount').value;
        var total_quantity  = document.getElementById('total_quantity').value;
        var chat_id         = document.getElementById('chat_id').value;
        $.ajax({
            url: '<?php echo site_url("seller/Chat/sendNotificationToCustomer"); ?>',
            type: "POST",
            data: {
                "product_id"        : product_id,
                "chat_id"           : chat_id,
                "customer_id"       : customer_id,
                "total_quantity"    : total_quantity,
                "bargain_amount"    : bargain_amount
            },
            success: function (response) {
                console.log(response)
                if (response == 1) {
                    $("#success-alert").css('display','block');
                    $("#danger-alert1").css('display','none');
                    $("#danger-alert").css('display','none');
                    $("#danger-alerts").css('display','none');
                    $("#success-alert").fadeTo(3000, 1000).slideUp(1000, function(){
                       $("#success-alert").slideUp(1000);
                    });
                    document.getElementById('bargain_amount').value = '';
                    document.getElementById('total_quantity').value = '';
                    // location.reload();
                }else if (response == 2) {
                    $("#danger-alerts").css('display','none');
                    $("#danger-alert1").css('display','none');
                    $("#success-alert").css('display','none');
                    $("#danger-alerts").css('display','block');
                    $("#danger-alerts").fadeTo(3000, 1000).slideUp(1000, function(){
                       $("#danger-alerts").slideUp(1000);
                    });
                    document.getElementById('bargain_amount').value = '';
                    document.getElementById('total_quantity').value = '';
                    // location.reload();
                }else if (response == 3) {
                    $("#danger-alert").css('display','none');
                    $("#danger-alerts").css('display','none');
                    $("#success-alert").css('display','none');
                    $("#danger-alert1").css('display','block');
                    $("#danger-alert1").fadeTo(3000, 1000).slideUp(1000, function(){
                       $("#danger-alert1").slideUp(1000);
                    });
                    document.getElementById('bargain_amount').value = '';
                    document.getElementById('total_quantity').value = '';
                    // location.reload();
                }else{
                    $("#danger-alert1").css('display','none');
                    $("#danger-alerts").css('display','none');
                    $("#danger-alert").css('display','block');
                    $("#success-alert").css('display','none');
                    $("#danger-alert").fadeTo(3000, 1000).slideUp(1000, function(){
                       $("#danger-alert").slideUp(1000);
                    });
                    document.getElementById('bargain_amount').value = '';
                    document.getElementById('total_quantity').value = '';
                    // location.reload();
                }
            }
        });
    }
</script>