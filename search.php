<?php require("templates/header.php") ?>

</head>

<!--Body Starts here-->
<body class="nav-md">

  <div class="container body">


    <div class="main_container">
<!--Sidebar Starts here-->
<?php require("templates/sidebar.php") ?>
<!--Sidebar Ends here-->

<!--Sidebar Starts here-->
<?php require("templates/menu.php") ?>
<!--Sidebar Ends here-->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
        
                    <?php
                    //error_reporting(0);
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "tweets";
                  	//connection to the database
										$conn = mysqli_connect($servername,$username,$password,$dbname);
										// Check connection
		                if ($conn->connect_error) {
		                     die("Connection failed: " . $conn->connect_error);
		                } 
                    $keywords =  "Kenya";
         //           $keywords =  "ongo\'nyi duong , gi ther modhiek ka dho nyathi , kihii ,  kehee ,  rayuom , jamwa , ruriri , nyamu cia ruguruguru ";
                  //$parts = explode(",",trim($keywords));
									// $clauses=array();
									// foreach ($parts as $part){
									//     //function_description in my case ,  replace it with whatever u want in ur table
									//     $clauses[]="LIKE '%" .$part. "%'";
									// }
									// $clause=implode(' OR ' ,$clauses);
									//echo $clause;
									//select your condition and add "AND ($clauses)" .
									$sql="SELECT * FROM uri WHERE tweet LIKE '$$keywords$'";
									$result = $conn->query($sql);
	                if ($result->num_rows > 0) {
	                	echo "Something found";
	                    while($row = $result->fetch_assoc()) {
	                      //Collect all profile details 
	                      $name = $row["name"];
	                      $prof = $row["profile_image_url"] ;
	                      $prof = str_replace("_normal","",$prof);
	                      $location = $row["location"];
	                      $desc = $row["description"];
	                      //$tweets = $row["tweet"];
	                      $handle = $row["screen_name"];
	                      //$time =$row["composed_time"];
	                    }
	                 } else{
	                 	echo "Sorry we couldn't get anything for you from DB";
	                 }
                  ?> 
          <div class="clearfix"></div>
          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" style="height:600px;">
                <div class="x_title">
                  <h2>Influence</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                Defected tweets: 
              </div>
            </div>
          </div>
          
        </div>

        <!-- footer content -->
        <?php require("templates/footer.php") ?>
        <!-- /footer content -->

      </div>
      <!-- /page content -->
    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>
  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>

</body>

</html>
