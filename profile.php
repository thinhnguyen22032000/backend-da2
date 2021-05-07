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
?>
 
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				 <div class="heading">
        <h3>Thông tin khách hàng</h3>
        </div>
        <table class="tblone">
          <?php 
                 $get_ct_by_id = $customer->get_ct_by_id($id);
                 if($get_ct_by_id){   
                 while($result = $get_ct_by_id->fetch_assoc()){ ?>
                 
          <tr>
            <td>Tên</td>
            <td>:</td>
            <td><?php echo $result["name"] ?></td>
          </tr>
           <tr>
            <td>Địa chỉ</td>
             <td>:</td>
            <td><?php echo $result["address"] ?></td>
          </tr>
           <tr>
            <td>Thành phố</td>
             <td>:</td>
            <td><?php echo $result["city"] ?></td>
          </tr>
           <tr>
            <td>Quốc gia</td>
             <td>:</td>
            <td><?php 
        
                if($result["country"]==0){
                    echo "Việt Name";
                }elseif ($result["country"]==1) {
                    echo "America";
                }elseif($result["country"]==2){
                  echo "India";
                }else{
                  echo "China";
                }
            ?></td>
          </tr>
           <tr>
            <td>Zipcode</td>
             <td>:</td>
            <td><?php echo $result["zipcode"] ?></td>
          </tr>
          <tr>
            <td>Phone</td>
             <td>:</td>
            <td><?php echo $result["phone"] ?></td>
          </tr>
          <tr>
            <td>Mail</td>
             <td>:</td>
            <td><?php echo $result["email"] ?></td>
          </tr>
           <tr class="odd gradeX">
              <td colspan="3"><a href="editprofile.php?edid=<?php echo $result['id'] ?>">Chỉnh sửa</a></td>
          </tr>
            
           <?php  
                  }
                 }
           
          ?>
          
        </table>
			    	
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php 
   include "inc/footer.php";
 ?>