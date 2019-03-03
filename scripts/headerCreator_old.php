<?php

require ('../includes/config.inc.php');
$location = BASE_URL . '/elearn.php';

session_start();
if (!isset($_SESSION['user_id'])) {

    // Need the functions:
    require (BASE_URI . '/includes/login_functions.php');
    redirect_login($location);
}

//echo $root;

?>


    <script src="<?php echo BASE_URL . '/includes/generaljs.js'; ?>" type="text/javascript">
</script>
    <script src="<?php echo BASE_URL . '/includes/jquery.min.js'; ?>" type="text/javascript">
</script>
   
	    
	    
</script>

<script src="<?php echo BASE_URL . '/includes/generaljs.js'; ?>" type="text/javascript"></script>



<?php echo '<script src="' . BASE_URL . '/includes/jquery.validate.js"></script>';

    echo '<link rel="stylesheet" type="text/css" href="'. BASE_URL . '/styles%20image.css">';


    ?>
