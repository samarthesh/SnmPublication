<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php">RD Publication</a>
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
        <a class="nav-link" href="category_list.php">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Books.php">&nbsp; Books</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">&nbsp; My Cart</a>
      </li>
	  
	  
	                <?php 
               if(isset($_SESSION['user'])){
                 echo ' <li><a class="nav-link" href="logout.php">&nbsp; LogOut</a></li>'.'<li><a class="nav-link" href="profile.php">&nbsp;'
                 .$name.
                 '</a></li>';
               }else{
                echo ' <li><a class="nav-link" href="signin.php">&nbsp; Signin</a></li>'.'<li><a class="nav-link" href="signup.php">&nbsp;Sign up</a></li>';
               }

              ?>
    </ul>
  </div>
</nav>

</body>
</html>