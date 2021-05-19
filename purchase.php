<?php
	session_start();
	
	require_once "./functions/database_functions.php";
	// print out header here
	$title = "Purchase";
	require "./template/header.php";
	// connect database
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$customer = getCustomerIdbyEmail($_SESSION['email']);
    ?>
	<table class="table">
		<tr>
			<th>Item</th>
			<th>Price</th>
	    	<th>Quantity</th>
	    	<th>Total</th>
	    </tr>
	    	<?php
			    foreach($_SESSION['cart'] as $isbn => $qty){
					$conn = db_connect();
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
		<tr>
			<td><?php echo $book['book_title'] . " by " . $book['book_author']; ?></td>
			<td><?php echo "INR" . $book['book_price']; ?></td>
			<td><?php echo $qty; ?></td>
			<td><?php echo "INR" . $qty * $book['book_price']; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo $_SESSION['total_items']; ?></th>
			<th><?php echo "INR" . $_SESSION['total_price']; ?></th>
		</tr>
		<tr>
			<th>Total COST</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo "INR" . ($_SESSION['total_price']); ?></th>
		</tr>
	</table>
	<br>
    <br>
	<h4 style="margin-left:-20px">Your Information</h4>
	<br>
	<form method="post" action="./pgRedirect.php" class="form-horizontal">
	<div class="form-group">
        <label for="exampleInputEmail1">Firstname</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['firstname']?>" name="firstname">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Lastname</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['lastname']?>" name="lastname">
    </div>
	    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name="mail">
    </div>
	    <div class="form-group">
        <label for="exampleInputEmail1">Phone Number</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name="phno">
    </div>

    <div class="form-group">
        <label for="inputAddress">Transaction ID</label>
        <input type="text" class="text" id="inputTID" name="tid" value="<?php echo  "RD" . rand(10000,99999999)?>" readonly >
    </div>
     <div class="form-group">
        <input type="hidden" class="form-control" aria-describedby="emailHelp" value="<?php echo $_SESSION['total_price']?>" name="total_price">
    </div>
      <div class="form-group">
        <input type="hidden" class="form-control" aria-describedby="emailHelp" value="<?php echo $customer['id']?>" name="custid">
    </div>
    <div class="form-row">
    </div>
	<br>
    <div class="form-group col-md-12" >
        <div class="form-group" >
            <div class="col-lg-10 col-lg-offset-2" style="margin-left:0px">
              	<button type="reset" class="btn btn-default">Cancel</button>
              	<button type="submit" class="btn btn-primary">Purchase</button>
            </div>
        </div>
    </form>
	<p class="lead">Please press Purchase to confirm your purchase, or Cancel  to reset the form .</p>
<?php
	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}
	if(isset($conn)){ mysqli_close($conn); }
	
?>