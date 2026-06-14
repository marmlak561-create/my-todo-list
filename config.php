<?php
$servername = "sql208.infinityfree.com";  // غيّرها حسب سيرفر قاعدة البيانات عندك
$username = "	if0_42183235";
$password = "NjiXaiL7fe";
$dbname  = "todo_list";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: (" . $conn->connect_errno . ") " . $conn->connect_error);
}
echo "Connected successfully";
?>
