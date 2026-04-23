<?php 
    session_start();
    session_destroy();
    header("location: http://localhost/forum-with-admin-panel-php/admin-panel/index.php");
?>