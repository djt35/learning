
		
		
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
		    <title>Lesion Form</title>
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
		                    <h2 style="text-align:left;">Lesion Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  _k_lesion  FROM  Lesion  WHERE  _k_lesion  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="Lesion">
					    <?php ?>
						    <button id="submitLesion">Submit</button>
		
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
		
			 LesionPassed = $("#id").text();
		
			if ( LesionPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("Lesion");
		
				LesionRequired = new Object;
		
				LesionRequired = getNamesFormElements("Lesion");
		
				LesionString = '`_k_lesion`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("Lesion", LesionString, getNamesFormElements("Lesion"), 1);
		
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
				    
				    $("#messageBox").text("Editing Lesion id "+idPassed);
		
				    enableFormInputs("Lesion");
		
				});
		
				try {
		
					$("form#Lesion").find("button#deleteLesion").length();
		
				}catch(error){
		
					$("form#Lesion").find("button").after("<button id='deleteLesion'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteLesion (){
		
				//LesionPassed is the current record, some security to check its also that in the id field
		
				if (LesionPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this Lesion?")) {
		
					disableFormInputs("Lesion");
		
					var LesionObject = pushDataFromFormAJAX("Lesion", "Lesion", "_k_lesion", LesionPassed, "2"); //delete Lesion
		
					LesionObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("Lesion deleted");
								edit = 0;
								LesionPassed = null;
								window.location.href = siteRoot + "scripts/forms/LesionTable.php";
								//go to Lesion list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("Lesion");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitLesionForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var LesionObject = pushDataFromFormAJAX("Lesion", "Lesion", "_k_lesion", null, "0"); //insert new object
		
					LesionObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New Lesion no "+data+" created");
							edit = 1;
							$("#id").text(data);
							LesionPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var LesionObject = pushDataFromFormAJAX("Lesion", "Lesion", "_k_lesion", LesionPassed, "1"); //insert new object
		
					LesionObject.done(function (data){
		
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
		
					fillForm(LesionPassed);
		
				}else{
					
					$("#messageBox").text("New Lesion");
					
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
		
		
				$("#content").on('click', '#submitLesion', (function(event) {
			        event.preventDefault();
			        $('#Lesion').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteLesion', (function(event) {
			        event.preventDefault();
			        deleteLesion();
		
		
			    }));
		
				$("#Lesion").validate({
		
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
			        },
			        submitHandler: function(form) {
		
			            submitLesionForm();
		
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