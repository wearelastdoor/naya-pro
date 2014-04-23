<?php

if (!defined('ABSPATH'))
    exit('restricted access');

/*=======================================================================
 * Fire up the engines to start theme setup.
 *=======================================================================*/

add_action('after_setup_theme', 'sampression_setup');

if (!function_exists('sampression_setup')):

    function sampression_setup() {

        global $content_width;

        /**
         * Global content width.
         */
        if (!isset($content_width))
            $content_width = 650;
        
         /**
         * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
         * @see http://codex.wordpress.org/Function_Reference/add_editor_style
         */
        add_editor_style();
        /**
         * This feature enables custom background color and image support for a theme
         */
        add_theme_support( 'custom-background', array(
			'default-color' => '',
		) );
		
        /**
         * This feature enables custom header color and image support for a theme
         */
        add_theme_support( 'custom-header', array(
                // Text color and image (empty to use none).
                'default-text-color'     => '',
                'default-image'          => '',

                // Set height and width, with a maximum value for the width.
                'height'                 => 152,
                'width'                  => 960,
                'max-width'              => 2000,

                // Support flexible height and width.
                'flex-height'            => true,
                'flex-width'             => true,
		'admin-head-callback'    => 'sampression_admin_header_style',
		'admin-preview-callback' => 'sampression_admin_header_image',
        ) );         
    }
endif;

/*
 * Sampression - Social Media Icons
 * @param $location header / footer
 * @return Social Media Links
 */
function sampression_social_media_icons($location = '', $separater = '') {
    if($location == '') {
        return '';
    }
    $icons = sampression_social_media();
    //sam_p($icons);
    if(count($icons['links']) == 0) {
        return '';
    }
    $return = '';
    $media = array();
    if($icons['link_styling'][$location]['active'] == 'yes') {
        //sam_p($icons['links']);
        foreach($icons['links'] as $key => $val) {
            if($icons['link_styling'][$location]['type'] == 'icon_only') {
                $media[] = '<a href="'.$val['url'].'" class="social-'.$key.'"><i class="icon-social-'.$key.'"></i></a>';
            } elseif($icons['link_styling'][$location]['type'] == 'text_only') {
                $media[] = '<a href="'.$val['url'].'" class="social-'.$key.'">'.$val['label'].'</a>';
            } else {
                $media[] = '<a href="'.$val['url'].'" class="social-'.$key.'"><i class="icon-social-'.$key.'"></i>'.$val['label'].'</a>';
            }
        }
        $return = implode($separater, $media);
    }
    return $return;
}

/**
 * Sampression Post thumbnail
 *
 */
function sampression_post_thumbnail() {
    if ( has_post_thumbnail() && ! post_password_required() ) {
        $link = get_permalink();
        if((is_single() || (is_page())) && wp_get_attachment_url(get_post_thumbnail_id())) {
            $link = wp_get_attachment_url(get_post_thumbnail_id());
        }
        //echo $link; die;
        //sam_p($sampression_image_settings);
        echo '<a href="' . $link . '" title="' . the_title_attribute('echo=0') . '" >';
            $thumb = 'large';
            the_post_thumbnail($thumb);
        echo '</a>';
    }
}

/**
 * sampression sidebar class
 *
 * @global type $sampression_style
 */
function sampression_sidebar_class($classes = array()) {
    $position = sampression_sidebar_position();
    $class = '';
    if ($position === 'left') {
        $class = 'four columns';
    } elseif ($position === 'right') {
        $class = 'four columns offset-by-one';
    } else {
        $class = '';
    }
    if(!empty($classes)) {
        if(is_array($classes)) {
            $class .= ' ' . implode(' ', $classes);
        } else {
            $class .= ' ' . $classes;
        }
    }
    echo $class;
}

/**
 * Sampression content class
 *
 * @global type $sampression_style
 */
function sampression_content_class($classes = array()) {
    $position = sampression_sidebar_position();
    $class = '';
    if ($position === 'left') {
        $class = 'eleven offset-by-one columns';
    } elseif ($position === 'right') {
        $class = 'eleven columns';
    } else {
        $class = 'sixteen columns';
    }
    if(!empty($classes)) {
        if(is_array($classes)) {
            $class .= ' ' . implode(' ', $classes);
        } else {
            $class .= ' ' . $classes;
        }
    }
    echo $class;
}

function sampression_sidebar_position() {
    global $post;
    $post_id = $post->ID;
    if(is_front_page()) {
        $post_id = get_option('page_on_front');
    }
    if(is_home()) {
        $post_id = get_option('page_for_posts');
    }
    $position = '';
    if(is_page() || is_single() || is_front_page() || is_home()) {
        $position = get_post_meta($post_id, 'sam_sidebar_by_post', true);
    }
    $sampression_position = (object) sampression_styling();
    if($position == '' || $position == 'default') {
        $position = $sampression_position->sidebar['active'];
    }
    return $position;
}


/**
 * Get blog title if use-title is set in sampression backend
 * else get logo icon
 *
 * @global type $sampression_logo_icon
 */
function sampression_blog_title() {
    $logo_icon = (object) sampression_logos_icons();
    if ($logo_icon->logo_icon['active']['name'] === 'use-title') {
        echo '<h1 class="site-title"><a href="'.get_bloginfo('wpurl').'" class="home-link">' . get_bloginfo('name') . '</a></h1>';
        if ($logo_icon->logo_icon['web_desc']['use_desc'] === 'yes') {
            echo '<h2 class="site-description">' . get_bloginfo('description') . '</h2>';
        }
    } else {
        echo '<div id="logo"><a href="'.get_bloginfo('wpurl').'" class="home-link"><img src="' . $logo_icon->logo_icon['image'] . '" title="' . get_bloginfo('name') . '" alt="' . get_bloginfo('name') . '" /></a></div>';
    }
}

/**
 * get sampression favicons
 *
 * @global type $sampression_logo_icon
 */
function sampression_favicons() {
    $sampression_logo_icon = (object) sampression_logos_icons();
    if ($sampression_logo_icon->fav_icon['favicon_16']['donot_use_favicon'] === 'no') {
        echo '<link rel="shortcut icon" href="' . $sampression_logo_icon->fav_icon['favicon_16']['image'] . '" />';
    }
    if ($sampression_logo_icon->apple_icon['donot_use_apple_icon'] === 'no') {
        if ($sampression_logo_icon->apple_icon['favicon_57']['donot_use_favicon'] === 'no') {
            echo '<link rel="apple-touch-icon" sizes="57x57" href="' . $sampression_logo_icon->apple_icon['favicon_57']['image'] . '" />';
        }
        if ($sampression_logo_icon->apple_icon['favicon_72']['donot_use_favicon'] === 'no') {
            echo '<link rel="apple-touch-icon" sizes="72x72" href="' . $sampression_logo_icon->apple_icon['favicon_72']['image'] . '" />';
        }
        if ($sampression_logo_icon->apple_icon['favicon_114']['donot_use_favicon'] === 'no') {
            echo '<link rel="apple-touch-icon" sizes="114x114" href="' . $sampression_logo_icon->apple_icon['favicon_114']['image'] . '" />';
        }
        if ($sampression_logo_icon->apple_icon['favicon_144']['donot_use_favicon'] === 'no') {
            echo '<link rel="apple-touch-icon" sizes="144x144" href="' . $sampression_logo_icon->apple_icon['favicon_144']['image'] . '" />';
        }
    }
}

/**
 * message info
 */
function message_info() {
    if (isset($_GET['message'])) {// class="message success auto-close"
        switch ($_GET['message']) {
            case 1:
                echo '<div id="self-destroy" class="restore-info">Successfully imported.</div>';
                break;
            case 2:
                echo '<div id="self-destroy" class="restore-info">Successfully restored to default.</div>';
                break;
            case 3:
                echo '<div id="self-destroy" class="restore-info">Your site is using default settings.</div>';
                break;
            case 4:
                echo '<div id="self-destroy" class="restore-info">' . SAM_FW_CSS_DIR . '/custom-css.css is not writeable. Please erase all CSS from the existing file.</div>';
                break;
            case 5:
                echo '<div id="self-destroy" class="restore-info">Imported file contain error.</div>';
                break;
            case 6:
                echo '<div id="self-destroy" class="restore-info">Imported file is invalid.</div>';
                break;
            default :
                echo '';
                break;
        }
    }
}

/**
 * generate javascript alert message
 *
 * @param $str message string
 */
function sam_a($str) {
    print "<script>\n";
    print "alert('" . $str . "');";
    print "</script>\n";
}

/**
 *  Php print_r function
 *
 * @param $array array
 */
function sam_p($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

if (isset($_GET['action']) && $_GET['action'] === 'restore') {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    WP_Filesystem();
    global $wp_filesystem;
    $key_values = array('sam-logos-icons-settings', 'sam-style-settings', 'sam-typography-settings', 'sam-social-media-settings', 'sam-custom-css-settings', 'sam-blog-page-settings', 'sam-hooks-settings');
    $counter = 0;
    foreach ($key_values as $key_value) {
        if (delete_option($key_value)) {
            $counter++;
        }
    }
    
    $message = 2;
    if ($counter === 0) {
        $message = 3;
    }
    $file = SAM_FW_CSS_DIR . '/custom-css.css';
    $css = ' ';
    if (!is_writable($file)) {
        $message = 4;
    } else {
        if (file_exists($file)) {
            if ( ! $wp_filesystem->put_contents( $file, $css, FS_CHMOD_FILE) ) {
                echo __('CSS could not be written at this time. Please try again later.', 'sampression');
            }
        }
    }
    $link = '';
    if(isset($_GET['sam-page']) && $_GET['sam-page']!= '') {
        $link = '&sam-page='.$_GET['sam-page'];
    }
    wp_redirect('themes.php?page=' . $_GET['page'] . $link . '&message=' . $message);
    exit;
}

add_action('after_setup_theme', 'sampression_additional_image_sizes');

/**
 * sampression image sizes
 *
 * @global type $image_settings_serialize
 */
function sampression_additional_image_sizes() {
    global $image_settings_serialize;
    $image_option = get_option('sam-image-settings', $image_settings_serialize);
    $image_settings = unserialize($image_option);
    $custom_sizes = $image_settings['image_sizes'];
    //sam_p($custom_sizes);
    for ($i = 0; $i < count($custom_sizes); $i++) {
        add_image_size($custom_sizes[$i]['slug'], $custom_sizes[$i]['width'], $custom_sizes[$i]['height'], true);
    }
    add_filter( 'image_size_names_choose', 'sampression_custom_image_sizes' );
}

/**
 * sampression navigation
 */
function sampression_navigation() {
    $args = array(
        'menu' => 'primary',
        'menu_class' => 'main-nav clearfix',
        'theme_location' => 'primary',
        'container'       => 'div',
	'container_class' => 'main-nav-wrapper',
        'fallback_cb' => 'sampression_primary_navigation_fallback'
    );
    wp_nav_menu($args);
}

function sampression_primary_navigation_fallback() {
    $args = array(
        'sort_column' => 'menu_order, post_title',
	'menu_class'  => 'main-nav-wrapper',
    );
    wp_page_menu($args);
}

if (!function_exists('sampression_the_title')) :
    function sampression_the_title() {
        if(get_post_format() === 'link') {
            the_title( '<h1 class="entry-title"><a href="' . esc_url( sampression_get_link_url() ) . '" rel="bookmark">', '</a></h1>' );
        } else {
            if ( is_single() || is_page() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
            endif;
        }
    }
endif;

if (!function_exists('sampression_post_meta')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function sampression_post_meta() {
        $sampression_blog_settings = (object) sampression_blog();
        $posted = '';
        $post_format = 'posted';
        if(get_post_format() === 'chat') {
            $post_format = 'chat';
        } elseif(get_post_format() === 'status') {
            $post_format = 'status';
        } elseif(get_post_format() === 'video') {
            $post_format = 'video';
        }
        if($sampression_blog_settings->post_meta['meta']['author'] === 'yes') {
            global $authordata;
            $posted .= sprintf(
                        '<span class="author">%4$s by <a href="%1$s" title="%2$s" rel="author">%3$s</a></span> ',
                        esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
                        esc_attr( sprintf( __( 'Posts by %s', 'sampression' ), get_the_author() ) ),
                        get_the_author(),
                        $post_format
                    );
        }
        if($sampression_blog_settings->post_meta['meta']['date'] === 'yes') {
            $time = '';
            if($sampression_blog_settings->post_meta['meta']['time'] === 'yes') {
                $time = ' ' . get_the_time();
            }
            $posted .= sprintf(
                        '<time datetime="%2$s" class="entry-date"><a href="%3$s">%1$s' . $time . '</a></time>',
                        get_the_date($sampression_blog_settings->post_meta['date_time']['date_active']),
                        get_the_date('c'),
                        get_permalink()
                    );
        }

        if($sampression_blog_settings->post_meta['meta']['categories'] === 'yes') {
            if(get_the_category_list()) {
                $posted .= '<span class="categories-links"> under ' . get_the_category_list(__(', ', 'sampression')) . '</span> ';
            }
        }
        if($sampression_blog_settings->post_meta['meta']['tags'] === 'yes') {
            if(get_the_tag_list()) {
                $posted .= '<span class="tags-links">' . get_the_tag_list( '', ', ', '' ) .'</span>';
            }
        }
        echo $posted;
    }

endif;

/**
 * sampression custom image sizes
 *
 * @global $_wp_additional_image_sizes
 * @param $image_sizes size-id
 * @return array
 */
function sampression_custom_image_sizes( $image_sizes ) {
    global $_wp_additional_image_sizes;
    if( empty( $_wp_additional_image_sizes ) )
        return $image_sizes;

    foreach ( $_wp_additional_image_sizes as $id => $data ) {
        if( !isset($image_sizes[$id]) )
            $image_sizes[$id] = ucwords( str_replace( '-', ' ', $id ) );
    }
    return $image_sizes;
}

add_filter( 'widget_text', 'do_shortcode');

function sampression_exclude_categories($query) {
    $sampression_blog_settings = (object) sampression_blog();
    if(count($sampression_blog_settings->blog_category['cat_id']) > 0) {
        $exclude = $sampression_blog_settings->blog_category['cat_id'];
        if ($query->is_home) {
            $query->set('category__not_in', $exclude);
        }
        if ($query->is_feed) {
            $query->set('category__not_in', $exclude);
        }
        if ($query->is_search) {
            $query->set('category__not_in', $exclude);
        }
        if (!is_admin() && $query->is_archive) {
            $query->set('category__not_in', $exclude);
        }
    }
    return $query;
}


add_filter('pre_get_posts','sampression_exclude_categories');

if ( ! function_exists( 'sampression_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function sampression_content_nav(  ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" class="<?php echo $nav_class; ?> clearfix">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'sampression' ); ?></h1>

	<?php if(is_attachment()) {
            
                $prev_image = sampression_get_previous_image_id();
                $next_image = sampression_get_previous_image_id(false);
                
                ?>
                <span class="nav-next alignright"><?php next_image_link(FALSE, truncate_text($next_image->post_title, 35)) ?></span>
                <span class="nav-prev alignleft"><?php previous_image_link(FALSE, truncate_text($prev_image->post_title, 35)) ?></span>
                <?php
        } elseif ( is_single() ) { // navigation links for single posts ?>
                <?php 
                $prev_post = get_adjacent_post('', '', true);
                $next_post = get_adjacent_post('', '', false);
                ?>
		<?php
                if(!empty($prev_post)) {
                    previous_post_link( '%link', truncate_text(get_the_title($prev_post->ID), 35) );//'%title'
                }
                if(!empty($next_post)) {
                    next_post_link( '%link', truncate_text(get_the_title($next_post->ID), 35) );//'%title'
                }
                ?>

        <?php } elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { // navigation links for home, archive, and search pages ?>
                <?php
                $sampression_blog_settings = (object) sampression_blog();
                //sam_p($sampression_blog_settings);
                if($sampression_blog_settings->pagination['default']['active'] === 'yes') {
                ?>
		<?php if ( get_next_posts_link() ) : ?>
		<?php next_posts_link( __( 'Older Posts', 'sampression' ) ); ?>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<?php previous_posts_link( __( 'Newer Posts', 'sampression' ) ); ?>
		<?php endif; ?>
                <?php
                } else {
                     sampression_pagination();
                }
                ?>

    <?php } ?>

	</nav>
	<?php
}
endif;

function sampression_get_previous_image_id($prev = true) {
    $post = get_post();
    $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );

    foreach ( $attachments as $k => $attachment )
        if ( $attachment->ID == $post->ID )
            break;

    $k = $prev ? $k - 1 : $k + 1;
    $output = $attachment_id = null;
    if ( isset( $attachments[ $k ] ) ) {
        $attachment_id = $attachments[ $k ]->ID;
    }
    return get_post($attachment_id);
}            
                
                

if(!function_exists('sampression_attached_image')) {
    
    function sampression_attached_image() {
        
        $post = get_post();
        $next_attachment_url = wp_get_attachment_url();
        
        $attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );
        
        // If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, 'large' )
	);
    }
    
}

if ( ! function_exists( 'sampression_pagination' ) ) :
	function sampression_pagination() {
		global $wp_query;

		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
                        'prev_text' => __('<', 'sampression'),
                        'next_text' => __('>', 'sampression')
		) );
	}
endif;

add_filter('next_posts_link_attributes', 'sampression_next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'sampression_previous_posts_link_attributes');

function sampression_next_posts_link_attributes() {
    return 'class="nav-next alignright"';
}

function sampression_previous_posts_link_attributes() {
    return 'class="nav-prev alignleft"';
}

add_filter('next_post_link', 'sampression_next_post_link');
add_filter('previous_post_link', 'sampression_previous_post_link');

function sampression_next_post_link($url) {
    return preg_replace('/rel="next"/', 'rel="next" class="nav-next alignright"', $url);
}

function sampression_previous_post_link($url) {
    return preg_replace('/rel="prev"/', 'rel="next" class="nav-prev alignleft"', $url);
}

add_filter('pre_get_posts','sampression_exclude_categories');

/**
 * Popular post function
 * @param $args arguments
 */
function sampression_popular_post($args=array()){
	$by = isset($args['by']) ? (strip_tags($args['by'])): 'comment_count';
	$number = isset($args['number']) ? (strip_tags($args['number'])) : 10;
	$meta_key = '';
	$order_by = 'comment_count';
	if($by == 'views'){
		$meta_key = 'post_views_count';
		$order_by = 'meta_value_num';
	}
	$argument = array(
		'post_type' => 'post',
		'posts_per_page' => $number,
		'meta_key' => $meta_key,
		'orderby' => $order_by
	);
	$loop = new WP_Query($argument);
	while( $loop -> have_posts()): $loop -> the_post();
?>
	<li> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </li>
<?php

	endwhile; wp_reset_postdata();
}

/**
 * Recent post function
 *
 * @param type $args arguments
 */
function sampression_recent_post($args=array()){
	$number = isset($args['number']) ? (strip_tags($args['number'])) : 10;
	$argument = array(
		'post_type' => 'post',
		'posts_per_page' => $number
	);
	$loop = new WP_Query($argument);
	while( $loop -> have_posts()): $loop -> the_post();
?>
	<li> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </li>
<?php

	endwhile; wp_reset_postdata();
}

/*=======================================================================
 * Comment Reply
 *=======================================================================*/
function sampression_enqueue_comment_reply() {
if ( is_singular() && comments_open() && get_option('thread_comments')) { 
		wp_enqueue_script('comment-reply'); 
	}
}
add_action( 'wp_enqueue_scripts', 'sampression_enqueue_comment_reply' );

if ( ! function_exists( 'sampression_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function sampression_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'sampression' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'sampresion' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<div class="author-avatar vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>

				</div><!-- .comment-author -->

                                <div class="comment-wrapper">
                                        <div class="comment-meta">
                                            <div class="comment-author clearfix">

                                                <span class="fn"><?php echo get_comment_author_link() ?></span>
                                                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>"><span class="date-details"><?php echo get_comment_date(); ?> at <?php echo get_comment_time(); ?></span></time></a>
                                            </div>
                                        </div>
                                        <div class="comment-content clearboth">
                                            <?php comment_text(); ?>
                                        </div>
<!--                                        <a href="#" class="comment-reply-link">Reply</a>-->
<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
                                    </div>



				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'sampression' ); ?></p>
				<?php endif; ?>


		</article><!-- .comment-body -->

	<?php
	endif;
}
endif;

/**
 * Return the post URL.
 *
 */
function sampression_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Truncate string in center
 *
 * @param $file File basename
 * @return truncated file name
 */
function truncate_text($str, $length = 20) {
    if(strlen($str) <= $length) {
        return $str;
    }
    $separator = '...';
    $separatorlength = strlen($separator) ;
    $maxlength = $length - $separatorlength;
    $start = $maxlength / 2 ;
    $trunc =  strlen($str) - $maxlength;

    return substr_replace($str, $separator, $start, $trunc);
}

/*
 * Display font select menu
 * 
 * @param $name Select Menu Name
 * @param $class Select Menu Class Name(s)
 * @param $default Select Menu Default Value i.e. selected value
 */
function sampression_font_select($name = '', $class = '', $default = '') {
    $default_fonts = (object) sampression_fonts_style();
    $fonts = $default_fonts->fonts;
    $return = '';
    $return .= '<select name="' . $name . '" class="' . $class . '">';
    foreach ($fonts as $fkey => $fval) {
        $return .= '<optgroup label="' . ucwords(str_replace('-', ' ', $fkey)) . '">';
        foreach ($fval as $key => $val) {
            $sel = '';
            if($default !== '' && ($val == $default)) {
                $sel = ' selected="selected"';
            }
            $return .= '<option value="' . $val .'"' . $sel . '>' . $key . '</option>';
        }
        $return .= '</optgroup>';
    }
    $return .= '</select>';
    echo $return;
}

/*
 * Display font size select menu
 * 
 * @param $name Select Menu Name
 * @param $class Select Menu Class Name(s)
 * @param $default Select Menu Default Value i.e. selected value
 * @param $min Minimum size value
 * @param $max Maximum size value
 */
function sampression_font_size_select($name = '', $class = '', $default = '') {
    $default_fonts = (object) sampression_fonts_style();
    $size = $default_fonts->size;
    $return = '';
    $return .= '<select name="' . $name . '" class="' . $class . '">';
    for ($i = $size['min_value']; $i <= $size['max_value']; $i++) {
        $sel = '';
        if($default !== '' && ($i == $default)) {
            $sel = ' selected="selected"';
        }
        $return .= '<option value="' . $i . '"' . $sel . '>' . $i . 'px</option>';
    }
    $return .= '</select>';
    echo $return;
}

/*
 * Display font style select menu
 * 
 * @param $name Select Menu Name
 * @param $class Select Menu Class Name(s)
 * @param $default Select Menu Default Value i.e. selected value
 */
function sampression_font_style_select($name = '', $class = '', $default = '') {
    $default_fonts = (object) sampression_fonts_style();
    $style = $default_fonts->style;
    $return = '';
    $return .= '<select name="' . $name . '" class="' . $class . '">';
    foreach ($style as $key => $val) {
        $sel = '';
        if($default !== '' && ($val == $default)) {
            $sel = ' selected="selected"';
        }
        $return .= '<option value="' . $val . '"' . $sel . '>' . $key . '</option>';
    }
    $return .= '</select>';
    echo $return;
}

/*
 * Display font transformation select menu
 * 
 * @param $name Select Menu Name
 * @param $class Select Menu Class Name(s)
 * @param $default Select Menu Default Value i.e. selected value
 */
function sampression_font_transformation_select($name = '', $class = '', $default = '') {
    $default_transformation = (object) sampression_fonts_style();
    $transformation = $default_transformation->transformation;
    $return = '';
    $return .= '<select name="' . $name . '" class="' . $class . '">';
    foreach ($transformation as $key => $val) {
        $sel = '';
        if($default !== '' && ($val == $default)) {
            $sel = ' selected="selected"';
        }
        $return .= '<option value="' . $val . '"' . $sel . '>' . $key . '</option>';
    }
    $return .= '</select>';
    echo $return;
}

function sampression_get_template($template_name) {
    include_once SAM_FW_TEMPLATE_DIR . '/' . $template_name;
}

function sampression_readmore_link() {
    if(sampression_get_the_excerpt()) {
        $blog_settings = (object) sampression_blog();
        $more = 'Read more';
        if(!empty($blog_settings->post_meta['others']['more_text'])) {
            $more = $blog_settings->post_meta['others']['more_text'];
        }
        printf( '<div class="entry-footer"><a href="%2$s">%1$s</a></div>', $more, get_permalink() );
    }
}

function sampression_post_class() {
    
    $blog_settings = (object)sampression_blog();
    if($blog_settings->post_meta['meta']['icon'] == 'yes') {
        return array('format-icon', 'clearfix');
    }
    return array('clearfix');
    
}

function sampression_get_post_format() {
    $format = get_post_format();
    if ( false === $format ) {
            $format = 'standard';
    }
    return $format;
}

//Removing default inline style of [gallery] shortcode
add_filter( 'use_default_gallery_style', '__return_false' );

function sampression_get_the_excerpt($post_id = '') {
    $excerpt = '';
    if($post_id !== '') {
        global $post;
        $post_id = $post->ID;
    }
    $post = get_post($post_id);
    $excerpt = $post->post_excerpt;
    return $excerpt;
}

// 404 Page error messages
function sampression_404_text() {
    return __("Sorry but we couldn't find the page you are looking for. Please check to make sure you've typed the URL correctly. You may also want to search for what you are looking for.", 'sampression');
}

function sampression_nothing_found_text() {
    
    return __("You can start a new search by using the box below.", 'sampression');
    
}

/*=======================================================================
 * Shows footer credits
 *=======================================================================*/
function sampression_footer_text() {
?>
    <?php _e( 'A theme by', 'sampression' ); ?> <a href="<?php echo esc_url( __( 'http://sampression.com', 'sampression' ) ); ?>" target="_blank" title="<?php esc_attr_e( 'Sampression', 'sampression' ); ?>"><?php _e( 'Sampression', 'sampression' ); ?></a>. <?php _e( 'Powered by', 'sampression' ); ?> <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'sampression' ) ); ?>" title="<?php esc_attr_e( 'WordPress', 'sampression' ); ?>" target="_blank" ><?php _e( 'WordPress', 'sampression' ); ?></a>.
<?php
}
add_filter( 'sampression_credits', 'sampression_footer_text' );


/*=======================================================================
 * Custom Header Admin Preview
 *=======================================================================*/
if ( ! function_exists( 'sampression_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see bijay_custom_header_setup().
 */
function sampression_admin_header_style() {
        $sampression_logo_icon = (object) sampression_logos_icons();
        
?>
	<style type="text/css">
		.appearance_page_custom-header #admin-heading {
			border: none;
		}
		#admin-heading h1 {
                    margin: 0;
		}
		#admin-heading h1.site-title a {
                   color: <?php echo $sampression_logo_icon->logo_icon['active']['color']; ?>;
                   text-decoration: none;
                   font: <?php echo $sampression_logo_icon->logo_icon['active']['style'].' '. $sampression_logo_icon->logo_icon['active']['size'] . 'px '. $sampression_logo_icon->logo_icon['active']['font']; ?>;
		}
		#desc {
                   color: <?php echo $sampression_logo_icon->logo_icon['web_desc']['color']; ?>;
                   font: <?php echo $sampression_logo_icon->logo_icon['web_desc']['style'].' '. $sampression_logo_icon->logo_icon['web_desc']['size'] . 'px '. $sampression_logo_icon->logo_icon['web_desc']['font']; ?>;
                   padding-top: 0;
                   padding-bottom: 10px;
		}
	</style>
<?php
}
endif; // bijay_admin_header_style

if ( ! function_exists( 'sampression_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see bijay_custom_header_setup().
 */
function sampression_admin_header_image() {
?>
	<div id="admin-heading">
		<h1 class="site-title"><a id="name" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 class="displaying-header-text" id="desc"><?php bloginfo( 'description' ); ?></h2>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // sampression_admin_header_image