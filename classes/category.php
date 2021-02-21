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
  public function insert_category($catName){
  	$catName = $this->fm->validation($catName);
  	
    $catName = mysqli_real_escape_string($this->db->link,$catName);
    if(empty($catName)){
    	$alert = "<span class='error'>Vui long dien ten danh muc</span>";
    	return $alert;
    }
    else{
    	$qr = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
    	$result = $this->db->insert($qr);
      if($result){
           $alert = "<span style='font-size:18px; color:green' class='thanhcong' style='color:green'>Thêm thành công</span>";
         return $alert;
      }
      else{
          $alert = "<span style='font-size:18px; color:red' class='thanhcong' style='color:green'>Xóa thất bại</span>";
        return $alert;
      } 	
    	
    }
  }

  public function show_category(){
   $qr = "SELECT * FROM tbl_category ORDER BY catid desc";
   $result = $this->db->select($qr);
   return $result;
  }

  public function update_category($catid, $catName){
    $catName = $this->fm->validation($catName);
    
    $catName = mysqli_real_escape_string($this->db->link,$catName);
    $catid = mysqli_real_escape_string($this->db->link,$catid);
    if(empty($catName)){
      $alert = "<span class='error'>Vui long dien ten danh muc</span>";
      return $alert;
    }
    else{
      $qr = "UPDATE tbl_category SET catName = '$catName' WHERE catid = '$catid'";
      $result = $this->db->insert($qr);
      if($result){
         $alert = "<span id='thanhcong' style='color:green'>Cập nhật thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='error'>Cập nhật thất bại</span>";
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
         $alert = "<span class='thanhcong' style='color:green'>Xóa thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='error'>Xóa thất bại</span>";
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