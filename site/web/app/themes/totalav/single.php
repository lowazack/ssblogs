<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()) :the_post(); ?>
<?php wpb_set_post_views(get_the_ID());?>
<div class="content">
  <div class="row">
    <div class="columns large-9">
      <div class="post">
        <div class="post__banner" style="background-image: url('<?= get_the_post_thumbnail_url() ?>')"></div>
        <div class="post__container">
          <div class="post__title"><?php the_title(); ?></div>
          <div class="post__date"><?php the_time('F j, Y'); ?></div>
          <hr>
          <div class="post__text">
            <?php the_content(); // Dynamic Content ?>
          </div>
        </div>
      </div>
    </div>
    <div class="columns small-3 d-n d-md-b">
      <div class="sidebar-card">
        <div class="sidebar-card__title">
          Most Viewed
        </div>

        <?php
        $popularpost = new WP_Query(
          [
            'posts_per_page' => 3,
            'meta_key'       => 'wpb_post_views_count',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC'
          ]
        ); ?>
        <?php while($popularpost->have_posts()) : $popularpost->the_post() ?>

          <hr>
          <span class="sidebar-card__viewed-category">
            <?= getFilteredCategory(get_the_category()) ?>
          </span>
          <a class="sidebar-card__viewed-title mt-2" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
          <p class="sidebar-card__viewed-date mt-2"><?php the_time('F j, Y'); ?></p>

        <?php endwhile; ?>


      </div>
    </div>
  </div>
</div>

<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>
