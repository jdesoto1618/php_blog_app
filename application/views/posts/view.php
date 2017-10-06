<h1 class="text-center">View Post</h1>
<hr class="horizontal">
<h3 class="text-center"><?= $post['title']; ?><small class="post_date">Posted on <em><?= $post['created_at']?></em></small></h3>
<div class="post_body">
  <?= $post['body']; ?>
  <br><br>
  <hr class="horizontal">
  <p><a class="btn btn-primary back_to_posts" href="<?= site_url('/posts/'); ?>">Back to Posts</a></p>
</div>
