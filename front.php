<?php 
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hymetocean Peers Co.</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <section class="header">
        <nav>
            <a href="front.php"><img src="img/logo.png"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="front.php">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="project.php">Projects</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="logins.php">Login</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>

    <div class="text-box">
        <h1>HYMETOCEAN PEERS CO.</h1>
        <p>Valuing Accuracy and Excellence </p>
        <a href="" class="hero-btn">Visit Us To Know More</a>
    </div>
        
    </section>

    <section class="description">
        <h1>What is HPC?</h1>
        <p>Hymetocean Peers Company is a response to a consulting need in Coastal Engineering and <br/> Quality Studies 
            using accurate modeling and monitoring tools.</p>
        
        <div class="row">
            <div class="description-col">
                <h3>Mission</h3>
                <p>The company’s mission is to determine the 
                    viability and associated environmental impacts and risks of development projects through 
                    state-of-the-art computational modeling and innovative environmental monitoring systems.</p>
            </div>
            <div class="description-col">
                <h3>Vision</h3>
                <p>Its vision is to be a leading provider of real solutions to environmental and engineering 
                    problems through accurate quantification and prediction of project impacts in the water and 
                    air environment.</p>
            </div>
            <div class="description-col">
                <h3>Believes</h3>
                <p> HPC believes that engineering development and environmental protection 
                    can go hand in hand through accurate project impact assessment.  In addition, we provide 
                    exploration companies the needed analysis for the viability of renewable energy projects 
                    including solar, wind, tidal and wave power development.</p>
            </div>
        </div>
    </section>

    <section class="global">
        <h1>Global Projects</h1>
        <p>Below are some of our global projects completed in the Pakistan, Japan, and Indonesia.</p>

        <div class="row">
                <div class="global-col">
                    <img src="img/pakistan.jpg">
                    <div class="layer">
                        <h3> PAKISTAN </h3>
                    </div>
                </div>
                <div class="global-col">
                    <img src="img/jaapan.jpg">
                    <div class="layer">
                        <h3>JAPAN</h3>
                    </div>
                </div>
                <div class="global-col">
                    <img src="img/indonesia.jpg">
                    <div class="layer">
                        <h3>INDONESIA</h3>
                    </div>
                </div>
         </div>

    </section>

<section class="proyekto">
    <section class="projects">
        <h1 >Our Projects</h1>
        <p> Below are some of the projects we have completed in the past.</p>

        <div class="row">
            <div class="projects-col">
                <img src="img/Pj2.png">
                <h3> Storm Surge Flood Simulation During Typhoon Yolanda in Tacloban City (2013)</h3>
                <p>This project simulated storm surge flooding in Tacloban City during Super Typhoon Yolanda (2013) using the PCOM model,accurately reflecting observed inundation and flood depths.</p>
            </div>
            <div class="projects-col">
                <img src="img/pj5.png">
                <h3> Sedimentation modeling and analysis for Laguna Lake accretion & erosion </h3>
                <p> This project involved modeling and analyzing sedimentation patterns in Laguna Lake, </br> focusing on areas of accretion and erosion to better understand lakebed changes over time. </p>
            </div>
            <div class="projects-col">
                <img src="img/pj10.png">
                <h3> Thermal mixing zone modeling for the JG Summit Naphtha Cracker Plant Project in 
                    Batangas, Philippines</h3>
                <p> This project modeled the thermal mixing zone for the JG Summit Naphtha Cracker Plant in Batangas, Philippines, to assess the dispersion of heated effluents in the surrounding waters. </p>
            </div>
        </div>
    </section>
</section>

<section class="testimonials">
    <h1>What Our Clients Says</h1>
    <p>We deliver expert solutions in Coastal Engineering and Water-Air Quality Studies.</br>
         Our clients rely on us for accurate insights and impactful results.</br>
          Hear their experiences.</p>

    <div class="row">
        <div class="testimonial-col">
            <img src="img/user1.jpg" >
            <div>
                <p>
                    "The team’s expertise in coastal engineering and water quality modeling was invaluable. 
                    Their accurate, actionable insights helped us make informed decisions."
                </p>
                <h3> John Guena Reyes</h3>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
        </div>
        <div class="testimonial-col">
            <img src="img/user2.jpg" >
            <div>
                <p>
                    "The team’s thorough analysis of water and air quality ensured our project met all environmental standards.
                     Their practical solutions were key to our success."
                </p>
                <h3>Dr. Maria Tan</h3>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half"></i>
            </div>
        </div>
    </div>
</section>

<section class="cta">
    <h1>Partner with Us for Expert Environmental Solutions</h1>
    <a href="contact.php" class="hero-btn">CONTACT US</a>
</section>~~

<section class="footer">
    <h3>About Us</h3>
    <p>Hymetocean Peers Company (HPC) is a technical service provider (General Partnership)</br> 
        registered in the Philippines that specializes in lakes and coastal ocean studies, water 
        resources,</br> renewable energy exploration, water quality modeling and air quality modeling. </p>
        <div class="icons">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-yahoo"></i>
        </div>

        <section class="cpr">
        <p>Copyright <i class="fa fa-copyright"></i> 2025 HYMETOCEAN.PEERS.CO, -All right Reserved - Terms of Use</p>
    </section>
</section>



<script>

    var navLinks = document.getElementById("navLinks");

    function showMenu(){
        navLinks.style.right = "0";
    }
    function hideMenu(){
        navLinks.style.right = "-200px";
    }

</script>

</body>
</html>
