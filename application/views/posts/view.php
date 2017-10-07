<h1 class="text-center">View Post</h1>
<hr class="horizontal">
<h3 class="text-center"><?= $post['title']; ?><small class="post_date">Posted on <em><?= $post['created_at']?></em></small></h3>
<div class="post_body">
  <?= $post['body']; ?>
  <br><br>
  <hr class="horizontal">
  <a class="btn btn-primary back_to_posts" href="<?= site_url('/posts/'); ?>">Back to Posts</a>
  <a class="btn btn-warning edit_post" href="<?= site_url('/posts/edit/'.$post['slug']); ?>">Edit Post</a>
  <!-- place this button opposite the back to posts button so there's less chance of accidental deletion -->
  <!-- use a form_open to place the delete button. also, this will delete the post by its id -->
  <?= form_open('/posts/delete/'.$post['id'], array('class' => 'delete_form')); ?>
    <input class="btn btn-danger delete_post pull-right" type="submit" value="Delete This Post">
  </form>
</div>
