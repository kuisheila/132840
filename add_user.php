<?php
// add_user.php
try {
    $db = new PDO('mysql:host=localhost;dbname=donors', 'koi', '1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        // Add more fields as needed

        $query = 'INSERT INTO donor (name) VALUES (:name)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        // Bind more parameters as needed

        $stmt->execute();

        // Redirect back to the dashboard after adding the user
        header('Location: dashboard.php');
        exit();
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>