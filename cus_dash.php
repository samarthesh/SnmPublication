<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    require_once "./functions/database_functions.php";
    	require "./template/header.php";
        $conn = db_connect();
    if(isset($_SESSION['email'])){
      $customer = getCustomerIdbyEmail($_SESSION['email']);
      $name=$customer['firstname'];
    }
?>
<div>
<?php
$id=$customer['id'];
$ret=mysqli_query($conn,"select * from purbooks where custid ='$id' AND status ='1'");
$cnt=1;
echo "<h2>YOUR PURCHASE BOOKS!</h2>";
while ($row=mysqli_fetch_array($ret)) {?>
<?php
                    $td=$row['book_title'];
                    echo "<h3>" .$td. "</h3>";
                    $dir="./bootstrap/pdf/$td/"; // Directory where files are stored

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
				}  ?>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>