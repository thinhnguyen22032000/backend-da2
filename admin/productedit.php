<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php require_once '../classes/category.php';?>
<?php require_once '../classes/brand.php';?>
<?php require_once '../classes/product.php';?>

<?php 
   
   $product = new product();
   if(!isset($_GET['productid']) || $_GET['productid'] == NULL) {
        echo "<script>window.location = 'productlist.php'</script>";
    } else {
        $productid = $_GET['productid']; 
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
   
     $productedit = $product->update_product($_POST, $_FILES, $productid);
  
   }


?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Cập nhật sản phẩm</h2>
        <?php 
               if(isset($productedit)){
                echo $productedit;
               }
        ?>
        <?php 
         $getProductId = $product->getProductById($productid);
         
         if($getProductId){
            while($result_pd = $getProductId->fetch_assoc()){ 
        ?>
         
                            

        <div class="block"> 

         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">

                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" value="<?php  echo $result_pd['productName']?>" name="productName" placeholder="Nhập tên sản phẩm..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>-----Chọn danh mục-----</option>
                            <?php 
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if($catlist){
                                    while($result = $catlist->fetch_assoc()) { ?>
                                     
                                     <option
                                             <?php 

                                                    if($result['catid'] == $result_pd['catid']){
                                                        echo 'selected';
                                                    }
                                             ?>
                                       
                                      value="<?php echo $result['catid'] ?>"><?php echo $result['catName'] ?></option>
                                     <?php
                                    }
                                }
                                
                            ?>
                         
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>-----Chọn thương hiệu-----</option>
                            <?php 
                                $brand = new brand();
                                $brandlist = $brand->show_brand();
                                if($brandlist){
                                    while($result = $brandlist->fetch_assoc()) { ?>
                                     
                                     <option
                                      <?php 
                                           if($result['brandid'] == $result_pd['brandid']){echo 'selected';}
                                       
                                      ?>
                                        
                                      value="<?php echo $result['brandid'] ?>"><?php echo $result['brandName'] ?></option>
                                     <?php
                                    }
                                }
                                
                            ?>
                        </select>
                    </td>
                </tr>
                
                 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="productDesc"><?php  echo $result_pd['productDesc']?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" value="<?php  echo $result_pd['price']?>" name="price" placeholder="Nhập giá..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Hình ảnh</label>
                    </td>
                    <td>
                        <img  height="90"  src="uploads/<?php echo trim($result_pd['image']);?>"><br>
                        <input  name="image" type="file"  />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                           <?php 
                                if($result_pd['type'] == 1){    ?>
                                <option selected value="1">Featured</option>
                                <option value="0">Non-Featured</option>
                                <?php 
                                 }else{
                                ?>
                                <option value="1">Featured</option>
                                <option selected value="0">Non-Featured</option>  
                                <?php 
                            }
                            ?>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Lưu" />
                    </td>
                </tr>                         
            </table>
            </form>
            <?php       
         }
         }

        ?> 

        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php require_once 'inc/footer.php';?>


