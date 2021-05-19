<?php
  session_start();
  $count = 0;
  // connecto database
  
  $title = "Index";
  require_once "./template/header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4LatestBook($conn);
?> 
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <br/> <br/>
      <p class="lead text-center text-muted">OUR MOST POPULAR BOOKS</p>
      <br><br>
      <div class="row">
        <?php foreach($row as $book) { ?>
      	<div class="col-md-3">
      		<a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
           <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
          </a>
          		                <table>
                <tr>
                  <td><strong>  <?php echo $book['book_title']; ?></strong></td>
                </tr>
                <tr>
                <td> <?php echo $book['book_author']; ?></td>
                </tr>
                <tr>
                <td><strong>INR <?php echo $book['book_price'];?></strong>  </td>
                </tr>
              </table>
      	</div>
        <?php } ?>
      </div>
<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>