<?php

$host = substr($_SERVER['HTTP_HOST'], 0, 5);
if (in_array($host, array('local', '127.0', '192.1'))) {
    $local = TRUE;
} else {
    $local = FALSE;
}

if ($local){

    $root = $_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/';
    $roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/dashboard/learning/';
    require($_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/includes/config.inc.php');
}else{
    $root = $_SERVER['DOCUMENT_ROOT'].'/learning/';
    $roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/learning/';

    require($_SERVER['DOCUMENT_ROOT'].'/learning/includes/config.inc.php');

}
$location = $roothttp . 'elearn.php';

session_start();
if (!isset($_SESSION['user_id'])) {

    // Need the functions:
    require ($root . 'includes/login_functions.php');
    redirect_login($location);
}

?> 

<script src="<?php echo $roothttp . 'includes/generaljs.js'; ?>" type="text/javascript"></script>
<script src="<?php echo $roothttp . 'includes/jquery.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo $roothttp . 'includes/jquery-ui.js'; ?>" type="text/javascript"></script>





<?php

$formv1 = new formGenerator;
$general = new general;
$video = new video;
$tagCategories = new tagCategories;

//!change title

$page_title = 'User Editor';

// Include the header file:
include($root . '/includes/header.php');
include($root . '/includes/naviCreator.php');

foreach ($_GET as $k=>$v){
	
	$sanitised = $general->sanitiseInput($v);
	$_GET[$k] = $sanitised;
	
	
}

if (isset($_GET['id']) && is_numeric($_GET['id'])){
	$id = $_GET['id'];
	
}else{
	
	$id = null;
	
}



//TERMINATE THE SCRIPT IF NOT A SUPERUSER



// Page content
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
<head>
    <title></title>
</head>

<body>
	
	<div id='id' style='display:none;'><?php if ($id){echo $id;}?></div>
	
    <div id="content" class="content">
	    
        <div class="responsiveContainer white">
	        
	        <div class="row">
                <div class="col-9">
                    <h2 style='text-align:left;'>User Creator</h2>
                </div>

                <div id='messageBox' class="col-3 yellow-light narrow center">
                    <p></p>
                </div>
            </div>
	        
	        
	        <p><?php
		        
		        if ($id){
	
					$q = "SELECT user_id FROM users WHERE user_id = $id";
					if ($general->returnYesNoDBQuery($q) === 0){
						echo 'Passed id does not exist in the database';
						exit();
						
					}
				}
	
?></p>
	        
	        	        
	        <p>
			    
			    <form id='users'>
			    <?php
				        
				    //echo $formv1->generateText('User id:', 'user_id', '', 'tooltip here');
					echo $formv1->generateText('First Name', 'firstname', '', 'tooltip here');
					echo $formv1->generateText('Surname', 'surname', '', 'tooltip here');
					echo $formv1->generateText('Email', 'email', '', 'tooltip here');
					echo $formv1->generatePassword('Password', 'password', '', 'tooltip here');
					echo $formv1->generatePassword('Password (again)', 'password_again', '', 'tooltip here');
					//need equivalent field that is not transmitted checkPassword
					echo $formv1->generateText('Centre', 'centre', '', 'tooltip here');
					//echo $formv1->generateText('Registered', 'registered_date', '', 'tooltip here');
					//echo $formv1->generateText('text here', 'last_login', '', 'tooltip here');
					//echo $formv1->generateText('text here', 'previous_login', '', 'tooltip here');
					echo $formv1->generateText('Timezone', 'timezone', '', 'tooltip here');
					echo $formv1->generateText('Access Level', 'access_level', '', 'tooltip here');
					echo $formv1->generateText('Contact phone', 'contactPhone', '', 'tooltip here');
					echo $formv1->generateText('Key', 'key', '', 'tooltip here');
				    
				    ?>
				    <button id='submitUsers'>Submit</button>
				        
			    </form>   
			        
		        </p>
		        
		        
	        
        </div>
        
    </div>
<script>
	var siteRoot = 'http://localhost:90/dashboard/learning/';

	userPassed = $('#id').text();
	
	if (userPassed == ''){
		
		var edit = 0;
		
	}else{
		
		var edit = 1;
		
	}
	
	
    /*var availableTags = [
      "AEST",
      "GDT",
    ];*/
    

	
	function fillForm (idPassed){
	
		disableFormInputs('users');
		
		userRequired = new Object;
			
		userRequired = getNamesFormElements('users');
		
		userString = '`user_id`=\''+idPassed+'\'';
		
		//push these specific items from the array
		
		var formElements = getNamesFormElements('users');
		delete formElements[4];
		
		
		var selectorObject = getDataQuery ('users', userString, formElements, 1);
		
		//console.log(selectorObject);
		
		selectorObject.done(function (data){
			
			//console.log(data);
			
			var formData = $.parseJSON(data);
			    
			 
		    $(formData).each(function(i,val){
			    $.each(val,function(k,v){
			        $('#'+k).val(v);  
			        //console.log(k+" : "+ v);     
			    });
		        
		    });
		    
		    enableFormInputs('users');
		
		});
		
		try {
			
			$('form#users').find('button#deleteUser').length();
			
		}catch(error){
			
			$('form#users').find('button').after('<button id="deleteUser">Delete</button>');
			
		}
	
	}
	
	
	//delete behaviour
	
	function deleteUser (){
		
		//userPassed is the current user, some security to check its also that in the id field
		
		if (userPassed != $('#id').text()){
			
			return;
			
		}
		
		
		if (confirm('Do you wish to delete this user?')) {
		
			disableFormInputs('users');
			
			var userObject = pushDataFromFormAJAX('users', 'users', 'user_id', userPassed, '2'); //delete user
			
			userObject.done(function (data){
		
				//console.log(data);

				if (data){
					
					if (data == 1){
					
						alert ('User deleted');
						edit = 0;
						userPassed = null;
						window.location.href = siteRoot + 'scripts/forms/userTable.php';
						//go to user list
						
					}else {
					
					alert('Error, try again');
					
					enableFormInputs('users');
					
				    }
					
					
					
				}
	      
		
			});
		
		}
		
		
	}
	
	function submitUserForm (){
		
		//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
		if (edit == 0){
			
			var userObject = pushDataFromFormAJAX('users', 'users', 'user_id', null, '0'); //insert new object
			
			userObject.done(function (data){
		
				//console.log(data);

				if (data){
					
					alert ('New user no '+data+' created');
					edit = 1;
					$('#id').text(data);
					userPassed = data;
					fillForm(data);
					
					
					
					
				}else {
					
					alert('No data inserted, try again');
					
				}
	      
		
			});
			
		} else if (edit == 1){
			
			var userObject = pushDataFromFormAJAX('users', 'users', 'user_id', userPassed, '1'); //insert new object
			
			userObject.done(function (data){
		
				//console.log(data);

				if (data){
					
					if (data == 1){
					
						alert ('Data updated');
						edit = 1;
						
					} else if (data == 0) {
					
					alert('No change in data detected');
					
				    } else if (data == 2) {
					
					alert('Error, try again');
					
				    }
					
					
					
				}
	      
		
			});
			
			
			
			
		}
		
		
	}
	
	$(document).ready(function() {

		if (edit == 1){
		
			fillForm(userPassed);
	
		}
		
		/*$("#timezone").autocomplete({
			source: availableTags
	  	});*/

		
		$('#content').on("click", "#submitUsers", (function(event) {
	        event.preventDefault();
	        $("#users").submit();
	
	
	    }));
	    
	    $('#content').on("click", "#deleteUser", (function(event) {
	        event.preventDefault();
	        deleteUser();
	
	
	    }));
	
		$('#users').validate({
	
	        invalidHandler: function(event, validator) {
	            var errors = validator.numberOfInvalids();
	            console.log('there were ' + errors + 'errors');
	            if (errors) {
	                var message = errors == 1 ?
	                    'You missed 1 field. It has been highlighted' :
	                    'You missed ' + errors + ' fields. They have been highlighted';
	                $("div.error span").html(message);
	                $("div.error").show();
	            } else {
	                $("div.error").hide();
	            }
	        },
	        rules: {
	
	            timezone: {
	                required: true,
	            },
	            password: {
		            required: true,
		        },
		        password_again: {
				      equalTo: "#password",
				},
		            
	            
	
	        },
	        messages: {
	
	            
	            timezone: {
	                required: 'a timezone is required for the user',
	
	
	            },
	
	        },
	
	        submitHandler: function(form) {
	
	            submitUserForm();
	            
	          	console.log('submitted form');
	
	
	
	    }




    });

})

	</script>    
    
    
<?php

    // Include the footer file to complete the template:
    include($root .'/includes/footer.html');




    ?>
</body>
</html>