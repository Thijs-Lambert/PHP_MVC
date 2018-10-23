<section>
  <header><h1 class="page-header">Register</h1></header>
  <div class="page-content">
    <form class="register-form" method="post">
      <div class="input-container text">
        <label>
          <span class="form-label">Email:</span>
          <input type="text" name="email" class="form-input"<?php if(!empty($_POST['email'])) echo 'value="' . $_POST['email'] . '"';?> />
          <?php if(!empty($errors['email'])) echo '<span class="error">' . $errors['email'] . '</span>';?>
        </label>
      </div>
      <div class="input-container text">
        <label>
          <span class="form-label">Password:</span>
          <input type="password" name="password" class="form-input"<?php if(!empty($_POST['password'])) echo 'value="' . $_POST['password'] . '"';?> />
          <?php if(!empty($errors['password'])) echo '<span class="error">' . $errors['password'] . '</span>';?>
        </label>
      </div>
      <div class="input-container text">
        <label>
          <span class="form-label">Confirm Password:</span>
          <input type="password" name="confirm_password" class="form-input"<?php if(!empty($_POST['confirm_password'])) echo 'value="' . $_POST['confirm_password'] . '"';?> />
          <?php if(!empty($errors['confirm_password'])) echo '<span class="error">' . $errors['confirm_password'] . '</span>';?>
        </label>
      </div>
      <div>
        <input type="submit" name="action" value="Register" class="form-submit" />
      </div>
    </form>
  </div>
</section>
