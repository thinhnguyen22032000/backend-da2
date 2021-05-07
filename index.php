<?php
    
  require_once "inc/header.php";
  include "inc/slider.php";  
 ?>

 <?php 
      if(isset($_GET['trang'])){
        $trang = $_GET['trang'];
      }
      else{
        $trang = 1;
      }
 ?>
	
<style type="text/css">
    .grid_1_of_4{
    min-height: 400px;

}
.phantrang a{
   padding-right: 5px;
}
.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}

.context-menu {cursor: context-menu;}

</style>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nổi bậc</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    
	     <div class="section group" id="sanphamf"></div>
        
     <!--  phan trang sản pham noi bat -->
      <div class="pagination">
      <a class="context-menu" id="befor_page_f">&laquo;</a>
      <a  id="page_f"></a>
      <a class="context-menu"  id="next_page_f">&raquo;</a>
      </div>

    
				
			<div class="content_bottom">
        		<div class="heading">
        		<h3>Sản phẩm mới</h3>
        		</div>
        		<div class="clear"></div>
    	</div>
      <!--  phan trang san pham new -->
     
			<div class="section group" id="sanphammoi"></div>
      <div class="pagination">
      <a class="context-menu" id="befor_page" name="">&laquo;</a>
      <a  id="page"></a>
      <a class="context-menu"  id="next_page">&raquo;</a>
      
      </div>
			          
           
    </div>

 </div>
 <script type="text/javascript">

  // goi data bằng ajax
  $(document).ready(function(){
       //load san pham moi
       load_spn();
       //load san pham f
       load_spf();

     
    
  });
      function load_spf(){
         $.get("./classes/ajax/productf.php",{"sanphamf":"f"}, function(data){
             
             $("#sanphamf").html(data);
             $("#page_f").html(count);

         });
      }

       function load_spn(){
         $.get("./classes/ajax/productn.php",{"sanphammoi":"n"}, function(data){
             $("#sanphammoi").html(data);           
             $("#page").html(count);
              console.log(count);


         });
       }
       // function load page
       // function load_page(count){
       //     if(count == 1){
            
       //      $("#befor_page").attr('readonly', true);
       //      $("#befor_page").css({"background-color":"grey"});
       //     }
       // }
      // next trang product new
        var count = 1;
       
        //next san pham vè sau
        $("#next_page").click(function(){
          count++;
           $.get("./classes/ajax/productn.php", {"trangn":count}, function(data){
            if(data!=0){
             $("#sanphammoi").html(data);
             $("#page").html(count);
              console.log(count);
             // load_page(count);
                }
                else{
                  count--;
                }
         });
        });
        //next sp về trước
         $("#befor_page").click(function(){
          if(count > 1){
          count--;
           $.get("./classes/ajax/productn.php", {"trangn":count}, function(data){
             $("#sanphammoi").html(data);
             $("#page").html(count);
             console.log(count);
            // load_page(count);
            
            
         });
         }else{
           
            $("#befor_page").attr('readonly', true);
            $("#befor_page").css({"background-color":"#e9e1e1"});
         }
        });

     // next trang san pham noi bat
     var count_f = 1; 
     $("#next_page_f").click(function(){
          count_f++; 
              
           $.get("./classes/ajax/productf.php", {"trangf":count_f}, function(data){
            if(data!=0){
             $("#sanphamf").html(data);
             $("#page_f").html(count_f);
          
             }else{
              count_f--;
             }
         });
         
        });
         $("#befor_page_f").click(function(){
          if(count_f > 1){
           count_f--;
            $.get("./classes/ajax/productf.php", {"trangf":count_f}, function(data){
             $("#sanphamf").html(data);
             $("#page_f").html(count_f);
            
         });
          }else{
              $("#befor_page_f").attr('readonly', true);
            $("#befor_page_f").css({"background-color":"#e9e1e1"});
          }
        });                 

 </script>

 <?php 
   include "inc/footer.php";
 ?>


     


