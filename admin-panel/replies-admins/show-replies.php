<?php require "../layouts/header.php"?>
<?php require "../../config/config.php" ?>
<?php 
    $replies = $conn->query("SELECT * FROM replies");
    $replies->execute();
    $allReplies = $replies->fetchAll(PDO::FETCH_OBJ);
?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Replies</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Reply</th>
                            <th scope="col">User Image</th>
                            <th scope="col">User Id</th>
                            <th scope="col">Go to Topic</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allReplies as $reply): ?>
                        <tr>
                            <th scope="row"><?php echo $reply->id; ?></th>
                            <td><?php echo $reply->reply; ?></td>
                            <td><img src="../../img/<?php echo $reply->user_image; ?>" alt="User Image" width="50"
                                    height="50">
                            </td>
                            <td><?php echo $reply->user_id; ?></td>
                            <td><a href="../topics-admins/show-topics.php?id=<?php echo $reply->topic_id; ?>"
                                    class="btn btn-success text-center">Go to topic</a></td>
                            <td><a href="delete-replies.php?id=<?php echo $reply->id; ?>"
                                    class="btn btn-danger text-center">Delete</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



</div>
<script type="text/javascript">

</script>
</body>

</html>