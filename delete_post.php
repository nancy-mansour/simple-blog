<?php
require 'global_config.php';
if (!isset ($_SESSION['user_id'])) {
  die (header("location: login.php"));
}
$user_id = $_SESSION['user_id'];
$post_id = $_GET['post_id'];
$conn = mysqli_connect($host, $user_name, $pw, $dbname);
$query = "SELECT * FROM posts WHERE post_id = '$post_id'";
$result = mysqli_query($conn, $query);
mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
$post_user_id = $row['user_id'];
if ($user_id !== $post_user_id){
  echo "Can not edit post, you did not create it!";
  die (header("Refresh:2 all_posts.php"));
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>DELETE ACCOUNT!</title>
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

  <p> Are you sure you want to delete post?</P>
    <form action="delete_post.php?post_id=<?php echo $post_id ?>" method="post">
      <input type="submit" name="confirm" value="Confirm"/>
      <input type="submit" name="cancel" value="Cancel"/>
    </form>

    <?php
    if(isset($_POST['confirm'])){
      $conn = mysqli_connect($host, $user_name, $pw, $dbname);
      if (! $conn) {
        die('Could not connect: ' .mysqli_error($conn));
      }
      $query = "DELETE FROM posts WHERE post_id = $post_id";
      $result = mysqli_query($conn, $query);
      if (!$result) {
        die ('Could not delete post: ' . mysqli_error($conn));
      }
      echo "Post deleted!";
      mysqli_close($conn);
      header("Refresh:2; url = all_posts.php");


    }elseif (isset($_POST['cancel'])) {
      echo "you should be redirected";
      header("location: show_post.php?post_id=" . $post_id);
    }
    
    ?>
  </body>
  </html>
