<?php require "../includes/header.php"?>
<?php require "../config/config.php"?>
<?php 
    if(!isset($_SESSION["username"])){
        header("location: ".APPURL."/index.php");
    }
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $select = $conn->query("SELECT * FROM topics WHERE id=$id");
        $select->execute(); 
        $result = $select->fetch(PDO::FETCH_OBJ);
        if(isset($_POST["submit"])){
            $title = $_POST["title"];
            $category = $_POST["category"];
            $body = $_POST["body"];
            $update = $conn->prepare("UPDATE topics 
                            SET title = :title, category = :category, body = :body
                            WHERE id = $id"); 
            $update->execute([
                ":title" => $title,
                ":category" => $category, 
                ":body" => $body, 
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
                    <h1 class="pull-left">Update A Topic</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" method="POST" action="update.php?id=<?php echo $id; ?>">
                        <div class="form-group">
                            <label>Topic Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $result->title; ?>"
                                placeholder="Enter Post Title">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category">
                                <option value="Design" <?= $result->category == 'Design' ? 'selected' : '' ?>>Design
                                </option>
                                <option value="Development" <?= $result->category == 'Development' ? 'selected' : '' ?>>
                                    Development</option>
                                <option value="Business & Marketing"
                                    <?= $result->category == 'Business & Marketing' ? 'selected' : '' ?>>Business &
                                    Marketing</option>
                                <option value="Search Engines"
                                    <?= $result->category == 'Search Engines' ? 'selected' : '' ?>>Search Engines
                                </option>
                                <option value="Cloud & Hosting"
                                    <?= $result->category == 'Cloud & Hosting' ? 'selected' : '' ?>>Cloud & Hosting
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Topic Body</label>
                            <textarea id="body" rows="10" cols="80" class="form-control" name="body">
                            <?php echo $result->body; ?>
                            </textarea>
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