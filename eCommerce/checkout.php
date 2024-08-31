<?php
// Database connection details
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

$grand_total = 0;
$total_quantity = 0;
$items = [];

// Query to get product details and total price from the cart
$sql = "SELECT product_name, quantity, total_price FROM cart";
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    // Add total price to grand total
    $grand_total += $row['total_price'];
    // Accumulate quantity for each product
    $total_quantity += $row['quantity'];
    // Append product name and quantity to items
    $items[] = $row['product_name'] . ' (' . $row['quantity'] . ')';
}

// Convert items array to a comma-separated string
$allItems = implode(', ', $items);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="google-signin-client_id" content="763173387217-lv83ao8bnjcorooamgv3enh452o3tab9.apps.googleusercontent.com" />
  <title>Checkout</title>
  <link rel="icon" type="image/x-icon" href="./assets/images/loogo.png" />
  <link rel="stylesheet" href="./assets/themify-icons-font/themify-icons/themify-icons.css" />
  <link rel="stylesheet" href="./assets/fontawesome-free-6.1.1/fontawesome-free-6.1.1-web/css/all.min.css" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <link rel="stylesheet" href="./assets/css/modal.css" />
  <link rel="stylesheet" href="./assets/css/responsive.css" />
  <link rel="stylesheet" href="./assets/css/products2.css" />
  <link rel="stylesheet" href="./assets/css/checkout.css"/>
</head>

<body>
  <div id="header">
    <div class="container width_86 width_94">
    <div class="nav-left">
            <ul id="nav">
              <li class="nav-item">
                <a href="index.php" class="header-nav-home">Home</a>
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
            <a href="./index.php">
              <img src="./assets/img/logo.png" width="140px",height="140px" alt="logo" class="nav-logo" />
            </a>
          </div>
          <div class="nav-right">
            <ul class="nav-right-list">
              <li class="list--item">
                <a href="cart.php" class="navright-item ti-bag js-btn-cartshopping">
                  <!--<p class="notification js--cartnotification">0</p>-->
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
  </div>

  <div class="checkout-container">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8" id="order">
          <h4 class="text-center text-info p-2">Complete your order!</h4>
          <div class="jumbotron p-3 mb-2 text-center">
            <h6 class="lead"><b>Product(s) : </b><?= htmlspecialchars($allItems); ?></h6>
            <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
            <h5><b>Total Amount : </b><?= number_format($grand_total, 2); ?>/-</h5>
          </div>
          <form action="action.php" method="post" id="placeOrder">
            <input type="hidden" name="products" value="<?= htmlspecialchars($allItems); ?>">
            <input type="hidden" name="grand_total" value="<?= htmlspecialchars($grand_total); ?>">
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
            </div>
            <div class="form-group">
              <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
            </div>
            <div class="form-group">
              <textarea name="address" class="form-control" rows="3" placeholder="Enter Delivery Address Here..."></textarea>
            </div>
            <h6 class="text-center lead">Select Payment Mode</h6>
            <div class="form-group">
              <select name="pmode" class="form-control">
                <option value="" selected disabled>-Select Payment Mode-</option>
                <option value="cod">Cash On Delivery</option>
                <option value="netbanking">Net Banking</option>
                <option value="cards">Debit/Credit Card</option>
              </select>
            </div>
            <form id="orderForm">
            <form id="placeOrder" action="placeOrder.php" method="post">
        <!-- Form fields go here -->
        <div class="form-group">
            <input href="placeOrder.php" type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
        </div>
    </form>
</div>
    </div>
    </div>
  </div>
  <

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

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script type="text/javascript">
   $(document).ready(function() {
        // Handle form submission via AJAX
        $("#placeOrder").submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            $.ajax({
                url: 'placeOrder.php', // URL to your order processing script
                method: 'post',
                data: $(this).serialize() + "&action=order", // Append additional data if needed
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.success) {
                        $("#successMessage").show(); // Show success message
                        $("#placeOrder")[0].reset(); // Reset the form
                        load_cart_item_number(); // Update cart item count
                    } else {
                        alert(result.error); // Show error message
                    }
                },
                error: function() {
                    alert('Failed to place order. Please try again.');
                }
            });
        });

        // Load total number of items added in the cart and display in the navbar
        function load_cart_item_number() {
            $.ajax({
                url: 'action.php', // URL to your script that returns cart count
                method: 'get',
                data: { cartItem: "addcart" },
                success: function(response) {
                    $(".notification").html(response); // Update cart count
                },
                error: function() {
                    console.error('Failed to load cart item count.');
                }
            });
        }

        // Initial cart item count load
        load_cart_item_number();
    });
  </script>
</body>

</html>
