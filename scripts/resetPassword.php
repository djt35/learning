<?php

//registerUser.php

//error_reporting(E_ALL);


$tokenaccess = 1;
//$openaccess= 1;



require ('../includes/config.inc.php'); 
require (BASE_URI .'/scripts/headerCreator.php');

if ($token){

    //echo 'access granted via token' . $token;
    if (isset($userid)){

        //echo 'userid = ' . $userid;

    }

    //NOW ECHO FORM
}

$general = new general;
$formv1 = new formGenerator;

//!change title

$page_title = 'Change Password for EndoWiki';

// Include the header file:
include(BASE_URI . "/scripts/logobar.php");
		
include(BASE_URI . "/includes/naviv1.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
<head>
    <title></title>
</head>

<body>
	
	<div id='userid' style='display:none;'><?php if ($userid){echo $userid;}?>
    </div>
    <div id='token' style='display:none;'><?php if ($token){echo $token;}?>
    
    </div>
	
    <div id="content" class="content">
	    
        <div class="responsiveContainer white">
	        
	        <div class="row" style='text-align:left;'>

                <div class = "col-6">

                   

                  <p>  Welcome <?php echo $general->getUserName($userid);?> </p>

                  <p>  Please enter a new password below.  This link only works once </p>

                  <form id='newPassword'>
                  
                  <?php
                  echo '<fieldset>';
                  echo $formv1->generatePassword('New Password', 'password', '', 'enter your new password');
                  echo $formv1->generatePassword('New Password again', 'confirm', '', 'enter your new password');
                 
                  echo '</fieldset>';
                  echo '<br><br>';
                    ?>

                <button type="button" id="submitNewPasswordForm">Submit</button>

                  </form>

                </div>

            </div>

        </div>

    </div>

<script>

switch (document.location.hostname)
{
        case 'www.endoscopy.wiki':
                          
                         var rootFolder = 'http://www.endoscopy.wiki/'; break;
        case 'localhost' :
                           var rootFolder = 'http://localhost:90/dashboard/learning/'; break;
        default :  // set whatever you want
}

var siteRoot = rootFolder;

function submitPasswordUpdate(){

    //update the password and issue new token

    var password = $('#password').val();

    var confirm = $('#confirm').val();

    var userid = $('#userid').text();

    var token = $('#token').text();

    var data = "&password="+password+"&confirm="+confirm+"&userid="+userid+"&token="+token;

    console.log(data); 

    var usersObject = $.ajax({
				url: siteRoot+"scripts/updatePassword.php",
				type: "get",
				data: "&password="+password+"&confirm="+confirm+"&userid="+userid+"&token="+token  	 		
			}); //insert new object
		
					usersObject.done(function (data){
		
						console.log(data);
		
						if (data == 1){
		
							alert ("Your password has been changed.  Please login again");
							header(siteRoot + "index.php");
		
		
		
		
						}else {
		
							alert("Failed, try again");
		
						}
		
		
					});




}

		
$(document).ready(function() {

     var titleGraphic = $(".title").height();
var titleBar = $("#menu").height();
$(".title").css('height', (titleBar));


$(window).resize(function() {
    waitForFinalEvent(function() {
        //alert("Resize...");
        var titleGraphic = $(".title").height();
        var titleBar = $("#menu").height();
        $(".title").css('height', (titleBar));

    }, 100, 'Resize header');
});

$("#content").on('click', '#submitNewPasswordForm', (function(event) {
			        event.preventDefault();
			        $('#newPassword').submit();
		
		
			    }));


})

$("#newPassword").validate({
		
        invalidHandler: function(event, validator) {
            var errors = validator.numberOfInvalids();
            console.log("there were " + errors + "errors");
            if (errors) {
                var message = errors == 1 ?
                    "You missed 1 field. It has been highlighted" :
                    "You missed " + errors + " fields. They have been highlighted";
                $('div.error span').html(message);
                $('div.error').show();
            } else {
                $('div.error').hide();
            }
        },rules: {


            password: { minlength : 8, required: true },   
			confirm : {
                    minlength : 8,
                    equalTo : "#password"
                },



},messages: {

    password: { minlength: 'Password must be 8 or more characters', required: 'Please enter a password' },   
			confirm: {minlength: 'Password must be 8 or more characters', equalTo: 'Passwords do not match'},
			


},
        submitHandler: function(form) {

            submitPasswordUpdate();

              console.log("User form submitted");



    }




});
</script>    


<?php

// Include the footer file to complete the template:
include(BASE_URI .'/includes/footer.html');




?>

</body>

</head>

</html>