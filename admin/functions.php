<?php

function insert_categories(){
    global $connection;
    
    if (isset($_POST['submit'])) {
                        $cat_title = $_POST['cat_title'];
                        if ($cat_title == "" || empty($cat_title)) {
                            echo "<p style='color:crimson;'>This field must not be empty!</p>";
                        } else {
                            $query = "INSERT INTO categories(cat_title) ";
                            $query .= "VALUE('{$cat_title}') ";
                            $create_category_query = mysqli_query($connection, $query);
                            if (!$create_category_query) {
                                die("Querry failed" . mysqli_error($connection));
                            }
                        }
                    }
                    
}

function findAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories LIMIT 30";
    $select_categories = mysqli_query($connection, $query);


    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    };
}

function deleteCategory(){
    global $connection;
    if (isset($_GET['delete'])) {
        $del_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    };
}
