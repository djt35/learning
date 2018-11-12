 <?php  
        $page_title='Logout of iACE Learning';
        $page_header='Logout';
        include ('image_header.php');  ?> 

    <div id="navi">
        <li><a href="http://www.acestudy.net">Main ACE Site</a></li>


    </div>
    
</div>
</header>
   
<div class="content">

   <?php // Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
    
    ?>
    
<h1>Logged Out!</h1>
 <p>You are now logged out!</p>
    </div>
   <?php include ('footer.html'); ?>

