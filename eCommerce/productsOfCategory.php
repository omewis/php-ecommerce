<?php
include '../admin/includes/session.php';
include '../admin/includes/dbconnection.php';


//main product shower
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
$sql = "SELECT * FROM products WHERE category_id = :category_id";
try {
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->execute();
} catch (Exception $e) {
    die("Query failed: " . $e->getMessage());
}

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

//category sidebar shower
$sql2 = "SELECT * FROM categories";
try {
  $stmt2 = $connect->query($sql2);
} catch (Exception $e) {
  die("Query failed: " . $e->getMessage());
}
$categories = $stmt2->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id"
        content="763173387217-lv83ao8bnjcorooamgv3enh452o3tab9.apps.googleusercontent.com">
    <title> All Products | Fresh Mart</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/loogo.png">
    <link rel="stylesheet" href="./assets/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.1.1/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/modal.css">
    <link rel="stylesheet" href="./assets/css/products.css">
    <link rel="stylesheet" href="./assets/css/rpsproducts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        .checkbox-wrapper {
            margin-bottom: 10px;
        }

        .checkbox-wrapper input[type="checkbox"] {
            margin-right: 8px;
        }

        .checkbox-wrapper label {
            font-size: 16px;
        }
    </style>
</head>

<body>


    <!-- slider -->
    <div id="slider">
        <div id="drop-of-water">
            <img src="./assets/images/bg-after-header.webp" alt="">
        </div>
        <div class="slider-title">Labtop category</div>
        <div class="slider-nav">
            <a href="./index.html" class="nav-item">Home</a><i>/</i>
            <b class="nav-item">Labtops</b>
        </div>
    </div>


    <!-- CONTENT -->
    <div id="content">
        <div class="content-about width_86 width_94 m-lr-auto">
            <div class="sidebar">
                <!-- Product Category -->
                <div class="sidebar-item">
                    <div class="sidebar-title">PRODUCT CATEGORIES</div>
                    <div class="sidebar-content">
                        <div id="categoriesContainer" class="sidebar-content-list">
                            <?php foreach ($categories as $category): ?>
                                <li class="subnav-item">
                                    <a href="./productsOfCategory.php?category_id=<?php echo $category['id']; ?>">
                                        <?php echo htmlspecialchars($category['name']); ?>
                                    </a>
                                </li>
                          <?php endforeach; ?>
                        </div>
                     
                    </div>
                </div>


                <!--price Filter -->
                <div class="sidebar-item">
                    <div class="sidebar-title">FILTER PRODUCTS</div>
                    <div class="sidebar-content">
                <b>Product Price</b>
                <ul class="sidebar-content-list">
                    <li class="item-name">
                        <input type="checkbox" id="price-1-10000" name="price[]" value="1-10000" <?php echo in_array('1-10000', $price_filter) ? 'checked' : ''; ?> />
                        <label for="price-1-10000">lower than 10,000$</label>
                    </li>
                    <li class="item-name">
                        <input type="checkbox" id="price-10000-15000" name="price[]" value="10000-15000" <?php echo in_array('10000-15000', $price_filter) ? 'checked' : ''; ?> />
                        <label for="price-10000-15000">10,000$ - 15,000$</label>
                    </li>
                    <li class="item-name">
                        <input type="checkbox" id="price-15000-20000" name="price[]" value="15000-20000" <?php echo in_array('15000-20000', $price_filter) ? 'checked' : ''; ?> />
                        <label for="price-15000-20000">15,000$ - 20,000$</label>
                    </li>
                    <li class="item-name">
                        <input type="checkbox" id="price-20000-50000" name="price[]" value="20000-50000" <?php echo in_array('20000-50000', $price_filter) ? 'checked' : ''; ?> />
                        <label for="price-20000-50000">20,000$ - 50,000$</label>
                    </li>
                    <li class="item-name">
                        <input type="checkbox" id="price-50000-150000" name="price[]" value="50000-150000" <?php echo in_array('50000-150000', $price_filter) ? 'checked' : ''; ?> />
                        <label for="price-50000-150000">50,000$ - 150,000$</label>
                    </li>
                </ul>
            </div>
                </div>

            </div>
            <div class="section-about">
                <div class="sort-products">
                    <div class="sort-product-item sort-product">
                        <i class="fa-solid fa-arrow-down-z-a"></i>
                        <p>Sort by</p>
                    </div>
                    <div class="sort-product-item">
                        <input type="radio" name="sort-products">
                        <p>Name A-Z</p>
                    </div>
                    <div class="sort-product-item">
                        <input type="radio" name="sort-products">
                        <p>Name Z-A</p>
                    </div>
                    <div class="sort-product-item">
                        <input type="radio" name="sort-products">
                        <p>Price low to high</p>
                    </div>
                    <div class="sort-product-item">
                        <input type="radio" name="sort-products">
                        <p>Price high to low</p>
                    </div>
                </div>
                <!--main section -->
                <div class="container w-100 d-flex justify-content-center w-100">
                <div class="row w-50">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="sectiontwo-item">
                            <div class="item-sp item-sp--img">
                                <a href="guava.html?id=<?php echo $product['id']; ?>">
                                    <img src="../admin/uploads/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid">
                                </a>
                            </div>
                            <div class="item-sp item-price">
                                <a href="guava.html?id=<?php echo $product['id']; ?>" class="item-sp--name"><?php echo htmlspecialchars($product['name']); ?></a>
                                <div class="item-sp-price">
                                    <p class="item-sp--cost"><?php echo htmlspecialchars($product['price']); ?><a>$</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found for this category.</p>
            <?php endif; ?>
        </div>
                </div>

                <!-- main section -->


            </div>
        </div>

        <script src="./assets/js/index.js"></script>
        <script src="./assets/js/ProductFiltiration.js"></script>
        <script src="./assets/js/addproducttocart.js"></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <!-- <script src="./assets/js/ProductFiltiration.js"></script> -->

    

        <script>
            document.querySelectorAll('.sidebar-content input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        const filters = Array.from(document.querySelectorAll('.sidebar-content input[type="checkbox"]:checked')).map(checkbox => checkbox.value);
        const category_id = new URLSearchParams(window.location.search).get('category_id');
        const url = `products.php?category_id=${category_id}&price[]=${filters.join('&price[]=')}`;
        
        fetch(url)
            .then(response => response.text())
            .then(html => {
                document.querySelector('.row').innerHTML = html;
            })
            .catch(error => console.error('Error:', error));
    });
});
        </script>

</body>

</html>