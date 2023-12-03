<?php
 $Homename = filter_input(INPUT_POST, 'Homename');
 $Address = filter_input(INPUT_POST, 'Address');
 $email = filter_input(INPUT_POST, 'Email');
 $password = filter_input(INPUT_POST, 'Password');
 $phoneNumber = filter_input(INPUT_POST, 'PhoneNumber');
 $Needs = filter_input(INPUT_POST, 'Needs');
 $Contactname = filter_input(INPUT_POST, 'Contactname');
 $description = filter_input(INPUT_POST, 'Description');
 $Link = filter_input(INPUT_POST, 'Link');
 if(empty($Homename) || !empty($Address) || !empty($email) || !empty($password) || !empty($phoneNumber) || !empty($Needs) || !empty($ContactnameType) || !empty($description))


 $host = "localhost";
 $username = "koi";
 $password = "1234";
 $dbname = "donors"; 
 
 // Create connection
 $conn = new mysqli($host, $username, $password, $dbname);
 
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }else{
    $sql = "INSERT INTO home (`Homename`, `Address`, `Email`, `Password`, `PhoneNumber`, `Needs`, `Contactname`, `Description`,`Link`)
    values ('$Homename', '$Address', '$email', '$password', '$phoneNumber','$Needs' ,'$Contactname', '$description', '$Link')";
    if ($conn->query($sql)){
        echo "New record is inserted";}
        else{ 
            echo "Error: ". $sql ."<br>". $conn->error;
        }}
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
            header("Location: tohome.html");
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
<form method="post" action=" tohome.html">
    Homename: <input type="text" name="Homename" required><br>
    Address: <input type="text" name="Address" required><br>
    Email: <input type="email" name="Email" required><br>
    Password: <input type="password" name="Password" required><br>
    Phone Number: <input type="tel" name="PhoneNumber" required><br>
    Needs: <input type="text" name="Needs" required><br>
    Contactname: <input type="text" name="Contactname" required></textarea><br>
    Link: <textarea input type="Link" name="Link" required></textarea><br>
    Description: <textarea name="Description" required></textarea><br>
    <input type="submit" value="Register" href="tohome.html">
    
</form>

</body>
</html>
