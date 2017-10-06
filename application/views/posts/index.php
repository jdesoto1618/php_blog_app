<h1 class="text-center">You're on the <?= $title ?> Page!</h1>
<hr>
<!-- loop through each post -->
<?php foreach ($posts as $post) : ?>
  <!-- post title. also get the post date and display it next to the title -->
  <h3><?= $post['title']?> <small class="post_date">Posted on <em><?= $post['created_at']?></em></small></h3> 
  <!-- post body -->
  <p><?= $post['body']?></p>
<?php endforeach; ?>
