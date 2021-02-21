<?php 
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../helpers/format.php');
  include_once ($filepath.'/../lib/database.php');
  ?>
<?php 
  class cart
  {
  	private $db;
  	private $fm;
  	
  	function __construct()
  	{
  		$this->db = new Database();
  		$this->fm = new Format();
  		
    }

    public function add_to_cart($id, $quantity){
       $quantity = $this->fm->validation($quantity);
       $quantity = mysqli_real_escape_string($this->db->link,$quantity);
       $id = mysqli_real_escape_string($this->db->link,$id);
       $sid = $this->fm->validation(session_id());

       $qr = "SELECT * FROM tbl_cart WHERE productid = '$id' AND sid = '$sid'";
       $check_cart = $this->db->select($qr);

       if(!$check_cart){
         $qr = "SELECT * FROM tbl_product WHERE productid = '$id'";

         $result= $this->db->select($qr)->fetch_assoc();
         $productName = $result['productName'];
         $price = $result['price'];
         $image = $result['image'];

         $qr = "INSERT INTO tbl_cart(productid ,quantity, sid, image, price, productName) VALUES ('$id','$quantity','$sid','$image','$price','$productName')";
         $add_cart = $this->db->insert($qr);

        if($add_cart){
         header("location:cart.php");
        }
        else{
          $alert = "<span class='error'>Them that bai</span>";
          return $alert;
        }       
      }
      else{
         $alert = "<span class='error' style='color: red; font-size:18px'>Sản phẩm đã tồn tại trong giỏ hàng</span>";
         return $alert;
    }   
    }



    public function get_product_cart(){
      $sid = session_id();
      $qr = "SELECT * FROM tbl_cart WHERE sid = '$sid'";
      $result = $this->db->select($qr);
      if($result){
      return $result;
      }
      else{
        
        return false;
      }
    }

    public function update_quantity($id, $quantity){

      $quantity = $this->fm->validation($quantity);
      $quantity = mysqli_real_escape_string($this->db->link,$quantity);
      $id = mysqli_real_escape_string($this->db->link,$id);

      if($quantity == 0){

          $qr = "DELETE FROM tbl_cart WHERE productid = '$id'";
          $result = $this->db->delete($qr);
          header("location:cart.php");
      }
      else{
          $qr = "UPDATE tbl_cart SET quantity = '$quantity' WHERE productid = '$id'";
          $result = $this->db->update($qr);
           header("location:cart.php");
    }
    }

    public function delete_product_on_cart($id){
      $qr = "DELETE FROM tbl_cart WHERE cartid = '$id'";
      $result = $this->db->delete($qr);
      if($result){
         header("location:cart.php");
      }
      else{
        $alert = "<span class='error'>Xóa thất bại</span>";
        return $alert;
      }   

    }

     public function check_cart(){
      $sid = session_id();
      $qr = "SELECT * FROM tbl_cart WHERE sid = '$sid'";
      $result = $this->db->select($qr);
      return $result;
     
    }
    public function check_ordered($customer_id){
      $qr = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
      $result = $this->db->select($qr);
      return $result;
     
    }

     public function check_wishlist($customer_id){
      $qr = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id'";
      $result = $this->db->select($qr);
      return $result;
     
    }
    

     public function insert_order($id){
      $sid = session_id();
      $qr = "SELECT * FROM tbl_cart WHERE sid = '$sid'";
      $get_cart = $this->db->select($qr);
      if($get_cart){
        while($result = $get_cart->fetch_assoc()){
          $productid = $result["productid"];
          $productName = $result["productName"];
          $quantity = $result["quantity"];
          $price = $result["price"] * $result["quantity"];
          $image = $result["image"];
          $customer_id = $id;

          $qr = "INSERT INTO tbl_order(productid ,productName, customer_id, quantity, price, image) VALUES ('$productid','$productName','$customer_id','$quantity','$price','$image')";
          $add_order = $this->db->insert($qr);

          if($add_order){
            $qr = "DELETE FROM tbl_cart WHERE sid = '$sid'";
            $result = $this->db->delete($qr);
            header("location:cusses.php");
          }
          else{
              $alert = "<span class='error' style='color: red; font-size:18px'>Mua hang that bai</span>";
          return $alert;
        }       

        }
      }
      
     
    }

    public function del_cart(){
      $sid = Session_id();
      $qr = "DELETE FROM tbl_cart WHERE sid = '$sid'";
      $result = $this->db->delete($qr);
    }


    public function get_price_bill($customer_id){
      $sid = session_id();
      $qr = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id'";
      $result = $this->db->select($qr);
      
      if($result){
        $total = 0;
        while($get_price = $result->fetch_assoc()){
          $total += $get_price["price"];
        }
      }
      return $total; 
    }


     public function show_product_order($id){
      $qr = "SELECT * FROM tbl_order WHERE customer_id = '$id'";
      $result = $this->db->select($qr);
      if($result){
      return $result;
      }
      else{
        
        return false;
      }
    }


    public function show_all_order(){
      $qr = "SELECT * FROM tbl_order";
      $result = $this->db->select($qr);
      return $result;
      
      }


      public function process_order($id, $date, $productid){
        $id = mysqli_real_escape_string($this->db->link,$id);
        $date = mysqli_real_escape_string($this->db->link,$date);
      
     
          $qr = "UPDATE tbl_order SET status = '1' WHERE 
          customer_id = '$id' AND
          date_order = '$date' AND
          productid = '$productid'
          ";
          $result = $this->db->update($qr);
          if($result){
              $alert = "<span class=''>Xử lý thành công</span>";
              return $alert;
          }
         else{
           $alert = "<span class='error'>Xử lý thất bại</span>";
           return $alert;
      }   
          
    
    }
     
      public function process_order_rv($id, $date, $productid){
        $id = mysqli_real_escape_string($this->db->link,$id);
        $date = mysqli_real_escape_string($this->db->link,$date);
      

          $qr = "UPDATE tbl_order SET status = '2' WHERE 
          customer_id = '$id' AND
          date_order = '$date' AND
          productid = '$productid'
          ";
          $result = $this->db->update($qr);
          if($result){
              $alert = "<span class=''>Xử lý thành công</span>";
              return $alert;
          }
         else{
           $alert = "<span class='error'>Xử lý thất bại</span>";
           return $alert;
      }   
          
    
    }


    public function show_wishlist($id){
      $qr = "SELECT * FROM tbl_wishlist WHERE customer_id = '$id'";
      $result = $this->db->select($qr);
      if($result){
      return $result;
      }
      else{
        
        return false;
      }
    }


    public function del_product_wishlist($id){
      $qr = "DELETE FROM tbl_wishlist WHERE productid = '$id'";
      $result = $this->db->delete($qr);
      if($result){
         $alert = "<span class='success'>Xóa thành công</span>";
        return $alert;
      }
      else{
        $alert = "<span class='error'>Xóa thất bại</span>";
        return $alert;
      }   

    }



     public function add_to_wishlist($id, $customer_id){
       $customer_id = mysqli_real_escape_string($this->db->link,$customer_id);
       $id = mysqli_real_escape_string($this->db->link,$id);
       

      
         $qr = "SELECT * FROM tbl_product WHERE productid = '$id'";

         $result= $this->db->select($qr)->fetch_assoc();
         $productName = $result['productName'];
         $price = $result['price'];
         $image = $result['image'];
         
         $qr = "SELECT * FROM tbl_wishlist WHERE productid = '$id' AND customer_id = '$customer_id'";
         $result= $this->db->select($qr);
         if($result){
           $alert = "<span class='red'>Đã tồn tại trong yêu thích</span>";
          return $alert;
         }
         else{
              $qr = "INSERT INTO tbl_wishlist(productid, productName, image, price, customer_id) VALUES ('$id', '$productName', '$image', '$price', '$customer_id')";
              $add_to_wishlist = $this->db->insert($qr);

            if($add_to_wishlist){
              $alert = "<span class='green'>Thêm thành công</span>";
              return $alert;
             }
            else{
            $alert = "<span class='red'>Thêm thất bại</span>";
           return $alert;
         }       
         }
       
    }

    public function del_order($id, $date, $productid){
        $id = mysqli_real_escape_string($this->db->link,$id);
        $date = mysqli_real_escape_string($this->db->link,$date);

        $qr = "SELECT * FROM tbl_order WHERE  customer_id = '$id' AND date_order = '$date' AND productid = '$productid'";
         
         $result= $this->db->select($qr)->fetch_assoc();
         $productName = $result['productName'];
         $price = $result['price'];
         $quantity = $result['quantity'];
         $status = '0'; // xóa
         $adminName = Session::get('adminName');

         $qry = "INSERT INTO tbl_log(productName, price, quantity, status, adminName) VALUES
          ('$productName', '$price','$quantity','$status', '$adminName')";

         $add_log = $this->db->insert($qry);
      
      //   $qr = "DELETE FROM tbl_order WHERE 
      //     customer_id = '$id' AND
      //     date_order = '$date' AND
      //     productid = '$productid'";
                               
      //     $result = $this->db->delete($qr);
      //     if($result){
      //         $alert = "<span class=''>Xử lý thành công</span>";
      //         return $alert;
      //     }
      //    else{
      //      $alert = "<span class='error'>Xử lý thất bại</span>";
      //      return $alert;
      // }   
          
    
    }
    
    public function del_order_huy($id, $date, $productid){
        $id = mysqli_real_escape_string($this->db->link,$id);
        $date = mysqli_real_escape_string($this->db->link,$date);

        $qr = "SELECT * FROM tbl_order WHERE  customer_id = '$id' AND date_order = '$date' AND productid = '$productid'";
         
         $result= $this->db->select($qr)->fetch_assoc();
         $productName = $result['productName'];
         $price = $result['price'];
         $quantity = $result['quantity'];
         $status = '1'; // xóa
         $adminName = Session::get('adminName');

         $qry = "INSERT INTO tbl_log(productName, price, quantity, status, adminName) VALUES
          ('$productName', '$price','$quantity','$status', '$adminName')";

         $add_log = $this->db->insert($qry);
      
      //   $qr = "DELETE FROM tbl_order WHERE 
      //     customer_id = '$id' AND
      //     date_order = '$date' AND
      //     productid = '$productid'";
                               
      //     $result = $this->db->delete($qr);
      //     if($result){
      //         $alert = "<span class=''>Xử lý thành công</span>";
      //         return $alert;
      //     }
      //    else{
      //      $alert = "<span class='error'>Xử lý thất bại</span>";
      //      return $alert;
      // }   
          
    
    }

    public function show_log(){
      $num = 5;
      if(isset($_GET['trang'])){
        $trang = $_GET['trang'];
       }
       else{
        $trang = 1;
       }
       $vitri = ($trang - 1) * $num; 
      
      $qr = "SELECT * FROM tbl_log LIMIT $vitri, $num";
      $result= $this->db->select($qr);
      return $result;
    }

     public function show_log_all(){

      $qr = "SELECT * FROM tbl_log ORDER BY logid DESC";
      $result= $this->db->select($qr);
      return $result;
    }

    public function thongke_date($date1,$date2){
       $date1 = date('Y-m-d 00:00:00', strtotime($date1));
       $date2 = date('Y-m-d 23:59:59', strtotime($date2));
       // if($date1 != '' || $date2 != ''){
       //    $qr = "SELECT * FROM tbl_log WHERE (date_order >= '$date1' AND date_order <= '$date2')";
       //      $result= $this->db->select($qr);
       //      return $result;
       // }
       // else{
       //  return 0;
       // }

        $flag;
        if($date1 == '' || $date2 == '' || $date1 > $date2){
          $flag = 0;
        }
         else{ 
             $qr = "SELECT * FROM tbl_log WHERE (date_order >= '$date1' AND date_order <= '$date2')";
             $result= $this->db->select($qr);
                  
                  
            $flag = $result;
                   
             }

       //  else{
       //       if($date1 > $date2){
       //        $flag = 1;
       //       }
       //       else{
       //             $qr = "SELECT * FROM tbl_log WHERE (date_order >= '$date1' AND date_order <= '$date2')";
       //             $result= $this->db->select($qr);
       //             $flag = $result;
       //       }
       //  }

       return $flag;
      }
    
  
  public function show_thongke_now(){

           $date_now = date('Y-m-d 23:59:59');
           $date_0 = date('Y-m-d 00:00:00');
           $qr = "SELECT * FROM tbl_log WHERE date_order >= '$date_0' AND date_order <= '$date_now'";
           $result= $this->db->select($qr);   
           return $result;
  }



  






}

?>