<?php

//registerUser.php

//error_reporting(E_ALL);

$openaccess=1;

require ('../includes/config.inc.php'); 
require (BASE_URI .'/scripts/headerScript.php');

require(BASE_URI . '/scripts/phpmailer/Exception.php');

require(BASE_URI . '/scripts/phpmailer/PHPMailer.php');

require(BASE_URI . '/scripts/phpmailer/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function Mailer ($email, $subject, $txt){
		
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 3;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'n3plcpnl0258.prod.ams3.secureserver.net';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'administrator@endoscopy.wiki';                 // SMTP username
                $mail->Password = 'Nel67fnvr2';                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('administrator@endoscopy.wiki', 'Endoscopy wiki administrator');
                
                foreach ($email as $key=>$value){
                    
                    $mail->addAddress($value);
                    
                }
                
                     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                $mail->addReplyTo('administrator@endoscopy.wiki', 'Endoscopy wiki administrator');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $txt;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
                //$this->setAccommodationUpdateDone($guestid);
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }

    
    
    
}

$general = new general;
$user = new users;

/*
function hash_password($password, $salt) {
    $salted_password = substr($password, 0, 4) . $salt . substr($password, 4);
    return hash('sha512', $salted_password);
}
*/

//print_r($_GET);

if (count($_GET) > 0){


    
	$data = $general->sanitiseGET($_GET);

    $emailaddress = $data['email'];

    if ($emailaddress){

        //echo 'Correct submission';

        //check the email address exists.

        //if so send an email to that address with the unique code in the token

        $q = "SELECT `user_id` FROM `users` WHERE `email` = '$emailaddress'";

        //echo $q;

        $result = $general->returnYesNoDBQuery($q);

        if ($result == 1){

            //send email

            $subject = "Password Reset Endoscopy Wiki";

            $txt = '<h2>Password Reset for Endoscopy Wiki</h2><br>';
	        $txt .= "<hr>";
            $txt .= "<br><br>";
            $txt .= "You recently requested a password reset email for Endoscopy wiki.";
            $txt .= "<br><br>";
            $txt .= "If it was not you who requested this reset you can safely ignore this email";
            $txt .= "<br><br>";
            $txt .= "Please click here to reset your password";

            Mailer(array(0 => 'djtate@gmail.com'), $subject, $txt);

            echo '1';

        }else{
            //echo 'user not found';
            echo '1'; //because the user should not know whether the query worked in production
        }

    }else{

        echo 'Email address not entered';

    }

    

	
	
	
	
	
	
	
	
	
	
	
	
		
	
	
	//remove the preset global variables


}else{
	
	echo 'No variables passed';
	
}

$general->endGeneral();
$user->endusers();


?>