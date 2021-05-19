<?php
    session_start();
	$title = "List book";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getAll($conn);

    $customer = getCustomerIdbyEmail($_SESSION['email']);
	$cid=$customer['id'];


header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if (isset($_POST) && count($_POST)>0 )
{ 
    $tid = $_POST['ORDERID'];
    $MID = $_POST['MID'];
    $TXNID = $_POST['TXNID'];
    $TXNAMOUNT = $_POST['TXNAMOUNT'];
    $PAYMENTMODE = $_POST['PAYMENTMODE'];
    $CURRENCY = $_POST['CURRENCY'];
    $TXNDATE = $_POST['TXNDATE'];
    $STATUS = $_POST['STATUS'];
    $RESPCODE = $_POST['RESPCODE'];
    $RESPMSG = $_POST['RESPMSG'];
    $GATEWAYNAME = $_POST['GATEWAYNAME'];
    $BANKTXNID = $_POST['BANKTXNID'];
    $BANKNAME = $_POST['BANKNAME'];
    $CHECKSUMHASH =$_POST['CHECKSUMHASH'];


     $query = mysqli_query($conn,"INSERT into transaction (`ORDERID`,`MID`,`TXNID`,`TXNAMOUNT`,`PAYMENTMODE`,`CURRENCY`,`TXNDATE`,`STATUS`,`RESPCODE`,`RESPMSG`,`GATEWAYNAME`,`BANKTXNID`,`BANKNAME`,`CHECKSUMHASH`) 
    VALUES ('$tid','$MID','$TXNID','$TXNAMOUNT','$PAYMENTMODE','$CURRENCY','$TXNDATE','$STATUS','$RESPCODE','$RESPMSG','$GATEWAYNAME','$BANKTXNID','$BANKNAME','$CHECKSUMHASH')");

}


if($isValidChecksum == "TRUE") {
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
        $query=mysqli_query($conn,"update purchase set Status='1' where tid='$tid'");
        $query1=mysqli_query($conn,"update purbooks set status='1' where tid='$tid'");
        if ($query and $query1) {
        header("Location: http://rdpublication.epizy.com/");
        }
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<b>Transaction status is failure TRY AGAIN...</b>" . "<br/>";
        $query=mysqli_query($conn,"update purchase set Status='2' where tid='$tid'");
        $query1=mysqli_query($conn,"update purbooks set status='2' where tid='$tid'");
	}

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>