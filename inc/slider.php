
<style type="text/css">
	.header_bottom_right_images{
		width: 70%;
	}
	.ct_b{
		
	float: right;
    width: 25%;
    margin-left: 2%;
    padding-top: 36px;

	}
	p{
		padding: 10px 10px;
		color: grey
	}
	h2{
	padding: 10px;
    font-weight: bold;
	}
	.mail{
      color: red
	}
	.sdt{
		font-size: 25px;
		color: red;
	}

</style>
<div class="header_bottom">
		<!-- <div class="header_bottom_left">
			<div class="section group">
				

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php"><img src="images/pic1.png" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Canon</h2>
						  <p>Lorem ipsum dolor sit amet, sed do eiusmod.</p>
						  <div class="button"><span><a href="details.php">Add to cart</a></span></div>
					</div>
				</div>
			
			
			</div>
		  <div class="clear"></div>
		</div> -->
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php 
                             $show_slider_ui = $product->show_slider_ui(1);
                             if($show_slider_ui){
                             	while($result = $show_slider_ui->fetch_assoc()){ ?>
                         
						<li><img height="320px" src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></li>
						 <?php
                             	}
                             }
						 ?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>

	     <div class="ct_b">
		  <h2>CTY TNHH 3 TV HONDASHOP</h2>
		  <p>Liên hệ với chúng tôi</p>
		  <p>Mail: <span class="mail">nhthinh2k@gmail.com</span></p>
		  <p>SDT: <span class="sdt">0988899977</span></p>
		  <p>Chúng tôi sẽ giải đáp mọi thắc mắc của quí khách hàng!!</p>
	    </div>
	  <div class="clear"></div>
  </div>	