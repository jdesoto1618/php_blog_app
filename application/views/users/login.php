<!-- keep page title separate from form container, so it appears on top of it -->
<h1 class="text-center"><?= $title; ?></h1>
<div class="row">
  <!-- user col-xs-8 to get teh size I want for this form, and offset it until the form is in the mdidle -->
  <div class="col-xs-8 col-xs-offset-1">
    <div class="form-container login">
      <!-- syntax on form_open is ('controller_name/method_name') -->
      <?= form_open('users/login'); ?>
          <h3 class="text-center login_title">Enter Login Information</h3>
          <!-- use bootstrap grid layout, adjust offset until form is centered -->
          <!-- username field for login with client side required -->
          <div class="form-group">
            <input class="form-control" type="text" name="username" placeholder="Username*" required autofocus>
          </div>
          <!-- password field for login with client side required -->
          <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Password*" required>
          </div>
          <!-- submit button -->
          <button type="submit" class="btn btn-success btn-block" name="button">Log In</button>
        <!-- </div> -->
      <?= form_close(); ?>
    </div> <!-- closes form container div -->
  </div> <!-- closes col div -->
</div> <!-- closes row div -->
