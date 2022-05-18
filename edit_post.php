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

  <form action="edit_post.php?post_id=<?php echo $post_id ?>" method="post">
    <label for="post_title">Post Title*</label>
    <input type="text" name="post_title" value="<?php echo (htmlspecialchars($row['post_title'], ENT_QUOTES))?>"/>
    <br/><br/>

    <label for="post">Post*</label><br/>
    <textarea name="post" rows="10" cols="100"><?php echo (htmlspecialchars($row['post'], ENT_QUOTES))?></textarea>
    <br/><br/>

    <input type="submit" name="edit_post" value="Edit post"/>

  </form>
  <p>*Required</p>

  <?php
  if (isset($_POST['edit_post'])) {
    $conn = mysqli_connect($host, $user_name, $pw, $dbname);

    if (! $conn) {
      die('Could not connect: ' .mysqli_error($conn));
    }

    $required_fields = array($_POST['post_title'], $_POST['post']);
    foreach ($required_fields as $value) {
      if ($value == null || trim($value) === "") {
        die("Fill required fields!");
      }
    }

    $post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $post = mysqli_real_escape_string($conn, $_POST['post']);
    
    $query = "UPDATE posts SET post_title = '$post_title', post = '$post'
    WHERE post_id = '$post_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
      die ('Could not enter data: ' . mysqli_error($conn));
    }

    header("location: show_post.php?post_id=" . $post_id);

    mysqli_close($conn);
  }

  ?>

</body>
</html>
