<?php get_header(); ?>

<div class="spacer"></div>

  <?php
  if ( have_posts() ) {
  	while ( have_posts() ) {
  		the_post();

      $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
      ?>

        <section id="blog-title">
          <div id="bg_img" style="background-image:url(<?php echo $featured_img; ?>)"></div>
          <div id="bg"></div>

                  <article class="blog">
                    <a href="http://forgetoday.com/tv"><span id="back"><I class="fa fa-arrow-circle-left"></i> Home</span></a>

                      <h2><?php the_title(); ?></h2>
                      <h3>Published <?php the_date(); ?> | In <?php the_category(); ?> | By <?php the_author(); ?></h3>

                    <?php the_content(); ?>

                    <?php comments_template( $file, $separate_comments ); ?>

                  <?php
              } // end while
            }; // end if
            ?>


            </article>

                    </section>


  <h4 class="related">More content</h4>
  <section class="related">

    <?php $orig_post = $post;
    global $post;
    $categories = get_the_category($post->ID);
    if ($categories) {
    $category_ids = array();
    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
    $args=array(
    'category__in' => $category_ids,
    'post__not_in' => array($post->ID),
    'posts_per_page'=> 4, // Number of related posts that will be displayed.
    'caller_get_posts'=>1,
    'orderby'=>'rand' // Randomize the posts
    );
    $my_query = new wp_query( $args );
    if( $my_query->have_posts() ) {
    while( $my_query->have_posts() ) {
    $my_query->the_post();

    $featured_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    ?>

    <div class="padder">
    <div class="related-tile">

      <div class="related-image" style="background-image:url(<?php echo $featured_img; ?>)">
      </div>
      <div class="related-content">
        <h4><?php the_date(); ?></h4>
        <h3><?php the_title(); ?></h3>
      </div>

      <a href="<?php the_permalink(); ?>"><div class="cover"></div></a>

      <div class="grad"></div>

    </div>
    </div>

    <?php }
    } }
    $post = $orig_post;
    wp_reset_query(); ?>

  </section>

    <a id="more" href="http://localhost/wp"><span><I class="fa fa-arrow-circle-right"></i> More videos</span></a>


<?php
get_template_part(contact);
get_footer();
?>
