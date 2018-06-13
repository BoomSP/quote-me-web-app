<?php
  session_start();

define('DB_DATABASE','');
define('DB_USERNAME','');
define('DB_PASSWORD','');
define('PDO_SDN','');

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
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body style="background-color: #F2EBE9;">
    <!--UPPER BAR-->
    <div>
      <h2 class="bar" id="logo-name"><a class="upper" href="index.php"><b>Quote:Me</b></a></h2>
    </div>

    <div style="font-family: 'Roboto', sans-serif;">
        <p style="font-size: 2em; text-align:center; max-width: 100%; padding: 0.5em;">Pile Up Inspirational Quotes</p>
        <div class="button-containter">
          <p><button class="btn" style="background-color: #8C7462; border: none; color: #3F2A1D font-size: 1em;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Sign In</button>
          <a class="btn" style="background-color: #8C7462; border: none; color: #3F2A1D;" href="signup.php">Sign Up</a>
        </div>

        <!-- Login Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">

            <!-- Login Modal Content-->
            <div class="modal-content" style="background-color: #F2EBE9;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color: #3F2A1D;"><span class="glyphicon glyphicon-lock"></span> Login</h4>
              </div>
              <div class="modal-body">
                <form method="post" action="#">
                  <div class="form-group">
                    <label for="usrname"  style="color: #3F2A1D;"><span class="glyphicon glyphicon-user" style="color: #3F2A1D;"></span> Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter Username">
                  </div>
                  <div class="form-group">
                    <label for="psw"  style="color: #3F2A1D;"><span class="glyphicon glyphicon-eye-open"  style="color: #3F2A1D;"></span> Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Enter Password">
                  </div>
                  <input name="signin" value="Sign In" type="submit" class="btn btn-default btn-block" style="color: #3F2A1D; background-color: #8C7462;"><!--<span  class="glyphicon glyphicon-off"></span>-->
                </form>
<?php
  // $nRows = $dbh->query('select count(*) from 50account where Username = '$usr' and Password = '$pwd' limit 1')->fetchColumn();
  // echo $nRows;


  if($_POST['signin']){
    $usr = $_POST['username'];
    $pwd = $_POST['password'];

    // $query = "select count(*) from 50account where Username = '$usr' and Password = '$pwd' limit 1";
    // $stmt = $dbh->query($query);
    // $row = $stmt->fetchColumn();

    $queryuser = "select Username from 50account where Username = '$usr' and Password = '$pwd' limit 1";
    $stmtuser = $dbh->query($queryuser);
    $data = $stmtuser->FetchAll(PDO::FETCH_ASSOC);
    foreach($data as $row){
    $u = $row['Username'];
  }

    if($u){
      //success
      $_SESSION['uuu'] = $u;


      header("location: main.php");
    }else{
      //failure
      $error = "Invalid Username or Password";
      echo $error;
    }
  }

 ?>
              </div>
              <div class="modal-footer">
                <p  style="color: #3F2A1D;">Not a member? <a style="color: #3F2A1D;" href="signup.php">Sign Up</a></p>
            </div>
          </div>
        </div>
      </div>
        </div>
  </body>
</html>
