
		
		
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
		    <title>pagelayoutercppatient Form</title>
		</head>
		
		<?php
		include($root . "/scripts/logobar.php");
		
		include($root . "/includes/naviCreator.php");
		?>
		
		<body>
		
			<div id="id" style="display:none;"><?php if ($id){echo $id;}?></div>
		
		    <div id='content' class='content'>
		
		        <div class='responsiveContainer white'>
		
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">pagelayoutercppatient Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  pagelayoutercppatient  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="pagelayoutercppatient">
					    <?php ?>
						    <button id="submitpagelayoutercppatient">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 pagelayoutercppatientPassed = $("#id").text();
		
			if ( pagelayoutercppatientPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("pagelayoutercppatient");
		
				pagelayoutercppatientRequired = new Object;
		
				pagelayoutercppatientRequired = getNamesFormElements("pagelayoutercppatient");
		
				pagelayoutercppatientString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("pagelayoutercppatient", pagelayoutercppatientString, getNamesFormElements("pagelayoutercppatient"), 1);
		
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
				    
				    $("#messageBox").text("Editing pagelayoutercppatient id "+idPassed);
		
				    enableFormInputs("pagelayoutercppatient");
		
				});
		
				try {
		
					$("form#pagelayoutercppatient").find("button#deletepagelayoutercppatient").length();
		
				}catch(error){
		
					$("form#pagelayoutercppatient").find("button").after("<button id='deletepagelayoutercppatient'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletepagelayoutercppatient (){
		
				//pagelayoutercppatientPassed is the current record, some security to check its also that in the id field
		
				if (pagelayoutercppatientPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this pagelayoutercppatient?")) {
		
					disableFormInputs("pagelayoutercppatient");
		
					var pagelayoutercppatientObject = pushDataFromFormAJAX("pagelayoutercppatient", "pagelayoutercppatient", "id", pagelayoutercppatientPassed, "2"); //delete pagelayoutercppatient
		
					pagelayoutercppatientObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("pagelayoutercppatient deleted");
								edit = 0;
								pagelayoutercppatientPassed = null;
								window.location.href = siteRoot + "scripts/forms/pagelayoutercppatientTable.php";
								//go to pagelayoutercppatient list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("pagelayoutercppatient");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitpagelayoutercppatientForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var pagelayoutercppatientObject = pushDataFromFormAJAX("pagelayoutercppatient", "pagelayoutercppatient", "id", null, "0"); //insert new object
		
					pagelayoutercppatientObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New pagelayoutercppatient no "+data+" created");
							edit = 1;
							$("#id").text(data);
							pagelayoutercppatientPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var pagelayoutercppatientObject = pushDataFromFormAJAX("pagelayoutercppatient", "pagelayoutercppatient", "id", pagelayoutercppatientPassed, "1"); //insert new object
		
					pagelayoutercppatientObject.done(function (data){
		
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
		
					fillForm(pagelayoutercppatientPassed);
		
				}else{
					
					$("#messageBox").text("New pagelayoutercppatient");
					
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
		
		
				$("#content").on('click', '#submitpagelayoutercppatient', (function(event) {
			        event.preventDefault();
			        $('#pagelayoutercppatient').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletepagelayoutercppatient', (function(event) {
			        event.preventDefault();
			        deletepagelayoutercppatient();
		
		
			    }));
		
				$("#pagelayoutercppatient").validate({
		
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
		
			            submitpagelayoutercppatientForm();
		
			          	console.log("submitted form");
		
		
		
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