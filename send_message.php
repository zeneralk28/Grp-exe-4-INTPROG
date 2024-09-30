<?php

$host = 'localhost'; 
$dbname = 'dbpersonal'; 
$username = 'root';
$password = ''; 

//Send info to the database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
    //POST request
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $recipient = htmlspecialchars($_POST['recipient']);
    $message = htmlspecialchars($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO messages (name, email, recipient, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_Param("ssss", $name, $email, $recipient, $message);

    if ($stmt->execute()) {

        header("Location: message_receipt.php?name=$name&email=$email&recipient=$recipient&message=$message");
        exit();
    } else {
        echo "Failed to send the message.";
    }

  }

$stmt->close();
$conn->close();
?>
