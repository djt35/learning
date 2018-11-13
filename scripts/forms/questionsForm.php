
		
		
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
		    <title>questions Form</title>
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
		                    <h2 style="text-align:left;">questions Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  questions  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="questions">
					    <?php echo $formv1->generateText('id', 'id', '', 'tooltip here');
echo $formv1->generateText('text', 'text', '', 'tooltip here');
echo $formv1->generateText('type', 'type', '', 'tooltip here');
echo $formv1->generateText('choice1', 'choice1', '', 'tooltip here');
echo $formv1->generateText('choice2', 'choice2', '', 'tooltip here');
echo $formv1->generateText('choice 3', 'choice 3', '', 'tooltip here');
echo $formv1->generateText('choice4', 'choice4', '', 'tooltip here');
echo $formv1->generateText('choice5', 'choice5', '', 'tooltip here');
?>
						    <button id="submitquestions">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 questionsPassed = $("#id").text();
		
			if ( questionsPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("questions");
		
				questionsRequired = new Object;
		
				questionsRequired = getNamesFormElements("questions");
		
				questionsString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("questions", questionsString, getNamesFormElements("questions"), 1);
		
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
		
				    enableFormInputs("questions");
		
				});
		
				try {
		
					$("form#questions").find("button#deletequestions").length();
		
				}catch(error){
		
					$("form#questions").find("button").after("<button id='deletequestions'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletequestions (){
		
				//questionsPassed is the current record, some security to check its also that in the id field
		
				if (questionsPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this questions?")) {
		
					disableFormInputs("questions");
		
					var questionsObject = pushDataFromFormAJAX("questions", "questions", "id", questionsPassed, "2"); //delete questions
		
					questionsObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("questions deleted");
								edit = 0;
								questionsPassed = null;
								window.location.href = siteRoot + "scripts/forms/questionsTable.php";
								//go to questions list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("questions");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitquestionsForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var questionsObject = pushDataFromFormAJAX("questions", "questions", "id", null, "0"); //insert new object
		
					questionsObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New questions no "+data+" created");
							edit = 1;
							$("#id").text(data);
							questionsPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var questionsObject = pushDataFromFormAJAX("questions", "questions", "id", questionsPassed, "1"); //insert new object
		
					questionsObject.done(function (data){
		
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
		
					fillForm(questionsPassed);
		
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
		
		
				$("#content").on('click', '#submitquestions', (function(event) {
			        event.preventDefault();
			        $('#questions').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletequestions', (function(event) {
			        event.preventDefault();
			        deletequestions();
		
		
			    }));
		
				$("#questions").validate({
		
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
id: { required: true },   
text: { required: true },   
type: { required: true },   
choice1: { required: true },   
choice2: { required: true },   
choice 3: { required: true },   
choice4: { required: true },   
choice5: { required: true },   
},messages: {
id: { required: 'message' },   
text: { required: 'message' },   
type: { required: 'message' },   
choice1: { required: 'message' },   
choice2: { required: 'message' },   
choice 3: { required: 'message' },   
choice4: { required: 'message' },   
choice5: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitquestionsForm();
		
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