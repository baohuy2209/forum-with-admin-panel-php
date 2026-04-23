<?php require "../layouts/header.php"?>
<?php require "../../config/config.php" ?>
<?php 
  $select = $conn->prepare("SELECT * FROM topics");
  $select->execute();
  $allTopics = $select->fetchAll(PDO::FETCH_OBJ);
?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Topics</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">User</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allTopics as $topic) :?>
                        <tr>
                            <th scope="row"><?php echo $topic->id; ?></th>
                            <td><?php echo $topic->title; ?></td>
                            <td><?php echo $topic->category; ?></td>
                            <td><?php echo $topic->username; ?></td>
                            <td><a href="delete-posts.php?id=<?php echo $topic->id; ?>"
                                    class="btn btn-danger text-center ">Delete</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require "../layouts/footer.php"?>