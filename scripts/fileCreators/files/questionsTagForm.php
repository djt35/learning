
		
		
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
		    <title>questionsTag Form</title>
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
		                    <h2 style="text-align:left;">questionsTag Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tablequestionsTag" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/questionsTagTable.php';">Table of questionsTag</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `questionsTag`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="questionsTag">
					    <?php echo $formv1->generateText('questions_id', 'questions_id', '', 'tooltip here');
echo $formv1->generateText('tags_id', 'tags_id', '', 'tooltip here');
?>
						    <button id="submitquestionsTag">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 questionsTagPassed = $("#id").text();
		
			if ( questionsTagPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("questionsTag");
		
				questionsTagRequired = new Object;
		
				questionsTagRequired = getNamesFormElements("questionsTag");
		
				questionsTagString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("questionsTag", questionsTagString, getNamesFormElements("questionsTag"), 1);
		
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
				    
				    $("#messageBox").append("Editing questionsTag id "+idPassed);
		
				    enableFormInputs("questionsTag");
		
				});
		
				try {
		
					$("form#questionsTag").find("button#deletequestionsTag").length();
		
				}catch(error){
		
					$("form#questionsTag").find("button").after("<button id='deletequestionsTag'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletequestionsTag (){
		
				//questionsTagPassed is the current record, some security to check its also that in the id field
		
				if (questionsTagPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this questionsTag?")) {
		
					disableFormInputs("questionsTag");
		
					var questionsTagObject = pushDataFromFormAJAX("questionsTag", "questionsTag", "id", questionsTagPassed, "2"); //delete questionsTag
		
					questionsTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("questionsTag deleted");
								edit = 0;
								questionsTagPassed = null;
								window.location.href = siteRoot + "scripts/forms/questionsTagTable.php";
								//go to questionsTag list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("questionsTag");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitquestionsTagForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var questionsTagObject = pushDataFromFormAJAX("questionsTag", "questionsTag", "id", null, "0"); //insert new object
		
					questionsTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New questionsTag no "+data+" created");
							edit = 1;
							$("#id").text(data);
							questionsTagPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var questionsTagObject = pushDataFromFormAJAX("questionsTag", "questionsTag", "id", questionsTagPassed, "1"); //insert new object
		
					questionsTagObject.done(function (data){
		
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
		
					fillForm(questionsTagPassed);
		
				}else{
					
					$("#messageBox").append("New questionsTag");
					
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
		
		
				$("#content").on('click', '#submitquestionsTag', (function(event) {
			        event.preventDefault();
			        $('#questionsTag').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletequestionsTag', (function(event) {
			        event.preventDefault();
			        deletequestionsTag();
		
		
			    }));
		
				$("#questionsTag").validate({
		
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
questions_id: { required: true },   
tags_id: { required: true },   
},messages: {
questions_id: { required: 'message' },   
tags_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitquestionsTagForm();
		
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