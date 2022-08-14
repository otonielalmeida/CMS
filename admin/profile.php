<?php
include "includes/admin_header.php";
include "../includes/db.php";
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$username' ";
    $user_profile_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($user_profile_query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_first_name = $row['user_first_name'];
        $user_last_name = $row['user_last_name'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
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
    $query .= "user_role = '$user_role'";
    $query .= "WHERE username = '$username'";

    $edit_user_query = mysqli_query($connection, $query);

    
}
?>

<div id="wrapper">
    <?php if ($connection) echo "connected"; ?>
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Profile Page
                        <small>Update</small>
                    </h1>
                    

                </div>



            </div>
            <!-- /.row -->
            <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
                <option value="<?php echo $user_role; ?>">Role</option>
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
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
    </div>
</form>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>
