<?php  
  include "inc/header.php";  
 ?>
<?php 
    $check_login = Session::get("customer_login");
    if($check_login == false){
      header("location:login.php");
    }
    $id_ct = Session::get("customer_id");
    if($id_ct){
      $id = $id_ct;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
   
     $update_ct = $customer->update_customer($id,$_POST);
  
   }
?>
 
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				 <div class="heading">
        <h3>Thông tin khách hàng</h3>
        </div>
        <form action="" method="post">
        <table class="tblone">
          <?php 
                 $get_ct_by_id = $customer->get_ct_by_id($id);
                 if($get_ct_by_id){   
                 while($result = $get_ct_by_id->fetch_assoc()){ ?>
          <tr>
            <?php 
               if(isset($update_ct)){
                echo "<td colspan='3'>".$update_ct."</td>";
               }
         ?>
          </tr>
                 
          <tr>
            <td>Tên</td>
            <td>:</td>
            <td><input type="text" name="name" value="<?php echo $result["name"] ?>"></td>
            
          </tr>
           <tr>
            <td>Địa chỉ</td>
             <td>:</td>
             <td><input type="text" name="address" value="<?php echo $result["address"] ?>"></td>
            
          </tr>
           <tr>
            <td>Thành phố</td>
             <td>:</td>
             <td><input type="text" name="city" value="<?php echo $result["city"] ?>"></td>
           
          </tr>
        
           <tr>
            <td>Zipcode</td>
             <td>:</td>
             <td><input type="text" name="zipcode" value="<?php echo $result["zipcode"] ?>"></td>
            
          </tr>
          <tr>
            <td>Phone</td>
             <td>:</td>
             <td><input type="text" name="phone" value="<?php echo $result["phone"] ?>"></td>
           
          </tr>
          <tr>
            <td>Mail</td>
             <td>:</td>
             <td><input type="text" name="email" value="<?php echo $result["email"] ?>"></td>
       
          </tr>
           <tr class="odd gradeX">
              <td colspan="3"><input type="submit" name="submit" value="Cập nhật"></td>
          </tr>
            
           <?php  
                  }
                 }
           
          ?>
          
        </table>
			  </form>  	
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php 
   include "inc/footer.php";
 ?>