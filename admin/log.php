<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php require_once '../classes/cart.php';?>
<style type="text/css">
    
    .bold {
        font-weight: bold;
    }
    .re{
        color: red;
    }
    .gr{
        color: green;
    }

</style>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Log</h2>
              
               <div class="block copyblock"> 
                 <form action="catadd.php" method="post">
                    <table class="form">
                        <?php 
                               
                        $cart = new cart();
                        $show_log = $cart->show_log();
                        if($show_log){
                            while($result = $show_log->fetch_assoc()){ ?>                         

                           <tr>  
                                <td><span class="bold"><?php echo $result['adminName'].': '. '(' .$result['date_order'].')'?></span><span>
                                     <?php 
                                         if($result['status']==0){
                                                echo "<span class='gr'>Đã bán sản phẩm: </span>";
                                            }
                                            else{
                                                echo "<span class='re'>Đã hủy đơn: </span>";
                                            }
                                          
                                   ?>
                                </span><span class="bold"><?php echo $result['productName'] ?></span></td>                                                           
                               
                                
                            </tr>
                            
						 <?php
                            }
                        }
                        ?>
                            
                       
                    </table>
                    </form>
                </div>
                <div class="phantrang">
                <p>Trang</p>
                 <?php 
                      $get_all_log = $cart->show_log_all();
                      $num_row = mysqli_num_rows($get_all_log);
                      $page_product = ceil($num_row/5); 
                      for ($i=1; $i <= $page_product ; $i++){ 
                          echo "<a href='?trang=".$i."'>".$i."<a/>";
                      }
                ?>
            </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>