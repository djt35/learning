
		
		
			<?php
			require ('../../includes/config.inc.php');
			require (BASE_URI . '/scripts/headerCreator.php');
		
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
		    <title>values Form</title>
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
		                    <h2 style="text-align:left;">values Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tablevalues" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/valuesTable.php';">Table of values</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `values`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="values">
					    <?php echo $formv1->generateText('Yes_No', 'Yes_No', '', 'tooltip here');
echo $formv1->generateText('Yes_No_t', 'Yes_No_t', '', 'tooltip here');
echo $formv1->generateText('specialistInterest', 'specialistInterest', '', 'tooltip here');
echo $formv1->generateText('specialistInterest_t', 'specialistInterest_t', '', 'tooltip here');
echo $formv1->generateText('emailPreferences', 'emailPreferences', '', 'tooltip here');
echo $formv1->generateText('emailPreferences_t', 'emailPreferences_t', '', 'tooltip here');
echo $formv1->generateText('access_level', 'access_level', '', 'tooltip here');
echo $formv1->generateText('access_level_t', 'access_level_t', '', 'tooltip here');
?>
						    <button id="submitvalues">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 valuesPassed = $("#id").text();
		
			if ( valuesPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("values");
		
				valuesRequired = new Object;
		
				valuesRequired = getNamesFormElements("values");
		
				valuesString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("values", valuesString, getNamesFormElements("values"), 1);
		
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
				    
				    $("#messageBox").append("Editing values id "+idPassed);
		
				    enableFormInputs("values");
		
				});
		
				try {
		
					$("form#values").find("button#deletevalues").length();
		
				}catch(error){
		
					$("form#values").find("button").after("<button id='deletevalues'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletevalues (){
		
				//valuesPassed is the current record, some security to check its also that in the id field
		
				if (valuesPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this values?")) {
		
					disableFormInputs("values");
		
					var valuesObject = pushDataFromFormAJAX("values", "values", "id", valuesPassed, "2"); //delete values
		
					valuesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("values deleted");
								edit = 0;
								valuesPassed = null;
								window.location.href = siteRoot + "scripts/forms/valuesTable.php";
								//go to values list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("values");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitvaluesForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var valuesObject = pushDataFromFormAJAX("values", "values", "id", null, "0"); //insert new object
		
					valuesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New values no "+data+" created");
							edit = 1;
							$("#id").text(data);
							valuesPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var valuesObject = pushDataFromFormAJAX("values", "values", "id", valuesPassed, "1"); //insert new object
		
					valuesObject.done(function (data){
		
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
		
					fillForm(valuesPassed);
		
				}else{
					
					$("#messageBox").append("New values");
					
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
		
		
				$("#content").on('click', '#submitvalues', (function(event) {
			        event.preventDefault();
			        $('#values').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletevalues', (function(event) {
			        event.preventDefault();
			        deletevalues();
		
		
			    }));
		
				$("#values").validate({
		
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
Yes_No: { required: true },   
Yes_No_t: { required: true },   
specialistInterest: { required: true },   
specialistInterest_t: { required: true },   
emailPreferences: { required: true },   
emailPreferences_t: { required: true },   
access_level: { required: true },   
access_level_t: { required: true },   
},messages: {
Yes_No: { required: 'message' },   
Yes_No_t: { required: 'message' },   
specialistInterest: { required: 'message' },   
specialistInterest_t: { required: 'message' },   
emailPreferences: { required: 'message' },   
emailPreferences_t: { required: 'message' },   
access_level: { required: 'message' },   
access_level_t: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitvaluesForm();
		
			          	console.log("submitted form");
		
		
		
			    }
		
		
		
		
		    });
		
		})
		
			</script>
		<?php
		
		    // Include the footer file to complete the template:
		    include(BASE_URI ."/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>