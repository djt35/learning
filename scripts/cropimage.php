<?php
        
require ('../includes/config.inc.php');

$openaccess = 0;
$requiredUserLevel = 1;

require (BASE_URI . '/scripts/headerScript.php');

error_reporting(E_ALL);

function determineImageAndCreate ($image){

    list($width, $height, $image_type) = getimagesize($image);

    //echo $image_type;

    switch ($image_type)
    {
        case 1: $src = imagecreatefromgif($image); /*echo 'image is gif';*/ return $src; break;
        case 2: $src = imagecreatefromjpeg($image);  /*echo 'image is jpeg';*/ return $src; break;
        case 3: $src = imagecreatefrompng($image); /*echo 'image is png';*/ return $src; break;
        case 6: $src = ImageCreateFromBmp($image); /*echo 'image is bmp, not yet implemented';*/ /*return $src;*/ return false; break;
        default: /*echo 'image not valid';*/ return false;  break;
    }

    
    
}
function createThumbnail($imageinput){
    
    $image = determineImageAndCreate($imageinput);

    $thumb_width = 680;
    $thumb_height = 536;
    
    $width = imagesx($image);
    $height = imagesy($image);
    
    $original_aspect = $width / $height;
    $thumb_aspect = $thumb_width / $thumb_height;
    
    if ( $original_aspect >= $thumb_aspect )
    {
       // If image is wider than thumbnail (in aspect ratio sense)
       $new_height = $thumb_height;
       $new_width = $width / ($height / $thumb_height);
    }
    else
    {
       // If the thumbnail is wider than the image
       $new_width = $thumb_width;
       $new_height = $height / ($width / $thumb_width);
    }
    
    $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
    
    // Resize and crop
    imagecopyresampled($thumb,
                       $image,
                       0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                       0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                       0, 0,
                       $new_width, $new_height,
                       $width, $height);
    
    return $thumb;
    
    }

function cropImage ($image, $type){
    
    //echo $image;
    //echo '<img src="'.$image.'">';

    //1 olympus centre
    //2 pentax left

    // Create image from JPEG
    $im = $image;
    
    // Create an image from given image FILE 
    //$im = imagecreatefromstring(file_get_contents($image)); 

    
     
    // find the size of image 
    //echo $imagey = imagesx($im);
    $size = min(imagesx($im), imagesy($im)); 
    
    //can we tell from the size of the input image which format it is?  therefore can be resized without $type

    // Set the crop image size  
    if ($type==1){

        //olympus middle
        $im2 = imagecrop($im, ['x' => 310, 'y' => 0, 'width' => 1330, 'height' => 1080]);

    }elseif ($type==2){
        //pentax left  //bottom 1024, right 1264
        $im2 = imagecrop($im, ['x' => 42, 'y' => 60, 'width' => 1222, 'height' => 964]);

    }elseif ($type==3){
        //olympus ultrathin  //l 570px, r 1580px, t 35px, b 1045px
        $im2 = imagecrop($im, ['x' => 570, 'y' => 35, 'width' => 1010, 'height' => 1010]);

    }

     

    if ($im2 !== FALSE) { 
        //echo 'image created';
        return $im2;
    }else{

        //echo 'image not created';
    }
    /*if ($im2 !== FALSE) { 
        header("Content-type: image/jpeg"); 
           imagejpeg($im2); 
        imagedestroy($im2); 
    } */

    //imagedestroy($im); 
    
    

    
}
function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    //echo $r;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            //echo 'new width is ' . $newwidth; 
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    if ($src){

        //echo 'file successfully created from image';
    }

    $dst = imagecreatetruecolor($newwidth, $newheight);

    if ($dst){

        //echo 'new image successfully created';
    }
    $var = imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}
function alternateResize ($image, $newwidth, $newheight){

    list($width, $height) = getimagesize($image);

    $src = determineImageAndCreate($image);
    if ($src){

        //echo 'file successfully created from image';
    }

    $dst = imagecreatetruecolor($newwidth, $newheight);

    if ($dst){

        //echo 'new image successfully created';
    }
    $var = imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;


}
function addWatermarkImage ($imageinput, $stampinput){

    //file as input

    $image = imagecreatefromjpeg($imageinput);

    $stamp = imagecreatefrompng($stampinput);

    if ($stamp){

        //echo 'stamp image created';
    }
    
    $right = 10;
    $bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    $im = imagecopymerge($image, $stamp, 0, 0, 0, 0, imagesx($stamp), imagesy($stamp), 10);

    if ($im){

        //echo 'image merge complete';
        return $image;
    }

    

}
function addWatermarkText ($imageinput, $text){

    $image = imagecreatefromjpeg($imageinput);

    $stamp = imagecreatetruecolor(200, 70);
    imagefilledrectangle($stamp, 0, 0, 199, 169, 0x0000FF);
    imagefilledrectangle($stamp, 9, 9, 190, 60, 0xFFFFFF);
    imagestring($stamp, 5, 20, 20, 'Endoscopy wiki', 0x0000FF);
    imagestring($stamp, 3, 20, 40, 'Author: '. $text, 0x0000FF);

    $right = 10;
    $bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    $im = imagecopymerge($image, $stamp, 960, 960, 0, 0, imagesx($stamp), imagesy($stamp), 50);

    if ($im){

        //echo 'image merge complete';
        return $image;
    }

}
function spliceFilename ($filename, $textToInsert, $requiredextension){

    //remove .and extension
    $arr = explode(".", $filename, 2);
    $first = $arr[0];

    //return new filename

    $filenameToReturn=$first . $textToInsert . '.' . $requiredextension;

    return $filenameToReturn;

}
function insertExtraDirectory ($filename, $textToInsert){

    //remove .and extension
    $arr = explode("/", $filename);
    $lastpart = $arr[3];

    //return new filename

    $filenameToReturn='includes/images' . '/' . $textToInsert . '/' . $lastpart;

    return $filenameToReturn;

}
//designed for ajax
////echo 'Image generation script';

//parameters
//imageSet
//crop yes no
//type of image 1 olympus 2 pentax
//always resize /resized
//always generate thumbnail image /thumbnails
//always create watermark version /watermarked

//put the original image in a subfolder with name originals and same filename
//create a thumbnail of the image at 1/8 size
//save this name to the database
//return the log file in console



$general = new general;


function ne($v) {
return $v != '';
}

$errors = array();
$messages = array();

if (count($_GET) > 0){

    

    $data = $general->sanitiseGET($_GET);

   
    //echo implode(" ",$data);

    $messages[] = implode(" ",$data);

    if (isset($data['imageSet'])){
        
        $imageSet = $data['imageSet'];
        $messages[] = 'Manipulating imageset id ' . $imageSet;

    }else{

        $imageSet = 0;
        $errors[] = 'imageSet not set in get array';
        print_r($errors);
        exit();

    }

    if (isset($data['crop'])){
        
        $crop = $data['crop'];
        $messages[] = 'Crop was set as '.$crop;

    }else{

        $crop = 0;
        $errors[] = 'crop not set in get array';

    }

    if ($crop == 1){

        if (isset($data['type'])){
        
            $type = $data['type'];
            $messages[] = 'Type was set as '.$type;
    
        }else{
    
            $errors[] = 'image type not set in get array yet crop requested';
    
        }

    }

    //get array of images from the imageset id

    $imageSetFilenameArray = $general->getFilenamesImageSetid($imageSet);

    $messages[] = 'Filenames to manipulate were' . implode(" ",$imageSetFilenameArray);

    if ($imageSetFilenameArray){

        //print_r($imageSetFilenameArray);

        foreach ($imageSetFilenameArray as $key=>$value){

            $imagename = $value;

            $messages[] = 'Image name ' . $imagename;

            //copy the original to original folder

            $copyfolderpath = insertExtraDirectory ('/'.$imagename, original);

            copy(BASE_URI . '/' . $imagename, BASE_URI . '/' . $copyfolderpath);

            $messages[] = BASE_URI . '/' . $imagename . ' copied to ' . BASE_URI . '/' . $copyfolderpath;

            $messages[] = substr(sprintf('%o', fileperms(BASE_URI . '/' . $imagename)), -4);
            
            //crop image

            if ($crop == '1' && isset($type)){

                $image = determineImageAndCreate(BASE_URI . '/' . $imagename);

                if ($image){

                    $messages[] = 'determineiMAGEandCreate worked';

                }else{

                    $errors[] = 'determineiMAGEandCreate did not work';
                }
                //if size of image w is >?? as constraint, i.ee do not resize an image not requiring it

                //print_r($image);

                $image = cropImage($image, $type);

                //print_r($image);

                echo $imagename;

                $cropexecuted = imagejpeg($image, BASE_URI . '/' . $imagename);

                if ($cropexecuted == 1){

                    $messages[] = BASE_URI . '/' . $imagename . ' cropped to ' . BASE_URI . '/' . $imagename;

                }else{

                    $errors[] = 'error, cropped image not saved';

                }

            }else{

                $messages[] = 'crop or type were not set so no cropping performed';
            }
            
            //resize

            $image = alternateResize(BASE_URI . '/' . $imagename, '1350', '1064');
            
            imagejpeg($image, BASE_URI . '/' . $imagename);

            //watermark

            $watermarkfolderpath = insertExtraDirectory ('/'.$imagename, 'watermark');

            //echo $watermarkfolderpath;

            $useridauthor = $general->getAuthorImageSet($imageSet);

            //echo $useridauthor . '****';

            $authorname = $general->getUserName($useridauthor);

            //echo $authorname;

            $image = addWatermarkText(BASE_URI . '/' . $imagename, $authorname);

            imagejpeg($image, BASE_URI . '/' . $watermarkfolderpath);

            //watermarkImage

            $watermarkImagefolderpath = insertExtraDirectory ('/'.$imagename, 'watermarkImage');

            $image = addWatermarkImage(BASE_URI . '/' . $imagename, BASE_URI . '/' . 'includes/images/stamp.png');

            imagejpeg($image, BASE_URI . '/' . $watermarkImagefolderpath);

            //thumbnail

            $imageThumbnailpath = insertExtraDirectory ('/'.$imagename, thumbnail);

            $imageThumbnail = createThumbnail(BASE_URI . '/' . $imagename);

            imagejpeg($imageThumbnail, BASE_URI . '/' . $imageThumbnailpath);

            imagedestroy($image);
            imagedestroy($imageThumbnail);

            

            

        }
    }else{

        $errors[] = 'imageset does not exist';
    }
    






//print_r($GLOBALS);

}else{

    $errors[] = 'GET array was empty';

}

if (empty($errors)){

    $general->setManipulatedImageSet($imageSet);
    echo 'Image Manipulation Complete';
    //print_r($messages);
}else{

    print_r($errors);
    print_r($messages);
}


//print_r($errors);
//print_r($messages);
//expecting $images which is an array of filenames


//for each image








    //also pass the type of image ie olympus middle, pentax left etc.



/*
Olympus middle crop
l 310px
r 1660px
t 0px
b 1080px
resize 1330 x 748

*/

?>