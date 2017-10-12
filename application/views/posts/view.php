<h1 class="text-center">View Post</h1>
<hr class="horizontal">
<h3 class="text-center"><?= $post['title']; ?><small class="post_date">Posted on <em><?= $post['created_at']?></em></small></h3>
<div class="post_body">
  <div class="row">
    <!-- place image on the left side of the post -->
    <div class="col-xs-2">
      <!-- show the image the user uploads. pull the image name from the database to be passed in as the one the user uploaded -->
      <img class="post_image" src="<?= site_url('./images/posts/'); ?><?= $post['post_image']; ?>">
    </div> <!-- end col-xs-3 div -->
    <!-- place post body on the right of the image, inline with it -->
    <div class="col-xs-10">
      <!-- post body -->
      <?= $post['body']; ?>
    </div>
  </div>
  <hr class="horizontal">
  <a class="btn btn-primary back_to_posts" href="<?= site_url('/posts/'); ?>">Back to Posts</a>
  <a class="btn btn-warning edit_post" href="<?= site_url('/posts/edit/'.$post['slug']); ?>">Edit Post</a>
  <!-- place this button opposite the back to posts button so there's less chance of accidental deletion -->
  <!-- use a form_open to place the delete button. also, this will delete the post by its id -->
  <?= form_open('/posts/delete/'.$post['id'], array('class' => 'delete_form')); ?>
    <input class="btn btn-danger delete_post pull-right" type="submit" value="Delete This Post">
  </form>
</div>
