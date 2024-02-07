<?php
// Process the form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $sport = $_POST["sport"];
    $experience = $_POST["experience"];
    $additional_info = $_POST["additional_info"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sports";
 
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
 
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 
    // Prepare and execute the SQL query using prepared statements
    $sqlquery = "INSERT INTO Sports (full_name, email, phone, age, sport, experience, additional_info) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sqlquery);
    $stmt->bind_param("ssiisss", $full_name, $email, $phone, $age, $sport, $experience, $additional_info);

    if ($stmt->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    
    // Output form data
    echo "<h2>Form Data:</h2>";
    echo "Full Name: " . $full_name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Phone: " . $phone . "<br>";
    echo "Age: " . $age . "<br>";
    echo "Sport: " . $sport . "<br>";
    echo "Experience: " . $experience . "<br>";
    echo "Additional Information: " . $additional_info . "<br>";

    // Close the database connection
    $conn->close();
}
?>