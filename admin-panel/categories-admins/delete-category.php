<?php 
    require "../../config/config.php";
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $delete = $conn->prepare("DELETE FROM categories WHERE id=:id");
        $delete->execute([
        ":id" => $id
        ]);
        echo "<script>window.open('http://localhost/forum-with-admin-panel-php/admin-panel/categories-admins/show-categories.php','_self')</script>";
    } else {
        header("location: http://localhost/forum-with-admin-panel-php/admin-panel/categories-admins/show-categories.php");
    }
?>