<style type="text/css">
.footer{
	    text-align: center;

}
.footer div{
	
}
.footer div h4 {
	color: white;
}
.footer div h4  li {
	color: white;
}
</style>
</div>
   <div class="footer">
   	   <div class="wrapper">	
	     <div class="section group">
	      <div class="col_1_of_4 span_1_of_4" style="margin-left: 35%">
						<h4>CTY TNHH 3 thành viên HONDASHOP</h4>
						<ul>
						<li><a href="#">Địa chỉ: 112/Nguyễn Văn Cừ</a></li>
						<li><a href="#">Hotline: 0999887766</a></li>
						<li><a href="#"><span>Email: nhtinh2k@gmail.opm</span></a></li>
						<li><a href="#"></a></li>
						<li><a href="#"><span></span></a></li>
						</ul>
					</div>

     </div>
    </div> 
</div>
<!-- <div class="footer">
	<div>
	<h4>Information</h4>
						<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Customer Service</a></li>
						<li><a href="#"><span>Advanced Search</span></a></li>
						<li><a href="#">Orders and Returns</a></li>
						<li><a href="#"><span>Contact Us</span></a></li>
						</ul>
					</div>
</div> -->
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>
<?php 

     ob_end_flush();
?>