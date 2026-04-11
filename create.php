<?php require "includes/header.php"?>
<?php require "config/config.php"?>
<?php 
    if(isset($_POST["submit"])){
        
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Create A Topic</h1>
                    <h4 class="pull-right">A Simple Forum</h4>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" method="POST" action="create.php">
                        <div class="form-group">
                            <label>Topic Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Post Title">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category">
                                <option value="Design">Design</option>
                                <option value="Development">Development</option>
                                <option value="Business & Marketing">Business & Marketing</option>
                                <option value="Search Engines">Search Engines</option>
                                <option value="Cloud & Hosting">Cloud & Hosting</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Topic Body</label>
                            <textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
                            <script>
                            CKEDITOR.replace('body');
                            </script>
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require "includes/footer.php" ?>