<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/category.php';?>
<?php 
   
   $cat = new category();
   
   if(isset($_GET['delid'])){
   	$delcat = $_GET['delid'];
   	$catdelete = $cat->delete_category($delcat);
   }
    
   
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách danh mục</h2>
                <div class="block tl_ct"> 
                <?php if(isset($catdelete)){echo $catdelete;}?> 
                <div style="height: 10px"></div>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên danh mục</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$listcat = $cat->show_category();
						if($listcat){
						   $i=0;
                           while($result = $listcat->fetch_assoc()){ ?> 

						    
						 <tr class="odd gradeX">
							
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']?></td>
							<td><a class="edit" href="catedit.php?catid=<?php echo $result['catid']?>"><i style='font-size:20px' class='far edit'>&#xf044;</i></a> || <a class="del" onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['catid']?>"><i style='font-size:20px' class='far del'>&#xf2ed;</i></a></td>
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

