<?php
require 'global_config.php';
if (!isset ($_SESSION['user_id'])) {
  die (header("location: login.php"));
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Posts</title>
  </head>
  <body>
    <a href="home_page.php">Home page</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="create_post.php">Create post</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="profile_page.php">Profile</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="logout.php">Logout</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    🐘 Big Elephant 🐘
    <br/><br/>
    <p> Posts </p>
    <br/>

    <?php
    $conn = mysqli_connect($host, $user_name, $pw, $dbname);
    $query = "SELECT * FROM posts";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) >0) {
      while($row = mysqli_fetch_assoc($result)){
        echo "Post title: " .$row["post_title"];
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='show_post.php?post_id=" . $row['post_id'] . "'>Show</a>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;<a  href='edit_post.php?post_id=" . $row['post_id'] . "'>Edit</a> ";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;<a  href='delete_post.php?post_id=" . $row['post_id'] . "'>Delete</a>  <br/><br/>";
      }
    }
    mysqli_close($conn);

    ?>

  </body>
</html>
