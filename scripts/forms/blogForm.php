
		
		
			<?php

			$requiredUserLevel = 1;

			//$openaccess = 1 allows the page to be viewed without login and skips the rest of the script
			//$requiredUserLevel corresponds to database users access level; if not set the page simply requires login
			//$paid allows setting of pages which require subscription and login

			//define token from url

			require ('../../includes/config.inc.php');

			$location = BASE_URL . '/scripts/forms/creatormenu.php';

			require (BASE_URI . '/scripts/headerCreator.php');
		
			$formv1 = new formGenerator;
			$general = new general;
			$video = new video;
			$user = new users;
			$tagCategories = new tagCategories;?>
		
		<script src='<?php echo BASE_URL . '/includes/tableinclude.js'; ?>' type='text/javascript'></script>
		
		<?php

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
		    <title> New blog entry</title>
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
							<h2 style="text-align:left;">New blog entry</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
							<p><button id="tableblog" onclick="window.location.href = '<?php echo BASE_URL;?>/scripts/forms/blogTable.php';">Table of blog</button></p>
		              
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `blog`  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
		
			        <p>
		
					    <form id="blog">
					    <?php //echo $formv1->generateText('dateCreated', 'dateCreated', '', 'tooltip here');
echo $formv1->generateText('title', 'title', '', 'tooltip here');
echo $formv1->generateSelectCustom('Author', 'author', '', $user->getUsers(), 'select the author from the list of users');
//echo $formv1->generateText('author', 'author', '', 'tooltip here'); -- submit user as author
echo $formv1->generateTextAreav3('description', 'description', '', 'tooltip here', '60');
echo '<br><br>';
echo $formv1->generateSelectCustom('video_id', 'video_id', '', $general->getVideos(), 'select the video from the list of videos');
echo '<button type="button" id="selectVideo" onclick="PopupCenter(siteRoot + \'scripts/forms/videoTable.php\', \'New Tag\', 600, 700);">Select video from visual list</button>';
//echo $formv1->generateText('video_id', 'video_id', '', 'tooltip here');
//echo $formv1->generateText('', 'imageSet_id', '', 'tooltip here');
echo '<br><br>';
echo $formv1->generateSelectCustom('imageSet_id', 'imageSet_id', '', $general->getImageset(), 'select the images from the list of imageSets');
echo '<button type="button" id="selectImages" onclick="PopupCenter(siteRoot + \'scripts/forms/imageSetTable.php\', \'New Tag\', 600, 700);">Select images from visual list</button>';
echo '<br><br>';
echo $formv1->generateSelectCustom('Maintain in top blog area?', 'topBlog', '', array(0=>'No', 1=>'Yes'), 'is this a top blog?');
//echo $formv1->generateText('topBlog', 'topBlog', '', 'tooltip here');
echo '<br><br>';
?>
						    <button id="submitblog">Submit</button>
		
					    </form>
		
				        </p>
		
		
		
		        </div>
		
		    </div>
		<script>
		switch (document.location.hostname) {
			case 'www.endoscopy.wiki':

				var rootFolder = 'http://www.endoscopy.wiki/';
				break;
			case 'localhost':
				var rootFolder = 'http://localhost:90/dashboard/learning/';
				break;
			default: // set whatever you want
		}

		var siteRoot = rootFolder;
		
			 blogPassed = $("#id").text();
		
			if ( blogPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
		
		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("blog");
		
				blogRequired = new Object;
		
				blogRequired = getNamesFormElements("blog");
		
				blogString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("blog", blogString, getNamesFormElements("blog"), 1);
		
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
				    
				    $("#messageBox").append("Editing blog id "+idPassed);
		
				    enableFormInputs("blog");
		
				});
		
				try {
		
					$("form#blog").find("button#deleteblog").length();
		
				}catch(error){
		
					$("form#blog").find("button").after("<button id='deleteblog'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteblog (){
		
				//blogPassed is the current record, some security to check its also that in the id field
		
				if (blogPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this blog?")) {
		
					disableFormInputs("blog");
		
					var blogObject = pushDataFromFormAJAX("blog", "blog", "id", blogPassed, "2"); //delete blog
		
					blogObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("blog deleted");
								edit = 0;
								blogPassed = null;
								window.location.href = siteRoot + "scripts/forms/blogTable.php";
								//go to blog list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("blog");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitblogForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var blogObject = pushDataFromFormAJAX("blog", "blog", "id", null, "0"); //insert new object
		
					blogObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New blog no "+data+" created");
							edit = 1;
							$("#id").text(data);
							blogPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var blogObject = pushDataFromFormAJAX("blog", "blog", "id", blogPassed, "1"); //insert new object
		
					blogObject.done(function (data){
		
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
		
					fillForm(blogPassed);
		
				}else{
					
					$("#messageBox").append("New blog");
					
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
		
		
				$("#content").on('click', '#submitblog', (function(event) {
			        event.preventDefault();
			        $('#blog').submit();
		
		
			    }));
		
			    $("#content").on('click', '#deleteblog', (function(event) {
			        event.preventDefault();
			        deleteblog();
		
		
			    }));
		
				$("#blog").validate({
		
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
//dateCreated: { required: true },   
author: { required: true },   
description: { required: true },   
video_id: { required: true },   
imageSet_id: { required: true },   
topBlog: { required: true },   
},messages: {
//dateCreated: { required: 'message' },   
author: { required: 'enter the author of the article' },   
description: { required: 'enter a description' },   
video_id: { required: 'is there an associated video?' },   
imageSet_id: { required: 'is there an associated set of images?' },   
topBlog: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitblogForm();
		
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