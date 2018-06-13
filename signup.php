<?php

define('DB_DATABASE','db29');
define('DB_USERNAME','db29');
define('DB_PASSWORD','db29pass');
define('PDO_SDN','mysql:dbhost=tbsed.info.yuge.ac.jp;dbname=db29');

try{
  $dbh = new PDO(PDO_SDN, DB_USERNAME, DB_PASSWORD);
  $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh -> query('SET NAMES utf8');
}catch(PDOException $e){
  echo $e -> getMessage();
  exit();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Quote:Me</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, user-scalable=no"/>
    <link rel="icon" type="img/ico" href="http://www.didactique.info/images/didaquest.favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  </head>

  <body style="background-color: #F2EBE9;">
    <!--UPPER BAR-->
    <div>
      <h2 class="bar" id="logo-name"><a class="upper" href="index.php"><b>Quote:Me</b></a></h2>
    </div>

    <div style="font-family: 'Roboto', sans-serif;">
    <!--ACCOUNT HEADING-->
    <h1 style="font-size: 2em; text-align: center; max-width: 100%;">Create New Account</h1>

    <!--SIGN UP FORM-->
    <div class="form-container">
    <form action="#" method="post">
      <div class="form-group">
        <label style="color: #3F2A1D;"><span><i class="fa fa-user-circle" aria-hidden="true" style="color: #3F2A1D;"></i></span> Usernane</label>
        <input type="text" class="form-control" name="usr" placeholder="Enter Username">
      </div>
      <div class="form-group">
        <label  style="color: #3F2A1D;"><span><i class="fa fa-unlock-alt" aria-hidden="true"  style="color: #3F2A1D;"></i></span> Password</label>
        <input type="text" class="form-control" name="pwd" placeholder="Enter Password">
      </div>
      <div style="text-align: right;">
      <span><input style="background-color: #8C7462; color: #3F2A1D" type="submit" class="btn btn-default" name="accbt" value="Create New Account">
        <a href="index.php" style="background-color: #8C7462; color: #3F2A1D" class="btn btn-default">Back</a></span>
      </form>

    <?php
      if($_POST['accbt']){

      $Username = $_POST['usr'];
      $Password = $_POST['pwd'];

      $query = "insert into 50account(Username, Password) values('$Username', '$Password')";
      $stmt = $dbh->query($query);

      header("location: index.php");

    }
     ?>


  </div>
</div>
</div>
  </body>
</html>
