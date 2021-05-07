<?php
    
  include "inc/header.php";
    
 ?>
<?php 
     if(isset($_GET['sp'])){
        $key = $_GET['sp'];
     }
     
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
                <h2>Từ khóa : <?php 
                   if(isset($key)){
                    echo $key;
                   }else{
                    echo $key = "";
                   
                   }
                 ?></h2>
    		</div>
           <?php 
                  if(isset($product_by_key)){
                    echo $product_by_key;
                  }

            ?> 
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

	      	<?php 
                    $product_by_key = $product->show_product_by_key($key);
                    if(!$product_by_key==0){
                        $i = 1;
                    	while ($result = $product_by_key->fetch_assoc()) { ?>
                   
				<div class="grid_1_of_4 images_1_of_4" style="<?php if($i == 5){echo "margin-left: 0px";} ?>">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo trim($result['image']);?>" alt="" /></a>
                     <div class="fix-ui">
					 <h2><?php echo $result["productName"] ?></h2>
					 <p><?php echo $fm->textShorten($result["productDesc"],30)?></p>
					 <p><span class="price"><?php echo $result["price"] ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result["productid"] ?>" class="details">Chi tiết</a></span></div>
                 </div>
				</div>
				 <?php
                 $i++;	
                    	}

                    }
                    else{
                          echo "<div class='err' style=margin-top:10px>Không tìm thấy sản phẩm!!</div>";
                          echo "<div style='height:200px'></div>";
                     } 
	      	?>
				
			</div>

         <div class="phantrang">
                
                 <?php 
                  $get_num_cm = $product->row_product_by_key($key);
                  if($get_num_cm){
                    echo "<p>Trang </p>";
                     $num_row = mysqli_num_rows($get_num_cm);
                     $page_product = ceil($num_row/4); 
                     for ($i=1; $i <= $page_product ; $i++){ 
                      echo "<a href='?sp=".$key."&trang=".$i."'>".$i."<a/>";
                  }
                  }
                  else{

                  }
                 
            ?>
          </div>
</div> 
                    


	
	
    </div>
 </div>
</div>
<?php 
   include "inc/footer.php";
 ?>