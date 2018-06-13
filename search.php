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
    <div class="bar">
      <div class="bar-side">
        <h2><span style="color:#F2EBE9;cursor:pointer" onclick="openNav()">&#9776;</span></h2>
      </div>
      <div class="bar-mid">
        <h2 id="logo-name"><b>Quote:Me</b></h2>
      </div>
      <div class="bar-add">
        <i style="color:#F2EBE9; text-align:center;" class="fa fa-plus-square-o fa-2x" aria-hidden="true"  data-toggle="modal" data-target="#AddModal"></i>
      </div>
    </div>

    <!--SIDEBAR-->
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a href="main.php">Quotes</a>
      <hr style="margin: 1em; border-color: #24150E;">
      <a href="index.php">Sign Out</a>
    </div>

    <!--ADD QUOTE MODAL-->
    <div style="font-family: 'Roboto', sans-serif;">
    <div class="modal fade" id="AddModal" role="dialog">
        <div class="modal-dialog">
    <!-- ADD QUOTE MODAL CONTENT-->
          <div class="modal-content">
        <div class="modal-body">
          <form action-"#" method="post">
            <div class="form-group">
                <label for="psw"  style="color: #3F2A1D;"><span><i class="fa fa-quote-left" aria-hidden="true" style="color: #3F2A1D;"></i></span> Quote</label>
              <textarea style="resize: none;" type="text" class="form-control" name="Quote" placeholder="Quote"></textarea>
            </div>
            <div class="form-group">
              <label style="color: #3F2A1D;"><span><i class="fa fa-user-circle" aria-hidden="true" style="color: #3F2A1D;"></i></span> Author</label>
              <input type="text" class="form-control" name="Author" placeholder="Author">
            </div>
            <div class="form-group">
              <label style="color: #3F2A1D;"><span><i class="fa fa-book" aria-hidden="true"  style="color: #3F2A1D;"></i></span> Source</label>
              <input type="text" class="form-control" name="Source" placeholder="Source">
            </div>
          <div style="text-align: right;">
          <span><input style="background-color: #8C7462; color: #3F2A1D" type="submit" class="btn" value="Add Quote" name="bt">
          </form>
            <!--ADD QUOTE PHP-->
            <?php
            $flag = true;
            $query = "select * from 50quotes where Username = '$_SESSION[uuu]' and quote like '%$_SESSION[idq]%'";
            $stmt = $dbh->query($query);
            $rec = $stmt->FetchAll(PDO::FETCH_ASSOC);

            if($_POST['bt']){
              $author = $_POST['Author'];
              $source = $_POST['Source'];
              $quote = $_POST['Quote'];

              $query = "insert into 50quotes(Username, author, source, quote) values('$_SESSION[uuu]', '$author', '$source', '$quote')";
              $stmt = $dbh->query($query);

              header("location: main.php");

              exit();
            }

            if($_POST['del']){
              $id = $_POST['id'];

              $query = "delete from 50quotes where id=$id";
              $stmt = $dbh->query($query);

              header("location: main.php");

              exit();
          }

            if($_POST['edit']){
              $id = $_POST['id'];
              $_SESSION['idq'] = $id;


              header("location: edit.php");
            }


            if($_POST['search']){
              $id = $_POST['id'];
              $_SESSION['idq'] = $id;


              header("location: search.php");


            }

             ?>

          <button style="background-color: #8C7462; color: #3F2A1D"  type="button" class="btn" data-dismiss="modal">Cancel</button></span>
        </div>
        </div>
      </div>
    </div>

    </div>
  </div>

  <!--Welcome -->
  <?php


   ?>

  <!--DELETE&EDIT ID INPUT-->
  <form action"#" method="post">
    <div style="padding-left: 8%; padding-right: 8%; padding-top: 3%; padding-bottom: 0%">
    <input type="text" class="form-control" name="id" placeholder="Enter ID Only">
    <div style="text-align: right; padding-top: 1%;">
    <input style="background-color: #8C7462; color: #3F2A1D; " type="submit" class="btn" value="Search" name="search">
    <input style="background-color: #8C7462; color: #3F2A1D; " type="submit" class="btn" value="Edit" name="edit">
    <input  style="background-color: #8C7462; color: #3F2A1D; " type="submit" class="btn" value="Delete" name="del">
  </div>
</div>
  </form>


  <!--CONTENT-->
<form action="#" method="post">

  <table class="table">
  <tr><th>Id</th><th>Quote</th><th>Author</th><th>Source</th><th>Create</th></tr>

  <?php

    foreach ($rec as $row){
      $id = $row['id'];
      $q = $row['quote'];
      $a = $row['author'];
      $s = $row['source'];
      $t = $row['timestamp'];

      echo "<tr><td>$id</td>";
      echo "<td>$q</td>";
      echo "<td>$a</td>";
      echo "<td>$s</td>";
      echo "<td>$t</td>";
      echo "</tr><br>";

    }

  echo "</table>";


  ?>
</form>


    <!--JAVASCRIPT-->

    <script>
    //SIDEBAR SCRIPT ON OPEN
      function openNav() {
        document.getElementById("mySidenav").style.width = "13em";
      }

    //SIDEBAR SCRIPT ON CLOSE
      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
      </script>

  </body>
</html>
