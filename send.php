<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iste_responses";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['message'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $message = $_POST['message'];

  $stmt = $conn->prepare("INSERT INTO responses(firstname, lastname, email, phone, address, message) VALUES (?, ?, ?, ?, ?, ?)");

  $stmt->bind_param("sssiss", $firstname, $lastname, $email, $phone, $address, $message);

  if ($stmt->execute()) {
    echo "Thanks for Submitting!";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "Please fill out all fields.";
}

$conn->close();
?>
