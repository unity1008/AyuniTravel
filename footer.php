<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <title><?= $translations['title'] ?></title>   

</head>
<body>
  
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <!-- Logo & Quick Links -->
            <div class="col-md-3 bg-light">
                <img class="w-100" src="./Assets/Img/logo.png"  >
            </div>
            <div class="col-md-3">
                <h5><?= $translations['Quick Links'] ?></h5>
                <ul class="list-unstyled">
                    <li><a class="text-decoration-none" href="index.php"><?= $translations['home'] ?></a></li>
                    <li><a class="text-decoration-none" href="#"><?= $translations['Flights'] ?></a></li>
                    <li><a class="text-decoration-none" href="#"><?= $translations['about'] ?></a></li>
                    <li><a class="text-decoration-none" href="#"><?= $translations['Travel Agency'] ?></a></li>
                    <li><a class="text-decoration-none" href="#"><?= $translations['Privacy Policy'] ?></a></li>
                    <li><a class="text-decoration-none" href="#"><?= $translations['Refund Policy'] ?></a></li>
                    <li><a class="text-decoration-none" href="#"><?= $translations['contact'] ?></a></li>
                </ul>
            </div>

            <!-- Branches -->
            <div class="col-md-3">
                <h5><?= $translations['Our Branches'] ?></h5>
                <ul class="list-unstyled">
                    <li><a class="text-decoration-none" href="#"><?= $translations['Wah Cantt'] ?></a></li>
                    <li><a class="text-decoration-none" href="#"><?= $translations['Attock'] ?></a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-3">
                <h5><?= $translations['contact'] ?></h5>
                <p>
               <a class="text-decoration-none" href="tel:+9251111786785" ><i class="bi bi-telephone-plus-fill"></i> +92 51 111 222 333</a> <br>
                  <a class="text-decoration-none" href="mailto:info@ayunitravel.com ">  <i class="bi bi-envelope-at-fill"></i> info@ayunitravel.com</a> <br>
                    <i class="bi bi-geo-alt-fill"></i> <?= $translations['Office'] ?> <br>
                    <?= $translations['address'] ?>  <br>
                </p>
                <!-- Social Icons -->
                <div class="social-icons">
                    <a class="text-decoration-none" href="#"><i class="bi bi-facebook"></i></a>
                    <a class="text-decoration-none" href="#"><i class="bi bi-twitter"></i></a>
                    <a class="text-decoration-none" href="#"><i class="bi bi-instagram"></i></a>
                    <a class="text-decoration-none" href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-4">
            <p><?= $translations['footer_text'] ?> </p>
        </div>
    </div>
</footer>
</body>
</html>