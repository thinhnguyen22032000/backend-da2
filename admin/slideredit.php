<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


<?php require_once '../classes/product.php';?>

<?php 
   
   $product = new product();
   if(!isset($_GET['eid']) || $_GET['eid'] == NULL) {
        echo "<script>window.location = 'sliderlist.php'</script>";
    } else {
        $id = $_GET['eid']; 
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
   
     $edit_slider = $product->update_slider($_POST, $_FILES, $id);
  
   }


?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Cập nhật Slider</h2>
        <?php 
             if(isset($edit_slider)){
                echo $edit_slider;
             }
        ?>
        <!-- <?php 
             if(isset($slider_add)){
                echo $slider_add;
             }
        ?> -->
    <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form"> 
            <?php 
                  $get_slider = $product->get_slider_by_id($id);
                    if($get_slider){
                        while($result = $get_slider->fetch_assoc()){ ?>


                <tr>
                    <td>
                        <label>Tên slider</label>
                    </td>
                    <td>
                        <input type="text" name="sliderName" placeholder="Tên slider" value="<?php echo $result['sliderName'] ?>" class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Ảnh</label>
                    </td>
                    <td>
                        <img style="width: 90px" src="uploads/<?php echo $result['image'] ?>"><br>
                        <input type="file" name="image"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Chế độ</label>
                    </td>
                    <td>
                         <select name="type">
                            <?php 
                                if($result['type'] == 0){    ?>
                                <option selected value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                                <?php 
                                 }else{
                                ?>
                                <option selected value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                                <?php 
                            }
                            ?>
                         </select>
                    </td>
                </tr> 
               
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Cập nhật" />
                    </td>
                </tr>
                  <?php
                        }
                    }  
                     
             ?>    
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