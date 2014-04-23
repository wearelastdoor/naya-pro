<?php
/**
 * Default template for displaying content
 * @package sampression framework v 1.0
 * @theme naya 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php sampression_the_title() ?>
        <div class="entry-meta">
            <?php sampression_post_meta(); ?>
        </div>
    </header>
        
    <div class="entry-content">
        <?php
        sampression_post_thumbnail();
        if( is_search() ) :
            the_excerpt();
        else :
            if( is_single() || !sampression_get_the_excerpt() ) {
                the_content();
                wp_link_pages( array(
                        'before'      => '<div class="page-links">',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                ) );
            } else {
                the_excerpt();
            }
        endif;
        ?>
    </div>
    <?php sampression_readmore_link() ?>
</article>