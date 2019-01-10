
		
		
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
		    <title>Video Chapter Form</title>
		</head>
		
		<style>
			
			.content, #menu, .responsiveContainer {
				
				color: white;
				background-color: black;
				
				
			}
			
			.content {
				
				max-height: none;
				
				
			}
			
			.navbar, .dropbtn, .dropdown .dropbtn, .navbar a, .dropdown, .dropdown-content {
				
				background-color: #2670DD;
				
			}
			
			footer {
				
				color: white;
				background-color: black;
				
			}
			
			.startTyping {
				
				font-size: large;
				
				
			}
			
			.modifiers {
				
				background-color: #2670DD; /* Blue UZ */
			    border: none;
			    color: white;
			    padding: 5px 10px;
			    text-align: center;
			    text-decoration: none;
			    display: inline-block;
			    font-size: 16px;
				
				
			}
			
			
			
			
		</style>
		
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
		                    <h2 style="text-align:left;">Video Chapter, Tag Form</h2>
		                </div>
		
		                <div id="messageBox" class='col-3 yellow-light narrow center'>
		                    <p></p>
		                </div>
		            </div>
		
		
			        <p><?php
		
				        if ($id){
		
							$q = "SELECT  `id`  FROM  `video`  WHERE  `id`  = $id";
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
					    
					    <!--<input name="files[]" type="file" multiple="multiple" accept=".jpg, .jpeg, .bmp"/>-->
					    
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
						<div id='videoDisplay'>
							
						</div>
					
					</div>
				    <div class='col-2'>
					</div>    
				</div>
		
		        </div>
		
		    </div>
		<script>
			
var siteRoot = "http://localhost:90/dashboard/learning/";

var imagesPassed = "";

var videoDataDefined;

var vimeoID;

videoPassed = $("#id").text();

if (videoPassed == "") {

    var edit = 0;
    
    videoDataDefined = 0;

} else {

    var edit = 1;
    
    $('#imageUpload').hide();
    
    videoDataDefined = 1;
    
    
    fillForm(videoPassed);
    
   
    
    //constructEditTable;

}

var files;

var imageID;

var singleTag;

var images = new Object();

var textAreas = new Object();

var selects = new Object();

var selects2 = new Object();

function videoDisplay (url){
	
	
	
        if (isNormalInteger(url) === true){
        
	        $('#videoDisplay').html("<div class='videoWrapper' style='text-align: centre'><iframe id='videoChapter' src='https://player.vimeo.com/video/"+url+"' width='700' height='504' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>");
			
			$('#submitimagefiles').prop('disabled', true);
			$('#video').prop('disabled', true);
			$('#resetVideoSubmit').show();
			$('#videoForm').show();
			$('#url').val(url);
			
			
		
		}else{
			
			
			alert('Invalid vimeo id in record');
			
		}

	
	
	
}

function constructEditTable(idPassed){
	
	//imagesPassed, ajax the id to get a table in the format of the previous
	
	//get the images
	
	//get all the tags for the images
	
	
	$('#imageUpload').hide();
	
    imagesRequired = new Object;

    //imagesRequired = getNamesFormElements("images");  JSONStraightDataQuery (table, query, outputFormat)

    imagesString = '`id`=\'' + idPassed + '\'';
    
    query = "SELECT a.`id`, a.`split`, b.`name`, b.`timeFrom`, b.`timeTo`, b.`number`, b.`name` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` WHERE a.`id` = "+idPassed;

    var selectorObject = JSONStraightDataQuery("video", query, 7); //to here

    //console.log(selectorObject);

    selectorObject.done(function(data) {

        console.log(data);
		
		try{
		
        var formData = $.parseJSON(data);
        
        } catch (error) {
	        
	       console.log('No ajax data received'); 
	        
        }

		var html = "<table id=\"imagesTable\" class=\"imageTable\">";
		html += "<tr>";
		html += '<th></th>';
			html += '<th></th>';
			html += '<th>Tags</th>';
			html += '<th>Description</th>';
			html += '<th>Chapter Number</th>';
			html += '</tr>';

        $(formData).each(function(i, val) {
            
            var id = val.id;
            var image_id = val.image_id;
            var url = val.url;
            var name = val.name;
            var type = val.type;  // to here
            
            html += '<tr class="file">';
			html += "<td id='"+image_id+"' style='display:none;'>$file</td>";
			html += "<td><img src='"+siteRoot+"/"+url+"' style=\"width:128px;\"></td>";
			html += "<td><button class='addTag'>Add Tag</button></td>";
			html += "<td class='imageTag' id='tag"+image_id+"'></td>";
			html += "<td class='imageDesc'><textarea name='imagename$insert' id='imagename"+image_id+"' class='name' rows='4' cols='30'></textarea></td>";
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
		html += "<button class='save' onclick='fn60sec();'> Save data </button>";
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
            console.log('Type for image id '+image_id+' is '+type);
            console.log('Order for image id '+image_id+' is '+order);
			
		
		$("#imagename"+image_id+"").val(name);
		
		$("#imagetype"+image_id+" option[value='"+type+"']").attr('selected', 'selected');
		
		$('#content').find("#imagetype"+image_id+"").val(type);
		
		$('#content').find("#imageorder"+image_id+"").val(order);
		
		
		
		
		});
		
				query = "SELECT b.`image_id`, c.`url`, c.`name`, c.`type`, e.`tagName`, d.`id` as imagesTagid, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` WHERE a.`id` = "+idPassed;
		
		    var selectorObject = JSONStraightDataQuery("imageSet", query, 7);
		
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
	
	
	query = "DELETE FROM `images` WHERE `id` = "+imageID+"";
	
	
    var selectorObject = JSONStraightDataQuery("images", query, 8);

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


function fn60sec() {

    console.log('fired');

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


    var tagsImagesObject = JSONDataQuery('images', overallObject, 6); //update new object

    tagsImagesObject.done(function(data) {

        console.log('tagsImagesObject = ' + data);

        if (data) {
	        
	        if (data == 1){
		        
		        $('#messageBox').html('Saved at '+ new Date().toLocaleTimeString('en-GB', { hour: "numeric", 
                                             minute: "numeric"})).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);;
		        
	        }

        }

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




function fillForm(idPassed) {

    disableFormInputs("images");

    imagesRequired = new Object;

    imagesRequired = getNamesFormElements("images");

    imagesString = '`id`=\'' + idPassed + '\'';

    var selectorObject = getDataQuery("images", imagesString, getNamesFormElements("images"), 1);

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

        var imagesObject = pushDataFromFormAJAX("images", "images", "id", imagesPassed, "2"); //delete images

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

        var imagesObject = pushDataFromFormAJAX("images", "images", "id", null, "0"); //insert new object

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

        var imagesObject = pushDataFromFormAJAX("images", "images", "id", imagesPassed, "1"); //insert new object

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

        //constructEditTable(imagesPassed);
        $("#messageBox").text("Editing Video "+videoPassed);

    } else {

        $("#messageBox").text("New Video Entry");

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

            $('.modal').find('.modalContent').append('<button id="newTagCategory">Add new tag category</button>');

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

            $('.modal').find('.modalContent').append('<button id="newTag">Add new tag </button>');


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

            var selectorObject = getDataQuery('imagesTag', '`images_id` = ' + imageID + ' and `tags_id` = ' + tagID + '', {
                '0': 'images_id',
                '1': 'tags_id'
            }, 3);

            //console.log(selectorObject);
            var alreadyExists;

            selectorObject.done(function(data) {



                if (data) {

                    console.log('important data is' + data);

                    if (data == 1) {

                        alert('This image tag combination already exists');
                        alreadyExists = 1;
                        $('.modal').hide();

                        $('.darkClass').hide();

                    } else {

                        alreadyExists = 0;
                    }

                }

                if (alreadyExists == 0) {

                    var tagsImagesObject = pushDataAJAX('imagesTag', 'id', '', 0, {
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

            var selectorObject = JSONDataQuery('imagesTag', tagImages, 4); //check these don't already exist

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

                    var tagsImagesObject = JSONDataQuery('imagesTag', tagImages, 5); //insert new object

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

            $('.modal').find('.modalContent').append('<button id="newTagCategory">Add new tag category</button>');

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

            var imagesObject = pushDataAJAX('imagesTag', 'id', tagImageid, 2, ''); //delete images

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