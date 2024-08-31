<?PHP 
include '../includes/session.php';
 include '../includes/dbconnection.php';
 include '../includes/validation.php';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
 
  <?php include '../includes/head.php';  
  if($_SERVER['REQUEST_METHOD'] =="POST"){
  //prepare the values
    $id=$_POST['id'];
    $password=$_POST['password'];
    $name=$_POST['user_name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    
    //validation
    $errors=[];
    if (!checkId($id)) {
      $errors["id"]="Invalid ID.<br>";
    }
    if (!checkName($name)) {
      $errors["name"]="Invalid Name.<br>";
    }
    if (!checkEmail($email)) {
      $errors["email"]="Email cant't be empty.<br>";
      }
    if (!checkPhone($phone)) {
        $errors["phone"]=" Invalid Phone Number.<br>";
      }
    
    //check if there errors before inserting
    if(empty($errors)){
      //insert to database
    $insert_result=$connect->query
    ("INSERT INTO `users`(`id`, `password`, `user_name`, `email`, `phone`) VALUES ('$id','$password','$name','$email','$phone')");
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
              <h4 class="page-title">Add User</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">All Users</a></li>
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
                      
                          name="id"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="user_name"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Name</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="user_name"
                          
                          name="user_name"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="password"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Password</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="number"
                          class="form-control"
                          id="password"
                          
                          name="password"
                        />
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label
                        for="email"
                        class="col-sm-3 text-end control-label col-form-label"
                        >email</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="email"
                          placeholder="email Here"
                          name="email"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="phone"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Phone</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="number"
                          class="form-control"
                          id="phone"
                          placeholder="phone Here"
                          name="phone"
                        />
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

