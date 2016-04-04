<?php require("templates/header.php") ?>

</head>


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
              <h3>Evaluating the influence of hatespeech</h3>
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
              <div class="x_panel">
                <div class="x_title">
                  <h2>Daily active users <small>Sessions</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-chevron-up"></i></a>
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
                    <li><a href="#"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                      <tr class="headings">
                        <th>
                          <input type="checkbox" class="tableflat">
                        </th>
                        <th>Name</th>
                        <!-- <th>Description</th> -->
                        <th>Followers</th>
                        <th>Total Statuses</th>
                        <th>Following </th>
                        <th>Timezone </th>
                        <th>Joined Twiter</th>
                        <th class=" no-link last"><span class="nobr">Action</span>
                        </th>
                      </tr>
                    </thead>

                    <tbody>
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
                    $sql = "SELECT * FROM uri GROUP BY screen_name ORDER BY id DESC LIMIT 50";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      $i = 1;
                      while($row = $result->fetch_assoc()) {
                        //Output Data
                        // $prof = $row["profile_image_url"] ;
                        // $prof = str_replace("_normal","",$prof); ?>
                      <tr class="even pointer">
                        <td class="a-center ">
                          <input type="checkbox" class="tableflat">
                        </td>
                        <td class=" "><?php echo  $row["name"] ?></td>
                        <td class=" "><?php echo  $row["friends_count"] ?></td>
                        <td class=" "><?php echo  $row["statuses_count"] ?></td>
                        <td class="a-right a-right "><?php echo  $row["followers_count"] ?></td>
                        <td class=" "><?php echo  $row["time_zone"] ?></td>
                        <td class=" "><?php echo  $row["created_at"] ?></td>
                        <td class=" last"><a href="profile.php?user=<?php echo $row['screen_name']?>">View</a>
                        </td>
                      </tr>
                      <?php
                      // if even, give class odd
                      if($i % 2 == 0) {?>
                        <tr class="odd pointer">
                        <td class="a-center ">
                          <input type="checkbox" class="tableflat">
                        </td>
                        <td class=" "><?php echo  $row["name"] ?></td>
                        <td class=" "><?php echo  $row["friends_count"] ?></td>                
                        <td class=" "><?php echo  $row["statuses_count"] ?></td>
                        <td class="a-right a-right "><?php echo  $row["followers_count"] ?></td>
                        <td class=" "><?php echo  $row["time_zone"] ?></td>
                        <td class=" "><?php echo  $row["created_at"] ?></td>
                        <td class=" last"><a href="profile.php?user=<?php echo $row['screen_name']?>">View</a>
                        </td>
                      </tr>
                      <?php }
                      ?>
                      
                  <?php
                         }
                    } else {
                         echo "Apparenty there is NO results to be fetched";
                    }

                    $conn->close();
                    ?> 
                    </tbody>

                  </table>
                </div>
              </div>
            </div>

            <br />
            <br />
            <br />

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


  <!-- Datatables -->
  <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script>
    $(document).ready(function() {
      $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      });
    });

    var asInitVals = new Array();
    $(document).ready(function() {
      var oTable = $('#example').dataTable({
        "oLanguage": {
          "sSearch": "Search all columns:"
        },
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0]
          } //disables sorting for column one
        ],
        'iDisplayLength': 12,
        "sPaginationType": "full_numbers",
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
          "sSwfPath": "js/datatables/tools/swf/copy_csv_xls_pdf.swf"
        }
      });
      $("tfoot input").keyup(function() {
        /* Filter on the column based on the index of this element's parent <th> */
        oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
      });
      $("tfoot input").each(function(i) {
        asInitVals[i] = this.value;
      });
      $("tfoot input").focus(function() {
        if (this.className == "search_init") {
          this.className = "";
          this.value = "";
        }
      });
      $("tfoot input").blur(function(i) {
        if (this.value == "") {
          this.className = "search_init";
          this.value = asInitVals[$("tfoot input").index(this)];
        }
      });
    });
  </script>
</body>

</html>
