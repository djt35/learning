
		
		
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
		    <title>Procedure Form</title>
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
		                    <h2 style="text-align:left;">Procedure Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  _k_procedure  FROM  Procedure  WHERE  _k_procedure  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="Procedure">
					    <?php ?>
						    <button id="submitProcedure">Submit</button>
		
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
		
			 ProcedurePassed = $("#id").text();
		
			if ( ProcedurePassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("Procedure");
		
				ProcedureRequired = new Object;
		
				ProcedureRequired = getNamesFormElements("Procedure");
		
				ProcedureString = '`_k_procedure`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("Procedure", ProcedureString, getNamesFormElements("Procedure"), 1);
		
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
				    
				    $("#messageBox").text("Editing Procedure id "+idPassed);
		
				    enableFormInputs("Procedure");
		
				});
		
				try {
		
					$("form#Procedure").find("button#deleteProcedure").length();
		
				}catch(error){
		
					$("form#Procedure").find("button").after("<button id='deleteProcedure'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteProcedure (){
		
				//ProcedurePassed is the current record, some security to check its also that in the id field
		
				if (ProcedurePassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this Procedure?")) {
		
					disableFormInputs("Procedure");
		
					var ProcedureObject = pushDataFromFormAJAX("Procedure", "Procedure", "_k_procedure", ProcedurePassed, "2"); //delete Procedure
		
					ProcedureObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("Procedure deleted");
								edit = 0;
								ProcedurePassed = null;
								window.location.href = siteRoot + "scripts/forms/ProcedureTable.php";
								//go to Procedure list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("Procedure");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitProcedureForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var ProcedureObject = pushDataFromFormAJAX("Procedure", "Procedure", "_k_procedure", null, "0"); //insert new object
		
					ProcedureObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New Procedure no "+data+" created");
							edit = 1;
							$("#id").text(data);
							ProcedurePassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var ProcedureObject = pushDataFromFormAJAX("Procedure", "Procedure", "_k_procedure", ProcedurePassed, "1"); //insert new object
		
					ProcedureObject.done(function (data){
		
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
		
					fillForm(ProcedurePassed);
		
				}else{
					
					$("#messageBox").text("New Procedure");
					
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
		
		
				$("#content").on('click', '#submitProcedure', (function(event) {
			        event.preventDefault();
			        $('#Procedure').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteProcedure', (function(event) {
			        event.preventDefault();
			        deleteProcedure();
		
		
			    }));
		
				$("#Procedure").validate({
		
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
		
			            submitProcedureForm();
		
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