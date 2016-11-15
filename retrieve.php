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
    
    $opmode = "2"; // delete message
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
/*
        foreach ($out as $mail) {
        $tmpObj = new stdClass();
        $tmpObj->msg = $mail;
        $formatted[] = $tmpObj;
        }


    $myObj = new stdClass();
    $myObj->msgSize = sizeof($out);
    $myObj->msgPayload = $formatted;
    echo json_encode($myObj);
    */
    $tmp = "";
    foreach ($out as $mail) {
        $tmp = $tmp.$mail."\n"."<br>";
    }
    echo $tmp;

/*
    $myObj = new stdClass();
    $myObj->msgSize = sizeof($out);
    $myObj->msgPayload = $out;
    echo json_encode($myObj);
    */
        //print_r($_POST);
    }
   else
   {
    $myObj = new stdClass();
    $myObj->msgSize = sizeof($out);
    $myObj->msgPayload = $out;
    echo json_encode($myObj);
   }
    exit;

}

echo "failed!";
print_r($_POST);
?>