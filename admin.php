<?php
session_start();
$firstname = isset($_SESSION['Firstname']) ? $_SESSION['Firstname'] : 'Unknown';
$lastname = isset($_SESSION['Lastname']) ? $_SESSION['Lastname'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="fa-solid fa-water"></span> <span>HYMETOCEAN PEERS CO.  </span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li><a href="admin.php" class="active"><span class="fa-solid fa-computer"></span>
                    <span>Dashboard </span></a>
                </li>
                <li><a href="clients.php"><span class="fa-solid fa-users-rectangle"></span>
                    <span>Clients </span></a>
                </li>
                <li><a href="projects.php"><span class="fa-solid fa-diagram-project"></span>
                    <span>Projects </span></a>
                </li>
                <li><a href="messages.php"><span class="fa-regular fa-message"></span>
                    <span>Messages </span></a>
                </li>
                <li><a href="tasks.php"><span class="fa-regular fa-clipboard"></span>
                    <span>Tasks </span></a>
                </li>
                <li><a href="account.php"><span class="fa-solid fa-users"></span>
                    <span>Accounts </span></a>
                <li><a href="logins.php"><span class="fa-solid fa-right-from-bracket"></span>
                    <span>Log out </span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="fa-solid fa-bars"></span>
                </label>

                Dashboard
            </h2>

            <div class="search-wrapper">
                <span class="fa-solid fa-magnifying-glass"></span>
                <input type="search" placeholder="Search here"/>
            </div>

            <div class="user-wrapper">
                <img src="img/admin-p2.jpg" width="30px" height="30px" alt="">
            <div>
                <h4><?= htmlspecialchars($firstname . ' ' . $lastname) ?></h4>
                <small>Admin</small>
            </div>
        </div>

        </header>

        <main>

            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1>32</h1>
                        <span>Clients</span>
                    </div>
                <div>
                    <span class="fa-solid fa-users"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1>12</h1>
                        <span>Projects</span>
                    </div>
                <div>
                    <span class="fa-regular fa-clipboard"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1>3</h1>
                        <span>Ongoing Task</span>
                    </div>
                <div>
                    <span class="fa-solid fa-person-digging"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1>8</h1>
                        <span>Finished Task</span>
                    </div>
                <div>
                    <span class="fa-solid fa-calendar-check"></i></span>
                    </div>
                </div>
            </div>

            <div class="recent-grid">
                <div class="Projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Recent Projects</h3>

                            <button>See all <span class="fa fa-arrow-circle-right">
                            </span></button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Project Title</td>
                                            <td>Department</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Hydrodynamic Modeling of Marikina River for Climate Adaptation</td>
                                            <td>Coastal Engineering</td>
                                            <td><span class="status purple"></span>
                                                Review
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Integrated Flood Risk Assessment for Coastal Barangays</td>
                                            <td>Coastal Engineering</td>
                                            <td><span class="status pink"></span>
                                                Ongoing
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Wave Power Potential Analysis in Eastern Philippines </td>
                                            <td> Renewable Energy</td>
                                            <td><span class="status orange"></span>
                                                Pending
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pollution Source Identification Using IoT Sensor Networks</td>
                                            <td>Water Quality Monitoring</td>
                                            <td><span class="status purple"></span>
                                                Review
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>AI-Driven Forecasting of Water Quality Parameters</td>
                                            <td>Research & Development</td>
                                            <td><span class="status purple"></span>
                                                Review
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Real-Time Water Quality Monitoring in Pasig River </td>
                                            <td>Water Quality Monitoring</td>
                                            <td><span class="status orange"></span>
                                                Pending
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Coastal Land Use Mapping Using Multitemporal Imagery</td>
                                            <td>Remote Sensing & GIS</td>
                                            <td><span class="status orange"></span>
                                                Pending
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Model Calibration Techniques for Tropical River Systems</td>
                                            <td>Research & Development</td>
                                            <td><span class="status pink"></span>
                                                Ongoing
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Baseline Study of Aquatic Ecosystems for Infrastructure Projects</td>
                                            <td>Water Quality Monitoring</td>
                                            <td><span class="status orange"></span>
                                                Pending
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Development of a Smart Buoy for Coastal Monitoring</td>
                                            <td>Project Management</td>
                                            <td><span class="status purple"></span>
                                                Review
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tidal Current Mapping for Micro-Hydro Installations</td>
                                            <td>Water Quality Monitoring</td>
                                            <td><span class="status pink"></span>
                                                Ongoing
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Erosion and Sediment Transport Simulation in Coastal Zones</td>
                                            <td>Coastal Engineering</td>
                                            <td><span class="status orange"></span>
                                                Pending
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                             </div>
                        </div>
                    </div>
                </div>

                <div class="customers">
                    <div class="card">
                        <div class="card-header">
                            <h3>New clients</h3>

                            <button>See all <span class="fa fa-arrow-circle-right">
                            </span></button>
                        </div>

                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="img/user-p1.jpg" width="40px" 
                                height="40px" alt="">
                                    <div>
                                        <h4>Donel Lopez</h4>
                                        <small>Businessman</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="fa fa-user-circle"></span>
                                    <span class="fa fa-comment"></span>
                                    <span class="fa fa-phone"></span>
                                </div>
                            </div>

                            <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="img/user-p1.jpg" width="40px" 
                                height="40px" alt="">
                                    <div>
                                        <h4>Phoebe Lagos</h4>
                                        <small>Student</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="fa fa-user-circle"></span>
                                    <span class="fa fa-comment"></span>
                                    <span class="fa fa-phone"></span>
                                </div>
                            </div>

                            <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="img/user-p1.jpg" width="40px" 
                                height="40px" alt="">
                                    <div>
                                        <h4>Josaeph Joestar</h4>
                                        <small>Businessman</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="fa fa-user-circle"></span>
                                    <span class="fa fa-comment"></span>
                                    <span class="fa fa-phone"></span>
                                </div>
                            </div>

                            <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="img/user-p1.jpg" width="40px" 
                                height="40px" alt="">
                                    <div>
                                        <h4>Alden Richards</h4>
                                        <small>Businessman</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="fa fa-user-circle"></span>
                                    <span class="fa fa-comment"></span>
                                    <span class="fa fa-phone"></span>
                                </div>
                            </div>

                            <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="img/user-p1.jpg" width="40px" 
                                height="40px" alt="">
                                    <div>
                                        <h4>Tung Tung Sahur</h4>
                                        <small>Student</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="fa fa-user-circle"></span>
                                    <span class="fa fa-comment"></span>
                                    <span class="fa fa-phone"></span>
                                </div>
                            </div>

                            <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <img src="img/user-p1.jpg" width="40px" 
                                height="40px" alt="">
                                    <div>
                                        <h4>John Paul Rivera</h4>
                                        <small>Student</small>
                                    </div>
                                </div>
                                <div class="contact">
                                    <span class="fa fa-user-circle"></span>
                                    <span class="fa fa-comment"></span>
                                    <span class="fa fa-phone"></span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>