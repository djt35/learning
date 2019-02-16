
		
		
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
		    <title>learningToolTag Form</title>
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
		                    <h2 style="text-align:left;">learningToolTag Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  learningToolTag  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="learningToolTag">
					    <?php echo $formv1->generateText('learningTool_id', 'learningTool_id', '', 'tooltip here');
echo $formv1->generateText('tags_id', 'tags_id', '', 'tooltip here');
?>
						    <button id="submitlearningToolTag">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 learningToolTagPassed = $("#id").text();
		
			if ( learningToolTagPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("learningToolTag");
		
				learningToolTagRequired = new Object;
		
				learningToolTagRequired = getNamesFormElements("learningToolTag");
		
				learningToolTagString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("learningToolTag", learningToolTagString, getNamesFormElements("learningToolTag"), 1);
		
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
				    
				    $("#messageBox").text("Editing learningToolTag id "+idPassed);
		
				    enableFormInputs("learningToolTag");
		
				});
		
				try {
		
					$("form#learningToolTag").find("button#deletelearningToolTag").length();
		
				}catch(error){
		
					$("form#learningToolTag").find("button").after("<button id='deletelearningToolTag'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletelearningToolTag (){
		
				//learningToolTagPassed is the current record, some security to check its also that in the id field
		
				if (learningToolTagPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this learningToolTag?")) {
		
					disableFormInputs("learningToolTag");
		
					var learningToolTagObject = pushDataFromFormAJAX("learningToolTag", "learningToolTag", "id", learningToolTagPassed, "2"); //delete learningToolTag
		
					learningToolTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("learningToolTag deleted");
								edit = 0;
								learningToolTagPassed = null;
								window.location.href = siteRoot + "scripts/forms/learningToolTagTable.php";
								//go to learningToolTag list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("learningToolTag");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitlearningToolTagForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var learningToolTagObject = pushDataFromFormAJAX("learningToolTag", "learningToolTag", "id", null, "0"); //insert new object
		
					learningToolTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New learningToolTag no "+data+" created");
							edit = 1;
							$("#id").text(data);
							learningToolTagPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var learningToolTagObject = pushDataFromFormAJAX("learningToolTag", "learningToolTag", "id", learningToolTagPassed, "1"); //insert new object
		
					learningToolTagObject.done(function (data){
		
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
		
					fillForm(learningToolTagPassed);
		
				}else{
					
					$("#messageBox").text("New learningToolTag");
					
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
		
		
				$("#content").on('click', '#submitlearningToolTag', (function(event) {
			        event.preventDefault();
			        $('#learningToolTag').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletelearningToolTag', (function(event) {
			        event.preventDefault();
			        deletelearningToolTag();
		
		
			    }));
		
				$("#learningToolTag").validate({
		
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
learningTool_id: { required: true },   
tags_id: { required: true },   
},messages: {
learningTool_id: { required: 'message' },   
tags_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitlearningToolTagForm();
		
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