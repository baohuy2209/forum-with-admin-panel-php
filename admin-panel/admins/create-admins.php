<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>
<?php 
  if(!isset($_SESSION["adminname"])){
      header("location: ".APPURL."/admins/login-admins.php");
  }
  if (isset($_POST["submit"])) {
    if(empty($_POST["email"]) || empty($_POST["username"]) || empty($_POST["password"])) {
      echo "<script>alert('Please fill in all fields')</script>";
    }else{
      $email = $_POST["email"];
      $username = $_POST["username"];
      $password = $_POST["password"];
      $checkExistEmail = $conn->query("SELECT * FROM admins WHERE email='$email'");
      $checkExistEmail->execute();
      if($checkExistEmail->rowCount() > 0){
				echo "<script>alert('Email already exists')</script>"; 
      }else{
        $insert = $conn->prepare("INSERT INTO admins (adminname, email, password) VALUES (:adminname, :email, :password)");
        $insert->execute([
          ":adminname" => $username,
          ":email" => $email,
          ":password" => password_hash($password, PASSWORD_DEFAULT)
        ]);
      }
    }
  }
?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Create Admins</h5>
                <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                    <!-- Email input -->
                    <div class="form-outline mb-4 mt-4">
                        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" name="username" id="form2Example1" class="form-control"
                            placeholder="username" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="form2Example1" class="form-control"
                            placeholder="password" />
                    </div>
                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require "../layouts/footer.php" ?>