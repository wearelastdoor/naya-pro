<?php
/**
 * Default template for displaying Header
 * @package sampression framework v 1.0
 * @theme naya 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );
?>
<!doctype html>
<!--[if lt IE 7]>      <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 ie7"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes(); ?> class="no-js lt-ie9 ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>" />
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

<title><?php bloginfo( 'name' ); ?> <?php wp_title( '|', true ); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_bloginfo( 'stylesheet_url' ) ); ?>" media="all" />
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>" />
<?php sampression_favicons(); ?>
<!--[if lt IE 9]>
<script src="<?php echo SAM_FW_JS_URL; ?>/modernizr.js"></script>
<![endif]-->
<?php do_action( 'sampression_before_head_close' ); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'sampression_after_body' ); ?>
<?php do_action( 'sampression_before_header' ); ?>
<div id="wrapper">
    <div id="inner-wrapper">
        <header id="header" class="block">
            <div class="container">
                <div class="six columns">
                	<span id="trigger-primary-nav"><a href="#primary-nav"><i class="icon-menu6"></i>&nbsp;</a></span>
                   <div class="site-title-wrap">
                        <?php sampression_blog_title() ?>
                    </div>
                </div>
                <div class="social-connect">
                    <?php echo sampression_social_media_icons( $location = 'header', $separater = '' ) ?>
                </div>
                <?php $header_image = get_header_image();
        		if ( ! empty( $header_image ) ) : ?>
                            <div class="jumbotron">
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo get_bloginfo('name'); ?>" /></a>
                            </div>
        		<?php endif; ?>
                <!-- .social-connect-->
                
                <nav id="primary-nav" class="clearfix" role="navigation">
                    
                    <?php sampression_navigation() ?>
                    
                </nav>
                <!-- #primary-nav -->
            </div>
        </header>
        <!--/#header-->
        <?php do_action( 'sampression_after_header' ); ?>