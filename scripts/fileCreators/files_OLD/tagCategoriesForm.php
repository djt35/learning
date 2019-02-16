
		
		
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
		    <title>tagCategories Form</title>
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
		                    <h2 style="text-align:left;">tagCategories Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  tagCategories  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="tagCategories">
					    <?php echo $formv1->generateText('tagCategoryName', 'tagCategoryName', '', 'tooltip here');
echo $formv1->generateText('active', 'active', '', 'tooltip here');
?>
						    <button id="submittagCategories">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 tagCategoriesPassed = $("#id").text();
		
			if ( tagCategoriesPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("tagCategories");
		
				tagCategoriesRequired = new Object;
		
				tagCategoriesRequired = getNamesFormElements("tagCategories");
		
				tagCategoriesString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("tagCategories", tagCategoriesString, getNamesFormElements("tagCategories"), 1);
		
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
				    
				    $("#messageBox").text("Editing tagCategories id "+idPassed);
		
				    enableFormInputs("tagCategories");
		
				});
		
				try {
		
					$("form#tagCategories").find("button#deletetagCategories").length();
		
				}catch(error){
		
					$("form#tagCategories").find("button").after("<button id='deletetagCategories'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deletetagCategories (){
		
				//tagCategoriesPassed is the current record, some security to check its also that in the id field
		
				if (tagCategoriesPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this tagCategories?")) {
		
					disableFormInputs("tagCategories");
		
					var tagCategoriesObject = pushDataFromFormAJAX("tagCategories", "tagCategories", "id", tagCategoriesPassed, "2"); //delete tagCategories
		
					tagCategoriesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("tagCategories deleted");
								edit = 0;
								tagCategoriesPassed = null;
								window.location.href = siteRoot + "scripts/forms/tagCategoriesTable.php";
								//go to tagCategories list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("tagCategories");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submittagCategoriesForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var tagCategoriesObject = pushDataFromFormAJAX("tagCategories", "tagCategories", "id", null, "0"); //insert new object
		
					tagCategoriesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New tagCategories no "+data+" created");
							edit = 1;
							$("#id").text(data);
							tagCategoriesPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var tagCategoriesObject = pushDataFromFormAJAX("tagCategories", "tagCategories", "id", tagCategoriesPassed, "1"); //insert new object
		
					tagCategoriesObject.done(function (data){
		
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
		
					fillForm(tagCategoriesPassed);
		
				}else{
					
					$("#messageBox").text("New tagCategories");
					
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
		
		
				$("#content").on('click', '#submittagCategories', (function(event) {
			        event.preventDefault();
			        $('#tagCategories').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deletetagCategories', (function(event) {
			        event.preventDefault();
			        deletetagCategories();
		
		
			    }));
		
				$("#tagCategories").validate({
		
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
tagCategoryName: { required: true },   
active: { required: true },   
},messages: {
tagCategoryName: { required: 'message' },   
active: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submittagCategoriesForm();
		
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