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
			<th>ISBN</th>
			<th>Title</th>
			<th>Author</th>
			<th>Image</th>
			<th>Description</th>
			<th>Price</th>
			<th>Publisher</th>
			<th>Category</th>
			<th>Pdf</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['book_isbn']; ?></td>
			<td><?php echo $row['book_title']; ?></td>
			<td><?php echo $row['book_author']; ?></td>
			<td><?php echo $row['book_image']; ?></td>
			<td><?php echo $row['book_descr']; ?></td>
			<td><?php echo $row['book_price']; ?></td>
			<td><?php echo getPubName($conn, $row['publisherid']); ?></td>
			<td><?php echo getCatName($conn, $row['categoryid']); ?></td>
            <td>   
                 <?php
                    $td=$row['book_title'];
                    $dir="./bootstrap/pdf/$td"; // Directory where files are stored

                    if ($dir_list = opendir($dir))
                    {   
                    while(($filename = readdir($dir_list)) != false)
                    {
                         $value=$dir.'/'.$filename;
                         if(is_file($value)){
                    ?>
                            <p><a href="<?php echo $value ?>"><?php echo $filename ?></a></p>
                            <?php
                        }
                    }
                    closedir($dir_list);
                    }

?>	<?php
				if( isset($_SESSION['expert']) && $_SESSION['expert']==true){
					echo '<td><a href="admin_edit.php?bookisbn=';
					echo $row['book_isbn'];
					echo'"><span class="glyphicon glyphicon-pencil"></span>Edit</a></td>';
				}else if (isset($_SESSION['manager']) && $_SESSION['manager']==true){
                    echo '<td><a href="admin_edit.php?bookisbn=';
					echo $row['book_isbn'];
					echo'"><span class="glyphicon glyphicon-pencil"></span>Edit</a></td>';
					echo '<td><a href="admin_delete.php?bookisbn=';
					echo $row['book_isbn']; 
					echo '"><span class="glyphicon glyphicon-trash"></span>Delete</a></td>';
				}
			?>
		</tr>
		<?php } ?>
	</table>

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>