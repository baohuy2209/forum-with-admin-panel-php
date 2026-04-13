<?php require "../includes/header.php"?>
<?php require "../config/config.php"?>
<?php 
    if(!isset($_SESSION["username"])){
        header("location: ".APPURL."/index.php");
    }
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $select = $conn->query("SELECT * FROM replies WHERE id=$id");
        $select->execute(); 
        $result = $select->fetch(PDO::FETCH_OBJ);
        if(isset($_POST["submit"])){
            $replies = $_POST["reply"];
            $update = $conn->prepare("UPDATE replies 
                            SET reply = :reply
                            WHERE id = $id"); 
            $update->execute([
                ":reply" => $replies, 
            ]);
            header("location: ".APPURL."/topics/topic.php?id=".$result->topic_id);
        }
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Update Replies</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" method="POST" action="updateReplies.php?id=<?php echo $id; ?>">
                        <div class="form-group">
                            <label>Reply to topic</label>
                            <textarea id="body" rows="10" cols="80" class="form-control" name="reply">
                                <?php echo $result->reply; ?>
                            </textarea>
                            <script>
                            CKEDITOR.replace('reply');
                            </script>
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require "../includes/footer.php" ?>