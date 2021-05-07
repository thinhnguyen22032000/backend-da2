<?php 
   $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../helpers/format.php');
  include_once ($filepath.'/../lib/database.php');
  ?>
<?php 
  class customer
  {
  	private $db;
  	private $fm;
    private $call;
  	
  	function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();

  		
    }

     public function check_email($email){
      $qr = "select * from tbl_customer where email = '$email'";
      $result = $this->db->select();
      if($result){
        return 1;
      }
     }

    public function insert_customer($data){
     //check input
     $name = $this->fm->validation($data['name']);
     $address = $this->fm->validation($data['address']);
     $city = $this->fm->validation($data['city']);
     $country = $this->fm->validation($data['country']);
     $zipcode = $this->fm->validation($data['zipcode']);
     $phone = $this->fm->validation($data['phone']);
     $email = $this->fm->validation($data['email']);
     $password = $this->fm->validation($data['password']);
    

     $name = mysqli_real_escape_string($this->db->link,$data['name']);
     $address = mysqli_real_escape_string($this->db->link,$data['address']);
     $city = mysqli_real_escape_string($this->db->link,$data['city']);
     $country = mysqli_real_escape_string($this->db->link,$data['country']);
     $zipcode = mysqli_real_escape_string($this->db->link,$data['zipcode']);
     $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
     $email = mysqli_real_escape_string($this->db->link,$data['email']);
     $password = mysqli_real_escape_string($this->db->link,$data['password']);
     $password = md5($password);

     if($name == '' || $address == '' || $city == '' || $country == '' || $zipcode == '' || $phone == '' || $email == '' || $password == '' ){
      $alert = "<span  class='err'>Vui lòng điền đủ thông tin</span>";
      return $alert;
     }
     else{

          $qr = "SELECT * from tbl_customer where email = '$email'";
          $result = $this->db->select($qr);
          if($result){
            $alert = "<span class='err'>Email đã tồn tại!!</span>";
            return $alert;  
          }
          else{

          $qr = "INSERT INTO tbl_customer(name, address, city, country, zipcode, phone, email, password) VALUES

          ('$name', '$address', '$city', '$country', '$zipcode', '$phone', '$email', '$password')";

          $result = $this->db->insert($qr);
          if($result){
             $alert = "<span class='succes'>Đăng kí thành công</span>";
             return $alert;
          }
          else{
                $alert = "<span class='err'>Đăng kí thất bại</span>";
                return $alert;
              } 
         }

     } 
     }

    


    public function check_login($data){

    $email = $this->fm->validation($data['email']);
    $password = $this->fm->validation($data['password']);

    $email = mysqli_real_escape_string($this->db->link,$data['email']);
    $password = mysqli_real_escape_string($this->db->link,$data['password']);
    $password = md5($password);
    if(empty($email) || empty($password)){
     $alert = "<span class='err'>Vui lòng điền đủ thông tin</span>";
      return $alert;   
    }
    else{
      $qr = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password' LIMIT 1";
      $result = $this->db->select($qr);
      if($result){
        $result = $result->fetch_assoc();
        Session::set("customer_login", true);
        Session::set("customer_id", $result['id']);
        Session::set("customer_name", $result['name']);
        header("location:cart.php");
      }
      else{ 
        $alert = "<span class='err'>Tài khoản hoặc mật khẩu không chính xác</span>";
        return $alert; 
      }
    }


}


    public function get_ct_by_id($id){
       $qr = "SELECT * FROM tbl_customer WHERE id = '$id'";
       $result = $this->db->select($qr);
       return $result;
    }


     public function update_customer($id,$data){
     //check input
     $name = $this->fm->validation($data['name']);
     $address = $this->fm->validation($data['address']);
     $city = $this->fm->validation($data['city']);
     //$country = $this->fm->validation($data['country']);
     $zipcode = $this->fm->validation($data['zipcode']);
     $phone = $this->fm->validation($data['phone']);
     $email = $this->fm->validation($data['email']);
     
    

     $name = mysqli_real_escape_string($this->db->link,$data['name']);
     $address = mysqli_real_escape_string($this->db->link,$data['address']);
     $city = mysqli_real_escape_string($this->db->link,$data['city']);
    
     $zipcode = mysqli_real_escape_string($this->db->link,$data['zipcode']);
     $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
     $email = mysqli_real_escape_string($this->db->link,$data['email']);
     

     if($name == '' || $address == '' || $city == '' || $zipcode == '' || $phone == '' || $email == ''){
      $alert = "<span class='err'>Vui lòng điền đủ thông tin</span>";
      return $alert;
     }
     else{

      $qr = "UPDATE tbl_customer set
      name = '$name',
      address = '$address',
      city ='$city', 
      zipcode = '$zipcode',
      phone ='$phone',
      email ='$email'
      WHERE id = '$id'";
      
      $result = $this->db->update($qr);
      if($result){
         $alert = "<span class='succes'>Cập nhật thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='err'>Cập nhật thất bại</span>";
        return $alert;
      } 

     } 
     }








}
?>