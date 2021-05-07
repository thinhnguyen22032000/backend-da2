<?php
 
 include "inc/header.php";
?>
<?php 
    $id_ct = Session::get("customer_id");
    if($id_ct){
      $id = $id_ct;
    }
 ?>

 <?php 
       if(isset($_GET["order"]) && $_GET["order"] == "order"){
    
          $insert_order = $cart->insert_order($id);

   }
 
 ?>
<style type="text/css">
	
/*.box_left{
	width: 55%;
    border: 1px solid gray;
    float: left;
}

.box_right{
	width: 44%;
    border: 1px solid gray;
    float: right;
}

.submit-order{
	padding: 10px 25px;
    background-color: #ffc91b;
}*/


</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
		    <div class="cartpage">
				 <div class="heading">
            <h3>Thanh toán không trực tuyến</h3>
        </div>


    </div> 
    <?php 
             if(isset($insert_order)){
             	echo $insert_order;
             }
        ?>
        <div class="box_left">
        	<table class="tblone">
							<tr>
								<th width="20%">Tên sản phẩm</th>
								<th width="20%">Hình ảnh</th>
								<th width="15%">Giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
								
							</tr>
							<?php                             
                                    
							 // code show gio hang
                                    $get_product_cart = $cart->get_product_cart();

                                    if($get_product_cart != false){
                                      $total_all = 0;
                                      $total_qty = 0;
                                  	while($result = $get_product_cart->fetch_assoc()){
							        
                            ?>
                             
                           
							<tr>
								<td><?php echo $result["productName"]; ?></td>
								<td><img src="admin/uploads/<?php echo trim($result['image']) ?>" alt=""/></td>
								<td><?php echo $result["price"]; ?></td>
								<td>
                                     <?php echo $result['quantity']; ?>                                
								</td>
								<td><?php
								  $subtotal = $result['price'] * $result["quantity"];
                                  echo $subtotal;
								  ?></td>
								
							</tr>
                            
						<?php
						$total_all += $subtotal; 
						$total_qty += $result["quantity"];
						}
						}
						else{
                            echo  "<span class='error' style='color:green; font-size:18px'>Giỏ hảng của bạn hiện đang trống</span>"; 
						}
						?>	
                                															
							
						</table>
						<?php  if(isset($total_qty) && isset($total_all)){ ?>

						
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Tổng : </th>
								<td><?php
								 
								 	echo $fm->canvert_vnd($total_all);
								
								 ?></td>
							</tr>
							<tr>
								<th>Thuế : </th>
								<td>15% (<?php echo $fm->canvert_vnd($total_all * 0.15); ?>)</td>
							</tr>
							<tr>
								<th>Tổng + thuế :</th>
								<td><?php
                                  
								 	$total_all = $total_all * 0.15 + $total_all; 
								    echo $total_all_vnd = $fm->canvert_vnd($total_all);
								    session::set("sum", $total_all_vnd);
								    session::set("qty", $total_qty);


								 ?></td>
							</tr>
					   </table>
					   <?php
					   } ?>
        </div>
        <div class="box_right">
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
           <!-- <tr>
            <td>Quốc gia</td>
             <td>:</td>
            <td><?php echo $result["country"] ?></td>
          </tr> -->
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
           <?php  
                  }
                 } 
          ?>
          
        </table>
        </div>
 	</div>
	</div>
	<center style="margin-bottom: 20px"><a class="submit-order" href="?order=order">Đặt hàng</a></center>
	<?php 
   include "inc/footer.php";
 ?>
  
