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
}
$ID= $GET['id'];
mysqli_query($con, "DELETE FFROM addcart WHERE id=$ID");
header('location: cart.php')


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
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare SQL statement to delete the record
    $sql = "DELETE FROM addcart WHERE id = :id";
    $stmt = $connect->prepare($sql);

    // Bind parameters and execute
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect to cart page after successful deletion
        header('Location: cart.php');
        exit();
    } else {
        echo "Error deleting record.";
    }
} else {
    echo "No ID specified.";
}

// Close the PDO connection
$connect = null;
?>
