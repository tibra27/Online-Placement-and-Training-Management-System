<?php 
  session_start(); 
/* A session is a way to store information (in variables) to be used across multiple pages.
Unlike a cookie, the information is not stored on the users computer.*/
  if (!isset($_SESSION['username'])) 
  {
    $_SESSION['msg'] = "You must log-in first";
    header('location: mnit.php');
  }
  if (isset($_GET['logout'])) 
  {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="beauty.css"> <!--Link to an external style sheet: -->
</head>
<body>
<!--The <div> element is often used as a container for other HTML elements to style them with CSS or to perform certain tasks with JavaScript.-->
<div class="header">
  <h2>Main Page</h2>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <p> <a href="index.php?logout='1'" style="color: blue;">sign out</a> </p>
    <?php endif ?>
</div>
    
</body>
</html>