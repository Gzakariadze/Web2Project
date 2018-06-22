<?php 
  session_start();

  // variable declaration
  $username = "";
  $email    = "";
  $errors = array(); 
  $_SESSION['success'] = "";

  // connect to database
  $db = mysqli_connect('localhost', 'root', '', 'registration');

  // REGISTER USER
  if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }

    if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match");
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
      $password = md5($password_1);//encrypt the password before saving in the database
      $query = "INSERT INTO users (username, email, password) 
            VALUES('$username', '$email', '$password')";
      mysqli_query($db, $query);

      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }

  }

  // ... 

  // LOGIN USER
  if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
      array_push($errors, "Username is required");
    }
    if (empty($password)) {
      array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
      $password = md5($password);
      $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
      $results = mysqli_query($db, $query);

      if (mysqli_num_rows($results) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
      }else {
        array_push($errors, "Wrong username/password combination");
      }
      
    }
  }

  // CHANGE USERNAME
  if (isset($_POST['chan_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $newusername = mysqli_real_escape_string($db, $_POST['newusername']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    // Check if the fields are filled
    if (empty($username)) { array_push($errors, "Please, input your username");}
    if (empty($newusername)) { array_push($errors, "Please, insert your new username"); }
    if (empty($password)) { array_push($errors, "You have to put in your password"); }
    // Checking database for username and password
    if (count($errors) == 0){
      $password = md5($password);
      $query = "SELECT * FROM users WHERE password = '$password' and username = '$username'";
      $results = mysqli_query($db, $query);
      $row = mysqli_fetch_row($results);
      if ($password != $row[3] or $username != $row[1]){
        array_push($errors, "Oops, your password or your username is incorrect");
      } else {
        $stry = "UPDATE users SET username = '$newusername' WHERE username='$username' and password = '$password'";
        $runner = mysqli_query($db, $stry);
        $_SESSION['success'] = "Your username has been changed";
        header('location: index.php');
      }
    }
  }

  // CHANGE PASSWORD
  if (isset($_POST['chan_pass'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password_3']);
    $newpassword = mysqli_real_escape_string($db, $_POST['password_4']);
    $repeatnewpassword = mysqli_real_escape_string($db, $_POST['password_5']);
    //Check if the fields are filled
    if (empty($username)) { array_push($errors, "Please, input your username");}
    if (empty($password)) { array_push($errors, "Old password is neccesary"); }
    if (empty($newpassword)) { array_push($errors, "Input your new password"); }
    if (empty($repeatnewpassword)) { array_push($errors, "Repeat your new password"); }
    //Search your password and username in database
    if (count($errors) == 0){
      $password = md5($password);
      $query = "SELECT * FROM users WHERE password = '$password' and username = '$username'";
      $results = mysqli_query($db, $query);
      $row = mysqli_fetch_row($results);
      if($password != $row[3] or $username != $row[1]){
        array_push($errors, "Oops, your password or your username is incorrect");
      } else {
        $newpassword = md5($newpassword);
        $stry="UPDATE users SET password = '$newpassword' WHERE password = '$password' AND username = '$username'";
        $runner = mysqli_query($db, $stry);
        $_SESSION['success'] = "Your password has been changed";
        header('location: index.php');
      }
    }
  }
  //Comment
  if (isset($_POST['click'])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $subtitle = mysqli_real_escape_string($db, $_POST['subtitle']);
    $content = mysqli_real_escape_string($db, $_POST['content']);
    $dbcon = mysqli_connect('localhost', 'root', '', 'registration');
    $sql = "INSERT INTO blog (title, subtitle, content) VALUE ('$title', '$subtitle', '$content')";
    mysqli_query($dbcon, $sql);
    header('location: comment.php');
  }
  // Go BACK
  if (isset($_POST['go_back'])){
    header('location: index.php');
  }

?>