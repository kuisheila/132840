<!-- search_results.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href=".bootstrap.css">
</head>
<body>

<?php
// Include TCPDF library
require_once('tcpdf/tcpdf.php');

// Database connection parameters
$servername = "localhost";
$username = "koi";
$password = "1234";
$dbname = "donors";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Build the SQL query based on search and filter criteria
$search = isset($_GET['search']) ? $_GET['search'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "SELECT * FROM donor WHERE Support LIKE '%$search%'";

if (!empty($status)) {
    $sql .= " AND Status = '$status'";
}

$result = $conn->query($sql);

// Check if there are rows in the result set
if ($result === false) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr>';
    
    echo '<th>Intended Donation</th>';
    echo '<th>Donation Description</th>';
    echo '<th>Donor Name</th>';
    echo '<th>Donor Contact</th>';
    echo '<th>Status</th>';
    // Add more header columns as needed
    echo '</tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        
        echo '<td>' . $row['Support'] . '</td>';
        echo '<td>' . $row['Description'] . '</td>';
        echo '<td>' . $row['FirstName'] . '</td>';
        echo '<td>' . $row['PhoneNumber'] . '</td>';
        echo '<td>' . $row['Status'] . '</td>';
        // Add more columns as needed
        echo '</tr>';
    }

    echo '</table>';

    // Add a button to download the PDF
    echo '<form method="post" action="generateD_pdf.php">';
    echo '<input type="hidden" name="search" value="' . htmlspecialchars($search) . '">';
    echo '<input type="hidden" name="status" value="' . htmlspecialchars($status) . '">';
    echo '<button type="submit">Download PDF</button>';
    echo '</form>';
} else {
    echo "No data found";
}

// Close the database connection
$conn->close();
?>

</body>
</html>
