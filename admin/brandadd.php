<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php 
   
   $brand = new brand();
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $brandName = $_POST['brandName'];
    

    $brandadd = $brand->insert_brand($brandName);

   }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm thương hiệu</h2>
                <div style="height: 10px"></div>
              <?php 
                if(isset($brandadd)){
                   echo $brandadd;
                }
               ?>
               <div class="block copyblock"> 
                 <form action="brandadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Thêm thương hiệu" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Thêm" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>