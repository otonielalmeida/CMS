<?php
function confirm($result)
{
    global $connection;
    if (!$result) {
        die("QUERRY FAILED ." . mysqli_error($connection));
    };
}
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
};
$query = "SELECT * FROM posts WHERE posts_id = $the_post_id ";
$select_posts_by_id = mysqli_query($connection, $query);


while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['posts_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}
if (isset($_POST['update_post'])) {
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];

    move_uploaded_file($post_image_temp, "../../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE posts_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE posts_id = {$post_id}";

    $update_post = mysqli_query($connection, $query);


    confirm($update_post);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?php echo $post_title ?>" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <select name="post_category_id" id="">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>$cat_title</option>";
            }
            ?>
        </select>

    </div>
    <div class="form_group">
        <label for="title">Post Author</label>
        <input type="text" value="<?php echo $post_author ?>" class="form-control" name="post_author">
    </div>

    <div class="form_group">
        <label for="title">Post Status</label>
        <select for="post_status">
            <option value='<?php echo $post_status; ?>'><?php echo $post_status ?></option>
            <?php
            if ($post_status == 'published') {
                echo "<option value = 'draft'>Draft</option>";
            } else {
                echo "<option value = 'published'>Published</option>";
            }
            ?>

        </select>

    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>">
    </div>

    <div class="form_group">
        <label for="post_image">Post Image</label>
        <input type="file" value="" class="form-control" name="image">
    </div>
    <div class="form_group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags ?>" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" value="" name="post_content" id="" cols="30" rows="10">
            <?php echo $post_content ?>
        </textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Publish Post">
    </div>
</form>

<?php
$query = "SELECT * FROM users";
$select_roles = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_roles)) {
    $user_id = $row['user_id'];
    $user_role = $row['user_role'];

    echo "<option value='$user_id'>$user_role</option>";
}
?>