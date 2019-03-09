<?php
	
    error_reporting(0);

    require (BASE_URI . '/includes/login_functions.php');
    
    //place to redirect the user if not allowed access
    $location = BASE_URL . '/index.php';

   
    
    require(BASE_URI . '/scripts/interpretUserAccess.php');
?>


        <script src="<?php echo BASE_URL . '/includes/jquery.min.js'; ?>" type="text/javascript">
</script>
   
	    <script src="<?php echo BASE_URL . '/includes/generaljs.js'; ?>" type="text/javascript">
</script>

	    

