<?php
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
$needs = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect search and filter criteria
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $needs = isset($_POST['needs']) ? $_POST['needs'] : '';
}

// Output the HTML form
?>
<form method="post" action="search_results.php">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" placeholder="Enter keyword" value="<?= htmlspecialchars($search) ?>">
    
    <label for="needs">Filter by Needs:</label>
    <select id="needs" name="needs">
        <option value="" <?= $needs === '' ? 'selected' : '' ?>>All</option>
        <option value="Food" <?= $needs === 'Food' ? 'selected' : '' ?>>Food</option>
        <option value="Shelter" <?= $needs === 'Shelter' ? 'selected' : '' ?>>Shelter</option>
        <!-- Add more options as needed -->
    </select>
    
    <button type="submit">Search & Filter</button>
</form>

<?php

// Build the SQL query based on search and filter criteria
$sql = "SELECT * FROM home WHERE Needs LIKE '%$search%'";

if (!empty($needs)) {
    $sql .= " AND Needs = '$needs'";
}

$result = $conn->query($sql);

// Check if there are rows in the result set
if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr>';
    
    echo '<th>Homename</th>';
    echo '<th>Needs</th>';
    echo '<th>Description</th>';
    echo '<th>Address</th>';
    echo '<th>Contact</th>';
    // Add more header columns as needed
    echo '</tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        
        echo '<td>' . $row['Homename'] . '</td>';
        echo '<td>' . $row['Needs'] . '</td>';
        echo '<td>' . $row['Description'] . '</td>';
        echo '<td>' . $row['Address'] . '</td>';
        echo '<td>' . $row['Phonenumber'] . '</td>';
        // Add more columns as needed
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "No data found";
}

// Close the database connection
$conn->close();

?>
