<?php require "../includes/header.php" ?>
<?php require "../config/config.php"?>
<?php 
    if(isset($_GET["id"])){
        $_id = $_GET['id'];
        $select = $conn->query("SELECT * FROM replies WHERE id=$_id");
        $select->execute(); 
        $reply = $select->fetch(PDO::FETCH_OBJ);
        if($reply->user_id !== $_SESSION["user_id"]){
            header("location: ".APPURL."/index.php");
        }else{
            $stmt = $conn->prepare("DELETE FROM replies WHERE id = :id");
            $stmt->execute([
                ":id"=> $_id
            ]);
            header("location: ".APPURL."/topics/topic.php?id=".$_id."");
        }
    }
?>