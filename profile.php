<?php require "includes/header.php" ?>
<?php require "config/config.php"?>
<?php 
  if($_GET["id"]){
    
  }else{
    header("location: ".APPURL."/404.php"); 
  }
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Profile</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <ul id="topics">
                        <li id="main-topic" class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left" src="img/gravatar.png" />
                                        <ul>
                                            <li><strong>username</strong></li>
                                            <li><a href="profile.html">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p>
                                            Globally productize optimal leadership skills without cooperative
                                            synergy. Authoritatively promote wireless technologies and high-payoff
                                            technology. Conveniently optimize virtual vortals for diverse
                                        </p>
                                    </div>
                                    <a class="btn btn-success" href="" role="button">number of Topics: 22</a>
                                    <a class="btn btn-primary" href="" role="button">number of replies: 22</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php require "includes/footer.php" ?>