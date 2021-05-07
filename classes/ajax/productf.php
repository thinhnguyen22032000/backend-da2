<?php 
   $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../../helpers/format.php');
  include_once ($filepath.'/../../lib/database.php');
  ?>


  <?php 

     
     
   
    $db = new Database();
    $fm = new Format();

     
    $so_sp_1_trang = 4;
  
     
   
       
   // show sp featherd

     if(isset($_GET["trangf"])){
       $trangf = $_GET["trangf"];

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
           <p>'.$fm->textShorten($result_page_f["productDesc"],70).'</p>
           <p><span class="price">'.$fm->canvert_vnd($result_page_f['price']).'</span></p>
            <div class="button"><span><a href="details.php?proid='.$result_page_f['productid'].'" class="details">Chi tiết</a></span></div>
          </div>
          </div>             

         ';
       }
      }
     }else{

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
           <p>'.$fm->textShorten($result_page_f["productDesc"],70).'</p>
           <p><span class="price">'.$fm->canvert_vnd($result_page_f['price']).'</span></p>
            <div class="button"><span><a href="details.php?proid='.$result_page_f['productid'].'" class="details">Chi tiết</a></span></div>
          </div>
          </div>             

         ';
       }
      }else{
        $trangf = 0;
      }
     }
       
?>