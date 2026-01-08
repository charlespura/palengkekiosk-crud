
<?php
// Enable error display and logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set error log file
ini_set('error_log', 'error.log');
?>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "palengke_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
} else {
    echo "Database Connected Successfully!";
}
?>
