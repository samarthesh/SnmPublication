<?php
session_start();

	require_once "./functions/database_functions.php";
	// print out header here
	$title = "Purchase Process";
	require "./template/header.php";
	// connect database
	$conn = db_connect();

		$firstname = trim($_POST['firstname']);
		$firstname = mysqli_real_escape_string($conn, $firstname);
		
		$lastname = trim($_POST['lastname']);
		$lastname = mysqli_real_escape_string($conn, $lastname);
		
		$mail = trim($_POST['mail']);
		$mail = mysqli_real_escape_string($conn, $mail);
		
		$phno = trim($_POST['phno']);
		$phno = mysqli_real_escape_string($conn, $phno);
		
		$name = $firstname.$lastname;
        $price = trim($_SESSION['total_price']);
		$price = mysqli_real_escape_string($conn, $price);
	
		
		$tid = trim(trim($_POST['tid']));
		$address = mysqli_real_escape_string($conn, $tid);
		
		$date = date("Y-m-d H:i:s");
	// find customer
	$customer = getCustomerIdbyEmail($_SESSION['email']);
	$id=$customer['id'];
	$query="INSERT INTO purchase(custid,name,Email,tid,PurDate,PhoneNumber,price,Status) VALUES('$id','$name','$mail', '$tid','$date','$phno','$price','1')";
	$result = mysqli_query($conn, $query);
	if(!$result){
			echo "Insert value false!" . mysqli_error($conn);
			exit;
		}
	// insertIntoOrder($conn, $customer['id'], $_SESSION['total_price'],$date);
	insertIntoCart($conn, $customer['id'],$date);

	// take orderid from order to insert order items
	// $orderid = getOrderId($conn, $customer['id']);
	$Cartid = getCartId($conn, $customer['id']);
	
	$ret=mysqli_query($conn,"select pbid from purchase where tid ='$tid'");
	$rer = mysqli_fetch_assoc($ret);
	$rare= $rer['pbid'];	
	foreach($_SESSION['cart'] as $isbn => $qty)
{
		$book_title = getbooktitle($isbn);
		$query = "INSERT INTO purbooks (book_title,purbookid,custid,tid,Status) VALUES 
		('$book_title', '$rare','$id','$tid','1')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert value false!" . mysqli_error($conn);
			exit;
		}
	}

	unset($_SESSION['cart']);
	unset($_SESSION['total_items']);
	header("Location: ./cus_dash.php"); 
exit();

?>
