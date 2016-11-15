<?php
session_start();
//echo "done!";
//echo $_SESSION['user'];
//echo $_SESSION['password'];

//this part is perhaps overkill but I wanted to set the HTTP headers and status code
//making to this line means everything was great with this request
header('HTTP/1.1 200 OK');
//this lets the browser know to expect json
header('Content-Type: application/json');
//this creates json and gives it 


if(!isset($_SESSION['user']) || !isset($_SESSION['password']))
{
   	// unknown error!
	$myObj = new stdClass();
    $myObj->msgSize = -3;
    echo json_encode($myObj);
    exit;
}

$opmode = "5"; // Login operation
$username = $_SESSION['user'];
$password = $_SESSION['password'];
exec("./gee-mail-ws $opmode \"$username\" \"$password\"",$out,$retv);



if($retv==0)
{
    $myObj = new stdClass();
    $myObj->msgSize = 0;
    echo json_encode($myObj);
}
else if ($retv==1)
{
	// Successful
	// 30	asas	Mon Nov 14 02:36:57 2016	0	Selam Genc 3
	
	foreach ($out as $mail) {
		$parsed = explode("\t",$mail);
		$tmpObj = new stdClass();
		$tmpObj->id = $parsed[0];
		$tmpObj->from = $parsed[1];
		$tmpObj->sdate = $parsed[2];
		$tmpObj->isRead = $parsed[3];
		$tmpObj->subject = $parsed[4];
		$formatted[] = $tmpObj;
	}


    $myObj = new stdClass();
    $myObj->msgSize = sizeof($out);
    $myObj->msgPayload = $formatted;
    echo json_encode($myObj);

}
else if ($retv==2)
{
	$myObj = new stdClass();
    $myObj->msgSize = -1;
    echo json_encode($myObj);
}
else
{
	// unknown error!
	$myObj = new stdClass();
    $myObj->msgSize = -2;
    echo json_encode($myObj);
}
exit;
?>