<!-- place page title here, from posts controller, create method -->
<h1 class="text-center"><?= $title; ?></h1>
<div class="form_container">
  <?= form_open('posts/update', array('class' => 'edit_form')); ?>
    <!-- set the hidden field to capture the post id -->
    <input type="hidden" name="id" value="<?= $post['id']; ?>">
    <!-- post title, post fields -->
    <div class="form-group">
      <!-- form control makes the input field block level and styles it -->
      <!-- set the value in this field to hold whatever is in it on submit. if isset returns false, set this form field to empty -->
      <!-- the name='title' will correspond to the database field of the same name! -->
      <input type="text" class="form-control" name="title" value="<?= $post["title"] ?>">
    </div>

    <div class="form-group">
      <!-- form control makes the input field block level and styles it -->
      <!-- the name='body' will correspond to the database field of the same name! -->
      <!-- another gotcha with textarea. place the post['body'] code betweenthe textarea tags! NOT as a value, like an input -->
      <textarea name="body" class="form-control" rows="4" cols="80"><?= $post["body"] ?></textarea>
    </div>

    <button type="submit" class="btn btn-success btn-block" name="button">Edit Post</button>
    <br>
  </form>

</div> <!-- closes form_container div -->
<!-- show errors for form validation, below the form -->
<!-- use bootstrap with php to style the errors. validation_errors accepts parameters -->
<ul class="error_list">
  <?= validation_errors('<li><span class="label label-danger">', '</span></li>'); ?>
</ul>
