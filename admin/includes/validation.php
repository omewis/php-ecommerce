<?php
function checkId($id) {
    return filter_var($id, FILTER_VALIDATE_INT) && $id > 0;
}
function checkName($name) {
    return !empty($name) && preg_match("/^[a-zA-Z\s]+$/", $name);
}
function checkDetails($details) {
    return !empty($details);
}
function checkDescription($description) {
    return !empty($description) && strlen($description) <= 255;
}
function checkStock($stock) {
    return filter_var($stock, FILTER_VALIDATE_INT) && $stock >= 0;
}
function checkImage($image) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $imageExtension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    return !empty($image) && in_array($imageExtension, $allowedExtensions);
}
function inputValidate($input){
    $input=trim($input);
    $input=strip_tags($input);
    $input=stripslashes($input);
    $input=strtolower($input);
    return $input;
}
function checkAlpha($input){
    $pattern='/^[a-zA-Z ]{3,}$/';
    return preg_match($pattern,$input);
}
function checkEmail($email){
    $pattern='/^[a-z]([a-z]|\d|\.)+([a-z]|[0-9])@(gmail|yahoo)(.com|.edu|.eg)$/';
    return preg_match($pattern,$email);
}

function checkPassword($password){
    $pattern='/(?=.*[A-Z])(?=.*\d{3,})/';
    return preg_match($pattern,$password);
}
function checkPhone($phone){
    $pattern='/^(010|011|012|015)\d{8}$/';
    return preg_match($pattern,$phone);
}
?>

