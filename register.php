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

// Get the username and uuid from the POST request
$username = $_POST['username'];
$uuid = $_POST['uuid'] ?? ''; // Fallback to empty string if uuid is not set

// Generate a random 10-character password
$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $mysqli->prepare("INSERT INTO users (username, uuid, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $uuid, $hashed_password);

// Execute
$stmt->execute();

// Send a success message
echo "Welcome! Your account has been created. Your username is $username. and your password is $password";

$stmt->close();
$mysqli->close();
?>
