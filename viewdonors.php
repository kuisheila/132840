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

// Initialize variables
$search = '';
$status = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Collect search and filter criteria
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $status = isset($_GET['status']) ? $_GET['status'] : '';
}



// Output the HTML form
?>
<form method="get" action="search_results.php">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" placeholder="Enter keyword" value="<?= htmlspecialchars($search) ?>">
    
    <label for="status">Filter by Status:</label>
    <select id="status" name="status">
        <option value="" <?= $status === '' ? 'selected' : '' ?>>All</option>
        <option value="Active" <?= $status === 'Active' ? 'selected' : '' ?>>Active</option>
        <option value="Inactive" <?= $status === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
    </select>
    
    <button type="submit">Search & Filter</button>
</form>

<?php
$sql = "SELECT * FROM donor WHERE Support LIKE '%$search%'";
// Check if there are rows in the result set
if (!empty($Support)) {
    $sql .= " AND Support = '$Support'";
}
$result = $conn->query($sql);

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
} else {
    echo "No data found";
}

$conn->close();
?>
