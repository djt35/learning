
		
		
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
		    <title>tags Form</title>
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
		                    <h2 style="text-align:left;">tags Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tableTags" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/tagsTable.php';">Table of tags</button></p>
		               
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  tags  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="tags">
					    <?php echo $formv1->generateText('tagName', 'tagName', '', 'tooltip here');
							echo $formv1->generateSelectTagCategories('tagCategories_id', 'tagCategories_id', '', 'tooltip here');
?>
						    <button id="submittags">Submit</button>
		
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
		
			 tagsPassed = $("#id").text();
		
			if ( tagsPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("tags");
		
				tagsRequired = new Object;
		
				tagsRequired = getNamesFormElements("tags");
		
				tagsString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("tags", tagsString, getNamesFormElements("tags"), 1);
		
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
				    
				    $("#messageBox").append("Editing tags id "+idPassed);
		
				    enableFormInputs("tags");
		
				});
		
				try {
		
					$("form#tags").find("button#deletetags").length();
		
				}catch(error){
		
					$("form#tags").find("button").after("<button id='deletetags'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletetags (){
		
				//tagsPassed is the current record, some security to check its also that in the id field
		
				if (tagsPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this tags?")) {
		
					disableFormInputs("tags");
		
					var tagsObject = pushDataFromFormAJAX("tags", "tags", "id", tagsPassed, "2"); //delete tags
		
					tagsObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("tags deleted");
								edit = 0;
								tagsPassed = null;
								window.location.href = siteRoot + "scripts/forms/tagsTable.php";
								//go to tags list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("tags");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submittagsForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var tagsObject = pushDataFromFormAJAX("tags", "tags", "id", null, "0"); //insert new object
		
					tagsObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New tags no "+data+" created");
							edit = 1;
							$("#id").text(data);
							tagsPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var tagsObject = pushDataFromFormAJAX("tags", "tags", "id", tagsPassed, "1"); //insert new object
		
					tagsObject.done(function (data){
		
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
		
					fillForm(tagsPassed);
		
				}else{
					
					$("#messageBox").append("New tags");
					
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
		
		
				$("#content").on('click', '#submittags', (function(event) {
			        event.preventDefault();
			        $('#tags').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletetags', (function(event) {
			        event.preventDefault();
			        deletetags();
		
		
			    }));
		
				$("#tags").validate({
		
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
tagName: { required: true },   
tagCategories_id: { required: true },   
},messages: {
tagName: { required: 'message' },   
tagCategories_id: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submittagsForm();
		
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