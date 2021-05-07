<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php 
   
   $cat = new category();
  

if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'catlist.php'</script>";
    } else {
        $catid = $_GET['catid']; 
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $catName = $_POST['catName'];
    $catid = $_GET['catid'];  
    $catedit = $cat->update_category($catid, $catName);
  
   }

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2 class="tl_ct">Cập nhật danh mục</h2>
                <?php 
                if(isset($catedit)){
                   echo $catedit;
                }
                ?>

                <?php 
                  $get_cat_name = $cat->getCatById($catid);

                  if(isset($get_cat_name)){
                    while($result = $get_cat_name->fetch_assoc()){ ?>

                 
            
               <div class="block copyblock"> 
                 <form action="catedit.php?catid=<?php echo $result['catid'] ?>" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName'] ?>" placeholder="Thêm danh mục sản phẩm" class="medium" />
                            </td>
                        </tr>
						<tr> 
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
<?php include 'inc/footer.php';?>