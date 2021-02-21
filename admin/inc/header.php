<?php 
  include '../lib/session.php';
  Session::checkSession();

  
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="../css/type_alert.css" rel="stylesheet" type="text/css" media="all"/>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>

    <!-- thong ke -->
 <!--    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

          <script type="text/javascript">
    
      google.charts.load('current', {packages: ['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawBasic);

      function drawBasic() {

            var data = google.visualization.arrayToDataTable([
              ['City', '2010 Population',],
              ['New York City, NY', 8175000],
              ['Los Angeles, CA', 3792000],
              ['Chicago, IL', 2695000],
              ['Houston, TX', 2099000],
              ['Philadelphia, PA', 1526000]
            ]);

            var options = {
              title: 'Population of Largest U.S. Cities',
              chartArea: {width: '50%'},
              hAxis: {
                title: 'Total Population',
                minValue: 0
              },
              vAxis: {
                title: 'City'
              }
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

            chart.draw(data, options);
          }

   </script> -->

	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/logohonda.jfif" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>Quản trị</h1>
					<p>Đại học KT-CN Cần Thơ</p>
				</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img width="40px" style="border-radius: 30px" src="img/profile-hacker.png" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li><?php 
                              echo $_SESSION['adminName'];
                            
                            ?></li>
                             <?php  
                                 if(isset($_GET['action']) && $_GET['action']=='logout')
                                  Session::destroy();
                                ?>
                            <li><a href="?action=logout">Đăng xuất</a>

                             </li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Quản trị</span></a> </li>
               <!--  <li class="ic-form-style"><a href=""><span>User Profile</span></a></li> -->
        				<li class="ic-typography"><a href="changepassword.php"><span>Đổi mật khẩu</span></a></li>
        				<li class="ic-grid-tables"><a href="inbox.php"><span>Inbox</span></a></li>
               <!--  <li class="ic-charts"><a href=""><span>Visit Website</span></a></li> -->
               <?php 

                       if(Session::get('level') == 0){
                        echo "<li><a href='statistical.php'>Thống kê</a></li>";
                       }
                       else{

                       }   
                ?>
                
                <?php 

                       if(Session::get('level') == 0){
                        echo "<li><a href='log.php'>Log</a></li>";
                       }
                       else{

                       }   
               
                ?>


               

            </ul>
        </div>
        <div class="clear">
        </div>
    