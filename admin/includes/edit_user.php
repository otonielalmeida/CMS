<?php

function confirm($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED ." . mysqli_error($connection));
    };
}

if(isset($_GET['u_id'])){
    $the_user_id = $_GET['u_id'];
}
$query = "SELECT * FROM users WHERE user_id = '$the_user_id'";
$select_user_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_user_by_id)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_first_name = $row['user_first_name'];
    $user_last_name = $row['user_last_name'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];

}

if (isset($_POST['edit_user'])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];


    move_uploaded_file($user_image_temp, "./../images_uesr/$user_image");

    $query = "UPDATE users SET " ;
    $query .= "username = '$username', ";
    $query .= "user_password = '$user_password', ";
    $query .= "user_image = '$user_image', ";
    $query .= "user_first_name = '$user_first_name', ";
    $query .= "user_last_name = '$user_last_name', ";
    $query .= "user_email = '$user_email', ";
    $query .= "user_role = '$user_role' ";
    $query .= "WHERE user_id = $the_user_id";

    $edit_user_query = mysqli_query($connection, $query);

    confirm($edit_user_query);
}


?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
                <option value="<?php echo $user_role; ?>" disabled selected>Role</option>
                <option value='admin'>Admin</option>
                <option value='user'>User</option>
        </select>

    </div>
    
    <div class="form_group">
        <label for="user_first_name">User First Name</label>
        <input type="text" class="form-control" name="user_first_name" value="<?php echo $user_first_name; ?>">
    </div>
    <div class="form_group">
        <label for="user_last_name">User Last Name</label>
        <input type="text" class="form-control" name="user_last_name" value="<?php echo $user_last_name; ?>">
    </div>
    <div class="form_group">
        <label for="user_email">User Email</label>
        <input type="text" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>
    <div class="form_group">
        <label for="user_password">User Password</label>
        <input type="text" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
    </div>
    <div class="form_group">
        <label for="user_image">User Image</label>
        <input type="file" class="form-control" name="image" value="<?php echo $user_image; ?>">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
</form>
