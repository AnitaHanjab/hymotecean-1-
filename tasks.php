<?php
include 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tasks | Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="admin.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .task-form {
      background: #fff;
      padding: 1rem;
      margin: 2rem 0;
      border-radius: 5px;
    }
    .task-form input, .task-form textarea {
      margin: 0.5rem 0;
      padding: 0.5rem;
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .task-form button {
      background: var(--main-color);
      color: white;
      padding: 0.6rem 1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .task-card {
      background: #fff;
      padding: 1rem;
      border-radius: 5px;
      margin-bottom: 1rem;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }
    .task-card h4 {
      margin: 0.2rem 0;
      color: var(--main-color);
    }
    .task-card p {
      font-size: 0.9rem;
      margin: 0.3rem 0;
      color: #333;
    }
    .label {
      font-weight: 600;
      color: #555;
    }
    .file {
      color: var(--main-color);
    }
    .button-group {
      margin-top: 0.5rem;
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
        <li><a href="messages.php"><span class="fa-regular fa-message"></span><span>Messages</span></a></li>
        <li><a href="tasks.php" class="active"><span class="fa-regular fa-clipboard"></span><span>Tasks</span></a></li>
        <li><a href="account.html"><span class="fa-solid fa-users"></span><span>Accounts</span></a></li>
        <li><a href="logins.php"><span class="fa-solid fa-right-from-bracket"></span><span>Log out</span></a></li>
      </ul>
    </div>
  </div>

  <div class="main-content">
    <header>
      <h2>
        <label for="nav-toggle"><span class="fa-solid fa-bars"></span></label>
        Tasks
      </h2>

      <div class="search-wrapper">
        <span class="fa-solid fa-magnifying-glass"></span>
        <input type="search" placeholder="Search tasks" />
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
      <div class="task-form">
        <h3>Assign New Task</h3>
        <form id="taskForm" method="POST" action="assignTask.php" enctype="multipart/form-data">
          <input type="text" name="Department" placeholder="Department" required />
          <input type="text" name="ProjectTitle" placeholder="Project Title" required />
          <textarea rows="4" name="Message" placeholder="Task Instructions / Message" required></textarea>
          <input type="email" name="RecipientEmail" placeholder="Recipient's Email" required />
          <input type="file" name="Attachment[]" id="attachmentInput" accept=".pdf,.doc,.docx,.jpg,.png" multiple required />
          
          <div class="button-group">
            <button type="submit" name="assignTask">Assign Task</button>
            <button type="submit" name="tasksSend" formaction="tasksSend.php">Send Task</button>
          </div>
        </form>

      </div>

      <div id="task-list">
        <?php
          include 'connect.php';
          $result = $conn->query("SELECT * FROM assigned_tasks ORDER BY created_at DESC");
          while ($row = $result->fetch_assoc()):
        ?>
          <div class="task-card">
            <h4><?= htmlspecialchars($row['department']) ?> - <?= htmlspecialchars($row['project_title']) ?></h4>
            <p><span class="label">Attachment:</span> 
              <a href="uploads/<?= urlencode($row['attachment']) ?>" class="file" download><?= htmlspecialchars($row['attachment']) ?></a>
            </p>
            <p><span class="label">Message:</span> <?= nl2br(htmlspecialchars($row['message'])) ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    </main>
  </div>

  <!-- SweetAlert2 Notifications -->
  <?php if (isset($_GET['status']) && $_GET['status'] === 'sent'): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Task Sent!',
      text: 'The task email was successfully sent to the user.',
      confirmButtonColor: '#3085d6'
    });
  </script>
  <?php elseif (isset($_GET['status']) && $_GET['status'] === 'error'): ?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Failed to Send',
      text: 'Something went wrong while sending the task.',
      confirmButtonColor: '#d33'
    });
  </script>
  <?php endif; ?>

  <script>
    function addTask() {
      const form = document.getElementById('taskForm');
      const department = form.Department.value.trim();
      const projectTitle = form.ProjectTitle.value.trim();
      const message = form.Message.value.trim();
      const recipientEmail = form.RecipientEmail.value.trim();
      const attachmentInput = document.getElementById('attachmentInput');

      if (!department || !projectTitle || !message || !recipientEmail || attachmentInput.files.length === 0) {
        Swal.fire({
          icon: 'warning',
          title: 'Missing Fields',
          text: 'Please complete all fields including attachment.',
          confirmButtonColor: '#f39c12'
        });
        return;
      }

      const file = attachmentInput.files[0];
      const formData = new FormData();
      formData.append("Department", department);
      formData.append("ProjectTitle", projectTitle);
      formData.append("Message", message);
      formData.append("RecipientEmail", recipientEmail);
      formData.append("Attachment[]", file);

      fetch("assignTask.php", {
        method: "POST",
        body: formData
      }).then(response => response.text())
        .then(result => {
          if (result === "success") {
            const downloadURL = URL.createObjectURL(file);
            const taskCard = document.createElement('div');
            taskCard.classList.add('task-card');
            taskCard.innerHTML = `
              <h4>${department} - ${projectTitle}</h4>
              <p><span class="label">Attachment:</span> 
                <a href="${downloadURL}" download="${file.name}" class="file">${file.name}</a>
              </p>
              <p><span class="label">Message:</span> ${message}</p>
            `;
            document.getElementById('task-list').prepend(taskCard);

            Swal.fire({
              icon: 'success',
              title: 'Task Assigned!',
              text: 'The task has been saved successfully.',
              confirmButtonColor: '#3085d6'
            });

            form.reset();
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Task could not be saved. Please try again.',
              confirmButtonColor: '#d33'
            });
          }
        }).catch(() => {
          Swal.fire({
            icon: 'error',
            title: 'Request Failed',
            text: 'Could not contact the server.',
            confirmButtonColor: '#d33'
          });
        });
    }
  </script>


</body>
</html>
