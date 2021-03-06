<?php get_header(); ?>

<div class="spacer"></div>

<!-- Category title -->
<h2 class="category"><span>Search //</span> <?php the_search_query(); ?></h2>

<ul class="popular-cats">
  <?php
    wp_list_categories( array(
      'odererby' => 'count',
      'order' => 'DESC',
      'number' => 5,
      'title_li' => __( '' ),
    ));
  ?>
</ul>

<?php

  global $query_string;

  $query_args = explode("&", $query_string);
  $search_query = array();

  foreach($query_args as $key => $string) {
    $query_split = explode("=", $string);
    $search_query[$query_split[0]] = urldecode($query_split[1]);
  } // foreach

  $search = new WP_Query($search_query);

  //Declare counter variable
  $counter = 0;

    if ($search->have_posts()) :
      while ($search->have_posts()) : $search->the_post ();

  //Declare variable for featured images
  $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>

<?php if($counter==0){ ?>

<section id="featured">

  <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>

  <div id="bg"></div>
  <div class="featured-info">

    <a href="http://localhost/wp"><span id="cat-back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>

    <h4><?php the_category(); ?></h4>
    <h2><?php the_title(); ?></h2>
    <p><?php the_excerpt(); ?></p>
    <a href="<?php the_permalink(); ?>"><button id="watch-now">Watch now <i class="fa fa-play"></i></button></a>
  </div>
</section>

<section id="category">

<?php } else { ?>

  <div class="padder">
    <div class="tile">
      <div class="tile-image" style="background-image:url(<?php echo $featured_img; ?>)">
      </div>
      <div class="tile-info">
        <div class="triangle"></div>
        <h4><?php the_category(); ?></h4>
        <h2><?php the_title(); ?></h2>
        <p><?php the_excerpt(); ?></p>
        <div class="grad"></div>
      </div>
      <a href="<?php the_permalink(); ?>">
      <div class="cover"></div>
      </a>
    </div>
  </div>

<?php } ?>

<?php
  $counter++;
  endwhile;
  else:
?>
  <p>Sorry, no posts matched your criteria.</p>
<?php
  endif;
  wp_reset_postdata();
?>

</section>

<!-- Pagination -->

<section id="pagination">
  <?php
    $pags = array(
      'prev_text'          => __('< Previous'),
      'next_text'          => __('Next >'),
    );
    echo paginate_links( $pags );
  ?>
</section>

<?php get_footer(); ?>
