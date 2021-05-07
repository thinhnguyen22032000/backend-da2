<?php 
  $filepath = realpath(dirname(__FILE__));
  require_once ($filepath.'/../helpers/format.php');
  require_once ($filepath.'/../lib/database.php');
  ?>
<?php 
  class user
  {
  	private $db;
  	private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();
  		
    }

    public function change_pw($pwold, $pwnew, $id){
      $pwold = $this->fm->validation($pwold);
      $pwold = md5($pwold);
      $pwnew = $this->fm->validation($pwnew);
      $pwnew = md5($pwnew);

      if($pwnew == '' || $pwold == ''){
        $alert = '<span class="err">Vui lòng nhập đủ thông tin</span>';
        return $alert;
      }


        $qr = "SELECT * FROM tbl_admin WHERE adminid = '$id' AND adminPass = '$pwold'";
        $result= $this->db->select($qr);
        if($result){
               $qr = "UPDATE tbl_admin SET adminPass = '$pwnew' WHERE 
               adminid = '$id' AND
               adminPass = '$pwold'
          ";
          $result = $this->db->update($qr);

          $alert = "<span class='succes'>Thay đổi mật khẩu thành công</span>";
          return $alert;  

        }else{
          
            $alert = "<span class='err'>Kiểm tra lại mật khẩu</span>";
            return $alert;    
        }
      
     
  }


    public function insert_admin($data){
     //check input
    
    

     $adminName = mysqli_real_escape_string($this->db->link,$data['adminName']);
     $adminUser = mysqli_real_escape_string($this->db->link,$data['adminUser']);
     $adminEmail = mysqli_real_escape_string($this->db->link,$data['adminEmail']);
     $adminPass = mysqli_real_escape_string($this->db->link,$data['adminPass']);
     $adminPass = md5($adminPass);

     if($adminName == '' || $adminUser == '' || $adminEmail == '' || $adminPass == ''){
      $alert = "<span  class='err'>Vui lòng điền đủ thông tin</span>";
      return $alert;
     }
     else{

          $qr = "SELECT * from tbl_admin where adminUser = '$adminUser'";
          $result = $this->db->select($qr);
          if($result){
            $alert = "<span class='err'>Tài khoản đã tồn tại!!</span>";
            return $alert;  
          }
          else{

          $qr = "INSERT INTO tbl_admin(adminName, adminPass, adminUser, adminEmail, level) VALUES

          ('$adminName', '$adminPass', '$adminUser', '$adminEmail', '1')";

          $result = $this->db->insert($qr);
          if($result){
             $alert = "<span class='succes'>Thêm thành công</span>";
             return $alert;
          }
          else{
                $alert = "<span class='err'>Thêm thất bại</span>";
                return $alert;
              } 
         }

     } 
     }

    
  







}

?>