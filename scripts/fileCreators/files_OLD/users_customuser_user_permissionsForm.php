
		
		
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
		    <title>users_customuser_user_permissions Form</title>
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
		                    <h2 style="text-align:left;">users_customuser_user_permissions Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  users_customuser_user_permissions  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="users_customuser_user_permissions">
					    <?php echo $formv1->generateText('customuser_id', 'customuser_id', '', 'tooltip here');
echo $formv1->generateText('permission_id', 'permission_id', '', 'tooltip here');
?>
						    <button id="submitusers_customuser_user_permissions">Submit</button>
		
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
		
			 users_customuser_user_permissionsPassed = $("#id").text();
		
			if ( users_customuser_user_permissionsPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("users_customuser_user_permissions");
		
				users_customuser_user_permissionsRequired = new Object;
		
				users_customuser_user_permissionsRequired = getNamesFormElements("users_customuser_user_permissions");
		
				users_customuser_user_permissionsString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("users_customuser_user_permissions", users_customuser_user_permissionsString, getNamesFormElements("users_customuser_user_permissions"), 1);
		
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
				    
				    $("#messageBox").text("Editing users_customuser_user_permissions id "+idPassed);
		
				    enableFormInputs("users_customuser_user_permissions");
		
				});
		
				try {
		
					$("form#users_customuser_user_permissions").find("button#deleteusers_customuser_user_permissions").length();
		
				}catch(error){
		
					$("form#users_customuser_user_permissions").find("button").after("<button id='deleteusers_customuser_user_permissions'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteusers_customuser_user_permissions (){
		
				//users_customuser_user_permissionsPassed is the current record, some security to check its also that in the id field
		
				if (users_customuser_user_permissionsPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this users_customuser_user_permissions?")) {
		
					disableFormInputs("users_customuser_user_permissions");
		
					var users_customuser_user_permissionsObject = pushDataFromFormAJAX("users_customuser_user_permissions", "users_customuser_user_permissions", "id", users_customuser_user_permissionsPassed, "2"); //delete users_customuser_user_permissions
		
					users_customuser_user_permissionsObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("users_customuser_user_permissions deleted");
								edit = 0;
								users_customuser_user_permissionsPassed = null;
								window.location.href = siteRoot + "scripts/forms/users_customuser_user_permissionsTable.php";
								//go to users_customuser_user_permissions list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("users_customuser_user_permissions");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitusers_customuser_user_permissionsForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var users_customuser_user_permissionsObject = pushDataFromFormAJAX("users_customuser_user_permissions", "users_customuser_user_permissions", "id", null, "0"); //insert new object
		
					users_customuser_user_permissionsObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New users_customuser_user_permissions no "+data+" created");
							edit = 1;
							$("#id").text(data);
							users_customuser_user_permissionsPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var users_customuser_user_permissionsObject = pushDataFromFormAJAX("users_customuser_user_permissions", "users_customuser_user_permissions", "id", users_customuser_user_permissionsPassed, "1"); //insert new object
		
					users_customuser_user_permissionsObject.done(function (data){
		
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
		
					fillForm(users_customuser_user_permissionsPassed);
		
				}else{
					
					$("#messageBox").text("New users_customuser_user_permissions");
					
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
		
		
				$("#content").on('click', '#submitusers_customuser_user_permissions', (function(event) {
			        event.preventDefault();
			        $('#users_customuser_user_permissions').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteusers_customuser_user_permissions', (function(event) {
			        event.preventDefault();
			        deleteusers_customuser_user_permissions();
		
		
			    }));
		
				$("#users_customuser_user_permissions").validate({
		
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
customuser_id: { required: true },   
permission_id: { required: true },   
},messages: {
customuser_id: { required: 'message' },   
permission_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitusers_customuser_user_permissionsForm();
		
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