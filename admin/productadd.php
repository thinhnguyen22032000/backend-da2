﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php require_once '../classes/category.php';?>
<?php require_once '../classes/brand.php';?>
<?php require_once '../classes/product.php';?>

<?php 
   
   $product = new product();
   if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
    
    $product_add = $product->insert_product($_POST, $_FILES);

   }
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div style="height: 10px"></div>
          <?php 
                if(isset($product_add)){
                    echo $product_add;
                }
        ?> 
        <div class="block">
       
        <div style="height: 10px"></div>             
         <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="productName" placeholder="Nhập tên sản phẩm..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>-----Danh mục-----</option>
                            <?php 
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if($catlist){
                                    while($result = $catlist->fetch_assoc()) { ?>
                                     
                                     <option value="<?php echo $result['catid'] ?>"><?php echo $result['catName'] ?></option>
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
                            <option>-----Thương hiệu-----</option>
                            <?php 
                                $brand = new brand();
                                $brandlist = $brand->show_brand();
                                if($brandlist){
                                    while($result = $brandlist->fetch_assoc()) { ?>
                                     
                                     <option value="<?php echo $result['brandid'] ?>"><?php echo $result['brandName'] ?></option>
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
                        <textarea class="tinymce" name="productDesc"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Nhập giá..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Hình ảnh</label>
                    </td>
                    <td>
                        <input id="files"  name="image" type="file" />
                       
                        </script>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>-----Mức độ-----</option>
                            <option value="1">Featured</option>
                            <option value="0">Non-Featured</option>
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


