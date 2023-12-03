<?php
 $FirstName = filter_input(INPUT_POST, 'FirstName');
 $lastName = filter_input(INPUT_POST, 'LastName');
 $email = filter_input(INPUT_POST, 'Email');
 $password = filter_input(INPUT_POST, 'Password');
 $phoneNumber = filter_input(INPUT_POST, 'PhoneNumber');
 $address = filter_input(INPUT_POST, 'Address');
 $support = filter_input(INPUT_POST, 'Support');
 $description = filter_input(INPUT_POST, 'Description');
 $Status = filter_input(INPUT_POST, 'Status');


 if(empty($firstName) || !empty($lastName) || !empty($email) || !empty($password) || !empty($phoneNumber) || !empty($address) || !empty($supportType) || !empty($description) || !empty($Status))


 $host = "localhost";
 $username = "koi";
 $password = "1234";
 $dbname = "donors"; 

 $conn = new mysqli($host, $username, $password, $dbname);

 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }else{
    $sql = "INSERT INTO donor (`FirstName`, `LastName`, `Email`, `Password`, `PhoneNumber`, `Address`, `Support`, `Description`, `Status`)
    values ('$FirstName', '$lastName', '$email', '$password', '$phoneNumber','$address' ,'$support', '$description','$Status')";
    if ($conn->query($sql)){
        echo "New record is inserted";}
        else{ 
            echo "Error: ". $sql ."<br>". $conn->error;
        }}
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
            header("Location: Todonor.html");
            exit(); 
         }
 
        $conn->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="registerdonor.css">
</head>
<body>
<style>
        body {
            background-color: #000000; /* Green background color */
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        div {
            text-align: center;
            padding: 20px;
            background-color: #23801d; /* White background color for the content */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #000000; /* Green text color */
        }

        button {
            background-color: #01080c; /* Blue button color */
            color: #fff; /* White text color */
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }

        button:hover {
            background-color: rgb(81, 118, 52, 107, 182); /* Darker blue on hover */
        }
    </style>
<h2>User Registration</h2>
<form method="post" action="registerdonor.php">
    First Name: <input type="text" name="FirstName" required><br>
    Last Name: <input type="text" name="LastName" required><br>
    Email: <input type="email" name="Email" required><br>
    Password: <input type="password" name="Password" required><br>
    Phone Number: <input type="tel" name="PhoneNumber" required><br>
    Address: <input type="text" name="Address" required><br>
    Type of Support: <input type="text" name="Support" required></textarea><br>
    Description: <textarea name="Description" required></textarea><br>
    Status:<input type="text" name="Status" required><br>
    
    <input type="submit" value="Register" href="./Todonor.html">
</form>

</body>
</html>
