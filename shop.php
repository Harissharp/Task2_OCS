<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Shop-Gibt</title>
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

  <!-- ======= Header ======= -->
   <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">GibJohn</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a class="btn disabled" href="scoreboard.php">Score Board</a></li>
          <li><a class="active" href="shop.php">Points Shop</a></li>
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
        <h2>Points Shop</h2>
        <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
      </div>
    </div><!-- End Breadcrumbs -->
    <?php 
    session_start();

    if (isset($_SESSION['Buy_returnMessage'])) {
      echo'<div class="alert alert-warning" role="alert">';
      echo "<p class='center'>". $_SESSION['Buy_returnMessage']."<p>";
      echo'</div>';
      
      unset($_SESSION['Buy_returnMessage']);# after being used it will not be needed until next time + without it would keep displaying after a purchase 
    }

    ?>
    <!-- ======= Courses Section ======= -->

    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">

          <!-- each Item Generator -->

          <?php
          $sql = "SELECT * FROM gibt_point_shop"; 

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

          <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch"> <!-- start item -->
              <div class="course-item">
                <img style="width:100%;max-width:400px;max-height:242px;height:100%" src="assets/img/<?php echo $row['Image'];?>" class="img-fluid" alt="<?php echo $row['Image_desc']; ?>">
                <div class="course-content">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4><?php echo $row['Category']; ?></h4>
                    <p class="price">Points:<?php echo $row['Price']; ?></p>
                  </div>

                  <h3><a><?php echo $row['Item_Name']; ?></a></h3>
                  <p><?php echo $row['Description']; ?></p>
                  <div class="trainer d-flex justify-content-between align-items-center">
                    <form action="buy.php" method="post">
                      <input type="hidden" name="item_name" value="<?php echo $row['Item_Name']; ?>">
                      <input type="hidden" name="Price" value="<?php echo $row['Price']; ?>">
                      <button type="submit">Buy Item!</button>
                    </form>
                  </div>
                </div>
              </div>
            </div> <!-- End  Item-->
          <?php endwhile; ?>

        </div>
      </div>
    </section><!-- End Courses Section -->

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