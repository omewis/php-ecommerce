<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/cart.css">
      <link rel="icon" type="image/x-icon" href="./assets/images/loogo.png" />
  <link rel="stylesheet" href="./assets/themify-icons-font/themify-icons/themify-icons.css" />
  <link rel="stylesheet" href="./assets/fontawesome-free-6.1.1/fontawesome-free-6.1.1-web/css/all.min.css" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <link rel="stylesheet" href="./assets/css/modal.css" />
  <link rel="stylesheet" href="./assets/css/responsive.css" />
  <link rel="stylesheet" href="./assets/css/cart2.css"/>
  <script src="https://kit.fontawesome.com/4a90be2ee9.js" crossorigin="anonymous"></script>

</head>
<body>
    <div id="header">
        <div class="container width_86 width_94">
          <div class="nav-left">
            <ul id="nav">
              <li class="nav-item">
                <a href="index.html" class="header-nav-home">Home</a>
              </li>
  
              <li class="nav-item nav-product">
                <div class="nav-product">
                  <a href="./products.html">Products
                    <i class="fa-solid fa-caret-down nav-arrow-icon"></i></a>
                </div>
                <ul class="subnav" id="categoryList">
                  <li class="subnav-item"><a href="./subnavvagetable.html" id="category">Headphones</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="./news.html">About</a>
              </li>
              <li class="nav-item">
                <a href="./contact.html">Contact</a>
              </li>
            </ul>
          </div>
          <div class="nav-between-logo">
            <a href="./index.html">
              <img src="./assets/img/logo.png" width="140px",height="140px" alt="logo" class="nav-logo" />
            </a>
          </div>
          <div class="nav-right">
            <ul class="nav-right-list">
              <li class="list--item">
                <a href="cart.html" class="navright-item ti-bag js-btn-cartshopping">
                  <p class="notification js--cartnotification">0</p>
                </a>
              </li>
              <li class="list--item user">
                <a href="#" class="navright-item ti-user"></a>
                <div class="signupsignin">
                  <div class="signupsignin-item signin">
                    <button class="btn btn-login js-btn-login">Login</button>
                  </div>
                  <div class="signupsignin-item signup">
                    <button class="btn btn-register js-btn-register">
                      Register
                    </button>
                  </div>
                </div>
              </li>
              <li class="list--item">
                <a href="#" class="navright-item ti-align-right js-btn-sidebar"></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
 <center><h3> Your Cart </h3> </center>    
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

// Example query to fetch items from the cart
$sql = "SELECT * FROM addcart";
try {
    $stmt = $connect->query($sql);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Query failed: " . $e->getMessage();
    exit();
}
?>

<center>
    <main>
        <table class='table'>
            <thead>
                <tr>
                    <th scope='col'>Product Name</th>
                    <th scope='col'>Product Price</th>
                    <th scope='col'>Remove Product</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><a href='delete.php?id=<?php echo htmlspecialchars($row['id']); ?>' class='btn btn-danger'>Remove</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</center>
<div class="button-container">
    <button class="button-link">
        <a href="products.php">Back to All Products</a>
    </button>
    <button class="button-link">
        <a href="checkout.php">Proceed to Checkout</a>
    </button>
</div>

<div id="footer">
    <div id="drop-of-water1">
      <div class="drop-of-water">
        <img src="./assets/images/bg-before-footer.webp" alt="">
      </div>
    </div>
    <div class="footer-first width_86 width_94 m-lr-auto ">
      <div class="footer-item footer-signup">
        <div class="signup-des">
          <p>Subscribe to our newsletter to receive special offers on Tech Tree Website products.</p>
        </div>
        <div class="signup-text-btn">
          <div class="signup-text">
            <input type="text" placeholder="Enter your email">
          </div>
          <div class="signup-btn">
            <button class="js-btn-registerfooter">Sign up</button>
          </div>
        </div>
      </div>
      <div class="footer-item footer-introduction">
        <div class="logo">
          <img src="./assets/img/logo.png" width="200px",height="180px" alt="">
        </div>
        <div class="introduction">
          The Tech Tree Website is an innovative online platform designed to cater to the needs of technology enthusiasts, 
          professionals, and learners alike. It serves as a comprehensive resource hub that not only provides up-to-date
           information on the latest technological advancements</div>
        <div class="logofooter">
          <img src="./assets/images/logo7.png" alt="">
        </div>
      </div>
      <div class="footer-item footer-contact">
        <h3>Contact Us
        </h3>
        <div>
          <p>Address: </p><a>Minia</a>

        </div>
        <div>
          <p>Phone </p><a>0332670569</a>
        </div>
        <div>
          <p>Email: </p><a>viennv.21it@vku.udn.vn</a>
        </div>
      </div>
    </div>
    <div class="footer-last">
      <div class="footer-copyright-iconcontact width_94 width_86 m-lr-auto">

        <div></div>
        <div class="iconcontact">
          <a href="" class="iconcontact-item ti-facebook"></a>
          <a href="" class="iconcontact-item ti-twitter"></a>
          <a href="" class="iconcontact-item ti-google"></a>
          <a href="" class="iconcontact-item icon-ytb"><img src="./assets/images/icon-ytb.png" alt=""></a>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</body>
</html>
