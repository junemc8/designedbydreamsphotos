<?php
/*
  This program will capture customer contact information submitted in form

*/
   require 'PHPMailer-master/PHPMailer-master/PHPMailerAutoload.php';

   //Email address to receive mail
   define("RECIPIENT", "junemc888@gmail.com");
   
   //Count number of errors
   $num_errors = 0;
   
   //String that will hold error Message 
   $error_msg = "";
   
   //String that will print out success of submission for email
   $results = "Thank you, message was successfully sent";
   
   //String that will print out if mail submission fails
   $error_results = "Mailer Error: Message could not be sent.";
   
   //Set flags used for good input
   $goodFname = FALSE;
   $goodLname = FALSE;
   $goodEmail = FALSE;
   $goodPhone = FALSE;
   $goodMessage = FALSE;
   
   //Validate data has been entered
   if (isset($_POST['phone']) && !empty($_POST["phone"])){ //Non-empty string.
     if (preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", trim($_POST["phone"]))){  //Data is in correct format 
     
       $phone = trim($_POST["phone"]);
       $goodPhone = TRUE;
    }
    else { //Incorrect format
  	     $error_msg .= "*Incorrect format for phone number<br />";
  	     $num_errors++; 
    }
    
  }
 
  if (isset($_POST['email']) && !empty($_POST["email"])) { //Non-empty string 
     //Verify alpha characters
     $email = trim($_POST["email"]);
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $error_msg .= "Invalid email format";
         $num_errors++; 
    }
    else
    {
		$goodEmail = TRUE;
	}
    
		 
  }
  else {//Empty string
  	$error_msg .= "*Please enter an email address<br />";
  	$num_errors++; 
  }
  //Check for empty string
  if (isset($_POST['fname']) && !empty(trim($_POST["fname"]))) { //Non-empty string
      //Verify alpha characters
      if (ctype_alpha(trim($_POST["fname"])))
      {
	  	$fname = trim($_POST["fname"]);
	  	$goodFname = TRUE;
	  }
	  else
	  {
	  	
	  	$error_msg .= "*First name can only contain alpha characters<br />";
	  	$num_errors++;
	  }
   
 
  }
  else {//Empty string
  	$error_msg .= "*Please enter your first name<br />";
  	$num_errors++; 
  }
    
  if (isset($_POST['lname'])&& !empty(trim($_POST["lname"]))) { //Non-empty string
      //Verify alpha characters
      if (ctype_alpha(trim($_POST["lname"])))
      {
	  	$lname = trim($_POST["lname"]);
	  	$goodLname = TRUE;
	  }
	  else
	  {
	  	
	  	$error_msg .= "*Last name can only contain alpha characters<br />";
	  	$num_errors++;
	  }
  }
  else {//Empty string
  	$error_msg .= "*Please enter your last name<br />";
  	$num_errors++; 
  }
  
  if (isset($_POST['message'])&& !empty($_POST["message"])) { //Non-empty string
   $message = trim($_POST["message"]);
   $goodMessage = TRUE;
  }
  else {
  	$error_msg .= "*Please enter message<br />";
  	$num_errors++; 
  }
  
  if ($num_errors == 0)
  {
	$mail = new PHPMailer;

    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'sendfromPHPmailer.photos@gmail.com';              // SMTP username
    $mail->Password = 'Bunn!ee1';                       // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom($email, $fname . ' ' . $lname);   // Get email address and name from form
    $mail->addAddress('june_mc@hotmail.com', 'June McClanahan');     // Add a recipient

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Customer Contact';
    $mail->Body    = '<b>Customer contact info: ' . $fname . ' ' . $lname . '</br>' .
      $phone . '</br>' . $email . '</br>' .	'Comments: ' . $message . '</b>';
    $mail->AltBody = 'Customer contact info: ' . $fname . ' ' . $lname . '\n' .
      $phone . '\n' . $email . '\n' . 'Customer commented: ' . $message;
	if(!$mail->send()){
		
	  //Print failure response
  	  $html = <<<HTML
  	    <!DOCTYPE html>
      <html lang="en">

  	  <head>
        <title>Contact Us</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="contact.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      </head>
  
      <body>
      <div id="success"><div class="alert alert-danger">
      
HTML;
		
		
      $html .= "<strong>" . $error_results . "</strong></br>" . $mail->ErrorInfo; ;
  	
  	    $html .= <<<HTML
           </div>
        
           <div class="col-sm-4 col-sm-offset-2">
		               <a href="./index.html" id="homebtn" class="btn btn-default btn-md" role="button">Home</a>
	       </div>
	      </div>
    
         
      </body>

      </html>
       
HTML;
   echo $html;
	 		
	}else
	{
  	  //Print success response
  	  $html = <<<HTML
  	    <!DOCTYPE html>
      <html lang="en">

  	  <head>
        <title>Contact Us</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="contact.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      </head>
  
      <body>
      <div id="success"><div class="alert alert-success">
      
HTML;
  	  $html .= "<strong>" . $results . "</strong>";
  	
  	  $html .= <<<HTML
           </div>
        
           <div class="col-sm-4 col-sm-offset-2">
		               <a href="./index.html" id="homebtn" class="btn btn-default btn-md" role="button">Home</a>
	       </div>
	      </div>
    
         
      </body>

      </html>
       
HTML;

      echo $html;
	}      
  }
  else{
  	  	
  	//Print form
  	$html = <<<HTML
  	  <!DOCTYPE html>
    <html lang="en">

  	<head>
  <title>Contact Us</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="contact.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  
  <body>
    <div class="alert alert-warning">
      
HTML;

$html .= "<h5 id=\"dataAlert\">Error(s) with the following data. Please fix and resubmit. </h5><br /><div id=\"errorBlock\">" . $error_msg;

$html .= <<<HTML
         </div>
        </div>
       <div class="container">
           <h2>Contact Us</h2>
           <div id='formBorder'>
       
           <form class="form-horizontal" role="form" method="post" action="contactus.php">
              <div class="form-group">
		           <label for="fname" class="col-sm-2 control-label">First Name<span class="required">*</span></label>
		           <div class="col-sm-3">
			          <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required="required" data-error="First name is required."
HTML;

if ($goodFname == TRUE)
{
	$html .=  "value=\"$fname\"\>";
}
else
{
	$html .=  "value=\"\"\>";
}

$html .= <<<HTML
	
			          <div class="help-block with-errors"></div>
		           </div>
	          </div>
	          <div class="form-group">
		           <label for="lname" class="col-sm-2 control-label">Last Name<span class="required">*</span></label>
		           <div class="col-sm-3">
			          <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required="required" data-error="Last name is required."
HTML;

if ($goodLname == TRUE)
{
	$html .=  "value=\"$lname\"\>";
}
else
{
	$html .=  "value=\"\"\>";
}

$html .= <<<HTML
			        <div class="help-block with-errors"></div>
		           </div>
	          </div>
	          <div class="form-group">
		           <label for="phone" class="col-sm-2 control-label">Phone Number</label>
		           <div class="col-sm-3">
			          <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" 
HTML;

if ($goodPhone == TRUE)
{
	$html .=  "value=\"$phone\"\>";
}
else
{
	$html .=  "value=\"\"\>";
	
}
$html .= <<<HTML
		           </div>
		           <div id="phoneFormat">e.g. 555-555-5555</div>
	          </div>
	          <div class="form-group">
		           <label for="email" class="col-sm-2 control-label">Email<span class="required">*</span></label>
		           <div class="col-sm-3">
			          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email Address" required="required" data-error="Email address is invalid."
HTML;

if ($goodEmail == TRUE)
{
	$html .=  "value=\"$email\"\>";
}
else
{
	$html .=  "value=\"\"\>";
}

$html .= <<<HTML
			          <div class="help-block with-errors"></div>
		           </div>
		        </div>
		        <div class="form-group">
		             <label for="message" class="col-sm-2 control-label">Message<span class="required">*</span></label>
		             <div class="col-sm-4">
			            <textarea class="form-control" rows="12" name="message" required="required" data-error="Message is required.">
HTML;

if ($goodMessage == TRUE)
{
	$html .=  $message;
}
else
{
	$html .=  "";
}
 
$html .= <<<HTML
       </textarea>
		                <div class="help-block with-errors"></div>
		             </div>
	            </div>
	            <div class="reqField">* denotes a required field</div>
	            <div class="form-group">
		            <div class="col-sm-2 col-sm-offset-2">
			           <input id="submit" name="submit" type="submit" value="Send Message" class="btn btn-primary">
			
		            </div>
		
	                <div class="col-sm-4 col-sm-offset-2">
		               <a href="www.designedbydreamsphotos.com" id="homebtn" class="btn btn-default btn-md" role="button">Home</a>
	                </div>
	            </div>
     
	       </form>
	       
	       <div id="camImg">
	            <img src="images/cannon2.jpg" class="img-circle" alt="Cannon Camera" width="304" height="236">
		   </div>
	
           </div>
         </div>
         
    </body>

    </html>
       
HTML;

// sometime later
echo $html;
    
    
  }
  
?>


