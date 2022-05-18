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
  <a href="all_posts.php">Posts</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="create_post.php">Create post</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="profile_page.php">Profile</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="logout.php">Logout</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  🐘 Big Elephant 🐘
  <br/><br/>

  <?php
  $post_id = $_GET['post_id'];
  $conn = mysqli_connect($host, $user_name, $pw, $dbname);
  $post_query = "SELECT * FROM posts WHERE post_id = '$post_id'";
  $post_result = mysqli_query($conn, $post_query);

  if (mysqli_num_rows($post_result) > 0){
    $post_row = mysqli_fetch_assoc($post_result);
    echo "<b>Post title:</b>" . $post_row['post_title'] . "<br/>";
    echo "<b>Post:</b> <br/>" . $post_row['post'];
  }
  $user_id = $_SESSION['user_id'];
  $user_query = "SELECT * FROM users WHERE user_id = '$user_id'";
  $user_result = mysqli_query($conn, $user_query);
  $user_row = mysqli_fetch_assoc($user_result);

  ?>
  <br/><br/>
  <a  href='edit_post.php?post_id=<?php echo $post_id ?>'>Edit</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a  href='delete_post.php?post_id=<?php echo $post_id ?>'>Delete</a>
  <br/><br/>

  <form action="show_post.php?post_id=<?php echo $post_id ?>" method="post">
    <input type="text" name="write_comment" maxlength="1200" />
    <input type="submit" name="comment" value="Comment" />
  </form>
  <br/><br/>

  <?php
  if (isset($_POST['comment_submit'])){
    $post_id = $_GET['post_id'];
    $comment_id = $_GET['comment_id'];
    $edit_comment = mysqli_real_escape_string($conn, $_POST['edit_comment']);
    $comment_update = "UPDATE comments SET comment = '$edit_comment' WHERE comment_id = '$comment_id'";
    $comment_update_result = mysqli_query($conn, $comment_update);
    if(!$comment_update_result){
      die("Failed to update comment!" . mysqli_error($conn));
    }
  }

  if (isset($_POST['comment'])){
    $comment = $_POST['write_comment'];
    if ($comment == null || trim($comment) === "") {
      die("Comment can not be blank!");
    }else{
      $comment_query = "INSERT INTO comments (post_id, user_id, comment) VALUES ('$post_id', '$user_id', '$comment');";
      $comment_insert = mysqli_query($conn, $comment_query);

    }
  }
  $comment_show_all = "SELECT users.user_id, users.f_name, users.l_name, comments.comment, comments.comment_id FROM users JOIN comments ON users.user_id = comments.user_id WHERE comments.post_id = '$post_id' ORDER BY comments.comment_id;";
  $comment_show_all_result = mysqli_query($conn, $comment_show_all);
  if (!$comment_show_all_result){
    die("Failed to show comments!" . mysqli_error($conn));
  }

  if (mysqli_num_rows($comment_show_all_result) >0) {
    while($comment_row = mysqli_fetch_assoc($comment_show_all_result)){
      if (isset ($_GET['edit_comment']) && $comment_row['comment_id'] == $_GET['comment_id'] && $comment_row['user_id'] == $user_id){
        //$comment = mysqli_real_escape_string($conn, $comment_row['comment']);
        echo "<form action='show_post.php?post_id=" . $post_id . "&comment_id=" . $comment_row['comment_id'] . "' method='post'>
        <label for='comment'>" . "<b>" . $comment_row['f_name'] . " " .  $comment_row['l_name'] . ": </b>" .  "</label>
        <input type='text' name='edit_comment' value='" . htmlspecialchars($comment_row['comment'], ENT_QUOTES) . "'/>
        <input type='submit' name='comment_submit' value='Submit'/><br/></form>";
      }else{
        echo "<b>" . $comment_row['f_name'] . " " . $comment_row['l_name'] . ": </b>" . $comment_row['comment'] . "<br/>" .
        "&nbsp;&nbsp;<a href='show_post.php?post_id=" . $post_id . "&comment_id=" . $comment_row['comment_id'] . "&edit_comment'>Edit</a>" .
        "&nbsp;&nbsp;<a href='delete_comment.php?post_id=" . $post_id . "&comment_id=" . $comment_row['comment_id'] . "&delete_comment'>Delete</a><br/>";
      }
    }
  }
  mysqli_close($conn);

  ?>
</body>
</html>
