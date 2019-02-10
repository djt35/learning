<?php


session_start();

$host = substr($_SERVER['HTTP_HOST'], 0, 5);
if (in_array($host, array('local', '127.0', '192.1'))) {
    $local = TRUE;
} else {
    $local = FALSE;
}

//echo 'document root is' . $_SERVER['DOCUMENT_ROOT'];

if ($local){

    $root = $_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/';
    $roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/dashboard/learning/';
    require($_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/includes/config.inc.php');
}else{
    $root = $_SERVER['DOCUMENT_ROOT'];
    $roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/';

    require($_SERVER['DOCUMENT_ROOT'].'/includes/config.inc.php');

}



//echo $root;

?>


        <script src="<?php echo $roothttp . 'includes/jquery.min.js'; ?>" type="text/javascript">
</script>
   
	    <script src="<?php echo $roothttp . 'includes/generaljs.js'; ?>" type="text/javascript">
</script>

	    
</script>



<script>
	
	
	
</script>



<?php echo '<script src="' . $roothttp . 'includes/jquery.validate.js"></script>';

    echo '<link rel="stylesheet" type="text/css" href="'. $roothttp . '/styles%20image.css">';
    
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';


    ?>
