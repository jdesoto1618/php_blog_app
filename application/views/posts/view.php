<h2 class="text-center"><?= $post['title']; ?><small class="post_date">Posted on <em><?= $post['created_at']?></em></small></h2>
<div class="post_body">
  <?= $post['body']; ?>
  <br><br>
  <hr class="horizontal">
  <p><a class="btn btn-primary" href="<?= site_url('/posts/'); ?>">Back to Posts</a></p>
</div>
