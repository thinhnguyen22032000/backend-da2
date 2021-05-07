<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php require_once '../helpers/format.php';?>
<?php require_once '../classes/cart.php'; ?>
<?php 
     $cart = new cart(); 
     $fm = new Format();
     // xử lý trạng thái sản phẩm
     if(isset($_GET['ctid'])){
     	$id = $_GET['ctid'];
     	$date = $_GET['date'];
     	$proid = $_GET['proid'];
     	$process_order = $cart->process_order($id, $date,$proid);
     	if($process_order){
     		 echo "<script>window.location = 'inbox.php'</script>";
     	}
     }
     // xoa don hang
     if(isset($_GET['delid'])){
     	$id = $_GET['delid'];
     	$date = $_GET['date'];
     	$proid = $_GET['proid'];
     	$del_order = $cart->del_order($id, $date,$proid);
     
     }
     //Hủy đơn hàng
      if(isset($_GET['huyorder'])){
      $id = $_GET['huyorder'];
      $date = $_GET['date'];
      $proid = $_GET['proid'];
      $del_order = $cart->del_order_huy($id, $date, $proid);
     
     }
?>
<style type="text/css">
   .pending {
     
    color: green;
   }
   .huydon {
   
    color: #ffee58;
   }
   .xoadon{
    font-weight: normal;
    color: red;
   }
   .process {
  
    color: green;
   }
   .dangchuyen{
   
    color: blue;
    
   }
 </style>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php 
                     if(isset($process_order)){
                     	echo $process_order;
                     }
                ?>
                 <?php 
                     if(isset($del_order)){
                     	echo $del_order;
                     }
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Ngày đặt</th>
							<th>Sản phẩm</th>
							<th>Số lượng</th>
							<th>Giá</th>
							<th>Địa chỉ</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php 
                           
                          $get_all_order = $cart->show_all_order();
                          if($get_all_order){
                          	$i = 0;
                          	while($result = $get_all_order->fetch_assoc()){
                          		 $i++;
                          	 ?>     
					    	<tr class="odd gradeX">
							   <td><?php echo $i; ?></td>
							   <td><?php echo $fm->formatDate($result['date_order']); ?></td>
							   <td><?php echo $result['productName'] ?></td>
							   <td><?php echo $result['quantity'] ?></td>
							   <td><?php echo $result['price'] ?></td>
							   <td ><a style="color: grey;" href="customer.php?ctid=<?php echo $result['customer_id']?>">Thông tin</a></td>
							   <td>
							   <?php
                       if($result['status'] == '0'){?>
                         <a class="pending" href="?ctid=<?php echo $result['customer_id'] ?>&date=<?php echo $result['date_order'] ?>&proid=<?php echo $result['productid'] ?>"><?php echo 'Chờ' ?></a>
                          || <a class="huydon" href="?huyorder=<?php echo $result['customer_id'] ?>&date=<?php echo $result['date_order'] ?>&proid=<?php echo $result['productid']?>"><?php echo 'Hủy đơn' ?></a>
                  <?php
                    }elseif($result['status'] == '1'){ ?>
                    	    <a class="dangchuyen"> <?php echo 'Đang chuyển...' ?></a>
                           || <a class="huydon" href="?huyorder=<?php echo $result['customer_id'] ?>&date=<?php echo $result['date_order'] ?>&proid=<?php echo $result['productid']?>"><?php echo 'Hủy đơn' ?></a>
                    	<?php
                    }elseif($result['status'] == '2'){ ?>
                    	 <a class="xoadon" href="?delid=<?php echo $result['customer_id'] ?>&date=<?php echo $result['date_order'] ?>&proid=<?php echo $result['productid']?>"><?php echo 'Xóa' ?> (Hoàn thành)</a>
                    	 <?php 
                    }

                            
							    ?>
                 <!--  || <a class="huydon" href="?huyorder=<?php echo $result['customer_id'] ?>&date=<?php echo $result['date_order'] ?>&proid=<?php echo $result['productid']?>"><?php echo 'Hủy đơn' ?></a> -->
							</td>
						
						   </tr>
               <?php
          	}
          }    

						?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script>
    // $( document ).ready(function() {
    //     alert('hello');
    // });
 
   
    </script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
