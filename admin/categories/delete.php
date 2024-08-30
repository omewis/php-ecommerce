<?php 
include '../includes/session.php';
 include '../includes/dbconnection.php';

 if(isset($_GET['id'])){
    $id=$_GET['id'];
 }else{
     echo "<h1 style='colore:red';text-align:center>Wronge Page!</h1>";
     exit();
 }
 $result=$connect->query(" DELETE FROM categories WHERE id=$id");
 if($result){
    header("location: index.php");
 }
?>