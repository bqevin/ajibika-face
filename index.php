<?php require("templates/header.php") ;
set_time_limit(60000);
?>

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
                    // Include the db connector
                    require dirname(__FILE__).'/templates/db.connect.php';
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
          <div class="row top_tiles">
          <?php
                    // Include the search class
                    require dirname(__FILE__).'/classes/class.search.php';
                    $words = "SELECT * FROM words";
                    $checkWords = $conn->query($words);
                    if ($checkWords->num_rows > 0) {
                        while($row = $checkWords->fetch_assoc()) {
                          //hatewords fetched
                          $hateframe = $row["hateframe"];
                          $meaning = $row["meaning"];
                          // Instantiate a new search class object
                          $search = new search();
                          // Send the search term to our search class and store the result
                          $search_results = $search->search($hateframe);
                          //if ($search_results) 
                          ?>
                          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <div class="tile-stats">
                            <div class="icon"><i class="fa fa-comments-o"></i>
                            </div>
                            <div class="count">
                            <?php if (is_numeric($search_results['count'])){
                              echo "<a href='search.php?s=$hateframe' target='_blank'>".$search_results['count']."</a>";
                              } else {
                                echo "0"; 
                              }
                              
                            ?>
                            </div>
                            <h3><?php echo $hateframe?></h3>
                            <p>
                            <?php 
                            if($meaning == ""){
                                echo "No description provided";
                                } else {
                                  echo $meaning;
                                }
                            ?>
                            </p>
                          </div>
                        </div>
                          <?php
                          
                        }
                    }

                    $conn->close();

          ?>
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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add-modal">
                  Submit keywords
                </button>
                 <!-- Keyword modal -->
                        <div class="modal fade" id="add-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Add one word at a time</h4>
                            </div>
                            <div class="modal-body">
                             <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="saveKeyword.php" method="post">
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hate keyword <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="first-name" name="hateframe" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meaning/Explanation <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="first-name" name="meaning" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Degree Irritation (%) <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="last-name" name="degree"required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                              <div class="ln_solid"></div>
                              <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                                  <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>
                        <!-- /.modal -->


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
		    $scores.load("index.php #scores");
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
