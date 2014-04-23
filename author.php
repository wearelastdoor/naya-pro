<?php
/**
 * Main template file
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
                    <img src="http://www.gravatar.com/avatar/<?php echo md5( get_the_author_meta( 'user_email' ) ) ?>?s=65" alt="Author Image"> <?php echo get_the_author_meta( 'display_name' ); ?>
                </h1>
                <?php
                    // Show an optional term description.
                    $author_bio = get_the_author_meta( 'description' );
                    if ( ! empty( $author_bio ) ) :
                            printf( '<div class="archive-description"><p>%s</p></div>', $author_bio );
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