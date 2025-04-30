<?php
     include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuni Travels</title>
    <!-- Google Font (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <style>
          /* Blinking shadow animation */
          @keyframes blink-shadow {
            0% { box-shadow: 0 0 5px rgba(0, 123, 255, 0.8); }
            25% { box-shadow: 0 0 10px rgba(255, 38, 0, 0.6), 0 0 20px rgba(255, 47, 0, 0.4); }
            50% { box-shadow: 0 0 15px rgba(255, 136, 0, 0.6), 0 0 30px rgba(255, 87, 51, 0.3), 0 0 50px rgba(255, 0, 0, 0.2); }
            75% { box-shadow: 0 0 10px rgba(255, 0, 0, 0.4), 0 0 20px rgba(255, 0, 0, 0.2); }
            100% { box-shadow: 0 0 5px rgba(255, 0, 0, 0.8); }
        }

        .blinking-shadow-btn {
            animation: blink-shadow 2s infinite ease-in-out;
            transition: 0.3s ease-in-out;
        }

        .blinking-shadow-btn:hover {
            animation: blink-shadow 2s infinite ease-in;
            box-shadow: 0 0 30px rgba(0, 86, 179, 0.9);
        }
      
        
    </style>
  </head>
<body>
  <!-- Header Section -->

      <!-- Header Section -->
    <div class="container-fluid top-header">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-md-3">
                    <a href="#">
                        <img src="./Assets/Img/Ayuni.png" alt="Ayuni Travel" class="img-fluid" width="150">
                    </a>
                </div>

                <!-- Contact Info -->
                <div class="col-md-6 text-center">
                    <span class="contact-info">
                        <i class="fas fa-phone-alt"></i> +92 51 111 786 785 |
                        <i class="fab fa-whatsapp text-success"></i> +92 3111 786 785
                    </span>
                </div>

                <!-- Social Media & Currency Dropdown -->
                <div class="col-md-3 text-end">
                    <span class="social-icons">
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-pinterest"></i>
                        <i class="fab fa-youtube"></i>
                    </span>

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



      



<!-- 24/7 Support Section -->
<div class="container-fluid support-section mt-3 pt-3 pb-3">
    <div class="container">
        <div class="row align-items-center">
            <!-- Image and Support Text -->
            <div class="col-md-4 d-flex align-items-center">
                <img src="Assets/Img/liveSupport.webp" alt="Support Image" class="support-img me-3">
                <div>
                    <div class="support-text">24/7 Hours Support</div>
                    <div class="support-subtext">Speak to our Travel Expert</div>
                </div>
            </div>
            <!-- Contact Details -->
            <div class="col-md-8 d-flex justify-content-md-end gap-4 flex-wrap support-contact space ">
                <a href="https://wa.me/923111786785" target="_blank">
                    <i class="fab fa-whatsapp text-success support-icon "></i> <span class="me-3"> +92 3111 222 333 </span>
                </a>
                <a href="tel:+9251111786785">
                    <i class="fas fa-phone-alt text-primary support-icon "></i> +92 51 111 222 333
                </a>
                <a href="mailto:info@rehmantravel.com">
                    <i class="fas fa-envelope text-danger support-icon "></i> info@ayunitravel.com
                </a>
            </div>
        </div>
    </div>
</div>




      <div class="container">
        <div class="row">
          <div class="container mt-4">
            <!-- Heading -->
            <h2 class="custom-heading">
                Explore <span class="icon">✔</span> <span class="highlight">Umrah</span> Best Packages
            </h2>

            <!-- Packages Row -->
            <div class="row mt-4">
                <!-- Package 1 -->
                <div class="col-md-3">
                    <div class="card package-card">
                        <img src="Assets/Img/maqam-e-ibrahim.webp" alt="Package Image">
                        <div class="card-body">
                            <h5 class="card-title">Economy Umrah Package</h5>
                            <p class="text-muted">Starting from</p>
                            <p class="price">$ 728*</p>
                        </div>
                        <div class="card-footer">
                            <span class="details">View Details</span>
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
                            <h5 class="card-title">Best Umrah Packages</h5>
                            <p class="text-muted">Starting from</p>
                            <p class="price">$ 1292*</p>
                        </div>
                        <div class="card-footer">
                            <span class="details">View Details</span>
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
                            <h5 class="card-title">Ramzan Umrah Package</h5>
                            <p class="text-muted">Starting from</p>
                            <p class="price">$ 1256*</p>
                        </div>
                        <div class="card-footer">
                            <span class="details">View Details</span>
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
                            <h5 class="card-title">Executive Umrah Package</h5>
                            <p class="text-muted">Starting from</p>
                            <p class="price">$ 1256*</p>
                        </div>
                        <div class="card-footer">
                            <span class="details">View Details</span>
                            <span class="arrow">→</span>
                        </div>
                        <div class="divider bg-primary"></div>
                    </div>
                </div>
            </div>
         </div>
         
        </div>
        

      </div>

      





      <div class="container mt-4">
          <div class="info-card">
              <!-- Welcome Heading -->
              <div class="info-heading">
                  Welcome to Ayuni Travels
              </div>

              <!-- Information Text -->
              <p class="info-text">
                  Ayuni Travels has established itself as a premier travel agency renowned for its comprehensive services and customer-centric approach. With a robust network of partners and a team of experienced professionals, Ayuni Travels is committed to making every journey seamless, enjoyable, and memorable. Whether planning a business trip, a family vacation, or a solo adventure, Ayuni Travels is your trusted partner in travel, offering a wide range of services to cater to all your travel needs. Services Offered by Ayuni Travels.
              </p>

              <p class="info-text">
                  <strong>1. Flight Booking:</strong> Ayuni Travels provides hassle-free flight booking services, offering competitive rates on domestic and international flights. With a user-friendly online booking system and a dedicated team of travel experts, we ensure the flight booking process is smooth and straightforward. Using advanced technology and partnerships with major airlines, Ayuni Travels ensures that customers get the best deals and the most convenient flight schedules.
                  Our sophisticated booking platform integrates real-time data and advanced algorithms to find and present the most affordable fares and optimal routes. Whether you're flying to a nearby city or an international destination, our extensive network of airline partners enables access to a wide range of flights, from budget-friendly options to premium experiences. Moreover, Ayuni  Travels offers exclusive deals and promotions, providing added value to customers. Our special offers are regularly updated, allowing travelers to take advantage of discounted rates and promotional packages. The company's strong relationships with airlines also mean that customers can benefit from additional perks such as extra baggage allowance, seat upgrades, and priority boarding. By choosing Ayuni  Travels for your flight booking needs, you can enjoy a seamless and stress-free experience, from the moment you start planning your trip until you arrive at your destination. With our dedication to quality service and customer satisfaction, Ayuni  Travels is your trusted partner for all your air travel requirements.
                 
                  <br> <br> <strong>  2. Visa Assistance:</strong> Navigating the complexities of visa applications can be daunting, often involving a myriad of forms, requirements, and procedures that vary from one country to another. This can be particularly challenging for travelers who are unfamiliar with the specific regulations or who have tight timelines. Ayuni  Travels simplifies this process by offering professional visa assistance services, ensuring that every step of the application is handled with precision and expertise. From the outset, we provide accurate and up-to-date information on visa requirements for a wide range of destinations. This includes detailed guidance on the types of visas available, eligibility criteria, necessary documentation, and application timelines. Whether you are applying for a tourist visa, business visa, student visa, or any other type, Ayuni  Travels ensures that you have all the information you need to proceed confidently. Furthermore, we understand that visa application issues can be stressful and time-sensitive. Our dedicated customer support team is available to address any concerns or questions you may have throughout the process. Whether you need clarification on specific requirements or assistance with urgent travel plans, we provide prompt and professional support.

                  <br> <br> <strong>    3. Hotel Reservations: </strong> Finding the right accommodation is crucial for a comfortable and enjoyable travel experience. we understand this necessity and offer extensive hotel reservation services designed to meet the diverse needs and preferences of our clients. With a focus on securing the best rates and prime locations, Ayuni  Travels ensures that every traveler can find a suitable place to stay, regardless of their budget or destination. Ayuni  Travels' hotel reservation services are comprehensive and user-friendly, providing customers with a seamless booking experience. With a global network of hotel partners, we offer an impressive array of accommodation options. Whether you are seeking the opulence of a luxury resort, the comfort of a mid-range hotel, or the affordability of budget-friendly lodgings, we have something for everyone. Our partnerships with renowned hotel chains and independent establishments worldwide ensure that customers have access to the best properties in prime locations.

                  <br><br> <strong>   4. Umrah and Hajj Packages:</strong>  For those undertaking the sacred journeys of Umrah and Hajj, Ayuni  Travels offers specialized packages that are meticulously designed to ensure a smooth and enriching pilgrimage experience. Understanding the profound spiritual significance and the logistical complexities of these journeys, we provide comprehensive packages that include flights, accommodations, guided tours, and a host of additional services. Our packages are crafted to allow pilgrims to concentrate fully on their spiritual practices and obligations, free from the worries of travel arrangements.

                  <br> <br>  <strong>   5. Customized Tour Packages: </strong> Ayuni  Travels excels in creating customized tour packages tailored to individual preferences and interests, ensuring that every traveler enjoys a unique and memorable experience. Our expertise in personalized travel planning allows us to cater to a wide array of interests and requirements, making sure that each journey is as distinctive and enjoyable as the traveler envisions. Whether you are looking for an adventurous trek, a relaxing beach holiday, or a cultural exploration, Ayuni  Travels crafts personalized itineraries that go beyond the ordinary.

                  <br> <br>  <strong>  6. Car Rentals:</strong>  For travelers who prefer the flexibility of exploring destinations at their own pace, Ayuni  Travels offers reliable and comprehensive car rental services. Recognizing that the freedom to set your itinerary is invaluable, we provide a range of vehicles to suit different preferences and needs, coupled with competitive rental rates to ensure affordability. Our car rental services are designed to deliver convenience, reliability, and the utmost satisfaction, allowing customers to enjoy self-driven travel with ease and confidence. Whether you need a compact car for city driving, a spacious SUV for family trips, or a luxury sedan for business travel, Ayuni  Travels has the perfect vehicle for every occasion. We offer competitive rental rates, ensuring that customers get the best value for their money. With transparent pricing and no hidden fees, customers can confidently budget for their car rental without any surprises.

                  <br>  <br>  <strong> 7. Corporate Travel Management:</strong>   Ayuni  Travels understands the unique needs of business travelers and offers specialized corporate travel management services that cater to the demands of the corporate world. Our comprehensive services include flight and hotel bookings, itinerary management, and 24/7 support, ensuring that business trips are efficient, productive, and stress-free. By using our expertise and extensive network, Ayuni  Travels provides tailored solutions that meet the specific requirements of corporate clients, allowing them to focus on their business objectives.

                  <br> <br>   <strong> 8. World Tours/Pakistan Tours:</strong>  Ayuni  Travels is renowned for its extensive range of travel services, offering both world tours and specialized Pakistan tours. Whether you're dreaming of exploring global destinations or discovering the hidden gems of Pakistan, we provide tailored packages that cater to various interests, budgets, and travel styles. With a commitment to excellence, personalized service, and a deep understanding of travel needs, Ayuni  Travels ensures every journey is memorable and enriching. By choosing Ayuni  Travels for your world tours and Pakistan tours, you can embark on a journey that is expertly planned, richly detailed, and deeply satisfying. Whether you're exploring far-off lands or discovering the treasures of your own country, we ensure a travel experience that exceeds expectations and creates lasting memories.

                  <br> <br>  <strong>  9. Franchise:</strong> Ayuni  Travels presents lucrative franchising opportunities for entrepreneurs looking to enter the dynamic and rewarding travel industry. As a well-established and reputable travel agency, we offer franchisees the chance to leverage their brand recognition, extensive network, and proven business model to establish and grow their successful travel businesses.

                  <br> <br>     By becoming a franchisee, you gain immediate access to a trusted brand that customers recognize and trust, which can significantly reduce the time and effort required to build brand awareness locally. Our proven business model minimizes risks associated with starting a new business and provides a framework for sustainable growth and profitability.
              </p>
              <p class="info-text">
                  <div class="col-lg-12">
                    <div class="col-lg-4">
                      Get the Latest Deals
                      Stay up to date with announcements and exclusive discounts feel free to subscribe with your email.
                    </div>
                    <div class="col-lg-8">                   

                            <form onsubmit="subscribeUser(event)">
                                <div class="input-group">
                                    <span class="input-group-text">📧</span>
                                    <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                                    <button class="btn btn-primary">Subscribe</button>
                                </div>
                            </form>
                    </div>
                  </div>
               </p>
          </div>
        </div>

        <!-- Floating Call Back Button -->
        <button class="callback-btn rounded  blinking-shadow-btn">Request Call Back <i class="fas fa-phone-alt"></i></button>



        <!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Logo & Quick Links -->
            <div class="col-md-3">
                <img src="./Assets/Img/logo.png" alt="Company Logo" style="width: 150px;">
            </div>
            <div class="col-md-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Flights</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Travel Agency</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Refund Policy</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>

            <!-- Branches -->
            <div class="col-md-3">
                <h5>Our Branches</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Wah Cantt</a></li>
                    <li><a href="#">Attock</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-3">
                <h5>Contact Us</h5>
                <p>
                    📞 +92 51 111 222 333 <br>
                    📧 info@ayunitravel.com <br>
                    📍 Ayuni  Travels Office <br>
                    Office no 35a 2ND Floor Wahcantt <br>
                </p>
                <!-- Social Icons -->
                <div class="social-icons">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-4">
            <p>&copy; 2025 Ayuni Travels™. All Rights Reserved.</p>
        </div>
    </div>
</footer>


    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
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