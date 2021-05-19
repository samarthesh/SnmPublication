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
	
if(isset($_POST['submit']))
  {
    $cid=$_GET['viewid'];
      $remark=$_POST['remark'];
      $status=$_POST['status'];
     
    
     
   $query=mysqli_query($conn,"update purchase set Remark='$remark',Status='$status' where pbid='$cid'");
   
   $query1=mysqli_query($conn,"update purbooks set status='$status' where purbookid='$cid'");

    if ($query and $query1) {
    $msg="All remark has been updated.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

  
}
?>	
	<div>
	<a href="admin_signout.php" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span>&nbsp;Logout</a>
	<a href="admin_book.php" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span>&nbsp;Books</a>
	<a href="admin_publishers.php" class="btn btn-primary"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Publishers</a>
	<a href="admin_categories.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Categories</a>
	<a href="admin_all_purchase.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;All Purchase</a>
	<a href="admin_acce_purchase.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Accepted Purchase</a>
	<a href="admin_rej_purchase.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Rejected Purchase</a>
<?php
	if (isset($_SESSION['manager']) && $_SESSION['manager']==true){
		echo '<a class="btn btn-primary" href="admin_add.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Book</a>';
	}
	?>
	</div>


<div class="table-responsive bs-example widget-shadow">

						<h4>View Purchase:</h4>
						<?php
$cid=$_GET['viewid'];
$ret=mysqli_query($conn,"select * from purchase where pbid ='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
						<table class="table table-bordered">
							<tr>
    <th>Purchase Date</th>
    <td><?php  echo $row['PurDate'];?></td>
  </tr>
  <tr>
<th>Name</th>
    <td><?php  echo  $row['Name'];?></td>
  </tr>

<tr>
    <th>Email</th>
    <td><?php  echo $row['Email'];?></td>
  </tr>
   <tr>
    <th>Mobile Number</th>
    <td><?php  echo $row['PhoneNumber'];?></td>
  </tr>
   <tr>
  
  <tr>
    <th>Books</th>
    <td><?php $book = getBookName($conn,$row['pbid']);
	foreach($book as $books){?>
		<?php 
		$arraydata = implode(',',(array)$books);
		echo $arraydata;} ?></td>
  </tr>
  <tr>
    <th>Apply Date</th>
    <td><?php echo $row['PurDate'];?></td>
  </tr>
  <tr>
    <th>Transaction Number</th>
    <td><?php echo $row['tid'];?></td>
  </tr>
  <tr>
    <th>Total Price</th>
    <td><?php echo $row['price'];?></td>
</tr> 

<tr>
    <th>Status</th>
    <td> <?php  
if($row['Status']=="1")
{
  echo "Approved";
}

if($row['Status']=="2")
{
  echo "Rejected";
}

     ;?></td>
  </tr>
						</table>
						<table class="table table-bordered">
							<?php if($row['Remark']==""){ ?>


<form name="submit" method="post" enctype="multipart/form-data"> 

<tr>
    <th>Remark :</th>
    <td>
    <textarea name="remark" placeholder="" rows="2" cols="14" class="form-control wd-450" required="true"></textarea></td>
   </tr>

  <tr>
    <th>Status :</th>
    <td>
   <select name="status" class="form-control wd-450" required="true" >
     <option value="1" Approved="true">Approved</option>
     <option value="2">Rejected</option>
   </select></td>
  </tr>

  <tr align="center">
    <td colspan="2"><button type="submit" name="submit" class="btn btn-az-primary pd-x-20">Submit</button></td>
  </tr>
  </form>
<?php } else { ?>
						</table>
						<table class="table table-bordered">
							<tr>
    <th>Remark</th>
    <td><?php echo $row['Remark']; ?></td>
  </tr>


<tr>
<th>Remark date</th>
<td><?php echo $row['RemarkDate']; ?>  </td></tr>

						</table>
						<?php } ?>
						<?php } ?>
					</div>


<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>