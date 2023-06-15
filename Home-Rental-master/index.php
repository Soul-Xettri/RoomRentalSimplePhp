<?php
  require 'config/config.php';
  $data = [];
  
  if(isset($_POST['search'])) {
    // Get data from FORM
    $keywords = $_POST['keywords'];
    $location = $_POST['location'];

    //keywords based search
    $keyword = explode(',', $keywords);
    $concats = "(";
    $numItems = count($keyword);
    $i = 0;
    foreach ($keyword as $key => $value) {
      # code...
      if(++$i === $numItems){
         $concats .= "'".$value."'";
      }else{
        $concats .= "'".$value."',";
      }
    }
    $concats .= ")";
  //end of keywords based search
  
  //location based search
    $locations = explode(',', $location);
    $loc = "(";
    $numItems = count($locations);
    $i = 0;
    foreach ($locations as $key => $value) {
      # code...
      if(++$i === $numItems){
         $loc .= "'".$value."'";
      }else{
        $loc .= "'".$value."',";
      }
    }
    $loc .= ")";

  //end of location based search
    
    try {
      //foreach ($keyword as $key => $value) {
        # code...

        $stmt = $connect->prepare("SELECT * FROM room_rental_registrations_apartment WHERE country IN $concats OR country IN $loc OR state IN $concats OR state IN $loc OR city IN $concats OR city IN $loc OR address IN $concats OR address IN $loc OR rooms IN $concats OR landmark IN $concats OR landmark IN $loc OR rent IN $concats OR deposit IN $concats");
        $stmt->execute();
        $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $connect->prepare("SELECT * FROM room_rental_registrations WHERE country IN $concats OR country IN $loc OR state IN $concats OR state IN $loc OR city IN $concats OR city IN $loc OR rooms IN $concats OR address IN $concats OR address IN $loc OR landmark IN $concats OR rent IN $concats OR deposit IN $concats");
        $stmt->execute();
        $data8 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = array_merge($data2, $data8);

    }catch(PDOException $e) {
      $errMsg = $e->getMessage();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>App</title>
    
    



    <!-- Bootstrap core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--Custom fonts for this template -->
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  
    <!-- Custom styles for this template -->
    <link href="assets/css/rent.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
   
  </head>

  <body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Rentals</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
           
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#search">Search</a>
            </li>
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#team">aboutus</a>
            </li>
            
            <?php 
              if(empty($_SESSION['username'])){
                echo '<li class="nav-item">';
                  echo '<a class="nav-link" href="./auth/login.php">Login</a>';
                echo '</li>';
              }else{
                echo '<li class="nav-item">';
                 echo '<a class="nav-link" href="./auth/dashboard.php">Home</a>';
               echo '</li>';
              }
            ?>
           
            

            <li class="nav-item">
              <a class="nav-link" href="./auth/register.php">Register</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in">Welcome To Room Rental Registration!</div>
          <div class="intro-heading text-uppercase">It's Nice To See You<br></div>
        </div>
      </div>
    </header>

     <!-- Search -->
    <section id="search">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Search</h2>
            <h3 class="section-subheading text-muted">Search rooms or homes for rent.</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form action="" method="POST" class="center" novalidate>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="keywords" name="keywords" type="text" placeholder="Key words(Ex: Pokhara,rent..)" required data-validation-required-message="Please enter keywords">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <input class="form-control" id="location" type="text" name="location" placeholder="Location" required data-validation-required-message="Please enter location.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>         

                <div class="col-md-2">
                  <div class="form-group">
                    <button id="" class="btn btn-success btn-md text-uppercase" name="search" value="search" type="submit">Search</button>
                  </div>
                </div>
              </div>
            </form>

            <?php
              if(isset($errMsg)){
                echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
              }
              if(count($data) !== 0){
                echo "<h2 class='text-center'>List of Apartment Details</h2>";
              }else{
                //echo "<h2 class='text-center' style='color:red;'>Try Some other keywords</h2>";
              }
            ?>        
            <?php 
                foreach ($data as $key => $value) {           
                  echo '<div class="card card-inverse card-info mb-3" style="padding:1%;">          
                        <div class="card-block">';
                          // echo '<a class="btn btn-warning float-right" href="update.php?id='.$value['id'].'&act=';if(isset($value['ap_number_of_plats'])){ echo "ap"; }else{ echo "indi"; } echo '">Edit</a>';
                         echo   '<div class="row">
                            <div class="col-4">
                            <h4 class="text-center">Owner Details</h4>';
                              echo '<p><b>Owner Name: </b>'.$value['fullname'].'</p>';
                              echo '<p><b>Mobile Number: </b>'.$value['mobile'].'</p>';
                             // echo '<p><b>Alternate Number: </b>'.$value['alternat_mobile'].'</p>';
                              echo '<p><b>Email: </b>'.$value['email'].'</p>';
                              echo '<p><b>Country: </b>'.$value['country'].'</p><p><b> State: </b>'.$value['state'].'</p><p><b> City: </b>'.$value['city'].'</p>';
                              if ($value['image'] !== 'uploads/') {
                                # code...
                                echo '<img src="app/'.$value['image'].'" width="100">';
                              }

                          echo '</div>
                            <div class="col-5">
                            <h4 class="text-center">Room Details</h4>';
                              // echo '<p><b>Country: </b>'.$value['country'].'<b> State: </b>'.$value['state'].'<b> City: </b>'.$value['city'].'</p>';
                              echo '<p><b>Plot Number: </b>'.$value['plot_number'].'</p>';

                              if(isset($value['sale'])){
                                echo '<p><b>Sale: </b>'.$value['sale'].'</p>';
                              } 
                              
                                if(isset($value['apartment_name']))                         
                                  echo '<div class="alert alert-success" role="alert"><p><b>Apartment Name: </b>'.$value['apartment_name'].'</p></div>';

                                if(isset($value['ap_number_of_plats']))
                                  echo '<div class="alert alert-success" role="alert"><p><b>Plat Number: </b>'.$value['ap_number_of_plats'].'</p></div>';

                              echo '<p><b>Available Rooms: </b>'.$value['rooms'].'</p>';
                              echo '<p><b>Address: </b>'.$value['address'].'</p><p><b> Landmark: </b>'.$value['landmark'].'</p>';
                          echo '</div>
                            <div class="col-3">
                            <h4>Other Details</h4>';
                            echo '<p><b>Accommodation: </b>'.$value['accommodation'].'</p>';
                            echo '<p><b>Description: </b>'.$value['description'].'</p>';
                              if($value['vacant'] == 0){ 
                                echo '<div class="alert alert-danger" role="alert"><p><b>Occupied</b></p></div>';
                              }else{
                                echo '<div class="alert alert-success" role="alert"><p><b>Vacant</b></p></div>';
                              } 
                            echo '</div>
                          </div>              
                         </div>
                      </div>';
                }
              ?>              
          </div>
        </div>
      </div>
      <br><br><br><br><br><br>
    

  <!--team Member-->

<div>
<link href="assets/css/member.css" rel="stylesheet">

<div id="team" name="team">
<div class="container">
<div class="row centered">
<h2 class="centered">MEET OUR AWESOME TEAM</h2>
<hr>
<div class="col-lg-3 teamborder team-md"> 
<img class="img img-circle" src="assets/img/aneel.jpg" height="200px" width="200px" alt="">
<h4>Anil Kumar Tiwari</h4>
<p>Web developer</p>
<a href="https://www.facebook.com/aniltiwari645"><i class="fa fa-facebook"></i></a> 
<a href="https://l.facebook.com/l.php?u=https%3A%2F%2Flinkedin.com%2Fin%2FAnil%2520Tiwari%3Ffbclid%3DIwAR0pi05-Z4U2hq5fGgX7J48OHF46mkYKyejvWxY5Awm2TfaWppaqBd8UfKM&h=AT3k6XSse7zjzAiSJBtIfqQl43d1doTIP4VHMTWkrqqaYnYUg70udN6MpowzzcknJnxPSmNUOe5EZkFbqru1KAmGGKY0FuWFuOXCYCeRMqNOTHSVrRwjDhwIXCZWU1ugDR2i"><i class="fa fa-linkedin"></i></a> 
</div>

<div class="col-lg-3 teamborder team-md"> 
 
<img class="img img-circle" src="assets/img/bidhu.jpg" height="200px" width="200px" alt="">
<h4>Bidhata Pandey</h4>
<p> Web developer</p>
<a href="https://www.facebook.com/bidhata.pandey.3"><i class="fa fa-facebook"></i></a> 
<a href="https://l.facebook.com/l.php?u=https%3A%2F%2Flinkedin.com%2Fin%2FBidhata%2520Pandey%3Ffbclid%3DIwAR1T1BB1ucWQvqUTrzwNk8yqSPD4TH16NnYXABE-rLm9Xdya3IoNjVrP_x8&h=AT1FZ2pl122HBQXCCm_t2PyZWWbqmMkIRTKtEyQv_69sihlIgRXti8Q_4Cizb_4oJ4mubHrd5IkP-rWGJA9jsWSu8fSt1RSi2TJXvOhxhVgHpb5cfvMChHK_5O6IZf8J49ba"><i class="fa fa-linkedin"></i></a> 
</div>
<div class="col-lg-3 teamborder team-md"> 
<img class="img img-circle" src="assets/img/lokesh.jpg" height="200px" width="200px" alt="">
<h4>Lokesh Subedi</h4>
<p>Web develper</p>
<a href="https://www.facebook.com/thelokesh.subedi"><i class="fa fa-facebook"></i></a> 
<a href="https://www.linkedin.com/in/thelokesh-subedi-97665b206"><i class="fa fa-linkedin"></i></a> 
</div>
<div class="col-lg-3 teamborder team-md"> 
<img class="img img-circle" src="assets/img/prasiddhi.jpg" height="200px" width="200px" alt="">
<h4>Prasiddhi Adhikari</h4>
<p> Web developer</p>
<a href="#"><i class="fa fa-facebook"></i></a> 
<a href="#"><i class="fa fa-linkedin"></i></a> 
</div>
</div>
</div>
</div>
</div>


              

</section>




              

            



<!-- Footer -->
    <footer style="background-color: #ccc;">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; Online Room Rental 2022</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-linkedin"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
   
    <!-- Bootstrap core JavaScript -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="assets/plugins/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="assets/js/jqBootstrapValidation.js"></script>
    <script src="assets/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="assets/js/rent.js"></script>
  </body>
</html>