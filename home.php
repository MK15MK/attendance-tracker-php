<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      
      background: #edc7b7;
      color: #fff;
      padding: 20px;
      font-family: Helvetica;
    }
    .container {
      background: rgba(255, 255, 255, 0.2);
      padding: 20px;
      border-radius: 10px;
    }
    .btn{
            color: #fff;
            background-color: #ac3b61;
        }
    .modal .modal-dialog {
      margin-top: 20vh;
    }

    nav {
      background:  #ac3b61;
      padding: 10px;
    }
    iframe{
      overflow: hidden;
    }
    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: flex-start; 
    }

    nav ul li {
      margin-right: 10px;
    }

    nav ul li:first-child {
      margin-right: auto;
    }

    nav ul li:last-child {
      margin-left: auto; 
    }

    nav ul li a {
      text-decoration: none;
      padding: 5px;
      color: #fff;
      text-align: left;
    }

    nav ul li a.active {
      font-weight: bold;
    }

    nav ul li a:hover,
    nav ul li a:focus,
    nav ul li a:active {
      color: #fff;
      text-decoration: none;
    }

    .content {
      padding: 20px;
      padding-top: 70px; 
    }

    iframe {
      border: none;
      width: 100%;
      height: calc(100vh - 50px);
    }

    h1 {
      margin: 0;
      padding: 10px;
    }
  </style>
</head>
<body>
  <nav class="fixed-top">
    <ul>
      <li><h1>Attendance</h1></li>
      <li><a href="#" class="active">Dashboard</a></li>
      <li><a href="#">Attendance</a></li>
      <li><a href="#">Details</a></li>
      <li><a href="#">Records</a></li>
      <li style="margin-left: auto;"><a href="log.html" id="logout">Logout</a>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
      </svg>
    </li>
    </ul>
  </nav>

  <div class="content">
    <iframe src="dashboard.html"></iframe>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    const navLinks = document.querySelectorAll('nav a');

    navLinks.forEach(link => {
      link.addEventListener('click', function(event) {
        event.preventDefault();

        navLinks.forEach(link => link.classList.remove('active'));

        this.classList.add('active');

        if (this.textContent === 'Dashboard') {
          document.querySelector('iframe').src = 'dashboard.html';
        } else if (this.textContent === 'Details') {
          document.querySelector('iframe').src = 'details.html';
        } else if (this.textContent === 'Records') {
          document.querySelector('iframe').src = 'records.html';
        } else if (this.getAttribute('id') === 'logout') {
          window.location.href = 'index.html';
        }else if (this.textContent === 'Attendance') {
          document.querySelector('iframe').src = 'attendance.html';
        }
      });
    });
  </script>
</body>
</html>
