<?php
// Database connection parameters
$servername = "localhost";
$username = "root";  // Your database username
$password = "";      // Your database password (leave empty if no password)
$dbname = "signup_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $firstname = $conn->real_escape_string(trim($_POST['firstname']));
    $lastname = $conn->real_escape_string(trim($_POST['lastname']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $address1 = $conn->real_escape_string(trim($_POST['address1']));
    $whatsapp = $conn->real_escape_string(trim($_POST['whatsapp']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $password = $conn->real_escape_string(trim($_POST['password']));

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (firstname, lastname, email, address1, whatsapp, phone, password)
            VALUES ('$firstname', '$lastname', '$email', '$address1', '$whatsapp', '$phone', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Sign up successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
