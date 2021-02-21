<?php
  include "inc/header.php";
 ?>
    
 
<style type="text/css">
	
	table.form {
	width:100%;
}
table.form td {
	padding:4px 0px;
}
table.form label {
	font-weight:bold;
}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">

                  <?php 
                        // check isset productid
                        if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
                            echo "<script>window.location = 'index.php'</script>";
                        } else {
                           $proid = $_GET['proid']; 
                        }

                        // add product to cart
                        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
                          $quantity = $_POST["quantity"];
                          $addtocart = $cart->add_to_cart($proid, $quantity);

                        }
                        // add wish list
                         
                        
                         if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_wish'])){
                         $check_ct = Session::get('customer_id');
                           if($check_ct){
                        	$customer_id = $check_ct;
                          }
                           else{
                         	  header("location: login.php");
                          }
                          $proid = $_POST['proid'];
                          $add_to_wishlist = $cart->add_to_wishlist($proid,$customer_id);

                        }

                     
                  ?>

                   <?php
                        // show product detail
                        $getproduct = $product->show_product_detail($proid);

                        if($getproduct){
                 	    while($result = $getproduct->fetch_assoc()) { ?>
                       
                  

				<div class="grid images_3_of_2">
						<img style="width: auto" src="admin/uploads/<?php echo trim($result['image']) ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'] ?></h2>
					<p><?php echo $fm->textShorten($result['productDesc'],500)?></p>					
					<div class="price">
						<p>Giá: <span><?php echo $result['price'] ?></span></p>
						<p>Danh mục: <span><?php echo $result['catName'] ?></span></p>
						<p>Thương hiệu:<span><?php echo $result['brandName'] ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Mua ngay"/>
					</form>				
				</div>

				<div class="add-cart">
					<form action="" method="post">
						<input type="hidden" name="proid" value="<?php echo $result['productid'] ?>" />
						<span class="grey">Sản phẩm yêu thích</span>
						<input type="submit" class="buysubmit" name="submit_wish" value="Thêm"/>
					</form>				
				</div>
				<?php if(isset($add_to_wishlist)){
				         echo $add_to_wishlist;
			              } 
                
			            ?>
			</div>
			<?php if(isset($addtocart)){
				         echo $addtocart;
			              } 
                
			            ?>
			<div class="product-desc">
			<h2>Chi tiết sản phẩm</h2>
	        <p><?php echo $result['productDesc']?></p>
	    </div>
				
	</div>
	<?php 	
                 	}
                 }
                 
    	 ?>
				<div class="rightsidebar span_3_of_1">
					<h2>Danh mục</h2>
					<?php 
                          $get_category = $cat->show_category();
                          if($get_category){
                          	while ($result = $get_category->fetch_assoc()) { ?>
                          	

					<ul>
				      <li><a href="productbycat.php?catid=<?php echo $result["catid"] ?>"><?php echo $result["catName"] ?></a></li>
				     
    				</ul>
    				<?php	
                          	}
                          }
                    
					?>
    	
 				</div>
 		</div>
 	</div>
		 	 <div class="comment">
		    	<form action="" method="post">
		    		<table class="form">
						  <label >Bình luận</label>
						  <textarea name="comment"></textarea>
						  <input type="submit" name="submit" value="Gửi">
					</table>
		    	</form>
		    </div>
	</div>
   <!--  comment -->


	<?php 
   include "inc/footer.php";
 ?>
  
