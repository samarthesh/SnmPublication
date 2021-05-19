<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    require_once "./functions/database_functions.php";
    if(isset($_SESSION['email'])){
      $customer = getCustomerIdbyEmail($_SESSION['email']);
      $name=$customer['firstname'];
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SNM Publication</title>
    <link rel="icon" href="./bootstrap/img/logo.png" type="image/icon type">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./bootstrap/css/jumbotron.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <style>
  header {
  position: relative;
  height: 300px;
  background-color: #35404f
 
}

h1 {
  padding: 100px 0;
  font: 44px "Arial";
  text-align: center;
}

header h1 {
  color: white;
}

svg {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 100px;
}

@media (max-width: 699px) {
  .svg--lg {
    display: none;
  }
}

@media (min-width: 700px) {
  .svg--sm {
    display: none;
  }
}

nav{}
</style>
</head>
<body>
<nav style="margin:0px; color:#35404f;" class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a href="index.php">
  <img src="./bootstrap/img/logo.png" alt="logo" width="42" height="42" align="left"/></a>
  <a style=" position:initial; text-align:left; left:0; margin:0;" class="navbar-brand" href="index.php">SNM Publication</a>
                <form  method="post" action="search_book.php" class="col-md-6" style="margin-top:7px">
              <input type="text" class="form-control" id="inputPassword2" placeholder="Search By Keyword" name="text">
              <button type="submit" class="btn btn-primary mb-2" style="display:none"></button>
           </form>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="category_list.php"><span class="glyphicon glyphicon-list-alt"></span>Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="books.php"><span class="glyphicon glyphicon-book"></span>Books</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>My Cart</a>
      </li>
	  
	  
	                <?php 
               if(isset($_SESSION['user'])){
                echo ' <li><a href="cus_dash.php"><span class="	glyphicon glyphicon-align-justify"></span>&nbsp; Dashboard</a></li>'.' <li><a href="logout.php"><span class="	glyphicon glyphicon-log-out"></span>&nbsp; LogOut</a></li>'.'<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;'
                 .$name.
                 '</a></li>';
               }else{
                echo ' <li><a class="nav-link" href="signin.php"><span class="	glyphicon glyphicon-log-in"></span>Signin</a></li>'.'<li><a class="nav-link" href="signup.php"><span class="glyphicon glyphicon-plus-sign"></span>Signup</a></li>';
               }

              ?>
    </ul>
  </div>
</nav>


    <?php
      if(isset($title) && $title == "Index") {
    ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <header>
  <h1>WELCOME TO SNM Publication</h1>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
    <polygon class="svg--sm" fill="white" points="0,0 30,100 65,21 90,100 100,75 100,100 0,100"/>
    <polygon class="svg--lg" fill="white" points="0,0 15,100 33,21 45,100 50,75 55,100 72,20 85,100 95,50 100,80 100,100 0,100" />
  </svg>
</header>
    <!--  <div class="jumbotron" style="  background: url('./bootstrap/img/fbg.jpg') no-repeat center center;background-size: 100% 100%;;height:600px
;
  " >
      <img style="height: 400px;" src="./bootstrap/img/fbg.jpg" alt="cover page">
      <div class="container">
       <!-- <h1 style="text-align:center; margin:5% auto;">WELCOME TO RD Publication</h1>   
        <p style="text-align:center; margin:5% auto;">Here you can find your Subject Books with Easy Explaination</p>    --> 
		  </div>
		</div>
    <?php } ?>

    <div class="container" id="main">