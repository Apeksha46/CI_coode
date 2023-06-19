<style type="text/css">
   /* CSS used here will be applied after bootstrap.css */
.badge-notify1
{
background:red;
position:relative;
margin-top: 5px;
float: right;
}
#showSale{
    position: absolute;
    top: 15px;
    right: 15px;
    background: red;
    color: #fff;
    padding: 4px;
    font-size: 10px;
    border-radius: 50px;
    width: 40px;
    text-align: center;
}
</style>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="collapse navbar-collapse sidebar-collapse" id="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <?php
                // $active = $this->uri->segment(3);
                $last = $this->uri->total_segments();
                $record_num = $this->uri->segment($last);
                $record_num1 = $this->uri->segment($last-1);
            ?>
            <li>
                <a <?php if($record_num=='dashboard'){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a <?php if($record_num=='User' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/User/total_user');?>"><i class="fa fa-list-alt "></i>Total User</a>
            </li>
            <li>
                <a <?php if($record_num=='User' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/User');?>"><i class="fa fa-list-alt "></i>Normal User</a>
            </li>
            <li>
                <a <?php if($record_num=='direct_user' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/User/direct_user');?>"><i class="fa fa-list-alt "></i>Direct User</a>
            </li>
            <li>
                <a <?php if($record_num=='general_setting' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/General_Setting');?>"><i class="fa fa-desktop"></i>General Setting</a>
            </li>
            <li>
                <a <?php if($record_num=='About_us' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/About_us');?>"><i class="fa fa-desktop"></i>About Us</a>
            </li>
            <li>
                <a <?php if($record_num=='Privacy_Policy' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Privacy_Policy');?>"><i class="fa fa-list-alt "></i>Privacy Policy</a>
            </li>
            <li>
                <a <?php if($record_num=='TermCondition' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/TermCondition');?>"><i class="fa fa-list-alt "></i>Terms & Condition</a>
            </li>
            <li>
                <a <?php if($record_num=='Web_Slider' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Web_Slider');?>"><i class="fa fa-list-alt "></i>Web Slider</a>
            </li>
            <li>
                <a <?php if($record_num=='Wishes' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Wishes');?>"><i class="fa fa-list-alt "></i>Wishes</a>
            </li>
             <li>
                <a <?php if($record_num=='Category' || $record_num=='add_category' || $record_num1=='edit_category' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Category');?>"><i class="fa fa-list-alt "></i>Category</a>
            </li>
            <li>
                <a <?php if($record_num=='SubCategory' || $record_num=='add_sub_category' || $record_num1=='edit_sub_category' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/SubCategory');?>"><i class="fa fa-list-alt "></i>Sub-Category</a>
            </li>
           
            <li>
                <a <?php if($record_num=='Product' || $record_num=='add_product' || $record_num1=='edit_Product' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Product');?>"><i class="fa fa-list-alt "></i>Product</a>
            </li>
            <li>
                <a <?php if($record_num=='Package' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Package');?>"><i class="fa fa-list-alt "></i>Package</a>
            </li>
            <li>
                <a href="#" <?php if($record_num=='Booking' || $record_num=='past_booking' || $record_num=='future_booking' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?>><i class="fa fa-user"></i> Booking<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php if($record_num=='past_booking' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Booking/past_booking'); ?>">Past Booking</a>
                    </li>
                    <li>
                        <a <?php if($record_num=='Booking' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Booking/'); ?>">Today Booking</a>
                    </li>
                    <!--<li>-->
                    <!--    <a <?php if($record_num=='future_booking'){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Booking/future_booking'); ?>">Future Booking</a>-->
                    <!--</li>-->
                </ul>
            </li>
            <li>
                <a href="#" <?php if($record_num=='gold_user' || $record_num=='silver_user' || $record_num=='bronze_user' || $record_num=='platinum_user' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?>><i class="fa fa-user"></i> Package User<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php if($record_num=='bronze_user' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Package/bronze_user'); ?>">Bronze User</a>
                    </li>
                    <li>
                        <a <?php if($record_num=='silver_user' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Package/silver_user'); ?>">Silver User</a>
                    </li>
                    <li>
                        <a <?php if($record_num=='gold_user'){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Package/gold_user'); ?>">Gold User</a>
                    </li>
                    <li>
                        <a <?php if($record_num=='diamond_user'){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Package/diamond_user'); ?>">Diamond User</a>
                    </li>
                    <li>
                        <a <?php if($record_num=='platinum_user'){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Package/platinum_user'); ?>">Platinum User</a>
                    </li>
                    <li>
                        <a <?php if($record_num=='platinum_plus_user'){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Package/platinum_plus_user'); ?>">Platinum Plus User</a>
                    </li> 
                </ul>
            </li>
            <!-- <li>
                <a href="#"<?php if($record_num=='Product' || $record_num=='add_product' || $record_num1=='edit_Product' || $record_num=='color_list' || $record_num=='addColorSize'  || $record_num=='editColorSize'){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?>><i class="fa fa-list-alt"></i> Manage Stock/Product<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php if($record_num=='Product' || $record_num=='add_product' || $record_num1=='edit_Product' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Product');?>"><i class="fa fa-list-alt "></i>Product</a>
                    </li>
                    <li>
                        <a <?php if($record_num=='color_list' || $record_num=='addColorSize'  || $record_num=='editColorSize'){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Product/color_list  '); ?>"><i class="fa fa-list-alt "></i>Color</a>
                    </li>
                </ul>
            </li> -->
            
            <!-- <li>
                <a href="#"<?php if($record_num=='Sale_Product' || $record_num=='add_sale_product' || $record_num1=='edit_sale_product' || $record_num=='sale_color_list' || $record_num=='sale_addColorSize'  || $record_num=='sale_editColorSize'){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?>><i class="fa fa-list-alt"></i> Xiri Sale Stock/Product<span class="fa arrow"></span>
                    <span id="showSale" style="display: none">Sale</span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php if($record_num=='Sale_Product' || $record_num=='add_sale_product' || $record_num1=='edit_sale_product'){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Sale_Product');?>"><i class="fa fa-list-alt "></i>Product</a>
                    </li>
                    <li>
                        <a <?php if($record_num=='sale_color_list' || $record_num=='sale_addColorSize'  || $record_num=='sale_editColorSize'){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Sale_Product/sale_color_list'); ?>"><i class="fa fa-list-alt "></i>Color</a>
                    </li>
                </ul>
            </li>
            
            
            <li>
                <a <?php if($record_num=='chat_list' || $record_num=='chatting' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Chat');?>" >
                    <i class="fa fa-comments-o "></i>Chat
                    <span id="chatCount"></span>
                </a>
            </li>
            <li>
                <a <?php if($record_num=='Offline' ){ ?>class="active-menu"<?php }else{ ?>class=""<?php } ?> href="<?php echo site_url('admin/Offline/');?>" >
                    <i class="fa fa-list-alt "></i>Offline Shopping
                </a>
            </li> -->
        </ul>
    </div>
</nav>
