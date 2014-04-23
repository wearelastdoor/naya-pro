<?php

add_action( 'sampression_init', 'sampression_theme_support' );

/**
 * sampression theme support
 */
function sampression_theme_support() {
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'quote', 'link', 'status', 'audio', 'chat' ) );
    //array( 'aside', 'image', 'gallery', 'video', 'quote', 'link', 'status', 'audio', 'chat' )
    if ( ! current_theme_supports( 'sampression-menus' ) )
        add_theme_support( 'sampression-menus', array(
            'primary'   => __('Primary Navigation', 'sampression')
        ) );

    if ( ! current_theme_supports( 'sampression-sidebars' ) )
        add_theme_support( 'sampression-sidebars', array(
            'primary-sidebar'   => array(
                'column' => '1 Column',
                'name' => __('Primary Sidebar', 'sampression'),
                'slug' => 'primary-sidebar',
                'desc' => __('The Primary Widget.', 'sampression')
            )
        ) );

}

add_action( 'sampression_init', 'sampression_constants' );

/**
 * Define Sampression Constants
 */
function sampression_constants() {

	/** Define Directory Location Constants */
	define( 'SAM_FW_THEME_DIR', get_template_directory() );
	define( 'SAM_FW_IMAGES_DIR', SAM_FW_THEME_DIR . '/images' );
        define( 'SAM_FW_TIMTHUMB_DIR', SAM_FW_THEME_DIR . '/timthumb' );
	define( 'SAM_FW_LIB_DIR', SAM_FW_THEME_DIR . '/lib' );
	define( 'SAM_FW_INC_DIR', SAM_FW_THEME_DIR . '/inc' );
	define( 'SAM_FW_TEMPLATE_DIR', SAM_FW_THEME_DIR . '/inc/templates' );
	define( 'SAM_FW_ADMIN_DIR', SAM_FW_INC_DIR . '/admin' );
	define( 'SAM_FW_ADMIN_CSS_DIR', SAM_FW_ADMIN_DIR . '/css' );
	define( 'SAM_FW_ADMIN_JS_DIR', SAM_FW_ADMIN_DIR . '/js' );
	define( 'SAM_FW_ADMIN_IMAGES_DIR', SAM_FW_ADMIN_DIR . '/images' );
	define( 'SAM_FW_JS_DIR', SAM_FW_LIB_DIR . '/js' );
	define( 'SAM_FW_CSS_DIR', SAM_FW_LIB_DIR . '/css' );
	define( 'SAM_FW_CLASSES_DIR', SAM_FW_INC_DIR . '/classes' );
	define( 'SAM_FW_FUNCTIONS_DIR', SAM_FW_INC_DIR . '/functions' );
	define( 'SAM_FW_WIDGETS_DIR', SAM_FW_INC_DIR . '/widgets' );
	define( 'SAM_FW_LANGUAGES_DIR', SAM_FW_THEME_DIR . '/languages' );
        
        /** Define Template Part Constants **/
        define( 'SAM_FW_CLS_TPL_PART_DIR', 'inc/classes/' );
        define( 'SAM_FW_FUNC_TPL_PART_DIR', 'inc/functions/' );
        define( 'SAM_FW_WIDGET_TPL_PART_DIR', 'inc/widgets/' );

	/** Define URL Location Constants */
	define( 'SAM_FW_SITE_URL', site_url() );
        define( 'SAM_FW_SITE_WPADMIN_URL', admin_url() );
	define( 'SAM_FW_THEME_URL', get_template_directory_uri() );
	define( 'SAM_FW_IMAGES_URL', SAM_FW_THEME_URL . '/images' );
        define( 'SAM_FW_TIMTHUMB_URL', SAM_FW_THEME_URL . '/timthumb' );
	define( 'SAM_FW_LIB_URL', SAM_FW_THEME_URL . '/lib' );
	define( 'SAM_FW_INC_URL', SAM_FW_THEME_URL . '/inc' );
	define( 'SAM_FW_ADMIN_URL', SAM_FW_INC_URL . '/admin' );
	define( 'SAM_FW_ADMIN_CSS_URL', SAM_FW_ADMIN_URL . '/css' );
	define( 'SAM_FW_ADMIN_JS_URL', SAM_FW_ADMIN_URL . '/js' );
	define( 'SAM_FW_ADMIN_IMAGES_URL', SAM_FW_ADMIN_URL . '/images' );
	define( 'SAM_FW_JS_URL', SAM_FW_LIB_URL . '/js' );
	define( 'SAM_FW_CSS_URL', SAM_FW_LIB_URL . '/css' );
	define( 'SAM_FW_CLASSES_URL', SAM_FW_INC_URL . '/classes' );
	define( 'SAM_FW_FUNCTIONS_URL', SAM_FW_INC_URL . '/functions' );
	define( 'SAM_FW_WIDGETS_URL', SAM_FW_INC_URL . '/widgets' );
	define( 'SAM_FW_LANGUAGES_URL', SAM_FW_THEME_URL . '/languages' );

	/** ------- */
	if ( isset( $_REQUEST['sam-page'] ) ) {
		define( 'SAM_FW_CURRENT_PAGE', mysql_real_escape_string( strtolower( trim( strip_tags( $_REQUEST['sam-page'] ) ) ) ) );
	} else {
		define( 'SAM_FW_CURRENT_PAGE', 'logos-icons' );
	}
}

add_action( 'sampression_init', 'sampression_load_framework' );

/**
 * load sampression framework
 */
function sampression_load_framework() {

        /*
         * Load Default Value
         */
        get_template_part( SAM_FW_FUNC_TPL_PART_DIR . 'defaults' );

	/** Load Classes */
	get_template_part( SAM_FW_CLS_TPL_PART_DIR . 'admin' );

	/** Load Functions */
	get_template_part( SAM_FW_FUNC_TPL_PART_DIR . 'functions' );
        get_template_part( SAM_FW_FUNC_TPL_PART_DIR . 'update-notifier' );
	get_template_part( SAM_FW_FUNC_TPL_PART_DIR . 'menu' );
	get_template_part( SAM_FW_FUNC_TPL_PART_DIR . 'sidebar' );
	get_template_part( SAM_FW_FUNC_TPL_PART_DIR . 'admin-ajax' );
	get_template_part( SAM_FW_FUNC_TPL_PART_DIR . 'view-counter' );
	get_template_part( SAM_FW_FUNC_TPL_PART_DIR . 'hooks' );
        get_template_part( SAM_FW_FUNC_TPL_PART_DIR . 'metabox' );

	/** Load Widgets */
        get_template_part( SAM_FW_WIDGET_TPL_PART_DIR . 'sam-dashboard-widget' );
	get_template_part( SAM_FW_WIDGET_TPL_PART_DIR . 'adminbar-menu' );

	/** Load Admin */
	if ( is_admin() ) :

	endif;

	/** Load Javascript */

	/** Load CSS */

}

add_action( 'sampression_init', 'sampression_i18n' );

/**
 * Internationalization
 */
function sampression_i18n() {
	load_theme_textdomain( 'sampression', SAM_FW_LANGUAGES_DIR );
}

do_action( 'sampression_init' );

new Sampression_Admin;