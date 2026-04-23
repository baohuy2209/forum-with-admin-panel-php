<?php require "../includes/header.php" ?>
<?php require "../config/config.php"?>
<?php 
    if(!isset($_SESSION["username"])){
        header("location: ".APPURL."/index.php");
    }
  if($_GET["name"]){
    $username = $_GET["name"];
    $select = $conn->query("SELECT * FROM users WHERE username='$username'"); 
    $select->execute(); 
    $user_profile = $select->fetch(PDO::FETCH_OBJ);
    // if($user_profile->username !== $_SESSION["username"]){
    //     header("location: ".APPURL."/index.php");
    // }
    $num_post_select = $conn->query("SELECT COUNT(id) as num_topic FROM topics WHERE username='$username'");
    $num_post_select->execute();
    $num_post_count = $num_post_select->fetch(PDO::FETCH_OBJ);
    $num_replies_select = $conn->query("SELECT COUNT(id) as num_replies FROM replies WHERE user_id='$user_profile->id'");
    $num_replies_select->execute();
    $num_replies_count = $num_replies_select->fetch(PDO::FETCH_OBJ);
  }else{
    header("location: ".APPURL."/404.php"); 
  }
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left"><?php echo $user_profile->name; ?></h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <ul id="topics">
                        <li id="main-topic" class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left"
                                            src="<?= !empty($user_profile->avatar) ? APPURL."/img/".$user_profile->avatar : APPURL."/img/gravatar.jpg" ?>" />
                                        <ul>
                                            <li><strong><?php echo $user_profile->username; ?></strong></li>
                                            <li><a
                                                    href="<?php echo APPURL; ?>/users/profile.php?name=<?php echo $_SESSION["username"]; ?>">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p>
                                            <?php echo $user_profile->about; ?>
                                        </p>
                                    </div>
                                    <a class="btn btn-success" href="" role="button">number of Topics:
                                        <?php echo $num_post_count->num_topic; ?></a>
                                    <a class="btn btn-primary" href="" role="button">number of replies:
                                        <?php echo $num_replies_count->num_replies; ?></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php require "../includes/footer.php" ?>