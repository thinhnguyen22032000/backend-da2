<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">
                <li><a class="menuitem">Danh mục sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="catadd.php">Thêm danh mục </a> </li>
                        <li><a href="catlist.php">Danh mục sản phẩm</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Thương hiệu sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="brandadd.php">Thêm thương hiệu</a> </li>
                        <li><a href="brandlist.php">Danh mục thương hiệu</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="productadd.php">Thêm sản phẩm</a> </li>
                        <li><a href="productlist.php">Danh sách sản phẩm</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Slider</a>
                    <ul class="submenu">
                        <li><a href="slideradd.php">Thêm Slider</a> </li>
                        <li><a href="sliderlist.php">Danh sách Slider</a> </li>
                    </ul>
                </li>
  
            <?php 
                     if(Session::get('level') == 0){ ?>
                        
                        <li><a class="menuitem">Nhân sự</a>
                         <ul class="submenu">
                             <li><a href="createadmin.php">Thêm nhân sự</a> </li>
                            <li><a href="personnellist.php">Danh sách nhân sự</a> </li>
                        </ul>
                     </li>
           <?php
                     }
                 
            ?>

                <!-- <li><a class="menuitem">Nhân sự</a>
                     <ul class="submenu">
                        <li><a href="createadmin.php">Thêm nhân sự</a> </li>
                        <li><a href="personnellist.php">Danh sách nhân sự</a> </li>
                    </ul>
                </li> -->
                
            </ul>
        </div>
    </div>
</div>