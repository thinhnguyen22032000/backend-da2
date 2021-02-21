<?php  
  include "inc/header.php";  
 ?>

 <?php 
         $check_user = Session::get('customer_login');
                    if(!$check_user){
                    	header("location: login.php");
                    }
         $id_ct = Session::get("customer_id");
             if($id_ct){
               $id = $id_ct;
             }

 ?>
 <style type="text/css">
    h3{
     color: green;
    font-size: 25px;
    text-align: center;
    }
    p{
        text-align: center;
        color: red;
        
    }
    .sussesf{
        margin-top: 40px;
        margin-bottom: 100px;
   
    }
    .sussesf a {
        text-decoration: underline;
    }

 </style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">			
          <h3>Đặt hàng thành công</h3>
             <div class="sussesf">
                <?php 
                     $get_price_bill = $cart->get_price_bill($id);
                     if($get_price_bill){
                                           ?>
                          <p>Tổng số tiền bạn cần thanh toán là : <?php echo $total = 0.15 * $get_price_bill + $get_price_bill." ".'vnđ(Thuế 15%)'?></p>
                          <?php  
                        
                     }
                ?>
              
              <p>Chúng tôi sẽ sớm liên hệ với bạn, vui lòng xem lại những sản phẩm của bạn <a href="order.php">here</a></p>
				 
			   </div> 	
    

       <div class="clear"></div>
    </div>
 </div>
</div>
<?php 
   include "inc/footer.php";
 ?>
