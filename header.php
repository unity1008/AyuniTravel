<?php
 require_once 'config.php'; 

 ?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <title><?= $translations['title'] ?></title>
   

</head>
<body>
  
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <a class="navbar-brand" href="index.php"><?= $translations['Ayuni Travels'] ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php"><?= $translations['home'] ?> <span class="sr-only">(current)</span></a>
            </li>
          
            <li class="nav-item dropdown">
            
              <a class="nav-link dropdown-toggle" href="calculator.php" role="button" data-toggle="dropdown" aria-expanded="false">
                  <?= $translations['Umrah'] ?>  <i class="bi bi-chevron-double-down"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="calculator.php"><?= $translations['umrah_calculator'] ?></a>
                <a class="dropdown-item" href="#"><?= $translations['Umrah Packages'] ?></a>
                <a class="dropdown-item" href="#"><?= $translations['Best Umrah Packages'] ?></a>
                <a class="dropdown-item" href="#"><?= $translations['Child Umrah Visa'] ?></a>
                <div class="dropdown-divider"></div>          
                <a class="dropdown-item" href="#"><?= $translations['Umrah Transport Services'] ?></a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><?= $translations['about'] ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link "><?= $translations['contact'] ?></a>
            </li>
            
              
              
            </ul>
            <form method="post" action="process.php">
               <span class="text-white small"><?= $translations['Translate'] ?> </span> 
                <select class="form-select form-select-sm d-inline w-auto" name="language" onchange="this.form.submit()">
                    <option value="en" <?= $_SESSION['lang'] == 'en' ? 'selected' : '' ?>>English</option>
                    <option value="ur" <?= $_SESSION['lang'] == 'ur' ? 'selected' : '' ?>>اردو</option>
                </select>
            </form>
          
        </div>
      </nav>
</body>
</html>