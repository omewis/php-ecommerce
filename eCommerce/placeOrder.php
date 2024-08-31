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

// Handle form submission and order processing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'order') {
    try {
        // Example of order processing logic
        // Save order to the database (you'll need to customize this)
        // ...

        // Clear the cart after processing the order
        $connect->exec("TRUNCATE TABLE addcart");

        echo json_encode(['success' => 'Order successfully placed!']);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to place order: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
?>
