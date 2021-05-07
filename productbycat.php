<?php
    
  include "inc/header.php";
    
 ?>
<?php 
   
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'details.php'</script>";
    } else {
        $catid = $_GET['catid']; 
    }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    	<?php 
                $get_cat_name = $cat->show_cat_by_id($catid);
                if($get_cat_name){
                   while ($result = $get_cat_name->fetch_assoc()) { ?>

    		    <h3><?php echo $result['catName'] ?></h3>

    		 <?php	
                    }
                  }
                      
	      	?>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      	<?php 
                    $product_by_cat = $product->show_product_by_cat($catid);
                    if($product_by_cat){
                    	while ($result = $product_by_cat->fetch_assoc()) { ?>
                   
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo trim($result['image']);?>" alt="" /></a>
                     <div class="fix-ui">
					 <h2><?php echo $result["productName"] ?></h2>
					 <p><?php echo $fm->textShorten($result["productDesc"],30)?></p>
					 <p><span class="price"><?php echo $fm->canvert_vnd($result['price'])?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result["productid"] ?>" class="details">Chi tiết</a></span></div>
                 </div>
				</div>
				 <?php	
                    	}
                    }
                      
	      	?>
				
			</div>
      <!-- phan trang -->

      <div class="phantrang">
                
                 <?php 
                  $get_num_cm = $product->row_product_by_cat($catid);
                  if($get_num_cm){
                    echo "<p>Trang </p>";
                     $num_row = mysqli_num_rows($get_num_cm);
                     $page_product = ceil($num_row/4); 
                     for ($i=1; $i <= $page_product ; $i++){ 
                      echo "<a href='?catid=".$catid."&trang=".$i."'>".$i."<a/>";
                  }
                  }
                  else{

                  }
                 
            ?>
          </div>

	
	
    </div>
 </div>
</div>
<?php 
   include "inc/footer.php";
 ?>
   