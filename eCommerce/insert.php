<?php
/*$servername = "localhost";
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
}*/
//include ('config.php');
/*include '../admin/includes/dbconnection.php';
if(isset($_POST['add'])){
$NAME = $_POST['name'];
$PRICE = $_POST['price'];
$insert = "INSERT INTO addcart (name, price) VALUES ('$NAME','$PRICE')";
mysqli_query($connect,$insert);
header('location: cart.php');

}
?>*/
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

if (isset($_POST['add'])) {
    // Retrieve POST data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Update SQL statement with correct column names
    $insert = "INSERT INTO addcart (id, name, price) VALUES (:id, :name, :price)";
    $stmt = $connect->prepare($insert);

    // Bind parameters
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_STR);

    // Execute statement
    if ($stmt->execute()) {
        // Redirect to cart page
        header('Location: cart.php');
      
        exit();
    } else {
        echo "Error: " . implode(", ", $stmt->errorInfo());
    }
}
?> 