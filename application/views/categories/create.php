<!-- place page title here, from categories controller, create method -->
<h1 class="text-center"><?= $title; ?></h1>
<hr class="horizontal">
<!-- use bootstrap form container for creating category form. this uses the same classes as creating a post -->
<div class="form-container category_form">
  <!-- use form_open_multipart for the form, when you want the user to be able to upload images. using form_open is just as well, but doesnt allow image upload -->
  <!-- categories/create is the POST request to this route -->
  <?= form_open_multipart('categories/create', array('class' => 'post_form')); ?>
    <div class="form-group">
      <!-- the name of this input field must match what is specified in the Categories controller create method, in the form_validation -->
      <!-- use bootstrap class form-control to style input field -->
      <input class="form-control" type="text" name="name" placeholder="Category">
    </div>
    <!-- block level submit button. inherits the css styling for this class, as intended for all submit buttons -->
    <button type="submit" class="btn btn-success btn-block" name="button">Create Category</button>
    <!-- back button, goes to posts index page -->
    <a class="btn btn-primary back_to_posts" href="<?= site_url('/posts/'); ?>">Back to Posts</a>
  </form>
</div>
<!-- show errors for form validation, below the form -->
<!-- use bootstrap with php to style the errors. validation_errors accepts parameters -->
<ul class="error_list">
  <?= validation_errors('<li><span class="label label-danger">', '</span></li>'); ?>
</ul>
