<!-- page title from categories controller -->
<h1 class="text-center"><?= $title; ?></h1>
<hr class="horizontal">
<!-- set bootstrap class for ul -->
<ul class="list-group">
  <!-- loop through and display each category -->
  <?php foreach ($categories as $category) : ?>
    <!-- bootstrap list group item class -->
    <!-- make a list item for each category for posts. each post has a category, so we want to show all posts that correspond to a category id. the categories table has a PK for each category, so use $category['id']. once this is done, show the category name associated with that id using $category['name']. this is also in the categories database -->
    <li class="list-group-item"><a href="<?= site_url('/categories/posts/'.$category['id']); ?>"><?= $category['name']; ?></a></li>
  <?php endforeach; ?>
</ul>
<!-- add this div so it can center the content in it, the anchor tag. div may have built in margins/padding, remove if necessary -->
<div class="text-center">
  <a class="btn btn-primary back_to_categorized_posts" href="<?= site_url('/posts/'); ?>">Back to Posts</a>
</div>
