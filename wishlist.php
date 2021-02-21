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
 <?php
        if(isset($_GET['delid'])){
          $delid = $_GET['delid'];
          $del_product = $cart->del_product_wishlist($delid);
        }
      
  ?>
 
 </style>
 <style type="text/css">
   .pending {
    font-weight: bold;
    color: red;
   }
   .process {
    font-weight: bold;
    color: green;
   }
   .error{
  color:red;
  font-size: 18px;
}

.success {
  color:green;
  font-size: 18px;
}
 </style>


 <div class="main">
    <div class="content">
    	<div class="cartoption">			
          <div class="cartpage">
         
            <h2>Yêu thích</h2>
             </div> 
             <?php 
                   if(isset($del_product)){
                    echo $del_product;
                   }
             ?>
            <table class="tblone">
              <tr>
                <th width="15%">STT</th>
                <th width="15%">Tên sản phẩm</th>
                <th width="15%">Hình ảnh</th>
                <th width="15%">Giá</th>
                <th width="10%">Hành động</th>
                
                
              </tr>
              <?php                          
              
                                    
               // code show gio hang
                 $get_wishlist = $cart->show_wishlist($id);

                    if($get_wishlist != false){
                            $i = 0;   
                       while($result = $get_wishlist->fetch_assoc()){
                            $i++;
                        ?>
                             
                           
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result["productName"]; ?></td>
                <td><img src="admin/uploads/<?php echo trim($result['image']) ?>" alt=""/></td>
                <td><?php echo $result["price"]; ?></td>
                <td><a href="details.php?proid=<?php echo $result['productid']?>">Chi tiết</a> || <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['productid']?>">Xóa</a></td>
                
              </tr>            
            <?php
              
                 
               }
            }
            ?>  
                                                              
              
            </table>
          
         
         
       <div class="clear"></div>
    </div>
 </div>
</div>

<?php 
   include "inc/footer.php";
 ?>