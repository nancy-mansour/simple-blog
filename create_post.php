<?php require 'global_config.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create post</title>
  </head>
  <body>
    <?php
      if (!isset($_SESSION['user_id'])){
        die (header ('location:login.php'));
      }
    ?>
    <a href="home_page.php">Home page</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="profile_page.php">Profile</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="all_posts.php">Posts</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="logout.php">Logout</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    🐘 Big Elephant 🐘
    <br/><br/>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <label for="post_title">Post Title*</label>
      <input type="text" name="post_title" value=""/>
      <br/><br/>

      <label for="post">Post*</label><br/>
      <textarea name="post" rows="10" cols="100"></textarea>
      <br/><br/>

      <input type="submit" name="create_post" value="Create post"/>
      <input type="submit" name="cancel" value="Cancel"/>

    </form>
    <p>*Required</p>

    <?php
    if (isset($_POST['create_post'])) {
      $required_fields = array($_POST['post_title'], $_POST['post']);
      foreach ($required_fields as $value) {
        if ($value == null || trim($value) === "") {
          die("Fill required fields!");
        }
      }
      $conn = mysqli_connect($host, $user_name, $pw, $dbname);
      $post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
      $post = mysqli_real_escape_string($conn, $_POST['post']);
      $user_id = $_SESSION['user_id'];

      $query = "INSERT INTO posts (user_id, post_title, post) VALUES ('$user_id', '$post_title', '$post');";
      $result = mysqli_query($conn, $query);

      if (!$result) {
        die ('Could not create post: ' . mysqli_error($conn));
      }
      echo "Post created!";
      header("Refresh:2; url = all_posts.php");

      mysqli_close($conn);
    } elseif (isset($_POST['cancel'])) {
      header("location: all_posts.php");
    }
     ?>
  </body>
</html>
