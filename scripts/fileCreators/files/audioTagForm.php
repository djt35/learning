
		
		
			<?php
		
			$host = substr($_SERVER['HTTP_HOST'], 0, 5);
		if (in_array($host, array('local', '127.0', '192.1'))) {
		    $local = TRUE;
		} else {
		    $local = FALSE;
		}
		
		if ($local){
			
			require ('/Applications/XAMPP/xamppfiles/htdocs/dashboard/learning/scripts/headerCreator.php');
			
			
		}else{
			
			require ($_SERVER['DOCUMENT_ROOT'].'/scripts/headerCreator.php');;
		}
		
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
		    <title>audioTag Form</title>
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
		                    <h2 style="text-align:left;">audioTag Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  audioTag  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="audioTag">
					    <?php echo $formv1->generateText('audio_id', 'audio_id', '', 'tooltip here');
echo $formv1->generateText('tags_id', 'tags_id', '', 'tooltip here');
?>
						    <button id="submitaudioTag">Submit</button>
		
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
		
			 audioTagPassed = $("#id").text();
		
			if ( audioTagPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("audioTag");
		
				audioTagRequired = new Object;
		
				audioTagRequired = getNamesFormElements("audioTag");
		
				audioTagString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("audioTag", audioTagString, getNamesFormElements("audioTag"), 1);
		
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
				    
				    $("#messageBox").text("Editing audioTag id "+idPassed);
		
				    enableFormInputs("audioTag");
		
				});
		
				try {
		
					$("form#audioTag").find("button#deleteaudioTag").length();
		
				}catch(error){
		
					$("form#audioTag").find("button").after("<button id='deleteaudioTag'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteaudioTag (){
		
				//audioTagPassed is the current record, some security to check its also that in the id field
		
				if (audioTagPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this audioTag?")) {
		
					disableFormInputs("audioTag");
		
					var audioTagObject = pushDataFromFormAJAX("audioTag", "audioTag", "id", audioTagPassed, "2"); //delete audioTag
		
					audioTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("audioTag deleted");
								edit = 0;
								audioTagPassed = null;
								window.location.href = siteRoot + "scripts/forms/audioTagTable.php";
								//go to audioTag list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("audioTag");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitaudioTagForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var audioTagObject = pushDataFromFormAJAX("audioTag", "audioTag", "id", null, "0"); //insert new object
		
					audioTagObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New audioTag no "+data+" created");
							edit = 1;
							$("#id").text(data);
							audioTagPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var audioTagObject = pushDataFromFormAJAX("audioTag", "audioTag", "id", audioTagPassed, "1"); //insert new object
		
					audioTagObject.done(function (data){
		
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
		
					fillForm(audioTagPassed);
		
				}else{
					
					$("#messageBox").text("New audioTag");
					
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
		
		
				$("#content").on('click', '#submitaudioTag', (function(event) {
			        event.preventDefault();
			        $('#audioTag').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteaudioTag', (function(event) {
			        event.preventDefault();
			        deleteaudioTag();
		
		
			    }));
		
				$("#audioTag").validate({
		
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
audio_id: { required: true },   
tags_id: { required: true },   
},messages: {
audio_id: { required: 'message' },   
tags_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitaudioTagForm();
		
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