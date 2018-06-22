<?php include('server.php');
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <form method="post" action="comment.php">
    <h2>Comment:</h2>
    <p>Title: <input type="text" name="title"></p>
    <p>Subtitle: <input type="text" name="subtitle"></p>
    <p>Content: <textarea name="content"></textarea></p>
    <input type="submit" name="click" value="Blog post">
    <input type="submit" name="go_back" value="Go Back">
  </form>
  <h2 style="color: green; text-align: center;">Here you can find latest comments on our website</h2>
   <?php
      $dbcon = mysqli_connect('localhost', 'root', '', 'registration');
      $sql = "SELECT * FROM blog ORDER BY id DESC";
      $result = mysqli_query($dbcon, $sql);

      while($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $subtitle = $row['subtitle'];
        $content = $row['content'];
      
    ?>
    <h2 class="sityvebi" style="text-align: center;"><?php echo $title; ?> - <small><?php echo $subtitle ;?></small></h2>
    <p style="text-align: center;"><?php echo $content ?></p>
    <hr>
    <?php 
      }
    ?>
</body>
</html>