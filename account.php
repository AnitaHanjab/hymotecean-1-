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
  <title>Accounts | Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="admin.css" />
  <style>
    .account-table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      margin-top: 2rem;
      border-radius: 5px;
      overflow: hidden;
    }
    .account-table th, .account-table td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid #f0f0f0;
      font-size: 0.95rem;
    }
    .account-table th {
      background: #f1f5f9;
    }
    .account-actions button {
      margin: 0.2rem 0.3rem 0.2rem 0;
      padding: 0.4rem 0.6rem;
      font-size: 0.8rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn-report {
      background-color: orange;
      color: #fff;
    }
    .btn-ban {
      background-color: red;
      color: #fff;
    }
    .btn-unban {
      background-color: #2facdd;
      color: #fff;
    }
    .btn-delete {
      background-color: #555;
      color: #fff;
    }
    .status-active, .status-online::before {
      color: green;
      font-weight: 600;
    }
    .status-reported {
      color: orange;
      font-weight: 600;
    }
    .status-banned {
      color: red;
      font-weight: 600;
    }
    .status-online::before {
      content: "● ";
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
        <li><a href="projects.php"><span class="fa-solid fa-diagram-project"></span><span>Projects</span></a></li>
        <li><a href="messages.php"><span class="fa-regular fa-message"></span><span>Messages</span></a></li>
        <li><a href="tasks.php"><span class="fa-regular fa-clipboard"></span><span>Tasks</span></a></li>
        <li><a href="account.php" class="active"><span class="fa-solid fa-users"></span><span>Accounts</span></a></li>
        <li><a href="logins.php"><span class="fa-solid fa-right-from-bracket"></span><span>Log out</span></a></li>
      </ul>
    </div>
  </div>

  <div class="main-content">
    <header>
      <h2>
        <label for="nav-toggle"><span class="fa-solid fa-bars"></span></label>
        Accounts
      </h2>

      <div class="search-wrapper">
        <span class="fa-solid fa-magnifying-glass"></span>
        <input type="search" placeholder="Search users" />
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
      <div class="card">
        <div class="card-header">
          <h3>User Accounts</h3>
        </div>
        <div class="card-body">
          <table class="account-table" id="account-table">
            <thead>
              <tr>
                <th>User</th>
                <th>Role</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Donel Lopez</td>
                <td>Businessman</td>
                <td>donel@example.com</td>
                <td class="status status-online">Active</td>
                <td class="account-actions">
                  <button class="btn-report" onclick="reportUser(this)">Report</button>
                  <button class="btn-ban" onclick="banUser(this)">Ban</button>
                  <button class="btn-unban" onclick="unbanUser(this)" style="display: none;">Unban</button>
                  <button class="btn-delete" onclick="deleteUser(this)">Delete Account</button>
                </td>
              </tr>
              <tr>
                <td>Phoebe Lagos</td>
                <td>Student</td>
                <td>phoebe@example.com</td>
                <td class="status status-online">Active</td>
                <td class="account-actions">
                  <button class="btn-report" onclick="reportUser(this)">Report</button>
                  <button class="btn-ban" onclick="banUser(this)">Ban</button>
                  <button class="btn-unban" onclick="unbanUser(this)" style="display: none;">Unban</button>
                  <button class="btn-delete" onclick="deleteUser(this)">Delete Account</button>
                </td>
              </tr>
              <tr>
                <td>Josaeph Joestar</td>
                <td>Businessman</td>
                <td>joestar@example.com</td>
                <td class="status status-online">Active</td>
                <td class="account-actions">
                  <button class="btn-report" onclick="reportUser(this)">Report</button>
                  <button class="btn-ban" onclick="banUser(this)">Ban</button>
                  <button class="btn-unban" onclick="unbanUser(this)" style="display: none;">Unban</button>
                  <button class="btn-delete" onclick="deleteUser(this)">Delete Account</button>
                </td>
              </tr>
              <tr>
                <td>Alden Richards</td>
                <td>Businessman</td>
                <td>alden@example.com</td>
                <td class="status status-online">Active</td>
                <td class="account-actions">
                  <button class="btn-report" onclick="reportUser(this)">Report</button>
                  <button class="btn-ban" onclick="banUser(this)">Ban</button>
                  <button class="btn-unban" onclick="unbanUser(this)" style="display: none;">Unban</button>
                  <button class="btn-delete" onclick="deleteUser(this)">Delete Account</button>
                </td>
              </tr>
              <tr>
                <td>Tung Tung Sahur</td>
                <td>Student</td>
                <td>tung@example.com</td>
                <td class="status status-online">Active</td>
                <td class="account-actions">
                  <button class="btn-report" onclick="reportUser(this)">Report</button>
                  <button class="btn-ban" onclick="banUser(this)">Ban</button>
                  <button class="btn-unban" onclick="unbanUser(this)" style="display: none;">Unban</button>
                  <button class="btn-delete" onclick="deleteUser(this)">Delete Account</button>
                </td>
              </tr>
              <tr>
                <td>John Paul Rivera</td>
                <td>Student</td>
                <td>johnpaul@example.com</td>
                <td class="status status-online">Active</td>
                <td class="account-actions">
                  <button class="btn-report" onclick="reportUser(this)">Report</button>
                  <button class="btn-ban" onclick="banUser(this)">Ban</button>
                  <button class="btn-unban" onclick="unbanUser(this)" style="display: none;">Unban</button>
                  <button class="btn-delete" onclick="deleteUser(this)">Delete Account</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <script>
    function reportUser(button) {
      const row = button.closest("tr");
      const statusCell = row.querySelector(".status");
      statusCell.textContent = "Reported";
      statusCell.className = "status status-reported";
    }

    function banUser(button) {
      const row = button.closest("tr");
      const statusCell = row.querySelector(".status");
      statusCell.textContent = "Banned";
      statusCell.className = "status status-banned";

      row.querySelector(".btn-ban").style.display = "none";
      row.querySelector(".btn-unban").style.display = "inline-block";
    }

    function unbanUser(button) {
      const row = button.closest("tr");
      const statusCell = row.querySelector(".status");
      statusCell.textContent = "Active";
      statusCell.className = "status status-online";

      row.querySelector(".btn-ban").style.display = "inline-block";
      row.querySelector(".btn-unban").style.display = "none";
    }

    function deleteUser(button) {
      const row = button.closest("tr");
      row.remove();
    }
  </script>
</body>
</html>