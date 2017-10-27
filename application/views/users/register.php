<h1 class="text-center"><?= $title; ?></h1>
<div class="form-container registration">
  <!-- form open looks in the controller(users)/method(register). this is what will be run when the user clicks sign up -->
  <?= form_open('users/register', array('class' => 'register_form')); ?>
  <h3 class="text-center new_user">New User Information</h3>
    <!-- post title, category, image fields -->
    <div class="form-group">
      <!-- form control makes the input field block level and styles it -->
      <!-- set the value in this field to hold whatever is in it on submit. if isset returns false, set this form field to empty -->
      <!-- the name='title' will correspond to the database field of the same name! -->
      <input type="text" class="form-control" name="name" placeholder="Name*">
    </div>
    <!-- user's email. change type to email -->
    <div class="form-group">
      <input type="email" class="form-control" name="email" placeholder="Email Address*">
    </div>
    <!-- user's zipcode -->
    <div class="form-group">
      <input type="text" class="form-control" name="zipcode" placeholder="Zipcode">
    </div>
    <!-- user's username -->
    <div class="form-group">
      <input type="text" class="form-control" name="username" placeholder="Username*">
    </div>
    <!-- user's password. use type password -->
    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password*">
    </div>
    <!-- password confirmation. use type password -->
    <div class="form-group">
      <input type="password" class="form-control" name="pwconf" placeholder="Password Confirmation*">
    </div>
    <!-- submit button -->
    <button type="submit" class="btn btn-success btn-block" name="button">Register This User</button>
    <!-- back to posts button -->
    <a class="btn btn-primary back_to_posts" href="<?= site_url('/posts/'); ?>">Back to Posts</a>
  </form> <!-- alternatively, can use <?#= form_close(); to generate the </form> markup ?> -->

</div> <!-- closes form_container div -->
<!-- show errors for form validation, below the form -->
<!-- use bootstrap with php to style the errors. validation_errors accepts parameters -->
<ul class="error_list">
  <?= validation_errors('<li class="error_list"><span class="label label-danger">', '</span></li>'); ?>
</ul>
