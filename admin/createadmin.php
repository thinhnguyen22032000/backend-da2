<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    
     include '../classes/user.php';
     $class = new user();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm tài khoản</h2>
        <div style="height: 10px"></div>
        <?php
        
              
              if(isset($_POST['submit'])){
                
                 $insert_admin = $class->insert_admin($_POST);
                  
              } 
                
        ?>
        <?php 
               if(isset($insert_admin)){
                echo $insert_admin;
               }
               
        ?>
        <div class="block">               
         <form action="" method="post">
            <table class="form">                    
                <tr>
                    <td>
                        <label>Họ Tên</label>
                    </td>
                    <td>
                        <input type="text" name="adminName" placeholder="Họ tên..."   class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Tài khoản</label>
                    </td>
                    <td>
                        <input type="text" name="adminUser" placeholder="Tài khoản..."  class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name="adminEmail" placeholder="Email..."  class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Mật khẩu</label>
                    </td>
                    <td>
                        <input type="password" name="adminPass" placeholder="Nhập mật khẩu mới..." class="medium" />
                    </td>
                </tr>

              
                 
                
                 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Tạo" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>