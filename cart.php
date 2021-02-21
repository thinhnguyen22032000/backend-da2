
<?php  
  include "inc/header.php";  
 ?>
 <?php 
       if(!isset($_GET['id'])){
       	echo "<meta http-equiv='refresh' content='0;URL=?id=live'";
       }
 ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				 
			    	<h2>Giỏ hàng</h2>
						<table class="tblone">
							<tr>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
								<th width="10%">Hành động</th>
							</tr>
							<!-- code cap nhat quantity  -->
							<?php                          
                            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
                               $quantity = $_POST['quantity'];
                               $productid = $_POST['productid'];
                               $update_quantity = $cart->update_quantity($productid, $quantity);

                            }

                            // code xoa product 
                            if(isset($_GET['delid'])){
                             	$delproduct = $_GET['delid'];
                          	    $product_delete = $cart->delete_product_on_cart($delproduct);
                            }
                                    
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
                                                                     
									<form action="" method="post">
										<input type="hidden" name="productid" value="<?php echo $result['productid']; ?>">
										<input type="number" name="quantity" value="<?php echo $result["quantity"]; ?>" min="0"/>
										<input type="submit" name="submit" value="Cập nhật"/>
									</form>
								</td>
								<td><?php
								  $subtotal = $result['price'] * $result["quantity"];
                                  echo $subtotal;
								  ?></td>
								<td><a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['cartid']?>">Xóa</a></td>
							</tr>
                            
						<?php
						$total_all += $subtotal; 
						$total_qty += $result["quantity"];
						}
						}
						else{
                            echo  "<span class='green'>Giỏ hàng của bạn hiện đang trống!!</span>"; 
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
								<td>15%</td>
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
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="paycart.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php 
   include "inc/footer.php";
 ?>
