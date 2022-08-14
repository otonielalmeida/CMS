<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>User</th>
            <th>Admin</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php

        function confirm($result)
        {
            global $connection;
            if (!$result) {
                die("QUERY FAILED ." . mysqli_error($connection));
            };
        }

        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);


        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_role = $row['user_role'];
            $user_first_name = $row['user_first_name'];
            $user_last_name = $row['user_last_name'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];

            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_first_name</td>";

            /* $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
            $select_categories_id = mysqli_query($connection, $query);


            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<td>{$cat_title}</td>";
            } */
            /* echo "<td>{$post_category_id}</td>"; */
            echo "<td>$user_last_name</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";
            /* $query = "SELECT * FROM posts WHERE posts_id = $comment_post_id ";
            $select_post_id_query = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_post_id_query)){
                $post_id = $row['posts_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";


            }
            
            echo "<td>$comment_date</td>"; */

            
            echo "<td><a href='users.php?change_to_user=$user_id'>User</a></td>";
            echo "<td><a href='users.php?change_to_adm=$user_id'>Admin</a></td>";
            echo "<td><a href='users.php?source=edit_user&u_id=$user_id'>Edit</a></td>";
            echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
            echo "</tr>";
        }
        ?>


    </tbody>
</table>
<?php
if (isset($_GET['change_to_user'])) {
    $the_user_id = $_GET['change_to_user'];
    $query = "UPDATE users SET user_role = 'user' WHERE user_id = '$the_user_id'";
    $approve_query = mysqli_query($connection, $query) or die("Error " . mysqli_error($connection));
    header("Location: users.php");
}

if (isset($_GET['change_to_adm'])) {
    $the_user_id = $_GET['change_to_adm'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = '$the_user_id'";
    $unapprove_query = mysqli_query($connection, $query) or die("Error " . mysqli_error($connection));
    header("Location: users.php");
}


if (isset($_GET['delete'])) {
    $the_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
    $delete_query = mysqli_query($connection, $query) or die("Error " . mysqli_error($connection));
    header("Location: users.php");
}
?>
