<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

try {
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
    exit();
}

// Handle AJAX request to get cart item count
if (isset($_GET['cartItem']) && $_GET['cartItem'] === 'addcart') {
    $stmt = $connect->query("SELECT COUNT(*) as count FROM addcart");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['count'];
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
?>

