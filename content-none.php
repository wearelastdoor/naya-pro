<?php
/**
 * The template for displaying a "No posts found" message
 * @package sampression framework v 1.0
 * @theme naya 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );
?>
<article class="post">
    <header class="entry-header">
        <h1 class="entry-title"><?php _e( 'Nothing Found', 'sampression' ); ?></h1>
    </header>
    <div class="entry-content">
        <p><?php _e( "You can start a new search by using the box below.", 'sampression' ); ?></p>
    </div>
    <?php get_search_form(); ?>
</article>