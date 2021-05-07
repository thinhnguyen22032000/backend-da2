<?php
    
  include "inc/header.php";
   
 ?>
 <?php 
      $check_user = Session::get('customer_login');
                    if($check_user){
                    	header("location:order.php");
                    }
 ?>

 <?php 
   // đăng kí tk
   if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
    
     $register_customer = $customer->insert_customer($_POST);

   }


   if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_cart'])){
    
     $check_login = $customer->check_login($_POST);

   }
?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Đăng nhập</h3>
        	<p style="color: #42a5f5">Điền thông tin để xác thực</p>
        	  <?php 
                  if(isset($check_login)){
                  	echo $check_login;
                  }
                  
        	?> 
        	<form action="" method="post" id="member">
                	<input name="email" type="text"  class="field" placeholder="Nhập email...">
                    <input name="password" type="password"  class="field" placeholder="Nhập mật khẩu..." >
                    <div class="buttons"><div><input type="submit" name="submit_cart" class="grey" style="background-color: #0097a7;
    color: white;" value="Đăng nhập"></div></div>
                 </form>
                 <!-- <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p> -->
                    
                    </div>
    	<div class="register_account">
    		<h3>Đăng kí tài khoản</h3>
    		<?php 
                 if(isset($register_customer)){
                 	echo $register_customer;
                 }
    		?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Nhập tên..." >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Nhập thành phố...">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Nhập Zip-Code...">
							</div>
							<div>
								<input type="text" name="email" placeholder="Nhập email...">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Nhập địa chỉ...">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Chọn quốc gia</option>         
							<option value="0">Việt Nam</option>
							<option value="1">America</option> 
							<option value="2">India</option> 
							<option value="3">China</option> 

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Nhập số điện thoại...">
		          </div>
				  
				  <div>
					<input type="password" name="password" style="width: 352px;
															      height: 27px;
																  margin-top: 6px;
																  outline: none;" 
                     placeholder="Nhập mật khẩu...">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" style="background-color: #0097a7;
    color: white;" value="Đăng kí"></div></div>
		   <!--  <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p> -->
		   

		    <div class="clear"></div>
		    <p style="margin-top: 10px">Lưu ý: Để giao dịch trở nên tiện lợi, nhanh chóng, quí khách hàng vui lòng đăng kí thông tin chính xác!!</p>
		    
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
  <?php 
   include "inc/footer.php";
 ?>

