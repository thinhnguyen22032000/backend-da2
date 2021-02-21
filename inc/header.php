<?php 
  include_once 'lib/session.php';
  Session::init();
?>


<?php 
   include_once 'lib/database.php';
   include_once 'helpers/format.php';
        
        
        require_once 'classes/user.php';
        require_once 'classes/cart.php';
        require_once 'classes/category.php';
        require_once 'classes/brand.php';
        require_once 'classes/product.php';
        require_once 'classes/customer.php';

      
        $db = new Database();
        $fm = new Format();
        $cart = new cart();
        $user = new user();
        $cat = new category();
        $brand = new brand();
        $product = new product();
        $customer = new customer();
         
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>


<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/type_alert.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>

<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="post" >
				    	<input type="text" name="key" placeholder="Nhập từ khóa...">
              <input type="submit" name="submit_search" value="Tìm">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php 
                                         $check_cart = $cart->check_cart();
                                         if($check_cart){
                                         echo session::get("sum") . ' || '. session::get("qty") ;
                                     }
                                     else{
                                     	echo "rỗng";
                                     }
									?>
								</span>
							</a>
						</div>
			      </div>

			<?php 
                 if(isset($_GET['ctid'])){
                  $del_cart = $cart->del_cart();
                 	Session::destroy();
                 }
             
			?>
		   <div class="login">
               <?php 
                    $check_user = Session::get('customer_login');
                    if($check_user){
                    	
                    	echo "<a href='?ctid=".Session::get('customer_id')."'>Đăng xuất</a>";
                    }
                    else{
                    	echo "<a href='login.php'>Đăng nhập</a>";
                    }
               ?>
          
		   	</div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Trang chủ</a></li>
	  <li><a href="products.php">Sản phẩm</a> </li>
	  <li><a href="topbrands.php">Thương hiệu</a></li>
     <?php 
                  $check_login = Session::get("customer_login");
                  // $check_wishlist = $cart->check_wishlist($id_ct);
                     if($check_login){
                          echo "<li><a href='cart.php'>Giỏ hàng</a></li>";
                    }
                     else{
                         echo "";   
                    }
     ?>
	 
	  <li><a href="contact.php">Liên hệ</a> </li>
       <?php 
                  $check_login = Session::get("customer_login");
                  // $check_wishlist = $cart->check_wishlist($id_ct);
                     if($check_login){
                          echo "<li><a href='wishlist.php'>Yêu thích</a></li>";
                    }
                     else{
                         echo "";   
                    }
     ?>

     


      <?php 
                  $id_ct = Session::get("customer_login");
                  // $check_ordered = $cart->check_ordered($id_ct);
                     if($check_login){
                          echo "<li><a href='order.php'>Hàng đã đặt</a></li>";
                    }
                     else{
                         echo "";   
                    }
                  ?>

      <?php 
           $check_login = Session::get('customer_login');
           if($check_user){
           	echo "<li><a href='profile.php'>Hồ sơ</a></li>";
           }
           else{

           }   
               
      ?>
	  <div class="clear"></div>
	</ul>
</div>