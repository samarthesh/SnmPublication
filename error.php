<?php
  session_start();
    require_once "./template/header.php";

?> 
 <h3>Invalid Page</h3>

<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>