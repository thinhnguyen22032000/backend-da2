<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/category.php';?>
<?php 
   
   $ps = new category();
   
   if(isset($_GET['delid'])){
    $del_ps = $_GET['delid'];
    $del_ps = $ps->delete_personnel($del_ps);
   }
    
   
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách nhân sự</h2>
                <div class="block tl_ct"> 
                <?php if(isset($del_ps)){echo $del_ps;}?> 
                <div style="height: 10px"></div>      
                    <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                          
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $list_ps = $ps->show_personnel();
                        if($list_ps){
                           $i=0;
                           while($result = $list_ps->fetch_assoc()){ ?> 

                            
                         <tr class="odd gradeX">
                            
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['adminName'] ?></td>
                            <td><?php echo $result['adminEmail'] ?></td>
                            
                               


                            <td><a class="del" onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['adminid']?>"><i style='font-size:20px' class='far del'>&#xf2ed;</i></a></td>
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