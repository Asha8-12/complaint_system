<!DOCTYPE html>
<html>
<head>
  <title>complaint </title>
  <link rel ="stylesheet" href ="styel2.css">
</head>
<body>
  <div class="container">
    <div class="logo-container">
      <img src="logo.png" alt="">
      <h1>ONLINE STUDENT COMPLAINT SYSTEM</h1>
    </div>
    <form class="login-form" action="login-form.php" method="POST">
    
    </select>
    <br>
      <input type="text" placeholder="Enter Login ID " id="username" name="email">
      <input type="password" placeholder="Enter Login password " id="password" name="password">
      <button type="submit" onclick="login()">SIGN IN</button>
      <div class="signup-links">
        <a href="index.php" class="signuo-link">you don't have account? Sign Up here</a>
        
      </div>
    </form>
  </div>
  <script>
    function login() {
       // Get the username and password from the input fields
      const username = document.getElementById('username').value;
       const password = document.getElementById('password').value;

       // Placeholder for actual login logic
    //   // Here we use a simple example for demonstration purposes
       if (username === 'admin@gmail.com' && password === '123') {
    //     // Redirect to the admin dashboard
         window.location.href = "admin_dasboard.html";
       } else {
    //     // Redirect to the user dashboard
        window.location.href = "dashboard.html";
       }
     }
  </script>
</body>
</html>