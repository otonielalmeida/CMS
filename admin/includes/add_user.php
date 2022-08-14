<?php

function confirm($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED ." . mysqli_error($connection));
    };
}

if (isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];


    move_uploaded_file($user_image_temp, "./../images_uesr/$user_image");

    $query = "INSERT INTO users(username, user_password, user_first_name, user_last_name, user_email, user_image, user_role) ";
    $query .= "VALUES('{$username}','{$user_password}','{$user_first_name}','{$user_last_name}','{$user_email}','{$user_image}','{$user_role}' ) ";
    $create_user_query = mysqli_query($connection, $query);

    confirm($create_user_query);
    echo "User Created: " . " " . "<a href='users.php'>View Users</a>";
}


?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
                <option value='admin'>Admin</option>
                <option value='user'>User</option>
        </select>

    </div>
    <div class="form_group">
        <label for="user_password">User Password</label>
        <input type="text" class="form-control" name="user_password">
    </div>
    <div class="form_group">
        <label for="user_first_name">User First Name</label>
        <input type="text" class="form-control" name="user_first_name">
    </div>
    <div class="form_group">
        <label for="user_last_name">User Last Name</label>
        <input type="text" class="form-control" name="user_last_name">
    </div>
    <div class="form_group">
        <label for="user_email">User Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>

    <div class="form_group">
        <label for="user_image">User Image</label>
        <input type="file" class="form-control" name="image">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
    </div>
</form>