
		
		
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
		    <title>slideQuestions Form</title>
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
		                    <h2 style="text-align:left;">slideQuestions Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tableslideQuestions" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/slideQuestionsTable.php';">Table of slideQuestions</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `slideQuestions`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="slideQuestions">
					    <?php echo $formv1->generateText('questions_id', 'questions_id', '', 'tooltip here');
echo $formv1->generateText('slide_id', 'slide_id', '', 'tooltip here');
?>
						    <button id="submitslideQuestions">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 slideQuestionsPassed = $("#id").text();
		
			if ( slideQuestionsPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("slideQuestions");
		
				slideQuestionsRequired = new Object;
		
				slideQuestionsRequired = getNamesFormElements("slideQuestions");
		
				slideQuestionsString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("slideQuestions", slideQuestionsString, getNamesFormElements("slideQuestions"), 1);
		
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
				    
				    $("#messageBox").append("Editing slideQuestions id "+idPassed);
		
				    enableFormInputs("slideQuestions");
		
				});
		
				try {
		
					$("form#slideQuestions").find("button#deleteslideQuestions").length();
		
				}catch(error){
		
					$("form#slideQuestions").find("button").after("<button id='deleteslideQuestions'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteslideQuestions (){
		
				//slideQuestionsPassed is the current record, some security to check its also that in the id field
		
				if (slideQuestionsPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this slideQuestions?")) {
		
					disableFormInputs("slideQuestions");
		
					var slideQuestionsObject = pushDataFromFormAJAX("slideQuestions", "slideQuestions", "id", slideQuestionsPassed, "2"); //delete slideQuestions
		
					slideQuestionsObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("slideQuestions deleted");
								edit = 0;
								slideQuestionsPassed = null;
								window.location.href = siteRoot + "scripts/forms/slideQuestionsTable.php";
								//go to slideQuestions list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("slideQuestions");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitslideQuestionsForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var slideQuestionsObject = pushDataFromFormAJAX("slideQuestions", "slideQuestions", "id", null, "0"); //insert new object
		
					slideQuestionsObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New slideQuestions no "+data+" created");
							edit = 1;
							$("#id").text(data);
							slideQuestionsPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var slideQuestionsObject = pushDataFromFormAJAX("slideQuestions", "slideQuestions", "id", slideQuestionsPassed, "1"); //insert new object
		
					slideQuestionsObject.done(function (data){
		
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
		
					fillForm(slideQuestionsPassed);
		
				}else{
					
					$("#messageBox").append("New slideQuestions");
					
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
		
		
				$("#content").on('click', '#submitslideQuestions', (function(event) {
			        event.preventDefault();
			        $('#slideQuestions').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteslideQuestions', (function(event) {
			        event.preventDefault();
			        deleteslideQuestions();
		
		
			    }));
		
				$("#slideQuestions").validate({
		
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
slide_id: { required: true },   
},messages: {
questions_id: { required: 'message' },   
slide_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitslideQuestionsForm();
		
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