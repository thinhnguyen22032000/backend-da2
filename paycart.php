<?php  
  include "inc/header.php";  
 ?>
<?php 
    $check_login = Session::get("customer_login");
    if($check_login == false){
      header("location:login.php");
    }
    // $id_ct = Session::get("customer_id");
    // if($id_ct){
    //   $id = $id_ct;
    // }
?>
 <style type="text/css">
   .shopping{
    
    width: 100%;
    height: 200px;
    text-align: center;
  }
   .shopping h3{
    margin-bottom: 100px;
    font-size: 25px;
    
   }
    .shopleft a, .shopright a{
    
    padding: 15px 25px;
   
   }
 </style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				 <div class="heading">
        <h3>Phương thức thanh toán</h3>
        </div>
    	</div> 
        
      <div class="shopping">
            <h3>Chọn phương thức thanh toán</h3>
            <div class="shopleft">
              <a href="onlinepay.php" class="buysubmit">Pay Online</a>
            </div>
            <div class="shopright">
              <a href="offlinepay.php" class="buysubmit">Pay Offline</a>
            </div>
          </div> 	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php 
   include "inc/footer.php";
 ?>