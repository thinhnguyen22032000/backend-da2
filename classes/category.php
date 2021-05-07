<?php 
   $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../helpers/format.php');
  include_once ($filepath.'/../lib/database.php');
  ?>
<?php 
  class category
  {
  	private $db;
  	private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();
  		
    }

  // show danh mục
  public function show_category(){
   $qr = "SELECT * FROM tbl_category ORDER BY catid desc";
   $result = $this->db->select($qr);
   return $result;
  }

  // show nhân sự
  public function show_personnel(){
    $qr = "SELECT * FROM tbl_admin WHERE level = 1";
    $result = $this->db->select($qr);
    return $result;
  }
  // xóa nhân sự
  public function delete_personnel($adminid){
    $qr = "DELETE FROM tbl_admin WHERE adminid = '$adminid'";
    $result = $this->db->delete($qr);
    if($result){
         $alert = "<span class='succes'>Xóa thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='err'>Xóa thất bại</span>";
        return $alert;
      }   
  }

  public function insert_category($catName){
  	$catName = $this->fm->validation($catName);
  	
    $catName = mysqli_real_escape_string($this->db->link,$catName);
    if(empty($catName)){
    	$alert = "<span class='err'>Vui lòng điền đủ thông tin</span>";
    	return $alert;
    }
    else{
    	$qr = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
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

  

  public function update_category($catid, $catName){
    $catName = $this->fm->validation($catName);
    
    $catName = mysqli_real_escape_string($this->db->link,$catName);
    $catid = mysqli_real_escape_string($this->db->link,$catid);
    if(empty($catName)){
      $alert = "<span class='err'>Vui lòng điền đủ thông tin</span>";
      return $alert;
    }
    else{
      $qr = "UPDATE tbl_category SET catName = '$catName' WHERE catid = '$catid'";
      $result = $this->db->insert($qr);
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


  public function getCatById($id){
   $qr = "SELECT * FROM tbl_category WHERE catid = '$id'";
   $result = $this->db->select($qr);
   return $result;
  }
  

  public function delete_category($id){
   $qr = "DELETE FROM tbl_category WHERE catid = '$id'";
   $result = $this->db->delete($qr);
      if($result){
         $alert = "<span class='succes'>Xóa thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='err'>Xóa thất bại</span>";
        return $alert;
      }   
      
    }


    public function show_cat_by_id($id){
   $qr = "SELECT * FROM tbl_category WHERE catid = '$id' LIMIT 1";
   $result = $this->db->select($qr);
   return $result;
  }
   
  







}

?>