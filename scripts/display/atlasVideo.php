


		<?php

require ('../../includes/config.inc.php'); require (BASE_URI.'/scripts/headerCreator.php');

$formv1 = new formGenerator;
$general = new general;
$video = new video;
$tagCategories = new tagCategories;
$db = new DataBaseMysql;
$user = new users;




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
		    <title>Endoscopy Video Atlas</title>
		</head>

		<style>

			.content, #menu, .responsiveContainer {

				color: white;
				background-color: black;



			}

			.content {

				max-height:none;

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

			[class*="col-"] {
			    float: left;
			    padding: 15px;
			    /*border: 1px solid red;*/
			}

			[class*="slim-col-"] {
			    float: left;
			    padding: 1px;
			    /*border: 1px solid red;*/
			}




		</style>

		<?php
include(BASE_URI . "/scripts/logobar.php");

include(BASE_URI . "/includes/naviv1.php");

spl_autoload_unregister('class_loader');

require(BASE_URI . '/scripts/autoload.php');
use Vimeo\Vimeo;
// Get this from your account
$vimeo_client_id = '47b9e04f8014da6dc06bbd4b5879d2f3dff2fc1c';
$vimeo_client_secret = '+7btjhyrrfEaZpAfLX81+pPrxOYlIS9A2d5Jj27GU7JyprVjwBGHK0+LE/XS0++3Ai060tT4msKZa4LbOQFOwOANa8JWqvz6D4k7XXFi4g8vEoBrH6Oh3RwQlaZUZCuP';

// This has to be generated on your site, plugin or theme
$vimeo_token = 'cc33c4732d5f31ff9b681b23591bd95d';
error_reporting(-1);

$client = new Vimeo($vimeo_client_id, $vimeo_client_secret, $vimeo_token);




//spl_autoload_register ('class_loader');

function getAllVideos ($tagCategoriesid) {

	global $db;
	global $client;
	global $user;

	//shows all videos in the tagCategory

	//$client = new Vimeo($vimeo_client_id, $vimeo_client_secret, $vimeo_token);

	$q = "SELECT a.`id`, a.`url`, a.`name`, a.`author`, a.`description`, a.`thumbnail`, DATE_FORMAT(a.`created`, '%M %d %Y') as created, d.`tagName`, d.`id` as `tags_id` FROM `video` as a INNER JOIN `chapter` as b ON a.`id` = b.`video_id` INNER JOIN `chapterTag` as c ON b.`id` = c.`chapter_id` INNER JOIN `tags` as d ON d.`id` = c.`tags_id` INNER JOIN `tagCategories` as e on e.`id` = d.`tagCategories_id` WHERE e.`id` = $tagCategoriesid GROUP BY a.`id` ORDER BY d.`tagName` ASC";

	//echo $q;

	//shows highest rated (1) images from each tag category

	//$q = "SELECT a.`id` as `imageSetid`, b.`image_id` as `imageid`, c.`url`, c.`name`, c.`order`, c.`type`, e.`tagName`, d.`tags_id` FROM `imageSet` as a INNER JOIN `imageImageSet` as b ON a.`id` = b.`imageSet_id` INNER JOIN `images` as c on b.`image_id` = c.`id` INNER JOIN `imagesTag` as d ON c.`id` = d.`images_id` INNER JOIN `tags` as e ON d.`tags_id` = e.`id` INNER JOIN `tagCategories` as f on f.`id` = e.`tagCategories_id` WHERE f.`id` = $tagCategoriesid AND c.`type` = 1 ORDER BY e.`tagName` ASC, `imageSetid` ASC, c.`order` ASC";
	//var_dump($db->connection->RunQuery("hello"));

	$result = $db->RunQueryDebug($q);

	if ($result->num_rows > 0){

		$x = 1;
		$y = 1;
		$lesionid='';
		echo "<hr>";
		echo "<div class='row tagSet'>";


		while($row = $result->fetch_array(MYSQLI_ASSOC)){


			if ($tagName){
				if ($tagName != $row['tagName']){ //for imageset then reset the row somehow

					echo "</div>";
					echo "<hr>";
					echo "<div class='row tagSet'>";
					//echo "<h3 style='text-align:left;'>$tagName</h3>";
					$x=1;

				}
			}

			$filename = $row['url'];
			//$position = $row['position'];
			$lesionid = $row['id'];
			$imageSetid = $row['imageSetid']; //implement later for videoset
			$name = $row['name'];
			$tagName = $row['tagName'];
			$tags_id = $row['tags_id'];
			$description = $row['description'];
			$author = $row['author'];
			$created = $row['created'];
			$thumbnail = $row['thumbnail'];

			//get all the tags for this tag with their category
			//does this show all tags for a specific image


			//echo "<div class='col-2' data='$x'><div class='description'>$name";
			//echo "</div>";

			//echo "</div>";
			if ($x == 1){echo "<div class='responsiveContainer'><div class='row'><div class='col-8'><h3 style='text-align:left; cursor:pointer;' id='tag{$tags_id}' class='tagLink'>$tagName</h3></div><div class='col-2'></div></div></div>";}
			
			//removed above <button type='button' class='blueButton uptodateSearch'>Search UpToDate</button></div><div class='col-2 allow2'><button type='button' class='blueButton pubMedSearch'>Search PubMed</button>

			if($x % 3 == 0){echo "<div class='row'>";  }

			echo "<div data='$x' class='col-4' style='border-right: 2px solid gray; border-left: 2px solid gray;'>";

			echo "<div class='row'>";

			echo "<div class='col-12'>";

			//$response = $client->request('/videos/' . $filename);

			//$urlThumbnail = $response['body']['pictures']['sizes'][4]['link'];

			echo "<img id='$lesionid' data='imageSet{$imageSetid}' class='lslimage zoom' src='$thumbnail' style='border-style: solid; border-width: 2px; border-color:gray;'>";
			//echo "<img id='$lesionid' class='lslimage zoom' src='https://www.acestudy.net/studyserver/$filename'>";
			//echo "<div class='caption'>$name</div>";
			//echo "</div>";
			echo "</div>";

			echo "</div>";

			echo "<div class='row veryNarrow'>";

			echo "<div class='col-12 veryNarrow'>";

			echo "<b>" . $name . "</b>";

			echo '<p style="font-size : 13px;">'.$description.'</p>';
			echo '<p style="font-size : 13px; text-align:right;">Author : '.$user->getUserName($author).' | Created : '.$created.'</p>';
			//echo '<p style="font-size : 13px; text-align:right;"></p>';

			echo "</div>";

			echo "</div>";

			echo "</div>";

			if($x % 3 == 0){echo "</div>";}

			$x++;

			continue;







		}echo "</div>";

	}

}

$uri = '/videos/259042119';

$video_id = '259042119';

//php




/*
		try {
		  */
/*$client->request($uri . '/privacy/domains/http://example.com', 'PUT');
			$client->request($uri, array(
			  'privacy' => array(
			    'embed' => 'whitelist'
			  )
			), 'PATCH');

			echo $uri . ' will only be embeddable on "http://example.com".';*/

//$result = $client->request('/videos/' . $video_id);

//print_r($result);
//$response = $client->request('/tutorial', array(), 'GET');

/*
		} catch (Exception $e) {
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		}*/



//print_r($response);


//$vimeo = new Vimeo( $vimeo_client_id, $vimeo_client_secret );

//$vimeo->setToken( $vimeo_token );

//$result = $client->request('/videos/' . $video_id);

//print_r($result);

// Video width and height
//$video_w = $result['body']['width'];
//$video_h = $result['body']['height'];

// Data for thumbnail with index 1
//$thumb_data = $result['body']['pictures']['sizes'][4]['link'];
//print_r($thumb_data);

// This is your thumbnail URL
//$thumb_url = $thumb_data['link'];

?>

		

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

			<div id="images" style="display:none;"><?php ?></div>

			<?php echo $general->getVideoIdsProcedure(); //gets data for tagCategories and imageids?>


		    <div id='content' class='content'>

		        <div class='responsiveContainer white'>

			        <div class='row'>
		                <div class='col-9'>
		                    <h2 style="text-align:left;">Endoscopic Resection Video Atlas</h2>
		                    <p style='text-align:left;'>Use the buttons below to filter the videos.  Clicking a video will take you to it.</p>
		                    <div id='procedureTagsDisplay' class='responsiveContainer' style='text-align:left;'>
			                    <div class='col-9'>

			                    Procedural tags:


			                    </div>
			                    <div id='resetButtonDiv' class='col-3'>
			                    </div>
		                    </div>
		                </div>

		                <!--<div id="messageBox" class='col-3 yellow-light veryNarrow center'>

		                    <p><button id="captionHide" class="modifiers">Toggle captions</button></p>
		                </div>-->
		            </div>




			    <div class='row' id='imageTitle'>

			    </div>

			    <div id='imageDisplay'>

				<?php echo getAllVideos('40');?>


				</div>

				<!--<div class='row' id='imageDisplay'>
					<div class='col-2'>
					</div>
					<div class='col-8'>

					</div>
				    <div class='col-2'>
					</div>
				</div>-->

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

}

var files;

var imageID;

var singleTag;

var images = new Object();

var textAreas = new Object();

var selects = new Object();

getSearchboxTerms();


function getSearchboxTerms (){

	var selectorObject = getDataQuery('tags', 'tagCategories_id = 38', {
            'id': 'id',
            'name': 'tagName'
        }, 1);

        //console.log(selectorObject);

        selectorObject.done(function(data) {

            console.log(data);

			var searchData = $.parseJSON(data);

			console.dir(searchData);

			$.each(searchData, function(key, value) {

				var id = value['id'];
				var name = value['tagName'];

		       	$('#json-datalist').append('<option value="'+name+'" data-id="'+id+'"></option>');

		        //data.append(key, value);



		    });

            $('#searchBox').attr("placeholder","Start typing an endoscopic diagnosis...");



        })



}

//!new

//get all procedure tags and insert at the top of the document

function insertProcedureTags () {

	var data = $('#procedureTags').text();

	var formData = $.parseJSON(data);



	$.each(formData, function(key, value) {

		var tagid = value['tagid'];
		var tagName = value['tagName'];

       	html = '<button id="' + tagid + '" class="tagButton">'+tagName+'</button>';

       	$('#procedureTagsDisplay').find('div').first().append(html);

       	//console.log(html);

        //data.append(key, value);

	});


}

function getAllImages () {


 request = $.ajax({
	        url: siteRoot + "scripts/getImages.php",
	        type: "get",
	        data: 'tagid='+option,

		   });

		   request.done(function(data){

			   if (data){

			    $('#imageTitle').html('<h3 style="text-align:left;">'+value+'</h3>');
			   	$('#imageDisplay').html(data);

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

        textAreas[x] = textareaText;

        x++;


    })

    x = 0;

    $('#imagesTable').find('tr').find('td:eq(5)').find('select').each(function() {

        console.log(this);

        var selectValue = $(this).val();

        selects[x] = selectValue;

        x++;


    })

    console.dir(images);
    console.dir(textAreas);
    console.dir(selects);

	//these need the field names

    overallObject['id'] = images;
    overallObject['type'] = selects;
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
//setInterval(fn60sec, 60 * 1000);


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



    insertProcedureTags();


    //$('#searchBox').attr("placeholder","Loading options...");


    //$('input[type=file]').on('change', prepareUpload);

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


    //!new

	//!start of filter tag buttons code
    //!detect click on tag button and filter the below

    $('.tagButton').on('click', function(){

	    //get the tag id

	    $(this).removeClass('tagbutton').addClass('greenButton');

	    $(this).siblings().removeClass('greenButton').addClass('tagButton');

	    var tagid = $(this).attr('id');
	    
	    console.log(tagid);

	    //get the array of images with their procedure tags

	    var data = $('#imageMatchProcedure').text();

		var formData = $.parseJSON(data);



		$.each(formData, function(key, value) {

			var tagidInner = value['tagid'];
			var tagName = value['tagName'];
			var imageid = value['videoid'];

			if (tagid == tagidInner){

				$('#'+imageid).show();
				
				console.log(imageid + 'should be shown');

			}else{

				$('#'+imageid).hide();

			}



		})

		$('.tagSet').show();

		$('.tagSet').prev().show();

		//$(tagSet).closest('hr').show()

		$('.tagSet').each(function(){

			var tagSet = $(this);

			console.dir(this);

			console.log('img length = ' + $(this).find('img:visible').length);

			if ($(this).find('img:visible').length == 0){

				console.log('no images');

				$(tagSet).hide();

				$(tagSet).prev().hide();

			} else {

				console.log('images');

				$(tagSet).show();

				//$(tagSet).closest('hr').show()

			}


		})

	     // add a reset tag underneath the last tag row

	     html = '<div style="text-align:left;"><button class="resetTags greenButton">'+'Show All'+'</button></div>';

	     if ($('#resetButtonDiv').find('.resetTags').length == 0){

		      $('#resetButtonDiv').append(html);

	     }




    })

    //reset tags button

    $('.content').on('click', '.resetTags', function() {


	    $('.tagSet').show();

		$('.tagSet').prev().show();

		$('.lslimage').show()

		//var hello = $(this).parent().parent().prev().children();

		//console.log(hello);

		$(this).parent().parent().prev().children().removeClass('greenButton').addClass('tagButton');

		$(this).remove();


	})

	//take to the individual tag display page

	$('.tagLink').on('click', function (){

		var tagid = $(this).attr('id');

		tagid = tagid.slice(3);

		window.location.href = siteRoot + "scripts/display/atlasTag.php?id="+tagid;




	})

	$('.pubMedSearch').on('click', function (){


		//get the tag name

		var searchTerm = $(this).parent().prev().prev().find('h3').html();

		console.log(searchTerm);

		PopupCenter("https://www.ncbi.nlm.nih.gov/pubmed?term="+searchTerm, 'PubMed Search (endoWiki)', 600, 700);





	})

    $('.uptodateSearch').on('click', function (){


		//get the tag name

		var searchTerm = $(this).parent().prev().find('h3').html();

		console.log(searchTerm);

		PopupCenter("https://www.uptodate.com/contents/search?search="+searchTerm, 'UpToDate Search (endoWiki)', 600, 700);





	})

	$('.content').on('click', '.lslimage', function(){


		var searchTerm = $(this).attr('id');

		console.log(searchTerm);

		//searchTerm = searchTerm.slice(8);

		window.location.href = siteRoot + "scripts/display/displayVideo.php?id="+searchTerm;



	})




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

    /*$("#content").on('click', '.tagButton', (function(event) {

        var button = $(this);

        var tagImageid = $(this).attr('id');

        // console.log(tagImageid);

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

    */

    $("#content").on('change', '#searchBox', (function(event) {

        var value = $(this).val();
		var option = $('#json-datalist').find("[value='" + value + "']").attr('data-id');


		  console.log('Tag to look for images is '+option);

		  //tagid

		  request = $.ajax({
	        url: siteRoot + "scripts/getImages.php",
	        type: "get",
	        data: 'tagid='+option,

		   });

		   request.done(function(data){

			   if (data){

			    $('#imageTitle').html('<h3 style="text-align:left;">'+value+'</h3>');
			   	$('#imageDisplay').html(data);

			   }

		   });




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

    $('.content').on('click', '#captionHide', function() {

        $('.caption').toggle();

		if ($(this).text() == 'Toggle captions'){

			$(this).text('Captions shown');

		}

		if ($(this).text() == 'Captions shown'){

			$(this).text('Captions hidden');

		} else if ($(this).text() == 'Captions hidden'){

			$(this).text('Captions shown');

		}

		//$(this).text('Captions shown');



        //window.open(siteRoot + "scripts/forms/tagsForm.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=700");



    })

    $('.content').on('click', '#resetPage', function(event) {
		event.preventDefault();
        $('#imageTitle').html('');
		$('#imageDisplay').html('');
		$('#searchBox').val('');



        //window.open(siteRoot + "scripts/forms/tagsForm.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=700");



    })

    //! allows opening of navbar with click

    $('.dropbtn').on('click', function(){

		//console.dir(this);



		$(this).parent().find('.dropdown-content').toggle();


	})






})
			</script>
		<?php

// Include the footer file to complete the template:
include(BASE_URI . "/includes/footer.html");




?>
		</body>
		</html>