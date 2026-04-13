<?php require "../includes/header.php" ?>
<?php require "../config/config.php"?>
<?php 
    if(isset($_GET["id"])){
        $_id = $_GET['id'];
        $select = $conn->query("SELECT * FROM topics WHERE id=$_id");
        $select->execute(); 
        $topic = $select->fetch(PDO::FETCH_OBJ);
        if($topic->user_id != $_SESSION["user_id"]){
            header("location: ".APPURL."/index.php");
        }else{
            $delete = $conn->query("DELETE FROM topics WHERE id='$_id'");
            $stmt = $conn->prepare("DELETE FROM replies WHERE topic_id = :id");
            $stmt->execute([
                ":id"=> $_id
            ]);
            header("location: ".APPURL."/index.php");
        }
    }
?>