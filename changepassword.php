<?php include('server.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h2>Change your password</h2>
  </div>
  <form method="post" action="changepassword.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Your username</label>
      <input type="password" name="username" >
    </div>
    <div class="input-group">
      <label>Your current password</label>
      <input type="password" name="password_3" >
    </div>
    <div class="input-group">
      <label>Your new password</label>
      <input type="password" name="password_4">
    </div>
    <div class="input-group">
      <label>Repeat new password</label>
      <input type="password" name="password_5">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="chan_pass">Change password</button>
      <button type="submit" class="btn" name="go_back">Go Back</button>
    </div>
  </form>
    
</body>
</html>