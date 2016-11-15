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

if(isset($_POST['passphrase']) && isset($_POST['mid']))
{
    
    $opmode = "4"; // delete message
    $username = $_SESSION['user'];
    $password = $_SESSION['password'];
    
    $passphrase = $_POST['passphrase'];
    $mid = $_POST['mid'];
    //echo $mid."<br>".$passphrase;
    //bool checkPP = checkPassphrase(messageid, passphrase);

    exec("./gee-mail-ws $opmode \"$username\" \"$password\" \"$mid\" \"$passphrase\" ",$out,$retv);
    //print_r($out);
    //echo "<br>".$retv;
    if($retv == 0)
    {
        //$_SESSION['msg:send'] = "Last email is successfully sent!";
        echo "0";
        //print_r($_POST);
    }
   else
   {
        echo "1"; // failed
   }
    exit;

}

echo "failed!";
print_r($_POST);
?>