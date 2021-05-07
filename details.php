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
.comment{
	width: 800px;
  border: 1px solid #eeeeee;
    padding: 20px;

}
.comment-input{
      outline: none;
    border-radius: 5px;
    border: 2px solid gray;
    width: 750px;
}
.button{
    padding: 5px 18px;
    color: white;
    background-color: #6b05be;

}


/*//-----------------*/
.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
 
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;

}

.container img.right {
 
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.h2cm{
  font-size: 20px;
  padding: 10px 15px;
  color: white;
  background-color: #6aba6a;
}
.name_cm{
  color: grey;
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
        <div style="height: 10px"></div>

       <!--  thêm san phẩm vào list live -->
				<?php if(isset($add_to_wishlist)){
				         echo $add_to_wishlist;
			              } 
                
			            ?>
             <!--  thêm vào card -->
      <?php if(isset($addtocart)){
                 echo $addtocart;
                    } 
                
                  ?>
			</div>
    
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

 	       <?php 
 	         $check_ct = Session::get('customer_login');
 	         if($check_ct){
            	        
                 if(isset($_POST["submit_cm"])){
                 	$id_product = $_GET["proid"];
                 	  $comment = $_POST["comment"];
                    $name =  Session::get("customer_name");
                    $customer_id = Session::get("customer_id");

                    $insert_comment = $product->insert_comment($customer_id, $id_product, $comment, $name);
                 } ?>
 	       
		 	 <div class="comment">
		    	<form action="" method="post">	    		
						  <p>Bình luận</p>
						  <textarea class="comment-input" name="comment"></textarea>
					     <input class="button" type="submit" name="submit_cm" value="Gửi">
		    	</form>
		    </div>
		 <?php
		    
		}
           
           ?>
	</div>
	
   <!--  Hiển thị đánh giá -->
  <div class="comment">
   <h2 class="h2cm">Đánh giá khách hàng</h2>
   <div class="container-cm">
   
   	 <?php 
   	    $id_product = $_GET["proid"];
        $show_comment = $product->show_comment_page($id_product);
        if($show_comment){
        	while($result = $show_comment->fetch_assoc()){ ?>
   	      
             <div class="container">
              <img style="border-radius: 50%; border: 1px solid black;width: 50px;height: 50px" src="images/anime.jfif">
              <p class="name_cm"><?php echo $result['name'] ?></p>
              <p><?php echo $result['comment']?></p>
              <span class="time-right"><?php echo date("d/m/Y H:m:s", strtotime($result['date_comment']))?></span>
            </div>
   	       <?php
        	}
        }
   ?>
   
</div>
 <div class="phantrang">
                
                 <?php 
                  $get_num_cm = $product->show_comment($id_product);
                  if($get_num_cm){
                    echo "<p>Trang </p>";
                     $num_row = mysqli_num_rows($get_num_cm);
                     $page_product = ceil($num_row/5); 
                     for ($i=1; $i <= $page_product ; $i++){ 
                      echo "<a href='?proid=".$id_product."&trang=".$i."'>".$i."<a/>";
                  }
                  }
                  else{

                  }
                 
            ?>
          </div>
</div>


	<?php 
   include "inc/footer.php";
 ?>
  
