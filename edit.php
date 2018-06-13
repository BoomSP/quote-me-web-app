<?php
  session_start();

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

$query = "select * from 50quotes where id = '$_SESSION[idq]'";
$stmt = $dbh->query($query);
$rec = $stmt->FetchAll(PDO::FETCH_ASSOC);

foreach ($rec as $row){
  $q = $row['quote'];
  $a = $row['author'];
  $s = $row['source'];
}

if($_POST['update']){
  $author = $_POST['Author'];
  $source = $_POST['Source'];
  $quote = $_POST['Quote'];

  $query = " update 50quotes set quote='$quote', author='$author', source='$source' where id='$_SESSION[idq]';";
  $stmt = $dbh->query($query);

  header("location: main.php");

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

<div style="padding-left: 7%; padding-right: 7%; padding-top: 5%">
    <form action-"#" method="post">
      <div class="form-group">
          <label for="psw"  style="color: #3F2A1D;"><span><i class="fa fa-quote-left" aria-hidden="true" style="color: #3F2A1D;"></i></span> Quote</label>
        <textarea style="resize: none;" type="text" class="form-control" name="Quote"><?php echo $q; ?></textarea>
      </div>
      <div class="form-group">
        <label style="color: #3F2A1D;"><span><i class="fa fa-user-circle" aria-hidden="true" style="color: #3F2A1D;"></i></span> Author</label>
        <input type="text" class="form-control" name="Author" value="<?php echo $a; ?>">
      </div>
      <div class="form-group">
        <label style="color: #3F2A1D;"><span><i class="fa fa-book" aria-hidden="true"  style="color: #3F2A1D;"></i></span> Source</label>
        <input type="text" class="form-control" name="Source" value="<?php echo $s; ?>">
      </div>
    <div style="text-align: right;">
    <span><input style="background-color: #8C7462; color: #3F2A1D" type="submit" class="btn" value="Update Quote" name="update">
      <a href="main.php" style="background-color: #8C7462; color: #3F2A1D" type="submit" class="btn" name="bt">Back</a>
    </form>
  </div>




  </body>
</html>
