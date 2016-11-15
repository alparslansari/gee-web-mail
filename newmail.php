<?php
session_start();


if(!isset($_SESSION['user']) || !isset($_SESSION['password']))
{
   	// unknown error!
	$myObj = new stdClass();
    $myObj->msgSize = -3;
    echo json_encode($myObj);
    exit;
}


//echo $_POST['toreceiver'];
//echo $_POST['subject'];
//echo $_POST['passphrase'];
//echo $_POST['mailcontent'];

if(isset($_POST['toreceiver']) && isset($_POST['subject']) && isset($_POST['passphrase']) && isset($_POST['mailcontent']))
{
    $opmode = "3"; // write message
    $username = $_SESSION['user'];
    $password = $_SESSION['password'];
    $receiver = $_POST['toreceiver'];
    $title = $_POST['subject'];
    $message = $_POST['mailcontent'];
    $message = str_replace("\"", "[{rdq}]", $message);
    $message = str_replace("\"", "[{rds}]", $message);
    $passphrase = $_POST['passphrase'];
    //echo "<br>";
    //echo $message;
    //  string receiver = argv[4];
    //  string title = argv[5];
    //  string message = argv[6];
    //  string passphrase = argv[7];
    //  writeMessage(username, receiver, title, message, timestamp, "0", passphrase);

    exec("./gee-mail-ws $opmode \"$username\" \"$password\" \"$receiver\" \"$title\" \"$passphrase\" \"$message\"",$out,$retv);
    //print_r($out);
    //echo "<br>".$retv;
    if($retv == 0)
       $_SESSION['msg:send'] = "Last email is successfully sent!";
   else
       $_SESSION['msg:send'] = "Email is failed to send!";
   echo "<script>window.location.replace('index.php');</script>";
    exit;
}

echo "failed!"

?>