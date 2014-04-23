<?php
/**
 * The template for displaying 404 pages (Not Found)
 * @package sampression framework v 1.0
 * @theme naya 1.0
 */
if ( ! defined('ABSPATH')) exit('restricted access');
get_header();
?>

<section class="block">
    <div class="container">
        <div id="content" class="<?php sampression_content_class() ?>">
            <article class="post">
                <header class="entry-header">
                    <h1 class="entry-title"><?php _e( '404 ERROR!', 'sampression' ) ?></h1>
                    <p><?php _e( 'Page not found', 'sampression' ) ?></p>
                </header>
                <div class="entry-content">
                    <?php printf( '<p>%s</p>', sampression_404_text() ); ?>
                </div>
                <?php get_search_form(); ?>
                <a href="javascript:history.go(-1);" class="link"><?php _e( 'Return to the previous page', 'sampression' ) ?></a>
            </article>
            <!--end of .post-->
        </div>
        <!--#content-->
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