<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


<?php require_once '../classes/product.php';?>

<?php 
   
   $product = new product();
   if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
    
    $slider_add = $product->insert_slider($_POST, $_FILES);

   }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Slider mới</h2>
        <div style="height: 10px"></div>
        <?php 
             if(isset($slider_add)){
                echo $slider_add;
             }
        ?>
    <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Tên slider</label>
                    </td>
                    <td>
                        <input type="text" name="sliderName" placeholder="Tên slider" class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Ảnh</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Chế độ</label>
                    </td>
                    <td>
                         <select name="type">
                             <option value="1">Hiện</option>
                             <option value="0">Ẩn</option>
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
<?php include 'inc/footer.php';?>