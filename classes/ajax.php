
<?php 
   $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../helpers/format.php');
  include_once ($filepath.'/../lib/database.php');
  ?>




<?php 
     
   
    $db = new Database();
    $fm = new Format();

      // hiển thị sp  theo trang(san pham moi)
    $so_sp_1_trang = 4;
    if(isset($_GET["trangn"])){
       $trangn = $_GET["trangn"]; 
       settype($trangn, "int");

       $from = ($trangn - 1)* $so_sp_1_trang;

       $qr = "SELECT * FROM tbl_product  ORDER BY productid DESC LIMIT $from, $so_sp_1_trang";
       $result = $db->select($qr);
       if($result){
       $i = 0;
       while($result_page = $result->fetch_assoc()){
           $i++;
           echo '

           <div class="grid_1_of_4 images_1_of_4">
            <a href="details.php"><img src="admin/uploads/'.trim($result_page['image']).'" alt="" /></a>
           <div class="fix-ui">
           <h2>'.$result_page['productName'].'</h2>
           <p><span class="price">'.$fm->canvert_vnd($result_page['price']).'</span></p>
            <div class="button"><span><a href="details.php?proid='.$result_page['productid'].'" class="details">Chi tiết</a></span></div>
          </div>
          </div>             

         ';
       }
      }
    }
      else{
      	$trangn = 1;
      	settype($trangn, "int");

        $from = ($trangn - 1)* $so_sp_1_trang;

       $qr = "SELECT * FROM tbl_product  ORDER BY productid DESC LIMIT $from, $so_sp_1_trang";
       $result = $db->select($qr);
       if($result){
        $i = 0;
        while($result_page = $result->fetch_assoc()){
          $i++;
         echo '

           <div class="grid_1_of_4 images_1_of_4">
            <a href="details.php"><img src="admin/uploads/'.trim($result_page['image']).'" alt="" /></a>
           <div class="fix-ui">
           <h2>'.$result_page['productName'].'</h2>
           <p><span class="price">'.$fm->canvert_vnd($result_page['price']).'</span></p>
            <div class="button"><span><a href="details.php?proid='.$result_page['productid'].'" class="details">Chi tiết</a></span></div>
          </div>
          </div>             

         ';
       }
     }
     }
     
   
       
   // show sp featherd

     if(!isset($_GET["trangf"]) && !isset($_GET["sanphamf"])){
       $trangf = 1; 

       $from = ($trangf - 1)* $so_sp_1_trang;

       $qr = "SELECT * FROM tbl_product WHERE type = '1'LIMIT $from, $so_sp_1_trang";
       $result = $db->select($qr);
       if($result){
       $i = 0;
       while($result_page_f = $result->fetch_assoc()){
           $i++;
           echo '

           <div class="grid_1_of_4 images_1_of_4">
            <a href="details.php"><img src="admin/uploads/'.trim($result_page_f['image']).'" alt="" /></a>
           <div class="fix-ui">
           <h2>'.$result_page_f['productName'].'</h2>
           <p>'.$fm->textShorten($result_page["productDesc"],70).'</p>
           <p><span class="price">'.$fm->canvert_vnd($result_page_f['price']).'</span></p>
            <div class="button"><span><a href="details.php?proid='.$result_page_f['productid'].'" class="details">Chi tiết</a></span></div>
          </div>
          </div>             

         ';
       }
      }
  }else{
  // 	 $so_sp_1_trang = 4;
  // 	 $trangn = 1;
  // 	 $from = ($trangn - 1)* $so_sp_1_trang;

  //      $qr = "SELECT * FROM tbl_product WHERE type = '1'LIMIT $from, $so_sp_1_trang";
  //      $result = $db->select($qr);
  //      if($result){
  //      $i = 0;
  //      while($result_page = $result->fetch_assoc()){
  //          $i++;
  //          echo '

  //          <div class="grid_1_of_4 images_1_of_4">
  //           <a href="details.php"><img src="admin/uploads/'.trim($result_page['image']).'" alt="" /></a>
  //          <div class="fix-ui">
  //          <h2>'.$result_page['productName'].'</h2>
  //          <p><span class="price">'.$fm->canvert_vnd($result_page['price']).'</span></p>
  //           <div class="button"><span><a href="details.php?proid='.$result_page['productid'].'" class="details">Chi tiết</a></span></div>
  //         </div>
  //         </div>             

  //        ';
  //      }
  //     }
  }
   


?>