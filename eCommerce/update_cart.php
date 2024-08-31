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

// Get product details from the POST request
$product_id = isset($_POST['id']) ? intval($_POST['product_id']) : 0;
$product_name = isset($_POST['name']) ? $_POST['product_name'] : '';
$product_price = isset($_POST['price']) ? floatval($_POST['product_price']) : 0.0;

if ($product_id > 0 && !empty($product_name) && $product_price > 0) {
    try {
        // Check if the product is already in the cart
        $stmt = $connect->prepare("SELECT id FROM addcart WHERE product_id = :id");
        $stmt->bindParam(':id', $product_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Product exists, update quantity
            $stmt = $connect->prepare("UPDATE addcart SET quantity = quantity + 1 WHERE id = :id");
        } else {
            // Product does not exist, insert new entry
            $stmt = $connect->prepare("INSERT INTO addcart (id, name, quantity, price) VALUES (:id, :name, 1, :price)");
        }

        $stmt->bindParam(':id', $product_id);
        $stmt->bindParam(':name', $product_name);
        $stmt->bindParam(':price', $product_price);
        $stmt->execute();

        // Get the updated cart count
        $stmt = $connect->query("SELECT COUNT(*) as count FROM addcart");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cart_count = $row['count'];

        echo json_encode(['cart_count' => $cart_count]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Failed to update cart: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid product data.']);
}
?>
