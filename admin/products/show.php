<?php
    include '../includes/dbconnection.php';

    if(isset($_GET['id'])){
       $id=$_GET['id'];
    }else{
        echo "<h1 style='colore:red';text-align:center>Wronge Page!</h1>";
        exit();
    }
    $product_result=$connect->query("SELECT 
    products.id, 
    products.name AS pro_name, 
    products.details,
    products.description,
    products.stock,
    categories.name AS ctg_name,
    products.price,
    products.discount,
    products.available,
    products.image    
FROM 
    products 
LEFT JOIN 
    categories 
ON 
    products.category_id = categories.id WHERE products.id=$id");

    $product_data=$product_result->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <?php include '../includes/head.php' ?>
  <style>
    th{
        background-color: #3e5569 !important;
        width: 25%;
        color: #D1E9F6;
    }
   </style>
  </head>

  <body>

    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >

      <header class="topbar" data-navbarbg="skin5">
      <?php include '../includes/rightHeader.php'?>
      </header>

      <aside class="left-sidebar" data-sidebarbg="skin5">
         <?php include '../includes/aside.php' ?>
      </aside>

      <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title"><?php echo $product_data['pro_name']?></h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                    <a href="create.php">Add New</a></li>
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid -->
        <div class="container-fluid">
          <!-- Start Page Content -->
          <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      
                      <tbody>
                        <tr>
                           <th>ID</th>
                           <td><?php echo $product_data['id']?></td>
                        </tr>
                        <tr>
                           <th>Name</th>
                           <td><?php echo $product_data['pro_name']?></td>
                        </tr>
                        <tr>
                           <th>Details</th>
                           <td><?php echo $product_data['details']?></td>
                        </tr>
                        <tr>
                           <th>Description</th>
                           <td><?php echo $product_data['description']?></td>
                        </tr>
                        <tr>
                           <th>Stock</th>
                           <td><?php echo $product_data['stock']?></td>
                        </tr>
                        <tr>
                           <th>Category</th>
                           <td><?php echo $product_data['ctg_name']?></td>
                        </tr>
                        <tr>
                           <th>Price</th>
                           <td><?php echo $product_data['price']?></td>
                        </tr>
                        <tr>
                           <th>Discount</th>
                           <td><?php echo $product_data['discount']?></td>
                        </tr>
                        <tr>
                           <th>Available</th>
                           <td><?php echo $product_data['available']?></td>
                        </tr>
                        <tr>
                           <th>Image</th>
                           <td>
                            <img src="../uploads/images/<?php echo $product_data['image'] ?>" width="150" height="100"> 
                           </td>
                        </tr>
    
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Page Content -->

        </div>
        <!-- End Container fluid -->

        <!-- footer -->
        <footer class="footer text-center">
        <?php include '../includes/footer.php' ?>
        </footer>
        <!-- End footer -->
        
      </div>
      <!-- End Page wrapper -->
    </div>
    <!-- End Wrapper -->

    <!-- All Jquery -->
    <?php include '../includes/scripts.php' ?>
    
  </body>
</html>
