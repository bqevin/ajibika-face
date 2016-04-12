<?php 
require dirname(__FILE__).'/templates/header.php';
//Check if search data was submitted
if ( isset( $_GET['s'] ) ) {

  // Include the search class
  //include( 'class.search.php' );
  require dirname(__FILE__).'/classes/class.search.php';
  
  // Instantiate a new instance of the search class
  $search = new search();
  
  // Store search term into a variable
  $search_term = htmlspecialchars($_GET['s'], ENT_QUOTES);
  
  // Send the search term to our search class and store the result
  $search_results = $search->search($search_term);

}
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
          <div class="page-title">
            <div class="title_left">
              <h3><?php echo $search_results['count']; ?> results of "<strong><?php echo $search_term ?></strong>" found</h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" >
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
                <div class="x_content">

                      <div class="col-md-9 col-sm-9 col-xs-12">

                       <!--  <ul class="stats-overview">
                          <li>
                            <span class="name"> Estimated budget </span>
                            <span class="value text-success"> 2300 </span>
                          </li>
                          <li>
                            <span class="name"> Total amount spent </span>
                            <span class="value text-success"> 2000 </span>
                          </li>
                          <li class="hidden-phone">
                            <span class="name"> Estimated project duration </span>
                            <span class="value text-success"> 20 </span>
                          </li>
                        </ul> -->
                        <div>

                          <h4>Recent tweets relating to the keyword</h4>

                          <!-- end of user messages -->
                          <ul class="messages">
                          <?php
                          if ($search_results){
                            foreach ( $search_results['results'] as $search_result ){
                              
                           ?>

                            <li class="animated flipInX">
                              <img src="<?php echo $search_result->profile_image_url?>" class="avatar" alt="Avatar">
                              <div class="message_date">
                                <h3 class="date text-info"><?php echo substr($search_result->composed_time,4,6)?></h3>
                                <p class="month"><?php echo substr($search_result->composed_time,10,12)?></p>
                              </div>
                              <div class="message_wrapper">
                                <h4 class="heading"><a target="_blank" href="profile.php?user=<?php echo $search_result->screen_name?>">@<?php echo $search_result->screen_name?></h4>
                                <blockquote class="message"><?php echo $search_result->tweet?></blockquote>
                                </a>
                                <br />
                                <p class="url">
                                  <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                  <a href="#"><i class="fa fa-paperclip"></i> Push as hatred message </a>
                                </p>
                              </div>
                            </li>
                            <?php
                             }
                          }
                          ?>
                          </ul>
                          <!-- end of user messages -->


                        </div>


                      </div>

                      <!-- start project-detail sidebar -->
                      <div class="col-md-3 col-sm-3 col-xs-12">

                        <section class="panel">

                          <div class="x_title">
                            <h2>Keyword Description</h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="panel-body">
                            <h3 class="green"><i class="fa fa-paint-comment"></i>Keyword :  <?php echo $search_term; ?></h3>
                            <?php
                              // Include the db connector
                              require dirname(__FILE__).'/templates/db.connect.php';
                              $sql = "SELECT * FROM words where hateframe = '$search_term' ";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                $i = 1;
                                while($row = $result->fetch_assoc()) {
                                  ?>
                                  <p><strong>Meaning: </strong><?php echo $row['meaning']?></p>
                                  <p>
                                  <strong>Variants: </strong><br>
                                  <?php 
                                  $text_line = explode(",",$row['variants']);
                                  $i = 1;
                                  for ($start=0; $start < count($text_line); $start++) {
                                  print $i.".  <a href='search.php?s=$text_line[$start]' target='_blank'>".$text_line[$start]. "</a><br>";
                                  $i++;
                                  }
                                  ?>
                                  </p>
                                  <?php
                                }
                              }
                            ?>
                            
                            <br />

                          
                          </div>

                        </section>

                      </div>
                      <!-- end project-detail sidebar -->

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
