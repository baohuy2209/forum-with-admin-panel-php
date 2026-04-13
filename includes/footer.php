<?php 
        $numAllTopics = $conn->query("SELECT COUNT(id) as num FROM topics");
        $numTopics = $numAllTopics->fetch(PDO::FETCH_OBJ);
        $sql = "SELECT c.name as category, COUNT(t.id) AS topic_count 
        FROM categories c
        JOIN topics t ON c.name = t.category
        GROUP BY c.id
        ORDER BY c.name ASC";
        $categories = $conn->query($sql);
        $listcategories = $categories->fetchAll(PDO::FETCH_OBJ);
        $numUser = $conn->query("SELECT COUNT(id) as num FROM users");
        $numUsers = $numUser->fetch(PDO::FETCH_OBJ);
        $numCategory = $conn->query("SELECT COUNT(category) as num FROM topics GROUP BY category");
        $numCategories = $numCategory->fetch(PDO::FETCH_OBJ);
?>
<div class="col-md-4">
    <div class="sidebar">
        <div class="block">
            <h3>Categories</h3>
            <div class="list-group block ">
                <a href="<?php echo APPURL."/index.php"?>" class="list-group-item active">All Topics <span
                        class="badge pull-right">
                        <?php echo $numTopics->num; ?>
                    </span></a>
                <?php foreach($listcategories as $category) : ?>
                <a href="<?php echo APPURL."/index.php?category=".urlencode($category->category)?>"
                    class="list-group-item"><?php echo $category->category; ?><span
                        class="color badge pull-right"><?php echo $category->topic_count; ?></span></a>
                <?php endforeach;?>
            </div>
        </div>

        <div class="block" style="margin-top: 20px;">
            <h3 class="margin-top: 40px">Forum Statistics</h3>
            <div class="list-group">
                <a href="#" class="list-group-item">Total Number of Users:<span
                        class="color badge pull-right"><?php echo $numUsers->num; ?></span></a>
                <a href="#" class="list-group-item">Total Number of Topics:<span
                        class="color badge pull-right"><?php echo $numTopics->num; ?></span></a>
                <a href="#" class="list-group-item">Total Number of Categories: <span
                        class="color badge pull-right"><?php echo $numCategories->num; ?></span></a>

            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo APPURL; ?>/js/bootstrap.js"></script>
</body>

</html>