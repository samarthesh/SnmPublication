<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "List category";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getAllCategories($conn);
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
	
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>Name</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['category_name']; ?></td>
			<?php
				if( isset($_SESSION['expert']) && $_SESSION['expert']==true){
					echo '<td><a href="admin_editcategories.php?catid=';
					echo $row['categoryid'];
					echo'"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a></td>';
				}else if (isset($_SESSION['manager']) && $_SESSION['manager']==true){
					echo '<td><a href="admin_deletecategories.php?catid=';
					echo $row['categoryid'];
					echo '"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</a></td>';
				}
			?>

		</tr>
		<?php } ?>
	</table>
    <?php
    if (isset($_SESSION['manager']) && $_SESSION['manager']==true){
		echo '<a class="btn btn-primary" href="admin_addcategory.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add Category</a>';
	}        
    ?>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>