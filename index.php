<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor - v4.7.0
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <?php include 'functions.php'; # functions file that contians alot of reusable code used all other the site
  session_start();
  UpdateSessionVars($_SESSION['ID']);?>
  <!-- ======= Header ======= -->
   <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">GibJohn</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="active" href="index.php">Home</a></li>
          <li><a class="btn disabled" href="scoreboard.php">Score Board</a></li>
          <li><a href="shop.php">Points Shop</a></li>
          <li><a href="my_account.php">My account</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <h2>Home Page</h2>
      </div>
    </div><!-- End Breadcrumbs -->
    <br>




  <main id="main">

    <!-- ======= Live Task Section ======= -->
    <?php
    $sql = "SELECT * FROM gibt_task_list_teacher"; 

    $host = "localhost";
    $username = "119019";
    $password = "saltaire";# connection to database 
    $dbname = "119019";
    $dsn = "mysql:host=$host;dbname=$dbname"; 

    try{ // tests the connections
        $pdo = new PDO($dsn, $username, $password); #tries the sql statment 
        $stmt = $pdo->query($sql);
        
         
        if($stmt === false){ #if it fails record error
          die("Error");
        }
         
       }catch (PDOException $e){
        echo $e->getMessage(); # display error
      }
    ?>
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Tasks</h2>
        <p>Live Tasks</p>
      </div>
    </div>

    <section id="features" class="features">
      <div class="container" data-aos="fade-up">
        <div class="row" data-aos="zoom-in" data-aos-delay="100">

          <!-- repeat these for each database entry --> 
          <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

          <div class="col-lg-3 col-md-4">
            <a href="<?php echo $row['Task_link']; ?>">
              <div class="icon-box">
                <i class="ri-calendar-todo-line" style="color: #22AA20;"></i>
                <h3><?php echo $row['Task_Name']; ?></h3>
              </div>
            </a>
          </div>

          <?php endwhile ?>
          <?php $pdo->connection = null;?> <!-- kills the connection --> 
           <!-- end --> 
        </div>
      </div>
    </section><!-- End Live Task  Section -->

    <!-- ======= Resource Section ======= -->

    <?php
    $sql = "SELECT * FROM gibt_task_list"; 

    $host = "localhost";
    $username = "119019";
    $password = "saltaire";# connection to database 
    $dbname = "119019";
    $dsn = "mysql:host=$host;dbname=$dbname"; 

    try{ // tests the connections
        $pdo = new PDO($dsn, $username, $password); #tries the sql statment 
        $stmt = $pdo->query($sql);
        
         
        if($stmt === false){ #if it fails record error
          die("Error");
        }
         
       }catch (PDOException $e){
        echo $e->getMessage(); # display error
      }
    ?>
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Additonal material</h2>
        <p>Resources</p>
      </div>
    </div>

    <section id="features" class="features">
      <div class="container" data-aos="fade-up">
        <div class="row" data-aos="zoom-in" data-aos-delay="100">

          <!-- repeat these for each databse entry --> 
          <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

          <div class="col-lg-3 col-md-4 mt-4">
            <a href="<?php echo $row['Task_link']; ?>">
              <div class="icon-box">
                <i class="ri-file-list-3-line" style="color: #27AA99;"></i>
                <h3><?php echo $row['Task_Name']; ?></h3>
              </div>
            </a>
          </div>

          <?php endwhile?>
          <?php $pdo->connection = null;?> <!-- kills the connection --> 

           <!-- end --> 
        </div>
      </div>
    </section><!-- Resource Task  Section -->

    <!-- =======  Performance Section ======= -->
    <section id="popular-courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Your progress</h2>
          <p>Data</p>
        </div>
        <div class="row" data-aos="zoom-in" data-aos-delay="100"><!--start row -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
              <img src="assets/img/course-1.jpg" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>Points: </h4>
                  <p class="price"><?php echo $_SESSION['User_points'] ;?></p>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
              <img src="assets/img/course-1.jpg" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>Score</h4>
                  <p class="price"><?php echo $_SESSION['User_score'] ;?></p>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->

        </div><!-- close row -->

      </div>
    </section><!-- Performance Section-->

    
  </main><!-- End #main -->

 <!-- ======= Footer ======= -->
 <footer id="footer">

   <div class="container d-md-flex py-4">

     <div class="me-md-auto text-center text-md-start">
       <div class="copyright">
         &copy; Copyright <strong><span>GibJohn</span></strong>. All Rights Reserved
       </div>
       <div class="credits">
         <!-- All the links in the footer should remain intact. -->
         <!-- You can delete the links only if you purchased the pro version. -->
         <!-- Licensing information: https://bootstrapmade.com/license/ -->
         <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/ -->
         Designed by <a href="https://bootstrapmade.com/">BootstrapMade </a> and edited and built on by <strong>Haris Sharp</strong>
       </div>
     </div>
   </div>
 </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>