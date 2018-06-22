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
  <form method="post" action="changeusername.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Your Current Username</label>
      <input type="password" name="username" >
    </div>
    <div class="input-group">
      <label>Your New Username</label>
      <input type="password" name="newusername" >
    </div>
    <div class="input-group">
      <label>Your password</label>
      <input type="password" name="password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="chan_user">Change Username</button>
      <button type="submit" class="btn" name="go_back">Go Back</button>
    </div>
  </form>
    
</body>
</html>