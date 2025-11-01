<?php
<?php
// logout.php
$conn = new mysqli("localhost","root","", "iwp");
if($conn->connect_error){
    // if DB is unavailable still clear cookie and redirect
    setcookie('hotel_auth', '', time()-3600, '/');
    header('Location: user_login.php');
    exit();
}

// Remove any stored temp session(s)
// Use TRUNCATE if you keep single-row temp_session; otherwise DELETE by token.
$conn->query("TRUNCATE TABLE temp_session");

// Clear the auth cookie
setcookie('hotel_auth', '', time()-3600, '/');
// Optionally unset $_COOKIE locally
unset($_COOKIE['hotel_auth']);

// Destroy PHP session if used
if (session_status() !== PHP_SESSION_NONE) {
    session_unset();
    session_destroy();
}

header('Location: user_login.php');
exit();
?>