<?php global $post; // required
$args = []; // exclude category 9
$custom_posts = get_posts($args);
$loopCount = 0
?>

<?php foreach($custom_posts as $post) : setup_postdata($post)?>
  <?php if($loopCount == 0 ): ?>
    <div class="columns large-8" >

    <a href="<?php the_permalink(); ?>" class="featured-articles mb-2 "
       style="background-image: url('<?= get_the_post_thumbnail_url() ?>')">
      <div class="featured-articles__text-container">
        <div class="featured-articles__tag"><?= getFilteredCategory(get_the_category()) ?></div>
        <?php the_title(); ?>
      </div>
    </a>
  </div>
    <?php $loopCount++ ?>
  <?php endif; ?>
<?php endforeach; ?>

 <div class="columns large-4">
   <?php $loopSkip = 0 ?>
   <?php foreach($custom_posts as $post) : setup_postdata($post) ?>
   <?php if($loopSkip == 0){ $loopSkip++; continue;} ?>

<?php if($loopCount <= 2):?>
       <div class="column medium-6 large-12 pr-0 pr-md-3 pl-0 pl-lg-3">
          <a href="<?php the_permalink(); ?>"
             class="featured-articles featured-articles--small mb-2"
             style="background-image: url('<?= get_the_post_thumbnail_url() ?>')">
            <div class="featured-articles__text-container">
              <div class="featured-articles__tag"><?= getFilteredCategory(get_the_category()) ?></div>
              <?php the_title(); ?>
            </div>
          </a>
        </div>
       <?php $loopCount++ ?>
     <?php else: ?>
       <?php break ?>
     <?php endif; ?>
   <?php endforeach; ?>
 </div>

<div class="columns">
    <?php $loopSkip = 0 ?>
    <?php foreach($custom_posts as $post) : setup_postdata($post) ?>
      <?php if($loopSkip < 3){ $loopSkip++; continue;} ?>
      <article
        class="columns medium-6 large-4 pr-0 pr-md-3 pl-md-3 pl-0 end">
        <div class="card">
          <a href="<?php the_permalink(); ?>"
             class="card__image"
             style="background-image: url('<?= get_the_post_thumbnail_url() ?>')"></a>
          <div class="card__text-container">
            <p class="card__category-title"><?= getFilteredCategory(get_the_category()) ?></p>
            <a href="<?php the_permalink(); ?>" class="card__title mb-1"><?php the_title(); ?></a>
            <div class="card__text">
              <?php html5wp_excerpt('html5wp_index'); ?>
            </div>
            <div class="card__date"><?php the_time('F j, Y'); ?></div>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
