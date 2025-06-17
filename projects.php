<?php
session_start();
$firstname = isset($_SESSION['Firstname']) ? $_SESSION['Firstname'] : 'Unknown';
$lastname = isset($_SESSION['Lastname']) ? $_SESSION['Lastname'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Projects | Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="admin.css" />
  <style>
    .add-project-form {
      background: #fff;
      margin: 2rem 0;
      padding: 1rem;
      border-radius: 5px;
    }
    .add-project-form input,
    .add-project-form select {
      margin: 0.5rem 0;
      padding: 0.5rem;
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .add-project-form button {
      margin-top: 0.5rem;
      background: var(--main-color);
      color: white;
      padding: 0.6rem 1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <input type="checkbox" id="nav-toggle" />
  <div class="sidebar">
    <div class="sidebar-brand">
      <h2><span class="fa-solid fa-water"></span> <span>HYMETOCEAN PEERS CO.</span></h2>
    </div>
    <div class="sidebar-menu">
      <ul>
        <li><a href="admin.php"><span class="fa-solid fa-computer"></span><span>Dashboard</span></a></li>
        <li><a href="clients.php"><span class="fa-solid fa-users-rectangle"></span><span>Clients</span></a></li>
        <li><a href="projects.php" class="active"><span class="fa-solid fa-diagram-project"></span><span>Projects</span></a></li>
        <li><a href="messages.php"><span class="fa-regular fa-message"></span><span>Messages</span></a></li>
        <li><a href="tasks.php"><span class="fa-regular fa-clipboard"></span><span>Tasks</span></a></li>
        <li><a href="account.php"><span class="fa-solid fa-users"></span><span>Accounts</span></a></li>
        <li><a href="logins.php"><span class="fa-solid fa-right-from-bracket"></span><span>Log out</span></a></li>
      </ul>
    </div>
  </div>

  <div class="main-content">
    <header>
      <h2>
        <label for="nav-toggle"><span class="fa-solid fa-bars"></span></label>
        Projects
      </h2>

      <div class="search-wrapper">
        <span class="fa-solid fa-magnifying-glass"></span>
        <input type="search" placeholder="Search here" />
      </div>

      <div class="user-wrapper">
        <img src="img/admin-p2.jpg" width="30px" height="30px" alt="" />
        <div>
          <h4><?= htmlspecialchars($firstname . ' ' . $lastname) ?></h4>
          <small>Admin</small>
        </div>
      </div>
    </header>

    <main>

      <div class="add-project-form">
        <h3>Add New Project</h3>
        <input type="text" id="project-title" placeholder="Project Title" />
        <input type="text" id="project-department" placeholder="Department" />
        <select id="project-status">
          <option value="Review">Review</option>
          <option value="Ongoing">Ongoing</option>
          <option value="Pending">Pending</option>
        </select>
        <button onclick="addProject()">Add Project</button>
      </div>

      <div class="card">
        <div class="card-header">
          <h3>Project List</h3>
          <button>See all <span class="fa fa-arrow-circle-right"></span></button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table width="100%" id="project-table">
              <thead>
                <tr>
                  <td>Project Title</td>
                  <td>Department</td>
                  <td>Status</td>
                </tr>
              </thead>
              <tbody>
                <tr><td>Hydrodynamic Modeling of Marikina River for Climate Adaptation</td><td>Coastal Engineering</td><td><select onchange="updateStatus(this)"><option selected>Review</option><option>Ongoing</option><option>Pending</option></select></td></tr>
                <tr><td>Integrated Flood Risk Assessment for Coastal Barangays</td><td>Coastal Engineering</td><td><select onchange="updateStatus(this)"><option>Review</option><option selected>Ongoing</option><option>Pending</option></select></td></tr>
                <tr><td>Wave Power Potential Analysis in Eastern Philippines</td><td>Renewable Energy</td><td><select onchange="updateStatus(this)"><option>Review</option><option>Ongoing</option><option selected>Pending</option></select></td></tr>
                <tr><td>Pollution Source Identification Using IoT Sensor Networks</td><td>Water Quality Monitoring</td><td><select onchange="updateStatus(this)"><option selected>Review</option><option>Ongoing</option><option>Pending</option></select></td></tr>
                <tr><td>AI-Driven Forecasting of Water Quality Parameters</td><td>Research & Development</td><td><select onchange="updateStatus(this)"><option selected>Review</option><option>Ongoing</option><option>Pending</option></select></td></tr>
                <tr><td>Real-Time Water Quality Monitoring in Pasig River</td><td>Water Quality Monitoring</td><td><select onchange="updateStatus(this)"><option>Review</option><option>Ongoing</option><option selected>Pending</option></select></td></tr>
                <tr><td>Coastal Land Use Mapping Using Multitemporal Imagery</td><td>Remote Sensing & GIS</td><td><select onchange="updateStatus(this)"><option>Review</option><option>Ongoing</option><option selected>Pending</option></select></td></tr>
                <tr><td>Model Calibration Techniques for Tropical River Systems</td><td>Research & Development</td><td><select onchange="updateStatus(this)"><option>Review</option><option selected>Ongoing</option><option>Pending</option></select></td></tr>
                <tr><td>Baseline Study of Aquatic Ecosystems for Infrastructure Projects</td><td>Water Quality Monitoring</td><td><select onchange="updateStatus(this)"><option>Review</option><option>Ongoing</option><option selected>Pending</option></select></td></tr>
                <tr><td>Development of a Smart Buoy for Coastal Monitoring</td><td>Project Management</td><td><select onchange="updateStatus(this)"><option selected>Review</option><option>Ongoing</option><option>Pending</option></select></td></tr>
                <tr><td>Tidal Current Mapping for Micro-Hydro Installations</td><td>Water Quality Monitoring</td><td><select onchange="updateStatus(this)"><option>Review</option><option selected>Ongoing</option><option>Pending</option></select></td></tr>
                <tr><td>Erosion and Sediment Transport Simulation in Coastal Zones</td><td>Coastal Engineering</td><td><select onchange="updateStatus(this)"><option>Review</option><option>Ongoing</option><option selected>Pending</option></select></td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    function addProject() {
      const title = document.getElementById("project-title").value.trim();
      const dept = document.getElementById("project-department").value.trim();
      const status = document.getElementById("project-status").value;

      if (!title || !dept) {
        alert("Please fill out all fields.");
        return;
      }

      const table = document.getElementById("project-table").getElementsByTagName("tbody")[0];
      const row = table.insertRow();

      row.innerHTML = `
        <td>${title}</td>
        <td>${dept}</td>
        <td>
          <select onchange="updateStatus(this)">
            <option${status === "Review" ? " selected" : ""}>Review</option>
            <option${status === "Ongoing" ? " selected" : ""}>Ongoing</option>
            <option${status === "Pending" ? " selected" : ""}>Pending</option>
          </select>
        </td>
      `;

      document.getElementById("project-title").value = "";
      document.getElementById("project-department").value = "";
      document.getElementById("project-status").value = "Review";
    }

    function updateStatus(select) {
      console.log(`Status changed to: ${select.value}`);
    }
  </script>
</body>
</html>