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
        <div id="scores">
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "tweets";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                         die("Connection failed: " . $conn->connect_error);
                    } 
                    $sql = "SELECT * FROM uri ";
                    $kot = "SELECT * FROM uri GROUP BY screen_name";
                    $max = "SELECT max(statuses_count), max(friends_count), max(followers_count) FROM uri LIMIT 1";
                    $result = $conn->query($sql);
                    $result2 = $conn->query($kot);
                    $result3 = $conn->query($max);
                    if ($result->num_rows > 0) {
                    	 	$i = 0;
	                      while($row = $result->fetch_assoc()) {
	                        //Number of tweets
	                        $tweets = count($row["tweet"]);
	                        $i++;
	                      }
	                      //Counts the number of unique kenyans on twitter(kots)
	                    	if ($result2->num_rows > 0) {
	                    		$kots = 0;
	                    		while ($row2 = $result2->fetch_assoc()) {
	                    			$kots++;
	                    		}
	                    	}
	                    	//Checks number of statuses & followers
	                    	if ($result3->num_rows > 0) {
	                    		while ($row3 = $result3->fetch_assoc()) {
	                    			$statuses = $row3["max(statuses_count)"];
	                    			$friends  = $row3["max(friends_count)"];
	                    			$following  = $row3["max(followers_count)"];
	                    			
	                    		}
	                    	}
	                    	
                     
                    } else {
                         echo "Somemthing went wrong";
                    }

                    $conn->close();
                    ?> 
        <div class="row top_tiles">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-comments-o"></i>
                </div>
                <div class="count"><?php echo $i?></div>

                <h3>Total Tweets</h3>
                <p>All collected tweets</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-globe"></i>
                </div>
                <div class="count"><?php echo $kots?></div>

                <h3>KoTs Online</h3>
                <p>Kenya twitter users</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-twitter"></i>
                </div>
                <div class="count"><?php echo $statuses?></div>

                <h3>Maximum Tweets</h3>
                <p>Person with most tweets</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-rss"></i>
                </div>
                <div class="count"><?php echo $friends?></div>

                <h3>Highest Follow</h3>
                <p>Max number of followers on a person</p>
              </div>
            </div>
          </div>
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

              </div>
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
  <script type="text/javascript">
  	var $scores = $("#scores");
		setInterval(function () {
		    $scores.load("summary.php #scores");
		}, 3000);
  </script>

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
