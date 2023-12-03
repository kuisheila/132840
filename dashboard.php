<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=donors', 'koi', '1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Database connection error: ' . $e->getMessage();
    die();
}

// Fetch number of users in donor table
$queryDonorCount = 'SELECT COUNT(*) AS donorCount FROM donor';
$resultDonorCount = $db->query($queryDonorCount);
$donorCount = $resultDonorCount->fetchColumn();

// Fetch number of users in home table
$queryHomeCount = 'SELECT COUNT(*) AS homeCount FROM home';
$resultHomeCount = $db->query($queryHomeCount);
$homeCount = $resultHomeCount->fetchColumn();

// Handle form submissions for adding users
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addDonor'])) {
        $name = $_POST['donor_name']; // Adjust field names as needed
        $insertDonorQuery = "INSERT INTO donor (name) VALUES (:name)";
        $stmt = $db->prepare($insertDonorQuery);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        header('Location: dashboard.php'); // Redirect after adding user
        exit();
    } elseif (isset($_POST['addHome'])) {
        $name = $_POST['home_name']; // Adjust field names as needed
        $insertHomeQuery = "INSERT INTO home (name) VALUES (:name)";
        $stmt = $db->prepare($insertHomeQuery);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        header('Location: dashboard.php'); // Redirect after adding user
        exit();
    }
}

// Handle user deletion
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['table']) && isset($_GET['Support'])) {
    $table = $_GET['table'];
    $Support = $_GET['Support'];
    $deleteQuery = "DELETE FROM $table WHERE Support = :Support";
    $stmt = $db->prepare($deleteQuery);
    $stmt->bindParam(':Support', $Support);
    $stmt->execute();
    header('Location: dashboard.php'); // Redirect after deleting user
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h1>Admin Dashboard</h1>

    <div>
        <h2>Number of Users in Donor Table: <?php echo $donorCount; ?></h2>
        <!-- Display Donor Table Data -->
        <table border="1">
            <!-- Adjust column headers as needed -->
            <tr>
                <th>Support</th>
                <th>FirstName</th>
                <th>Action</th>
            </tr>
            <?php
            $donorData = $db->query('SELECT * FROM donor')->fetchAll(PDO::FETCH_ASSOC);
            foreach ($donorData as $donor) {
                echo "<tr>";
                echo "<td>{$donor['Support']}</td>";
                echo "<td>{$donor['FirstName']}</td>";
                echo "<td><a href='dashboard.php?action=delete&table=donor&Support={$donor['Support']}'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <!-- Form to add a donor -->
        <form method="post" action="dashboard.php">
            <label for="donor_name">Add Donor:</label>
            <input type="text" name="donor_name" required>
            <button type="submit" name="addDonor">Add Donor</button>
        </form>
    </div>

    <div>
        <h2>Number of Users in Home Table: <?php echo $homeCount; ?></h2>
        <!-- Display Home Table Data -->
        <table border="1">
            <!-- Adjust column headers as needed -->
            <tr>
                <th>Needs</th>
                <th>Homename</th>
                <th>Action</th>
            </tr>
            <?php
            $homeData = $db->query('SELECT * FROM home')->fetchAll(PDO::FETCH_ASSOC);
            foreach ($homeData as $home) {
                echo "<tr>";
                echo "<td>{$home['Needs']}</td>";
                echo "<td>{$home['Homename']}</td>";
                echo "<td><a href='dashboard.php?action=delete&table=home&Needs={$home['Needs']}'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <!-- Form to add a home user -->
        <form method="post" action="dashboard.php">
            <label for="home_name">Add Home User:</label>
            <input type="text" name="home_name" required>
            <button type="submit" name="addHome">Add Home User</button>
        </form>
    </div>
</body>
</html>
