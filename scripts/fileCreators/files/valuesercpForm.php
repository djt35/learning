
		
		
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
		    <title>valuesercp Form</title>
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
		                    <h2 style="text-align:left;">valuesercp Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  ?id  FROM  valuesercp  WHERE  ?id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="valuesercp">
					    <?php ?>
						    <button id="submitvaluesercp">Submit</button>
		
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
		
			 valuesercpPassed = $("#id").text();
		
			if ( valuesercpPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("valuesercp");
		
				valuesercpRequired = new Object;
		
				valuesercpRequired = getNamesFormElements("valuesercp");
		
				valuesercpString = '`?id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("valuesercp", valuesercpString, getNamesFormElements("valuesercp"), 1);
		
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
				    
				    $("#messageBox").text("Editing valuesercp id "+idPassed);
		
				    enableFormInputs("valuesercp");
		
				});
		
				try {
		
					$("form#valuesercp").find("button#deletevaluesercp").length();
		
				}catch(error){
		
					$("form#valuesercp").find("button").after("<button id='deletevaluesercp'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletevaluesercp (){
		
				//valuesercpPassed is the current record, some security to check its also that in the id field
		
				if (valuesercpPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this valuesercp?")) {
		
					disableFormInputs("valuesercp");
		
					var valuesercpObject = pushDataFromFormAJAX("valuesercp", "valuesercp", "?id", valuesercpPassed, "2"); //delete valuesercp
		
					valuesercpObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("valuesercp deleted");
								edit = 0;
								valuesercpPassed = null;
								window.location.href = siteRoot + "scripts/forms/valuesercpTable.php";
								//go to valuesercp list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("valuesercp");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitvaluesercpForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var valuesercpObject = pushDataFromFormAJAX("valuesercp", "valuesercp", "?id", null, "0"); //insert new object
		
					valuesercpObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New valuesercp no "+data+" created");
							edit = 1;
							$("#id").text(data);
							valuesercpPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var valuesercpObject = pushDataFromFormAJAX("valuesercp", "valuesercp", "?id", valuesercpPassed, "1"); //insert new object
		
					valuesercpObject.done(function (data){
		
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
		
					fillForm(valuesercpPassed);
		
				}else{
					
					$("#messageBox").text("New valuesercp");
					
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
		
		
				$("#content").on('click', '#submitvaluesercp', (function(event) {
			        event.preventDefault();
			        $('#valuesercp').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletevaluesercp', (function(event) {
			        event.preventDefault();
			        deletevaluesercp();
		
		
			    }));
		
				$("#valuesercp").validate({
		
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
		
			            submitvaluesercpForm();
		
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