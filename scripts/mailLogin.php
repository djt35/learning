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
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'n3plcpnl0258.prod.ams3.secureserver.net';  // Specify main and backup SMTP servers
                
                $mail->SMTPAuth = False;
                //$mail->SMTPAuth = true;
                //$mail->AuthType = 'PLAIN';                               // Enable SMTP authentication
                //$mail->Username = 'administrator@endoscopy.wiki';                 // SMTP username
                $mail->Username = 'k8qbphyrx50v@endoscopy.wiki';                 // SMTP username
                $mail->Password = 'Nel67&fnvr2';                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('administrator@endoscopy.wiki', 'Endoscopy wiki');
                
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
                return true;
                //$this->setAccommodationUpdateDone($guestid);
            } catch (Exception $e) {
                return false;
                
                //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
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

            $q = "SELECT `key` FROM `users` WHERE `email` = '$emailaddress'";

            $result = $general->connection->RunQuery($q);

            if ($result){

                while($row = $result->fetch_array(MYSQLI_ASSOC)){
    
                    $key = $row['key'];
    
    
                }
    
            }

            //get the unique code and build the link

            $subject = "Password Reset Endoscopy Wiki";

            $txt = '<h2>Password Reset for Endoscopy Wiki</h2><br>';
	        $txt .= "<hr>";
            $txt .= "<br><br>";
            $txt .= "You recently requested a password reset email for Endoscopy wiki.";
            $txt .= "<br><br>";
            $txt .= "If it was not you who requested this reset you can safely ignore this email";
            $txt .= "<br><br>";
            $txt .= "Please click <a href='" . BASE_URL . "/scripts/resetPassword.php?token=" . $key . "'>here </a>to reset your password";

            if (Mailer(array(0 => $emailaddress), $subject, $txt)){

            echo '1';
            }else{

            echo '1';    
            }

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