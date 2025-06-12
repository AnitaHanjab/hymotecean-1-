<?php
date_default_timezone_set('Asia/Manila');
include 'connect.php';
include 'comments.inc.php';
setComments($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hymetocean Peers Co.</title>
    <link rel="stylesheet" href="style.css?v=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>

<section class="sub-header">
    <nav>
        <a href="front.php"><img src="img/logo.png" alt="Logo" /></a>
        <div class="nav-links" id="navLinks">
            <i class="fa fa-times" onclick="hideMenu()"></i>
            <ul>
                <li><a href="front.php">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="project.php">Projects</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="logins.php">Logout</a></li>
            </ul>
        </div>
        <i class="fa fa-bars" onclick="showMenu()"></i>
    </nav>
    <h1>Our Projects</h1>
</section>

<section class="project-1">
    <div class="row">
        <div class="project-left">
            <img src="img/bg34 (1).jpg" alt="Project Image" />
            <h2>List of Projects</h2>
                <br>
                <p> • Coastal Modeler for Various Dredging and Reclamation Projects, Abu Dhabi UAE. 
                    March 2023-December 2024. </p>
                <br>
                <p> • Coastal Modeler for Various Desalination Projects, Abu Dhabi UAE May-June 2023.</p>
                <br>
                <p> • Coastal processes and hazard modeling for the CDO Kayak expansion project of Makati 
                    Development Corporation. March 2022-April 2022. </p>
                <br>
                <p> • Coastal Engineering/Hazard and Hydrological/Flood Modeling Study for the Nasugbu 
                    Harbor Center Project. December 2021 - February 2022. </p>
                <br>
                <p> • Coastal Engineering Modeling Study for the Anvaya N14 Project. Morong, Bataan. 
                    August - October 2021.  </p>
                <br>
                <p> • Coastal Engineering Study and Bathymetric Survey for the SMDC Calatagan Beachtown 
                    Project.  Calatagan, Batangas.  July - September 2021. </p>
                <br>
                <p> • Coastal Engineering Modeling Study for the Cancabato Breakwater-Bridge Project. 
                    Tacloban City, Philippines. September 2019 - March 2020. </p>
                <br>
                <p> • Coastal Modeling Study for the Metro Bacolod Urban Master Plan Project. PKII
                    PLANADES. NEDA Philippines. May 2019-May 2020.  </p>
                <br>
                <p> • Coastal engineering modeling study for the Panglao (Blu Sky Bohol) Coastal 
                    Development Project. Makati Development Corp.  May - August 2019. </p>
                <br>
                <p> • Coastal engineering modeling study for the Danao Coastal Development Project. Makati 
                    Development Corp.  August-October 2018. </p>
                <br>
                <p> • Coastal engineering modeling study for the Laguindingan-2 Coastal Development 
                    Project. Makati Development Corp.  June - September 2018. </p>
                <br>
                <p> • Coastal Hydrodynamics and Coastal Hazard Modeling Study for the MB Expansion 
                    Project, Nasugbu Batangas. Makati Development Corp. October-December 2017 </p>
                <br>
                <p> • Brine Outfall Dispersion and Mixing Zone Modeling Study for the 100 MLD RPWSIP 
                    Project of MWCI.  Sta. Clara International Corporation. October 16 - January 2017.  </p>
                <br>
                <p> • Coastal engineering modeling study on storm surge and tsunami occurrence for the 
                    Amara 3B Project. Makati Development Corporation. Feb. April 2016.  </p>
                <br>
                <p> • Consultant, Coastal Hydraulics and sediment morphodynamic modeling for Camaya 
                    Coast.  December 2014 - February 2015.  </p>
                <br>
                <p> • Coastal circulation and wave disturbance modeling study for the Caylabne Bay Resort 
                    Development. May-July 2014.   </p>
                <br>
                <p> • Coastal engineering modeling (storm surge, waves, tsunami and circulation) for the 
                    Puerto Azul Project.  Makati Development Corp.  April - May 2014.   </p>
                <br>
                <p> • Sedimentation Study for the La Mesa Watershed Reservation. Berkman International,  
                    Inc.  Jan. - May 2014. </p> 

            <div class="comment-box">
                <h3>Leave Comment</h3>
                <form method="post" action="" class="comment-form">
                    <input type="text" name="username" class="comment-username" placeholder="Enter Name"  />
                    <input type="email" name="email" class="comment-email" placeholder="Enter Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter a valid email address" />
                    <input type="hidden" name="date" class="comment-date" value="<?php echo date('Y-m-d H:i:s'); ?>" />
                    <textarea rows="5" name="comment" class="comment-text" placeholder="Your comment" ></textarea>
                    <button type="submit" name="commentSubmit" class="hero-btn blue-btn">POST COMMENT</button>
                </form>
                <?php getComments($conn); ?>
            </div>
        </div>

        <div class="project-right">
            <h3>For All Projects Overview</h3>
            <div><span>Coastal Engineering</span><span>12</span></div>
            <div><span>Water Quality Studies</span><span>9</span></div>
            <div><span>River Flow Modeling</span><span>15</span></div>
            <div><span>Environmental Impact</span><span>7</span></div>
            <div><span>Renewable Energy</span><span>9</span></div>
            <div><span>Ocean Currents</span><span>8</span></div>
        </div>
    </div>
</section>

<section class="footer">
    <h3>About Us</h3>
    <p>Hymetocean Peers Company (HPC) is a technical service provider (General Partnership) registered in the Philippines that specializes in lakes and coastal ocean studies, water resources, renewable energy exploration, water quality modeling and air quality modeling.</p>
    <div class="icons">
        <i class="fa-brands fa-facebook"></i>
        <i class="fa-brands fa-twitter"></i>
        <i class="fa-brands fa-instagram"></i>
        <i class="fa-brands fa-yahoo"></i>
    </div>
    <section class="cpr">
        <p>Copyright <i class="fa fa-copyright"></i> 2025 HYMETOCEAN.PEERS.CO - All rights Reserved</p>
    </section>
</section>

<script>
    var navLinks = document.getElementById("navLinks");
    function showMenu() {
        navLinks.style.right = "0";
    }
    function hideMenu() {
        navLinks.style.right = "-200px";
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
