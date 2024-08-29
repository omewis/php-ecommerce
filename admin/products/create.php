<?PHP 
 include '../includes/dbconnection.php';
 include '../includes/validation.php';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
 
  <?php include '../includes/head.php';
  
  $ctg_result=$connect->query("SELECT * FROM categories");// only select need fetch
  $ctg_data=$ctg_result->fetchAll(PDO::FETCH_ASSOC);
  
  if($_SERVER['REQUEST_METHOD'] =="POST"){
  //prepare the values
    $id=$_POST['id'];
    $name=$_POST['name'];
    $details=$_POST['details'];
    $description=$_POST['description'];
    $stock=$_POST['stock'];
    $category_id=$_POST['category_id'];
    $price=$_POST['price'];
    $discount=$_POST['discount'];
    $available=isset($_POST['available']) ? $_POST['available'] : null;
    $image=$_FILES['image'];
    $imageName=$image['name'];
    $imageTmp=$image['tmp_name'];

    //validation
    $errors=[];
    if (!checkId($id)) {
      $errors["id"]="Invalid ID.<br>";
    }
    if (!checkName($name)) {
      $errors["name"]="Invalid Name.<br>";
    }
    if (!checkDetails($details)) {
      $errors["details"]="Details cant't be empty.<br>";
    }
    if (!checkDescription($description)) {
      $errors["description"]="Description cant't be empty.<br>";
    }
    if (!checkStock($stock)) {
      $errors["stock"]="Stock should be positive number.<br>";
    }
  
    if (!checkImage($imageName)) {
     $errors["image"]="Please upload image.<br>";
    }

    //check if there errors before inserting
    if(empty($errors)){
      //insert to database
    $insert_result=$connect->query
    ("INSERT INTO `products`(`id`, `name`, `details`, `description`, `stock`, `available`, `price`, `image`, `discount`, `category_id`)
     VALUES ('$id','$name','$details','$description','$stock','$available','$price','$imageName','$discount','$category_id')
    ");
    if($insert_result){
      move_uploaded_file($imageTmp,"../uploads/images/$imageName");
      }
    }  
  }
  ?>
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
              <h4 class="page-title">Add Product</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">All Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                    <a href="#">Add New</a></li>
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
            <div class="col-md-12">
              <div class="card">
                <?php if (isset($insert_result)&& $insert_result){ ?>
                <div class="alert alert-success">Added Successfully.</div>
                <?php }?>
                <?php if(isset($errors) && !empty($errors)){?>
                <div class="alert alert-danger">
                  <ul>
                    <?php foreach ($errors as $error) {?>
                    <li><?php echo $error ?></li>
                    <?php }?>
                  </ul>
                </div>
                <?php }?>
                <form class="form-horizontal" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" method="post" novalidate >
                  <div class="card-body">
                    <div class="form-group row">
                      <label
                        for="id"
                        class="col-sm-3 text-end control-label col-form-label"
                        >ID</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="number"
                          class="form-control"
                          id="id"
                          placeholder="ID Here"
                          name="id"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Name</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          placeholder="Product Name Here"
                          name="name"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="details"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Details</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="details"
                          placeholder="details Here"
                          name="details"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="description"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Description</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="description"
                          placeholder="description Here"
                          name="description"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="stock"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Stock</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="number"
                          class="form-control"
                          id="stock"
                          placeholder="stock Here"
                          name="stock"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="category_id"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Category</label
                      >
                      <div class="col-sm-9">
                        <select class="form-control" name="category_id">
                        <?php foreach($ctg_data as $category) {?>
                            <option value="<?php echo $category['id']?>"><?php echo $category['name'] ?></option>
                            <?php }?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="price"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Price</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="number"
                          class="form-control"
                          id="price"
                          placeholder="price Here"
                          name="price"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="discount"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Discount</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="number"
                          class="form-control"
                          id="discount"
                          placeholder="discount Here"
                          name="discount"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label 
                        for="image" 
                        class="col-sm-3 text-end control-label col-form-label"
                        >Upload Image</label
                      >
                      <div class="col-sm-9">
                        <input 
                          type="file" 
                          class="form-control" 
                          id="image" 
                          name="image" 
                          accept="image/*">
                      </div>
                    </div>
                    <div class="form-group row">
                    <label
                        for="available"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Available</label
                      >
                      <div class="col-md-9">
                        <div class="form-check">
                          <input
                            type="radio"
                            class="form-check-input"
                            id="available"
                            name="available"
                            value="y"
                          />
                          <label
                            class="form-check-label mb-0"
                            for="customControlValidation1"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check">
                          <input
                            type="radio"
                            class="form-check-input"
                            id="customControlValidation2"
                            name="available"
                            value="n"
                          />
                          <label
                            class="form-check-label mb-0"
                            for="customControlValidation2"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>
                   
                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary">
                        Add
                      </button>
                    </div>
                  </div>
                </form>
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

