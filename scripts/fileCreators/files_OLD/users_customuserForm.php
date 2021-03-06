
		
		
			<?php
		
			require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/headerCreator.php');
		
			$formv1 = new formGenerator;
			$general = new general;
			$video = new video;
			$tagCategories = new tagCategories;
		
		
		
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
		    <title>users_customuser Form</title>
		</head>
		
		<?php
		include(BASE_URI . "/scripts/logobar.php");
		
		include(BASE_URI . "/includes/naviCreator.php");
		?>
		
		<body>
		
			<div id="id" style="display:none;"><?php if ($id){echo $id;}?></div>
		
		    <div id='content' class='content'>
		
		        <div class='responsiveContainer white'>
		
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">users_customuser Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  users_customuser  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="users_customuser">
					    <?php echo $formv1->generateText('password', 'password', '', 'tooltip here');
echo $formv1->generateText('last_login', 'last_login', '', 'tooltip here');
echo $formv1->generateText('is_superuser', 'is_superuser', '', 'tooltip here');
echo $formv1->generateText('username', 'username', '', 'tooltip here');
echo $formv1->generateText('first_name', 'first_name', '', 'tooltip here');
echo $formv1->generateText('last_name', 'last_name', '', 'tooltip here');
echo $formv1->generateText('email', 'email', '', 'tooltip here');
echo $formv1->generateText('is_staff', 'is_staff', '', 'tooltip here');
echo $formv1->generateText('is_active', 'is_active', '', 'tooltip here');
echo $formv1->generateText('date_joined', 'date_joined', '', 'tooltip here');
echo $formv1->generateText('age', 'age', '', 'tooltip here');
echo $formv1->generateText('institution', 'institution', '', 'tooltip here');
?>
						    <button id="submitusers_customuser">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
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
		
			 users_customuserPassed = $("#id").text();
		
			if ( users_customuserPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("users_customuser");
		
				users_customuserRequired = new Object;
		
				users_customuserRequired = getNamesFormElements("users_customuser");
		
				users_customuserString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("users_customuser", users_customuserString, getNamesFormElements("users_customuser"), 1);
		
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
				    
				    $("#messageBox").text("Editing users_customuser id "+idPassed);
		
				    enableFormInputs("users_customuser");
		
				});
		
				try {
		
					$("form#users_customuser").find("button#deleteusers_customuser").length();
		
				}catch(error){
		
					$("form#users_customuser").find("button").after("<button id='deleteusers_customuser'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteusers_customuser (){
		
				//users_customuserPassed is the current record, some security to check its also that in the id field
		
				if (users_customuserPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this users_customuser?")) {
		
					disableFormInputs("users_customuser");
		
					var users_customuserObject = pushDataFromFormAJAX("users_customuser", "users_customuser", "id", users_customuserPassed, "2"); //delete users_customuser
		
					users_customuserObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("users_customuser deleted");
								edit = 0;
								users_customuserPassed = null;
								window.location.href = siteRoot + "scripts/forms/users_customuserTable.php";
								//go to users_customuser list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("users_customuser");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitusers_customuserForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var users_customuserObject = pushDataFromFormAJAX("users_customuser", "users_customuser", "id", null, "0"); //insert new object
		
					users_customuserObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New users_customuser no "+data+" created");
							edit = 1;
							$("#id").text(data);
							users_customuserPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var users_customuserObject = pushDataFromFormAJAX("users_customuser", "users_customuser", "id", users_customuserPassed, "1"); //insert new object
		
					users_customuserObject.done(function (data){
		
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
		
			$(document).ready(function() {
		
				if (edit == 1){
		
					fillForm(users_customuserPassed);
		
				}else{
					
					$("#messageBox").text("New users_customuser");
					
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
		
		
				$("#content").on('click', '#submitusers_customuser', (function(event) {
			        event.preventDefault();
			        $('#users_customuser').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteusers_customuser', (function(event) {
			        event.preventDefault();
			        deleteusers_customuser();
		
		
			    }));
		
				$("#users_customuser").validate({
		
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
password: { required: true },   
last_login: { required: true },   
is_superuser: { required: true },   
username: { required: true },   
first_name: { required: true },   
last_name: { required: true },   
email: { required: true },   
is_staff: { required: true },   
is_active: { required: true },   
date_joined: { required: true },   
age: { required: true },   
institution: { required: true },   
},messages: {
password: { required: 'message' },   
last_login: { required: 'message' },   
is_superuser: { required: 'message' },   
username: { required: 'message' },   
first_name: { required: 'message' },   
last_name: { required: 'message' },   
email: { required: 'message' },   
is_staff: { required: 'message' },   
is_active: { required: 'message' },   
date_joined: { required: 'message' },   
age: { required: 'message' },   
institution: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitusers_customuserForm();
		
			          	console.log("submitted form");
		
		
		
			    }
		
		
		
		
		    });
		
		})
		
			</script>
		<?php
		
		    // Include the footer file to complete the template:
		    include(BASE_URI . "/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>