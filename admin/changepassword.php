<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    
     include '../classes/user.php';
    
     $class = new user();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Đổi mật khẩu</h2>
        <div style="height: 10px"></div>
        <?php
        
              
              if(isset($_POST['submit'])){
                 $pwold = $_POST['pwold'];
                 $pwnew = $_POST['pwnew'];
                 $adminid = $_SESSION['adminid'];
                
                 $change_pw = $class->change_pw($pwold, $pwnew, $adminid);
                  
              } 
                
        ?>
        <?php 
               if(isset($change_pw)){
                echo $change_pw;
               }
               
        ?>
        <div class="block">               
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Mật khẩu hiện tại</label>
                    </td>
                    <td>
                        <input type="password" name="pwold" placeholder="Nhập mật khẩu hiện tại..."  name="title" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Mật khẩu mới</label>
                    </td>
                    <td>
                        <input type="password" name="pwnew" placeholder="Nhập mật khẩu mới..." name="slogan" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Cập nhật" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>