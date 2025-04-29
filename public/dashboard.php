<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | To-Do List App</title>
  <style>
    /* Basic Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f2f5;
      min-height: 100vh;
    }

    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #4CAF50;
      padding: 10px 20px;
      color: white;
      position: relative;
    }

    .nav-left h1 {
      font-size: 24px;
    }

    .nav-right {
      position: relative;
    }

    .user-profile {
      cursor: pointer;
    }

    .user-profile img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 2px solid white;
    }

    .dropdown {
      position: absolute;
      right: 0;
      top: 60px;
      background: white;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      border-radius: 8px;
      overflow: hidden;
      display: none;
      min-width: 180px;
      z-index: 10;
    }

    .dropdown p {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      font-size: 14px;
      color: #333;
    }

    .dropdown a {
      display: block;
      padding: 10px;
      text-decoration: none;
      color: #333;
      transition: background 0.3s;
    }

    .dropdown a:hover {
      background: #f0f0f0;
    }

    /* Main Content */
    .container {
      padding: 20px;
      max-width: 900px;
      margin: 0 auto;
    }

    .todo-list {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .todo-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid #eee;
    }

    .todo-item:last-child {
      border-bottom: none;
    }

    .todo-title {
      font-size: 16px;
      color: #333;
    }

    .todo-status {
      font-size: 14px;
      color: #4CAF50;
    }
  </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="nav-left">
    <h1>To-Do List App</h1>
  </div>
  <div class="nav-right">
    <div class="user-profile" onclick="toggleDropdown()">
      <img src="https://i.pravatar.cc/300" alt="Profile">
    </div>
    <div id="profileDropdown" class="dropdown">
      <p><strong>John Doe</strong><br>john@example.com</p>
      <a href="#">Profile</a>
      <a href="#">Logout</a>
    </div>
  </div>
</nav>

<!-- Main Content -->
<div class="container">
  <div class="todo-list">
    <h2 style="margin-bottom: 20px;">Your Tasks</h2>

    <!-- Example Task Item -->
    <div class="todo-item">
      <span class="todo-title">Finish To-Do List Project</span>
      <span class="todo-status">Pending</span>
    </div>

    <div class="todo-item">
      <span class="todo-title">Meeting with Group</span>
      <span class="todo-status">Completed</span>
    </div>

    <div class="todo-item">
      <span class="todo-title">Submit Final Report</span>
      <span class="todo-status">Pending</span>
    </div>

  </div>
</div>

<!-- Javascript -->
<script>
function toggleDropdown() {
  var dropdown = document.getElementById('profileDropdown');
  dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
}

// Optional: klik di luar dropdown untuk nutup otomatis
window.onclick = function(event) {
  if (!event.target.matches('.user-profile img')) {
    var dropdowns = document.getElementsByClassName("dropdown");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.style.display === 'block') {
        openDropdown.style.display = 'none';
      }
    }
  }
}
</script>

</body>
</html>
