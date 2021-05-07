<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php require_once '../helpers/format.php';?>

<?php 
      $fm = new Format();
      $pd = new product();

    if(isset($_GET['delid'])){
   	$delproduct = $_GET['delid'];
   	$product_delete = $pd->delete_product($delproduct);
   }

     

 ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div style="height: 10px"></div>
        <?php 
              if(isset($product_delete)){
              	echo $product_delete;
              }
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên sản phẩm</th>
					<th>Giá</th>
					<th>Ảnh</th>
					<th>Danh mục</th>
					<th>Thương hiệu</th>
					<th>Mô tả</th>
					<th>Loại</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
				<?php
                       
                        $pdlist = $pd->show_product();
                        
                        if($pdlist){
                        	$i=0;
                        	while($result = $pdlist->fetch_assoc()){ ?>
				     <tr class="odd gradeX">
				                       	 
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $result['price'] ?></td>
					<td><img width="100px" height="100px"  src="uploads/<?php echo trim($result['image']);?>"></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><?php
                    echo $fm->textShorten($result['productDesc'], $limit = 10)
					 ?></td>

					<td class="center"><?php

					    echo $result['type']==0?'Không nỗi bậc':'Nỗi bậc' ?></td>

					<td><a class="green" href="productedit.php?productid=<?php echo $result['productid'] ?>"><i style='font-size:20px' class='far edit'>&#xf044;</i></a> || <a class="red" onclick = "return confirm('Bạn có muốn xóa?')" href=?delid=<?php echo $result['productid']?>><i style='font-size:20px' class='far del'>&#xf2ed;</i></a></td>
					
					
					  	
				</tr>
				<?php
				$i++;
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
