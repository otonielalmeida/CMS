<?php
include "includes/admin_header.php";
include "../includes/db.php";
include "functions.php";
?>

<div id="wrapper">

    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                </div>


                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        global $connection;
                                        $query = "SELECT * from posts ";
                                        $all_posts = mysqli_query($connection, $query);
                                        while ($row = mysqli_fetch_array($all_posts)) {
                                            $post_count = mysqli_num_rows($all_posts);
                                        }

                                        ?>
                                        <div class='huge'><?php echo $post_count; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        global $connection;
                                        $query = "SELECT * from comments ";
                                        $all_comments = mysqli_query($connection, $query);
                                        while ($row = mysqli_fetch_array($all_comments)) {
                                            $comment_count = mysqli_num_rows($all_comments);
                                        }

                                        ?>
                                        <div class='huge'><?php echo $comment_count; ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        global $connection;
                                        $query = "SELECT * from users ";
                                        $all_users = mysqli_query($connection, $query);
                                        while ($row = mysqli_fetch_array($all_users)) {
                                            $user_count = mysqli_num_rows($all_users);
                                        }

                                        ?>
                                        <div class='huge'><?php echo $user_count; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        global $connection;
                                        $query = "SELECT * from categories ";
                                        $all_categories = mysqli_query($connection, $query);
                                        while ($row = mysqli_fetch_array($all_categories)) {
                                            $category_count = mysqli_num_rows($all_categories);
                                        }

                                        ?>
                                        <div class='huge'><?php echo $category_count; ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
                <?php
                $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                $select_all_published_posts = mysqli_query($connection, $query);
                $post_published_count = mysqli_num_rows($select_all_published_posts);

                $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
                $select_all_draft_posts = mysqli_query($connection, $query);
                $post_draft_count = mysqli_num_rows($select_all_draft_posts);

                $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                $unnapproved_comments_query = mysqli_query($connection, $query);
                $unnaproved_comment_count = mysqli_num_rows($unnapproved_comments_query);

                $query = "SELECT * FROM users WHERE user_role = 'user' ";
                $select_all_subscribers = mysqli_query($connection, $query);
                $user_count = mysqli_num_rows($select_all_subscribers);
                ?>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>