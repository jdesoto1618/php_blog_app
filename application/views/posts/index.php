<h1 class="text-center">Blog Posts Page!</h1>
<h3 class="text-center">Newest posts are listed first.</h3>
<hr class="horizontal">
<!-- loop through each post -->
<?php foreach ($posts as $post) : ?>
  <!-- post title. also get the post date and display it next to the title. this can't be done until the tables are joined, since we set up the categories in a separate table. If category was built in from the start, it would be easier. This is more likely a real-world application of any website. adding features as you go, you can't think or anticipate them all from the beginning. In any case, the categoriesand posts tables are joined, and we can simply use $post['name'] to access the category name from the categories table -->
  <h3><?= $post['title']?> - <strong><?= $post['name'] ?></strong> <small class="post_date">Posted on <em><?= $post['created_at']?></em></small></h3>
  <!-- post body -->
  <p><?= word_limiter($post['body'], 50)?></p>
  <br>
  <!-- link to view a specific post. use site_url so the address becomes /php_blog/posts/slugname -->
  <p><a class="btn btn-primary view_post" href="<?= site_url('/posts/'.$post['slug']); ?>">View Post</a></p>
<?php endforeach; ?>
