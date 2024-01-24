<?php
// PHP Script (register.php)
$db_host = 'localhost';  // Your MySQL host
$db_user = 'shadland_sl';  // Your MySQL username
$db_pass = 'Wicked5622!';  // Your MySQL password
$db_name = 'shadland_sl';  // Your MySQL database name

// Create connection
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get the username and UUID from the POST request
$username = $_POST['username'];
$uuid = $_POST['uuid']; // Assuming UUID is sent via POST

// Generate a random 10-character password
$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $mysqli->prepare("INSERT INTO users (username, password, uuid) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hashed_password, $uuid);

// Execute
$stmt->execute();

// Send a success message
echo "Welcome! Your account has been created. Your username is $username.";

$stmt->close();
$mysqli->close();
?>
