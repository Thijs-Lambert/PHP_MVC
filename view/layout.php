<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Onelinr</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="site-container">
    <header><h1 class="site-header"><a href="index.php">Onelinr</a></h1></header>
    <?php
      if(!empty($_SESSION['error'])) {
        echo '<div class="error box">' . $_SESSION['error'] . '</div>';
      }
      if(!empty($_SESSION['info'])) {
        echo '<div class="info box">' . $_SESSION['info'] . '</div>';
      }
    ?>

    <section class="login-container">
      <?php if (empty($_SESSION['user'])): ?>
      <header class="hidden"><h1>Login</h1></header>
      <form class="login-form" method="post" action="index.php?page=login">
        <input type="hidden" name="action" value="login" />
        <div class="input-container text">
          <label>
            <span class="form-label hidden">Email:</span>
            <input type="text" name="email" placeholder="email" class="form-input" />
          </label>
        </div>
        <div class="input-container text">
          <label>
            <span class="form-label hidden">Password:</span>
            <input type="password" name="password" placeholder="password" class="form-input" />
          </label>
        </div>
        <div class="input-container submit">
          <button type="submit" class="form-submit">Login</button>
          or <a href="index.php?page=register">Register</a>
        </div>
      </form>
      <?php else: ?>
      <header class="hidden"><h1>Logout</h1></header>
      <p><?php echo $_SESSION['user']['email'];?> - <a href="index.php?page=logout" class="logout-button">Logout</a></p>
      <?php endif; ?>
  </section>

    <?php echo $content; ?>
  </div>

</body>
</html>
