<?php
/**
 * The template for displaying Category pages
 * @package sampression framework v 1.0
 * @theme naya 1.0
 */
if ( ! defined('ABSPATH')) exit('restricted access');
get_header();
?>

<section class="block">
    <div class="container">
        <div id="content" class="<?php sampression_content_class() ?>">
            <header class="archive-header">
                        <h1 class="archive-title">
                           <?php printf( __( 'Category: %s', 'sampression' ), single_cat_title( '', false ) ); ?>
                        </h1>
                        <?php
                            // Show an optional term description.
                            $term_description = term_description();
                            if ( ! empty( $term_description ) ) :
                                    printf( '<div class="archive-description"><p>%s</p></div>', $term_description );
                            endif;
                        ?>
					</header>
            <?php if ( have_posts() ) : ?>
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php
                        get_template_part( 'content', get_post_format() );
                    ?>

                <?php endwhile; ?>

                <?php sampression_content_nav(); ?>

            <?php else : ?>

                <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>
            <!-- .post-->
        </div>
        <!-- #content-->
        <?php 
            $position = sampression_sidebar_position();
            if ($position === 'right') {
                get_sidebar();
            }                           
        ?>
    </div>
</section>
<!-- .block-->
<?php get_footer(); ?>