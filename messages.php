<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Messages | Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="admin.css" />
  <style>
    .message-card {
      background: #fff;
      padding: 1rem;
      margin-bottom: 1rem;
      border-radius: 8px;
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }
    .message-card img {
      border-radius: 50%;
      width: 60px;
      height: 60px;
      object-fit: cover;
    }
    .message-content h4 {
      margin-bottom: 0.2rem;
    }
    .message-content p {
      margin: 0.3rem 0;
      font-size: 0.9rem;
      color: #333;
    }
    .message-content .label {
      font-weight: 600;
      color: #555;
    }
    .message-content .attachment {
      color: var(--main-color);
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
        <li><a href="admin.html"><span class="fa-solid fa-computer"></span><span>Dashboard</span></a></li>
        <li><a href="clients.html"><span class="fa-solid fa-users-rectangle"></span><span>Clients</span></a></li>
        <li><a href="projects.html"><span class="fa-solid fa-diagram-project"></span><span>Projects</span></a></li>
        <li><a href="messages.php" class="active"><span class="fa-regular fa-message"></span><span>Messages</span></a></li>
        <li><a href="tasks.php"><span class="fa-regular fa-clipboard"></span><span>Tasks</span></a></li>
        <li><a href="account.html"><span class="fa-solid fa-users"></span><span>Accounts</span></a></li>
        <li><a href="logins.php"><span class="fa-solid fa-right-from-bracket"></span><span>Log out</span></a></li>
      </ul>
    </div>
  </div>

  <div class="main-content">
    <header>
      <h2>
        <label for="nav-toggle"><span class="fa-solid fa-bars"></span></label>
        Messages
      </h2>

      <div class="search-wrapper">
        <span class="fa-solid fa-magnifying-glass"></span>
        <input type="search" placeholder="Search messages" />
      </div>

      <div class="user-wrapper">
        <img src="img/admin-p2.jpg" width="30px" height="30px" alt="" />
        <div>
          <h4>Prinz Asignado</h4>
          <small>Admin</small>
        </div>
      </div>
    </header>

    <main>
      <div class="card">
        <div class="card-header">
          <h3>Client Messages</h3>
        </div>

        <div class="card-body">
          <?php
include 'connect.php';
$result = $conn->query("SELECT * FROM messages ORDER BY timestamp DESC");
while ($row = $result->fetch_assoc()):
    $files = array_filter(explode(',', $row['attachments'])); // handles empty values
?>
<div class="message-card">
  <img src="img/user-p1.jpg" alt="Client Profile" />
  <div class="message-content">
    <h4><?= htmlspecialchars($row['name']) ?></h4>
    <p><span class="label">Email:</span> <?= htmlspecialchars($row['email']) ?></p>
    <p><span class="label">Requested Project:</span> <?= htmlspecialchars($row['project']) ?></p>
    <p><span class="label">Attachment:</span> 
<?php if (!empty($row['attachments'])): 
    $files = explode(',', $row['attachments']);
    foreach ($files as $file): 
        $filename = basename($file); ?>
        <br><a class="attachment" href="<?= htmlspecialchars($file) ?>" download><?= htmlspecialchars($filename) ?></a>
<?php endforeach; 
else: ?>
    <span class="attachment">No attachment</span>
<?php endif; ?>
</p>

    </p>
    <p><span class="label">Message:</span> <?= nl2br(htmlspecialchars($row['message'])) ?></p>
  </div>
</div>
<?php endwhile; ?>

        </div>
      </div>
    </main>
  </div>
</body>
</html>
