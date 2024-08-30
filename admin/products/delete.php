<?php 
include '../includes/session.php';
 include '../includes/dbconnection.php';

 if(isset($_GET['id'])){
    $id=$_GET['id'];
 }else{
     echo "<h1 style='colore:red';text-align:center>Wronge Page!</h1>";
     exit();
 }
$select_result=$connect->query("SELECT image FROM products WHERE id=$id ");
$image_data=$select_result->fetch(PDO::FETCH_ASSOC);
$image_name=$image_data['image'];
 $result=$connect->query(" DELETE FROM products WHERE id=$id");
 if($result){
    unlink("../uploads/images/$image_name");
    header("location: index.php");
 }
?>