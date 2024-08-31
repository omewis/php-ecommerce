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

// Execute a SQL query
$sql = "SELECT * FROM products";
try {
    $stmt = $connect->query($sql);
} catch (Exception $e) {
    die("Query failed: " . $e->getMessage());
}

// Fetch all results as an associative array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display the products
echo "<div class='products-container'>";
foreach($products as $product) {
    echo "
    <div class='product-item'>
        <div class='item-sp'>
            <a href='guava.html?id={$product['id']}'>
                <img src='../admin/uploads/images/{$product['image']}'' alt='{$product['name']}' />
            </a>
            
        </div>
        <div class='item-sp'>
            <a href='guava.html?id={$product['id']}' class='item-sp--name'>{$product['name']}</a>
            <div class='item-sp-price'>
                <p class='item-sp--cost'>{$product['price']}</p>
            </div>
            <form action='insert.php' method='POST'>
                <input type='hidden' name='id' value='{$product['id']}'>
                <input type='hidden' name='name' value='{$product['name']}'>
                <input type='hidden' name='price' value='{$product['price']}'>
                <button type='submit' name='add' class='btn btn-success'>Add to Cart</button>
            </form>
        </div>
    </div>
    ";
}
echo "</div>";



// Close the PDO connection
$connect = null;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="/admin/uploads/images/iphone.jpeg" alt="">
</body>
</html>
