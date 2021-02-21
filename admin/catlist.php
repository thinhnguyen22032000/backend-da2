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
                <h2>Category List</h2>
                <div class="block"> 
                <?php if(isset($catdelete)){echo $catdelete;}?>       
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
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
							<td><a href="catedit.php?catid=<?php echo $result['catid']?>">Edit</a> || <a onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['catid']?>">Delete</a></td>
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

