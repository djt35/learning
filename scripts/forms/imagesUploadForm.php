
		
		
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
		    <title>images Form</title>
		</head>
		
		<?php
		include($root . "/scripts/logobar.php");
		
		include($root . "/includes/naviCreator.php");
		?>
		
		<div id="loading">
	
		</div>
		
		<div class="darkClass">
		
		</div>
		
		<div class="modal" style="display:none;">
			
			<div class='modalContent'>
				
			</div>
			<div class='modalClose'>
				<p><br><button onclick="$('.modal, .darkClass').hide();">Close this window</button></p>
			</div>
			
		</div>
		
		<body>
		
			<div id="id" style="display:none;"><?php if ($id){echo $id;}?></div>
		
		    <div id='content' class='content'>
		
		        <div class='responsiveContainer white'>
		
			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">Images Upload Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  id  FROM  images  WHERE  id  = $id";
							if ($general->returnYesNoDBQuery($q) != 1){
								echo "Passed id does not exist in the database";
								exit();
		
							}
						}
		
		?></p>
		
				<div class='row'>
					<div class='col-2'>
					</div>
					<div class='col-8'>
					
					
					    <form id="imageUpload">
					    
					    <input name="files[]" type="file" multiple="multiple" accept=".jpg, .jpeg"/>
					    
					    <button id="submitimagefiles">Submit</button>
		
					    </form>
					</div>
				    <div class='col-2'>
					</div>    
				</div>
			        
				<div class='row'>
					<div class='col-2'>
					</div>
					<div class='col-8'>
					
					
					    <form id="images">
					    <?php /*echo $formv1->generateText('url', 'url', '', 'tooltip here');
echo $formv1->generateText('name', 'name', '', 'tooltip here');
echo $formv1->generateText('type', 'type', '', 'tooltip here');*/
?>
						   <!-- <button id="submitimages">Submit</button>-->
		
					    </form>
					</div>
				    <div class='col-2'>
					</div>    
				</div>
		
		        </div>
		
		    </div>
		<script>
			var siteRoot = "http://localhost:90/dashboard/learning/";
		
			 imagesPassed = $("#id").text();
		
			if ( imagesPassed == ""){
		
				var edit = 0;
		
			}else{
		
				var edit = 1;
		
			}
			
			var files;



function addImageTagAll (event){
	event.preventDefault();
	
	//get all the table rows with class file
	
	//launch the tag modal
	
	//once tag selected, come back and insert required keys
	
	//collect the data needed for the tag table	
	
	//display keys below
	
}


function prepareUpload(event) {
    files = event.target.files;
}



// Catch the form submit and upload the files
function uploadFiles(event) {
    event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening

    // START A LOADING SPINNER HERE

    // Create a formdata object and add the files
    var data = new FormData();
    $.each(files, function(key, value) {
        data.append(key, value);
    });

    request = $.ajax({
        url: 'files_upload.php?files',
        type: 'POST',
        data: data,
        cache: false,
        //dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request


        success: function(data, textStatus, jqXHR) {
            if (typeof data.error === 'undefined') {

                $('#images').html(data);
                
                console.log(data);
                //submitForm(event, data);
            } else {
                // Handle errors here
                console.log('ERRORS: ' + data.error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
            // STOP LOADING SPINNER
        }
    });


}

		
		
		
		
			function fillForm (idPassed){
		
				disableFormInputs("images");
		
				imagesRequired = new Object;
		
				imagesRequired = getNamesFormElements("images");
		
				imagesString = '`id`=\''+idPassed+'\'';
		
				var selectorObject = getDataQuery ("images", imagesString, getNamesFormElements("images"), 1);
		
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
				    
				    $("#messageBox").text("Editing images id "+idPassed);
		
				    enableFormInputs("images");
		
				});
		
				try {
		
					$("form#images").find("button#deleteimages").length();
		
				}catch(error){
		
					$("form#images").find("button").after("<button id='deleteimages'>Delete</button>");
		
				}
		
			}
		
		
			//delete behaviour
		
			function deleteimages (){
		
				//imagesPassed is the current record, some security to check its also that in the id field
		
				if (imagesPassed != $("#id").text()){
		
					return;
		
				}
		
		
				if (confirm("Do you wish to delete this images?")) {
		
					disableFormInputs("images");
		
					var imagesObject = pushDataFromFormAJAX("images", "images", "id", imagesPassed, "2"); //delete images
		
					imagesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							if (data == 1){
		
								alert ("images deleted");
								edit = 0;
								imagesPassed = null;
								window.location.href = siteRoot + "scripts/forms/imagesTable.php";
								//go to images list
		
							}else {
		
							alert("Error, try again");
		
							enableFormInputs("images");
		
						    }
		
		
		
						}
		
		
					});
		
				}
		
		
			}
		
			function submitimagesForm (){
		
				//pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)
		
				if (edit == 0){
		
					var imagesObject = pushDataFromFormAJAX("images", "images", "id", null, "0"); //insert new object
		
					imagesObject.done(function (data){
		
						//console.log(data);
		
						if (data){
		
							alert ("New images no "+data+" created");
							edit = 1;
							$("#id").text(data);
							imagesPassed = data;
							fillForm(data);
		
		
		
		
						}else {
		
							alert("No data inserted, try again");
		
						}
		
		
					});
		
				} else if (edit == 1){
		
					var imagesObject = pushDataFromFormAJAX("images", "images", "id", imagesPassed, "1"); //insert new object
		
					imagesObject.done(function (data){
		
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
		
					fillForm(imagesPassed);
		
				}else{
					
					$("#messageBox").text("New images");
					
				}
				
				$('input[type=file]').on('change', prepareUpload);
		
				$('#loading').bind('ajaxStart', function(){
				    $(this).show();
				}).bind('ajaxStop', function(){
				    $(this).hide();
				});
		
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
		
		
				$("#content").on('click', '#submitimages', (function(event) {
			        event.preventDefault();
			        $('#images').submit();
		
		
			    }));
			    
			    $("#content").on('click', "#submitimagefiles", function() {
				   //event=$(this);
				   if (files == null){
					   alert('No files selected');
					   return;
				   }
				   
				 
				   else {
					   uploadFiles(event);
				   }
				   
			   }); 
			   
			   $('.content').on('click', '.file', function(){
			
				var cellClicked = $(this);
				
				var lesionID = $(cellClicked).closest('tr').find('td:eq(0)').text();
				
				var studyID = $(cellClicked).closest('tr').find('td:eq(1)').text();
				
				$('.darkClass').show();
				
				request = $.ajax({
			        url: siteRoot+"scripts/getReferrer.php",
			        type: "get",
			        data: '_k_patient='+studyID
				    });
				
				request.done(function (response, textStatus, jqXHR){
				        //console.log(response);
				        
				        try{
				        
				        	var returnedData = $.parseJSON(response);
				        	}catch{
					        	
					        	$('.modal').show();
					        	
					        	$('.modal').find('.modalContent').html('<h3>Referrer Details</h3><p>The referrer for lesion'+lesionID+', patient '+studyID+' is not yet defined</p><br><br><p>Would you like to select the referrer now?</p><br><p><button class=\'selectReferrer\' onClick=\'selectReferrer("'+studyID+'")\'>Select Referrer</button></p>');
					        	
					        	return;
					        	
				        	}
				        
				        if (returnedData.title == null){
					        
					        returnedData.title = 'Dr';
					        
					        
				        }
				        
				        
				        $('.modal').show();
				
				
						$('.modal').find('.modalContent').html('<h3>Referrer Details</h3><p>The referrer for '+lesionID+', patient '+studyID+' is below</p><br><br>');
						
						$('.modal').find('.modalContent').append('<p>Name: '+returnedData.title+' '+returnedData.firstname+' '+returnedData.surname+' </p>');
						
						$('.modal').find('.modalContent').append('<p>Address: '+returnedData.address+'</p>');
						
						$('.modal').find('.modalContent').append('<p>Phone: '+returnedData.telephone+'</p>');

						$('.modal').find('.modalContent').append('<p>Fax: '+returnedData.fax+'</p>');
						
						$('.modal').find('.modalContent').append('<p>Email: '+returnedData.email+'</p>');
						
						$('.modal').find('.modalContent').append('<p><button onclick=\'$(".modal, .darkClass").hide();selectReferrer("'+studyID+'")\'>Change Referrer</button></p>');



						
				        
				   });
				
				request.fail(function (jqXHR, textStatus, errorThrown){
				        
				        console.log('ajax failed');
				        $('.darkClass').hide();
				        return;
				        
				        	    });
				
				request.always(function () {
				        // Reenable the inputs
				       
				    });
				    
				
				
				
				
			
			})
			   
			   
			   
			   
			   
			   
			   
			   
			   
		
			    $("#content").on('click', '#deleteimages', (function(event) {
			        event.preventDefault();
			        deleteimages();
		
		
			    }));
		
				$("#images").validate({
		
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
url: { required: true },   
name: { required: true },   
type: { required: true },   
},messages: {
url: { required: 'message' },   
name: { required: 'message' },   
type: { required: 'message' },   
},
			        submitHandler: function(form) {
		
			            submitimagesForm();
		
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