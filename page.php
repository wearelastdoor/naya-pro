<?php
/**
 * Default template for single page
 * @package sampression framework v 1.0
 * @theme naya 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );
get_header();
?>

<section class="block">
    <div class="container">
        <div class="<?php sampression_content_class() ?>">
            <div id="primary-content">
                <?php if ( have_posts() ) : ?>                    
                <?php while ( have_posts() ) : the_post(); ?>    
                    <div <?php post_class(); ?> >
                          <header class="entry-header">
                            <?php sampression_the_title() ?>
                        </header>
                            <?php sampression_post_thumbnail(); ?>
                       <div class="entry-content">
                            <?php
                            the_content();
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'sampression' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                                ) );
                            ?>
                        </div>
                    </div>
                    
                <?php endwhile; ?>
                <!-- content navigation -->                    
                <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                    comments_template();
                    ?>

                <?php else : ?>

                    <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>
                <!-- .post-->

            </div>
          <!-- #primary-content-->
        </div>
        <?php 
            $position = sampression_sidebar_position();
            if ($position === 'right') {
                get_sidebar();
            }                           
        ?>          
    </div>
</section><!--.block-->
<?php get_footer(); ?>