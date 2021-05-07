<?php 
   $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../helpers/format.php');
  include_once ($filepath.'/../lib/database.php');
  ?>
<?php 
  class brand
  {
  	private $db;
  	private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();
  		
    }
  public function insert_brand($brandName){
  	$brandName = $this->fm->validation($brandName);
  	
    $brandName = mysqli_real_escape_string($this->db->link,$brandName);
    if(empty($brandName)){
    	$alert = "<span class='err'>Vui lòng điền đủ thông tin</span>";
    	return $alert;
    }
    else{
    	$qr = "INSERT INTO tbl_brand(brandName) VALUES ('$brandName')";
    	$result = $this->db->insert($qr);
      if($result){
           $alert = "<span class='succes'>Thêm thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='error'>Them that bai</span>";
        return $alert;
      } 	
    	
    }
  }

  public function show_brand(){
   $qr = "SELECT * FROM tbl_brand ORDER BY brandid desc";
   $result = $this->db->select($qr);
   return $result;
  }

  public function update_brand($brandid, $brandName){
    $brandName = $this->fm->validation($brandName);
    
    $brandName = mysqli_real_escape_string($this->db->link,$brandName);
    $brandid = mysqli_real_escape_string($this->db->link,$brandid);
    if(empty($brandName)){
      $alert = "<span class='err'>Vui lòng điền đủ thông tin</span>";
      return $alert;
    }
    else{
      $qr = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandid = '$brandid'";
      $result = $this->db->update($qr);
      if($result){
         $alert = "<span class='succes'>Cập nhật thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='error'>Cap nhat that bai</span>";
        return $alert;
      }   
      
    }
  }


  public function getBrandById($id){
   $qr = "SELECT * FROM tbl_brand WHERE brandid = '$id'";
   $result = $this->db->select($qr);
   return $result;
  }
  

  public function delete_brand($id){
   $qr = "DELETE FROM tbl_brand WHERE brandid = '$id'";
   $result = $this->db->delete($qr);
      if($result){
         $alert = "<span class='succes'>Xóa thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='error'>Xoa that bai</span>";
        return $alert;
      }   
      
    }
   
  







}

?>