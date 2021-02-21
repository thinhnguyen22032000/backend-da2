<?php
    
  include "inc/header.php";
    
 ?>
<?php 
     if(isset($_POST['key'])){
        $key = $_POST['key'];
     }
     
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
                <h2>Từ khóa : <?php 
                   if(isset($key)){
                    echo $key;
                   }
                 ?></h2>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      	<?php 
                    $product_by_key = $product->show_product_by_key($key);
                    if($product_by_key){
                    	while ($result = $product_by_key->fetch_assoc()) { ?>
                   
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo trim($result['image']);?>" alt="" /></a>
                     <div class="fix-ui">
					 <h2><?php echo $result["productName"] ?></h2>
					 <p><?php echo $fm->textShorten($result["productDesc"],30)?></p>
					 <p><span class="price"><?php echo $result["price"] ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result["productid"] ?>" class="details">Chi tiết</a></span></div>
                 </div>
				</div>
				 <?php	
                    	}
                    }
                      
	      	?>
				
			</div>

	
	
    </div>
 </div>
</div>
<?php 
   include "inc/footer.php";
 ?>