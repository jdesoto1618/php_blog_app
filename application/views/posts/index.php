<h1 class="text-center"><?= $title; ?></h1>
<h3 class="text-center">Newest posts are listed first.</h3>
<hr class="horizontal">
<!-- loop through each post -->
<?php foreach ($posts as $post) : ?>
  <!-- post title. also get the post date and display it next to the title. this can't be done until the tables are joined, since we set up the categories in a separate table. If category was built in from the start, it would be easier. This is more likely a real-world application of any website. adding features as you go, you can't think or anticipate them all from the beginning. In any case, the categories and posts tables are joined, and we can simply use $post['name'] to access the category name from the categories table -->
  <h3><?= $post['title']?> - <strong><?= $post['name'] ?></strong> <small class="post_date">Posted on <em><?= $post['created_at']?></em></small></h3>
  <div class="row">
    <!-- place image on the left side of the post -->
    <div class="col-xs-2">
      <!-- show the image the user uploads. pull the image name from the database to be passed in as the one the user uploaded -->
      <img class="post_image" src="<?= site_url('./images/posts/'); ?><?= $post['post_image']; ?>">
    </div> <!-- end col-xs-3 div -->
    <!-- place post body on the right of the image, inline with it -->
    <div class="col-xs-10">
      <!-- post body -->
      <p><?= word_limiter($post['body'], 50)?></p>
      <br>
      <!-- link to view a specific post. use site_url so the address becomes /php_blog/posts/slugname -->
      <a class="btn btn-primary view_post" href="<?= site_url('/posts/'.$post['slug']); ?>">View Post</a>
    </div> <!-- end col-xs-9 div -->
  </div> <!-- end row div -->
<?php endforeach; ?>
<hr class="horizontal">
<!-- pagination div for styling -->
<div class="pagination">
  <!-- get pagination from controller. this will create the links to separate pages for more posts per the rules in the controller -->
  <?= $this->pagination->create_links(); ?>
</div>
