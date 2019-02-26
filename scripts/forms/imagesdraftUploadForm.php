
		
		
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
		$user = new users;
		
		if ($user->getUserAccessLevel($_SESSION['user_id']) > 4){
	
			redirect_login($location);
	
	
		}else{
			
			$userid = $_SESSION['user_id'];
			echo '<div id="user_id" style="display:none;">' . $userid . '</div>';
			
		}
		
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
		    <title>Submit Images to Endoscopy Wiki</title>
		</head>
		
		<?php
		include($root . "/scripts/logobar.php");
		
		include($root . "/includes/naviv1.php");
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
		                    <h2 style="text-align:left;">Submit Images to Endoscopy Wiki</h2>
		                    <p style='text-align:left;'>Welcome <?php echo $user->getUserName($_SESSION['user_id']);?>.</p><p style='text-align:left;'>Thanks for your interest in our site.  Please submit images below.  See the attached video for a tutorial of how things work!</p>
		                    <p style='text-align:left;'>All work submitted, if selected, will be credited to you with your details as entered in your user account.</p>
		                    <p style='text-align:left;'>You will receive an alert if your submission is made active on the site.</p>

		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `imageSetDraft`  WHERE  `id`  = $id";
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
					    
					    <input name="files[]" type="file" multiple="multiple" accept=".jpg, .jpeg, .bmp"/>
					    
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
					
					
					    <div id="images">
					    <?php /*echo $formv1->generateText('url', 'url', '', 'tooltip here');
echo $formv1->generateText('name', 'name', '', 'tooltip here');
echo $formv1->generateText('type', 'type', '', 'tooltip here');*/
?>
						   <!-- <button id="submitimages">Submit</button>-->
		
					    </div>
					</div>
				    <div class='col-2'>
					</div>    
				</div>
		
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

imagesPassed = $("#id").text();

if (imagesPassed == "") {

    var edit = 0;

} else {

    var edit = 1;
    
    $('#imageUpload').hide();
    
    //constructEditTable;

}

var files;

var imageID;

var singleTag;

var images = new Object();

var textAreas = new Object();

var selects = new Object();

var selects2 = new Object();



function constructEditTable(idPassed){
	
	//imagesPassed, ajax the id to get a table in the format of the previous
	
	//get the images
	
	//get all the tags for the images
	
	
	$('#imageUpload').hide();
	
    imagesRequired = new Object;

    //imagesRequired = getNamesFormElements("images");  JSONStraightDataQuery (table, query, outputFormat)

    imagesString = '`id`=\'' + idPassed + '\'';
    
    query = "SELECT a.`id`, a.`name` as `imageSetname`, a.`type` as `imageSetTitle`, a.`author`, b.`image_id`, c.`url`, c.`name`, c.`type`, c.`order` FROM `imageSetDraft` as a INNER JOIN `imageImageSetDraft` as b ON a.`id` = b.`imageSet_id` INNER JOIN `imagesDraft` as c on b.`image_id` = c.`id` WHERE a.`id` = "+idPassed;

    var selectorObject = JSONStraightDataQuery("imageSetDraft", query, 7);

    //console.log(selectorObject);

    selectorObject.done(function(data) {

        console.log(data);
		
		try{
		
        var formData = $.parseJSON(data);
        
        } catch (error) {
	        
	       console.log('No ajax data received'); 
	        
        }
		
		var html = "Title of this image set : <input id='imageSetTitle' size='40'></input><br><br>";
		//html += "Author of this image set : {select here for author}<br>";
		 html += "Overall description for these images : <br><textarea name='imageSetname' id='imageSetname' class='name' rows='4' cols='100'></textarea><br><br>";
		html += "<table id=\"imagesTable\" class=\"imageTable\">";
		html += "<tr>";
		html += '<th></th>';
			html += '<th></th>';
			html += '<th>Tags</th>';
			html += '<th>Description</th>';
			html += '<th>Rank</th>';
			html += '<th>Display order</th>';
			html += '</tr>';

        $(formData).each(function(i, val) {
            
            var id = val.id;
            var image_id = val.image_id;
            var url = val.url;
            var name = val.name;
            var type = val.type;
            
            html += '<tr class="file">';
			html += "<td id='"+image_id+"' style='display:none;'>"+url+"</td>";
			html += "<td><img src='"+siteRoot+"/"+url+"' style=\"width:128px;\"></td>";
			html += "<td><button class='addTag'>Add Tag</button></td>";
			html += "<td class='imageTag' id='tag"+image_id+"'></td>";
			html += "<td class='imageDesc'><textarea name='imagename$insert' id='imagename"+image_id+"' class='name' rows='4' cols='30'></textarea></td>";
			html += "<td class='imageType'><select id='imagetype"+image_id+"' class='type'><option hidden selected></option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select></td>";
			html += "<td><select name='imageorder"+image_id+"' id='imageorder"+image_id+"' class='order'><option hidden selected>";
			
			var i;
			for (i = 1; i <= Object.keys(formData).length; i++) { 
			    html += "<option value='"+i+"'>"+i+"</option>";
			}
			
			
			html += "</select></td>";
			html += "<td class='deleteImage'>&#x2718;</td>";
			html += '</tr>';


        });
        
        html += '</table>';
		html += '<p>';
		html += "<button class='addTagAll'> Add tag to all images</button>&nbsp;&nbsp;";
		html += "<button class='save' onclick='fn60sec();'> Save data </button>&nbsp;&nbsp;";
		html += "<button class='view' onclick='preview("+idPassed+");'><b>View example page</b> </button>";
		html += '</p>';

        $("#messageBox").text("Editing images with imageSet id " + idPassed);
        $("#images").html(html);
        
        $(formData).each(function(i, val) {
            
            var id = val.id;
            var image_id = val.image_id;
            var url = val.url;
            var name = val.name;
            var type = $.trim(val.type);
            var order = $.trim(val.order);
            var imageSetname = val.imageSetname;
            var description = val.imageSetTitle;
            console.log('Type for image id '+image_id+' is '+type);
            console.log('Order for image id '+image_id+' is '+order);
			
		
		$("#imagename"+image_id+"").val(name);
		
		$("#imagetype"+image_id+" option[value='"+type+"']").attr('selected', 'selected');
		
		$('#content').find("#imagetype"+image_id+"").val(type);
		
		$('#content').find("#imageorder"+image_id+"").val(order);
		
		$('#content').find("#imageSetname").val(imageSetname);
		
		$('#content').find("#imageSetTitle").val(description);
		
		//author needs implementing here
		
		
		
		});
		
				query = "SELECT b.`image_id`, c.`url`, c.`name`, c.`type`, e.`tagName`, d.`id` as imagesTagid, d.`tags_id` FROM `imageSetDraft` as a INNER JOIN `imageImageSetDraft` as b ON a.`id` = b.`imageSet_id` INNER JOIN `imagesDraft` as c on b.`image_id` = c.`id` INNER JOIN `imagesTagDraft` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` WHERE a.`id` = "+idPassed;
		
		    var selectorObject = JSONStraightDataQuery("imageSetDraft", query, 7);
		
		    //console.log(selectorObject);
		
		    selectorObject.done(function(data) {
		
		        console.log(data);
				
				try{
				
		        var formData = $.parseJSON(data);
		        
		        } catch (error) {
			        
			       console.log('No ajax data received'); 
			        
		        }
		        
		        $(formData).each(function(i, val) {
            
	            var id = val.id;
	            var image_id = val.image_id;
	            var tags_id = val.tags_id;
	            var imagesTagid = val.imagesTagid;
	            var tagName = val.tagName;
	            var type = val.type;

	            
	            $("#tag"+image_id+"").append('<button id="' + imagesTagid + '" class="tagButton">'+tagName+'</button>');
				
				
				
				});
		        
		        updatePreValues ();
		        
		    });

		
        //enableFormInputs("images");

    });

    /*try {

        $("form#images").find("button#deleteimages").length();

    } catch (error) {

        $("form#images").find("button").after("<button id='deleteimages'>Delete</button>");

    }*/
	/*
	echo '<table id="imagesTable" class="imageTable">';
		echo '<tr>';
			echo '<th></th>';
			echo '<th></th>';
			echo '<th>Tags</th>';
			echo '<th>Description</th>';
			echo '<th>Rank</th>';
			echo '</tr>';
		foreach ($filearray as $key=>$value){
			
			$insert = $value['id'];
			$file = $value['filename'];
			
			
			echo '<tr class="file">';
			echo "<td id='$insert' style='display:none;'>$file</td>";
			echo "<td><img src='$roothttp/$file' style=\"width:128px;\"></td>";
			echo "<td><button class='addTag'>Add Tag</button></td>";
			echo "<td class='imageTag'></td>";
			echo "<td class='imageDesc'><textarea name='imagename$insert' id='imagename$insert' class='name' rows='4' cols='30'></textarea></td>";
			echo "<td class='imageRank'><select name='imagetype$insert' id='imagetype$insert' class='type'><option hidden selected></option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select></td>";

			
			echo '</tr>';
		}
		echo '</table>';
		echo '<p>';
		echo "<button class='addTagAll'> Add tag to all images</button>&nbsp;&nbsp;";
		echo "<button class='save' onclick='fn60sec();'> Save data </button>";
		echo '</p>';*/
	
}

function deleteImage(imageRowClicked){
	
	
	//get the image id
	
	console.log(imageRowClicked);
	
	var imageID = $(imageRowClicked).closest('tr').find('td:eq(0)').attr('id');
	
	
	query = "DELETE FROM `imagesDraft` WHERE `id` = "+imageID+"";
	
	
    var selectorObject = JSONStraightDataQuery("imagesDraft", query, 8);

    //console.log(selectorObject);

    selectorObject.done(function(data) {

        console.log(data);
		
		if (data){
			
			
			if (data == 1){
				
				console.log('now remove the table row');
				
				$(imageRowClicked).closest('tr').hide();
				
			}else{
				
				alert('Row not deleted');
				
			}
			
		}

	
	});
	
}


function preview(idPassed){
	
	PopupCenter(siteRoot + "scripts/display/atlasImagesetDraft.php?id="+idPassed, 'Preview images', 800, 1000);

	
	
}

function fn60sec() {

    console.log('fired');
    
    //get logged in author
    
    var user_id = $('#user_id').text();
    
    console.log('data is '+'user_id='+user_id);
    
    //check function to see if user in session matches user in javascript function
    
    //createCheckuser file in scripts
    
    request = $.ajax({
	        url: siteRoot + "scripts/checkUser.php",
	        type: "get",
	        data: 'userid='+user_id,

		   });

		   request.done(function(data){

			   if (data){

			     if (data == 1){
				     
				      //!get imageids

    var overallObject = new Object();

    x = 0;

    $('#imagesTable').find('tr').find('td:eq(0)').each(function() {

        //console.log(this);

        var fileid = $(this).attr('id');

        images[x] = fileid;

        x++;


    })

    //get array of textareas

    x = 0;

    $('#imagesTable').find('tr').find('td:eq(4)').find('textarea').each(function() {

        console.log(this);

        var textareaText = $(this).val();

        textAreas[x] = $.trim(textareaText);

        x++;


    })

    x = 0;

    $('#imagesTable').find('tr').find('td:eq(5)').find('select').each(function() {

        console.log(this);

        var selectValue = $(this).val();

        selects[x] = selectValue;

        x++;


    })
    
    x = 0;

    $('#imagesTable').find('tr').find('td:eq(6)').find('select').each(function() {

        console.log(this);

        var selectValue = $(this).val();

        selects2[x] = selectValue;

        x++;


    })

    console.dir(images);
    console.dir(textAreas);
    console.dir(selects);
    console.dir(selects2);

	
	//these need the field names
	
    overallObject['id'] = images;
    overallObject['type'] = selects;
    overallObject['order'] = selects2;
    overallObject['name'] = textAreas;

    console.dir(overallObject);


    var tagsImagesObject = JSONDataQuery('imagesDraft', overallObject, 6); //update new object

    tagsImagesObject.done(function(data) {

        console.log('tagsImagesObject = ' + data);
        
        var imageSetDescription = $('#imageSetname').val();
        
        var imageSetTitle = $('#imageSetTitle').val();

		if (imagesPassed == "") {
	    
	    	imagesPassed = $('#imageSetID').text();
	    	
	    
		}
		
		console.log('images passed is '+imagesPassed);
        
        var imageSetObject = pushDataAJAX('imageSetDraft', 'id', imagesPassed, 1, {
                        'name': imageSetDescription,
                        'type': imageSetTitle,
                        'author' : user_id,
                        
                    }); 
        
        imageSetObject.done(function(data) {
        
        
        		console.log('imageSetObject completed with data ' + data);

		        if (data) {
			        
			        if (data == 1){
				        
				        $('#messageBox').html('Saved at '+ new Date().toLocaleTimeString('en-GB', { hour: "numeric", 
		                                             minute: "numeric"})).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);;
				        
			        }
		
		        }
		        
		})

    })

    //table
    //updateType 6 (not insert)
    //array

    //get array of dropdowns

    //enter this in the field name

    /*
			        
			        imageID = $(cellClicked).closest('tr').find('td:eq(0)').attr('id');
			        
			        var text = $(this).val();
		
					var imagesObject = pushDataAJAX('images', 'id', imageID, 1, {'name':text}); //delete images
		
					imagesObject.done(function (data){
		
						console.log(data);
		
						if (data){
		
							if (data == 1){
		
								//alert ("tag connection deleted");
								console.log('textarea data updated');
								
								//edit = 0;
								//imagesPassed = null;
								//window.location.href = siteRoot + "scripts/forms/imagesTable.php";
								//go to images list
		
							}else {
		
								console.log('textarea data not updated');
		
							//enableFormInputs("images");
		
						    }
		
		
		
						}
		
		
					});
			   */

    // runs every 60 sec and runs on init.
				     
			     }else if (data == 0){
				     
				     logout();
				     
			     }

			   }

		   });
    
    

   
}
setInterval(fn60sec, 60 * 1000);


function addImageTagAll(event) {
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

    disableFormInputs("imageUpload");
    // Create a formdata object and add the files
    var data = new FormData();
    $.each(files, function(key, value) {
        data.append(key, value);
    });

    request = $.ajax({
        url: 'files_draft_upload.php?files',
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




function fillForm(idPassed) {

    disableFormInputs("images");

    imagesRequired = new Object;

    imagesRequired = getNamesFormElements("images");

    imagesString = '`id`=\'' + idPassed + '\'';

    var selectorObject = getDataQuery("imagesDraft", imagesString, getNamesFormElements("images"), 1);

    //console.log(selectorObject);

    selectorObject.done(function(data) {

        //console.log(data);

        var formData = $.parseJSON(data);


        $(formData).each(function(i, val) {
            $.each(val, function(k, v) {
                $("#" + k).val(v);
                //console.log(k+' : '+ v);
            });

        });

        $("#messageBox").text("Editing images id " + idPassed);

        enableFormInputs("images");

    });

    try {

        $("form#images").find("button#deleteimages").length();

    } catch (error) {

        $("form#images").find("button").after("<button id='deleteimages'>Delete</button>");

    }

}


//delete behaviour

function deleteimages() {

    //imagesPassed is the current record, some security to check its also that in the id field

    if (imagesPassed != $("#id").text()) {

        return;

    }


    if (confirm("Do you wish to delete this images?")) {

        disableFormInputs("images");

        var imagesObject = pushDataFromFormAJAX("images", "imagesDraft", "id", imagesPassed, "2"); //delete images

        imagesObject.done(function(data) {

            //console.log(data);

            if (data) {

                if (data == 1) {

                    alert("images deleted");
                    edit = 0;
                    imagesPassed = null;
                    window.location.href = siteRoot + "scripts/forms/imagesTable.php";
                    //go to images list

                } else {

                    alert("Error, try again");

                    enableFormInputs("images");

                }



            }


        });

    }


}

function updatePreValues (){
	
	
	$('.order').each(function(){
	
		//console.log(this);
	
		$(this).data('pre', $(this).val());
		
		//var hello = $(this).data('pre');
		
		//console.log(hello);
		
	})
	
	
	
}

function submitimagesForm() {

    //pushDataFromFormAJAX (form, table, identifierKey, identifier, updateType)

    if (edit == 0) {

        var imagesObject = pushDataFromFormAJAX("images", "imagesDraft", "id", null, "0"); //insert new object

        imagesObject.done(function(data) {

            //console.log(data);

            if (data) {

                alert("New images no " + data + " created");
                edit = 1;
                $("#id").text(data);
                imagesPassed = data;
                fillForm(data);




            } else {

                alert("No data inserted, try again");

            }


        });

    } else if (edit == 1) {

        var imagesObject = pushDataFromFormAJAX("images", "imagesDraft", "id", imagesPassed, "1"); //insert new object

        imagesObject.done(function(data) {

            //console.log(data);

            if (data) {

                if (data == 1) {

                    alert("Data updated");
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

    if (edit == 1) {

        constructEditTable(imagesPassed);

    } else {

        $("#messageBox").text("New images");

    }

    $('input[type=file]').on('change', prepareUpload);

    $('#loading').bind('ajaxStart', function() {
        $(this).show();
    }).bind('ajaxStop', function() {
        $(this).hide();
    });

    var titleGraphic = $(".title").height();
    var titleBar = $("#menu").height();
    $(".title").css('height', (titleBar));


    $(window).resize(function() {
        waitForFinalEvent(function() {
            //alert("Resize...");
            var titleGraphic = $(".title").height();
            var titleBar = $("#menu").height();
            $(".title").css('height', (titleBar));

        }, 100, 'Resize header');
    });
    
    /*
    $(document).click(function(event) {
	  //if you click on anything except the modal itself or the "open modal" link, close the modal
	  if (!$(event.target).closest(".modal").length) {
	    $(".content").find(".modal").removeClass("visible");
	  }
	});
	*/
	
	var navBarEntry = '<div class="dropdown"><button class="dropbtn activeButton">Image Creators&#9660;</button><div class="dropdown-content"><a href="' + siteRoot + 'scripts/forms/imagesdraftUploadForm.php">New Image Entry</a><hr><a href="' + siteRoot + 'scripts/forms/imageSetdraftTable.php">Images Table</a></div></div>';
    
    $('.navbar').find('.dropdown:eq(3)').after(navBarEntry);

    $("#content").on('click', '#submitimages', (function(event) {
        event.preventDefault();
        $('#images').submit();


    }));

    $("#content").on('click', "#submitimagefiles", function() {
        //event=$(this);
        if (files == null) {
            alert('No files selected');
            return;
        } else {
            uploadFiles(event);
        }

    });

    //!Add new tag to single image

    $('.content').on('click', '.addTag', function() {


        event.preventDefault();

        var cellClicked = $(this);

        imageID = $(cellClicked).closest('tr').find('td:eq(0)').attr('id');

        console.log('File id is' + imageID);

        singleTag = 1;

        $('.darkClass').show();



        var selectorObject = getDataQuery('tagCategories', '', {
            'id': 'id',
            'Category Name': 'tagCategoryName'
        }, 2);

        //console.log(selectorObject);

        selectorObject.done(function(data) {

            //console.log(data);

            $('.modal').show();

            $('.modal').show();
            $('.modal').css('max-height', 800);
            $('.modal').css('max-width', 800);
            $('.modal').css('overflow', 'scroll');



            $('.modal').find('.modalContent').html('<h3>Choose Tag Category</h3>');


            $('.modal').find('.modalContent').append('<p>' + data + '</p>');

            //this line removed for draft upload
            //$('.modal').find('.modalContent').append('<button id="newTagCategory">Add new tag category</button>');

            return;



        })

    })

    $('.modal').on('click', '.tagCategoriesrow', function() {

        event.preventDefault();

        var cellClicked = $(this);

        var tagCategoryID = $(cellClicked).closest('tr').find('td:eq(0)').text();

        //console.log('File id is'+fileID);

        $('.darkClass').show();



        var selectorObject = getDataQuery('tags', 'tagCategories_id =\'' + tagCategoryID + '\'', {
            'id': 'id',
            'Tag Name': 'tagName'
        }, 2);

        //console.log(selectorObject);

        selectorObject.done(function(data) {

            //console.log(data);

            $('.modal').show();

            $('.modal').show();
            $('.modal').css('max-height', 800);
            $('.modal').css('max-width', 800);
            $('.modal').css('overflow', 'scroll');



            $('.modal').find('.modalContent').html('<h3>Choose Tag</h3>');


            $('.modal').find('.modalContent').append('<p>' + data + '</p>');

			//this line removed for draft image upload
            //$('.modal').find('.modalContent').append('<button id="newTag">Add new tag </button>');


            return;



        })

    })

    $('.modal').on('click', '.tagsrow', function() {

        //!commit the tag to the database

        event.preventDefault();

        var cellClicked = $(this);

        var tagID = $(cellClicked).closest('tr').find('td:eq(0)').text();

        //console.log('File id is'+fileID);

        $('.darkClass').show();

        //collect objects imageID, tagID and insert into imageTags

        //check connections do not already exist

        //query imagesTag for where images_id = imageID and tags_id = tagID

        //3 new tag for matching a row

        if (singleTag == 1) {

            var selectorObject = getDataQuery('imagesTagDraft', '`images_id` = ' + imageID + ' and `tags_id` = ' + tagID + '', {
                '0': 'images_id',
                '1': 'tags_id'
            }, 3);

            //console.log(selectorObject);
            var alreadyExists;
            //find the id of image which is already tagged, push it from the array of images to be tagged!

            selectorObject.done(function(data) {



                if (data) {

                    console.log('important data is' + data);

                    if (data == 1) {

                        alert('This image tag combination already exists for one or more images');
                        alreadyExists = 1;
                        $('.modal').hide();

                        $('.darkClass').hide();

                    } else {

                        alreadyExists = 0;
                    }

                }

                if (alreadyExists == 0) {

                    var tagsImagesObject = pushDataAJAX('imagesTagDraft', 'id', '', 0, {
                        'images_id': imageID,
                        'tags_id': tagID
                    }); //insert new object

                    tagsImagesObject.done(function(data) {

                        console.log('tagsImagesObject = ' + data);

                        if (data) {

                            if (isNormalInteger(data)) {

                                //alert ("Tag added");

                                //add the tag to the table

                                $('.file').find('td[id=' + imageID + ']').closest('tr').find('td:eq(3)').append('<button id="' + data + '" class="tagButton">' + $(cellClicked).closest('tr').find('td:eq(1)').text() + '</button>');

                                $('.modal').hide();

                                $('.darkClass').hide();

                                return;


                            } else {

                                alert("Error, try again");

                            }



                        }


                    });

                }


            })


        } else if (singleTag == 0) {

            //table, outputformat, array containing pairs to insert

            //combine the objects

            //fileList {0: 'id', 1: 'id2'} etc

            //tag same in each case tagID

            var tagImages = new Object();

            $.each(images, function(k, v) {

                console.log(k);
                console.log(v);

                tagImages[k] = {
                    'images_id': v,
                    'tags_id': tagID
                };



            })

            console.dir(tagImages);

            //imageTag = {0 = Object {images_id : id, tags_id : tagID

            var selectorObject = JSONDataQuery('imagesTagDraft', tagImages, 4); //check these don't already exist

            //console.log(selectorObject);
            var alreadyExists;

            selectorObject.done(function(data) {



                if (data) {

                    console.log('important data is' + data);

                    if (data == 1) {

                        alert('One of these images is already tagged with this tag, select individually');
                        alreadyExists = 1;
                        $('.modal').hide();

                        $('.darkClass').hide();

                    } else {

                        alreadyExists = 0;
                    }

                }

                if (alreadyExists == 0) {

                    var tagsImagesObject = JSONDataQuery('imagesTagDraft', tagImages, 5); //insert new object

                    tagsImagesObject.done(function(data) {

                        console.log('tagsImagesObject = ' + data);

                        if (data) {

                            if (data != 0) {

                                //alert ("Tag added");

                                var returnedData = $.parseJSON(data);

                                console.dir(returnedData);

                                //add the tag to the table rows

                                var xy = 0;

                                $('#imagesTable').find('tr').find('td:eq(3)').each(function() {


                                    $(this).append('<button id="' + returnedData[xy] + '" class="tagButton">' + $(cellClicked).closest('tr').find('td:eq(1)').text() + '</button>');

                                    xy++;

                                })

                                $('.modal').hide();

                                $('.darkClass').hide();

                                return;


                            } else {

                                alert("Error, try again");

                            }



                        }


                    });

                }

            })

        }

    })


    //!Add new tag to all images uploaded

    $('.content').on('click', '.addTagAll', function() {


        event.preventDefault();

        var cellClicked = $(this);

        //get an array of the required image id's

        //var images = new Object();

        x = 0;

        $('#imagesTable').find('tr').find('td:eq(0)').each(function() {

            //console.log(this);

            var fileid = $(this).attr('id');

            images[x] = fileid;

            x++;


        })

        singleTag = 0;


        console.dir(images);

        $('.darkClass').show();



        var selectorObject = getDataQuery('tagCategories', '', {
            'id': 'id',
            'Category Name': 'tagCategoryName'
        }, 2);

        //console.log(selectorObject);

        selectorObject.done(function(data) {

            //console.log(data);

            $('.modal').show();

            $('.modal').show();
            $('.modal').css('max-height', 800);
            $('.modal').css('max-width', 800);
            $('.modal').css('overflow', 'scroll');



            $('.modal').find('.modalContent').html('<h3>Choose Tag Category</h3>');


            $('.modal').find('.modalContent').append('<p>' + data + '</p>');

			//this line removed for draft upload
           // $('.modal').find('.modalContent').append('<button id="newTagCategory">Add new tag category</button>');

            return;



        })

    })




    $("#content").on('click', '#deleteimages', (function(event) {
        event.preventDefault();
        deleteimages();


    }));
    
    $("#content").on('click', '.deleteImage', (function(event) {
	    
	    
        event.preventDefault();
        
        if (confirm("Do you wish to delete this image?")) {
	        deleteImage($(this));
		}
        
        
        
    }));

    $("#content").on('click', '.tagButton', (function(event) {

        var button = $(this);

        var tagImageid = $(this).attr('id');

         console.log(tagImageid);

        if (confirm("Do you wish to delete this tag from the image?")) {

            //disableFormInputs("images");

            var imagesObject = pushDataAJAX('imagesTagDraft', 'id', tagImageid, 2, ''); //delete images

            imagesObject.done(function(data) {

                console.log(data);

                if (data) {

                    if (data == 1) {

                        //alert ("tag connection deleted");
                        $(button).remove();

                        //edit = 0;
                        //imagesPassed = null;
                        //window.location.href = siteRoot + "scripts/forms/imagesTable.php";
                        //go to images list

                    } else {

                        alert("Error, try again");

                        //enableFormInputs("images");

                    }



                }


            });

        }


    }));

    $('.modal').on('click', '#newTagCategory', function() {

        $('.modal').hide();

        $('.darkClass').hide();

        PopupCenter(siteRoot + "scripts/forms/tagCategoriesForm.php", 'New Tag Category', 600, 700);

        //window.open(, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=700");



    })

    $('.modal').on('click', '#newTag', function() {

        $('.modal').hide();

        $('.darkClass').hide();

        PopupCenter(siteRoot + "scripts/forms/tagsForm.php", 'New Tag', 600, 700);


        //window.open(siteRoot + "scripts/forms/tagsForm.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=700");



    })
    
    
		
	
		

    
    $('#content').on('change', '.order', function() {

        //prevents two of the same numbers in order
        var before_change = $(this).data('pre');
   
        //get value of this order
        
        orderValue = $(this).val();  //new value of clicked select
        
        orderid = $(this).attr('id');
        
        $('.order').each(function(){
	        
	        if ($(this).attr('id') != orderid){
		        
		        
		        if ($(this).val() == orderValue){
			        
			        $(this).val(before_change);
			        
			        $(this).data('pre', $(this).val());
			        
		        }
		        
	        }
	        
	        
	        
        })
        
        $(this).data('pre', $(this).val());
       



    })

    


    

})		
			</script>
		<?php
		
		    // Include the footer file to complete the template:
		    include($root ."/includes/footer.html");
		
		
		
		
		    ?>
		</body>
		</html>