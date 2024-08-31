<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce"; 

// Establish a PDO connection
try {
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}

if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Validate quantity
    if ($quantity <= 0) {
        echo "Quantity must be greater than zero.";
        exit();
    }

    // Update SQL statement
    $update = "UPDATE addcart SET quantity = :quantity WHERE id = :id";
    $stmt = $connect->prepare($update);

    // Bind parameters
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

    // Execute statement
    if ($stmt->execute()) {
        // Redirect back to the cart page
        header('Location: cart.php');
        exit();
    } else {
        echo "Error: " . implode(", ", $stmt->errorInfo());
    }
} else {
    echo "Invalid request.";
}
?>

