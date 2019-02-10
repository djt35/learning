
		
		
			<?php
		
			$host = substr($_SERVER['HTTP_HOST'], 0, 5);
		if (in_array($host, array('local', '127.0', '192.1'))) {
		    $local = TRUE;
		} else {
		    $local = FALSE;
		}
		
		if ($local){
			
			require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/headerCreator.php');
			
			
		}else{
			
			require ($_SERVER['DOCUMENT_ROOT'].'/scripts/headerCreator.php');;
		}
		
			$formv1 = new formGenerator;
			$general = new general;
			$video = new video;
			$tagCategories = new tagCategories;
			$user = new users;
		
		
		
		foreach ($_GET as $k=>$v){
		
			$sanitised = $general->sanitiseInput($v);
			$_GET[$k] = $sanitised;
		
		
		}
		
		if (isset($_GET["id"]) && is_numeric($_GET["id"])){
			$id = $_GET["id"];
		
		}else{
		
			$id = null;
		
		}
		
		
		
		//TERMINATE THE SCRIPT IF NOT A SUPERUSER
		
		
		
		// Page content
		?>
		<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
		
		<html>
		<head>
		    <title>users Form</title>
		</head>
		
		<?php
		include($root . "/scripts/logobar.php");
		
		include($root . "/includes/naviCreator.php");
		
		if ($user->getUserAccessLevel($_SESSION['user_id']) > 1){
			
			echo '<body><div class="content">';
			
			//message to user goes here
			
			echo 'You do not have sufficient access privileges to view this page';
			echo '<br><br>';
			echo '<a href="javascript:history.back()">Go Back</a>';
			
			echo '</div></body>';
			include($root ."/includes/footer.html");
			
			exit();
			
			//redirect_login($location);
	
	
		}
		
		?>
		
		
		<body>
		
			<div id="id" style="display:none;"><?php if ($id){echo $id;}?></div>
		
		    <div id='content' class='content' style='text-align:left;'>
		
		        <div class='responsiveContainer white'>
		
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">New / Edit Endoscopy Wiki Users Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  user_id  FROM  users  WHERE  user_id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			       <div class='row'>
				       <div class='col-2'></div>
		                <div class='col-8'>
		
					    <form id="users">
					    <?php 
						    
						    
						    
$countries = array();

$q = "SELECT `CountryID`, `CountryName` FROM countries";

$result = $general->connection->RunQuery($q);

while($row = $result->fetch_array(MYSQLI_ASSOC)){
				
				$id = $row['CountryID'];
				$name = $row['CountryName'];
		
				$countries[$id] = $name;
		
		}
					
				
//echo $formv1->generateText('user_id', 'user_id', '', 'tooltip here');
echo '<fieldset>';
echo $formv1->generateText('Firstname', 'firstname', '', 'tooltip here');
echo $formv1->generateText('Surname', 'surname', '', 'tooltip here');
echo $formv1->generateText('Email Address', 'email', '', 'tooltip here');
echo $formv1->generateText('Password', 'password', '', 'tooltip here');
//echo '<button type="button" id="hash">hash</button>';
echo '</fieldset>';
echo '<br><br>';

echo '<fieldset>';
echo $formv1->generateText('Institution name', 'centreName', '', 'tooltip here');
echo $formv1->generateText('Institution City', 'centreCity', '', 'tooltip here');
echo $formv1->generateSelectCustom('Country', 'centreCountry', '', $countries, 'tooltip here');
echo $formv1->generateText('Phone number', 'contactPhone', '', 'tooltip here');

echo '</fieldset>';
echo '<br><br>';

echo '<fieldset>';
echo $formv1->generateSelect('What is your specialist interest?', 'specialistInterest', '', 'specialistInterest', 'tooltip here');
echo $formv1->generateSelect('Are you a trainee?', 'trainee', '', 'Yes_No', 'tooltip here');
echo $formv1->generateText('How many years have you practiced?', 'yearsIndependent', '', 'tooltip here');
echo $formv1->generateText('How many years have you performed endoscopy for independently?', 'yearsEndoscopy', '', 'tooltip here');
echo $formv1->generateSelect('Have you ever undertaken an endoscopy fellowship (dedicated, >6months)', 'endoscopyTrainingProgramme', '', 'Yes_No', 'tooltip here');
echo $formv1->generateSelect('Email preferences <sub>(can be changed later)</sub>', 'emailPreferences', '', 'emailPreferences', 'tooltip here');

echo '</fieldset>';
echo '<br><br>';

echo '<fieldset>';
echo $formv1->generateText('timezone', 'timezone', '', 'tooltip here');
echo $formv1->generateText('registered_date', 'registered_date', '', 'tooltip here');
echo $formv1->generateText('last_login', 'last_login', '', 'tooltip here');
echo $formv1->generateText('previous_login', 'previous_login', '', 'tooltip here');
echo $formv1->generateSelect('User access level', 'access_level', '', 'access_level', 'tooltip here');
echo $formv1->generateText('key', 'key', '', 'tooltip here');
//echo '<button type="button" id="random">random key</button><br><br>';
echo '</fieldset>';
echo '<br><br>';
?>
						    <button id="submitusers">Submit</button>
		
					    </form>
		                </div>
						<div class='col-2'></div>
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
		
			 usersPassed = $("#id").text();
		
			if ( usersPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("users");
		
				usersRequired = new Object;
		
				usersRequired = getNamesFormElements("users");
		
				usersString = '`user_id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("users", usersString, getNamesFormElements("users"), 1);
		
				//console.log(selectorObject);
		
				selectorObject.done(function (data){
		
					//console.log(data);
		
					var formData = $.parseJSON(data);
		
		
				    $(formData).each(function(i,val){
					    $.each(val,function(k,v){
					        $("#"+k).val(v);
					        //console.log(k+' : '+ v);
					    });
		
				    });
				    
				    $("#messageBox").text("Editing users id "+idPassed);
		
				    enableFormInputs("users");
		
				});
		
				try {
		
					var length = $("form#users").find("#deleteusers").length;
					if (length == 0){
							$("form#users").find("#submitusers").after("<button id='deleteusers'>Delete</button>");
							
							}
		
				}catch(error){
		
					
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteusers (){
		
				//usersPassed is the current record, some security to check its also that in the id field
		
				if (usersPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this users?")) {
		
					disableFormInputs("users");
		
					var usersObject = pushDataFromFormAJAX("users", "users", "user_id", usersPassed, "2"); //delete users
		
					usersObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("users deleted");
								edit = 0;
								usersPassed = null;
								window.location.href = siteRoot + "scripts/forms/usersTable.php";
								//go to users list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("users");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitusersForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var usersObject = pushDataFromFormAJAX("users", "users", "user_id", null, "0"); //insert new object
		
					usersObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New users no "+data+" created");
							edit = 1;
							$("#id").text(data);
							usersPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var usersObject = pushDataFromFormAJAX("users", "users", "user_id", usersPassed, "1"); //insert new object
		
					usersObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("Data updated");
								edit = 1;
		
							} else if (data == 0) {
		
							alert("No change in data detected");
		
						    } else if (data == 2) {
		
							alert("Error, try again");
		
						    }
		
		
		
						}
		
		
					});
		
		
		
		
				}
		
		
			}
			
			function hash() {
				
				//later
				
				
				
			}
		
			$(document).ready(function() {
		
				if (edit == 1){
		
					fillForm(usersPassed);
		
				}else{
					
					$("#messageBox").text("New users");
					
				}
		
				
		
			  	var titleGraphic = $(".title").height();
				var titleBar = $("#menu").height();
				$(".title").css('height',(titleBar));
		
		
				$(window).resize(function () {
			    waitForFinalEvent(function(){
			      //alert("Resize...");
			      var titleGraphic = $(".title").height();
				  var titleBar = $("#menu").height();
				  $(".title").css('height',(titleBar));
		
			    }, 100, 'Resize header');
					});
		
		
				$("#content").on('click', '#submitusers', (function(event) {
			        event.preventDefault();
			        $('#users').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteusers', (function(event) {
			        event.preventDefault();
			        deleteusers();
		
		
			    }));
		
				$("#users").validate({
		
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
   
firstname: { required: true },   
surname: { required: true },   
email: { required: true, email: true },   
password: { required: true },   
centreName: { required: true },
centreCity: { required: true },
specialistInterest: { required: true },
trainee: { required: true },
yearsIndependent: { required: true },
yearsEndoscopy: { required: true },
endoscopyTrainingProgramme : { required: true },
emailPreferences: { required: true },

access_level: { required: true },   


},messages: {
 
firstname: { required: 'Please enter your first name' },   
surname: { required: 'Please enter your surname' },   
email: { required: 'Please enter your email address', email: 'Please enter a valid email address'},   
password: { required: 'Please enter a password' },   

centreName: { required: 'Please enter the name of your institution' },
centreCity: { required: 'Please enter your institution city' },
specialistInterest: { required: 'Please select your specialist interest' },
trainee: { required: 'Are you a trainee?' },
yearsIndependent: { required: 'How many years have you been practising your specialty (incl. training)' },
yearsEndoscopy: { required: 'How many years have you been performing endoscopy?' },
endoscopyTrainingProgramme : { required: 'Required' },
emailPreferences: { required: 'Required' },

 
access_level: { required: 'Please enter user access level' },   

},
			        submitHandler: function(form) {
		
			            submitusersForm();
		
			          	console.log("User form submitted");
		
		
		
			    }
		
		
		
		
		    });
		
		})
		
			</script>
		<?php
		
		    // Include the footer file to complete the template:
		    include($root ."/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>