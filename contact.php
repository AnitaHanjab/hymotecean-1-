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
    <section class="sub-header">
        <nav>
            <a href="front.php"><img src="img/logo.png"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="front.php">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="project.html">Projects</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="logins.php">Login</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <h1>Contact Us</h1>
    </section>

   <section class="location">

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3246.2437737586897!2d121.12649171658889!3d14.630026501538163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b90e38a65bb3%3A0xb82942a133b3c85!2sLa%20Unica%20Phase%203%20Ext.!5e0!3m2!1sen!2sph!4v1744451428740!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    
   </section>
    
   <section class="contact-us">

    <div class="row">
        <div class="contact-col">
            <div>
                <i class="fa fa-home"></i>
                <span>
                    <h5> 15 Langka St. La Unica Hija 3 Cupang</h5>
                    <p>Cupang, Antipolo City, Philippines. </p>
                </span> 
            </div>
            <div>
                <i class="fa fa-phone"></i>
                <span>
                    <h5> No. 632-86465730</h5>
                    <h5> +63 917-4713084</h5>
                    <p>Monday to Saturday, 10AM to 10PM </p>
                </span> 
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <span>
                    <h5> peerscom@gmail.com</h5>
                    <p>Email us your query</p>
                </span> 
            </div>
        </div>
    </div>  

<div class="contact-col">

    <form method="post" action="send.php">
        <input type="text" name="Name" id="Name" placeholder="Enter your name" required>
        <input type="email" name="Email" id="Email" placeholder="Enter email address" required>
        <input type="text" name="Projects" id="Projects" placeholder="Enter your request project" required>
        <textarea rows="8" name="Message" id="Message" placeholder="Message" required></textarea>
        <button type="submit" name="send" class="hero-btn blue-btn">Send Message</button>
    </form>
</div>

   </section>

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