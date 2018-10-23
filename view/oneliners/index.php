<section>
  <header><h1 class="page-header hidden">Onliners</h1></header>
  <div class="page-content">
    <section class="page-section oneliners">
      <header class="hidden"><h1>Onliners list</h1></header>
      <?php if(empty($oneliners)): ?>
      <p>No oneliners yet</p>
      <?php else: ?>
      <ol>
        <?php
        foreach($oneliners as $oneliner) {
          echo "<li class=\"oneliner\">";
          echo "<a href=\"index.php?page=detail&id=" . $oneliner['id'] . "\">";
          echo "<span class=\"oneliner-text\">";
          echo $oneliner['text'];
          echo "</span>";
          echo "</a>";
          echo "<span class=\"oneliner-author\">by " . $oneliner['author'] . "</span>";
          if (!empty($_SESSION['user'])) {
            echo ' <a href="index.php?id=' . $oneliner['id'] . '&amp;action=delete" class="confirmation">delete</a>';
          }
          echo "</li>";
        }
        ?>
      </ol>
      <?php endif; ?>
    </section>
    <?php if (!empty($_SESSION['user'])): ?>
      <section class="page-section onliner-form">
        <header class="page-section-header"><h1>Add Oneliner</h1></header>
        <form class="oneliner-form" method="post">
          <div class="input-container text">
            <label>
              <span class="form-label">Oneliner:</span>
              <textarea name="text" class="form-text"><?php if(!empty($_POST['text'])) echo $_POST['text'];?></textarea>
              <?php if(!empty($errors['text'])) echo '<span class="error">' . $errors['text'] . '</span>';?>
            </label>
          </div>
          <div>
            <input type="submit" name="action" value="Add Oneliner" class="form-submit" />
          </div>
        </form>
      </section>
    <?php endif; ?>
  </div>
</section>
<script type="text/javascript">
{
  const init = () => {
    const confirmationLinks = Array.from(document.getElementsByClassName(`confirmation`));
    confirmationLinks.forEach($confirmationLink => {
      $confirmationLink.addEventListener(`click`, e => {
        if (!confirm('Are you sure?')) e.preventDefault();
      });
    });
  };
  init();
}
</script>
