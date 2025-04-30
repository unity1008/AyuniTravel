

<!DOCTYPE html>

<?php
     include("header.php");
     require_once 'config.php';
     
 

?>
 <!-- <html lang="<?= $_SESSION['lang'] ?>" dir="<?= ($_SESSION['lang'] === 'ur') ? 'rtl' : 'ltr' ?>">  -->
 <html lang="<?= $_SESSION['lang'] ?>" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $translations['title'] ?></title>
    <script src="Assets/lang.js"></script>
    <!-- Google Font (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
    <style>
          /* Blinking shadow animation */
          @keyframes blink-shadow {
            0% { box-shadow: 0 0 5px rgba(0, 123, 255, 0.8); }
            20% { box-shadow: 0 0 10px rgba(21, 0, 255, 0.6), 0 0 20px rgb(0, 13, 255); }
            45% { box-shadow: 0 0 15px rgba(26, 255, 0, 0.63), 0 0 30px rgb(0, 255, 0), 0 0 50px rgba(255, 0, 0, 0.2); }
            65% { box-shadow: 0 0 15px rgba(255, 213, 0, 0.6), 0 0 30px rgb(255, 247, 0), 0 0 50px rgba(255, 0, 0, 0.2); }
            85% { box-shadow: 0 0 10px rgb(255, 0, 0), 0 0 20px rgb(255, 0, 0); }
            100% { box-shadow: 0 0 5px rgba(255, 0, 221, 0.8); }
        }

        .blinking-shadow-btn {
            animation: blink-shadow 2s infinite ease-in-out;
            transition: 0.3s ease-in-out;
        }

        .blinking-shadow-btn:hover {
            animation: blink-shadow 2s infinite ease-in;
            box-shadow: 0 0 30px rgba(0, 86, 179, 0.9);
        } 
        @media (prefers-reduced-motion: reduce) {
            .blinking-shadow-btn {
                animation: none;
            }
        }   
        
      
        
    </style>
  </head>
<body>
    

  <!-- Header Section -->

      <!-- Header Section -->
    <div class="container-fluid top-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-md-3 ">
                    <a href="index.php">
                        <img src="./Assets/Img/logo.png" alt="Ayuni Travel" class="img-fluid  w-100" >
                    </a>
                </div>

                <!-- Contact Info -->
                <div class="col-md-6 text-center">
                    <span class="contact-info">
                             <a href="tel:+9251111786785" target="_blank" class="text-decoration-none">  <i class="fas fa-phone-alt"></i> +92 51 111 786 785  </a>  |
                             <a href="https://wa.me/923111786785" target="_blank" class="text-decoration-none">  <i class="fab fa-whatsapp text-success"></i> +92 3111 786 785 </a> 
                    </span>
                </div>

                <!-- Social Media & Currency Dropdown -->
                <div class="col-md-3 text-end">
                    <span class="social-icons">
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.twitter.com/" target="_blank"> <i class="fab fa-twitter"></i> </a>
                        <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.pinterest.com/" target="_blank"> <i class="fab fa-pinterest"></i></a>
                        <a href="https://www.youtube.com/" target="_blank"> <i class="fab fa-youtube"></i></a> 
                    </span>
                     <!-- Currency Switcher -->
                

                    <!-- Currency Dropdown -->
                    <!-- <div class="dropdown d-inline">
                        <button class="btn btn-light dropdown-toggle" type="button" id="currencyDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://flagcdn.com/w40/us.png" class="currency-flag"> USD
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="currencyDropdown">
                            <li><a class="dropdown-item" href="#"><img src="https://flagcdn.com/w40/us.png" class="currency-flag"> $ USD</a></li>
                            <li><a class="dropdown-item" href="#"><img src="https://flagcdn.com/w40/eu.png" class="currency-flag"> € EUR</a></li>
                            <li><a class="dropdown-item" href="#"><img src="https://flagcdn.com/w40/gb.png" class="currency-flag"> £ GBP</a></li>
                            <li><a class="dropdown-item" href="#"><img src="https://flagcdn.com/w40/pk.png" class="currency-flag"> Rs PKR</a></li>
                            <li><a class="dropdown-item" href="#"><img src="https://flagcdn.com/w40/ae.png" class="currency-flag"> AED</a></li>
                            <li><a class="dropdown-item" href="#"><img src="https://flagcdn.com/w40/sa.png" class="currency-flag"> ريال SR</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
    </div>



      
<!--  Slider Section -->
<div class="container-fluid slider-section m-0 p-0">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button"  data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="Assets/Img/img1.png" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block text-white">
                <h5>Complete your spiritual journey with visits to the holy cities of Makkah. </h5>
                <p class="text-primary">Experience the spiritual journey of a lifetime.</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="Assets/Img/img2.png" class="d-block w-100" >
            <div class="carousel-caption d-none d-md-block">
                <h5>Walk in the footsteps of the Prophet ﷺ in the blessed city of Madina.</h5>
                <p>Discover the tranquility of Madina – a sacred stop on your spiritual journey.</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="Assets/Img/img1.png" class="d-block w-100" >
            <div class="carousel-caption d-none d-md-block">
                <h5>Embark on a sacred journey to Makkah and Madina</h5>
                <p>the heart of every believer's dream.</p>
            </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</div>



<!-- 24/7 Support Section -->
<div class="container-fluid support-section mt-3 pt-3 pb-3">
     <div class="row align-items-center d-flex justify-content-between  ">
            <!-- Image and Support Text -->
            <div class="col-md-4 d-flex align-items-center">
                <img src="Assets/Img/liveSupport.webp" alt="Support Image" class="support-img me-3">
                <div>
                    <div class="support-text"><?= $translations['24/7 Hours Support'] ?></div>
                    <div class="support-subtext"> <?= $translations['Speak to our Travel Expert'] ?></div>
                </div>
            </div>
            <!-- Contact Details -->
            <div class="col-md-8 d-flex justify-content-md-end gap-4 flex-wrap support-contact space ">
                <a href="https://wa.me/923111786785" target="_blank" class="text-decoration-none">
                    <i class="fab fa-whatsapp text-success support-icon "></i> <span class="me-3"> +92 3111 222 333 </span>
                </a>
                <a href="tel:+9251111786785" target="_blank" class="text-decoration-none">
                    <i class="fas fa-phone-alt text-primary support-icon "></i> +92 51 111 222 333
                </a>
                <a href="mailto:info@rehmantravel.com" class="text-decoration-none">
                    <i class="fas fa-envelope text-danger support-icon "></i> info@ayunitravel.com
                </a>
            </div>
        </div>
</div>


     
    <div class="container">
        <div class="row">
            <div class="container mt-4">
              
                <!-- Heading -->
                <h2 class="custom-heading d-flex justify-content-between">
                    <?= $translations['Explore ✔ Umrah Best Packages'] ?>    
                    <!-- Explore <span class="icon">✔</span> <span class="highlight">Umrah</span> Best Packages -->
                    <button type="button" class="btn btn-primary border " data-bs-toggle="modal" data-bs-target="#mapModal">
                        <i class="bi bi-geo-alt-fill"></i> <?= $translations['View Map'] ?>  
                    </button>
                </h2>
                <div class="modal fade modal-dialog modal-fullscreen-sm-down" id="mapModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                    
                        <div class="modal-body  p-2 mb-lg-0 mb-3 bg-white rounded">
                        <iframe class="w-100" height="600" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d496.1344775531091!2d72.770697!3d33.762712!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfa750bb279a9f%3A0xc201923b55bd767a!2sAyuni%20Tech%20Services!5e1!3m2!1sen!2sus!4v1741588700284!5m2!1sen!2sus" loading="lazy" ></iframe>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Packages Row -->
                <div class="row mt-4">
                    <!-- Package 1 -->
                    <div class="col-md-3">
                        <div class="card package-card">
                            <img src="Assets/Img/maqam-e-ibrahim.webp" alt="Package Image">
                            <div class="card-body">
                                <h5 class="card-title"> <?= $translations['Economy Umrah Package'] ?>  </h5>
                                <p class="text-muted"> <?= $translations['Starting from'] ?></p>
                                <p class="price">SR 728*</p>
                            </div>
                            <div class="card-footer">
                                <span class="details"> <?= $translations['View Details'] ?></span>
                                <span class="arrow">→</span>
                            </div>
                            <div class="divider bg-success"></div>
                        </div>
                    </div>

                    <!-- Package 2 -->
                    <div class="col-md-3">
                        <div class="card package-card">
                            <img src="Assets/Img/best Umrah Packages.webp" alt="Package Image">
                            <div class="card-body">
                                <h5 class="card-title"><?= $translations['Best Umrah Packages'] ?></h5>
                                <p class="text-muted"><?= $translations['Starting from'] ?></p>
                                <p class="price">SR 1292*</p>
                            </div>
                            <div class="card-footer">
                                <span class="details"><?= $translations['View Details'] ?></span>
                                <span class="arrow">→</span>
                            </div>
                            <div class="divider bg-primary"></div>
                        </div>
                    </div>

                    <!-- Package 3 -->
                    <div class="col-md-3">
                        <div class="card package-card">
                            <img src="Assets/Img/Umrah Package.webp" alt="Package Image">
                            <div class="card-body">
                                <h5 class="card-title"><?= $translations['Ramzan Umrah Package'] ?></h5>
                                <p class="text-muted"><?= $translations['Starting from'] ?></p>
                                <p class="price">SR 1256*</p>
                            </div>
                            <div class="card-footer">
                                <span class="details"><?= $translations['View Details'] ?></span>
                                <span class="arrow">→</span>
                            </div>
                            <div class="divider bg-success"></div>
                        </div>
                    </div>

                    <!-- Package 4 -->
                    <div class="col-md-3">
                        <div class="card package-card">
                            <img src="Assets/Img/Executive Umrah Packages.webp" alt="Package Image">
                            <div class="card-body">
                                <h5 class="card-title"><?= $translations['Executive Umrah Package'] ?></h5>
                                <p class="text-muted"><?= $translations['Starting from'] ?></p>
                                <p class="price">SR 2756*</p>
                            </div>
                            <div class="card-footer">
                                <span class="details"><?= $translations['View Details'] ?></span>
                                <span class="arrow">→</span>
                            </div>
                            <div class="divider bg-primary"></div>
                        </div>
                    </div>
                </div>
                </div>
         
        </div>
        

      </div>

      





      <div class="container mt-4 <?= $_SESSION['lang'] === 'ur' ? 'text-end' : 'text-start' ?>" dir="<?= $_SESSION['lang'] === 'ur' ? 'rtl' : 'ltr' ?>">
        <div class="row d-flex block">
            <div class="info-card w-100">
                <!-- Welcome Heading -->
                <div class="info-heading">
                    <?= $translations['Welcome to Ayuni Travels'] ?> 
                </div>

                <!-- Paragraph 1 with image on right -->
                <div class="row align-items-center my-4">
                        <p class="info-text"><?= $translations['p1'] ?></p>
                   
                </div>

                <!-- Paragraph 2 with image on left -->
                <div class="row align-items-center my-4 flex-md-row-reverse">
                    <div class="col-md-6">
                        <p class="info-text">
                            1. <strong><?= $translations['Flight Booking:'] ?> </strong><br><?= $translations['p2'] ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid rounded" src="Assets/Img/flight.png" alt="">
                    </div>
                </div>

                <!-- Paragraph 3 with image on right -->
                <div class="row align-items-center my-4">
                    <div class="col-md-6">
                        <p class="info-text">
                            2. <strong><?= $translations['Visa Assistance:'] ?></strong><br><?= $translations['p3'] ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid rounded" src="Assets/Img/Visa.png" alt="">
                    </div>
                </div>

                <!-- Paragraph 4 with image on left -->
                <div class="row align-items-center my-4 flex-md-row-reverse">
                    <div class="col-md-6">
                        <p class="info-text">
                            3. <strong><?= $translations['Hotel Reservations:'] ?></strong><br><?= $translations['p4'] ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid rounded" src="Assets/Img/hottel.png" alt="">
                    </div>
                </div>

                <!-- Paragraph 5 with image on right -->
                <div class="row align-items-center my-4">
                    <div class="col-md-6">
                        <p class="info-text">
                            4. <strong><?= $translations['Car Rentals:'] ?></strong><br><?= $translations['p5'] ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid rounded" src="Assets/Img/car rental.png" alt="">
                    </div>
                </div>

                <!-- Subscription Section -->
                <div class="row my-5">
                    <div class="col-lg-4">
                        <p class="info-text"><?= $translations['subscription'] ?></p>
                    </div>
                    <div class="col-lg-8">
                        <form onsubmit="subscribeUser(event)">
                            <div class="input-group">
                                <span class="input-group-text">📧</span>
                                <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                                <button class="btn btn-primary"><?= $translations['Subscribe'] ?? 'Subscribe' ?></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


        <!-- Floating Call Back Button -->
          <!-- Button to Open Modal -->
        <button type="button" style="z-index: 1;" class="callback-btn rounded  blinking-shadow-btn" data-bs-toggle="modal" data-bs-target="#callbackModal"><?= $translations['Request Call Back'] ?> <i class="fas fa-phone-alt"></i></button>
        
     <!-- Modal for show call booking form -->
     <div class="modal fade" id="callbackModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"><?= $translations['Request Call Back'] ?> </h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><?= $translations['Request Call Back p'] ?></p>
                    <form id="callbackForm" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold"><?= $translations['Name'] ?></label>
                                <input type="text" class="form-control" id="name" required>
                                <div class="invalid-feedback"><?= $translations['Please enter your name'] ?>.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-bold"><?= $translations['Phone'] ?></label>
                                <input type="tel" class="form-control" id="phone" pattern="[0-9]{11}" required>
                                <div class="invalid-feedback"><?= $translations['valid 10-digit phone number'] ?></div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold"><?= $translations['Email'] ?></label>
                                <input type="email" class="form-control" id="email" required>
                                <div class="invalid-feedback"><?= $translations['Enter a valid email'] ?></div>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label fw-bold"><?= $translations['Country'] ?></label>
                                <input type="text" class="form-control" id="city" required>
                                <div class="invalid-feedback"><?= $translations['Enter your city or country'] ?></div>
                            </div>
                            <div class="col-12">
                                <label for="remarks" class="form-label fw-bold"><?= $translations['Remarks'] ?></label>
                                <textarea class="form-control" id="remarks" rows="3" required></textarea>
                                <div class="invalid-feedback"><?= $translations['Please enter a message'] ?></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?= $translations['Close'] ?></button>
                    <button type="submit" class="btn btn-success wave-glow" form="callbackForm" ><?= $translations['Submit'] ?></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bootstrap Form Validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        event.preventDefault(); // Stop form submission (Replace with AJAX)
                        alert("Form submitted successfully!"); // Temporary success message
                        form.reset();
                        form.classList.remove('was-validated');
                        var modal = bootstrap.Modal.getInstance(document.getElementById('callbackModal'));
                        modal.hide(); // Close modal on successful submit
                        modal.reset();
                        //                   modal.closelog();
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <?php include("footer.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function subscribeUser(event) {
            event.preventDefault();
            let email = document.getElementById("email").value;
            let messageBox = document.getElementById("message");

            if (email.trim() === "") {
                messageBox.innerHTML = "<div class='alert alert-danger'>Please enter a valid email!</div>";
                return;
            }

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "subscribe.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    messageBox.innerHTML = xhr.responseText;
                    document.getElementById("email").value = ""; // Clear input
                }
            };
            xhr.send("email=" + encodeURIComponent(email));
        }
    </script>
</body>
</html>