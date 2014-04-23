<?php if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );?>
<div id="sam-wrapper">
    <div id="header" class=" clearfix">
        <div id="logo">
            <h2><?php _e( 'naya lite', 'sampression' );?></h2>
            <span class="tagline"><?php _e( 'a new theme', 'sampression' );?></span>
        </div>
        <div class="sam-version">
            <span><?php _e( 'version 1.0', 'sampression' );?></span>
            <span><?php _e( 'framework 1.0', 'sampression' );?></span>
        </div>
    </div><!--end of #header-->
    <nav id="top-nav" class="clearfix">
        <ul class="external-links">
            <li><a href="http://sampression.com/themes/naya-lite" target="_blank"><i class="icon-view-changes-log"></i><?php _e( 'VIEW CHANGE LOG', 'sampression' );?></a></li>
            <li><a href="http://docs.sampression.com/category/naya-lite" target="_blank"><i class="icon-theme-documentation"></i><?php _e( 'THEME DOCUMENTATION', 'sampression' );?></a></li>
            <li><a href="http://sampression.com/forums/forum/naya-lite" target="_blank"><i class="icon-support-desk"></i><?php _e( 'VISIT SUPPORT DESK', 'sampression' );?></a></li>
        </ul>
    </nav>
    <!-- #top-nav-->
    <div id="sam-main-content" class="clearfix">
        <?php message_info() ?>