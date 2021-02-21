<?php
    
  require_once "inc/header.php";
  include "inc/slider.php";  
 ?>

 <?php 
      if(isset($_GET['trang'])){
        $trang = $_GET['trang'];
      }
      else{
        $trang = 1;
      }
 ?>
	
<style type="text/css">
    .grid_1_of_4{
    min-height: 400px;

}
.phantrang a{
   padding-right: 5px;
}
</style>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nổi bậc</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    	
	      <div class="section group">
	      	<?php 
    	         
                 $getproduct = $product->getProduct_feathered();
                 if($getproduct){
                 	while($result = $getproduct->fetch_assoc()) { ?>
                 
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo trim($result['image']) ?>" alt="" /></a>
                    <div class="fix-ui">
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['productDesc'],70)?></p>
					 <p><span class="price"><?php echo $fm->canvert_vnd($result['price']) ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productid'] ?>" class="details">Chi tiết</a></span></div>
                    </div>
				</div>
			<?php 	
                 	}
                 }   
    	    ?>
			</div>
             <div class="phantrang">
                <p>Trang</p>
                 <?php 
                  $get_productf = $product->get_productf();
                  $num_row = mysqli_num_rows($get_productf);
                  $page_product = ceil($num_row/4); 
                   for ($i=1; $i <= $page_product; $i++){ 
                  echo "<a href='?trangf=".$i."'>".$i."<a/>";
                  }
                 
                  
            ?>
            </div>
				
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sản phẩm mới</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">

	      	<?php 
                 $getproduct = $product->getProduct_new();
                 if($getproduct){
                    $i=0;
                 	while($result = $getproduct->fetch_assoc()) { 
                        $i++;
                        ?>

				<div class="grid_1_of_4 images_1_of_4" style="<?php if($i == 1){echo "margin-left: 0";}  ?>">
					 <a href="details.php"><img src="admin/uploads/<?php echo trim($result['image']) ?>" alt="" /></a>
                 <div class="fix-ui">
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><span class="price"><?php echo $result['price'] ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productid'] ?>" class="details">Chi tiết</a></span></div>
                 </div>
				</div>

				<?php 	
                 	}
                 }
                 
    	 ?>
			</div>

           <div class="phantrang">
                <p>Trang</p>
                 <?php 
                  $get_all_product = $product->get_all_product();
                  $num_row = mysqli_num_rows($get_all_product);
                  $page_product = ceil($num_row/4); 
                  for ($i=1; $i <= $page_product ; $i++){ 
                      echo "<a href='?trang=".$i."'>".$i."<a/>";
                  }
            ?>
            </div>
           
    </div>
 </div>
 <?php 
   include "inc/footer.php";
 ?>


