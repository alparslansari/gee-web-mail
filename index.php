<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GeeMail: Unbreakbale...</title>

    <!-- Bootstrap -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/jumbotron-narrow.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <style>
      .red {
        color: #d14;
      }
      </style>
  
  </head>
  <body>

      <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <?php if(isset($_SESSION['user'])) {?>
            <li role="presentation"><a href="passw.php">Password</a></li>
            <?php } ?>
            <li role="presentation"><a href="logout.php" onclick="signOut();">Logout</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">GeeMail Inc. &copy;</h3>
      </div>

<!-- Login and Registration -->
<?php if(!isset($_SESSION['user'])) {?>
  <div class="jumbotron">
    <h1>_GeeMail_</h1>
    <p class="lead">GeeMail: Next Generation Email Server!</p>
    <div class="col-lg-6">
      Sign in
      <form class="form-signin" name='signinFrm' action="index.php" method="post">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon" id="usrname" name="usrname">@</span>
            <input type="text" class="form-control" placeholder="Username" aria-describedby="usrname" id="username" name="username">
          </div>
          
          <div class="input-group">
            <span class="input-group-addon" id="psscode" name="psscode">P</span>
            <input type="password" class="form-control" placeholder="Password" aria-describedby="psscode" id="passcode" name="passcode">
          </div>
          <button class="btn btn-sm btn-success pull-right" id="signin" name="signin" value="signin" type="submit">Sign-in</button>
        </div>
      </form>
    </div>
    <div class="col-lg-6">
      Register
      <form class="form-signin" name='signupFrm' id='signupFrm' action="index.php" method="post">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">@</span>
        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" id="username1" name="username1">
      </div>
          
      <div class="input-group">
        <span class="input-group-addon" id="passcode1" name="psscode1">P</span>
        <input type="password" class="form-control" placeholder="Password" aria-describedby="psscode1" id="passcode1" name="passcode1">
      </div>
    
      <div class="input-group">
        <span class="input-group-addon" id="passcode2" name="psscode2">P</span>
        <input type="password" class="form-control" placeholder="Password - retype" aria-describedby="psscode2" id="passcode2" name="passcode2">
      </div>
      <button class="btn btn-sm btn-primary pull-right" id="signup" name="signup" value="signup" type="submit">Sign-up</button>
      
      </form>
    
    </div>
    <div class="col-lg-6 pull-right" id ="signuperr" style="display:none;">
    </div>
    
    <div class="col-lg-12"><br></div>
    <div class="col-lg-12" id="signerr" style="display:none;">        
      <div class="alert alert-danger" role="alert" >
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <h4><strong>Incorrect</strong> username or password!</h4>
      </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br>
  </div>
      
      <footer class="footer">
        <p>&copy; 2016 ASAS</p>
      </footer>
      <?php } else {
      // This is where user in SESSION -- DISPLAY TOPICS
      
      ?>
      <div class="jumbotron">
        <h1>Welcome, <?php echo $_SESSION['user']; ?>!</h1>
        <p class="lead">Mail is...loading...</p>
        <?php
        if(isset($_SESSION['msg:send']))
          echo "<p>".$_SESSION['msg:send']."</br>";

        ?>
        <!-- <h3>Message to be:</h3> -->
        <button class="pull-right add" data-target="#add" data-toggle="modal"><i class="glyphicon glyphicon-envelope"></i> New mail</button>
      </div>
      

      <div class="row marketing">
        <div class="col-lg-12">
          <h1 >Your MAIL box: </h1>
          <table id="emessages">
            <thead>
              <th></th>
              <th style="text-align: center;">From</th>
              <th style="text-align: center;">Subject</th>
              <th style="text-align: center;">Date</th>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
        

      </div>
            <footer class="footer">
        <p>&copy; 2016 ASAS</p>
      </footer>
      
        <!-- Modal -->
<div id="manage" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mail Manage:</h4>
      </div>
      <div class="modal-body">
        <p class="pmanage">...</p>
        <table>
          <tr>
            <td><b>Passphrase:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
            <td><input type="text" id="passphrase" name="passphrase" maxlength="100" size="50" autocomplete="off"></td>
          </tr>
        </table>
        <p class="acmanage">...</p>
      </div>
      <div class="modal-footer">
        <button type="submit" id="mread" name="mread" class="btn btn-primary">Read Mail <i class="glyphicon glyphicon-envelope"></i></button>
        <button type="submit" id="mdelete" name="mdelete" class="btn btn-danger" data-dismiss="modal">Delete <i class="glyphicon glyphicon-trash"></i></button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



  <!-- New mail Modal -->
<div id="add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="newmail.php" method="post" id="madd" name="madd">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New message:</h4>
      </div>
      <div class="modal-body">
        <p>Simply fill all the fields and send the mail! </p>
        <table>
          <tr>
            <td><b>To: </b></td>
            <td><input type="text" id="toreceiver" name="toreceiver" maxlength="100" size="50"></td>
          </tr>
          <tr>
            <td><b>Passphrase: </b></td>
            <td><input type="text" id="passphrase" name="passphrase" maxlength="100" size="50" autocomplete="off"></td>
          </tr>
          <tr>
            <td><b>Subject: </b></td>
            <td><input type="text" id="subject" name="subject" maxlength="100" size="50"></td>
          </tr>

        </table>
        <div>
           <textarea id="mailcontent" name="mailcontent" rows="4" cols="80"></textarea> 
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" id="badd" name="badd" class="btn btn-primary" data-dismiss="modal">Send <i class="glyphicon glyphicon-send"></i></button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>

  </div>
</div>


      
      <?php } ?>
      


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
  
    <?php if(isset($_SESSION['user'])) {?>
    <script>
    $(document).ready(function(){
      $.ajax({ url: "loader.php",
              context: document.body,
              success: function(idata){
                // check if the operation is sucesfull
                if(idata.msgSize=='-1'||idata.msgSize=='-2')
                {
                  $( ".lead" ).html( "Mail server is not stable! Please contact with administrators!!!" );
                  return;
                } else if(idata.msgSize=='-3')
                {
                   $( ".lead" ).html( "Warning!!! Unauthorize use detected! Please contact with administrators!!!" );
                   return;
                }
                $( ".lead" ).html( "You have <b>"+idata.msgSize+"</b> mails." );
                var spacer = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                for (var i = 0; i < idata.msgSize ; i++) {
                  //alert (idata.msgPayload[i].id );
                  //alert (idata.msgPayload[i].from );
                  //alert (idata.msgPayload[i].sdate );
                  //alert (idata.msgPayload[i].isRead );
                  //alert (idata.msgPayload[i].subject );
                  if(idata.msgPayload[i].isRead==0)
                  {
                    var micon = '<td><i class="glyphicon glyphicon-envelope"></i>'+spacer+'</td>';
                  } 
                  else
                  {
                    var micon = '<td><i class="glyphicon glyphicon-ok"></i>'+spacer+'</td>';
                  }
                    
                  var mfrom = "<td>"+idata.msgPayload[i].from+spacer+"</td>";
                  var msubject = "<td>"+idata.msgPayload[i].subject+spacer+"</td>";
                  var mdate = "<td>"+idata.msgPayload[i].sdate+spacer+"</td>";
                  var consele = "<tr class='clickable-row' " +
                                     "data-target='#manage' " +
                                     "data-toggle='modal' " +
                                     "data-id='"+idata.msgPayload[i].id+"'" +
                                     "data-sbj='"+idata.msgPayload[i].subject+"'" +
                                     ">"+micon+mfrom+msubject+mdate+"</tr>";
                  $('#emessages').append(consele);
                };

                // do message processing stuff
              }});

    $( "#medit" ).click(function() {
        $("#fedit" ).submit();
     });
     
     $( "#mlock" ).click(function() {
        $("#flock" ).submit();
     });
        
      $( "#mdelete" ).click(function() {
        $("#fdelete" ).submit();
      });
      
         $( "#badd" ).click(function() {
        $("#madd" ).submit();
   });


      });



$(document).on('click', '.clickable-row', function () {
    // your function here
      var mId = $(this).attr('data-id');
      var sbj = $(this).attr('data-sbj');
      $( ".pmanage" ).html( "<b>Subject: </b>"+sbj);
      $("#mdelete").attr('data-id', mId);
      $("#mread").attr('data-id', mId);
      $( ".acmanage" ).html( "" ); // celar out
      $("#passphrase").val("");

});

$(document).on('click', '#mread', function () {
    // your function here
      var mId = $(this).attr('data-id');
      var passp = $("#passphrase").val();
      var murl = "retrieve.php";
      var params = {mid:mId,passphrase:passp};
      $.ajax({ url: murl,
                 type: "POST",
                 data: params,
              context: document.body,
              success: function(rdata){
              // check if the operation is sucesfull

               $( ".acmanage" ).html( rdata );

          }});

});

$(document).on('click', '#mdelete', function () {
    // your function here
      var mId = $(this).attr('data-id');
      var passp = $("#passphrase").val();
      var murl = "delete.php";
      var params = {mid:mId,passphrase:passp};
      $.ajax({ url: murl,
                 type: "POST",
                 data: params,
              context: document.body,
              success: function(idata){
              // check if the operation is sucesfull
              if (idata==0)
              {
                alert("Last email is successfully deleted!");
                window.location.replace('index.php');
              }
              else
              {
                alert("Last email could not be deleted at this time!");
              }
          }});
});



    </script>
    
    
    <?php } else {?>
    
    
  <script>
    function signin()
    {
        document.getElementById("signerr").style.display="block";
        document.getElementById("usrname").focus();
    }
    function signup(incele)
    {
    	document.getElementById("signuperr").innerHTML= incele;
      document.getElementById("signuperr").style.display="block";
      document.getElementById("username1").focus();
    }
    
  $(document).ready(function( )
  {
    // initialize table load
       jQuery(function ($) {
       
          $("#signupFrm").validate({
           rules: {
               passcode1: { 
                 required: true,
                    minlength: 8,
                    maxlength: 90,

               }, 
               passcode2: {
                    required: true,
                    //equalTo: "#passcode1",
                    minlength: 8,
                    maxlength: 90
               }


           },
     messages:{
         passcode1: { 
                 required:"the password is required"

               },
        passcode2: { 
                 required:"the password 2 is required"
                 //,equalTo: "Passwords does not match!"
               }
     }

  });
  
       });
     


    });
  

  </script>
  
  <?php }?>
  
  <?php


if (isset($_POST['signin'])) {
    //print_r($_POST);
    $opmode = "1"; // Login operation
    $username = $_POST['username'];
	  $password = $_POST['passcode'];
    $username = str_replace("\"", "", $username);
    $username = str_replace("\"", "", $username);
    $password = str_replace("\"", "", $password);
    $password = str_replace("\"", "", $password);

	  exec("./gee-mail-ws $opmode \"$username\" \"$password\"",$out,$retv);
    if(isset($out[0])){
      // There is something in the db. The username/password match up.
       if($out[0]==100) {
          $_SESSION['user']=$username;
          $_SESSION['password']=$password;
          echo "<script>window.location.replace('index.php');</script>";
          exit;
       }
    }
    // PASSWORD IS NOT MATCHED WITH USER
    echo $out[0];
    echo "<script type=\"text/javascript\">signin();</script>";
		exit; // Stops the script with an error message.
}

if (isset($_POST['signup'])) {
  $password1 = $_POST['passcode1'];
  $password2 = $_POST['passcode2'];
  $username = $_POST['username1'];
  $errmsg = "<ul>";
  
  if ($username == "") 
  { // Checks for blanks.
    $errmsg = $errmsg."<li class='red'><strong>Username</strong> is missing!</li>";
  }

  if (strpos($username, '"') !== FALSE)
  {
   $errmsg = $errmsg."<li class='red'><strong>Username</strong> should not contain quote!</li>";
  }

if (strpos($username, '\'') !== FALSE)
  {
   $errmsg = $errmsg."<li class='red'><strong>Username</strong> should not contain single quote!</li>";
  }



    
  //password1 and password2 needs to be same! Do validation!
	if ($password1 != $password2) 
  { // Checks for pass consistency
        $errmsg .= "<li class='red'><strong>Passwords</strong> does not match!</li>";
  }
  
  // Pass leng min check
  if( strlen($password1) < 8 || strlen($password2) < 8) {
	  $errmsg .= "<li class='red'><strong>Passwords</strong> size is less than 8!</li>";
  }
  
  // Pass leng max check
  if( strlen($password1) > 250 || strlen($password2) > 250) {
    $errmsg .= "<li class='red'><strong>Passwords</strong> size is too long! Max 250</li>";
  }
  
  // To get more random pass with a good entropy
  // Should be one number
  if( !preg_match("#[0-9]+#", $password1) ) {
	  $errmsg .= "<li class='red'><strong>Password</strong> must include at least one number! </li>";
  }
  
  // Should be one letter
  if( !preg_match("#[a-z]+#", $password1) ) {
	  $errmsg .= "<li class='red'><strong>Password</strong> must include at least one letter! </li>  ";
  }

  // Should be one capital letter
  if( !preg_match("#[A-Z]+#", $password1) ) {
	  $errmsg .= "<li class='red'><strong>Password</strong> must include at least one CAPS! </li>  ";
  }

  // Should be one symbol
  if( !preg_match("#\W+#", $password1) ) {
	  $errmsg .= "<li class='red'><strong>Password</strong> must include at least one symbol! </li>  ";
  }

  
  if(strlen($errmsg) < 5)
  {
    $opmode = "0"; // Login operation
    $password = str_replace("\"", "", $password1);
    $password = str_replace("\"", "", $password);

    exec("./gee-mail-ws $opmode \"$username\" \"$password\"",$out,$retv);
    if(isset($out[0])){
      // There is something in the db. The username/password match up.
      if($out[0]==10) {
          $_SESSION['user']=$username;
          $_SESSION['password']=$password;
          echo "<script>window.location.replace('index.php');</script>";
          exit;
       }
       else if($out[0]==20)
       {
          //username exists
          $errmsg = "<li class='red'>Username is taken!</li>";
          $errmsg = $errmsg."</ul>";
       }
       else if($out[0]==30)
       {
           // password too weak
           $errmsg = "<li class='red'>Password is too weak!</li>";
           $errmsg = $errmsg."</ul>";
       }
       else
       {
           $errmsg = "<li class='red'>Error Code:".$out[0]." </li>";
           $errmsg = $errmsg."</ul>";
       }
    }
    else
    {
      $errmsg = "<li class='red'>Registration error!</li>";
      $errmsg = $errmsg."</ul>";
    }
    print_r($out);
    echo "<script type=\"text/javascript\">signup(\"$errmsg\");</script>";
    exit;
  
}
else
  {
    $errmsg = $errmsg."</ul>";
    echo "<script type=\"text/javascript\">signup(\"$errmsg\");</script>";
    exit();
  }

}
?>
    
</html>
