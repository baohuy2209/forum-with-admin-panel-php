<?php require "layouts/header.php"; ?>
<?php require "../config/config.php"?>
<?php 
    if(!isset($_SESSION["adminname"])){
        header("location: ".APPURL."/admins/login-admins.php");
    }
    $numAllTopics = $conn->query("SELECT COUNT(id) as num FROM topics");
    $numTopics = $numAllTopics->fetch(PDO::FETCH_OBJ);
    $numCategory = $conn->query("SELECT COUNT(id) as num FROM categories");
    $numCategories = $numCategory->fetch(PDO::FETCH_OBJ);
    $numAdmins = $conn->query("SELECT COUNT(id) as num FROM admins");
    $numAdmins = $numAdmins->fetch(PDO::FETCH_OBJ);
    $numReplies = $conn->query("SELECT COUNT(id) as num FROM replies");
    $numReplies = $numReplies->fetch(PDO::FETCH_OBJ);
?>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Topics</h5>
                <p class="card-text">Number of topics: <?php echo $numTopics->num; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Categories</h5>
                <p class="card-text">Number of categories: <?php echo $numCategories->num; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Admins</h5>
                <p class="card-text">Number of admins: <?php echo $numAdmins->num; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Replies</h5>
                <p class="card-text">Number of replies: <?php echo $numReplies->num; ?></p>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->
<?php require "layouts/footer.php"; ?>