
		
		
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
		    <title>referencesTag Form</title>
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
		                    <h2 style="text-align:left;">referencesTag Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tablereferencesTag" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/referencesTagTable.php';">Table of referencesTag</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `referencesTag`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="referencesTag">
					    <?php echo $formv1->generateText('references_id', 'references_id', '', 'tooltip here');
echo $formv1->generateText('tag_id', 'tag_id', '', 'tooltip here');
?>
						    <button id="submitreferencesTag">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 referencesTagPassed = $("#id").text();
		
			if ( referencesTagPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("referencesTag");
		
				referencesTagRequired = new Object;
		
				referencesTagRequired = getNamesFormElements("referencesTag");
		
				referencesTagString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("referencesTag", referencesTagString, getNamesFormElements("referencesTag"), 1);
		
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
				    
				    $("#messageBox").append("Editing referencesTag id "+idPassed);
		
				    enableFormInputs("referencesTag");
		
				});
		
				try {
		
					$("form#referencesTag").find("button#deletereferencesTag").length();
		
				}catch(error){
		
					$("form#referencesTag").find("button").after("<button id='deletereferencesTag'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletereferencesTag (){
		
				//referencesTagPassed is the current record, some security to check its also that in the id field
		
				if (referencesTagPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this referencesTag?")) {
		
					disableFormInputs("referencesTag");
		
					var referencesTagObject = pushDataFromFormAJAX("referencesTag", "referencesTag", "id", referencesTagPassed, "2"); //delete referencesTag
		
					referencesTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("referencesTag deleted");
								edit = 0;
								referencesTagPassed = null;
								window.location.href = siteRoot + "scripts/forms/referencesTagTable.php";
								//go to referencesTag list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("referencesTag");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitreferencesTagForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var referencesTagObject = pushDataFromFormAJAX("referencesTag", "referencesTag", "id", null, "0"); //insert new object
		
					referencesTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New referencesTag no "+data+" created");
							edit = 1;
							$("#id").text(data);
							referencesTagPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var referencesTagObject = pushDataFromFormAJAX("referencesTag", "referencesTag", "id", referencesTagPassed, "1"); //insert new object
		
					referencesTagObject.done(function (data){
		
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
		
					fillForm(referencesTagPassed);
		
				}else{
					
					$("#messageBox").append("New referencesTag");
					
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
		
		
				$("#content").on('click', '#submitreferencesTag', (function(event) {
			        event.preventDefault();
			        $('#referencesTag').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletereferencesTag', (function(event) {
			        event.preventDefault();
			        deletereferencesTag();
		
		
			    }));
		
				$("#referencesTag").validate({
		
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
references_id: { required: true },   
tag_id: { required: true },   
},messages: {
references_id: { required: 'message' },   
tag_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitreferencesTagForm();
		
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