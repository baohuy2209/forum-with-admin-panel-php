<?php require "../includes/header.php"?>
<?php require "../config/config.php"?>
<?php 
    if(!isset($_SESSION["username"])){
        header("location: ".APPURL."/index.php");
    }
    $select = $conn->query("SELECT * FROM categories"); 
    $select->execute();
    $allCategories = $select->fetchAll(PDO::FETCH_OBJ);
    if(isset($_POST["submit"])){
        if(empty($_POST["title"]) OR empty($_POST["category"]) OR empty($_POST["body"])){
			echo "<script>alert('one or more inputs are empty')</script>";
        }else{
            $title = $_POST["title"];
            $category = $_POST["category"];
            $body = $_POST["body"];
            $username = $_SESSION["username"]; 
            $userid = $_SESSION["user_id"];
            $insert = $conn->prepare("INSERT INTO topics (title, category, body, username, user_id) VALUES (:title, :category, :body, :username, :user_id)"); 
            $insert->execute([
                ":title" => $title,
                ":category" => $category, 
                ":body" => $body, 
                ":username"=> $username,
                ":user_id"=> $userid
            ]);
            header("location: ".APPURL."/index.php");
        }
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Create A Topic</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" method="POST" action="create.php">
                        <div class="form-group">
                            <label>Topic Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Post Title">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category">
                                <?php foreach($allCategories as $category):?>
                                <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Topic Body</label>
                            <textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
                            <script>
                            CKEDITOR.replace('body');
                            </script>
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require "../includes/footer.php" ?>