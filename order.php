<?php  
  include "inc/header.php";  
 ?>

 <?php 
         $check_user = Session::get('customer_login');
                    if(!$check_user){
                    	header("location: login.php");
                    }
         $id_ct = Session::get("customer_id");
             if($id_ct){
               $id = $id_ct;
             }

 ?>
 
 </style>
 <style type="text/css">
   .pending {
    font-weight: bold;
    color: red;
   }
   .process {
    font-weight: bold;
    color: green;
   }
 </style>

 <?php 
      if(isset($_GET['cusid'])){
      $id = $_GET['cusid'];
      $date = $_GET['date'];
      $proid = $_GET['proid'];
      $process_order_rv = $cart->process_order_rv($id, $date,$proid);
      if($process_order_rv){
         echo "<script>window.location = 'order.php'</script>";
      }
     }
    
 ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">			
          <div class="cartpage">
         
            <h2>Đặt hàng</h2>
            <table class="tblone">
              <tr>
                <th width="15%">Tên sản phẩm</th>
                <th width="15%">Hình ảnh</th>
                <th width="15%">Giá</th>
                <th width="10%">Số lượng</th>
                <th width="20%">Ngày đặt</th>
                <th width="10%">Trạng thái</th>
                <th width="10%">Hành động</th>
                
                
              </tr>
              <?php                          
              
                                    
               // code show gio hang
                   $get_product_order = $cart->show_product_order($id);

                            if($get_product_order != false){
                               
                            while($result = $get_product_order->fetch_assoc()){
                      
                            ?>
                             
                           
              <tr>
                <td><?php echo $result["productName"]; ?></td>
                <td><img src="admin/uploads/<?php echo trim($result['image']) ?>" alt=""/></td>
                <td><?php echo $result["price"]; ?></td>
                <td>
                    <?php echo $result["quantity"]; ?>                                                 
                </td>
                <td>
                    <?php echo $fm->formatDate($result["date_order"]); ?>                                                 
                </td>

              <!--   hien thi status------------------------------------ -->

                <?php 
                     if($result["status"] =='0'){ ?>
                        <td class="pending">
                       <?php echo "Chờ" ?>                                                 
                       </td>
                     <?php
                     }elseif($result["status"] =='1'){ ?>
                         <td class="process">
                          <?php echo "Đã chuyển" ?>                                                 
                         </td>
                         <?php
                      }else if($result["status"] =='2'){ ?>
                        <td class='process'><?php echo "Đã nhận" ?></td>
                        <?php
                        }
                       ?>

                <!--   button control status------------------------------- -->


                <?php if($result["status"]=='0'){ ?>
                    <td><?php echo "N/A"; ?></td> 
                <?php    
                }
               
                else if($result["status"]=='1') { ?>

                    <td><a class="process" href="?cusid=<?php echo $result['customer_id'] ?>&date=<?php echo $result['date_order'] ?>&proid=<?php echo $result['productid'] ?>"><?php echo 'Nhận' ?></a></td>

                    <?php 
                }else{ ?>

                  <td class="process"><?php echo "Đã nhận" ?></td>

                <?php
                }
                 
                ?>
              </tr>
                            
            <?php
              
                 
               }
            }
            ?>  
                                                              
              
            </table>
          
          </div> 
         
       <div class="clear"></div>
    </div>
 </div>
</div>

<?php 
   include "inc/footer.php";
 ?>