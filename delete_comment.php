<?php
require 'global_config.php';
$conn = mysqli_connect($host, $user_name, $pw, $dbname);
$user_id =  $_SESSION['user_id'];
$comment_id = $_GET['comment_id'];
$post_id = $_GET['post_id'];
$query = "SELECT * FROM comments WHERE comment_id = '$comment_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if (isset($_GET['delete_comment'])){
  if($user_id == $row['user_id']){
    $query = "DELETE FROM comments WHERE comment_id = '$comment_id'";
    $result = mysqli_query($conn, $query);
    header ('location: show_post.php?post_id=' . $post_id);
  } else {
    echo "You did not create the comment you can not delete it!";
    header ('refresh:1, show_post.php?post_id=' . $post_id);
  }
}
mysqli_close($conn);
?>
