<?php
if ( ! defined('ABSPATH')) exit('restricted access');

add_action( 'after_setup_theme', 'sampression_register_nav_menus' );

function sampression_register_nav_menus() {

	if ( ! current_theme_supports( 'sampression-menus' ) )
		return;

	$menus = get_theme_support( 'sampression-menus' );

	/** Register supported menus */
	foreach ( (array) $menus[0] as $id => $name ) {
		register_nav_menu( $id , $name );
	}


}

function _option_menu() {//SAM_FW_CURRENT_PAGE
    
    $menus = array(
        'logos-icons' => array(
            'slug' => 'sampression-options',
            'label' => __( 'Logos &amp; Icons', 'sampression' )
        ),
        'styling' => array(
            'slug' => 'sampression-options&sam-page=styling',
            'label' => __( 'Styling', 'sampression' )
        ),
        'typography' => array(
            'slug' => 'sampression-options&sam-page=typography',
            'label' => __( 'Typography', 'sampression' )
        ),
        'social-media' => array(
            'slug' => 'sampression-options&sam-page=social-media',
            'label' => __( 'Social Media', 'sampression' )
        ),
        'custom-css' => array(
            'slug' => 'sampression-options&sam-page=custom-css',
            'label' => __( 'Custom CSS', 'sampression' )
        ),
        'blog' => array(
            'slug' => 'sampression-options&sam-page=blog',
            'label' => __( 'Blog', 'sampression' )
        ),
        'miscellaneous' => array(
            'slug' => 'sampression-options&sam-page=miscellaneous',
            'label' => __( 'Miscellaneous', 'sampression' )
        ),
        'hooks' => array(
            'slug' => 'sampression-options&sam-page=hooks',
            'label' => __( 'Hooks', 'sampression' )
        )
    );
    
    foreach ( (array) $menus as $key => $val ) {
        ?>
        <li class="<?php echo $key; if($key == SAM_FW_CURRENT_PAGE) { echo ' current'; } ?>"><a href="themes.php?page=<?php echo $val['slug']; ?>"><i class="icon-sam-<?php echo $key; ?>"></i><?php echo $val['label']; ?></a></li>
    <?php
    }
    
}