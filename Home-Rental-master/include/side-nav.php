<?php
	if(empty($_SESSION['role']))
		header('Location: login.php');

?>
<!-- <section> -->
	<!-- <nav class="navbar navbar-expand-sm navbar-default sidebar" style="background-color:rgba(217, 179, 255,0.5);" id="mainNav">
      <div class="container">
      	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" 
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
         <i class="fa fa-bars"></i>
        Menu
        </button>
        
        <div class="collapse navbar-collapse" id="navbarResponsive1">
          <ul class="navbar-nav text-center" style="    flex-direction: column;">  
          <div class="mb-5">
          <a class="nav-link" href="#" ><?php echo $_SESSION['fullname']; ?> <?php if($_SESSION['role'] == 'admin'){ echo "(Admin)"; } ?></a>
        </div>    
            <li class="nav-item">
              <a class="nav-link" href="../auth/dashboard.php">Home</a>
            </li>
            <li class="nav-item">
            	<?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user'){ 
	        		echo '<a href="../app/register.php" class="nav-link"> Register </a>';
	      	 	} ?>             
            </li>
            <li class="nav-item">
	        	<a href="../app/list.php" class="nav-link">Details/Update</a>
            </li>

            <li class="nav-item">
              <?php if($_SESSION['role'] == 'admin'){ 
                echo '<a href="../app/sms.php" class="nav-link">Send SMS</a>';
              } ?>
            </li>

            <li class="nav-item">
              <?php if($_SESSION['role'] == 'admin'){ 
                echo '<a href="../app/cmplist.php" class="nav-link">Complaint List</a>';
              } ?>
            </li>
          </ul>
        </div>
      </div>
    </nav> -->
<html>
  <head>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script>
      
    </script>
  </head>
  <body>
  <nav>
        <div class="logo-name">
            <div class="logo-image">
                <!--<img src="images/logo.png" alt="">-->
            </div>

            <span class="logo_name">Home/Rent</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="../auth/dashboard.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Home</span>
                </a></li> 
                <li>
                    
                <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user'){ 
                echo '<a href="../app/register.php">
	        	    <i class="uil uil-signin"></i>
                 <span class="link-name">Register</span>
                  </a>';
	      	 	} ?> 
              </li>
                <li>
                    
                <?php if( $_SESSION['role'] == 'user'){ 
                echo '<a href="../app/complaint.php">
	        	    <i class="uil uil-signin"></i>
                 <span class="link-name">Complaint</span>
                  </a>';
	      	 	} ?> 
              </li>
                <li><a href="../app/list.php">
                  <i class="uil uil-document-info"></i>
                  <span class="link-name">Details/Update</span>
                </a></li>

                <li>
                 <?php if($_SESSION['role'] == 'admin'){ 
                  echo '<a href="../app/sms.php" class="nav-link">
                  <i class="uil uil-message"></i>
                  <span class="link-name">Send SMS</span></a>';
                 } ?>     
                </li>


                <li>
                <?php if($_SESSION['role'] == 'admin'){ 
                echo '<a href="../app/cmplist.php" class="nav-link">
                <i class="uil uil-comments"></i>
                    <span class="link-name">Complaint List</span></a>';
                } ?> 
                </li>


                <!-- <li><a href="#">
                    <i class="uil uil-share"></i>
                    <span class="link-name">Share</span>
                </a></li> -->
            </ul>
            
            <ul class="logout-mode">
              <li><a href="#">
                 <i class="uil uil-user-circle"></i>
                    <span class="link-name"><?php echo $_SESSION['fullname']; ?> <?php if($_SESSION['role'] == 'admin'){ echo "(Admin)"; } ?></span>
                </a></li>
                <li><a href="../auth/logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
                

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>
    <script src="../assets/js/script.js"></script>
  </body>
</html>
   

<!-- </section> -->
