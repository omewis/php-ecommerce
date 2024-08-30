<?php
include '../includes/session.php';
include '../includes/dbconnection.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    echo "<h1 style='color:red; text-align:center;'>Wrong Page!</h1>";
    exit();
}

$user_result = $connect->prepare("
    SELECT orders.*, users.user_name 
    FROM orders 
    JOIN users ON orders.user_id = users.id 
    WHERE orders.id = :id
");

$user_result->bindParam(':id', $id, PDO::PARAM_INT);
$user_result->execute();

$order_data = $user_result->fetch(PDO::FETCH_ASSOC);

if (!$order_data) {
    echo "<h1 style='color:red; text-align:center;'>Order not found!</h1>";
    exit();
}
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
              <h4 class="page-title"><?php echo $order_data['user_name']; echo " order's" ?></h4>
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
                           <td><?php echo $order_data['id']?></td>
                        </tr>
                        <tr>
                           <th>address</th>
                           <td><?php echo $order_data['address']?></td>
                        </tr>
                        <tr>
                           <th>last_name</th>
                           <td><?php echo $order_data['last_name']?></td>
                        </tr>
                        <tr>
                           <th>first_name</th>
                           <td><?php echo $order_data['first_name']?></td>
                        </tr>
                        <tr>
                           <th>total</th>
                           <td><?php echo $order_data['total']?></td>
                        </tr>
                        <tr>
                           <th>phone</th>
                           <td><?php echo $order_data['phone']?></td>
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
