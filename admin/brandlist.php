<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/brand.php';?>
<?php 
   
   $brand = new brand();
   
   if(isset($_GET['delid'])){
   	$delbrand = $_GET['delid'];
   	$brand_delete = $brand->delete_brand($delbrand);
   }
    
   
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách thương hiệu</h2>
                <div class="block"> 
                <?php if(isset($brand_delete)){echo $brand_delete;}?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên thương hiệu</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$listbrand = $brand->show_brand();
						if($listbrand){
						   $i=0;
                           while($result = $listbrand->fetch_assoc()){ ?> 

						    
						 <tr class="odd gradeX">
							
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName']?></td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brandid'] ?>">Edit</a> || <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['brandid']?>">Delete</a></td>
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