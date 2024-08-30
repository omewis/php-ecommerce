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
function checkPhone($phone) {
    return preg_match("/^\+?[0-9]{7,15}$/", $phone);
}
?>
