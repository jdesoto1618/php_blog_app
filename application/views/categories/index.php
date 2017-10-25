<!-- page title from categories controller -->
<h1 class="text-center"><?= $title; ?></h1>
<hr class="horizontal">
<!-- set bootstrap class for ul -->
<ul class="list-group">
  <!-- loop through and display each category -->
  <?php foreach ($categories as $category): ?>
    <!-- bootstrap list group item class -->
    <!-- make a list item for each category for posts. each post has a category, so we want to show all posts that correspond to a category id. the categories table has a PK for each category, so use $category['id']. once this is done, show the category name associated with that id using $category['name']. this is also in the categories database -->
    <!-- also, check if a category belongs to the currently logged in user. this code will be placed after the closing anchor tag but still inside the li, so the X appears next to it if the conditional result is true -->
    <li class="list-group-item">
      <a href="<?= site_url('/categories/posts/'.$category['id']); ?>"><?= $category['name']; ?>
      <?php if($this->session->userdata('user_id') == $category['fk_user_id']): ?>
        <!-- submit delete request if the user wants to delete their category -->
        <form class="delete_category_form" action="categories/delete/<?= $category['id']; ?>" method="post">
          <!-- leaving off the first btn when specifying btn btn-link will not give the link a bootstrap styling -->
          <input type="submit" class="btn-link delete_category" value="&times;">
        </form>
        <!-- since I had already set the display for the li's to be block, had to move the closing anchor tag here after setting the delete form to have display: inline in the css. this allowed the delete category X and the category name to be displayed inline  -->
      <?php endif; ?></a>
    </li>
  <?php endforeach; ?>
</ul>
<!-- add this div so it can center the content in it, the anchor tag. div may have built in margins/padding, remove if necessary -->
<div class="text-center">
  <a class="btn btn-primary back_to_categorized_posts" href="<?= site_url('/posts/'); ?>">Back to Posts</a>
</div>
