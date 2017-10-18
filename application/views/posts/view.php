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
  <!-- back button, goes to posts index page -->
  <a class="btn btn-primary back_button" href="<?= site_url('/posts/'); ?>">Back to Posts</a>
  <!-- only show edit and delete buttons on posts you created. $post[''] must include a matching field name from the model, database -->
  <?php if($this->session->userdata('user_id') == $post['fk_user_id']): ?>
    <a class="btn btn-warning edit_post" href="<?= site_url('/posts/edit/'.$post['slug']); ?>">Edit Post</a>
    <!-- place this button opposite the back to posts button so there's less chance of accidental deletion -->
    <!-- use a form_open to place the delete button. also, this will delete the post by its id -->
    <?= form_open('/posts/delete/'.$post['id'], array('class' => 'delete_form')); ?>
      <input class="btn btn-danger delete_post pull-right" type="submit" value="Delete This Post">
    </form>
  <?php endif; ?>
</div>
<hr class="comments_hr">
<h3 class="text-center comments_section">Comments</h3>
<!-- if comments exist for a post, show them all -->
<?php if($comments) :  ?>
  <?php foreach ($comments as $comment) : ?>
    <div class="well">
      <h5 class="comment_body"><em><?= $comment['name']; ?> commented:</em> <strong><?= $comment['body']; ?></strong></h5>
    </div>
  <?php endforeach; ?>
<?php else : ?>
  <!-- if there are no comments on a post -->
  <p class="no_comments">No comments on this post yet.</p>
<?php endif; ?>
<hr class="horizontal">
<h3 class="text-center add_comment_title">Add Comment</h3>
<!-- show comment errors, if any -->
<!-- use bootstrap with php to style the errors. validation_errors accepts parameters -->
<ul class="error_list">
  <?= validation_errors('<li class="error_list"><span class="label label-danger">', '</span></li>'); ?>
</ul>
<!-- form open: 'comments controller/create method/post id' -->
<?= form_open('comments/create/'.$post['id'], array('class' => 'add_comment_form')); ?>
  <!-- user's name for comments -->
  <div class="form-group">
    <input class="form-control comment_field" type="text" name="name" placeholder="Name">
  </div>
  <!-- user's email for comments -->
  <div class="form-group">
    <input class="form-control comment_field" type="email" name="email" placeholder="Email">
  </div>
  <!-- user's comment body -->
  <div class="form-group">
    <!-- save user data on submit, in case they are redirected. for textarea, make sure to place this between the textarea tags, not in a value like for input tags -->
    <textarea class="form-control comment_field" name="body" rows="5" cols="80" placeholder="Comment"></textarea>
  </div>
  <!-- hidden field to pass post slug with this comment -->
  <input type="hidden" name="slug" value="<?= $post['slug']; ?>">
  <!-- <input class="btn btn-primary comment_button" type="submit" value="Add Comment"> -->
  <button class="btn btn-primary comment_button" type="submit" name="button">Add Comment</button>
</form>
