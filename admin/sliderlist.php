<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php require_once '../classes/product.php';?>
<?php
      $product = new product(); 
     if(isset($_GET['etype']) && isset($_GET['type'])){
     	$id = $_GET['etype'];
     	$type = $_GET['type'];

     	$update_type_slider = $product->update_type_slider($id, $type);
     }

      if(isset($_GET['delid'])){
     	$id = $_GET['delid'];

     	$del_slider = $product->del_slider($id);
     }

?>
<style type="text/css">
   .red {
    
    
   }
   .green {
    font-weight: bold;
    color: green;

   }
 </style>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div style="height: 10px"></div>
        <?php 
             if(isset($del_slider)){
             	echo $del_slider;
             }
           
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên Slider</th>
					<th>Ảnh</th>
			        <th>Chế độ</th>		
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>

            <?php
               
               
                $sliderlist = $product->show_slider();
                if($sliderlist){
                	$i = 0;
                	while($result = $sliderlist->fetch_assoc()){
                       $i++;
                	 ?>
                    
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['sliderName'] ?></td>
					<td><img width="400px" height="200px" src="uploads/<?php echo $result['image'] ?>"></td>
					<td><?php 
					     if($result['type'] == 1){ ?>
					     	<a class="green" href="?etype=<?php echo $result['id'] ?>&type=0"><i style='font-size:30px' class='fas'>&#xf205;</i></a>
					     <?php 	
					     }
					     else{ ?>
                            <a class="" href="?etype=<?php echo $result['id'] ?>&type=1"><i style='font-size:30px' class='fas'>&#xf204;</i></a>

					     	<?php

					     }

					?></td>				
				<td>
					
					<a onclick="return confirm('Are you sure to Delete!');" href="?delid=<?php echo $result['id'] ?>" ><i style='font-size:20px' class='far del'>&#xf2ed;</i></a> 
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

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
