<?php
 require "../includes/header.php" ?>
<?php require "../config/config.php"?>
<?php 
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sqlMainTopic = "SELECT t.id, t.title, t.category, t.body, t.user_id, t.created_at, u.username, u.name, u.avatar, COUNT(t2.id) AS post_count
            FROM topics t
            JOIN users u ON t.user_id = u.id 
            LEFT JOIN topics t2 ON t2.user_id = u.id
            WHERE t.id = :id
            GROUP BY t.id
        "; 
        $select = $conn->prepare($sqlMainTopic); 
        $select->execute([":id"=> $id]);
        $mainTopic = $select->fetch(PDO::FETCH_OBJ); 
        if($select->rowCount() == 0){
            header("location: ".APPURL."/index.php");
        }
        $sqlAllReplies = "SELECT r.id, r.reply, r.created_at, r.user_id, u.name, u.username, u.avatar, COUNT(t.id) AS post_count
        FROM replies r
        JOIN users u ON r.user_id = u.id
        LEFT JOIN topics t ON t.user_id = u.id
        WHERE r.topic_id = '$id'
        GROUP BY r.id
        ORDER BY r.created_at ASC
        ";
        $selectAllReplies = $conn->query($sqlAllReplies);
        $selectAllReplies->execute();
        $replies = $selectAllReplies->fetchAll(PDO::FETCH_OBJ);
        if(isset($_POST["submit"])){
            if($_POST["reply"] == ""){
    			echo "<script>alert('one or more inputs are empty')</script>";
            }else{
                $reply = $_POST["reply"]; 
                if(!$_SESSION["user_id"]){
        			echo "<script>alert('You must login to replies this topic')</script>";
                }else{
                    $user_id = $_SESSION["user_id"]; 
                    $user_img = $_SESSION["user_image"];
                    $insert = $conn->prepare("INSERT INTO replies (reply, user_id, user_image, topic_id) VALUES (:reply, :user_id, :user_image, :topic_id)");
                    $insert->execute([
                        ":user_id"=> $user_id,
                        ":reply"=> $reply, 
                        ":user_image"=> $user_img, 
                        ":topic_id"=> $id
                    ]);
                    echo "<script>alert('Your replies saved!')</script>";
                    header("location: ".APPURL."/topics/topic.php?id='$id'");
                }
            }
        }
    }else{
        header("location: ".APPURL."/404.php"); 
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">
                        <?php echo $mainTopic->title; ?></h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <ul id="topics">
                        <li id="main-topic" class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left"
                                            src="<?= !empty($mainTopic->avatar) ? APPURL.'/img/'.$mainTopic->avatar : APPURL.'/img/gravatar.png' ?>" />
                                        <ul>
                                            <li><strong><?= strlen($mainTopic->username) > 8 ? substr($mainTopic->username, 0, 8)." ..." : $mainTopic->username;
                                                    ?></strong>
                                            </li>
                                            <li><?php echo $mainTopic->post_count; ?> Posts</li>
                                            <li><a href="profile.php">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p><?php echo $mainTopic->body; ?></p>
                                    </div>
                                    <?php if ($mainTopic->user_id == $_SESSION["user_id"]) : ?>
                                    <a class="btn btn-danger" href="delete.php?id=<?php echo $id; ?>"
                                        role="button">Delete</a>
                                    <a class="btn btn-warning" href="update.php?id=<?php echo $id; ?>"
                                        role="button">Update</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <?php foreach($replies as $reply) : ?>
                        <li class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left"
                                            src="<?= !empty($reply->avatar) ? APPURL.'/img/'.$reply->avatar : APPURL.'/img/gravatar.png' ?>" />
                                        <ul>
                                            <li class="text-break">
                                                <strong>
                                                    <?= strlen($reply->username) > 8 ? substr($reply->username,0,8)." ..." : $reply->username ?>
                                                </strong>
                                            </li>
                                            <li><?php echo $reply->post_count; ?> Posts</li>
                                            <li><a href="profile.php">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p><?php echo $reply->reply; ?></p>
                                    </div>
                                    <?php if ($reply->user_id == $_SESSION["user_id"]) : ?>
                                    <a class="btn btn-danger"
                                        href="<?php echo APPURL; ?>/replies/delete.php?id=<?php echo $reply->id; ?>"
                                        role="button">Delete</a>
                                    <a class="btn btn-warning"
                                        href="<?php echo APPURL; ?>/replies/updateReplies.php?id=<?php echo $reply->id; ?>"
                                        role="button">Update</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <h3>Reply To Topic</h3>
                    <form role="form" method="POST" action="topic.php?id=<?php echo (int)$id; ?>">
                        <div class="form-group">
                            <textarea id="reply" rows="10" cols="80" class="form-control" name="reply"></textarea>
                            <script>
                            CKEDITOR.replace('reply');
                            </script>
                        </div>
                        <button name="submit" type="submit" class="color btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require "../includes/footer.php"?>