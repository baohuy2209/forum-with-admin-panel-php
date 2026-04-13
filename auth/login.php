<?php require "../includes/header.php" ?>
<?php require "../config/config.php"?>
<?php 
  if(isset($_SESSION["username"])){
    header("location: ".APPURL."/index.php");
  }
  if(isset($_POST["login"])){
    if($_POST['email'] == '' OR $_POST['password'] == ''){
			echo "<script>alert('one or more inputs are empty')</script>";
    }else{
      $email = $_POST["email"];
      $password = $_POST["password"];
      $login = $conn->query("SELECT * FROM users WHERE email='$email'");
      $login->execute(); 

      $data = $login->fetch(PDO::FETCH_ASSOC);
      // echo $login->rowCount();
      if($login->rowCount() > 0){
        if(password_verify($password, $data['password'])){
          $_SESSION['username'] = $data['username'];
          $_SESSION['email'] = $data['email'];
          $_SESSION['user_id'] = $data['id'];
          $_SESSION['user_image'] = $data['avatar'];
          header("Location: ".APPURL."/index.php");
        }else{
  	  		echo "<script>alert('Incorrect password')</script>";
        }
      }else{
        echo "No user found with that email";
  	  	echo "<script>alert('No user found with that email')</script>";
      }
    }
  }
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Login</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" enctype="multipart/form-data" method="post" action="login.php">

                        <div class="form-group">
                            <label>Email Address*</label> <input type="email" class="form-control" name="email"
                                placeholder="Enter Your Email Address">
                        </div>

                        <div class="form-group">
                            <label>Password*</label> <input type="password" class="form-control" name="password"
                                placeholder="Enter A Password">
                        </div>

                        <input name="login" type="submit" class="color btn btn-default" value="Login" />
                    </form>
                </div>
            </div>
        </div>
        <?php require "../includes/footer.php" ?>