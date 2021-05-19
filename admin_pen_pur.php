<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "List book";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getAll($conn);
?>	
	<div>
	<a href="admin_signout.php" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span>&nbsp;Logout</a>
	<a href="admin_book.php" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span>&nbsp;Books</a>
	<a href="admin_publishers.php" class="btn btn-primary"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Publishers</a>
	<a href="admin_categories.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Categories</a>
	<a href="admin_all_purchase.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;All Purchase</a>
	<a href="admin_acce_purchase.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Accepted Purchase</a>
	<a href="admin_rej_purchase.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Rejected Purchase</a>
    	<a href="admin_pen_pur.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Pending Checking</a>

<?php
	if (isset($_SESSION['manager']) && $_SESSION['manager']==true){
		echo '<a class="btn btn-primary" href="admin_add.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Book</a>';
	}
	?>
	</div>
	
	<div class="table-responsive bs-example widget-shadow">
						<h4>Pending Purchase:</h4>
						<table class="table table-bordered"> <thead> <tr> <th>#</th> <th> Purchase Date</th> <th>Name</th><th>Mobile Number</th><th>Action</th> </tr> </thead> <tbody>
<?php
$ret=mysqli_query($conn,"select *from  purchase where Status IS NULL OR Status = ''");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

						 <tr> <th scope="row"><?php echo $cnt;?></th> <td><?php  echo $row['PurDate'];?></td> <td><?php  echo $row['Name'];?></td><td><?php  echo $row['PhoneNumber'];?></td><td><a href="view_purchase.php?viewid=<?php echo $row['pbid'];?>">View</a></td> </tr>   <?php 
$cnt=$cnt+1;
}?></tbody> </table> 
					</div>
					
					
					<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>