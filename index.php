<?php require "includes/header.php" ?>
<?php require "config/config.php"?>
<?php 
    if(isset($_GET["category"])){
        $category = $_GET["category"];
        $sql = "SELECT t.id, t.title, t.category, t.body, t.created_at,
               u.name, u.username, u.avatar, COUNT(r.id) AS reply_count
            FROM topics t
            JOIN users u ON t.user_id = u.id
            LEFT JOIN replies r ON r.topic_id = t.id
            WHERE LOWER(t.category) = LOWER(:category)
            GROUP BY t.id
            ORDER BY t.created_at DESC";
        $allTopics = $conn->prepare($sql);
        $allTopics->execute([
            ":category"=> $category,
        ]); 
        $listTopics = $allTopics->fetchAll(PDO::FETCH_OBJ);
    }else{
        $sql = "SELECT t.id, t.title, t.category, t.body, t.created_at,
               u.name, u.username, u.avatar, COUNT(r.id) AS reply_count
            FROM topics t
            JOIN users u ON t.user_id = u.id
            LEFT JOIN replies r ON r.topic_id = t.id
            GROUP BY t.id
            ORDER BY t.created_at DESC";
        $allTopics = $conn->query($sql);
        $allTopics->execute(); 
        $listTopics = $allTopics->fetchAll(PDO::FETCH_OBJ);
    }
    
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Welcome to Forum</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <ul id="topics">
                        <?php foreach($listTopics as $topic): ?>
                        <li class="topic">
                            <div class="row">
                                <div class="col-md-2 d-flex justify-content-center align-items-center">
                                    <img class="avatar pull-left"
                                        style="border-radius: 50%; width: 85px; height: 85px; place-items: center;"
                                        src="<?= !empty($topic->avatar) ? 'img/' . $topic->avatar : 'img/gravatar.png' ?>" />
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <h3><a
                                                href="<?php echo APPURL; ?>/topics/topic.php?id=<?php echo $topic->id; ?>"><?php echo $topic->title; ?></a>
                                        </h3>
                                        <div class="topic-info">
                                            <a
                                                href="<?php echo APPURL."/index.php?category=".urlencode($topic->category)?>"><?php echo $topic->category; ?></a>
                                            >> <a
                                                href="<?php echo APPURL; ?>/users/profile.php?name=<?php echo $topic->username; ?>"><?php echo $topic->username; ?></a>
                                            >>
                                            Posted on:
                                            <?php echo date('M', strtotime($topic->created_at)).', '.date('d', strtotime($topic->created_at)).' '.date('Y', strtotime($topic->created_at));?>
                                            <span class="color badge pull-right">
                                                <?php echo $topic->reply_count; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </div>

        <?php require "includes/footer.php"?>