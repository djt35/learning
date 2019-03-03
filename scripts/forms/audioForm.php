
		
		
			<?php
		
			require ('../../includes/config.inc.php'); require (BASE_URI.'/scripts/headerCreator.php');
		
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
		    <title>audio Form</title>
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
		                    <h2 style="text-align:left;">audio Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  audio  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="audio">
					    <?php echo $formv1->generateText('name', 'name', '', 'tooltip here');
echo $formv1->generateText('url', 'url', '', 'tooltip here');
?>
						    <button id="submitaudio">Submit</button>
		
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
		
			 audioPassed = $("#id").text();
		
			if ( audioPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("audio");
		
				audioRequired = new Object;
		
				audioRequired = getNamesFormElements("audio");
		
				audioString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("audio", audioString, getNamesFormElements("audio"), 1);
		
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
				    
				    $("#messageBox").text("Editing audio id "+idPassed);
		
				    enableFormInputs("audio");
		
				});
		
				try {
		
					$("form#audio").find("button#deleteaudio").length();
		
				}catch(error){
		
					$("form#audio").find("button").after("<button id='deleteaudio'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteaudio (){
		
				//audioPassed is the current record, some security to check its also that in the id field
		
				if (audioPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this audio?")) {
		
					disableFormInputs("audio");
		
					var audioObject = pushDataFromFormAJAX("audio", "audio", "id", audioPassed, "2"); //delete audio
		
					audioObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("audio deleted");
								edit = 0;
								audioPassed = null;
								window.location.href = siteRoot + "scripts/forms/audioTable.php";
								//go to audio list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("audio");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitaudioForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var audioObject = pushDataFromFormAJAX("audio", "audio", "id", null, "0"); //insert new object
		
					audioObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New audio no "+data+" created");
							edit = 1;
							$("#id").text(data);
							audioPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var audioObject = pushDataFromFormAJAX("audio", "audio", "id", audioPassed, "1"); //insert new object
		
					audioObject.done(function (data){
		
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
		
					fillForm(audioPassed);
		
				}else{
					
					$("#messageBox").text("New audio");
					
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
		
		
				$("#content").on('click', '#submitaudio', (function(event) {
			        event.preventDefault();
			        $('#audio').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteaudio', (function(event) {
			        event.preventDefault();
			        deleteaudio();
		
		
			    }));
		
				$("#audio").validate({
		
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
name: { required: true },   
url: { required: true },   
},messages: {
name: { required: 'message' },   
url: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitaudioForm();
		
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