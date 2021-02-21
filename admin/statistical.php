<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php require_once '../classes/cart.php';?>
<?php 
     require_once '../helpers/format.php';
     $fm = new Format();
?>
<style type="text/css">
    
    .bold {
        font-weight: bold;
    }
    .re{
        color: red;
    }
    .gr{
        color: green;
    }

    table, td, th {  
      border: 1px solid #ddd;
      text-align: left;
    }

    table {
      border-collapse: collapse;

      
    }

    th, td {
      padding: 15px;
      padding-left: 20px !important;
    }
    .button:hover{
      background-color: #ebebe9;
    }
    .date1{
      margin-left: 8px;
    }
    #piechart{
    position: absolute;
    top: 170px;
    right: 80px;
    }
    .title{
    position: absolute;
    right: 50%;
    margin-top: 50px;
    }

     
</style>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
 <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>

  <?php 
      
  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thống kê</h2>
                 <form action="" method="post">
                    <table class="form">
                          <p >Từ: <input class="date1"  type="date" name="first_date" value="<?php echo $_POST['first_date'] ?>" ></p>
                          <p>Đến: <input type="date" name="last_date" value="<?php echo $_POST['last_date'] ?>" ></p>
                          <input class="button" type="submit" name="submit" value="Thống kê">                          
                          <?php 
                               $cart = new cart();
                                 
                               if(isset($_POST['submit'])){
                                 $date1 = $_POST['first_date'];
                                 $date2 = $_POST['last_date'];                           

                                 $thongke = $cart->thongke_date($date1,$date2);
                                 if($thongke){
                                  $all_quantity = 0;
                                  $all_price = 0;
                                  $all_quantity_huy = 0;
                                  while($result = $thongke->fetch_assoc()){ 
                                     if($result['status'] == '0'){
                                        $all_price += $result['price'];
                                        $all_quantity += $result['quantity'];
                                     }
                                     else{
                                      $all_quantity_huy += $result['quantity'];
                                     }    
                                     
                                     }
                              
                                    }
                                    if($thongke){
                                    echo '
                                    <table class="form" style="width: 25%">
                                         <tr>
                                             <th>Nội dung</th>
                                             <th>Giá trị</th>
                                          </tr>
                                          <tr>
                                             <td>Sản phẩm bán được</td>
                                             <td>'.$all_quantity.'</td>
                                          </tr>
                                          <tr>
                                             <td>Sản phẩm hũy đơn</td>
                                             <td>'.$all_quantity_huy.'</td>
                                          </tr>
                                          <tr>
                                             <td>Giá trị thu được</td>
                                             <td>'.$fm->canvert_vnd($all_price).'</td>
                                          </tr>
                                    </table>
                                    <span class="bold title">Thống kê: '.date('d-m-Y', strtotime($date1)).' đến '.date('d-m-Y', strtotime($date2)).'</span>
                                     <div id="piechart"></div>

                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                                        <script type="text/javascript">
                                        
                                        google.charts.load("current", {"packages":["corechart"]});
                                        google.charts.setOnLoadCallback(drawChart);

                                       
                                        function drawChart() {
                                          var data = google.visualization.arrayToDataTable([
                                          ["Task", "Hours per Day"],
                                          ["Sản phẩm bán được",'.$all_quantity.' ],
                                          ["Sản phẩm bị hũy", '.$all_quantity_huy.' ],
                                          
                                        ]);

                                         
                                          var options = {"title":"Thống kê sản phẩm", "width":550, "height":400};

                                       
                                          var chart = new google.visualization.PieChart(document.getElementById("piechart"));
                                          chart.draw(data, options);
                                        }
                                        </script>

                                    ';
                                    }
                                    elseif($thongke == 0){
                                      echo '<p class="re">Vui lòng kiếm tra input!!</p>';
                                    } 
                                    else{
                                      echo '<p class="re">Vui lòng nhập dữ liệu đầu vào!!</p>';
                                    }                                

                                 }else{
                                       
                                 $thongke = $cart->show_thongke_now();
                                 if($thongke){
                                  $all_quantity = 0;
                                  $all_price = 0;
                                  $all_quantity_huy = 0;
                                  while($result = $thongke->fetch_assoc()){ 
                                     if($result['status'] == '0'){
                                      $all_price += $result['price'];
                                      $all_quantity += $result['quantity'];
                                     }
                                     else{
                                      $all_quantity_huy += $result['quantity'];
                                    }    
                                     
                                    }
                              
                                    }
                                    echo '
                                    <table class="form" style="width: 25%">
                                          <tr>
                                             <th>Nội dung</th>
                                             <th>Giá trị</th>
                                          </tr>
                                          <tr>
                                             <td>Sản phẩm bán được</td>
                                             <td>'.$all_quantity.'</td>
                                          </tr>
                                          <tr>
                                             <td>Sản phẩm hũy đơn</td>
                                             <td>'.$all_quantity_huy.'</td>
                                          </tr>
                                          <tr>
                                              <td>Giá trị thu được</td>
                                              <td>'.$fm->canvert_vnd($all_price).'</td>
                                          </tr>
                                    </table>
                                    <p class="bold title">Thống kê: '.date('d-m-Y', strtotime(date('d-m-Y'))).'</p>

                                     <div id="piechart"></div>

                                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                                        <script type="text/javascript">
                                        
                                        google.charts.load("current", {"packages":["corechart"]});
                                        google.charts.setOnLoadCallback(drawChart);

                                       
                                        function drawChart() {
                                          var data = google.visualization.arrayToDataTable([
                                          ["Task", "Hours per Day"],
                                          ["Sản phẩm bán được",'.$all_quantity.' ],
                                          ["Sản phẩm bị hũy", '.$all_quantity_huy.' ],
                                          
                                        ]);

                                         
                                          var options = {"title":"Thống kê sản phẩm", "width":550, "height":400};

                                       
                                          var chart = new google.visualization.PieChart(document.getElementById("piechart"));
                                          chart.draw(data, options);
                                        }
                                        </script>


                                    ';


                                 }
                                
                            
                          ?>
                        
             
                           
                    </table>
                    </form>                

               <!--  <div id="piechart"></div>

                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                <script type="text/javascript">
                // Load google charts
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                // Draw the chart and set the chart values
                function drawChart($qt_b, $qt_h) {
                  var data = google.visualization.arrayToDataTable([
                  ['Task', 'Hours per Day'],
                  ['Sản phẩm bán được', $qt_b],
                  ['Sản phẩm bị hũy', $qt_h],
                  
                ]);

                  // Optional; add a title and set the width and height of the chart
                  var options = {'title':'Thống kê sản phẩm', 'width':550, 'height':400};

                  // Display the chart inside the <div> element with id="piechart"
                  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                  chart.draw(data, options);
                }
                </script> -->
            
            </div>
        </div>
<?php include 'inc/footer.php';?>