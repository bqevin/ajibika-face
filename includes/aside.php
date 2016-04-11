      <!--sidebar start-->
      <aside>
        <div id="sidebar"  class="nav-collapse " style="padding-top:20px;">
          <!-- sidebar menu start-->
          <ul class="sidebar-menu" id="nav-accordion">
           <!--  <h5 class="centered"><a href="display.php?user=<?php echo $user->data()->username; ?>"><?php echo $user->data()->name; ?></a></h5> -->
            <?php 
              $email = $user->data()->email; 
              $_SESSION['email'] = $email;
              ?>
            <li class="mt">
              <a href="display.php?user=<?php echo $user->data()->username; ?>">
              <i class="fa fa-dashboard"></i>
              <span>Profile</span>
              </a>
            </li>
            <li class="sub-menu">
              <a href="javascript:;" >
                <!-- <i class="fa fa-money"></i> -->
                <span>Payment History <i class="fa fa-chevron-down"></i></span>
              </a>
              <ul class="sub">
                <li><a  href="#">Balance</a></li>
                <li><a  href="#">Cash Accumulated</a></li>
                <!-- <li><a  href="#">Visa</a></li> -->
              </ul>
            </li>
            <li class="sub-menu">
              <a class="active" href="javascript:;" >
              <i class="fa fa-user"></i>
              <span>Account Details</span>
              </a>
            </li>
            <li class="sub-menu">
              <a href="javascript:;"  >
              <i class="fa fa-cloud-download"></i>
              <span>Download History</span>
              </a>
            </li>
            <!--                   <li class="sub-menu">
              <a href="javascript:;" >
                  <i class="fa fa-book"></i>
                  <span>Buy Licences</span>
              </a>
              <ul class="sub">
                  <li><a  href="#">Public</a></li>
                  <li><a  href="#">General</a></li>
              
              </ul>
              </li> -->
          </ul>
          <!-- sidebar menu end-->
        </div>
      </aside>
      <!--sidebar end-->