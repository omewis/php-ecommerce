<?php
include '../includes/session.php';
include '../includes/dbconnection.php';

$result = $connect->query("SELECT 
    products.id, 
    products.name AS pro_name, 
    products.stock,
    categories.name AS ctg_name 
FROM 
    products 
LEFT JOIN 
    categories 
ON 
    products.category_id = categories.id;");

$products=$result->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <?php include '../includes/head.php' ?>
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
              <h4 class="page-title">Products</h4>
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
                  <h5 class="card-title">All Products</h5>
                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Stock</th>
                          <th>Category</th>
                          <th> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($products as $product){?>
                        <tr>
                          <td><?php echo $product['id']?></td>
                          <td><?php echo $product['pro_name']?></td>
                          <td><?php echo $product['stock']?></td>                                                
                          <td><?php echo $product['ctg_name']?></td>
                          <td> 
                            <a href="show.php?id=<?php echo $product['id']?>" class="btn btn-primary">Show</a>
                            <a href="edit.php?id=<?php echo $product['id']?>" class="btn btn-success">Edit</a>
                            <a href="delete.php?id=<?php echo $product['id']?>" class="btn btn-danger confirm">Delete</a>
                            <?php } ?>
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
     <script>
      let deleteBtn=document.querySelectorAll(".confirm");
      for(let i=0; i<deleteBtn.length; i++){
        deleteBtn[i].addEventListener("click",function(e){
         let ans=confirm("Do you want to confirm deleting?");
         if(!ans){
          e.preventDefault();
         }
        })
      }
      </script>
    <?php include '../includes/scripts.php' ?>
    
  </body>
</html>
