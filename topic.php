<?php require "includes/header.php" ?>
<?php require "config/config.php"?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">How did you learn CSS and HTML?</h1>
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
                                            <li><strong>MOhamed Hassan</strong></li>
                                            <li>43 Posts</li>
                                            <li><a href="profile.php">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p>I just worked in split mode in dreamweaver and paid attention to what was
                                            happening on the code end.
                                            How did you learn CSS and HTML? How long did it take you until you were
                                            proficient?</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left" src="img/gravatar.png" />
                                        <ul>
                                            <li><strong>MOhamed Hassan</strong></li>
                                            <li>43 Posts</li>
                                            <li><a href="profile.php">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p>Congrats on how to make a href and inserting an image...


                                            You can learn HTML/CSS pretty fast, though how to use it in different
                                            scenarios is a whole other deal.

                                            I like to check out tutorials on how to implement the newest within html/css
                                            (html5 / css3), or check out the works of others and try to implement
                                            myself.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left" src="img/gravatar.png" />
                                        <ul>
                                            <li><strong>MOhamed Hassan</strong></li>
                                            <li>43 Posts</li>
                                            <li><a href="profile.php">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p>w3schools is very good. I can't code an entire site, but I can handle basic
                                            things like links, fonts and colors. I'm not intimidated by the site of
                                            code.</p>

                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left" src="img/gravatar.png" />
                                        <ul>
                                            <li><strong>MOhamed Hassan</strong></li>
                                            <li>43 Posts</li>
                                            <li><a href="profile.php">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p>Personally, I started to look at some examples and after I build some crapy
                                            sites, I learned quite well. As a recommendation, you can check
                                            http://www.w3schools.com/ ., the site is pretty complete.</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left" src="img/gravatar.png" />
                                        <ul>
                                            <li><strong>MOhamed Hassan</strong></li>
                                            <li>43 Posts</li>
                                            <li><a href="profile.php">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p>html and css are basic there not much to them the main then you need to learn
                                            is how elements interact as one element can make another element behave
                                            differently this is the most complex part including cross brower
                                            compatability</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h3>Reply To Topic</h3>
                    <form role="form">
                        <div class="form-group">
                            <textarea id="reply" rows="10" cols="80" class="form-control" name="reply"></textarea>
                            <script>
                            CKEDITOR.replace('reply');
                            </script>
                        </div>
                        <button type="submit" class="color btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require "includes/footer.php"?>