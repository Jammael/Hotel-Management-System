<?php
// ensure_login.php
// Accepts any query parameters and redirects the user to bookroom.php if logged in.
// Otherwise redirects to user_login.php with a next= parameter that preserves the intended destination and query.

$conn = new mysqli("localhost","root","", "iwp");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// fetch the stored session token (if you keep single-row temp_session)
$sql = "SELECT * FROM temp_session LIMIT 1";
$result = $conn->query($sql);
$row = $result ? $result->fetch_row() : null;

// Build the destination (bookroom.php plus original query string if present)
$qs = '';
if(!empty($_SERVER['QUERY_STRING'])){
    $qs = '?' . $_SERVER['QUERY_STRING'];
}

// Validate that there is both a temp_session row and a matching non-empty auth cookie
$logged = false;
if ($row && !empty($row[0]) && !empty($_COOKIE['hotel_auth'])) {
    // strict equality check
    if (hash_equals((string)$row[0], (string)$_COOKIE['hotel_auth'])) {
        $logged = true;
    }
}

if($logged){
    header('Location: bookroom.php' . $qs);
    exit();
} else {
    $intended = 'bookroom.php' . $qs;
    header('Location: user_login.php?next=' . urlencode($intended));
    exit();
}

?>
