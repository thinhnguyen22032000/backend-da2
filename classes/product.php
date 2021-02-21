<?php 
   $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../helpers/format.php');
  include_once ($filepath.'/../lib/database.php');
  ?>
<?php 
  class product
  {
  	private $db;
  	private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();
  		
    }
  public function insert_product($data,$files){
  	
  	
    $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
    $category = mysqli_real_escape_string($this->db->link,$data['category']);
    $brand = mysqli_real_escape_string($this->db->link,$data['brand']);
    $productDesc = mysqli_real_escape_string($this->db->link,$data['productDesc']);
    $type = mysqli_real_escape_string($this->db->link,$data['type']);
    $price = mysqli_real_escape_string($this->db->link,$data['price']);

    // kiem tra hinh anh va upload file len folder uploads
    $permited = array('ajp', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

    if($productName == '' || $category == '' || $brand == '' || $productDesc == '' || $type == '' || $price == '' || $file_name=='' ){
    	$alert = "<span class='red'>Vui lòng điền đủ thông tin</span>";
    	return $alert;
    }
    else{
      move_uploaded_file($file_temp,$uploaded_image);
    	$qr = "INSERT INTO tbl_product(productName,catid,brandid,productDesc,type,price,image) VALUES ('$productName',' $category',' $brand',' $productDesc','$type',' $price',' $unique_image ')";
    	$result = $this->db->insert($qr);
      if($result){
              $alert = "<span class='green'>Thêm thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='red'>Thêm thất bại</span>";
        return $alert;
      } 	
    	
    }
  }

  public function show_product(){
   $qr = "SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName FROM tbl_product inner join 

   tbl_category on tbl_product.catid = tbl_category.catid inner join tbl_brand on tbl_product.brandid = tbl_brand.brandid
   
   ORDER BY catid desc";


   $result = $this->db->select($qr);
   return $result;
  }

  public function update_product($data, $files, $id){
    $productName = mysqli_real_escape_string($this->db->link,$data['productName']);
    $category = mysqli_real_escape_string($this->db->link,$data['category']);
    $brand = mysqli_real_escape_string($this->db->link,$data['brand']);
    $productDesc = mysqli_real_escape_string($this->db->link,$data['productDesc']);
    $type = mysqli_real_escape_string($this->db->link,$data['type']);
    $price = mysqli_real_escape_string($this->db->link,$data['price']);

    // kiem tra hinh anh va upload file len folder uploads
    $permited = array('ajp', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

    if($productName == '' || $category == '' || $brand == '' || $productDesc == '' || $type == '' || $price == ''){
      $alert = "<span class='error'>Vui lòng điền đủ thông tin</span>";
      return $alert;
    }
    else{
          if(!empty($file_name)){
            if($file_size > 20480){
              $alert = "<span class='red'>Kích thước ảnh phải nhỏ hơn 24080!!!</span>";
              return $alert;
            }
            elseif(in_array($file_ext, $permited) == false){
                $alert = "<span class='red'>Chỉ nhận ảnh có phần mở rộng: ".implode(',' , $permited)."</span>";
            }
            
            
            $qr = "UPDATE tbl_product SET
             productName = '$catName',
             catid = '$category',
             brandid = '$brand',
             productDesc = '$productDesc',
             type = '$type',
             price = '$price',
             image = '$unique_image'
             WHERE productid = '$id'";
            $result = $this->db->insert($qr);
            if($result){
            $alert = "<span class='green'>Cập nhật thành công</span>";
            return $alert;
            }
            else{
            $alert = "<span class='red'>Cập nhật thất bại</span>";
            return $alert;  

           }
        }
        else{
          
            $qr = "UPDATE tbl_product SET
             productName = '$productName',
             catid = '$category',
             brandid = '$brand',
             productDesc = '$productDesc',
             type = '$type',
             price = '$price'
             WHERE productid = '$id'";
        } 
         $result = $this->db->insert($qr);
            if($result){
            $alert = "<span class='green'>Cập nhật thành công</span>";
            return $alert;
            }
            else{
            $alert = "<span class='red'>Cập nhật thất bại</span>";
            return $alert;  
    
    }
  }
}


  public function getProductById($id){
   $qr = "SELECT * FROM tbl_product WHERE productid = '$id'";
   $result = $this->db->select($qr);
   return $result;
  }
  

  public function delete_product($id){
   $qr = "DELETE FROM tbl_product WHERE productid = '$id'";
   $result = $this->db->delete($qr);
      if($result){
         $alert = "<span class='thanhcong' style='color:green'>Xóa thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='error'>=Xóa thất bại</span>";
        return $alert;
      }   
      
    }


    public function getProduct_feathered(){
       $num = 4;
       if(isset($_GET['trangf'])){
        $trangf = $_GET['trangf'];
       }
       else{
        $trangf = 1;
       }
       $vitrif = ($trangf - 1) * $num;
       $qr = "SELECT * FROM tbl_product WHERE type = '1' LIMIT $vitrif, $num";
       $result = $this->db->select($qr);
       return $result;
    }
     public function get_productf(){
      
       $qr = "SELECT * FROM tbl_product WHERE type = '1' ";
       $result = $this->db->select($qr);
       return $result;
    }

    public function getProduct_new(){
       $num = 4;
       if(isset($_GET['trang'])){
        $trang = $_GET['trang'];
       }
       else{
        $trang = 1;
       }
       $vitri = ($trang - 1)*$num;
       $qr = "SELECT * FROM tbl_product  LIMIT 4";
       $result = $this->db->select($qr);
       return $result;
    }
    

     public function get_all_product(){
       $qr = "SELECT * FROM tbl_product ";
       $result = $this->db->select($qr);
       return $result;
    }

    public function show_product_detail($id){
     $qr = "SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName FROM tbl_product inner join 

     tbl_category on tbl_product.catid = tbl_category.catid inner join tbl_brand on tbl_product.brandid = tbl_brand.brandid
     
     WHERE productid = '$id'";


     $result = $this->db->select($qr);
     return $result;
  }



  // show san pham theo category

   public function show_product_by_cat($id){
   $qr = "SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName FROM tbl_product inner join 

   tbl_category on tbl_product.catid = tbl_category.catid inner join tbl_brand on tbl_product.brandid = tbl_brand.brandid
   
   WHERE tbl_product.catid = '$id' ORDER BY catid desc";


   $result = $this->db->select($qr);
   return $result;
  }
  

   public function show_product_by_key($key){
   $qr = "SELECT tbl_product.*, tbl_category.catName,tbl_brand.brandName FROM tbl_product inner join 

   tbl_category on tbl_product.catid = tbl_category.catid inner join tbl_brand on tbl_product.brandid = tbl_brand.brandid
   
   WHERE tbl_product.productName like '%$key%'";


   $result = $this->db->select($qr);
   return $result;
  }


  // insert slider 


   public function insert_slider($data,$files){
    
    
    $sliderName = mysqli_real_escape_string($this->db->link,$data['sliderName']);
    $type = mysqli_real_escape_string($this->db->link,$data['type']);
    
    // kiem tra hinh anh va upload file len folder uploads
    $permited = array('ajp', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

    if($sliderName == '' || $type == ''){
      $alert = "<span class='error'>Vui lòng điền đủ thông tin</span>";
      return $alert;
    }
    else{
      move_uploaded_file($file_temp,$uploaded_image);
      $qr = "INSERT INTO tbl_silder(sliderName, image, type) VALUES ('$sliderName', '$unique_image', '$type')";
      $result = $this->db->insert($qr);
      if($result){
              $alert = "<span style='font-size:18px; color:green' class='thanhcong' style='color:green'>Thêm thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='error'>Thêm thất bại</span>";
        return $alert;
      }   
      
    }
  }


   public function show_slider(){
     $qr = "SELECT * FROM tbl_silder";
     $result = $this->db->select($qr);
     return $result;
  }
   public function show_slider_ui($id){
     $qr = "SELECT * FROM tbl_silder WHERE type = '$id'";
     $result = $this->db->select($qr);
     return $result;
  }

  public function get_slider_by_id($id){
       $qr = "SELECT * FROM tbl_silder WHERE id = '$id'";
       $result = $this->db->select($qr);
       return $result;
    }
  
   public function update_type_slider($id, $type){
       $qr = "UPDATE tbl_silder SET type = '$type' WHERE id = '$id'";
       $result = $this->db->update($qr);
       return $result;
    }


    public function del_slider($id){
     $qr = "DELETE FROM tbl_silder WHERE id = '$id'";
     $result = $this->db->delete($qr);
      if($result){
         $alert = "<span class='green' style='color:green'>Xóa thành công</span>";
         return $alert;
      }
      else{
        $alert = "<span class='red'>=Xóa thất bại</span>";
        return $alert;
      }   
      
    }
  






}

?>