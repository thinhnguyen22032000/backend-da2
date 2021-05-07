<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php 
   
   $brand = new brand();
  

if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
        echo "<script>window.location = 'brandlist.php'</script>";
    } else {
        $brandid = $_GET['brandid']; 
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $brandName = $_POST['brandName'];
    $brandid = $_GET['brandid'];  
    $brandedit = $brand->update_brand($brandid, $brandName);
  
   }

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Cập nhật danh mục</h2>
                <div style="height: 10px"></div>
                <?php 
                if(isset($brandedit)){
                   echo $brandedit;
                }
                ?>

                <?php 
                  $get_brand_name = $brand->getBrandById($brandid);

                  if(isset($get_brand_name)){
                    while($result = $get_brand_name->fetch_assoc()){ ?>

                 
            
               <div class="block copyblock"> 
                 <form action="brandedit.php?brandid=<?php echo $result['brandid'] ?>" method="post">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName'] ?>" placeholder="Thêm danh mục sản phẩm" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Edit" />
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
<?php include 'inc/footer.php';?>