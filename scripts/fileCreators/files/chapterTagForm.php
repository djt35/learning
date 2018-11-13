
		
		
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
		    <title>chapterTag Form</title>
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
		                    <h2 style="text-align:left;">chapterTag Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  chapterTag  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="chapterTag">
					    <?php echo $formv1->generateText('tags_id', 'tags_id', '', 'tooltip here');
echo $formv1->generateText('chapter_id', 'chapter_id', '', 'tooltip here');
?>
						    <button id="submitchapterTag">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 chapterTagPassed = $("#id").text();
		
			if ( chapterTagPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("chapterTag");
		
				chapterTagRequired = new Object;
		
				chapterTagRequired = getNamesFormElements("chapterTag");
		
				chapterTagString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("chapterTag", chapterTagString, getNamesFormElements("chapterTag"), 1);
		
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
				    
				    $("#messageBox").text("Editing chapterTag id "+idPassed);
		
				    enableFormInputs("chapterTag");
		
				});
		
				try {
		
					$("form#chapterTag").find("button#deletechapterTag").length();
		
				}catch(error){
		
					$("form#chapterTag").find("button").after("<button id='deletechapterTag'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletechapterTag (){
		
				//chapterTagPassed is the current record, some security to check its also that in the id field
		
				if (chapterTagPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this chapterTag?")) {
		
					disableFormInputs("chapterTag");
		
					var chapterTagObject = pushDataFromFormAJAX("chapterTag", "chapterTag", "id", chapterTagPassed, "2"); //delete chapterTag
		
					chapterTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("chapterTag deleted");
								edit = 0;
								chapterTagPassed = null;
								window.location.href = siteRoot + "scripts/forms/chapterTagTable.php";
								//go to chapterTag list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("chapterTag");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitchapterTagForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var chapterTagObject = pushDataFromFormAJAX("chapterTag", "chapterTag", "id", null, "0"); //insert new object
		
					chapterTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New chapterTag no "+data+" created");
							edit = 1;
							$("#id").text(data);
							chapterTagPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var chapterTagObject = pushDataFromFormAJAX("chapterTag", "chapterTag", "id", chapterTagPassed, "1"); //insert new object
		
					chapterTagObject.done(function (data){
		
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
		
					fillForm(chapterTagPassed);
		
				}else{
					
					$("#messageBox").text("New chapterTag");
					
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
		
		
				$("#content").on('click', '#submitchapterTag', (function(event) {
			        event.preventDefault();
			        $('#chapterTag').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletechapterTag', (function(event) {
			        event.preventDefault();
			        deletechapterTag();
		
		
			    }));
		
				$("#chapterTag").validate({
		
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
tags_id: { required: true },   
chapter_id: { required: true },   
},messages: {
tags_id: { required: 'message' },   
chapter_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitchapterTagForm();
		
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