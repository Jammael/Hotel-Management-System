<?php
// user_logged_in.php - handle login POST and redirect before any output so cookies/headers work
$conn = new mysqli("localhost","root","", "iwp");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Basic validation
if(!isset($_POST['phone']) || !isset($_POST['password'])){
    header('Location: user_login.php');
    exit();
}

$phone = $_POST['phone'];
$pwd = $_POST['password'];
$next = isset($_POST['next']) && !empty($_POST['next']) ? $_POST['next'] : 'user_view.php';

// Look up user (kept simple to match existing app behaviour)
$sql = "SELECT * FROM user_login WHERE phone = '" . $conn->real_escape_string($phone) . "' LIMIT 1";
$res = mysqli_query($conn, $sql);
if($res && ($row = mysqli_fetch_row($res))){
    // row[0]=phone, row[1]=password, row[2]=name ... (existing order)
    if($pwd === $row[1]){
        // replace temp_session with current user
        mysqli_query($conn, "DELETE FROM temp_session");
        $ins = sprintf(
            "INSERT INTO temp_session VALUES('%s','%s','%s','%s','%s','%s')",
            $conn->real_escape_string($row[0]),
            $conn->real_escape_string($row[1]),
            $conn->real_escape_string($row[2]),
            $conn->real_escape_string($row[3]),
            $conn->real_escape_string($row[4]),
            $conn->real_escape_string($row[5])
        );
        mysqli_query($conn, $ins);

        // set a short-lived auth cookie before any output
        setcookie('hotel_auth', $row[0], time()+3600, '/');

        // redirect to intended page
        header('Location: ' . $next);
        exit();
    }
}

// If we reach here, login failed - redirect back to login (optionally preserve next)
$loginUrl = 'user_login.php';
if(!empty($next)){
    $loginUrl .= '?next=' . urlencode($next);
}
header('Location: ' . $loginUrl);
exit();
?>