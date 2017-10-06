<h1 class="text-center"><?= $title ?>!</h1>
<hr class="horizontal">
<!-- loop through each post -->
<?php foreach ($posts as $post) : ?>
  <!-- post title. also get the post date and display it next to the title -->
  <h3><?= $post['title']?> <small class="post_date">Posted on <em><?= $post['created_at']?></em></small></h3>
  <!-- post body -->
  <p><?= $post['body']?></p>
  <br>
  <!-- link to view a specific post. use site_url so the address becomes /php_blog/posts/slugname -->
  <p><a class="btn btn-primary view_post" href="<?= site_url('/posts/'.$post['slug']); ?>">View Post</a></p>
<?php endforeach; ?>
