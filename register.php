
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <div class="register-container">
    <div class="register-form-wrapper">
      <h2 class="form-title">Register</h2>
      <div id="error-msg" class="error-msg"></div>
      <form id="register-form" class="register-form">
        <div class="form-group">
          <label for="name">Username:</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="phoneNumber">Phone Number:</label>
          <input type="text" id="phoneNumber" name="phoneNumber" required>
        </div>
        <div class="form-group">
          <label for="course">Course:</label>
          <input type="text" id="course" name="course" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" id="confirmPassword" name="confirmPassword" required>
        </div>
        <button type="submit" class="submit-btn">Register</button>
      </form>
    </div>
  </div>
  
 
</body>
</html>
