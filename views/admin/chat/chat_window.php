<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('seller/Dashboard');?>">Home</a></li>
			<li class="active">Add Category</li>
			<li></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner"> 
        <div class="row">
            <div class="col-xs-12">
            	<div class="chat-window">
            		<!-- 

A concept for a chat interface. 

Try writing a new message! :)


Follow me here:
Twitter: https://twitter.com/thatguyemil
Codepen: https://codepen.io/emilcarlsson/
Website: http://emilcarlsson.se/

-->

					<div id="frame">
						<div class="content">
							<div class="contact-profile">
								<img src="https://www.eharmony.co.uk/dating-advice/wp-content/uploads/2011/04/profilephotos-960x640.jpg" alt="" />
								<p>Harvey Specter</p>
								
							</div>
							<div class="messages">
								<ul>
									<li class="sent">
										<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
										<p>
										<span class="msg">How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</span>
										<span class="date-time">2:00 am,18/4/19</span>
									   </p>
									</li>
									<li class="replies">
										<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
										<p><span class="msg">When you're backed against the wall, break the god damn thing down.
									    </span>
										<span class="date-time">2:00 am,18/4/19</span>
										</p>
									</li>
								
								</ul>
							</div>
							<div class="message-input">
								<div class="wrap">
								<textarea class="type-msg" placeholder="">
									
								</textarea>		
  							    <button type="button" class="btn btn-default btn-sm">
						          <span class="glyphicon glyphicon-send"></span> 
						        </button>
								</div>
							</div>
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
    $( document ).ready(function() {
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
</script>