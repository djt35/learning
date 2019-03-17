
		
		
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
		    <title>videoTag Form</title>
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
		                    <h2 style="text-align:left;">videoTag Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tablevideoTag" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/videoTagTable.php';">Table of videoTag</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `videoTag`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="videoTag">
					    <?php echo $formv1->generateText('tags_id', 'tags_id', '', 'tooltip here');
echo $formv1->generateText('video_id', 'video_id', '', 'tooltip here');
?>
						    <button id="submitvideoTag">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 videoTagPassed = $("#id").text();
		
			if ( videoTagPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("videoTag");
		
				videoTagRequired = new Object;
		
				videoTagRequired = getNamesFormElements("videoTag");
		
				videoTagString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("videoTag", videoTagString, getNamesFormElements("videoTag"), 1);
		
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
				    
				    $("#messageBox").append("Editing videoTag id "+idPassed);
		
				    enableFormInputs("videoTag");
		
				});
		
				try {
		
					$("form#videoTag").find("button#deletevideoTag").length();
		
				}catch(error){
		
					$("form#videoTag").find("button").after("<button id='deletevideoTag'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletevideoTag (){
		
				//videoTagPassed is the current record, some security to check its also that in the id field
		
				if (videoTagPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this videoTag?")) {
		
					disableFormInputs("videoTag");
		
					var videoTagObject = pushDataFromFormAJAX("videoTag", "videoTag", "id", videoTagPassed, "2"); //delete videoTag
		
					videoTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("videoTag deleted");
								edit = 0;
								videoTagPassed = null;
								window.location.href = siteRoot + "scripts/forms/videoTagTable.php";
								//go to videoTag list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("videoTag");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitvideoTagForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var videoTagObject = pushDataFromFormAJAX("videoTag", "videoTag", "id", null, "0"); //insert new object
		
					videoTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New videoTag no "+data+" created");
							edit = 1;
							$("#id").text(data);
							videoTagPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var videoTagObject = pushDataFromFormAJAX("videoTag", "videoTag", "id", videoTagPassed, "1"); //insert new object
		
					videoTagObject.done(function (data){
		
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
		
					fillForm(videoTagPassed);
		
				}else{
					
					$("#messageBox").append("New videoTag");
					
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
		
		
				$("#content").on('click', '#submitvideoTag', (function(event) {
			        event.preventDefault();
			        $('#videoTag').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletevideoTag', (function(event) {
			        event.preventDefault();
			        deletevideoTag();
		
		
			    }));
		
				$("#videoTag").validate({
		
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
video_id: { required: true },   
},messages: {
tags_id: { required: 'message' },   
video_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitvideoTagForm();
		
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