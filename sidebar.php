<?php
/**
 * Default template for displaying Primary Widget Area
 * @package sampression framework v 1.0
 * @theme naya 1.0
 */
if ( !defined( 'ABSPATH' ) )
    exit( 'restricted access' );
?>
<aside id="sidebar" role="complementary" class="<?php sampression_sidebar_class() ?>">
    <?php do_action( 'sampression_before_sidebar' ); ?>
    <?php
    if ( is_active_sidebar( 'primary-sidebar' ) ) {
        dynamic_sidebar( 'primary-sidebar' );
    }
    ?>
    <?php do_action( 'sampression_after_sidebar' ); ?>
</aside>
<!-- #sidebar-->